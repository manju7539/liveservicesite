<?php

    defined('BASEPATH') or exit('No script direct access allowed');

    class ApiModel extends CI_Model
    {
        function __construct()
        {
            date_default_timezone_set('Asia/Kolkata');
        }

        
        //create model function //7-11-2022 //archana
        
        
        // public function getData($tbl,$wh)
        // {
        //     $this->db->where($wh);
        //     return $this->db->get($tbl)->row_array();
        // }
        
         public function getData($table, $where) {
            $query = $this->db->where($where)->get($table);
        
            if (!$query) {
                log_message('error', 'Database Error: ' . json_encode($this->db->error()));
                return false;
            }
        
            return $query->row_array();
        }

        public function getData1($tbl)
        {
            return $this->db->get($tbl)->row_array();
        }
        public function get_room_no_data1($hotel_id,$room_no,$todays_date)
        {
            $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_hotel_booking_details.booking_id');
            $this->db->where('user_hotel_booking_details.room_no',$room_no);
            $this->db->where('user_hotel_booking.hotel_id',$hotel_id);
            $this->db->where('user_hotel_booking.booking_status',1);
            $this->db->where('user_hotel_booking.check_out >=',$todays_date);
            return $this->db->get('user_hotel_booking_details')->row_array();
        }
        public function getAllData($tbl,$wh)
        {
            $this->db->where($wh);
            return $this->db->get($tbl)->result_array();
        }
        public function get_handover_desc($tbl,$wh)
        {
            $this->db->where($wh);
            $this->db->order_by('staff_handover_id','desc');
            return $this->db->get($tbl)->result_array();
        }
        public function getAllData1($tbl)
        {
            return $this->db->get($tbl)->result_array();
        }

        //create CRUD functions //7-11-2022 //archana
        public function insert_data($tbl,$arr)
        {
            $this->db->insert($tbl,$arr);
            return $this->db->insert_id();
        }

        public function edit_data($tbl,$wh,$arr)
        {
            $this->db->where($wh);
            if($this->db->update($tbl,$arr))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        public function delete_data($tbl,$wh)
        {
            $this->db->where($wh);
            if($this->db->delete($tbl))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        //check email id //7-11-2022 //archana
        public function check_email_id($email)
        {
            $this->db->where('email_id',$email);
            $this->db->where('user_type',0);
            return $this->db->get('register')->row_array();
        }

        //check mobile number //7-11-2022 //archana
        public function check_mobile_no($mobile_no)
        {
            $this->db->where('mobile_no',$mobile_no);
            $this->db->where('user_type',0);
            return $this->db->get('register')->row_array();
        }

    public function get_user_data($u_id)
{
    $this->db->select('u_id, full_name, email_id, mobile_no, profile_photo, address, city, user_type'); // Include 'city'
    $this->db->from('register');
    $this->db->where('u_id', $u_id);
    $this->db->where('user_type', 0);

    return $this->db->get()->row_array();
}


        //get hotels list //7-11-2022 //archana
        public function get_hotel_list()
        {
            $this->db->where('user_type',2);
            return $this->db->get('register')->result_array();
        }

        //get hotels details //7-11-2022 //archana
        public function get_hotel_data($hotel_id)
        {
            $this->db->where('u_id',$hotel_id);
            $this->db->where('user_type',2);
            return $this->db->get('register')->row_array();
        }

        //get hotels images //7-11-2022 //archana
        public function get_hotel_imgs($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('hotel_photos')->result_array();
        }

        //get enquiry request list//8-11-2022 //archana
       /* public function get_enquiry_list($u_id)
        {
            $this->db->select('register.hotel_name,register.city,hotel_enquiry_request.*');
            $this->db->join('register','register.u_id = hotel_enquiry_request.hotel_id');
            $this->db->where('hotel_enquiry_request.u_id',$u_id);
           // $this->db->where('hotel_enquiry_request.is_admin_accept_req',1); //0
           
            //$this->db->where('hotel_enquiry_request.request_status !=',3);
            $this->db->order_by('hotel_enquiry_request.hotel_enquiry_request_id ','desc');
            return $this->db->get('hotel_enquiry_request')->result_array();

            //
            $this->db->select('register.hotel_name,register.hotel_logo,register.city,hotel_enquiry_request.*');
            $this->db->join('register','register.u_id = hotel_enquiry_request.hotel_id');
            $this->db->where('hotel_enquiry_request.u_id',$u_id);
           // $this->db->where('hotel_enquiry_request.is_admin_accept_req',1); //0
           
            //$this->db->where('hotel_enquiry_request.request_status !=',3);
            $this->db->order_by('hotel_enquiry_request.hotel_enquiry_request_id ','desc');
            return $this->db->get('hotel_enquiry_request')->result_array();
        }*/
      
        public function get_enquiry_list($u_id)
        {
            $this->db->select('register.hotel_name,register.hotel_logo,register.city,hotel_enquiry_request.*');
            $this->db->join('register','register.u_id = hotel_enquiry_request.hotel_id');
            $this->db->where('hotel_enquiry_request.u_id',$u_id);
            $this->db->where('hotel_enquiry_request.is_main_req',1);
            // $this->db->where('hotel_enquiry_request.is_confirm_booking !=',1);
            $this->db->order_by('hotel_enquiry_request.hotel_enquiry_request_id ','desc');
            return $this->db->get('hotel_enquiry_request')->result_array();
        }

        public function get_feedback_data($u_id, $hotel_id, $booking_id)
            {
                return $this->db->select('rating, review_for, review, rating_date, rating_time')
                                ->from('review')
                                ->where('u_id', $u_id)
                                ->where('hotel_id', $hotel_id)
                                ->where('booking_id', $booking_id)
                                ->get()
                                ->result_array();
            }


        //sub leads list //4-1-2023 //archana
        public function get_sub_enquiry_list($u_id,$request_id)
        {
            $this->db->select('register.hotel_name,register.hotel_logo,register.city,hotel_enquiry_request.*');
            $this->db->join('register','register.u_id = hotel_enquiry_request.hotel_id');
            $this->db->where('hotel_enquiry_request.u_id',$u_id);
            $this->db->where('hotel_enquiry_request.is_sub_req',1);
            $this->db->where('hotel_enquiry_request.is_confirm_booking !=',1);
            $this->db->where('hotel_enquiry_request.request_id',$request_id);
            //$this->db->order_by('hotel_enquiry_request.hotel_enquiry_request_id ','desc');
            return $this->db->get('hotel_enquiry_request')->result_array();
        }

        //get total child and adults //8-11-2022 //archana
        public function get_total_adults_child($hotel_enquiry_request_id)
        {
            $this->db->select('sum(no_of_room) as no_of_rooms,sum(childs) as total_child,sum(adults) as total_adults');
            $this->db->where('hotel_enquiry_request_id',$hotel_enquiry_request_id);
            return $this->db->get('hotel_enquiry_request_details')->result_array();
        }

        //get user notifications //8-11-2022 //archana
        public function get_user_notifications($u_id)
        {
            $this->db->where('u_id',$u_id);
            $this->db->where('clear_flag',1);
            $this->db->order_by('u_notification_id','desc');
            return $this->db->get('user_notification')->result_array();
        }
      
        public function get_guest_u_notifications()
        {
            $this->db->order_by('id','desc');
            return $this->db->get('guest_login_user_notification')->result_array();
        }

        //get enquiry request details//9-11-2022 //archana
        public function get_enquiry_details($u_id,$hotel_enquiry_request_id)
        {
            $this->db->select('register.hotel_name,register.city,register.state,hotel_enquiry_request.*');
            $this->db->join('register','register.u_id = hotel_enquiry_request.hotel_id');
            $this->db->where('hotel_enquiry_request.u_id',$u_id);
            $this->db->where('hotel_enquiry_request.hotel_enquiry_request_id',$hotel_enquiry_request_id);
            return $this->db->get('hotel_enquiry_request')->row_array();
        }

        //get hotel enquiry details //9-11-2022 //archana
        public function get_hotel_enquiry_details($hotel_enquiry_request_id)
        {
            $this->db->where('hotel_enquiry_request_id',$hotel_enquiry_request_id);
            return $this->db->get('hotel_enquiry_request_details')->result_array();
        }

        //get offer list//9-11-2022 //archana
        public function get_offer_list()
        {
            // $this->db->where('offer_for',1);
            return $this->db->get('offers')->result_array();
        }
        public function get_user_room_no($booking_id){
            $this->db->where('booking_id',$booking_id);
            return $this->db->get('user_hotel_booking_details')->row_array();
        }
        
        //get user guest details //10-11-2022 //archana
        public function get_user_guest_data($u_id,$hotel_id,$booking_id)
        {
            $this->db->where('u_id',$u_id);
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->where('is_guest',1);
            return $this->db->get('guest_user')->row_array();
        }

        //get userbooking details //10-11-2022 //archana
        public function get_user_booking_details($u_id,$hotel_id,$booking_id)
        {
            $this->db->where('u_id',$u_id);
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->where('booking_status',1);
            $this->db->where('check_out >=',date('Y-m-d'));
            return $this->db->get('user_hotel_booking')->row_array();
        }

        //get user guest details //10-11-2022 //archana
        public function get_help_support_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('is_active',1);
            return $this->db->get('faq')->result_array();
        }

        //get near by places //10-11-2022 //archana
        public function get_near_by_places_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('hotel_near_by_place')->result_array();
        }

        //get near by places //10-11-2022 //archana
        public function get_near_by_places_details($hotel_id,$hotel_near_by_place_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('hotel_near_by_place_id',$hotel_near_by_place_id);
            return $this->db->get('hotel_near_by_place')->row_array();
        }

        //get near by help //10-11-2022 //archana
        public function get_near_by_help_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('hotel_near_by_help')->result_array();
        }

        //get near by help //10-11-2022 //archana
        public function get_near_by_help_details($hotel_id,$hotel_near_by_help_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('hotel_near_by_help_id',$hotel_near_by_help_id);
            return $this->db->get('hotel_near_by_help')->row_array();
        }

        //get particular hotel offer list//9-11-2022 //archana
        public function get_hotel_offer_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('offers')->result_array();
        }

        //get particular hotel offer list//9-11-2022 //archana
        public function get_hotel_guidelines_data($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('hotel_guidelines')->row_array();
        }

        //get hotels facility //11-11-2022 //archana
        public function get_hotel_facility($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('hotel_facility')->result_array();
        }

        //get user order compalints //14-11-2022 //archana
        public function get_user_order_complaint_list($hotel_id,$u_id,$complaint_for)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('complaint_for',$complaint_for);
            $this->db->order_by('complaint_id','desc');
            return $this->db->get('order_complaints')->result_array();
        }
        
        //food facility //14-11-2022 //archana
        public function get_food_facility($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('food_facility')->result_array();
        }
         
        //food category//14-11-2022 //archana
        public function get_food_category($hotel_id,$food_facility_id)
        {
            $this->db->select('food_facility.facility_name,food_category.*');
            $this->db->join('food_facility','food_facility.food_facility_id = food_category.food_facility_id');
            $this->db->where('food_category.food_facility_id',$food_facility_id);
            $this->db->where('food_category.hotel_id',$hotel_id);
            return $this->db->get('food_category')->result_array();
        }
         
        //food menu//14-11-2022 //archana
        public function get_breakfast_food_menus($hotel_id,$food_facility_id)
        {
            $this->db->select('food_facility.facility_name,food_category.category_name,food_menus.*');
            $this->db->join('food_facility','food_facility.food_facility_id = food_menus.food_facility_id');
            $this->db->join('food_category','food_category.food_category_id = food_menus.food_category_id');
            $this->db->where('food_menus.hotel_id',$hotel_id);
            $this->db->where('food_menus.food_facility_id',$food_facility_id);
            $this->db->where('food_menus.menus_for',2);
            return $this->db->get('food_menus')->result_array();
        }
         
        //food menu//14-11-2022 //archana
        public function get_regular_food_menus($hotel_id,$food_facility_id)
        {
            $this->db->select('food_facility.facility_name,food_category.category_name,food_menus.*');
            $this->db->join('food_facility','food_facility.food_facility_id = food_menus.food_facility_id');
            $this->db->join('food_category','food_category.food_category_id = food_menus.food_category_id');
            $this->db->where('food_menus.hotel_id',$hotel_id);
            $this->db->where('food_menus.food_facility_id',$food_facility_id);
            $this->db->where('food_menus.menus_for',1);
            return $this->db->get('food_menus')->result_array();
        }
         
        //food menu//14-11-2022 //archana
        public function get_today_special_food_menus($hotel_id,$food_facility_id)
        {
            $this->db->select('food_facility.facility_name,food_category.category_name,food_menus.*');
            $this->db->join('food_facility','food_facility.food_facility_id = food_menus.food_facility_id');
            $this->db->join('food_category','food_category.food_category_id = food_menus.food_category_id');
            $this->db->where('food_menus.hotel_id',$hotel_id);
            $this->db->where('food_menus.food_facility_id',$food_facility_id);
            $this->db->where('food_menus.menus_for',3);
            return $this->db->get('food_menus')->result_array();
        }
        
        //house keeping services//15-11-2022 //archana
        public function get_housekeeping_services($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('is_active',1);
            return $this->db->get('house_keeping_services')->result_array();
        }
         
        //laundry time and details //15-11-2022 //archana
        public function get_laundry_time($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('laundry_time')->row_array();
        }
         
        //laundry time and details //15-11-2022 //archana
        public function get_cloth_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('cloth')->result_array();
        }
         
        //get user order compalints //23-11-2022 //archana
        public function get_user_other_complaint_list($hotel_id,$u_id,$complaint_for)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('complaint_for',$complaint_for);
          	$this->db->order_by('complaint_id','desc');
            return $this->db->get('other_complaints')->result_array();
        }
       
        //get hotel panel list //23-11-2022 //archana
        public function get_hotel_panel_list($hotel_id)
        {
            $this->db->select('departement.department_name,hotels_panel_list.*');
            $this->db->join('departement','departement.department_id = hotels_panel_list.department_id');
            $this->db->where('hotels_panel_list.admin_id',$hotel_id);
            $this->db->where('hotels_panel_list.department_id !=',1);
            $this->db->where('hotels_panel_list.department_status',1);
            return $this->db->get('hotels_panel_list')->result_array();
        }

        //get room service services list //23-11-2022 //archana
        public function get_roomservice_services_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('room_servs_services')->result_array();
        }

        //get room service menu category list //23-11-2022 //archana
        public function get_roomservice_menu_cat_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('room_servs_category')->result_array();
        }

        //get room service menu list category wise //23-11-2022 //archana
        public function get_roomservice_menu_list_cat_wise($hotel_id,$room_serv_cat_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_serv_cat_id',$room_serv_cat_id);
            return $this->db->get('room_serv_menu_list')->result_array();
        }

        //get hotels minibar //23-11-2022 //archana
        public function get_hotel_minibar($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('room_servs_mini_bar')->result_array();
        }

        //get hotels services //24-11-2022 //archana
        public function get_hotel_services($hotel_id,$department_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('department_id',$department_id);
            return $this->db->get('hotels_services')->result_array();
        }

        //get user all food order not only complete order //24-11-2022 //archana
        public function get_user_food_orders($hotel_id,$u_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->where('order_status !=',2);
          	$this->db->order_by('food_order_id','desc');
            return $this->db->get('food_orders')->result_array();
        }

        //get user all food order not only complete order details //24-11-2022 //archana
        public function get_user_food_orders_details($hotel_id,$food_order_id)
        {
            $this->db->select('food_menus.items_name,food_order_details.*');
            $this->db->join('food_menus','food_menus.food_item_id = food_order_details.food_items_id');
            $this->db->where('food_order_details.hotel_id',$hotel_id);
            $this->db->where('food_order_details.food_order_id',$food_order_id);
            return $this->db->get('food_order_details')->result_array();
        }

        //get user all housekeeping order not only complete order //24-11-2022 //archana
        public function get_user_housekeeping_orders($hotel_id,$u_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->where('order_status !=',2);
          	$this->db->order_by('h_k_order_id','desc');
            return $this->db->get('house_keeping_orders')->result_array();
        }

        //get user all housekeeping order not only complete order details //24-11-2022 //archana
        public function get_user_housekeeping_details($hotel_id,$h_k_order_id)
        {
            $this->db->select('house_keeping_services.service_type,house_keeping_order_details.*');
            $this->db->join('house_keeping_services','house_keeping_services.h_k_services_id = house_keeping_order_details.h_k_service_id');
            $this->db->where('house_keeping_order_details.hotel_id',$hotel_id);
            $this->db->where('house_keeping_order_details.h_k_order_id',$h_k_order_id);
            return $this->db->get('house_keeping_order_details')->result_array();
        }

        //get user all laundry order not only complete order //24-11-2022 //archana
        public function get_user_laundry_orders($hotel_id,$u_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->where('order_status !=',2);
          	$this->db->order_by('cloth_order_id','desc');
            return $this->db->get('cloth_orders')->result_array();
        }

        //get user all housekeeping order not only complete order details //24-11-2022 //archana
        public function get_user_laundry_details($hotel_id,$cloth_order_id)
        {
            $this->db->select('cloth.cloth_name,cloth_order_details.*');
            $this->db->join('cloth','cloth.cloth_id = cloth_order_details.cloth_id');
            $this->db->where('cloth_order_details.hotel_id',$hotel_id);
            $this->db->where('cloth_order_details.cloth_order_id',$cloth_order_id);
            return $this->db->get('cloth_order_details')->result_array();
        }

        //get user all room service services order not only complete order //24-11-2022 //archana
        public function get_user_rs_services_orders($hotel_id,$u_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->where('order_status !=',2);
          	// $this->db->order_by('rmservice_services_order_id','desc');
          	$this->db->order_by('DATE(created_at)','desc');
            return $this->db->get('rmservice_services_orders')->result_array();
        }

        //get user all room service services order not only complete order details //24-11-2022 //archana
        public function get_user_rs_services_details($hotel_id,$room_service_unique_id)
        {
            $this->db->select('room_servs_services.service_name,rmservice_services_details.*');
            $this->db->join('room_servs_services','room_servs_services.r_s_services_id = rmservice_services_details.room_serv_service_id');
            $this->db->where('rmservice_services_details.hotel_id',$hotel_id);
            // $this->db->where('rmservice_services_details.rmservice_services_order_id',$rmservice_services_order_id);
            $this->db->where('rmservice_services_details.room_service_unique_id',$room_service_unique_id);
            return $this->db->get('rmservice_services_details')->result_array();
        }

        //get user all room service menu order not only complete order //24-11-2022 //archana
        public function get_user_rs_menu_orders($hotel_id,$u_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->where('order_status !=',2);
          	$this->db->order_by('room_service_menu_order_id','desc');
            return $this->db->get('room_service_menu_orders')->result_array();
        }

        //get user all room service menu order not only complete order details //24-11-2022 //archana
        public function get_user_rs_menu_details($hotel_id,$room_service_menu_order_id)
        {
            $this->db->select('room_serv_menu_list.menu_name,room_servs_category.category_name,room_service_menu_details.*');
            $this->db->join('room_serv_menu_list','room_serv_menu_list.room_serv_menu_id = room_service_menu_details.room_serv_menu_id');
            $this->db->join('room_servs_category','room_servs_category.room_servs_category_id = room_service_menu_details.room_service_cat_id');
            $this->db->where('room_service_menu_details.hotel_id',$hotel_id);
            $this->db->where('room_service_menu_details.room_service_menu_order_id',$room_service_menu_order_id);
            return $this->db->get('room_service_menu_details')->result_array();
        }

        //get user all reserve table request not only accept order //24-11-2022 //archana
        public function get_user_reserve_table_request($hotel_id,$u_id,$booking_id)
        {
            $this->db->select('food_facility.facility_name,reserve_table.*');
            $this->db->join('food_facility','food_facility.food_facility_id = reserve_table.food_facility_id');
            $this->db->where('reserve_table.hotel_id',$hotel_id);
            $this->db->where('reserve_table.u_id',$u_id);
            $this->db->where('reserve_table.booking_id',$booking_id);
            $this->db->order_by('reserve_table.reserve_table_id','desc');
            // $this->db->where('reserve_table.request_status !=',1);
            return $this->db->get('reserve_table')->result_array();
        }

        //get business center //24-11-2022 //archana
        public function get_hotel_business_center_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('is_active',1);
            return $this->db->get('business_center')->result_array();
        }

        //get user all reserve business center request not only accept order //24-11-2022 //archana
        public function get_user_reserve_business_request($hotel_id,$u_id,$booking_id)
        {
            $this->db->select('business_center.business_center_type as business_center_name,business_center.no_of_people,business_center_reservation.*');
            $this->db->join('business_center','business_center.business_center_id = business_center_reservation.business_center_type');
            $this->db->where('business_center_reservation.hotel_id',$hotel_id);
            $this->db->where('business_center_reservation.u_id',$u_id);
            $this->db->where('business_center_reservation.booking_id',$booking_id);
            $this->db->order_by('business_center_reservation.b_c_reserve_id','desc');
            // $this->db->where('business_center_reservation.request_status !=',1);
            return $this->db->get('business_center_reservation')->result_array();
        }

        //get business center //25-11-2022 //archana
        public function get_hotel_banquet_hall_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('banquet_hall')->result_array();
        }

        //get user all reserve banquet hall request not only accept order //24-11-2022 //archana
        public function get_user_reserve_banquet_hall_request($hotel_id,$u_id,$booking_id)
        {
            $this->db->select('banquet_hall.banquet_hall_name,banquet_hall_orders.*');
            $this->db->join('banquet_hall','banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
            $this->db->where('banquet_hall_orders.hotel_id',$hotel_id);
            $this->db->where('banquet_hall_orders.u_id',$u_id);
            $this->db->where('banquet_hall_orders.booking_id',$booking_id);
            $this->db->order_by('banquet_hall_orders.banquet_hall_orders_id','desc');
            // $this->db->where('banquet_hall_orders.request_status !=',1);
            return $this->db->get('banquet_hall_orders')->result_array();
        }

        //get user cab request list //25-11-2022 //archana
        public function get_user_cab_req_list($hotel_id,$u_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->order_by('cab_service_request_id','desc');
            return $this->db->get('cab_service_request_list')->result_array();
        }

        //get luggage charges //25-11-2022 //archana
        public function get_hotel_luggage_charges($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('luggage_charges')->result_array();
        }

        //get user luggage request list //25-11-2022 //archana
        public function get_user_luggage_req_list($hotel_id,$u_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->order_by('luggage_request_id','desc');
            return $this->db->get('luggage_request')->result_array();
        }

        //get user luggage request details //25-11-2022 //archana
        public function get_user_luggage_req_details($hotel_id,$luggage_request_id)
        {
            $this->db->select('luggage_charges.luggage_type,luggage_req_details.*');
            $this->db->join('luggage_charges','luggage_charges.luggage_charge_id = luggage_req_details.luggage_type_id');
            $this->db->where('luggage_req_details.hotel_id',$hotel_id);
            $this->db->where('luggage_req_details.luggage_request_id',$luggage_request_id);
            return $this->db->get('luggage_req_details')->result_array();
        }

        //get vehicle charges //25-11-2022 //archana
        public function get_hotel_vehicle_wash_charges($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('vehicle_washing_charges')->result_array();
        }

        //get vehicle wash request //25-11-2022 //archana
        public function get_user_vehicle_wash_request($hotel_id,$u_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->order_by('vehicle_wash_request_id','desc');
            return $this->db->get('vehicle_wash_request')->result_array();
        }

        //get front ofs service //28-11-2022 //archana
        public function get_hotel_front_ofs_service_data($hotel_id,$service_name)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('service_name',$service_name);
            return $this->db->get('front_ofs_services')->result_array();
        }

        //get offer list//28-11-2022 //archana
        public function get_food_offer_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('offer_for',3);
            return $this->db->get('offers')->result_array();
        }

        //get user msg get list//29-11-2022 //archana
        public function get_msg_data($hotel_id,$sender_id,$receiver_id,$date)
        {
            $date2 = $date;
            $date1 = date('Y-m-d',strtotime('-3 days'.$date2));
            
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('sender_id',$sender_id);
            $this->db->where('receiver_id',$receiver_id);
            $this->db->where('msg_date >=',$date1);
            $this->db->where('msg_date <=',$date2);
            // $this->db->order_by('msg_date','asc');
            return $this->db->get('chat_details_of_user')->result_array();
        }

        //get found list//29-11-2022 //archana
        public function get_found_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('lost_found_flag',2);
            return $this->db->get('lost_found_list')->result_array();
        }

        //get city list//3-12-2022 //archana
        public function get_city_list()
        {
            return $this->db->get('city')->result_array();
        }

        //get hotel list by city wise//3-12-2022 //archana
        public function get_hotel_list_by_city($city)
        {
            $this->db->where('city',$city);
            $this->db->where('user_type',2);
            $this->db->where('is_active',1);
            return $this->db->get('register')->result_array();
        }

        //get user booking history//3-12-2022 //archana
        public function get_user_booking_history($u_id)
        {
            $this->db->select('user_hotel_booking.*,register.hotel_name,register.city,register.state');
            $this->db->join('register','register.u_id = user_hotel_booking.hotel_id');
            $this->db->where('user_hotel_booking.u_id',$u_id);
            $this->db->where('user_hotel_booking.booking_status',2);
          	$this->db->order_by('user_hotel_booking.booking_id','desc');
            return $this->db->get('user_hotel_booking')->result_array();
        }

        //get user hotel booking details//3-12-2022 //archana
        public function get_hotel_booking_details($booking_id)
        {
            $this->db->where('booking_id',$booking_id);
            return $this->db->get('user_hotel_booking_details')->result_array();
        }

        //get hotels room type list //7-12-2022 //archana
        public function get_room_type_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('room_type')->result_array();
        }
      
        //get hotels room type list //24-1-2023 //archana
        public function get_room_type_list_1($hotel_id)
        {
          	$this->db->group_by('room_type.room_type_id');
            $this->db->select('room_type.*');
            $this->db->join('room_configure','room_configure.room_type = room_type.room_type_id');
            $this->db->join('room_nos','room_nos.room_configure_id = room_configure.room_configure_id');
            $this->db->join('room_status','room_status.hotel_id = room_nos.hotel_id AND room_status.room_no = room_nos.room_no');
            $this->db->where('room_status.room_status',3);
            $this->db->where('room_type.hotel_id',$hotel_id);
            return $this->db->get('room_type')->result_array();
        }
      
        public function get_faq($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('is_active',1);

            return $this->db->get('faq')->result_array();
        }
        
        public function get_contact_details ($store_id){
            $this->db->where('store_id', $store_id);
            return $this->db->get('StoreSettings')->result_array();

        }

        public function get_terms_condition($term_condition_id) {
            $this->db->where('term_condition_id', $term_condition_id);
            return $this->db->get('terms_condition')->result_array();
        }
    
        public function get_help_center($help_center_id) {
            // Query the database to fetch the help center data based on the ID
            $this->db->where('help_center_id', $help_center_id);
            return $this->db->get('help_center')->result_array();
        }
    

      
        public function get_p_policy($hotel_id)
        {
            $this->db->where('added_by_u_id',$hotel_id);
            return $this->db->get('privacy_policy')->result_array();
        }
	
      	public function get_total_request_pending_count($wh,$hotel_id,$u_id,$booking_id)
        {
            $this->db->select('count(h_k_order_id) as total_count');
            $this->db->where($wh);
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);          
            return $this->db->get('house_keeping_orders')->result_array();
        }
      
        public function get_total_request_pending_count_1($wh1,$hotel_id,$u_id,$booking_id)
        {
            $this->db->select('count(rmservice_services_order_id) as total_count');
            $this->db->where($wh1);
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);         
            return $this->db->get('rmservice_services_orders')->result_array();
        }
      
        public function get_total_visitors_count($hotel_id,$u_id,$booking_id)
        {
            //$this->db->select('count(visitor_id) as total_count');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);         
            $this->db->where('is_otp_verified',0);         
            $this->db->where('is_otp_correct',0);               
            return $this->db->get('visitor')->result_array();
        }
        
        public function get_ratings_count($wh,$hotel_id)
        {
            $this->db->select('count(rating_id) as total_count');
            $this->db->where($wh);
            $this->db->where('hotel_id',$hotel_id);
            // $this->db->where('u_id',$u_id);         
            return $this->db->get('hotel_ratings')->result_array();
        }
       
      public function getAllData_rating($hotel_id)
        {
            $this->db->select('hotel_ratings.u_id, hotel_ratings.rating, hotel_ratings.review, hotel_ratings.rating_date, hotel_ratings.rating_time, register.full_name');
            $this->db->from('hotel_ratings');
            $this->db->join('register', 'register.u_id = hotel_ratings.u_id', 'left');
            $this->db->where('hotel_ratings.hotel_id', $hotel_id);
        
            return $this->db->get()->result_array();
        }


        
        public function get_data($u_id)
        {
            $this->db->where('u_id',$u_id);
            return $this->db->get('preferences')->result_array();
        }

        public function get_confirm_enquiry_list($u_id)
        {
            $this->db->select('register.hotel_name,register.hotel_logo,register.city,hotel_enquiry_request.*');
            $this->db->join('register','register.u_id = hotel_enquiry_request.hotel_id');
            $this->db->where('hotel_enquiry_request.u_id',$u_id);
            $this->db->where('hotel_enquiry_request.is_confirm_booking',1);
            //$this->db->where('hotel_enquiry_request.request_status',3);
            //$this->db->or_where('hotel_enquiry_request.request_status',4);
            $this->db->order_by('hotel_enquiry_request.hotel_enquiry_request_id ','desc');
            return $this->db->get('hotel_enquiry_request')->result_array();
        }
      
        public function get_hotel_avg_rating($hotel_id)
        { 
            $this->db->select('avg(rating) as avrag_rating');          
            $this->db->where('hotel_id',$hotel_id);   
            return $this->db->get('hotel_ratings')->result_array();
        }
        
        //10-1-2023 //archana
        public function get_user_laudry_order($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('cloth_order_id','desc');   
            return $this->db->get('cloth_orders')->result_array();
        }
        
        //10-1-2023 //archana
        public function get_user_food_order($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('food_order_id','desc');   
            return $this->db->get('food_orders')->result_array();
        }
        
        //10-1-2023 //archana
        public function get_user_housekeeping_order($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('h_k_order_id','desc');   
            return $this->db->get('house_keeping_orders')->result_array();
        }
        
        //10-1-2023 //archana
        public function get_user_rs_service_order($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('rmservice_services_order_id','desc');   
            return $this->db->get('rmservice_services_orders')->result_array();
        }
        
        //10-1-2023 //archana
        public function get_user_rs_menu_order($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('room_service_menu_order_id','desc');   
            return $this->db->get('room_service_menu_orders')->result_array();
        }
       
        //booking details //21-11-2022 //archana
        public function get_user_booking_details_1($hotel_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('booking_id',$booking_id);
            return $this->db->get('user_hotel_booking')->row_array();
        }
  
        //get user guest details //18-1-2023 //archana
        /*public function get_user_guest_list($u_id)
        {
            $this->db->where('u_id',$u_id);
            $this->db->where('is_guest',1);
            return $this->db->get('guest_user')->result_array();
        }*/
      
        //get user guest details //18-1-2023 //archana
        public function get_user_guest_list($u_id)
        {
            $this->db->join('user_hotel_booking','user_hotel_booking.u_id = guest_user.u_id AND user_hotel_booking.booking_id = guest_user.booking_id');
            $this->db->where('guest_user.u_id',$u_id);
            $this->db->where('guest_user.is_guest',1);
            $this->db->where('user_hotel_booking.booking_status',1);
            $this->db->where('user_hotel_booking.check_out >=',date('Y-m-d'));
            return $this->db->get('guest_user')->result_array();
        }


        //get user current booking details //18-1-2023 //archana
        public function get_user_current_booking_details($u_id,$booking_id)
        {
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->where('booking_status',1);
            $this->db->where('check_out >=',date('Y-m-d'));
            return $this->db->get('user_hotel_booking')->row_array();
        }


        //get luggage guest list //24-1-2023 //archana
        public function get_hotel_guest_list($hotel_id,$wh)
        {
            $this->db->distinct('u_id');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('is_guest',1);
            $this->db->where('chat_visible_mode',1);
            $this->db->where($wh);
            return $this->db->get('guest_user')->result_array();
        }

        //get user chat history with department //30-1-2023 //archana
        public function get_user_chat_with_department($hotel_id,$u_id,$booking_id,$department_id,$service_id,$services_name)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->where('department_id',$department_id);
            $this->db->where('service_id',$service_id);
            $this->db->where('services_name',$services_name);
            $this->db->order_by('msg_date','asc');
            $this->db->order_by('msg_time','asc');
            return $this->db->get('user_query_to_department')->result_array();
        }
       

        public function check_mobile($mobile)
        {
            $this->db->where('mobile_no',$mobile);
            return $this->db->get('register')->result_array();
        }
      
    
        public function get_user_data_food_staff($u_id)
        {
            $this->db->where('u_id',$u_id);
            $this->db->where('user_type',8);
            return $this->db->get('register')->row_array();
        }
      
        public function get_user_data_room_service_staff($u_id)
        {
            $this->db->where('u_id',$u_id);
            $this->db->where('user_type',10);
            return $this->db->get('register')->row_array();
        }
      
        public function getCount_complete_orders($tbl,$where)
        {
          $this->db->select('count(h_k_order_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }

        public function getCount_laundry_complete_orders($tbl,$where)
        {
          $this->db->select('count(cloth_order_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }
       
        public function food_Count_complete_orders($tbl,$where)
        {
          $this->db->select('count(food_order_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }
      
        public function getCount_room_service_ord($tbl,$where)
        {
          $this->db->select('count(room_service_menu_order_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }
      
        public function getCount_rm_service_complete_orders($tbl,$where)
        {
          $this->db->select('count(rmservice_services_order_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }
      
        public function getCount_housekeeping_orders($tbl,$where)
        {
          $this->db->select('count(h_k_order_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }
      
        public function getCount_housekeeping_cloth_orders($tbl,$where)
        {
          $this->db->select('count(cloth_order_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }
		
      	public function getCount_food_orders($tbl,$where)
        {
          $this->db->select('count(food_order_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }
      
        public function getCount_room_service_menu_orders($tbl,$where)
        {
          $this->db->select('count(room_service_menu_order_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }
      
        public function getCount_room_service_orders($tbl,$where)
        {
          $this->db->select('count(rmservice_services_order_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }
      
        public function getCount_housekeeping_notification($tbl,$where)
        {
          $this->db->select('count(s_notification_id) as total_count');
          $this->db->from($tbl);
          $this->db->where($where);
          $query = $this->db->get();
          return $query->result_array();
        }

		public function getData_Orders_housekeeping_history($tbl,$where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->order_by('h_k_order_id','DESC');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result_array();
        }
      
        public function getData_Orders_cloth_history($tbl,$where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->order_by('cloth_order_id','DESC');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result_array();
        }
      
        public function getData_Orders_food_history($tbl,$where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->order_by('food_order_id','DESC');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result_array();
        }
      
        public function getData_Orders_rm_menus_history($tbl,$where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->order_by('room_service_menu_order_id','DESC');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result_array();
        }
      
        public function getData_Orders_rm_services_history($tbl,$where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->order_by('rmservice_services_order_id','DESC');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result_array();
        }
        public function getstaffdata($tbl,$wh)
        {
            $this->db->where($wh);
            return $this->db->get($tbl)->result_array();
        }
        public function edit_data_assign_handover($tbl,$arr,$wh1)
        {
            $this->db->where($wh1);
            // $this->db->update($tbl, $arr);
            // return $this->db->affected_rows();
            if($this->db->update($tbl,$arr))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        public function get_spa_type($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('front_ofs_spa_service_images')->result_array();
        }
        public function get_user_spa_type($u_id,$hotel_id)
        {
            $this->db->select('front_ofs_spa_service_images.spa_type,spa_service_request_list.select_date,spa_service_request_list.reject_reason,spa_service_request_list.select_time
            ,spa_service_request_list.request_status,spa_service_request_list.select_date,spa_service_request_list.select_time,spa_service_request_list.reject_date,spa_service_request_list.cancel_date,spa_service_request_list.accept_date,spa_service_request_list.complete_date,spa_service_request_list.spa_service_request_id, spa_service_request_list.hotel_id,spa_service_request_list.booking_id,spa_service_request_list.note,spa_service_request_list.charges,spa_service_request_list.request_date,spa_service_request_list.request_time');
            $this->db->join('spa_service_request_list','spa_service_request_list.spa_type = front_ofs_spa_service_images.front_ofs_spa_service_images_id');
            $this->db->where('spa_service_request_list.u_id',$u_id);
            $this->db->where('spa_service_request_list.hotel_id',$hotel_id);
            $this->db->order_by('spa_service_request_id','desc');
            return $this->db->get('front_ofs_spa_service_images')->result_array();
        }
        public function get_user_spa_request ($hotel_id,$u_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            $this->db->order_by('spa_service_request_id','desc');
            return $this->db->get('spa_service_request_list')->result_array();
        }
        public function edit_checkin_status($tbl,$wh,$arr)
        {
            $this->db->where($wh);
            if($this->db->update($tbl,$arr))
            {
                $this->db->where($wh);
                $query = $this->db->get($tbl);
                if ($query->num_rows() > 0) {
                    return $query->row_array();
                } else {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        public function insert_call_request($tbl, $arr)
        {
            if ($this->db->insert($tbl, $arr))
            {
                $lastInsertedId = $this->db->insert_id();
                $query = $this->db->get_where($tbl, array('u_notification_id' => $lastInsertedId));
                if ($query->num_rows() > 0) {
                    return $query->row_array();
                } else {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        public function get_hotel_data_before_check_in($u_id)
        {
            $this->db->select('*');
            $this->db->where('u_id',$u_id);
            $this->db->order_by('booking_id','DESC');
            $this->db->where('booking_status',1);
            $this->db->where('check_out >=',date('Y-m-d'));
            return $this->db->get('user_hotel_booking')->result_array();
            
        }
        public function get_staff_user_data($u_id)
        {
            $this->db->where('u_id',$u_id);
            return $this->db->get('register')->row_array();
        }

        public function get_resve_tbl_room_no($hotel_id,$booking_id)
        {
            // $this->db->select('uhbd.room_no');
            $this->db->select('*');
            $this->db->from('user_hotel_booking_details as uhbd');
            $this->db->where('uhb.booking_id',$booking_id);
            $this->db->where('uhb.hotel_id',$hotel_id);
            $this->db->join('user_hotel_booking as uhb','uhb.booking_id = uhbd.booking_id');
            $query = $this->db->get();
            return $query->row_array();
        }

        public function get_room_configure_id($hotel_id,$room_no)
        {
            $this->db->select('room_configure_id');
            $this->db->from('room_nos');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_no',$room_no);
            $query = $this->db->get();
            return $query->row_array();
        }

        public function get_floor_id($hotel_id,$room_configure_id)
        {
            $this->db->select('floor_id');
            $this->db->from('room_configure');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_configure_id',$room_configure_id);
            $query = $this->db->get();
            return $query->row_array();
        }
        public function get_floor_no($hotel_id,$floors_id)
        {
            $this->db->select('floor');
            $this->db->from('floors');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('floor_id',$floors_id);
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->row_array();
        }
        public function get_spa_service_request($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('spa_service_request_id','desc');   
            return $this->db->get('spa_service_request_list')->result_array();
        }
        public function get_vehicle_wash_service_request($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('vehicle_wash_request_id','desc');   
            return $this->db->get('vehicle_wash_request')->result_array();
        }
        public function get_luggage_service_request($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('luggage_request_id','desc');   
            return $this->db->get('luggage_request')->result_array();
        }
        public function get_cab_service_request($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('cab_service_request_id','desc');   
            return $this->db->get('cab_service_request_list')->result_array();
        }
        public function get_business_center_request($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('b_c_reserve_id','desc');   
            return $this->db->get('business_center_reservation')->result_array();
        }
        public function get_reserve_table_request($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('reserve_table_id','desc');   
            return $this->db->get('reserve_table')->result_array();
        }
        public function get_banquet_hall_request($hotel_id,$u_id,$booking_id)
        {       
            $this->db->where('hotel_id',$hotel_id);   
            $this->db->where('u_id',$u_id);   
            $this->db->where('booking_id',$booking_id);   
            // $this->db->where('order_status',$order_status);
            $this->db->order_by('banquet_hall_orders_id','desc');   
            return $this->db->get('banquet_hall_orders')->result_array();
        }
        // occupied room no
        public function get_occupied_rooms_staff($hotel_id)
        {
            $currentDate = date('Y-m-d');
            $this->db->select('uhbd.room_no'); // Include necessary columns
            $this->db->from('user_hotel_booking_details as uhbd');
            $this->db->join('user_hotel_booking as uhb', 'uhb.booking_id = uhbd.booking_id');
            $this->db->join('room_status as rs', 'rs.room_no = uhbd.room_no');
            $this->db->where('uhb.check_out >=', $currentDate);
            $this->db->where('uhb.hotel_id', $hotel_id);
            $this->db->where('uhb.booking_status', 1);
            $this->db->where('rs.room_status', 2);
            $this->db->where('rs.hotel_id', $hotel_id);
            $this->db->distinct(); 
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array(); // Return an empty array if no results found
            }
        }

       

    }
?>