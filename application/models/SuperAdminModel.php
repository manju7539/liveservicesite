<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdminModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }

    //  For login Check_Mail(Super_admin)....Supriya
    public function check_email($email, $password)
    {
        $this->db->where('email_id', $email);
        $this->db->where('password', $password);
        $this->db->where('user_type', 1);
        return $this->db->get('register')->row_array();
    }
    public function getamount($wh)
    {
        $this->db->select_sum('amount');
        $this->db->from('hotel_credit_amount_list');
        $this->db->DISTINCT('hotel_id');
        $this->db->where($wh);
        $query=$this->db->get();
        return $query->row_array();
    }
    public function remove_mode() 
    {
        $sql="SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))";    
        $this->db->query($sql);
    }
    public function getAllData($tbl, $wh)
    {
        $this->db->where($wh);
        return $this->db->get($tbl)->result_array();
    }
    public function getAllDatat($tbl, $where)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }
    public function add_hotel()
    {
        $post_data = $this->input->post();
    }
    public function getPlan($tbl)
    {
        $this->db->select('*');
        $this->db->order_by('created_at', 'DESC');
        $this->db->from($tbl);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_hotels_id()
    {
        $this->db->where('user_type', 2);
        $this->db->DISTINCT('hotel_name');
        return $this->db->get('register')->result_array();
    }

    public function getFilteredHotels($where)
{
    return $this->db->where($where)->get('register')->result_array();
}
    public function ser_check_list($date)
    {
        $this->db->select('*');
        $this->db->from('register');
        $this->db->where('user_type',2);
        $this->db->like('register_date',$date);
        $query =$this->db->get();
        return $query->result_array();
    }
    public function ser_check_list_hotel($searchon)
    {
        $this->db->select('*');
        $this->db->from('register');
        $this->db->where('user_type',2);
        $this->db->where('u_id',$searchon);
        $query =$this->db->get();
        return $query->result_array();
    }
    public function searchcCrud($searchon,$date,$city)
    {
        $this->db->select('*');
        $this->db->from('register');
        $this->db->where('user_type',2);
        $this->db->where('city',$city);
        $this->db->where('register_date',$date);
        $this->db->where('u_id',$searchon);
        $query =$this->db->get();
        return $query->result_array();
    }
    public function insertData($tbl, $arr)
    {
        $this->db->insert($tbl, $arr);
        return $this->db->insert_id();
    }
    public function editData1($tbl, $where, $arr)
    {
        $this->db->where('leads_plan_id', $where);
        if ($this->db->update($tbl, $arr)) {
            return true;
        } else {
            return false;
        }
    }
    public function editData($tbl,$wh,$arr)
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
    public function editDatat($tbl, $wh, $arr)
    {
        $this->db->where($wh);
        if ($this->db->update($tbl, $arr)) {
            return true;
        } else {
            return false;
        }
    }
    public function editData_recharge($tbl, $where, $arr)
    {
        $this->db->where('leads_recharge_id', $where);
        if ($this->db->update($tbl, $arr)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($tbl, $where)
    {
        $this->db->where($where);
        if ($this->db->delete($tbl)) {
            return true;
        } else {
            return false;
        }
    }
   
    public function getSingleData($tbl, $where)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function group_city($tbl, $where)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        // $this->db->group_by('city');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_city_wise_hotel($tbl, $wh)
    {
        // $this->where('user_type',2);
        $this->db->where($wh);
        return $this->db->get($tbl)->result_array();
    }
    public function get_hotel_credit_data($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('hotel_credit_amount_list')->row_array();
    }
    public function get_user_dataa($hotel_id)
    {
        $this->db->where('u_id', $hotel_id);
        return $this->db->get('register')->row_array();
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
    public function get_credit_amount()
    {
        // $data = array();
        // $this->db->select('*');
        // $this->db->order_by('id', 'DESC');
        // return $this->db->get('hotel_credit_amount_list')->row_array();
        $data = array();
        $this->db->select('*');
        // $this->db->limit($limit, $offset);
        $this->db->order_by('id','DESC');
        $Q = $this->db->get('hotel_credit_amount_list');
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
    public function get_credit_amount_mng_credit($where)
    {
        // $data = array();
        // $this->db->select('*');
        // $this->db->order_by('id', 'DESC');
        // return $this->db->get('hotel_credit_amount_list')->row_array();
        $data = array();
        $this->db->select('*');
        // $this->db->limit($limit, $offset);
        // $this->db->order_by('id','DESC');
        $this->db->where($where);
        $Q = $this->db->get('hotel_credit_amount_list');
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
    
    public function search_lead_datewise($date)
    {
        $this->db->select('*');
        $this->db->from('hotel_enquiry_request');
        $this->db->where('request_status', 1);
        $this->db->like('check_in_date', $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function search_hotel_lead_datewise($searchon)
    {
        $this->db->select('*');
        $this->db->from('hotel_enquiry_request');
        $this->db->where('request_status', 1);
        $this->db->like('hotel_id', $searchon);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_request_list()
    {
        $data = array();
        // $this->db->select('*');
        // $this->db->from('hotel_enquiry_request');
        // $this->db->join('register','register.u_id = hotel_enquiry_request.u_id');
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.hotel_name,register.email_id,register.address,register.city,register.area,hotel_enquiry_request.*');
        $this->db->join('register', 'register.u_id = hotel_enquiry_request.u_id');
        $this->db->where('hotel_enquiry_request.request_status', 1);
        // $this->db->group_by(array('register.u_id','hotel_enquiry_request.u_id'));
        $this->db->order_by('hotel_enquiry_request.hotel_enquiry_request_id ', 'DESC');
        // echo $this->db->last_query();
        return $this->db->get('hotel_enquiry_request')->result_array();
    }
    public function get_accept_request_list()
    {
        $this->db->select('*');
        $this->db->from('hotel_enquiry_request');
        $this->db->join('register', 'register.u_id = hotel_enquiry_request.u_id');
        // $this->db->join('depa8rtement','departement.department_id  = hotels_panel_list.admin_id');
        $this->db->where('request_status', 1);
        return $this->db->get()->result_array();
    }
    public function get_leads_plan_list()
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('admin_purchase_leads_id ', 'DESC');
        return $this->db->get('admin_purchase_leads')->result_array();
    }
    public function getData($tbl, $wh)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($wh);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ser_guest_hotelwise1($searchon)
    {
        $this->db->select('*');
        $this->db->from('guest_user');
        $this->db->where('is_guest', 1);
        $this->db->like('hotel_id', $searchon,'none');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_customer_citywise($tbl, $where)
    {
        $this->db->select('city');
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->DISTINCT('city');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_cancelll_booking()
    {
        $this->db->select('*');
        $this->db->from('user_hotel_booking');
        $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        $this->db->order_by('user_hotel_booking.booking_id', 'DESC');
        $this->db->where('booking_status', 2);
        return $this->db->get()->result_array();
    }
    public function get_gueest_llist()
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.hotel_name,register.email_id,register.address,guest_user.*');
        $this->db->join('register', 'register.u_id = guest_user.u_id');
        $this->db->where('guest_user.is_guest', 1);
        $this->db->order_by('guest_user.guest_user_id', 'DESC');
        return $this->db->get('guest_user')->result_array();
        // $data = array();
        // $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
        // $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        // $this->db->join('guest_user', 'guest_user.u_id = user_hotel_booking.u_id AND guest_user.hotel_id = user_hotel_booking.hotel_id AND guest_user.booking_id = user_hotel_booking.booking_id');
        // // $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
        // $this->db->where('user_hotel_booking.booking_status', 1);
        // $this->db->where('user_hotel_booking.booking_from', 2);
        // $this->db->order_by('user_hotel_booking.booking_id', 'desc');
        // //$this->db->where('user_hotel_booking.check_out >=',date('Y-m-d'));
        // $Q = $this->db->get('user_hotel_booking');
        // if ($Q->num_rows() > 0) {
        //     foreach ($Q->result_array() as $row) {
        //         $data[] = $row;
        //     }
        // }
        // $Q->free_result();
        // return $data;
    }
    public function get_customer_search_record($city)
    {
        $this->db->where('user_type', 0);
        $this->db->where('city', $city);
        return $this->db->get('register')->result_array();
    }
    public function get_customers()
    {
        $this->db->order_by('u_id', 'DESC');
        $this->db->where('user_type', 0);
        return $this->db->get('register')->result_array();
    }
    public function get_all_bookings()
    {
        $this->db->select('*');
        $this->db->from('user_hotel_booking');
        $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        $this->db->order_by('user_hotel_booking.booking_id', 'DESC');
        $this->db->where('booking_status', 1);
        return $this->db->get()->result_array();
    }
    public function get_all_bookings_pagiantion()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('user_hotel_booking');
        $this->db->order_by('booking_id', 'DESC');
        $this->db->where('booking_status', 1);
        return $this->db->get()->result_array();
    }
    public function getdepartment()
    {
        $this->db->select('*');
        $this->db->from('departement');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getdepartmentedit($wh)
    {
        $this->db->select('*');
        $this->db->from('departement');
        $this->db->where('department_id',$wh);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_city_list()
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('city_id', 'DESC');
        return $this->db->get('city')->result_array();
    }
    public function get_data($tbl)
    {
        $this->db->select('content');
        $this->db->where('tc_form', 0);
        $this->db->from($tbl);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_data_privacy_policy_customers($tbl)
    {
        $this->db->select('content');
        $this->db->where('privacy_policy_for', 1);
        $this->db->from($tbl);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_Terms_Conditions_hotels()
    {
        $this->db->where('tc_form', 1);
        return $this->db->get('terms_condition')->row_array();
    }
    public function get_data_privacy_policy_hotels($tbl)
    {
        $this->db->select('content');
        $this->db->where('privacy_policy_for', 2);
        $this->db->where('added_by', 2);
        $this->db->from($tbl);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_user_list_by_hotels()
    {
        // $this->db->where('hotel_id',$hotel_id);
        $this->db->where('user_type', 0);
        $this->db->where('is_active', 1);
        return $this->db->get('register')->result_array();
    }
    public function get_city_list_by_hotels()
    {
        // $this->db->where('hotel_id',$hotel_id);
        $this->db->where('user_type', 2);
        $this->db->DISTINCT('city');
        return $this->db->get('register')->result_array();
    }

    public function get_notification_list()
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('notification_id ', 'DESC');
        $this->db->from('notifications');
        $this->db->where('send_by', 1);
        // $this->db->where('notification_id', $id);
        return $this->db->get()->result_array();
    }
    public function get_service($where)
    {
        $this->db->join('services_of_department', 'services_of_department.departtment_id  = departement.department_id');
        $this->db->where($where);
        return $this->db->get('departement')->result_array();
    }
    public function getAll_Datadd()
    {
        $this->db->select('*');
        $this->db->from('departement');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert_data($tbl, $arr)
    {
        $this->db->insert($tbl, $arr);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function get_email_data($tbl,$wh)
    {
        $this->db->where($wh);
        return $this->db->get($tbl)->row_array();
    }

    // 05-04-2023
    public function get_cancelll_booking_pagiantion()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('user_hotel_booking');
        $this->db->order_by('booking_id','DESC');  
        $this->db->where('booking_status',2);
        $Q = $this->db->get();
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

    // 06-04-2023
    public function get_user_booking_details($hotel_id,$booking_id)
    {
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('booking_id',$booking_id);
        return $this->db->get('user_hotel_booking')->row_array();
    }
    public function get_user_booking_history($hotel_id,$u_id)
    {
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('u_id',$u_id);
        $this->db->where('booking_status',2);
        return $this->db->get('user_hotel_booking')->result_array();
    }
    public function get_booking_room_details($booking_id)
    {
        $this->db->select('room_type.room_type_name,user_hotel_booking_details.*');
        $this->db->join('room_type','room_type.room_type_id = user_hotel_booking_details.room_type');
        // $this->db->where('user_hotel_booking_details.hotel_id',$hotel_id);
        $this->db->where('user_hotel_booking_details.booking_id',$booking_id);
        return $this->db->get('user_hotel_booking_details')->result_array();
    }
    public function get_user_checkout_booking_data($hotel_id,$booking_id,$u_id)
    {
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('u_id',$u_id);
        $this->db->where('booking_id',$booking_id);
        return $this->db->get('user_checkout_data')->row_array();
    }
    public function get_room_service_minibar($hotel_id)
    {
        $this->db->where('hotel_id',$hotel_id);
        return $this->db->get('room_servs_mini_bar')->result_array();
    } 
    public function get_user_checkout_booking_details($hotel_id,$user_checkout_data_id)
    {
        $this->db->select('date');
        $this->db->distinct();
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('user_checkout_data_id',$user_checkout_data_id);
        return $this->db->get('user_checkout_details')->result_array();
    }
    public function get_user_checkout_booking_details1($hotel_id,$user_checkout_data_id)
    {
        $this->db->select('description');
        $this->db->distinct();
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('user_checkout_data_id',$user_checkout_data_id);
        return $this->db->get('user_checkout_details')->result_array();
    }
    public function get_customer_booking_history($u_id)
    {
        $this->db->select('*');
        $this->db->from('user_hotel_booking');
        // $this->db->join('register','register.u_id = user_hotel_booking.u_id');
        // $this->db->join('depa8rtement','departement.department_id  = hotels_panel_list.admin_id');
        // $this->db->where('user_hotel_booking.u_id',$u_id);
        $this->db->where('u_id',$u_id);
        $this->db->where('booking_status',2);
        return $this->db->get()->result_array();
    }
    public function searchCrud($where)
    {
        $data = array();
        $this->db->select('*');
        //$this->db->from('register');
        $this->db->order_by('u_id','DESC');
        $this->db->where($where);
        $Q = $this->db->get('register');
        if($Q->num_rows() > 0)
        {
            foreach ($Q->result_array() as $row)
            {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $Q->result_array();
    }
    public function getlostdata($tbl,$wh){
        $this->db->select('*');
        $this->db->where('city_id',$wh);
        return $this->db->get('city')->row_array();
    }
    function get_hotel_enquiry_request_pagination()
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('hotel_enquiry_request_id','DESC');
        // $this->db->where('request_status',1);
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

    public function get_request($hotel_id,$request_status)
    {
        $this->db->join('hotel_enquiry_request','hotel_enquiry_request.hotel_id = register.u_id');
        $this->db->where('register.u_id',$hotel_id);
        $this->db->where('hotel_enquiry_request.request_status',$request_status);
        return $this->db->get('register')->result_array();
    }
    public function guest_panel_date_filter($date,$searchon)
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.hotel_name,register.email_id,register.address,guest_user.*');
        $this->db->join('register', 'register.u_id = guest_user.u_id');
        $this->db->where('DATE(guest_user.created_at)',$date);
        $this->db->where('guest_user.hotel_id',$searchon);
        $this->db->where('guest_user.is_guest', 1);
        $this->db->order_by('guest_user.guest_user_id', 'DESC');
        return $this->db->get('guest_user')->result_array();
    }
    public function guest_date_filter($date)
    {
        $this->db->select('*');
        $this->db->from('guest_user');
        $this->db->where('is_guest', 1);
        $this->db->like('created_at', $date);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function active_guest($date,$searchon,$city)
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,register.hotel_name,register.email_id,register.address,guest_user.*');
        $this->db->join('register', 'register.u_id = guest_user.u_id');
        $this->db->where('DATE(guest_user.created_at)',$date);
        $this->db->where('guest_user.hotel_id',$searchon);
        $this->db->where('register.city',$city);
        $this->db->where('guest_user.is_guest', 1);
        $this->db->order_by('guest_user.guest_user_id', 'DESC');
        return $this->db->get('guest_user')->result_array();
    }

    public function guest_panel_all_filter($start_date, $end_date, $searchon, $city)
    {
        $data = array();
        $this->db->select('r1.full_name, r1.mobile_no, r1.guest_type, r1.hotel_name, r1.email_id, r1.address, guest_user.*');
        $this->db->from('guest_user');
        $this->db->join('register AS r1', 'r1.u_id = guest_user.u_id', 'left');
        $this->db->join('register AS r2', 'r2.u_id = guest_user.hotel_id', 'left');
        $this->db->where('guest_user.hotel_id', $searchon);
        $this->db->where('r2.city', $city);
        $this->db->where('guest_user.is_guest', 1);
        $this->db->where("DATE(guest_user.created_at) BETWEEN '$start_date' AND '$end_date'");
        $this->db->order_by('guest_user.guest_user_id', 'DESC');
        return $this->db->get()->result_array();
    }
    public function guest_panel_both_date_filter($start_date, $end_date)
    {
        $data = array();
        $this->db->select('r1.full_name, r1.mobile_no, r1.guest_type, r1.hotel_name, r1.email_id, r1.address, guest_user.*');
        $this->db->from('guest_user');
        $this->db->join('register AS r1', 'r1.u_id = guest_user.u_id', 'left');
        $this->db->where('guest_user.is_guest', 1);
        $this->db->where("DATE(guest_user.created_at) BETWEEN '$start_date' AND '$end_date'");
        $this->db->order_by('guest_user.guest_user_id', 'DESC');
        return $this->db->get()->result_array();
    }
    public function guest_panel_date_hotel_filter($start_date, $end_date, $searchon)
    {
        $data = array();
        $this->db->select('r1.full_name, r1.mobile_no, r1.guest_type, r1.hotel_name, r1.email_id, r1.address, guest_user.*');
        $this->db->from('guest_user');
        $this->db->join('register AS r1', 'r1.u_id = guest_user.u_id', 'left');
        $this->db->where('guest_user.hotel_id', $searchon);
        $this->db->where('guest_user.is_guest', 1);
        $this->db->where("DATE(guest_user.created_at) BETWEEN '$start_date' AND '$end_date'");
        $this->db->order_by('guest_user.guest_user_id', 'DESC');
        return $this->db->get()->result_array();
    }
    public function guest_panel_date_city_filter($start_date, $end_date, $city)
    {  
        $data = array();
        $this->db->select('r1.full_name, r1.mobile_no, r1.guest_type, r1.hotel_name, r1.email_id, r1.address, guest_user.*');
        $this->db->from('guest_user');
        $this->db->join('register AS r1', 'r1.u_id = guest_user.u_id', 'left');
        $this->db->join('register AS r2', 'r2.u_id = guest_user.hotel_id', 'left');
        $this->db->where('r2.city', $city);
        $this->db->where('guest_user.is_guest', 1);
        $this->db->where("DATE(guest_user.created_at) BETWEEN '$start_date' AND '$end_date'");
        $this->db->order_by('guest_user.guest_user_id', 'DESC');
        return $this->db->get()->result_array();
    }


    public function get_customer_all_filter($date,$city)
    {
        $this->db->where('user_type', 0);
        $this->db->where('register_date', $date);
        // $this->db->where('hotel_id', $searchon);
        $this->db->where('city', $city);
        return $this->db->get('register')->result_array();
    }
    public function get_guest_list()
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
        $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        $this->db->join('guest_user', 'guest_user.u_id = user_hotel_booking.u_id AND guest_user.hotel_id = user_hotel_booking.hotel_id AND guest_user.booking_id = user_hotel_booking.booking_id');
        // $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
        $this->db->where('user_hotel_booking.booking_status', 1);
        $this->db->where('user_hotel_booking.booking_from', 1);
        $this->db->order_by('user_hotel_booking.booking_id', 'desc');
        //$this->db->where('user_hotel_booking.check_out >=',date('Y-m-d'));
        $Q = $this->db->get('user_hotel_booking');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    public function web_guest_all_filter($date,$searchon,$city)
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
        $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        $this->db->join('guest_user', 'guest_user.u_id = user_hotel_booking.u_id AND guest_user.hotel_id = user_hotel_booking.hotel_id AND guest_user.booking_id = user_hotel_booking.booking_id');
        // $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
        $this->db->where('user_hotel_booking.booking_status', 1);
        $this->db->order_by('user_hotel_booking.booking_id', 'desc');
        $this->db->where('DATE(guest_user.created_at)',$date);
        $this->db->where('guest_user.hotel_id',$searchon);
        $this->db->where('register.city',$city);
        //$this->db->where('user_hotel_booking.check_out >=',date('Y-m-d'));
        $Q = $this->db->get('user_hotel_booking');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    public function ser_check_en_data($where)
    {
        $this->db->select('*');
        $this->db->from('hotel_enquiry_request');
        $this->db->where($where);
        // $this->db->like('register_date',$date);
        // $this->db->where('request_status',0);
        // $this->db->where('hotel_id',$hotel_name);
        $query =$this->db->get();
        return $query->result_array();
    }
    public function get_guest_via_app_list()
    {
        $data = array();
        $this->db->select('register.full_name,register.mobile_no,register.guest_type,user_hotel_booking.*');
        $this->db->join('register', 'register.u_id = user_hotel_booking.u_id');
        $this->db->join('guest_user', 'guest_user.u_id = user_hotel_booking.u_id AND guest_user.hotel_id = user_hotel_booking.hotel_id AND guest_user.booking_id = user_hotel_booking.booking_id');
        // $this->db->where('user_hotel_booking.hotel_id', $hotel_id);
        $this->db->where('user_hotel_booking.booking_status', 1);
        $this->db->where('user_hotel_booking.booking_from', 2);
        $this->db->order_by('user_hotel_booking.booking_id', 'desc');
        //$this->db->where('user_hotel_booking.check_out >=',date('Y-m-d'));
        $Q = $this->db->get('user_hotel_booking');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    public function get_names_of_specific_type($id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('notifications');
        $this->db->where('send_by', 1);
        $this->db->where('notification_id', $id);
        $this->db->order_by('notification_id ', 'DESC');
        return $this->db->get()->result_array();
    }
    public function getAllDataofcity($tbl)
    {
        return $this->db->get($tbl)->result_array();
    }
}