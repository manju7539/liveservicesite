<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FoodAdminModel extends CI_Model {
    function __construct() 
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }

    public function getfileter_wise_Data($hotel_id,$facilities,$categories,$menu_for_1) 
    {
        $data = array();
        $this->db->from('food_menus');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->like('food_facility_id',$facilities);
        $this->db->like('food_category_id',$categories);  
        $this->db->like('menus_for',$menu_for_1);     

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

    public function getAllData1($tbl,$wh)
    {
        $this->db->where($wh);
        return $this->db->get($tbl)->result_array();
    } 

    public function get_room_no_data($hotel_id,$room_no,$todays_date)
    {
        $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_hotel_booking_details.booking_id');
        $this->db->where('user_hotel_booking_details.room_no',$room_no);
        $this->db->where('user_hotel_booking.hotel_id',$hotel_id);
        $this->db->where('user_hotel_booking.booking_status',1);
        $this->db->where('user_hotel_booking.check_out >=',$todays_date);
        return $this->db->get('user_hotel_booking_details')->row_array();
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

    public function get_menu_new_order_list_pagination_food_admin($todays_date,$hotel_id,$id='')
    {
        // $data = array();
        $this->db->select('*');
        // $this->db->order_by('food_order_id','DESC');
        $this->db->where('order_status',0);
        $this->db->where('food_order_id',$id);
        $this->db->where('order_date',$todays_date);
        $this->db->where('hotel_id',$hotel_id);
        $query = $this->db->get('food_orders');
        return $query->result_array();
        // if($Q->num_rows() > 0)
        // {
        //     foreach ($Q->result_array() as $row)
        //     {
        //         $data[] = $row;
        //     }
        // }
        
        // $Q->free_result();

        // return $data;
    }

    function outof_time_food_order($ord_to_15min)
    {
        $this->db->select('food_order_id');
        $this->db->from('food_orders');
        $this->db->order_by('food_order_id','DESC');
        $this->db->where('order_status',0);
        $this->db->where('order_time <=',$ord_to_15min);
        $query = $this->db->get();
        return $query->result_array();
    }

    function outof_time_accepted_food_order($ord_to_15min)
    {
        $this->db->select('food_order_id');
        $this->db->from('food_orders');
        $this->db->order_by('food_order_id','DESC');
        $this->db->where('order_status',1);
        $this->db->where('accept_time <=',$ord_to_15min);
        $query = $this->db->get();
        // echo "<pre>";
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }

    public function getCount_accepted_orders($tbl,$where,$like)
    {
        $this->db->select('count(food_order_id) as total_count');
        $this->db->distinct('hotel_id'); 
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->like('food_facility_id',$like, 'both');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getCount_complete_orders11($tbl,$where,$like)
    {
        $this->db->select('count(food_order_id) as total_count');
        $this->db->distinct('hotel_id'); 
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->like('food_facility_id',$like, 'both');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getCount_pending_orders($tbl,$where,$like)
    {
        $this->db->select('count(food_order_id) as total_count');
        $this->db->distinct('hotel_id'); 
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->like('food_facility_id',$like, 'both');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getCount_reject_orders($tbl,$where,$like)
    {
        $this->db->select('count(food_order_id) as total_count');
        $this->db->distinct('hotel_id'); 
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->like('food_facility_id',$like, 'both');
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_menu_new_order_list_pagination_1( $order_type, $todays_date,$hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('food_order_id','DESC');
        $this->db->where('order_from',$order_type);
        $this->db->where('order_date',$todays_date);
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('order_status',0);
        $this->db->where('added_by',2);
        
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
    function get_accepted_menu_list_pagination_search($order_type)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('food_order_id ','DESC');
        $this->db->where('order_status',1);
        $this->db->where('order_from',$order_type);
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
    function get_completed_menu_list_pagination_search($order_type,$hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('food_order_id ','DESC');
        $this->db->where('order_status',2);
        $this->db->where('order_from',$order_type);
        $this->db->where('hotel_id',$hotel_id);
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
    function get_rejected_menu_list_pagination_search($order_type,$hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('food_order_id ','DESC');
        $this->db->where('order_status',3);
        $this->db->where('order_from',$order_type);
        $this->db->where('hotel_id',$hotel_id);
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
    public function getAllDataFilter($tbl,$wh)
    {
        $this->db->distinct('banquet_hall_id'); 
        $this->db->where($wh);
        return $this->db->get($tbl)->result_array();
    }
    function get_banquet_hall_all_list_pagination_search($hotel_id,$date,$order_sts)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('banquet_hall_orders_id','DESC');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('request_date',$date);
        $this->db->where('request_status',$order_sts);
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
    public function get_banquet_hall_new_list_pagination_search($hotel_id,$hall_name,$date)
    {
        $data = array();
        $this->db->select('*');
        //$this->db->join('banquet_hall','banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
        $this->db->join('banquet_hall','banquet_hall_orders.banquet_hall_id = banquet_hall.banquet_hall_id');
        $this->db->where('banquet_hall_orders.hotel_id',$hotel_id);
        $this->db->where('banquet_hall_orders.banquet_hall_id',$hall_name);
        $this->db->where('banquet_hall_orders.request_date',$date);
        $this->db->where('request_status',0);    
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
    public function get_manageorder_new($hotel_id,$todays_date)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('food_orders');
        
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('order_date',$todays_date);
        $this->db->order_by('food_order_id','DESC');
        $this->db->where('order_status',0);
        $Q = $this->db->get();
        
        //$this->db->join('banquet_hall','banquet_hall.banquet_hall_id = banquet_hall_orders.banquet_hall_id');
       
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
    public function getData($tbl, $wh)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($wh);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function menu_faccility_data($tbl,$hotel_id)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where('hotel_id',$hotel_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllTableData($tbl,$hotel_id)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where('hotel_id',$hotel_id);
        $query = $this->db->get();
        return $query->result_array();
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
    function get_menu_new_order_food_admin($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('food_order_id','DESC');
        $this->db->where('order_status',0);
        $this->db->where('hotel_id',$hotel_id);
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
    function get_total_food_order_count($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('food_order_id','DESC');
        $this->db->where('hotel_id',$hotel_id);
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
   
    public function get_count_of_tbl_req($hotel_id,$today_date)
    {
        $this->db->select('count(reserve_table_id) as total_tb_req');
        $this->db->where('request_status',0);
        $this->db->from('reserve_table');
        $this->db->where('added_by',3);
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('DATE_FORMAT(reserve_date, "%Y-%m-%d")=', $today_date);
        $query = $this->db->get();
        // echo "<pre>";
        // print_r($this->db->last_query());
        // exit;
        return $query->row_array();
    }

    function get_new_reserve_tbl_data($rowperpage,$row,$search,$hotel_id)
    {
        $this->db->order_by('rstb.reserve_table_id','DESC');
        $this->db->limit($rowperpage, $row);
        $this->db->where('rstb.hotel_id',$hotel_id);
        $this->db->where('rstb.request_status',0);
        $this->db->where('rstb.request_date',date('Y-m-d'));
        
        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
            $this->db->like('reg.full_name', $search);
            $this->db->or_where('rstb.floor',$search);
            $this->db->or_where('rstb.room_no',$search);
            $this->db->or_like('register.hotel_name', $search);
            $this->db->or_like('rstb.request_date', $search);
            $this->db->or_like('rstb.reserve_date', $search);
            $this->db->or_like('rstb.no_of_people', $search);
            $this->db->group_end();     
        } 
        $this->db->select('rstb.reserve_table_id,rstb.request_date,rstb.request_time,rstb.no_of_people,rstb.floor,rstb.room_no,rstb.reserve_date,rstb.updated_at,reg.full_name as guest_name,register.hotel_name,uhb.booking_status');
        $this->db->from('reserve_table as rstb');
        $this->db->join('register','register.u_id = rstb.hotel_id');
        $this->db->join('register as reg','reg.u_id = rstb.u_id');
        $this->db->join('user_hotel_booking as uhb','uhb.booking_id = rstb.booking_id');
        $query = $this->db->get();
        // echo "<pre>";
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }

    function total_new_reserve_tbl_data($search='', $hotel_id='')
    {
        $this->db->order_by('rstb.reserve_table_id','DESC');
        $this->db->where('rstb.hotel_id',$hotel_id);
        $this->db->where('rstb.request_status',0);
        $this->db->where('rstb.request_date',date('Y-m-d'));

        if(!empty($search))
        {
                $this->db->group_start(); // Open bracket
                $this->db->like('reg.full_name', $search);
                $this->db->or_where('rstb.floor',$search);
                $this->db->or_where('rstb.room_no',$search);
                $this->db->or_like('register.hotel_name', $search);
                $this->db->or_like('rstb.request_date', $search);
                $this->db->or_like('rstb.reserve_date', $search);
                $this->db->or_like('rstb.no_of_people', $search);
                $this->db->group_end();     
        } 

        $this->db->select('count(rstb.reserve_table_id) as total_record');
        $this->db->from('reserve_table as rstb');
        $this->db->join('register','register.u_id = rstb.hotel_id');
        $this->db->join('register as reg','reg.u_id = rstb.u_id');
        $query = $this->db->get();
        return $query->row();
    }

    function new_Manage_Order_list($rowperpage,$row,$search,$hotel_id)
    {
        $this->db->order_by('fod.food_order_id','DESC');
        $this->db->limit($rowperpage, $row);
        $this->db->where('fod.hotel_id',$hotel_id);
        $this->db->where('fod.order_status',0);
        $this->db->where('fod.order_date',date('Y-m-d'));
        $this->db->where('rns.hotel_id',$hotel_id);
      
        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
            $this->db->like('reg.full_name', $search);
            $this->db->or_like('fod.order_date', $search);
            $this->db->or_where('fod.food_order_id', $search);
            $this->db->or_where('uhbd.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('fod.food_order_id,fod.out_of_time_status,fod.order_date,fod.order_time,fod.order_from,fod.additional_note,reg.full_name,uhbd.room_no,floors.floor,uhb.booking_status');
        $this->db->from('food_orders as fod');
        $this->db->join('register as reg','reg.u_id = fod.u_id');
        $this->db->join('user_hotel_booking as uhb','uhb.booking_id = fod.booking_id');
        $this->db->join('user_hotel_booking_details as uhbd','uhbd.booking_id = uhb.booking_id');
        $this->db->join('room_nos as rns','rns.room_no = uhbd.room_no');
        $this->db->join('room_configure as rcg','rcg.room_configure_id = rns.room_configure_id');
        $this->db->join('floors','floors.floor_id = rcg.floor_id');
        $query = $this->db->get();
        // echo "<pre>";    
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }

    function total_new_Manage_Order_list_data($search='', $hotel_id='')
    {
        $this->db->order_by('fod.food_order_id','DESC');
        $this->db->where('fod.hotel_id',$hotel_id);
        $this->db->where('fod.order_status',0);
        $this->db->where('fod.order_date',date('Y-m-d'));
        $this->db->where('rns.hotel_id',$hotel_id);

        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
            $this->db->like('reg.full_name', $search);
            $this->db->or_like('fod.order_date', $search);
            $this->db->or_where('fod.food_order_id', $search);
            $this->db->or_where('uhbd.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('count(fod.food_order_id) as total_record');
        $this->db->from('food_orders as fod');
        $this->db->join('register as reg','reg.u_id = fod.u_id');
        $this->db->join('user_hotel_booking as uhb','uhb.booking_id = fod.booking_id');
        $this->db->join('user_hotel_booking_details as uhbd','uhbd.booking_id = uhb.booking_id');
        $this->db->join('room_nos as rns','rns.room_no = uhbd.room_no');
        $this->db->join('room_configure as rcg','rcg.room_configure_id = rns.room_configure_id');
        $this->db->join('floors','floors.floor_id = rcg.floor_id');
        $query = $this->db->get();
        // echo "<pre>";    
        // print_r($this->db->last_query());
        // exit;
        return $query->row();
    }

    function accepted_food_Order_list($rowperpage,$row,$search,$hotel_id)
    {
        $this->db->order_by('fod.food_order_id','DESC');
        $this->db->limit($rowperpage, $row);
        $this->db->where('fod.hotel_id',$hotel_id);
        $this->db->where('fod.order_status',1);
        $this->db->where('rns.hotel_id',$hotel_id);
      
        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
            $this->db->like('reg.full_name', $search);
            $this->db->or_like('fod.order_date', $search);
            $this->db->or_where('fod.food_order_id', $search);
            $this->db->or_where('uhbd.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('fod.food_order_id,fod.out_of_time_status,fod.u_id,fod.hotel_id,fod.order_date,fod.order_time,fod.order_from,fod.additional_note,fod.staff_name,fod.staff_id,reg.full_name,uhbd.room_no,floors.floor');
        $this->db->from('food_orders as fod');
        $this->db->join('register as reg','reg.u_id = fod.u_id');
        $this->db->join('user_hotel_booking as uhb','uhb.booking_id = fod.booking_id');
        $this->db->join('user_hotel_booking_details as uhbd','uhbd.booking_id = uhb.booking_id');
        $this->db->join('room_nos as rns','rns.room_no = uhbd.room_no');
        $this->db->join('room_configure as rcg','rcg.room_configure_id = rns.room_configure_id');
        $this->db->join('floors','floors.floor_id = rcg.floor_id');
        $query = $this->db->get();
        // echo "<pre>";    
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }

    function total_accepted_food_list_data($search='', $hotel_id='')
    {
        $this->db->order_by('fod.food_order_id','DESC');
        $this->db->where('fod.hotel_id',$hotel_id);
        $this->db->where('fod.order_status',1);
        $this->db->where('rns.hotel_id',$hotel_id);

        if(!empty($search))
        {
            $this->db->group_start(); // Open bracket
            $this->db->like('reg.full_name', $search);
            $this->db->or_like('fod.order_date', $search);
            $this->db->or_where('fod.food_order_id', $search);
            $this->db->or_where('uhbd.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('count(fod.food_order_id) as total_record');
        $this->db->from('food_orders as fod');
        $this->db->join('register as reg','reg.u_id = fod.u_id');
        $this->db->join('user_hotel_booking as uhb','uhb.booking_id = fod.booking_id');
        $this->db->join('user_hotel_booking_details as uhbd','uhbd.booking_id = uhb.booking_id');
        $this->db->join('room_nos as rns','rns.room_no = uhbd.room_no');
        $this->db->join('room_configure as rcg','rcg.room_configure_id = rns.room_configure_id');
        $this->db->join('floors','floors.floor_id = rcg.floor_id');
        $query = $this->db->get();
        // echo "<pre>";    
        // print_r($this->db->last_query());
        // exit;
        return $query->row();
    }

    public function check_exist_cat_name($hotel_id,$food_facility_id,$cat_name)
    {
        $this->db->select('count(food_category_id) as row_count');
        $this->db->from('food_category');
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('food_facility_id',$food_facility_id);
        $this->db->where('category_name',$cat_name);
        $query = $this->db->get();
        return $query->row();
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

    public function get_food_service_request($hotel_id,$today_date)
    {
        $data = array();
        $this->db->select('*');
        $this->db->order_by('service_request_id ', 'DESC');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('send_to', 4);
        $this->db->where('request_status', 0);
        $this->db->where('DATE(service_request.created_at)',$today_date);
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
    public function insert_data($tbl, $arr)
  {
    $this->db->insert($tbl, $arr);
    return $this->db->insert_id();
  }
  function get_staff_list_pagination($hotel_id,$todays_date)
  {
       $data = array();
       $this->db->select('*');
      
       $this->db->order_by('staff_handover_id','DESC');
       $this->db->where('is_complete',0);
       $this->db->where('date',$todays_date);
       $this->db->where('added_by',4);
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
  function get_completed_staff_list_pagination($hotel_id)
  {
       $data = array();
       $this->db->select('*');
      
       $this->db->order_by('staff_handover_id','DESC');
       $this->db->where('is_complete',1);
       $this->db->where('added_by',4);
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
  public function getdatareassign($tbl,$wh){
    $this->db->select('*');
    $this->db->where('staff_handover_id',$wh);
    return $this->db->get('handover_staff')->row_array();
}
public function edit_data_assign_handover($tbl,$arr,$wh1)
{
    $this->db->where($wh1);
    if($this->db->update($tbl,$arr))
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
    return TRUE;
  } else {
    return FALSE;
  }
}
public function get_data_service($tbl, $wh)
{
  $this->db->select('*');
  $this->db->where('service_request_id', $wh);
  return $this->db->get('service_request')->row_array();
}
public function get_accepted_service_request($hotel_id)
{
  $data = array();
  $this->db->select('*');
  $this->db->order_by('service_request_id', 'DESC');
  $this->db->where('hotel_id', $hotel_id);
  $this->db->where('send_to =', 4);
  $this->db->where('request_status', 1);
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
    $this->db->order_by('service_request_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('send_to =', 4);
    $this->db->where('request_status', 2);
    $Q = $this->db->get('service_request');
    if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $Q->free_result();

    return $data;
  }
  function redirect_completed_menu_list_pagination($hotel_id, $food_facility_id)
{
    $data = array();
    $this->db->distinct();
    $this->db->select('food_orders.*'); // Select all columns from food_orders
    $this->db->from('food_orders');
    $this->db->join('food_order_details', 'food_orders.food_order_id = food_order_details.food_order_id');
    $this->db->join('food_menus', 'food_order_details.food_items_id = food_menus.food_item_id');
    $this->db->join('food_facility', 'food_menus.food_facility_id = food_facility.food_facility_id');
    $this->db->where('food_orders.order_status', 2);
    $this->db->where('food_orders.hotel_id', $hotel_id);
    $this->db->like('food_orders.food_facility_id', $food_facility_id, 'both');
    $this->db->order_by('food_orders.food_order_id', 'DESC');
    $Q = $this->db->get();

    if ($Q->num_rows() > 0) {
        foreach ($Q->result_array() as $row) {
            $data[] = $row;
        }
    }

    $Q->free_result();

    return $data;
}
function redirect_rejected_menu_list_pagination($hotel_id, $food_facility_id)
{
    $data = array();
    $this->db->distinct();
    $this->db->select('food_orders.*'); // Select all columns from food_orders
    $this->db->from('food_orders');
    $this->db->join('food_order_details', 'food_orders.food_order_id = food_order_details.food_order_id');
    $this->db->join('food_menus', 'food_order_details.food_items_id = food_menus.food_item_id');
    $this->db->join('food_facility', 'food_menus.food_facility_id = food_facility.food_facility_id');
    $this->db->where('food_orders.order_status', 3);
    $this->db->where('food_orders.hotel_id', $hotel_id);
    $this->db->like('food_orders.food_facility_id', $food_facility_id, 'both');
    $this->db->order_by('food_orders.food_order_id', 'DESC');
    $Q = $this->db->get();

    if ($Q->num_rows() > 0) {
        foreach ($Q->result_array() as $row) {
            $data[] = $row;
        }
    }

    $Q->free_result();

    return $data;
}
function redirect_menu_new_order_list_pagination_food_admin($todays_date,$hotel_id,$food_facility_id)
{
    $data = array();
    $this->db->distinct();
    $this->db->select('food_orders.*'); // Select all columns from food_orders
    $this->db->from('food_orders');
    $this->db->join('food_order_details', 'food_orders.food_order_id = food_order_details.food_order_id');
    $this->db->join('food_menus', 'food_order_details.food_items_id = food_menus.food_item_id');
    $this->db->join('food_facility', 'food_menus.food_facility_id = food_facility.food_facility_id');
    $this->db->where('food_orders.order_status', 0);
    $this->db->where('food_orders.hotel_id', $hotel_id);
    $this->db->where('food_orders.order_date',$todays_date);
    $this->db->like('food_orders.food_facility_id', $food_facility_id, 'both');
    $this->db->order_by('food_orders.food_order_id', 'DESC');
    $Q = $this->db->get();

    if ($Q->num_rows() > 0) {
        foreach ($Q->result_array() as $row) {
            $data[] = $row;
        }
    }

    $Q->free_result();

    return $data;
}

     
}