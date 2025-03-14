<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoomserviceModel extends CI_Model {
    function __construct() 
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }

    function get_new_order_list($todays_date,$hotel_id)
    {
        // print_r($todays_date);exit;
        $data = array();
        $this->db->select('*');
        $this->db->order_by('room_service_menu_order_id','DESC');
        $this->db->where('order_status',0);
        $this->db->where('order_from',3);
        $this->db->where('order_total !=',0);
        $this->db->where('order_date',$todays_date);
        $this->db->where('hotel_id',$hotel_id);
        $Q = $this->db->get('room_service_menu_orders');
        // echo "<pre>";
        // print_r($this->db->last_query());
        // exit;

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

    function getAllData($todays_date,$hotel_id)
    {
        // print_r($todays_date);exit;
        $data = array();
        $this->db->select('*');
        $this->db->order_by('room_service_menu_order_id','DESC');
        $this->db->where('order_status',0);
        $this->db->where('order_from',3);
        $this->db->where('order_date',$todays_date);
        $this->db->where('hotel_id',$hotel_id);

        $this->db->get('room_service_menu_orders')->row_array();
        
    }

    public function getData($tbl,$wh)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($wh);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getAllData1($tbl,$wh)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($wh);
        $query = $this->db->get();
        return $query->result_array();
    } 

    public function insert_data($tbl,$arr)
    {
        $this->db->insert($tbl,$arr);
        $insert_id=$this->db->insert_id();
        // echo "<pre>";
        // print_r($this->db->last_query());
        // exit;
        return $insert_id;
    }

    public function get_oncall_list($hotel_id,$order_type, $todays_date)
    {
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('order_from',$order_type);
        $this->db->where('order_date',$todays_date);
        $this->db->where('order_status',0);
        $this->db->where('added_by',2);
        return $this->db->get('room_service_menu_orders')->result_array();
    }

        public function get_room_no_data($hotel_id,$room_no,$todays_date)
        {
            //   print_r($todays_date);exit;
            $this->db->from('user_hotel_booking_details');
            $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_hotel_booking_details.booking_id');
            $this->db->where('user_hotel_booking_details.room_no',$room_no);
            $this->db->where('user_hotel_booking.hotel_id',$hotel_id);
            $this->db->where('user_hotel_booking.check_out >=',$todays_date);
            //   print_r($this->db->where('user_hotel_booking.check_out >=',$todays_date));exit;
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->row_array();
       }
        function get_all_accepted_orders_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('room_service_menu_order_id','DESC');
            $this->db->where('order_status',1);
            $this->db->where('hotel_id',$hotel_id); 
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
        function get_service_completed_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('room_service_menu_order_id','DESC');
            $this->db->where('order_status',2);
            $this->db->where('hotel_id',$hotel_id);
            
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
        function get_service_rejected_list_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('room_service_menu_order_id','DESC');
            $this->db->where('order_status',3);
            $this->db->where('hotel_id',$hotel_id);
            
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
        
        function service_completed_list_pagination($hotel_id,$click_on_room_number='')
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('rmservice_services_order_id','DESC');
            $this->db->where('order_status',2);
            $this->db->where('hotel_id',$hotel_id); 
            if($click_on_room_number != '')
            {
                $this->db->where('room_no',$click_on_room_number);
            }

            
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
        function get_default_menu_list_data($hotel_id,$selected_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('room_serv_menu_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_serv_cat_id',$selected_id);
            // echo $this->db->last_query();
            return $this->db->get('room_serv_menu_list')->result_array();
        }

        function get_selected_menu_list_data($hotel_id,$category_id)
        {
            $this->db->select('*');
            $this->db->order_by('room_serv_menu_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_serv_cat_id',$category_id);
            // echo $this->db->last_query();
            return $this->db->get('room_serv_menu_list')->result_array();
        }

        function get_edit_menu_list_data($hotel_id,$id)
        {
            $this->db->select('*');
            $this->db->order_by('room_serv_menu_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_serv_menu_id',$id);
            // echo $this->db->last_query();
            return $this->db->get('room_serv_menu_list')->result_array();
        }
        
        function get_categories($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('room_servs_category_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $Q = $this->db->get('room_servs_category');

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
        
        public function get_data_categories($hotel_id)
        {
            $this->db->select('*');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->from('room_servs_category');
            $query = $this->db->get();
            return $query->result_array();
        }
        function get_menu_list_data($hotel_id)
        {   
           
            $data = array();
            $this->db->select('*');
            $this->db->order_by('room_serv_menu_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_serv_cat_id',1);
            return $this->db->get('room_serv_menu_list')->result_array();  
        }

        function get_menu_list_daynamic_data($hotel_id,$room_serv_cat_id)
        {   
           
            $data = array();
            $this->db->select('*');
            $this->db->order_by('room_serv_menu_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_serv_cat_id',$room_serv_cat_id);
            return $this->db->get('room_serv_menu_list')->result_array();  
        }

        function get_menu_edit_list_data($hotel_id,$cat_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('room_serv_menu_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_serv_cat_id',$cat_id);
            return $this->db->get('room_serv_menu_list')->result_array();  
        }

        function get_service_new_list_pagination($where)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('rmservice_services_order_id ','DESC');
            $this->db->where($where);
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

        function get_first_menu_list($rowperpage, $row, $search,$columnName,$hotel_id,$selected_id)
        {
            $this->db->order_by('room_serv_menu_id','DESC');
            $this->db->limit($rowperpage, $row);
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_serv_cat_id',$selected_id);

            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('menu_name', $search);
                $this->db->or_where('price', $search);
                $this->db->or_where('prepartion_time', $search);
                $this->db->or_like('details', $search);
            $this->db->group_end();     
            } 
            // $this->db->group_by('rso.rmservice_services_order_id'); 
            
            $this->db->select('*');
            $this->db->from('room_serv_menu_list');
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->result_array();
        }

        function getTotal_first_menu_list($search, $hotel_id,$selected_id)
        {
            $this->db->order_by('room_serv_menu_id','DESC');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_serv_cat_id',$selected_id);

            if(!empty($search)){
                $this->db->group_start(); // Open bracket
                    $this->db->like('menu_name', $search);
                    $this->db->or_where('price', $search);
                    $this->db->or_where('prepartion_time', $search);
                    $this->db->or_like('details', $search);
                $this->db->group_end();     
            } 

            $this->db->select('count(room_serv_menu_id) as total_record');
            $this->db->from('room_serv_menu_list');
            $query = $this->db->get();
            return $query->row();
        }

        function get_neworderfrom_room_Data($rowperpage, $row, $search,$columnName,$hotel_id,$todays_date)
        {
            $this->db->order_by('rsmo.room_service_menu_order_id','DESC');
            $this->db->limit($rowperpage, $row);
            $this->db->where('rsmo.order_status',0);
            $this->db->where('rsmo.order_date',$todays_date);
            $this->db->where('rsmo.hotel_id',$hotel_id);

            // if(!empty($search)){
            // $this->db->group_start(); // Open bracket
            //     $this->db->like('rso.date', $search);
            //     $this->db->or_where('reg.full_name', $search);
            //     $this->db->or_where('rso.time', $search);
            // $this->db->group_end();     
            // } 
            // $this->db->group_by('rso.rmservice_services_order_id'); 
            
            $this->db->select('*');
            $this->db->from('rmservice_services_orders as rsmo');
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->result_array();
        }

        function getTotal_neworderfrom_room($search, $hotel_id,$todays_date)
        {
            $this->db->order_by('rsmo.room_service_menu_order_id','DESC');
            $this->db->where('rsmo.order_status',0);
            $this->db->where('rsmo.order_date',$todays_date);
            $this->db->where('rsmo.hotel_id',$hotel_id);

            // if(!empty($search)){
            // $this->db->group_start(); // Open bracket
            //     $this->db->like('rso.order_date', $search);
            //     $this->db->or_where('rso.rmservice_services_order_id', $search);
            //     $this->db->or_where('reg.full_name', $search);
            //     $this->db->or_where('staff.full_name', $search);
            //     $this->db->or_where('rso.time', $search);
            //     $this->db->like('uhb.room_no', $search);
            //     $this->db->like('floors.floor', $search);
            //     $this->db->like('reg.mobile_no', $search);
            // $this->db->group_end();     
            // } 

            $this->db->select('count(rsmo.room_service_menu_order_id) as total_record');
            $this->db->from('rmservice_services_orders as rsmo');
            $query = $this->db->get();
            return $query->row();
        }

        function get_accepted_order_data($rowperpage, $row, $search,$columnName,$hotel_id)
        {
            $this->db->order_by('rso.rmservice_services_order_id','DESC');
            $this->db->limit($rowperpage, $row);
            $this->db->where('rso.hotel_id',$hotel_id);
            $this->db->where('rso.order_status',1);

            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('rso.date', $search);
                $this->db->or_where('reg.full_name', $search);
                $this->db->or_where('rso.time', $search);
            $this->db->group_end();     
            } 
            // $this->db->group_by('rso.rmservice_services_order_id'); 
            
            $this->db->select('DISTINCT(rso.rmservice_services_order_id),rso.rmservice_services_order_id,rso.order_date,rso.order_from,rso.order_status,reg.full_name,reg.guest_type,reg.mobile_no,staff.full_name as staff_name,uhb.room_no,floors.floor');
            $this->db->from('rmservice_services_orders as rso');
            $this->db->join('register as reg', 'reg.u_id = rso.u_id','left');
            $this->db->join('register as staff', 'staff.u_id = rso.staff_id','left');
            $this->db->join('user_hotel_booking_details as uhb', 'uhb.booking_id = rso.booking_id','left');
            $this->db->join('room_nos as rnu', 'rnu.room_no = uhb.room_no','left');
            $this->db->join('room_configure as rcon', 'rcon.room_configure_id = rnu.room_configure_id','left');
            $this->db->join('floors', 'floors.floor_id = rcon.floor_id','left');
            $query = $this->db->get();
            return $query->result_array();
        }

        function get_total_accepted_order($search='', $hotel_id='')
        {
            $this->db->order_by('rso.rmservice_services_order_id','DESC');
            $this->db->where('rso.hotel_id',$hotel_id);
            $this->db->where('rso.order_status',1);

            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('rso.order_date', $search);
                $this->db->or_where('rso.rmservice_services_order_id', $search);
                $this->db->or_where('reg.full_name', $search);
                $this->db->or_where('staff.full_name', $search);
                $this->db->or_where('rso.time', $search);
                $this->db->like('uhb.room_no', $search);
                $this->db->like('floors.floor', $search);
                $this->db->like('reg.mobile_no', $search);
            $this->db->group_end();     
            } 

            $this->db->select('count(DISTINCT(rso.rmservice_services_order_id)) as total_record');
            $this->db->from('rmservice_services_orders as rso');
            $this->db->join('register as reg', 'reg.u_id = rso.u_id','left');
            $this->db->join('register as staff', 'staff.u_id = rso.staff_id','left');
            $this->db->join('user_hotel_booking_details as uhb', 'uhb.booking_id = rso.booking_id','left');
            $this->db->join('room_nos as rnu', 'rnu.room_no = uhb.room_no','left');
            $this->db->join('room_configure as rcon', 'rcon.room_configure_id = rnu.room_configure_id','left');
            $this->db->join('floors', 'floors.floor_id = rcon.floor_id','left');
            $query = $this->db->get();
            return $query->row();
        }

        function get_service_new_orders($todays_date,$hotel_id,$click_on_room_number='')
        {
            $this->db->select('*');
            $this->db->order_by('rmservice_services_order_id','DESC');
            $this->db->from('rmservice_services_orders');
            $this->db->where('order_date',$todays_date); 
            $this->db->where('order_status',0); 
            $this->db->where('order_from',3); 
            $this->db->where('hotel_id',$hotel_id); 
            if(!empty($click_on_room_number))
            {
                $this->db->where('room_no',$click_on_room_number); 
            }
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->result_array();
        }

        function get_service_accepted_orders($hotel_id,$click_on_room_number='')
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('rmservice_services_order_id','DESC');
            $this->db->where('order_status',1);
            $this->db->where('hotel_id',$hotel_id); 
            if($click_on_room_number != '')
            {
                $this->db->where('room_no',$click_on_room_number);
            }
            // $this->db->where('order_from',$order_type); 
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

        //completed order search in room service
        function get_service_list_pagination_1($order_type)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('rmservice_services_order_id','DESC');
            $this->db->where('order_status',2);
            $this->db->where('order_from',$order_type);
            
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

        function get_Service_rejected_pagination($hotel_id,$click_on_room_number='')
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('rmservice_services_order_id ','DESC');
            $this->db->where('order_status',3);
            $this->db->where('hotel_id',$hotel_id); 
            if($click_on_room_number != '')
            {
                $this->db->where('room_no',$click_on_room_number);
            }

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
        public function check_image($tbl,$where1)
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

        public function get_services_data_edit($hotel_id,$id)
        {
            $this->db->select('*');
            $this->db->from('room_servs_services');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('r_s_services_id',$id);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_category_edit_data($hotel_id,$id)
        {
            $this->db->select('*');
            $this->db->from('room_servs_category');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_servs_category_id',$id);
            $query = $this->db->get();
            return $query->result_array();
        }
        function get_service_management_Data($rowperpage, $row, $search,$columnName,$hotel_id)
        {
            $this->db->order_by('rss.r_s_services_id','DESC');
            $this->db->limit($rowperpage, $row);
            $this->db->where('rss.hotel_id',$hotel_id);

            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('rss.service_name', $search);
                $this->db->or_where('rss.r_s_services_id', $search);
                $this->db->or_like('rss.amount', $search);
            $this->db->group_end();     
            } 
            
            $this->db->select('rss.service_name,rss.icon_img,rss.amount,rss.r_s_services_id');
            $this->db->from('room_servs_services as rss');
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->result_array();
        }

        function getTotalservice_management($search='', $hotel_id='')
        {
            $this->db->order_by('rss.r_s_services_id','DESC');
            $this->db->where('rss.hotel_id',$hotel_id);

            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('rss.service_name', $search);
                $this->db->or_where('rss.r_s_services_id', $search);
                $this->db->or_like('rss.amount', $search);
            $this->db->group_end();     
            } 
            
            $this->db->select('count(*) as total_record');
            $this->db->from('room_servs_services as rss');
            $query = $this->db->get();
            return $query->row();
        }

        function get_services($hotel_id)
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
        function get_minibar_data($hotel_id)
        {
            $this->db->select('*');
            $this->db->from('room_servs_mini_bar');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('added_by',2);
            $this->db->order_by('r_s_min_bar_id  ','DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        function get_edit_minibar_model_data($hotel_id,$id)
        {
            $this->db->select('*');
            $this->db->from('room_servs_mini_bar');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('r_s_min_bar_id',$id);
            $this->db->order_by('r_s_min_bar_id  ','DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        function get_staff_manage_edit_data($hotel_id,$id)
        {
            $this->db->select('*');
            $this->db->from('register');
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('user_type',10);
            $this->db->where('user_is',2);
            $this->db->where('u_id',$id);
            $query = $this->db->get();
            return $query->result_array();
        }

        function get_pending_handover_modal_list($hotel_id,$id)
        {
            $data = array();
             $this->db->select('*');
             $this->db->from('handover_manger');
             $this->db->order_by('m_handover_id','DESC');
             $this->db->where('m_handover_id',$id);
             $this->db->where('is_complete',0);
             $this->db->where('added_by',3);
             $this->db->where('hotel_id',$hotel_id);
             $query = $this->db->get();
            return $query->result_array();
        }

        function get_Mcompleted_handover_modal_list($hotel_id,$id)
        {
            $this->db->select('hm.date,hm.time,hm.description');
            $this->db->from('handover_manger as hm');
            $this->db->order_by('m_handover_id','DESC');
            $this->db->where('m_handover_id',$id);
            $this->db->where('is_complete',1);
            $this->db->where('added_by',3);
            $this->db->where('hotel_id',$hotel_id);
            $query = $this->db->get();
           return $query->result_array();
        }

        function get_staff_list($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('u_id','DESC');
            $this->db->where('user_type',10);
            $this->db->where('user_is',2);
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
        function get_user_review_pagination($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('review_id','DESC');
            $this->db->where('review_for',3);
            $this->db->where('hotel_id',$hotel_id);
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

        function get_review_page_Data($rowperpage, $row, $search,$columnName,$hotel_id)
        {
            $this->db->order_by('rew.review_id','DESC');
            $this->db->limit($rowperpage, $row);
            $this->db->where('rew.review_for',3);
            $this->db->where('rew.hotel_id',$hotel_id);

            // if(!empty($search)){
            // $this->db->group_start(); // Open bracket
            //     $this->db->like('rss.service_name', $search);
            //     $this->db->or_where('rew.r_s_services_id', $search);
            //     $this->db->or_where('rew.amount', $search);
            // $this->db->group_end();     
            // } 
            
            $this->db->select('rew.review_id,rew.rating_time,rew.rating_date,rew.rating,rew.review,reg.full_name as gest_name');
            $this->db->from('review as rew');
            $this->db->join('register as reg', 'reg.u_id = rew.u_id','left');
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->result_array();
        }

        function getTotal_review_page_Data($search='', $hotel_id='')
        {
            $this->db->order_by('rew.review_id','DESC');
            $this->db->where('rew.review_for',3);
            $this->db->where('rew.hotel_id',$hotel_id);

            // if(!empty($search)){
            // $this->db->group_start(); // Open bracket
            //     $this->db->like('rss.service_name', $search);
            //     $this->db->or_where('rss.r_s_services_id', $search);
            //     $this->db->or_where('rss.amount', $search);
            // $this->db->group_end();     
            // } 
            
            $this->db->select('count(*) as total_record');
            $this->db->from('review as rew');
            $this->db->join('register as reg', 'reg.u_id = rew.u_id','left');
            $query = $this->db->get();
            return $query->row();
        }

        function get_pending_handover_list($hotel_id)
        {
             $data = array();
             $this->db->select('*');
             $this->db->order_by('m_handover_id','DESC');
             $this->db->where('is_complete',0);
             $this->db->where('added_by',3);
             $this->db->where('hotel_id',$hotel_id);
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

        public function get_completedhendover_completd_Data($hotel_id)
        {
            $this->db->order_by('hdm.m_handover_id','DESC');
            $this->db->where('hdm.hotel_id',$hotel_id);
            $this->db->where('hdm.is_complete',1);
            $this->db->where('hdm.added_by',3);
            $this->db->select('hdm.m_handover_id,register.full_name AS completed_By');
            $this->db->from('handover_manger as hdm');
            $this->db->join('register', 'register.u_id = hdm.completed_manger_id','left');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_pendinghendover_Data($rowperpage, $row, $search,$columnName,$hotel_id)
        {
            $this->db->order_by('hdm.m_handover_id','DESC');
            $this->db->limit($rowperpage, $row);
            $this->db->where('hdm.hotel_id',$hotel_id);
            $this->db->where('hdm.is_complete',0);
            $this->db->where('hdm.added_by',3);

            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('hdm.date', $search);
                $this->db->or_where('register.full_name', $search);
                $this->db->or_where('hdm.time', $search);
            $this->db->group_end();     
            } 
            
            $this->db->select('hdm.*,register.full_name');
            $this->db->from('handover_manger as hdm');
            $this->db->join('register', 'register.u_id = hdm.create_manager_id','left');
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->result_array();
        }

        public function getTotalpendinghanover($search='', $hotel_id='')
        {
            $this->db->where('hdm.hotel_id',$hotel_id);
            $this->db->where('hdm.is_complete',0);
            $this->db->where('hdm.added_by',3);

            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('hdm.date', $search);
                $this->db->or_where('register.full_name', $search);
                $this->db->or_where('hdm.time', $search);
            $this->db->group_end();     
            } 

            $this->db->select('count(*) as total_record');
            $this->db->from('handover_manger as hdm');
            $this->db->join('register', 'register.u_id = hdm.create_manager_id','left');
            $query = $this->db->get();
            return $query->row();
        }

        public function staff_pending_hendover_Data($rowperpage, $row, $search,$columnName,$hotel_id)
        {
            $this->db->order_by('staff_handover_id ','DESC');
            $this->db->limit($rowperpage, $row);
            $this->db->where('hns.is_complete',0);
            $this->db->where('hns.added_by',3);
            $this->db->where('hns.hotel_id',$hotel_id);
            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('hns.created_at', $search);
                $this->db->or_where('reg.full_name', $search);
            $this->db->group_end();     
            } 
            
            $this->db->select('hns.staff_handover_id,hns.created_at,reg.full_name,hns.description');
            $this->db->from('handover_staff as hns');
            $this->db->join('register as reg', 'reg.u_id = hns.create_staff_id','left');
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->result_array();
        }

        public function getTotalstaff_pending_hendover($search='', $hotel_id='')
        {
            $this->db->where('hns.is_complete',0);
            $this->db->where('hns.added_by',3);
            $this->db->where('hns.hotel_id',$hotel_id);
            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('hns.created_at', $search);
                $this->db->or_where('reg.full_name', $search);
            $this->db->group_end();     
            } 
            
            $this->db->select('count(*) as total_record');
            $this->db->from('handover_staff as hns');
            $this->db->join('register as reg', 'reg.u_id = hns.create_staff_id','left');
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->row();
        }

        public function get_staff_completedhendover($hotel_id)
        {
            $this->db->order_by('hns.staff_handover_id','DESC');
            $this->db->where('hns.is_complete',1);
            $this->db->where('hns.added_by',3);
            $this->db->where('hns.hotel_id',$hotel_id);
            $this->db->select('hns.staff_handover_id,reg.full_name as completed_By');
            $this->db->from('handover_staff as hns');
            $this->db->join('register as reg', 'reg.u_id = hns.completed_staff_id','left');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function staff_completed_hendover_Data($rowperpage, $row, $search,$columnName,$hotel_id)
        {
            $this->db->limit($rowperpage, $row);
            $this->db->where('hns.is_complete',1);
            $this->db->where('hns.added_by',3);
            $this->db->where('hns.hotel_id',$hotel_id);
            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('hns.created_at', $search);
                $this->db->or_where('reg.full_name', $search);
            $this->db->group_end();     
            } 
            $this->db->select('hns.*,reg.full_name');
            $this->db->from('handover_staff as hns');
            $this->db->join('register as reg', 'reg.u_id = hns.create_staff_id','left');
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->result_array();
        }
        
        public function getTotalstaff_completed_hendover($search='', $hotel_id='')
        {
            $this->db->where('hns.is_complete',1);
            $this->db->where('hns.added_by',3);
            $this->db->where('hns.hotel_id',$hotel_id);
            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('hns.created_at', $search);
                $this->db->or_where('reg.full_name', $search);
            $this->db->group_end();     
            } 
            
            $this->db->select('count(*) as total_record');
            $this->db->from('handover_staff as hns');
            $this->db->join('register as reg', 'reg.u_id = hns.create_staff_id','left');
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->row();
        }

        public function menu_accepted_ord($u_id)
        {
            $this->db->select('*');
            $this->db->from('room_service_menu_orders');
            $this->db->order_by('room_service_menu_order_id ','DESC');
            $this->db->where('order_status',1);
            $this->db->where('staff_id',$u_id);   
            $query = $this->db->get();
            return $query->result_array();
        }

        public function menu_copleted_ord($u_id)
        {
            $this->db->select('*');
            $this->db->from('room_service_menu_orders');
            $this->db->order_by('room_service_menu_order_id ','DESC');
            $this->db->where('order_status',2);
            $this->db->where('staff_id',$u_id);  
            $query = $this->db->get();
            return $query->result_array();
        }

        public function service_accepted_ord($u_id)
        {
            $this->db->select('*');
            $this->db->from('rmservice_services_orders');
            $this->db->order_by('rmservice_services_order_id ','DESC');
            $this->db->where('order_status',1);
            $this->db->where('staff_id',$u_id);  
            $query = $this->db->get();
            return $query->result_array();
        }
        
        public function service_copleted_ord($u_id)
        {
            $this->db->select('*');
            $this->db->from('rmservice_services_orders');
            $this->db->order_by('rmservice_services_order_id','DESC');
            $this->db->where('order_status',2);
            $this->db->where('staff_id',$u_id);  
            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_completedhendover_Data($rowperpage, $row, $search,$columnName,$hotel_id)
        {
            // if(!empty($columnName)){
            //     $this->db->order_by($columnName, $columnSortOrder);
            // }
            $this->db->order_by('hdm.m_handover_id','DESC');
            $this->db->limit($rowperpage, $row);
            $this->db->where('hdm.hotel_id',$hotel_id);
            $this->db->where('hdm.is_complete',1);
            $this->db->where('hdm.added_by',3);

            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('hdm.date', $search);
                $this->db->or_where('register.full_name', $search);
                $this->db->or_where('hdm.time', $search);
            $this->db->group_end();     
            } 
            
            $this->db->select('hdm.*,register.full_name');
            $this->db->from('handover_manger as hdm');
            $this->db->join('register', 'register.u_id = hdm.create_manager_id','left');
            // $this->db->join('register', 'hdm.create_manager_id = register.u_id OR hdm.completed_manger_id = register.u_id', 'left');
            // $this->db->group_by('hdm.m_handover_id');
            $query = $this->db->get();
            // echo "<pre>";
            // print_r($this->db->last_query());
            // exit;
            return $query->result_array();
        }

        public function getTotalcompletedhanover($search='', $hotel_id='')
        {
            $this->db->where('hdm.hotel_id',$hotel_id);
            $this->db->where('hdm.is_complete',1);
            $this->db->where('hdm.added_by',3);
            // if(!empty($ch_status) AND $ch_status == 'yes'){
            //     $current_date = date('Y-m-d', time());
            //     $this->db->where('DATE_FORMAT(ch.evidence_due_by, "%Y-%m-%d") >= ', $current_date);   
            // }
            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                $this->db->like('hdm.date', $search);
                $this->db->or_where('register.full_name', $search);
                $this->db->or_where('hdm.time', $search);
            $this->db->group_end();     
            } 
            $this->db->select('count(*) as total_record');
            $this->db->from('handover_manger as hdm');
            $this->db->join('register', 'register.u_id = hdm.completed_manger_id','left');
            $query = $this->db->get();
            return $query->row();
        }

        public function getHandover_staff($tbl,$wh)
        {
            $this->db->where($wh);
              $this->db->distinct('create_manager_id'); 
            return $this->db->get($tbl)->result_array();
        }
        function get_completed_handover_list_pagination($hotel_id)
        {
             $data = array();
             $this->db->select('*');
             $this->db->order_by('m_handover_id','DESC');
             $this->db->where('is_complete',1);
             $this->db->where('added_by',3);
             $this->db->where('hotel_id',$hotel_id);
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
        function get_staff_handover_list_pagination($hotel_id)
        {
             $data = array();
             $this->db->select('*');
             $this->db->order_by('staff_handover_id','DESC');
             $this->db->where('is_complete',0);
             $this->db->where('added_by',3);
             $this->db->where('hotel_id',$hotel_id);
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

        public function deleteData($tbl, $where)
        {
            $this->db->where($where);
            if ($this->db->delete($tbl)) {
                return TRUE;
            } else {
                return FALSE;
                }
        }
}