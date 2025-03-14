<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		 $this->load->model('MainModel');
		  $this->load->model('FrontofficeModel');
		  $this->load->model('HotelAdminModel');
		  $this->load->model('HouseKeepingModel');
		  $this->load->model('FoodAdminModel');
		  $this->load->model('SuperAdminModel', 'SuperAdmin');
		  $this->load->helper('notification_helper');
		  $this->load->helper('array');

		 if(empty($this->session->userdata('u_id'))){
		 	redirect('/');
		 }
		// $this->load->library('pagination');   
	}

	public function index()
	{   
		$userType = $this->session->userdata('userType');
		// echo "<pre>";
		// print_r($userType);
		// exit;
		// housekeeping
		if($userType == 5){

			if($this->session->userdata('u_id'))
			{
				$admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
				$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
				$hotel_id = $get_hotel_id['hotel_id']; 

				$order_status = 4;
				$front_dashboard['offer_list'] = $this->HouseKeepingModel->get_offer_list($admin_id,$order_status);
			 
				  $time1 = "00:00:00";
				$time2 = "03:00:00";
				$time3 = "06:00:00";
				$time4 = "09:00:00";
				$time5 = "12:00:00";
				$time6 = "15:00:00";
				$time7 = "18:00:00";
				$time8 = "21:00:00";
				$time9 = "24:00:00";
	
				//room clean status
				$front_dashboard['first_hrs_room_clean_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart($hotel_id,$time1,$time2);
				$front_dashboard['second_hrs_room_clean_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart($hotel_id,$time2,$time3);
				$front_dashboard['third_hrs_room_clean_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart($hotel_id,$time3,$time4);
				$front_dashboard['forth_hrs_room_clean_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart($hotel_id,$time4,$time5);
				$front_dashboard['fifth_hrs_room_clean_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart($hotel_id,$time5,$time6);
				$front_dashboard['sixth_hrs_room_clean_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart($hotel_id,$time6,$time7);
				$front_dashboard['seventh_hrs_room_clean_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart($hotel_id,$time7,$time8);
				$front_dashboard['eighth_hrs_room_clean_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart($hotel_id,$time8,$time9);
	
				//room dirty status
				$front_dashboard['first_hrs_room_dirty_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart1($hotel_id,$time1,$time2);
				$front_dashboard['second_hrs_room_dirty_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart1($hotel_id,$time2,$time3);
				$front_dashboard['third_hrs_room_dirty_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart1($hotel_id,$time3,$time4);
				$front_dashboard['forth_hrs_room_dirty_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart1($hotel_id,$time4,$time5);
				$front_dashboard['fifth_hrs_room_dirty_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart1($hotel_id,$time5,$time6);
				$front_dashboard['sixth_hrs_room_dirty_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart1($hotel_id,$time6,$time7);
				$front_dashboard['seventh_hrs_room_dirty_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart1($hotel_id,$time7,$time8);
				$front_dashboard['eighth_hrs_room_dirty_status'] = $this->HouseKeepingModel->get_hotel_rooms_status_bar_chart1($hotel_id,$time8,$time9);
			  
				$front_dashboard['total_expected_current_booking'] = $this->HouseKeepingModel->get_hotel_expected_current_booking($hotel_id);
				//echo "<pre>";
				//print_r($front_dashboard['total_expected_current_booking']);
				$front_dashboard['get_hotel_expected_departed_booking'] = $this->HouseKeepingModel->get_hotel_expected_current_booking($admin_id);
			  
			  	$this->load->view('include/header');
				$this->load->view('page/housekeepingdashboard1',$front_dashboard);
				$this->load->view('include/footer');

			}
			else
			{
				$this->load->view('pages/Login_page');
			} 
		}
        // print_r($userType);die;
		// food & Breverage
		if($userType == 7){
			//   //get dashboard data
            // $u_id= 2;
		    // // print_r($u_id);die;
			// $where ='(u_id = "'.$u_id.'")';
			// $admin_details = $this->FrontofficeModel->getData($tbl ='register', $where);
			
			// $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			// $get_hotel_name = $this->FrontofficeModel->getData($tbl ='register', $wh);
			// // print_r($admin_details);die;
			// 	$admin_id = $admin_details['hotel_id'];
			// 	$u_id11 = $admin_details['u_id'];

			// $room_status1 = 3; //available
			// $room_status2 = 2; //accupied
			// $room_status3 = 1; //dirty
			// $room_status4 = 4; //under maintainance

			// $booking_status1 = 1; //current booking

			// $booking_status2 = 0; //expected arrived booking

			// $booking_status3 = 2; //expected daparted
          
            // $front_dashboard['total_rooms'] = $this->FrontofficeModel->get_total_room_count11($admin_id);
          

			// $front_dashboard['total_availble_rooms'] = $this->FrontofficeModel->get_hotel_rooms_status($admin_id,$room_status1);

			// $front_dashboard['total_accupied_rooms'] = $this->FrontofficeModel->get_hotel_rooms_status($admin_id,$room_status2);
			
			// $front_dashboard['total_dirty_rooms'] = $this->FrontofficeModel->get_hotel_rooms_status($admin_id,$room_status3);
			
			// $front_dashboard['total_undermaintance_rooms'] = $this->FrontofficeModel->get_hotel_rooms_status($admin_id,$room_status4);
			
			// $front_dashboard['total_current_booking'] = $this->FrontofficeModel->get_hotel_user_booking($admin_id,$booking_status1);

			// $front_dashboard['total_pending_booking'] = $this->FrontofficeModel->get_hotel_user_booking($admin_id,$booking_status2);
			
			// $front_dashboard['total_daparted_booking'] = $this->FrontofficeModel->get_hotel_user_booking($admin_id,$booking_status3);
			
			// $front_dashboard['total_CHG_guest'] = $this->FrontofficeModel->get_hotel_chg_guest($admin_id);
			
			// $front_dashboard['get_front_ofs_notifications'] = $this->FrontofficeModel->get_notifications_for_front_ofs($admin_id);
			
			// $front_dashboard['total_expected_current_booking'] = $this->FrontofficeModel->get_hotel_expected_current_booking($admin_id);

			// $front_dashboard['get_hotel_expected_departed_booking'] = $this->FrontofficeModel->get_hotel_expected_current_booking($admin_id);
			
			// $front_dashboard['get_hotel_expected_CHG_guest'] = $this->FrontofficeModel->get_hotel_guest_list($admin_id);
			
			// $front_dashboard['floor_list'] = $this->FrontofficeModel->get_floor_list($admin_id);

			// $front_dashboard['total_business_center'] = $this->FrontofficeModel->get_active_business_center($admin_id);

			// $front_dashboard['total_reserve_business_center'] = $this->FrontofficeModel->get_reservation_bc($admin_id);

			// $front_dashboard['total_b_h'] = $this->FrontofficeModel->banquet_hall($admin_id);

			// $front_dashboard['total_reserve_bh'] = $this->FrontofficeModel->get_reservation_bh($admin_id);

			// $front_dashboard['hotels_booking_data'] = $this->FrontofficeModel->get_hotel_peoples($admin_id);

			// $order_status = 1;

			// $front_dashboard['room_service_list'] = $this->FrontofficeModel->get_room_service_services_order($admin_id,$order_status);

			// $front_dashboard['room_service_menu_list'] = $this->FrontofficeModel->get_room_service_menu_order($admin_id,$order_status);

			// $front_dashboard['hk_service_list'] = $this->FrontofficeModel->get_house_keeping_service_order($admin_id,$order_status);

			// $front_dashboard['laundry_list'] = $this->FrontofficeModel->get_laundry_order($admin_id,$order_status);

			// $front_dashboard['food_list'] = $this->FrontofficeModel->get_food_order($admin_id,$order_status);

			// $front_dashboard['offer_list'] = $this->FrontofficeModel->get_offer_list($admin_id,$order_status);

			// $front_dashboard['today_check_in_check_out'] = $this->FrontofficeModel->get_today_booking_data($admin_id);
		    
		    
            $admin_id = $this->session->userdata('u_id');
          	 //pending orders
			$time1 = "00:00:00";
			$time2 = "04:00:00";

			$time3 = "04:00:00";
			$time4 = "08:00:00";

			$time5 = "08:00:00";
			$time6 = "12:00:00";

			$time7 = "12:00:00";
			$time8 = "16:00:00";

			$time9 = "16:00:00";
			$time10 = "20:00:00";

			$time11 = "20:00:00";
			$time12 = "24:00:00";

			$food_dashboard['first_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time1,$time2);
			
			$food_dashboard['second_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time3,$time4);
	
			$food_dashboard['third_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time5,$time6);
	
			$food_dashboard['forth_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time7,$time8);
			
			$food_dashboard['fifth_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time9,$time10);
					
			$food_dashboard['six_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time11,$time12);
			
		
			//complete

			$food_dashboard['com_first_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time1,$time2);
			
			$food_dashboard['com_second_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time3,$time4);
			
			$food_dashboard['com_third_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time5,$time6);
			
			$food_dashboard['com_forth_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time7,$time8);
			
			$food_dashboard['com_fifth_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time9,$time10);
			
			$food_dashboard['com_six_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time11,$time12);
			
          
			// last 7 days pending order
			$food_dashboard['first_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time1,$time2);
			
			$food_dashboard['second_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time3,$time4);
			
			$food_dashboard['third_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time5,$time6);
			
			$food_dashboard['forth_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time7,$time8);		
			
			$food_dashboard['fifth_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time9,$time10);
			
			$food_dashboard['six_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time11,$time12);
			
		
			//complete last 7 days
			$food_dashboard['com_first_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time1,$time2);
			
			$food_dashboard['com_second_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time3,$time4);
			
			$food_dashboard['com_third_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time5,$time6);
			
			$food_dashboard['com_forth_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time7,$time8);
			
			$food_dashboard['com_fifth_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time9,$time10);
			
			$food_dashboard['com_six_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time11,$time12);
			
			//current month pending order
			$food_dashboard['first_four_hrs_curr_mnt'] = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time1,$time2);
			
			$food_dashboard['second_four_hrs_curr_mnt'] = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time3,$time4);
			
			$food_dashboard['third_four_hrs_curr_mnt'] = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time5,$time6);
			
			$food_dashboard['forth_four_hrs_curr_mnt']  = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time7,$time8);
			
			$food_dashboard['fifth_four_hrs_curr_mnt'] = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time9,$time10);
			
			$food_dashboard['six_four_hrs_curr_mnt'] = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time11,$time12);
			
          
            //complete current month
            $food_dashboard['com_first_four_hrs_cureent_mnt'] = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time1,$time2);
			
			$food_dashboard['com_second_four_hrs_cureent_mnt'] = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time3,$time4);
			
			$food_dashboard['com_third_four_hrs_cureent_mnt'] = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time5,$time6);
			
			$food_dashboard['com_forth_four_hrs_cureent_mnt']  = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time7,$time8);
			
			$food_dashboard['com_fifth_four_hrs_cureent_mnt'] = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time9,$time10);
			
			$food_dashboard['com_six_four_hrs_cureent_mnt'] = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time11,$time12);
            
           
            //current year pending order
            $food_dashboard['first_four_hrs_curr_yr'] = $this->MainModel->get_food_order_current_yr_count($admin_id,$time1,$time2);
			
			$food_dashboard['second_four_hrs_curr_yr'] = $this->MainModel->get_food_order_current_yr_count($admin_id,$time3,$time4);
			
			$food_dashboard['third_four_hrs_curr_yr'] = $this->MainModel->get_food_order_current_yr_count($admin_id,$time5,$time6);
			
			$food_dashboard['forth_four_hrs_curr_yr']  = $this->MainModel->get_food_order_current_yr_count($admin_id,$time7,$time8);
			
			$food_dashboard['fifth_four_hrs_curr_yr'] = $this->MainModel->get_food_order_current_yr_count($admin_id,$time9,$time10);
			
			$food_dashboard['six_four_hrs_curr_yr'] = $this->MainModel->get_food_order_current_yr_count($admin_id,$time11,$time12);
			
			//complete current year
            $food_dashboard['com_first_four_hrs_cureent_yr'] = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time1,$time2);
			
			$food_dashboard['com_second_four_hrs_cureent_yr'] = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time3,$time4);
			
			$food_dashboard['com_third_four_hrs_cureent_yr'] = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time5,$time6);
			
			$food_dashboard['com_forth_four_hrs_cureent_yr']  = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time7,$time8);
			
			$food_dashboard['com_fifth_four_hrs_cureent_yr'] = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time9,$time10);
			
			$food_dashboard['com_six_four_hrs_cureent_yr'] = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time11,$time12);
		
          
              
            //end data
			$this->load->view('include/header');
			$this->load->view('page/dashboard', $food_dashboard);
			$this->load->view('include/footer');
		}else if($userType == 2){
            $u_id= $this->session->userdata('u_id');
		    // print_r($u_id);die;
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->FrontofficeModel->getData($tbl ='register', $where);
			
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			$get_hotel_name = $this->FrontofficeModel->getData($tbl ='register', $wh);
			// print_r($admin_details);die;
				$admin_id = $this->session->userdata('u_id');
				$u_id11 = $admin_details['u_id'];

			$room_status1 = 3; //available
			$room_status2 = 2; //accupied
			$room_status3 = 1; //dirty
			$room_status4 = 4; //under maintainance

			$booking_status1 = 1; //current booking

			$booking_status2 = 0; //expected arrived booking

			$booking_status3 = 2; //expected daparted

			$front_dashboard['hotel_id'] = $u_id;
          
            $front_dashboard['total_rooms'] = $this->FrontofficeModel->get_total_room_count11($admin_id);
          

			$front_dashboard['total_availble_rooms'] = $this->HotelAdminModel->get_hotel_rooms_status($admin_id,$room_status1);

			$front_dashboard['total_accupied_rooms'] = $this->HotelAdminModel->get_hotel_rooms_status($admin_id,$room_status2);
			
			$front_dashboard['total_dirty_rooms'] = $this->HotelAdminModel->get_hotel_rooms_status($admin_id,$room_status3);
			
			$front_dashboard['total_undermaintance_rooms'] = $this->HotelAdminModel->get_hotel_rooms_status($admin_id,$room_status4);
			
			$front_dashboard['total_current_booking'] = $this->HotelAdminModel->get_hotel_user_booking($admin_id,$booking_status1);

			$front_dashboard['total_pending_booking'] = $this->HotelAdminModel->get_hotel_user_booking($admin_id,$booking_status2);
			
			$front_dashboard['total_daparted_booking'] = $this->HotelAdminModel->get_hotel_user_booking($admin_id,$booking_status3);
			
			$front_dashboard['total_CHG_guest'] = $this->HotelAdminModel->get_hotel_chg_guest($admin_id);
			
			$front_dashboard['get_front_ofs_notifications'] = $this->HotelAdminModel->get_notifications_for_front_ofs($admin_id);
			
			$front_dashboard['total_expected_current_booking'] = $this->HotelAdminModel->get_hotel_expected_current_booking($admin_id);

			$front_dashboard['get_hotel_expected_departed_booking'] = $this->HotelAdminModel->get_hotel_expected_current_booking($admin_id);
			
			$front_dashboard['get_hotel_expected_CHG_guest'] = $this->HotelAdminModel->get_hotel_guest_list($admin_id);
			
			$front_dashboard['floor_list'] = $this->HotelAdminModel->get_floor_list($admin_id);

			$front_dashboard['total_business_center'] = $this->HotelAdminModel->get_active_business_center($admin_id);

			$front_dashboard['total_reserve_business_center'] = $this->HotelAdminModel->get_reservation_bc($admin_id);

			$front_dashboard['total_b_h'] = $this->HotelAdminModel->banquet_hall($admin_id);

			$front_dashboard['total_reserve_bh'] = $this->HotelAdminModel->get_reservation_bh($admin_id);

			$front_dashboard['hotels_booking_data'] = $this->HotelAdminModel->get_hotel_peoples($admin_id);

			$order_status = 1;

			$front_dashboard['room_service_list'] = $this->HotelAdminModel->get_room_service_services_order($admin_id,$order_status);

			$front_dashboard['room_service_menu_list'] = $this->HotelAdminModel->get_room_service_menu_order($admin_id,$order_status);

			$front_dashboard['hk_service_list'] = $this->HotelAdminModel->get_house_keeping_service_order($admin_id,$order_status);

			$front_dashboard['laundry_list'] = $this->HotelAdminModel->get_laundry_order($admin_id,$order_status);

			$front_dashboard['food_list'] = $this->HotelAdminModel->get_food_order($admin_id,$order_status);

			$front_dashboard['offer_list'] = $this->HotelAdminModel->get_offer_list($admin_id,$order_status);

			$front_dashboard['today_check_in_check_out'] = $this->HotelAdminModel->get_today_booking_data($admin_id);

			$front_dashboard['total_checkout_request'] = $this->HotelAdminModel->get_checkout_request($admin_id,0);
		    
		    
			$this->load->view('include/header');
			$this->load->view('page/admindashboard' ,$front_dashboard);
			$this->load->view('include/footer');
		}else if($userType == 3){
		    
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
			
			$all_hotel_notis_from_SA = $this->FrontofficeModel->all_hotel_notic_from_superadmin();

			$specific_hotel_notis_from_SA = $this->FrontofficeModel->specific_hotel_notis_from_SA($admin_id);
			$get_front_ofs_notis = $this->FrontofficeModel->get_notifications_for_front_ofs($admin_id);
			
			$front_dashboard['get_front_ofs_notifications'] = array_merge($all_hotel_notis_from_SA,$specific_hotel_notis_from_SA,$get_front_ofs_notis);
			
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
			
			$front_dashboard['total_checkout_request'] = $this->FrontofficeModel->get_checkout_request($admin_id,0);
		    
		    
			$this->load->view('include/header');
			$this->load->view('page/frontOfficedashboard', $front_dashboard);
			$this->load->view('include/footer');
		}else if($userType == 1){
			$admin_id=$this->session->userdata('u_id');
			// $data['selected_hotel_id'] = $this->input->post('selected_hotel_id');
			$where = '(user_type = 2 )';
            $hotel_list = $this->MainModel->hotel_list_dashboard('register',$where);

			$hotel_id = $hotel_list[0]['u_id'];
			// $hotel_id = 458;
         	$year = date('Y');

			$order = [];
			$total_rev1 = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$daily_data = $this->MainModel->get_daily_report_graph_dep1($month,$year,$hotel_id);
				if(!empty($daily_data))
				{
				  foreach($daily_data as $d_d)
				  {
					$order = (int)$d_d['price'];
				  }
				}
				else
				{
				  $order = 0;
				}
	
				$total_rev1[] = (int)$order;
			}
			$dashboard['hotel_admin'] = $total_rev1;

			$front_office = [];
			$total_rev11 = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$daily_data = $this->MainModel->get_daily_report_graph_dep2($month,$year,$hotel_id);
				if(!empty($daily_data))
				{
				  foreach($daily_data as $d_d)
				  {
					$front_office = (int)$d_d['price'];
				  }
				}
				else
				{
				  $front_office = 0;
				}
	
				$total_rev11[] = (int)$front_office;
			}
			$dashboard['front_office'] = $total_rev11;

			$food_breverage = [];
			$total_rev111 = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$daily_data = $this->MainModel->get_daily_report_graph_dep4($month,$year,$hotel_id);
				if(!empty($daily_data))
				{
				  foreach($daily_data as $d_d)
				  {
					$food_breverage = (int)$d_d['price'];
				  }
				}
				else
				{
				  $food_breverage = 0;
				}
	
				$total_rev111[] = (int)$food_breverage;
			}
			$dashboard['food_breverage'] = $total_rev111;

			$house_keeping = [];
			$total_rev1111 = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$daily_data = $this->MainModel->get_daily_report_graph_dep5($month,$year,$hotel_id);
				if(!empty($daily_data))
				{
				  foreach($daily_data as $d_d)
				  {
					$house_keeping = (int)$d_d['price'];
				  }
				}
				else
				{
				  $house_keeping = 0;
				}
	
				$total_rev1111[] = (int)$house_keeping;
			}
			$dashboard['house_keeping'] = $total_rev1111;

			$chart_data = [];
			$total_chart_data = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$chart_data11 = $this->MainModel->getMonthlyGraph($month,$year,$hotel_id);
         
				if($chart_data11)
				{
					foreach($chart_data11 as $r_y_12)
					{
						$chart_data = $r_y_12['total_rev'];
					}
				}
				else
				{
					$chart_data = 0;
				}
	
				$total_chart_data[] = (int)$chart_data;
			}
			$dashboard['Leads'] = $total_chart_data;

			$converted_leades = [];
			$total_converted_leades = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$chart_data11 = $this->MainModel->get_leads_conver_MonthlyGraph($month,$year,$hotel_id);
         
				if($chart_data11)
				{
					foreach($chart_data11 as $r_y_12)
					{
						$converted_leades = $r_y_12['total_rev'];
					}
				}
				else
				{
					$converted_leades = 0;
				}
	
				$total_converted_leades[] = (int)$converted_leades;
			}
			$dashboard['converted_leades'] = $total_converted_leades;

			$request_status1 = 1;
             $request_status111 = 0;
            $request_status12 = 3;

			$dashboard['hotel_id'] = $hotel_id;

            $where= '(request_status = 1)';
           
            $dashboard['get_total_leads'] = $this->MainModel->get_count_converted_leads();
          
          	$dashboard['get_count_converted_leads'] = $this->MainModel->get_count_guest_converted_leads();
          
            $dashboard['get_total_converted_revenue_leads'] = $this->MainModel->get_total_converted_revenue_leads($request_status1);

			//$dashboard['current_week_total_revenue'] = $this->MainModel->get_weekly_leads_revenue($request_status1);
          
            //$dashboard['lead_conversion'] = $this->MainModel->get_lead_conversion ($request_status1);
			
			//$dashboard['get_current_month_lead'] = $this->MainModel->get_current_month_total_lead($request_status1);
          
			//$dashboard['get_current_month_total_revenue'] = $this->MainModel->get_current_month_total_revenue($request_status1);
   
          //get weekly lead
			$dashboard['current_week_total_revenue'] = $this->MainModel->get_weekly_leads_revenue($hotel_id);
            //get weekly lead conversion
            $dashboard['lead_conversion_weekly'] = $this->MainModel->get_weekly_lead_conversion($hotel_id);
			//get monthly lead
			$dashboard['get_current_month_lead'] = $this->MainModel->get_current_month_total_lead($hotel_id);
          //get monthly lead conversion
			$dashboard['get_monthly_lead_conversion'] = $this->MainModel->get_current_month_total_revenue($hotel_id);
            //get yearly lead
            $dashboard['get_yearly_lead_revenue'] = $this->MainModel->get_yearly_lead_revenue($hotel_id);
          //get yearly lead conversion
			$dashboard['get_yearly_lead_conversion'] = $this->MainModel->get_yearly_lead_conversion($hotel_id);

            $dashboard['get_total_revenue_leads'] = $this->MainModel->get_total_revenue_leads();

			$this->load->view('include/header');
			$this->load->view('page/superadmindashboard',$dashboard);
			$this->load->view('include/footer');
		}else if($userType == 6){
			$id = $this->session->userdata('u_id');

            $wh_admin = '(u_id ="'.$id.'")';
            $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			// print_r($admin_id);
            $admin_id = $get_hotel_id['hotel_id']; 
			$user_type = 10;
				$is_active1 = 1;
				$is_active2 = 0;
	
				$room_service_dashboard['staff_list'] = $this->MainModel->get_particular_hotel_staff_list($admin_id,$user_type);
				
				$room_service_dashboard['active_staff'] = $this->MainModel->get_particular_hotel_staff_list_count($admin_id,$user_type,$is_active1);
				
				$room_service_dashboard['deactive_staff'] = $this->MainModel->get_particular_hotel_staff_list_count($admin_id,$user_type,$is_active2);
	
				$room_service_dashboard['get_rs_notifications'] = $this->MainModel->get_notifications_for_rs($admin_id);
				
				$room_service_dashboard['floor_list'] = $this->MainModel->get_floor_list($admin_id);
				
				//pending orders
				$time1 = "00:00:00";
				$time2 = "04:00:00";
	
				$time3 = "04:00:00";
				$time4 = "08:00:00";
	
				$time5 = "08:00:00";
				$time6 = "12:00:00";
	
				$time7 = "12:00:00";
				$time8 = "16:00:00";
	
				$time9 = "16:00:00";
				$time10 = "20:00:00";
	
				$time11 = "20:00:00";
				$time12 = "24:00:00";
	
				$room_rs_sers_order = $this->MainModel->get_room_service_order_count($admin_id,$time1,$time2);
				$room_rs_menu_order = $this->MainModel->get_room_service_menu_order_count($admin_id,$time1,$time2);
		
				$room_service_dashboard['first_four_hrs'] = array_merge($room_rs_sers_order,$room_rs_menu_order);
				
				$room_rs_sers_order1 = $this->MainModel->get_room_service_order_count($admin_id,$time3,$time4);
				$room_rs_menu_order1 = $this->MainModel->get_room_service_menu_order_count($admin_id,$time3,$time4);
		
				$room_service_dashboard['second_four_hrs'] = array_merge($room_rs_sers_order1,$room_rs_menu_order1);
				
				$room_rs_sers_order2 = $this->MainModel->get_room_service_order_count($admin_id,$time5,$time6);
				$room_rs_menu_order2 = $this->MainModel->get_room_service_menu_order_count($admin_id,$time5,$time6);
		
				$room_service_dashboard['third_four_hrs'] = array_merge($room_rs_sers_order2,$room_rs_menu_order2);
				
				$room_rs_sers_order3 = $this->MainModel->get_room_service_order_count($admin_id,$time7,$time8);
				$room_rs_menu_order3 = $this->MainModel->get_room_service_menu_order_count($admin_id,$time7,$time8);
		
				$room_service_dashboard['forth_four_hrs'] = array_merge($room_rs_sers_order3,$room_rs_menu_order3);
				
				$room_rs_sers_order4 = $this->MainModel->get_room_service_order_count($admin_id,$time9,$time10);
				$room_rs_menu_order4 = $this->MainModel->get_room_service_menu_order_count($admin_id,$time9,$time10);
		
				$room_service_dashboard['fifth_four_hrs'] = array_merge($room_rs_sers_order4,$room_rs_menu_order4);
			
				$room_rs_sers_order5 = $this->MainModel->get_room_service_order_count($admin_id,$time11,$time12);
				$room_rs_menu_order5 = $this->MainModel->get_room_service_menu_order_count($admin_id,$time11,$time12);
		
				$room_service_dashboard['six_four_hrs'] = array_merge($room_rs_sers_order5,$room_rs_menu_order5);
			
				//complete
	
				$room_rs_sers_order_com = $this->MainModel->get_room_service_order_complate_count($admin_id,$time1,$time2);
				$room_rs_menu_order_com = $this->MainModel->get_room_service_menu_order_complete_count($admin_id,$time1,$time2);
		
				$room_service_dashboard['com_first_four_hrs'] = array_merge($room_rs_sers_order_com,$room_rs_menu_order_com);
				
				$room_rs_sers_order_com1 = $this->MainModel->get_room_service_order_complate_count($admin_id,$time3,$time4);
				$room_rs_menu_order_com1 = $this->MainModel->get_room_service_menu_order_complete_count($admin_id,$time3,$time4);
		
				$room_service_dashboard['com_second_four_hrs'] = array_merge($room_rs_sers_order_com1,$room_rs_menu_order_com1);
				
				$room_rs_sers_order_com2 = $this->MainModel->get_room_service_order_complate_count($admin_id,$time5,$time6);
				$room_rs_menu_order_com2 = $this->MainModel->get_room_service_menu_order_complete_count($admin_id,$time5,$time6);
		
				$room_service_dashboard['com_third_four_hrs'] = array_merge($room_rs_sers_order_com2,$room_rs_menu_order_com2);
				
				$room_rs_sers_order_com3 = $this->MainModel->get_room_service_order_complate_count($admin_id,$time7,$time8);
				$room_rs_menu_order_com3 = $this->MainModel->get_room_service_menu_order_complete_count($admin_id,$time7,$time8);
		
				$room_service_dashboard['com_forth_four_hrs'] = array_merge($room_rs_sers_order_com3,$room_rs_menu_order_com3);
				
				$room_rs_sers_order_com4 = $this->MainModel->get_room_service_order_complate_count($admin_id,$time9,$time10);
				$room_rs_menu_order_com4 = $this->MainModel->get_room_service_menu_order_complete_count($admin_id,$time9,$time10);
		
				$room_service_dashboard['com_fifth_four_hrs'] = array_merge($room_rs_sers_order_com4,$room_rs_menu_order_com4);
			
				$room_rs_sers_order_com5 = $this->MainModel->get_room_service_order_complate_count($admin_id,$time11,$time12);
				$room_rs_menu_order_com5 = $this->MainModel->get_room_service_menu_order_complete_count($admin_id,$time11,$time12);
		
				$room_service_dashboard['com_six_four_hrs'] = array_merge($room_rs_sers_order_com5,$room_rs_menu_order_com5);
			
				// last 7 days pending order
				$room_rs_sers_order_7 = $this->MainModel->get_room_service_order_count1($admin_id,$time1,$time2);
				$room_rs_menu_order_7 = $this->MainModel->get_room_service_menu_order_count1($admin_id,$time1,$time2);
		
				$room_service_dashboard['first_four_hrs_7'] = array_merge($room_rs_sers_order_7,$room_rs_menu_order_7);
				
				$room_rs_sers_order_71 = $this->MainModel->get_room_service_order_count1($admin_id,$time3,$time4);
				$room_rs_menu_order_71 = $this->MainModel->get_room_service_menu_order_count1($admin_id,$time3,$time4);
		
				$room_service_dashboard['second_four_hrs_7'] = array_merge($room_rs_sers_order_71,$room_rs_menu_order_71);
				
				$room_rs_sers_order_72 = $this->MainModel->get_room_service_order_count1($admin_id,$time5,$time6);
				$room_rs_menu_order_72 = $this->MainModel->get_room_service_menu_order_count1($admin_id,$time5,$time6);
		
				$room_service_dashboard['third_four_hrs_7'] = array_merge($room_rs_sers_order_72,$room_rs_menu_order_72);
				
				$room_rs_sers_order_73 = $this->MainModel->get_room_service_order_count1($admin_id,$time7,$time8);
				$room_rs_menu_order_73 = $this->MainModel->get_room_service_menu_order_count1($admin_id,$time7,$time8);
		
				$room_service_dashboard['forth_four_hrs_7'] = array_merge($room_rs_sers_order_73,$room_rs_menu_order_73);
				
				$room_rs_sers_order_74 = $this->MainModel->get_room_service_order_count1($admin_id,$time9,$time10);
				$room_rs_menu_order_74 = $this->MainModel->get_room_service_menu_order_count1($admin_id,$time9,$time10);
		
				$room_service_dashboard['fifth_four_hrs_7'] = array_merge($room_rs_sers_order_74,$room_rs_menu_order_74);
			
				$room_rs_sers_order_75 = $this->MainModel->get_room_service_order_count1($admin_id,$time11,$time12);
				$room_rs_menu_order_75 = $this->MainModel->get_room_service_menu_order_count1($admin_id,$time11,$time12);
		
				$room_service_dashboard['six_four_hrs_7'] = array_merge($room_rs_sers_order_75,$room_rs_menu_order_75);
			
				//complete last 7 days
				$room_rs_sers_order_com_7 = $this->MainModel->get_room_service_order_complate_count1($admin_id,$time1,$time2);
				$room_rs_menu_order_com_7 = $this->MainModel->get_room_service_menu_order_complete_count1($admin_id,$time1,$time2);
		
				$room_service_dashboard['com_first_four_hrs_7'] = array_merge($room_rs_sers_order_com_7,$room_rs_menu_order_com_7);
				
				$room_rs_sers_order_com_71 = $this->MainModel->get_room_service_order_complate_count1($admin_id,$time3,$time4);
				$room_rs_menu_order_com_71 = $this->MainModel->get_room_service_menu_order_complete_count1($admin_id,$time3,$time4);
		
				$room_service_dashboard['com_second_four_hrs_7'] = array_merge($room_rs_sers_order_com_71,$room_rs_menu_order_com_71);
				
				$room_rs_sers_order_com_72 = $this->MainModel->get_room_service_order_complate_count1($admin_id,$time5,$time6);
				$room_rs_menu_order_com_72 = $this->MainModel->get_room_service_menu_order_complete_count1($admin_id,$time5,$time6);
		
				$room_service_dashboard['com_third_four_hrs_7'] = array_merge($room_rs_sers_order_com_72,$room_rs_menu_order_com_72);
				
				$room_rs_sers_order_com_73 = $this->MainModel->get_room_service_order_complate_count1($admin_id,$time7,$time8);
				$room_rs_menu_order_com_73 = $this->MainModel->get_room_service_menu_order_complete_count1($admin_id,$time7,$time8);
		
				$room_service_dashboard['com_forth_four_hrs_7'] = array_merge($room_rs_sers_order_com_73,$room_rs_menu_order_com_73);
				
				$room_rs_sers_order_com_74 = $this->MainModel->get_room_service_order_complate_count1($admin_id,$time9,$time10);
				$room_rs_menu_order_com_74 = $this->MainModel->get_room_service_menu_order_complete_count1($admin_id,$time9,$time10);
		
				$room_service_dashboard['com_fifth_four_hrs_7'] = array_merge($room_rs_sers_order_com_74,$room_rs_menu_order_com_74);
			
				$room_rs_sers_order_com_75 = $this->MainModel->get_room_service_order_complate_count1($admin_id,$time11,$time12);
				$room_rs_menu_order_com_75 = $this->MainModel->get_room_service_menu_order_complete_count1($admin_id,$time11,$time12);
		
				$room_service_dashboard['com_six_four_hrs_7'] = array_merge($room_rs_sers_order_com_75,$room_rs_menu_order_com_75);
			
				//current month pending order
				$room_rs_sers_order_cureent_mnt = $this->MainModel->get_room_service_order_current_mnt_count($admin_id,$time1,$time2);
				$room_rs_menu_order_cureent_mnt = $this->MainModel->get_room_service_menu_order_current_mnt_count($admin_id,$time1,$time2);
		
				$room_service_dashboard['first_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt,$room_rs_menu_order_cureent_mnt);
				
				$room_rs_sers_order_cureent_mnt1 = $this->MainModel->get_room_service_order_current_mnt_count($admin_id,$time3,$time4);
				$room_rs_menu_order_cureent_mnt1 = $this->MainModel->get_room_service_menu_order_current_mnt_count($admin_id,$time3,$time4);
		
				$room_service_dashboard['second_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt1,$room_rs_menu_order_cureent_mnt1);
				
				$room_rs_sers_order_cureent_mnt2 = $this->MainModel->get_room_service_order_current_mnt_count($admin_id,$time5,$time6);
				$room_rs_menu_order_cureent_mnt2 = $this->MainModel->get_room_service_menu_order_current_mnt_count($admin_id,$time5,$time6);
		
				$room_service_dashboard['third_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt2,$room_rs_menu_order_cureent_mnt2);
				
				$room_rs_sers_order_cureent_mnt3 = $this->MainModel->get_room_service_order_current_mnt_count($admin_id,$time7,$time8);
				$room_rs_menu_order_cureent_mnt3 = $this->MainModel->get_room_service_menu_order_current_mnt_count($admin_id,$time7,$time8);
		
				$room_service_dashboard['forth_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt3,$room_rs_menu_order_cureent_mnt3);
				
				$room_rs_sers_order_cureent_mnt4 = $this->MainModel->get_room_service_order_current_mnt_count($admin_id,$time9,$time10);
				$room_rs_menu_order_cureent_mnt4 = $this->MainModel->get_room_service_menu_order_current_mnt_count($admin_id,$time9,$time10);
		
				$room_service_dashboard['fifth_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt4,$room_rs_menu_order_cureent_mnt4);
			
				$room_rs_sers_order_cureent_mnt5 = $this->MainModel->get_room_service_order_current_mnt_count($admin_id,$time11,$time12);
				$room_rs_menu_order_cureent_mnt5 = $this->MainModel->get_room_service_menu_order_current_mnt_count($admin_id,$time11,$time12);
		
				$room_service_dashboard['six_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt5,$room_rs_menu_order_cureent_mnt5);
			
				//complete current month
				$room_rs_sers_order_com_cureent_mnt = $this->MainModel->get_room_service_order_complete_count_current_mnt($admin_id,$time1,$time2);
				$room_rs_menu_order_com_cureent_mnt = $this->MainModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time1,$time2);
		
				$room_service_dashboard['com_first_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt,$room_rs_menu_order_com_cureent_mnt);
				
				$room_rs_sers_order_com_cureent_mnt1 = $this->MainModel->get_room_service_order_complete_count_current_mnt($admin_id,$time3,$time4);
				$room_rs_menu_order_com_cureent_mnt1 = $this->MainModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time3,$time4);
		
				$room_service_dashboard['com_second_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt1,$room_rs_menu_order_com_cureent_mnt1);
				
				$room_rs_sers_order_com_cureent_mnt2 = $this->MainModel->get_room_service_order_complete_count_current_mnt($admin_id,$time5,$time6);
				$room_rs_menu_order_com_cureent_mnt2 = $this->MainModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time5,$time6);
		
				$room_service_dashboard['com_third_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt2,$room_rs_menu_order_com_cureent_mnt2);
				
				$room_rs_sers_order_com_cureent_mnt3 = $this->MainModel->get_room_service_order_complete_count_current_mnt($admin_id,$time7,$time8);
				$room_rs_menu_order_com_cureent_mnt3 = $this->MainModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time7,$time8);
		
				$room_service_dashboard['com_forth_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt3,$room_rs_menu_order_com_cureent_mnt3);
				
				$room_rs_sers_order_com_cureent_mnt4 = $this->MainModel->get_room_service_order_complete_count_current_mnt($admin_id,$time9,$time10);
				$room_rs_menu_order_com_cureent_mnt4 = $this->MainModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time9,$time10);
		
				$room_service_dashboard['com_fifth_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt4,$room_rs_menu_order_com_cureent_mnt4);
			
				$room_rs_sers_order_com_cureent_mnt5 = $this->MainModel->get_room_service_order_complete_count_current_mnt($admin_id,$time11,$time12);
				$room_rs_menu_order_com_cureent_mnt5 = $this->MainModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time11,$time12);
		
				$room_service_dashboard['com_six_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt5,$room_rs_menu_order_com_cureent_mnt5);
			
				//current year pending order
				$room_rs_sers_order_cureent_yr = $this->MainModel->get_room_service_order_current_yr_count($admin_id,$time1,$time2);
				$room_rs_menu_order_cureent_yr = $this->MainModel->get_room_service_menu_order_current_yr_count($admin_id,$time1,$time2);
		
				$room_service_dashboard['first_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr,$room_rs_menu_order_cureent_yr);
				
				$room_rs_sers_order_cureent_yr1 = $this->MainModel->get_room_service_order_current_yr_count($admin_id,$time3,$time4);
				$room_rs_menu_order_cureent_yr1 = $this->MainModel->get_room_service_menu_order_current_yr_count($admin_id,$time3,$time4);
		
				$room_service_dashboard['second_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr1,$room_rs_menu_order_cureent_yr1);
				
				$room_rs_sers_order_cureent_yr2 = $this->MainModel->get_room_service_order_current_yr_count($admin_id,$time5,$time6);
				$room_rs_menu_order_cureent_yr2 = $this->MainModel->get_room_service_menu_order_current_yr_count($admin_id,$time5,$time6);
		
				$room_service_dashboard['third_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr2,$room_rs_menu_order_cureent_yr2);
				
				$room_rs_sers_order_cureent_yr3 = $this->MainModel->get_room_service_order_current_yr_count($admin_id,$time7,$time8);
				$room_rs_menu_order_cureent_yr3 = $this->MainModel->get_room_service_menu_order_current_yr_count($admin_id,$time7,$time8);
		
				$room_service_dashboard['forth_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr3,$room_rs_menu_order_cureent_yr3);
				
				$room_rs_sers_order_cureent_yr4 = $this->MainModel->get_room_service_order_current_yr_count($admin_id,$time9,$time10);
				$room_rs_menu_order_cureent_yr4 = $this->MainModel->get_room_service_menu_order_current_yr_count($admin_id,$time9,$time10);
		
				$room_service_dashboard['fifth_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr4,$room_rs_menu_order_cureent_yr4);
			
				$room_rs_sers_order_cureent_yr5 = $this->MainModel->get_room_service_order_current_yr_count($admin_id,$time11,$time12);
				$room_rs_menu_order_cureent_yr5 = $this->MainModel->get_room_service_menu_order_current_yr_count($admin_id,$time11,$time12);
		
				$room_service_dashboard['six_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr5,$room_rs_menu_order_cureent_yr5);
			
				//complete current year
				$room_rs_sers_order_com_cureent_yr = $this->MainModel->get_room_service_order_complete_count_current_yr($admin_id,$time1,$time2);
				$room_rs_menu_order_com_cureent_yr = $this->MainModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time1,$time2);
		
				$room_service_dashboard['com_first_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr,$room_rs_menu_order_com_cureent_yr);
				
				$room_rs_sers_order_com_cureent_yr1 = $this->MainModel->get_room_service_order_complete_count_current_yr($admin_id,$time3,$time4);
				$room_rs_menu_order_com_cureent_yr1 = $this->MainModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time3,$time4);
		
				$room_service_dashboard['com_second_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr1,$room_rs_menu_order_com_cureent_yr1);
				
				$room_rs_sers_order_com_cureent_yr2 = $this->MainModel->get_room_service_order_complete_count_current_yr($admin_id,$time5,$time6);
				$room_rs_menu_order_com_cureent_yr2 = $this->MainModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time5,$time6);
		
				$room_service_dashboard['com_third_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr2,$room_rs_menu_order_com_cureent_yr2);
				
				$room_rs_sers_order_com_cureent_yr3 = $this->MainModel->get_room_service_order_complete_count_current_yr($admin_id,$time7,$time8);
				$room_rs_menu_order_com_cureent_yr3 = $this->MainModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time7,$time8);
		
				$room_service_dashboard['com_forth_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr3,$room_rs_menu_order_com_cureent_yr3);
				
				$room_rs_sers_order_com_cureent_yr4 = $this->MainModel->get_room_service_order_complete_count_current_yr($admin_id,$time9,$time10);
				$room_rs_menu_order_com_cureent_yr4 = $this->MainModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time9,$time10);
		
				$room_service_dashboard['com_fifth_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr4,$room_rs_menu_order_com_cureent_yr4);
			
				$room_rs_sers_order_com_cureent_yr5 = $this->MainModel->get_room_service_order_complete_count_current_yr($admin_id,$time11,$time12);
				$room_rs_menu_order_com_cureent_yr5 = $this->MainModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time11,$time12);
		
				$room_service_dashboard['com_six_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr5,$room_rs_menu_order_com_cureent_yr5);
			

			$this->load->view('include/header');
			$this->load->view('page/roomservicedashboard', $room_service_dashboard);
			$this->load->view('include/footer');
		}
		
	}
	
	public function hotel_wise_chart()
	{
		$selected_hotel_id = $this->input->post('selected_hotel_id');
		// $data['selected_hotel_id'] = $this->input->post('selected_hotel_id');
		// echo "<pre>";
		// print_r($selected_hotel_id);
		// exit;
		// $selected_hotel_id = 458;
		$dashboard_chart['selected_hotel_id'] = $selected_hotel_id;
		$year = date('Y');

			$order = [];
			$total_rev1 = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$daily_data = $this->MainModel->get_daily_report_graph_dep1($month,$year,$selected_hotel_id);
				if(!empty($daily_data))
				{
				  foreach($daily_data as $d_d)
				  {
					$order = (int)$d_d['price'];
				  }
				}
				else
				{
				  $order = 0;
				}
	
				$total_rev1[] = (int)$order;
			}
			$dashboard_chart['hotel_admin'] = $total_rev1;

			$front_office = [];
			$total_rev11 = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$daily_data = $this->MainModel->get_daily_report_graph_dep2($month,$year,$selected_hotel_id);
				if(!empty($daily_data))
				{
				  foreach($daily_data as $d_d)
				  {
					$front_office = (int)$d_d['price'];
				  }
				}
				else
				{
				  $front_office = 0;
				}
	
				$total_rev11[] = (int)$front_office;
			}
			$dashboard_chart['front_office'] = $total_rev11;

			$food_breverage = [];
			$total_rev111 = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$daily_data = $this->MainModel->get_daily_report_graph_dep4($month,$year,$selected_hotel_id);
				if(!empty($daily_data))
				{
				  foreach($daily_data as $d_d)
				  {
					$food_breverage = (int)$d_d['price'];
				  }
				}
				else
				{
				  $food_breverage = 0;
				}
	
				$total_rev111[] = (int)$food_breverage;
			}
			$dashboard_chart['food_breverage'] = $total_rev111;

			$house_keeping = [];
			$total_rev1111 = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$daily_data = $this->MainModel->get_daily_report_graph_dep5($month,$year,$selected_hotel_id);
				if(!empty($daily_data))
				{
				  foreach($daily_data as $d_d)
				  {
					$house_keeping = (int)$d_d['price'];
				  }
				}
				else
				{
				  $house_keeping = 0;
				}
	
				$total_rev1111[] = (int)$house_keeping;
			}
			$dashboard_chart['house_keeping'] = $total_rev1111;

			$chart_data = [];
			$total_chart_data = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$chart_data11 = $this->MainModel->getMonthlyGraph($month,$year,$selected_hotel_id);
         
				if($chart_data11)
				{
					foreach($chart_data11 as $r_y_12)
					{
						$chart_data = $r_y_12['total_rev'];
					}
				}
				else
				{
					$chart_data = 0;
				}
	
				$total_chart_data[] = (int)$chart_data;
			}
			$dashboard_chart['Leads'] = $total_chart_data;

			$converted_leades = [];
			$total_converted_leades = [];
			for ($month = 1; $month <= 12; $month++) 
			{
				$chart_data11 = $this->MainModel->get_leads_conver_MonthlyGraph($month,$year,$selected_hotel_id);
         
				if($chart_data11)
				{
					foreach($chart_data11 as $r_y_12)
					{
						$converted_leades = $r_y_12['total_rev'];
					}
				}
				else
				{
					$converted_leades = 0;
				}
	
				$total_converted_leades[] = (int)$converted_leades;
			}
			$dashboard_chart['converted_leades'] = $total_converted_leades;

			
          //get weekly lead
		  $dashboard_chart['current_week_total_revenue'] = $this->MainModel->get_weekly_leads_revenue($selected_hotel_id);
		  //get weekly lead conversion
		  $dashboard_chart['lead_conversion_weekly'] = $this->MainModel->get_weekly_lead_conversion($selected_hotel_id);
		  //get monthly lead
		  $dashboard_chart['get_current_month_lead'] = $this->MainModel->get_current_month_total_lead($selected_hotel_id);
		//get monthly lead conversion
		  $dashboard_chart['get_monthly_lead_conversion'] = $this->MainModel->get_current_month_total_revenue($selected_hotel_id);
		  //get yearly lead
		  $dashboard_chart['get_yearly_lead_revenue'] = $this->MainModel->get_yearly_lead_revenue($selected_hotel_id);
		//get yearly lead conversion
		  $dashboard_chart['get_yearly_lead_conversion'] = $this->MainModel->get_yearly_lead_conversion($selected_hotel_id);

		  $dashboard_chart['get_total_revenue_leads'] = $this->MainModel->get_total_revenue_leads();

		echo json_encode($dashboard_chart); 
        exit;
		// $this->load->view('page/superadmindashboard',$data);
		// return $selected_hotel_id;
	}

    public function room_service_dashboard()
	{
        // print_r($this->session->userdata());die;
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');

			$order_status1 = 0;
			$order_status2 = 1;
			$order_status3 = 2;
			$order_status4 = 3;

			$room_service_pending_order = $this->HotelAdminModel->get_room_service_services_order($admin_id,$order_status1);
			$room_service_menu_pending_order = $this->HotelAdminModel->get_room_service_menu_order($admin_id,$order_status1);

			$room_service_dashboard['pending_order'] = array_merge($room_service_pending_order,$room_service_menu_pending_order);

			$room_service_accepted_order = $this->HotelAdminModel->get_room_service_services_order($admin_id,$order_status2);
			$room_service_menu_accepted_order = $this->HotelAdminModel->get_room_service_menu_order($admin_id,$order_status2);
			
			$room_service_dashboard['accepted_order'] = array_merge($room_service_accepted_order,$room_service_menu_accepted_order);

			$room_service_complete_order = $this->HotelAdminModel->get_room_service_services_order($admin_id,$order_status3);
			$room_service_menu_complete_order = $this->HotelAdminModel->get_room_service_menu_order($admin_id,$order_status3);

			$room_service_dashboard['complete_order'] = array_merge($room_service_complete_order,$room_service_menu_complete_order);

			$room_service_rejected_order = $this->HotelAdminModel->get_room_service_services_order($admin_id,$order_status4);
			$room_service_menu_rejected_order = $this->HotelAdminModel->get_room_service_menu_order($admin_id,$order_status4);

			$room_service_dashboard['reject_order'] = array_merge($room_service_rejected_order,$room_service_menu_rejected_order);
			
			$user_type = 10;
			$is_active1 = 1;
			$is_active2 = 0;

			$room_service_dashboard['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);
			
			$room_service_dashboard['active_staff'] = $this->HotelAdminModel->get_particular_hotel_staff_list_count($admin_id,$user_type,$is_active1);
			
			$room_service_dashboard['deactive_staff'] = $this->HotelAdminModel->get_particular_hotel_staff_list_count($admin_id,$user_type,$is_active2);

			$room_service_dashboard['get_rs_notifications'] = $this->HotelAdminModel->get_notifications_for_rs($admin_id);
			
			$room_service_dashboard['floor_list'] = $this->HotelAdminModel->get_floor_list($admin_id);
			
			//pending orders
			$time1 = "00:00:00";
			$time2 = "04:00:00";

			$time3 = "04:00:00";
			$time4 = "08:00:00";

			$time5 = "08:00:00";
			$time6 = "12:00:00";

			$time7 = "12:00:00";
			$time8 = "16:00:00";

			$time9 = "16:00:00";
			$time10 = "20:00:00";

			$time11 = "20:00:00";
			$time12 = "24:00:00";

			$room_rs_sers_order = $this->HotelAdminModel->get_room_service_order_count($admin_id,$time1,$time2);
			$room_rs_menu_order = $this->HotelAdminModel->get_room_service_menu_order_count($admin_id,$time1,$time2);
	
			$room_service_dashboard['first_four_hrs'] = array_merge($room_rs_sers_order,$room_rs_menu_order);
			
			$room_rs_sers_order1 = $this->HotelAdminModel->get_room_service_order_count($admin_id,$time3,$time4);
			$room_rs_menu_order1 = $this->HotelAdminModel->get_room_service_menu_order_count($admin_id,$time3,$time4);
	
			$room_service_dashboard['second_four_hrs'] = array_merge($room_rs_sers_order1,$room_rs_menu_order1);
			
			$room_rs_sers_order2 = $this->HotelAdminModel->get_room_service_order_count($admin_id,$time5,$time6);
			$room_rs_menu_order2 = $this->HotelAdminModel->get_room_service_menu_order_count($admin_id,$time5,$time6);
	
			$room_service_dashboard['third_four_hrs'] = array_merge($room_rs_sers_order2,$room_rs_menu_order2);
			
			$room_rs_sers_order3 = $this->HotelAdminModel->get_room_service_order_count($admin_id,$time7,$time8);
			$room_rs_menu_order3 = $this->HotelAdminModel->get_room_service_menu_order_count($admin_id,$time7,$time8);
	
			$room_service_dashboard['forth_four_hrs'] = array_merge($room_rs_sers_order3,$room_rs_menu_order3);
			
			$room_rs_sers_order4 = $this->HotelAdminModel->get_room_service_order_count($admin_id,$time9,$time10);
			$room_rs_menu_order4 = $this->HotelAdminModel->get_room_service_menu_order_count($admin_id,$time9,$time10);
	
			$room_service_dashboard['fifth_four_hrs'] = array_merge($room_rs_sers_order4,$room_rs_menu_order4);
		
			$room_rs_sers_order5 = $this->HotelAdminModel->get_room_service_order_count($admin_id,$time11,$time12);
			$room_rs_menu_order5 = $this->HotelAdminModel->get_room_service_menu_order_count($admin_id,$time11,$time12);
	
			$room_service_dashboard['six_four_hrs'] = array_merge($room_rs_sers_order5,$room_rs_menu_order5);
		
			//complete

			$room_rs_sers_order_com = $this->HotelAdminModel->get_room_service_order_complate_count($admin_id,$time1,$time2);
			$room_rs_menu_order_com = $this->HotelAdminModel->get_room_service_menu_order_complete_count($admin_id,$time1,$time2);
	
			$room_service_dashboard['com_first_four_hrs'] = array_merge($room_rs_sers_order_com,$room_rs_menu_order_com);
			
			$room_rs_sers_order_com1 = $this->HotelAdminModel->get_room_service_order_complate_count($admin_id,$time3,$time4);
			$room_rs_menu_order_com1 = $this->HotelAdminModel->get_room_service_menu_order_complete_count($admin_id,$time3,$time4);
	
			$room_service_dashboard['com_second_four_hrs'] = array_merge($room_rs_sers_order_com1,$room_rs_menu_order_com1);
			
			$room_rs_sers_order_com2 = $this->HotelAdminModel->get_room_service_order_complate_count($admin_id,$time5,$time6);
			$room_rs_menu_order_com2 = $this->HotelAdminModel->get_room_service_menu_order_complete_count($admin_id,$time5,$time6);
	
			$room_service_dashboard['com_third_four_hrs'] = array_merge($room_rs_sers_order_com2,$room_rs_menu_order_com2);
			
			$room_rs_sers_order_com3 = $this->HotelAdminModel->get_room_service_order_complate_count($admin_id,$time7,$time8);
			$room_rs_menu_order_com3 = $this->HotelAdminModel->get_room_service_menu_order_complete_count($admin_id,$time7,$time8);
	
			$room_service_dashboard['com_forth_four_hrs'] = array_merge($room_rs_sers_order_com3,$room_rs_menu_order_com3);
			
			$room_rs_sers_order_com4 = $this->HotelAdminModel->get_room_service_order_complate_count($admin_id,$time9,$time10);
			$room_rs_menu_order_com4 = $this->HotelAdminModel->get_room_service_menu_order_complete_count($admin_id,$time9,$time10);
	
			$room_service_dashboard['com_fifth_four_hrs'] = array_merge($room_rs_sers_order_com4,$room_rs_menu_order_com4);
		
			$room_rs_sers_order_com5 = $this->HotelAdminModel->get_room_service_order_complate_count($admin_id,$time11,$time12);
			$room_rs_menu_order_com5 = $this->HotelAdminModel->get_room_service_menu_order_complete_count($admin_id,$time11,$time12);
	
			$room_service_dashboard['com_six_four_hrs'] = array_merge($room_rs_sers_order_com5,$room_rs_menu_order_com5);
		
			// last 7 days pending order
			$room_rs_sers_order_7 = $this->HotelAdminModel->get_room_service_order_count1($admin_id,$time1,$time2);
			$room_rs_menu_order_7 = $this->HotelAdminModel->get_room_service_menu_order_count1($admin_id,$time1,$time2);
	
			$room_service_dashboard['first_four_hrs_7'] = array_merge($room_rs_sers_order_7,$room_rs_menu_order_7);
			
			$room_rs_sers_order_71 = $this->HotelAdminModel->get_room_service_order_count1($admin_id,$time3,$time4);
			$room_rs_menu_order_71 = $this->HotelAdminModel->get_room_service_menu_order_count1($admin_id,$time3,$time4);
	
			$room_service_dashboard['second_four_hrs_7'] = array_merge($room_rs_sers_order_71,$room_rs_menu_order_71);
			
			$room_rs_sers_order_72 = $this->HotelAdminModel->get_room_service_order_count1($admin_id,$time5,$time6);
			$room_rs_menu_order_72 = $this->HotelAdminModel->get_room_service_menu_order_count1($admin_id,$time5,$time6);
	
			$room_service_dashboard['third_four_hrs_7'] = array_merge($room_rs_sers_order_72,$room_rs_menu_order_72);
			
			$room_rs_sers_order_73 = $this->HotelAdminModel->get_room_service_order_count1($admin_id,$time7,$time8);
			$room_rs_menu_order_73 = $this->HotelAdminModel->get_room_service_menu_order_count1($admin_id,$time7,$time8);
	
			$room_service_dashboard['forth_four_hrs_7'] = array_merge($room_rs_sers_order_73,$room_rs_menu_order_73);
			
			$room_rs_sers_order_74 = $this->HotelAdminModel->get_room_service_order_count1($admin_id,$time9,$time10);
			$room_rs_menu_order_74 = $this->HotelAdminModel->get_room_service_menu_order_count1($admin_id,$time9,$time10);
	
			$room_service_dashboard['fifth_four_hrs_7'] = array_merge($room_rs_sers_order_74,$room_rs_menu_order_74);
		
			$room_rs_sers_order_75 = $this->HotelAdminModel->get_room_service_order_count1($admin_id,$time11,$time12);
			$room_rs_menu_order_75 = $this->HotelAdminModel->get_room_service_menu_order_count1($admin_id,$time11,$time12);
	
			$room_service_dashboard['six_four_hrs_7'] = array_merge($room_rs_sers_order_75,$room_rs_menu_order_75);
		
			//complete last 7 days
			$room_rs_sers_order_com_7 = $this->HotelAdminModel->get_room_service_order_complate_count1($admin_id,$time1,$time2);
			$room_rs_menu_order_com_7 = $this->HotelAdminModel->get_room_service_menu_order_complete_count1($admin_id,$time1,$time2);
	
			$room_service_dashboard['com_first_four_hrs_7'] = array_merge($room_rs_sers_order_com_7,$room_rs_menu_order_com_7);
			
			$room_rs_sers_order_com_71 = $this->HotelAdminModel->get_room_service_order_complate_count1($admin_id,$time3,$time4);
			$room_rs_menu_order_com_71 = $this->HotelAdminModel->get_room_service_menu_order_complete_count1($admin_id,$time3,$time4);
	
			$room_service_dashboard['com_second_four_hrs_7'] = array_merge($room_rs_sers_order_com_71,$room_rs_menu_order_com_71);
			
			$room_rs_sers_order_com_72 = $this->HotelAdminModel->get_room_service_order_complate_count1($admin_id,$time5,$time6);
			$room_rs_menu_order_com_72 = $this->HotelAdminModel->get_room_service_menu_order_complete_count1($admin_id,$time5,$time6);
	
			$room_service_dashboard['com_third_four_hrs_7'] = array_merge($room_rs_sers_order_com_72,$room_rs_menu_order_com_72);
			
			$room_rs_sers_order_com_73 = $this->HotelAdminModel->get_room_service_order_complate_count1($admin_id,$time7,$time8);
			$room_rs_menu_order_com_73 = $this->HotelAdminModel->get_room_service_menu_order_complete_count1($admin_id,$time7,$time8);
	
			$room_service_dashboard['com_forth_four_hrs_7'] = array_merge($room_rs_sers_order_com_73,$room_rs_menu_order_com_73);
			
			$room_rs_sers_order_com_74 = $this->HotelAdminModel->get_room_service_order_complate_count1($admin_id,$time9,$time10);
			$room_rs_menu_order_com_74 = $this->HotelAdminModel->get_room_service_menu_order_complete_count1($admin_id,$time9,$time10);
	
			$room_service_dashboard['com_fifth_four_hrs_7'] = array_merge($room_rs_sers_order_com_74,$room_rs_menu_order_com_74);
		
			$room_rs_sers_order_com_75 = $this->HotelAdminModel->get_room_service_order_complate_count1($admin_id,$time11,$time12);
			$room_rs_menu_order_com_75 = $this->HotelAdminModel->get_room_service_menu_order_complete_count1($admin_id,$time11,$time12);
	
			$room_service_dashboard['com_six_four_hrs_7'] = array_merge($room_rs_sers_order_com_75,$room_rs_menu_order_com_75);
		
			//current month pending order
			$room_rs_sers_order_cureent_mnt = $this->HotelAdminModel->get_room_service_order_current_mnt_count($admin_id,$time1,$time2);
			$room_rs_menu_order_cureent_mnt = $this->HotelAdminModel->get_room_service_menu_order_current_mnt_count($admin_id,$time1,$time2);
	
			$room_service_dashboard['first_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt,$room_rs_menu_order_cureent_mnt);
			
			$room_rs_sers_order_cureent_mnt1 = $this->HotelAdminModel->get_room_service_order_current_mnt_count($admin_id,$time3,$time4);
			$room_rs_menu_order_cureent_mnt1 = $this->HotelAdminModel->get_room_service_menu_order_current_mnt_count($admin_id,$time3,$time4);
	
			$room_service_dashboard['second_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt1,$room_rs_menu_order_cureent_mnt1);
			
			$room_rs_sers_order_cureent_mnt2 = $this->HotelAdminModel->get_room_service_order_current_mnt_count($admin_id,$time5,$time6);
			$room_rs_menu_order_cureent_mnt2 = $this->HotelAdminModel->get_room_service_menu_order_current_mnt_count($admin_id,$time5,$time6);
	
			$room_service_dashboard['third_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt2,$room_rs_menu_order_cureent_mnt2);
			
			$room_rs_sers_order_cureent_mnt3 = $this->HotelAdminModel->get_room_service_order_current_mnt_count($admin_id,$time7,$time8);
			$room_rs_menu_order_cureent_mnt3 = $this->HotelAdminModel->get_room_service_menu_order_current_mnt_count($admin_id,$time7,$time8);
	
			$room_service_dashboard['forth_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt3,$room_rs_menu_order_cureent_mnt3);
			
			$room_rs_sers_order_cureent_mnt4 = $this->HotelAdminModel->get_room_service_order_current_mnt_count($admin_id,$time9,$time10);
			$room_rs_menu_order_cureent_mnt4 = $this->HotelAdminModel->get_room_service_menu_order_current_mnt_count($admin_id,$time9,$time10);
	
			$room_service_dashboard['fifth_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt4,$room_rs_menu_order_cureent_mnt4);
		
			$room_rs_sers_order_cureent_mnt5 = $this->HotelAdminModel->get_room_service_order_current_mnt_count($admin_id,$time11,$time12);
			$room_rs_menu_order_cureent_mnt5 = $this->HotelAdminModel->get_room_service_menu_order_current_mnt_count($admin_id,$time11,$time12);
	
			$room_service_dashboard['six_four_hrs_curr_mnt'] = array_merge($room_rs_sers_order_cureent_mnt5,$room_rs_menu_order_cureent_mnt5);
		
			//complete current month
			$room_rs_sers_order_com_cureent_mnt = $this->HotelAdminModel->get_room_service_order_complete_count_current_mnt($admin_id,$time1,$time2);
			$room_rs_menu_order_com_cureent_mnt = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time1,$time2);
	
			$room_service_dashboard['com_first_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt,$room_rs_menu_order_com_cureent_mnt);
			
			$room_rs_sers_order_com_cureent_mnt1 = $this->HotelAdminModel->get_room_service_order_complete_count_current_mnt($admin_id,$time3,$time4);
			$room_rs_menu_order_com_cureent_mnt1 = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time3,$time4);
	
			$room_service_dashboard['com_second_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt1,$room_rs_menu_order_com_cureent_mnt1);
			
			$room_rs_sers_order_com_cureent_mnt2 = $this->HotelAdminModel->get_room_service_order_complete_count_current_mnt($admin_id,$time5,$time6);
			$room_rs_menu_order_com_cureent_mnt2 = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time5,$time6);
	
			$room_service_dashboard['com_third_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt2,$room_rs_menu_order_com_cureent_mnt2);
			
			$room_rs_sers_order_com_cureent_mnt3 = $this->HotelAdminModel->get_room_service_order_complete_count_current_mnt($admin_id,$time7,$time8);
			$room_rs_menu_order_com_cureent_mnt3 = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time7,$time8);
	
			$room_service_dashboard['com_forth_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt3,$room_rs_menu_order_com_cureent_mnt3);
			
			$room_rs_sers_order_com_cureent_mnt4 = $this->HotelAdminModel->get_room_service_order_complete_count_current_mnt($admin_id,$time9,$time10);
			$room_rs_menu_order_com_cureent_mnt4 = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time9,$time10);
	
			$room_service_dashboard['com_fifth_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt4,$room_rs_menu_order_com_cureent_mnt4);
		
			$room_rs_sers_order_com_cureent_mnt5 = $this->HotelAdminModel->get_room_service_order_complete_count_current_mnt($admin_id,$time11,$time12);
			$room_rs_menu_order_com_cureent_mnt5 = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_mnt($admin_id,$time11,$time12);
	
			$room_service_dashboard['com_six_four_hrs_cureent_mnt'] = array_merge($room_rs_sers_order_com_cureent_mnt5,$room_rs_menu_order_com_cureent_mnt5);
		
			//current year pending order
			$room_rs_sers_order_cureent_yr = $this->HotelAdminModel->get_room_service_order_current_yr_count($admin_id,$time1,$time2);
			$room_rs_menu_order_cureent_yr = $this->HotelAdminModel->get_room_service_menu_order_current_yr_count($admin_id,$time1,$time2);
	
			$room_service_dashboard['first_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr,$room_rs_menu_order_cureent_yr);
			
			$room_rs_sers_order_cureent_yr1 = $this->HotelAdminModel->get_room_service_order_current_yr_count($admin_id,$time3,$time4);
			$room_rs_menu_order_cureent_yr1 = $this->HotelAdminModel->get_room_service_menu_order_current_yr_count($admin_id,$time3,$time4);
	
			$room_service_dashboard['second_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr1,$room_rs_menu_order_cureent_yr1);
			
			$room_rs_sers_order_cureent_yr2 = $this->HotelAdminModel->get_room_service_order_current_yr_count($admin_id,$time5,$time6);
			$room_rs_menu_order_cureent_yr2 = $this->HotelAdminModel->get_room_service_menu_order_current_yr_count($admin_id,$time5,$time6);
	
			$room_service_dashboard['third_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr2,$room_rs_menu_order_cureent_yr2);
			
			$room_rs_sers_order_cureent_yr3 = $this->HotelAdminModel->get_room_service_order_current_yr_count($admin_id,$time7,$time8);
			$room_rs_menu_order_cureent_yr3 = $this->HotelAdminModel->get_room_service_menu_order_current_yr_count($admin_id,$time7,$time8);
	
			$room_service_dashboard['forth_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr3,$room_rs_menu_order_cureent_yr3);
			
			$room_rs_sers_order_cureent_yr4 = $this->HotelAdminModel->get_room_service_order_current_yr_count($admin_id,$time9,$time10);
			$room_rs_menu_order_cureent_yr4 = $this->HotelAdminModel->get_room_service_menu_order_current_yr_count($admin_id,$time9,$time10);
	
			$room_service_dashboard['fifth_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr4,$room_rs_menu_order_cureent_yr4);
		
			$room_rs_sers_order_cureent_yr5 = $this->HotelAdminModel->get_room_service_order_current_yr_count($admin_id,$time11,$time12);
			$room_rs_menu_order_cureent_yr5 = $this->HotelAdminModel->get_room_service_menu_order_current_yr_count($admin_id,$time11,$time12);
	
			$room_service_dashboard['six_four_hrs_curr_yr'] = array_merge($room_rs_sers_order_cureent_yr5,$room_rs_menu_order_cureent_yr5);
		
			//complete current year
			$room_rs_sers_order_com_cureent_yr = $this->HotelAdminModel->get_room_service_order_complete_count_current_yr($admin_id,$time1,$time2);
			$room_rs_menu_order_com_cureent_yr = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time1,$time2);
	
			$room_service_dashboard['com_first_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr,$room_rs_menu_order_com_cureent_yr);
			
			$room_rs_sers_order_com_cureent_yr1 = $this->HotelAdminModel->get_room_service_order_complete_count_current_yr($admin_id,$time3,$time4);
			$room_rs_menu_order_com_cureent_yr1 = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time3,$time4);
	
			$room_service_dashboard['com_second_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr1,$room_rs_menu_order_com_cureent_yr1);
			
			$room_rs_sers_order_com_cureent_yr2 = $this->HotelAdminModel->get_room_service_order_complete_count_current_yr($admin_id,$time5,$time6);
			$room_rs_menu_order_com_cureent_yr2 = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time5,$time6);
	
			$room_service_dashboard['com_third_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr2,$room_rs_menu_order_com_cureent_yr2);
			
			$room_rs_sers_order_com_cureent_yr3 = $this->HotelAdminModel->get_room_service_order_complete_count_current_yr($admin_id,$time7,$time8);
			$room_rs_menu_order_com_cureent_yr3 = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time7,$time8);
	
			$room_service_dashboard['com_forth_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr3,$room_rs_menu_order_com_cureent_yr3);
			
			$room_rs_sers_order_com_cureent_yr4 = $this->HotelAdminModel->get_room_service_order_complete_count_current_yr($admin_id,$time9,$time10);
			$room_rs_menu_order_com_cureent_yr4 = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time9,$time10);
	
			$room_service_dashboard['com_fifth_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr4,$room_rs_menu_order_com_cureent_yr4);
		
			$room_rs_sers_order_com_cureent_yr5 = $this->HotelAdminModel->get_room_service_order_complete_count_current_yr($admin_id,$time11,$time12);
			$room_rs_menu_order_com_cureent_yr5 = $this->HotelAdminModel->get_room_service_menu_order_complete_count_current_yr($admin_id,$time11,$time12);
	
			$room_service_dashboard['com_six_four_hrs_cureent_yr'] = array_merge($room_rs_sers_order_com_cureent_yr5,$room_rs_menu_order_com_cureent_yr5);
            $this->load->view('include/header');
			$this->load->view('page/roomservicedashboard1',$room_service_dashboard);
            $this->load->view('include/footer');
		}
		else
		{
			redirect(base_url());
		}
	}

    public function food_bverages_dashboard()
	{
		if($this->session->userdata('u_id'))
		{
			$hotel_id = $this->input->get('hotel_id');
			$food_dashboard['floor_list'] = $this->MainModel->get_floor_list($hotel_id);
            $admin_id = $this->session->userdata('u_id');
          	 //pending orders
			$time1 = "00:00:00";
			$time2 = "04:00:00";

			$time3 = "04:00:00";
			$time4 = "08:00:00";

			$time5 = "08:00:00";
			$time6 = "12:00:00";

			$time7 = "12:00:00";
			$time8 = "16:00:00";

			$time9 = "16:00:00";
			$time10 = "20:00:00";

			$time11 = "20:00:00";
			$time12 = "24:00:00";

			$food_dashboard['hotel_id'] = $hotel_id;

			$food_dashboard['first_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time1,$time2);
			
			$food_dashboard['second_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time3,$time4);
	
			$food_dashboard['third_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time5,$time6);
	
			$food_dashboard['forth_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time7,$time8);
			
			$food_dashboard['fifth_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time9,$time10);
					
			$food_dashboard['six_four_hrs'] = $this->MainModel->get_food_order_count($admin_id,$time11,$time12);
			
		
			//complete

			$food_dashboard['com_first_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time1,$time2);
			
			$food_dashboard['com_second_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time3,$time4);
			
			$food_dashboard['com_third_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time5,$time6);
			
			$food_dashboard['com_forth_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time7,$time8);
			
			$food_dashboard['com_fifth_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time9,$time10);
			
			$food_dashboard['com_six_four_hrs'] = $this->MainModel->get_food_order_complate_count($admin_id,$time11,$time12);
			
          
			// last 7 days pending order
			$food_dashboard['first_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time1,$time2);
			
			$food_dashboard['second_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time3,$time4);
			
			$food_dashboard['third_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time5,$time6);
			
			$food_dashboard['forth_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time7,$time8);		
			
			$food_dashboard['fifth_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time9,$time10);
			
			$food_dashboard['six_four_hrs_7'] = $this->MainModel->get_order_order_count1($admin_id,$time11,$time12);
			
		
			//complete last 7 days
			$food_dashboard['com_first_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time1,$time2);
			
			$food_dashboard['com_second_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time3,$time4);
			
			$food_dashboard['com_third_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time5,$time6);
			
			$food_dashboard['com_forth_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time7,$time8);
			
			$food_dashboard['com_fifth_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time9,$time10);
			
			$food_dashboard['com_six_four_hrs_7'] = $this->MainModel->get_food_order_complate_count1($admin_id,$time11,$time12);
			
			//current month pending order
			$food_dashboard['first_four_hrs_curr_mnt'] = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time1,$time2);
			
			$food_dashboard['second_four_hrs_curr_mnt'] = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time3,$time4);
			
			$food_dashboard['third_four_hrs_curr_mnt'] = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time5,$time6);
			
			$food_dashboard['forth_four_hrs_curr_mnt']  = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time7,$time8);
			
			$food_dashboard['fifth_four_hrs_curr_mnt'] = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time9,$time10);
			
			$food_dashboard['six_four_hrs_curr_mnt'] = $this->MainModel->get_food_order_current_mnt_count($admin_id,$time11,$time12);
			
          
            //complete current month
            $food_dashboard['com_first_four_hrs_cureent_mnt'] = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time1,$time2);
			
			$food_dashboard['com_second_four_hrs_cureent_mnt'] = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time3,$time4);
			
			$food_dashboard['com_third_four_hrs_cureent_mnt'] = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time5,$time6);
			
			$food_dashboard['com_forth_four_hrs_cureent_mnt']  = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time7,$time8);
			
			$food_dashboard['com_fifth_four_hrs_cureent_mnt'] = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time9,$time10);
			
			$food_dashboard['com_six_four_hrs_cureent_mnt'] = $this->MainModel->get_food_order_complete_count_current_mnt($admin_id,$time11,$time12);
            
           
            //current year pending order
            $food_dashboard['first_four_hrs_curr_yr'] = $this->MainModel->get_food_order_current_yr_count($admin_id,$time1,$time2);
			
			$food_dashboard['second_four_hrs_curr_yr'] = $this->MainModel->get_food_order_current_yr_count($admin_id,$time3,$time4);
			
			$food_dashboard['third_four_hrs_curr_yr'] = $this->MainModel->get_food_order_current_yr_count($admin_id,$time5,$time6);
			
			$food_dashboard['forth_four_hrs_curr_yr']  = $this->MainModel->get_food_order_current_yr_count($admin_id,$time7,$time8);
			
			$food_dashboard['fifth_four_hrs_curr_yr'] = $this->MainModel->get_food_order_current_yr_count($admin_id,$time9,$time10);
			
			$food_dashboard['six_four_hrs_curr_yr'] = $this->MainModel->get_food_order_current_yr_count($admin_id,$time11,$time12);
			
			//complete current year
            $food_dashboard['com_first_four_hrs_cureent_yr'] = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time1,$time2);
			
			$food_dashboard['com_second_four_hrs_cureent_yr'] = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time3,$time4);
			
			$food_dashboard['com_third_four_hrs_cureent_yr'] = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time5,$time6);
			
			$food_dashboard['com_forth_four_hrs_cureent_yr']  = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time7,$time8);
			
			$food_dashboard['com_fifth_four_hrs_cureent_yr'] = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time9,$time10);
			
			$food_dashboard['com_six_four_hrs_cureent_yr'] = $this->MainModel->get_food_order_complete_count_current_yr($admin_id,$time11,$time12);
		
			$food_dashboard["completed_order"] = $this->MainModel->get_completed_menu_list_pagination($admin_id);
			$food_dashboard["new_order_list"] = $this->FoodAdminModel->get_menu_new_order_food_admin($admin_id);
			$food_dashboard["rejected_order"] = $this->MainModel->get_rejected_menu_list_pagination($admin_id);
			$food_dashboard["total_order"] = $this->FoodAdminModel->get_total_food_order_count($admin_id);

          
            $this->load->view('include/header');
              $this->load->view('page/food_beverages_dashboard',$food_dashboard);
              $this->load->view('include/footer');
		}
		else
		{
			redirect(base_url());
		}
	}
	public function Viewfacility()
	{   
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
		$data["list"] = $this->MainModel->get_facility_list_pagination($hotel_id);
		$this->load->view('include/header');
		$this->load->view('foodadmin/viewFacility', $data);
		$this->load->view('include/footer');
	}

		public function baq_reser()
	{   
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
      	 $wh1 = '(request_status = 1 OR request_status = 2)';
		 $data["list"] = $this->MainModel->get_banquet_hall_all_list_pagination($hotel_id,$wh1);
		$this->load->view('include/header');
		$this->load->view('foodadmin/baq_reser', $data);
		$this->load->view('include/footer');
	}

	

	public function viewFacilityCategory()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
      	$data["list"] = $this->MainModel->get_facility_category_list_pagination($hotel_id);
		$this->load->view('include/header');
		$this->load->view('foodadmin/viewFacilityCategory', $data);
		$this->load->view('include/footer');
	}

	public function food_category_data_modal()
	{
		$id = $this->input->post('id');
		$where1 = '(food_facility_id ="'.$id.'")';
    	$data['get_facility_category'] = $this->FoodAdminModel->getAllData1('food_category',$where1);
		$this->load->view('foodadmin/ajax_category_Facility', $data);

	}

	public function viewMenuList()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
		  $facilities = $this->input->post('facilities');
		  $categories = $this->input->post('categories');
		  $menu_for_1 = $this->input->post('menu_for_1');


		  if (isset($_POST['search_1'])) 
		  {
			$wh = '(hotel_id ="'.$hotel_id.'" AND food_facility_id ="'.$facilities.'" AND food_category_id ="'.$categories.'" AND menus_for ="'.$menu_for_1.'")';
            $data["list"] = $this->FoodAdminModel->getfileter_wise_Data($hotel_id,$facilities,$categories,$menu_for_1);
			$this->load->view('include/header');
			$this->load->view('foodadmin/viewMenuList', $data);
			$this->load->view('include/footer');
		  }else{
			$data["list"] = $this->MainModel->get_menu_list_pagination($hotel_id);
		$this->load->view('include/header');
		$this->load->view('foodadmin/viewMenuList', $data);
		$this->load->view('include/footer');
		  }
      	
	}

		public function viewManageHalls()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
      	$where = '(added_by = 2 AND hotel_id ="'.$hotel_id.'")';
			$data['banq_hall'] = $this->MainModel->getAllData1($tbl ='banquet_hall', $where);
		$this->load->view('include/header');
		$this->load->view('foodadmin/viewManageHalls', $data);
		$this->load->view('include/footer');
	}

	public function newOrder()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
		// print_r($hotel_id);exit;
      	 $todays_date = date('Y-m-d');
		$data["new_reserve_order"] = $this->MainModel->get_reserve_table_pending_list_pagination($hotel_id,$todays_date);
		// echo "<pre>";
		// print_r($data["new_reserve_order"]);
		// exit;
		$data["accepted_reserve_order"] = $this->MainModel->get_reserve_table_accept_list_pagination($hotel_id);
		$where = '(request_status = 2 )';
      	$data["rejected_reserve_order"] = $this->MainModel->get_reserve_table_reject_list_pagination($hotel_id,$where);
		$this->load->view('include/header');
		$this->load->view('foodadmin/newOrder', $data);
		$this->load->view('include/footer');
	}

	public function acceptedOrder()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
      	$data["accepted_reserve_order"] = $this->MainModel->get_reserve_table_accept_list_pagination($hotel_id);
		$this->load->view('include/header');
		$this->load->view('foodadmin/acceptedOrder', $data);
		$this->load->view('include/footer');
	}

	public function rejectedOrder()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
      	$where = '(request_status = 2 OR request_status = 3)';
      	$data["rejected_reserve_order"] = $this->MainModel->get_reserve_table_reject_list_pagination($hotel_id,$where);
		$this->load->view('include/header');
		$this->load->view('foodadmin/rejectedOrder', $data);
		$this->load->view('include/footer');
	}

		public function staffdetails()
	{
		// $admin_id = $this->session->userdata('u_id');
		// $u_id = $this->uri->segment(3);
		
		// $wh_admin = '(u_id ="'.$admin_id.'")';
        // $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	// $hotel_id = $get_hotel_id['hotel_id']; 
      	// $where = '(request_status = 2 OR request_status = 3)';
		$u_id = $this->input->post('id');
		$hotel_id = $this->input->post('hotel_id');
		$wh = '(u_id = "'.$u_id.'")';
		$data['get_staff_details'] = $this->MainModel->getData('register',$wh);

      	$data["complete_list"] = $this->MainModel->get_user_complete_menu_list_pagination($hotel_id,$u_id);
		// $this->load->view('include/header');
		$this->load->view('foodadmin/ajaxstaffdetails', $data);
		// $this->load->view('include/footer');
	}

	

		public function staffManage()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
      	$data["staff_list"] = $this->MainModel->get_staff_list_pagination($hotel_id);
		$this->load->view('include/header');
		$this->load->view('foodadmin/staffManage', $data);
		$this->load->view('include/footer');
	}

			public function review()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
      	$data["staff_list"] = $this->MainModel->get_staff_list_pagination($hotel_id);
      	$data["list"] = $this->MainModel->get_user_review_pagination($hotel_id);
		$this->load->view('include/header');
		$this->load->view('foodadmin/review', $data);
		$this->load->view('include/footer');
	}

	  public function banq_hall_req_accept()
        {
            // $request_status = $this->input->post('request_status');
            
			$food_id = $this->session->userdata('u_id');
			$banquet_hall_orders_id = $this->input->post('data_id');

           // $banquet_hall_orders_id = $this->uri->segment(3);

            $wh = '(banquet_hall_orders_id = "'.$banquet_hall_orders_id.'")';

            $arr = array(
                            'request_status' => 1,
                            'assign_by' => 2,
                            'assign_by_u_id' => $food_id,
                        );

            $up = $this->MainModel->editData('banquet_hall_orders',$wh,$arr);

            if($up)
            {
					$get_u_id = $this->MainModel->getData($tbl='banquet_hall_orders', $wh);
					$wh1 = '(u_id = "'.$get_u_id['u_id'].'")';
					$get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);

					$deviceToken = $get_dt['token'];
					$title = 'Banquet Hall Request is Accepted';
					$body = array(
						'banquet_hall_orders_id' =>$banquet_hall_orders_id,
					);
					$result = send_push_notification($deviceToken, $title, $body);
					// print_r($result);die;

               	$admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
		        $data["list"] = $this->MainModel->get_banquet_hall_new_list_pagination($hotel_id);
		        $this->load->view('foodadmin/ajaxBanqHallReqAcceptList', $data);
            }
            else
            {
                $this->session->set_flashdata('add','Something went wrong');
                redirect(base_url('ban_new_req'));
            }
        }
    public function housekeeping_dashboard()
	{
        // print_r($this->session->userdata());die;
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');

			// floor list 
            $hotel_id = $this->input->get('hotel_id'); 
            $housekeeping_dashboard['floor_list'] = $this->MainModel->get_floor_list($hotel_id);
			// echo "<pre>";
			// print_r($this->db->last_query());
			// exit;

			$order_status1 = 0;
			$order_status2 = 1;
			$order_status3 = 2;
			$order_status4 = 3;
			
			$room_status1 = 3; //available
			$room_status2 = 2; //accupied
			$room_status3 = 1; //dirty
			$room_status4 = 4; //under maintainance

			$housekeeping_dashboard['hotel_id'] = $hotel_id;
			$hk_ld_total_order = $this->HotelAdminModel->total_order($admin_id);
			// $hk_total_order = $this->HotelAdminModel->get_house_keeping_service_order($admin_id,$order_status4);
			$housekeeping_dashboard['total_order'] = array_merge($hk_ld_total_order);


			$hk_ld_pending_order = $this->HotelAdminModel->get_laundry_order($admin_id,$order_status1);

			$hk_pending_order = $this->HotelAdminModel->get_house_keeping_service_order($admin_id,$order_status1);

			$housekeeping_dashboard['pending_order'] = array_merge($hk_ld_pending_order,$hk_pending_order);

			$hk_ld_accepted_order = $this->HotelAdminModel->get_laundry_order($admin_id,$order_status2);

			$hk_accepted_order = $this->HotelAdminModel->get_house_keeping_service_order($admin_id,$order_status2);

			$housekeeping_dashboard['accept_order'] = array_merge($hk_ld_accepted_order,$hk_accepted_order);

			$hk_ld_complete_order = $this->HotelAdminModel->get_laundry_order($admin_id,$order_status3);

			$hk_complete_order = $this->HotelAdminModel->get_house_keeping_service_order($admin_id,$order_status3);

			$housekeeping_dashboard['complete_order'] = array_merge($hk_ld_complete_order,$hk_complete_order);

			$hk_ld_reject_order = $this->HotelAdminModel->get_laundry_order($admin_id,$order_status4);

			$hk_reject_order = $this->HotelAdminModel->get_house_keeping_service_order($admin_id,$order_status4);

			$housekeeping_dashboard['reject_order'] = array_merge($hk_ld_reject_order,$hk_reject_order);

			$housekeeping_dashboard['total_expected_current_booking'] = $this->HotelAdminModel->get_hotel_expected_current_booking($admin_id);

			$housekeeping_dashboard['get_hotel_expected_departed_booking'] = $this->HotelAdminModel->get_hotel_expected_current_booking($admin_id);
			
			$housekeeping_dashboard['check_out_rooms'] = $this->HotelAdminModel->get_checkout_room_no($admin_id);
			
			$housekeeping_dashboard['total_availble_rooms'] = $this->HotelAdminModel->get_hotel_rooms_status($admin_id,$room_status1);

			$housekeeping_dashboard['total_accupied_rooms'] = $this->HotelAdminModel->get_hotel_rooms_status($admin_id,$room_status2);
			
			$housekeeping_dashboard['total_dirty_rooms'] = $this->HotelAdminModel->get_hotel_rooms_status($admin_id,$room_status3);
			
			$housekeeping_dashboard['total_undermaintance_rooms'] = $this->HotelAdminModel->get_hotel_rooms_status($admin_id,$room_status4);
			
			$housekeeping_dashboard['get_hk_notifications'] = $this->HotelAdminModel->get_notifications_for_housekeeping($admin_id);
	
			$user_type = 9;
			$is_active1 = 1;
			$is_active2 = 0;

			$housekeeping_dashboard['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);
			
			$housekeeping_dashboard['active_staff'] = $this->HotelAdminModel->get_particular_hotel_staff_list_count($admin_id,$user_type,$is_active1);
			
			$housekeeping_dashboard['deactive_staff'] = $this->HotelAdminModel->get_particular_hotel_staff_list_count($admin_id,$user_type,$is_active2);

			$time1 = "00:00:00";
			$time2 = "03:00:00";
			$time3 = "06:00:00";
			$time4 = "09:00:00";
			$time5 = "12:00:00";
			$time6 = "15:00:00";
			$time7 = "18:00:00";
			$time8 = "21:00:00";
			$time9 = "24:00:00";

			//room clean status
			$housekeeping_dashboard['first_hrs_room_clean_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart($admin_id,$time1,$time2);
			$housekeeping_dashboard['second_hrs_room_clean_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart($admin_id,$time2,$time3);
			$housekeeping_dashboard['third_hrs_room_clean_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart($admin_id,$time3,$time4);
			$housekeeping_dashboard['forth_hrs_room_clean_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart($admin_id,$time4,$time5);
			$housekeeping_dashboard['fifth_hrs_room_clean_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart($admin_id,$time5,$time6);
			$housekeeping_dashboard['sixth_hrs_room_clean_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart($admin_id,$time6,$time7);
			$housekeeping_dashboard['seventh_hrs_room_clean_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart($admin_id,$time7,$time8);
			$housekeeping_dashboard['eighth_hrs_room_clean_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart($admin_id,$time8,$time9);

			//room dirty status
			$housekeeping_dashboard['first_hrs_room_dirty_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart1($admin_id,$time1,$time2);
			$housekeeping_dashboard['second_hrs_room_dirty_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart1($admin_id,$time2,$time3);
			$housekeeping_dashboard['third_hrs_room_dirty_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart1($admin_id,$time3,$time4);
			$housekeeping_dashboard['forth_hrs_room_dirty_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart1($admin_id,$time4,$time5);
			$housekeeping_dashboard['fifth_hrs_room_dirty_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart1($admin_id,$time5,$time6);
			$housekeeping_dashboard['sixth_hrs_room_dirty_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart1($admin_id,$time6,$time7);
			$housekeeping_dashboard['seventh_hrs_room_dirty_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart1($admin_id,$time7,$time8);
			$housekeeping_dashboard['eighth_hrs_room_dirty_status'] = $this->HotelAdminModel->get_hotel_rooms_status_bar_chart1($admin_id,$time8,$time9);
			$this->load->view('include/header');
			$this->load->view('page/housekeepingdashboard',$housekeeping_dashboard);
            $this->load->view('include/footer');
		}
		else
		{
			redirect(base_url());
		}
	}
         public function banq_hall_req_reject()
        {
            // $request_status = $this->input->post('request_status');
            
			$food_id = $this->session->userdata('u_id');
			$banquet_hall_orders_id = $this->input->post('data_id');

          //  $banquet_hall_orders_id = $this->uri->segment(3);

            $wh = '(banquet_hall_orders_id = "'.$banquet_hall_orders_id.'")';

            $arr = array(
                            'request_status' => 2,
                            'assign_by' => 2,
                            'assign_by_u_id' => $food_id,
                        );

            $up = $this->MainModel->editData('banquet_hall_orders',$wh,$arr);

            if($up)
            {
              $admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
	        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
	      	$hotel_id = $get_hotel_id['hotel_id']; 
	        $data["list"] = $this->MainModel->get_banquet_hall_new_list_pagination($hotel_id);
	        $this->load->view('foodadmin/ajaxBanqHallReqAcceptList', $data);
            }
            else
            {
                $this->session->set_flashdata('add','Something went wrong');
                redirect(base_url('ban_new_req'));
            }
        }

	public function newRequest()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
      
		// print_r($hotel_id);
	 
		if(isset($_POST['search'])) 
		{	
			$date = $this->input->post('date');
			$hall_name = $this->input->post('hall_name');
			
			$data["list"] = $this->FoodAdminModel->get_banquet_hall_new_list_pagination_search($hotel_id,$date,$hall_name);
			$this->load->view('include/header');
			$this->load->view('foodadmin/newRequest', $data);
			$this->load->view('include/footer');
			
		
		}else if(isset($_POST['search'])){
			$date = $this->input->post('date');
			$order_sts = $this->input->post('order_sts');
			$data["list1"] = $this->FoodAdminModel->get_banquet_hall_all_list_pagination_search($hotel_id,$date,$order_sts);
			$this->load->view('include/header');
			$this->load->view('foodadmin/newRequest', $data);
			$this->load->view('include/footer');
		}
		else{
			$data["list"] = $this->MainModel->get_banquet_hall_new_list_pagination($hotel_id);
			$wh1 = '(request_status = 1 OR request_status = 2)';
			$data["list1"] = $this->MainModel->get_banquet_hall_all_list_pagination($hotel_id,$wh1);
		   
		   $this->load->view('include/header');
		   $this->load->view('foodadmin/newRequest', $data);
		   $this->load->view('include/footer');
		}

      	
	}

	public function newManageOrder()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id'];
		// print_r($todays_date);exit;
		$order_type = $this->input->post('order_type');
		$todays_date = date('Y-m-d');
		if (isset($_POST['search'])) 
		{
			$data["new_order_list"] = $this->FoodAdminModel->get_menu_new_order_list_pagination_1( $order_type, $todays_date,$hotel_id);
			$this->load->view('include/header');
			$this->load->view('foodadmin/newManageOrder', $data);
			$this->load->view('include/footer');
		}
		else
		{
			$data["new_order_list"] = $this->FoodAdminModel->get_menu_new_order_list_pagination_food_admin($todays_date,$hotel_id);
			$data["accepted_order"] = $this->MainModel->get_accepted_menu_list_pagination($hotel_id);
			$data["completed_order"] = $this->MainModel->get_completed_menu_list_pagination($hotel_id);
			$data["rejected_order"] = $this->MainModel->get_rejected_menu_list_pagination($hotel_id);
			$this->load->view('include/header');
			$this->load->view('foodadmin/newManageOrder', $data);
			$this->load->view('include/footer');
		}
       
	}

	public function new_food_ord_req_modal_data()
	{
		$food_order_id = $this->input->post('id');
		$wh_l = '(food_order_id = "' . $food_order_id . '")';
	   	$data['get_f_orders_data'] = $this->FoodAdminModel->getAllData1('food_order_details', $wh_l);
		// echo "<pre>";
		// print_r($data['get_f_orders_data']);
		// exit;
		$this->load->view('foodadmin/ajaxnew_food_ord_req', $data);
	}

	public function get_out_of_time_orders()
	{
		//log_message('error', 'timeout_order--'.json_encode('error_log'));
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id'];
		$ord_to_15min = date('Y-m-d H:i:s', (time() - 60 * 15));
		$time_out_ord = $this->FoodAdminModel->outof_time_food_order($ord_to_15min,$hotel_id);
		$arr_to_string = array_column($time_out_ord,'food_order_id');
		$result =[];
		foreach($arr_to_string as $val_time)
		{
			$where = '(food_order_id = "'.$val_time.'" AND hotel_id ="'.$hotel_id.'" AND order_status = 0)';
				$arr= array(
					'out_of_time_status'=>1,
				);
				$out_of_time_status_update = $this->FoodAdminModel->editData($tbl="food_orders",$where,$arr);
				$result[]= $val_time;
		}
		$data = $result;
		// echo "<pre>";
		// print_r($data);
		// exit;
		echo json_encode($data); 
	}

	public function change_new_order_status()
	{
		// echo "hii";die;
		// $a=$this->input->post();print_r($a);exit;
		$food_order_id = $this->input->post('food_order_id');
		$order_status = $this->input->post('order_status');
		$reject_reason = $this->input->post('reject_reason');

		$staff_id =$this->input->post('staff_id');
		$hotel_id =$this->input->post('hotel_id');
		$u_id =$this->input->post('u_id');
		// print_r($u_id);die;
		$booking_id =$this->input->post('booking_id');
		$todays_date = date('Y-m-d');
	  
		$otp = rand('1111','9999');
	   
		if ($order_status == 1) 
		{
				$arr = array(
								'order_status' =>$order_status,
								'staff_id' =>$staff_id,
								'accept_date'=>date('Y-m-d'),
								  'accept_time'=>date('G:i:s'),
								  'otp' => $otp
							);
				$wh = '(food_order_id = "'.$food_order_id.'")';
				$add = $this->MainModel->editData($tbl='food_orders', $wh, $arr);
				if ($add) 
				{
					
					$wh1 = '(u_id = "'.$u_id.'")';
					$get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);

					$deviceToken = $get_dt['token'];
					$title = 'Food Order Is Accepted';
					$body = array(
						'food_order_id' =>$food_order_id,
						
					);
					$result = send_push_notification($deviceToken, $title, $body);
					
					// notification for staff
					$get_u_id = $this->MainModel->getData($tbl='food_orders', $wh);
					$wh_s = '(u_id = "'.$get_u_id['staff_id'].'")';
					// print_r($wh_s);die;
					$get_staff_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh_s);

					$deviceToken1= $get_staff_dt['token'];
					$title1 = 'New Order Assign ';
					$body1 = array(
						'food_order_id' =>$food_order_id,
						
					);
					$result1 = send_push_notification_for_staff($deviceToken1, $title1, $body1);
					print_r($result1);die;

					   $arr= array(
									'hotel_id' => $hotel_id,
									'staff_id'=>$staff_id,
									'u_id'=>$u_id,
									'booking_id'=>$booking_id,                                       
									'description' => 'Food Order Assing to the staff',
									'activity_for' => 3                     
							   );
					$add1 = $this->MainModel->insertData($tbl="activity_of_hotel",$arr);
					$data["new_order_list"] = $this->FoodAdminModel->get_menu_new_order_list_pagination_food_admin($todays_date,$hotel_id);
				  

					$this->load->view('foodadmin/ajaxnewManageOrder', $data);
							  
				} 
				else 
				{
					$this->session->set_flashdata('add', 'Something went Wrong');
					redirect(base_url('new_order'));
				}
		}
		elseif($order_status == 3)
		{
				$arr1 = array(
								'order_status' =>$order_status,
								'reject_reason' =>$reject_reason,
								'staff_id' =>0,
								'reject_date' =>date('Y-m-d')   
							);
				$wh1 = '(food_order_id = "'.$food_order_id.'")';
				$add = $this->MainModel->editData($tbl='food_orders', $wh1, $arr1);

				if ($add) 
				{
					$wh2 = '(u_id = "'.$u_id.'")';
					$get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh2);

					$deviceToken = $get_dt['token'];
					$title = 'Food Order Is Rejected';
					$body = array(
						'food_order_id' =>$food_order_id,
						'reject_reason' =>$reject_reason,
					);
					$result = send_push_notification($deviceToken, $title, $body);


					$data["new_order_list"] = $this->FoodAdminModel->get_menu_new_order_list_pagination_food_admin($todays_date,$hotel_id);
					$this->load->view('foodadmin/ajaxnewManageOrder', $data);
				} 
				else 
				{
					$this->session->set_flashdata('add', 'Something went Wrong');
					redirect(base_url('new_order'));
				}
		}
	}

	public function reassign_orders()
	{
		// echo "<pre>";
		// print_r($this->input->post());
		// exit;
		$hotel_id = $this->input->post('hotel_id');
		$food_order_id = $this->input->post('food_order_id');
		$staff_id = $this->input->post('staff_id');
		$otp = rand('1111','9999');
		if(!empty($food_order_id))
		{
			$arr = array(
				'staff_id' =>$staff_id,
				'accept_date'=>date('Y-m-d'),
				'accept_time'=>date('G:i:s'),
				'otp' => $otp
			);
			$wh = '(food_order_id = "'.$food_order_id.'")';
			$add = $this->MainModel->editData($tbl='food_orders', $wh, $arr);
			$data["reassign_order_list"] = $this->MainModel->get_accepted_menu_list_pagination($hotel_id);
			$this->load->view('foodadmin/ajaxreassignOrder', $data);
		}
	}

	public function profile()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
        //  $where = $wh_admin;
			$data['admin_details'] = $this->MainModel->getData($tbl ='register', $wh_admin);
       $this->load->view('include/header');
		$this->load->view('foodadmin/profile', $data);
		$this->load->view('include/footer');
	}

	public function newAcceptOrder()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
		$order_type = $this->input->post('order_type');

		if (isset($_POST['search'])) 
		{
			
			$data["accepted_order"] = $this->FoodAdminModel->get_accepted_menu_list_pagination_search($order_type);
			$this->load->view('include/header');
			$this->load->view('foodadmin/newAcceptOrder', $data);
			$this->load->view('include/footer');

		}
		else{
		
			$data["accepted_order"] = $this->MainModel->get_accepted_menu_list_pagination($hotel_id);
		//  echo '<pre>';print_r($data["list"]);exit;
			$this->load->view('include/header');
			$this->load->view('foodadmin/newAcceptOrder', $data);
			$this->load->view('include/footer');

		}

	}

	public function newCompleteOrder()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
		$order_type = $this->input->post('order_type');
		if (isset($_POST['search'])) 
		{
		
			$data["completed_order"] = $this->FoodAdminModel->get_completed_menu_list_pagination_search($order_type,$hotel_id);
			$this->load->view('include/header');
			$this->load->view('foodadmin/newCompleteOrder', $data);
			$this->load->view('include/footer'); 
			
		}
		else{
		$data["completed_order"] = $this->MainModel->get_completed_menu_list_pagination($hotel_id);
		$this->load->view('include/header');
		$this->load->view('foodadmin/newCompleteOrder', $data);
		$this->load->view('include/footer');
		}
       
	}

	public function newRejectOrder()
	{
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id'];
		$order_type = $this->input->post('order_type'); 
		if (isset($_POST['search'])) 
		{
			
			$data["rejected_order"] = $this->FoodAdminModel->get_rejected_menu_list_pagination_search($order_type,$hotel_id);
			$this->load->view('include/header');
			$this->load->view('foodadmin/newRejectOrder', $data);
			$this->load->view('include/footer');
			
		}
		else{
			$data["rejected_order"] = $this->MainModel->get_rejected_menu_list_pagination($hotel_id);
			$this->load->view('include/header');
			$this->load->view('foodadmin/newRejectOrder', $data);
			$this->load->view('include/footer');
		}
       
	}

	public function add_facility()
	{

		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
		$file="";
         if (!empty($_FILES['File']['name'])) 
         {
              $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
              $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
              $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
              $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
              $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];

              $path = 'assets/dist/picture/';
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
        
        
            $type = $this->input->post('facility_name');
            $desc = $this->input->post('desc');
            
            $arr= array(
                    'facility_name'=>$type,
                    'description'=>$desc,
                    'icon'=>base_url().$file,
                    'added_by'=>2,
                    'added_by_u_id'=>$get_hotel_id['u_id'],
                    'hotel_id' =>$get_hotel_id['hotel_id']
               );
             $add = $this->MainModel->insertData($tbl="food_facility",$arr);
            if($add)
            {
            	$admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
				$data["list"] = $this->MainModel->get_facility_list_pagination($hotel_id);
				$this->load->view('foodadmin/ajaxFacilityList', $data);
			}
            
	}

	public function update_facility()
      {
            $id = $this->input->post('food_facility_id');
            $facility_name = $this->input->post('facility_name');
            $desc =$this->input->post('description');
			// $a=$this->input->post();print_r($a);die;
        
            $wh = '(food_facility_id = "'.$id.'")';       
            $get_img['food_facility']= $this->FoodAdminModel->getData($tbl='food_facility', $wh);
			// print_r($get_img);
            $img=$get_img['food_facility']['icon'];
			// print_r($get_img['food_facility']['icon']);die;
            if (!empty($_FILES['File']['name']))
            {

                $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
                $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
                $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
                $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
                $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];

                $path = 'assets/dist/picture/';
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
                            'facility_name' =>$facility_name,
                            'description' =>$desc,
                            'icon' => $file
                        );

            
            $add = $this->MainModel->editData($tbl='food_facility',$wh,$arr);
            if($add)
            {
              $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
				$data["list"] = $this->MainModel->get_facility_list_pagination($hotel_id);
				$this->load->view('foodadmin/ajaxFacilityList', $data);
            }
           
      }


    public function delete_facility()
	{          
		$id=$this->input->post('id');

		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
		$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		$hotel_id = $get_hotel_id['hotel_id']; 

		$where = '(food_facility_id = "'.$id.'" AND hotel_id = "'.$hotel_id.'")';
		$del_categories= $this->MainModel->deleteData($tbl="food_category", $where);

		$where = '(food_facility_id = "'.$id.'" AND hotel_id = "'.$hotel_id.'")';
		$del_menus= $this->MainModel->deleteData($tbl="food_menus", $where);

		$where = '(food_facility_id = "'.$id.'" AND hotel_id = "'.$hotel_id.'")';
		$result= $this->MainModel->deleteData($tbl="food_facility", $where);

		if($result)
		{
			echo "1";
		}
		else
		{ 
			echo "0";
		}
	}

       public function add_category()
      {
            $food_facility_id = $this->input->post('facility_name');
            $cat_name = $this->input->post('cat_name');
          

            //food admin id
            $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
            	$added_by_u_id = $get_hotel_id['u_id'];

            $arr= array(
                            'food_facility_id'=>$food_facility_id,
                            'category_name'=>$cat_name,
                            'added_by'=>2,
                            'added_by_u_id'=>$added_by_u_id, 
                            'hotel_id'=>$hotel_id                         
                       );
     
            $add = $this->MainModel->insertData($tbl="food_category",$arr);
            if($add)
            {
               $data["list"] = $this->MainModel->get_facility_category_list_pagination($hotel_id);
				$this->load->view('foodadmin/ajaxCategoryList', $data);
            }
            
           
            
      }


       public function add_staff()
        {
            $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
          
            $full_name =$this->input->post('full_name');
            $mobile =$this->input->post('mobile');
            $email =$this->input->post('email');
            $address =$this->input->post('address');          	
          
            $file="";
            if (!empty($_FILES['File']['name'])) 
            {
                $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
                $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
                $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
                $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
                $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];

                $path = 'assets/dist/staff_profile/';
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
              				'hotel_id' => $hotel_id,
                            'user_type'=>8,
                            'user_is'=>2,
                            'full_name'=>$full_name,
                            'mobile_no'=>$mobile,
                            'email_id'=>$email, 
                            'address'=>$address,
              				'profile_photo' =>base_url().$file,
                            'is_active' => 1,
                            'register_date' => date('Y-m-d')                      
                       );
     
            $add = $this->MainModel->insertData($tbl="register",$arr);
            if($add)
            {
                $data["staff_list"] = $this->MainModel->get_staff_list_pagination($hotel_id);
				$this->load->view('foodadmin/ajaxStaffList', $data);
            }
          
        }

        
         public function update_staff_details()
        {
            $u_id = $this->input->post('u_id');
           $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
          	$where='(u_id ="'.$u_id.'")';
            $profile_img= $this->MainModel->getData($tbl='register', $where);
            $img=$profile_img['profile_photo'];
  
              if (!empty($_FILES['File']['name']))
              {
  
                  $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
                  $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
                  $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
                  $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
                  $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];
  
                  $path = 'assets/dist/profie/';
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
  
                      return $error;
                  }
              } 
              else
              {
                  $file=$img;
              }
          
            $arr = array(
                            'full_name'=> $this->input->post('full_name'),
                            'mobile_no'=> $this->input->post('mobile'), 
                            'email_id' => $this->input->post('email'),
                            'address'=> $this->input->post('address'),
              				'profile_photo'=> base_url().$file
                        );
            
            $where = '(u_id = "'.$u_id.'")';
            $edit= $this->MainModel->editData($tbl='register', $where, $arr);
            if($edit)
            {
                $data["staff_list"] = $this->MainModel->get_staff_list_pagination($hotel_id);

				$this->load->view('foodadmin/ajaxStaffList', $data);

            }
              
        }

          public function delete_staff()
        {
            $id=$this->input->post('id');

            $where = '(u_id = "'.$id.'")';
            $result= $this->MainModel->deleteData($tbl="register", $where);
            if ($result) 
            {
                echo "1";
            } 
            else 
            {
                echo "0";
            }
        }



public function addMenu($value='')
{
	$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id']; 
        // $data["list"] = $this->MainModel->get_facility_list_pagination($hotel_id);
         $data["list"] = [];
		$this->load->view('include/header');
		$this->load->view('foodadmin/addMenu', $data);
		$this->load->view('include/footer');
}

 		public function add_menus()
        {
          	$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
	        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
	      	$hotel_id = $get_hotel_id['hotel_id']; 
			// $a=$this->input->post();echo "<pre>";print_r($a);die;
            $food_facility_id = $this->input->post('food_facility');
            $food_category_id = $this->input->post('food_category');
            $menus_for = $this->input->post('menu_for');
            $items_name = $this->input->post('items_name');
            $price = $this->input->post('price');
            $offer_in_per = $this->input->post('offer');
            $prepartion_time = $this->input->post('prepartion_time');
            $time_in = $this->input->post('time_in'); 
            $description = $this->input->post('description');
			$update_image = date("Y_m_d_H_m_s").'-'.$_FILES['file']['name']; 
			$file = "";
			if(!empty($_FILES['file']['name'])){
			
				$uploadPath =  realpath(FCPATH . 'assets/dist/picture/');
				
				//$config['overwrite'] = TRUE;
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = '*'; 
				$config['file_name'] = $update_image;  
				
				// Load and initialize upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				// Upload file to server
				if($this->upload->do_upload('file')){   
					$update_filename = $this->upload->data();
					$postArr['file'] = $update_filename['file_name'];
					$file_path_url = base_url() . 'assets/dist/picture/' . $update_filename['file_name'];
					$file = $file_path_url; 
				}
			} 
			// echo "<pre>";
			// print_r($file);
			// exit;
            $arr= array(
                'hotel_id'=>$hotel_id,
                'food_facility_id'=>$food_facility_id,
                'food_category_id'=>$food_category_id,
                'menus_for'=>$menus_for,  
                'items_name'=>$items_name,
                'price'=>$price,  
                'offer_in_per'=>$offer_in_per,  
                'prepartion_time'=>$prepartion_time,
                'time_in'=>$time_in,
                'description'=>$description, 
                'item_img' =>$file                  
           );
            $add = $this->MainModel->insertData($tbl="food_menus",$arr);
            if($add)
            {
                // $this->session->set_flashdata('add','Success..!');
                // redirect(base_url('menulist'));
                  $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
				$data["list"] = $this->MainModel->get_menu_list_pagination($hotel_id);
				$this->load->view('foodadmin/ajaxMenuList', $data);
            }
            // else
            // {
            //     $this->session->set_flashdata('add','Something went Wrong');
            //     redirect(base_url('menulist')); 
            // }

        }
		public function panel_notification()
		{
			// echo "<pre>";
			//  print_r($this->session->userdata());
			//  exit;
			if($this->session->userdata('u_id'))
			{
				$u_id = $this->session->userdata('u_id');
			  
				$where ='(u_id = "'.$u_id.'")';
			  
				$admin_details = $this->MainModel->getData($tbl ='register', $where);
			  
				$admin_id = $admin_details['hotel_id'];
			  
				$u_id11 = $admin_details['u_id'];

				$all_room_notification['userType'] = $this->session->userdata('userType');

				  $all_room_notification['get_rs_notifications'] = $this->MainModel->get_notifications_for_rs_1($admin_id);
	
				  $department_id = '';
				  if($all_room_notification['userType'] == 7)
				  {
					  $department_id = 5;
				  }
				  else
				  {
					  $department_id = 3;
				  }
				$all_room_notification['get_staff_orders'] = $this->MainModel->get_staff_noti($admin_id,$department_id);
				$this->load->view('include/header');
				$this->load->view('page/show_all_notification',$all_room_notification);
				$this->load->view('include/footer');
				
			}
			else
			{
				redirect(base_url());
			}
		}
		
	
	 
	  public function update_menus()
        {
            
            $food_item_id= $this->input->post('food_item_id');           
            $where='(food_item_id ="'.$food_item_id.'")';
     
            $menu_img['food']= $this->MainModel->getData($tbl='food_menus', $where);
            $img=$menu_img['food']['item_img'];

			$update_image = date("Y_m_d_H_m_s").'-'.$_FILES['item_img']['name']; 
			// echo "<pre>";
			// print_r($update_image);
			// exit;
			$file = "";
			if(!empty($_FILES['item_img']['name'])){
			
				$uploadPath =  realpath(FCPATH . 'assets/dist/picture/');
				
				//$config['overwrite'] = TRUE;
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = '*'; 
				$config['file_name'] = $update_image;  
				
				// Load and initialize upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				// Upload file to server
				if($this->upload->do_upload('item_img')){   
					$update_filename = $this->upload->data();
					$postArr['item_img'] = $update_filename['file_name'];
					$file_path_url = base_url() . 'assets/dist/picture/' . $update_filename['file_name'];
					$file = $file_path_url; 
				}
			} 
			else
			{
				$file = $img;
			}
          
		 $arr = array(
              'food_facility_id'=> $this->input->post('facility1'),
              'food_category_id'=> $this->input->post('category'),
              'menus_for'=> $this->input->post('menu_for'),
              'items_name' => $this->input->post('items_name'),
              'price' => $this->input->post('price'),
              'offer_in_per' => $this->input->post('offer_in_per'),
              'prepartion_time' => $this->input->post('prepartion_time'),
              'time_in' => $this->input->post('time_in'),
              'description' => $this->input->post('description'),
              'item_img'=> $file,
          );

             $edit= $this->MainModel->editData($tbl='food_menus', $where, $arr);
             if($edit)
             {
                // $this->session->set_flashdata('add','Data Update..!');
                // redirect(base_url('menus_list'));
                 $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
				$data["list"] = $this->MainModel->get_menu_list_pagination($hotel_id);
				$this->load->view('foodadmin/ajaxMenuList', $data);
             }
             // else
             // {
             //    $this->session->set_flashdata('add','Something went Wrong');
             //    redirect(base_url('menus_list')); 
             // }      
        }

         public function delete_menus()
        {          
              $food_item_id=$this->input->post('id');
              $where = '(food_item_id = "'.$food_item_id.'")';
              $result= $this->MainModel->deleteData($tbl="food_menus", $where);
              if($result)
              {
              echo "1";
              }
              else
              { 
              echo "0";
              }
        }

public function get_menu_price()
        {
            
            $menu_n = $this->input->post('menu_n');
            
            $where = '(food_item_id = "'.$menu_n.'")';
            $menu_price = $this->MainModel->getData('food_menus',$where);
   
            $arr = array($menu_price['price'],$menu_price['item_img']);
            //print_r($arr);
            echo json_encode($arr);
           // $output = ''; 
            
            //$output .= $menu_price['price'];
            
            //echo $output;
        } 
        

        public function add_menu_orders()
        {
          	$otp = rand('1111','9999');
          	$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
		    $get_data = $this->MainModel->getData('register',$wh_admin);
				
      		$hotel_id = $get_data['hotel_id'];
		     
            $u_id = $this->input->post('user_id');
            $room_number = $this->input->post('room_number'); 
            // $staff_id = $this->input->post('staff_id');
            $staff_id = 0;
            $order_from = $this->input->post('order_from');
			// print_r($order_from)  ;die;
          
          
            //single values
            $food_menus = $this->input->post('food_menus');
            $menu_price = $this->input->post('menu_price');
            $menu_qty = $this->input->post('menu_qty');
       
            //multiple values
            $food_menus_1 = $this->input->post('food_menus_1');
            $food_menu_price = $this->input->post('food_menu_price');
            $food_menu_qty = $this->input->post('food_menu_qty');
			$additional_note = $this->input->post('additional_note');
			$food_facility_id = $this->input->post('food_facility_id');
			$food_facility_ids = implode(',',$food_facility_id);
			// echo "<pre>";
			// print_r($this->input->post());
			// exit;
			// echo "<pre>";
			// print_r($food_facility_ids);
			// exit;
            //get food order total
            $total_menu_price = 0;
            $total_menu_qty = 0;
            $count = count($food_menus_1);
            for ($i = 0; $i < $count; $i++) 
            {
            	$total_menu_price = $total_menu_price + $food_menu_price[$i];
            	$total_menu_qty = $total_menu_qty + $food_menu_qty[$i];
            }
        
            // $order_total = $menu_price * $menu_qty;
            $order_total = $total_menu_price;
          
            //get booking id        
            $enquiry_id = $this->input->post('enquiry_id');
       	    $date= date('Y-m-d');
            $booking_id = '';
            $wh11 = '(u_id = "'.$u_id.'" AND check_out >= "'.$date.'" AND enquiry_id="'. $enquiry_id.'")';
            $get_data_booking_id = $this->MainModel->getData('user_hotel_booking', $wh11);
            // var_dump( $get_data_booking_id);die;
            if(!empty($get_data_booking_id))
            {
              $booking_id = $get_data_booking_id['booking_id'];
            }

            $arr= array(
                            'hotel_id'=>$get_data['hotel_id'],
							'food_facility_id'=> $food_facility_ids,
                            'u_id' =>$u_id,
                            'room_no'=>$room_number,
              				'booking_id' => $booking_id,
                            'staff_id'=>$staff_id,
							'additional_note'=>$additional_note,
                            'order_from'=>$order_from,
                            'order_date' =>date('Y-m-d'),
                            'order_time' =>date("G:i:s"),
              				'accept_date'=>date('Y-m-d'),
              				'accept_time' =>date("G:i:s"),
                            'order_status'=>0,
              				'order_total' => $order_total,
                            'added_by' =>1,
                            'out_of_time_status' =>0,
              				'otp' => $otp,
                            'added_by_u_id' =>$get_data['u_id']
                       );
            
            $add = $this->MainModel->insertData($tbl="food_orders", $arr);
            if($add)
            {
				// echo "hiiiiiiiiiii";exit;
				// if (!empty($food_menus)) 
				// {
				// 	$arr2 = array(
				// 					'hotel_id' =>$get_data['hotel_id'],
				// 					'food_order_id'=>$add,                                
				// 					'food_items_id' => $food_menus,
				// 					'price' => $menu_price,
				// 					'quantity' => $menu_qty,
				// 				);
				// 	$insert_id2 = $this->MainModel->insertData($tbl="food_order_details", $arr2);
				// }

                //add multiple menus
				$todays_date = date('Y-m-d');
				$data["new_order_list"] = $this->FoodAdminModel->get_manageorder_new($hotel_id,$todays_date);
				// echo "<pre>";print_r($data);exit;
				$this->load->view('foodadmin/ajaxnewManageOrder',$data);
                if (!empty($food_menus_1)) 
                {
                    $count = count($food_menus_1);
                    for ($i = 0; $i < $count; $i++) 
                    {
                        $arr3 = array(
                                        'hotel_id' =>$get_data['hotel_id'],
                                        'food_order_id'=>$add,
                                        'food_items_id' => $food_menus_1[$i],
                                        'price' => $food_menu_price[$i],
                                        'quantity' => $food_menu_qty[$i],
                                    );
                        $insert_id3 = $this->MainModel->insertData($tbl="food_order_details", $arr3);
							// echo "<pre>";
							// print_r($insert_id3);
							// exit;
                    }
                                     
                }
                 // $this->session->set_flashdata('add', 'Success');
                 // redirect(base_url('accepted_order'));
                $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
		      	
                // $data["list"] = $this->MainModel->get_menu_new_order_list_pagination($hotel_id);
                // $tblblock['block'] = $this->load->view('foodadmin/ajaxOrderCreate', $data);
                $tblblock['success'] = 1;
                // echo $tblblock;exit;

              //  $this->load->view('foodadmin/ajaxOrderCreate', $data);
                // echo '<pre>';print_r($tblblock);exit;
                // echo json_encode($tblblock, JSON_UNESCAPED_SLASHES);die;
                //echo json_encode(['success'=>1,'blockArr'=> $tblblock]);
            }
            else 
            {
            	$tblblock['block'] = "Something went Wrong";
                $tblblock['success'] = 2;
                echo json_encode($tblblock, JSON_UNESCAPED_SLASHES);die;
            	 //echo json_encode(['success'=>2,'blockArr'=> "Something went Wrong"]);
                // $this->session->set_flashdata('add', 'Something went Wrong');
                // redirect(base_url('new_order'));
            }
        }  


 public function change_new_table_reserve_status()
        {
			$rejected_reg = $this->input->post('reject_reason');
            $reserve_table_id = $this->input->post('reserve_table_id');
            $request_status = $this->input->post('request_status');
            
            if ($request_status == 1) 
            {
                    $arr = array(
							'request_status' =>$request_status,
							'accept_date'=>date('Y-m-d')
						);
                    $wh = '(reserve_table_id = "'.$reserve_table_id.'")';
                    $add = $this->MainModel->editData($tbl='reserve_table', $wh, $arr);
                    if ($add) 
                    {
						$get_u_id = $this->MainModel->getData($tbl='reserve_table', $wh);
						$wh1 = '(u_id = "'.$get_u_id['u_id'].'")';
						$get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);

						$deviceToken = $get_dt['token'];
						$title = 'Reserve Table Request is Accepted';
						$body = array(
							'reserve_table_id' =>$reserve_table_id,
						);
						$result = send_push_notification($deviceToken, $title, $body);

                    	$admin_id = $this->session->userdata('u_id');
						$wh_admin = '(u_id ="'.$admin_id.'")';
				        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
				      	$hotel_id = $get_hotel_id['hotel_id']; 
				      	 $todays_date = date('Y-m-d');
						$data["new_reserve_order"] = $this->MainModel->get_reserve_table_pending_list_pagination($hotel_id,$todays_date);
						$this->load->view('foodadmin/ajaxReserveOrderList', $data);

                        // $this->session->set_flashdata('add', 'Success..!');
                        // redirect(base_url('Table_mang'));
                    } 
                    else 
                    {
                        $this->session->set_flashdata('add', 'Something went Wrong');
                        redirect(base_url('Table_mang'));
                    }
            }
            elseif($request_status == 2)
            {
                    $arr1 = array(
                                    'request_status' =>$request_status, 
									'reject_reason' =>$rejected_reg,  
                                    'reject_date' =>date('Y-m-d')   
                                );

                    $wh1 = '(reserve_table_id = "'.$reserve_table_id.'")';
                    $add = $this->MainModel->editData($tbl='reserve_table', $wh1, $arr1);
                    if ($add) 
                    {
						$get_u_id = $this->MainModel->getData($tbl='reserve_table', $wh1);
						$wh1 = '(u_id = "'.$get_u_id['u_id'].'")';
						$get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);

						$deviceToken = $get_dt['token'];
						$title = 'Reserve Table Request is Accepted';
						$body = array(
							'reserve_table_id' =>$reserve_table_id,
							'rejected_reason' =>$rejected_reg,
						);
						$result = send_push_notification($deviceToken, $title, $body);
						// print_r($result);die;
                       $admin_id = $this->session->userdata('u_id');
						$wh_admin = '(u_id ="'.$admin_id.'")';
				        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
				      	$hotel_id = $get_hotel_id['hotel_id']; 
				      	 $todays_date = date('Y-m-d');
						$data["new_reserve_order"] = $this->MainModel->get_reserve_table_pending_list_pagination($hotel_id,$todays_date);
						$this->load->view('foodadmin/ajaxReserveOrderList', $data);
                    } 
                    else 
                    {
                        $this->session->set_flashdata('add', 'Something went Wrong');
                        redirect(base_url('Table_mang'));
                    }
            }

        } 


public function update_status_user()
        {
            $arr=array(
                        'is_active'=>$_POST['active']
                      );
            
            $u_id=$_POST['uid'];
            $where = '(u_id="' . $u_id . '")';
            $id=$this->MainModel->editData($tbl="register",$where,$arr); 
            if($id)
            {
                echo json_encode(TRUE);
            }
            else
            {
                echo json_encode(FALSE);
            }	
        }

         public function delete_hall()
        {          
              $banquet_hall_id=$this->input->post('id');
              $where = '(banquet_hall_id = "'.$banquet_hall_id.'")';
              $result= $this->MainModel->deleteData($tbl="banquet_hall", $where);
              if($result)
              {
              	echo "1";
              }
              else
              { 
              	echo "0";
              }
        }


public function add_banq_hall()
        {
            $u_id = $this->session->userdata('u_id');
            $where = '(u_id = "'.$u_id.'")';
            $admin_details = $this->MainModel->getData('register',$where);
        
            $arr= array(
                            'banquet_hall_name'=>$this->input->post('hall_name'),  
                            'no_of_people'=>$this->input->post('capacity'),
                            'description'=>$this->input->post('description'),                 
                            'hotel_id'=>$admin_details['hotel_id'],
                            'added_by_u_id'=>$admin_details['u_id'],
                            'added_by'=>2         
                       );

            $add = $this->MainModel->insertData($tbl="banquet_hall",$arr);
            if($add)
            {

                // add multiple images
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

                        $path = 'assets/dist/banqt_hall_img/';
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
                            
                            $arr1 = array(
                                            'hotel_id' => $admin_details['hotel_id'],
                                            'banquet_hall_id' => $add,
                                            'images' => $image,
                                        );

                            $this->MainModel->insertData($tbl="banquet_hall_images",$arr1);
                        } 
                    }
                }


               $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
		      	$where = '(added_by = 2 AND hotel_id ="'.$hotel_id.'")';
				$data['banq_hall'] = $this->MainModel->getAllData1($tbl ='banquet_hall', $where);
				 $this->load->view('foodadmin/ajaxManageBanqHallList', $data);
            }
            else
            {
                $this->session->set_flashdata('add','Something went Wrong');
                redirect(base_url('Hall_mang')); 
            }
        }                            
	


         public function update_banq_hall_details()
        {
            $banquet_hall_id= $this->input->post('banquet_hall_id');  
            $banquet_hall_image_id = $this->input->post('banquet_hall_image_id',TRUE);
            $hotel_id = $this->session->userdata('u_id');
            $where ='(banquet_hall_id ="'.$banquet_hall_id.'")';
            
             $arr = array(
                              'banquet_hall_name'=> $this->input->post('hall_name'),
                              'no_of_people'=> $this->input->post('capacity'), 
                              'description' => $this->input->post('description'),
                         );

             $edit= $this->MainModel->editData($tbl='banquet_hall', $where, $arr);
             if($edit)
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
    
                            $path = 'assets/dist/banqt_hall_img/';
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
                                
                                $wh1 = '(banquet_hall_image_id = "'.$banquet_hall_image_id[$i].'")';

                                $arr1 = array(
                                                'images' => $image,
                                            );
    
                                $this->MainModel->editData('banquet_hall_images',$wh1,$arr1);
                            } 
                        }
                    }
                }

                if(isset($_FILES['image1']['name']))
                {
                    // add multiple images
                    $count1 = count($_FILES['image1']['name'],TRUE);

                    for($j = 0;$j < $count1; $j++)
                    {
                        if(!empty($_FILES['image1']['name'][$j]))
                        {
                            $_FILES['my_file']['name'] = $_FILES['image1']['name'][$j];
                            $_FILES['my_file']['type'] = $_FILES['image1']['type'][$j];
                            $_FILES['my_file']['tmp_name'] = $_FILES['image1']['tmp_name'][$j];
                            $_FILES['my_file']['size'] = $_FILES['image1']['size'][$j];
                            $_FILES['my_file']['error'] = $_FILES['image1']['error'][$j];

                            $path = 'assets/dist/banqt_hall_img/';
                            $file_path = './'.$path;
                            $config['allowed_types'] = '*';
                            $config['encrypt_name'] = TRUE;
                            $config['upload_path'] = $file_path;
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload('my_file'))
                            { 
                                $file_data = $this->upload->data();

                                $image1 = base_url().$path.$file_data['file_name'];
                                
                                $arr1 = array(
                                                'hotel_id' => $hotel_id,
                                                'banquet_hall_id' => $banquet_hall_id,
                                                'images' => $image1,
                                            );

                                $this->HotelAdminModel->insert_data('banquet_hall_images',$arr1);
                            } 
                        }
                    }
                  
                }
                
               $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
		      	$where = '(added_by = 2 AND hotel_id ="'.$hotel_id.'")';
				$data['banq_hall'] = $this->MainModel->getAllData1($tbl ='banquet_hall', $where);
				 $this->load->view('foodadmin/ajaxManageBanqHallList', $data);

             }
             else
             {
                $this->session->set_flashdata('add','Something went Wrong');
                redirect(base_url('Hall_mang')); 
             }      
        }


  public function update_profile()
      {
            
            $uid= $this->input->post('id');           
            $where='(u_id ="'.$uid.'")';
            $profile_img= $this->MainModel->getData($tbl='register', $where);
            $img=$profile_img['profile_photo'];

            if (!empty($_FILES['File']['name']))
            {

                $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
                $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
                $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
                $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
                $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];

                $path = 'assets/dist/profie/';
                $file_path = './' . $path;
                $config['allowed_types'] = '*';

                $config['upload_path'] = $file_path;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_uploaded_file'))
                {
                    $file_data = $this->upload->data();
                    //$this->resize_image($file_data);

                    $file_path_url = base_url("assets/dist/profie/"). $file_data['file_name'];

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
                              'full_name'=> $this->input->post('fname'),
                              'email_id'=> $this->input->post('email'),
                              'mobile_no'=> $this->input->post('mobile'),
                              'profile_photo'=> $file,
                          );

             $wh = '(u_id ="'.$uid.'")';
             $edit= $this->MainModel->editData($tbl='register', $wh, $arr);
             if($edit)
             {
              $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
		        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		      	$hotel_id = $get_hotel_id['hotel_id']; 
		         $where = '(user_type = 7)';
			$data['admin_details'] = $this->MainModel->getData($tbl ='register', $where);
			 $this->load->view('foodadmin/ajaxUpdateProfile', $data);
             }
             else
             {
                $this->session->set_flashdata('update','Something went Wrong');
                redirect(base_url('profile')); 
             }      
          
      }  
	  public function get_lat_long()
	  {
		  $query = $this->MainModel->getlan_lat();
  // print_r($query);
			foreach($query as $row){  
					   // $hotel_info= $row['hotel_name'].$row['hotel_importans'];
									  $indexedOnly[] = array(
																//$row;
																 $row['hotel_name'], 
																(float)$row['latitude'],
																(float)$row['longitude'],
																	$row['hotel_importans']
										  

										
															  //$row['hotel_name'],
															  //$row['latitude'],
															  //$row['longitude']
														  );
								  }
				 if($indexedOnly)
				   {
					  echo json_encode($indexedOnly);
				   }
				   else
				   {
					   echo 0;
				   }
	  }
   

        public function change_password()
      {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            $re_enter_password = $this->input->post('confirm_password');

            $u_id = $this->input->post('u_id');
            
            $wh = '(u_id = "'.$u_id.'")';

            $admin = $this->MainModel->getData('register',$wh);
            

            if($admin['password'] == md5($current_password))
            {
                    if($new_password == $re_enter_password)
                    {
                        $arr = array(
                                        'password' => md5($re_enter_password),
                                        'password_text'=>$re_enter_password
                                    );

                        $up = $this->MainModel->editData($tbl='register',$wh,$arr);

                        if($up)
                        {
                           echo '1';exit;
                        }
                        else
                        {
                            echo '2';exit;
                        }
                    }
                    else
                    {
                       echo '3';exit;
                    }
            }
            else
            {
                echo '4';exit;
            }
      }      
	  public function update_food_category()
      {
        	//echo "hi";die;
            $food_category_id = $this->input->post('food_category_id');
            $food_category_name = $this->input->post('food_category_name');
        	
           $id_count = count($food_category_id,TRUE);
        
        //   echo "id_count==".$id_count;
        
             for($i = 0;$i < $id_count; $i++)
                {
                   $wh = '(food_category_id  = "'.$food_category_id[$i].'")';
                    $arr1 = array(
                      
                                'category_name' => $food_category_name[$i]
                      
                                );
            
                   $up =  $this->MainModel->editData('food_category',$wh,$arr1);
                }
        
                if($up)
                {
					$admin_id = $this->session->userdata('u_id');
					$wh_admin = '(u_id ="'.$admin_id.'")';
					$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
					$hotel_id = $get_hotel_id['hotel_id']; 
					$data["list"] = $this->MainModel->get_facility_category_list_pagination($hotel_id);

                    // $this->session->set_flashdata('add','Data Update Successfully');
                    $this->load->view('include/header');
                    $this->load->view('foodadmin/viewFacilityCategory',$data);
                    $this->load->view('include/footer');
                }
                else
                {
                    $this->session->set_flashdata('add','Something went wrong');
                    $this->load->view('foodeadmin/viewFaccilityCategory');
                } 

      }

	  public function get_food_cat_count()
	  {
		// echo "<pre>";
		// print_r($this->input->post());
		// exit;
		// $id=$this->input->post('id');
		// $where = '(food_category_id = "'.$id.'")';
		
		// $arr = array(
		// 	'food_category_id' => '',
		// );

		// $result= $this->FoodAdminModel->editData("food_category", $where, $arr);
		// if
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
		$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
		$hotel_id = $get_hotel_id['hotel_id']; 
		$data["list"] = $this->MainModel->get_facility_category_list_pagination($hotel_id);
		$this->load->view('foodadmin/ajaxCategoryList', $data);
	  }

	  public function delete_facility_category()
      {          
            $id=$this->input->post('cat_id');
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$hotel_id = $get_hotel_id['hotel_id']; 

			$where = '(food_category_id = "'.$id.'" AND hotel_id = "'.$hotel_id.'")';
			$del_menus= $this->MainModel->deleteData($tbl="food_menus", $where);
  
            $where = '(food_category_id = "'.$id.'" AND hotel_id = "'.$hotel_id.'")';
            $result= $this->MainModel->deleteData($tbl="food_category", $where);
  
            if($result)
            {
              echo "1";
            }
            else
            { 
              echo "0";
            }
  
      }
	  public function get_selected_category()
	  {
		  $food_facility_id = $this->input->post('food_facility_id');
		  $wh = '(food_facility_id = "'.$food_facility_id.'")';
		  
		  $food_facility = $this->MainModel->getAllData1($tbl='food_category',$wh);
		  
		  //print_r($subcat);die;
		  //$output = '<option value="">---select---';              //."  "."(".$row['weight'].")"
		  if(!empty($food_facility))
		  {
			foreach($food_facility as $row)
			{
				$output .= '<option value="'.$row['food_category_id'].'">'.$row['category_name'].'</option>';
			}

			echo $output;
		  }
			else
		  {
			echo "0";
			 
		  } 
		   
	  }
	  public function changeUpCategory_for_search_data()
	  {
		  $facilities_1 = $this->input->post('facilities_1');

		  $wh = '(food_facility_id = "'.$facilities_1.'")';
		  
		  $food_category = $this->MainModel->getAllData1($tbl='food_category',$wh);

		  $output = '<option value="">--select--</option>';

		  foreach($food_category as $food_cat)
		  {
			  $output .= '<option if($fac[food_facility_id] == $l[food_facility_id]){ echo "selected";} value="'.$food_cat['food_category_id'].'">'.$food_cat['category_name'].'</option>';
		  }

		  echo $output;
	  }
	  public function get_edit_mng_staff_detaiils()
	{
		$u_id = $this->input->post('u_id');
          
		$where='(u_id ="'.$u_id.'")';
	  $data['s']= $this->MainModel->getData($tbl='register', $where);
	//   echo "<pre>";
	//   print_r($data);die;
		$this->load->view('foodadmin/ajaxstaffmanageedit', $data);
		// $this->load->view('include/footer');
	}
	public function get_user_id()
	{
		$todays_date = date('Y-m-d');
		$hotel_id = $this->input->post('hotel_id');
		
		$room_no = $this->input->post('room_no');
		$guest_data = $this->FoodAdminModel->get_room_no_data($hotel_id,$room_no,$todays_date);
		if(!empty($guest_data))
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
		//echo $hotel_id;die;
		$room_no = $this->input->post('room_no');
		
		$guest_data = $this->FoodAdminModel->get_room_no_data($hotel_id,$room_no,$todays_date);
		if(!empty($guest_data ))
		{
			$wh = '(u_id = "'.$guest_data['u_id'].'")';

			$user_data = $this->MainModel->getData('register',$wh);
			
			$output = ''; 
			
			$output .= $user_data['full_name'];
			
			echo $output;
		}
		
	}
	public function get_user_id_data()
	{
		$todays_date = date('Y-m-d');
		$hotel_id = $this->input->post('hotel_id');
		//echo $hotel_id;die;
		$room_no = $this->input->post('room_no');
		$a=$this->input->post();
		$guest_data = $this->FoodAdminModel->get_room_no_data($hotel_id,$room_no,$todays_date);

		if(!empty($guest_data ))
		{
			$wh = '(u_id = "'.$guest_data['u_id'].'")';

			$user_data = $this->MainModel->getData('.',$wh);
			
			$output = ''; 
			
			$output .= $user_data['u_id'];
			
			echo $output;
		}
		
	}
	public function get_enquiry_id()
	{
	$todays_date=date('Y-m-d');
	$hotel_id = $this->input->post('hotel_id');
	//echo $hotel_id;die;
	$room_no = $this->input->post('room_no');

	$guest_data = $this->FoodAdminModel->get_room_no_data($hotel_id,$room_no,$todays_date);
	if(!empty($guest_data ))
	{

		$output = ''; 

		$output .= $guest_data['enquiry_id'];

		echo $output;
	}  
	}
	public function getrequirement(){
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	$hotel_id = $get_hotel_id['hotel_id'];
		// print_r($todays_date);exit;
		$todays_date = date('Y-m-d');
		$id=$this->input->post('id');
		// print_r($id);exit;
		// $wh_l = '(food_order_id = "' . $id . '")';
		//     $data = $this->MainModel->getAllData1('food_order_details', $wh_l);
		$data["new_order_list"] = $this->FoodAdminModel->get_menu_new_order_list_pagination_food_admin($todays_date,$hotel_id);
		// echo "<pre>";print_r($data);exit;
		
		echo json_encode($data);
	}
	public function getEditDataoffacility(){
		
	
		$where = $this->input->post('id');
        // print_r($where);die;
		$wh = '(food_facility_id ="'.$where.'")';
		$data = $this->MainModel->getSingleData($tbl ='food_facility', $wh);
		// print_r($data);exit;
		echo json_encode($data);
	}
	public function getEditdata_menulist(){
		
	
		$where = $this->input->post('id');
        // print_r($where);die;
		$wh = '(food_item_id ="'.$where.'")';
		$data = $this->MainModel->getSingleData($tbl ='food_menus', $wh);
		// print_r($data);exit;
		echo json_encode($data);
	}
	public function getmanagehallbanquet_edit_data(){
		
	
		$where = $this->input->post('id');
        // print_r($where);die;
		$wh = '(banquet_hall_id ="'.$where.'")';
		$data = $this->MainModel->getSingleData($tbl ='banquet_hall', $wh);
		$banquet_hall_id = $data['banquet_hall_id'];
		$wh_banq = '(banquet_hall_id = "'.$banquet_hall_id.'")';
		$data['images'] = $this->MainModel->getAllData1('banquet_hall_images',$wh_banq);


		// echo "<pre>";print_r($data);exit;
		echo json_encode($data);
	}

	public function food_order_change_status()
	{
			// $a=$this->input->post();
			// print_r($a);die;
		$arr=array(
			'order_status'=>$_POST['status']
			);
			
			$food_order_id=$_POST['uid'];
			$where = '(food_order_id="' . $food_order_id . '")';
			$id=$this->MainModel->editData($tbl="food_orders",$where,$arr); 
			if($id)
			{
				$get_u_id = $this->MainModel->getData($tbl='food_orders', $where);
				$wh1 = '(u_id = "'.$get_u_id['u_id'].'")';
				$get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);
				// echo "<pre>";
				// print_r($get_dt);
				// exit;

				$deviceToken = $get_dt['token'];
				$title = 'Food Order Is Completed';
				$body = array(
					'food_order_id' =>$food_order_id,
				);
				$result = send_push_notification($deviceToken, $title, $body);
				echo json_encode(TRUE);
			}
			else
			{
				echo json_encode(FALSE);
			}	
	}

	public function get_view_completed_data()
	{
		$food_order_id = $this->input->post('id');
		$wh_l = '(food_order_id = "' . $food_order_id . '")';
       $data['get_f_orders_data'] = $this->MainModel->getAllData1('food_order_details',$wh_l);
	   $this->load->view('foodadmin/ajaxview_modal', $data);
	}

	public function get_view_rejected_data()
	{
		$food_order_id = $this->input->post('id');
		$wh_l = '(food_order_id = "' . $food_order_id . '")';
       $data['get_f_orders_data'] = $this->MainModel->getAllData1('food_order_details',$wh_l);
	   $this->load->view('foodadmin/ajaxview_modal_reje', $data);
	}
	
}
