<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainModel extends CI_Model {
    function __construct() 
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }

    //  For login Check_Mail(Super_admin)....Supriya    
                       
    public function check_email($email,$password, $userType)
    {
        $this->db->where('email_id',$email);
        $this->db->where('password',$password);
        $this->db->where('user_type',$userType);
        return $this->db->get('register')->row_array();
    }
    public function get_room_service_menu_list($room_serv_cat_id,$hotel_id)
    {
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('room_serv_cat_id',$room_serv_cat_id);
        return $this->db->get('room_serv_menu_list')->result_array();
    }
     public function fetchdata($profile)
    {
       
        $this->db->select('profile_photo');
        $this->db->from('register');
        $this->db->where('u_id', $profile);
        return $this->db->get()->row_array();
    }

    
    public function get_food_category($hotel_id,$food_facility_id)
        {
            $this->db->where('food_facility_id',$food_facility_id);
            $this->db->where('hotel_id',$hotel_id);
            return $this->db->get('food_category')->result_array();
        }
        public function get_access_to_department($hotel_id,$department_id,$user_id,$services_name)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('department_id',$department_id);
            $this->db->where('user_id',$user_id);
            $this->db->where('services_name',$services_name);
            return $this->db->get('access_to_department')->row_array();
        }
    public function get_total_room_count($hotel_id,$room_type)
        {
            $this->db->select('count(room_nos.room_no) as total_room');
            $this->db->join('room_nos','room_nos.room_configure_id = room_configure.room_configure_id');
            $this->db->where('room_configure.hotel_id',$hotel_id);
            $this->db->where('room_configure.room_type',$room_type);
            return $this->db->get('room_configure')->result_array();
        }
        public function get_room_numbers($hotel_id,$room_configure_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_configure_id',$room_configure_id);
            return $this->db->get('room_nos')->result_array();
        }
        public function get_room_imgs($hotel_id,$room_configure_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_configure_id',$room_configure_id);
            return $this->db->get('room_imgs')->result_array();
        }
        public function get_room_facility($hotel_id,$room_configure_id)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('room_configure_id',$room_configure_id);
            return $this->db->get('room_facility')->result_array();
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
        public function get_booking_room_details($booking_id)
    {
        $this->db->select('room_type.room_type_name,user_hotel_booking_details.*');
        $this->db->join('room_type','room_type.room_type_id = user_hotel_booking_details.room_type');
        // $this->db->where('user_hotel_booking_details.hotel_id',$hotel_id);
        $this->db->where('user_hotel_booking_details.booking_id',$booking_id);
        return $this->db->get('user_hotel_booking_details')->result_array();
    }
        public function getManageBusinessCenter($tbl, $business_id){
        
        $this->db->select('business_center.*,business_center_images.*,business_center_facility.*');
        $this->db->join('business_center_facility','business_center.business_center_id=business_center_facility.business_center_id');
        $this->db->join('business_center_images','business_center.business_center_id=business_center_images.business_center_id');
        $this->db->where('business_center_facility.business_center_id',$business_id);
        $this->db->where('business_center_images.business_center_id',$business_id);
       
        return $this->db->get('business_center')->row_array();
    
    }
            public function getagentData($tbl,$wh){
            $this->db->select('*');
            $this->db->where('id',$wh);     
            return $this->db->get('agents')->row_array();
        }
    public function get_room_nosw($hotel_id,$room_type)
        {
            $this->db->select('room_configure.room_type,room_configure.price,room_nos.*');
            $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
            $this->db->where('room_configure.hotel_id',$hotel_id);
            $this->db->where('room_configure.room_type',$room_type);
            return $this->db->get('room_nos')->result_array();
        }
         public function get_room_nos($hotel_id,$room_type)
         {
           $this->db->select('*');
           $this->db->join('room_configure','room_configure.room_configure_id = room_nos.room_configure_id');
           $this->db->where('room_configure.hotel_id',$hotel_id);
           $this->db->where('room_configure.room_type',$room_type);
           return $this->db->get('room_nos')->result_array();
         }
    public function get_offer_list_housekeeping($hotel_id,$order_status)
        {
          $this->db->where('hotel_id',$hotel_id);
          $this->db->where('offer_for',$order_status);
          return $this->db->get('offers')->result_array();
        }
    public function get_room_nos_floor_wise($hotel_id,$floor_id)
    {
        $this->db->join('room_nos','room_nos.room_configure_id = room_configure.room_configure_id');
        $this->db->where('room_configure.hotel_id',$hotel_id);
        $this->db->where('room_configure.floor_id',$floor_id);
        return $this->db->get('room_configure')->result_array();
    }
    public function get_spa_services_images($hotel_id,$front_ofs_service_id)
    {
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('front_ofs_service_id',$front_ofs_service_id);
        return $this->db->get('front_ofs_spa_service_images')->result_array();
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
    public function get_particular_hotel_staff_list($hotel_id,$user_type)
    {
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('user_type',$user_type);
        return $this->db->get('register')->result_array();
    }

     // staff list of particular hotels count---------supriya
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
                            $this->db->order_by('notifications.notification_id','desc');
                            // $this->db->where('notifictions_department_id.department_id',3);
                            return $this->db->get('notifications')->result_array();
                        }
                        public function get_floor_list($hotel_id)
                        {
                            $this->db->where('hotel_id',$hotel_id);
                            return $this->db->get('floors')->result_array();
                        }


                          // room service order count
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
                               
                        // room service order count---------supriya
                        public function get_room_service_menu_order_count($hotel_id,$time1,$time2)
                        {
                            $this->db->where('hotel_id',$hotel_id);
                            $this->db->where('order_time >=',$time1);
                            $this->db->where('order_time <=',$time2);
                            $this->db->where('order_date',date("Y-m-d"));
                            $this->db->where('order_status',0);
                            return $this->db->get('room_service_menu_orders')->result_array();
                        }

                     // room service complete order count------supriya
                        public function get_room_service_order_complate_count($hotel_id,$time1,$time2)
                        {
                            $this->db->where('hotel_id',$hotel_id);
                            $this->db->where('HOUR(updated_at) >=',$time1);
                            $this->db->where('HOUR(updated_at) <=',$time2);
                            $this->db->where('complete_date',date("Y-m-d"));
                            $this->db->where('order_status',2);
                            return $this->db->get('rmservice_services_orders')->result_array();
                        }

                          // room service complete order count----------supriya
                            public function get_room_service_menu_order_complete_count($hotel_id,$time1,$time2)
                            {
                                $this->db->where('hotel_id',$hotel_id);
                                $this->db->where('HOUR(updated_at) >=',$time1);
                                $this->db->where('HOUR(updated_at) <=',$time2);
                                $this->db->where('complete_date',date("Y-m-d"));
                                $this->db->where('order_status',2);
                                return $this->db->get('room_service_menu_orders')->result_array();
                            }
                              // room service order count-------->supriya
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

                            // room service order count
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

                                    // room service complete order count last 7 days
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

                                     // room service complete order count
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
                            public function get_room_service_order_current_mnt_count($hotel_id,$time1,$time2)
                            {
                                $this->db->where('hotel_id',$hotel_id);
                                $this->db->where('order_time >=',$time1);
                                $this->db->where('order_time <=',$time2);
                                $this->db->where('MONTH(order_date)',date("m"));
                                $this->db->where('order_status',0);
                                return $this->db->get('rmservice_services_orders')->result_array();
                            }
                    
                              // room service order count current month
                              public function get_room_service_menu_order_current_mnt_count($hotel_id,$time1,$time2)
                              {
                                  $this->db->where('hotel_id',$hotel_id);
                                  $this->db->where('order_time >=',$time1);
                                  $this->db->where('order_time <=',$time2);
                                  $this->db->where('MONTH(order_date)',date("m"));
                                  $this->db->where('order_status',0);
                                  return $this->db->get('room_service_menu_orders')->result_array();
                              }
                               // room service complete order count current month
                            public function get_room_service_order_complete_count_current_mnt($hotel_id,$time1,$time2)
                            {
                                $this->db->where('hotel_id',$hotel_id);
                                $this->db->where('HOUR(updated_at) >=',$time1);
                                $this->db->where('HOUR(updated_at) <=',$time2);
                                $this->db->where('MONTH(updated_at)',date("m"));
                                $this->db->where('order_status',2);
                                return $this->db->get('rmservice_services_orders')->result_array();
                            }
                            // room service complete order count
                            public function get_room_service_menu_order_complete_count_current_mnt($hotel_id,$time1,$time2)
                            {
                                $this->db->where('hotel_id',$hotel_id);
                                $this->db->where('HOUR(updated_at) >=',$time1);
                                $this->db->where('HOUR(updated_at) <=',$time2);
                                $this->db->where('MONTH(updated_at)',date("m"));
                                $this->db->where('order_status',2);
                                return $this->db->get('room_service_menu_orders')->result_array();
                            } // room service order count current year
                            public function get_room_service_order_current_yr_count($hotel_id,$time1,$time2)
                            {
                                $this->db->where('hotel_id',$hotel_id);
                                $this->db->where('order_time >=',$time1);
                                $this->db->where('order_time <=',$time2);
                                $this->db->where('YEAR(order_date)',date("Y"));
                                $this->db->where('order_status',0);
                                return $this->db->get('rmservice_services_orders')->result_array();
                            }
                       // room service order count current year
                       public function get_room_service_menu_order_current_yr_count($hotel_id,$time1,$time2)
                       {
                           $this->db->where('hotel_id',$hotel_id);
                           $this->db->where('order_time >=',$time1);
                           $this->db->where('order_time <=',$time2);
                           $this->db->where('YEAR(order_date)',date("Y"));
                           $this->db->where('order_status',0);
                           return $this->db->get('room_service_menu_orders')->result_array();
                       }
                          // room service complete order count current month
                          public function get_room_service_order_complete_count_current_yr($hotel_id,$time1,$time2)
                          {
                              $this->db->where('hotel_id',$hotel_id);
                              $this->db->where('HOUR(updated_at) >=',$time1);
                              $this->db->where('HOUR(updated_at) <=',$time2);
                              $this->db->where('YEAR(updated_at)',date("Y"));
                              $this->db->where('order_status',2);
                              return $this->db->get('rmservice_services_orders')->result_array();
                          }
                           // room service complete order count
                           public function get_room_service_menu_order_complete_count_current_yr($hotel_id,$time1,$time2)
                           {
                               $this->db->where('hotel_id',$hotel_id);
                               $this->db->where('HOUR(updated_at) >=',$time1);
                               $this->db->where('HOUR(updated_at) <=',$time2);
                               $this->db->where('YEAR(updated_at)',date("Y"));
                               $this->db->where('order_status',2);
                               return $this->db->get('room_service_menu_orders')->result_array();
                           }
                           public function getCount_complete_orders($tbl,$where)
                           {
                              $this->db->select('count(rmservice_services_order_id ) as total_count');
                              $this->db->from($tbl);
                              $this->db->where($where);
                              $query = $this->db->get();
                              return $query->result_array();
                           }
                 
                       public function getCount_menu_complete_orders($tbl,$where)
                       {
                           $this->db->select('count(room_service_menu_order_id) as total_count');
                           $this->db->from($tbl);
                           $this->db->where($where);
                           $query = $this->db->get();
                           return $query->result_array();
                       }

                       // public function getCount_rejected_orders($tbl,$where)
                       // {
                       //    $this->db->select('count(rmservice_services_order_id) as total_count');
                       //    $this->db->from($tbl);
                       //    $this->db->where($where);
                       //    $query = $this->db->get();
                       //    return $query->result_array();
                       // }
                      
                             // reserve table data
                             public function get_notifications_for_rs_1($hotel_id)
                             {
                                 // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
                                 $this->db->where('notifications.send_by_id',$hotel_id);
                                 $this->db->where('notifications.send_for',7);
                                 $this->db->order_by('notifications.notification_id','desc');
                                 // $this->db->where('notifictions_department_id.department_id',3);
                                 return $this->db->get('notifications')->result_array();
                             }
                             public function get_staff_noti($hotel_id)
                             {
                                 $this->db->join('notifictions_department_id','notifications.notification_id = notifictions_department_id.notification_id');
                                 $this->db->where('notifications.send_by_id',$hotel_id);
                                 $this->db->where('notifications.send_for',7);
                                 $this->db->where('order_status',0);              
                                 $this->db->where('notifictions_department_id.department_id',3);
                                 return $this->db->get('notifications')->result_array();
                             }
                             public function get_count_converted_leads()
                             {
                                 //$this->db->where('request_status',$request_status1);
                                  $this->db->DISTINCT('hotel_enquiry_request_id');
                                 return $this->db->get('hotel_enquiry_request')->result_array();
                             }
                             public function get_count_guest_converted_leads()
                             {
                               //  $this->db->where('request_status',$request_status1);
                               $this->db->DISTINCT('guest_user_id');
                               return $this->db->get('guest_user')->result_array();
                             }
                             public function get_total_converted_revenue_leads($request_status1)
                                            {
                                                $this->db->select('sum(room_charges) as total_amt');
                                                $this->db->where('request_status',$request_status1);
                                                return $this->db->get('hotel_enquiry_request')->result_array();
                                            }
                                            public function get_weekly_leads_revenue($hotel_id)
                                            {
                                                $this->db->where('hotel_id',$hotel_id);
                                                // $this->db->where('created_at >=',date('Y-m-d'));
                                                $this->db->where('created_at <=',date('Y-m-d',strtotime('-7 day')));
                                                // $this->db->where('MONTH(order_date)',date("m"));
                                                return $this->db->get('admin_purchase_leads')->result_array();
                                            }
                                            public function get_weekly_lead_conversion($hotel_id)
                                            {    
                                                // $this->db->group_by('MONTH(created_at)');
                                                // $this->db->select('sum(room_charges)as total_rev');
                                                $this->db->where('hotel_id',$hotel_id);
                                                $this->db->where('request_status',1);
                                                // $this->db->where('created_at >=',date('Y-m-d'));
                                                $this->db->where('check_in_date <=',date('Y-m-d',strtotime('-7 day')));
                                                return $this->db->get('hotel_enquiry_request')->result_array();
                                            }
                                             //current month total lead
                                            public function get_current_month_total_lead($hotel_id)
                                            {
                                                // $this->db->select('sum(amount) as total_amt');
                                                $this->db->where('hotel_id',$hotel_id);
                                                // $this->db->where('check_in_date >=',date('Y-m-d'));
                                                $this->db->where('created_at <=',date('Y-m-d',strtotime('-30 day')));
                                                return $this->db->get('admin_purchase_leads')->result_array();
                                            }
    
    
    
                                               //current month lead conversion
                                               public function get_current_month_total_revenue($hotel_id)
                                               {
                                                //    $this->db->select('sum(room_charges) as total_amt');
                                                   $this->db->where('hotel_id',$hotel_id);
                                                   $this->db->where('request_status',1);
                                                //    $this->db->where('check_in_date >=',date('Y-m-d'));
                                                   $this->db->where('check_in_date <=',date('Y-m-d',strtotime('-30 day')));
                                                   return $this->db->get('hotel_enquiry_request')->result_array();
                                               }
                                                 //get total lead in yearly
                                            public function get_yearly_lead_revenue($hotel_id)
                                            {
                                                // $this->db->select('sum(amount) as total_amt');
                                                $this->db->where('hotel_id',$hotel_id);
                                                // $this->db->where('check_in_date >=',date('Y-m-d'));
                                                $this->db->where('created_at <=',date('Y-m-d',strtotime('-30 day')));
                                                return $this->db->get('admin_purchase_leads')->result_array();
                                            }
    
                                            //get yearly lead conversion
                                            public function get_yearly_lead_conversion($hotel_id)
                                            {
                                             //    $this->db->select('sum(room_charges) as total_amt');
                                                $this->db->where('hotel_id',$hotel_id);
                                                $this->db->where('request_status',1);
                                             //    $this->db->where('check_in_date >=',date('Y-m-d'));
                                                $this->db->where('check_in_date <=',date('Y-m-d',strtotime('-30 day')));
                                                return $this->db->get('hotel_enquiry_request')->result_array();
                                            }
                                            public function get_total_revenue_leads()
                                            {
                                                $this->db->select('sum(purchase_price) as total_amt');
                                                // $this->db->where('request_status',$request_status1);
                                                return $this->db->get('admin_purchase_leads')->result_array();
                                            }
                                            public function get_leads_recharge()
                                            {
                                                $this->db->select('sum(leads_recharge.lead_cost) as total_amt');
                                                $this->db->join('leads_recharge','leads_recharge.city = hotel_enquiry_request.hotel_id');
                                                // $this->db->group_by('hotel_enquiry_request.hotel_id');
                                                // $this->db->where('hotel_enquiry_request.request_status',1);
                                                return $this->db->get('hotel_enquiry_request')->result_array();
                                            }
                                            public function get_convert_leads_recharge()
                                            {
                                                $this->db->select('(sum((leads_recharge.lead_percentage))/100 * (hotel_enquiry_request.room_charges)) as total_amt');
                                                $this->db->join('leads_recharge','leads_recharge.city = hotel_enquiry_request.hotel_id');
                                                $this->db->group_by('hotel_enquiry_request.hotel_enquiry_request_id');
                                                //$this->db->where('hotel_enquiry_request.request_status',3);
                                                $this->db->or_where('hotel_enquiry_request.request_status',4);
                                                return $this->db->get('hotel_enquiry_request')->result_array();
                                            }
    // room service complete order count last 7 days//7-12-2022 //archana
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
    public function getCount_active_staff($tbl,$where)
    {
      $this->db->select('count(u_id) as total_count');
      $this->db->from($tbl);
      $this->db->where($where);
      $query = $this->db->get();
      return $query->result_array();
    }
    public function get_offer_list_food($hotel_id,$order_status)
    {
      $this->db->where('hotel_id',$hotel_id);
      $this->db->where('offer_for',$order_status);
      return $this->db->get('offers')->result_array();
    }
    public function getDataActivity($tbl,$where)
        {
          $this->db->select('*');
          $this->db->order_by('food_order_id','DESC');
          $this->db->where('order_status',2);
          $this->db->where($where);
          $this->db->from($tbl);
          $query = $this->db->get();
          return $query->result_array();
        }
        public function get_notifications_for_food_1($hotel_id)
        {
            // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
            $this->db->where('notifications.send_by_id',$hotel_id);
            $this->db->where('notifications.send_for',7);
            // $this->db->where('notifictions_department_id.department_id',5);
            $this->db->order_by('notifications.notification_id','desc');
            //$this->db->limit(4);
            return $this->db->get('notifications')->result_array();
        }
    public function get_notifications_for_food($hotel_id)
    {
        // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
        $this->db->where('notifications.send_by_id',$hotel_id);
        $this->db->where('notifications.send_for',7);
        // $this->db->where('notifictions_department_id.department_id',5);
        $this->db->order_by('notifications.notification_id','desc');
        $this->db->limit(4);
        return $this->db->get('notifications')->result_array();
    }
    public function get_notifications_for_food_limit($hotel_id)
    {
        // $this->db->join('notifictions_department_id','notifications.notification_id = notifications.notification_id');
        $this->db->where('notifications.send_by_id',$hotel_id);
        $this->db->where('notifications.send_for',7);
        // $this->db->where('notifictions_department_id.department_id',5);
        $this->db->order_by('notifications.notification_id','desc');
        $this->db->limit(4);
        return $this->db->get('notifications')->result_array();
    }
    public function get_offer_list($hotel_id,$order_status)
    {
        $this->db->where('hotel_id',$hotel_id);
        $this->db->where('offer_for',$order_status);
        return $this->db->get('offers')->result_array();
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
  
     // to get data in row 10-10-2022 ravina
    public function getData($tbl,$where)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();
    } 
    public function getAllData($tbl,$wh)
    {
        $this->db->where($wh);
        return $this->db->get($tbl)->result_array();
    }
     public function get_user_data($u_id)
    {
        $this->db->where('u_id',$u_id);
        return $this->db->get('register')->row_array();
    }
    public function get_listt($u_id)
    {  
        $this->db->select('*');
        $this->db->from('hotels_panel_list');
        $this->db->join('register','register.u_id = hotels_panel_list.admin_id');
        // $this->db->join('depa8rtement','departement.department_id  = hotels_panel_list.admin_id');
        $this->db->where('u_id',$u_id);
        return $this->db->get()->result_array();
    }
    public function get_listt1($u_id)
    {  
        $this->db->select('*');
        $this->db->from('hotels_panel_list');
      
        $this->db->where('id',$u_id);
        return $this->db->get()->result_array();
    }
    public function getSingleData($tbl,$where)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        $query = $this->db->get();        
        return $query->row_array();
    }
    public function get_reuest_accept_list($tbl,$where)
    {
        $this->db->select('hotel_id');
        $this->db->DISTINCT();
        $this->db->from($tbl);
        $this->db->where($where);
        
        $query = $this->db->get();
        return $query->result_array();
      
    }
    public function get_facility_list_pagination($hotel_id)
        {
              $data = array();
              $this->db->select('*');
              $this->db->order_by('food_facility_id','DESC');
              //$this->db->where('added_by',2);
              $this->db->where('hotel_id',$hotel_id);
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

    function get_facility_category_list_pagination($hotel_id)
    {
          $data = array();
          $this->db->select('*');
          $this->db->order_by('food_facility_id','DESC');
          //$this->db->where('added_by',2);
          $this->db->where('hotel_id',$hotel_id);
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
     function get_menu_list_pagination($hotel_id)
        {
              $data = array();
              $this->db->select('*');
              $this->db->where('hotel_id',$hotel_id);
              //$this->db->order_by('food_item_id','DESC');            
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
 function get_accepted_menu_list_pagination($hotel_id)
       {
              $data = array();
              $this->db->select('*');
              //$this->db->limit($limit, $offset);
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
 function get_menu_new_order_list_pagination($hotel_id)
       {
              $data = array();
              $this->db->select('*');
              $this->db->order_by('food_order_id','DESC');
              $this->db->where('order_status',0);
              // $this->db->where('order_date',$todays_date);
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

 function get_reserve_table_pending_list_pagination($hotel_id,$todays_date)
          {
                 $data = array();
                 $this->db->select('*');
                 $this->db->order_by('reserve_table_id','DESC');
                 $this->db->where('request_status',0);
                 $this->db->where('request_date',$todays_date);
                 $this->db->where('hotel_id',$hotel_id);
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

function get_reserve_table_accept_list_pagination($hotel_id)
          {
                 $data = array();
                 $this->db->select('*');
                 $this->db->order_by('reserve_table_id ','DESC');
                 $this->db->where('request_status',1);
                 $this->db->where('hotel_id',$hotel_id);
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


          function get_reserve_table_reject_list_pagination($hotel_id,$where)
          {
                 $data = array();
                 $this->db->select('*');
                 $this->db->order_by('reserve_table_id','DESC');
                 //$this->db->where('request_status',2);
                 $this->db->where('hotel_id',$hotel_id);
                 $this->db->where($where);
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
 function get_user_complete_menu_list_pagination($hotel_id,$u_id)
          {
                 $data = array();
                 $this->db->select('*');
                 $this->db->order_by('food_order_id ','DESC');
                 $this->db->where('order_status',2);
                 $this->db->where('hotel_id',$hotel_id);
                 $this->db->where('staff_id',$u_id);
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
  
        function facility_name($tbl, $where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->where($where);
            $query =$this->db->get();
            return $query->row_array();
        }     

         function get_cat_name($tbl, $where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->where($where);
            $query =$this->db->get();
            return $query->row_array();
        }  
        function get_staff_list_pagination($hotel_id)
       {
             $data = array();
             $this->db->select('*');
             $this->db->order_by('u_id','DESC');
             $this->db->where('user_type',8);
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
             $this->db->where('review_for',4);
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

 function get_banquet_hall_all_list_pagination($hotel_id,$wh1)
       {
             $data = array();
             $this->db->select('*');
             $this->db->order_by('banquet_hall_orders_id','DESC');
             $this->db->where('hotel_id',$hotel_id);
             $this->db->where($wh1);
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

        function get_banquet_hall_new_list_pagination($hotel_id)
       {
             $data = array();
             $this->db->select('*');
             $this->db->order_by('banquet_hall_orders_id','DESC');
             $this->db->where('request_status',0);
             $this->db->where('hotel_id',$hotel_id);
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
     public function insertData($tbl,$arr)
        {
            $this->db->insert($tbl,$arr);
            return $this->db->insert_id();
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
         public function edit_data($tbl,$where,$arr)
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
         public function group_city($tbl,$where)
        {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->distinct('city'); 
        $query = $this->db->get();
        return $query->result_array();
        }
        

        // 05-04-2023
        public function get_Terms_Conditions_hotels()
        {
            $this->db->where('tc_form',1);
            return $this->db->get('terms_condition')->row_array();
        }
        public function insert_data($tbl,$arr)
        {
            $this->db->insert($tbl,$arr);
            $insert_id=$this->db->insert_id();
            return $insert_id;
        }
        public function get_Privacy_policy_hotels()
        {
            $this->db->where('privacy_policy_for',2);
            return $this->db->get('privacy_policy')->row_array();
        }
        public function get_Terms_Condition_Customers()
        {
            $this->db->where('content is NOT NULL', NULL, FALSE);
            return $this->db->get('terms_condition')->row_array();
        }
        public function get_Privacy_Policy_Customers()
        {
            $this->db->where('privacy_policy_for',1);
            return $this->db->get('privacy_policy')->row_array();
        }
        public function get_requestet_list_hotels($tbl,$where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            //$this->db->group_by('u_id');
            $this->db->where($where);
            // $this -> db -> where('request_status', 0);
            // $this->db->where('request_status',0);
            // $this->db->where('request_status',1);
        //    $this -> db -> where('request_status = 1 OR request_status = 0');

            $query = $this->db->get();
            return $query->result_array();
        }

        // -06-04-2023
        public function get_user_room_service_menu_completed_order_list($u_id,$booking_id)
        {
            $this->db->select('room_serv_menu_list.menu_name,room_service_menu_details.*');
            $this->db->join('room_service_menu_details','room_service_menu_details.room_service_menu_order_id = room_service_menu_orders.room_service_menu_order_id');
            $this->db->join('room_serv_menu_list','room_service_menu_details.room_service_menu_order_id = room_serv_menu_list.room_serv_menu_id');
            // $this->db->where('room_service_menu_orders.hotel_id',$hotel_id);
            $this->db->where('room_service_menu_orders.u_id',$u_id);
            $this->db->where('room_service_menu_orders.booking_id',$booking_id);
            $this->db->where('room_service_menu_orders.order_status',2);
            $this->db->where('room_service_menu_orders.is_paid_after_check_out',1);
            return $this->db->get('room_service_menu_orders')->result_array();
        }
        public function get_user_checkout_booking_details_amt($hotel_id,$user_checkout_data_id,$description)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('user_checkout_data_id',$user_checkout_data_id);
            $this->db->where('description',$description);
            // $this->db->where('date',$date);
            return $this->db->get('user_checkout_details')->result_array();
        }
        public function get_user_checkout_booking_details_subtotal($hotel_id,$user_checkout_data_id,$description)
        {
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('user_checkout_data_id',$user_checkout_data_id);
            $this->db->where('description_name',$description);
            return $this->db->get('user_checkout_sub_total')->row_array();
        }
        public function get_preference($tbl,$where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->where($where);
            
            $query = $this->db->get();
            return $query->result_array();
        }
        public function getlan_lat()
        {
            $this->db->select('hotel_name,latitude,longitude,hotel_importans');
            $this->db->from('register');
            $this->db->where('user_type',2);
            $query = $this->db->get();
            return $query->result_array();
        }
        public function get_request($hotel_id,$request_status)
        {
            $this->db->join('hotel_enquiry_request','hotel_enquiry_request.hotel_id = register.u_id');

            $this->db->where('register.u_id',$hotel_id);
            $this->db->where('hotel_enquiry_request.request_status',$request_status);
            return $this->db->get('register')->result_array();
        }
        public function getlostdata($tbl,$wh){
            $this->db->select('*');
            $this->db->where('id',$wh);    
            return $this->db->get('lost_found_list')->row_array();
        }
        public function getexpenseData($tbl,$wh){
            $this->db->select('*');
            $this->db->where('expense_id',$wh);     
            return $this->db->get('expenses')->row_array();
        }
        public function getfloorData($tbl,$wh){
            $this->db->select('*');
            $this->db->where('floor_id',$wh);     
            return $this->db->get('floors')->row_array();
        }
        public function getroomData($tbl,$wh){
            $this->db->select('*');
            $this->db->where('room_type_id',$wh);     
            return $this->db->get('room_type')->row_array();
        }
        public function get_email_data($tbl,$wh)
        {
            $this->db->where($wh);
            return $this->db->get($tbl)->row_array();
        }
        public function get_en_req($tbl,$where)
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->where($where);
            $this->db->group_by('hotel_id');
            $query = $this->db->get();        
            return $query->result_array();
        }
      
        public function getenquirydata($tbl,$wh){
            $this->db->select('*');
            $this->db->where('hotel_enquiry_request_id',$wh);     
            return $this->db->get('hotel_enquiry_request')->row_array();
        }

        public function hotel_list_dashboard($tbl,$where)
        {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        $this->db->distinct('hotel_name'); 
        $query = $this->db->get();
        return $query->result_array();
        }
}