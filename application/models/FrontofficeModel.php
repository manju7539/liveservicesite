<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FrontofficeModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }
    // 1
    public function get_all_checkout_request($hotel_id)
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.email_id,user_hotel_booking.*,user_checkout_requests.*');
        $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_checkout_requests.booking_id');
        $this->db->join('register','register.u_id = user_checkout_requests.u_id');
        $this->db->where('user_checkout_requests.hotel_id',$hotel_id);
        $this->db->where('user_checkout_requests.request_status',0);
        $Q = $this->db->get('user_checkout_requests');
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
  public function search_visitor_data($admin_id,$visit_date)
  {
      $this->db->select('*');
      $this->db->from('visitor');
      $this->db->where('hotel_id',$admin_id);
      $this->db->where('visit_date',$visit_date);
      $query =$this->db->get();
      return $query->result_array();
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
    public function getgymsingledata($tbl,$where)
      {
        $this->db->select('front_ofs_services.*,front_ofs_services_images.image');
        $this->db->join('front_ofs_services_images','front_ofs_services.front_ofs_service_id=front_ofs_services_images.front_ofs_service_id');
        $this->db->where('front_ofs_services_images.front_ofs_service_id',$where);
        return $this->db->get('front_ofs_services')->row_array();
        //   $this->db->select('*');
        //   $this->db->from($tbl);
        //   $this->db->where($where);
        //   $query = $this->db->get();        
        //   return $query->row_array();
      }
      
    public function get_all_accepted_checkout_request($hotel_id)
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.email_id,user_hotel_booking.*,user_checkout_requests.*');
        $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_checkout_requests.booking_id');
        $this->db->join('register','register.u_id = user_checkout_requests.u_id');
        $this->db->where('user_checkout_requests.hotel_id',$hotel_id);
        $this->db->where('user_checkout_requests.request_status',1);
        $Q = $this->db->get('user_checkout_requests');
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
    public function get_all_completed_checkout_request($hotel_id)
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.email_id,user_hotel_booking.*,user_checkout_requests.*');
        $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_checkout_requests.booking_id');
        $this->db->join('register','register.u_id = user_checkout_requests.u_id');
        $this->db->where('user_checkout_requests.hotel_id',$hotel_id);
        $this->db->where('user_checkout_requests.request_status',2);
        $Q = $this->db->get('user_checkout_requests');
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

    public function getcabdata($tbl,$wh)
    {
        $this->db->select('*');
        $this->db->where('cab_service_request_id',$wh);    
        return $this->db->get('cab_service_request_list')->row_array();
    }
    public function cab_service_completed_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('updated_at','DESC');
        $this->db->order_by('accepted_date','DESC');
        $this->db->order_by('request_date','DESC');
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
    public function cab_service_rejected_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('reject_date','DESC');
        $this->db->order_by('request_date','DESC');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('request_status',2);
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
    public function get_user_pending_booking_list_from_app_pagination($hotel_id)
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
    public function get_admin_data($u_id)
    {
        $this->db->where('u_id',$u_id);
        return $this->db->get('register')->row_array();
        print_r($result);
    exit;
    }
    
    public function get_user_pending_booking_list_from_app($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_status', 0);
        $this->db->where('booking_from', 2);
        $this->db->order_by('booking_id', 'DESC');
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
    public function get_checkout_guest_list_pagination($hotel_id)
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
    public function get_ratings($where) 
    {
        $this->db->where($where);
        $query = $this->db->get('review');
        $result = $query->num_rows();
        return $result;
    }
    public function get_user_upcoming_booking_list_from_app_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_status', 0);
        $this->db->where('booking_from', 2);
        $this->db->where('check_in >', date('Y-m-d'));
        $Q = $this->db->get('user_hotel_booking');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }
    public function get_business_center_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('b_c_reserve_id', 'DESC');
        $this->db->select('business_center.business_center_type as business_center_type_name,business_center_reservation.*');
        $this->db->join('business_center', 'business_center.business_center_id = business_center_reservation.business_center_type');
        $this->db->where('business_center_reservation.request_status', 1);
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
    public function get_active_business_center($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('is_active', 1);
        return $this->db->get('business_center')->result_array();
    }
    public function get_center($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('business_center_id ', 'DESC');
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
    public function get_hotel_guidelines($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('hotel_guidelines')->row_array();
    }
    public function getData($tbl, $wh)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($wh);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->row_array();
    }
    public function getAllData($tbl, $wh)
    {
        $this->db->where($wh);
        // echo $this->db->last_query();
        return $this->db->get($tbl)->result_array();
    }
    public function get_hotel_enquiry_request_pagination($hotel_id, $today_date)
{
    $data = array();
    $this->db->select('*');
    $this->db->from('hotel_enquiry_request');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('check_in_date >=', $today_date); // Fetch today and future dates
    $this->db->where('request_status', 0);
    $this->db->where('is_main_req', 1);
    $this->db->order_by('check_in_date', 'ASC'); // Sort by upcoming check-in dates
    
    $Q = $this->db->get();
    
    if ($Q->num_rows() > 0) {
        $data = $Q->result_array();
    }
    
    $Q->free_result();
    return $data;
}

    function get_enquiry_accepted_by_user($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('hotel_enquiry_request_id','DESC');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('request_status',3);
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
    public function get_user_data($u_id)
    {
        $this->db->where('u_id', $u_id);
        return $this->db->get('register')->row_array();
    }
    public function get_enquiry_rejected_by_user($hotel_id)
    {
        $data = array();
        $this->db->select('*');
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
    public function get_floor_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('floor', 'ASC');
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
    public function get_room_no_data($hotel_id, $room_no)
    {
        $this->db->join('user_hotel_booking', 'user_hotel_booking.booking_id = user_hotel_booking_details.booking_id');
        $this->db->where('user_hotel_booking_details.room_no', $room_no);
        $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
        return $this->db->get('user_hotel_booking_details')->row_array();
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
    public function get_user_data_by_username($user_n)
    {
        $this->db->where('full_name', $user_n);
        // $this->db->where('user_type',0);
        return $this->db->get('register')->row_array();

    }
    public function get_room_nos_floor_wise($hotel_id, $floor_id)
    {
        $this->db->join('room_nos', 'room_nos.room_configure_id = room_configure.room_configure_id');
        $this->db->where('room_configure.hotel_id', $hotel_id);
        $this->db->where('room_configure.floor_id', $floor_id);
        return $this->db->get('room_configure')->result_array();
    }

    public function get_guest_list($hotel_id)
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
        $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        $this->db->join('guest_user', 'guest_user.u_id = user_hotel_booking.u_id AND guest_user.hotel_id = user_hotel_booking.hotel_id AND guest_user.booking_id =                         user_hotel_booking.booking_id');
        $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
        $this->db->where('user_hotel_booking.booking_status', 1);
        $this->db->order_by('user_hotel_booking.booking_id', 'desc');
        $this->db->where('user_hotel_booking.check_in <=',date('Y-m-d'));
        $this->db->where('user_hotel_booking.check_out >=',date('Y-m-d') );
        $Q = $this->db->get('user_hotel_booking');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }
    public function get_room_type_list1($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('room_type')->result_array();
    }
    public function get_room_no_list($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('room_status', 3);
        return $this->db->get('room_status')->result_array();
    }
    public function get_departure_guest_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
        $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        // $this->db->order_by('user_hotel_booking.check_out','DESC');
        $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
        // $this->db->where('user_hotel_booking.check_in <= ',date('Y-m-d'));
        $this->db->order_by('user_hotel_booking.actual_checkout', 'desc');
        $this->db->where('user_hotel_booking.booking_status', 2);
        $Q = $this->db->get('user_hotel_booking');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }
    public function get_upcoming_guest_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
        $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
        $this->db->where('user_hotel_booking.check_in >',date('Y-m-d'));
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

    public function get_visitor_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('created_at','DESC');
        $this->db->where('hotel_id', $hotel_id);
        $Q = $this->db->get('visitor');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
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
    public function get_notifications_for_housekeeping_1($hotel_id)
    {
        // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
        $this->db->where('notifications.send_by_id', $hotel_id);
        $this->db->where('notifications.send_for', 7);
        $this->db->order_by('notifications.notification_id', 'desc');
        // $this->db->where('notifications.department_id',4);
        return $this->db->get('notifications')->result_array();
    }
    public function get_admin_sent_user_notifications($hotel_id)
    {

        $data = array();
        $this->db->select('*');
        $this->db->where('send_by_id', $hotel_id);
        $this->db->or_where('send_by', 3);
        $this->db->or_where('send_for', 3);
        $this->db->or_where('send_for', 4);
        $this->db->or_where('send_for', 8);
        $this->db->or_where('send_for', 9);
        $this->db->order_by('notification_id', 'desc');
        return $this->db->get('notifications')->result_array();
        $Q = $this->db->get('notifications');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }
    public function get_admin_sent_user_notifications_search($hotel_id,$date)
    {

        $data = array();
        $this->db->select('*');
        $this->db->where('send_by_id', $hotel_id);
        $this->db->where( 'DATE(created_at)', $date);
        // $this->db->group_start();
        // $this->db->or_where('send_by', 3);
        // $this->db->or_where('send_for', 3);
        // $this->db->or_where('send_for', 4);
        // $this->db->or_where('send_for', 8);
        // $this->db->or_where('send_for', 9);
        // $this->db->group_end();
        $this->db->order_by('notification_id', 'desc');
        return $this->db->get('notifications')->result_array();
        $Q = $this->db->get('notifications');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
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
        // $this->db->where('send_to !=', 2);
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

    public function get_hotel_service_request($hotel_id,$todays_date)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('service_request_id ', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('DATE(created_at)', $todays_date);
        $this->db->where('send_to =', 2);
        $this->db->where('request_status',0);
        $Q = $this->db->get('service_request');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }
    public function get_accept_service_request($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('service_request_id ', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('send_to =', 2);
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
    public function get_reject_service_request($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('service_request_id ', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('send_to =', 2);
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
    public function get_service_request_new($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('service_request_id ', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        // $this->db->where('send_to =', 2);
        $Q = $this->db->get('service_request');

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
        $this->db->where('review_for', 2);
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
    public function get_manager_handover_list_pagination_1($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('m_handover_id', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('is_complete', 0);
        $Q = $this->db->get('handover_manger');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }
    public function getTotalcompletedhanover($hotel_id)
    {
        $data = array();
        $this->db->select('count(*) as total_record');
        $this->db->order_by('m_handover_id', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('is_complete', 0);
        $Q = $this->db->get('handover_manger');

        return $Q->row();
    }
    
    public function getTotalcompletedhanover_1($hotel_id)
    {
        $data = array();
        $this->db->select('count(*) as total_record');
        $this->db->order_by('m_handover_id', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('is_complete', 1);
        $Q = $this->db->get('handover_manger');

        return $Q->row();
    }
    public function getHandover($tbl,$wh)
    {
        $this->db->select('*');
        $this->db->where('m_handover_id',$wh);     
        return $this->db->get('handover_manger')->row_array();
    }
    public function get_manager_handover_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        // $this->db->limit($rowperpage, $row);
        $this->db->order_by('m_handover_id', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('is_complete', 0);
        $Q = $this->db->get('handover_manger');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }
    public function get_pending_handover_modal_list($hotel_id,$id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('handover_manger');
        $this->db->order_by('m_handover_id','DESC');
        $this->db->where('m_handover_id',$id);
        $this->db->where('is_complete',0);
        $this->db->where('hotel_id',$hotel_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_pending_handover_modal($hotel_id,$id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('m_handover_id','DESC');
        $this->db->where('m_handover_id',$id);
        $this->db->where('is_complete',0);
        $this->db->where('hotel_id',$hotel_id);
        return $this->db->get('handover_manger')->row_array();
    }
    public function get_manager_handover_completed_list_pagination($admin_id,$is_complete2)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('updated_at', 'DESC');
        // $this->db->limit($rowperpage, $row);
        $this->db->where('hotel_id', $admin_id);
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

    public function get_lost_found_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('created_at', 'DESC');
        $this->db->where('is_complete',0);
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
    public function completed_lost_found_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('created_at', 'DESC');
        $this->db->where('is_complete',1);
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
    public function get_user_expense_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('expense_id', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('expenses')->result_array();

         
    }
    public function get_floor_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('floor_id', 'DESC');
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
    public function get_room_type_list($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('room_type')->result_array();
    }

    public function get_room_nos($hotel_id, $room_type)
    {
        // print_r($room_type);exit;
        $this->db->select('*');
        $this->db->join('room_configure', 'room_configure.room_configure_id = room_nos.room_configure_id');
        $this->db->where('room_configure.hotel_id', $hotel_id);
        $this->db->where('room_configure.room_type', $room_type);
        return $this->db->get('room_nos')->result_array();
    }
    public function get_available_room_no($hotel_id, $room_no)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('room_no', $room_no);
        $this->db->where('room_status', 3);
        return $this->db->get('room_status')->row_array();
    }

    public function get_room_type_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('hotel_id', $hotel_id);

        $Q = $this->db->get('room_type');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
    }

    public function get_floor_list($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->order_by('floor', 'ASC');
        return $this->db->get('floors')->result_array();
    }
    public function get_room_typee_list($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('room_type')->result_array();
    }
    public function get_total_room_count($hotel_id, $room_type)
    {
        $this->db->select('count(room_nos.room_no) as total_room');
        $this->db->join('room_nos', 'room_nos.room_configure_id = room_configure.room_configure_id');
        $this->db->where('room_configure.hotel_id', $hotel_id);
        $this->db->where('room_configure.room_type', $room_type);
        return $this->db->get('room_configure')->result_array();
    }
    public function get_agents_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('created_at','DESC');
        $this->db->where('hotel_id', $hotel_id);
        $Q = $this->db->get('agents');

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();

        return $data;
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
    public function edit_data($tbl, $wh, $arr)
    {
        $this->db->where($wh);

        if ($this->db->update($tbl, $arr)) {
            return true;
        } else {
            return false;
        }
    }
    public function get_user_list_by_hotels($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('user_type', 0);
        $this->db->where('is_active', 1);
        return $this->db->get('register')->result_array();
    }
    // Guest list of that hotels --------------Supriya
    public function get_guest_list_by_hotels($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('is_guest', 1);
        $this->db->distinct('u_id');
        //  $this->db->where('dnd_mode',1);
        return $this->db->get('guest_user')->result_array();
    }
    public function insert_data($tbl, $arr)
    {
        $this->db->insert($tbl, $arr);
        return $this->db->insert_id();
    }
    public function get_room_nos_data($hotel_id, $room_type, $room_no)
    {
        $this->db->join('room_configure', 'room_configure.room_configure_id = room_nos.room_configure_id');
        $this->db->where('room_configure.hotel_id', $hotel_id);
        $this->db->where('room_configure.room_type', $room_type);
        $this->db->where('room_nos.room_no', $room_no);
        return $this->db->get('room_nos')->row_array();
    }
    // public function delete_data($tbl, $wh)
    // {
    //     $this->db->where($wh);
    //     if ($this->db->delete($tbl)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    public function get_total_room_count11($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);

        return $this->db->get('room_nos')->result_array();
    }

    public function get_hotel_rooms_status($hotel_id, $room_status)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('room_status', $room_status);
        return $this->db->get('room_status')->result_array();
    }
    public function get_hotel_user_booking($hotel_id, $booking_status)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_status', $booking_status);
        $this->db->where('check_in =', date('Y-m-d'));
        return $this->db->get('user_hotel_booking')->result_array();
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
    public function get_hotel_expected_current_booking($hotel_id)
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
    public function get_hotel_chg_guest($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('guest_type', 3);
        $this->db->where('user_type', 0);
        $this->db->where('register_date =', date('Y-m-d'));
        return $this->db->get('register')->result_array();
    }

    public function get_notifications_for_front_ofs($hotel_id,$today_date)
    {
        $this->db->select('notifications.notification_id,notifications.created_at,notifications.title,notifications.description,notifictions_department_id.department_id');
        $this->db->where('notifications.send_by_id', $hotel_id);
        $this->db->where('notifications.send_for', 7);
        $this->db->where('Date(notifications.created_at)',$today_date);
        $this->db->order_by('notifications.notification_id', 'desc');
        $this->db->where('notifictions_department_id.department_id', 2);
        $this->db->where('notifications.order_status', 0);
        $this->db->join('notifictions_department_id','notifictions_department_id.notification_id = notifications.notification_id','left');
        return $this->db->get('notifications')->result_array();
    }
    public function get_notifications_for_front_ofs12($hotel_id, $today_date)
{
    $this->db->select('notification_id, created_at, title, description');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('DATE(created_at)', $today_date);
    $this->db->order_by('notification_id', 'desc');

    $query = $this->db->get('notifications');

    // Debugging
    if ($query->num_rows() == 0) {
        log_message('error', 'No notifications found in get_notifications_for_front_ofs for hotel ID: ' . $hotel_id);
    }

    return $query->result_array();
}


    //total hotels expected current booking ------supriya
   
    //total hotels all guest--------supriya
    public function get_hotel_guest_list($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('guest_type', 1);
        $this->db->where('user_type', 0);
        $this->db->where('register_date =', date('Y-m-d'));
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
        $this->db->select('count(total_adults) as total_adults,count(total_child) as total_child');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_status', 1);
        return $this->db->get('user_hotel_booking')->result_array();
    }

    //room service services order
    public function get_room_service_services_order($hotel_id, $order_status)
    {
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,rmservice_services_orders.*');
        $this->db->join('register', 'register.u_id = rmservice_services_orders.u_id');
        $this->db->order_by('rmservice_services_orders.rmservice_services_order_id', 'DESC');
        $this->db->where('rmservice_services_orders.hotel_id', $hotel_id);
        $this->db->where('rmservice_services_orders.order_status', $order_status);
        return $this->db->get('rmservice_services_orders')->result_array();
    }

    //room service menu order
    public function get_room_service_menu_order($hotel_id, $order_status)
    {
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,room_service_menu_orders.*');
        $this->db->join('register', 'register.u_id = room_service_menu_orders.u_id');
        $this->db->where('room_service_menu_orders.hotel_id', $hotel_id);
        $this->db->where('room_service_menu_orders.order_status', $order_status);
        return $this->db->get('room_service_menu_orders')->result_array();
    }

    public function get_house_keeping_service_order($hotel_id, $order_status)
    {
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,house_keeping_orders.*');
        $this->db->join('register', 'register.u_id = house_keeping_orders.u_id');
        $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
        $this->db->where('house_keeping_orders.order_status', $order_status);
        return $this->db->get('house_keeping_orders')->result_array();
    }
    //laundry order(cloth)
    public function get_laundry_order($hotel_id, $order_status)
    {
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.profile_photo,cloth_orders.*');
        $this->db->join('register', 'register.u_id = cloth_orders.u_id');
        $this->db->where('cloth_orders.hotel_id', $hotel_id);
        $this->db->where('cloth_orders.order_status', $order_status);
        return $this->db->get('cloth_orders')->result_array();
    }
    //bar and restaurant order order
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

    //guest booking room related details
    public function get_booking_room_details($booking_id)
    {
        $this->db->select('room_type.room_type_name,user_hotel_booking_details.*');
        $this->db->join('room_type', 'room_type.room_type_id = user_hotel_booking_details.room_type');
        //  $this->db->where('user_hotel_booking_details.hotel_id',$hotel_id);
        $this->db->where('user_hotel_booking_details.booking_id', $booking_id);
        return $this->db->get('user_hotel_booking_details')->result_array();
    }
    //booking details
    public function get_user_booking_details($hotel_id, $booking_id)
    {
        // print_r($hotel_id);exit;
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_id', $booking_id);
        return $this->db->get('user_hotel_booking')->row_array();
    }
    //booking history
    public function get_user_booking_history($hotel_id, $u_id1)
    {
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('u_id',$u_id1);
        $this->db->where('booking_status',2);
        return $this->db->get('user_hotel_booking')->result_array();
    }
    //user room service menu complete order list
    public function get_user_room_service_menu_completed_order_list($hotel_id, $booking_id, $u_id)
    {
        $this->db->select('room_serv_menu_list.menu_name,room_service_menu_details.*');
        $this->db->join('room_service_menu_details', 'room_service_menu_details.room_service_menu_order_id = room_service_menu_orders.room_service_menu_order_id');
        $this->db->join('room_serv_menu_list', 'room_service_menu_details.room_service_menu_order_id = room_serv_menu_list.room_serv_menu_id');
        $this->db->where('room_service_menu_orders.hotel_id', $hotel_id);
        $this->db->where('room_service_menu_orders.booking_id', $booking_id);
        $this->db->where('room_service_menu_orders.u_id', $u_id);
        $this->db->where('room_service_menu_orders.order_status', 2);
        $this->db->where('room_service_menu_orders.is_paid_after_check_out', 1);
        return $this->db->get('room_service_menu_orders')->result_array();
    }
    //user housekeeping service complete order list
    public function get_user_housekeeping_completed_order_list($hotel_id, $booking_id, $u_id)
    {
        $this->db->select('house_keeping_services.service_type,house_keeping_order_details.*');
        $this->db->join('house_keeping_order_details', 'house_keeping_order_details.h_k_order_id = house_keeping_orders.h_k_order_id');
        $this->db->join('house_keeping_services', 'house_keeping_order_details.h_k_service_id = house_keeping_services.h_k_services_id');
        $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
        $this->db->where('house_keeping_orders.booking_id', $booking_id);
        $this->db->where('house_keeping_orders.u_id', $u_id);
        $this->db->where('house_keeping_orders.order_status', 2);
        $this->db->where('house_keeping_orders.is_paid_after_check_out', 1);
        return $this->db->get('house_keeping_orders')->result_array();
    }

    //user cloth or laundry complete order list
    public function get_user_laundry_order_list($hotel_id, $booking_id, $u_id)
    {
        $this->db->select('cloth.cloth_name,cloth_order_details.*');
        $this->db->join('cloth_order_details', 'cloth_order_details.cloth_order_id = cloth_orders.cloth_order_id');
        $this->db->join('cloth', 'cloth_order_details.cloth_id = cloth.cloth_id');
        $this->db->where('cloth_orders.hotel_id', $hotel_id);
        $this->db->where('cloth_orders.booking_id', $booking_id);
        $this->db->where('cloth_orders.u_id', $u_id);
        $this->db->where('cloth_orders.order_status', 2);
        $this->db->where('cloth_orders.is_paid_after_check_out', 1);
        return $this->db->get('cloth_orders')->result_array();
    }
    //user food complete order list
    public function get_user_food_completed_order_list($hotel_id, $booking_id, $u_id)
    {
        $this->db->select('food_menus.items_name,food_order_details.*');
        $this->db->join('food_order_details', 'food_order_details.food_order_id = food_orders.food_order_id');
        $this->db->join('food_menus', 'food_order_details.food_items_id = food_menus.food_item_id');
        $this->db->where('food_orders.hotel_id', $hotel_id);
        $this->db->where('food_orders.booking_id', $booking_id);
        $this->db->where('food_orders.u_id', $u_id);
        $this->db->where('food_orders.order_status', 2);
        $this->db->where('food_orders.is_paid_after_check_out', 1);
        return $this->db->get('food_orders')->result_array();
    }
    //user room service services complete order list
    public function get_user_room_service_services_order_list($hotel_id, $booking_id, $u_id)
    {
        $this->db->select('room_servs_services.service_name,rmservice_services_details.*');
        $this->db->join('rmservice_services_details', 'rmservice_services_details.rmservice_services_order_id = rmservice_services_orders.rmservice_services_order_id');
        $this->db->join('room_servs_services', 'rmservice_services_details.room_serv_service_id = room_servs_services.r_s_services_id');
        $this->db->where('rmservice_services_orders.hotel_id', $hotel_id);
        $this->db->where('rmservice_services_orders.booking_id', $booking_id);
        $this->db->where('rmservice_services_orders.u_id', $u_id);
        $this->db->where('rmservice_services_orders.order_status', 2);
        $this->db->where('rmservice_services_orders.is_paid_after_check_out', 1);
        return $this->db->get('rmservice_services_orders')->result_array();
    }

    //checout booking details
    public function get_shuttle_service_staff_avaibility_by_day($hotel_id, $day)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('day', $day);
        return $this->db->get('shuttle_service_avaibility')->result_array();
    }
    public function get_lost_found_list($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('lost_found_list')->result_array();
    }

    //get hotel enquiry request-------------supriya
    public function get_hotel_enquiry_request($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('request_status', 0);
        $this->db->order_by('check_in_date', 'DESC');
        // echo $this->db->last_query();

        return $this->db->get('hotel_enquiry_request')->result_array();
    }
    //total user room service menu  order list-----------------Supriya
    public function get_total_user_room_service_menu_order($hotel_id, $booking_id, $u_id, $complete_date)
    {
        $this->db->select('sum(order_total) as total');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_id', $booking_id);
        $this->db->where('u_id', $u_id);
        $this->db->where('complete_date', $complete_date);
        $this->db->where('payment_status', 0);
        return $this->db->get('room_service_menu_orders')->result_array();
    }
    public function get_total_user_room_service_service_order($hotel_id, $booking_id, $u_id, $complete_date)
    {
        $this->db->select('sum(order_total) as total');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_id', $booking_id);
        $this->db->where('u_id', $u_id);
        $this->db->where('complete_date', $complete_date);
        $this->db->where('payment_status', 0);
        return $this->db->get('rmservice_services_orders')->result_array();
    }

    public function get_user_checkout_booking_details($hotel_id, $user_checkout_data_id)
    {
        $this->db->group_by('date');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('user_checkout_data_id', $user_checkout_data_id);
        $this->db->order_by('user_checkout_detail_id', 'asc');
        return $this->db->get('user_checkout_details')->result_array();
    }

    public function get_user_checkout_booking_details1($hotel_id, $user_checkout_data_id)
    {
        $this->db->group_by('description');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('user_checkout_data_id', $user_checkout_data_id);
        $this->db->order_by('user_checkout_detail_id', 'asc');
        return $this->db->get('user_checkout_details')->result_array();
    }
    //checout booking details
    public function get_user_checkout_booking_details_amt($hotel_id, $user_checkout_data_id, $description)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('user_checkout_data_id', $user_checkout_data_id);
        $this->db->where('description', $description);
        $this->db->order_by('user_checkout_detail_id', 'asc');
        // $this->db->where('date',$date);
        return $this->db->get('user_checkout_details')->result_array();
    }
    //checout booking details
    public function get_user_checkout_booking_details_subtotal($hotel_id, $user_checkout_data_id, $description)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('user_checkout_data_id', $user_checkout_data_id);
        $this->db->where('description_name', $description);
        return $this->db->get('user_checkout_sub_total')->row_array();
    }
    //checout booking details
    public function get_user_checkout_booking_data($hotel_id, $booking_id, $u_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('u_id', $u_id);
        $this->db->where('booking_id', $booking_id);
        return $this->db->get('user_checkout_data')->row_array();
    }
    //room services mini bar
    public function get_room_service_minibar($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('room_servs_mini_bar')->result_array();
    }
    //get buisness center_data
    public function get_buis_center_data($u_id)
    {
        $this->db->where('business_center_id ', $u_id);
        return $this->db->get('business_center')->row_array();
    }
    //Super Admin Hotels Facility----------supriya
    public function get_center_facility($hotel_id)
    {
        $this->db->where('business_center_id', $hotel_id);
        return $this->db->get('business_center_facility')->result_array();
    }
    public function get_buis_center_photos($hotel_id)
    {
        $this->db->where('business_center_id', $hotel_id);
        // echo $this->db->last_query();      
        return $this->db->get('business_center_images')->result_array();
    }

    public function get_customers($hotel_id)
    {
        $this->db->where('user_type', 0);
        $this->db->where('hotel_id', $hotel_id);

        //  $this->db->group_by('full_name');
        return $this->db->get('register')->result_array();
    }

    public function get_gues($hotel_id)
    {
        $this->db->where('is_guest', 1);
        $this->db->where('hotel_id', $hotel_id);
        //  $this->db->group_by('full_name');
        return $this->db->get('guest_user')->result_array();
    }

    public function get_total_user_laundry_order($hotel_id, $booking_id, $u_id, $complete_date)
    {
        $this->db->select('sum(order_total) as total');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_id', $booking_id);
        $this->db->where('u_id', $u_id);
        $this->db->where('complete_date', $complete_date);
        $this->db->where('is_paid', 0);
        return $this->db->get('cloth_orders')->result_array();
    }

    //room type images
    public function get_room_imgs($hotel_id, $room_configure_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('room_configure_id', $room_configure_id);
        return $this->db->get('room_imgs')->result_array();
    }

    //room  facilities
    public function get_room_facility($hotel_id, $room_configure_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('room_configure_id', $room_configure_id);
        return $this->db->get('room_facility')->result_array();
    }

    //room nos
    public function get_room_numbers($hotel_id, $room_configure_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('room_configure_id', $room_configure_id);
        return $this->db->get('room_nos')->result_array();
    }

    public function get_room_type_data($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('room_type')->row_array();
    }

    public function get_room_related_data($hotel_id, $room_type)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('room_type', $room_type);
        return $this->db->get('room_configure')->result_array();
    }

    // availble room no data

    //search in check in data
    public function ser_check_list($date)
    {
        $this->db->select('*');
        $this->db->from('user_hotel_booking');

        $this->db->like('check_in', $date);
        $query = $this->db->get();
        //   echo $this->db->last_query();
        return $query->result_array();
    }
    public function get_room_chr($hotel_id, $id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('room_type', $id);
        // $this->db->where('price',$room_no);
        return $this->db->get('room_configure')->row_array();
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
    public function get_active_business_center_app($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('is_active', 1);
//   echo $this->db->last_query();  
        return $this->db->get('business_center')->result_array();
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
    public function searchcCrud($searchon, $hotel_id, $date)
    {
        $this->db->select('*');
        $this->db->from('business_center_reservation');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('event_date', $date);
        // $this->db->where('request_status', 1);
        $this->db->like('business_center_type', $searchon);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_total_user_housekeeping_order($hotel_id, $booking_id, $u_id, $complete_date)
    {
        $this->db->select('sum(order_total) as total');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_id', $booking_id);
        $this->db->where('u_id', $u_id);
        $this->db->where('complete_date', $complete_date);
        $this->db->where('is_paid', 0);
        return $this->db->get('house_keeping_orders')->result_array();
    }
    public function get_total_user_food_order($hotel_id, $booking_id, $u_id, $complete_date)
    {
        $this->db->select('sum(order_total) as total');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('booking_id', $booking_id);
        $this->db->where('u_id', $u_id);
        $this->db->where('complete_date', $complete_date);
        $this->db->where('is_paid', 0);
        return $this->db->get('food_orders')->result_array();
    }
    public function search_guest_data($check_in, $hotel_id, $u_id)
    {

        $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
        $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        $this->db->where('user_hotel_booking.booking_status', 1);
        $this->db->where('user_hotel_booking.check_out >=', date('Y-m-d'));
        $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
        $this->db->where('user_hotel_booking.check_in', $check_in);
        $this->db->like('user_hotel_booking.u_id', $u_id);
        // $this->db->order_by('booking_id','DESC');
        $query = $this->db->get('user_hotel_booking');
        return $query->result_array();
    }
    public function search_departed_guest_data($check_in, $hotel_id, $u_id)
    {

        $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
        $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        $this->db->where('user_hotel_booking.booking_status', 2);
        // $this->db->where('user_hotel_booking.check_out >=',date('Y-m-d'));
        $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
        $this->db->where('user_hotel_booking.check_in', $check_in);
        $this->db->like('user_hotel_booking.u_id', $u_id);
        // $this->db->order_by('booking_id','DESC');
        $query = $this->db->get('user_hotel_booking');
        return $query->result_array();
    }
    public function ser_check_in_date_data($check_in_date,$hotel_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_enquiry_request');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('check_in_date',$check_in_date);
       
        $query =$this->db->get();
        return $query->result_array();
    }
    public function ser_check_out_date_data($check_out_date,$hotel_id)
    {
        $this->db->select('*');
        $this->db->from('hotel_enquiry_request');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('check_out_date',$check_out_date);
       
        $query =$this->db->get();
        return $query->result_array();
    }
    public function search_en_request_data($check_in_date, $hotel_id, $check_out_date)
    {
        $this->db->select('*');
        $this->db->from('hotel_enquiry_request');
        $this->db->where('hotel_id', $hotel_id);
        // $this->db->where('check_in_date',$check_in_date);
        // $this->db->like('check_out_date',$check_out_date);
        // $this->db->where('check_in_date BETWEEN "'.date('Y-m-d',strtotime($check_in_date)).'" and "'.date('Y-m-d',strtotime($check_out_date)).'"');
        $this->db->where(' check_in_date >= date("' . $check_in_date . '")');
        $this->db->where('check_out_date <= date("' . $check_out_date . '")');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_spa_services_images($hotel_id, $front_ofs_service_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('front_ofs_service_id', $front_ofs_service_id);
        return $this->db->get('front_ofs_spa_service_images')->result_array();
    }
    public function get_front_ofs_services_pagination($hotel_id, $service_name)
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
    public function getpoolsingledata($tbl,$where)
    {
        $this->db->select('front_ofs_services.*,front_ofs_services_images.image');
        $this->db->join('front_ofs_services_images','front_ofs_services.front_ofs_service_id=front_ofs_services_images.front_ofs_service_id');
        $this->db->where('front_ofs_services_images.front_ofs_service_id',$where);
        return $this->db->get('front_ofs_services')->row_array();

        // $this->db->select('*');
        // $this->db->from($tbl);
        // $this->db->where($where);
        // $query = $this->db->get();        
        // return $query->row_array();
    }
    public function getshuttlesingledata($tbl,$where)
    {
        $this->db->select('front_ofs_services.*,front_ofs_services_images.image');
        $this->db->join('front_ofs_services_images','front_ofs_services.front_ofs_service_id=front_ofs_services_images.front_ofs_service_id');
        $this->db->where('front_ofs_services_images.front_ofs_service_id',$where);
        return $this->db->get('front_ofs_services')->row_array();
        // $this->db->select('*');
        // $this->db->from($tbl);
        // $this->db->where($where);
        // $query = $this->db->get();        
        // return $query->row_array();
    }
    public function getspasingledata($tbl,$where)
    {
        $this->db->select('front_ofs_services.*,front_ofs_services_images.image,front_ofs_spa_service_images.*');
        $this->db->join('front_ofs_services_images','front_ofs_services.front_ofs_service_id=front_ofs_services_images.front_ofs_service_id');
        $this->db->join('front_ofs_spa_service_images','front_ofs_services.front_ofs_service_id=front_ofs_spa_service_images.front_ofs_service_id');
        $this->db->where('front_ofs_services_images.front_ofs_service_id',$where);
        $this->db->where('front_ofs_spa_service_images.front_ofs_service_id',$where);
        return $this->db->get('front_ofs_services')->result_array();
        // $this->db->select('*');
        // $this->db->from($tbl);
        // $this->db->where($where);
        // $query = $this->db->get();        
        // return $query->row_array();
    }
    public function getbabysingledata($tbl,$where)
    {
        $this->db->select('front_ofs_services.*,front_ofs_services_images.image');
        $this->db->join('front_ofs_services_images','front_ofs_services.front_ofs_service_id=front_ofs_services_images.front_ofs_service_id');
        $this->db->where('front_ofs_services_images.front_ofs_service_id',$where);
        return $this->db->get('front_ofs_services')->row_array();
        // $this->db->select('*');
        // $this->db->from($tbl);
        // $this->db->where($where);
        // $query = $this->db->get();        
        // return $query->row_array();
    }

    public function get_vehicle_wash_request_list_pagination($hotel_id)
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
    public function get_car_request_list1($hotel_id,$where)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('vehicle_wash_request_id', $where);
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('vehicle_wash_request')->row_array();
    }
    public function get_lugggage_request_list1($hotel_id,$where)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('luggage_request_id', $where);
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('luggage_request')->row_array();
    }
    public function get_luggage_request_list_pagination($hotel_id)
    {
        // print_r($hotel_id);exit;
        $data = array();
        $this->db->select('*');
        $this->db->order_by('luggage_request_id', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('request_status', 0);
        return $this->db->get('luggage_request')->result_array();
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
    public function get_spa_request_list1($hotel_id,$where)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('spa_service_request_id', $where);
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('spa_service_request_list')->row_array();
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
    public function get_cab_service_pagination($hotel_id)
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
    public function get_luggage_accepted_request_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('luggage_request_id','DESC');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('is_completed',0);
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
    public function get_luggage_rejected_request_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('luggage_request_id','DESC');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('request_status',2);
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
    function get_luggage_charges_list_pagination($hotel_id)
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

    public function get_business_center_pagination($hotel_id)
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
    public function get_user_data_by_no($mobile_no)
    {
        $this->db->where('mobile_no',$mobile_no);
        $this->db->where('user_type',0);
        return $this->db->get('register')->row_array();
    }
    public function getnotifications($tbl,$wh){
        $this->db->select('*');
        $this->db->where('notification_id',$wh);     
        return $this->db->get('notifications')->row_array();
    }
    // code by vivek
    public function see_all_notification($hotel_id,$today_date)
    {
        $this->db->where('notifications.send_by_id',$hotel_id);
        $this->db->where('notifications.send_for',7);
        $this->db->where('notifications.order_status',0);
        $this->db->where('DATE(notifications.created_at)',$today_date);
        $this->db->order_by('notifications.notification_id','desc');
        return $this->db->get('notifications')->result_array();
    }
    // notification from super admin for all hotels (by : push)
    public function all_hotel_notic_from_superadmin($today_date)
    {
        $this->db->select('notification_id, created_at, title, description, resend_count as all_hotels_resent_not');
        $this->db->where('notifications.send_by_id', 1); // Specify the table alias
        $this->db->where('notifications.send_for', 1); // Specify the table alias
        $this->db->where('notifications.send_to', 1); // Specify the table alias
        $this->db->where('DATE(notifications.created_at)', $today_date); // Specify the table alias
        $this->db->where('notifications.notification_type', 2); // Specify the table alias
        $this->db->order_by('notifications.notification_id', 'desc'); // Specify the table alias
        return $this->db->get('notifications')->result_array();
    }
    
     // notification from super admin for specific hotels (by : push)
    public function specific_hotel_notis_from_SA($hotel_id,$today_date)
    {
        $this->db->select('not.notification_id,not.created_at,not.title,not.description,not.resend_count as specific_hotel_resent_not');
        $this->db->where('not.send_by_id',1);
        $this->db->where('not.send_for',2);
        $this->db->where('not.send_to',2);
        $this->db->where('not.notification_type',2);
        $this->db->where('DATE(not.created_at)',$today_date);
        $this->db->order_by('not.notification_id','desc');
        $this->db->join('notifictions_u_id','notifictions_u_id.notification_id = not.notification_id');
        $this->db->where('notifictions_u_id.user_id',$hotel_id);
        return $this->db->get('notifications as not')->result_array();
    }

    public function all_hotel_notic_from_superadmin12($today_date)
    {
        $this->db->select('notification_id, created_at, title, description, resend_count as all_hotels_resent_not');
        $this->db->where([
            'send_by_id' => 1,
            'send_for' => 1,
            'send_to' => 1,
            'notification_type' => 2
        ]);
        $this->db->where('DATE(created_at)', $today_date);
        $this->db->order_by('notification_id', 'desc');
    
        $query = $this->db->get('notifications');
        
        // Debugging
        if ($query->num_rows() == 0) {
            log_message('error', 'No notifications found in all_hotel_notic_from_superadmin12');
        }
    
        return $query->result_array();
    }
    
    
    public function specific_hotel_notis_from_SA12($hotel_id, $today_date)
{
    $this->db->select('not.notification_id, not.created_at, not.title, not.description, not.resend_count as specific_hotel_resent_not');
    $this->db->where([
        'not.send_by_id' => 1,
        'not.send_for' => 2,
        'not.send_to' => 2,
        'not.notification_type' => 2
    ]);
    $this->db->where('DATE(not.created_at)', $today_date);
    $this->db->join('notifictions_u_id', 'notifictions_u_id.notification_id = not.notification_id');
    $this->db->where('notifictions_u_id.user_id', $hotel_id);
    $this->db->order_by('not.notification_id', 'desc');

    $query = $this->db->get('notifications as not');
    
    // Debugging
    if ($query->num_rows() == 0) {
        log_message('error', 'No notifications found in specific_hotel_notis_from_SA12 for hotel ID: ' . $hotel_id);
    }

    return $query->result_array();
}

    public function getregdata($tbl,$wh){
        $this->db->select('*');
        $this->db->where('b_c_reserve_id',$wh);
        return $this->db->get('business_center_reservation')->row_array();
    }
    public function getServiceId($tbl,$wh){
        $this->db->select('*');
        $this->db->where('service_request_id',$wh);
        return $this->db->get('service_request')->row_array();
    }
    public function getEnquiryId($tbl,$wh){
        $this->db->select('*');
        $this->db->where('hotel_enquiry_request_id',$wh);
        return $this->db->get('hotel_enquiry_request')->row_array();
    }
    public function gethandata($tbl,$wh){
        $this->db->select('*');
        $this->db->where('id',$wh);
        return $this->db->get('lost_found_list')->row_array();
    }
    public function editData($tbl,$where,$arr)
    {
        $this->db->where($where);
        
        if($this->db->update($tbl,$arr))
        {
             return TRUE;
        } 
        else 
        {
            return FALSE;
        }
    }
    public function get_all_hotels_services($rowperpage, $row, $search, $hotel_id)
    {
        $this->db->limit($rowperpage, $row);
        $this->db->where('hotel_id', $hotel_id);
        $this->db->order_by('services_name','ASC');

        if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('services_name', $search);
            $this->db->group_end();     
        } 

        $this->db->select('hotels_service_id,services_id,services_name,status');
        $this->db->from('hotels_services');
        $query = $this->db->get();
        // echo "<pre>";
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }

    public function getTotal_all_hotels_services($search, $hotel_id)
    {
        $this->db->order_by('hotels_service_id','DESC');
        $this->db->where('hotel_id', $hotel_id);

        if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('services_name', $search);
            $this->db->group_end();     
        } 

        $this->db->select('count(services_id) as total_record');
        $this->db->from('hotels_services');
        $query = $this->db->get();
        return $query->row();
    }
    public function get_vehicle_wash_completed_request_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('vehicle_wash_request_id','DESC');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('request_status',4);
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
    function cab_service_completed_tab($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        // $this->db->limit($limit, $offset);
        $this->db->order_by('complete_date', 'DESC');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('request_status',4);
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
    public function get_luggage_completed_request_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('luggage_request_id','DESC');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('is_completed',1);
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
    function cab_service_cancle_tab($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        // $this->db->limit($limit, $offset);
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
    public function get_checkout_request($hotel_id, $request_status)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('request_status', $request_status);
        $this->db->order_by('checkout_request_id','DESC');
        return $this->db->get('user_checkout_requests')->result_array();
    }
    public function getdataotp($tbl,$wh){
        $this->db->select('*');
        $this->db->where('visitor_id',$wh);
        return $this->db->get('visitor')->row_array();
    }
    function get_business_data($rowperpage, $row, $search,$columnName,$hotel_id)
    {
        $this->db->order_by('business_center_reservation.created_at','DESC');
        $this->db->limit($rowperpage, $row);
        $this->db->where('business_center_reservation.hotel_id', $hotel_id);
        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
                // $this->db->like('business_center.business_center_type', $search);
                // $this->db->or_where('reg.full_name', $search);
            $this->db->group_end();     
        } 
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('request_status', 0);

        $this->db->order_by('b_c_reserve_id', 'DESC');
        $Q = $this->db->get('business_center_reservation');

        return $Q->result_array();
    }
    function get_visiter_data($rowperpage, $row, $search,$columnName,$hotel_id)
    {
        $this->db->order_by('visitor.created_at','DESC');
        $this->db->limit($rowperpage, $row);
        $this->db->where('visitor.hotel_id', $hotel_id);
        if(!empty($search)){
        $this->db->group_start(); // Open bracket
            $this->db->like('visitor.visitor_name', $search);
            $this->db->or_where('visitor.room_no', $search);
            $this->db->or_where('reg.full_name', $search);
        $this->db->group_end();     
        } 
        $this->db->select('visitor.*,reg.mobile_no,reg.full_name');
        $this->db->from('visitor');
        $this->db->join('register as reg', 'reg.u_id = visitor.u_id','left');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_total_visiter_data($search='', $hotel_id='')
    {
        $this->db->order_by('visitor.created_at','DESC');
        $this->db->where('visitor.hotel_id', $hotel_id);

        if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('visitor.visitor_name', $search);
                $this->db->or_where('visitor.room_no', $search);
                $this->db->or_where('reg.full_name', $search);
            $this->db->group_end();     
        } 

        $this->db->select('count(visitor_id) as total_record');
        $this->db->from('visitor');
        $this->db->join('register as reg', 'reg.u_id = visitor.u_id','left');
        $query = $this->db->get();
        return $query->row();
    }
    function get_total_business_data($search='', $hotel_id='')
    {
        $this->db->order_by('business_center_reservation.created_at','DESC');
        // $this->db->limit($rowperpage, $row);
        $this->db->where('business_center_reservation.hotel_id', $hotel_id);
        $this->db->where('request_status', 0);
        if(!empty($search)){
            $this->db->group_start(); // Open bracket
                // $this->db->like('business_center.full_name', $search);
                // $this->db->or_where('reg.full_name', $search);
            $this->db->group_end();     
        } 
        $this->db->select('count(b_c_reserve_id) as total_record');
        // $this->db->select('business_center.*,business_center_reservation.client_name,business_center_reservation.client_mobile_no');
        // $this->db->join('business_center', 'business_center.business_center_id = business_center_reservation.business_center_type');
        $Q = $this->db->get('business_center_reservation');
        return $Q->row();
    }
}
