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
    public function get_room_no_data($hotel_id,$room_no,$todays_date)
    {
      $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_hotel_booking_details.booking_id');
      $this->db->where('user_hotel_booking_details.room_no',$room_no);
      $this->db->where('user_hotel_booking.hotel_id',$hotel_id);
      $this->db->where('user_hotel_booking.check_out >=',$todays_date);
      return $this->db->get('user_hotel_booking_details')->row_array();
    }
    function get_menu_new_order_list_pagination_food_admin($hotel_id,$todays_date)
    {
          $data = array();
          $this->db->select('*');
          $this->db->order_by('food_order_id','DESC');
          $this->db->where('order_status',0);
          $this->db->where('order_date',$todays_date);
          $this->db->where('hotel_id',$hotel_id);
          //$this->db->where('added_by',2);
          
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


   
}