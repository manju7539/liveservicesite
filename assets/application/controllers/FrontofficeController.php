<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontofficeController extends CI_Controller {
    function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		 $this->load->model('FrontofficeModel');
		 $this->load->model('MainModel');
		 
		 if(empty($this->session->userdata('u_id'))){
		 	redirect('/');
		 }
		// $this->load->library('pagination');   
	}
	// public function index()
	// {   
	// 	$this->load->view('include/header');
	// 	$this->load->view('page/dashboard');
	// 	$this->load->view('include/footer');
	// }

	public function index()
	{
		if($this->session->userdata('u_id'))
		{
			
			$u_id= $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->FrontofficeModel->getData($tbl ='register', $where);
			
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			$get_hotel_name = $this->FrontofficeModel->getData($tbl ='register', $wh);
			
				$admin_id = $admin_details['hotel_id'];
				$u_id11 = $admin_details['u_id'];

			$room_status1 = 3; //available
			$room_status2 = 2; //accupied
			$room_status3 = 1; //dirty
			$room_status4 = 4; //under maintainance

			$booking_status1 = 1; //current booking

			$booking_status2 = 0; //expected arrived booking

			$booking_status3 = 2; //expected daparted
          
            $front_dashboard['total_rooms'] = $this->FrontofficeModel->get_total_room_count11($admin_id);
          

			$front_dashboard['total_availble_rooms'] = $this->FrontofficeModel->get_hotel_rooms_status($admin_id,$room_status1);

			$front_dashboard['total_accupied_rooms'] = $this->FrontofficeModel->get_hotel_rooms_status($admin_id,$room_status2);
			
			$front_dashboard['total_dirty_rooms'] = $this->FrontofficeModel->get_hotel_rooms_status($admin_id,$room_status3);
			
			$front_dashboard['total_undermaintance_rooms'] = $this->FrontofficeModel->get_hotel_rooms_status($admin_id,$room_status4);
			
			$front_dashboard['total_current_booking'] = $this->FrontofficeModel->get_hotel_user_booking($admin_id,$booking_status1);

			$front_dashboard['total_pending_booking'] = $this->FrontofficeModel->get_hotel_user_booking($admin_id,$booking_status2);
			
			$front_dashboard['total_daparted_booking'] = $this->FrontofficeModel->get_hotel_user_booking($admin_id,$booking_status3);
			
			$front_dashboard['total_CHG_guest'] = $this->FrontofficeModel->get_hotel_chg_guest($admin_id);
			
			$front_dashboard['get_front_ofs_notifications'] = $this->FrontofficeModel->get_notifications_for_front_ofs($admin_id);
			
			$front_dashboard['total_expected_current_booking'] = $this->FrontofficeModel->get_hotel_expected_current_booking($admin_id);

			$front_dashboard['get_hotel_expected_departed_booking'] = $this->FrontofficeModel->get_hotel_expected_current_booking($admin_id);
			
			$front_dashboard['get_hotel_expected_CHG_guest'] = $this->FrontofficeModel->get_hotel_guest_list($admin_id);
			
			$front_dashboard['floor_list'] = $this->FrontofficeModel->get_floor_list($admin_id);

			$front_dashboard['total_business_center'] = $this->FrontofficeModel->get_active_business_center($admin_id);

			$front_dashboard['total_reserve_business_center'] = $this->FrontofficeModel->get_reservation_bc($admin_id);

			$front_dashboard['total_b_h'] = $this->FrontofficeModel->banquet_hall($admin_id);

			$front_dashboard['total_reserve_bh'] = $this->FrontofficeModel->get_reservation_bh($admin_id);

			$front_dashboard['hotels_booking_data'] = $this->FrontofficeModel->get_hotel_peoples($admin_id);

			$order_status = 1;

			$front_dashboard['room_service_list'] = $this->FrontofficeModel->get_room_service_services_order($admin_id,$order_status);

			$front_dashboard['room_service_menu_list'] = $this->FrontofficeModel->get_room_service_menu_order($admin_id,$order_status);

			$front_dashboard['hk_service_list'] = $this->FrontofficeModel->get_house_keeping_service_order($admin_id,$order_status);

			$front_dashboard['laundry_list'] = $this->FrontofficeModel->get_laundry_order($admin_id,$order_status);

			$front_dashboard['food_list'] = $this->FrontofficeModel->get_food_order($admin_id,$order_status);

			$front_dashboard['offer_list'] = $this->FrontofficeModel->get_offer_list($admin_id,$order_status);

			$front_dashboard['today_check_in_check_out'] = $this->FrontofficeModel->get_today_booking_data($admin_id);

			// $this->load->view('pages/index',$front_dashboard);
			
			$this->load->view('include/header');
			$this->load->view('page/dashboard',$front_dashboard);
			$this->load->view('include/footer');
		}
		else
        {
            redirect(base_url());
        } 

	}
	public function get_floor_data_in_dashboard_page()
     {
		// print_r('hi');
         $date1 = $this->input->post('date');

         $date = date('Y-m-d',strtotime($date1));
		//   print_r($date1);
         $output = '';

        //  $admin_id = $this->session->userdata('admin_id');
        $u_id= $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->FrontofficeModel->getData($tbl ='register', $where);
			// var_dump($this->session->userdata());die;
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			$get_hotel_name = $this->FrontofficeModel->getData($tbl ='register', $wh);
			
				$admin_id = $admin_details['hotel_id'];
                $u_id11 = $admin_details['hotel_id'];

			

         $floor_list = $this->FrontofficeModel->get_floor_list($admin_id);
// print_r($floor_list);die;
         if($floor_list)
         {
             foreach ($floor_list as $fl) 
             {
     
                 $output .= ' <div class="rooms mt-3 d-flex align-items-center justify-content-between flex-wrap">
                                 <div class="ms-4 bed-text">
                                     <h4>Floor '.$fl['floor'].'</h4>
                                     <div class="users d-flex  align-items-center" style="flex-wrap:wrap">';

                     
                                    //  $admin_id = $this->session->userdata('admin_id');
                                    $u_id= $this->session->userdata('u_id');
                                    $where ='(u_id = "'.$u_id.'")';
                                    $admin_details = $this->FrontofficeModel->getData($tbl ='register', $where);
                                    
                                    $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                    $get_hotel_name = $this->FrontofficeModel->getData($tbl ='register', $wh);
                                    $admin_id = $admin_details['hotel_id'];

                                     $room_no = $this->FrontofficeModel->get_room_nos_floor_wise($admin_id,$fl['floor_id']);

                                     if($room_no)
                                     {
                                         foreach ($room_no as $rn) 
                                         {
                                             $wh = '(room_no = "'.$rn['room_no'].'" AND hotel_id = "'.$admin_id.'" AND DATE(updated_at) > "'.$date.'")';

                                             $room_status = $this->FrontofficeModel->getData('room_status',$wh);

                                             if($room_status)
                                             {
                                                 if($room_status['room_status'] == 1)//dirty
                                                 {
                                                     $b_color = "#ec1c24";
                                                 }
                                                 else
                                                 {
                                                     if($room_status['room_status'] == 2)//accupied
                                                     {
                                                         $b_color = "#d653c1";
                                                     }
                                                     else
                                                     {
                                                         if($room_status['room_status'] == 3)//available
                                                         {
                                                             $b_color = "#7cc142";
                                                         }
                                                         else
                                                         {
                                                             if($room_status['room_status'] == 4)//under maintaintance
                                                             {
                                                                 $b_color = "#7cc142";
                                                             }
                                                         }
                                                     }
                                                 }
                    
                 $output .=   '<div class="room_card card" style="background:'.$b_color.'">
               
                             <span class="room_no ">'.$room_status['room_no'].'</span>
                         </div>';
					// 	 <span title="2 orders" class="badge badge-success" style="
					// 	 left:40px; margin-top:-14px;position:absolute;  animation: 1s ease 0s normal none infinite running wobble;
					// 	 left: 40px;
					// 	 margin-top: -14px;
					// 	 position: absolute;
					// 	 animation: 1s ease 0s normal none infinite running wobble;
					// 	 background-color: #68e365;
					// 	 line-height: 1.5;
					// 	 border-radius: 1.03125rem;
					// 	 padding: 0.25rem 0.625rem;
					// 	 border: 0.0625rem solid transparent;
					// 	 display: inline-block;
					// 	 padding: 0.35em 0.65em;
					// 	 font-size: 0.75em;
					// 	 font-weight: 700;
					// 	 line-height: 1;
					// 	 color: #fff;
					// 	 text-align: center;
					// 	 white-space: nowrap;
					//   ">1
					//   </span>
                                 }
                             }
                         }
                 $output .=       
                     '</div>
                 </div>
            
        </div>';
     
             }
         }
     
         echo $output;
     }
	public function all_services()
	{
		// echo 'hi';die;
		$this->load->view('include/header');
		$this->load->view('frontoffice/all_services');
		$this->load->view('include/footer');
	}
	public function frontaArrival()
	{   
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
		$date = $this->input->post('check_in');

	//	$hotel_id = $this->session->userdata('u_id');
	
		if(!empty($date))
		{
			
		$digitalcheck_in['today_hotel_book_list_by_app'] = $this->FrontofficeModel->ser_check_list($date);
			
		$digitalcheck_in['list'] =$this->FrontofficeModel->get_user_pending_booking_list_from_app_pagination($admin_id);
		$digitalcheck_in['room_type_list'] = $this->FrontofficeModel->get_room_type_list($admin_id);
		
		// $digitalcheck_in['today_hotel_book_list_by_app'] = $this->FrontofficeModel->get_user_pending_booking_list_from_app($admin_id);
		$digitalcheck_in['walking_guest_for_sign'] = $this->FrontofficeModel->get_user_pending_booking_list_from_app($admin_id);
	
// print_r($digitalcheck_in['today_hotel_book_list_by_app']);die;
		
		
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewFrontaArrival', $digitalcheck_in);
		$this->load->view('include/footer');

		}
		else
		{
			
			$digitalcheck_in['list'] =$this->FrontofficeModel->get_user_pending_booking_list_from_app_pagination($admin_id);
			// print_r($digitalcheck_in['list']);exit;
			$digitalcheck_in['room_type_list'] = $this->FrontofficeModel->get_room_type_list($admin_id);
			
			$digitalcheck_in['today_hotel_book_list_by_app'] = $this->FrontofficeModel->get_user_pending_booking_list_from_app($admin_id);
			$digitalcheck_in['walking_guest_for_sign'] = $this->FrontofficeModel->get_user_pending_booking_list_from_app($admin_id);
			$this->load->view('include/header');
			$this->load->view('frontoffice/viewFrontaArrival', $digitalcheck_in);
			$this->load->view('include/footer');
		}

		// $digitalcheck_in['today_hotel_book_list_by_app'] = $this->FrontofficeModel->get_user_pending_booking_list_from_app($admin_id);
		
		
	}
	public function upcomingArrival()
	{	
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$hotel_id = $this->session->userdata('u_id');
		$digitalcheck_in['today_hotel_book_list_by_app'] = $this->FrontofficeModel->get_upcoming_list_from_app($hotel_id);
		// $this->load->view('include/header');
		$this->load->view('frontoffice/viewUpcomingArrival', $digitalcheck_in);
		// $this->load->view('include/footer');

	}
	public function frontDeparture()
	{ 
		
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
		$date = $this->input->post('check_out');
// print_r($date);exit;
		if(!empty($date))
		{
			
			$check_out["list"] = $this->FrontofficeModel->get_checkout_guest_list_date_wise_pagination($admin_id,$date);
				
			$this->load->view('include/header');
			$this->load->view('frontoffice/viewFrontDeparture',$check_out);
			$this->load->view('include/footer');

		}
		else{
			$check_out["list"] = $this->FrontofficeModel->get_checkout_guest_list_pagination($admin_id);
				
			$this->load->view('include/header');
			$this->load->view('frontoffice/viewFrontDeparture',$check_out);
			$this->load->view('include/footer');
		}
	}
	public function raiseDispute()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$this->load->view('include/header');
		$this->load->view('frontoffice/viewRaiseDispute',$admin_details);
		$this->load->view('include/footer');

	}
	public function businessCenterRequest()
	{ 
		// echo "hiii";
		// die;
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		// $digitalcheck_in['list'] =$this->FrontofficeModel->get_user_upcoming_booking_list_from_app_pagination($admin_id);
		$business_center_reservation['list'] = $this->FrontofficeModel->get_business_center_reservation_list_app($admin_id);  
		$business_center_reservation['business_center'] = $this->FrontofficeModel->get_active_business_center_app($admin_id);
		
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewBusinessCenterRequest', $business_center_reservation);
		$this->load->view('include/footer');

	}
	public function listOfAcceptedRequest()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$digitalcheck_in['list'] =$this->FrontofficeModel->get_user_upcoming_booking_list_from_app_pagination($admin_id);
		$digitalcheck_in["list"] = $this->FrontofficeModel->get_business_center_list_pagination($admin_id);
		$digitalcheck_in['business_center'] = $this->FrontofficeModel->get_active_business_center($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewListOfAcceptedRequest', $digitalcheck_in);
		$this->load->view('include/footer');
	}
	public function listOfRejectedRequest()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$business_center_reservation["list"] = $this->FrontofficeModel->get_business_center_list_reject_pagination($admin_id);

		$business_center_reservation['business_center'] = $this->FrontofficeModel->get_active_business_center($admin_id);

		// $digitalcheck_in['list'] =$this->FrontofficeModel->get_user_upcoming_booking_list_from_app_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewListOfRejectedRequest', $business_center_reservation);
		$this->load->view('include/footer');
	}
	public function ManageBusinessCenter()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$business_data['list'] = $this->FrontofficeModel->get_center($admin_id);
		$business_data['data'] = $this->FrontofficeModel->get_buis_center_data($admin_id);          
		$business_data['facility_list'] = $this->FrontofficeModel->get_center_facility($admin_id);
		$business_data['center_pics'] = $this->FrontofficeModel->get_buis_center_photos($admin_id);
		// print_r($business_data['center_pics']);exit;

		$this->load->view('include/header');
		$this->load->view('frontoffice/viewManageBusinessCenter', $business_data);
		$this->load->view('include/footer');
	}
	public function enquiry()
	{ 	
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$enquiry_request["list"] = $this->FrontofficeModel->get_hotel_enquiry_request_pagination($admin_id);
	
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewEnquiry', $enquiry_request);
		$this->load->view('include/footer');
	}
	public function acceptedByUser()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$enquiry_request["list"] = $this->FrontofficeModel->get_hotel_enquiry_request_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewAcceptedByUser',$enquiry_request);
		$this->load->view('include/footer');
	}
	public function reject_enquiry_request()
	{
		
		$hotel_enquiry_request_id =  $this->uri->segment(3);
		// print_r($hotel_enquiry_request_id);exit;
		 // var_dump($hotel_enquiry_request_id);die;
	 //    $admin_id = $this->session->userdata('front_id');

		 $u_id= $this->session->userdata('u_id');
		 $where ='(u_id = "'.$u_id.'")';
		 $admin_details = $this->MainModel->getData($tbl ='register', $where);
		 
		 $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
		 $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
		 
			 $admin_id = $admin_details['hotel_id'];
			 $u_id1 = $admin_details['u_id'];



		$wh = '(hotel_enquiry_request_id = "'.$hotel_enquiry_request_id.'")';

		$arr = array(
					'request_status' => 2,
					'reject_date' => date('Y-m-d'),
					'request_reject_by' => 2,
					'request_reject_by_u_id' => $u_id1,
					);
					// print_r($arr);exit;

		$up = $this->FrontofficeModel->edit_data('hotel_enquiry_request',$wh,$arr);

		if($up)
		{
			$this->session->set_flashdata('msg','Request rejected');
			redirect(base_url('/enquiry'));
		}
		else
		{
			$this->session->set_flashdata('msg','Something went wrong');
			redirect(base_url('enquiry'));
		}
	}

	public function rejectedByUser()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
		$enquiry_request["list"] = $this->FrontofficeModel->get_enquiry_rejected_by_user($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewRejectedByUser', $enquiry_request);
		$this->load->view('include/footer');
	}
	public function roomStatus()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
		$room_status['floor_list'] = $this->FrontofficeModel->get_floor_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewRoomStatus',$room_status);
		$this->load->view('include/footer');
	}
	public function guests()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$guest_mng['list'] = $this->FrontofficeModel->get_guest_list($admin_id);
		$guest_mng['room_type'] = $this->FrontofficeModel->get_room_type_list1($admin_id);
		$guest_mng['availble_rooms'] = $this->FrontofficeModel->get_room_no_list($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewInHouseGuest',$guest_mng);
		$this->load->view('include/footer');
	}
	public function guest_history(){
		
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$postArray = $this->input->post();
		
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
		$booking_id=$postArray['booking_id'];
		$u_id1=$postArray['u_id1'];
		
		
		$guest_history['user_data'] = $this->FrontofficeModel->get_user_data($u_id);
		$guest_history['booking_details'] = $this->FrontofficeModel->get_user_booking_details($admin_id,$booking_id);
		$guest_history['booking_history'] = $this->FrontofficeModel->get_user_booking_history($admin_id,$u_id);
		$guest_history['room_number'] = $this->FrontofficeModel->get_booking_room_details($booking_id);

		
		$this->load->view('frontoffice/ajax_viewGuestsHistory',$guest_history);
	
	}
	public function viewRoomConfig(){
		
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$postArray = $this->input->post();
		// print_r($postArray);
		// exit;
		
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
		$room_type=$postArray['room_type'];
		// print_r($room_type);
		// exit;
		
		
		$view_room['room_type_data'] = $this->FrontofficeModel->get_room_type_data($admin_id);
		$view_room['list'] = $this->FrontofficeModel->get_room_related_data($admin_id,$room_type);
		$view_room['floor_list'] = $this->FrontofficeModel->get_floor_list($admin_id);
		// print_r($view_room['room_type_data']);
		// exit;

		
		$this->load->view('frontoffice/ajaxViewRoomConfig',$view_room);
	
	}
	
