<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HotelAdminModel extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function get_room_type_list1($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('room_type')->result_array();
  }
  function get_vehicle_wash_charges_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('vehicle_washing_charge_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('vehicle_washing_charges');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function getBanquetData($wh)
  {
    $this->db->select('*');
    $this->db->from('banquet_hall');
    $this->db->where('banquet_hall_id', $wh);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getlostdata($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('faq_id', $wh);
    return $this->db->get('faq')->row_array();
  }
  public function getHSdata($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('h_k_order_id', $wh);
    return $this->db->get('house_keeping_orders')->row_array();
  }
  public function getFBdata($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('food_order_id', $wh);
    return $this->db->get('food_orders')->row_array();
  }
  public function getLaundrydata($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('cloth_order_id', $wh);
    return $this->db->get('cloth_orders')->row_array();
  }
  public function getstaffdata($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('rmservice_services_order_id', $wh);
    return $this->db->get('rmservice_services_orders')->row_array();
  }
  public function getotpdata($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('visitor_id', $wh);
    return $this->db->get('visitor')->row_array();
  }
  public function getstaff1data($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('room_service_menu_order_id', $wh);
    return $this->db->get('room_service_menu_orders')->row_array();
  }
  public function getfloordata($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('floor_id', $wh);
    return $this->db->get('floors')->row_array();
  }
  public function get_food_category($hotel_id, $food_facility_id)
  {
    $this->db->where('food_facility_id', $food_facility_id);
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('food_category')->result_array();
  }
  function banquet_hall_pending_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->select('register.full_name,register.mobile_no,banquet_hall.banquet_hall_name,banquet_hall_orders.*');
    $this->db->join('register', 'register.u_id = banquet_hall_orders.u_id');
    $this->db->join('banquet_hall', 'banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
    $this->db->where('banquet_hall_orders.hotel_id', $hotel_id);
    $this->db->where('banquet_hall_orders.request_status', 0);
    $Q = $this->db->get('banquet_hall_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function banquet_hall_pending_pagination_search($hotel_id,$date,$banquet_hall_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->select('register.full_name,register.mobile_no,banquet_hall.banquet_hall_name,banquet_hall_orders.*');
    $this->db->join('register', 'register.u_id = banquet_hall_orders.u_id');
    $this->db->join('banquet_hall', 'banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
    $this->db->where('banquet_hall_orders.hotel_id', $hotel_id);
    $this->db->where('banquet_hall_orders.request_status', 0);
    $this->db->where('banquet_hall_orders.event_date', $date);
    $this->db->where('banquet_hall_orders.banquet_hall_id', $banquet_hall_id);
    $Q = $this->db->get('banquet_hall_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function banquet_hall_pending_pagination_accepted_search($hotel_id,$date,$banquet_hall_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->select('register.full_name,register.mobile_no,banquet_hall.banquet_hall_name,banquet_hall_orders.*');
    $this->db->join('register', 'register.u_id = banquet_hall_orders.u_id');
    $this->db->join('banquet_hall', 'banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
    $this->db->where('banquet_hall_orders.hotel_id', $hotel_id);
    $this->db->where('banquet_hall_orders.request_status', 1);
    $this->db->where('banquet_hall_orders.event_date', $date);
    $this->db->where('banquet_hall_orders.banquet_hall_id', $banquet_hall_id);
    $Q = $this->db->get('banquet_hall_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function banquet_hall_pending_pagination_rejected_search($hotel_id,$date,$banquet_hall_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->select('register.full_name,register.mobile_no,banquet_hall.banquet_hall_name,banquet_hall_orders.*');
    $this->db->join('register', 'register.u_id = banquet_hall_orders.u_id');
    $this->db->join('banquet_hall', 'banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
    $this->db->where('banquet_hall_orders.hotel_id', $hotel_id);
    $this->db->where('banquet_hall_orders.request_status', 2);
    $this->db->where('banquet_hall_orders.event_date', $date);
    $this->db->where('banquet_hall_orders.banquet_hall_id', $banquet_hall_id);
    $Q = $this->db->get('banquet_hall_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  function get_complaints_pagination($hotel_id, $complaint_status)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('complaint_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('complaint_status', $complaint_status);
    $Q = $this->db->get('order_complaints');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_leads_plan()
  {
    return $this->db->get('leads_plan')->result_array();
  }
  public function get_leads_plan_1()
  {
    $this->db->select_max('amount');
    return $this->db->get('leads_plan')->result_array();
  }
  function get_close_complaints_pagination($hotel_id, $complaint_status)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('complaint_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('complaint_status', $complaint_status);
    $Q = $this->db->get('order_complaints');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('banquet_hall_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('banquet_hall');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  function banquet_hall_pending_pagination_accepted($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->select('register.full_name,register.mobile_no,banquet_hall.banquet_hall_name,banquet_hall_orders.*');
    $this->db->join('register', 'register.u_id = banquet_hall_orders.u_id');
    $this->db->join('banquet_hall', 'banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
    $this->db->where('banquet_hall_orders.hotel_id', $hotel_id);
    $this->db->where('banquet_hall_orders.request_status', 1);
    $Q = $this->db->get('banquet_hall_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function banquet_hall_pending_pagination_rejected($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->select('register.full_name,register.mobile_no,banquet_hall.banquet_hall_name,banquet_hall_orders.*');
    $this->db->join('register', 'register.u_id = banquet_hall_orders.u_id');
    $this->db->join('banquet_hall', 'banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
    $this->db->where('banquet_hall_orders.hotel_id', $hotel_id);
    $this->db->where('banquet_hall_orders.request_status', 2);
    $Q = $this->db->get('banquet_hall_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function get_manager_handover_completed_list_pagination($hotel_id, $is_complete2)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('m_handover_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('is_complete', $is_complete2);
    $Q = $this->db->get('handover_manger');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function get_staff_handover_pagination($hotel_id, $is_complete1,$today_date)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('staff_handover_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('date', $today_date);
    $this->db->where('is_complete', $is_complete1);
    $Q = $this->db->get('handover_staff');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function get_staff_handover_pagination_search($hotel_id,$date,$staff_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('staff_handover_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('date', $date);
    $this->db->where('create_staff_id', $staff_id);
    $Q = $this->db->get('handover_staff');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function get_staff_complete_handover_pagination($hotel_id, $is_complete1)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('staff_handover_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('is_complete', $is_complete1);
    $Q = $this->db->get('handover_staff');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function get_staff_complete_handover_pagination_search($hotel_id,$date,$staff_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('staff_handover_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('date', $date);
    $this->db->where('create_staff_id', $staff_id);
    $Q = $this->db->get('handover_staff');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function get_manager_handover_list_pagination($hotel_id, $is_complete1)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('m_handover_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('is_complete', $is_complete1);
    $Q = $this->db->get('handover_manger');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_laundry_time($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('laundry_time')->row_array();
  }
  public function get_admin_panel_list_2($hotel_id)
  {
    $this->db->join('departement', 'departement.department_id = hotels_panel_list.department_id');
    $this->db->where('hotels_panel_list.admin_id', $hotel_id);
    $this->db->where('hotels_panel_list.department_id !=', 1);
    $this->db->where('hotels_panel_list.department_id !=', 2);
    return $this->db->get('hotels_panel_list')->result_array();
  }

  function get_staff_list_according_to_hotel_1($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('user_is', 2);
    $this->db->order_by('u_id', 'DESC');
    $Q = $this->db->get('register');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  function get_checkout_guest_list_date_wise_pagination($hotel_id, $date)
  {
    $data = array();
    $this->db->select('register.full_name,register.mobile_no,user_hotel_booking.*,user_checkout_data.*');
    $this->db->join('register', 'register.u_id = user_checkout_data.u_id');
    $this->db->join('user_hotel_booking', 'user_hotel_booking.booking_id = user_checkout_data.booking_id');
    $this->db->where('user_checkout_data.hotel_id', $hotel_id);
    $this->db->where('user_checkout_data.is_paid', 1);
    $this->db->where('user_hotel_booking.booking_status', 2);
    $this->db->where('user_hotel_booking.actual_checkout', $date);
    $Q = $this->db->get('user_checkout_data');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('r_s_min_bar_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('room_servs_mini_bar');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_room_service_cat_list($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('room_servs_category')->result_array();
  }

  function room_service_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('r_s_services_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('room_servs_services');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('h_k_services_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('house_keeping_services');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('cloth_id', 'DESC');
    $this->db->where('hotel_id', $admin_id);
    $Q = $this->db->get('cloth');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_room_type_list($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    // $this->db->where('room_type_id !=',1);
    return $this->db->get('room_type')->result_array();
  }
  public function get_user_pending_booking_list_from_app($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('booking_status', 0);
    $this->db->where('booking_from', 2);
    $this->db->where('check_in', date('Y-m-d'));
    return $this->db->get('user_hotel_booking')->result_array();
  }
  public function get_upcoming_list_from_app($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('booking_status', 0);
    $this->db->where('booking_from', 2);
    $this->db->order_by('booking_id', 'DESC');
    $this->db->where('check_in >', date('Y-m-d'));
    return $this->db->get('user_hotel_booking')->result_array();
  }
  function get_user_pending_booking_list_from_app_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('booking_status', 0);
    $this->db->where('booking_from', 2);
    $this->db->where('check_in', date('Y-m-d'));
    $Q = $this->db->get('user_hotel_booking');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('luggage_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 1);
    $Q = $this->db->get('luggage_request');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('luggage_charge_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('luggage_charges');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('vehicle_wash_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 1);
    $Q = $this->db->get('vehicle_wash_request');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_vehicle_wash_rejected_request_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('vehicle_wash_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 2);
    $Q = $this->db->get('vehicle_wash_request');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_vehicle_wash_completed_request_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('vehicle_wash_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 4);
    $Q = $this->db->get('vehicle_wash_request');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('offer_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('offers');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function total_order($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    // $this->db->order_by('offer_id','DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('house_keeping_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_user_data_by_no($mobile_no)
  {
    $this->db->where('mobile_no', $mobile_no);
    $this->db->where('user_type', 0);
    return $this->db->get('register')->row_array();
  }
  public function get_laundry_order($hotel_id, $order_status)
  {
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,cloth_orders.*');
    $this->db->join('register', 'register.u_id = cloth_orders.u_id');
    $this->db->where('cloth_orders.hotel_id', $hotel_id);
    $this->db->where('cloth_orders.order_status', $order_status);
    return $this->db->get('cloth_orders')->result_array();
  }
  public function get_house_keeping_service_order($hotel_id, $order_status)
  {
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,house_keeping_orders.*');
    $this->db->join('register', 'register.u_id = house_keeping_orders.u_id');
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status', $order_status);
    return $this->db->get('house_keeping_orders')->result_array();
  }
  public function get_hotel_expected_current_booking($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('check_in <=', date('Y-m-d'));
    return $this->db->get('user_hotel_booking')->result_array();
  }
  public function get_hotel_rooms_status($hotel_id, $room_status)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_status', $room_status);
    return $this->db->get('room_status')->result_array();
  }
  public function get_notifications_for_housekeeping($hotel_id,$today_date)
  {
    // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
    $this->db->where('notifications.send_by_id', $hotel_id);
    $this->db->where('notifications.send_for', 7);
    $this->db->where('DATE(notifications.created_at)', $today_date);
    $this->db->where('notifications.order_status !=',4);
    $this->db->where('notifications.order_status !=',5);
    $this->db->order_by('notifications.notification_id', 'desc');
    // $this->db->limit(20);
    return $this->db->get('notifications')->result_array();
  }
  public function get_hotel_rooms_status_bar_chart($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_status', 3);
    $this->db->where('HOUR(created_at) >=', $time1);
    $this->db->where('HOUR(created_at) <=', $time2);
    $this->db->where('DATE(created_at)', date('Y-m-d'));
    return $this->db->get('room_status')->result_array();
  }
  public function get_hotel_rooms_status_bar_chart1($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_status', 1);
    $this->db->where('HOUR(updated_at) >=', $time1);
    $this->db->where('HOUR(updated_at) <=', $time2);
    $this->db->where('DATE(updated_at)', date('Y-m-d'));
    return $this->db->get('room_status')->result_array();
  }

  public function get_room_service_services_order($hotel_id, $order_status)
  {
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,rmservice_services_orders.*');
    $this->db->join('register', 'register.u_id = rmservice_services_orders.u_id');
    $this->db->where('rmservice_services_orders.hotel_id', $hotel_id);
    $this->db->where('rmservice_services_orders.order_status', $order_status);
    $this->db->order_by('rmservice_services_orders.rmservice_services_order_id', 'desc');
    return $this->db->get('rmservice_services_orders')->result_array();
  }
  public function get_room_service_menu_order($hotel_id, $order_status)
  {
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,room_service_menu_orders.*');
    $this->db->join('register', 'register.u_id = room_service_menu_orders.u_id');
    $this->db->where('room_service_menu_orders.hotel_id', $hotel_id);
    $this->db->where('room_service_menu_orders.order_status', $order_status);
    return $this->db->get('room_service_menu_orders')->result_array();
  }
  public function get_particular_hotel_staff_list_count($hotel_id, $user_type, $is_active)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('user_type', $user_type);
    $this->db->where('is_active', $is_active);
    return $this->db->get('register')->result_array();
  }
  public function get_notifications_for_rs($hotel_id)
  {
    // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
    $this->db->where('notifications.send_by_id', $hotel_id);
    $this->db->where('notifications.send_for', 7);
    // $this->db->where('notifictions_department_id.department_id',3);
    $this->db->order_by('notifications.notification_id', 'desc');
    $this->db->limit(4);
    return $this->db->get('notifications')->result_array();
  }
  public function get_room_type_data($hotel_id)
  {
    $this->db->where($hotel_id);
    return $this->db->get('room_type')->row_array();
  }
  public function get_room_related_data($hotel_id, $room_type)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_type', $room_type);
    return $this->db->get('room_configure')->result_array();
  }
  public function get_hotel_available_service_list($department_id)
  {
    $this->db->where('department_id', $department_id);
    return $this->db->get('services_name_department_wise')->result_array();
  }
  public function get_floor_list($hotel_id)
  {
    $this->db->order_by('floor', 'asc');
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('floors')->result_array();
  }
  public function get_room_service_order_count($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('order_time >=', $time1);
    // $this->db->where('HOUR(created_at)',$time2);
    $this->db->where('order_time <=', $time2);
    $this->db->where('order_date', date("Y-m-d"));
    $this->db->where('order_status', 0);
    return $this->db->get('rmservice_services_orders')->result_array();
  }
  public function get_room_service_menu_order_count($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('order_time >=', $time1);
    $this->db->where('order_time <=', $time2);
    $this->db->where('order_date', date("Y-m-d"));
    $this->db->where('order_status', 0);
    return $this->db->get('room_service_menu_orders')->result_array();
  }
  public function get_room_service_order_complate_count($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('HOUR(updated_at) >=', $time1);
    $this->db->where('HOUR(updated_at) <=', $time2);
    $this->db->where('complete_date', date("Y-m-d"));
    $this->db->where('order_status', 2);
    return $this->db->get('rmservice_services_orders')->result_array();
  }
  public function get_room_service_menu_order_complete_count($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('HOUR(updated_at) >=', $time1);
    $this->db->where('HOUR(updated_at) <=', $time2);
    $this->db->where('complete_date', date("Y-m-d"));
    $this->db->where('order_status', 2);
    return $this->db->get('room_service_menu_orders')->result_array();
  }
  //getroom nos //4-11-2022 //archana
  public function get_room_nos_data($hotel_id, $room_type, $room_no)
  {
    $this->db->join('room_configure', 'room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->where('room_configure.hotel_id', $hotel_id);
    $this->db->where('room_configure.room_type', $room_type);
    //$this->db->where('room_nos_img.room_no',$room_no);
    $this->db->where('room_nos.room_no', $room_no);
    return $this->db->get('room_nos')->row_array();
  }

  // room service order count//7-12-2022 //archana
  public function get_room_service_order_count1($hotel_id, $time1, $time2)
  {
    $date1 = date("Y-m-d", strtotime('-7 days'));
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('order_time >=', $time1);
    $this->db->where('order_time <=', $time2);
    $this->db->where('order_date >=', $date1);
    $this->db->where('order_date <=', date("Y-m-d"));
    $this->db->where('order_status', 0);
    return $this->db->get('rmservice_services_orders')->result_array();
  }

  // room service order count//7-12-2022 //archana
  public function get_room_service_menu_order_count1($hotel_id, $time1, $time2)
  {
    $date1 = date("Y-m-d", strtotime('-7 days'));
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('order_time >=', $time1);
    $this->db->where('order_time <=', $time2);
    $this->db->where('order_date >=', $date1);
    $this->db->where('order_date <=', date("Y-m-d"));
    $this->db->where('order_status', 0);
    return $this->db->get('room_service_menu_orders')->result_array();
  }

  // room service complete order count last 7 days//7-12-2022 //archana
  public function get_room_service_order_complate_count1($hotel_id, $time1, $time2)
  {
    $date1 = date("Y-m-d", strtotime('-7 days'));
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('HOUR(updated_at) >=', $time1);
    $this->db->where('HOUR(updated_at) <=', $time2);
    $this->db->where('complete_date >=', $date1);
    $this->db->where('complete_date <=', date("Y-m-d"));
    $this->db->where('order_status', 2);
    return $this->db->get('rmservice_services_orders')->result_array();
  }
  public function get_room_service_menu_order_complete_count1($hotel_id, $time1, $time2)
  {
    $date1 = date("Y-m-d", strtotime('-7 days'));
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('HOUR(updated_at) >=', $time1);
    $this->db->where('HOUR(updated_at) <=', $time2);
    $this->db->where('complete_date >=', $date1);
    $this->db->where('complete_date <=', date("Y-m-d"));
    $this->db->where('order_status', 2);
    return $this->db->get('room_service_menu_orders')->result_array();
  }

  // room service order count current month//7-12-2022 //archana
  public function get_room_service_order_current_mnt_count($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('order_time >=', $time1);
    $this->db->where('order_time <=', $time2);
    $this->db->where('MONTH(order_date)', date("m"));
    $this->db->where('order_status', 0);
    return $this->db->get('rmservice_services_orders')->result_array();
  }

  // room service order count current month//7-12-2022 //archana
  public function get_room_service_menu_order_current_mnt_count($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('order_time >=', $time1);
    $this->db->where('order_time <=', $time2);
    $this->db->where('MONTH(order_date)', date("m"));
    $this->db->where('order_status', 0);
    return $this->db->get('room_service_menu_orders')->result_array();
  }

  // room service complete order count current month//7-12-2022 //archana
  public function get_room_service_order_complete_count_current_mnt($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('HOUR(updated_at) >=', $time1);
    $this->db->where('HOUR(updated_at) <=', $time2);
    $this->db->where('MONTH(updated_at)', date("m"));
    $this->db->where('order_status', 2);
    return $this->db->get('rmservice_services_orders')->result_array();
  }

  // room service complete order count//7-12-2022 //archana
  public function get_room_service_menu_order_complete_count_current_mnt($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('HOUR(updated_at) >=', $time1);
    $this->db->where('HOUR(updated_at) <=', $time2);
    $this->db->where('MONTH(updated_at)', date("m"));
    $this->db->where('order_status', 2);
    return $this->db->get('room_service_menu_orders')->result_array();
  }

  // room service order count current year//7-12-2022 //archana
  public function get_room_service_order_current_yr_count($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('order_time >=', $time1);
    $this->db->where('order_time <=', $time2);
    $this->db->where('YEAR(order_date)', date("Y"));
    $this->db->where('order_status', 0);
    return $this->db->get('rmservice_services_orders')->result_array();
  }
  public function get_room_service_menu_order_current_yr_count($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('order_time >=', $time1);
    $this->db->where('order_time <=', $time2);
    $this->db->where('YEAR(order_date)', date("Y"));
    $this->db->where('order_status', 0);
    return $this->db->get('room_service_menu_orders')->result_array();
  }

  // room service complete order count current month//7-12-2022 //archana
  public function get_room_service_order_complete_count_current_yr($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('HOUR(updated_at) >=', $time1);
    $this->db->where('HOUR(updated_at) <=', $time2);
    $this->db->where('YEAR(updated_at)', date("Y"));
    $this->db->where('order_status', 2);
    return $this->db->get('rmservice_services_orders')->result_array();
  }

  // room service complete order count//7-12-2022 //archana
  public function get_room_service_menu_order_complete_count_current_yr($hotel_id, $time1, $time2)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('HOUR(updated_at) >=', $time1);
    $this->db->where('HOUR(updated_at) <=', $time2);
    $this->db->where('YEAR(updated_at)', date("Y"));
    $this->db->where('order_status', 2);
    return $this->db->get('room_service_menu_orders')->result_array();
  }

  //get checkout rooms//7-12-2022 //archana
  public function get_checkout_room_no($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_status', 1);
    return $this->db->get('room_status')->result_array();
  }

  function get_notifications_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('notification_id', 'DESC');
    $this->db->where('send_by_id', $hotel_id);
    $this->db->where('send_by', 2);
    // $this->db->where('send_for',6);
    $this->db->where('send_for', 7);
    $Q = $this->db->get('notifications');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function get_notifications_pagination_search($hotel_id,$send_to,$notification_type)
  {
      $data = array();
      $this->db->select('*');
      $this->db->order_by('notification_id','DESC');
      $this->db->where('send_by_id',$hotel_id);
      $this->db->where('send_to',$send_to);
      $this->db->where('notification_type',$notification_type);
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
    $this->db->where('added_by_u_id', $hotel_id);
    $this->db->where('added_by', 1);
    return $this->db->get('privacy_policy')->row_array();
  }
  function get_faq_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('faq_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('faq');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }


  public function get_user_list_of_particular_hotel($hotel_id)
  {
    $this->db->select('register.u_id,register.full_name,guest_user.*');
    $this->db->join('register', 'register.u_id = guest_user.u_id');
    $this->db->where('guest_user.hotel_id', $hotel_id);
    $this->db->where('guest_user.is_guest', 1);
    $this->db->where('guest_user.is_department_notification', 1);
    return $this->db->get('guest_user')->result_array();
  }
  public function get_user_list_by_hotels($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('user_type', 0);
    $this->db->where('is_active', 1);
    return $this->db->get('register')->result_array();
  }
  function get_admin_sent_user_notifications_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->where('send_by_id', $hotel_id);
    $this->db->where('send_by', 2);
    $this->db->where('send_for', 3);
    $this->db->order_by('notification_id', 'DESC');
    $Q = $this->db->get('notifications');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  function get_admin_sent_user_notifications_pagination_search($hotel_id,$send_to,$notification_type)
  {
      $data = array();
      $this->db->select('*');
      $this->db->where('send_by_id',$hotel_id);
      $this->db->where('send_to',$send_to);
      $this->db->where('notification_type',$notification_type);
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
    $this->db->order_by('hotel_near_by_help_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('hotel_near_by_help');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_room_no_list($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_status', 3);
    return $this->db->get('room_status')->result_array();
  }

  function get_guest_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
    $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
    $this->db->join('guest_user', 'guest_user.u_id = user_hotel_booking.u_id AND guest_user.hotel_id = user_hotel_booking.hotel_id AND guest_user.booking_id = user_hotel_booking.booking_id');
    $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
    $this->db->where('user_hotel_booking.booking_status', 1);
    $this->db->order_by('user_hotel_booking.booking_id', 'desc');
    $this->db->where('DATE_FORMAT(user_hotel_booking.check_in, "%Y-%m-%d") <=', date('Y-m-d'));
    // $this->db->where('DATE_FORMAT(user_hotel_booking.check_in, "%Y-%m-%d") >=',date('Y-m-d'));
    $Q = $this->db->get('user_hotel_booking');
    // echo "<pre>";
    // print_r($this->db->last_query());
    // exit;

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }
    $Q->free_result();
    return $data;
  }
  function get_guest_list_pagination1($hotel_id, $date1, $date2, $name)
  {
    $data = array();

    $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
    $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
    $this->db->join('guest_user', 'guest_user.u_id = user_hotel_booking.u_id AND guest_user.hotel_id = user_hotel_booking.hotel_id AND guest_user.booking_id = user_hotel_booking.booking_id');
    $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
    $this->db->where('register.full_name', $name);
    $this->db->where('user_hotel_booking.booking_status', 1);
    $this->db->where('user_hotel_booking.check_in >=', $date1);
    $this->db->where('user_hotel_booking.check_out <=', $date2);
    $this->db->order_by('user_hotel_booking.booking_id', 'desc');
    // $this->db->where('user_hotel_booking.check_out >=',date('Y-m-d'));
    $Q = $this->db->get('user_hotel_booking');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_departure_guest_list($hotel_id)
  {
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
    $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
    $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
    $this->db->where('user_hotel_booking.booking_status', 2);
    $this->db->order_by('user_hotel_booking.actual_checkout', 'desc');
    return $this->db->get('user_hotel_booking')->result_array();
  }
  public function get_upcoming_guest_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
    $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
    $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
    $this->db->where('DATE_FORMAT(user_hotel_booking.check_in, "%Y-%m-%d") >', date('Y-m-d'));
    // $this->db->where('user_hotel_booking.check_in >=',date('Y-m-d'));
    $this->db->where('user_hotel_booking.booking_status', 1);
    $Q = $this->db->get('user_hotel_booking');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_feedback_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');

    $this->db->select('register.full_name,review.*');
    $this->db->join('register', 'register.u_id = review.u_id');
    $this->db->where('review.hotel_id', $hotel_id);
    $Q = $this->db->get('review');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_feedback_list_pagination_search($hotel_id,$date,$review_for)
  {
      $data = array();
      $this->db->select('*');
      $this->db->select('register.full_name,review.*');
      $this->db->join('register','register.u_id = review.u_id');
      $this->db->where('review.hotel_id',$hotel_id);
      $this->db->where('review.rating_date',$date);
      $this->db->where('review.review_for',$review_for);
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

    $this->db->order_by('hotel_near_by_place_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('hotel_near_by_place');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('lost_found_list');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('expense_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('expenses');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->where('hotel_id', $hotel_id);
    $this->db->order_by('visitor_id', 'DESC');
    $Q = $this->db->get('visitor');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_active_business_center($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('is_active', 1);
    return $this->db->get('business_center')->result_array();
  }
  function get_hotel_enquiry_accepted_request_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    // $this->db->limit($limit, $offset);
    $this->db->order_by('hotel_enquiry_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 1);
    $Q = $this->db->get('hotel_enquiry_request');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_shuttle_service_staff_avaibility_by_day($hotel_id, $day)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('day', $day);
    return $this->db->get('shuttle_service_avaibility')->result_array();
  }
  function get_hotel_enquiry_rejected_request_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    // $this->db->limit($limit, $offset);
    $this->db->order_by('hotel_enquiry_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 2);
    $Q = $this->db->get('hotel_enquiry_request');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function cab_service_accepted_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    // $this->db->limit($limit, $offset);
    $this->db->order_by('accepted_date', 'DESC');
    $this->db->order_by('request_date', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 1);
    $Q = $this->db->get('cab_service_request_list');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('complete_date', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 4);
    $Q = $this->db->get('cab_service_request_list');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  function get_house_keeping_service_order_pagination($hotel_id, $order_status, $room_num = '')
  {
    $data = array();
    $this->db->select('*');
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,house_keeping_orders.*');
    $this->db->join('register', 'register.u_id = house_keeping_orders.u_id');
    if (!empty($room_num)) {
      $this->db->join('user_hotel_booking_details', 'user_hotel_booking_details.booking_id = house_keeping_orders.booking_id');
      $this->db->where('user_hotel_booking_details.room_no', $room_num);
    }
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status', $order_status);
    $this->db->where('house_keeping_orders.order_from', 3);
    $this->db->order_by('house_keeping_orders.h_k_order_id', 'desc');
    $Q = $this->db->get('house_keeping_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  function get_reserve_table_list_pagination($hotel_id, $request_status)
  {
    $data = array();
    $this->db->select('register.full_name,register.mobile_no,reserve_table.*');
    $this->db->join('register', 'register.u_id = reserve_table.u_id');
    $this->db->where('reserve_table.hotel_id', $hotel_id);
    $this->db->where('reserve_table.request_status', $request_status);
    $Q = $this->db->get('reserve_table');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }


  function get_reserve_table_pending_list_pagination($hotel_id, $request_status)
  {
    $data = array();
    $this->db->select('register.full_name,register.mobile_no,reserve_table.*');
    $this->db->join('register', 'register.u_id = reserve_table.u_id');
    $this->db->order_by('reserve_table.created_at', 'DESC');
    $this->db->where('reserve_table.hotel_id', $hotel_id);
    $this->db->where('reserve_table.request_status', $request_status);
    return $this->db->get('reserve_table')->result_array();
    $Q = $this->db->get('reserve_table');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  function get_new_reserve_tbl_data($rowperpage, $row, $search, $hotel_id)
  {
    $this->db->order_by('reserve_table.created_at', 'DESC');
    $this->db->limit($rowperpage, $row);
    $this->db->where('reserve_table.hotel_id', $hotel_id);
    $this->db->where('reserve_table.request_status', 0);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_like('reserve_table.request_date', $search);
      $this->db->group_end();
    }

    $this->db->select('register.full_name,register.mobile_no,reserve_table.*');
    $this->db->from('reserve_table');
    $this->db->join('register', 'register.u_id = reserve_table.u_id');
    $query = $this->db->get();
    // echo "<pre>";
    // print_r($this->db->last_query());
    // exit;
    return $query->result_array();
  }

  function total_new_reserve_tbl_data($search = '', $hotel_id = '')
  {
    $this->db->order_by('reserve_table.created_at', 'DESC');
    $this->db->where('reserve_table.hotel_id', $hotel_id);
    $this->db->where('reserve_table.request_status', 0);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_like('reserve_table.request_date', $search);
      $this->db->group_end();
    }

    $this->db->select('count(reserve_table.reserve_table_id) as total_record');
    $this->db->from('reserve_table');
    $this->db->join('register', 'register.u_id = reserve_table.u_id');
    $query = $this->db->get();
    return $query->row();
  }

  function get_acceped_reserve_tbl_data($rowperpage, $row, $search, $hotel_id)
  {
    $this->db->order_by('reserve_table.updated_at', 'DESC');
    $this->db->limit($rowperpage, $row);
    $this->db->where('reserve_table.hotel_id', $hotel_id);
    $this->db->where('reserve_table.request_status', 1);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_where('register.mobile_no', $search);
      $this->db->or_like('reserve_table.request_date', $search);
      $this->db->or_like('reserve_table.accept_date', $search);
      $this->db->group_end();
    }
    $this->db->select('register.full_name,register.mobile_no,reserve_table.*');
    $this->db->from('reserve_table');
    $this->db->join('register', 'register.u_id = reserve_table.u_id');
    $query = $this->db->get();
    // echo "<pre>";
    // print_r($this->db->last_query());
    // exit;
    return $query->result_array();
  }

  function total_acceped_reserve_tbl_data($search = '', $hotel_id = '')
  {
    $this->db->order_by('reserve_table.created_at', 'DESC');
    $this->db->where('reserve_table.hotel_id', $hotel_id);
    $this->db->where('reserve_table.request_status', 1);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_where('register.mobile_no', $search);
      $this->db->or_like('reserve_table.request_date', $search);
      $this->db->or_like('reserve_table.accept_date', $search);
      $this->db->group_end();
    }

    $this->db->select('count(reserve_table.reserve_table_id) as total_record');
    $this->db->from('reserve_table');
    $this->db->join('register', 'register.u_id = reserve_table.u_id');
    $query = $this->db->get();
    return $query->row();
  }

  function get_rejected_reserve_tbl_data($rowperpage, $row, $search, $hotel_id)
  {
    $this->db->order_by('reserve_table.updated_at', 'DESC');
    $this->db->limit($rowperpage, $row);
    $this->db->where('reserve_table.hotel_id', $hotel_id);
    $this->db->where('reserve_table.request_status', 2);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_where('register.mobile_no', $search);
      $this->db->or_like('reserve_table.request_date', $search);
      $this->db->or_like('reserve_table.reject_date', $search);
      $this->db->group_end();
    }
    $this->db->select('register.full_name,register.mobile_no,reserve_table.*');
    $this->db->from('reserve_table');
    $this->db->join('register', 'register.u_id = reserve_table.u_id');
    $query = $this->db->get();
    // echo "<pre>";
    // print_r($this->db->last_query());
    // exit;
    return $query->result_array();
  }

  function total_rejected_reserve_tbl_data($search = '', $hotel_id = '')
  {
    $this->db->order_by('reserve_table.created_at', 'DESC');
    $this->db->where('reserve_table.hotel_id', $hotel_id);
    $this->db->where('reserve_table.request_status', 2);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_where('register.mobile_no', $search);
      $this->db->or_like('reserve_table.request_date', $search);
      $this->db->or_like('reserve_table.reject_date', $search);
      $this->db->group_end();
    }

    $this->db->select('count(reserve_table.reserve_table_id) as total_record');
    $this->db->from('reserve_table');
    $this->db->join('register', 'register.u_id = reserve_table.u_id');
    $query = $this->db->get();
    return $query->row();
  }


  function get_menu_list_pagination($admin_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('food_item_id', 'DESC');
    $this->db->where('hotel_id', $admin_id);
    $Q = $this->db->get('food_menus');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_food_facility($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('food_facility')->result_array();
  }
  public function get_hotels_facility($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('hotel_facility')->result_array();
  }
  public function get_hotel_admin_leads($hotel_id)
  {
    $this->db->join('leads_plan', 'leads_plan.leads_plan_id = admin_purchase_leads.leads_plan_id');
    $this->db->where('admin_purchase_leads.hotel_id', $hotel_id);
    return $this->db->get('admin_purchase_leads')->result_array();
  }
  public function get_hotel_photos($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('hotel_photos')->result_array();
  }

  function get_front_ofs_services_pagination($hotel_id, $service_name)
  {
    $data = array();
    $this->db->select('*');

    $this->db->order_by('front_ofs_service_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('service_name', $service_name);
    $Q = $this->db->get('front_ofs_services');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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

    $this->db->order_by('cab_service_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 0);
    $Q = $this->db->get('cab_service_request_list');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('luggage_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 0);
    $Q = $this->db->get('luggage_request');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('vehicle_wash_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 0);
    $Q = $this->db->get('vehicle_wash_request');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_spa_services_images($hotel_id, $front_ofs_service_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('front_ofs_service_id', $front_ofs_service_id);
    return $this->db->get('front_ofs_spa_service_images')->result_array();
  }

  public function get_particular_hotel_staff_list($hotel_id, $user_type)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('user_type', $user_type);
    return $this->db->get('register')->result_array();
  }
  function get_laundry_order_pagination($hotel_id, $order_status, $room_num = '')
  {
    $data = array();
    $this->db->select('*');
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,cloth_orders.*');
    if (!empty($room_num)) {
      $this->db->join('user_hotel_booking_details', 'user_hotel_booking_details.booking_id = cloth_orders.booking_id');
      $this->db->where('user_hotel_booking_details.room_no', $room_num);
    }
    $this->db->join('register', 'register.u_id = cloth_orders.u_id');
    $this->db->where('cloth_orders.hotel_id', $hotel_id);
    $this->db->where('cloth_orders.order_status', $order_status);
    $this->db->where('cloth_orders.order_from', 3);
    $this->db->order_by('cloth_orders.cloth_order_id', 'desc');
    $Q = $this->db->get('cloth_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('b_c_reserve_id', 'DESC');
    $this->db->select('business_center.business_center_type as business_center_type_name,business_center_reservation.*');
    $this->db->join('business_center', 'business_center.business_center_id = business_center_reservation.business_center_type');
    $this->db->where('business_center_reservation.hotel_id', $hotel_id);
    $this->db->where('business_center_reservation.request_status', 1);
    $Q = $this->db->get('business_center_reservation');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_business_center_reservation_list_app($hotel_id)
  {
    $data = array();

    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 0);

    $this->db->order_by('b_c_reserve_id', 'DESC');
    $Q = $this->db->get('business_center_reservation');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
    //    return $this->db->get('business_center_reservation')->result_array();
  }
  public function get_business_center_list_reject_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('b_c_reserve_id', 'DESC');
    $this->db->select('business_center.business_center_type as business_center_type_name,business_center_reservation.*');
    $this->db->join('business_center', 'business_center.business_center_id = business_center_reservation.business_center_type');
    $this->db->where('business_center_reservation.request_status', 2);
    $this->db->where('business_center_reservation.hotel_id', $hotel_id);
    $Q = $this->db->get('business_center_reservation');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('food_facility_id', 'DESC');
    //$this->db->where('added_by',2);
    $this->db->where('hotel_id', $admin_id);
    $Q = $this->db->get('food_facility');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('food_facility_id', 'DESC');
    $this->db->where('hotel_id', $admin_id);
    $Q = $this->db->get('food_facility');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_daily_report_available_rooms($hotel_id)
  {
    $this->db->where('room_status', 3);
    
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('room_status')->result_array();
  }
  public function getAllData($tbl, $wh)
  {
    $this->db->where($wh);
    return $this->db->get($tbl)->result_array();
  }
  public function getData1($tbl, $wh)
  {
    $this->db->where($wh);
    $this->db->order_by('created_at', 'DESC');
    return $this->db->get($tbl)->row_array();
  }
  public function getData($tbl, $wh)
  {
    $this->db->where($wh);
    return $this->db->get($tbl)->row_array();
  }

  public function insert_data($tbl, $arr)
  {
    $this->db->insert($tbl, $arr);
    return $this->db->insert_id();
  }
  public function edit_data($tbl, $wh, $arr)
  {
    $this->db->where($wh);
    if ($this->db->update($tbl, $arr)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function delete_data($tbl, $wh)
  {
    $this->db->where($wh);
    if ($this->db->delete($tbl)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function get_available_room_no($hotel_id, $room_no)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_no', $room_no);
    $this->db->where('room_status', 3);
    return $this->db->get('room_status')->row_array();
  }
  function get_checkout_guest_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('register.full_name,register.mobile_no,user_hotel_booking.*,user_checkout_data.*');
    $this->db->join('register', 'register.u_id = user_checkout_data.u_id');
    $this->db->join('user_hotel_booking', 'user_hotel_booking.booking_id = user_checkout_data.booking_id');
    $this->db->where('user_checkout_data.hotel_id', $hotel_id);
    $this->db->where('user_checkout_data.is_paid', 1);
    $this->db->where('user_hotel_booking.booking_status', 2);
    $Q = $this->db->get('user_checkout_data');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_room_nos($hotel_id, $room_type)
  {
    $this->db->select('*');
    $this->db->join('room_configure', 'room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->where('room_configure.hotel_id', $hotel_id);
    $this->db->where('room_configure.room_type', $room_type);
    return $this->db->get('room_nos')->result_array();
  }

  public function get_user_booking_history($hotel_id, $u_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('u_id', $u_id);
    $this->db->where('booking_status', 2);
    return $this->db->get('user_hotel_booking')->result_array();
  }
  public function get_room_service_minibar($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('room_servs_mini_bar')->result_array();
  }
  public function get_user_checkout_booking_data($hotel_id, $booking_id, $u_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('u_id', $u_id);
    $this->db->where('booking_id', $booking_id);
    return $this->db->get('user_checkout_data')->row_array();
  }
  public function get_user_data($u_id)
  {
    $this->db->where('u_id', $u_id);
    return $this->db->get('register')->row_array();
  }

  function get_food_order_pagination($hotel_id, $order_status, $room_num = '')
  {
    $data = array();
    $this->db->select('*');
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,food_orders.*');
    $this->db->join('register', 'register.u_id = food_orders.u_id');
    if (!empty($room_num)) {
      $this->db->join('user_hotel_booking_details', 'user_hotel_booking_details.booking_id = food_orders.booking_id');
      $this->db->where('user_hotel_booking_details.room_no', $room_num);
    }
    $this->db->where('food_orders.hotel_id', $hotel_id);
    $this->db->where('food_orders.order_status', $order_status);
    $this->db->where('food_orders.order_from', 3);
    $this->db->order_by('food_orders.food_order_id', 'desc');
    $Q = $this->db->get('food_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  function get_new_food_order_data($rowperpage, $row, $search, $hotel_id, $room_num = '')
  {
    $this->db->order_by('food_orders.food_order_id', 'desc');
    $this->db->limit($rowperpage, $row);
    $this->db->where('food_orders.hotel_id', $hotel_id);
    $this->db->where('food_orders.order_status', 0);
    $this->db->where('food_orders.order_from', 3);
    $this->db->where('food_orders.order_date', date('Y-m-d'));

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_like('food_orders.order_date', $search);
      $this->db->or_like('food_orders.food_order_id', $search);
      $this->db->group_end();
    }
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,food_orders.*');
    $this->db->from('food_orders');
    $this->db->join('register', 'register.u_id = food_orders.u_id');
    if (!empty($room_num)) {
      $this->db->join('user_hotel_booking_details', 'user_hotel_booking_details.booking_id = food_orders.booking_id');
      $this->db->where('user_hotel_booking_details.room_no', $room_num);
    }
    $query = $this->db->get();
    // echo "<pre>";
    // print_r($this->db->last_query());
    // exit;
    return $query->result_array();
  }

  function get_total_new_food_order_data($search = '', $hotel_id = '', $room_num = '')
  {
    $this->db->order_by('food_orders.food_order_id', 'desc');
    $this->db->where('food_orders.hotel_id', $hotel_id);
    $this->db->where('food_orders.order_status', 0);
    $this->db->where('food_orders.order_from', 3);
    $this->db->where('food_orders.order_date', date('Y-m-d'));

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_like('food_orders.order_date', $search);
      $this->db->or_like('food_orders.food_order_id', $search);
      $this->db->group_end();
    }

    $this->db->select('count(food_orders.food_order_id) as total_record');
    $this->db->from('food_orders');
    $this->db->join('register', 'register.u_id = food_orders.u_id');
    if (!empty($room_num)) {
      $this->db->join('user_hotel_booking_details', 'user_hotel_booking_details.booking_id = food_orders.booking_id');
      $this->db->where('user_hotel_booking_details.room_no', $room_num);
    }
    $query = $this->db->get();
    return $query->row();
  }

  public function get_user_booking_details($hotel_id, $booking_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('booking_id', $booking_id);
    return $this->db->get('user_hotel_booking')->row_array();
  }
  function get_room_service_services_order_pagination($hotel_id, $order_status)
  {
    $data = array();
    $this->db->select('*');
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,rmservice_services_orders.*');
    $this->db->join('register', 'register.u_id = rmservice_services_orders.u_id');
    $this->db->where('rmservice_services_orders.hotel_id', $hotel_id);
    $this->db->where('rmservice_services_orders.order_status', $order_status);
    $this->db->order_by('rmservice_services_orders.rmservice_services_order_id', 'desc');
    $Q = $this->db->get('rmservice_services_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  function get_room_service_menu_order_pagination($hotel_id, $order_status)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('room_service_menu_order_id', 'DESC');
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,room_service_menu_orders.*');
    $this->db->join('register', 'register.u_id = room_service_menu_orders.u_id');
    $this->db->where('room_service_menu_orders.hotel_id', $hotel_id);
    $this->db->where('room_service_menu_orders.order_total !=', 0);
    $this->db->where('room_service_menu_orders.order_status', $order_status);
    $Q = $this->db->get('room_service_menu_orders');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_booking_room_details($booking_id)
  {
    $this->db->select('room_type.room_type_name,user_hotel_booking_details.*');
    $this->db->join('room_type', 'room_type.room_type_id = user_hotel_booking_details.room_type');
    // $this->db->where('user_hotel_booking_details.hotel_id',$hotel_id);
    $this->db->where('user_hotel_booking_details.booking_id', $booking_id);
    return $this->db->get('user_hotel_booking_details')->result_array();
  }

  function get_panel_admin_list_according_to_hotel_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('u_id', 'DESC');
    $this->db->where('user_is', 1);
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('register');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_admin_panel_list($hotel_id)
  {
    $this->db->join('departement', 'departement.department_id = hotels_panel_list.department_id');
    $this->db->where('hotels_panel_list.admin_id', $hotel_id);
    $this->db->where('hotels_panel_list.department_id !=', 1);
    return $this->db->get('hotels_panel_list')->result_array();
  }

  function get_room_type_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->where('hotel_id', $hotel_id);
    //$this->db->where('room_type_id !=',1);  
    $Q = $this->db->get('room_type');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
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
    $this->db->order_by('business_center_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('business_center');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_room_nos_floor_wise($hotel_id, $floor_id)
  {
    $this->db->join('room_nos', 'room_nos.room_configure_id = room_configure.room_configure_id');
    $this->db->where('room_configure.hotel_id', $hotel_id);
    $this->db->where('room_configure.floor_id', $floor_id);
    return $this->db->get('room_configure')->result_array();
  }
  function get_floor_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('floor_id', 'ASC');
    $this->db->where('hotel_id', $hotel_id);
    $Q = $this->db->get('floors');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_hotel_guidelines($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('hotel_guidelines')->row_array();
  }

  function get_hotel_enquiry_request_pagination($hotel_id,$today_date)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('hotel_enquiry_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('check_in_date', $today_date);
    $this->db->where('request_status', 0);
    $this->db->where('is_main_req', 1);
    $Q = $this->db->get('hotel_enquiry_request');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  // vivek
  public function getnearplacesdata($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('hotel_near_by_place_id', $wh);
    return $this->db->get('hotel_near_by_place')->row_array();
  }
  public function getAllTableData($tbl)
  {
    $this->db->select('*');
    // $this->db->group_by('places');
    $this->db->distinct('places');

    $this->db->from($tbl);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getdataforeditofbanquet($wh)
  {
    $this->db->select('*');
    $this->db->where('banquet_hall_id', $wh);
    return $this->db->get('banquet_hall')->row_array();
  }
  public function getdataforeditofoffer($wh)
  {
    $this->db->select('*');
    $this->db->where('offer_id', $wh);
    return $this->db->get('offers')->row_array();
  }
  public function getUniqueOfferFromData()
  {
    $this->db->select('offer_for');
    $this->db->distinct('offer_for');
    $this->db->from('offers');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getdataforeditonearbyhotel($wh)
  {
    $this->db->select('*');
    $this->db->where('hotel_near_by_help_id', $wh);
    return $this->db->get('hotel_near_by_help')->row_array();
  }
  // vivek 22/05/2023
  public function edit_data_banquet_image($tbl, $wh, $imgarr)
  {
    $this->db->where($wh);
    if ($this->db->update($tbl, $imgarr)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function edit_data_nearByplace_image($tbl, $wh, $imgarr)
  {
    $this->db->where($wh);
    if ($this->db->update($tbl, $imgarr)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function edit_data_nearByHelp_image($tbl, $wh, $imgarr)
  {
    $this->db->where($wh);
    if ($this->db->update($tbl, $imgarr)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function get_notifications_for_front_ofs_1($hotel_id)
  {
    $this->db->where('notifications.send_by_id', $hotel_id);
    $this->db->where('notifications.send_for', 7);
    $this->db->order_by('notifications.notification_id', 'desc');
    return $this->db->get('notifications')->result_array();
  }
  public function get_notifications_for_rs_1($hotel_id)
  {
    // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
    $this->db->where('notifications.send_by_id', $hotel_id);
    $this->db->where('notifications.send_for', 7);
    $this->db->order_by('notifications.notification_id', 'desc');
    // $this->db->where('notifictions_department_id.department_id',3);
    return $this->db->get('notifications')->result_array();
  }
  public function get_notifications_for_housekeeping_1($hotel_id,$today_date)
  {
    // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
    $this->db->where('notifications.send_by_id', $hotel_id);
    $this->db->where('notifications.send_for', 7);
    $this->db->where('DATE(notifications.created_at)', $today_date);
    $this->db->order_by('notifications.notification_id', 'desc');
    // $this->db->limit(20);
    // $this->db->where('notifications.department_id',4);
    return $this->db->get('notifications')->result_array();
  }
  public function get_notifications_for_food_1($hotel_id,$today_date)
  {
    // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
    $this->db->where('notifications.send_by_id', $hotel_id);
    $this->db->where('notifications.send_for', 7);
    $this->db->where('DATE(notifications.created_at)', $today_date);
    // $this->db->where('notifictions_department_id.department_id',5);
    $this->db->order_by('notifications.notification_id', 'desc');
    // $this->db->limit(20);
    return $this->db->get('notifications')->result_array();
  }
  // for dashboard functions start
  public function get_hotel_user_booking($hotel_id, $booking_status)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('booking_status', $booking_status);
    return $this->db->get('user_hotel_booking')->result_array();
  }
  public function get_hotel_chg_guest($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('guest_type', 3);
    $this->db->where('user_type', 0);
    return $this->db->get('register')->result_array();
  }
  public function get_notifications_for_front_ofs($hotel_id)
  {
    $this->db->where('notifications.send_by_id', $hotel_id);
    $this->db->where('notifications.send_for', 7);
    $this->db->order_by('notifications.notification_id', 'desc');
    // $this->db->limit(8);
    return $this->db->get('notifications')->result_array();
  }
  public function get_hotel_guest_list($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('guest_type', 1);
    $this->db->where('user_type', 0);
    return $this->db->get('register')->result_array();
  }
  public function get_reservation_bc($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 1);
    return $this->db->get('business_center_reservation')->result_array();
  }
  public function banquet_hall($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('banquet_hall')->result_array();
  }
  public function get_reservation_bh($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 1);
    return $this->db->get('banquet_hall_orders')->result_array();
  }
  public function get_hotel_peoples($hotel_id)
  {
    $this->db->select('SUM(total_adults) as total_adults_count, SUM(total_child) as total_child_count');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('booking_status', 1);
    $result = $this->db->get('user_hotel_booking')->row_array(); // Get a single row instead of an array of rows

    $total_child_count = $result['total_child_count'];
    $total_adults_count = $result['total_adults_count'];

    return array('total_child_count' => $total_child_count, 'total_adults_count' => $total_adults_count);
  }


  public function get_food_order($hotel_id, $order_status)
  {
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,food_orders.*');
    $this->db->join('register', 'register.u_id = food_orders.u_id');
    $this->db->where('food_orders.hotel_id', $hotel_id);
    $this->db->where('food_orders.order_status', $order_status);
    return $this->db->get('food_orders')->result_array();
  }
  public function get_offer_list($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('offers')->result_array();
  }
  public function get_today_booking_data($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('check_in', date('Y-m-d'));
    $this->db->or_where('extend_check_out', date('Y-m-d'));
    $this->db->where('booking_status', 1);
    return $this->db->get('user_hotel_booking')->result_array();
  }
  public function getallfloor($hotel_id)
  {
    $this->db->select('*');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->order_by('floor', 'ASC');
    return $this->db->get('floors')->result_array();
  }
  public function getallroom($hotel_id)
  {
    $this->db->select('*');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->order_by('floor', 'ASC');
    return $this->db->get('floors')->result_array();
  }
  public function get_room_numbers($hotel_id, $room_configure_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_configure_id', $room_configure_id);
    return $this->db->get('room_nos')->result_array();
  }
  public function get_room_facility($hotel_id, $room_configure_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_configure_id', $room_configure_id);
    return $this->db->get('room_facility')->result_array();
  }
  public function get_room_imgs($hotel_id, $room_configure_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_configure_id', $room_configure_id);
    return $this->db->get('room_imgs')->result_array();
  }
  public function all_notification_list($hotel_id)
  {
    $this->db->where('notifications.send_by_id', $hotel_id);
    $this->db->order_by('notifications.notification_id', 'desc');
    return $this->db->get('notifications')->result_array();
  }
  public function getallnotificationcount($tbl, $wh)
  {
    $this->db->where($wh);
    return $this->db->get($tbl)->result_array();
  }

  // today

  public function get_hotel_vehicle_wash_charges($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('vehicle_washing_charges')->result_array();
  }

  function cab_service_rejected_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    // $this->db->limit($limit, $offset);
    $this->db->order_by('reject_date', 'DESC');
    $this->db->order_by('request_date', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 2);
    $Q = $this->db->get('cab_service_request_list');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }

  public function get_luggage_rejected_request_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('luggage_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 2);
    $Q = $this->db->get('luggage_request');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }


  public function get_luggage_completed_request_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('luggage_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 4);
    $Q = $this->db->get('luggage_request');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_spa_request_list_pagination($hotel_id)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('spa_service_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 0);
    return $this->db->get('spa_service_request_list')->result_array();
  }

  public function get_spa_accept_list_pagination($hotel_id)
  {
    // print_r($hotel_id);exit;
    $data = array();
    $this->db->select('*');
    $this->db->order_by('spa_service_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 1);
    return $this->db->get('spa_service_request_list')->result_array();
  }

  public function get_spa_complete_list_pagination($hotel_id)
  {
    // print_r($hotel_id);exit;
    $data = array();
    $this->db->select('*');
    $this->db->order_by('spa_service_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 4);
    return $this->db->get('spa_service_request_list')->result_array();
  }
  public function get_spa_reject_list_pagination($hotel_id)
  {
    // print_r($hotel_id);exit;
    $data = array();
    $this->db->select('*');
    $this->db->order_by('spa_service_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', 2);
    return $this->db->get('spa_service_request_list')->result_array();
  }

  public function editData($tbl, $where, $arr)
  {
    $this->db->where($where);

    if ($this->db->update($tbl, $arr)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  function get_other_complaints_pagination($hotel_id, $complaint_status)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('complaint_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('complaint_status', $complaint_status);
    $Q = $this->db->get('other_complaints');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function get_close_other_complaints_pagination($hotel_id, $complaint_status)
  {
    $data = array();
    $this->db->select('*');
    $this->db->order_by('complaint_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('complaint_status', $complaint_status);
    $Q = $this->db->get('other_complaints');

    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function getdatacab($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('cab_service_request_id', $wh);
    return $this->db->get('cab_service_request_list')->row_array();
  }
  public function getregdata($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('b_c_reserve_id', $wh);
    return $this->db->get('business_center_reservation')->row_array();
  }
  public function get_checkout_request($hotel_id, $request_status)
  {
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('request_status', $request_status);
    $this->db->order_by('checkout_request_id', 'DESC');
    return $this->db->get('user_checkout_requests')->result_array();
  }
  public function get_all_checkout_request($hotel_id)
  {
    $data = array();
    $this->db->select('register.full_name,register.mobile_no,register.email_id,user_hotel_booking.*,user_checkout_requests.*');
    $this->db->join('user_hotel_booking', 'user_hotel_booking.booking_id = user_checkout_requests.booking_id');
    $this->db->join('register', 'register.u_id = user_checkout_requests.u_id');
    $this->db->where('user_checkout_requests.hotel_id', $hotel_id);
    $this->db->where('user_checkout_requests.request_status', 0);
    $Q = $this->db->get('user_checkout_requests');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_all_accepted_checkout_request($hotel_id)
  {
    $data = array();
    $this->db->select('register.full_name,register.mobile_no,register.email_id,user_hotel_booking.*,user_checkout_requests.*');
    $this->db->join('user_hotel_booking', 'user_hotel_booking.booking_id = user_checkout_requests.booking_id');
    $this->db->join('register', 'register.u_id = user_checkout_requests.u_id');
    $this->db->where('user_checkout_requests.hotel_id', $hotel_id);
    $this->db->where('user_checkout_requests.request_status', 1);
    $Q = $this->db->get('user_checkout_requests');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function get_all_completed_checkout_request($hotel_id)
  {
    $data = array();
    $this->db->select('register.full_name,register.mobile_no,register.email_id,user_hotel_booking.*,user_checkout_requests.*');
    $this->db->join('user_hotel_booking', 'user_hotel_booking.booking_id = user_checkout_requests.booking_id');
    $this->db->join('register', 'register.u_id = user_checkout_requests.u_id');
    $this->db->where('user_checkout_requests.hotel_id', $hotel_id);
    $this->db->where('user_checkout_requests.request_status', 2);
    $Q = $this->db->get('user_checkout_requests');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  public function getAllData1($tbl, $wh)
  {
    $this->db->where($wh);
    return $this->db->get($tbl)->result_array();
  }
  public function getdatadirty($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('room_status_id', $wh);
    return $this->db->get('room_status')->row_array();
  }
  public function getfoodmenudata($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('food_item_id', $wh);
    return $this->db->get('food_menus')->row_array();
  }
  public function getgymsingledata($tbl, $where)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($where);
    $query = $this->db->get();
    return $query->row_array();
  }
  public function getpoolsingledata($tbl, $where)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($where);
    $query = $this->db->get();
    return $query->row_array();
  }
  public function getshuttlesingledata($tbl, $where)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($where);
    $query = $this->db->get();
    return $query->row_array();
  }
  public function getbabysingledata($tbl, $where)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($where);
    $query = $this->db->get();
    return $query->row_array();
  }
  public function check_image($tbl, $where1)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($where1);
    $query = $this->db->get();
    // echo "<pre>";
    // print_r($this->db->last_query());
    // exit;
    return $query->result_array();
  }


  function get_new_house_order_data($rowperpage, $row, $search, $hotel_id, $room_num = '')
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id', 'DESC');
    $this->db->limit($rowperpage, $row);
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status', 0);
    $this->db->where('house_keeping_orders.order_from', 3);
    $this->db->where('house_keeping_orders.order_date', date('y-m-d'));
    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_like('house_keeping_orders.order_date', $search);
      $this->db->or_like('house_keeping_orders.h_k_order_id', $search);
      $this->db->group_end();
    }
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,house_keeping_orders.*');
    $this->db->from('house_keeping_orders');
    $this->db->join('register', 'register.u_id = house_keeping_orders.u_id');
    if (!empty($room_num)) {
      $this->db->join('user_hotel_booking_details', 'user_hotel_booking_details.booking_id = house_keeping_orders.booking_id');
      $this->db->where('user_hotel_booking_details.room_no', $room_num);
    }
    $query = $this->db->get();
    // echo "<pre>";
    // print_r($this->db->last_query());
    // exit;
    return $query->result_array();
  }

  function get_total_new_house_order_data($search = '', $hotel_id = '', $room_num = '')
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id', 'desc');
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status', 0);
    $this->db->where('house_keeping_orders.order_from', 3);
    $this->db->where('house_keeping_orders.order_date', date('y-m-d'));

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_like('house_keeping_orders.order_date', $search);
      $this->db->or_like('house_keeping_orders.h_k_order_id', $search);
      $this->db->group_end();
    }

    $this->db->select('count(house_keeping_orders.h_k_order_id) as total_record');
    $this->db->from('house_keeping_orders');
    $this->db->join('register', 'register.u_id = house_keeping_orders.u_id');
    if (!empty($room_num)) {
      $this->db->join('user_hotel_booking_details', 'user_hotel_booking_details.booking_id = house_keeping_orders.booking_id');
      $this->db->where('user_hotel_booking_details.room_no', $room_num);
    }
    $query = $this->db->get();
    return $query->row();
  }
  function get_new_laundry_order_data($rowperpage, $row, $search, $hotel_id, $room_num = '')
  {
    $this->db->order_by('cloth_orders.cloth_order_id', 'DESC');
    $this->db->limit($rowperpage, $row);
    $this->db->where('cloth_orders.hotel_id', $hotel_id);
    $this->db->where('cloth_orders.order_status', 0);
    $this->db->where('cloth_orders.order_from', 3);
    $this->db->where('cloth_orders.order_date', date('y-m-d'));
    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_like('cloth_orders.order_date', $search);
      $this->db->or_like('cloth_orders.cloth_order_id', $search);
      $this->db->group_end();
    }
    $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,cloth_orders.*');
    $this->db->from('cloth_orders');
    $this->db->join('register', 'register.u_id = cloth_orders.u_id');
    if (!empty($room_num)) {
      $this->db->join('user_hotel_booking_details', 'user_hotel_booking_details.booking_id = cloth_orders.booking_id');
      $this->db->where('user_hotel_booking_details.room_no', $room_num);
    }
    $query = $this->db->get();
    // echo "<pre>";
    // print_r($this->db->last_query());
    // exit;
    return $query->result_array();
  }

  function get_total_new_laundry_order_data($search = '', $hotel_id = '', $room_num = '')
  {
    $this->db->order_by('cloth_orders.cloth_order_id', 'desc');
    $this->db->where('cloth_orders.hotel_id', $hotel_id);
    $this->db->where('cloth_orders.order_status', 0);
    $this->db->where('cloth_orders.order_from', 3);
    $this->db->where('cloth_orders.order_date', date('y-m-d'));

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('register.full_name', $search);
      $this->db->or_where('register.guest_type', $search);
      $this->db->or_like('cloth_orders.order_date', $search);
      $this->db->or_like('cloth_orders.cloth_order_id', $search);
      $this->db->group_end();
    }

    $this->db->select('count(cloth_orders.cloth_order_id) as total_record');
    $this->db->from('cloth_orders');
    $this->db->join('register', 'register.u_id = cloth_orders.u_id');
    if (!empty($room_num)) {
      $this->db->join('user_hotel_booking_details', 'user_hotel_booking_details.booking_id = cloth_orders.booking_id');
      $this->db->where('user_hotel_booking_details.room_no', $room_num);
    }
    $query = $this->db->get();
    return $query->row();
  }
  public function getspasingleinfo($tbl, $where)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($where);
    $query = $this->db->get();
    return $query->row_array();
  }

  function get_new_spa_order_data($rowperpage, $row, $search, $hotel_id)
  {
    $this->db->order_by('spa_service_request_list.spa_service_request_id', 'DESC');

    $this->db->limit($rowperpage, $row);
    $this->db->where('request_status', 0);
    $this->db->where('spa_service_request_list.hotel_id', $hotel_id);
    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      // $this->db->like('visitor.visitor_name', $search);
      $this->db->or_where('spa_service_request_list.mobile_no', $search);
      $this->db->or_where('register.full_name', $search);
      $this->db->group_end();
    }
    $this->db->select('*,register.full_name');

    $this->db->from('spa_service_request_list');

    $this->db->join('register', 'register.u_id = spa_service_request_list.u_id', 'left');
    // $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id','left');
    // $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id','left');
    // $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no','left');
    // $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id','left');
    // $this->db->join('floors','floors.floor_id = room_configure.floor_id','left');
    $query = $this->db->get();
    return $query->result_array();
  }
  function get_total_new_spa_order_data($search = '', $hotel_id = '')
  {
    $this->db->order_by('spa_service_request_list.spa_service_request_id', 'DESC');
    $this->db->where('spa_service_request_list.hotel_id', $hotel_id);

    $this->db->where('request_status', 0);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      // $this->db->like('visitor.visitor_name', $search);
      $this->db->or_where('spa_service_request_list.mobile_no', $search);
      $this->db->or_where('register.full_name', $search);
      $this->db->group_end();
    }

    $this->db->select('count(spa_service_request_id) as total_record');
    $this->db->from('spa_service_request_list');

    $this->db->join('register', 'register.u_id = spa_service_request_list.u_id', 'left');
    // $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id','left');
    // $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id','left');
    // $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no','left');
    // $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id','left');
    // $this->db->join('floors','floors.floor_id = room_configure.floor_id','left');

    $query = $this->db->get();
    return $query->row();
  }
  function get_new_luggage_order_data($rowperpage, $row, $search, $hotel_id)
  {
    $this->db->order_by('luggage_request.luggage_request_id', 'DESC');

    $this->db->limit($rowperpage, $row);
    $this->db->where('request_status', 0);
    $this->db->where('luggage_request.hotel_id', $hotel_id);
    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      // $this->db->like('visitor.visitor_name', $search);
      $this->db->or_where('luggage_request.mobile_no', $search);
      $this->db->or_where('register.full_name', $search);
      $this->db->group_end();
    }
    $this->db->select('*,register.full_name');

    $this->db->from('luggage_request');

    $this->db->join('register', 'register.u_id = luggage_request.u_id', 'left');
    // $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id','left');
    // $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id','left');
    // $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no','left');
    // $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id','left');
    // $this->db->join('floors','floors.floor_id = room_configure.floor_id','left');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_total_new_luggage_order_data($search = '', $hotel_id = '')
  {
    $this->db->order_by('luggage_request.luggage_request_id', 'DESC');
    $this->db->where('luggage_request.hotel_id', $hotel_id);

    $this->db->where('request_status', 0);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      // $this->db->like('visitor.visitor_name', $search);
      $this->db->or_where('luggage_request.mobile_no', $search);
      $this->db->or_where('register.full_name', $search);
      $this->db->group_end();
    }

    $this->db->select('count(luggage_request_id) as total_record');
    $this->db->from('luggage_request');

    $this->db->join('register', 'register.u_id = luggage_request.u_id', 'left');
    // $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id','left');
    // $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id','left');
    // $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no','left');
    // $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id','left');
    // $this->db->join('floors','floors.floor_id = room_configure.floor_id','left');

    $query = $this->db->get();
    return $query->row();
  }

  function get_new_cab_order_data($rowperpage, $row, $search, $hotel_id)
  {
    $this->db->order_by('cab_service_request_list.cab_service_request_id', 'DESC');

    $this->db->limit($rowperpage, $row);
    $this->db->where('request_status', 0);
    $this->db->where('cab_service_request_list.hotel_id', $hotel_id);
    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      // $this->db->like('visitor.visitor_name', $search);
      $this->db->or_where('register.mobile_no', $search);
      $this->db->or_where('register.full_name', $search);
      $this->db->group_end();
    }
    $this->db->select('*,register.full_name');

    $this->db->from('cab_service_request_list');

    $this->db->join('register', 'register.u_id = cab_service_request_list.u_id', 'left');
    // $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id','left');
    // $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id','left');
    // $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no','left');
    // $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id','left');
    // $this->db->join('floors','floors.floor_id = room_configure.floor_id','left');
    $query = $this->db->get();
    return $query->result_array();
  }
  function get_total_new_cab_order_data($search = '', $hotel_id = '')
  {
    $this->db->order_by('cab_service_request_list.cab_service_request_id', 'DESC');
    $this->db->where('cab_service_request_list.hotel_id', $hotel_id);

    $this->db->where('request_status', 0);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      // $this->db->like('visitor.visitor_name', $search);
      $this->db->or_where('register.mobile_no', $search);
      $this->db->or_where('register.full_name', $search);
      $this->db->group_end();
    }

    $this->db->select('count(cab_service_request_id) as total_record');
    $this->db->from('cab_service_request_list');

    $this->db->join('register', 'register.u_id = cab_service_request_list.u_id', 'left');
    // $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id','left');
    // $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id','left');
    // $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no','left');
    // $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id','left');
    // $this->db->join('floors','floors.floor_id = room_configure.floor_id','left');

    $query = $this->db->get();
    return $query->row();
  }
  function get_new_carwash_order_data($rowperpage, $row, $search, $hotel_id)
  {
    $this->db->order_by('vehicle_wash_request.vehicle_wash_request_id', 'DESC');

    $this->db->limit($rowperpage, $row);
    $this->db->where('request_status', 0);
    $this->db->where('vehicle_wash_request.hotel_id', $hotel_id);
    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      // $this->db->like('visitor.visitor_name', $search);
      $this->db->or_where('register.mobile_no', $search);
      $this->db->or_where('register.full_name', $search);
      $this->db->group_end();
    }
    $this->db->select('*,register.full_name');

    $this->db->from('vehicle_wash_request');

    $this->db->join('register', 'register.u_id = vehicle_wash_request.u_id', 'left');
    // $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id','left');
    // $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id','left');
    // $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no','left');
    // $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id','left');
    // $this->db->join('floors','floors.floor_id = room_configure.floor_id','left');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_total_new_carwash_order_data($search = '', $hotel_id = '')
  {
    $this->db->order_by('vehicle_wash_request.vehicle_wash_request_id', 'DESC');
    $this->db->where('vehicle_wash_request.hotel_id', $hotel_id);

    $this->db->where('request_status', 0);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      // $this->db->like('visitor.visitor_name', $search);
      $this->db->or_where('register.mobile_no', $search);
      $this->db->or_where('register.full_name', $search);
      $this->db->group_end();
    }

    $this->db->select('count(vehicle_wash_request_id) as total_record');
    $this->db->from('vehicle_wash_request');

    $this->db->join('register', 'register.u_id = vehicle_wash_request.u_id', 'left');
    // $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id','left');
    // $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id','left');
    // $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no','left');
    // $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id','left');
    // $this->db->join('floors','floors.floor_id = room_configure.floor_id','left');

    $query = $this->db->get();
    return $query->row();
  }

  function today_arrival_data_list($rowperpage, $row, $search, $hotel_id)
  {
    $this->db->order_by('uhb.booking_id', 'DESC');
    $this->db->limit($rowperpage, $row);
    $this->db->where('uhb.hotel_id', $hotel_id);
    $this->db->where('uhb.booking_status', 0);
    $this->db->where('uhb.check_in', date('Y-m-d'));
    $this->db->where('uhb.booking_from', 2);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('reg.full_name', $search);
      $this->db->or_where('uhb.no_of_rooms', $search);
      $this->db->or_where('uhb.total_adults', $search);
      $this->db->or_like('uhb.check_out', $search);
      $this->db->or_where('uhb.booking_id', $search);
      $this->db->or_like('uhb.check_in', $search);
      $this->db->or_like('reg.mobile_no', $search);
      $this->db->or_like('reg.email_id', $search);
      $this->db->group_end();
    }

    $this->db->select('uhb.booking_id,uhb.check_in,uhb.check_out,uhb.no_of_rooms,uhb.total_adults,uhb.total_child,uhb.no_of_rooms,uhb.room_type,reg.full_name,reg.mobile_no,reg.email_id');
    $this->db->from('user_hotel_booking as uhb');
    $this->db->join('register as reg', 'reg.u_id = uhb.u_id');
    $query = $this->db->get();
    // echo "<pre>";    
    // print_r($this->db->last_query());
    // exit;
    return $query->result_array();
  }

  function total_today_arrival_data_list($search = '', $hotel_id = '')
  {
    $this->db->order_by('uhb.booking_id', 'DESC');
    $this->db->where('uhb.hotel_id', $hotel_id);
    $this->db->where('uhb.booking_status', 0);
    $this->db->where('uhb.check_in', date('Y-m-d'));
    $this->db->where('uhb.booking_from', 2);

    if (!empty($search)) {
      $this->db->group_start(); // Open bracket
      $this->db->like('reg.full_name', $search);
      $this->db->or_where('uhb.no_of_rooms', $search);
      $this->db->or_where('uhb.total_adults', $search);
      $this->db->or_like('uhb.check_out', $search);
      $this->db->or_where('uhb.booking_id', $search);
      $this->db->or_like('uhb.check_in', $search);
      $this->db->or_like('reg.mobile_no', $search);
      $this->db->or_like('reg.email_id', $search);
      $this->db->group_end();
    }

    $this->db->select('count(uhb.booking_id) as total_record');
    $this->db->from('user_hotel_booking as uhb');
    $this->db->join('register as reg', 'reg.u_id = uhb.u_id');
    $query = $this->db->get();
    // echo "<pre>";    
    // print_r($this->db->last_query());
    // exit;
    return $query->row();
  }
  public function getdataluggage($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('luggage_request_id', $wh);
    return $this->db->get('luggage_request')->row_array();
  }
  public function getdatacarwash($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('vehicle_wash_request_id', $wh);
    return $this->db->get('vehicle_wash_request')->row_array();
  }
  public function getdatasparequest($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('spa_service_request_id', $wh);
    return $this->db->get('spa_service_request_list')->row_array();
  }
  public function getdataunder($tbl,$wh){
    $this->db->select('*');
    $this->db->where('room_status_id',$wh);
    return $this->db->get('room_status')->row_array();
}

function accepted_food_Order_list($rowperpage,$row,$search,$hotel_id)
    {
        $this->db->order_by('food_orders.accept_time','ASC');
        $this->db->limit($rowperpage, $row);
        $this->db->where('food_orders.hotel_id',$hotel_id);
        $this->db->where('food_orders.order_status',1);
        $this->db->where('food_orders.order_from',3);
        // $this->db->where('rns.hotel_id',$hotel_id);
      
        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
                $this->db->like('register.full_name', $search);
                $this->db->or_like('food_orders.order_date', $search);
                $this->db->or_where('food_orders.food_order_id', $search);
                // $this->db->or_where('uhbd.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('food_orders.food_order_id,food_orders.u_id,food_orders.out_of_time_status,food_orders.order_date,food_orders.order_time,food_orders.accept_date,food_orders.accept_time,food_orders.order_from,food_orders.additional_note,food_orders.staff_name,register.full_name,register.mobile_no');
        $this->db->from('food_orders');
        $this->db->join('register', 'register.u_id = food_orders.u_id');
        $query = $this->db->get();
        // echo "<pre>";    
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }
    function total_accepted_food_list_data($search='', $hotel_id='')
    {
      $this->db->order_by('food_orders.accept_time','ASC');
      $this->db->where('food_orders.hotel_id',$hotel_id);
      $this->db->where('food_orders.order_status',1);
      $this->db->where('food_orders.order_from',3);
        // $this->db->where('rns.hotel_id',$hotel_id);

        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
                $this->db->like('register.full_name', $search);
                $this->db->or_like('food_orders.order_date', $search);
                $this->db->or_where('food_orders.food_order_id', $search);
                // $this->db->or_where('uhbd.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('count(food_orders.food_order_id) as total_record');
        $this->db->from('food_orders');
        $this->db->join('register', 'register.u_id = food_orders.u_id');
        $query = $this->db->get();
        // echo "<pre>";    
        // print_r($this->db->last_query());
        // exit;
        return $query->row();
    }
    function outof_time_accepted_house_order($ord_to_15min)
    {
        $this->db->select('h_k_order_id');
        $this->db->from('house_keeping_orders');
        $this->db->order_by('h_k_order_id','DESC');
        $this->db->where('order_status',1);
        $this->db->where('accept_time <=',$ord_to_15min);
        $query = $this->db->get();
        // echo "<pre>";
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }

    function accepted_house_Order_list($rowperpage,$row,$search,$hotel_id)
    {
        $this->db->order_by('house_keeping_orders.accept_time','ASC');
        $this->db->limit($rowperpage, $row);
        $this->db->where('house_keeping_orders.hotel_id',$hotel_id);
        $this->db->where('house_keeping_orders.order_status',1);
        $this->db->where('house_keeping_orders.order_from',3);
        // $this->db->where('rns.hotel_id',$hotel_id);
      
        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
                $this->db->like('register.full_name', $search);
                $this->db->or_like('house_keeping_orders.order_date', $search);
                $this->db->or_where('house_keeping_orders.h_k_order_id', $search);
                // $this->db->or_where('uhbd.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.u_id,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.accept_date,house_keeping_orders.accept_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,house_keeping_orders.staff_name,register.full_name,register.mobile_no');
        $this->db->from('house_keeping_orders');
        $this->db->join('register', 'register.u_id = house_keeping_orders.u_id');
        $query = $this->db->get();
        // echo "<pre>";    
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }

    function total_accepted_house_list_data($search='', $hotel_id='')
    {
      $this->db->order_by('house_keeping_orders.accept_time','ASC');
      $this->db->where('house_keeping_orders.hotel_id',$hotel_id);
      $this->db->where('house_keeping_orders.order_status',1);
      $this->db->where('house_keeping_orders.order_from',3);
        // $this->db->where('rns.hotel_id',$hotel_id);

        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
                $this->db->like('register.full_name', $search);
                $this->db->or_like('house_keeping_orders.order_date', $search);
                $this->db->or_where('house_keeping_orders.h_k_order_id', $search);
                // $this->db->or_where('uhbd.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('count(house_keeping_orders.h_k_order_id) as total_record');
        $this->db->from('house_keeping_orders');
        $this->db->join('register', 'register.u_id = house_keeping_orders.u_id');
        $query = $this->db->get();
        // echo "<pre>";    
        // print_r($this->db->last_query());
        // exit;
        return $query->row();
    }

    function outof_time_laundry_order($ord_to_15min)
    {
        $this->db->select('cloth_order_id');
        $this->db->from('cloth_orders');
        $this->db->order_by('cloth_order_id','DESC');
        $this->db->where('order_status',0);
        $this->db->where('order_time <=',$ord_to_15min);
        $query = $this->db->get();
        // echo "<pre>";
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }
    function outof_time_accepted_laundry_order($ord_to_15min)
    {
        $this->db->select('cloth_order_id');
        $this->db->from('cloth_orders');
        $this->db->order_by('cloth_order_id','DESC');
        $this->db->where('order_status',1);
        $this->db->where('accept_time <=',$ord_to_15min);
        $query = $this->db->get();
        // echo "<pre>";
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }
    function accepted_laundry_Order_list($rowperpage,$row,$search,$hotel_id)
    {
        $this->db->order_by('cloth_orders.accept_time','ASC');
        $this->db->limit($rowperpage, $row);
        $this->db->where('cloth_orders.hotel_id',$hotel_id);
        $this->db->where('cloth_orders.order_status',1);
        $this->db->where('cloth_orders.order_from',3);
        // $this->db->where('rns.hotel_id',$hotel_id);
      
        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
                $this->db->like('register.full_name', $search);
                $this->db->or_like('cloth_orders.order_date', $search);
                $this->db->or_where('cloth_orders.cloth_order_id', $search);
                // $this->db->or_where('uhbd.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('cloth_orders.cloth_order_id,cloth_orders.u_id,cloth_orders.out_of_time_status,cloth_orders.order_date,cloth_orders.order_time,cloth_orders.accept_date,cloth_orders.accept_time,cloth_orders.order_from,cloth_orders.additional_note,cloth_orders.staff_name,register.full_name,register.mobile_no');
        $this->db->from('cloth_orders');
        $this->db->join('register', 'register.u_id = cloth_orders.u_id');
        $query = $this->db->get();
        // echo "<pre>";    
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }

    
    function total_accepted_laundry_list_data($search='', $hotel_id='')
    {
      $this->db->order_by('cloth_orders.accept_time','ASC');
      $this->db->where('cloth_orders.hotel_id',$hotel_id);
      $this->db->where('cloth_orders.order_status',1);
      $this->db->where('cloth_orders.order_from',3);
        // $this->db->where('rns.hotel_id',$hotel_id);

        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
                $this->db->like('register.full_name', $search);
                $this->db->or_like('cloth_orders.order_date', $search);
                $this->db->or_where('cloth_orders.cloth_order_id', $search);
                // $this->db->or_where('uhbd.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('count(cloth_orders.cloth_order_id) as total_record');
        $this->db->from('cloth_orders');
        $this->db->join('register', 'register.u_id = cloth_orders.u_id');
        $query = $this->db->get();
        // echo "<pre>";    
        // print_r($this->db->last_query());
        // exit;
        return $query->row();
    }

    function cab_service_cancle_tab($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        // $this->db->limit($limit, $offset);
        $this->db->order_by('cab_service_request_id', 'DESC');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('request_status',3);
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
    public function get_service_request($u_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('service_request_id ', 'DESC');
        $this->db->where('u_id', $u_id);
        // $this->db->where('request_status',0);
        $Q = $this->db->get('service_request');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }

    public function get_hotel_service_request($hotel_id,$today_date)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('service_request_id ', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('DATE(service_request.created_at)',$today_date);
        // $this->db->where('send_to', 4);
        // $this->db->where('request_status',0);
        $Q = $this->db->get('service_request');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }
    public function get_user_data_by_username($user_n)
    {
        $this->db->where('full_name', $user_n);
        // $this->db->where('user_type',0);
        return $this->db->get('register')->row_array();

    }
    public function get_accupied_rooms($hotel_id)
    {
        $currentDate = date('Y-m-d');
        $this->db->select('uhbd.room_no');
        $this->db->from('user_hotel_booking_details as uhbd');
        $this->db->where('uhb.check_out >=',date('Y-m-d'));
        // $this->db->where("'$currentDate' BETWEEN uhb.check_in AND uhb.check_out");
        $this->db->where('uhb.check_in <=',date('Y-m-d'));
        $this->db->where('uhb.hotel_id',$hotel_id);
        $this->db->where('uhb.booking_status',1);
        $this->db->where('rs.room_status',2);
        $this->db->where('rs.hotel_id',$hotel_id);
        $this->db->join('user_hotel_booking as uhb','uhb.booking_id = uhbd.booking_id');
        $this->db->join('room_status as rs','rs.room_no = uhbd.room_no');
        $this->db->distinct(); 
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_room_no_data($hotel_id,$room_no,$todays_date)
    {
      $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_hotel_booking_details.booking_id');
      $this->db->where('user_hotel_booking_details.room_no',$room_no);
      $this->db->where('user_hotel_booking.hotel_id',$hotel_id);
      $this->db->where('user_hotel_booking.check_out >=',$todays_date);
      return $this->db->get('user_hotel_booking_details')->row_array();
    }
    public function get_accepted_service_request($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('service_request_id ', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('request_status',1);
        $Q = $this->db->get('service_request');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }
    public function get_rejected_service_request($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('service_request_id ', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('request_status',2);
        $Q = $this->db->get('service_request');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }
    public function getspasingledata($tbl,$where)
    {
        $this->db->select('front_ofs_services.*,front_ofs_services_images.image,front_ofs_spa_service_images.*');
        $this->db->join('front_ofs_services_images','front_ofs_services.front_ofs_service_id=front_ofs_services_images.front_ofs_service_id');
        $this->db->join('front_ofs_spa_service_images','front_ofs_services.front_ofs_service_id=front_ofs_spa_service_images.front_ofs_service_id');
        $this->db->where('front_ofs_services_images.front_ofs_service_id',$where);
        $this->db->where('front_ofs_spa_service_images.front_ofs_service_id',$where);
        return $this->db->get('front_ofs_services')->result_array();
       
    }
    public function get_hotel_current_booking($hotel_id, $booking_status)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_status', $booking_status);
        $this->db->where('check_in_status', 1);
        $this->db->where('check_in =', date('Y-m-d'));
        return $this->db->get('user_hotel_booking')->result_array();
    }
    public function get_hotel_current_booking_accept($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        //$this->db->where('check_in <=',date('Y-m-d'));
        $this->db->where('check_in =', date('Y-m-d'));
        return $this->db->get('user_hotel_booking')->result_array();
    }
    public function get_hotel_expected_booking($hotel_id, $booking_status)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_status', $booking_status);
        $this->db->where('check_in_status', 0);
        $this->db->where('check_in =', date('Y-m-d'));
        return $this->db->get('user_hotel_booking')->result_array();
    }
    public function get_hotel_expected_current__booking($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        //$this->db->where('check_in <=',date('Y-m-d'));
        $this->db->where('check_in >', date('Y-m-d'));
        return $this->db->get('user_hotel_booking')->result_array();
    }
    public function get_hotel_depated_booking($hotel_id, $booking_status)
    {
        // $this->db->where('hotel_id', $hotel_id);
        // $this->db->where('booking_status', $booking_status);
        // $this->db->where('check_in =', date('Y-m-d'));
        // return $this->db->get('user_hotel_booking')->result_array();
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('check_out =',date('Y-m-d'));
        $this->db->where('booking_status ', 2);
        $this->db->where('check_in_status ', 2);
        return $this->db->get('user_hotel_booking')->result_array();
    }
    public function total_expected_departed_booking($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('check_out =',date('Y-m-d'));
        $this->db->where('booking_status ', 2);
        // $this->db->where('check_in_status ', 1);
        return $this->db->get('user_hotel_booking')->result_array();
    }
}
