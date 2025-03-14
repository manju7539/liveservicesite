<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HotelAdminModel extends CI_Model {
    function __construct() 
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }

     public function get_room_type_list1($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('room_type')->result_array();
        }
        function get_vehicle_wash_charges_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('vehicle_washing_charge_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $Q = $this->db->get('vehicle_washing_charges');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        public function get_food_category($hotel_id,$food_facility_id)
        {
            $this->db->where('food_facility_id',$food_facility_id);
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('food_category')->result_array();
        }
        function banquet_hall_pending_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->select('register.full_name,register.mobile_no,banquet_hall.banquet_hall_name,banquet_hall_orders.*');
            $this->db->join('register','register.u_id = banquet_hall_orders.u_id');
            $this->db->join('banquet_hall','banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
            $this->db->where('banquet_hall_orders.hotel_id',$hotel_id);
            $this->db->where('banquet_hall_orders.request_status',0);
            $Q = $this->db->get('banquet_hall_orders');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function get_banquet_hall_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('banquet_hall_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $Q = $this->db->get('banquet_hall');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        
        function banquet_hall_pending_pagination1($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->select('register.full_name,register.mobile_no,banquet_hall.banquet_hall_name,banquet_hall_orders.*');
            $this->db->join('register','register.u_id = banquet_hall_orders.u_id');
            $this->db->join('banquet_hall','banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
            $this->db->where('banquet_hall_orders.hotel_id',$hotel_id);
            $Q = $this->db->get('banquet_hall_orders');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function get_manager_handover_completed_list_pagination($hotel_id,$is_complete2)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('m_handover_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('is_complete',$is_complete2);
            $Q = $this->db->get('handover_manger');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function get_staff_handover_pagination($hotel_id,$is_complete1)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('staff_handover_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('is_complete',$is_complete1);
            $Q = $this->db->get('handover_staff');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        function get_staff_complete_handover_pagination($hotel_id,$is_complete1)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('staff_handover_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('is_complete',$is_complete1);
            $Q = $this->db->get('handover_staff');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function get_manager_handover_list_pagination($hotel_id,$is_complete1)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('m_handover_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('is_complete',$is_complete1);
            $Q = $this->db->get('handover_manger');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        public function get_laundry_time($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('laundry_time')->row_array();
        }
        public function get_admin_panel_list_2($hotel_id)
        {
            $this->db->join('departement','departement.department_id = hotels_panel_list.department_id');
            $this->db->where('hotels_panel_list.admin_id',$hotel_id);
            $this->db->where('hotels_panel_list.department_id !=',1);
            $this->db->where('hotels_panel_list.department_id !=',2);
            return $this->db->get('hotels_panel_list')->result_array();
        }

        function get_staff_list_according_to_hotel_1($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('user_is',2);   
            $Q = $this->db->get('register');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        function get_checkout_guest_list_date_wise_pagination($hotel_id,$date)
        {
            $data = array();
            $this->db->select('register.full_name,register.mobile_no,user_hotel_booking.*,user_checkout_data.*');
            $this->db->join('register','register.u_id = user_checkout_data.u_id');
            $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_checkout_data.booking_id');
            $this->db->where('user_checkout_data.hotel_id',$hotel_id);
            $this->db->where('user_checkout_data.is_paid',1);
            $this->db->where('user_hotel_booking.booking_status',2);
            $this->db->where('user_hotel_booking.actual_checkout',$date);
            $Q = $this->db->get('user_checkout_data');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function room_service_minibar_pagination($hotel_id)
        {
          $data = array();
          $this->db->select('*');
          $this->db->order_by('r_s_min_bar_id','DESC');
          $this->db->where('hotel_id',$hotel_id);
          $Q = $this->db->get('room_servs_mini_bar');

          if($Q->num_rows() > 0)
          {
            foreach ($Q->result_array() as $row)
            {
              $data[] = $row;
            }
          }

          $Q->free_result();

          return $data;
        }

        public function get_room_service_cat_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('room_servs_category')->result_array();
        }
      
        function room_service_list_pagination($hotel_id)
        {
          $data = array();
          $this->db->select('*');
          $this->db->order_by('r_s_services_id','DESC');
          $this->db->where('hotel_id',$hotel_id);
          $Q = $this->db->get('room_servs_services');

          if($Q->num_rows() > 0)
          {
            foreach ($Q->result_array() as $row)
            {
              $data[] = $row;
            }
          }

          $Q->free_result();

          return $data;
        }
        
        function get_housekeeping_services_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('h_k_services_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $Q = $this->db->get('house_keeping_services');

            if($Q->num_rows() > 0)
            {
                foreach ($Q->result_array() as $row)
                {
                    $data[] = $row;
                }
            }
            
            $Q->free_result();

            return $data;
        }
       
        function get_cloth_list_pagination($admin_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('cloth_id','DESC');
            $this->db->where('hotel_id',$admin_id);           
            $Q = $this->db->get('cloth');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        public function get_room_type_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            // $this->db->where('room_type_id !=',1);
            return $this->db->get('room_type')->result_array();
        }
        public function get_user_pending_booking_list_from_app($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('booking_status',0);
            $this->db->where('booking_from',2);
            $this->db->where('check_in',date('Y-m-d'));
            return $this->db->get('user_hotel_booking')->result_array();
        }
        function get_user_pending_booking_list_from_app_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            // $this->db->limit($limit, $offset);
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('booking_status',0);
            $this->db->where('booking_from',2);
            $this->db->where('check_in',date('Y-m-d'));
            $Q = $this->db->get('user_hotel_booking');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        public function get_luggage_accepted_request_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('luggage_request_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('request_status',1);
            $Q = $this->db->get('luggage_request');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        public function get_luggage_charges_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('luggage_charge_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $Q = $this->db->get('luggage_charges');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        public function get_vehicle_wash_accepted_request_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('vehicle_wash_request_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('request_status',1);
            $Q = $this->db->get('vehicle_wash_request');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        
        function get_offer_list_pagination($hotel_id)
        {
          $data = array();
          $this->db->select('*');
          $this->db->order_by('offer_id','DESC');
          $this->db->where('hotel_id',$hotel_id);   
          $Q = $this->db->get('offers');

          if($Q->num_rows() > 0)
          {
            foreach ($Q->result_array() as $row)
            {
              $data[] = $row;
            }
          }

          $Q->free_result();

          return $data;
        }
        public function get_user_data_by_no($mobile_no)
        {
            $this->db->where('mobile_no',$mobile_no);
            $this->db->where('user_type',0);
            return $this->db->get('register')->row_array();
        }
        public function get_laundry_order($hotel_id,$order_status)
        {
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,cloth_orders.*');
            $this->db->join('register','register.u_id = cloth_orders.u_id');
            $this->db->where('cloth_orders.hotel_id',$hotel_id);
            $this->db->where('cloth_orders.order_status',$order_status);
            return $this->db->get('cloth_orders')->result_array();
        }
        public function get_house_keeping_service_order($hotel_id,$order_status)
        {
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,house_keeping_orders.*');
            $this->db->join('register','register.u_id = house_keeping_orders.u_id');
            $this->db->where('house_keeping_orders.hotel_id',$hotel_id);
            $this->db->where('house_keeping_orders.order_status',$order_status);
            return $this->db->get('house_keeping_orders')->result_array();
        }
        public function get_hotel_expected_current_booking($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('check_in <=',date('Y-m-d'));
            return $this->db->get('user_hotel_booking')->result_array();
        }
        public function get_hotel_rooms_status($hotel_id,$room_status)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_status',$room_status);
            return $this->db->get('room_status')->result_array();
        }
        public function get_notifications_for_housekeeping($hotel_id)
        {
            // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
            $this->db->where('notifications.send_by_id',$hotel_id);
            $this->db->where('notifications.send_for',7);
            // $this->db->where('notifictions_department_id.department_id',4);
            $this->db->order_by('notifications.notification_id','desc');
            $this->db->limit(4);
            return $this->db->get('notifications')->result_array();
        }
        public function get_hotel_rooms_status_bar_chart($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_status',3);
            $this->db->where('HOUR(created_at) >=',$time1);
            $this->db->where('HOUR(created_at) <=',$time2);
            $this->db->where('DATE(created_at)',date('Y-m-d'));
            return $this->db->get('room_status')->result_array();
        }
        public function get_hotel_rooms_status_bar_chart1($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_status',1);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('DATE(updated_at)',date('Y-m-d'));
            return $this->db->get('room_status')->result_array();
        }
      
        public function get_room_service_services_order($hotel_id,$order_status)
        {
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,rmservice_services_orders.*');
            $this->db->join('register','register.u_id = rmservice_services_orders.u_id');
            $this->db->where('rmservice_services_orders.hotel_id',$hotel_id);
            $this->db->where('rmservice_services_orders.order_status',$order_status);
            return $this->db->get('rmservice_services_orders')->result_array();
        }
        public function get_room_service_menu_order($hotel_id,$order_status)
        {
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,room_service_menu_orders.*');
            $this->db->join('register','register.u_id = room_service_menu_orders.u_id');
            $this->db->where('room_service_menu_orders.hotel_id',$hotel_id);
            $this->db->where('room_service_menu_orders.order_status',$order_status);
            return $this->db->get('room_service_menu_orders')->result_array();
        }
        public function get_particular_hotel_staff_list_count($hotel_id,$user_type,$is_active)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('user_type',$user_type);
            $this->db->where('is_active',$is_active);
            return $this->db->get('register')->result_array();
        }
        public function get_notifications_for_rs($hotel_id)
        {
            // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
            $this->db->where('notifications.send_by_id',$hotel_id);
            $this->db->where('notifications.send_for',7);
            // $this->db->where('notifictions_department_id.department_id',3);
            $this->db->order_by('notifications.notification_id','desc');
            $this->db->limit(4);
            return $this->db->get('notifications')->result_array();
        }
        public function get_room_type_data($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('room_type')->row_array();
        }
        public function get_room_related_data($hotel_id,$room_type)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_type',$room_type);
            return $this->db->get('room_configure')->result_array();
        }
        public function get_hotel_available_service_list($department_id)
        {
            $this->db->where('department_id',$department_id);
            return $this->db->get('services_name_department_wise')->result_array();
        }
        public function get_floor_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('floors')->result_array();
        }
        public function get_room_service_order_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            // $this->db->where('HOUR(created_at)',$time2);
            $this->db->where('order_time <=',$time2);
            $this->db->where('order_date',date("Y-m-d"));
            $this->db->where('order_status',0);
            return $this->db->get('rmservice_services_orders')->result_array();
        }
        public function get_room_service_menu_order_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            $this->db->where('order_time <=',$time2);
            $this->db->where('order_date',date("Y-m-d"));
            $this->db->where('order_status',0);
            return $this->db->get('room_service_menu_orders')->result_array();
        }
        public function get_room_service_order_complate_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('complete_date',date("Y-m-d"));
            $this->db->where('order_status',2);
            return $this->db->get('rmservice_services_orders')->result_array();
        }
        public function get_room_service_menu_order_complete_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('complete_date',date("Y-m-d"));
            $this->db->where('order_status',2);
            return $this->db->get('room_service_menu_orders')->result_array();
        }
    //getroom nos //4-11-2022 //archana
    public function get_room_nos_data($hotel_id,$room_type,$room_no)
    {
        $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
        $this->db->where('room_configure.hotel_id',$hotel_id);
        $this->db->where('room_configure.room_type',$room_type);
        //$this->db->where('room_nos_img.room_no',$room_no);
        $this->db->where('room_nos.room_no',$room_no);
        return $this->db->get('room_nos')->row_array();
    }

        // room service order count//7-12-2022 //archana
        public function get_room_service_order_count1($hotel_id,$time1,$time2)
        {
            $date1 = date("Y-m-d",strtotime('-7 days'));
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            $this->db->where('order_time <=',$time2);
            $this->db->where('order_date >=',$date1);
            $this->db->where('order_date <=',date("Y-m-d"));
            $this->db->where('order_status',0);
            return $this->db->get('rmservice_services_orders')->result_array();
        }
    
        // room service order count//7-12-2022 //archana
        public function get_room_service_menu_order_count1($hotel_id,$time1,$time2)
        {
            $date1 = date("Y-m-d",strtotime('-7 days'));
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            $this->db->where('order_time <=',$time2);
            $this->db->where('order_date >=',$date1);
            $this->db->where('order_date <=',date("Y-m-d"));
            $this->db->where('order_status',0);
            return $this->db->get('room_service_menu_orders')->result_array();
        }
    
        // room service complete order count last 7 days//7-12-2022 //archana
        public function get_room_service_order_complate_count1($hotel_id,$time1,$time2)
        {
            $date1 = date("Y-m-d",strtotime('-7 days'));
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('complete_date >=',$date1);
            $this->db->where('complete_date <=',date("Y-m-d"));
            $this->db->where('order_status',2);
            return $this->db->get('rmservice_services_orders')->result_array();
        }
        public function get_room_service_menu_order_complete_count1($hotel_id,$time1,$time2)
        {
            $date1 = date("Y-m-d",strtotime('-7 days'));
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('complete_date >=',$date1);
            $this->db->where('complete_date <=',date("Y-m-d"));
            $this->db->where('order_status',2);
            return $this->db->get('room_service_menu_orders')->result_array();
        }
    
        // room service order count current month//7-12-2022 //archana
        public function get_room_service_order_current_mnt_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            $this->db->where('order_time <=',$time2);
            $this->db->where('MONTH(order_date)',date("m"));
            $this->db->where('order_status',0);
            return $this->db->get('rmservice_services_orders')->result_array();
        }
    
        // room service order count current month//7-12-2022 //archana
        public function get_room_service_menu_order_current_mnt_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            $this->db->where('order_time <=',$time2);
            $this->db->where('MONTH(order_date)',date("m"));
            $this->db->where('order_status',0);
            return $this->db->get('room_service_menu_orders')->result_array();
        }
    
        // room service complete order count current month//7-12-2022 //archana
        public function get_room_service_order_complete_count_current_mnt($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('MONTH(updated_at)',date("m"));
            $this->db->where('order_status',2);
            return $this->db->get('rmservice_services_orders')->result_array();
        }
    
        // room service complete order count//7-12-2022 //archana
        public function get_room_service_menu_order_complete_count_current_mnt($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('MONTH(updated_at)',date("m"));
            $this->db->where('order_status',2);
            return $this->db->get('room_service_menu_orders')->result_array();
        }
    
        // room service order count current year//7-12-2022 //archana
        public function get_room_service_order_current_yr_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            $this->db->where('order_time <=',$time2);
            $this->db->where('YEAR(order_date)',date("Y"));
            $this->db->where('order_status',0);
            return $this->db->get('rmservice_services_orders')->result_array();
        }
        public function get_room_service_menu_order_current_yr_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            $this->db->where('order_time <=',$time2);
            $this->db->where('YEAR(order_date)',date("Y"));
            $this->db->where('order_status',0);
            return $this->db->get('room_service_menu_orders')->result_array();
        }
    
        // room service complete order count current month//7-12-2022 //archana
        public function get_room_service_order_complete_count_current_yr($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('YEAR(updated_at)',date("Y"));
            $this->db->where('order_status',2);
            return $this->db->get('rmservice_services_orders')->result_array();
        }
    
        // room service complete order count//7-12-2022 //archana
        public function get_room_service_menu_order_complete_count_current_yr($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('YEAR(updated_at)',date("Y"));
            $this->db->where('order_status',2);
            return $this->db->get('room_service_menu_orders')->result_array();
        }

        //get checkout rooms//7-12-2022 //archana
        public function get_checkout_room_no($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_status',1);
            return $this->db->get('room_status')->result_array();
        }
    
        function get_notifications_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('notification_id','DESC');
             $this->db->where('send_by_id',$hotel_id);
            $this->db->where('send_by',2);
            // $this->db->where('send_for',6);
            $this->db->where('send_for',7);
            $Q = $this->db->get('notifications');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
 public function get_hotel_privacy_policy($hotel_id)
        {
            $this->db->where('added_by_u_id',$hotel_id);
            $this->db->where('added_by',1);
            return $this->db->get('privacy_policy')->row_array();
        }
        function get_faq_pagination($hotel_id)
        {
          $data = array();
          $this->db->select('*');
          
          $this->db->order_by('faq_id','DESC');
          $this->db->where('hotel_id',$hotel_id);   
          $Q = $this->db->get('faq');

          if($Q->num_rows() > 0)
          {
            foreach ($Q->result_array() as $row)
            {
              $data[] = $row;
            }
          }

          $Q->free_result();

          return $data;
        }


        public function get_user_list_of_particular_hotel($hotel_id)
        {
           	$this->db->select('register.u_id,register.full_name,guest_user.*');
            $this->db->join('register','register.u_id = guest_user.u_id');
            $this->db->where('guest_user.hotel_id',$hotel_id);
            $this->db->where('guest_user.is_guest',1);
            $this->db->where('guest_user.is_department_notification',1);
            return $this->db->get('guest_user')->result_array();
        }
        public function get_user_list_by_hotels($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('user_type',0);
            $this->db->where('is_active',1);
            return $this->db->get('register')->result_array();
        }
        function get_admin_sent_user_notifications_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->where('send_by_id',$hotel_id);
            $this->db->where('send_by',2);
            $this->db->where('send_for',3);
            $this->db->order_by('notification_id','DESC');
            $Q = $this->db->get('notifications');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

  function get_hotel_near_by_help_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('hotel_near_by_help_id','DESC');
            $this->db->where('hotel_id',$hotel_id);   
            $Q = $this->db->get('hotel_near_by_help');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }        

 public function get_room_no_list($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_status',3);
            return $this->db->get('room_status')->result_array();
        }

  function get_guest_list_pagination($hotel_id)
        {
            $data = array();
            
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
            $this->db->join('register','register.u_id = user_hotel_booking.u_id');
            $this->db->join('guest_user','guest_user.u_id = user_hotel_booking.u_id AND guest_user.hotel_id = user_hotel_booking.hotel_id AND guest_user.booking_id = user_hotel_booking.booking_id');
            $this->db->where('user_hotel_booking.hotel_id',$hotel_id);
            $this->db->where('user_hotel_booking.booking_status',1);
            $this->db->order_by('user_hotel_booking.booking_id','desc');
            //$this->db->where('user_hotel_booking.check_out >=',date('Y-m-d'));
            $Q = $this->db->get('user_hotel_booking');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

 public function get_departure_guest_list($hotel_id)
        {
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
            $this->db->join('register','register.u_id = user_hotel_booking.u_id');
            $this->db->where('user_hotel_booking.hotel_id',$hotel_id);
            $this->db->where('user_hotel_booking.booking_status',2);
            return $this->db->get('user_hotel_booking')->result_array();
        }

 public function get_feedback_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
           
            $this->db->select('register.full_name,review.*');
            $this->db->join('register','register.u_id = review.u_id');
            $this->db->where('review.hotel_id',$hotel_id);
            $Q = $this->db->get('review');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }  

         public function get_ratings($where) 
        {
            $this->db->where($where);
            $query = $this->db->get('review');
            $result = $query->num_rows();
            return $result;
        }              

 function get_hotel_near_by_place_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
           
            $this->db->order_by('hotel_near_by_place_id','DESC');
            $this->db->where('hotel_id',$hotel_id);   
            $Q = $this->db->get('hotel_near_by_place');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function get_lost_found_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $Q = $this->db->get('lost_found_list');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        function get_user_expense_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('expense_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $Q = $this->db->get('expenses');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        function get_visitor_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->where('hotel_id',$hotel_id);
            $Q = $this->db->get('visitor');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        public function get_active_business_center($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('is_active',1);
            return $this->db->get('business_center')->result_array();
        }
        function get_hotel_enquiry_accepted_request_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            // $this->db->limit($limit, $offset);
            $this->db->order_by('hotel_enquiry_request_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('request_status',1);
            $Q = $this->db->get('hotel_enquiry_request');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        public function get_shuttle_service_staff_avaibility_by_day($hotel_id,$day)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('day',$day);
            return $this->db->get('shuttle_service_avaibility')->result_array();
        }
        function get_hotel_enquiry_rejected_request_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            // $this->db->limit($limit, $offset);
            $this->db->order_by('hotel_enquiry_request_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('request_status',2);
            $Q = $this->db->get('hotel_enquiry_request');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function cab_service_completed_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            // $this->db->limit($limit, $offset);
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('request_status',1);
            $Q = $this->db->get('cab_service_request_list');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        
        function get_house_keeping_service_order_pagination($hotel_id,$order_status)
        {
            $data = array();
            $this->db->select('*');
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,house_keeping_orders.*');
            $this->db->join('register','register.u_id = house_keeping_orders.u_id');
            $this->db->where('house_keeping_orders.hotel_id',$hotel_id);
            $this->db->where('house_keeping_orders.order_status',$order_status);
            $this->db->order_by('house_keeping_orders.h_k_order_id','desc');
            $Q = $this->db->get('house_keeping_orders');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        function get_reserve_table_list_pagination($hotel_id,$request_status)
        {
            $data = array();
            $this->db->select('register.full_name,register.mobile_no,reserve_table.*');
            $this->db->join('register','register.u_id = reserve_table.u_id');
            $this->db->where('reserve_table.hotel_id',$hotel_id);
            $this->db->where('reserve_table.request_status',$request_status);
            $Q = $this->db->get('reserve_table');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
      

        function get_reserve_table_pending_list_pagination($hotel_id,$request_status)
        {
            $data = array();
            $this->db->select('register.full_name,register.mobile_no,reserve_table.*');
            $this->db->join('register','register.u_id = reserve_table.u_id');
            $this->db->where('reserve_table.hotel_id',$hotel_id);
            $this->db->where('reserve_table.request_status',$request_status);
            return $this->db->get('reserve_table')->result_array();
            $Q = $this->db->get('reserve_table');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function get_menu_list_pagination($admin_id)
        {
              $data = array();
              $this->db->select('*');
              $this->db->order_by('food_item_id','DESC');
              $this->db->where('hotel_id',$admin_id);           
              $Q = $this->db->get('food_menus');
              if($Q->num_rows() > 0)
              {
                  foreach ($Q->result_array() as $row)
                  {
                      $data[] = $row;
                  }
              }
              
              $Q->free_result();

              return $data;
        }
        public function get_food_facility($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('food_facility')->result_array();
        }
        public function get_hotels_facility($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('hotel_facility')->result_array();
        }
        public function get_hotel_admin_leads($hotel_id)
        {
            $this->db->join('leads_plan','leads_plan.leads_plan_id = admin_purchase_leads.leads_plan_id');
            $this->db->where('admin_purchase_leads.hotel_id',$hotel_id);
            return $this->db->get('admin_purchase_leads')->result_array();
        }
        public function get_hotel_photos($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('hotel_photos')->result_array();
        }

        function get_front_ofs_services_pagination($hotel_id,$service_name)
        {
            $data = array();
            $this->db->select('*');
           
            $this->db->order_by('front_ofs_service_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('service_name',$service_name);
            $Q = $this->db->get('front_ofs_services');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
           
	    function get_cab_service_pagination($hotel_id)
      {
          $data = array();

          $this->db->select('*');
          
          $this->db->order_by('cab_service_request_id','DESC');
          $this->db->where('hotel_id',$hotel_id);
          $this->db->where('request_status',0);
          $Q = $this->db->get('cab_service_request_list');

          if($Q->num_rows() > 0)
          {
            foreach ($Q->result_array() as $row)
            {
              $data[] = $row;
            }
          }

          $Q->free_result();

          return $data;
      }
      
        public function get_luggage_request_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('luggage_request_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('request_status',0);
            $Q = $this->db->get('luggage_request');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function get_vehicle_wash_request_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('vehicle_wash_request_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('request_status',0);
            $Q = $this->db->get('vehicle_wash_request');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        public function get_spa_services_images($hotel_id,$front_ofs_service_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('front_ofs_service_id',$front_ofs_service_id);
            return $this->db->get('front_ofs_spa_service_images')->result_array();
        }

        public function get_particular_hotel_staff_list($hotel_id,$user_type)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('user_type',$user_type);
            return $this->db->get('register')->result_array();
        }
        function get_laundry_order_pagination($hotel_id,$order_status)
        {
            $data = array();
            $this->db->select('*');
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,cloth_orders.*');
            $this->db->join('register','register.u_id = cloth_orders.u_id');
            $this->db->where('cloth_orders.hotel_id',$hotel_id);
            $this->db->where('cloth_orders.order_status',$order_status);
            $this->db->order_by('cloth_orders.cloth_order_id','desc');
            $Q = $this->db->get('cloth_orders');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function get_business_center_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('b_c_reserve_id','DESC');
            $this->db->select('business_center.business_center_type as business_center_type_name,business_center_reservation.*');
            $this->db->join('business_center','business_center.business_center_id = business_center_reservation.business_center_type');
            $this->db->where('business_center_reservation.hotel_id',$hotel_id);  
            $Q = $this->db->get('business_center_reservation');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        function get_facility_category_list_pagination($admin_id)
        {
              $data = array();
              $this->db->select('*');
              $this->db->order_by('food_facility_id','DESC');
              //$this->db->where('added_by',2);
              $this->db->where('hotel_id',$admin_id);
              $Q = $this->db->get('food_facility');

              if($Q->num_rows() > 0)
              {
                  foreach ($Q->result_array() as $row)
                  {
                      $data[] = $row;
                  }
              }
              
              $Q->free_result();

              return $data;
        }
        function get_facility_list_pagination($admin_id)
        {
              $data = array();
              $this->db->select('*');
              $this->db->order_by('food_facility_id','DESC');
              $this->db->where('hotel_id',$admin_id);
              $Q = $this->db->get('food_facility');

              if($Q->num_rows() > 0)
              {
                  foreach ($Q->result_array() as $row)
                  {
                      $data[] = $row;
                  }
              }
              
              $Q->free_result();

              return $data;
         }
        public function get_daily_report_available_rooms($date,$hotel_id)
        {
          $this->db->where('room_status',3);
          $this->db->where('DATE(created_at)',$date);
          $this->db->where('hotel_id',$hotel_id);
          return $this->db->get('room_status')->result_array();
        }
        public function getAllData($tbl,$wh)
        {
            $this->db->where($wh);
            return $this->db->get($tbl)->result_array();
        }  
        
        public function getData($tbl,$wh)
        {
            $this->db->where($wh);
            return $this->db->get($tbl)->row_array();
        }   

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
        
// public function get_booking_room_details($booking_id)
//         {
//             $this->db->select('room_type.room_type_name,user_hotel_booking_details.*');
//             $this->db->join('room_type','room_type.room_type_id = user_hotel_booking_details.room_type');
//             // $this->db->where('user_hotel_booking_details.hotel_id',$hotel_id);
//             $this->db->where('user_hotel_booking_details.booking_id',$booking_id);
//             return $this->db->get('user_hotel_booking_details')->result_array();
//         }

 public function get_available_room_no($hotel_id,$room_no)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_no',$room_no);
            $this->db->where('room_status',3);
            return $this->db->get('room_status')->row_array();
        }        
        function get_checkout_guest_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('register.full_name,register.mobile_no,user_hotel_booking.*,user_checkout_data.*');
            $this->db->join('register','register.u_id = user_checkout_data.u_id');
            $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_checkout_data.booking_id');
            $this->db->where('user_checkout_data.hotel_id',$hotel_id);
            $this->db->where('user_checkout_data.is_paid',1);
            $this->db->where('user_hotel_booking.booking_status',2);
            $Q = $this->db->get('user_checkout_data');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
  public function get_room_nos($hotel_id,$room_type)
         {
           $this->db->select('*');
           $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
           $this->db->where('room_configure.hotel_id',$hotel_id);
           $this->db->where('room_configure.room_type',$room_type);
           return $this->db->get('room_nos')->result_array();
         }

 public function get_user_booking_history($hotel_id,$u_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_status',2);
            return $this->db->get('user_hotel_booking')->result_array();
        } 
        public function get_room_service_minibar($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('room_servs_mini_bar')->result_array();
        }
        public function get_user_checkout_booking_data($hotel_id,$booking_id,$u_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('u_id',$u_id);
            $this->db->where('booking_id',$booking_id);
            return $this->db->get('user_checkout_data')->row_array();
        }
 public function get_user_data($u_id)
        {
            $this->db->where('u_id',$u_id);
            return $this->db->get('register')->row_array();
        }
        function get_food_order_pagination($hotel_id,$order_status)
        {
            $data = array();
            $this->db->select('*');
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,food_orders.*');
            $this->db->join('register','register.u_id = food_orders.u_id');
            $this->db->where('food_orders.hotel_id',$hotel_id);
            $this->db->where('food_orders.order_status',$order_status);
          	$this->db->order_by('food_orders.food_order_id','desc');
            $Q = $this->db->get('food_orders');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
      
 public function get_user_booking_details($hotel_id,$booking_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('booking_id',$booking_id);
            return $this->db->get('user_hotel_booking')->row_array();
        }
        function get_room_service_services_order_pagination($hotel_id,$order_status) 
        {
            $data = array();
            $this->db->select('*');
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,rmservice_services_orders.*');
            $this->db->join('register','register.u_id = rmservice_services_orders.u_id');
            $this->db->where('rmservice_services_orders.hotel_id',$hotel_id);
            $this->db->where('rmservice_services_orders.order_status',$order_status);
            $this->db->order_by('rmservice_services_orders.rmservice_services_order_id','desc');
            $Q = $this->db->get('rmservice_services_orders');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        function get_room_service_menu_order_pagination($hotel_id,$order_status)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('room_service_menu_order_id','DESC');
            $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,room_service_menu_orders.*');
            $this->db->join('register','register.u_id = room_service_menu_orders.u_id');
            $this->db->where('room_service_menu_orders.hotel_id',$hotel_id);
            $this->db->where('room_service_menu_orders.order_status',$order_status);
            $Q = $this->db->get('room_service_menu_orders');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
        
        public function get_booking_room_details($booking_id)
        {
            $this->db->select('room_type.room_type_name,user_hotel_booking_details.*');
            $this->db->join('room_type','room_type.room_type_id = user_hotel_booking_details.room_type');
            // $this->db->where('user_hotel_booking_details.hotel_id',$hotel_id);
            $this->db->where('user_hotel_booking_details.booking_id',$booking_id);
            return $this->db->get('user_hotel_booking_details')->result_array();
        }

        function get_panel_admin_list_according_to_hotel_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('u_id','DESC');
            $this->db->where('user_is',1);
            $this->db->where('hotel_id',$hotel_id);   
            $Q = $this->db->get('register');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        public function get_admin_panel_list($hotel_id)
        {
            $this->db->join('departement','departement.department_id = hotels_panel_list.department_id');
            $this->db->where('hotels_panel_list.admin_id',$hotel_id);
            $this->db->where('hotels_panel_list.department_id !=',1);
            return $this->db->get('hotels_panel_list')->result_array();
        }

        function get_room_type_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->where('hotel_id',$hotel_id);
            //$this->db->where('room_type_id !=',1);  
            $Q = $this->db->get('room_type');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        function get_business_center_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('business_center_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $Q = $this->db->get('business_center');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }

        public function get_room_nos_floor_wise($hotel_id,$floor_id)
        {
            $this->db->join('room_nos','room_nos.room_configure_id = room_configure.room_configure_id');
            $this->db->where('room_configure.hotel_id',$hotel_id);
            $this->db->where('room_configure.floor_id',$floor_id);
            return $this->db->get('room_configure')->result_array();
        }
        function get_floor_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('floor_id','ASC');
            $this->db->where('hotel_id',$hotel_id);  
            $Q = $this->db->get('floors');
            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }
 public function get_hotel_guidelines($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('hotel_guidelines')->row_array();
        }
        
function get_hotel_enquiry_request_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('hotel_enquiry_request_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('request_status',0);
            $Q = $this->db->get('hotel_enquiry_request');

            if($Q->num_rows() > 0)
            {
              foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
            }

            $Q->free_result();

            return $data;
        }


}