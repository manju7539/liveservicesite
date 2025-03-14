<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuSettingsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->model('SuperAdminModel', 'SuperAdmin');
        $this->load->helper('notification_helper');
    
        $this->load->model('MainModel');

        if (empty($this->session->userdata('u_id'))) {
            redirect('/');
        }
        // $this->load->library('pagination');
    }
    public function index()
    {
      //  $this->SuperAdmin->remove_mode();
        $this->load->view('include/header');
        $this->load->view('page/dashboard');
        $this->load->view('include/footer');
    }

    // hotel list menu
    public function hotelLists()
    {
     // $this->SuperAdmin->remove_mode();
        $admin_id = $this->session->userdata('u_id');
        $where = '(user_type = 2)';
        $date = $this->input->post('register_date');
        $searchon = $this->input->post('hotel_name');
        $city = $this->input->post('city');
    
        // $data['hotel_data'] = $this->SuperAdmin->getAllDatat($tbl = 'register', $where);
        $data['hotel_data']= $this->SuperAdmin->searchCrud($where);
      
        if(isset($date) && empty($searchon) && empty($city))
        {
            $data['hotel_data'] = $this->SuperAdmin->ser_check_list($date);
            $this->load->view('include/header');
            $this->load->view('superadmin/hotelLists', $data);
            $this->load->view('include/footer');
        }
        elseif(empty($date) && !empty($searchon) && empty($city))
        {
            $data['hotel_data'] = $this->SuperAdmin->ser_check_list_hotel($searchon);
            $this->load->view('include/header');
            $this->load->view('superadmin/hotelLists', $data);
            $this->load->view('include/footer');
        }
        elseif(empty($date) && empty($searchon) && !empty($city))
        {
            $wh = '(city = "'.$city.'" AND user_type = 2)';
            $data['hotel_data'] = $this->MainModel->getAllData('register',$wh);
            $this->load->view('include/header');
            $this->load->view('superadmin/hotelLists', $data);
            $this->load->view('include/footer');
        }
        elseif(!empty($date) && !empty($searchon) && empty($city))
        {
            $wh = '(register_date = "'.$date.'" AND u_id = "'.$searchon.'")';
            $data['hotel_data'] = $this->MainModel->getAllData('register',$wh);
            $this->load->view('include/header');
            $this->load->view('superadmin/hotelLists', $data);
            $this->load->view('include/footer');
        }
        elseif(!empty($date) && empty($searchon) && !empty($city))
        {
            $wh = '(register_date = "'.$date.'" AND city = "'.$city.'")';
            $data['hotel_data'] = $this->MainModel->getAllData('register',$wh);
            $this->load->view('include/header');
            $this->load->view('superadmin/hotelLists', $data);
            $this->load->view('include/footer');
        }
        elseif(empty($date) && !empty($searchon) && !empty($city))
        {
            $wh = '(u_id = "'.$searchon.'" AND city = "'.$city.'")';
            $data['hotel_data'] = $this->MainModel->getAllData('register',$wh);
            $this->load->view('include/header');
            $this->load->view('superadmin/hotelLists', $data);
            $this->load->view('include/footer');
        }
        elseif(!empty($date) && !empty($searchon) && !empty($city))
        {
            $data['hotel_data'] = $this->SuperAdmin->searchcCrud($searchon,$date,$city);
            $this->load->view('include/header');
            $this->load->view('superadmin/hotelLists', $data);
            $this->load->view('include/footer');
        }
        else
        {
            $this->load->view('include/header');
            $this->load->view('superadmin/hotelLists', $data);
            $this->load->view('include/footer');
        }
    }

    // add hotel 
    public function add_hotels()
    {
        $file="";
        if (!empty($_FILES['hotel_logo']['name'])) 
        {
            $_FILES['my_uploaded_file']['name'] = $_FILES['hotel_logo']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['hotel_logo']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['hotel_logo']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['hotel_logo']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['hotel_logo']['size'];

            $path = 'assets/hotel_logo/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
                
            if ($this->upload->do_upload('my_uploaded_file'))
            {
                $file_data = $this->upload->data();
                $file_path_url =base_url().$path.$file_data['file_name'];
                $file=$file_path_url;
            }
            else
            {
                $file="";
            }
        }
       
        $hotel_name = $this->input->post('hotel_name');
        $full_name = $this->input->post('full_name');
        $email_id = $this->input->post('email_id');
        $password = $this->input->post('password');
        // $confirm_pass   = $this->input->post('confirm_pass');

        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $mobile_no = $this->input->post('mobile_no');
        $area = $this->input->post('area');
        $pincode = $this->input->post('pincode');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $department_id = $this->input->post('department_id');
        $department_id11 = 1;

        // $departmment_id      = $this->input->post('department_status');
        $departmment_id = $this->input->post('departmment_id');
        $department_name = $this->input->post('department_name');
        $department_status = $this->input->post('department_status');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $price = $this->input->post('price');
        $services_id = $this->input->post('services_id');
        $services_name = $this->input->post('services_name');

        $price1 = array_values(array_filter($price));
        $start_date1 = array_values(array_filter($start_date));
        $end_date1 = array_values(array_filter($end_date));
        // $department_status22 = array_values( array_filter($department_status) );
        $department_name11 = array_values(array_filter($department_name));
        $services_name1 = array_values(array_filter($services_name));

        $arr = array(
            // 'u_id'        => $u_id,
            // 'hotel_id'        =>$u_id,
            'hotel_name' => $hotel_name,
            'full_name' => $full_name,
            'email_id' => $email_id,
            'mobile_no' => $mobile_no,
            'area' => $area,
            'password' => md5($password),
            'password_text' => $password,
            'pincode' => $pincode,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'hotel_logo' => $file,
            'is_active' => 1,
            'user_type' => 2,
            'register_date' => date('Y-m-d'),
        );

        $add = $this->SuperAdmin->insert_data('register', $arr);
        if ($add) 
        {
            if (isset($department_status)) 
            {
                $temp = count($department_status);
                for ($i = 0; $i < $temp; $i++) 
                {
                    $wh_s_id1 = '( department_id ="' . $department_status[$i] . '")';
                    $service_data1 = $this->SuperAdmin->getSingleData($tbl = "departement", $wh_s_id1);
                    $data = array(
                        'admin_id' => $add,
                        'department_id' => $department_status[$i],
                        'department_name' => $service_data1['department_name'],
                        // 'department_status'  => $department_id[$i],
                        'department_status' => 1,
                        'start_date' => date("Y-m-d", strtotime($start_date1[$i])),
                        'end_date' => date("Y-m-d", strtotime($end_date1[$i])),
                        'price' => $price1[$i],
                    );
                    $department_permission = $this->SuperAdmin->insert_data('hotels_panel_list', $data);
                }
            }
        }

        if ($department_permission) 
        {
            //   if(isset($services_id))
            //    {
            //     $tempp = count($services_id);

            //      for($j = 0 ;$j < $tempp; $j++)
            //       {
            //            $datas = array(
            //                         'hotel_id'       => $add,
            //                         'department_id'  =>  $departmment_id[$j],
            //                         'services_id'    =>  $services_id[$j],
            //                         'services_name'  => $services_name1[$j],
            //                         );

            //          $service_permission = $this->SuperAdmin->insert_data('hotels_services',$datas);
            //       }

            //     }

            if (!empty($services_id)) 
            {
                foreach ($services_id as $s_ids) 
                {
                    $s_array = explode('_', $s_ids);
                    $wh_s_id = '(departtment_id="' . $s_array[0] . '" AND service_id ="' . $s_array[1] . '")';
                    $service_data = $this->SuperAdmin->getSingleData($tbl = "services_of_department", $wh_s_id);
                    $datas = array(
                        'hotel_id' => $add,
                        'department_id' => $s_array[0],
                        'services_id' => $s_array[1],
                        'services_name' => $service_data['service_name'],
                    );

                    $service_permission = $this->SuperAdmin->insert_data('hotels_services', $datas);

                }
                if ($services_id = 12) 
                {
                    $staff_name = "Dummy Staff";
                    $description = "Dummy description";
                    $t_nd_c = "Dummy Terms and Condition";
                    $contact_no = "Dummy Contact No";
                    $datas = array(
                        'hotel_id' => $add,
                        'service_name' => 4,
                        'staff_name' => $staff_name,
                        'contact_no' => $contact_no,
                        'description' => $description,
                        't_nd_c' => $t_nd_c,
                    );

                    $service_permission = $this->SuperAdmin->insert_data('front_ofs_services', $datas);
                    if ($service_permission) 
                    {
                        $spa_photo = base_url() . 'assets/dist/shuttle1.jpg';
                        $arr1 = array(

                            'hotel_id' => $add,
                            'service_name' => 3,
                            'front_ofs_service_id' => $service_permission,
                            'image' => $spa_photo,
                        );
                        $this->SuperAdmin->insert_data('front_ofs_services_images', $arr1);
                    }
                }
                if ($services_id = 2) 
                {
                    $staff_name = "Dummy Staff";
                    $description = "Dummy description";
                    $contact_no = "Dummy Contact No";
                    $open_time = "Dummy Open time";
                    $t_nd_c = "Dummy Terms and Condition";

                    $datas = array(
                        'hotel_id' => $add,
                        'service_name' => 2,
                        'staff_name' => $staff_name,
                        'contact_no' => $contact_no,
                        'description' => $description,
                        't_nd_c' => $t_nd_c,
                        'open_time' => $open_time,
                        'close_time' => 0,
                        'break_start_time' => 0,
                        'break_close_time' => 0,
                        'added_by_u_id' => 1,
                    );

                    $service_permission11 = $this->SuperAdmin->insert_data('front_ofs_services', $datas);

                    if ($service_permission11) 
                    {
                        $spa_photo = base_url() . 'assets/dist/spa11.jpg';
                        $arr1 = array(

                            'hotel_id' => $add,
                            'service_name' => 2,
                            'front_ofs_service_id' => $service_permission11,
                            'image' => $spa_photo,
                        );

                        $this->SuperAdmin->insert_data('front_ofs_services_images', $arr1);

                        $spa_photo = base_url() . 'assets/dist/spa11.jpg';
                        $spa_type = "Dummy spa type";
                        $spa_price = "Dummy spa price";
                        $spa_type_description = "Dummy spa description";
                        $datas = array(
                            'hotel_id' => $add,
                            'front_ofs_service_id' => $service_permission11,
                            'spa_photo' => $spa_photo,
                            'spa_type' => $spa_type,
                            'spa_price' => $spa_price,
                            'spa_description' => $spa_type_description,
                        );
                        $service_permission12 = $this->SuperAdmin->insert_data('front_ofs_spa_service_images', $datas);
                    }
                }
                if ($services_id = 3) 
                {
                    $staff_name = "Dummy Staff";
                    $description = "Dummy description";
                    $t_nd_c = "Dummy Terms and Condition";
                    $contact_no = "Dummy Contact No";
                    $open_time = "Dummy Open time";
                    $close_time = "Dummy Close time";
                    $datas = array(
                        'hotel_id' => $add,
                        'service_name' => 1,
                        'staff_name' => $staff_name,
                        'contact_no' => $contact_no,
                        'description' => $description,
                        't_nd_c' => $t_nd_c,
                        'open_time' => $open_time,
                        'close_time' => $close_time,
                        'break_start_time' => 0,
                        'break_close_time' => 0,
                        'added_by_u_id' => 1,
                    );

                    $service_permission21 = $this->SuperAdmin->insert_data('front_ofs_services', $datas);

                    if ($service_permission21) 
                    {
                        $spa_photo = base_url() . 'assets/dist/gymm.jpg';
                        $arr1 = array(

                            'hotel_id' => $add,
                            'service_name' => 1,
                            'front_ofs_service_id' => $service_permission21,
                            'image' => $spa_photo,
                        );

                        $this->SuperAdmin->insert_data('front_ofs_services_images', $arr1);
                    }
                }

                if ($services_id = 4) 
                {
                    $staff_name = "Dummy Staff";
                    $description = "Dummy description";
                    $t_nd_c = "Dummy Terms and Condition";
                    $contact_no = "Dummy Contact No";
                    $open_time = "Dummy Open time";
                    $close_time = "Dummy Close time";
                    $datas = array(
                        'hotel_id' => $add,
                        'service_name' => 3,
                        'staff_name' => $staff_name,
                        'contact_no' => $contact_no,
                        'description' => $description,
                        't_nd_c' => $t_nd_c,
                        'open_time' => $open_time,
                        'close_time' => $close_time,
                        'break_start_time' => 0,
                        'break_close_time' => 0,
                        'added_by_u_id' => 1,
                    );

                    $service_permission21 = $this->SuperAdmin->insert_data('front_ofs_services', $datas);

                    if ($service_permission21) 
                    {
                        $spa_photo = base_url() . 'assets/dist/pool11.jpg';
                        $arr1 = array(

                            'hotel_id' => $add,
                            'service_name' => 3,
                            'front_ofs_service_id' => $service_permission21,
                            'image' => $spa_photo,
                        );

                        $this->SuperAdmin->insert_data('front_ofs_services_images', $arr1);
                    }
                }

                if ($services_id = 7) 
                {
                    $staff_name = "Dummy Staff";
                    $description = "Dummy description";
                    $t_nd_c = "Dummy Terms and Condition";
                    $contact_no = "Dummy Contact No";
                    $open_time = "Dummy Open time";
                    $close_time = "Dummy Close time";
                    $datas = array(
                        'hotel_id' => $add,
                        'service_name' => 5,
                        'staff_name' => $staff_name,
                        'contact_no' => $contact_no,
                        'description' => $description,
                        't_nd_c' => $t_nd_c,
                        'open_time' => $open_time,
                        'close_time' => $close_time,
                        'break_start_time' => 0,
                        'break_close_time' => 0,
                        'added_by_u_id' => 1,
                    );

                    $service_permission21 = $this->SuperAdmin->insert_data('front_ofs_services', $datas);

                    if ($service_permission21) 
                    {
                        $spa_photo = base_url() . 'assets/dist/babyc.jpg';
                        $arr1 = array(

                            'hotel_id' => $add,
                            'service_name' => 5,
                            'front_ofs_service_id' => $service_permission21,
                            'image' => $spa_photo,
                        );

                        $this->SuperAdmin->insert_data('front_ofs_services_images', $arr1);
                    }
                }
            }
            $where = '(user_type = 2)';
            $data['hotel_data']= $this->SuperAdmin->searchCrud($where);
            $this->load->view('superadmin/ajaxhotellistupdateddata',$data);
        } 
        else 
        {
            echo "<script>
                    alert('Unable to insert Data...!');
                    window.location.href='" . base_url('Add_hotel') . "';
                  </script>";
        }
        // }
    }

    // fetch hotel data for edit
    public function get_hotellist_data()
    {
        $id= $this->input->post('id');
        $where = '(u_id = "'.$id.'"  )';
        // $date = $this->input->post('register_date');
        $searchon = $this->input->post('city_name');
        
        $wh = '(city_id = "'.$searchon.'")';
        $data['l']= $this->SuperAdmin->searchCrud($where);
        $data['city_namee'] = $this->SuperAdmin->getSingleData('city',$wh);
        $this->load->view('superadmin/ajaxhotelllistedit', $data);
    }

    // update hotel
    public function update_hotel()
    {
        $u_id        = $this->input->post('u_id');  	
        $hotelname   = $this->input->post('hotel_name');
        $adminname   = $this->input->post('full_name');
        $latitude    = $this->input->post('latitude');
        $longitude   = $this->input->post('longitude');
        $email       = $this->input->post('email_id');
        $phone       = $this->input->post('mobile_no');
        $address     = $this->input->post('address');
        $area        = $this->input->post('area');
        $pincode     = $this->input->post('pincode');
        $city        = $this->input->post('city');
        $state       = $this->input->post('state');
        $where = '(user_type = 2)';
        
        $arr=array(
            'hotel_name'  => $hotelname,
            'full_name'  => $adminname ,
            'latitude'   => $latitude,
            'longitude'  => $longitude,
            'email_id'   =>$email,
            'mobile_no'  => $phone,
            'address'    => $address,
            'area'       => $area,
            'pincode'    => $pincode,
            'city'       => $city,
            'state'      => $state,
            
            );
    
        $where1='(u_id="'.$u_id.'")';
        $result= $this->MainModel->editData($tbl='register', $where1, $arr);   		
        
        if($result)
        {
            $data['hotel_data']= $this->SuperAdmin->searchCrud($where);
            $this->load->view('superadmin/ajaxhotellistupdateddata',$data);
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
        }
    }

    // delete hotel
    public function  delete_hotel()
    {
        $id = $this->input->post('id');
        $where = '(u_id = "' . $id . '") or (hotel_id = "'.$id.'")';
        $result = $this->SuperAdmin->deleteData($tbl = "register", $where);

        $where_offer = '(hotel_id = "' . $id . '")';
        $offer = $this->SuperAdmin->deleteData($tbl = "offers", $where_offer);

        if ($result) 
        {
            $where1 = '(user_type = 2)';
            $data['hotel_data']= $this->SuperAdmin->searchCrud($where1);
            $this->load->view('superadmin/ajaxhotellistupdateddata',$data);
        } 
        else 
        {
            echo "0";
        }
    }

    // closure lead count
    public function closer_cound_leads()
    {
        // $this->session->userdata('u_id')
        // $admin_id = $this->uri->segment(2);
        $admin_id= $this->input->post('u_id1'); 
      
        $request_status= 1;
        $closer_count_list['closer_lead_list'] = $this->MainModel->get_request($admin_id,$request_status);
        $this->load->view('superadmin/ajaxcloser_cound_leads',$closer_count_list);
    }

    public function change_user_status()
    {
        $arr=array(
                    'is_active'=>$_POST['active']
                
                    );
        
        $u_id = $_POST['uid'];
        $where = '(u_id="' . $u_id . '")';
        $id = $this->MainModel->editData($tbl="register",$where,$arr); 
        if($id)
        {
            echo json_encode(TRUE);
        }
        else
        {
            echo json_encode(FALSE);
        }	
    }

    public function hotel_info()
	{
        // $admin_id = $this->session->userdata('u_id');
        // $where = '(user_type = 2)';
        $admin_id = $this->uri->segment(3);
        // $data['hotel_data'] = $this->SuperAdmin->getAllDatat($tbl = 'register', $where);
             
        $hotel_information['data'] = $this->SuperAdmin->get_user_dataa($admin_id);
        $hotel_information['facility_list'] = $this->SuperAdmin->get_hotels_facility($admin_id);
        $hotel_information['leads_purchase_list'] = $this->SuperAdmin->get_hotel_admin_leads($admin_id);
        $hotel_information['hotels_pics'] = $this->SuperAdmin->get_hotel_photos($admin_id);
        $this->load->view('include/header');
        $this->load->view('superadmin/ViewHotelInfo', $hotel_information);
        $this->load->view('include/footer');
	}

    public function hotel_info_sub_edit()
	{
        // $where = '(user_type = 2)';
        $u_id = $this->input->post('id');
        $data['info'] = $this->MainModel->get_listt1($u_id);
        $this->load->view('superadmin/ajaxViewHotelInfo', $data);
	}
    
    public function isEmailExist()
    {
        $email_id = $this->input->post('email_id');
        $password         = $this->input->post('password');
        // $confirm_pass      = $this->input->post('confirm_pass');

        $hotel_name         = $this->input->post('hotel_name');
        $full_name          = $this->input->post('full_name');
        $latitude           = $this->input->post('latitude');
        $longitude          = $this->input->post('longitude');
        $mobile_no          = $this->input->post('mobile_no');
        $area               = $this->input->post('area');
        $pincode            = $this->input->post('pincode');
        $address            = $this->input->post('address');
        $city               = $this->input->post('city');
        $state              = $this->input->post('state');
     
        $wh = '(email_id = "'.$email_id.'")';
        $email_data = $this->MainModel->get_email_data('register',$wh);

        if(!empty($email_data) && !empty($email_id))
        {
             echo "1";
            // $email = array(
            //                 'email_id' => $email_data['email_id'],        
            //               );
            //  echo json_encode($email);
        }
        else if(empty($hotel_name))
        {
             echo "2";
        }
        else if(empty($full_name))
        {
             echo "3";
        }
        else if(empty($latitude))
        {
             echo "4";
        }
        else if(empty($longitude))
        {
             echo "5";
        }
        else if(empty($email_id))
        {
             echo "6";
        }
        else if(empty($password))
        {
            echo "7";
        }
        else if(empty($mobile_no))
        {
             echo "8";
        }
        else if(empty($address))
        {
             echo "9";
        }
        else if(empty($area))
        {
             echo "10";
        }
        elseif(empty($pincode))
        {
             echo "11";
           
        }
        else if(empty($state))
        {
             echo "12";                                  
        }
         elseif(empty($city))
        {
             echo "13";
        }
        else
        {
            echo "0";
        }

    }
    
    public function delete_services()
    {
        $id=$this->input->post('id');
        $where = '(id = "'.$id.'")';
        $result= $this->MainModel->deleteData($tbl="hotel_admin_wallet_history", $where);

        if ($result) 
        {
            echo "1";
        } 
        else 
        {
            echo "0";
        }
    }
    
    public function guestfrom()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
        $city = $this->input->post('city');
        $searchon = $this->input->post('hotel_id');
        $date = $this->input->post('register_date');
        if(!empty($date) && !empty($searchon) && !empty($city) )
        {
            $data['list'] = $this->SuperAdmin->web_guest_all_filter($date,$searchon,$city);
            $this->load->view('include/header');
            $this->load->view('superadmin/webGuest', $data);
            $this->load->view('include/footer');
        }
        else
        {
            $guest_mng['list'] = $this->SuperAdmin->get_guest_list();
            $this->load->view('include/header');
            $this->load->view('superadmin/webGuest',$guest_mng);
            $this->load->view('include/footer');
        }
	}
    public function activeGuest()
    {
        $admin_id = $this->session->userdata('u_id');
        $city = $this->input->post('city');
        $searchon = $this->input->post('hotel_id');
        $date = $this->input->post('register_date');
        
        if(!empty($date) && !empty($searchon) && !empty($city) )
        {
        
            $data['list'] = $this->SuperAdmin->active_guest($date,$searchon,$city);
            $this->load->view('include/header');
            $this->load->view('superadmin/activeGuest', $data);
            $this->load->view('include/footer');
        }
        else 
        {
            $where = '(is_guest = 1)';
            $guest_mng['list'] = $this->SuperAdmin->get_guest_via_app_list();
            // echo "<pre>";print_r($guest_mng);die;
            $this->load->view('include/header');
            $this->load->view('superadmin/activeGuest', $guest_mng);
            $this->load->view('include/footer');
        }
    }
    
    public function getEditDataofCity()
    {
		$where = $this->input->post('id');
		$wh = '(city_id ="'.$where.'")';
		$data = $this->MainModel->getSingleData($tbl ='city', $wh);
		echo json_encode($data);
	}
    
    public function guest_view()
    {
        $booking_id = $this->uri->segment(3);
        $u_id = $this->uri->segment(4);
        $where ='(booking_id = "'.$booking_id.'" )';
        $admin_details = $this->MainModel->getData($tbl ='user_hotel_booking', $where);
        $admin_id = $admin_details['hotel_id'];

        $check_out_view['admin_data'] = $this->SuperAdmin->get_user_dataa($admin_id);
        $check_out_view['user_data'] = $this->SuperAdmin->get_user_dataa($u_id);
        $check_out_view['booking_details'] = $this->SuperAdmin->get_user_booking_details($admin_id,$booking_id);
        $check_out_view['booking_checkout_data'] = $this->SuperAdmin->get_user_checkout_booking_data($admin_id,$booking_id,$u_id);
        $check_out_view['booking_room_details'] = $this->SuperAdmin->get_booking_room_details($booking_id);
        $check_out_view['minibar_list'] = $this->SuperAdmin->get_room_service_minibar($admin_id);
        $this->load->view('include/header');
        $this->load->view('superadmin/ajaxGuest_View',$check_out_view);
        $this->load->view('include/footer');
    }
        
    public function update_vality_department()
    {  
        $admin_id       = $this->input->post('id'); 
        $u_id       = $this->input->post('admin_id');  
        $start_date     = $this->input->post('start_date');  	
        $end_date       =$this->input->post('end_date');
        $price          =$this->input->post('price');

        $arr=array(
            'start_date'  => $start_date,
            'end_date'    => $end_date,
            'price'       => $price,
        );

        $where1='(id="'.$admin_id.'")';
        $result['info']= $this->SuperAdmin->editData($tbl='hotels_panel_list', $where1, $arr);  
        if($result)
        {
            $data['info'] = $this->MainModel->get_listt($u_id);
            $this->load->view('superadmin/ajaxviewhotelinfoodata_edittable',$data);  
        }
        else
        {
            $this->session->set_flashdata('validity_error_msg', 'Something Went Wrong..!');
        }
    }
             
    // dasshboard enquiry list show
    public function enquiry()
    {
        $u_id = $this->session->userdata('u_id');
        $where ='(u_id = "'.$u_id.'")';
        $admin_details = $this->MainModel->getData($tbl ='register', $where);
        $admin_id = $admin_details['hotel_id'];
        $hotel_name = $this->input->post('hotel_id');

        $where1 = '(request_status = 1 AND hotel_id="'.$hotel_name.'")';
        if(isset($hotel_name))
        {
            $data['list'] = $this->SuperAdmin->ser_check_en_data($where1);
            $this->load->view('include/header');
            $this->load->view('superadmin/enquiry',$data);
            $this->load->view('include/footer');
        }
        else
        {
            $enquiry_request["list"] = $this->SuperAdmin->get_hotel_enquiry_request_pagination();
            $this->load->view('include/header');
            $this->load->view('superadmin/enquiry',$enquiry_request);
            $this->load->view('include/footer');
        }
    } 
            
    // leads plan menu    
    public function leadsPlan()
    {
        $admin_id = $this->session->userdata('u_id');   
        // $where = '(user_type = 2)';
        $data['leads_plan'] = $this->SuperAdmin->getPlan($tbl = 'leads_plan');
        $this->load->view('include/header');
        $this->load->view('superadmin/leadsPlan', $data);
        $this->load->view('include/footer');
    }

    // add lead plan
    public function add_plan()
    {
        $admin_id = $this->session->userdata('u_id');
        $ledas_name = $this->input->post('ledas_name');
        $amount = $this->input->post('amount');
        $description = $this->input->post('description');

        $arr = array(
            'ledas_name' => $ledas_name,
            'amount' => $amount,
            'description' => $description,
        );

        $add = $this->SuperAdmin->insertData($tbl = "leads_plan", $arr);
        if ($add) {
            $data["leads_plan"] = $this->SuperAdmin->getPlan($tbl = 'leads_plan');
            $this->load->view('superadmin/ajaxLeads_plan', $data);
        }
    }

    // fetch lead plan data for edit
    public function getEditDataofLeadsPlan()
    {
		$where = $this->input->post('id');
		$wh = '(leads_plan_id ="'.$where.'")';
		$data = $this->MainModel->getSingleData($tbl ='leads_plan', $wh);
		echo json_encode($data);
	}

    // update lead plan
    public function update_plan()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('leads_plan_id');
        $data['leads_plan'] = $this->SuperAdmin->getPlan($tbl = 'leads_plan');

        $arr = array(
            'ledas_name' => $this->input->post('ledas_name'),
            'amount' => $this->input->post('amount'),
            'description' => $this->input->post('description'),
        );
        $edit = $this->SuperAdmin->editData1($tbl = 'leads_plan', $where, $arr);

        if ($edit) {
            $data["leads_plan"] = $this->SuperAdmin->getPlan($tbl = 'leads_plan');
            $this->load->view('superadmin/ajaxLeads_plan', $data);
        }
    }

    // delete leads plan
    public function delete_plan()
    {
        $id = $this->input->post('id');
        $where = '(leads_plan_id = "' . $id . '")';
        $result = $this->SuperAdmin->deleteData($tbl = "leads_plan", $where);
        if ($result) 
        {
            $data["leads_plan"] = $this->SuperAdmin->getPlan($tbl = 'leads_plan');
            $this->load->view('superadmin/ajaxLeads_plan', $data);
        } else 
        {
            echo "0";
        }
    }

    // leads recharge menu
    public function leadRecharge()
    {
        $admin_id = $this->session->userdata('u_id');
        $data['leads_recharge'] = $this->SuperAdmin->getPlan($tbl = 'leads_recharge');
        $this->load->view('include/header');
        $this->load->view('superadmin/leadRecharge', $data);
        $this->load->view('include/footer');
    }

    // add lead rechage 
    public function lead_recharge()
    {
        $admin_id = $this->session->userdata('u_id');
        $city = $this->input->post('city');
        $lead_cost = $this->input->post('lead_cost');
        $lead_percentage = $this->input->post('lead_percentage');

        $arr = array(
            'city' => $city,
            'lead_cost' => $lead_cost,
            'lead_percentage' => $lead_percentage,
        );

        $add = $this->SuperAdmin->insertData($tbl = "leads_recharge", $arr);
        
        if ($add) 
        {
            $data["leads_recharge"] = $this->SuperAdmin->getPlan($tbl = 'leads_recharge');
            $this->load->view('superadmin/ajaxLeadRecharge', $data);
        }
    }
    
    // fetch lead rechage data for edit
    public function getEditdata_lead_recharge()
    {
		$where = $this->input->post('id');
		$wh = '(leads_recharge_id ="'.$where.'")';
		$data = $this->MainModel->getSingleData($tbl ='leads_recharge', $wh);

		echo json_encode($data);
	}

    // update lead rechage 
    public function update_lead_recharge()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('leads_recharge_id');
        $data['leads_recharge'] = $this->SuperAdmin->getPlan($tbl = 'leads_recharge');

        $arr = array(
            'city' => $this->input->post('city'),
            'lead_cost' => $this->input->post('lead_cost'),
            'lead_percentage' => $this->input->post('lead_percentage'),
        );
        $where = $this->input->post('leads_recharge_id');
        $edit = $this->SuperAdmin->editData_recharge($tbl = 'leads_recharge', $where, $arr);

        if ($edit) 
        {
            $data["leads_recharge"] = $this->SuperAdmin->getPlan($tbl = 'leads_recharge');
            $this->load->view('superadmin/ajaxLeadRecharge', $data);
        }
    }

    // delete lead recharge
    public function delete_lead_recharge()
    {
        $id = $this->input->post('id');
        $where = '(leads_recharge_id = "' . $id . '")';
        $result = $this->SuperAdmin->deleteData($tbl = "leads_recharge", $where);
        if ($result) 
        {
            $data["leads_recharge"] = $this->SuperAdmin->getPlan($tbl = 'leads_recharge');
            $this->load->view('superadmin/ajaxLeadRecharge', $data);
        } 
        else 
        {
            echo "0";
        }
    }

    // hotel credit menu
    public function mng_credits()
    {
        $admin_id = $this->session->userdata('u_id');
        $data['leads_recharge'] = $this->SuperAdmin->get_credit_amount();
        $this->load->view('include/header');
        $this->load->view('superadmin/mng_credits', $data);
        $this->load->view('include/footer');
    }

    // add hotel credit
    public function mng_credits_add()
    {
        $hotel_id = $this->input->post('hotel_name');
        $city = $this->input->post('city');
        $amount = $this->input->post('amount');
        $user = $this->SuperAdmin->get_hotel_credit_data($hotel_id);

        $arr = array(
            'hotel_id' => $hotel_id,
            'city_name' => $city,
            'amount' => $user['amount'] + $amount,
        );

        $insert_id22 = $this->SuperAdmin->insertData($tbl = 'hotel_credit_amount_list', $arr);

        if ($insert_id22) 
        {

            $arr = array(
                'hotel_admin_id' => $hotel_id,
                'amount' => $amount,
                'city_name' => $city,
                'amount_status' => 1,
                'added_by' => 1,
            );

            $add = $this->SuperAdmin->insertData('hotel_admin_wallet_history', $arr);

            $wh = '(u_id = "' . $hotel_id . '")';
            $user2 = $this->SuperAdmin->get_user_dataa($hotel_id);

            $arr_p = array(
                'wallet_points' => $user2['wallet_points'] + $amount,
            );
            $up = $this->SuperAdmin->editDatat('register', $wh, $arr_p);
          
            //  $this->session->set_flashdata('credit_msg','Wallet amount added Successfully...');
            //  redirect(base_url('mng_credits'));
            // $data["leads_recharge"] = $this->SuperAdmin->getPlan($tbl = 'hotel_admin_wallet_history');
            $data['leads_recharge'] = $this->SuperAdmin->get_credit_amount();
            $this->load->view('superadmin/ajaxmng_charge', $data);
        } 
        else 
        {
            $this->session->set_flashdata('credit_error_msg', 'Something went wrong');
            redirect(base_url('mng_credits'));
        }
    }

    // fetch hotel credit data for edit
    public function getEditdata_mng_credit()
    {
        $id = $this->input->post('id');
        $city_id = $this->input->post('city_id');
        $where = '(id = "' . $id . '")';
        $data['leads_recharge'] = $this->SuperAdmin->get_credit_amount_mng_credit($where);
        $wh = '(city_id = "'.$city_id.'")';
        $data['city_names'] = $this->SuperAdmin->getSingleData('city',$wh);
        $data['id'] = $data['leads_recharge'][0]['id'];
        $data['hotel_id'] = $data['leads_recharge'][0]['hotel_id'];
        $data['amount'] = $data['leads_recharge'][0]['amount'];
        $data['city_name'] = $data['city_names']['city'];
        $data['city_id'] = $data['leads_recharge'][0]['city_name'];
        
        echo json_encode($data);
    }

    // update hotel credit
    public function update_credit_amount()
    {  
        $id= $this->input->post('id');  
        $hotelname=$this->input->post('hotel_name1');
        $city=$this->input->post('city_name');
        $amount=$this->input->post('amount');
        
        $arr=array(
            
            'hotel_id' => $hotelname,
            'city_name'=> $city,
            'amount'=> $amount
            );
        $where1='(id="'.$id.'")';
        $result= $this->MainModel->editData($tbl='hotel_credit_amount_list', $where1, $arr); 
        
        if($result)
        {
            $wh = '(u_id = "'.$hotelname.'")';
            $user2 = $this->SuperAdmin->get_user_dataa($hotelname);
            $wallet_points = $user2['wallet_points'] ?? 0;
            $arr_p = array(
                            'wallet_points' => $wallet_points + $amount 
                        );
            $up = $this->MainModel->editData('register',$wh,$arr_p);
            $wallet_dat = $this->SuperAdmin->get_hotel_credit_data($hotelname);

            $arr =  array(
        
                //'amount' => $wallet_dat['amount'] + $amount ,
                // 'city_name'=> $city,
                'amount'=> $amount,
            );
            $where1='(hotel_admin_id="'.$hotelname.'")';
            $add = $this->MainModel->editData('hotel_admin_wallet_history', $where1,$arr);
            $data['leads_recharge'] = $this->SuperAdmin->get_credit_amount();
            $this->load->view('superadmin/ajaxmng_charge',$data);
        }
        else
        {
            $this->session->set_flashdata('credit_error_msg', 'Something Went Wrong..!');
        }
    }

    // delete hotel credit
    public function delete_mng_charge()
    {
        $id = $this->input->post('id');
        $where = '(id = "' . $id .'")';
        $result = $this->SuperAdmin->deleteData($tbl = "hotel_credit_amount_list", $where);
        if ($result) 
        {
            $data['leads_recharge'] = $this->SuperAdmin->get_credit_amount();
            $this->load->view('superadmin/ajaxmng_charge',$data);
        } 
        else 
        {
            echo "0";
        }
    }

    // all leads menu
    public function leads()
    {
        $uid = $this->session->userdata('u_id');
        $date = $this->input->post('check_in_date');
        $searchon = $this->input->post('hotel_id');

        if (!empty($date)) 
        {
            $closer_count_list['all_lead_list'] = $this->SuperAdmin->search_lead_datewise($date);
            $this->load->view('include/header');
            $this->load->view('superadmin/leads', $closer_count_list);
            $this->load->view('include/footer');
        } 
        elseif (!empty($searchon)) 
        {
            $closer_count_list['all_lead_list'] = $this->SuperAdmin->search_hotel_lead_datewise($searchon);
            $this->load->view('include/header');
            $this->load->view('superadmin/leads', $closer_count_list);
            $this->load->view('include/footer');
        } 
        else 
        {
            $admin_id = $this->session->userdata('u_id');
            $where = '(request_status = 1)';
            $closer_count_list['all_lead_list'] = $this->SuperAdmin->get_request_list();
            $closer_count_list['accept_request_leads'] = $this->SuperAdmin->get_accept_request_list();
            $this->load->view('include/header');
            $this->load->view('superadmin/leads', $closer_count_list);
            $this->load->view('include/footer');
        }
    }
                
    // plan purchase memu 
    public function plan_purchase_hotels()
    {
        $uid = $this->session->userdata('u_id');
        $buy_plan['plan_purchase_list'] = $this->SuperAdmin->get_leads_plan_list();
        $this->load->view('include/header');
        $this->load->view('superadmin/plan_purchase_hotels', $buy_plan);
        $this->load->view('include/footer');
    }

    // guest menu list
    public function guest_panel()
    {
        $admin_id = $this->session->userdata('u_id');
        $city = $this->input->post('city');
        $searchon = $this->input->post('hotel_id');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $date = $this->input->post('register_date');
        
        if(!empty($start_date) && !empty($end_date) && !empty($searchon) && !empty($city) )
        {
            $data['list'] = $this->SuperAdmin->guest_panel_all_filter($start_date,$end_date,$searchon,$city);
            $this->load->view('include/header');
            $this->load->view('superadmin/guest_panel', $data);
            $this->load->view('include/footer');
        }
        else if(!empty($start_date) && !empty($end_date) && empty($searchon) && empty($city) )
        {
            $data['list'] = $this->SuperAdmin->guest_panel_both_date_filter($start_date,$end_date);
            $this->load->view('include/header');
            $this->load->view('superadmin/guest_panel', $data);
            $this->load->view('include/footer');
        }
        else if(!empty($start_date) && !empty($end_date) && !empty($searchon) && empty($city) )
        {
            $data['list'] = $this->SuperAdmin->guest_panel_date_hotel_filter($start_date,$end_date,$searchon);
            $this->load->view('include/header');
            $this->load->view('superadmin/guest_panel', $data);
            $this->load->view('include/footer');
        }
        else if(!empty($start_date) && !empty($end_date) && empty($searchon) && !empty($city) )
        {
            $data['list'] = $this->SuperAdmin->guest_panel_date_city_filter($start_date,$end_date,$city);
            $this->load->view('include/header');
            $this->load->view('superadmin/guest_panel', $data);
            $this->load->view('include/footer');
        }
        else 
        {
            $where = '(is_guest = 1)';
            $guest_mng['list'] = $this->SuperAdmin->get_gueest_llist();
            $this->load->view('include/header');
            $this->load->view('superadmin/guest_panel', $guest_mng);
            $this->load->view('include/footer');
        }
    }

    // guest history
    public function guest_history()
    {
        $u_id=$this->input->post('u_id1');
        $booking_id=$this->input->post('booking_id');
        $where ='(booking_id = "'.$booking_id.'" )';
        $admin_details = $this->MainModel->getData($tbl ='user_hotel_booking', $where);
        $admin_id = $admin_details['hotel_id'];

        $guest_history['user_data'] = $this->SuperAdmin->get_user_dataa($u_id);
        $guest_history['admin_data'] = $this->SuperAdmin->get_user_dataa($admin_id);
        $guest_history['booking_details'] = $this->SuperAdmin->get_user_booking_details($admin_id,$booking_id);
        $guest_history['booking_history'] = $this->SuperAdmin->get_user_booking_history($admin_id,$u_id);
        $guest_history['room_number'] = $this->SuperAdmin->get_booking_room_details($booking_id);
        $this->load->view('superadmin/ajaxGuest_History', $guest_history);
    }

    // guest invoice
    public function add_checkout_details()
    {
        $booking_id = $this->uri->segment(3);
        $u_id = $this->uri->segment(4);
        $admin_id1 = $this->session->userdata('u_id');
        // $booking_id=$postArray['booking_id'];
        // $u_id=$postArray['u_id1'];
        // $booking_id = $this->uri->segment(3);
        $where ='(booking_id = "'.$booking_id.'" )';
        $admin_details = $this->MainModel->getData($tbl ='user_hotel_booking', $where);
        $admin_id = $admin_details['hotel_id'];
        
        $booking_details = $this->SuperAdmin->get_user_booking_details($admin_id,$booking_id);
        $date1 = $booking_details['check_in'];
        $date2 = $booking_details['check_out'];
        $service_tax = $booking_details['service_tax'];
        $luxury_tax = $booking_details['luxury_tax'];

        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        
        // $amount = $booking_details['total_charges'] / $days;
        $amount = $booking_details['total_charges'];

        // $s_amount = $service_tax / $days;
        $s_amount = $service_tax;

        // $lt_amount = $luxury_tax / $days;
        $lt_amount = $luxury_tax;

        $wh = '(hotel_id = "'.$admin_id.'" AND u_id = "'.$u_id.'" AND booking_id = "'.$booking_id.'")';
        $user_checkout_data = $this->MainModel->getData('user_checkout_data',$wh);

        if(empty($user_checkout_data))
        {
            $arr = array(
                            // 'hotel_id' => $admin_id,
                            'u_id' => $u_id,
                            'booking_id' => $booking_id
                        );
            $add = $this->MainModel->insert_data('user_checkout_data',$arr);

            if($add)
            { 
                //add room charges
                for($i = 0;$i < $days; $i++)
                {
                    $description = "Room Charges";
                    $check_out = $booking_details['check_out'];
                    $check_in = $booking_details['check_in'];

                    if(($check_in >= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days')) && $check_out <= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days'))) || ($check_in <= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days')) && $check_out >= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days'))))
                    {
                        $amount1 = $amount;
                    }
                    else
                    {
                        $amount1 = 0;
                    }

                    $arr1 = array(
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $add,
                                'description' => $description,
                                'date' => date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days')),
                                'amount' => $amount1
                                );

                    $add_rm_charges = $this->MainModel->insert_data('user_checkout_details',$arr1);
                    
                    if($add_rm_charges)
                    { 
                        $wh1 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$add.'" AND description_name = "'.$description.'")';
                        $user_checkout_sub_total = $this->MainModel->getData('user_checkout_sub_total',$wh1);
                        
                        //add subtotal
                        if($user_checkout_sub_total)
                        {
                            $st_arr1 = array(
                                                'sub_total' => $user_checkout_sub_total['sub_total'] + $amount1
                                            );
                            $this->MainModel->edit_data('user_checkout_sub_total',$wh1,$st_arr1);
                        }
                        else
                        {
                            //edit subtotal
                            $st_arr2 = array(
                                        'hotel_id' => $admin_id,
                                        'user_checkout_data_id' => $add,
                                        'description_name' => $description,
                                        'sub_total' => $amount1
                                        );
                            $this->MainModel->insert_data('user_checkout_sub_total',$st_arr2);
                        }

                        //add total bill
                        $wh_ck = '(user_checkout_data_id = "'.$add.'")';
                        $user_checkout_data1 = $this->MainModel->getData('user_checkout_data',$wh_ck);
                        $tot_arr1 = array(
                                        'total_bill' => $user_checkout_data1['total_bill'] + $amount1
                                        );
                        $this->MainModel->edit_data('user_checkout_data',$wh_ck,$tot_arr1);
                    }
                }
                
                //GST
                for($k = 0;$k < $days; $k++)
                {
                    $description_lx = "GST";
                    $check_out = $booking_details['check_out'];
                    $check_in = $booking_details['check_in'];

                    if(($check_in >= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$k. 'days')) && $check_out <= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$k. 'days'))) || ($check_in <= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$k. 'days')) && $check_out >= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$k. 'days'))))
                    {
                        $lt_amount1 = $lt_amount;
                    }
                    else
                    {
                        $lt_amount1 = 0;
                    }
                    $arr_lx = array(
                                'user_checkout_data_id' => $add,
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $add,
                                'description' => $description_lx,
                                'date' => date('Y-m-d',strtotime($booking_details['check_in']. '+'.$k. 'days')),
                                'amount' => $lt_amount1
                                );
                    $add_lux = $this->MainModel->insert_data('user_checkout_details',$arr_lx);
                    
                    if($add_lux)
                    { 
                        $wh13 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$add.'" AND description_name = "'.$description_lx.'")';
                        $user_checkout_sub_total2 = $this->MainModel->getData('user_checkout_sub_total',$wh13);
                        
                        //add subtotal
                        if($user_checkout_sub_total2)
                        {
                            $st_arr13 = array(
                                            'sub_total' => $user_checkout_sub_total2['sub_total'] + $lt_amount1
                                            );
                            $this->MainModel->edit_data('user_checkout_sub_total',$wh13,$st_arr13);
                        }
                        else
                        {
                            //edit subtotal
                            $st_arr23 = array(
                                            'hotel_id' => $admin_id,
                                            'user_checkout_data_id' => $add,
                                            'description_name' => $description_lx,
                                            'sub_total' => $lt_amount1
                                            );
                            $this->MainModel->insert_data('user_checkout_sub_total',$st_arr23);
                        }

                        //add total bill
                        $wh_ck3_1 = '(user_checkout_data_id = "'.$add.'")';
                        $user_checkout_data1_3 = $this->MainModel->getData('user_checkout_data',$wh_ck3_1);
                        $tot_arr3 = array(
                                            'total_bill' => $user_checkout_data1_3['total_bill'] + $lt_amount1
                                            );
                        $this->MainModel->edit_data('user_checkout_data',$wh_ck3_1,$tot_arr3);
                    }
                }

                //other tax
                for($j = 0;$j < $days; $j++)
                {
                    $description_s = "Other Tax";
                    $check_out = $booking_details['check_out'];
                    $check_in = $booking_details['check_in'];
                    if(($check_in >= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$j. 'days')) && $check_out <= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$j. 'days'))) || ($check_in <= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$j. 'days')) && $check_out >= date('Y-m-d',strtotime($booking_details['check_in']. '+'.$j. 'days'))))
                    {
                        $s_amount1 = $s_amount;
                    }
                    else
                    {
                        $s_amount1 = 0;
                    }
                    $arr_s = array(
                                'user_checkout_data_id' => $add,
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $add,
                                'description' => $description_s,
                                'date' => date('Y-m-d',strtotime($booking_details['check_in']. '+'.$j. 'days')),
                                'amount' => $s_amount1
                                );

                    $add_ser = $this->MainModel->insert_data('user_checkout_details',$arr_s);
                    if($add_ser)
                    { 
                        $wh12 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$add.'" AND description_name = "'.$description_s.'")';
                        $user_checkout_sub_total1 = $this->MainModel->getData('user_checkout_sub_total',$wh12);
                        
                        //add subtotal
                        if($user_checkout_sub_total1)
                        {
                            $st_arr12 = array(
                                            'sub_total' => $user_checkout_sub_total1['sub_total'] + $s_amount1
                                            );
                            $this->MainModel->edit_data('user_checkout_sub_total',$wh12,$st_arr12);
                        }
                        else
                        {
                            //edit subtotal
                            $st_arr22 = array(
                                            'hotel_id' => $admin_id,
                                            'user_checkout_data_id' => $add,
                                            'description_name' => $description_s,
                                            'sub_total' => $s_amount1
                                            );
                            $this->MainModel->insert_data('user_checkout_sub_total',$st_arr22);
                        }

                        //add total bill
                        $wh_ck1 = '(user_checkout_data_id = "'.$add.'")';
                        $user_checkout_data11 = $this->MainModel->getData('user_checkout_data',$wh_ck1);
                        $tot_arr2 = array(
                                            'total_bill' => $user_checkout_data11['total_bill'] + $s_amount1
                                            );
                        $this->MainModel->edit_data('user_checkout_data',$wh_ck1,$tot_arr2);
                    }
                }
                redirect(base_url('SuperAdminController/guest_view/' .$booking_id.'/'.$u_id));
            }
        }
        else
        {
            redirect(base_url('SuperAdminController/guest_view/' .$booking_id.'/'.$u_id));
        }
    }

    // customer menu list
    public function customer_list()
    {
        $admin_id = $this->session->userdata('u_id');
        $city = $this->input->post('city');
        // $searchon = $this->input->post('hotel_id');
        $date = $this->input->post('register_date');

        if(!empty($date) && !empty($city) )
        {
            $data['customer_list'] = $this->SuperAdmin->get_customer_all_filter($date,$city);
            $this->load->view('include/header');
            $this->load->view('superadmin/customer_list', $data);
            $this->load->view('include/footer');
        }
        // if (isset($city)) {
        //     $where = '(user_type = 0 AND city ="' . $city . '")';
        //     $data['customer_list'] = $this->SuperAdmin->get_customer_search_record($city);
        //     $this->load->view('include/header');
        //     $this->load->view('superadmin/customer_list', $data);
        //     $this->load->view('include/footer');
        // } 
        else 
        {
            $list_of_customer['customer_list'] = $this->SuperAdmin->get_customers();
            $this->load->view('include/header');
            $this->load->view('superadmin/customer_list', $list_of_customer);
            $this->load->view('include/footer');
        }
    }

    // booking menu list
    public function all_booking()
    {
        $admin_id = $this->session->userdata('u_id');
        $get_all_bookingss = $this->SuperAdmin->get_all_bookings();
        $closer_count_list['all_bookings'] = $this->SuperAdmin->get_all_bookings_pagiantion();
        $this->load->view('include/header');
        $this->load->view('superadmin/all_booking', $closer_count_list);
        $this->load->view('include/footer');
    }

    public function customer_view()
    {
        $admin_id= $this->session->userdata('u_id'); 
        $postArray = $this->input->post();
        //  $booking_id=$postArray['booking_id'];
        $u_id=$postArray['u_id1'];
        $customer_view['data'] = $this->SuperAdmin->get_user_dataa($u_id);
        $customer_view['u_id'] = $u_id;
        $customer_view['get_customer_booking_history'] = $this->SuperAdmin->get_customer_booking_history($u_id);
        $this->load->view('superadmin/ajaxCustomer_View', $customer_view);
    }

    // canceled booking data
    public function cancle_booking()
    {
        $admin_id = $this->session->userdata('u_id');
        $get_all_bookingss = $this->SuperAdmin->get_cancelll_booking();
        // $closer_count_list['all_bookings'] = $this->SuperAdmin->get_cancelll_booking();
        $closer_count_list['cancel_booking'] = $this->SuperAdmin->get_cancelll_booking_pagiantion();
        $this->load->view('include/header');
        $this->load->view('superadmin/cancle_booking', $closer_count_list);
        $this->load->view('include/footer');
    }
    
    // Department List
    public function deparment()
    {
        $data['add'] = $this->SuperAdmin->getdepartment();
        $this->load->view('include/header');
        $this->load->view('superadmin/deparment', $data);
        $this->load->view('include/footer');
    }

    // add department
    public function add_departments()
    {
        $admin_id = $this->session->userdata('u_id');
        $_FILES['my_uploaded_file']['name'] = $_FILES['icon']['name'];
        $_FILES['my_uploaded_file']['type'] = $_FILES['icon']['type'];
        $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['icon']['tmp_name'];
        $_FILES['my_uploaded_file']['error'] = $_FILES['icon']['error'];
        $_FILES['my_uploaded_file']['size'] = $_FILES['icon']['size'];

        $path = 'logo/department_logo/';
        $file_path = './' . $path;
        $config['allowed_types'] = '*';
        $config['upload_path'] = $file_path;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('my_uploaded_file')) 
        {
            $file_data = $this->upload->data();
            $file_path_url = base_url() . $path . $file_data['file_name'];
        }
        $department_name = $this->input->post('department_name');
        $arr = array(
            'department_name' => $department_name,
            'icon' => $file_path_url,
        );

        $insert_id22 = $this->SuperAdmin->insert_data($tbl = 'departement', $arr);
        if ($insert_id22) 
        {
            $data["departement"] = $this->SuperAdmin->getPlan($tbl = 'departement');
            $this->load->view('superadmin/ajaxdepartement', $data);
        }
    }

    // department data for edit
    public function getDepartmentData()
    {
        $wh = $this->input->post('id');
        $data = $this->SuperAdmin->getdepartmentedit( $wh);
        echo json_encode($data);
    }

    // update department
    public function update_departments()
    {
        $admin_id = $this->session->userdata();
        $department_id = $this->input->post('department_id');
        // echo $department_id;
        $wh = '(department_id="' . $department_id . '")';
        $data['departement'] = $this->SuperAdmin->getData($tbl = 'departement', $wh);
        $img = $data['departement']['icon'];

        if (!empty($_FILES['icon']['name'])) 
        {
            $_FILES['my_uploaded_file']['name'] = $_FILES['icon']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['icon']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['icon']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['icon']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['icon']['size'];

            $path = 'logo/department_logo/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file')) {

                $file_data = $this->upload->data();
                $file_path_url = base_url() . $path . $file_data['file_name'];
                $file = $file_path_url;
            } 
            else 
            {
                $error = array('error' => $this->upload->display_errors());
                return $error;
            }
        } 
        else 
        {
            $file = $img;
        }

        $where = $this->input->post('department_id');
        $data['departement'] = $this->SuperAdmin->getPlan($tbl = 'departement');

        $arr = array(
            'icon' => $file,
            'department_name' => $this->input->post('department_name'),
        );
        $department_id = $this->input->post('department_id');
        $wh = '(department_id="' . $department_id . '")';
        $edit = $this->SuperAdmin->editDatat($tbl = 'departement', $wh, $arr);

        if ($edit) 
        {
            $data["departement"] = $this->SuperAdmin->getPlan($tbl = 'departement');
            $this->load->view('superadmin/ajaxdepartement', $data);
        }

    }

    // delete department
    public function delete_department()
    {
        $id = $this->input->post('id');
        $wh = '(department_id = "'.$id.'")';
        $up = $this->MainModel->deleteData('departement', $wh);
        
        if($up)
        {
            $data["departement"] = $this->SuperAdmin->getPlan($tbl = 'departement');
            $this->load->view('superadmin/ajaxdepartement', $data);
        }
        else
        {
            echo "0"; 
        }
    }

    // city menu list
    public function city()
    {
        $data['get_city_list'] = $this->SuperAdmin->get_city_list();
        $this->load->view('include/header');
        $this->load->view('superadmin/city', $data);
        $this->load->view('include/footer');
    }

    // add city
    public function add_city()
    {
        $admin_id = $this->session->userdata('u_id');
        $city_name = $this->input->post('city');
        $wh = '(city = "' . $city_name . '")';
        $city_data = $this->SuperAdmin->getData('city', $wh);

        if ($city_data)
        {
            echo "1";
        } 
        else 
        {
            $arr = array(
                'city' => $city_name,
            );
            $add = $this->SuperAdmin->insertData($tbl = 'city', $arr);

            if ($add) 
            {
                $data["get_city_list"] = $this->SuperAdmin->getPlan($tbl = 'city');
                $this->load->view('superadmin/ajaxcity', $data);
            }
        }
    }

    // fetch edit data of city
    public function getLostData()
    {
        $wh = $this->input->post('id');
        $data = $this->SuperAdmin->getlostdata($tbl ='city', $wh);
        echo json_encode($data);
    }

    // update city 
    public function update_city()
    {
        $city_id = $this->input->post('city_id');
        $city_name = $this->input->post('city');
        $arr = array(
            'city' => $city_name,
        );
        $wh = '(city_id="' . $city_id . '")';
        $edit = $this->SuperAdmin->editDatat($tbl = 'city', $wh, $arr);
        if ($edit) 
        {
           $data["get_city_list"] = $this->SuperAdmin->getPlan($tbl = 'city');
           $this->load->view('superadmin/ajaxcity', $data);
        }
    }

    // delete city
    public function delete_city()
    {
        $id = $this->input->post('id');
        $wh = '(city_id = "'.$id.'")';
        $up = $this->MainModel->deleteData('city', $wh);
        if($up)
        {
            $data["get_city_list"] = $this->SuperAdmin->getPlan($tbl = 'city');
            $this->load->view('superadmin/ajaxcity', $data);
        }
        else
        {
            echo "0"; 
        }
    }

    public function app_terms()
    {
        $this->load->view('include/header');
        $this->load->view('superadmin/app_terms');
        $this->load->view('include/footer');
    }
    public function web_terms()
    {
        $this->load->view('include/header');
        $this->load->view('superadmin/web_terms');
        $this->load->view('include/footer');
    }
    public function web_privacy()
    {
        $this->load->view('include/header');
        $this->load->view('superadmin/web_privacy');
        $this->load->view('include/footer');
    }
    public function menu_setting()
    {
        $this->load->view('include/header');
        $this->load->view('superadmin/menu_setting');
        $this->load->view('include/footer');
    }

    // customer terms & condition
    public function Add_Terms_Condition_Customers()
    {
        $content = $this->input->post('content');
        $data = $this->MainModel->get_Terms_Condition_Customers();
        $wh = '(term_condition_id = "'.$data['term_condition_id'].'")';

        if($data)
        {
            $arr = array(
                        'content' => $content,
                            );
            $up = $this->MainModel->editData('terms_condition',$wh,$arr);
        }
        else
        {
            $arr = array(
                        'content' => $content,
                        'tc_form'=> 0
                        );

            $add = $this->MainModel->insert_data('terms_condition',$arr);
        }

        if($up || $add)
        {
            $this->session->set_flashdata('term_msg', 'Data Added Successfully..!');
            redirect(base_url().'app_terms'); 
        }
        else
        {
            $this->session->set_flashdata('term_error_msg', 'Something Went Wrong..!');
            redirect(base_url().'app_terms'); 
        }
    }

    // customer privacy policy
    public function Add_Privacy_Policy_Customers()
    {
        $id= $this->session->userdata('u_id');
        $content = $this->input->post('content');
        $data = $this->MainModel->get_Privacy_Policy_Customers();
        $wh = '(privacy_id = "'.$data['privacy_id'].'")';
        if($data)
        {
            $arr = array(
                        'content' => $content,
                            );
            $up = $this->MainModel->editData('privacy_policy',$wh,$arr);
        }
        else
        {
            $arr = array(
                        'content' => $content,
                        'added_by'=>2,
                        'added_by_u_id'=> $id,
                        'privacy_policy_for'=> 1
                        );
            $add = $this->MainModel->insert_data('privacy_policy',$arr);
        }

        if($up || $add)
        {
            $this->session->set_flashdata('privacy_msg', 'Data Added Succesfully..!');
            redirect(base_url().'app_privacy'); 
        }
        else
        {
            $this->session->set_flashdata('privacy_error_msg', 'Something Went Wrong..!');
            redirect(base_url().'app_privacy'); 
        }
    }

    // hotel terms & condition
    public function Add_Terms_Condition_Hotels()
    {
        $content = $this->input->post('content');
        $data = $this->MainModel->get_Terms_Conditions_hotels();
        $wh = '(term_condition_id = "'.$data['term_condition_id'].'")';
        
        if($data)
        {
            $arr = array(
                        'content' => $content,
                            );
            $up = $this->MainModel->editData('terms_condition',$wh,$arr);
        }
        else
        {
            $arr = array(
                    'content' => $content,
                    'tc_form'=> 1
                    );
            $add = $this->MainModel->insert_data('terms_condition',$arr);
        }

        if($up || $add)
        {
            $this->session->set_flashdata('hotel_term_msg', 'Data Added Succesfully..!');
            redirect(base_url().'web_terms'); 
        }
        else
        {
            $this->session->set_flashdata('hotel_error_msg', 'Something Went Wrong..!');
            redirect(base_url().'web_terms'); 
        }
    }

 // hotel privacy policy
    public function Add_Privacy_policy_Hotels()
    {
        $id= $this->session->userdata('u_id');
        $content = $this->input->post('content');
        $data = $this->MainModel->get_Privacy_policy_hotels();
        $wh = '(privacy_id = "'.$data['privacy_id'].'")';

        if($data)
        {
            $arr = array(
                        'content' => $content,
                            'added_by_u_id'=>  $id,
                        );
            $up = $this->MainModel->editData('privacy_policy',$wh,$arr);
        }
        else
        {
            $arr = array(
                        'content' => $content,
                        'privacy_policy_for'=> 2,
                        'added_by_u_id' =>$id,
                        'added_by'=>2
                        );
            $add = $this->MainModel->insert_data('privacy_policy',$arr);
        }

        if($up || $add)
        {
            $this->session->set_flashdata('hotel_privacy_msg', 'Data Added Succesfully..!');
            redirect(base_url().'web_privacy'); 
        }
        else
        {
            $this->session->set_flashdata('privacy_error_msg', 'Data Added Succesfully..!');
            redirect(base_url().'web_privacy'); 
        }
    }

    // notification menu
    public function panel_noti()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = '(send_by = 1)';
        $data['user_list'] = $this->SuperAdmin->get_user_list_by_hotels();
        $data['get_user_list_by_hotels'] = $this->SuperAdmin->get_city_list_by_hotels();
        $data['list'] = $this->SuperAdmin->get_notification_list();
        $this->load->view('include/header');
        $this->load->view('superadmin/panel_noti', $data);
        $this->load->view('include/footer');
    }

    // notification menu
    public function add_notification()
    {
        $id = $this->input->post('notification_id');
        $send_to     = $this->input->post('send_for');
        $name        = $this->input->post('name');
        // $hotelname   = !empty($this->input->post('individual')) ? $this->input->post('individual') : '';
        $type        = $this->input->post('notification_type');
        $title       = $this->input->post('title');
        $description = $this->input->post('description1');
        $description = strip_tags($description); // Remove HTML tags from the description
        $description = trim($description);

        if($send_to == "1")
        {
            $send_to1 = 1;
        }
        elseif($send_to == "3")
        {
            $send_to1 = 1;
        }
        else
        {
            $send_to1 = 2;
        }

        $arr = array(
                    'send_to'           => $send_to1,
                    'send_for'          => $send_to,
                    'notification_type' => $type,
                    'title'             => $title,
                    'description'       => $description,
                    'resend_count'      =>1,
                    'send_by'           =>1,
                    'send_by_id'        =>1
                    );

        $data = $this->SuperAdmin->insert_data($tbl='notifications', $arr);
        if($data)
        {
            if($send_to =="1" )
            {
                $all_users = $this->SuperAdmin->get_hotels_id();
                foreach($all_users as $a)
                {
                $arr_send = array(
                                    'user_id'         =>$a['u_id'],
                                    'notification_id' =>$data,
                                    'resend_count'      =>1,
                                
                                );
                $insert= $this->SuperAdmin->insert_data($tbl='notifictions_u_id', $arr_send);
                }
            }
            elseif($send_to == "2")
            {
                $all_users = $this->input->post('individual');
                foreach( $all_users as $a)
                {
                    $arr_send =array(
                                    'user_id'         => $a,
                                    'notification_id' =>$data,
                                    'resend_count'      =>1,
                                    
                                    );
                $insert= $this->SuperAdmin->insert_data($tbl='notifictions_u_id', $arr_send);
                }
            }
            elseif($send_to =="3" )
            {
                $all_users = $this->SuperAdmin->get_user_list_by_hotels();
                foreach($all_users as $a)
                {
                    $arr_send = array(
                                        'user_id'         =>$a['u_id'],
                                        'resend_count'      =>1,
                                        'notification_id' =>$data,
                                        
                                    );
                    $insert= $this->SuperAdmin->insert_data($tbl='notifictions_u_id', $arr_send);
                    
                    $wh1 = '(u_id = "'.$a['u_id'].'")';
                    $get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);
                    if($get_dt){
                        $deviceToken = $get_dt['token'];
                        $noti_title = $title ;
                        $body = $description;
                        $result = send_push_notification($deviceToken, $noti_title, $body);
                    }
                }
            }
            elseif($send_to == "4")
            {
                $all_users = $this->input->post('users');
                
                foreach($all_users as $a)
                {
                    
                    $arr_send = array(
                                        'user_id'        =>$a,
                                        'resend_count'      =>1,
                                        'notification_id'=>$data,
                                        
                                        );
                    $insert= $this->SuperAdmin->insert_data($tbl='notifictions_u_id', $arr_send);

                    $wh1 = '(u_id = "'.$a.'")';
                    $get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);
                    if($get_dt){
                        $deviceToken = $get_dt['token'];
                        $noti_title = $title ;
                        $body = $description;
                        $result = send_push_notification($deviceToken, $noti_title, $body);
                    }
                }
            }
            elseif($send_to == "5")
            {
                $all_users = $this->input->post('name');
                foreach($all_users as $a)
                {
                    $arr_send = array(
                                        'user_id'        =>$a,
                                        'resend_count'      =>1,
                                        'notification_id'=>$data,
                                        
                                        );

                    $insert= $this->SuperAdmin->insert_data($tbl='notifictions_u_id', $arr_send);
                }
            }
            else
            {
                $this->session->set_flashdata('msg', 'Something Went Wrong..!');
                redirect(base_url().'panel_noti');
            }  
            if ($insert) 
            {
                $where = '(send_by = 1)';
                $result = array();
                $result['notification'] = $this->SuperAdmin->getAllDatat($tbl='notifications',$where);
                $result['user_list'] = $this->SuperAdmin->get_user_list_by_hotels();
                $result['get_user_list_by_hotels'] = $this->SuperAdmin->get_city_list_by_hotels();
                $result['list'] = $this->SuperAdmin->get_notification_list();
                $this->load->view('superadmin/ajaxpanel_noti',$result);
            } 
        }
    }
    public function resend_notification()
    {   
        $arr=$this->input->post();
        $notificationId= $this->input->post('notificationId') ? $this->input->post('notificationId') : $this->input->get('notificationId');
        $wh = '(notification_id = "'.$notificationId.'")';
        $notification_data = $this->MainModel->getData('notifications',$wh);
        $notification_data1 = $this->MainModel->getAllData('notifictions_u_id',$wh);

        $arr = array(
                    'resend_count' => $notification_data['resend_count']+1,
                );

        $arr_u_id = array(
            'resend_count' => $notification_data['resend_count']+1,
        );
        $add = $this->MainModel->editData('notifications',$wh,$arr);
        $u_id_update = $this->MainModel->editData('notifictions_u_id',$wh,$arr_u_id);
        $data['list'] = $this->SuperAdmin->get_notification_list();
        $this->load->view('superadmin/ajaxpanel_noti',$data);
    }
    public function delete_cities()
    {
        $id = $this->input->post('id');
        $where = '(notification_id = "' . $id . '")';
        $result = $this->SuperAdmin->deleteData($tbl = "notifications", $where);
        if ($result) 
        {
            $data['list'] = $this->SuperAdmin->get_notification_list();
            $this->load->view('superadmin/ajaxpanel_noti',$data);
        } else 
        {
            echo "0";
        }
    }

    public function get_view_name_data_notification()
    {

        // if($row['send_for'] == 1 || $row['send_for'] == 2){
        // $data['list'] = $this->SuperAdmin->get_notification_list();
        $id =$this->input->post('id');
        $data['row'] = $this->SuperAdmin->get_names_of_specific_type($id);
        $this->load->view('superadmin/ajaxnamesmodel',$data);
    }
    public function changeSubcategory()
    {
        $cat = $this->input->post('cat');
        $wh = '(city = "' . $cat . '" AND user_type = 2 AND is_active = 1)';
        $sub_cat = $this->SuperAdmin->get_city_wise_hotel('register', $wh);
        $output = '<option>--Select Hotel--</option>';

        foreach ($sub_cat as $s_c) 
        {
            $output .= '<option value = "' . $s_c['u_id'] . '">' . $s_c['hotel_name'] . '</option>';
        }
        echo $output;
    }
    public function editsubhotels()
    {
        $cat = $this->input->post('cat');
        $wh = '(city  = "'.$cat.'" AND user_type = 2)';
        $sub_cat = $this->SuperAdmin->get_city_wise_hotel('register',$wh);
        $output = '<option>--Select Hotel--</option>'; 
        
        foreach($sub_cat as $s_c)
        {
            $output .= '<option value = "'.$s_c['u_id'].'">'.$s_c['hotel_name'].'</option>';
        }
        echo $output;
    }
}
