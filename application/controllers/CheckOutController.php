<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class CheckOutController extends CI_Controller
    {
        function __construct()
        {
            parent :: __construct();
            date_default_timezone_set('Asia/Kolkata');
            $this->load->model('HotelAdminModel');
            $this->load->model('MainModel');
            $this->load->model('FrontofficeModel');
            
        }
        public function extend_checkout_data1()
        {
            $booking_id = $this->input->post('booking_id');
 
            $booking_details_id = $this->input->post('booking_details_id',TRUE);

            $check_out = $this->input->post('check_out');
            $room_type = $this->input->post('room_type');//multiple
            $room_no = $this->input->post('room_no');//multiple

			// $admin_id = $this->session->userdata('admin_id');
            $u_id= $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			
			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
			$admin_id = $admin_details['hotel_id'];
			$u_id11 = $admin_details['u_id'];

            $wh = '(booking_id = "'.$booking_id.'")';
            // print_r($wh);exit;
            $arr = array(
                         'extend_check_out' => $check_out
                        );
                        
                        $up  = $this->FrontofficeModel->edit_data('user_hotel_booking',$wh,$arr);
// print_r($up);exit;
            if($up)
            {
                //edit room data
                $count = count((array)$room_type);
                // var_dump(  $count);die;

                for($i = 0;$i < $count; $i++)
                {
                    $wh1 = '(booking_details_id = "'.$booking_details_id[$i].'")';

                    $rm_data = $this->FrontofficeModel->get_room_nos_data($admin_id,$room_type[$i],$room_no[$i]);
                    if(!empty($rm_data))
                    {
                        $price =$rm_data['price'];
                    }
                    else
                    {
                        $price = 0;
                    }
                    $arr1 = array(
                                    'extend_room_no' => $room_no[$i],
                                    'extend_room_type' => $room_type[$i],
                                    'extend_room_price' => $price,
                                );

                    $add_details = $this->FrontofficeModel->edit_data('user_hotel_booking_details',$wh1,$arr1);

                    if($add_details)
                    {
                        $wh_detail = '(booking_id = "'.$booking_id.'")';

                        $booking_data = $this->MainModel->getData('user_hotel_booking',$wh_detail);
                   
                   if(!empty($rm_data))
                   {
                       $price1 = $rm_data['price'];
                   }
                   else
                   {
                       $price1 = 0;
                   }
    if(!empty($booking_data))
    {
         $arr_up = array(
                                            'total_charges' => $booking_data['total_charges'] + $price1,
                                        );
    }
    else
    {
         $arr_up = array(
                                            'total_charges' => 0,
                                        );
    }
                       
            
                        $this->FrontofficeModel->edit_data('user_hotel_booking',$wh_detail,$arr_up);

                    }
                }
                $this->session->set_flashdata('msg','Data Updated Successfully');
                redirect(base_url('guests'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('guests'));
            }
        }
        public function add_checkout_details()
        {
			// print_r('hello');exit;
            // $admin_id = $this->session->userdata('admin_id');
			
			// $booking_id = $this->uri->segment(3);
            $admin_id1 = $this->session->userdata('u_id');
             
            $booking_id = $this->uri->segment(3);
            $where ='(booking_id = "'.$booking_id.'" )';
            $admin_details = $this->MainModel->getData($tbl ='user_hotel_booking', $where);
            $admin_id = $admin_details['hotel_id'];

            

			$u_id = $this->uri->segment(4);
            
			$booking_details = $this->MainModel->get_user_booking_details($admin_id,$booking_id);
            
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
                                'hotel_id' => $admin_id,
                                'u_id' => $u_id,
                                'booking_id' => $booking_id
                            );

                $add = $this->FrontofficeModel->insert_data('user_checkout_data',$arr);

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

                        $add_rm_charges = $this->FrontofficeModel->insert_data('user_checkout_details',$arr1);

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

                                $this->FrontofficeModel->edit_data('user_checkout_sub_total',$wh1,$st_arr1);
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

                                $this->FrontofficeModel->insert_data('user_checkout_sub_total',$st_arr2);
                            }

                            //add total bill
                            $wh_ck = '(user_checkout_data_id = "'.$add.'")';

                            $user_checkout_data1 = $this->MainModel->getData('user_checkout_data',$wh_ck);

                            $tot_arr1 = array(
                                            'total_bill' => $user_checkout_data1['total_bill'] + $amount1
                                            );

                            $this->FrontofficeModel->edit_data('user_checkout_data',$wh_ck,$tot_arr1);
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

                        $add_lux = $this->FrontofficeModel->insert_data('user_checkout_details',$arr_lx);
                        
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

                                $this->FrontofficeModel->edit_data('user_checkout_sub_total',$wh13,$st_arr13);
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

                                $this->FrontofficeModel->insert_data('user_checkout_sub_total',$st_arr23);
                            }

                            //add total bill
                            $wh_ck3_1 = '(user_checkout_data_id = "'.$add.'")';

                            $user_checkout_data1_3 = $this->MainModel->getData('user_checkout_data',$wh_ck3_1);

                            $tot_arr3 = array(
                                                'total_bill' => $user_checkout_data1_3['total_bill'] + $lt_amount1
                                                );

                            $this->FrontofficeModel->edit_data('user_checkout_data',$wh_ck3_1,$tot_arr3);
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

                        $add_ser = $this->FrontofficeModel->insert_data('user_checkout_details',$arr_s);
                        
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

                                $this->FrontofficeModel->edit_data('user_checkout_sub_total',$wh12,$st_arr12);
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

                                $this->FrontofficeModel->insert_data('user_checkout_sub_total',$st_arr22);
                            }

                            //add total bill
                            $wh_ck1 = '(user_checkout_data_id = "'.$add.'")';

                            $user_checkout_data11 = $this->MainModel->getData('user_checkout_data',$wh_ck1);

                            $tot_arr2 = array(
                                                'total_bill' => $user_checkout_data11['total_bill'] + $s_amount1
                                                );

                            $this->FrontofficeModel->edit_data('user_checkout_data',$wh_ck1,$tot_arr2);
                        }
                    }
                    
                    redirect(base_url('CheckOutController/checkout_view/' . $booking_id.'/'.$u_id));
                }
            }
            else
            {
                redirect(base_url('CheckOutController/checkout_view/' . $booking_id.'/'.$u_id));
            }
        }
        public function checkout_view()
        {
            if($this->session->userdata('u_id'))
            {
                $u_id = $this->session->userdata('u_id');
                $where ='(u_id = "'.$u_id.'")';
                $admin_details = $this->MainModel->getData($tbl ='register', $where);
                $admin_id = $admin_details['hotel_id'];
                
                $booking_id = $this->uri->segment(3);
    
                $u_id = $this->uri->segment(4);
    
                $check_out_view['admin_data'] = $this->FrontofficeModel->get_user_data($admin_id);
    
                $check_out_view['user_data'] = $this->FrontofficeModel->get_user_data($u_id);
    
                $check_out_view['booking_details'] = $this->FrontofficeModel->get_user_booking_details($admin_id,$booking_id);
    // print_r($check_out_view['booking_details']);exit;
                $check_out_view['booking_checkout_data'] = $this->FrontofficeModel->get_user_checkout_booking_data($admin_id,$booking_id,$u_id);
    
                $check_out_view['booking_room_details'] = $this->FrontofficeModel->get_booking_room_details($booking_id);
                
                $check_out_view['minibar_list'] = $this->FrontofficeModel->get_room_service_minibar($admin_id);
    $this->load->view('include/header');
                $this->load->view('frontoffice/checkout_view',$check_out_view);
    $this->load->view('include/footer');
    
            }
            else
            {
                redirect(base_url());
            }
        }
    
      
        //extend check out data //21-11-2022 //archana
        public function extend_checkout_data()
        {
            $booking_id = $this->input->post('booking_id');

            $booking_details_id = $this->input->post('booking_details_id',TRUE);

            $check_out = $this->input->post('check_out');

            $room_type = $this->input->post('room_type');//multiple
            $room_no = $this->input->post('room_no');//multiple

			$admin_id = $this->session->userdata('u_id');
            // print_r($this->session->userdata());die;
            $wh = '(booking_id = "'.$booking_id.'")';

            $arr = array(
                         'extend_check_out' => $check_out
                        );

            $up  = $this->HotelAdminModel->edit_data('user_hotel_booking',$wh,$arr);

            if($up)
            {
                //edit room data
                $count = count($room_type);

                for($i = 0;$i < $count; $i++)
                {
                    $wh1 = '(booking_details_id = "'.$booking_details_id[$i].'")';

                    $rm_data = $this->HotelAdminModel->get_room_nos_data($admin_id,$room_type[$i],$room_no[$i]);
            
                    $arr1 = array(
                                    'extend_room_no' => $room_no[$i],
                                    'extend_room_type' => $room_type[$i],
                                    'extend_room_price' => $rm_data['price'],
                                );

                    $add_details = $this->HotelAdminModel->edit_data('user_hotel_booking_details',$wh1,$arr1);

                    if($add_details)
                    {
                        //add total charges
                        $wh_detail = '(booking_id = "'.$booking_id.'")';

                        $booking_data = $this->HotelAdminModel->getData('user_hotel_booking',$wh_detail);

                        $arr_up = array(
                                            'total_charges' => $booking_data['total_charges'] + $rm_data['price'],
                                        );
            
                        $this->HotelAdminModel->edit_data('user_hotel_booking',$wh_detail,$arr_up);

                        //change room status
                        $wh_rm_st = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$room_no[$i].'")';

                        $arr_rm_st = array(
                                            'room_status' => 2
                                        );
            
                        $this->HotelAdminModel->edit_data('room_status',$wh_rm_st,$arr_rm_st);

                    }

                    //add extended date
                    $user_checkout_data = $this->HotelAdminModel->getData('user_checkout_data',$wh);
                    
                    $description_lx = "GST";
                    $description_s = "Other Tax";

                    $description_hk = "Housekeeping";
                    $description_ld = "Laundry";
                    $description_fd = "Bar And Restaurant";
                    $description_rs = "Room Service Menu";

                    $wh_ch_d_gst = '(user_checkout_data_id = "'.$user_checkout_data['user_checkout_data_id'].'" AND description = "'.$description_lx.'")';

                    $user_checkout_details_gst = $this->HotelAdminModel->getData('user_checkout_details',$wh_ch_d_gst);

                    $wh_ch_d_o_tax = '(user_checkout_data_id = "'.$user_checkout_data['user_checkout_data_id'].'" AND description = "'.$description_s.'")';

                    $user_checkout_details_o_tax = $this->HotelAdminModel->getData('user_checkout_details',$wh_ch_d_o_tax);

                    $wh_ch_d_hk = '(user_checkout_data_id = "'.$user_checkout_data['user_checkout_data_id'].'" AND description = "'.$description_hk.'")';

                    $user_checkout_details_hk = $this->HotelAdminModel->getData('user_checkout_details',$wh_ch_d_hk);

                    $wh_ch_d_ld = '(user_checkout_data_id = "'.$user_checkout_data['user_checkout_data_id'].'" AND description = "'.$description_ld.'")';

                    $user_checkout_details_ld = $this->HotelAdminModel->getData('user_checkout_details',$wh_ch_d_ld);

                    $wh_ch_d_fd = '(user_checkout_data_id = "'.$user_checkout_data['user_checkout_data_id'].'" AND description = "'.$description_fd.'")';

                    $user_checkout_details_fd = $this->HotelAdminModel->getData('user_checkout_details',$wh_ch_d_fd);

                    $wh_ch_d_rs = '(user_checkout_data_id = "'.$user_checkout_data['user_checkout_data_id'].'" AND description = "'.$description_rs.'")';

                    $user_checkout_details_rs = $this->HotelAdminModel->getData('user_checkout_details',$wh_ch_d_ld);

                    if($user_checkout_data)
                    {
                        $wh_rt = '(room_type_id = "'.$room_type[$i].'")';

                        $room_type_data = $this->HotelAdminModel->getData('room_type',$wh_rt);
                        
                        $date = $booking_data['check_in'];
                        $date1 = $booking_data['check_out'];
                        $date2 = $booking_data['extend_check_out'];

                        $diff = abs(strtotime($date2) - strtotime($date1));

                        $years = floor($diff / (365*60*60*24));
                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                        
                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                        
                        $user_checkout_data_id = $user_checkout_data['user_checkout_data_id'];
                        
                        //room charges
                        for($j = 0;$j < $days; $j++)
                        {
                            $description = "Room Charges";

                            $check_out = $booking_data['extend_check_out'];

                            $check_in = $booking_data['check_out'];
        
                            $wh_chk_d_rc = '(user_checkout_data_id = "'.$user_checkout_data_id.'" AND description = "'.$description.'" AND date = "'.date('Y-m-d',strtotime($booking_data['check_out']. '+'.$j. 'days')).'")';

                            $u_chk_d_rc = $this->HotelAdminModel->getData('user_checkout_details',$wh_chk_d_rc);

                            $add_rm_charges = "";
                            
                            if(empty($u_chk_d_rc))
                            {
                                if(($check_in >= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$j. 'days')) && $check_out <= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$j. 'days'))) || ($check_in <= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$j. 'days')) && $check_out >= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$j. 'days'))))
                                {
                                    $amount1 = $room_type_data['price'];
                                }
                                else
                                {
                                    $amount1 = 0;
                                }

                                $arr1 = array(
                                                'hotel_id' => $admin_id,
                                                'user_checkout_data_id' => $user_checkout_data_id,
                                                'description' => $description,
                                                'date' => date('Y-m-d',strtotime($booking_data['check_out']. '+'.$j. 'days')),
                                                'amount' => $amount1
                                                );

                                $add_rm_charges = $this->HotelAdminModel->insert_data('user_checkout_details',$arr1);
                            }
                            else
                            {
                                if(($check_in >= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$j. 'days')) && $check_out <= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$j. 'days'))) || ($check_in <= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$j. 'days')) && $check_out >= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$j. 'days'))))
                                {
                                    $amount1 = $room_type_data['price'];
                                }
                                else
                                {
                                    $amount1 = 0;
                                }

                                $arr_rc_up = array(
                                                    'amount' => $amount1
                                                );

                                $add_rm_charges = $this->HotelAdminModel->edit_data('user_checkout_details',$wh_chk_d_rc,$arr_rc_up);
                            }
                            
                            if($add_rm_charges)
                            { 
                                $wh1 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$user_checkout_data_id.'" AND description_name = "'.$description.'")';

                                $user_checkout_sub_total = $this->HotelAdminModel->getData('user_checkout_sub_total',$wh1);
                                
                                //add subtotal
                                if($user_checkout_sub_total)
                                {
                                    $st_arr1 = array(
                                                    'sub_total' => $user_checkout_sub_total['sub_total'] + $amount1
                                                    );

                                    $this->HotelAdminModel->edit_data('user_checkout_sub_total',$wh1,$st_arr1);
                                }
                                else
                                {
                                    //edit subtotal
                                    $st_arr2 = array(
                                                    'hotel_id' => $admin_id,
                                                    'user_checkout_data_id' => $user_checkout_data_id,
                                                    'description_name' => $description,
                                                    'sub_total' => $amount1
                                                    );

                                    $this->HotelAdminModel->insert_data('user_checkout_sub_total',$st_arr2);
                                }

                                //add total bill
                                $wh_ck = '(user_checkout_data_id = "'.$user_checkout_data_id.'")';

                                $user_checkout_data1 = $this->HotelAdminModel->getData('user_checkout_data',$wh_ck);

                                $tot_arr1 = array(
                                                'total_bill' => $user_checkout_data1['total_bill'] + $room_type_data['price']
                                                );

                                $this->HotelAdminModel->edit_data('user_checkout_data',$wh_ck,$tot_arr1);
                            }
                        }
                        
                        //GST
                        for($k = 0;$k < $days; $k++)
                        {
                            $description_lx = "GST";

                            $check_out = $booking_data['extend_check_out'];

                            $check_in = $booking_data['check_out'];

                            $lt_amount = $user_checkout_details_gst['amount'];

                            $wh_chk_d_lx = '(user_checkout_data_id = "'.$user_checkout_data_id.'" AND description = "'.$description_lx.'" AND date = "'.date('Y-m-d',strtotime($booking_data['check_out']. '+'.$k. 'days')).'")';

                            $u_chk_d_lx = $this->HotelAdminModel->getData('user_checkout_details',$wh_chk_d_lx);

                            $add_lux = "";
                            
                            if(empty($u_chk_d_lx))
                            {
                                if(($check_in >= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$k. 'days')) && $check_out <= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$k. 'days'))) || ($check_in <= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$k. 'days')) && $check_out >= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$k. 'days'))))
                                {
                                    $lt_amount1 = $lt_amount;
                                }
                                else
                                {
                                    $lt_amount1 = 0;
                                }

                                $arr_lx = array(
                                                'hotel_id' => $admin_id,
                                                'user_checkout_data_id' => $user_checkout_data_id,
                                                'description' => $description_lx,
                                                'date' => date('Y-m-d',strtotime($booking_data['check_out']. '+'.$k. 'days')),
                                                'amount' => $lt_amount1
                                                );

                                $add_lux = $this->HotelAdminModel->insert_data('user_checkout_details',$arr_lx);
                            }

                            if($add_lux)
                            { 
                                $wh13 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$user_checkout_data_id.'" AND description_name = "'.$description_lx.'")';

                                $user_checkout_sub_total2 = $this->HotelAdminModel->getData('user_checkout_sub_total',$wh13);
                                
                                //add subtotal
                                if($user_checkout_sub_total2)
                                {
                                    $st_arr13 = array(
                                                    'sub_total' => $user_checkout_sub_total2['sub_total'] + $lt_amount1
                                                    );

                                    $this->HotelAdminModel->edit_data('user_checkout_sub_total',$wh13,$st_arr13);
                                }
                                else
                                {
                                    //edit subtotal
                                    $st_arr23 = array(
                                                    'hotel_id' => $admin_id,
                                                    'user_checkout_data_id' => $user_checkout_data_id,
                                                    'description_name' => $description_lx,
                                                    'sub_total' => $lt_amount1
                                                    );

                                    $this->HotelAdminModel->insert_data('user_checkout_sub_total',$st_arr23);
                                }

                                //add total bill
                                $wh_ck3_1 = '(user_checkout_data_id = "'.$user_checkout_data_id.'")';

                                $user_checkout_data1_3 = $this->HotelAdminModel->getData('user_checkout_data',$wh_ck3_1);

                                $tot_arr3 = array(
                                                    'total_bill' => $user_checkout_data1_3['total_bill'] + $lt_amount1
                                                    );

                                $this->HotelAdminModel->edit_data('user_checkout_data',$wh_ck3_1,$tot_arr3);
                            }
                        }

                        //other tax
                        for($l = 0;$l < $days; $l++)
                        {
                            $description_s = "Other Tax";

                            $check_out = $booking_data['extend_check_out'];

                            $check_in = $booking_data['check_out'];

                            $s_amount = $user_checkout_details_o_tax['amount'];

                            $wh_chk_d_ot = '(user_checkout_data_id = "'.$user_checkout_data_id.'" AND description = "'.$description_s.'" AND date = "'.date('Y-m-d',strtotime($booking_data['check_out']. '+'.$l. 'days')).'")';

                            $u_chk_d_ot = $this->HotelAdminModel->getData('user_checkout_details',$wh_chk_d_ot);

                            $add_ser = "";
                            
                            if(empty($u_chk_d_ot))
                            {
                                if(($check_in >= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$l. 'days')) && $check_out <= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$l. 'days'))) || ($check_in <= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$l. 'days')) && $check_out >= date('Y-m-d',strtotime($booking_data['check_out']. '+'.$l. 'days'))))
                                {
                                    $s_amount1 = $s_amount;
                                }
                                else
                                {
                                    $s_amount1 = 0;
                                }

                                $arr_s = array(
                                            'hotel_id' => $admin_id,
                                            'user_checkout_data_id' => $user_checkout_data_id,
                                            'description' => $description_s,
                                            'date' => date('Y-m-d',strtotime($booking_data['check_out']. '+'.$l. 'days')),
                                            'amount' => $s_amount1
                                            );

                                $add_ser = $this->HotelAdminModel->insert_data('user_checkout_details',$arr_s);
                            }
                              
                            if($add_ser)
                            { 
                                $wh12 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$user_checkout_data_id.'" AND description_name = "'.$description_s.'")';

                                $user_checkout_sub_total1 = $this->HotelAdminModel->getData('user_checkout_sub_total',$wh12);
                                
                                //add subtotal
                                if($user_checkout_sub_total1)
                                {
                                    $st_arr12 = array(
                                                    'sub_total' => $user_checkout_sub_total1['sub_total'] + $s_amount1
                                                    );

                                    $this->HotelAdminModel->edit_data('user_checkout_sub_total',$wh12,$st_arr12);
                                }
                                else
                                {
                                    //edit subtotal
                                    $st_arr22 = array(
                                                    'hotel_id' => $admin_id,
                                                    'user_checkout_data_id' => $user_checkout_data_id,
                                                    'description_name' => $description_s,
                                                    'sub_total' => $s_amount1
                                                    );

                                    $this->HotelAdminModel->insert_data('user_checkout_sub_total',$st_arr22);
                                }

                                //add total bill
                                $wh_ck1 = '(user_checkout_data_id = "'.$user_checkout_data_id.'")';

                                $user_checkout_data11 = $this->HotelAdminModel->getData('user_checkout_data',$wh_ck1);

                                $tot_arr2 = array(
                                                    'total_bill' => $user_checkout_data11['total_bill'] + $s_amount1
                                                    );

                                $this->HotelAdminModel->edit_data('user_checkout_data',$wh_ck1,$tot_arr2);
                            }
                        }

                        //if any service add this then add date
                        //Housekeeping
                        if($user_checkout_details_hk)
                        {
                            for($m = 0;$m < $days; $m++)
                            {
                                $check_out = $booking_data['extend_check_out'];
    
                                $check_in = $booking_data['check_out'];
    
                                $wh_chk_d_hk = '(user_checkout_data_id = "'.$user_checkout_data_id.'" AND description = "'.$description_hk.'" AND date = "'.date('Y-m-d',strtotime($booking_data['check_out']. '+'.$m. 'days')).'")';
    
                                $u_chk_d_hk = $this->HotelAdminModel->getData('user_checkout_details',$wh_chk_d_hk);
    
                                $add_hk = "";
                                
                                if(empty($u_chk_d_hk))
                                { 
                                    $arr_hk = array(
                                                    'hotel_id' => $admin_id,
                                                    'user_checkout_data_id' => $user_checkout_data_id,
                                                    'description' => $description_ld,
                                                    'date' => date('Y-m-d',strtotime($booking_data['check_out']. '+'.$m. 'days')),
                                                    'amount' => 0
                                                    );
    
                                    $add_hk = $this->HotelAdminModel->insert_data('user_checkout_details',$arr_hk);
                                }
                            }
                        }

                        //Laundry
                        if($user_checkout_details_ld)
                        {
                            for($n = 0;$n < $days; $n++)
                            {
                                $check_out = $booking_data['extend_check_out'];
    
                                $check_in = $booking_data['check_out'];
    
                                $wh_chk_d_ld = '(user_checkout_data_id = "'.$user_checkout_data_id.'" AND description = "'.$description_ld.'" AND date = "'.date('Y-m-d',strtotime($booking_data['check_out']. '+'.$n. 'days')).'")';
    
                                $u_chk_d_ld = $this->HotelAdminModel->getData('user_checkout_details',$wh_chk_d_ld);
    
                                $add_ld = "";
                                
                                if(empty($u_chk_d_ld))
                                { 
                                    $arr_hld = array(
                                                'hotel_id' => $admin_id,
                                                'user_checkout_data_id' => $user_checkout_data_id,
                                                'description' => $description_ld,
                                                'date' => date('Y-m-d',strtotime($booking_data['check_out']. '+'.$n. 'days')),
                                                'amount' => 0
                                                );
    
                                    $add_ld = $this->HotelAdminModel->insert_data('user_checkout_details',$arr_hld);
                                }
                            }
                        }

                        //Food
                        if($user_checkout_details_fd)
                        {
                            for($o = 0;$o < $days; $o++)
                            {
                                $check_out = $booking_data['extend_check_out'];
    
                                $check_in = $booking_data['check_out'];
    
                                $wh_chk_d_fd = '(user_checkout_data_id = "'.$user_checkout_data_id.'" AND description = "'.$description_fd.'" AND date = "'.date('Y-m-d',strtotime($booking_data['check_out']. '+'.$o. 'days')).'")';
    
                                $u_chk_d_fd = $this->HotelAdminModel->getData('user_checkout_details',$wh_chk_d_fd);
    
                                $add_fd = "";
                                
                                if(empty($u_chk_d_fd))
                                { 
                                    $arr_fd = array(
                                                    'hotel_id' => $admin_id,
                                                    'user_checkout_data_id' => $user_checkout_data_id,
                                                    'description' => $description_fd,
                                                    'date' => date('Y-m-d',strtotime($booking_data['check_out']. '+'.$o. 'days')),
                                                    'amount' => 0
                                                    );
    
                                    $add_fd = $this->HotelAdminModel->insert_data('user_checkout_details',$arr_fd);
                                }
                            }
                        }
                        
                        //Room Service
                        if($user_checkout_details_rs)
                        {
                            for($p = 0;$p < $days; $p++)
                            {
                                $check_out = $booking_data['extend_check_out'];
    
                                $check_in = $booking_data['check_out'];
    
                                $wh_chk_d_rs = '(user_checkout_data_id = "'.$user_checkout_data_id.'" AND description = "'.$description_rs.'" AND date = "'.date('Y-m-d',strtotime($booking_data['check_out']. '+'.$p. 'days')).'")';
    
                                $u_chk_d_rs = $this->HotelAdminModel->getData('user_checkout_details',$wh_chk_d_rs);
    
                                $add_fd = "";
                                
                                if(empty($u_chk_d_rs))
                                { 
                                    $arr_rs = array(
                                                    'hotel_id' => $admin_id,
                                                    'user_checkout_data_id' => $user_checkout_data_id,
                                                    'description' => $description_rs,
                                                    'date' => date('Y-m-d',strtotime($booking_data['check_out']. '+'.$p. 'days')),
                                                    'amount' => 0
                                                    );
    
                                    $add_fd = $this->HotelAdminModel->insert_data('user_checkout_details',$arr_rs);
                                }
                            }
                        }
                    }
                }

                $this->session->set_flashdata('msg','Data Updated Successfully');
                redirect(base_url('HoteladminController/guestList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/guestList'));
            }
        }
      
    
    }
?>