public function getnotification()
{
	// $wh = $this->input->post('id');
	// 	$data = $this->MainModel->getroomData($tbl ='room_type', $wh);
	// 	echo json_encode($data);
	$wh = $this->input->post('id');
		$data = $this->FrontofficeModel->getnotifications($tbl ='notifications', $wh);
		echo json_encode($data);
}
	public function visitors()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$add_visitors["list"] = $this->FrontofficeModel->get_visitor_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewVisitors',$add_visitors);
		$this->load->view('include/footer');
	}
	public function all_room_notification()
	{
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');
			
			$all_room_notification['list'] = $this->FrontofficeModel->get_notifications_for_rs_1($admin_id);
			$this->load->view('include/header');
			$this->load->view('frontoffice/viewNotification',$all_room_notification);
			$this->load->view('include/footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function housekeeping_notification()
	{
      	if($this->session->userdata('u_id'))
		{
          	$admin_id = $this->session->userdata('u_id');
	  		$h_notification['list'] = $this->FrontofficeModel->get_notifications_for_housekeeping_1($admin_id);
			  $this->load->view('include/header');
			$this->load->view('frontoffice/viewNotification',$h_notification);
			$this->load->view('include/footer');
        }
		else
		{
			redirect(base_url());
		}
	}
	public function notification()
	{ 
		
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		// $send_department['list'] = $this->FrontofficeModel->get_admin_sent_user_notifications($admin_id);
		$send_department['user_list'] = $this->FrontofficeModel->get_user_list_by_hotels($admin_id);
		$send_department['guest_list'] = $this->FrontofficeModel->get_guest_list_by_hotels($admin_id);
		$send_department['list'] = $this->FrontofficeModel->get_admin_sent_user_notifications($admin_id);

		$this->load->view('include/header');
		
		$this->load->view('frontoffice/viewNotification',$send_department);
		
		$this->load->view('include/footer');
	}
	public function restaurant_notification()
	{
		$this->load->view('include/header');
		$this->load->view('frontoffice/restaurant_notification');
		$this->load->view('include/footer');
	}
	public function serviceRequest()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$service_request['list'] = $this->FrontofficeModel->get_service_request($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewServiceRequest',$service_request);
		$this->load->view('include/footer');
	}

	public function serviceBooking()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewServiceBooking');
		$this->load->view('include/footer');
	}
	public function ajaxSubIconBlockView()
		{
			
			$postArr = $this->input->post();
			$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
			$guest_mng['icon_id'] = $postArr['data_id'];
			$guest_mng['sub_section_icon_id'] = $postArr['sub_section_id'];
			//$admin_id = $get_hotel_id['u_id']; 
			$guest_mng['sub_icon_id'] = $postArr['sub_section_id'];
			if($postArr['data_id'] == "10"){
				if($postArr['sub_section_id'] == "1"){
					$service_name = 1;
					$guest_mng["list"] = $this->FrontofficeModel->get_front_ofs_services_pagination($admin_id,$service_name);
				}else if($postArr['sub_section_id'] == "2"){
					$service_name = 2;
					$guest_mng["list"] = $this->FrontofficeModel->get_front_ofs_services_pagination($admin_id,$service_name);
				}else if($postArr['sub_section_id'] == "3"){
					$service_name = 3;
					$guest_mng["list"] = $this->FrontofficeModel->get_front_ofs_services_pagination($admin_id,$service_name);
				}else if($postArr['sub_section_id'] == "4"){
					$service_name = 4;
					$guest_mng["list"] = $this->FrontofficeModel->get_front_ofs_services_pagination($admin_id,$service_name);
					$service_name = 4;
					$guest_mng["list"] = $this->FrontofficeModel->get_front_ofs_services_pagination($admin_id,$service_name);
                    $day1 = "Sunday";
			$day2 = "Monday";
			$day3 = "Tuesday";
			$day4 = "Wednesday";
			$day5 = "Thursday";
			$day6 = "Friday";
			$day7 = "Saturday";
            $service_name = 4;
			$guest_mng["list"] = $this->FrontofficeModel->get_front_ofs_services_pagination($admin_id,$service_name);
			
			$guest_mng['sun_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day1);

			$guest_mng['mon_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day2);

			$guest_mng['tue_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day3);

			$guest_mng['wed_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day4);

			$guest_mng['thurs_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day5);

			$guest_mng['fri_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day6);

			$guest_mng['sat_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day7);
				}else if($postArr['sub_section_id'] == "5"){
					$service_name = 5;
					$guest_mng["list"] = $this->FrontofficeModel->get_front_ofs_services_pagination($admin_id,$service_name);
				}else if($postArr['sub_section_id'] == "6"){
				
					$guest_mng["vehicle_wash_request"] = $this->FrontofficeModel->get_vehicle_wash_request_list_pagination($admin_id);
				}else if($postArr['sub_section_id'] == "7"){
				
					$guest_mng["luggage_request"] = $this->FrontofficeModel->get_luggage_request_list_pagination($admin_id);
					// print_r($guest_mng["luggage_request"]);exit;
				}else if($postArr['sub_section_id'] == "8"){
					$guest_mng["list"] = $this->FrontofficeModel->get_cab_service_pagination($admin_id);
				}
			}
			$this->load->view('frontoffice/ajaxFrontSubIconBlockView', $guest_mng);
		}
		public function add_shuttle_service_staff_avaibility()
        {
            
            $day = $this->input->post('day');
            $front_ofs_service_id = $this->input->post('front_ofs_service_id');
            $start_time = $this->input->post('start_time');
            $end_time = $this->input->post('end_time');
            
            $u_id = $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			$admin_id = $admin_details['hotel_id'];

            $arr = array(
                            'hotel_id' => $admin_id,
                            'day' => $day,
                            'front_ofs_service_id' => $front_ofs_service_id,
                            'start_time' => $start_time,
                            'end_time' => $end_time,
                            'available_status' => 1,
                        );

            $add = $this->FrontofficeModel->insert_data('shuttle_service_avaibility',$arr);

            if($add)
            {
                $this->session->set_flashdata('msg','Data Added Successfully');
                redirect(base_url('facilityUpdate'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('facilityUpdate'));
            }
        }
		public function ajaxIconBlockView()
		{
			$postArr = $this->input->post();
			$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
			$guest_mng['icon_id'] = $postArr['data_id'];
			$guest_mng['sub_section_icon_id'] = $postArr['sub_section_id'];
			//$admin_id = $get_hotel_id['u_id']; 
			if($postArr['data_id'] == 1){
				$guest_mng["list"] = $this->FrontofficeModel->get_hotel_enquiry_request_pagination($admin_id);
			}else if($postArr['data_id'] == 2){
				$guest_mng["floor_list"] = $this->FrontofficeModel->get_floor_list_pagination($admin_id);
			}else if($postArr['data_id'] == 4){
				$guest_mng["list"] = $this->FrontofficeModel->get_floor_list_pagination($admin_id);
			}else if($postArr['data_id'] == 5){
				$guest_mng["list"] = $this->FrontofficeModel->get_room_type_list_pagination($admin_id);
			}else if($postArr['data_id'] == 7){
				$guest_mng["list"] = $this->FrontofficeModel->get_business_center_pagination($admin_id);
			}else if($postArr['data_id'] == 8){
				$guest_mng["list"] = $this->FrontofficeModel->get_business_center_list_pagination($admin_id);
			}else if($postArr['data_id'] == 9){
				
				
				 $guest_mng["list"] = [];
			}else if($postArr['data_id'] == 10){
			
				if($guest_mng['sub_section_icon_id'] == 1){
					$service_name = 1;
					$guest_mng["list"] = $this->FrontofficeModel->get_front_ofs_services_pagination($admin_id,$service_name);
				}
			
				
				// $guest_mng["list"] = [];
			}else if($postArr['data_id'] == 11){
				$guest_mng["list"] = $this->FrontofficeModel->get_lost_found_pagination($admin_id);
			}else if($postArr['data_id'] == 12){
				$guest_mng["list"] = $this->FrontofficeModel->get_user_expense_pagination($admin_id);
			}else if($postArr['data_id'] == 13){
				$guest_mng["list"] = $this->FrontofficeModel->get_visitor_pagination($admin_id);
			}else if($postArr['data_id'] == 15){
				$guest_mng["list"] = $this->FrontofficeModel->get_visitor_pagination($admin_id);
			}
			$this->load->view('frontoffice/ajaxFrontIconBlockView', $guest_mng);	
		
		}


	public function feedback()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$feedbacks["list"] = $this->FrontofficeModel->get_feedback_list_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewFeedback',$feedbacks);
		$this->load->view('include/footer');
	}
	public function handover()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$data['pending_handover']= $this->FrontofficeModel->get_manager_handover_list_pagination_1($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewHandover',$data);
		$this->load->view('include/footer');
	}
	public function completedHandover()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
		$is_complete2 = 1;

		$data['completed_handover']= $this->FrontofficeModel->get_manager_handover_completed_list_pagination($admin_id,$is_complete2);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewCompletedHandover',$data);
		$this->load->view('include/footer');
	}
	public function lost()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
		

		$lost_found["list"] = $this->FrontofficeModel->get_lost_found_pagination($admin_id);
		// print_r($lost_found['list']);die;
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewLost',$lost_found);
		$this->load->view('include/footer');
	}
	public function expense()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$accounts["list"] = $this->FrontofficeModel->get_user_expense_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewExpense',$accounts);
		$this->load->view('include/footer');
	
	}
	public function facilityUpdate()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewFacilityUpdate');
		$this->load->view('include/footer');
	
	}
	public function nightAudit()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewNightAudit');
		$this->load->view('include/footer');
	
	}
	
	
	public function hotelGuide()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$hotelGuide["content"] = $this->FrontofficeModel->get_hotel_guidelines($admin_id);
		//echo '<pre>';print_r($hotelGuide["content"]);exit;
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewHotelGuide',$hotelGuide);
		$this->load->view('include/footer');
	
	}

	public function addFloor()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$add_floor["floor_data"] = $this->FrontofficeModel->get_floor_list_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewAddFloor',$add_floor);
		$this->load->view('include/footer');
	
	}
	public function addRoomType()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$add_room_type["room_type_list"] = $this->FrontofficeModel->get_room_type_list_pagination($admin_id);
		
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewAddRoomType',$add_room_type);
		$this->load->view('include/footer');
	
	}
	public function roomConfig()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		//$front_dashboard['floor_list'] = $this->FrontofficeModel->get_floor_list($admin_id);
		$room_configure['room_type'] = $this->FrontofficeModel->get_room_typee_list($admin_id);
		$room_configure['floor_list'] = $this->FrontofficeModel->get_floor_list($admin_id);

		
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewRoomConfig',$room_configure);
		$this->load->view('include/footer');
	
	}
	public function agents()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$add_visitors["agents_list"] = $this->FrontofficeModel->get_agents_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('frontoffice/viewAgents',$add_visitors);
		$this->load->view('include/footer');
	
	}


	// jquery purpose

	
	
	
	public function get_room_nos()
	{
		$room_type = $this->input->post('room_type');
		
		// $admin_id = $this->session->userdata('admin_id');
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$u_id11 = $admin_details['hotel_id'];

		$room_no_data = $this->FrontofficeModel->get_room_nos($admin_id,$room_type);

		$output = '';

		foreach($room_no_data as $r_n)
		{
			$available_rm = $this->FrontofficeModel->get_available_room_no($admin_id,$r_n['room_no']);

			if($available_rm)
			{
				$output .= '<div class="room_card card  p-0" 
								data-bs-target=".add" class="green">
								<input name="room_no" class="radio" type="radio"
									value="'.$r_n['room_no'].'">
								<span
									class="room_no m-0 room_card  red colored-div">'.$r_n['room_no'].'</span>
							</div>';
			}
		}

		echo $output;
	}
	
	public function get_room_nos1()
	{
		$room_type = $this->input->post('room_type');
		
		// $admin_id = $this->session->userdata('admin_id');
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
		$u_id11 = $admin_details['hotel_id'];

		$room_no_data = $this->FrontofficeModel->get_room_nos($admin_id,$room_type);

		$output = '';

		// $i = 1;

		foreach($room_no_data as $r_n)
		{
			$available_rm = $this->FrontofficeModel->get_available_room_no($admin_id,$r_n['room_no']);

			if($available_rm)
			{
				$output .= '<div class="room_card card  p-0" data-bs-toggle="modal"
							data-bs-target=".add" class="green">
							<input name="room_no1[]" class="radio" type="radio"
								value="'.$r_n['room_no'].'">
							<span
								class="room_no m-0 room_card  red colored-div">'.$r_n['room_no'].'</span>
						</div>';
			}
		}

		echo $output;
	}
	public function get_room_charge()
	{
		$room_type = $this->input->post('srvice_type');
		$where = '(room_type = "'.$room_type.'")';
		$room_charge = $this->FrontofficeModel->getData('room_configure', $where);
		$output = '';
		$output .= $room_charge['price'];

		echo $output;
	}
	public function get_room_charge1()
	{
		$room_type = $this->input->post('srvice_type');

		$where = '(room_type = "'.$room_type.'")';
		$room_charge = $this->FrontofficeModel->getData('room_configure', $where);

		$output = '';

		$output .= $room_charge['price'];

		echo $output;
	}
	

	public function add_walking()
	{
		$full_name = $this->input->post('full_name');
             $mobile_no = $this->input->post('mobile_no');
             $check_in = $this->input->post('check_in');
             $check_in_time = $this->input->post('check_in_time');
             $check_out = $this->input->post('check_out');
             $check_out_time = $this->input->post('check_out_time');
             $total_adults = $this->input->post('total_adults');
              $guest_type = $this->input->post('guest_type');

             $total_child = $this->input->post('total_child');
             $no_of_guests = $this->input->post('no_of_guests');
            
            $u_id= $this->session->userdata('u_id');
            $where ='(u_id = "'.$u_id.'")';
            $admin_details = $this->MainModel->getData($tbl ='register', $where);
			

            $admin_id = $admin_details['hotel_id'];

            $u_id11 = $admin_details['u_id'];
			
             $wh = '(mobile_no = "'.$mobile_no.'")';
 
             $user_data = $this->MainModel->getData('register',$wh);
			 
             $add_user = "";
             $up_user = "";
 
             //id proff images
             $_FILES['my_file']['name'] = $_FILES['id_proff_img']['name'];
             $_FILES['my_file']['type'] = $_FILES['id_proff_img']['type'];
             $_FILES['my_file']['tmp_name'] = $_FILES['id_proff_img']['tmp_name'];
             $_FILES['my_file']['size'] = $_FILES['id_proff_img']['size'];
             $_FILES['my_file']['error'] = $_FILES['id_proff_img']['error'];
 
             $path = 'logo/check_in/';
             $file_path = './'.$path;
             $config['allowed_types'] = '*';
             $config['encrypt_name'] = TRUE;
             $config['upload_path'] = $file_path;
             $this->load->library('upload',$config);
             $this->upload->initialize($config);
 
             if($this->upload->do_upload('my_file'))
             {
                 $file_data = $this->upload->data();
 
                 $id_proff_img = base_url().$path.$file_data['file_name'];
				
             }
             else
             {
                 $this->session->set_flashdata('msg','Error to upload images');
                 redirect(base_url('check_in'));
             }
                             
             if($user_data)
             {
                 $arr_up = array(
                                 'full_name' => $full_name,
                                 'mobile_no' => $mobile_no,
                                 'guest_type' => $guest_type,
                             );
                
                 $up_user = $this->FrontofficeModel->edit_data('register',$wh,$arr_up);
 
                 $u_id = $user_data['u_id'];
             }
             else
             {
                 $arr_add = array(
                                 'hotel_id' => $admin_id,
                                 'full_name' => $full_name,
                                 'mobile_no' => $mobile_no,
                                 'password' => md5($mobile_no),
                                 'password_text' => $mobile_no,
                                 'Id_proff_photo' => $id_proff_img,
                                 'register_date' => date('Y-m-d'),
                                 'guest_type' => $guest_type,
                                 'is_active' => 1
                                 );
 
                 $add_user = $this->FrontofficeModel->insert_data('register',$arr_add);
 
                 $u_id = $add_user;
             }
 
             if($add_user || $up_user)
             {
                 $arr_add = array(
                                 'hotel_id' => $admin_id,
                                 'u_id' => $u_id,
                                 'id_proff_img' => $id_proff_img,
                                 'no_of_guests' => $no_of_guests,
                                 'total_adults' => $total_adults,
                                 'total_child' => $total_child,
                                 'booking_date' => date('Y-m-d'),
                                 'check_in' => $check_in,
                                 'check_in_time' => $check_in_time,
                                 'check_out' => $check_out,
                                 'check_out_time' => $check_out_time,
                                 'booking_status' => 1,
                                 'booking_from' => 1,
                                 );
								
                 $add_booking = $this->FrontofficeModel->insert_data('user_hotel_booking',$arr_add);
 
                 if($add_booking)
                 {
                     //added as a guest
                     $arr_add_ug = array(
                                     'hotel_id' => $admin_id,
                                     'u_id' => $u_id,
                                     'booking_id' => $add_booking,
                                     'login_id' => $mobile_no,
                                     'dnd_mode' => 2,
                                     'is_guest' => 1,
                                     );
									        
 
                     $this->FrontofficeModel->insert_data('guest_user',$arr_add_ug);
                    
                     //add room no type price
                     $no_of_rooms = $this->input->post('no_of_rooms');
                     $room_type = $this->input->post('room_type');
                     $room_no = $this->input->post('room_no');
 
                     $rm_data = $this->FrontofficeModel->get_room_nos_data($admin_id,$room_type,$room_no);
					
                     $arr_add_details = array(
                                             'booking_id' => $add_booking,
                                             'room_no' => $room_no,
                                             'price' => $rm_data['price'],
                                             'no_of_rooms' => $no_of_rooms,
                                             'room_type' => $room_type,
                                             );
                                            
                     $add_details = $this->FrontofficeModel->insert_data('user_hotel_booking_details',$arr_add_details);
					 
                     if($add_details)
                     {
                        
                        $wh_r1 = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$room_no.'")';

                        $arr_rm_up1 = array(
                                            'room_status' => 2,
                                        );
                                    
                       $s= $this->FrontofficeModel->edit_data('room_status',$wh_r1,$arr_rm_up1);
					  
                         $wh_detail = '(booking_id = "'.$add_booking.'")';
 
                         $booking_data = $this->MainModel->getData('user_hotel_booking',$wh_detail);
						
                         $arr_up = array(
                                             'total_charges' => $booking_data['total_charges'] + $rm_data['price'],
                                             'no_of_rooms' => $booking_data['no_of_rooms'] + $no_of_rooms,
                                         );
             
                         $this->FrontofficeModel->edit_data('user_hotel_booking',$wh_detail,$arr_up);
 
                     }
                  
                      
                     $no_of_rooms1 = $this->input->post('no_of_rooms1');
                     $room_type1 = $this->input->post('room_type1');
                     $room_no1 = $this->input->post('room_no1');
					
                     if(isset($_POST['room_type1']))
                     {
                         $count = count($room_type1);
 
                         for($i = 0 ;$i < $count; $i++)
                         {
                             $rm_data1 = $this->FrontofficeModel->get_room_nos_data($admin_id,$room_type1[$i],$room_no1[$i]);
                     
                             $arr_add_details1 = array(
                                                         'booking_id' => $add_booking,
                                                         'room_no' => $room_no1[$i],
                                                         'price' => $rm_data1['price'],
                                                         'no_of_rooms' => $no_of_rooms1[$i],
                                                         'room_type' => $room_type1[$i],
                                                     );
 
                             $add_details1 = $this->FrontofficeModel->insert_data('user_hotel_booking_details',$arr_add_details1);
                             if($add_details1)
                             {
                                 $wh_detail1 = '(booking_id = "'.$add_booking.'")';
         
                                 $booking_data1 = $this->MainModel->getData('user_hotel_booking',$wh_detail1);
         
                                 $arr_up1 = array(
                                                     'total_charges' => $booking_data1['total_charges'] + $rm_data1['price'],
                                                     'no_of_rooms' => $booking_data1['no_of_rooms'] + $no_of_rooms1[$i],
                                                    );
                     
                                 $this->FrontofficeModel->edit_data('user_hotel_booking',$wh_detail1,$arr_up1);

                                 $wh_rn_status1 = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$room_no1[$i].'")';

                                 $arr_rn_status1 = array(
                                                             'room_status' => 2
                                                         );
 
                                 $this->FrontofficeModel->edit_data('room_status',$wh_rn_status1,$arr_rn_status1);
         
                             }
                         }
                     }
 
					 $u_id = $this->session->userdata('u_id');
					 $where ='(u_id = "'.$u_id.'")';
					 $admin_details = $this->MainModel->getData($tbl ='register', $where);
					 $admin_id = $admin_details['hotel_id'];
			 
					 $digitalcheck_in['list'] =$this->FrontofficeModel->get_user_pending_booking_list_from_app_pagination($admin_id);
					 $digitalcheck_in['room_type_list'] = $this->FrontofficeModel->get_room_type_list($admin_id);
					 $digitalcheck_in['today_hotel_book_list_by_app'] = $this->FrontofficeModel->get_user_pending_booking_list_from_app($admin_id);
					 $digitalcheck_in['walking_guest_for_sign'] = $this->FrontofficeModel->get_user_pending_booking_list_from_app($admin_id);
			 
					//  $this->load->view('include/header');
					 $this->load->view('frontoffice/ajaxviewFrontaArrival', $digitalcheck_in);
					//  $this->load->view('include/footer');
                 }
                 else
                 {
                     $this->session->set_flashdata('msg','Something went wrong');
                     redirect(base_url('check_in'));
                 }
             }
	}
	public function Add_hotel_guide()
	{
		// $content = $this->input->post('content');
		// echo $content;
		// exit;
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
		
	
		
		$u_id11 = $admin_details['u_id'];

		$content = $this->input->post('content');
		// echo $content;
		// exit;
		$wh = '(hotel_id = "'.$admin_id.'")';

		$hotel_guidelines_data = $this->FrontofficeModel->getData('hotel_guidelines',$wh);

		$up = "";
		$add = "";

		if($hotel_guidelines_data)
		{
			$arr_up = array(
						'content' => $content,
						);

			$up = $this->FrontofficeModel->edit_data('hotel_guidelines',$wh,$arr_up);
		}
		else
		{
			$arr_add =  array(
						  'hotel_id' => $admin_id,
						  'content' => $content,
						  'added_by' => 1,
						  'added_by_u_id' => $u_id11,
						);

			$add = $this->FrontofficeModel->insert_data('hotel_guidelines',$arr_add);
		}
		
		if($add || $up)
		{
			echo "success";exit;
		}
		
		}
		public function add_guest_count()
        {
            $adult = $this->input->post('adult');

            $child = $this->input->post('child');

			
            // $wh = '(r_s_min_bar_id = "'.$minibar.'")';

            // $room_servs_mini_bar =  $this->MainModel->getData('room_servs_mini_bar',$wh);

            $output = '';

            $output .=  $adult + $child;
            // print_r($output);exit;
            echo $output;
        }

		public function add_floor()
		{
			$u_id = $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			$admin_id = $admin_details['hotel_id'];
		
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
			$admin_id = $admin_details['hotel_id'];
			$u_id11 = $admin_details['u_id'];

			$floor = $this->input->post('floor');

			$wh = '(hotel_id = "'.$admin_id.'" AND floor = "'.$floor.'")';

			$floor_data = $this->MainModel->getData('floors',$wh);

			if($floor_data)
			{
				$this->session->set_flashdata('msg','Floor already exits..');
				redirect(base_url('add_floor'));
			}
			else
			{
				$arr =  array(
							'hotel_id' => $admin_id,
							'floor' => $floor,
							'added_by' => 2,
							'added_by_u_id' => $u_id11,
							);
							// print_r($arr);exit;
				$add = $this->FrontofficeModel->insert_data('floors',$arr);

				if($add)
				{
					$u_id = $this->session->userdata('u_id');
					$where ='(u_id = "'.$u_id.'")';
					$admin_details = $this->MainModel->getData($tbl ='register', $where);
					$admin_id = $admin_details['hotel_id'];

					$add_floor["floor_data"] = $this->FrontofficeModel->get_floor_list_pagination($admin_id);
					// $this->load->view('include/header');
					$this->session->set_flashdata('msg','Floor added Successfully..');
					$this->load->view('frontoffice/ajaxviewAddFloor',$add_floor);
					// $this->load->view('include/footer');
					
				}
				else
				{
					$this->session->set_flashdata('msg','Something went wrong');
					redirect(base_url('add_floor'));
				}
			}
		}
		public function prevent_double_entry()
		{
			$u_id = $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			$admin_id = $admin_details['hotel_id'];
			
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			$get_hotel_name = $this->FrontofficeModel->getData($tbl ='register', $wh);
			$admin_id = $admin_details['hotel_id'];
			$u_id11 = $admin_details['u_id'];

			$floor = $this->input->post('floor');

			$wh = '(hotel_id = "'.$admin_id.'" AND floor = "'.$floor.'")';

			$floor_data = $this->FrontofficeModel->getData('floors',$wh);

			if($floor_data)
			{
				echo "1";
			}
		}
		// public function edit_floor()
		// {
		// 	$u_id = $this->session->userdata('u_id');
		// 	$where ='(u_id = "'.$u_id.'")';
		// 	$admin_details = $this->MainModel->getData($tbl ='register', $where);
		// 	$admin_id = $admin_details['hotel_id'];
			
		// 	$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
		// 	$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
		// 	$admin_id = $admin_details['hotel_id'];
		// 	$u_id11 = $admin_details['u_id'];

		// 	$floor_id = $this->input->post('floor_id');

		// 	$floor = $this->input->post('floor');

		// 	$wh = '(floor_id = "'.$floor_id.'")';

		// 	$wh1 = '(hotel_id = "'.$admin_id.'" AND floor = "'.$floor.'")';

		// 	$floor_data = $this->MainModel->getData('floors',$wh1);

		// 	if($floor_data)
		// 	{
		// 		$this->session->set_flashdata('msg','Floor already exits..');
		// 		//redirect(base_url('add_floor'));
		// 	}
		// 	else
		// 	{
		// 		$arr =  array(
		// 						'floor' => $floor,
		// 					);

		// 		$add = $this->MainModel->edit_data('floors',$wh,$arr);

		// 		if($add)
		// 		{
		// 			$this->session->set_flashdata('msg','Floor updated Successfully..');
		// 			//redirect(base_url('add_floor'));
		// 		}
		// 		else
		// 		{
		// 			$this->session->set_flashdata('msg','Something went wrong');
		// 			//redirect(base_url('add_floor'));
		// 		}
		// 	}
		// }
		public function delete_floor()
        {
            $id=$this->input->post('id');

            $where = '(floor_id = "'.$id.'")';
            $result= $this->FrontofficeModel->delete_data($tbl="floors", $where);

            if ($result) {
                echo "1";
            } else {
                echo "0";
            }
        }
		public function delete_room_type()
        {
            $room_type_id = $this->input->post('id');
            
            $wh = '(room_type_id = "'.$room_type_id.'")';

            $del = $this->FrontofficeModel->delete_data('room_type',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
		public function business_center_request()
		{
			$client_name = $this->input->post('client_name');
			$client_mobile_no = $this->input->post('client_mobile_no');
			$business_center_type = $this->input->post('business_center_type');
			$event_name = $this->input->post('event_name');
			$event_date = $this->input->post('event_date');
			$start_time = $this->input->post('start_time');
			$end_time = $this->input->post('end_time');
			$description = $this->input->post('additional_note');

			// $admin_id = $this->session->userdata('front_id');
			$u_id= $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
			$admin_id = $admin_details['hotel_id'];
			$u_id11 = $admin_details['u_id'];

			$wh = '(hotel_id = "'.$admin_id.'" AND business_center_type = "'.$business_center_type.'" AND event_date = "'.$event_date.'" AND start_time >= "'.$start_time.'"AND end_time <= "'.$end_time.'")';

			$business_center_reser_data = $this->MainModel->getData('business_center_reservation',$wh);

			if($business_center_reser_data)
			{
				$this->session->set_flashdata('msg','Already Reserve this center of selected date');
				redirect(base_url('business_new'));
			}
			else
			{
				$_FILES['my_file']['name'] = $_FILES['id_proof_photo']['name'];
				$_FILES['my_file']['type'] = $_FILES['id_proof_photo']['type'];
				$_FILES['my_file']['tmp_name'] = $_FILES['id_proof_photo']['tmp_name'];
				$_FILES['my_file']['size'] = $_FILES['id_proof_photo']['size'];
				$_FILES['my_file']['error'] = $_FILES['id_proof_photo']['error'];

				$path = 'logo/business/';
				$file_path = './'.$path;
				$config['allowed_types'] = '*';
				$config['encrypt_name'] = TRUE;
				$config['upload_path'] = $file_path;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('my_file'))
				{
					
					$file_data = $this->upload->data();

					$id_proof_photo = base_url().$path.$file_data['file_name'];
				}
				else
				{
					$this->session->set_flashdata('msg','Image Error to upload');
					redirect(base_url('business_new'));
				}
				
				$arr = array(
							'u_id' => $u_id11,
							'hotel_id' => $admin_id,
							'client_name' => $client_name,
							'client_mobile_no' => $client_mobile_no,
							'business_center_type' => $business_center_type,
							'event_date' => $event_date,
							'event_name' => $event_name,
							'start_time' => $start_time,
							'end_time' => $end_time,
							'id_proof_photo' => $id_proof_photo,
							'request_status'=>0,
							 'additional_note' => $description,
							 'added_by' => 2,
							'added_by_u_id' => $u_id11,
							);
								
				$add = $this->FrontofficeModel->insert_data('business_center_reservation',$arr);
				// print_r($add);exit;		

				if($add)
				{
					$u_id = $this->session->userdata('u_id');
					$where ='(u_id = "'.$u_id.'")';
					$admin_details = $this->MainModel->getData($tbl ='register', $where);
					$admin_id = $admin_details['hotel_id'];

					// $digitalcheck_in['list'] =$this->FrontofficeModel->get_user_upcoming_booking_list_from_app_pagination($admin_id);
					$business_center_reservation['list'] = $this->FrontofficeModel->get_business_center_reservation_list_app($admin_id);  
					$business_center_reservation['business_center'] = $this->FrontofficeModel->get_active_business_center_app($admin_id);
				
					$this->load->view('frontoffice/ajaxviewBusinessCenterRequest', $business_center_reservation);
	
				}
				else
				{
					$this->session->set_flashdata('msg','Image Error to upload');
					redirect(base_url('business_reser'));
				}
			}
		}
		public function change_user_status()
		{
			$arr=array(
						'request_status'=>$_POST['request_status']
					
						);
			
			$u_id  = $_POST['b_c_reserve_id'];
		   //    var_dump($u_id );die;
			$where = '(b_c_reserve_id ="' . $u_id . '")';
			$id = $this->MainModel->edit_data($tbl="business_center_reservation",$where,$arr); 
			if($id)
			{
				echo json_encode(TRUE);
			}else{
				echo json_encode(FALSE);
			}	
		}
		public function add_business_center()
		{
		   $u_id= $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			
		   //  $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
		   //  $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
			$admin_id = $admin_details['hotel_id'];
			$u_id = $admin_details['u_id'];
			$business_center_type = $this->input->post('business_center_type');
			$no_of_people = $this->input->post('no_of_people');
			$price = $this->input->post('price');
			$description = $this->input->post('description');
			$facility_name = $this->input->post('facility_name');
		   //  $admin_id = $this->session->userdata('admin_id');

			$arr = array(
							'hotel_id' => $admin_id,
							'business_center_type' => $business_center_type,
							'no_of_people' => $no_of_people,
							'price' => $price,
							'description' => $description,
							'is_active' => 1,
							'added_by' => 2,
							'added_by_u_id' => $u_id,
						);
						
			$add = $this->FrontofficeModel->insert_data('business_center',$arr);

			if($add)
			{
				// add multiple images
				$count_img = count($_FILES['image']['name'],TRUE);
				for($i = 0;$i < $count_img; $i++)
				{
					if(!empty($_FILES['image']['name'][$i]))
					{

						$_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
						$_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
						$_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
						$_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
						$_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];
	
						$path = 'logo/manage_add/';
						$file_path = './'.$path;
						$config['allowed_types'] = '*';
						$config['encrypt_name'] = TRUE;
						$config['upload_path'] = $file_path;
						$this->load->library('upload',$config);
						$this->upload->initialize($config);

						if($this->upload->do_upload('my_uploaded_file'))
						{
							$file_data = $this->upload->data();
	
							$images = base_url().$path.$file_data['file_name'];
							
							$arr1 = array(
										'hotel_id' => $admin_id,
										'business_center_id' => $add,
										'image' => $images
										);

							$this->FrontofficeModel->insert_data('business_center_images',$arr1);
						}        
					}
				}

				//add multiple facility 
				for($j = 0;$j < count($facility_name); $j++)
				{
					$arr_fc = array(
									'hotel_id' => $admin_id,
									'business_center_id' => $add,
									'facility_name' => $facility_name[$j]
								);

					$this->FrontofficeModel->insert_data('business_center_facility',$arr_fc);
				}   
				$u_id = $this->session->userdata('u_id');
				$where ='(u_id = "'.$u_id.'")';
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
				$admin_id = $admin_details['hotel_id'];

				$business_data['list'] = $this->FrontofficeModel->get_center($admin_id);
				$business_data['data'] = $this->FrontofficeModel->get_buis_center_data($admin_id);          
				$business_data['facility_list'] = $this->FrontofficeModel->get_center_facility($admin_id);
				$business_data['center_pics'] = $this->FrontofficeModel->get_buis_center_photos($admin_id);

				$this->load->view('frontoffice/ajaxviewManageBusinessCenter', $business_data);
			
			}
			else
			{
				$this->session->set_flashdata('msg','Something went wrong');
				redirect(base_url('ManageBusinessCenter'));
			}
		}
	 public function sent_notification_to_customers()
        {
            $send_to11 = $this->input->post('send_to');
			
            $users = $this->input->post('users');
            // print_r($send_to);die;
            $notification_type = $this->input->post('notification_type');
            $title = $this->input->post('title');
            $description = $this->input->post('description');

            // $admin_id = $this->session->userdata('front_id');
            $u_id= $this->session->userdata('u_id');
            $where ='(u_id = "'.$u_id.'")';
            $admin_details = $this->MainModel->getData($tbl ='register', $where);
            
            $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
            $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
            $admin_id = $admin_details['hotel_id'];
            $u_id11 = $admin_details['u_id'];
            
            if($send_to11 == "cust")
                {
                    $send_to1 = 3;
                }
            elseif($send_to11 == "spe_cust")
                {
                    $send_to1 = 4;
                }
                elseif($send_to11 == "guest")
                {
                    $send_to1 = 8;
                }
                elseif($send_to11 == "spe_guest")
                {
                    $send_to1 = 9;
                }
                else
                {
                    $send_to1 = 0;
                }

            if($send_to11 == "cust")
            {
                $send_for = 1;
            }
            elseif($send_to11 == "guest")
            {
                $send_for = 1;
            }
            else
            {
                $send_for = 2;
            }

            $arr = array(
                        'send_to' => $send_for,
                        'send_for' => $send_to1,
                        'notification_type' => $notification_type,
                        'title' => $title,
                        'description' => $description,
                        'send_by' => 3,
                        'send_by_id' => $u_id11,
                    );
					
            $add = $this->FrontofficeModel->insert_data('notifications',$arr);
			
            if($add)
            {

                if($send_to1 =="3" )
                                {
                                    $id = $this->session->userdata('u_id');
                                    $wh_admin = '(u_id ="'.$id.'")';
                                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                    $hotel_id = $get_hotel_id['hotel_id'];
                                    
                                    $all_users = $this->FrontofficeModel->get_customers( $hotel_id);
                                    foreach($all_users as $a)
                                    {
                                    $arr_send = array(
                                                        'user_id'         =>$a['u_id'],
                                                        'notification_id' =>$add,
                                                    
                                                    );
                                    $insert= $this->FrontofficeModel->insert_data($tbl='notifictions_u_id', $arr_send);
                                    }
									$u_id = $this->session->userdata('u_id');
				$where ='(u_id = "'.$u_id.'")';
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
				$admin_id = $admin_details['hotel_id'];

				// $send_department['list'] = $this->FrontofficeModel->get_admin_sent_user_notifications($admin_id);
				$send_department['user_list'] = $this->FrontofficeModel->get_user_list_by_hotels($admin_id);
				$send_department['guest_list'] = $this->FrontofficeModel->get_guest_list_by_hotels($admin_id);
				$send_department['list'] = $this->FrontofficeModel->get_admin_sent_user_notifications($admin_id);
                                    $this->session->set_flashdata('msg', 'Notification Added Successfully..!');
									$this->load->view('frontoffice/ajaxviewNotification',$send_department);
                                }
                                elseif($send_to1 =="8" )
                                {
                                    $id = $this->session->userdata('u_id');
                                    $wh_admin = '(u_id ="'.$id.'")';
                                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                    $hotel_id = $get_hotel_id['hotel_id'];
                                  
                                    $all_users = $this->FrontofficeModel->get_gues($hotel_id);
                                    foreach($all_users as $a)
                                    {
                                    $arr_send = array(
                                                      'user_id'         =>$a['u_id'],
                                                      'notification_id' =>$add,
                                                   
                                                    );
                                   $insert= $this->FrontofficeModel->insert_data($tbl='notifictions_u_id', $arr_send);
                                    }
									$u_id = $this->session->userdata('u_id');
				$where ='(u_id = "'.$u_id.'")';
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
				$admin_id = $admin_details['hotel_id'];

				// $send_department['list'] = $this->FrontofficeModel->get_admin_sent_user_notifications($admin_id);
				$send_department['user_list'] = $this->FrontofficeModel->get_user_list_by_hotels($admin_id);
				$send_department['guest_list'] = $this->FrontofficeModel->get_guest_list_by_hotels($admin_id);
				$send_department['list'] = $this->FrontofficeModel->get_admin_sent_user_notifications($admin_id);
                                    $this->session->set_flashdata('msg', 'Notification Added Successfully..!');
                                    $this->load->view('frontoffice/ajaxviewNotification',$send_department);
                                }

                elseif($send_to1 == 4)
                {
                    $count = count($users);

                    for($i = 0;$i < $count;$i++)
                    {
                        $arr1 = array(
                                    'notification_id' => $add,
                                    'user_id' => $users[$i]
                                    );

                        $this->FrontofficeModel->insert_data('notifictions_u_id',$arr1);
                    }
					$u_id = $this->session->userdata('u_id');
				$where ='(u_id = "'.$u_id.'")';
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
				$admin_id = $admin_details['hotel_id'];

				// $send_department['list'] = $this->FrontofficeModel->get_admin_sent_user_notifications($admin_id);
				$send_department['user_list'] = $this->FrontofficeModel->get_user_list_by_hotels($admin_id);
				$send_department['guest_list'] = $this->FrontofficeModel->get_guest_list_by_hotels($admin_id);
				$send_department['list'] = $this->FrontofficeModel->get_admin_sent_user_notifications($admin_id);
					$this->session->set_flashdata('msg','Sent Notification to Users Successfully...');
					$this->load->view('frontoffice/ajaxviewNotification',$send_department);
                    
                    // redirect(base_url('notification'));
                }
                elseif($send_to1 == 9)
                {
                    $count = count($users);

                    for($i = 0;$i < $count;$i++)
                    {
                        $arr1 = array(
                                    'notification_id' => $add,
                                    'user_id' => $users[$i]
                                    );

                        $this->FrontofficeModel->insert_data('notifictions_u_id',$arr1);
                    }
                   
				$u_id = $this->session->userdata('u_id');
				$where ='(u_id = "'.$u_id.'")';
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
				$admin_id = $admin_details['hotel_id'];

				// $send_department['list'] = $this->FrontofficeModel->get_admin_sent_user_notifications($admin_id);
				$send_department['user_list'] = $this->FrontofficeModel->get_user_list_by_hotels($admin_id);
				$send_department['guest_list'] = $this->FrontofficeModel->get_guest_list_by_hotels($admin_id);
				$send_department['list'] = $this->FrontofficeModel->get_admin_sent_user_notifications($admin_id);

				// $this->load->view('include/header');
				
				$this->load->view('frontoffice/ajaxviewNotification',$send_department);
				
				// $this->load->view('include/footer');
                }
              

            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('notification'));
            }
        }
		public function add_service_request()
		{
			$room_no = $this->input->post('room_no');
			$guest_id = $this->input->post('user_n');
			$user_n = $this->input->post('user_name');
			$send_to111 = $this->input->post('send_to');
			$requirement = $this->input->post('requirement');
			
		   //  $admin_id = $this->session->userdata('front_id');
		   $u_id= $this->session->userdata('u_id');
		   $where ='(u_id = "'.$u_id.'")';
		   $admin_details = $this->MainModel->getData($tbl ='register', $where);
		  
		   $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
		   
		   $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
		  
		   $admin_id = $admin_details['hotel_id'];
		   $u_id11 = $admin_details['u_id'];
		 
			$user_data = $this->FrontofficeModel->get_user_data_by_username($user_n);
			
			if(!empty($user_data ))
			{
				$arr = array(
								'hotel_id'    => $admin_id,
								'room_no'      => $room_no,
								'u_id' => $u_id11,
								'guest_name' => $user_n,
								'send_to' => $send_to111,
								'send_to_u_id'=>$guest_id,
								'requirement' => $requirement,
								'date' => date('Y-m-d'),
								'time' =>date("h:i:s"),
							);
							
							// print_r($arr);exit;
				$add = $this->FrontofficeModel->insert_data('service_request',$arr);
				if($add){
						$send_for = 7;
						$send_to = 2;
						$title ="Service Request";
						   $arr = array(
									   'ser_id'      => $add,
									   'send_to'     => $send_to,
									   'send_for'    => $send_for,
									   'title'       =>$title,
									   'room_no'     => $room_no,
									   'description'  => $requirement,
									   'send_by'      => 3,
									   'send_by_id'   => $admin_id,
									   'added_by_id' => $u_id11,
								   );
					  
						   $add11 = $this->FrontofficeModel->insert_data('notifications',$arr);
						   // var_dump($add11);die;
						   if($add11){
							  
								  $arr = array(
											   'notification_id' => $add11,
											   'department_id' => $send_to111
										  );

								  $add11 = $this->FrontofficeModel->insert_data('notifictions_department_id',$arr);
				
								  $u_id = $this->session->userdata('u_id');
								  $where ='(u_id = "'.$u_id.'")';
								  $admin_details = $this->MainModel->getData($tbl ='register', $where);
								  $admin_id = $admin_details['hotel_id'];
						  
								  $service_request['list'] = $this->FrontofficeModel->get_service_request($admin_id);
								//   $this->load->view('include/header');
								  $this->load->view('frontoffice/ajaxviewServiceRequest',$service_request);
								//   $this->load->view('include/footer');
				   }
				}
				else
				{
					$this->session->set_flashdata('msg','Something went wrong');
					redirect(base_url('ser_req'));
				}
			   }
			   else
			   {
				   $this->session->set_flashdata('msg','User not exit');
				   redirect(base_url('ser_req'));
			   }	   
		}
		public function get_user_mobile()
		{
			$hotel_id = $this->input->post('hotel_id');
			$room_no = $this->input->post('room_no');
			$guest_data = $this->FrontofficeModel->get_room_no_data($hotel_id,$room_no);

		if(!empty($guest_data ))
			{
				$wh = '(u_id = "'.$guest_data['u_id'].'")';
				$user_data = $this->MainModel->getData('register',$wh);
				$output = ''; 
				$output .= $user_data['mobile_no'];
				echo $output;
			}  
		}
		public function get_user_id()
		{
			$hotel_id = $this->input->post('hotel_id');
			
			$room_no = $this->input->post('room_no');
			
			$guest_data = $this->FrontofficeModel->get_room_no_data($hotel_id,$room_no);
			if(!empty($guest_data))
			{
				$output = '';              
			
				$output .= $guest_data['u_id'];
				
				echo $output;
			}
			
			
		}
		public function get_user_name()
		{
			$hotel_id = $this->input->post('hotel_id');
			//echo $hotel_id;die;
			$room_no = $this->input->post('room_no');
			
			$guest_data = $this->FrontofficeModel->get_room_no_data($hotel_id,$room_no);
			if(!empty($guest_data ))
			{
				$wh = '(u_id = "'.$guest_data['u_id'].'")';

				$user_data = $this->MainModel->getData('register',$wh);
				
				$output = ''; 
				
				$output .= $user_data['full_name'];
				
				echo $output;
			}
			
		}   
		public function add_lost_found_record()
		{
			  $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'];
			  $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'];
			  $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'];
			  $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'];
			  $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'];

			  $path = 'logo/lost/';
			  $file_path = './'.$path;
			  $config['allowed_types'] = '*';
			  $config['encrypt_name'] = TRUE;
			  $config['upload_path'] = $file_path;
			  $this->load->library('upload',$config);
			  $this->upload->initialize($config);

			  if($this->upload->do_upload('my_uploaded_file'))
			  {
				  $file_data = $this->upload->data();

				  $images = base_url().$path.$file_data['file_name'];
			  }
		  
		  
			$room_no = $this->input->post('room_no');
			$user_n = $this->input->post('user_n');
		  //   $lost_item_name = $this->input->post('lost_item_name');
		   
			$item_name = $this->input->post('found_item_name');
			$description = $this->input->post('description');
			$lost_found_date = $this->input->post('lost_found_date');
			$lost_found_time = $this->input->post('lost_found_time');
			$contact_no = $this->input->post('contact_no');
			 $lost_found_flag = $this->input->post('lost_found_flag');

			
			// $admin_id = $this->session->userdata('admin_id');
			$u_id= $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
		
			$admin_id = $admin_details['hotel_id'];
			$u_id11 = $admin_details['u_id'];
		  //   $mobile_no = $admin_details['mobile_no'];
			 if($lost_found_flag == 1 ){
			$arr = array(
							'hotel_id' => $admin_id,
							'room_no' => $room_no,
							'guest_name' => $user_n,
							'img'      => $images,
							'lost_item_name' => $item_name,
							'lost_found_date' => $lost_found_date,
							'lost_found_flag' =>$lost_found_flag,
							'lost_found_time' =>$lost_found_time,
							'description' => $description,
							'contact_no'  =>$contact_no,

						);
						// print_r($arr);exit;
				  $add_details = $this->FrontofficeModel->insert_data('lost_found_list',$arr);
					  }else{
						  $arr = array(
							  'hotel_id' => $admin_id,
							  'room_no' => $room_no,
							  'guest_name' => $user_n,
							  'img'      => $images,
							//'lost_item_name' => $lost_item_name,
							  'found_item_name' => $item_name,
							  'lost_found_date' => $lost_found_date,
							  'lost_found_flag' =>$lost_found_flag,
							  'lost_found_time' =>$lost_found_time,
							  'description' => $description,
							  'contact_no'  =>$contact_no,

						  );
					
						//   print_r($arr);exit;
					$add_details = $this->FrontofficeModel->insert_data('lost_found_list',$arr);
					  }
				  if($add_details){
					$u_id = $this->session->userdata('u_id');
					$where ='(u_id = "'.$u_id.'")';
					$admin_details = $this->MainModel->getData($tbl ='register', $where);
					$admin_id = $admin_details['hotel_id'];
					
			
					$lost_found["list"] = $this->FrontofficeModel->get_lost_found_pagination($admin_id);
					// $this->load->view('include/header');
					$this->load->view('frontoffice/ajaxviewLost',$lost_found);
					// $this->load->view('include/footer');
				  }
				  else{
					  $this->session->set_flashdata('msg', 'Something Went Wrong..!');
					  redirect(base_url().'lost_depar');
					  }
		}
		public function add_pending_handover()
		{
			  $id = $this->session->userdata('u_id');
			   $where ='(u_id = "'.$id.'")';
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
				
				$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
				$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
				$admin_id = $admin_details['hotel_id'];
				$u_id11 = $admin_details['u_id'];

				$create_manager_id=$this->input->post('create_manager_id');
				$date=$this->input->post('date');
				$time=$this->input->post('time');
				$description=$this->input->post('description');
				$where = '(u_id ="'.$id.'")';
				
				$get_d = $this->MainModel->getData($tbl ='register', $where);
				if(!empty($get_d)) 
				{
					$u_id = $get_d['u_id'];
					$hotel_id = $get_d['hotel_id'];
				}

				
				$arr = array(
							
							'create_manager_id'=>$id,
							'date'=>$date,
							'time'=>$time,
							'description' =>$description,
							'hotel_id' =>$hotel_id,
							'is_complete'=> 0,
							'added_by'=> 4,
							'added_by_u_id'=> $u_id,
				);
				$insert_id22 = $this->FrontofficeModel->insert_data($tbl='handover_manger', $arr);

				// if($insert_id22)
				// {
				// 	// $u_id = $this->session->userdata('u_id');
				// 	// $where ='(u_id = "'.$u_id.'")';
				// 	// $admin_details = $this->MainModel->getData($tbl ='register', $where);
				// 	// $admin_id = $admin_details['hotel_id'];
			
				// 	// $data['pending_handover']= $this->FrontofficeModel->get_manager_handover_list_pagination($admin_id);
				// 	// // $this->load->view('include/header');
				// 	// $this->load->view('frontoffice/ajaxviewHandover',$data);
				// 	// $this->load->view('include/footer');
				// }
				// else
				// {
				// // $this->session->set_flashdata('pending_handover_error_msg', 'Something Went Wrong..!');
				// // redirect(base_url().'handover'); 
					
				// }
			 }   
			 public function add_expenses()
			 {
				 $guest_name = $this->input->post('guest_name');
				 $mobile_no = $this->input->post('mobile_no');
				 $expense_amt = $this->input->post('expense_amt');
				 $date = $this->input->post('date');
				 $description = $this->input->post('description');
				  $booking_id = $this->input->post('booking_id');
				 // $admin_id = $this->session->userdata('front_id');
				 $u_id= $this->session->userdata('u_id');
				 $where ='(u_id = "'.$u_id.'")';
				 $admin_details = $this->MainModel->getData($tbl ='register', $where);
				 
				 $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
				 $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
				 $admin_id = $admin_details['hotel_id'];
				 $u_id11 = $admin_details['u_id'];

				 $user_data = $this->FrontofficeModel->get_user_data_by_no($mobile_no);
				 // var_dump($user_data);die;

				 if($user_data)
				 {
					 $arr = array(
									 'hotel_id' => $admin_id,
									 'u_id' => $user_data['u_id'],
									 'booking_id' => $booking_id,
									 'guest_name' => $guest_name,
									 'mobile_no' => $mobile_no,
									 'expense_amt' => $expense_amt,
									 'date' => $date,
									 'description' => $description,
									 'added_by' => 2,
									 'added_by_u_id' => $u_id11,
								 );

					 $add = $this->FrontofficeModel->insert_data('expenses',$arr);

					 if($add)
					 {
						$u_id = $this->session->userdata('u_id');
						$where ='(u_id = "'.$u_id.'")';
						$admin_details = $this->MainModel->getData($tbl ='register', $where);
						$admin_id = $admin_details['hotel_id'];

						$accounts["list"] = $this->FrontofficeModel->get_user_expense_pagination($admin_id);
						// $this->load->view('include/header');
						$this->load->view('frontoffice/ajaxviewExpense',$accounts);
						// $this->load->view('include/footer');
					 }
					 else
					 {
						 $this->session->set_flashdata('msg','Something went wrong');
						 redirect(base_url('expense'));
					 }
				 }
				 else
				 {
					 $this->session->set_flashdata('msg','Mobile number not registerd');
					 redirect(base_url('expense'));
				 }
			 }     
			 public function add_booking_id()
			 {
				 $mobile_no = $this->input->post('mobile_no');
	 
				 $wh = '(mobile_no = "'.$mobile_no.'")';
				//  print_r($wh);exit;
				 $register =  $this->MainModel->getData('register',$wh);
	 
				 $wh1 = '(u_id = "'.$register['u_id'].'" AND is_guest = 1)';
	 
				 $guest_user =  $this->MainModel->getData('guest_user',$wh1);
				//  print_r($guest_user);exit;
				 $output = '';
	 
				 $output .= $guest_user['booking_id'];
				 
				 echo $output;
			 }
			 public function add_room_type()
			 {
				 // $admin_id = $this->session->userdata('front_id');
				 $u_id= $this->session->userdata('u_id');
				 $where ='(u_id = "'.$u_id.'")';
				 $admin_details = $this->MainModel->getData($tbl ='register', $where);
				 
				 $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
				 $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
				 $admin_id = $admin_details['hotel_id'];
				 $u_id11 = $admin_details['u_id'];


				 $room_type_name = $this->input->post('room_type_name');
				 $price = $this->input->post('price');
				 $lux_tax = $this->input->post('lux_tax');
				 $serv_tax = $this->input->post('serv_tax');

				 $wh = '(hotel_id = "'.$admin_id.'" AND room_type_name = "'.$room_type_name.'")';

				 $room_type_data = $this->MainModel->getData('room_type',$wh);

				 if($room_type_data)
				 {
					 $this->session->set_flashdata('room_type_msg','Room Type already exits..');
					 redirect(base_url('add_room_type'));
				 }
				 else
				 {
					 $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'];
					 $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'];
					 $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'];
					 $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'];
					 $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'];

					 $path = 'logo/room_type/';
					 $file_path = './'.$path;
					 $config['allowed_types'] = '*';
					 $config['encrypt_name'] = TRUE;
					 $config['upload_path'] = $file_path;
					 $this->load->library('upload',$config);
					 $this->upload->initialize($config);

					 if($this->upload->do_upload('my_uploaded_file'))
					 {
						 $file_data = $this->upload->data();

						 $images = base_url().$path.$file_data['file_name'];
					 }

					 $arr =  array(
									 'hotel_id' => $admin_id,
									 'room_type_name' => $room_type_name,
									 'images' => $images,
									 'price' => $price,
									 'lux_tax' => $lux_tax,
									 'serv_tax' => $serv_tax,
									 'added_by' => 2,
									 'added_by_u_id' => $u_id11,
								 );

					 $add = $this->FrontofficeModel->insert_data('room_type',$arr);

					 if($add)
					 {
						$u_id = $this->session->userdata('u_id');
						$where ='(u_id = "'.$u_id.'")';
						$admin_details = $this->MainModel->getData($tbl ='register', $where);
						$admin_id = $admin_details['hotel_id'];
				
						$add_room_type["room_type_list"] = $this->FrontofficeModel->get_room_type_list_pagination($admin_id);
						
						// $this->load->view('include/header');
						$this->load->view('frontoffice/ajaxviewAddRoomType',$add_room_type);
						// $this->load->view('include/footer');
					 }
					 else
					 {
						 $this->session->set_flashdata('room_type_msg','Something went wrong');
						 redirect(base_url('add_room_type'));
					 }
				 }
			 }
			 public function add_agency()
			 {
				 $u_id= $this->session->userdata('u_id');
				 $where ='(u_id = "'.$u_id.'")';
				 $admin_details = $this->MainModel->getData($tbl ='register', $where);
				 
				 $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
				 $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
				 
					 $admin_id = $admin_details['hotel_id'];
					 $u_id11 = $admin_details['u_id'];
				$agent_name=$this->input->post('name');
				$email=$this->input->post('email');
				$phone=$this->input->post('phone');
				$agency_name=$this->input->post('agency_name');
				$description=$this->input->post('description');

				 
				 $arr = array(
							'hotel_id'=>$admin_id,
							 'name' => $agent_name,
							 'email' => $email,
							 'phone' => $phone,
							 'agency_name' => $agency_name,
							 'description'=> $description,
							 // 'added_by_u_id'=> $u_id11
							 
							 );
				 
			 $insert_id22 = $this->FrontofficeModel->insert_data($tbl='agents', $arr);

			 if($insert_id22)
			 {
				$u_id = $this->session->userdata('u_id');
				$where ='(u_id = "'.$u_id.'")';
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
				$admin_id = $admin_details['hotel_id'];

				$add_visitors["agents_list"] = $this->FrontofficeModel->get_agents_pagination($admin_id);
				// $this->load->view('include/header');
				$this->session->set_flashdata('msg', 'Agent added Sucessfully..!');
				$this->load->view('frontoffice/ajaxviewAgents',$add_visitors);
				// $this->load->view('include/footer');
				 
				//  redirect(base_url().'agents'); 
				 }
				 else
				 {
				 $this->session->set_flashdata('msg', 'Something Went Wrong..!');
				 redirect(base_url().'agents'); 
					 
				 }
		 } 
		 public function assign_rooms()
		 {
			 $booking_id = $this->input->post('booking_id');
			 $room_no = $this->input->post('room_no'); //single
			 $price = $this->input->post('price'); //single
			 $room_type = $this->input->post('room_type'); //single
			 $price1 = $this->input->post('price1'); // multiple
			 $room_no1 = $this->input->post('room_no1');//multiple
 
			 $wh_detail = '(booking_id = "'.$booking_id.'")';
			 
			 // $admin_id = $this->session->userdata('admin_id');
 
			 $u_id = $this->session->userdata('u_id');
			 $where ='(u_id = "'.$u_id.'")';
			 $admin_details = $this->MainModel->getData($tbl ='register', $where);
			 $admin_id = $admin_details['hotel_id'];
			
			 $booking_data = $this->MainModel->getData('user_hotel_booking',$wh_detail);
			 $add_details = "";
			 $add_details1 = "";
 
			 //single room addd
 
			 if(isset($_POST['room_no']))
			 {
				 $arr = array(
								 'booking_id' => $booking_id,
								 'room_no' => $room_no,
								 'price' => $price,
								 'no_of_rooms' => 1,
								 'room_type' => $room_type,
							 );
							

				 $add_details = $this->FrontofficeModel->insert_data('user_hotel_booking_details',$arr);
				
				 if($add_details)
				 {
				   $ar = array(

						 'booking_id' => $booking_id,
						 'hotel_id' => $booking_data['hotel_id'],
						 'u_id' => $booking_data['u_id'],
						 'check_in' => $booking_data['check_in'],
						 'check_out' => $booking_data['check_out'],
						
					 );
					
					  $this->FrontofficeModel->insert_data('web_check_in',$ar);
					 // change room status
					 $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$room_no.'")';
 
					 $arr_rm_up = array(
										 'room_status' => 2,
									 );
 
					 $this->FrontofficeModel->edit_data('room_status',$wh_r,$arr_rm_up);
 
					 $arr_up = array(
										 'total_charges' => $booking_data['total_charges'] + $price,
										 'booking_status' => 1
									 );
 
					 $this->FrontofficeModel->edit_data('user_hotel_booking',$wh_detail,$arr_up);
 
				 }
			 }
			 
		 
			 if(isset($_POST['room_no1']))
			 {
				 $count = count($room_no1);
 
				 for($i = 0 ;$i < $count; $i++)
				 {
					 $arr1 = array(
									 'booking_id' => $booking_id,
									 'room_no' => $room_no1[$i],
									 'price' => $price1[$i],
									 'no_of_rooms' => 1,
									 'room_type' => $room_type,
								 );
			
					 $add_details1 = $this->FrontofficeModel->insert_data('user_hotel_booking_details',$arr1);
 
					 if($add_details1)
					 {
						$ar = array(

						 'booking_id' => $booking_id,
						 'hotel_id' => $booking_data['hotel_id'],
						 'u_id' => $booking_data['u_id'],
						 'check_in' => $booking_data['check_in'],
						 'check_out' => $booking_data['check_out'],
					  
					 );

					  $this->FrontofficeModel->insert_data('web_check_in',$ar);
						 // change room status
						 $wh_r1 = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$room_no1[$i].'")';
 
						 $arr_rm_up1 = array(
											 'room_status' => 2,
										 );
 
						 $this->FrontofficeModel->edit_data('room_status',$wh_r1,$arr_rm_up1);
 
						 $arr_up1 = array(
											 'total_charges' => $booking_data['total_charges'] + $price1[$i],
											 'booking_status' => 1
										 );
			 
						 $this->FrontofficeModel->edit_data('user_hotel_booking',$wh_detail,$arr_up1);
 
					 }
				 }
			 }
 
			 if($add_details || $add_details1)
			 {
				   //changes enquiry request status
				 $wh_enq = '(hotel_enquiry_request_id = "'.$booking_data['enquiry_id'].'")';
 
				 $arr_eq = array(
									 'is_admin_accept_req' => 1,
									 'request_status' => 4,
								 );
 
				 $this->FrontofficeModel->edit_data('hotel_enquiry_request',$wh_enq,$arr_eq);
 
				 $this->session->set_flashdata('msg','Assign Rooms Successfully');
				 redirect(base_url('frontArrival'));
			 }
			 else
			 {
				 $this->session->set_flashdata('msg','Something went wrong');
				 redirect(base_url('frontArrival'));
			 }
		 }

		 public function edit_business_center()
		 {
			 $business_center_id = $this->input->post('business_center_id');
			
			 $business_center_type = $this->input->post('business_center_type');
			 $no_of_people = $this->input->post('no_of_people');
			 $price = $this->input->post('price');
			 $description = $this->input->post('description');
			 $facility_name = $this->input->post('facility_name');
 
			
			 $business_center_image_id = $this->input->post('business_center_image_id',TRUE); // image id
			 // $id1 = $this->input->post('img_id',TRUE);
			
			 $wh = '(business_center_id = "'.$business_center_id.'")';
			// print_r($wh);exit;
			 $arr = array(
						  'business_center_type' => $business_center_type,
						  'no_of_people' => $no_of_people,
						  'price' => $price,
						  'description' => $description
						 );
			 $up = $this->FrontofficeModel->edit_data('business_center',$wh,$arr);
			//  print_r($up);exit;

			 if($up)
			 {
				  // updated particular images
				 if(isset($_FILES['image']['name']))
				 {
					// print
					 echo $count_img = count(array($_FILES['image']['name'],TRUE));
					
					 for($i = 0;$i < $count_img; $i++)
					 {
						 if(!empty($_FILES['image']['name'][$i]))
						 {
							 $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
							 $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
							 $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
							 $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
							 $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];
		 
							 $path = 'logo/manage_add/';
							 $file_path = './'.$path;
							 $config['allowed_types'] = '*';
							 $config['encrypt_name'] = TRUE;
							 $config['upload_path'] = $file_path;
							 $this->load->library('upload',$config);
							 $this->upload->initialize($config);
	 
							 if($this->upload->do_upload('my_uploaded_file'))
							 {
								 $file_data = $this->upload->data();
		 
								 $images = base_url().$path.$file_data['file_name'];
								 
								 $wh1 = '(business_center_image_id = "'.$business_center_image_id[$i].'")';
	 
								 $arr1 = array(
											 'image' => $images
											 );
	 
								 $this->FrontofficeModel->edit_data('business_center_images',$wh1,$arr1);
							 }        
						 }
					 }
				 }
				 
				 //edit facility
				 if(!empty($facility_name))
				 {
					 for($j = 0;$j < count($facility_name); $j++)
					 {
						 $arr_fc = array(
										 'facility_name' => $facility_name[$j]
									 );
									//  print_r($arr_fc);exit;
						 $this->FrontofficeModel->edit_data('business_center_facility',$wh,$arr_fc);
					 }
				 }
				 
				
				 $u_id = $this->session->userdata('u_id');
				 $where ='(u_id = "'.$u_id.'")';
				 $admin_details = $this->MainModel->getData($tbl ='register', $where);
				 $admin_id = $admin_details['hotel_id'];
		 
				 $business_data['list'] = $this->FrontofficeModel->get_center($admin_id);
				 $business_data['data'] = $this->FrontofficeModel->get_buis_center_data($admin_id);          
				 $business_data['facility_list'] = $this->FrontofficeModel->get_center_facility($admin_id);
				 $business_data['center_pics'] = $this->FrontofficeModel->get_buis_center_photos($admin_id);
		 
				 $this->session->set_flashdata('msg','Business center updated successfully..');
				 $this->load->view('frontoffice/ajaxviewManageBusinessCenter', $business_data);
				//  $this->load->view('include/footer');
			 }
			 else
			 {
				 $this->session->set_flashdata('msg','Something went wrong');
				 redirect(base_url('add_center'));
			 }
 
		 }
		 public function update_pending_handover()
		 {
			$id = $this->session->userdata('u_id');
			$where = '(u_id ="'.$id.'")';
			$get_d = $this->MainModel->getData($tbl ='register', $where);

			$hotel_id = $get_d['hotel_id'];
			$m_handover_id= $this->input->post('m_handover_id');  	
			$is_complete=$this->input->post('is_complete');
			$description=$this->input->post('description');

					$arr=array(
					'completed_manger_id'=>$hotel_id,
					'is_complete' => $is_complete,
					'description' => $description
					);

			$where1='(m_handover_id="'.$m_handover_id.'")';
			
			$result = $this->FrontofficeModel->edit_data($tbl='handover_manger', $where1, $arr);   
			//    var_dump($result);die;		
			// if($result)
			// {
				
			// 	// $u_id = $this->session->userdata('u_id');
			// 	// 	$where ='(u_id = "'.$u_id.'")';
			// 	// 	$admin_details = $this->MainModel->getData($tbl ='register', $where);
			// 	// 	$admin_id = $admin_details['hotel_id'];
			
			// 	// 	$data['pending_handover']= $this->FrontofficeModel->get_manager_handover_list_pagination($rowperpage, $row, $search,$columnName,$hotel_id);
			// 	// 	$this->session->set_flashdata('pending_handover_msg', 'Data Update Successfully..!');
			// 	// 	// $this->load->view('include/header');
			// 	// 	$this->load->view('frontoffice/ajaxviewHandover',$data);
			// }
			// else
			// {
			// 	$this->session->set_flashdata('pending_handover_error_msg', 'Something Went Wrong..!');
			// 	redirect(base_url().'handover'); 
			// }
		 }
		 public function edit_lost_found()
		 {
			 
			 
			 $room_no = $this->input->post('room_no');
			 $user_n = $this->input->post('user_n');
			 $found_item_name = $this->input->post('found_item_name');
 
			 $lost_item_name = $this->input->post('lost_item_name');
 
			 $description = $this->input->post('description');
			 $lost_found_date = $this->input->post('lost_found_date');
			 $lost_found_date = $this->input->post('lost_found_date');
			 
			
			 $id = $this->input->post('id');
			//  print_r($id);exit;
			 $wh11 = '(id = "'.$id.'")';
 
			 $lost_found_data  = $this->MainModel->getData('lost_found_list',$wh11);
			 if(!empty($_FILES['image']['name']))
			 {
				 $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'];
				 $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'];
				 $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'];
				 $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'];
				 $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'];
 
				 $path = 'logo/lost/';
				 $file_path = './'.$path;
				 $config['allowed_types'] = '*';
				 $config['encrypt_name'] = TRUE;
				 $config['upload_path'] = $file_path;
				 $this->load->library('upload',$config);
				 $this->upload->initialize($config);
 
				 if($this->upload->do_upload('my_uploaded_file'))
				 {
					 $file_data = $this->upload->data();
 
					 $images = base_url().$path.$file_data['file_name'];
				 }
			 }
			 else
			 {
				 $images = $lost_found_data['img'];
			 }
			 $wh = '(id = "'.$id.'")';
 
			 $arr = array(
				 'room_no' => $room_no,
				 'guest_name' => $user_n,
				 'img'=> $images, 
				 'lost_item_name' => $lost_item_name,
				 'found_item_name' => $found_item_name,
				 'description' => $description,
				 'lost_found_date' => $lost_found_date  ,
						 );
			//    print_r( $arr);exit;
			 $up = $this->FrontofficeModel->edit_data('lost_found_list',$wh,$arr);
 
			 if($up)
			 {
				$u_id = $this->session->userdata('u_id');
					$where ='(u_id = "'.$u_id.'")';
					$admin_details = $this->MainModel->getData($tbl ='register', $where);
					$admin_id = $admin_details['hotel_id'];
						
					$lost_found["list"] = $this->FrontofficeModel->get_lost_found_pagination($admin_id);
					
					$this->session->set_flashdata('msg','Data Updated Successfully');
					$this->load->view('frontoffice/ajaxviewLost',$lost_found);
				
			 }
			 else
			 {
				 $this->session->set_flashdata('msg','Something went wrong');
				 redirect(base_url('lost_depar'));
			 }
		 }
		 public function edit_expenses()
		 {
			// print_r($this->input->post('expense_id'));exit;
			 $guest_name = $this->input->post('guest_name');
			 $mobile_no = $this->input->post('mobile_no');
			 $expense_amt = $this->input->post('expense_amt');
			 $date = $this->input->post('date');
			 $description = $this->input->post('description');

			 $expense_id = $this->input->post('expense_id');
			 //  var_dump($expense_id);die;
			 $wh = '(expense_id = "'.$expense_id.'")';

			 $user_data = $this->FrontofficeModel->get_user_data_by_no($mobile_no);

			 if($user_data)
			 {
				 $arr = array(
							 'guest_name' => $guest_name,
							 'mobile_no' => $mobile_no,
							 'u_id' => $user_data['u_id'],
							 'expense_amt' => $expense_amt,
							 'date' => $date,
							 'description' => $description,
							 );
							//  print_r($arr);exit;
				 $up = $this->FrontofficeModel->edit_data('expenses',$wh,$arr);

				 if($up)
				 {
					 
					 $u_id = $this->session->userdata('u_id');
					 $where ='(u_id = "'.$u_id.'")';
					 $admin_details = $this->MainModel->getData($tbl ='register', $where);
					 $admin_id = $admin_details['hotel_id'];
 
					 $accounts["list"] = $this->FrontofficeModel->get_user_expense_pagination($admin_id);
					 $this->session->set_flashdata('msg','Data Updated Successfully');
					 $this->load->view('frontoffice/ajaxviewExpense',$accounts);
				 }
				 else
				 {
					 $this->session->set_flashdata('msg','Something went wrong');
					 redirect(base_url('expense'));
				 }
			 }
			 else
			 {
				 $this->session->set_flashdata('msg','Mobile number not registerd');
				 redirect(base_url('expense'));
			 }
			 
		 }
		 public function edit_floor()
		 {
		 // $admin_id = $this->session->userdata('front_id');
			$u_id= $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);

			$admin_id = $admin_details['hotel_id'];
			$u_id11 = $admin_details['u_id'];
			$floor_id = $this->input->post('floor_id');
			$floor = $this->input->post('floor');

			$wh = '(floor_id = "'.$floor_id.'")';
			$wh1 = '(hotel_id = "'.$admin_id.'" AND floor = "'.$floor.'")';
			$floor_data = $this->MainModel->getData('floors',$wh1);
		 if($floor_data)
		 {
			$this->session->set_flashdata('msg','Floor already exits..');
			redirect(base_url('add_floor'));
		 }
		 else
		 {
			$arr =  array(
			'floor' => $floor,
			);
				$add = $this->FrontofficeModel->edit_data('floors',$wh,$arr);
			if($add)
			{
			
				$u_id = $this->session->userdata('u_id');
				$where ='(u_id = "'.$u_id.'")';
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
				$admin_id = $admin_details['hotel_id'];

				$add_floor["floor_data"] = $this->FrontofficeModel->get_floor_list_pagination($admin_id);

				$this->session->set_flashdata('msg','Floor updated Successfully..');
				$this->load->view('frontoffice/ajaxviewAddFloor',$add_floor);
				
			}
			else
			{
				$this->session->set_flashdata('msg','Something went wrong');
				redirect(base_url('add_floor'));
			}
		 }
	}
	public function update_room_type()
	{
		$front_office_id = $this->session->userdata('u_id');

		$room_type_id = $this->input->post('room_type_id');

		$room_type_name = $this->input->post('room_type_name');
		$price = $this->input->post('price');
		$lux_tax = $this->input->post('lux_tax');
		$serv_tax = $this->input->post('serv_tax');

		$wh = '(room_type_id = "'.$room_type_id.'")';

		$wh1 = '(hotel_id = "'.$front_office_id.'" AND room_type_name = "'.$room_type_name.'")';

		$room_type_data = $this->MainModel->getData('room_type',$wh1);

		$room_type_data1 = $this->MainModel->getData('room_type',$wh);

		if($room_type_data)
		{
			$this->session->set_flashdata('room_type_msg','Room Type already exits..');
			redirect(base_url('add_room_type'));
		}
		else
		{
			if(!empty($_FILES['image']['name']))
			{
				$_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'];
				$_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'];
				$_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'];
				$_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'];
				$_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'];

				$path = 'logo/room_type/';
				$file_path = './'.$path;
				$config['allowed_types'] = '*';
				$config['encrypt_name'] = TRUE;
				$config['upload_path'] = $file_path;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('my_uploaded_file'))
				{
					$file_data = $this->upload->data();

					$images = base_url().$path.$file_data['file_name'];
				}
			}
			else
			{
				$images = $room_type_data1['images'];
			}
			
			$arr =  array(
							'room_type_name' => $room_type_name,
							'images' => $images,
							'price' => $price,
							'lux_tax' => $lux_tax,
							'serv_tax' => $serv_tax,
						);

			$add = $this->FrontofficeModel->edit_data('room_type',$wh,$arr);

			if($add)
			{
				
				$u_id = $this->session->userdata('u_id');
				$where ='(u_id = "'.$u_id.'")';
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
				$admin_id = $admin_details['hotel_id'];
				
				$add_room_type["room_type_list"] = $this->FrontofficeModel->get_room_type_list_pagination($admin_id);
				$this->session->set_flashdata('room_type_msg','Room Type updated Successfully..');		
						// $this->load->view('include/header');
				$this->load->view('frontoffice/ajaxviewAddRoomType',$add_room_type);
						// $this->load->view('include/footer');
			}
			else
			{
				$this->session->set_flashdata('room_type_msg','Something went wrong');
				redirect(base_url('add_room_type'));
			}
		}
	}  
	public function update_agents()
	{
		$agent_id= $this->input->post('id');  	
		$agent_name=$this->input->post('name');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$agency_name=$this->input->post('agency_name');
		$description=$this->input->post('description');

		
		$arr=array(
			'name' => $agent_name,
			'email' => $email,
			'phone' => $phone,
			'agency_name' => $agency_name,
			'description'=> $description,
		
		);
		$where1='(id="'.$agent_id.'")';
		$result= $this->FrontofficeModel->edit_data($tbl='agents', $where1, $arr);   		
		if($result)
		{
			$u_id = $this->session->userdata('u_id');
				$where ='(u_id = "'.$u_id.'")';
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
				$admin_id = $admin_details['hotel_id'];

				$add_visitors["agents_list"] = $this->FrontofficeModel->get_agents_pagination($admin_id);
				
				$this->session->set_flashdata('msg', 'Data Update Successfully..!');
				$this->load->view('frontoffice/ajaxviewAgents',$add_visitors);
		}
		else
		{
			$this->session->set_flashdata('msg', 'Something Went Wrong..!');
			redirect(base_url().'agents'); 
		}
	} 
	public function delete_services()
	{
		$id=$this->input->post('id');

		
		$where = '(business_center_id = "'.$id.'")';
		$result= $this->FrontofficeModel->delete_data($tbl="business_center", $where);

		if ($result) {
			echo "1";
		} else {
			echo "0";
		}
	}
	public function edit_front_ofs_services()
	{
		$service_name = $this->input->post('service_name');
		$staff_name = $this->input->post('staff_name');
		$contact_no = $this->input->post('contact_no');
		$open_time = $this->input->post('open_time');
		$close_time = $this->input->post('close_time');
		$break_start_time = $this->input->post('break_start_time');
		$break_close_time = $this->input->post('break_close_time');
		$description = $this->input->post('description');
		$t_nd_c = $this->input->post('t_nd_c');

		// $admin_id = $this->session->userdata('admin_id');
		$u_id= $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		
		$admin_id = $admin_details['hotel_id'];
		$u_id11 = $admin_details['u_id'];

		$wh = '(u_id = "'.$admin_id.'")';
		$get_data = $this->MainModel->getData('register', $wh);
		$front_ofs_service_id = $this->input->post('front_ofs_service_id');

		$front_ofs_service_image_id = $this->input->post('front_ofs_service_image_id',TRUE);

		$front_ofs_spa_service_images_id = $this->input->post('front_ofs_spa_service_images_id',TRUE);

		$wh = '(front_ofs_service_id = "'.$front_ofs_service_id.'") ';

		$spa_type = $this->input->post('spa_type');
		$spa_price = $this->input->post('spa_price');

		$spa_type12 = $this->input->post('spa_type12');
		$spa_price12 = $this->input->post('spa_price12');
		
		

		$shuttle_service_image_id = $this->input->post('shuttle_service_image_id');

		$arr = array(
						'service_name' => $service_name,
						'staff_name' => $staff_name,
						'contact_no' => $contact_no,
						'open_time' => $open_time,
						'close_time' => $close_time,
						'break_start_time' => $break_start_time,
						'break_close_time' => $break_close_time,
						'description' => $description,
						't_nd_c' => $t_nd_c
					);

		$up = $this->FrontofficeModel->edit_data('front_ofs_services',$wh,$arr);

		if($up)
		{
			// edit multiple images
			if(isset($_FILES['image']['name']))
			{
				$count = count($_FILES['image']['name'],TRUE);

				for($i = 0;$i < $count; $i++)
				{
					if(!empty($_FILES['image']['name'][$i]))
					{
						$_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
						$_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
						$_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
						$_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
						$_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];

						$path = 'logo/';
						$file_path = './'.$path;
						$config['allowed_types'] = '*';
						$config['encrypt_name'] = TRUE;
						$config['upload_path'] = $file_path;
						$this->load->library('upload',$config);
						$this->upload->initialize($config);

						if($this->upload->do_upload('my_uploaded_file'))
						{ 
							$file_data = $this->upload->data();

							$image = base_url().$path.$file_data['file_name'];
							
							$wh1 = '(front_ofs_service_image_id = "'.$front_ofs_service_image_id[$i].'")';

							$arr1 = array(
											'image' => $image,
										);

							$this->FrontofficeModel->edit_data('front_ofs_services_images',$wh1,$arr1);
						} 
					}
				}
			}

			//edit only single image of shuttle service
			if($service_name == 4)
			{
				if(isset($_FILES['shuttle_img']['name']))
				{
					if(!empty($_FILES['shuttle_img']['name']))
					{
						$_FILES['my_shuttle_file']['name'] = $_FILES['shuttle_img']['name'];
						$_FILES['my_shuttle_file']['type'] = $_FILES['shuttle_img']['type'];
						$_FILES['my_shuttle_file']['tmp_name'] = $_FILES['shuttle_img']['tmp_name'];
						$_FILES['my_shuttle_file']['size'] = $_FILES['shuttle_img']['size'];
						$_FILES['my_shuttle_file']['error'] = $_FILES['shuttle_img']['error'];

					if(!empty($_FILES['shuttle_img']['name']))
						$path = 'logo/';
						$file_path = './'.$path;
						$config['allowed_types'] = '*';
						$config['encrypt_name'] = TRUE;
						$config['upload_path'] = $file_path;
						$this->load->library('upload',$config);
						$this->upload->initialize($config);

						if($this->upload->do_upload('my_uploaded_file'))
						{ 
							$file_data = $this->upload->data();

							$shuttle_img = base_url().$path.$file_data['file_name'];
							
							$wh_sh = '(front_ofs_service_image_id = "'.$shuttle_service_image_id.'")';

							$arr_sh = array(
											'image' => $shuttle_img,
										);

							$this->FrontofficeModel->edit_data('front_ofs_services_images',$wh_sh,$arr_sh);
						} 
					}
				}
			}

			// spa images
			if($service_name == 2)
			{
				// edit multiple spa photo price and type
				if(isset($_FILES['spa_photo']['name']))
				{
					$count1 = count($_FILES['spa_photo']['name'],TRUE);

					for($k = 0;$k < $count1; $k++)
					{
						$wh_sp_i = '(front_ofs_spa_service_images_id = "'.$front_ofs_spa_service_images_id[$k].'")';

						$services_img = $this->MainModel->getData('front_ofs_spa_service_images',$wh_sp_i);

						if(!empty($_FILES['spa_photo']['name'][$k]))
						{
							$_FILES['my_spa_file1']['name'] = $_FILES['spa_photo']['name'][$k];
							$_FILES['my_spa_file1']['type'] = $_FILES['spa_photo']['type'][$k];
							$_FILES['my_spa_file1']['tmp_name'] = $_FILES['spa_photo']['tmp_name'][$k];
							$_FILES['my_spa_file1']['size'] = $_FILES['spa_photo']['size'][$k];
							$_FILES['my_spa_file1']['error'] = $_FILES['spa_photo']['error'][$k];

							$path = 'logo/';
							$file_path = './'.$path;
							$config['allowed_types'] = '*';
							$config['encrypt_name'] = TRUE;
							$config['upload_path'] = $file_path;
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('my_spa_file1'))
							{ 
								$file_data = $this->upload->data();

								$spa_photo = base_url().$path.$file_data['file_name'];
								
							} 
						}
						else
						{
							$spa_photo = $services_img['spa_photo'];
						}

						$arr_spa_up = array(
											'spa_photo' => $spa_photo,
											'spa_type' => $spa_type[$k],
											'spa_price' => $spa_price[$k],
										);

						$this->FrontofficeModel->edit_data('front_ofs_spa_service_images',$wh_sp_i,$arr_spa_up);
					}
				}

				// add multiple spa photo price and type
				// $count3 = count($spa_type12);
				if(!empty($_FILES['spa_photo12']['name'])){

					$count3 = count($_FILES['spa_photo12']['name'],TRUE);

					for($l = 0;$l < $count3; $l++)
				{
					if(!empty($_FILES['spa_photo12']['name'][$l]))
					{
						$_FILES['my_spa_file2']['name'] = $_FILES['spa_photo12']['name'][$l];
						$_FILES['my_spa_file2']['type'] = $_FILES['spa_photo12']['type'][$l];
						$_FILES['my_spa_file2']['tmp_name'] = $_FILES['spa_photo12']['tmp_name'][$l];
						$_FILES['my_spa_file2']['size'] = $_FILES['spa_photo12']['size'][$l];
						$_FILES['my_spa_file2']['error'] = $_FILES['spa_photo12']['error'][$l];

						$path = 'logo/';
						$file_path = './'.$path;
						$config['allowed_types'] = '*';
						$config['encrypt_name'] = TRUE;
						$config['upload_path'] = $file_path;
						$this->load->library('upload',$config);
						$this->upload->initialize($config);

						if($this->upload->do_upload('my_spa_file2'))
						{ 
							$file_data = $this->upload->data();

							$spa_photo2 = base_url().$path.$file_data['file_name'];
							
							$arr_spa_ad = array(
												'hotel_id' => $admin_id,
												'front_ofs_service_id' => $front_ofs_service_id,
												'spa_photo' => $spa_photo2,
												'spa_type' => $spa_type12[$l],
												'spa_price' => $spa_price12[$l],
												);

							$this->FrontofficeModel->insert_data('front_ofs_spa_service_images',$arr_spa_ad);
						} 
					}
				}
				

				
				}
			}
			  
			if($service_name == 1)
			{
				$this->session->set_flashdata('msg','Data Updated Successfully');
				redirect(base_url('facilityUpdate'));
			}
			else
			{
				if($service_name == 2)
				{
					$this->session->set_flashdata('msg','Data Updated Successfully');
					// print('hello');exit;
					redirect(base_url('serviceBooking'));
				}
				else
				{
					if($service_name == 3)
					{
						$this->session->set_flashdata('msg','Data Updated Successfully');
						redirect(base_url('facilityUpdate'));
					}
					else
					{
						if($service_name == 4)
						{
							$this->session->set_flashdata('msg','Data Updated Successfully');
							redirect(base_url('facilityUpdate'));
						}
						else
						{
							if($service_name == 5)
							{
								$this->session->set_flashdata('msg','Data Updated Successfully');
								redirect(base_url('serviceBooking'));
							}
							else
							{
								if($service_name == 6)
								{
									$this->session->set_flashdata('msg','Data Updated Successfully');
									redirect(base_url('serviceBooking'));
								}
								else
								{
									if($service_name == 7)
									{
										$this->session->set_flashdata('msg','Data Updated Successfully');
										redirect(base_url('serviceBooking'));
									}
									else
									{
										if($service_name == 8)
										{
											$this->session->set_flashdata('msg','Data Updated Successfully');
											redirect(base_url('serviceBooking'));
										}
									}
								}
							}
						}
					}
				}
			}
		}
		else
		{
			if($service_name == 1)
			{
				$this->session->set_flashdata('msg','Something went wrong');
				redirect(base_url('serviceBooking'));
			}
			else
			{
				if($service_name == 2)
				{
					$this->session->set_flashdata('msg','Something went wrong');
					redirect(base_url('serviceBooking'));
				}
				else
				{
					if($service_name == 3)
					{
						$this->session->set_flashdata('msg','Something went wrong');
						redirect(base_url('serviceBooking'));
					}
					else
					{
						if($service_name == 4)
						{
							$this->session->set_flashdata('msg','Something went wrong');
							redirect(base_url('serviceBooking'));
						}
						else
						{
							if($service_name == 5)
							{
								$this->session->set_flashdata('msg','Something went wrong');
								redirect(base_url('serviceBooking'));
							}
							else
							{
								if($service_name == 6)
								{
									$this->session->set_flashdata('msg','Something went wrong');
									redirect(base_url('serviceBooking'));
								}
								else
								{
									if($service_name == 7)
									{
										$this->session->set_flashdata('msg','Something went wrong');
										redirect(base_url('serviceBooking'));
									}
									else
									{
										if($service_name == 8)
										{
											$this->session->set_flashdata('msg','Something went wrong');
											redirect(base_url('serviceBooking'));
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}    
	public function shuttle_availabilty()
	{
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');
		
			$day1 = "Sunday";
			$day2 = "Monday";
			$day3 = "Tuesday";
			$day4 = "Wednesday";
			$day5 = "Thursday";
			$day6 = "Friday";
			$day7 = "Saturday";
            $service_name = 4;
			$guest_mng["list"] = $this->FrontofficeModel->get_front_ofs_services_pagination($admin_id,$service_name);
			
			$guest_mng['sun_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day1);

			$guest_mng['mon_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day2);

			$guest_mng['tue_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day3);

			$guest_mng['wed_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day4);

			$guest_mng['thurs_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day5);

			$guest_mng['fri_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day6);

			$guest_mng['sat_list'] = $this->FrontofficeModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day7);
			$guest_mng['sub_icon_id'] = 4;
		

			$this->load->view('frontoffice/ajaxFrontSubIconBlockView', $guest_mng);
		}
		else
		{
			redirect(base_url());
		}
		
	}
	public function change_business_center_status()
	{
		$status = $this->input->post('status');
		$business_center_id = $this->input->post('id');

		$wh = '(business_center_id = "'.$business_center_id.'")';

		$arr = array(
						'is_active' => $status
					);
		
		$update = $this->FrontofficeModel->edit_data('business_center',$wh,$arr);

		if($update)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	public function resend_notification_to_user()
	{
		$notification_id = $this->uri->segment(3);

		$wh = '(notification_id = "'.$notification_id.'")';

		$wh = '(notification_id = "'.$notification_id.'")';

		$notification_data = $this->MainModel->getData('notifications',$wh);

		$notification_data1 = $this->MainModel->getAllData('notifictions_u_id',$wh);

		$arr = array(
						'send_to' => $notification_data['send_to'],
						'send_for' => $notification_data['send_for'],
						'notification_type' => $notification_data['notification_type'],
						'title' => $notification_data['title'],
						'description' => $notification_data['description'],
						'send_by' => $notification_data['send_by'],
						'send_by_id' => $notification_data['send_by_id'],
					);

		$add = $this->FrontofficeModel->insert_data('notifications',$arr);

		if($add)
		{
		 //    if($notification_data['send_to'] == 2)
		 //    {
		 //        if($notification_data1)
		 //        {
		 //            foreach($notification_data1 as $nt)
		 //            {
		 //                $arr1 = array(
		 //                            'notification_id' => $notification_id,
		 //                            'user_id' => $nt['user_id']
		 //                            );

		 //                $this->MainModel->insert_data('notifictions_u_id',$arr1);
		 //         }
		 //             }  
		 //    }

			 // if($notification_data['send_to'] == 2)
			 if(!empty($notification_data))

			 {
				 if($notification_data1)
				 {
					 foreach($notification_data1 as $nt)
					 {
						 $arr1 = array(
							 'notification_id' => $notification_id,
							 'user_id' => $nt['user_id']
							 );

						 $this->FrontofficeModel->insert_data('notifictions_u_id',$arr1);
					 }
				 }  
			 }
			$this->session->set_flashdata('msg','Resent Notification to User Successfully...');
			redirect(base_url('notification'));
		}
		else
		{
			$this->session->set_flashdata('msg','Something went wrong');
			redirect(base_url('notification'));
		}
	}
	public function getEditData(){
		$wh = $this->input->post('id');
		// $wh = '(business_center_id ="'.$where.'")';
		$data = $this->MainModel->getManageBusinessCenter($tbl ='business_center', $wh);
		// print_r($resultData);exit;
		echo json_encode($data);
	}
	public function getLostData(){
		$wh = $this->input->post('id');
		$data = $this->MainModel->getlostdata($tbl ='lost_found_list', $wh);
		echo json_encode($data);
	}
	public function getExpenseData()
	{
		$wh = $this->input->post('id');
		$data = $this->MainModel->getexpenseData($tbl ='expenses', $wh);
		echo json_encode($data);
	}
	public function getFloorData()
	{
		$wh = $this->input->post('id');
		$data = $this->MainModel->getfloorData($tbl ='floors', $wh);
		echo json_encode($data);
	}
	public function getRoomData()
	{
		$wh = $this->input->post('id');
		$data = $this->MainModel->getroomData($tbl ='room_type', $wh);
		echo json_encode($data);
	}
	public function getAgentData()
	{
		$wh = $this->input->post('id');
		$data = $this->MainModel->getagentData($tbl ='agents', $wh);
		// print_r($data);exit;
		echo json_encode($data);
	}
	public function add_luggage_charges()
	{
		$luggage_type = $this->input->post('luggage_type');
		$charges = $this->input->post('charges');

		// $admin_id = $this->session->userdata('front_id');
		$u_id= $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		
		$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
		$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
		$admin_id = $admin_details['hotel_id'];
		$u_id11 = $admin_details['u_id'];

		$wh = '(luggage_type = "'.$luggage_type.'" AND hotel_id = "'.$admin_id.'")';

		$luggage_charges_data = $this->MainModel->getData('luggage_charges',$wh);

		if($luggage_charges_data)
		{
			$this->session->set_flashdata('msg','Data Already Exits');
			redirect(base_url('serviceBooking'));
		}
		else
		{
			$arr = array(
							'hotel_id' => $admin_id,
							'luggage_type' => $luggage_type,
							'charges' => $charges,
							'added_by' => 2,
							'added_by_u_id' => $u_id11,
						);

			$add = $this->MainModel->insert_data('luggage_charges',$arr);

			if($add)
			{
				$guest_mng['sub_icon_id'] = 7;
				$guest_mng["luggage_request"] = $this->FrontofficeModel->get_luggage_request_list_pagination($admin_id);
				$this->session->set_flashdata('msg','Luggage charges Added Successfully');
				$this->load->view('frontoffice/luggage', $guest_mng);
			}
			else
			{
				$this->session->set_flashdata('msg','Something went wrong');
				redirect(base_url('serviceBooking'));
			}
		}
	}
	public function accept_cloakroom_service_request()
	{
		// $admin_id = $this->session->userdata('front_id');
		$u_id= $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		
		$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
		$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
		$admin_id = $admin_details['hotel_id'];
		$u_id11 = $admin_details['u_id'];

		$luggage_request_id = $this->uri->segment(3);

		$wh = '(luggage_request_id = "'.$luggage_request_id.'")';

		$arr = array(
						'request_status' => 1,
						'assign_by' => 2,
						'assign_by_u_id' => $u_id11,
					);

		$up = $this->MainModel->edit_data('luggage_request',$wh,$arr);

		if($up)
		{
			$this->session->set_flashdata('msg','Request accepted successfully');
			redirect(base_url('serviceBooking'));
		}
		else
		{
			$this->session->set_flashdata('msg','Something went wrong');
			redirect(base_url('serviceBooking'));
		}
	}

	   //Reject  cloakroom service by front Office----------Supriya 
	   public function reject_cloakroom_service_request()
	{
		// $admin_id = $this->session->userdata('front_id');
		$u_id= $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		
		$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
		$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
		$admin_id = $admin_details['hotel_id'];
		$u_id11 = $admin_details['u_id'];

		$luggage_request_id = $this->uri->segment(3);

		$wh = '(luggage_request_id = "'.$luggage_request_id.'")';

		$arr = array(
						'request_status' => 2,
						'assign_by' => 2,
						'assign_by_u_id' => $u_id11,
					);

		$up = $this->MainModel->edit_data('luggage_request',$wh,$arr);

		if($up)
		{
			$this->session->set_flashdata('msg','Request rejected successfully');
			redirect(base_url('serviceBooking'));
		}
		else
		{
			$this->session->set_flashdata('msg','Something went wrong');
			redirect(base_url('serviceBooking'));
		}
	}
	public function delete_lost_found()
        {
            $id=$this->input->post('id');

            $where = '(id = "'.$id.'")';
            $result= $this->FrontofficeModel->delete_data($tbl="lost_found_list", $where);

            if ($result) {
                echo "1";
            } else {
                echo "0";
            }
        }
		public function delete_expence()
		{
			$expense_id = $this->input->post('id');
			
			$wh = '(expense_id = "'.$expense_id.'")';

			$up = $this->FrontofficeModel->delete_data('expenses', $wh);

			if($up)
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}

	public function delete_notifications()
	{          
		  $id=$this->input->post('id');

		  $where = '(notification_id = "'.$id.'")';
		  $result= $this->FrontofficeModel->delete_data($tbl="notifications", $where);

		  if($result)
		  {
			echo "1";
		  }
		  else
		  { 
			echo "0";
		  }

	}
	public function delete_agents()
	{
		$agent_id = $this->input->post('id');
		
		$wh = '(id = "'.$agent_id.'")';

		$up = $this->FrontofficeModel->delete_data('agents', $wh);

		if($up)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	} 
	public function enquiry_acceptdata()
	{
		$wh = $this->input->post('id');
		$data = $this->MainModel->getenquirydata($tbl ='hotel_enquiry_request', $wh);
		echo json_encode($data);
	}   
	public function accept_enquiry_request()
	{
		$room_charges = $this->input->post('room_charges');
		$service_tax = $this->input->post('service_tax');
		$luxury_tax = $this->input->post('luxury_tax');

		$hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');
		
		// $admin_id = $this->session->userdata('admin_id');
		$u_id= $this->session->userdata('u_id');

		$where ='(u_id = "'.$u_id.'")';

		$admin_details = $this->MainModel->getData($tbl ='register', $where);

		$admin_id = $admin_details['hotel_id'];

		$u_id1 = $admin_details['u_id'];
	
		$user_data = $this->MainModel->get_user_data($admin_id);
		$admin_wallet_points = $user_data['wallet_points'];
		
		if($admin_wallet_points < 0  || $admin_wallet_points == 0)
		{
			
			$this->session->set_flashdata('msg','Your Wallet Amount is Less');
			redirect(base_url('enquiry_request'));
		}
		else
		{
			  $wh = '(hotel_enquiry_request_id = "'.$hotel_enquiry_request_id.'")';

			  $arr = array(
						  'request_status' => 1,
						  'accept_date' => date('Y-m-d'),
						  'room_charges' => $room_charges,
						  'service_tax' => $service_tax,
						  'luxury_tax' => $luxury_tax,
						  'request_accept_by' => 1,
						  'request_accept_by_u_id' => $admin_id,
						  );
						//   print_r($arr);exit;
			  $up = $this->FrontofficeModel->edit_data('hotel_enquiry_request',$wh,$arr);

			  if($up)
			  {
				  $user_data = $this->FrontofficeModel->get_user_data($admin_id);
				  	
				  $city_id = $user_data['city'];
				 
				  $admin_wallet_points = $user_data['wallet_points'];
					
				  $wh = '(city = "'.$city_id.'")';
				 
				  $lead_recharge_data = $this->FrontofficeModel->getData('leads_recharge',$wh);
				//   print_r($lead_recharge_data);exit;
				  $lead_percentage = $lead_recharge_data['lead_percentage'];

				  $cut_amount = $room_charges * ($lead_percentage / 100);

				  $current_wallet_amount = $admin_wallet_points - ($cut_amount);

				  $wh_u_id = '(u_id = "'.$admin_id.'")';

				  $arr_u_id = array(
									  'wallet_points' => $current_wallet_amount,
								  );
				  $this->FrontofficeModel->edit_data('register',$wh_u_id,$arr_u_id);

				  $arr_admin_history = array(
											  'hotel_admin_id' => $admin_id,
											  'amount' => $cut_amount,
											  'amount_status' => 2,
										  );
									  
				  $this->FrontofficeModel->insert_data('hotel_admin_wallet_history',$arr_admin_history);

				  
				  $this->session->set_flashdata('msg','Request accepted Successfully');
				  redirect(base_url('enquiry'));
			  }
			  else
			  {
				  $this->session->set_flashdata('msg','Something went wrong');
				  redirect(base_url('enquiry'));
			  }
		}
	
	}
	public function enquiry_asperlist()
	{
		$u_id= $this->session->userdata('u_id');

		$where ='(u_id = "'.$u_id.'")';

		$admin_details = $this->MainModel->getData($tbl ='register', $where);
			
		$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			
		$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);

		$hotel_id = $admin_details['hotel_id'];

		$id = $this->input->post('id');
		
		$data['data'] = $this->FrontofficeModel->get_enquiry_by_user($hotel_id,$id);
		echo json_encode($data);
		$this->load->view('frontoffice/ajaxenquiryrequest',$data);
		
	}
	public function assign_room_type()
	{
		$room_type = $this->input->post('status');
	   //  $room_type_name = $this->input->post('room_type_name');
		$hotel_enquiry_request_id  = $this->input->post('id');

		$wh1 = '(room_type_id  = "'.$room_type.'")';
		$room_type_name = $this->MainModel->getData($tbl='room_type',$wh1);
		
		$r_name=$room_type_name['room_type_name'];

		$wh = '(hotel_enquiry_request_id  = "'.$hotel_enquiry_request_id.'")';

		$arr = array(
						'room_type' => $room_type,
						'room_type_name' => $r_name
					);
		
		$update = $this->MainModel->edit_data('hotel_enquiry_request',$wh,$arr);

		if($update)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	public function newenquiryRequest()
	{
		$u_id= $this->session->userdata('u_id');

		$where ='(u_id = "'.$u_id.'")';

		$admin_details = $this->MainModel->getData($tbl ='register', $where);
			
		$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			
		$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);

		$hotel_id = $admin_details['hotel_id'];

		$enquiry_request["list"] = $this->FrontofficeModel->get_hotel_enquiry_request_pagination($hotel_id);
		// print_r($enquiry_request["list"]);exit;
		$this->load->view('frontoffice/ajaxnewrequestenquiry', $enquiry_request);
	}
	public function acceptenquiryRequest()
	{
		$u_id= $this->session->userdata('u_id');

			$where ='(u_id = "'.$u_id.'")';

			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			
			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);

			$hotel_id = $admin_details['hotel_id'];
			
		$enquiry_request["list"] = $this->FrontofficeModel->get_enquiry_accepted_by_user($hotel_id);
		$this->load->view('frontoffice/ajaxacceptrequestenquiry', $enquiry_request);
	}
	public function rejectenquiryRequest()
	{
		$u_id= $this->session->userdata('u_id');

			$where ='(u_id = "'.$u_id.'")';

			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			
			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);

			$hotel_id = $admin_details['hotel_id'];
			
		$enquiry_request["list"] = $this->FrontofficeModel->get_enquiry_rejected_by_user($hotel_id);
		$this->load->view('frontoffice/ajaxrejectenquiryRequest', $enquiry_request);
	}
	
	public function accept_enquiry_request1()
{
	$room_charges = $this->input->post('room_charges');
	$service_tax = $this->input->post('service_tax');
	$luxury_tax = $this->input->post('luxury_tax');

	$hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');
	
	$admin_id = $this->session->userdata('u_id');
  
	$user_data = $this->MainModel->get_user_data($admin_id);

	$admin_wallet_points = $user_data['wallet_points'];
  
	if($admin_wallet_points < 0  || $admin_wallet_points == 0)
	{
		// print_r($admin_wallet_points);exit;
		$this->session->set_flashdata('msg','Your Wallet Amount is Less');
		redirect(base_url('enquiry'));
	}
	else
	{
		  $wh = '(hotel_enquiry_request_id = "'.$hotel_enquiry_request_id.'")';

		  $arr = array(
					  'request_status' => 1,
					  'accept_date' => date('Y-m-d'),
					  'room_charges' => $room_charges,
					  'service_tax' => $service_tax,
					  'luxury_tax' => $luxury_tax,
					  'request_accept_by' => 1,
					  'request_accept_by_u_id' => $admin_id,
					  );
// print_r($arr);exit;
		  $up = $this->FrontofficeModel->edit_data('hotel_enquiry_request',$wh,$arr);

		  if($up)
		  {
			  $user_data = $this->MainModel->get_user_data($admin_id);

			  $city_id = $user_data['city'];

			  $admin_wallet_points = $user_data['wallet_points'];

			  $wh_1 = '(city = "'.$city_id.'")';

			  $lead_recharge_data = $this->MainModel->getData('leads_recharge',$wh_1);
			// print_r($lead_recharge_data);die;
			if(isset($lead_recharge_data['lead_percentage']))
			{
			    $lead_percentage = $lead_recharge_data['lead_percentage'];

			  $cut_amount = $room_charges * ($lead_percentage / 100);

			  $current_wallet_amount = $admin_wallet_points - ($cut_amount);
			}
			else
			{

			  $cut_amount = $room_charges ;

			  $current_wallet_amount = $admin_wallet_points - ($cut_amount);
			}
			  

			  $wh_u_id = '(u_id = "'.$admin_id.'")';

			  $arr_u_id = array(
								  'wallet_points' => $current_wallet_amount,
							  );

			  $this->FrontofficeModel->edit_data('register',$wh_u_id,$arr_u_id);

			  $arr_admin_history = array(
										  'hotel_admin_id' => $admin_id,
										  'amount' => $cut_amount,
										  'amount_status' => 2,
									  );

			  $this->FrontofficeModel->insert_data('hotel_admin_wallet_history',$arr_admin_history);

			  $this->session->set_flashdata('msg','Request accepted Successfully');
			  redirect(base_url('enquiry'));
		  }
		  else
		  {
			  $this->session->set_flashdata('msg','Something went wrong');
			  redirect(base_url('enquiry'));
		  }
	}

}

 public function check_visitor_otp()
 {
	 $visitor_id = $this->input->post('visitor_id');
	 $otp = $this->input->post('otp');
	 
	 $wh = '(visitor_id = "'.$visitor_id.'")';

	 $data = $this->MainModel->getData('visitor',$wh);

	 if($data['otp'] == $otp)
	 {
		 $arr = array(
					  'is_otp_verified' => 1,
					  'is_otp_correct' => 1,
					 );

		 $up = $this->FrontofficeModel->edit_data('visitor',$wh,$arr);

		 if($up)
		 {
			 $this->session->set_flashdata('msg','OTP verified Successfully');
			 redirect(base_url('visitors'));
		 }
		 else
		 {
			 $this->session->set_flashdata('msg','Something went wrong');
			 redirect(base_url('visitors'));
		 }
	 }
	 else
	 {
		 $arr = array(
						 'is_otp_verified' => 2,
						 'is_otp_correct' => 2,
					 );

		 $up = $this->FrontofficeModel->edit_data('visitor',$wh,$arr);

		 if($up)
		 {
			 $this->session->set_flashdata('msg','OTP is incorrect');
			 redirect(base_url('visitors'));
		 }
		 else
		 {
			 $this->session->set_flashdata('msg','Something went wrong');
			 redirect(base_url('visitors'));
		 }
	 }
 }

public function todayfrontArrival()
{
	$u_id = $this->session->userdata('u_id');
	$where ='(u_id = "'.$u_id.'")';
	$admin_details = $this->MainModel->getData($tbl ='register', $where);
	$admin_id = $admin_details['hotel_id'];

	$digitalcheck_in['list'] =$this->FrontofficeModel->get_user_pending_booking_list_from_app_pagination($admin_id);
	$digitalcheck_in['room_type_list'] = $this->FrontofficeModel->get_room_type_list($admin_id);
	$digitalcheck_in['today_hotel_book_list_by_app'] = $this->FrontofficeModel->get_user_pending_booking_list_from_app($admin_id);
	$digitalcheck_in['walking_guest_for_sign'] = $this->FrontofficeModel->get_user_pending_booking_list_from_app($admin_id);

   //  $this->load->view('include/header');
	$this->load->view('frontoffice/ajaxviewFrontaArrival', $digitalcheck_in);
		// $this->load->view('include/footer');
}
public function add_advance_payment()
{
	$booking_id = $this->input->post('booking_id');
	$u_id = $this->input->post('u_id');
	$description = $this->input->post('description');
	$total_amt = $this->input->post('total_amt');
	$amount = $this->input->post('amount');
	$payment_type = $this->input->post('payment_type');

	$user_checkout_data_id = $this->input->post('user_checkout_data_id');
	
	// $admin_id = $this->session->userdata('admin_id');
	$u_id1= $this->session->userdata('front_id');
	$where ='(u_id = "'.$u_id1.'")';
	$admin_details = $this->MainModel->getData($tbl ='register', $where);
	
	$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
	$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
	$admin_id = $admin_details['hotel_id'];
	
	$wh = '(user_checkout_data_id = "'.$user_checkout_data_id.'")';

	$user_checkout_data = $this->MainModel->getData('user_checkout_data',$wh);

	if($amount > $total_amt)
	{
		$this->session->set_flashdata('msg','Enter valid Number');
		redirect(base_url('FrontofficeController/checkout_view/' . $booking_id.'/'.$u_id));
	}
	else
	{
		if($user_checkout_data['remaing_amt'] == 0)
		{
			$remaing_amt = $user_checkout_data['total_bill'] - $amount;
		}
		else
		{
			$remaing_amt = $user_checkout_data['remaing_amt'] - $amount;
		}

		$arr = array(
						'advance_payment' => $user_checkout_data['advance_payment'] + $amount,
						'advance_pay_type' => $payment_type,
						'advance_pay_date' => date('Y-m-d'),
						'remaing_amt' => $remaing_amt,
						'is_paid_advance_payment' => 1,
					);
	  
		$up = $this->FrontofficeModel->edit_data('user_checkout_data',$wh,$arr);

		if($up)
		{ 
			redirect(base_url('FrontofficeController/checkout_view/' . $booking_id.'/'.$u_id));    
		}
	}
}
public function add_minibar_amt()
{
	$minibar = $this->input->post('minibar');

	$qty = $this->input->post('qty');

	$wh = '(r_s_min_bar_id = "'.$minibar.'")';

	$room_servs_mini_bar =  $this->MainModel->getData('room_servs_mini_bar',$wh);

	$output = '';

	$output .= $room_servs_mini_bar['price'] * $qty;
	
	echo $output;
}

public function add_minbar_in_checkout()
{
	$booking_id = $this->input->post('booking_id');
	$u_id = $this->input->post('u_id');
	$description = $this->input->post('description');
	$date = $this->input->post('date');
	$amount = $this->input->post('amount');

	$user_checkout_data_id = $this->input->post('user_checkout_data_id');
	
 //    $admin_id = $this->session->userdata('admin_id');
		 $u_id1= $this->session->userdata('u_id');
		 $where ='(u_id = "'.$u_id1.'")';
		 $admin_details = $this->MainModel->getData($tbl ='register', $where);
		 
		 $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
		 $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
		 $admin_id = $admin_details['hotel_id'];
	
	$booking_details = $this->MainModel->get_user_booking_details($admin_id,$booking_id);
	
	$wh = '(user_checkout_data_id = "'.$user_checkout_data_id.'")';

	$user_checkout_data = $this->MainModel->getData('user_checkout_data',$wh);

	$wh1 = '(booking_id = "'.$booking_id.'")';

	$arr = array(
				 'total_bill' => $user_checkout_data['total_bill'] + $amount,
				);

	$up = $this->FrontofficeModel->edit_data('user_checkout_data',$wh,$arr);
	
	if($up)
	{
		$wh_11 = '(user_checkout_data_id = "'.$user_checkout_data_id.'" AND hotel_id = "'.$admin_id.'" AND description = "'.$description.'")';

		$user_checkout_details = $this->MainModel->getData('user_checkout_details',$wh_11);

		if($user_checkout_details)
		{
			$arr_11  = array(
							'date' => $date,
							'amount' => $amount
							);

			$up_check_details = $this->FrontofficeModel->edit_data('user_checkout_details',$wh_11,$arr_11);

			if($up_check_details)
			{
				$wh_1 = '(description_name = "'.$description.'" AND user_checkout_data_id = "'.$user_checkout_data_id.'")';

				$user_checkout_sub_total_data = $this->MainModel->getData('user_checkout_sub_total',$wh_1);

				if($user_checkout_sub_total_data)
				{
					$arr_sub = array(
									'sub_total' => $user_checkout_sub_total_data['sub_total'] + $amount
								);

					$this->FrontofficeModel->edit_data('user_checkout_sub_total',$wh_1,$arr_sub);
				}
			}
		}
		else
		{
			for($i = 0;$i < 7; $i++)
			{ 
				if(date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days')) == $date)
				{
					$date1 = $date;
					$amount1 = $amount;
				}
				else
				{
					$date1 = date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days'));
					$amount1 = 0;
				}

				$arr1 = array(
							'hotel_id' => $admin_id,
							'user_checkout_data_id' => $user_checkout_data_id,
							'description' => $description,
							'date' => $date1,
							'amount' => $amount1
							);

				$add_check_details = $this->FrontofficeModel->insert_data('user_checkout_details',$arr1);

				if($add_check_details)
				{ 
					$wh1 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$user_checkout_data_id.'" AND description_name = "'.$description.'")';

					$user_checkout_sub_total = $this->FrontofficeModel->getData('user_checkout_sub_total',$wh1);
					
					//add subtotal
					if($user_checkout_sub_total)
					{
						$st_arr1 = array(
										'sub_total' => $user_checkout_sub_total['sub_total'] + $amount1
										);

						$this->FrontofficeModel->edit_data('user_checkout_sub_total',$wh1,$st_arr1);
					}
					else
					{
						//edit subtotal
						$st_arr2 = array(
									'hotel_id' => $admin_id,
									'user_checkout_data_id' => $user_checkout_data_id,
									'description_name' => $description,
									'sub_total' => $amount1
									);

						$this->FrontofficeModel->insert_data('user_checkout_sub_total',$st_arr2);
					}
				}
			}
		}
		redirect(base_url('FrontofficeController/checkout_view/' . $booking_id.'/'.$u_id));    
	}
}
 //onchange function minibar amount 
public function checkout_view()
        {
            if($this->session->userdata('u_id'))
            {
                $u_id = $this->session->userdata('u_id');
                $where ='(u_id = "'.$u_id.'")';
                $admin_details = $this->MainModel->getData($tbl ='register', $where);
                $admin_id = $admin_details['hotel_id'];
                
                $booking_id = $this->uri->segment(3);
    
                $u_id = $this->uri->segment(4);
    
                $check_out_view['admin_data'] = $this->FrontofficeModel->get_user_data($admin_id);
    
                $check_out_view['user_data'] = $this->FrontofficeModel->get_user_data($u_id);
    
                $check_out_view['booking_details'] = $this->FrontofficeModel->get_user_booking_details($admin_id,$booking_id);
    // print_r($check_out_view['booking_details']);exit;
                $check_out_view['booking_checkout_data'] = $this->FrontofficeModel->get_user_checkout_booking_data($admin_id,$booking_id,$u_id);
    
                $check_out_view['booking_room_details'] = $this->FrontofficeModel->get_booking_room_details($booking_id);
                
                $check_out_view['minibar_list'] = $this->FrontofficeModel->get_room_service_minibar($admin_id);
    $this->load->view('include/header');
                $this->load->view('frontoffice/checkout_view',$check_out_view);
    $this->load->view('include/footer');
    
            }
            else
            {
                redirect(base_url());
            }
        }
    
      
public function checkout_bill()
        {
            $booking_id = $this->input->post('booking_id');
            $u_id = $this->input->post('u_id');
            $is_today_charge = $this->input->post('is_today_charge');
            $amount = $this->input->post('amount');

            $user_checkout_data_id = $this->input->post('user_checkout_data_id');
            
			// $admin_id = $this->session->userdata('admin_id');
            $u_id11= $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id11.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
			$admin_id = $admin_details['hotel_id'];
          
            
            $wh = '(user_checkout_data_id = "'.$user_checkout_data_id.'")';

            $wh1 = '(booking_id = "'.$booking_id.'")';

            $user_hotel_booking = $this->MainModel->getData('user_hotel_booking',$wh1);

            $user_checkout_data = $this->MainModel->getData('user_checkout_data',$wh);

            $check_in = $user_hotel_booking['check_in'];

            if($check_in == date('Y-m-d') && $is_today_charge == 1)
            {
                $arr_ch = array(
                                'paid_date' => date('Y-m-d'),
                                'is_paid' => 1,
                                'total_bill' => $amount,
                                'is_today_charge' => 1,
                                'todays_charges' => $amount,
                                );
                 
                $up_ch = $this->FrontofficeModel->edit_data('user_checkout_data',$wh,$arr_ch);

                if($up_ch)
                {
                    $del = $this->FrontofficeModel->delete_data('user_checkout_details',$wh);

                    $del = $this->FrontofficeModel->delete_data('user_checkout_sub_total',$wh);

                    if($del)
                    {
                        $arr_ch_d = array(
                                          'user_checkout_data_id' => $user_checkout_data_id,
                                          'hotel_id' => $admin_id,
                                          'description' => "Room Charges",
                                          'date' => date('Y-m-d'),
                                          'amount' => $amount
                                        );
                        
                        $add_chk_details = $this->FrontofficeModel->insert_data('user_checkout_details',$arr_ch_d);
                        
                        if($add_chk_details)
                        {
                            $arr_ch_d_sub = array(
                                            'user_checkout_data_id' => $user_checkout_data_id,
                                            'hotel_id' => $admin_id,
                                            'description_name' => "Room Charges",
                                            'sub_total' => $amount
                                            );
                            
                            $this->FrontofficeModel->insert_data('user_checkout_sub_total',$arr_ch_d_sub);
                        }
                    }

                    $arr_ck_1 = array(
                                    'booking_status' => 2,
                                    'actual_checkout' => date('Y-m-d'),
                                    );

                    $chk_1 = $this->FrontofficeModel->edit_data('user_hotel_booking',$wh1,$arr_ck_1);

                    if($chk_1)
                    {
                        //guest user status change
                        $wh_gu_1 = '(u_id = "'.$u_id.'" AND hotel_id = "'.$admin_id.'" AND booking_id = "'.$booking_id.'")';
                        
                        $arr_gu_1 = array(
                                        'is_guest' => 2
                                    );

                        $this->FrontofficeModel->edit_data('guest_user',$wh_gu_1,$arr_gu_1);

                        //room status change
                        
                        $booking_details_1 = $this->MainModel->getAllData('user_hotel_booking_details',$wh1);
// print_r($booking_details_1);exit;
                        if($booking_details_1)
                        {
                            foreach ($booking_details_1 as $bk_1) 
                            {
                                $wh_rm_s_1 = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$bk_1['room_no'].'")';

                                $arr_bk_1 = array(
                                                'room_status' => 1
                                                );

                                $this->FrontofficeModel->edit_data('room_status',$wh_rm_s_1,$arr_bk_1);

                            }
                        }

                        //change checkout status for all order
                        $arr_chng_chk_1 = array(
                                            'is_paid_after_check_out' => 1
                                            );

                        $arr_v_wash_1 = array(
                                            'is_paid_checkout' => 1
                                            );
                        $this->FrontofficeModel->edit_data('cloth_orders',$wh_gu_1,$arr_chng_chk_1);

                        $this->FrontofficeModel->edit_data('food_orders',$wh_gu_1,$arr_chng_chk_1);

                        $this->FrontofficeModel->edit_data('rmservice_services_orders',$wh_gu_1,$arr_chng_chk_1);

                        $this->FrontofficeModel->edit_data('room_service_menu_orders',$wh_gu_1,$arr_chng_chk_1);

                        $this->FrontofficeModel->edit_data('house_keeping_orders',$wh_gu_1,$arr_chng_chk_1);

                        $this->FrontofficeModel->edit_data('vehicle_wash_request',$wh_gu_1,$arr_v_wash_1);

                        $this->FrontofficeModel->edit_data('expenses',$wh_gu_1,$arr_chng_chk_1);

                        $this->FrontofficeModel->edit_data('luggage_request',$wh_gu_1,$arr_chng_chk_1);

                    }  
                    redirect(base_url('FrontofficeController/checkout_view/' . $booking_id.'/'.$u_id));   
                }
            }
            else
            {
                if($is_today_charge == 1)
                {
                    $total = $user_checkout_data['total_bill'] + $amount;
                    $is_today_charge = 1;
                    $todays_charges = $amount;
                }
                else
                {
                    $total = $user_checkout_data['total_bill'];
                    $is_today_charge = 0;
                    $todays_charges = 0;
                }

                $arr = array(
                            //  'payment_type' => $payment_type,
                            'paid_date' => date('Y-m-d'),
                            'is_paid' => 1,
                            'total_bill' => $total,
                            'is_today_charge' => $is_today_charge,
                            'todays_charges' => $todays_charges
                            );

                $up = $this->FrontofficeModel->edit_data('user_checkout_data',$wh,$arr);
                
                if($up)
                {
                    $arr1 = array(
                                    'booking_status' => 2,
                                    'actual_checkout' => date('Y-m-d'),
                                );

                    $chk = $this->FrontofficeModel->edit_data('user_hotel_booking',$wh1,$arr1);

                    if($chk)
                    {
                        //guest user status change
                        $wh_gu = '(u_id = "'.$u_id.'" AND hotel_id = "'.$admin_id.'" AND booking_id = "'.$booking_id.'")';
                        
                        $arr_gu = array(
                                        'is_guest' => 2
                                    );

                        $this->FrontofficeModel->edit_data('guest_user',$wh_gu,$arr_gu);

                        //room status change
                        
                        $booking_details = $this->MainModel->getAllData('user_hotel_booking_details',$wh1);

                        if($booking_details)
                        {
                            foreach ($booking_details as $bk) 
                            {
                                $wh_rm_s = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$bk['room_no'].'")';

                                $arr_bk = array(
                                                'room_status' => 1
                                                );

                                $this->FrontofficeModel->edit_data('room_status',$wh_rm_s,$arr_bk);

                            }
                        }

                        //change checkout status for all order
                        $arr_chng_chk = array(
                                            'is_paid_after_check_out' => 1
                                            );

                        $arr_v_wash = array(
                                            'is_paid_checkout' => 1
                                            );
                        $this->FrontofficeModel->edit_data('cloth_orders',$wh_gu,$arr_chng_chk);

                        $this->FrontofficeModel->edit_data('food_orders',$wh_gu,$arr_chng_chk);

                        $this->FrontofficeModel->edit_data('rmservice_services_orders',$wh_gu,$arr_chng_chk);

                        $this->FrontofficeModel->edit_data('room_service_menu_orders',$wh_gu,$arr_chng_chk);

                        $this->FrontofficeModel->edit_data('house_keeping_orders',$wh_gu,$arr_chng_chk);

                        $this->FrontofficeModel->edit_data('vehicle_wash_request',$wh_gu,$arr_v_wash);

                        $this->FrontofficeModel->edit_data('expenses',$wh_gu,$arr_chng_chk);

                        $this->FrontofficeModel->edit_data('luggage_request',$wh_gu,$arr_chng_chk);

                        redirect(base_url('FrontofficeController/checkout_view/' . $booking_id.'/'.$u_id));    

                    }
                }
            }
        }
 //add additional charges
 public function additional_amount_in_checkout()
 {
	 $booking_id = $this->input->post('booking_id');
	 $u_id = $this->input->post('u_id');
	 $description = $this->input->post('description');
	 $date = $this->input->post('date');
	 $amount = $this->input->post('amount');

	 $user_checkout_data_id = $this->input->post('user_checkout_data_id');
	 
   //   $admin_id = $this->session->userdata('admin_id');
   $u_id11= $this->session->userdata('u_id');
   $where ='(u_id = "'.$u_id11.'")';
   $admin_details = $this->MainModel->getData($tbl ='register', $where);
   
   $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
   $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
   $admin_id = $admin_details['hotel_id'];
	 
	 $booking_details = $this->FrontofficeModel->get_user_booking_details($admin_id,$booking_id);
	 
	 $wh = '(user_checkout_data_id = "'.$user_checkout_data_id.'")';

	 $user_checkout_data = $this->MainModel->getData('user_checkout_data',$wh);

	 $wh1 = '(booking_id = "'.$booking_id.'")';

	 $arr = array(
				  'total_bill' => $user_checkout_data['total_bill'] + $amount,
				 );

	 $up = $this->FrontofficeModel->edit_data('user_checkout_data',$wh,$arr);
	 
	 if($up)
	 {
		 $wh_11 = '(user_checkout_data_id = "'.$user_checkout_data_id.'" AND hotel_id = "'.$admin_id.'" AND description = "'.$description.'")';

		 $user_checkout_details = $this->MainModel->getData('user_checkout_details',$wh_11);

		 if($user_checkout_details)
		 {
			 $arr_11  = array(
							 'date' => $date,
							 'amount' => $amount
							 );

			 $up_check_details = $this->FrontofficeModel->edit_data('user_checkout_details',$wh_11,$arr_11);

			 if($up_check_details)
			 {
				 $wh_1 = '(description_name = "'.$description.'" AND user_checkout_data_id = "'.$user_checkout_data_id.'")';

				 $user_checkout_sub_total_data = $this->MainModel->getData('user_checkout_sub_total',$wh_1);

				 if($user_checkout_sub_total_data)
				 {
					 $arr_sub = array(
									 'sub_total' => $user_checkout_sub_total_data['sub_total'] + $amount
								 );

					 $this->FrontofficeModel->edit_data('user_checkout_sub_total',$wh_1,$arr_sub);
				 }
			 }
		 }
		 else
		 {
			 for($i = 0;$i < 7; $i++)
			 { 
				 if(date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days')) == $date)
				 {
					 $date1 = $date;
					 $amount1 = $amount;
				 }
				 else
				 {
					 $date1 = date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days'));
					 $amount1 = 0;
				 }

				 $arr1 = array(
							 'hotel_id' => $admin_id,
							 'user_checkout_data_id' => $user_checkout_data_id,
							 'description' => $description,
							 'date' => $date1,
							 'amount' => $amount1
							 );

				 $add_check_details = $this->FrontofficeModel->insert_data('user_checkout_details',$arr1);

				 if($add_check_details)
				 { 
					 $wh1 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$user_checkout_data_id.'" AND description_name = "'.$description.'")';

					 $user_checkout_sub_total = $this->MainModel->getData('user_checkout_sub_total',$wh1);
					 
					 //add subtotal
					 if($user_checkout_sub_total)
					 {
						 $st_arr1 = array(
										 'sub_total' => $user_checkout_sub_total['sub_total'] + $amount1
										 );

						 $this->FrontofficeModel->edit_data('user_checkout_sub_total',$wh1,$st_arr1);
					 }
					 else
					 {
						 //edit subtotal
						 $st_arr2 = array(
									 'hotel_id' => $admin_id,
									 'user_checkout_data_id' => $user_checkout_data_id,
									 'description_name' => $description,
									 'sub_total' => $amount1
									 );

						 $this->FrontofficeModel->insert_data('user_checkout_sub_total',$st_arr2);
					 }
				 }
			 }
		 }
		 redirect(base_url('FrontofficeController/checkout_view/' . $booking_id.'/'.$u_id));    
	 }
 }
public function upcomingfrontaArrival()
{
	$u_id = $this->session->userdata('u_id');
	$where ='(u_id = "'.$u_id.'")';
	$admin_details = $this->MainModel->getData($tbl ='register', $where);
	$admin_id = $admin_details['hotel_id'];
	$digitalcheck_in['list'] =$this->FrontofficeModel->get_user_upcoming_booking_list_from_app_pagination($admin_id);

	$digitalcheck_in['room_type_list'] = $this->FrontofficeModel->get_room_type_list($admin_id);

	$digitalcheck_in['today_hotel_book_list_by_app'] = $this->FrontofficeModel->get_upcoming_list_from_app($admin_id);
			
	$digitalcheck_in['walking_guest_for_sign'] = $this->FrontofficeModel->get_upcoming_list_from_app($admin_id);
	$this->load->view('frontoffice/ajaxviewupcomingFrontaArrival', $digitalcheck_in);
}

public function acceptrequest()
{
	$u_id= $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
			$admin_id = $admin_details['hotel_id'];

	$business_center_reservation["list"] = $this->FrontofficeModel->get_business_center_list_pagination($admin_id);
// print_r($business_center_reservation["list"]);exit;
	$business_center_reservation['business_center'] = $this->FrontofficeModel->get_active_business_center($admin_id);
	// echo "<pre>"; print_r($business_center_reservation['list']); echo "</pre>";die;
	$this->load->view('frontoffice/ajaxbusiness_reser',$business_center_reservation);
}
public function rejectrequest()
{
	$u_id= $this->session->userdata('u_id');
	$where ='(u_id = "'.$u_id.'")';
	$admin_details = $this->MainModel->getData($tbl ='register', $where);
			
	$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
	$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
	$admin_id = $admin_details['hotel_id'];
	$business_center_reservation["list"] = $this->FrontofficeModel->get_business_center_list_reject_pagination($admin_id);

	$business_center_reservation['business_center'] = $this->FrontofficeModel->get_active_business_center($admin_id);
	$this->load->view('frontoffice/ajax_rejectrequest',$business_center_reservation);

} 
	public function inhouse_guest(){
	$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$guest_mng['list'] = $this->FrontofficeModel->get_guest_list($admin_id);
		$guest_mng['room_type'] = $this->FrontofficeModel->get_room_type_list1($admin_id);
		$guest_mng['availble_rooms'] = $this->FrontofficeModel->get_room_no_list($admin_id);
		
		$this->load->view('frontoffice/ajaxinhouse_guset',$guest_mng);	
	}
		public function departed_guest()
		{ 
			$u_id = $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			$admin_id = $admin_details['hotel_id'];

			$departed_guest['list'] = $this->FrontofficeModel->get_departure_guest_list_pagination($admin_id);
			// print_r($departed_guest['list']);exit;
			$this->load->view('frontoffice/ajaxviewDepartedGuest',$departed_guest);

		}

	public function pendinghandover()
		{
			  //  Start :: datatable code 
			  $draw = $this->input->post('draw');
			  $row = $this->input->post('start');
			  $rowperpage = $this->input->post('length');
			  $search_array = $this->input->post('search');
			  $search = !empty($search_array['value']) ? $search_array['value'] : '';
			  // $order_by = $this->input->post('order');
			  $by_columns = $this->input->post('columns');
			  // print_r($pending_handover);exit;
			  $columnName = $by_columns[0]['data'];
			$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];

		$pending_handover= $this->FrontofficeModel->get_manager_handover_list_pagination($rowperpage, $row, $search,$columnName,$admin_id);
		// print_r($pending_handover);exit;
		foreach($pending_handover AS $val)
        {
            $wh = '(u_id = "'.$val['create_manager_id'].'")';
            $get = $this->MainModel->getData('register',$wh);
            if(!empty($get))
            {
                $name = $get['full_name'];
  
                }
                    else
             {
            $name = "-";
            }
        }
		$total_completed_hendovers = $this->FrontofficeModel->getTotalcompletedhanover($admin_id);
        $totalRecords = $total_completed_hendovers->total_record;

        $data = array();
        $i=1;
        foreach($pending_handover AS $val)
        {
            $date = $val['date'];
            $time = date('h:i A', strtotime($val['time']));
            $date_time = $date."   ".$time;

            $discription = '<a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter_'.$val['m_handover_id'].'"><i class="fa fa-eye"></i></a>';

            $status = '<a class="badge badge-danger description_status_modal" data-pk-id="'.$val['m_handover_id'].'">
            Pending </a>';
            // echo "<pre>";
            // print_r($val);
            $data[] = array(
                "sr_no"            => $i++,
                "name_created_by"    => $name,
                "date"   => $date,
				"time"   => $time,
                // "name_completed_by"   => $val['completed_By'],
                "description"=> $discription,
                "status"        => $status,
            );
        }
        // print_r($data);exit;

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );

        echo json_encode($response);
		// $this->load->view('frontoffice/ajax_pendinghandover',$data);
		
		}
		public function completehandover()
		{
			$draw = $this->input->post('draw');
			$row = $this->input->post('start');
			$rowperpage = $this->input->post('length');
			$search_array = $this->input->post('search');
			$search = !empty($search_array['value']) ? $search_array['value'] : '';
			// $order_by = $this->input->post('order');
			$by_columns = $this->input->post('columns');
			// print_r($pending_handover);exit;
			$columnName = $by_columns[0]['data'];
		  $u_id = $this->session->userdata('u_id');
	  $where ='(u_id = "'.$u_id.'")';
	  $admin_details = $this->MainModel->getData($tbl ='register', $where);
	  $admin_id = $admin_details['hotel_id'];
	  $is_complete2 = 1;
	  $pending_handover= $this->FrontofficeModel->get_manager_handover_completed_list_pagination($rowperpage, $row, $search,$columnName,$admin_id, $is_complete2);
	//   print_r($pending_handover);exit;
	  foreach($pending_handover as $row){
		//created user name
   $wh ='(u_id="'.$row['create_manager_id'].'")';
   $user_d = $this->MainModel->getData($tbl='register',$wh);  
   //print_r($user_d);                                                       
   if(!empty($user_d))
   {
	   $uname = $user_d['full_name'];                                                  
   }
   else
   {
	   $uname ='';
   }
   //created user date & time
   $wh1 ='(create_manager_id="'.$user_d['u_id'].'" )';
   $user_d1 = $this->MainModel->getData($tbl='handover_manger',$wh1);                                                         
   if(!empty($user_d1))
   {
	   $date = $user_d1['date'];
	   $time = date('h:i A', strtotime($user_d1['time']));
   }
   else
   {
	   $date = '';
	   $time = '';
   }

   //completed user name
   $wh2 ='(u_id="'.$row['completed_manger_id'].'")';
   $user_com = $this->MainModel->getData($tbl='register',$wh2);  
//    print_r($user_com);                                                       
   if(!empty($user_com))
   {
	   $c_uname = $user_com['full_name'];                                                  
   }
   else
   {
	   $c_uname ='';
   }}
	//   print_r($c_uname); 
	  $total_completed_hendovers = $this->FrontofficeModel->getTotalcompletedhanover_1($admin_id);
	  $totalRecords = $total_completed_hendovers->total_record;

	  $data = array();
	  $i=1;
	  foreach($pending_handover AS $val)
	  {
		  $date = $val['date'];
		  $time = date('h:i A', strtotime($val['time']));
		  $date_time = $date."   ".$time;

		  $discription = '<a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter_'.$val['m_handover_id'].'"><i class="fa fa-eye"></i></a>';

		  $status = ($val['is_complete'] == 1) ? '<a href="javascript:void(0)" class="badge badge-rounded badge-outline-success">complete</a>' : '';
		  // echo "<pre>";
		  // print_r($val);
		  $data[] = array(
			  "sr_no"            => $i++,
			  "name_created_by"    => $uname,
			  "date"   => $date,
			  "time"   => $time,
			  "name_completed_by"   => $c_uname,
			  "description"=> $discription,
			  "status"        => $status,
		  );
	  }
	//   print_r($data);exit;

	  ## Response
	  $response = array(
		  "draw" => intval($draw),
		  "iTotalRecords" => $totalRecords,
		  "iTotalDisplayRecords" => $totalRecords,
		  "aaData" => $data
	  );

	  echo json_encode($response);
	  // $this->load->view('frontoffice/ajax_pendinghandover',$data);
		}
		public function dicription_modal_status_chang()
		{
			$id = $this->input->post('id');
			$u_id = $this->session->userdata('u_id');
			$where = '(u_id = "' . $u_id . '")';
			$admin_details = $this->MainModel->getData($tbl = 'register', $where);
			$hotel_id = $admin_details['hotel_id'];
			$data["list"] = $this->FrontofficeModel->get_pending_handover_modal_list($hotel_id,$id);
			
			$this->load->view('frontoffice/ajaxpending_status_form', $data);
		}
		public function dicription_modal_data()
		{
			$id = $this->input->post('id');
			$uname = $this->input->post('uname');
	
			$u_id = $this->session->userdata('u_id');
			$where = '(u_id = "' . $u_id . '")';
			$admin_details = $this->MainModel->getData($tbl = 'register', $where);
			$hotel_id = $admin_details['hotel_id'];
			$data["list"] = $this->FrontofficeModel->get_pending_handover_modal_list($hotel_id,$id);
			$data['uname'] = $uname;
			
			$this->load->view('frontoffice/ajaxpending_discr_modal', $data);
			
		}
}