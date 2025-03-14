<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FoodadminController extends CI_Controller 
{
    function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		 $this->load->model('MainModel');
		  $this->load->model('FrontofficeModel');
		  $this->load->model('HotelAdminModel');
		  $this->load->model('HouseKeepingModel');
		  $this->load->model('FoodAdminModel');
		  $this->load->model('SuperAdminModel', 'SuperAdmin');
		  $this->load->helper('notification_helper');
		  $this->load->helper('array');

		 if(empty($this->session->userdata('u_id'))){
		 	redirect('/');
		 }
		// $this->load->library('pagination');   
	}

    public function get_reserve_table_new_data()
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

        $admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        if($this->session->userdata('userType') == 2)
		{
			$hotel_id = $get_hotel_id['u_id']; 
		}
		else
		{
			$hotel_id = $get_hotel_id['hotel_id']; 
		}

        $get_new_reserve_tbl_data = $this->FoodAdminModel->get_new_reserve_tbl_data($rowperpage,$row,$search, $hotel_id);

        // echo "<pre>";
        // print_r($get_new_reserve_tbl_data);
        // exit;
        $total_new_reserve_tbl_data = $this->FoodAdminModel->total_new_reserve_tbl_data($search, $hotel_id);
        
        $totalRecords = $total_new_reserve_tbl_data->total_record;

        $data = array();
        $i=1;
        foreach($get_new_reserve_tbl_data AS $val)
        {
            if($val['booking_status'] == 1)
            {
                $req_time = date('h:i A', strtotime($val['request_time']));
                $Req_Date_Time = '<span> '.date('d-m-Y', strtotime($val['request_date'])).'/<sub>'.$req_time.'</sub></span>';

                $time = date('h:i A', strtotime($val['updated_at']));
                $date_time = '<span>'.date('d-m-Y', strtotime($val['reserve_date'])).'/<sub>'.$time.'</sub></span>';

                $action = '<a href="javascript:void(0)" data-id="'.$val['reserve_table_id'].'" class="btn btn-warning shadow btn-xs sharp me-1 updateOrderStatus"><i class="fa fa-share"></i></a>';	

                $data[] = array(
                    "sr_no"			=>	$row+$i++ ,
                    "Req_Date_Time"	=>  $Req_Date_Time,
                    "floor"         =>  $val['floor'],
                    "room_no"       =>  $val['room_no'],
                    "Guest_Name"	=>  $val['guest_name'],
                    "hotel_name"	=>  $val['hotel_name'],
                    "No_of_people"	=>  $val['no_of_people'],
                    "date_time"	    =>  $date_time,
                    "Action"        =>  $action,
                );
            }
        }
        
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );
        echo json_encode($response);
    }

    public function new_data_of_Manage_Order()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $draw  = $this->input->post('draw');
        $row  = $this->input->post('start');
        $rowperpage  = $this->input->post('length');
        $search_array  = $this->input->post('search');
        $search = !empty($search_array['value'])?$search_array['value']: '' ;

        $admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	if($this->session->userdata('userType') == 2)
        {
            $hotel_id = $get_hotel_id['u_id']; 
        }
        else
        {
            $hotel_id = $get_hotel_id['hotel_id']; 
        }

        $new_Manage_Order_list = $this->FoodAdminModel->new_Manage_Order_list($rowperpage,$row,$search, $hotel_id);
        
        // echo "<pre>";
        // print_r($new_Manage_Order_list);
        // exit;
        $total_new_Manage_Order_list_data = $this->FoodAdminModel->total_new_Manage_Order_list_data($search, $hotel_id);
        
        $totalRecords = $total_new_Manage_Order_list_data->total_record;

        $data = array();
        $i=1;
        foreach($new_Manage_Order_list AS $val)
        {
            if($val['booking_status'] == 1)
            {

                $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="'.$val['out_of_time_status'].'"><span> '.$val['food_order_id'].'</span></div>';

                $req_time = date('h:i A', strtotime($val['order_time']));
                $Req_Date_Time = '<span> '.date('d-m-Y', strtotime($val['order_date'])).'/<sub>'.$req_time.'</sub></span>';

                $order_type = '';

                if ($val['order_from'] == 1) {  
                    $order_type = 'On Call';
                } elseif ($val['order_from'] == 2) {
                    $order_type = 'From Staff';
                } elseif ($val['order_from'] == 3) {
                    $order_type = 'App Order';
                } elseif ($val['order_from'] == 4) {
                    $order_type = 'Walking ';
                }else{
                    $order_type = "-";
                }

                $note = '<div><a href="#"><div class="badge badge-info note_class" data-note-id="'.$val['food_order_id'].'" data-msg="'.$val['additional_note'].'">view</div></a></div>';

                $requirement = '<div><a href="#"><div class="badge badge-info new_food_ord_req" data-id="'.$val['food_order_id'].'">view</div></a></div>';

                $action = '<div><a href="#" class="btn btn-warning shadow btn-xs sharp me-1 edit_data" data-bs-toggle="modal" data-id="'.$val['food_order_id'].'" data-bs-target=".update_staff_modal"><i class="fa fa-share"></i></a></div>';	

                $data[] = array(
                    "sr_no"			=>	$row+$i++ ,
                    "order_id"	    =>  $order_id,
                    "req_date_time" =>  $Req_Date_Time,
                    "ord_type"      =>  $order_type,
                    "floor"	        =>  $val['floor'],
                    "room_no"	    =>  $val['room_no'],
                    "guest_name"	=>  $val['full_name'],
                    "note"	        =>  $note,
                    "requirement"   =>  $requirement,
                    "action"        =>  $action,
                );
            }
        }
       
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" =>$totalRecords,
            "aaData" => $data
        );
        echo json_encode($response);
    }

    public function check_category_name()
    {
        $admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        if($this->session->userdata('userType') == 2)
		{
			$hotel_id = $get_hotel_id['u_id']; 
		}
		else
		{
			$hotel_id = $get_hotel_id['hotel_id']; 
		} 

        $food_facility_id = $this->input->post('food_facility_id');
        $cat_name = $this->input->post('cat_name');
        $category_name_unick = $this->FoodAdminModel->check_exist_cat_name($hotel_id,$food_facility_id,$cat_name);
        if($category_name_unick->row_count > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
        exit;
    }

    public function accepted_order_of_food()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $draw  = $this->input->post('draw');
        $row  = $this->input->post('start');
        $rowperpage  = $this->input->post('length');
        $search_array  = $this->input->post('search');
        $search = !empty($search_array['value'])?$search_array['value']: '' ;

        $admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	if($this->session->userdata('userType') == 2)
        {
            $hotel_id = $get_hotel_id['u_id']; 
        }
        else
        {
            $hotel_id = $get_hotel_id['hotel_id']; 
        }

        $accepted_food_Order_list = $this->FoodAdminModel->accepted_food_Order_list($rowperpage,$row,$search, $hotel_id);
        
        // echo "<pre>";
        // print_r($new_Manage_Order_list);
        // exit;
        $total_accepted_food_list_data = $this->FoodAdminModel->total_accepted_food_list_data($search, $hotel_id);
        
        $totalRecords = $total_accepted_food_list_data->total_record;

        $data = array();
        $i=1;
        foreach($accepted_food_Order_list AS $val)
        {
            $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="'.$val['out_of_time_status'].'"><span> '.$val['food_order_id'].'</span></div>';

            $req_time = date('h:i A', strtotime($val['order_time']));
            $Req_Date_Time = '<span> '.date('d-m-Y', strtotime($val['order_date'])).'/<sub>'.$req_time.'</sub></span>';

            $order_type = '';

            if ($val['order_from'] == 1) {  
                $order_type = 'On Call Order';
             } elseif ($val['order_from'] == 2) {
                $order_type = 'From Staff Order';
             } elseif ($val['order_from'] == 3) {
                $order_type = 'App Order';
             } elseif ($val['order_from'] == 4) {
                $order_type = 'Walking Order';
             }else{
                $order_type = "-";
            }

            $Requirements = '<div><a href="#"><div class="badge badge-info accepted_view" data-view-id5="'.$val['food_order_id'].'" data-bs-toggle="modal">view</div></a></div>';

            $reassign = '<div><a href="#" data-hotel-id="'.$val['hotel_id'].'" data-id="'.$val['food_order_id'].'" data-staff-name="'.$val['staff_name'].'" data-staff-id="'.$val['staff_id'].'" class="btn btn-warning btn_reassign_ord" data-bs-toggle="modal" data-bs-target="#reassign_ord_modal" >Reassign?</button></a></div>'; 

            $order_status = '<div>
            <input type="hidden" name="user_id" id="foodorderid'.$val['food_order_id'].'" value="'.$val['food_order_id'].'">
            <input type="hidden" name="useruid" id="useruid'.$val['food_order_id'].'" value="'.$val['u_id'].'">
            <input type="hidden" name="userhotelid" id="userhotelid'.$val['food_order_id'].'" value="'.$val['hotel_id'].'">
            
           
            
            
            <select class="form-control" name="status" id="foodstatus'.$val['food_order_id'].'" onchange="change_status('.$val['food_order_id'].');" style="min-width:85px;text-align:center">
                <option value="1" selected>Accepted</option>
                <option value="2">Completed</option>
            </select>
            </div>';	

            $data[] = array(
                "sr_no"			=>	$row+$i++ ,
                "order_id"	    =>  $order_id,
                "req_date_time" =>  $Req_Date_Time,
                "ord_type"      =>  $order_type,
                "floor"	        =>  $val['floor'],
                "room_no"	    =>  $val['room_no'],
                "guest_name"	=>  $val['full_name'],
                "Requirements"	=>  $Requirements,  
                "Assign_Order"  =>  $val['staff_name'],
                "Reassign_Order"=>  $reassign,
                "Order_Status"  =>  $order_status,
            );
        }
       
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" =>$totalRecords,
            "aaData" => $data
        );
        echo json_encode($response);
    }

}