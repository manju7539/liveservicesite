<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoomserviceController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->model('RoomserviceModel');
        $this->load->model('MainModel');
        $this->load->library('pagination');

        if (empty($this->session->userdata('u_id'))) {
            redirect('/');
        }
        // $this->load->library('pagination');
    }

    public function header_order_count()
    {
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id'];

        $todays_date = date('Y-m-d');
        $where = '(order_date = "'.$todays_date.'" AND order_status = 0 AND hotel_id ="'.$hotel_id.'")';
        $on_call_ord = $this->MainModel->getAllData1($tbl='room_service_menu_orders',$where);
        $on_cl_count = !empty($on_call_ord) ? count($on_call_ord) : 0;
        echo json_encode($on_cl_count); 
        exit;
    }

    public function menuNewOrder()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData('register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $todays_date = date('Y-m-d');
        $data["list"] = $this->RoomserviceModel->get_new_order_list($todays_date, $hotel_id);
        // echo "<pre>";
        // print_r($data['list']);
        // exit;
        $this->load->view('include/header');
        $this->load->view('roomservice/viewMenuNewOrder', $data);
        $this->load->view('include/footer');
    }

    public function view_requirement_data()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $id = $this->input->post('id');
        $wh1 = '(room_service_menu_order_id ="'.$id.'")';
        $data['get_h_orders_data'] = $this->MainModel->getAllData1('room_service_menu_details',$wh1);
        $this->load->view('roomservice/ajaxview_modal_data', $data);
    }

    public function menuAcceptedOrder()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["order_data"] = $this->RoomserviceModel->get_all_accepted_orders_pagination($admin_id);
        
        $this->load->view('include/header');
        $this->load->view('roomservice/viewmenuAcceptedOrder', $data);
        $this->load->view('include/footer');
    }
    public function menuCompletedOrder()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["list"] = $this->RoomserviceModel->get_service_completed_list_pagination($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewMenuCompletedOrder', $data);
        $this->load->view('include/footer');
    }

    //chiragi add method
    public function change_new_order_status()
    {
        $otp = rand('1111','9999');
        $u_id = $this->session->userdata('u_id');
        // print_r($this->session->userdata());
        // exit;
        $wh = '(u_id = "'.$u_id.'")';
        $get_data = $this->MainModel->getData('register', $wh);

        $room_service_menu_order_id = $this->input->post('room_service_menu_order_id');
    
        $wh111 = '(room_service_menu_order_id = "'.$room_service_menu_order_id.'")';

        $rs_m_order_data = $this->MainModel->getData('room_service_menu_orders',$wh111);
        
        $order_status = $this->input->post('order_status');
        // $time = $this->input->post('time');
        $staff_id =$this->input->post('staff_id');
    
        $user_id = $this->input->post('uid');
        if ($order_status == 1) 
        {
                $arr = array(
                                'order_status' =>1,
                                'staff_id' =>$staff_id,
                                'accept_date'=>date('Y-m-d'),
                                'accept_time' =>date('G:i:s'),
                                'otp' =>$otp
                            );

                //$wh = '(room_service_unique_id = "'.$room_service_unique_id.'")';
                $add = $this->MainModel->editData($tbl='room_service_menu_orders', $wh111, $arr);
                if ($add) 
                {  
                    $arr = array(
                        'order_status' =>1,
                        'staff_id' =>$staff_id,
                        'accept_date'=>date('Y-m-d'),
                        'accept_time' =>date('G:i:s'),
                        'otp' =>$otp
                    );
                    $wh = '(room_service_unique_id = "'.$rs_m_order_data['room_service_unique_id'].'")';
                    $add11 = $this->MainModel->editData($tbl='rmservice_services_orders', $wh, $arr);
                    
                        $arr2 = array(
                                    'hotel_id' =>$get_data['hotel_id'],
                                    'u_id'=>$user_id,
                                    'subject' => 'Request Accept',
                                    'description' => 'user order request accept by room service and assign their staff',
                                );
                    $insert_id3 = $this->RoomserviceModel->insert_data($tbl="user_notification", $arr2);
                    
                    $this->session->set_flashdata('order_msg', 'Success..!');
                    
                    redirect(base_url('menuNewOrder'));
                } 
                else 
                {
                    $this->session->set_flashdata('order_msg', 'Something went Wrong');
                    redirect(base_url('menuNewOrder'));
                }
        }
        elseif($order_status == 3)
        {
                $arr = array(
                                'order_status' =>3,  
                                'reject_date' =>date('Y-m-d')   
                            );

                //$wh = '(room_service_menu_order_id = "'.$room_service_menu_order_id.'")';
                $add = $this->MainModel->editData($tbl='room_service_menu_orders',$wh111, $arr);
                if ($add) 
                {
                $arr = array(
                    'order_status' => $order_status,
                    'reject_date' => date('Y-m-d')
                    
                );

                    $wh = '(room_service_unique_id = "'.$rs_m_order_data['room_service_unique_id'].'")';
                    $add = $this->MainModel->editData($tbl='rmservice_services_orders', $wh, $arr);

                    $this->session->set_flashdata('order_msg', 'Success..!');
                    redirect(base_url('menuNewOrder'));
                } 
                else 
                {
                    $this->session->set_flashdata('order_msg', 'Something went Wrong');
                    redirect(base_url('menuNewOrder'));
                }
        }

    }
    //end method
    public function menuRejectedOrder()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["list"] = $this->RoomserviceModel->get_service_rejected_list_pagination($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewMenuRejectedOrder', $data);
        $this->load->view('include/footer');
    }

    // public function deshboard_room_number()
    // {
    //     $click_on_room_number = $this->input->post('room_number');

    //     $u_id = $this->session->userdata('u_id');   
    //     $where = '(u_id = "' . $u_id . '")';
    //     $admin_details = $this->MainModel->getData($tbl = 'register', $where);
    //     $hotel_id = $admin_details['hotel_id'];
    //     $todays_date = date('Y-m-d');

    //     $where = '(order_date = "'.$todays_date.'" AND order_status = 0 AND order_from = 3 AND hotel_id ="'.$hotel_id.'" AND room_no = "'.$click_on_room_number.'")';
    //     $data["list"] = $this->RoomserviceModel->getAllData1('rmservice_services_orders',$where);
    //     $data["order_data"] = $this->RoomserviceModel->get_service_accepted_orders($hotel_id,$click_on_room_number);
    //     $data["rejected_list"] = $this->RoomserviceModel->get_Service_rejected_pagination($hotel_id,$click_on_room_number);
    //     $data["completed_list"] = $this->RoomserviceModel->service_completed_list_pagination($hotel_id,$click_on_room_number);
    //     redirect('roomServiceOrder');
    //     // $this->load->view('include/header');
    //     // $this->load->view('roomservice/viewRoomServiceOrder', $data);
    //     // $this->load->view('include/footer');
    // }

    public function roomServiceOrder()
    {
        $click_on_room_number = $this->input->get('room_no');
        $u_id = $this->session->userdata('u_id');   
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $todays_date = date('Y-m-d');
        if(!empty($click_on_room_number))
        {
            $where = '(order_date = "'.$todays_date.'" AND order_status = 0 AND order_from = 3 AND hotel_id ="'.$hotel_id.'" AND room_no = "'.$click_on_room_number.'")';
        $data["list"] = $this->RoomserviceModel->getAllData1('rmservice_services_orders',$where);
        $data["order_data"] = $this->RoomserviceModel->get_service_accepted_orders($hotel_id,$click_on_room_number);
        // echo "<pre>";
        // print_r($this->db->last_query());
        //     // exit;
        // echo "<pre>";
        // print_r($data["order_data"]);
        // exit;
        $data["rejected_list"] = $this->RoomserviceModel->get_Service_rejected_pagination($hotel_id,$click_on_room_number);
        $data["completed_list"] = $this->RoomserviceModel->service_completed_list_pagination($hotel_id,$click_on_room_number);
        }
        else
        {
           $where = '(order_date = "'.$todays_date.'" AND order_status = 0 AND order_from = 3 AND hotel_id ="'.$hotel_id.'")';
        $data["list"] = $this->RoomserviceModel->getAllData1('rmservice_services_orders',$where);
        $data["order_data"] = $this->RoomserviceModel->get_service_accepted_orders($hotel_id);
        // echo "<pre>";
        // print_r($this->db->last_query());
        //     // exit;
        // echo "<pre>";
        // print_r($data["order_data"]);
        // exit;
        $data["rejected_list"] = $this->RoomserviceModel->get_Service_rejected_pagination($hotel_id);
        $data["completed_list"] = $this->RoomserviceModel->service_completed_list_pagination($hotel_id); 
        }
        
        $this->load->view('include/header');
        $this->load->view('roomservice/viewRoomServiceOrder', $data);
        $this->load->view('include/footer');
    }

    public function orderbyroom()
    {
        $this->load->view('include/header');
        $this->load->view('roomservice/vieworder_by_room');
        $this->load->view('include/footer');
    }

    public function newroomServiceOrder()
    {
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $by_columns = $this->input->post('columns');
        $columnName = $by_columns[0]['data'];

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $todays_date = date('Y-m-d');

        $neworderfrom_room_Data = $this->RoomserviceModel->get_neworderfrom_room_Data($rowperpage, $row, $search,$columnName,$hotel_id,$todays_date);

        $total_neworderfrom_room_ = $this->RoomserviceModel->getTotal_neworderfrom_room($search, $hotel_id,$todays_date);
        $totalRecords = $total_neworderfrom_room_->total_record;

        $data = array();
        $i=1;
        foreach($neworderfrom_room_Data AS $val)
        {
            // echo "<pre>";
            // print_r($neworderfrom_room_Data);
            $order_from = '';
            if($val['order_from'] == 1)
            {
                $order_from = "On Call Order";

            }
            elseif($val['order_from'] == 2)
            {
                $order_from = "Staff Order";
            }
            elseif($val['order_from'] == 3)
            {
                $order_from = "App";
            }
            else{
                $order_from = "-";
            }
            
            $guest_typee = '';
            if($val['guest_type'] == 1)
            {
                $guest_typee = "Regular";
            }
            elseif($val['guest_type'] == 2)
            {
                $guest_typee = "VIP";
            }
            elseif($val['guest_type'] == 3)
            {
                $guest_typee = "Complete House Guest";
            }
            elseif($val['guest_type'] == 4)
            {
                $guest_typee = "WHC";
            }
            else
            {
                $guest_typee = "-";
            }
            $od_time = date('h:i A', strtotime($val['order_time']));
            $date = '<h5>'.$val['order_date'].'<sub>'.$od_time.'</sub></h5>';
            $requirement = '<div class="badge badge-secondary view_class_modal" data-id="'.$val['room_service_menu_order_id'].'">view</div>';
            // $Action = '<a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="'.$val['r_s_services_id'].'"><i class="fa fa-pencil"></i></a> <a href="#"  data-delete-id="'.$val['r_s_services_id'].'"class="btn btn-danger btn-xs delete_click_modal"><i class="fa fa-trash"></i></a>';
            $note = '<div><a href="#"><div class="badge badge-info" data-bs-toggle="modal" data-bs-target=".order_desc_'.$val['room_service_menu_order_id'].'">view</div></a></div>';
            $action = '<a href="#" class="btn btn-warning btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".status_'.$val['room_service_menu_order_id'].'"><i class="fa fa-share"></i></a>';
            // echo "<pre>";
            // print_r($val);
            $data[] = array(
                "sr_no"         => $i++,
                "order_id"      => $val['rmservice_services_order_id'],
                "order_type"    => $order_from,
                "date"          => $date,
                "floor"         => '',
                "room_no"       => $val['room_no'],
                "name"          => $val['guest_name'],
                "requirement"   => $requirement,
                "gest_type"     => $guest_typee,
                "note"          => $note,
                "phone"         => '',
                "Action"        => $action  
            );
        }
        exit;

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );

        echo json_encode($response);

        //  End :: datatable code 
    
    
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData('register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $todays_date = date('Y-m-d');
        $data["list"] = $this->RoomserviceModel->get_new_order_list($todays_date, $hotel_id);

        // $u_id = $this->session->userdata('u_id');
        // $where = '(u_id = "' . $u_id . '")';
        // $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        // $hotel_id = $admin_details['hotel_id'];
        
		// $todays_date = date('Y-m-d');
        // $where = '(order_date = "'.$todays_date.'" AND order_status = 0 AND order_from = 3 AND hotel_id ="'.$hotel_id.'"  )';
        // $data["new_order_data"] = $this->RoomserviceModel->getAllData1('room_service_menu_orders',$where);
        // $this->load->view('roomservice/ajaxnewroomServiceOrder', $data);
    }

    public function change_order_status()
   {
        $otp = rand('1111','9999');

        $rmservice_services_order_id = $this->input->post('rmservice_services_order_id');

        $wh111 = '(rmservice_services_order_id = "'.$rmservice_services_order_id.'")';

        $rs_s_order_data = $this->MainModel->getData('rmservice_services_orders',$wh111);

        $order_status = $this->input->post('order_status');

        $staff_id =$this->input->post('staff_id');
          
        if ($order_status == 1) 
        {
            $arr = array(
                            'order_status' =>$order_status,
                            'staff_id' =>$staff_id,
                            'accept_date' => date('Y-m-d'),
                            'accept_time' =>date('G:i:s'),
                            'otp'=>$otp
                        );

            //$wh = '(rmservice_services_order_id = "'.$rmservice_services_order_id.'")';
            $add = $this->MainModel->editData($tbl='rmservice_services_orders', $wh111, $arr);
            if ($add) 
            {
                $wh1 = '(room_service_unique_id = "'.$rs_s_order_data['room_service_unique_id'].'")';

            $arr_rs = array(
                            'order_status' => $order_status,
                            'staff_id' => $staff_id,
                            'accept_date' => date('Y-m-d'),
                            'otp' => $otp,
                        );

            $this->MainModel->editData('room_service_menu_orders',$wh1,$arr);
            
                $this->session->set_flashdata('add', 'Success..!');
                redirect(base_url('roomServiceOrder'));
            } 
            else 
            {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url('roomServiceOrder'));
            }
        }
        elseif($order_status == 3)
        {
                $arr = array(
                                    'order_status' => $order_status,
                                    'reject_date' => date('Y-m-d')
                                
                            );

                // $wh = '(rmservice_services_order_id = "'.$rmservice_services_order_id.'")';
                $add = $this->MainModel->editData($tbl='rmservice_services_orders', $wh111, $arr);
                if ($add) 
                {
                    
                $arr = array(
                    'order_status' => $order_status,
                    'reject_date' => date('Y-m-d')
                    
                );

                    $wh1 = '(room_service_unique_id = "'.$rs_s_order_data['room_service_unique_id'].'")';
                    $add = $this->MainModel->editData($tbl='room_service_menu_orders', $wh1, $arr);
                
                    $this->session->set_flashdata('add', 'Success..!');
                    redirect(base_url('roomServiceOrder'));
                }
                else 
                {
                    $this->session->set_flashdata('add', 'Something went Wrong');
                    redirect(base_url('roomServiceOrder'));
                }
        }

   }

    public function ServiceOrder_getdata()
    {
        // $u_id = $this->session->userdata('u_id');
        // $where = '(u_id = "' . $u_id . '")';
        // $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        // $admin_id = $admin_details['hotel_id'];

        // $data["new_order_data"] = $this->RoomserviceModel->get_service_new_list_pagination($where);
        // $this->load->view('roomservice/ajaxnewroomServiceOrder', $data);
    }

    public function roomServiceAcceptedOrder()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["order_data"] = $this->RoomserviceModel->get_service_accepted_orders($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewRoomServiceAcceptedOrder', $data);
        $this->load->view('include/footer');
    }

    public function newroomServiceAcceptedOrder()
    {
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $columnName ='';
        foreach($this->input->post('columns') AS $col)
        {
            $columnName = $col['data'];
        }
        // echo "<pre>";
        // print_r($search);
        // exit;

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];

        $accepted_order_data = $this->RoomserviceModel->get_accepted_order_data($rowperpage, $row, $search,$columnName,$hotel_id);
        // echo "<pre>";
        // print_r($accepted_order_data);
        // exit;
        $total_accepted_order = $this->RoomserviceModel->get_total_accepted_order($search, $hotel_id);
        
        $totalRecords = $total_accepted_order->total_record;

        $data = array();
        $i=1;
        foreach($accepted_order_data AS $val)
        {
            $guest_name = !empty($val['full_name']) ? $val['full_name'] : '-';
            $guest_typee = !empty($val['guest_type']) ? $val['guest_type'] : '-';
            $room_no = !empty($val['room_no']) ? $val['room_no'] : '-';
            $floor_no = !empty($val['floor']) ? $val['floor'] : '-';
            $staff_name = $val['staff_name'];
            $order_type = '';
            if($val['order_from'] == 1)
            {
            $order_type = 'On Call';
            }
            elseif($val['order_from'] == 2)
            {
            $order_type = 'From Staff';
            }
            elseif($val['order_from'] == 3)
            {
            $order_type = 'App';
            }
            else{
            $order_type = '-';

            }
            // gest type
            if($val['guest_type'] == 1)
            {
                $guest_typee = "Regular";
            }
            elseif($val['guest_type'] == 2)
            {
                $guest_typee =  "VIP";
            }
            elseif($val['guest_type'] == 3)
            {
                $guest_typee =  "Complete House Guest";
            }
            elseif($val['guest_type'] == 4)
            {
                $guest_typee =  "WHC";
            }
            else
            {
                $guest_typee = "-";
            }
            
            $requirement = '<a href="#" class="btn btn-secondary btn-xs modelclick" order-id="'.$val['rmservice_services_order_id'].'"><i class="fa fa-eye"></i></a>';
        
            if($val['order_status'] == 0)
            {
            $order_status = 'New Order';
            }
            elseif($val['order_status'] == 1)
            {
            $order_status = 'Accepted';
            }
            elseif($val['order_status'] == 2)
            {
            $order_status = 'Completed';
            }
            elseif($val['order_status'] == 3)
            {
            $order_status = 'Rejected';
            }
            $status_order = '<h5><a href="#"><div class="badge badge-success">'.$order_status.'</div></a></h5>';
            $data[] = array(
                    "sr_no"         =>  $i++,
                    "order_id"      =>  $val['rmservice_services_order_id'],
                    "order_type"    =>  $order_type,
                    "date"          =>  $val['order_date'],
                    "floor"         =>  $floor_no,
                    "room_no"       =>  $room_no,
                    "name"          =>  $guest_name,
                    "requirement"   =>  $requirement,
                    "gest_type"     =>  $guest_typee,
                    "assign_to"     =>  $staff_name,
                    "status"        =>  $status_order
            );
        }
       

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );
        // echo "<pre>";
        // print_r($response);
        // exit;
        echo json_encode($response);
        
        // $this->load->view('roomservice/ajaxnewroomServiceAcceptedOrder', $data);
    }

    public function order_accep_req()
    {
        $order_id = $this->input->post('orderid');
        $wh1 = '(rmservice_services_order_id ="'.$order_id.'")';
        $get_h_orders_data = $this->MainModel->getAllData1('rmservice_services_details',$wh1);
        $service_name = '';
        $amount = '';
        $image = '';
        $quantity = '';
        $i='';
        foreach ($get_h_orders_data as $g1) 
        {
            $wh11 = '(r_s_services_id  ="'.$g1['room_serv_service_id'].'")';
            $menu_namee = $this->MainModel->getData('room_servs_services',$wh11); 
            if(!empty($menu_namee))
            {
                $service_name = $menu_namee['service_name'];
                $amount = $menu_namee['amount'] * $g1['quantity'] ;
                $image = $menu_namee['icon_img'];
                $quantity = $g1['quantity'];
            }
            else
            {
                $service_name ='-';
                $amount = '-';
                $image ='-';
                $quantity = '-';
            }
            $i++;
        }
        $data['srno'] = $i;
        $data['service_name'] = $service_name;
        $data['amount'] = $amount;
        $data['image'] = $image;
        $data['quantity'] = $quantity;
        echo json_encode($data);
    }

    public function roomServiceRejectedOrder()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["list"] = $this->RoomserviceModel->get_Service_rejected_pagination($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewroomServiceRejectedOrder', $data);
        $this->load->view('include/footer');
    }

    public function newroomServiceRejectedOrder()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["rejected_order_data"] = $this->RoomserviceModel->get_Service_rejected_pagination($admin_id);
        $this->load->view('roomservice/ajaxnewroomServiceRejectedOrder', $data);
    }

    public function ServiceRejectedOrder_getdata()
    {

    }

    public function roomServiceCompletedOrder()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["list"] = $this->RoomserviceModel->service_completed_list_pagination($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewRoomServiceCompletedOrder', $data);
        $this->load->view('include/footer');
    }

    public function newroomServiceCompletedOrder()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["list"] = $this->RoomserviceModel->service_completed_list_pagination($admin_id);
        $this->load->view('roomservice/ajaxroomServiceCompletedOrder', $data);
    }

    public function ServiceCompletedOrder_getdata()
    {

    }

    public function search_completed_order()
    {
        // echo "hello";
        // exit;
        $complated_by = $this->input->post('complated_by');
        if (isset($complated_by)) 
			{
				$data["list"] = $this->RoomserviceModel->get_service_list_pagination_1($complated_by);
				// $this->load->view('roomservice/ajaxroomServiceCompletedOrder',$data);
                $this->load->view('roomservice/ajaxroomServicesearchdata',$data);
			}
    }

    public function menuManage()
    {
        $this->load->view('include/header');
        $this->load->view('roomservice/viewMenuManage');
        $this->load->view('include/footer');
    }
    // public function menuManage_table()
    // {
    //     $selected_id = $this->input->post('selected_id');
    //     $u_id = $this->session->userdata('u_id');
    //     $where = '(u_id = "' . $u_id . '")';
    //     $admin_details = $this->MainModel->getData($tbl = 'register', $where);
    //     $hotel_id = $admin_details['hotel_id'];
    //     $service['menu_list'] = $this->RoomserviceModel->get_default_menu_list_data($hotel_id,$selected_id);
    //     $this->load->view('roomservice/ajaxviewMenuManage', $service);
    // }

    public function menuManage_table()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $selected_id = $this->input->post('selected_id');
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        // $service['menu_list'] = $this->RoomserviceModel->get_default_menu_list_data($hotel_id,$selected_id);
        // $this->load->view('roomservice/ajaxviewMenuManage', $service);
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $by_columns = $this->input->post('columns');
        $columnName = '';
        foreach($by_columns AS $col)
        { 
            $columnName = $col['data'];
        }
       
        $first_menu_list = $this->RoomserviceModel->get_first_menu_list($rowperpage, $row, $search,$columnName,$hotel_id,$selected_id);

        $total_first_menu_list = $this->RoomserviceModel->getTotal_first_menu_list($search, $hotel_id,$selected_id);
        $totalRecords = $total_first_menu_list->total_record;
        $table_id = $this->input->post('tb_id');
        $data = array();
        $i=1;
        foreach($first_menu_list AS $val)
        {
            $time_in = '';
            if($val['time_in'] == 1)
            {
                $time_in = "Min";

            }
            elseif($val['time_in'] == 2)
            {
                $time_in = "Hrs";
            }
            else
            {
                $time_in ="-";
            }
            $price = '<h5> <i class="fa fa-rupee"></i>'.$val['price'].'</h5>';
            $photo = '<div class="lightgallery"class="room-list-bx d-flex align-items-center"><img class="me-3" src="'.$val['image'].'" alt="" style="width:40px; height:40px;"></div>';
            $priperation_time = '<h5>'.$val['prepartion_time'].$time_in.'</h5>';
            $action = '<div class="d-flex"><a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="'.$val['room_serv_menu_id'].'" data-table-id="'.$table_id.'"><i class="fa fa-pencil"></i></a><a href="#"  data-delete-id="'.$val['room_serv_menu_id'].'"class="btn btn-danger btn-xs delete_click_modal"><i class="fa fa-trash"></i></a></div>';
            // echo "<pre>";
            // print_r($val);
            $data[] = array(
                "sr_no"             => $i++,
                "Item_Name"         => $val['menu_name'],
                "Price"             => $price,
                "Photo"             => $photo,
                "Preparation_time"  => $priperation_time,
                "Details"           => $val['details'],
                "Action"            => $action
            );
            // echo "<pre>";
            // print_r($data);
        }
        // exit;

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );

        echo json_encode($response);

        //  End :: datatable code 
    }

    public function MenuManagementdata()
    {
        $category_id = $this->input->post('id');
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $data['menu_list'] = $this->RoomserviceModel->get_selected_menu_list_data($hotel_id,$category_id);
        $this->load->view('roomservice/ajaxMenuManagementdata',$data);
    }

    public function roomservice_update_manumodal()
    {
        $room_serv_menu_id = $this->input->post('room_serv_menu_id');

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $old_data = $this->RoomserviceModel->get_edit_menu_list_data($hotel_id,$room_serv_menu_id);
        $old_img = $old_data[0]['image'];
        // echo "<pre>";
        // print_r($old_data[0]['image']);
        // exit;

        $update_image = date("Y_m_d_H_m_s").'-'.$_FILES['image']['name'];  

        $file = "";
        if(!empty($_FILES['image']['name'])){
          
            $uploadPath =  realpath(FCPATH . 'logo/menu/');
            
            //$config['overwrite'] = TRUE;
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
            $config['file_name'] = $update_image;  
            
            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            // Upload file to server
            if($this->upload->do_upload('image')){   
                $update_filename = $this->upload->data();
                $postArr['image'] = $update_filename['file_name'];
                $file_path_url = base_url() . 'logo/menu/' . $update_filename['file_name'];
                $file = $file_path_url; 
            }
        } 
        else
        {
            $file = $old_img;
        }

        $menu_name = $this->input->post('menu_name');
        $cat_id = $this->input->post('room_serv_cat_id');
        $price = $this->input->post('price');
        $prepartion_time = $this->input->post('prepartion_time');
        $time_in = $this->input->post('time_in');
        $details = $this->input->post('details');

        $arr = array(
            'menu_name' => $menu_name,
            'price' => $price,
            'image' => $file,
            'prepartion_time' => $prepartion_time,
            'time_in' => $time_in,
            'details' => $details,
        );
        $where1 = '(room_serv_menu_id="' . $room_serv_menu_id . '")';
        $result = $this->RoomserviceModel->editData($tbl = 'room_serv_menu_list', $where1, $arr);
        redirect('menuManage');
        // if ($result) {
        //     // $this->menuManage_table();
        //     $u_id = $this->session->userdata('u_id');
        //     $where = '(u_id = "' . $u_id . '")';
        //     $id = $this->input->post('categoryid');
        //     $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        //     $hotel_id = $admin_details['hotel_id'];
        //     $service['menu_list'] = $this->RoomserviceModel->get_menu_edit_list_data($hotel_id,$cat_id);
        // // echo "<pre>";
        // // print_r($service['menu_list']);
        // // exit;
        //     $this->load->view('roomservice/ajaxMenuManagementdata', $service);

        // } 

    }

    public function manumanage_daynamic_delete_data()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $delete_id = $this->input->post('delete_id');
        $wh = '(room_serv_menu_id = "'.$delete_id.'")';
        $delete = $this->RoomserviceModel->deleteData('room_serv_menu_list', $wh);
        if($delete)
        {
            echo 1;
        }
    }

    public function get_menu_service_data()
    {
        $id = $this->input->post('id');
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $data['data_for_modal'] = $this->RoomserviceModel->get_edit_menu_list_data($hotel_id,$id);
        $data['table_id'] = $this->input->post('table_id');
        $this->load->view('roomservice/ajaxMenuManagementdata_editmodal',$data);
    }

    public function get_user_id()
    {
        $todays_date = date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        // print_r($hotel_id);exit;
        $room_no = $this->input->post('room_no');

        $guest_data = $this->RoomserviceModel->get_room_no_data($hotel_id, $room_no, $todays_date);
        // print_r($guest_data);exit;
        if (!empty($guest_data)) {
            $output = '';

            $output .= $guest_data['u_id'];

            echo $output;
        }
    }
    public function get_menu_price()
    {

        $menu_name = $this->input->post('menu_name');
        // var_dump($cat );die;
        $where = '( added_by=2 AND room_serv_menu_id = "' . $menu_name . '")';
        $cloth_price = $this->MainModel->getData('room_serv_menu_list', $where);

        $output = '';

        $output .= $cloth_price['price'];

        echo $output;
    }
    public function get_menus()
    {
        $cat = $this->input->post('sub_cat');
        $wh = '( added_by=2 AND room_serv_cat_id = "' . $cat . '")';

        $sub_cat = $this->MainModel->getAllData1('room_serv_menu_list', $wh);

        $output = '<option>--Select--</option>';

        foreach ($sub_cat as $s_c) {
            $output .= '<option value = "' . $s_c['room_serv_menu_id'] . '">' . $s_c['menu_name'] . '</option>';
        }

        echo $output;
    }
    public function get_menu_price1()
    {

        $menu_name = $this->input->post('cloths_name1');
        // var_dump($cat );die;
        $where = '(room_serv_menu_id = "' . $menu_name . '")';
        $cloth_price = $this->MainModel->getData('room_serv_menu_list', $where);

        $output = '';

        $output .= $cloth_price['price'];

        echo $output;

    }
    public function get_enquiry_id()
    {
        $todays_date = date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        //echo $hotel_id;die;
        $room_no = $this->input->post('room_no');

        $guest_data = $this->RoomserviceModel->get_room_no_data($hotel_id, $room_no, $todays_date);
        
        if (!empty($guest_data)) {
            // $wh = '(u_id = "'.$guest_data['u_id'].'" AND check_out >="'. $todays_date.'" )';

            // $user_data = $this->MainModel->getData('user_hotel_booking',$wh);

            $output = '';

            $output .= $guest_data['enquiry_id'];

            echo $output;
        }
    }
    public function get_user_name()
    {
        $todays_date = date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        //echo $hotel_id;die;
        $room_no = $this->input->post('room_no');
        $guest_data = $this->RoomserviceModel->get_room_no_data($hotel_id, $room_no, $todays_date);
        // echo "<pre>";
        // print_r($this->db->last_query());
        // echo "<pre>";
        // print_r($guest_data);
        // exit;
        if (!empty($guest_data)) {
            $wh = '(u_id = "' . $guest_data['u_id'] . '")';

            $user_data = $this->MainModel->getData('register', $wh);

            $output = '';

            $output .= $user_data['full_name'];

        
            echo $output;
        }
    }
    public function get_user_mobile_no()
    {
        $todays_date = date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        //echo $hotel_id;die;
        $room_no = $this->input->post('room_no');

        $guest_data = $this->RoomserviceModel->get_room_no_data($hotel_id, $room_no, $todays_date);
        if (!empty($guest_data)) {
            $wh = '(u_id = "' . $guest_data['u_id'] . '")';

            $user_data = $this->MainModel->getData('register', $wh);

            $output = '';

            $output .= $user_data['mobile_no'];

            echo $output;
        }
    }

    public function get_guest_type()
    {
        $todays_date = date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        //echo $hotel_id;die;
        $room_no = $this->input->post('room_no');

        $guest_data = $this->RoomserviceModel->get_room_no_data($hotel_id, $room_no, $todays_date);

        if (!empty($guest_data)) {
            $wh = '(u_id = "' . $guest_data['u_id'] . '")';

            $user_data = $this->MainModel->getData('register', $wh);
            // echo "<pre>";
            // print_r($user_data['guest_type']);
            // exit;

            $output = '';

            $output .= $user_data['guest_type'];

            echo $output;
        }
    }
    public function get_service_type_amt()
    {
        $srvice_type_id = $this->input->post('srvice_type');

        $where = '(r_s_services_id = "' . $srvice_type_id . '")';
        $service_amount = $this->MainModel->getData('room_servs_services', $where);

        $output = '';

        $output .= $service_amount['amount'];

        echo $output;
    }
    public function changeSubcategory()
    {

        $cat = $this->input->post('cat');
        $wh = '(room_serv_cat_id = "' . $cat . '" )';

        $sub_cat = $this->MainModel->getAllData1('room_serv_menu_list', $wh);

        $output = '<option>--Select--</option>';

        foreach ($sub_cat as $s_c) {
            $output .= '<option value = "' . $s_c['room_serv_menu_id'] . '">' . $s_c['menu_name'] . '</option>';
        }

        echo $output;
    }
    public function menuManageAddCategories()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["add"] = $this->RoomserviceModel->get_categories($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewmenuManageAddCategories', $data);
        $this->load->view('include/footer');
    }

    public function get_category_editmodel_data()
    {
        $id = $this->input->post('id');
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $data['data_for_modal'] = $this->RoomserviceModel->get_category_edit_data($hotel_id,$id);
        $this->load->view('roomservice/ajaxaddcategorydata_editmodal',$data);
    }

    public function swal_delete_data()
    {
        $delete_id = $this->input->post('delete_id');
        $wh = '(room_servs_category_id = "'.$delete_id.'")';
        $delete = $this->RoomserviceModel->deleteData('room_servs_category', $wh);
        if($delete)
        {
            echo 1;
        }
    }

    public function roomservice_update_addcategories()
    {
        $room_servs_category_id= $this->input->post('room_servs_category_id'); 
        $category_name=$this->input->post('category_name');

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $where1='(room_servs_category_id="'.$room_servs_category_id.'")';
        $result = $this->RoomserviceModel->check_image($tbl = 'room_servs_category', $where1);
        $old_img = $result[0]['image'];

        $category_img = date("Y_m_d H:m:s").'-'.$_FILES['image']['name'];  
        $file = "";
        if(!empty($_FILES['image']['name'])){
            $uploadPath =  realpath(FCPATH . 'logo/service/');
            
            //$config['overwrite'] = TRUE;
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
            $config['file_name'] = $category_img;  
            
            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            // Upload file to server
            if($this->upload->do_upload('image')){   
                $update_filename = $this->upload->data();
                $postArr['image'] = $update_filename['file_name'];
                $file_path_url = base_url() . 'logo/service/' . $update_filename['file_name'];
                $file = $file_path_url;  
            // echo "hello";
            // // print_r($_FILES['image']['name']);
            // exit;
            }
        } else{
            $file = $old_img; 
        }

        $arr = array(
            'category_name' => ucwords($category_name),
            'image' => $file,
        );
        $update = $this->RoomserviceModel->editData('room_servs_category',$where1,$arr);
        if ($update) 
        {
            $data['edited_data'] = $this->RoomserviceModel->get_categories($hotel_id);
            // echo "<pre>"; 
            // print_r($data['edited_data']);
            // exit;
            $this->load->view('roomservice/ajaxaddcategory_data_edittable',$data);  
        } 
        else 
        {
            $this->session->set_flashdata('msg', 'Something Went Wrong..!');
            // redirect(base_url() . 'menu_manag');
        }
        // echo "<pre>"; 
        // print_r($file);
        // exit;
    }

    public function ajaxmenuManageAddCategories()
    {
        $category_name = $this->input->post('category_name');
        $Manucat_img = date("Y_m_d H:m:s").'-'.$_FILES['image']['name'];  
        $file = "";
        if(!empty($_FILES['image']['name'])){
            $uploadPath =  realpath(FCPATH . 'logo/service/');
            
            //$config['overwrite'] = TRUE;
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
            $config['file_name'] = $Manucat_img;  
            
            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            // Upload file to server
            if($this->upload->do_upload('image')){   
                $update_filename = $this->upload->data();
                $postArr['image'] = $update_filename['file_name'];
                $file_path_url = base_url() . 'logo/service/' . $update_filename['file_name'];
                $file = $file_path_url;  
            // echo "hello";
            // // print_r($_FILES['image']['name']);
            // exit;
            }
        } 

        $u_id= $this->session->userdata('u_id');
        $where ='(u_id = "'.$u_id.'")';
        $admin_details = $this->MainModel->getData($tbl ='register', $where);
        $admin_id = $admin_details['hotel_id'];
        $u_id1 = $admin_details['u_id'];
        $wh = '(category_name = "'.ucwords($category_name).'" AND hotel_id = "'.$admin_id.'")';
        $room_servs_category = $this->MainModel->getData('room_servs_category',$wh);
        if($room_servs_category)
        {
            $this->session->set_flashdata('msg','This category is already exits..');
            redirect(base_url('menuManageAddCategories'));
        }
        else
        {
            $arr = array(
                'hotel_id'=> $admin_id,
                'category_name' => $category_name,
                'image' => $file,
                'added_by'=>2,
                'added_by_u_id'=>$u_id1
            );
            $last_insert_id = $this->RoomserviceModel->insert_data($tbl='room_servs_category', $arr);
            if ($last_insert_id == '') 
            {
                $this->session->set_flashdata('msg', 'Something Went Wrong..!');
                redirect(base_url('menuManageAddCategories'));
            }
            else 
            {
                $u_id = $this->session->userdata('u_id');
                $where = '(u_id = "' . $u_id . '")';
                $admin_details = $this->MainModel->getData($tbl = 'register', $where);
                $admin_id = $admin_details['hotel_id'];
                $data["add"] = $this->RoomserviceModel->get_categories($admin_id);
                $this->load->view('roomservice/ajax_manu_category', $data);
            } 
        }
    }

    public function serviceManagement()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $service['service'] = $this->RoomserviceModel->get_services($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewServiceManagement', $service);
        $this->load->view('include/footer');
    }

    public function get_service_manage_table()
    {
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        // $order_by = $this->input->post('order');
        $by_columns = $this->input->post('columns');
        $columnName = $by_columns[0]['data'];

        // if(!empty($order_by[0]['dir'])){
        //     $columnIndex = $order_by[0]['column'];
        //     $columnName = $by_columns[$columnIndex]['data'];
        //     $columnSortOrder = $order_by[0]['dir'];
        // }   
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];

        $service_management_data = $this->RoomserviceModel->get_service_management_Data($rowperpage, $row, $search,$columnName,$hotel_id);

        $total_service_management = $this->RoomserviceModel->getTotalservice_management($search, $hotel_id);
        $totalRecords = $total_service_management->total_record;

        $data = array();
        $i=1;
        foreach($service_management_data AS $val)
        {
            $image = '<div class="lightgallery"><img class="me-3" src="'.$val['icon_img'].'" alt="" style="width:30px; height:40px;"></div>';
            $Action = '<a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="'.$val['r_s_services_id'].'"><i class="fa fa-pencil"></i></a> <a href="#"  data-delete-id="'.$val['r_s_services_id'].'"class="btn btn-danger btn-xs delete_click_modal"><i class="fa fa-trash"></i></a>';
            // echo "<pre>";
            // print_r($val);
            $data[] = array(
                "sr_no"         => $i++,
                "Service_Name"  => $val['service_name'],
                "Icon"          => $image,
                "Price"         => $val['amount'],
                "Action"        => $Action,
            );
        }
        // exit;

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );

        echo json_encode($response);

        //  End :: datatable code 
    }

    public function get_service_manage_data()
    {
        $id = $this->input->post('id');
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $data['data_for_modal'] = $this->RoomserviceModel->get_services_data_edit($hotel_id,$id);
        $this->load->view('roomservice/ajaxserviceManagementdata_editmodal',$data);
    }

    public function roomservice_update_service_manage()
    {
        $department_id= $this->input->post('r_s_services_id'); 
        $service_name=$this->input->post('service_name');
        $amount=$this->input->post('amount');
        $update_image = date("Y_m_d_H_m_s").'-'.$_FILES['file']['name']; 

        // get old image for check update
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $where1='(r_s_services_id="'.$department_id.'")';
        $result = $this->RoomserviceModel->check_image($tbl = 'room_servs_services', $where1);
        $old_img = $result[0]['icon_img'];

        $file = "";
        if(!empty($_FILES['file']['name'])){
            $uploadPath =  realpath(FCPATH . 'logo/service/');
            //$config['overwrite'] = TRUE;
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
            $config['file_name'] = $update_image;  
            
            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            // Upload file to server
            if($this->upload->do_upload('file')){   
                $update_filename = $this->upload->data();
                $postArr['file'] = $update_filename['file_name'];
                $file_path_url = base_url() . 'logo/service/' . $update_filename['file_name'];
                $file = $file_path_url;  
            }
        } else{
            $file = $old_img; 
        }

        $arr=array(
            'service_name'=>$service_name,
            'icon_img' => $file,
            'amount' => $amount,
        );

        $where1='(r_s_services_id="'.$department_id.'")';
        $result = $this->RoomserviceModel->editData($tbl = 'room_servs_services', $where1, $arr);
        if ($result) 
        {
            // $data['edited_data'] = $this->RoomserviceModel->get_services($hotel_id);
            // $this->load->view('roomservice/ajaxserviceManagementdata_edittable',$data);  
            // redirect(base_url() . 'get_service_manage_table');
        } 
        else 
        {
            $this->session->set_flashdata('msg', 'Something Went Wrong..!');
            // redirect(base_url() . 'menu_manag');
        }
    }

    public function service_manage_delete_data()
    {
        $delete_id = $this->input->post('delete_id');
        $wh = '(r_s_services_id = "'.$delete_id.'")';
        $delete = $this->RoomserviceModel->deleteData('room_servs_services', $wh);
        if($delete){
            echo 1;
        }
    }

    public function miniBar()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["minibar"] = $this->RoomserviceModel->get_minibar_data($admin_id);
        $this->load->view('include/header');
        $this->load->view('roomservice/viewMiniBar', $data);
        $this->load->view('include/footer');
    }

    public function get_minibar_service_data()
    {
        $id = $this->input->post('id');
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        // room_servs_mini_bar
        $data['data_for_modal'] = $this->RoomserviceModel->get_edit_minibar_model_data($hotel_id,$id);
        $this->load->view('roomservice/ajaxminibar_editmodal',$data);
    }

    public function roomservice_update_minibar()
    {
        $mini_bar_id= $this->input->post('r_s_min_bar_id');  	
        $item_name=$this->input->post('item_name');
        $price=$this->input->post('price');
        $description=$this->input->post('description');
        $update_image = date("Y_m_d_H_m_s").'-'.$_FILES['file']['name'];  

        // get old image for check update
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $where1='(r_s_min_bar_id="'.$mini_bar_id.'")';
        $result = $this->RoomserviceModel->check_image($tbl = 'room_servs_mini_bar', $where1);
        $old_img = $result[0]['icon_img'];

        $file = "";
        if(!empty($_FILES['file']['name'])){
          
                $uploadPath =  realpath(FCPATH . 'logo/minibar/');
                
                //$config['overwrite'] = TRUE;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
                $config['file_name'] = $update_image;  
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('file')){   
                    $update_filename = $this->upload->data();
                    $postArr['file'] = $update_filename['file_name'];
                    $file_path_url = base_url() . 'logo/minibar/' . $update_filename['file_name'];
                    $file = $file_path_url;  
                    // echo "hello"; exit;
                }
        } else{
            $file = $old_img; 
        }
        $arr=array(     
            'item_name'=>$item_name,
            'icon_img' => $file,
            'price' => $price,
            'description'=>$description,
        );
        $where1='(r_s_min_bar_id="'.$mini_bar_id.'")';
        $result= $this->RoomserviceModel->editData($tbl='room_servs_mini_bar', $where1, $arr);   		
        if($result)
        {
            $data['edited_data'] = $this->RoomserviceModel->get_minibar_data($hotel_id);
            $this->load->view('roomservice/ajax_minibar_data_edittable',$data);  
        }
        else
        {
            $this->session->set_flashdata('msg', 'Something Went Wrong..!');
            // redirect(base_url() . 'menu_manag');
        }
    }

    public function minibar_delete_data()
    {
        $delete_id = $this->input->post('delete_id');
        $wh = '(r_s_min_bar_id = "'.$delete_id.'")';
        $delete = $this->RoomserviceModel->deleteData('room_servs_mini_bar', $wh);
        if($delete)
        {
            echo 1;
        }
    }

    public function staffManage()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data['staff'] = $this->RoomserviceModel->get_staff_list($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewStaffManage', $data);
        $this->load->view('include/footer');
    }

    public function update_status_user()
    {
        $arr=array(
                    'is_active'=>$_POST['active']
                );
        
        $u_id=$_POST['uid'];
        $where = '(u_id="' . $u_id . '")';
        $id=$this->RoomserviceModel->editData($tbl="register",$where,$arr); 
        if($id)
        {
            echo json_encode(TRUE);
        }
        else
        {
            echo json_encode(FALSE);
        }	
    }

    public function staff_history()
    {
        $u_id = $this->uri->segment(2);
        $where = '(u_id = "'.$u_id.'")';
        $data['list'] = $this->RoomserviceModel->getData($tbl ='register', $where);
        $this->load->view('include/header');
        $this->load->view('roomservice/viewstaff_history', $data);
        $this->load->view('include/footer');
    }

    public function get_staffmanage_editmodel_data()
    {
        $id = $this->input->post('id');
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $data['data_for_modal'] = $this->RoomserviceModel->get_staff_manage_edit_data($hotel_id,$id);
        $this->load->view('roomservice/ajaxstaff_managedata_editmodal',$data);
    }

    public function roomservice_update_staffmanage()
    {
        $staff_id= $this->input->post('u_id');  
        $register_date=$this->input->post('register_date');
        $full_name=$this->input->post('full_name');
        $mobile_no=$this->input->post('mobile_no');
        $email_id=$this->input->post('email_id');
        $address=$this->input->post('address');
        $city=$this->input->post('city');
        
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $where1='(u_id="'.$staff_id.'" AND hotel_id = "'.$hotel_id.'")';
        $result = $this->RoomserviceModel->check_image($tbl = 'register', $where1); 
        $old_profile_photo = $result[0]['profile_photo'];
        $old_Id_proof_photo = $result[0]['Id_proff_photo'];

        $profile_img = date("Y_m_d H:m:s").'-'.$_FILES['profile_photo']['name'];  
        $profile_file = "";
        if(!empty($_FILES['profile_photo']['name'])){
            $uploadPath =  realpath(FCPATH . 'logo/service/');
            
            //$config['overwrite'] = TRUE;
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
            $config['file_name'] = $profile_img;  
            
            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            // Upload file to server
            if($this->upload->do_upload('profile_photo')){   
                $update_filename = $this->upload->data();
                $postArr['profile_photo'] = $update_filename['file_name'];
                $file_path_url = base_url() . 'logo/service/' . $update_filename['file_name'];
                $profile_file = $file_path_url;  
            // echo "hello";
            // // print_r($_FILES['image']['name']);
            // exit;
            }
        } else{
            $profile_file = $old_profile_photo; 
        }

        $Id_proof_img = date("Y_m_d H:m:s").'-'.$_FILES['Id_proff_photo']['name'];  
        $Id_proof_file = "";
        if(!empty($_FILES['Id_proff_photo']['name'])){
            $uploadPath =  realpath(FCPATH . 'logo/service/');
            
            //$config['overwrite'] = TRUE;
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
            $config['file_name'] = $Id_proof_img;  
            
            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            // Upload file to server
            if($this->upload->do_upload('Id_proff_photo')){   
                $update_filename = $this->upload->data();
                $postArr['Id_proff_photo'] = $update_filename['file_name'];
                $file_path_url = base_url() . 'logo/service/' . $update_filename['file_name'];
                $Id_proof_file = $file_path_url;  
            // echo "hello";
            // // print_r($_FILES['image']['name']);
            // exit;
            }
        } else{
            $Id_proof_file = $old_Id_proof_photo; 
        }
        $arr=array(
            'register_date'=>$register_date,
            'profile_photo'=>$profile_file,
            'Id_proff_photo'=>$Id_proof_file,
            'full_name' => $full_name,
            'mobile_no' => $mobile_no,
            'email_id'=>$email_id,
            'address'=>$address,
            'city'=>$city,
        );
        $where1='(u_id="'.$staff_id.'")';
        $update= $this->RoomserviceModel->editData($tbl='register', $where1, $arr); 
        if($update)
        {
            $data['edited_data'] = $this->RoomserviceModel->get_staff_list($hotel_id);
            $this->load->view('roomservice/ajaxstaff_managedata_edittable',$data);  
        }
    }
    
    public function staff_manage_delete_data()
    {
        $delete_id = $this->input->post('delete_id');
        $wh = '(u_id = "'.$delete_id.'")';
        $delete = $this->RoomserviceModel->deleteData('register', $wh);
        if($delete)
        {
            echo 1;
        }
    }

    public function roomServiceReview()
    {
        $this->load->view('include/header');
        $this->load->view('roomservice/viewRoomServiceReview');
        $this->load->view('include/footer');
    }
    public function managerHandover()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["list"] = $this->RoomserviceModel->get_pending_handover_list($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewManagerHandover', $data);
        $this->load->view('include/footer');
    }

    public function dicription_modal_data()
    {
        $id = $this->input->post('id');
        $uname = $this->input->post('uname');

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $data["list"] = $this->RoomserviceModel->get_pending_handover_modal_list($hotel_id,$id);
        $data['uname'] = $uname;
        $this->load->view('roomservice/ajaxpending_discr_modal', $data);
    }

    public function completed_dicription_modal_data()
    {
        $id = $this->input->post('id');
        $uname = $this->input->post('uname');

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $data["list"] = $this->RoomserviceModel->get_Mcompleted_handover_modal_list($hotel_id,$id);
        $data['uname'] = $uname;
        echo json_encode($data);
    }


    public function dicription_modal_status_chang()
    {
        $id = $this->input->post('id');
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $data["list"] = $this->RoomserviceModel->get_pending_handover_modal_list($hotel_id,$id);
        $this->load->view('roomservice/ajaxpending_status_form', $data);
    }

    public function handover_status_change()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $id = $this->session->userdata('u_id');
        $where = '(u_id ="'.$id.'")';
        $get_d = $this->MainModel->getData($tbl ='register', $where);
        $hotel_id = $get_d['hotel_id'];
        $m_handover_id= $this->input->post('m_handover_id');  	
        $is_complete=$this->input->post('is_complete');
        $description=$this->input->post('description');
        $arr=array(
            'completed_manger_id'=>$hotel_id,
            'is_complete' => $is_complete,
            'description' => $description
        );
        $where1='(m_handover_id="'.$m_handover_id.'")';
        $result = $this->RoomserviceModel->editData('handover_manger', $where1, $arr);  
        if($result)
        {
            $data["list"] = $this->RoomserviceModel->get_pending_handover_list($hotel_id);
            $this->load->view('roomservice/ajaxpending_data_table', $data);
        }
    }

    public function getpending_hendover()
    {
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        // $order_by = $this->input->post('order');
        $by_columns = $this->input->post('columns');
        $columnName = $by_columns[0]['data'];

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];

        $pending_hendover_data = $this->RoomserviceModel->get_pendinghendover_Data($rowperpage, $row, $search,$columnName,$hotel_id);
        $total_pending_hendovers = $this->RoomserviceModel->getTotalpendinghanover($search, $hotel_id);
        $totalRecords = $total_pending_hendovers->total_record;

        $data = array();
        $i=1;
        foreach($pending_hendover_data AS $val)
        {
            // echo "<pre>";
            // print_r($val);
            $time = date('h:i A', strtotime($val['time']));
            // $date_time = $date."   ".$time;

            $discription = '<a href="#" class="btn btn-secondary btn-xs description_modal_click" data-id="'.$val['m_handover_id'].'" data-uname="'.$val['full_name'].'"><i class="fa fa-eye"></i></a>';

            $status = '<a class="badge badge-danger description_status_modal" data-pk-id="'.$val['m_handover_id'].'">
            Pending </a>';
            
            $data[] = array(
                "sr_no"             => $row+$i++,
                "name_created_by"   => $val['full_name'],
                "description"      => $discription,
                "date"              => $val['date'],
                "time"              => $time,
                "status"            => $status,
            );
        }
        // exit;

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );

        echo json_encode($response);

        //  End :: datatable code 
    }

    public function getcompleted_hendover()
    {
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        // $order_by = $this->input->post('order');
        $by_columns = $this->input->post('columns');
        $columnName = $by_columns[0]['data'];

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];

        $completdet_by_data = $this->RoomserviceModel->get_completedhendover_completd_Data($hotel_id); 
        // echo "<pre>";
        // print_r($completdet_by_data);
        // exit;
        $completed_hendover_data = $this->RoomserviceModel->get_completedhendover_Data($rowperpage, $row, $search,$columnName,$hotel_id);
        // echo "<pre>";
        // print_r($completed_hendover_data);
        // exit;
        $all_array = [];
        foreach($completed_hendover_data AS $key=>$val)
        {
            $m_handover_id = !empty($val['m_handover_id']) ? $val['m_handover_id'] : '';  
            // $com_by = !empty($val['completed_By']) ? $val['completed_By'] : '';
            $date = !empty($val['date']) ? $val['date'] :'';
            $time = !empty($val['time']) ? $val['time'] :'';
            // $description = !empty($val['description']) ? $val['description'] :'';
            $is_complete = !empty($val['is_complete']) ? $val['is_complete'] :'';
            $full_name = !empty($val['full_name']) ? $val['full_name'] :'';

            $all_array[$val['m_handover_id']] = array(
                    'm_handover_id' => $m_handover_id,
                    'date' => $date,
                    'time' => $time,
                    // 'description' => $description,
                    'is_complete' => $is_complete,
                    'full_name' => $full_name,
                    'completed_By' => $completdet_by_data[$key]['completed_By']
                );
        }
       
        $total_completed_hendovers = $this->RoomserviceModel->getTotalcompletedhanover($search, $hotel_id);
        $totalRecords = $total_completed_hendovers->total_record;

        $data = array();
        $i=1;
        foreach($all_array AS $val)
        {
            $date = $val['date'];
            $time = date('h:i A', strtotime($val['time']));
            $date_time = $date."   ".$time;

            // $discription = '<a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter_'.$val['m_handover_id'].'"><i class="fa fa-eye"></i></a>';

            $discription = '<a href="#" class="btn btn-secondary btn-xs completed_view_modal_click" data-id="'.$val['m_handover_id'].'" data-uname="'.$val['full_name'].'"><i class="fa fa-eye"></i></a>';

            $status = ($val['is_complete'] == 1) ? '<a href="javascript:void(0)" class="badge badge-rounded badge-outline-success">complete</a>' : '';

            // echo "<pre>";
            // print_r($val);
            $data[] = array(
                "sr_no"            => $row+$i++,
                "name_created_by"    => $val['full_name'],
                "date_time"   => $date_time,
                "name_completed_by"   => $val['completed_By'],
                "description"=> $discription,
                "status"        => $status,
            );
        }
        // exit;

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );

        echo json_encode($response);

        //  End :: datatable code 
    }

    public function managerHandoverUpdate()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["list"] = $this->RoomserviceModel->get_completed_handover_list_pagination($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewManagerHandoverUpdate', $data);
        $this->load->view('include/footer');
    }
    public function staffHandover()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["staff_pending_list"] = $this->RoomserviceModel->get_staff_handover_list_pagination($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewStaffHandover', $data);
        $this->load->view('include/footer');
    }

    public function staff_pending_hendover()
    {
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $by_columns = $this->input->post('columns');
        $columnName = $by_columns[0]['data'];

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];

        $staff_pending_hendover_Data = $this->RoomserviceModel->staff_pending_hendover_Data($rowperpage, $row, $search,$columnName,$hotel_id);
        $total_staff_pending_hendover = $this->RoomserviceModel->getTotalstaff_pending_hendover($search, $hotel_id);
        // echo "<pre>";
        // print_r($total_staff_pending_hendover);
        // exit;
        $totalRecords = $total_staff_pending_hendover->total_record;

        $data = array();
        $i=1;
        foreach($staff_pending_hendover_Data AS $val)
        {
            $date = date('Y-m-d',strtotime($val['created_at']));
            $time = date('h:i a',strtotime($val['created_at']));

            $discription = '<a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter_'.$val['staff_handover_idPrimary'].'"><i class="fa fa-eye"></i></a>';

            $status = '<a href="javascript:void(0)" class="badge badge-rounded badge-outline-warning">Pending</a>';

            $data[] = array(
                "sr_no"             => $i++,
                "name_created_by"   => $val['full_name'],
                "description"       => $discription,
                "date"              => $date,
                "time"              => $time,
                "status"            => $status
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );

        echo json_encode($response);

        //  End :: datatable code 
    }

    public function staffCompletedHandover()
    {
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $data["staff_pending_list"] = $this->RoomserviceModel->get_staff_handover_list_pagination($admin_id);

        $this->load->view('include/header');
        $this->load->view('roomservice/viewstaffCompletedHandover', $data);
        $this->load->view('include/footer');
    }

    public function staff_completed_hendover()
    {
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $by_columns = $this->input->post('columns');
        $columnName = $by_columns[0]['data'];

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];

        $completdet_by_data = $this->RoomserviceModel->get_staff_completedhendover($hotel_id);
        $staff_completed_hendover_Data = $this->RoomserviceModel->staff_completed_hendover_Data($rowperpage, $row, $search,$columnName,$hotel_id);
        $all_array = [];
        foreach($staff_completed_hendover_Data AS $key=>$val)
        {
            $staff_handover_id = !empty($val['staff_handover_id']) ? $val['staff_handover_id'] : ''; 
            $date = !empty($val['date']) ? $val['date'] :'';
            $time = !empty($val['time']) ? $val['time'] :'';
            $complete_date = !empty($val['complete_date']) ? $val['complete_date'] :'';
            $complete_time = !empty($val['complete_time']) ? $val['complete_time'] :'';
            $full_name = !empty($val['full_name']) ? $val['full_name'] :'';

            $all_array[$val['staff_handover_id']] = array(
                    'staff_handover_id' => $staff_handover_id,
                    'date' => $date,
                    'time' => $time,
                    'complete_time' => $complete_time,
                    'full_name' => $full_name,
                    'complete_date' => $complete_date,
                    'completed_By' => $completdet_by_data[$key]['completed_By']
                );
        }
        $total_staff_completed_hendover = $this->RoomserviceModel->getTotalstaff_completed_hendover($search, $hotel_id);
        // echo "<pre>";
        // print_r($total_staff_pending_hendover);
        // exit;
        $totalRecords = $total_staff_completed_hendover->total_record;

        $data = array();
        $i=1;
        foreach($all_array AS $val)
        {
            $time = date('h:i a',strtotime($val['time']));
            $comp_time = date('h:i a',strtotime($val['complete_time']));

            $date_time = '<h5>'.$val['date'].' '.$time.'</h5>';

            $Complited_date_time = '<div><h5 class="text-nowrap">'.$val['complete_date'].' '.$comp_time.'</h5></div>';

            $discription = '<a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter_'.$val['staff_handover_id'].'"><i class="fa fa-eye"></i></a>';

            $status = '<a href="javascript:void(0)" class="badge badge-rounded badge-outline-success">Complete</a>';

            $data[] = array(
                "sr_no"                 => $i++,
                "created_by"            => $val['full_name'],
                "date_time"             => $date_time,
                "completed_by"          => $val['completed_by'],
                "Complited_date_time"   => $Complited_date_time,
                "description"           => $discription,
                "order_status"          => $status
            );
        }
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );

        echo json_encode($response);

        //  End :: datatable code 
    }

    public function add_neworder()
    {
        // print_r($this->input->post());exit;
        $otp = rand('1111', '9999');
        $unique_id = rand('1111', '9999');
        $u_id = $this->session->userdata('u_id');
        $wh = '(u_id = "' . $u_id . '")';

        $get_data = $this->MainModel->getData('register', $wh);

        $room_service_order_id = $this->input->post('room_service_order_id');
        $u_id_hb = $this->input->post('u_id');
        $order_from = $this->input->post('order_from');
        $room_no = $this->input->post('room_no');
        $user_name = $this->input->post('guest_id');
        //  print_r($_POST['category_name']);exit;
        //   var_dump($user_name);die;

        $guest_types = $this->input->post('gest_type');
        $type_of_gest = '';
        if($guest_types == "Regular")
        {
            $type_of_gest = 1;
        }
        elseif($guest_types == "VIP")
        {
            $type_of_gest = 2;
        }
        elseif($guest_types == "CHG")
        {
            $type_of_gest = 3;
        }
        elseif($guest_types== "WHC")
        {
            $type_of_gest = 4;
        }
        else
        {
            $type_of_gest = "-";
        }
        $mobile_no = $this->input->post('mobile_no');
        $order_date = $this->input->post('order_date');
        $order_time = $this->input->post('order_time');
        $staff_id = $this->input->post('staff_id');
        $payment_status = $this->input->post('payment_status');
        //   $admin_id = $this->session->userdata('u_id');
        $category_name = $this->input->post('category_name');
        $menu_name = $this->input->post('menu_name');
        $price = $this->input->post('price');
        $qty = $this->input->post('quantity');
        $enquiry_id = $this->input->post('enquiry_id');
        $date = date('Y-m-d');
        $booking_id = '';
        // $wh11 = '(u_id = "' . $u_id . '" AND check_out >= "' . $date . '" AND enquiry_id="' . $enquiry_id . '")';
        $wh11 = '(check_out >= "' . $date . '" AND enquiry_id="' . $enquiry_id . '")';
        $get_data_booking_id = $this->MainModel->getData('user_hotel_booking', $wh11);
        // print_r($get_data_booking_id);exit;
        if (!empty($get_data_booking_id)) {
            $booking_id = $get_data_booking_id['booking_id'];
        }
        $arr = array(
            'hotel_id' => $get_data['hotel_id'],
            'booking_id' => $booking_id,
            'u_id' => $u_id,
            //    'room_service_order_id'=> $room_service_order_id,
            'order_from' => $order_from,
            'room_no' => $room_no,
            'Guest_type' => $type_of_gest,
            'mobile_no' => $mobile_no,
            'order_date' => $order_date,
            'order_time' => $order_time,
            'accept_date' => date('Y-m-d'),
            'accept_time' => date("h:i:s"),
            'staff_id' => $staff_id,
            'payment_status' => $payment_status,
            'order_status' => 1,
            'added_by' => 3,
            'otp' => $otp,
            'added_by_u_id' => $get_data['u_id'],
            'room_service_unique_id' => $unique_id,
        );
        // echo "<pre>";
        // print_r( $arr);
        // exit;
        $insert_id22 = $this->RoomserviceModel->insert_data($tbl = 'room_service_menu_orders', $arr);
        //  print_r($insert_id22);exit;
        if (isset($_POST['category_name'])) {

            $data = array(
                'hotel_id' => $get_data['hotel_id'],
                'room_service_menu_order_id' => $insert_id22,
                'room_service_cat_id' => $category_name,
                'room_serv_menu_id' => $menu_name,
                'price' => $price,
                'quantity' => $qty,
                'room_service_unique_id' => $unique_id,

            );
            $service_order = $this->RoomserviceModel->insert_data('room_service_menu_details', $data);

            $category_name1 = $this->input->post('category_name1');
            $menu_name1 = $this->input->post('menu_name1');
            $price1 = $this->input->post('price1');
            $quantity1 = $this->input->post('quantity1');

            if (isset($_POST['category_name1'])) {
                $count1 = count($category_name1);
                for ($j = 0; $j < $count1; $j++) {
                    $data = array(
                        'hotel_id' => $get_data['hotel_id'],
                        'room_service_menu_order_id	' => $insert_id22,
                        'room_service_cat_id' => $category_name1[$j],
                        'room_serv_menu_id' => $menu_name1[$j],
                        'price' => $price1[$j],
                        'quantity' => $quantity1[$j],
                        'room_service_unique_id' => $unique_id,

                    );
                    $service_orderr = $this->RoomserviceModel->insert_data('room_service_menu_details', $data);

                }
                // if ($service_orderr) {
                //     // redirect(base_url().'menuAcceptedOrder');
                //     $u_id = $this->session->userdata('u_id');
                //     $where = '(u_id = "' . $u_id . '")';
                //     $admin_details = $this->MainModel->getData($tbl = 'register', $where);
                //     $hotel_id = $admin_details['hotel_id'];
                //     $todays_date = date('Y-m-d');

                //     $data["list"] = $this->RoomserviceModel->get_new_order_list_pagination($todays_date, $hotel_id);
                //     //   print_r($data["list"]);exit;
                //     // $this->load->view('include/header');
                //     $this->load->view('roomservice/ajaxviewMenuNewOrder', $data);
                //     // $this->load->view('include/footer');
                // }
            }
            // redirect(base_url().'menuAcceptedOrder');
            // if ($service_order) {
            //     echo "hello 2"; exit;
                
            //     // $u_id = $this->session->userdata('u_id');
            //     // $where = '(u_id = "' . $u_id . '")';
            //     // $admin_details = $this->MainModel->getData($tbl = 'register', $where);
            //     // $hotel_id = $admin_details['hotel_id'];
            //     // $todays_date = date('Y-m-d');

            //     // $data["list"] = $this->RoomserviceModel->get_new_order_list_pagination($todays_date, $hotel_id);

            //     // $this->load->view('roomservice/ajaxviewMenuNewOrder', $data);

            // }
        } else {
            // $this->session->set_flashdata('order_msg', 'Something Went Wrong..!');
            redirect(base_url() . 'menuNewOrder');

        }

    }
    public function menuManage_add()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $first_id = $this->input->post('first_menu_id');
        // $serv_cat_id = $this->input->post('selected_menu_service');
        $serv_cat_id = $this->input->post('selected_menu_service_id');
        $room_serv_cat_id =  !empty($first_id) ? $first_id : $serv_cat_id;

        // echo "<pre>";
        // print_r($room_serv_cat_id);
        // exit;
        $admin_id = $this->session->userdata('u_id');

        $_FILES['my_uploaded_file']['name'] = $_FILES['file']['name'];
        $_FILES['my_uploaded_file']['type'] = $_FILES['file']['type'];
        $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['file']['tmp_name'];
        $_FILES['my_uploaded_file']['error'] = $_FILES['file']['error'];
        $_FILES['my_uploaded_file']['size'] = $_FILES['file']['size'];

        $path = 'logo/menu/';
        $file_path = './' . $path;
        $config['allowed_types'] = '*';

        $config['upload_path'] = $file_path;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('my_uploaded_file')) {

            $file_data = $this->upload->data();

            $file_path_url = base_url() . $path . $file_data['file_name'];
            // print_r($file_path_url);exit;
        }
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $u_id1 = $admin_details['u_id'];

        $menu_name = $this->input->post('menu_name');
        $price = $this->input->post('price');
        $prepartion_time = $this->input->post('prepartion_time');
        $time_in = $this->input->post('time_in');
        $details = $this->input->post('details');

        $wh = '(menu_name = "' . ucwords($menu_name) . '" AND hotel_id = "' . $admin_id . '" AND room_serv_cat_id = "' . $room_serv_cat_id . '")';

        $menu_list = $this->MainModel->getData('room_serv_menu_list', $wh);

        if ($menu_list) {
            $this->session->set_flashdata('msg', 'This Menu already exits..');
            redirect(base_url('menu_manag'));
        } else {
            $arr = array(
                'hotel_id' => $admin_id,
                'menu_name' => $menu_name,
                'price' => $price,
                'image' => $file_path_url,
                'prepartion_time' => $prepartion_time,
                'time_in' => $time_in,
                'details' => $details,
                'room_serv_cat_id' => $room_serv_cat_id,
                'added_by' => 2,
                'added_by_u_id' => $u_id1,
            ); 
            $insert_id22 = $this->RoomserviceModel->insert_data($tbl = 'room_serv_menu_list', $arr);
            // echo "<pre>";
            // print_r($insert_id22);
            // exit;
        }
        // if ($insert_id22) {
        //     $u_id = $this->session->userdata('u_id');
        //     $where = '(u_id = "' . $u_id . '")';
        //     $id = $this->input->post('categoryid');
        //     $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        //     $hotel_id = $admin_details['hotel_id'];

        //     $service['menu_list'] = $this->RoomserviceModel->get_menu_list_daynamic_data($hotel_id,$room_serv_cat_id);

        //     $this->load->view('roomservice/ajaxMenuManage', $service);

        // } 
    }
    public function add_service_menu()
    {
        // print_r($this->input->post());exit;
        $file = "";
        if (!empty($_FILES['file']['name'])) {
            $_FILES['my_uploaded_file']['name'] = $_FILES['file']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['file']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['file']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['file']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['file']['size'];

            $path = 'logo/service/';

            $file_path = './' . $path;
            $config['allowed_types'] = '*';

            $config['upload_path'] = $file_path;

            //   print_r($config['upload_path']);exit;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file')) {
                $file_data = $this->upload->data();
                $file_path_url = base_url() . 'logo/service/' . $file_data['file_name'];
                $file = $file_path_url;
            } else {
                $file = "";
            }
        }
        //    var_dump(  $file);die;
        $service_name = $this->input->post('service_name');
        $additional_note = $this->input->post('additional_note');
        $amount = $this->input->post('amount');

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $u_id1 = $admin_details['u_id'];

        $wh = '(service_name = "' . ucwords($service_name) . '" AND hotel_id = "' . $admin_id . '")';
        $room_servs_services = $this->MainModel->getData('room_servs_services', $wh);

        if ($room_servs_services) {
            $this->session->set_flashdata('msg', 'This service already exits..');
            redirect(base_url('serviceManagement'));
        } else {
            $arr = array(

                'service_name' => $service_name,
                'icon_img' => $file,
                'amount' => $amount,
                'added_by' => 2,
                'hotel_id' => $admin_id,
                'added_by_u_id' => $u_id1,

            );

            $insert_id22 = $this->RoomserviceModel->insert_data($tbl = 'room_servs_services', $arr);
            //     // $this->load->view('roomservice/ajaxviewServiceManagement', $service);
            // $this->load->view('roomservice/ajaxserviceManagementdata_edittable',$data); 
        }
    }
    public function add_minibar_data()
    {
        $file = "";
        if (!empty($_FILES['file']['name'])) {
            $_FILES['my_uploaded_file']['name'] = $_FILES['file']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['file']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['file']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['file']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['file']['size'];

            $path = 'logo/minibar/';

            $file_path = './' . $path;
            $config['allowed_types'] = '*';

            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file')) {
                $file_data = $this->upload->data();
                $file_path_url = base_url() . 'logo/minibar/' . $file_data['file_name'];
                $file = $file_path_url;

            } else {
                $file = "";
            }
        }
        //    var_dump(  $file);die;
        $item_name = $this->input->post('item_name');
        $price = $this->input->post('price');
        $description = $this->input->post('description');

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);

        $admin_id = $admin_details['hotel_id'];
        $u_id1 = $admin_details['u_id'];

        $arr = array(
            'hotel_id' => $admin_id,
            'item_name' => $item_name,
            'icon_img' => $file,
            'price' => $price,
            'description' => $description,
            'added_by_u_id' => $u_id1,
            'added_by' => 2,
        );
        $insert_id22 = $this->RoomserviceModel->insert_data($tbl = 'room_servs_mini_bar', $arr);

        if ($insert_id22) {
            $u_id = $this->session->userdata('u_id');
            $where = '(u_id = "' . $u_id . '")';
            $admin_details = $this->MainModel->getData($tbl = 'register', $where);
            $hotel_id = $admin_details['hotel_id'];
            $data["minibar"] = $this->RoomserviceModel->get_minibar_data($hotel_id);
            //   print_r($data["minibar"]);exit;

            // $this->load->view('include/header');
            $this->load->view('roomservice/ajaxviewMiniBar', $data);
            // $this->load->view('include/footer');
        } else {
            $this->session->set_flashdata('minbar_error_msg', 'Something Went Wrong..!');
            redirect(base_url() . 'mini_bar');

        }
    }
    public function add_manage_handover()
    {
        $id = $this->session->userdata('u_id');

        //  var_dump($id);die;

        $create_manager_id = $this->input->post('create_manager_id');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $description = $this->input->post('description');
        $where = '(u_id ="' . $id . '")';
        $get_d = $this->MainModel->getData($tbl = 'register', $where);

        if (!empty($get_d)) {
            $u_id = $get_d['u_id'];
            $hotel_id = $get_d['hotel_id'];
            // print_r($get_d['hotel_id']);exit;
        }

        //   print_r($u_id);exit;
        $arr = array(

            'create_manager_id' => $id,
            'date' => $date,
            'time' => $time,
            'description' => $description,
            'hotel_id' => $hotel_id,
            'is_complete' => 0,
            'added_by' => 3,
            'added_by_u_id' => $u_id,
        );

        $insert_id22 = $this->RoomserviceModel->insert_data($tbl = 'handover_manger', $arr);
        //  print_r($insert_id22);exit;
        if ($insert_id22) {
            $u_id = $this->session->userdata('u_id');
            $where = '(u_id = "' . $u_id . '")';
            $admin_details = $this->MainModel->getData($tbl = 'register', $where);
            $admin_id = $admin_details['hotel_id'];
            $data["list"] = $this->RoomserviceModel->get_pending_handover_list($admin_id);

            $this->load->view('roomservice/ajaxviewManagerHandover', $data);

        } else {
            $this->session->set_flashdata('pending_handover_error_msg', 'Something Went Wrong..!');
            redirect(base_url() . 'mng_handover');

        }
    }

    public function ServiceAcceptedOrder_getdata()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $otp = rand('1111','9999');
        $u_id1 = $this->session->userdata('u_id');
        // print_r($this->session->userdata());die;
        $wh = '(u_id = "'.$u_id1.'")';
        $get_data = $this->MainModel->getData('register', $wh);

        // $room_service_order_id = $this->input->post('room_service_order_id');
        // $u_id = $this->input->post('u_id');
        $order_from=$this->input->post('order_from');
        $room_no=$this->input->post('room_no');
        $user_name = $this->input->post('guest_id');
        $guest_types=$this->input->post('guest_type');
        $mobile_no=$this->input->post('mobile_no');
        $order_date=$this->input->post('order_date');
        $order_time=$this->input->post('order_time');
        $staff_id=$this->input->post('staff_id');
        $payment_status=$this->input->post('payment_status');

        // Start :: If service add then only
        $service_name =$this->input->post('service_name');
        $price         =$this->input->post('amount');
        $qty           =$this->input->post('quantity');
        $enquiry_id = $this->input->post('enquiry_id');
        // End :: If service add then only

        $date= date('Y-m-d');
        $booking_id = '';
        $wh11 = '(u_id = "'.$user_name.'" AND check_out >= "'.$date.'" AND enquiry_id="'. $enquiry_id.'")';
        $get_data_booking_id = $this->MainModel->getData('user_hotel_booking', $wh11);
        if(!empty($get_data_booking_id))
        {
            $booking_id = $get_data_booking_id['booking_id'];
        }

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $unique_number = rand(1111,9999);

        $arr = array(
            // 'hotel_id'=>$get_data['hotel_id']
            'hotel_id'=>$hotel_id,
            'u_id' =>$u_id1 ,
            'booking_id'=>$booking_id,
            // 'order_from'=>$order_from,
            'order_from'=>$this->input->post('order_from'),
            'accept_date' =>date('Y-m-d'),
            'accept_time' =>date('H:i:s'),
            // 'room_no'=>$room_no,
            'room_no'=>$this->input->post('room_no'),
            'Guest_type'=>$this->input->post('guest_type'),
            'mobile_no' =>$this->input->post('mobile_no'),
            'order_date'=>$order_date,
            'order_time'=>$order_time,
            'staff_id'=>$staff_id,
            'payment_status'=>$payment_status,
            'order_status'=> 0,
            'added_by'=> 3,
            'otp' =>$otp,
            // 'added_by_u_id'=>$get_data['u_id'],
            'room_service_unique_id' => $unique_number,
        );
        
        $insert_order_data = $this->RoomserviceModel->insert_data('rmservice_services_orders', $arr);
        // echo "<pre>";
        // print_r($insert_order_data);
        // exit;
        if(isset($_POST['service_name']))
        {
            $data = array(
                // 'hotel_id'=>$get_data['hotel_id'],
                'hotel_id'=>$hotel_id,
                'rmservice_services_order_id' => $insert_order_data,
                'room_serv_service_id'  => $service_name,
                'price'                =>$price,
                'quantity'             => $qty,
                'room_service_unique_id' => $unique_number,
            );
            $service_order = $this->RoomserviceModel->insert_data('rmservice_services_details',$data);
        
            $service_name1=$this->input->post('service_name2');
            $price2=$this->input->post('price2');
            $quantity1=$this->input->post('qty1');

            if(isset($_POST['service_name2']))
            {
                $count1 = count($service_name1);
                for($j = 0 ;$j < $count1 ; $j++)
                {
                    $data = array(
                        'hotel_id'=>$get_data['hotel_id'],
                        'rmservice_services_order_id' =>$insert_order_data,
                        'room_serv_service_id'  => $service_name1[$j],
                        'price'                =>$price2[$j],
                        'quantity'             => $quantity1[$j],
                        'room_service_unique_id' => $unique_number,
                    );
                $service_order = $this->RoomserviceModel->insert_data('rmservice_services_details',$data);
                }
            }
        }
         
        $order_type_data = $this->input->post('selected_order_serv');

        if($insert_order_data)   
        {
            $order_type = $this->input->post('order_from');
            // echo "<pre>";
            // print_r($order_type);
            // exit;

            // if($order_type_data == '' || $order_type_data == 'new_orders' || $order_type_data == 'accepted_order')
            // {
                $data["accepted_order_data"] = $this->RoomserviceModel->get_service_accepted_orders($hotel_id);
                // echo "<pre>";
                // print_r($data["accepted_order_data"]);
                // exit; 
            // }
            $this->load->view('roomservice/ajaxnewroomServiceAcceptedOrder', $data);
        }         
       
    }

    public function Serviceadd_into_accepted()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $otp = rand('1111','9999');
        $u_id1 = $this->session->userdata('u_id');
        // print_r($this->session->userdata());die;
        $wh = '(u_id = "'.$u_id1.'")';
        $get_data = $this->MainModel->getData('register', $wh);

        // $room_service_order_id = $this->input->post('room_service_order_id');
        // $u_id = $this->input->post('u_id');
        // $order_from=$this->input->post('order_from');
        // $room_no=$this->input->post('room_no');
        $user_name = $this->input->post('guest_id');
        // $guest_types=$this->input->post('guest_type');
        $guest_types = $this->input->post('guestType');
        $type_of_gest = '';
        if($guest_types == "Regular")
        {
            $type_of_gest = 1;
        }
        elseif($guest_types == "VIP")
        {
            $type_of_gest = 2;
        }
        elseif($guest_types == "CHG")
        {
            $type_of_gest = 3;
        }
        elseif($guest_types== "WHC")
        {
            $type_of_gest = 4;
        }
        else
        {
            $type_of_gest = "-";
        }
        // $mobile_no=$this->input->post('mobile_no');
        $order_date=$this->input->post('order_date');
        $order_time=$this->input->post('order_time');
        $staff_id=$this->input->post('staff_id');
        $payment_status=$this->input->post('payment_status');

        // Start :: If service add then only
        $service_name =$this->input->post('service_name');
        $price         =$this->input->post('amount');
        $qty           =$this->input->post('quantity');
        $enquiry_id = $this->input->post('enquiry_id');
        // End :: If service add then only

        $date= date('Y-m-d');
        $booking_id = '';
        $wh11 = '(u_id = "'.$user_name.'" AND check_out >= "'.$date.'" AND enquiry_id="'. $enquiry_id.'")';
        $get_data_booking_id = $this->MainModel->getData('user_hotel_booking', $wh11);
        if(!empty($get_data_booking_id))
        {
            $booking_id = $get_data_booking_id['booking_id'];
        }

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];
        $unique_number = rand(1111,9999);

        $arr = array(
            // 'hotel_id'=>$get_data['hotel_id']
            'hotel_id'=>$hotel_id,
            'u_id' =>$u_id1 ,
            'booking_id'=>$booking_id,
            // 'order_from'=>$order_from,
            'order_from'=>$this->input->post('order_from'),
            'accept_date' =>date('Y-m-d'),
            'accept_time' =>date('H:i:s'),
            // 'room_no'=>$room_no,
            'room_no'=>$this->input->post('room_no'),
            'Guest_type'=>$type_of_gest,
            'mobile_no' =>$this->input->post('mobile_no'),
            'order_date'=>$order_date,
            'order_time'=>$order_time,
            'staff_id'=>$staff_id,
            'payment_status'=>$payment_status,
            'order_status'=> 1,
            'added_by'=> 3,
            'otp' =>$otp,
            // 'added_by_u_id'=>$get_data['u_id'],
            'room_service_unique_id' => $unique_number,
        );
        
        $insert_order_data = $this->RoomserviceModel->insert_data('rmservice_services_orders', $arr);
        if(isset($_POST['service_name']))
        {
            $data = array(
                // 'hotel_id'=>$get_data['hotel_id'],
                'hotel_id'=>$hotel_id,
                'rmservice_services_order_id' => $insert_order_data,
                'room_serv_service_id'  => $service_name,
                'price'                =>$price,
                'quantity'             => $qty,
                'room_service_unique_id' => $unique_number,
            );
            $service_order = $this->RoomserviceModel->insert_data('rmservice_services_details',$data);
        
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
            $service_name1=$this->input->post('service_name2');
            $price2=$this->input->post('price2');
            $quantity1=$this->input->post('qty1');

            if(isset($_POST['service_name2']))
            {
                $count1 = count($service_name1);
                for($j = 0 ;$j < $count1 ; $j++)
                {
                    $data = array(
                        'hotel_id'=>$get_data['hotel_id'],
                        'rmservice_services_order_id' =>$insert_order_data,
                        'room_serv_service_id'  => $service_name1[$j],
                        'price'                =>$price2[$j],
                        'quantity'             => $quantity1[$j],
                        'room_service_unique_id' => $unique_number,
                    );
                $service_order = $this->RoomserviceModel->insert_data('rmservice_services_details',$data);
                }
            }
        }

        if($insert_order_data)   
        {
            redirect(base_url().'roomServiceOrder'); 
        //     $data["accepted_order_data"] = $this->RoomserviceModel->get_service_accepted_orders($hotel_id);
                
        //     $this->load->view('roomservice/ajaxnewroomServiceAcceptedOrder', $data);
        }         
       
    }

    public function add_room_service_staff()
    {
        if (!empty($_FILES['profile_photo']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['profile_photo']['name'];
            $_FILES['my_file']['type'] = $_FILES['profile_photo']['type'];
            $_FILES['my_file']['size'] = $_FILES['profile_photo']['size'];
            $_FILES['my_file']['error'] = $_FILES['profile_photo']['error'];
            $_FILES['my_file']['tmp_name'] = $_FILES['profile_photo']['tmp_name'];

            $path = 'logo/profile_photo/';
            $upload_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = true;
            $config['upload_path'] = $upload_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('profile_photo')) {
                $file_data = $this->upload->data();

                $profile_photo = base_url() . $path . $file_data['file_name'];
            } else {
                $this->session->set_flashdata('msg', 'Erro to upload image');
                redirect(base_url('profile'));
            }
        }

        if (!empty($_FILES['Id_proff_photo']['name'])) {
            $_FILES['my_id_proff_file']['name'] = $_FILES['Id_proff_photo']['name'];
            $_FILES['my_id_proff_file']['type'] = $_FILES['Id_proff_photo']['type'];
            $_FILES['my_id_proff_file']['size'] = $_FILES['Id_proff_photo']['size'];
            $_FILES['my_id_proff_file']['error'] = $_FILES['Id_proff_photo']['error'];
            $_FILES['my_id_proff_file']['tmp_name'] = $_FILES['Id_proff_photo']['tmp_name'];

            $path = 'logo/id_proff/';
            $upload_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = true;
            $config['upload_path'] = $upload_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_id_proff_file')) {
                $file_data = $this->upload->data();

                $Id_proff_photo = base_url() . $path . $file_data['file_name'];
            } else {
                $this->session->set_flashdata('msg', 'Erro to upload image');
                redirect(base_url('profile'));
            }
        }

        $register_date = $this->input->post('register_date');
        $full_name = $this->input->post('full_name');
        $mobile_no = $this->input->post('mobile_no');
        $email_id = $this->input->post('email_id');
        $address = $this->input->post('address');
        $city = $this->input->post('city');

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['hotel_id'];
        $u_id1 = $admin_details['u_id'];

        $arr = array(

            'register_date' => $register_date,
            //  'profile_photo'=>$file,
            //  'Id_proff_photo'=>$files,

            'profile_photo' => $profile_photo,
            'Id_proff_photo' => $Id_proff_photo,

            'full_name' => $full_name,
            'mobile_no' => $mobile_no,
            'email_id' => $email_id,
            'address' => $address,
            'city' => $city,
            'is_active' => 1,
            'user_is' => 2,
            'user_type' => 10,
            'hotel_id' => $admin_id,

        );
        // print_r($arr);exit;
        $wh = '(mobile_no ="' . $mobile_no . '")';
        $mobile_exist = $this->MainModel->getAllData1('register', $wh);
        $wh1 = '(email_id ="' . $email_id . '")';
        $email_exist = $this->MainModel->getAllData1('register', $wh1);
        if ($mobile_exist) {
            $this->session->set_flashdata('msg', 'Mobile Number Already Exist');
            echo 1;
        } elseif ($email_exist) {
            $this->session->set_flashdata('msg', 'Email Already Exist');
            echo 2;
        } else {
            $insert_id22 = $this->RoomserviceModel->insert_data($tbl = 'register', $arr);

            if ($insert_id22) {
                $u_id = $this->session->userdata('u_id');
                $where = '(u_id = "' . $u_id . '")';
                $admin_details = $this->MainModel->getData($tbl = 'register', $where);
                $admin_id = $admin_details['hotel_id'];
                $data['staff'] = $this->RoomserviceModel->get_staff_list($admin_id);

                $this->load->view('roomservice/ajaxviewStaffHandover', $data);

            } else {
                $this->session->set_flashdata('staff_error_msg', 'Something Went Wrong..!');
                redirect(base_url() . 'staff_manag');
            }
        }

    }
    public function menuManage_update()
    {
        // print_r($this->input->post());exit;
        $room_serv_menu_id = $this->input->post('room_serv_menu_id');
        $file = "";
        if (!empty($_FILES['file']['name'])) {
            $_FILES['my_uploaded_file']['name'] = $_FILES['file']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['file']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['file']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['file']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['file']['size'];

            $path = 'logo/menu/';

            $file_path = './' . $path;
            $config['allowed_types'] = '*';

            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file')) {
                $file_data = $this->upload->data();
                $file_path_url = base_url() . 'logo/menu/' . $file_data['file_name'];
                $file = $file_path_url;
            } else {
                $file = "";
            }
        }

        $menu_name = $this->input->post('menu_name');
        $price = $this->input->post('price');
        $prepartion_time = $this->input->post('prepartion_time');
        $time_in = $this->input->post('time_in');
        $details = $this->input->post('details');

        $arr = array(
            'menu_name' => $menu_name,
            'price' => $price,
            'image' => $file,
            'prepartion_time' => $prepartion_time,
            'time_in' => $time_in,
            'details' => $details,

        );

        // print_r($arr);exit;

        $where1 = '(room_serv_menu_id="' . $room_serv_menu_id . '")';
        $result = $this->RoomserviceModel->editData($tbl = 'room_serv_menu_list', $where1, $arr);
        //    var_dump($result);die;
        if ($result) {
            $u_id = $this->session->userdata('u_id');
            $where = '(u_id = "' . $u_id . '")';
            $id = $this->input->post('categoryid');

            $admin_details = $this->MainModel->getData($tbl = 'register', $where);
            $hotel_id = $admin_details['hotel_id'];

            $service['menu_list'] = $this->RoomserviceModel->get_menu_list_data($hotel_id);

            $this->load->view('roomservice/ajaxMenuManage', $service);

        } else {
            $this->session->set_flashdata('msg', 'Something Went Wrong..!');
            redirect(base_url() . 'menu_manag');
        }
    }
    public function assign_order()
    {
        $notification_id = $this->input->post('id');

        $wh = '(notification_id = "'.$notification_id.'")';

        $arr = array(
                    'order_status' => 1,
                    );

        $up = $this->RoomserviceModel->editData('notifications',$wh,$arr);

        if($up)
        {
            $this->session->set_flashdata('msg','Request accepted Successfully');
            redirect(base_url('panel_notification'));
        }
        // else
        // {
        //     $this->session->set_flashdata('msg','Something went wrong');
        //     redirect(base_url('panel_notification'));
        // }
    }
    public function reject_order()
    {
        $notification_id = $this->input->post('id');
    
        $wh = '(notification_id = "'.$notification_id.'")';

        $arr = array(
                    'order_status' => 2,
                    );

        $up = $this->RoomserviceModel->editData('notifications',$wh,$arr);
    }

    public function get_rating_table_data()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        // $order_by = $this->input->post('order');
        $by_columns = $this->input->post('columns');
        $columnName = $by_columns[0]['data'];
        $page_no = $this->input->post('page_no');

        // if(!empty($order_by[0]['dir'])){
        //     $columnIndex = $order_by[0]['column'];
        //     $columnName = $by_columns[$columnIndex]['data'];
        //     $columnSortOrder = $order_by[0]['dir'];
        // }   
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $hotel_id = $admin_details['hotel_id'];

        $get_review_page_Data = $this->RoomserviceModel->get_review_page_Data($rowperpage, $row, $search,$columnName,$hotel_id);

        $total_review_page_Data = $this->RoomserviceModel->getTotal_review_page_Data($search, $hotel_id);
        $totalRecords = $total_review_page_Data->total_record;
        // echo "<pre>";
        // print_r($this->input->post());
        $data = array();
        $i=1;
        foreach($get_review_page_Data AS $val)
        {
            $rating = '';
            if($val['rating'] != 0)
            {
                $rating = '';
               for($x = 1; $x <= $val['rating']; $x++)
               {
                    $rating .= '<i class="fa fa-star text-secondary"></i>';
               }
            }
            else
            {
                $rating = '';
            }

            $set_time = date('h:i A', strtotime($val['rating_time']));
            $time = '<span class="text-nowrap">'.$set_time.'</span>';
            $Comment = '<a href="#" id="reting_comment_click" class="badge badge-info" data-id="'.$val['review_id'].'" data-comment = "'.$val['review'].'" style="margin-left: 4.5rem;">view</a>';
            $data[] = array(
                "sr_no"         => $row+$i++,
                "Customer_Name"  => $val['gest_name'],
                "Date"          => date('M d Y', strtotime($val['rating_date'])),
                "Time"         => $time,
                "Rating"        => $rating,
                "Comment"        => $Comment,
            );
        }
        // exit;

            
        // echo "<pre>";
        // print_r($page_no);
            // exit;

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );

        echo json_encode($response);

        //  End :: datatable code 
    }
}
