<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class HouseKeepingModel extends CI_Model 
    {
        public function getData($tbl,$where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->where($where);
            $query = $this->db->get();
            return $query->row_array();
        } 

        function get_new_order_list_pagination_1($order_type, $todays_date,$hotel_id)
          {
              $data = array();
              $this->db->select('*');
             
              $this->db->order_by('h_k_order_id','DESC');
              $this->db->where('order_from',$order_type);
              $this->db->where('order_date',$todays_date);
              $this->db->where('hotel_id',$hotel_id);
              $this->db->where('order_status',0);
              //$this->db->where('added_by',2);
              
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

    function outof_time_housekeeping_order($ord_to_15min)
    {
        $this->db->select('h_k_order_id');
        $this->db->from('house_keeping_orders');
        $this->db->order_by('h_k_order_id','DESC');
        $this->db->where('order_status',0);
        $this->db->where('order_time <=',$ord_to_15min);
        $query = $this->db->get();
        // echo "<pre>";
        // print_r($this->db->last_query());
        // exit;
        return $query->result_array();
    }
          function get_new_order_list_pagination($todays_date,$hotel_id)
          {
              $data = array();
              $this->db->select('*');
              
              $this->db->order_by('h_k_order_id','DESC');
              $this->db->where('order_status',0);
              $this->db->where('order_date',$todays_date);
              $this->db->where('hotel_id',$hotel_id);
              //$this->db->where('added_by',2);
              
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

         function get_all_accepted_orders_pagination($hotel_id)
         {
             $data = array();
             $this->db->select('*');
           
             $this->db->order_by('h_k_order_id','DESC');
             $this->db->where('order_status',1);
             $this->db->where('hotel_id',$hotel_id); 
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

        public function getAllData1($tbl,$wh)
        {
            $this->db->where($wh);
            return $this->db->get($tbl)->result_array();
        }
        public function getAllTableData($tbl)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $query = $this->db->get();
            return $query->result_array();
        }
        function get_menu_new_order_list_pagination($todays_date,$hotel_id)
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
         function get_accepted_menu_list_pagination($hotel_id)
         {
                $data = array();
                $this->db->select('*');
                $this->db->order_by('food_order_id ','DESC');
                $this->db->where('order_status',1);
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
       function get_completed_menu_list_pagination($hotel_id)
       {
              $data = array();
              $this->db->select('*');
             
              $this->db->order_by('food_order_id','DESC');
              $this->db->where('order_status',2);
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

          function get_rejected_menu_list_pagination($hotel_id)
          {
                 $data = array();
                 $this->db->select('*');
             
                 $this->db->order_by('food_order_id ','DESC');
                 $this->db->where('order_status',3);
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

   
        public function get_food_order_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            // $this->db->where('HOUR(created_at)',$time2);
            $this->db->where('order_time <=',$time2);
            $this->db->where('order_date',date("Y-m-d"));
            $this->db->where('order_status',0);
            return $this->db->get('food_orders')->result_array();
        }

        public function get_food_order_complate_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('complete_date',date("Y-m-d"));
            $this->db->where('order_status',2);
            return $this->db->get('food_orders')->result_array();
        }
        
        public function get_order_order_count1($hotel_id,$time1,$time2)
        {
            $date1 = date("Y-m-d",strtotime('-7 days'));
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            $this->db->where('order_time <=',$time2);
            $this->db->where('order_date >=',$date1);
            $this->db->where('order_date <=',date("Y-m-d"));
            $this->db->where('order_status',0);
            return $this->db->get('food_orders')->result_array();
        }

        public function get_food_order_complate_count1($hotel_id,$time1,$time2)
        {
            $date1 = date("Y-m-d",strtotime('-7 days'));
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('complete_date >=',$date1);
            $this->db->where('complete_date <=',date("Y-m-d"));
            $this->db->where('order_status',2);
            return $this->db->get('food_orders')->result_array();
        }

        public function get_food_order_current_mnt_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            $this->db->where('order_time <=',$time2);
            $this->db->where('MONTH(order_date)',date("m"));
            $this->db->where('order_status',0);
            return $this->db->get('food_orders')->result_array();
        }

        public function get_food_order_complete_count_current_mnt($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('MONTH(updated_at)',date("m"));
            $this->db->where('order_status',2);
            return $this->db->get('food_orders')->result_array();
        }

        public function get_food_order_current_yr_count($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_time >=',$time1);
            $this->db->where('order_time <=',$time2);
            $this->db->where('YEAR(order_date)',date("Y"));
            $this->db->where('order_status',0);
            return $this->db->get('food_orders')->result_array();
        }

        public function get_food_order_complete_count_current_yr($hotel_id,$time1,$time2)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('HOUR(updated_at) >=',$time1);
            $this->db->where('HOUR(updated_at) <=',$time2);
            $this->db->where('YEAR(updated_at)',date("Y"));
            $this->db->where('order_status',2);
            return $this->db->get('food_orders')->result_array();
        }

        public function insertData($tbl,$arr)
        {
            $this->db->insert($tbl,$arr);
            return $this->db->insert_id();
        }  
        public function get_manageorder_new($hotel_id,$todays_date)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('cloth_orders');
        
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('order_date',$todays_date);
        $this->db->order_by('cloth_order_id','DESC');
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
    public function get_room_no_data($hotel_id,$room_no,$todays_date)
    {
        $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = user_hotel_booking_details.booking_id');
        $this->db->where('user_hotel_booking_details.room_no',$room_no);
        $this->db->where('user_hotel_booking.hotel_id',$hotel_id);
        $this->db->where('user_hotel_booking.booking_status',1);
        $this->db->where('user_hotel_booking.check_out >=',$todays_date);
        return $this->db->get('user_hotel_booking_details')->row_array();
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

    function get_service_completed_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        
        $this->db->order_by('h_k_order_id','DESC');
        $this->db->where('order_status',2);
        $this->db->where('hotel_id',$hotel_id);
        
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

    function get_service_rejected_list_pagination($hotel_id)
    {
        $data = array();
        $this->db->select('*');
        
        $this->db->order_by('h_k_order_id','DESC');
        $this->db->where('order_status',3);
        $this->db->where('hotel_id',$hotel_id);
        
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
    public function getregdata($tbl,$wh){
        $this->db->select('*');
        $this->db->where('u_id',$wh);
        return $this->db->get('register')->row_array();
    }
    function get_staff_list($hotel_id)
        {
            $data = array();
            $this->db->select('*');
            
            $this->db->order_by('u_id','DESC');
            $this->db->where('user_type',9);
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

        public function deleteData($tbl, $where)
        {
            $this->db->where($where);
            if ($this->db->delete($tbl))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        function get_all_user_completed_orders_pagination($u_id)
          {
              $data = array();
              $this->db->select('*');
             
              $this->db->order_by('h_k_order_id','DESC');
              $this->db->where('order_status',2);
              $this->db->where('staff_id',$u_id);   
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

          function get_all_user_Laundry_completed_orders_pagination($u_id)
          {
              $data = array();
              $this->db->select('*');
              
              $this->db->order_by('cloth_order_id','DESC');
              $this->db->where('order_status',2);
              $this->db->where('staff_id',$u_id);   
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

          function get_cloth_list_pagination($hotel_id)
          {
             $data = array();
             $this->db->select('*');
             
             $this->db->order_by('cloth_id','DESC');
             $this->db->where('added_by',2);
             $this->db->where('hotel_id',$hotel_id);
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

          function get_laundry_new_list_pagination($todays_date,$hotel_id)
          {
              $data = array();
              $this->db->select('*');
        
              $this->db->order_by('cloth_order_id','DESC');
              $this->db->where('order_status',0);
              $this->db->where('order_date',$todays_date);
              $this->db->where('hotel_id',$hotel_id);
              //$this->db->where('added_by',2);
              
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

          function get_laundry_list_accepted_pagination($hotel_id)
          {
              $data = array();
              $this->db->select('*');
             
              $this->db->order_by('cloth_order_id','DESC');
              $this->db->where('order_status',1);
              $this->db->where('hotel_id',$hotel_id);
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

          function get_laundry_list_completes_pagination($hotel_id)
          {
              $data = array();
              $this->db->select('*');
              
              $this->db->order_by('cloth_order_id','DESC');
              $this->db->where('order_status',2);
              $this->db->where('hotel_id',$hotel_id);
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
          function get_laundry_rejected_list_pagination($hotel_id)
          {
              $data = array();
              $this->db->select('*');
            
              $this->db->order_by('cloth_order_id','DESC');
              $this->db->where('order_status',3);
              $this->db->where('hotel_id',$hotel_id);
              
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

          public function getdatareg($tbl,$wh){
            $this->db->select('*');
            $this->db->where('cloth_id',$wh);
            return $this->db->get('cloth')->row_array();
        }

        // code by vivek
        public function get_offer_list($hotel_id,$order_status)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('offer_for',$order_status);
            return $this->db->get('offers')->result_array();
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
        public function get_hotel_expected_current_booking($hotel_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('check_in <=',date('Y-m-d'));
            return $this->db->get('user_hotel_booking')->result_array();
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
        public function getCount_accepted_orders($tbl,$where)
        {
            $this->db->select('count(h_k_order_id) as total_count');
            $this->db->from($tbl);
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result_array();
        }
        public function getCount_rejected_orders($tbl,$where)
        {
            $this->db->select('count(h_k_order_id) as total_count');
            $this->db->from($tbl);
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result_array();
        }
        // public function getAllData1($tbl,$wh)
        // {
        //     $this->db->where($wh);
        //     return $this->db->get($tbl)->result_array();
        // }
        public function get_daily_report_graph_dirty_rooms($date,$hotel_id)
        {
        $this->db->select('count(room_status_id) as total_revenue');
        $this->db->where('room_status',1);
        $this->db->where('DATE(created_at)',$date);
        $this->db->where('hotel_id',$hotel_id);
        return $this->db->get('room_status')->result_array();
        }
        public function get_daily_report_graph_accupied_rooms($date,$hotel_id)
        {
          $this->db->select('count(room_status_id) as total_revenue_1');
          $this->db->where('room_status',2);
          $this->db->where('DATE(created_at)',$date);
          $this->db->where('hotel_id',$hotel_id);
          return $this->db->get('room_status')->result_array();
        }
        public function get_daily_report_graph_available_rooms($date,$hotel_id)
        {
            $this->db->select('count(room_status_id) as total_revenue_2');
            $this->db->where('room_status',3);
            $this->db->where('DATE(created_at)',$date);
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('room_status')->result_array();
        }
        public function get_daily_report_graph_un_main_rooms($date,$hotel_id)
        {
          $this->db->select('count(room_status_id) as total_revenue_3');
          $this->db->where('room_status',4);
          $this->db->where('DATE(created_at)',$date);
          $this->db->where('hotel_id',$hotel_id);
          return $this->db->get('room_status')->result_array();
        }
        public function get_notifications_for_housekeeping_limit($hotel_id)
        {
            
            $this->db->where('notifications.send_by_id',$hotel_id);
            $this->db->where('notifications.send_for',7);
            // $this->db->where('notifictions_department_id.department_id',5);
            $this->db->order_by('notifications.notification_id','desc');
            $this->db->limit(4);
            return $this->db->get('notifications')->result_array();
        }
        public function getCount_active_staff($tbl,$where)
        {
            $this->db->select('count(u_id) as total_count');
            $this->db->from($tbl);
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result_array();
        }
        public function get_laundry_count_1($hotel_id,$todays_date)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_date',$todays_date);
            $this->db->where('order_status',0);
            $this->db->where('added_by',2);
            return $this->db->get('cloth_orders')->result_array();
        }

        public function get_laundry_count_2($hotel_id,$todays_date)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('order_date',$todays_date);
            $this->db->where('order_status',0);
            $this->db->where('added_by',1);
            return $this->db->get('cloth_orders')->result_array();
        }
        public function get_staff_orderss($hotel_id)
        {
            
            $this->db->where('notifications.send_by_id',$hotel_id);
            $this->db->where('notifications.send_for',7);
            $this->db->where('order_status',0); 
            $this->db->order_by('notifications.notification_id','desc');
            //$this->db->limit(4);
            return $this->db->get('notifications')->result_array();
        }
        public function get_notifications_for_housekeeping($hotel_id,$today_date)
        {
            $this->db->where('notifications.send_by_id',$hotel_id);
            $this->db->where('notifications.send_for',7);
            $this->db->where('DATE(notifications.created_at)',$today_date);
            $this->db->where('notifications.order_status',0);
            $this->db->order_by('notifications.notification_id','desc');
            // $this->db->limit(20);
            return $this->db->get('notifications')->result_array();
        }
        // code by nishan 30/05/2023 start
        function get_user_review_pagination($hotel_id)
         {
              $data = array();
              $this->db->select('*');
              
              $this->db->order_by('review_id','DESC');
              $this->db->where('review_for',5);
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
         public function get_daily_report_available_rooms($hotel_id)
         {
           $this->db->where('room_status',3);
           $this->db->where('hotel_id',$hotel_id);
           return $this->db->get('room_status')->result_array();
         }

         public function getdatadirty($tbl,$wh){
            $this->db->select('*');
            $this->db->where('room_status_id',$wh);
            return $this->db->get('room_status')->row_array();
        }
        public function getdataunder($tbl,$wh){
            $this->db->select('*');
            $this->db->where('room_status_id',$wh);
            return $this->db->get('room_status')->row_array();
        }
        function get_service_list($hotel_id)
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
        // code by nishan 30/05/2023 end

        public function getdataser($tbl,$wh){
            $this->db->select('*');
            $this->db->where('h_k_services_id',$wh);
            return $this->db->get('house_keeping_services')->row_array();
        }

        function get_handover_list_pagination($hotel_id)
        {
             $data = array();
             $this->db->select('*');
            
             $this->db->order_by('m_handover_id','DESC');
             $this->db->where('is_complete',0);
             $this->db->where('added_by',2);
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
             $this->db->where('added_by',2);
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

        public function gethandata($tbl,$wh){
            $this->db->select('*');
            $this->db->where('m_handover_id',$wh);
            return $this->db->get('handover_manger')->row_array();
        }

        public function getdatalaun($tbl,$wh){
            $this->db->select('*');
            $this->db->where('cloth_order_id',$wh);
            return $this->db->get('cloth_orders')->row_array();
        }
        
        function get_visiter_data($rowperpage,$row,$search,$hotel_id)
        {
            $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
            $this->db->limit($rowperpage, $row);
            $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
            $this->db->where('house_keeping_orders.order_status',0);
            $this->db->where('house_keeping_orders.order_date',date('Y-m-d'));
            $this->db->where('room_nos.hotel_id', $hotel_id);
            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                // $this->db->like('visitor.visitor_name', $search);
                $this->db->like('register.full_name', $search);
                $this->db->or_like('house_keeping_orders.order_date', $search);
                $this->db->or_where('house_keeping_orders.h_k_order_id', $search);
                $this->db->or_where('user_hotel_booking_details.room_no', $search);
            $this->db->group_end();     
            } 
            $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor,user_hotel_booking.booking_status');
          
            $this->db->from('house_keeping_orders');
           
            $this->db->join('register','register.u_id = house_keeping_orders.u_id');
            $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
            $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
            $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
            $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
            $this->db->join('floors','floors.floor_id = room_configure.floor_id');
            $query = $this->db->get();
            return $query->result_array();
        }
    
        function get_total_visiter_data($search='', $hotel_id='')
        {
            $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
            $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
            $this->db->where('house_keeping_orders.order_status',0);
            $this->db->where('house_keeping_orders.order_date',date('Y-m-d'));
            $this->db->where('room_nos.hotel_id', $hotel_id);
    
            if(!empty($search)){
                $this->db->group_start(); // Open bracket
                $this->db->like('register.full_name', $search);
                $this->db->or_like('house_keeping_orders.order_date', $search);
                $this->db->or_where('house_keeping_orders.h_k_order_id', $search);
                $this->db->or_where('user_hotel_booking_details.room_no', $search);
                $this->db->group_end();     
            } 
    
            $this->db->select('count(h_k_order_id) as total_record');
            $this->db->from('house_keeping_orders');
            
            $this->db->join('register','register.u_id = house_keeping_orders.u_id');
            $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
            $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
            $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
            $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
            $this->db->join('floors','floors.floor_id = room_configure.floor_id');
           
            $query = $this->db->get();
            return $query->row();
        }
        public function get_visitor_pagination($hotel_id,$todays_date)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('created_at','DESC');
            $this->db->where('order_date',$todays_date);
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

        function get_laundry_data($rowperpage,$row,$search,$hotel_id)
        {
            $this->db->order_by('cloth_orders.cloth_order_id','DESC');
            // $this->db->where('order_date',$todays_date);
            $this->db->limit($rowperpage, $row);
            $this->db->where('cloth_orders.order_status',0);
            $this->db->where('cloth_orders.hotel_id', $hotel_id);
            $this->db->where('cloth_orders.order_date',date('Y-m-d'));
            $this->db->where('room_nos.hotel_id', $hotel_id);
            if(!empty($search)){
            $this->db->group_start(); // Open bracket
                // $this->db->like('visitor.visitor_name', $search);
                $this->db->like('register.full_name', $search);
                $this->db->or_like('cloth_orders.order_date', $search);
                $this->db->or_where('cloth_orders.cloth_order_id', $search);
                $this->db->or_where('user_hotel_booking_details.room_no', $search);
            $this->db->group_end();         
            } 
            $this->db->select('cloth_orders.cloth_order_id,cloth_orders.out_of_time_status,cloth_orders.order_date,cloth_orders.order_time,cloth_orders.order_from,cloth_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor,user_hotel_booking.booking_status');
          
            $this->db->from('cloth_orders');
           
            $this->db->join('register','register.u_id = cloth_orders.u_id');
            $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = cloth_orders.booking_id');
            $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
            $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
            $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
            $this->db->join('floors','floors.floor_id = room_configure.floor_id');
           
            $query = $this->db->get();
            return $query->result_array();
        }
    
        function get_total_laundry_data($search='', $hotel_id='')
        {
            $this->db->order_by('cloth_orders.cloth_order_id','DESC');
            // $this->db->where('order_date',$todays_date);
            $this->db->where('cloth_orders.hotel_id', $hotel_id);
            $this->db->where('cloth_orders.order_status',0);
         
             $this->db->where('cloth_orders.order_date',date('Y-m-d'));
            $this->db->where('room_nos.hotel_id', $hotel_id);
    
            if(!empty($search)){
                $this->db->group_start(); // Open bracket
                $this->db->like('register.full_name', $search);
                $this->db->or_like('cloth_orders.order_date', $search);
                $this->db->or_where('cloth_orders.cloth_order_id', $search);
                $this->db->or_where('user_hotel_booking_details.room_no', $search);
                $this->db->group_end();     
            } 
    
            $this->db->select('count(cloth_order_id) as total_record');
            $this->db->from('cloth_orders');
            
            $this->db->join('register','register.u_id = cloth_orders.u_id');
            $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = cloth_orders.booking_id');
            $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
            $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
            $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
            $this->db->join('floors','floors.floor_id = room_configure.floor_id');
           
            $query = $this->db->get();
            return $query->row();
        }
        public function get_laundry_pagination($hotel_id,$todays_date)
        {
            $data = array();
            $this->db->select('*');
            $this->db->order_by('created_at','DESC');
            $this->db->where('order_date',$todays_date);
            $this->db->where('hotel_id', $hotel_id);
            $Q = $this->db->get('cloth_orders');
    
            if ($Q->num_rows() > 0) {
                foreach ($Q->result_array() as $row) {
                    $data[] = $row;
                }
            }
    
            $Q->free_result();
    
            return $data;
        }
    
    
    public function getdataneworder($tbl, $wh)
  {
    $this->db->select('*');
    $this->db->where('h_k_order_id', $wh);
    return $this->db->get('house_keeping_orders')->row_array();
  }
  public function getSingleData($tbl,$where)
  {
      $this->db->select('*');
      $this->db->from($tbl);
      $this->db->where($where);
      $query = $this->db->get();        
      return $query->row_array();
  }
  public function get_laundry_time($hotel_id)
  {
    $this->db->where('hotel_id', $hotel_id);
    return $this->db->get('laundry_time')->row_array();
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
public function getallfoodorder($tbl,$where)
{
    $this->db->select('*');
    $this->db->order_by('h_k_order_id','DESC');
    $this->db->where($where);
    $this->db->from($tbl);
    $query = $this->db->get();
    return $query->result_array();
}

function outof_time_house_order($ord_to_15min)
{
    $this->db->select('h_k_order_id');
    $this->db->from('house_keeping_orders');
    $this->db->order_by('h_k_order_id','DESC');
    $this->db->where('order_status',0);
    $this->db->where('order_time <=',$ord_to_15min);
    $query = $this->db->get();
    return $query->result_array();
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
        $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
        $this->db->where('house_keeping_orders.order_status',1);
      
        $this->db->where('room_nos.hotel_id', $hotel_id);
        if(!empty($search)){
        $this->db->group_start(); // Open bracket
            // $this->db->like('visitor.visitor_name', $search);
            $this->db->like('register.full_name', $search);
            $this->db->or_like('house_keeping_orders.order_date', $search);
            $this->db->or_where('house_keeping_orders.h_k_order_id', $search);
            $this->db->or_where('user_hotel_booking_details.room_no', $search);
        $this->db->group_end();     
        } 
        $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.u_id,house_keeping_orders.hotel_id,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,house_keeping_orders.staff_name,register.full_name,user_hotel_booking_details.room_no,floors.floor');
      
        $this->db->from('house_keeping_orders');
       
        $this->db->join('register','register.u_id = house_keeping_orders.u_id');
        $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
        $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
        $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
        $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
        $this->db->join('floors','floors.floor_id = room_configure.floor_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    function total_accepted_house_list_data($search='', $hotel_id='')
    {
        $this->db->order_by('house_keeping_orders.accept_time','ASC');
        $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
        $this->db->where('house_keeping_orders.order_status',1);
       
        $this->db->where('room_nos.hotel_id', $hotel_id);

        if(!empty($search)){
            $this->db->group_start(); // Open bracket
            $this->db->like('register.full_name', $search);
            $this->db->or_like('house_keeping_orders.order_date', $search);
            $this->db->or_where('house_keeping_orders.h_k_order_id', $search);
            $this->db->or_where('user_hotel_booking_details.room_no', $search);
            $this->db->group_end();     
        } 

        $this->db->select('count(h_k_order_id) as total_record');
        $this->db->from('house_keeping_orders');
        
        $this->db->join('register','register.u_id = house_keeping_orders.u_id');
        $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
        $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
        $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
        $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
        $this->db->join('floors','floors.floor_id = room_configure.floor_id');
       
        $query = $this->db->get();
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
    $this->db->where('cloth_orders.hotel_id', $hotel_id);
    $this->db->where('cloth_orders.order_status',1);
    
    $this->db->where('room_nos.hotel_id', $hotel_id);
    if(!empty($search)){
    $this->db->group_start(); // Open bracket
        // $this->db->like('visitor.visitor_name', $search);
        $this->db->like('register.full_name', $search);
        $this->db->or_like('cloth_orders.order_date', $search);
        $this->db->or_where('cloth_orders.cloth_order_id', $search);
        $this->db->or_where('user_hotel_booking_details.room_no', $search);
    $this->db->group_end();     
    } 
    $this->db->select('cloth_orders.cloth_order_id,cloth_orders.out_of_time_status,cloth_orders.u_id,cloth_orders.hotel_id,cloth_orders.order_date,cloth_orders.order_time,cloth_orders.order_from,cloth_orders.additional_note,cloth_orders.staff_name,register.full_name,user_hotel_booking_details.room_no,floors.floor');
    
    $this->db->from('cloth_orders');
    
    $this->db->join('register','register.u_id = cloth_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = cloth_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
    $query = $this->db->get();
    return $query->result_array();
}
function total_accepted_laundry_list_data($search='', $hotel_id='')
{
    $this->db->order_by('cloth_orders.accept_time','ASC');
    $this->db->where('cloth_orders.hotel_id', $hotel_id);
    $this->db->where('cloth_orders.order_status',1);
    
    $this->db->where('room_nos.hotel_id', $hotel_id);

    if(!empty($search)){
        $this->db->group_start(); // Open bracket
        $this->db->like('register.full_name', $search);
        $this->db->or_like('cloth_orders.order_date', $search);
        $this->db->or_where('cloth_orders.cloth_order_id', $search);
        $this->db->or_where('user_hotel_booking_details.room_no', $search);
        $this->db->group_end();     
    } 

    $this->db->select('count(cloth_order_id) as total_record');
    $this->db->from('cloth_orders');
    
    $this->db->join('register','register.u_id = cloth_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = cloth_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
    
    $query = $this->db->get();
    return $query->row();
}
public function getPlan($tbl)
{
    $this->db->select('*');
    $this->db->order_by('created_at', 'DESC');
    $this->db->from($tbl);
    $query = $this->db->get();
    // print_r($query);
    //     exit;
    //  echo $this->db->last_query();
    //  exit;
    return $query->result_array();
    //  print_r($query);
    //     exit;
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

public function get_house_service_request($hotel_id,$today_date)
{
    $data = array();
    $this->db->select('*');
    $this->db->order_by('service_request_id ', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('send_to', 5);
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
function get_staff_list_pagination($hotel_id,$todays_date)
{
    $data = array();
    $this->db->select('*');

    $this->db->order_by('staff_handover_id','DESC');
    $this->db->where('is_complete',0);
    $this->db->where('added_by',2);
    $this->db->where('date',$todays_date);
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
function get_staff_handover_completed_list_pagination($hotel_id, $is_complete2)
{
    $data = array();
    $this->db->select('*');
    $this->db->order_by('staff_handover_id', 'DESC');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('is_complete', $is_complete2);
    $Q = $this->db->get('handover_staff');

    if ($Q->num_rows() > 0) {
        foreach ($Q->result_array() as $row) {
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
    $this->db->where('added_by',2);
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
public function getdatareassign($tbl,$wh)
{
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
  $this->db->where('send_to =', 5);
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
    $this->db->where('send_to =', 5);
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
  public function search_order_data($hotel_id,$order_type,$todays_date)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',0);
    $this->db->where('house_keeping_orders.order_date',$todays_date);
    $this->db->where('house_keeping_orders.order_from',$order_type);
    
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_completed_order_data($hotel_id,$order_type)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',2);
    
    $this->db->where('house_keeping_orders.order_from',$order_type);
  
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.staff_name,house_keeping_orders.created_at,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_rejected_order_data($hotel_id,$order_type)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',3);
  
    $this->db->where('house_keeping_orders.order_from',$order_type);
   
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.reject_date,house_keeping_orders.reject_reason,house_keeping_orders.created_at,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_accepted_order_data($hotel_id,$order_type)
  {
    $this->db->order_by('house_keeping_orders.accept_time','ASC');
           
   
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',1);
    $this->db->where('house_keeping_orders.order_from',$order_type);
   
  
    $this->db->where('room_nos.hotel_id', $hotel_id);
  
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.u_id,house_keeping_orders.hotel_id,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,house_keeping_orders.staff_name,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }

  public function search_floor_order_data($hotel_id,$todays_date,$floor_no)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',0);
    $this->db->where('house_keeping_orders.order_date',$todays_date);
    
    $this->db->where('floors.floor_id',$floor_no);
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_floor_completed_order_data($hotel_id,$floor_no)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',2);
    
   
    $this->db->where('floors.floor_id',$floor_no);
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.staff_name,house_keeping_orders.created_at,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_floor_rejected_order_data($hotel_id,$floor_no)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',3);
  
   
    $this->db->where('floors.floor_id',$floor_no);
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.reject_date,house_keeping_orders.reject_reason,house_keeping_orders.created_at,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_floor_accepted_order_data($hotel_id,$floor_no)
  {
    $this->db->order_by('house_keeping_orders.accept_time','ASC');
           
   
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',1);
    
    $this->db->where('floors.floor_id',$floor_no);
  
    $this->db->where('room_nos.hotel_id', $hotel_id);
  
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.u_id,house_keeping_orders.hotel_id,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,house_keeping_orders.staff_name,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  function get_room_search($hotel_id)
  {
      $this->db->where('floors.hotel_id', $hotel_id);
      
    
    
      $this->db->select('*, room_nos.room_no');
    
      $this->db->from('floors');
     
      $this->db->join('room_configure', 'floors.floor_id = room_configure.floor_id');
      $this->db->join('room_nos','room_nos.room_configure_id = room_configure.room_configure_id');
     
        $query =$this->db->get();
        return $query->result_array();
      
  }
  public function search_room_rejected_order_data($hotel_id,$room_no)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',3);
  
    $this->db->where('user_hotel_booking_details.room_no',$room_no);
    
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.reject_date,house_keeping_orders.reject_reason,house_keeping_orders.created_at,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_room_completed_order_data($hotel_id,$room_no)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',2);
    
    $this->db->where('user_hotel_booking_details.room_no',$room_no);
 
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.staff_name,house_keeping_orders.created_at,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_room_accepted_order_data($hotel_id,$room_no)
  {
    $this->db->order_by('house_keeping_orders.accept_time','ASC');
           
   
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',1);
    $this->db->where('user_hotel_booking_details.room_no',$room_no);

  
    $this->db->where('room_nos.hotel_id', $hotel_id);
  
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.u_id,house_keeping_orders.hotel_id,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,house_keeping_orders.staff_name,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_room_order_data($hotel_id,$todays_date,$room_no)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',0);
    $this->db->where('house_keeping_orders.order_date',$todays_date);
    $this->db->where('user_hotel_booking_details.room_no',$room_no);
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_date_order_data($hotel_id,$order_date)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',0);
    $this->db->where('house_keeping_orders.order_date',$order_date);
   
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_date_rejected_order_data($hotel_id,$order_date)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',3);
    $this->db->where('house_keeping_orders.reject_date',$order_date);
  
    
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.reject_date,house_keeping_orders.reject_reason,house_keeping_orders.created_at,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_date_completed_order_data($hotel_id,$order_date)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',2);
    
    $this->db->where('house_keeping_orders.order_date',$order_date);
    
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.staff_name,house_keeping_orders.created_at,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_date_accepted_order_data($hotel_id,$order_date)
  {
    $this->db->order_by('house_keeping_orders.accept_time','ASC');
           
   
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',1);
    $this->db->where('house_keeping_orders.order_date',$order_date);
  
    $this->db->where('room_nos.hotel_id', $hotel_id);
  
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.u_id,house_keeping_orders.hotel_id,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,house_keeping_orders.staff_name,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_all_order_data($hotel_id,$order_date,$floor_no,$room_no,$order_type)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',0);
    $this->db->where('house_keeping_orders.order_date',$order_date);
    $this->db->where('floors.floor_id',$floor_no);
    $this->db->where('user_hotel_booking_details.room_no',$room_no);
    $this->db->where('house_keeping_orders.order_from',$order_type);

   
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_all_accepted_order_data($hotel_id,$order_date,$floor_no,$room_no,$order_type)
  {
    $this->db->order_by('house_keeping_orders.accept_time','ASC');
           
   
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',1);
    $this->db->where('house_keeping_orders.order_date',$order_date);
    $this->db->where('floors.floor_id',$floor_no);
    $this->db->where('user_hotel_booking_details.room_no',$room_no);
    $this->db->where('house_keeping_orders.order_from',$order_type);
  
    $this->db->where('room_nos.hotel_id', $hotel_id);
  
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.out_of_time_status,house_keeping_orders.u_id,house_keeping_orders.hotel_id,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,house_keeping_orders.staff_name,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_all_completed_order_data($hotel_id,$order_date,$floor_no,$room_no,$order_type)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',2);
    
    $this->db->where('house_keeping_orders.order_date',$order_date);
    $this->db->where('floors.floor_id',$floor_no);
    $this->db->where('user_hotel_booking_details.room_no',$room_no);
    $this->db->where('house_keeping_orders.order_from',$order_type);
  
 
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.staff_name,house_keeping_orders.created_at,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
  public function search_all_rejected_order_data($hotel_id,$order_date,$floor_no,$room_no,$order_type)
  {
    $this->db->order_by('house_keeping_orders.h_k_order_id','DESC');
           
    
    $this->db->where('house_keeping_orders.hotel_id', $hotel_id);
    $this->db->where('house_keeping_orders.order_status',3);
    $this->db->where('house_keeping_orders.reject_date',$order_date);
    $this->db->where('floors.floor_id',$floor_no);
    $this->db->where('user_hotel_booking_details.room_no',$room_no);
    $this->db->where('house_keeping_orders.order_from',$order_type);
  
  
    
    $this->db->where('room_nos.hotel_id', $hotel_id);
   
    $this->db->select('house_keeping_orders.h_k_order_id,house_keeping_orders.reject_date,house_keeping_orders.reject_reason,house_keeping_orders.created_at,house_keeping_orders.out_of_time_status,house_keeping_orders.order_date,house_keeping_orders.order_time,house_keeping_orders.order_from,house_keeping_orders.additional_note,register.full_name,user_hotel_booking_details.room_no,floors.floor');
  
    $this->db->from('house_keeping_orders');
   
    $this->db->join('register','register.u_id = house_keeping_orders.u_id');
    $this->db->join('user_hotel_booking','user_hotel_booking.booking_id = house_keeping_orders.booking_id');
    $this->db->join('user_hotel_booking_details','user_hotel_booking_details.booking_id = user_hotel_booking.booking_id');
    $this->db->join('room_nos','room_nos.room_no = user_hotel_booking_details.room_no');
    $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
    $this->db->join('floors','floors.floor_id = room_configure.floor_id');
      $query =$this->db->get();
      return $query->result_array();
      
  }
    }
    ?>