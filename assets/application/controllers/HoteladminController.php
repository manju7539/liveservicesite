<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HoteladminController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		 $this->load->model('HotelAdminModel');
		  $this->load->model('MainModel');
		 if(empty($this->session->userdata('u_id'))){
		 	redirect('/');
		 }
		// $this->load->library('pagination');   
	}
	public function guestList()
	{   
		$userType = $this->session->userdata('userType');
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        
      	$admin_id = $get_hotel_id['u_id']; 
		$guest_mng['room_type'] = $this->HotelAdminModel->get_room_type_list1($admin_id);

		$guest_mng['availble_rooms'] = $this->HotelAdminModel->get_room_no_list($admin_id);
		$guest_mng["list"] = $this->HotelAdminModel->get_guest_list_pagination($admin_id);
        $guest_mng['list1'] = $this->HotelAdminModel->get_departure_guest_list($admin_id);
		$this->load->view('include/header');
		$this->load->view('hoteladmin/viewGuestList', $guest_mng);
		$this->load->view('include/footer');
		
	}
    public function changeFoodCat()
    {
        $food_facility_id = $this->input->post('food_facility_id');
        
        $admin_id = $this->session->userdata('u_id');

        $food_cat = $this->HotelAdminModel->get_food_category($admin_id,$food_facility_id);

        $output = '<option>---Choose Food Category--</option>';

        foreach($food_cat as $fc)
        {
            $output .= '<option value="'.$fc['food_category_id'].'">'.$fc['category_name'].'</option>';
        }

        echo $output;
    }

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

                        $lt_amount = $user_checkout_details_gst['amount']??0;

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

                        $s_amount = $user_checkout_details_o_tax['amount']??0;

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

    public function banquet_hall()
	{
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');
            $wh = '(hotel_id ="'.$admin_id.'")';
          
            $banquet_hall["list"] = $this->HotelAdminModel->get_banquet_hall_pagination($admin_id);
            $this->load->view('include/header');
			$this->load->view('hoteladmin/banquet_hall',$banquet_hall);
            $this->load->view('include/footer');
		}
		else
		{
			redirect(base_url());
		}
	}
    public function delete_banquet_hall()
    {
        $banquet_hall_id = $this->input->post('id');
        
        $wh = '(banquet_hall_id = "'.$banquet_hall_id.'")';

        $del = $this->HotelAdminModel->delete_data('banquet_hall',$wh);

        $del = $this->HotelAdminModel->delete_data('banquet_hall_images',$wh);

        if($del)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }

    public function edit_banquet_hall()
    {
        $banquet_hall_name = $this->input->post('banquet_hall_name');
        $no_of_people = $this->input->post('no_of_people');
        $description = $this->input->post('description');
        
        $admin_id = $this->session->userdata('u_id');

        $banquet_hall_id = $this->input->post('banquet_hall_id');

        $banquet_hall_image_id = $this->input->post('banquet_hall_image_id',TRUE);

        $wh = '(banquet_hall_id = "'.$banquet_hall_id.'")';

        $arr = array(
                        'banquet_hall_name' => $banquet_hall_name,
                        'no_of_people' => $no_of_people,
                        'description' => $description,
                    );

        $up = $this->HotelAdminModel->edit_data('banquet_hall',$wh,$arr);

        if($up)
        {
            // edit multiple images
            if(isset($_FILES['image']['name']))
            {
                $count = count($_FILES['image']['name'],TRUE);

                for($i = 0;$i < $count; $i++)
                {
                    if(!empty($_FILES['image']['name'][$i]))
                    {
                        $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                        $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                        $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                        $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                        $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];

                        $path = 'assets/upload/banquet_hall_img/';
                        $file_path = './'.$path;
                        $config['allowed_types'] = '*';
                        $config['encrypt_name'] = TRUE;
                        $config['upload_path'] = $file_path;
                        $this->load->library('upload',$config);
                        $this->upload->initialize($config);

                        if($this->upload->do_upload('my_uploaded_file'))
                        { 
                            $file_data = $this->upload->data();

                            $image = base_url().$path.$file_data['file_name'];
                            
                            $wh1 = '(banquet_hall_image_id = "'.$banquet_hall_image_id[$i].'")';

                            $arr1 = array(
                                            'images' => $image,
                                        );

                            $this->HotelAdminModel->edit_data('banquet_hall_images',$wh1,$arr1);
                        } 
                    }
                }
            }

            // add multiple images
            $count1 = count($_FILES['image1']['name'],TRUE);

            for($j = 0;$j < $count1; $j++)
            {
                if(!empty($_FILES['image1']['name'][$j]))
                {
                    $_FILES['my_file']['name'] = $_FILES['image1']['name'][$j];
                    $_FILES['my_file']['type'] = $_FILES['image1']['type'][$j];
                    $_FILES['my_file']['tmp_name'] = $_FILES['image1']['tmp_name'][$j];
                    $_FILES['my_file']['size'] = $_FILES['image1']['size'][$j];
                    $_FILES['my_file']['error'] = $_FILES['image1']['error'][$j];

                    $path = 'assets/upload/banquet_hall_img/';
                    $file_path = './'.$path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('my_file'))
                    { 
                        $file_data = $this->upload->data();

                        $image1 = base_url().$path.$file_data['file_name'];
                        
                        $arr1 = array(
                                        'hotel_id' => $admin_id,
                                        'banquet_hall_id' => $banquet_hall_id,
                                        'images' => $image1,
                                    );

                        $this->HotelAdminModel->insert_data('banquet_hall_images',$arr1);
                    } 
                }
            }

            $this->session->set_flashdata('msg','Data Updated Successfully...');
            redirect(base_url('HoteladminController/banquet_hall'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/banquet_hall'));
        }
    }
    public function add_banquet_hall()
    {
        $banquet_hall_name = $this->input->post('banquet_hall_name');
        $no_of_people = $this->input->post('no_of_people');
        $description = $this->input->post('description');
        
        $admin_id = $this->session->userdata('u_id');

        $arr1 = array(
                    'hotel_id' => $admin_id,
                    'banquet_hall_name' => $banquet_hall_name,
                    'no_of_people' => $no_of_people,
                    'description' => $description,
                    'added_by' => 1,
                    'added_by_u_id' => $admin_id,
                    );

        $add = $this->HotelAdminModel->insert_data('banquet_hall',$arr1);

        if($add)
        {
            // add multiple images
            $count = count($_FILES['image']['name'],TRUE);

            for($i = 0;$i < $count; $i++)
            {
                if(!empty($_FILES['image']['name'][$i]))
                {
                    $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                    $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                    $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                    $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                    $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];

                    $path = 'assets/upload/banquet_hall_img/';
                    $file_path = './'.$path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('my_uploaded_file'))
                    { 
                        $file_data = $this->upload->data();

                        $image = base_url().$path.$file_data['file_name'];
                        
                        $arr1 = array(
                                        'hotel_id' => $admin_id,
                                        'banquet_hall_id' => $add,
                                        'images' => $image,
                                    );

                        $this->HotelAdminModel->insert_data('banquet_hall_images',$arr1);
                    } 
                }
            }

            $this->session->set_flashdata('msg','Data Added Successfully...');
            redirect(base_url('HoteladminController/banquet_hall'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/banquet_hall'));
        }
    }

    public function hotel_information()
	{
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');

			$hotel_information['data'] = $this->HotelAdminModel->get_user_data($admin_id);
            //echo "<pre>";
            //print_r($hotel_information['data']);

			$hotel_information['facility_list'] = $this->HotelAdminModel->get_hotels_facility($admin_id);

			$hotel_information['leads_purchase_list'] = $this->HotelAdminModel->get_hotel_admin_leads($admin_id);

			$hotel_information['hotels_pics'] = $this->HotelAdminModel->get_hotel_photos($admin_id);
			
            $this->load->view('include/header');
			$this->load->view('hoteladmin/hotel_information',$hotel_information);
            $this->load->view('include/footer');
		}
		else
		{
			redirect(base_url());
		}
	}
    public function add_hotel_info()
    {
        $hotel_name = $this->input->post('hotel_name');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $address = $this->input->post('address');
        $area = $this->input->post('area');
        $pincode = $this->input->post('pincode');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $hotel_description = $this->input->post('hotel_description');
        $hotel_requirement = $this->input->post('hotel_requirement');
        $hotel_importans = $this->input->post('hotel_importans');
        // $facilities = $this->input->post('facilities'); //multiple

        $hotel_photo_id = $this->input->post('hotel_photo_id',TRUE); // image id
        
        $admin_id = $this->session->userdata('u_id');

        $wh = '(u_id = "'.$admin_id.'")';

        $wh1 = '(hotel_id = "'.$admin_id.'")';

        $hotels_facility = $this->HotelAdminModel->getData('hotel_facility',$wh1);

        $hotel_data = $this->HotelAdminModel->getData('register',$wh);

        //add multiple hotesl photos
        if(isset($_FILES['images']['name']))
        {
            $count_img = count($_FILES['images']['name'],TRUE);

            for($i = 0;$i < $count_img; $i++)
            {
                if(!empty($_FILES['images']['name'][$i]))
                {
                    $_FILES['my_file']['name'] = $_FILES['images']['name'][$i];
                    $_FILES['my_file']['type'] = $_FILES['images']['type'][$i];
                    $_FILES['my_file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                    $_FILES['my_file']['size'] = $_FILES['images']['size'][$i];
                    $_FILES['my_file']['error'] = $_FILES['images']['error'][$i];

                    $path = 'assets/upload/hotels_photos/';
                    $file_path = './'.$path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('my_file'))
                    {
                        $file_data = $this->upload->data();

                        $images = base_url().$path.$file_data['file_name'];
                        
                        $arr1 = array(
                                    'hotel_id' => $admin_id,
                                    'images' => $images
                                    );

                        $this->HotelAdminModel->insert_data('hotel_photos',$arr1);
                    }        
                }
            }
        }

        // add facility 
        if(isset($_POST['facility_name']))
        {
            // add multiple facility
            $del = $this->HotelAdminModel->delete_data('hotel_facility',$wh1); 

            if($del)
            {
                $facility = $_POST['facility_name'];

                $facility_string = $facility[0];

                $facility_string_arr = explode(",",$facility_string);

                foreach ($facility_string_arr as $key => $value) 
                {
                    $arr_fc = array(
                                        'hotel_id' => $admin_id,
                                        'facility_name' => $value,
                                    );

                    $this->HotelAdminModel->insert_data('hotel_facility',$arr_fc);
                }
            }
        }

        // updated particular hotel_img
        if(isset($_FILES['h_image']['name']))
        {
            $count_img1 = count($_FILES['h_image']['name'],TRUE);

            for($j = 0;$j < $count_img1; $j++)
            {
                if(!empty($_FILES['h_image']['name'][$j]))
                {
                    $_FILES['my_uploaded_file']['name'] = $_FILES['h_image']['name'][$j];
                    $_FILES['my_uploaded_file']['type'] = $_FILES['h_image']['type'][$j];
                    $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['h_image']['tmp_name'][$j];
                    $_FILES['my_uploaded_file']['size'] = $_FILES['h_image']['size'][$j];
                    $_FILES['my_uploaded_file']['error'] = $_FILES['h_image']['error'][$j];

                    $path = 'assets/upload/hotels_photos/';
                    $file_path = './'.$path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('my_uploaded_file'))
                    {
                        $file_data = $this->upload->data();

                        $hotel_images = base_url().$path.$file_data['file_name'];
                        
                        $wh_h_p = '(hotel_photo_id = "'.$hotel_photo_id[$j].'")';

                        $arr_h_p = array(
                                            'images' => $hotel_images
                                        );

                        $this->HotelAdminModel->edit_data('hotel_photos',$wh_h_p,$arr_h_p);
                    }        
                }
            }
        }
        // print_r($_FILES);die;
        //edit hotel logo 
        if($_FILES['hotel_logo']['name'])
        {
            $_FILES['my_file_logo']['name'] = $_FILES['hotel_logo']['name'];
            $_FILES['my_file_logo']['type'] = $_FILES['hotel_logo']['type'];
            $_FILES['my_file_logo']['tmp_name'] = $_FILES['hotel_logo']['tmp_name'];
            $_FILES['my_file_logo']['size'] = $_FILES['hotel_logo']['size'];
            $_FILES['my_file_logo']['error'] = $_FILES['hotel_logo']['error'];

            $path = 'assets/upload/hotel_logo/';
            $file_path = './'.$path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('my_file_logo'))
            {
                $file_data = $this->upload->data();

                $hotel_logo = base_url().$path.$file_data['file_name'];
               
            }
        }
        else
        {
            $hotel_logo = $hotel_data['hotel_logo'];
        }

        $arr_r = array(
                        'hotel_name' => $hotel_name,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'address' => $address,
                        'area' => $area,
                        'pincode' => $pincode,
                        'city' => $city,
                        'state' => $state,
                        'hotel_logo' => $hotel_logo,
                        'hotel_description' => $hotel_description,
                        'hotel_requirement' => $hotel_requirement,
                        'hotel_importans' => $hotel_importans,
                    );
                    $errors = $this->upload->display_errors();
                    // print_r($errors);die;
        $this->HotelAdminModel->edit_data('register',$wh,$arr_r);

        $this->session->set_flashdata('msg','Data Added Successfully...');
        redirect(base_url('HoteladminController/hotel_information'));

    }
  
    public function new_hall_request()
	{
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');
            $new_hall_request["list"] = $this->HotelAdminModel->banquet_hall_pending_pagination($admin_id);
            $new_hall_request["list1"] = $this->HotelAdminModel->banquet_hall_pending_pagination1($admin_id);

            $this->load->view('include/header');
			$this->load->view('hoteladmin/new_hall_request',$new_hall_request);
            $this->load->view('include/footer');
		}
		else
		{
			redirect(base_url());
		}
	}
    public function departed_guest()
	{   
		$userType = $this->session->userdata('userType');
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        
      	$admin_id = $get_hotel_id['u_id']; 
		
		$guest_mng["list"] = $this->HotelAdminModel->get_departure_guest_list($admin_id);
		$this->load->view('include/header');
		$this->load->view('hoteladmin/viewDepartedGuestList', $guest_mng);
		$this->load->view('include/footer');
		
	}
    public function request_accept1()
    {
        // $request_status = $this->input->post('request_status');
        
        $admin_id = $this->session->userdata('u_id');

        $banquet_hall_orders_id = $this->uri->segment(3);
// print_r($banquet_hall_orders_id);die;
        $wh = '(banquet_hall_orders_id = "'.$banquet_hall_orders_id.'")';

        $arr = array(
                        'request_status' => 1,
                        'assign_by' => 1,
                        'assign_by_u_id' => $admin_id,
                    );

        $up = $this->HotelAdminModel->edit_data('banquet_hall_orders',$wh,$arr);

        if($up)
        {
            $this->session->set_flashdata('msg','Request accepted successfully');
            redirect(base_url('HoteladminController/new_hall_request'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/new_hall_request'));
        }
    }

    //8-11-2022 //archana
    public function request_reject1()
    { 
        $admin_id = $this->session->userdata('admin_id');

        $banquet_hall_orders_id = $this->uri->segment(3);

        $wh = '(banquet_hall_orders_id = "'.$banquet_hall_orders_id.'")';

        $arr = array(
                        'request_status' => 2,
                        'assign_by' => 1,
                        'assign_by_u_id' => $admin_id,
                    );

        $up = $this->HotelAdminModel->edit_data('banquet_hall_orders',$wh,$arr);

        if($up)
        {
            $this->session->set_flashdata('msg','Request rejected successfully');
            redirect(base_url('HoteladminController/new_hall_request'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/new_hall_request'));
        }
    }

    public function create_all_department_admin()
    {
    //  print_r($this->input->post());die;  
        $department_id = $this->input->post('department_id');      
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $mobile_no = $this->input->post('mobile_no');
        $email_id = $this->input->post('email_id');
        $password = $this->input->post('password'); 
        //$id_proof_name = $this->input->post('id_proof_name');
        $shift_type = $this->input->post('shift_type');
        $shift_start_time = $this->input->post('shift_start_time');
        $shift_end_time = $this->input->post('shift_end_time');
        
        $admin_id = $this->session->userdata('u_id');

        $hotel_available_service_list = $this->HotelAdminModel->get_hotel_available_service_list($department_id);
        if($department_id == 2)
        {
            $user_type = 3;
        }
        else
        {
            if($department_id == 3)
            {
                $user_type = 6;
            }
            else
            {
                if($department_id == 4)
                {
                    $user_type = 7;  //5
                }
                else
                {
                    if($department_id == 5)
                    {
                        $user_type = 5; //7
                    }
                }
            }
        }

        if(!empty($_FILES['profile_photo']['name']))
        {
            $_FILES['my_file']['name'] = $_FILES['profile_photo']['name']; 
            $_FILES['my_file']['type'] = $_FILES['profile_photo']['type']; 
            $_FILES['my_file']['size'] = $_FILES['profile_photo']['size']; 
            $_FILES['my_file']['error'] = $_FILES['profile_photo']['error']; 
            $_FILES['my_file']['tmp_name'] = $_FILES['profile_photo']['tmp_name']; 

            $path = 'assets/upload/other_panel_admin_photo/';
            $upload_path = './'.$path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $upload_path;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('my_file'))
            {
                $file_data = $this->upload->data();

                $profile_photo = base_url().$path.$file_data['file_name'];
            }
            else
            {
                $this->session->set_flashdata('msg','Erro to upload image');
                redirect(base_url('HoteladminController/login_departments'));
            }
        }

        

        $arr = array(
                     'hotel_id' => $admin_id,
                     'user_type' => $user_type,
                     'user_is' => 1,
                     'full_name' => $first_name." ".$last_name,
                     'email_id' => $email_id,
                     'mobile_no' => $mobile_no,
                     'password' => md5($password),			//md5($mobile_no)
                     'password_text' => $password,	//$mobile_no
                     'profile_photo' => $profile_photo,
                     //'id_proof_name' => $id_proof_name,
                     //'Id_proff_photo' => $Id_proff_photo,
                     'shift_type' => $shift_type,
                     'shift_start_time' => $shift_start_time,
                     'shift_end_time' => $shift_end_time,
                     'is_active' => 1,
                     'register_date' => date('Y-m-d'),
                    );

        $add = $this->HotelAdminModel->insert_data('register',$arr);

        if($add)
        {
            if($hotel_available_service_list)
            {
                foreach($hotel_available_service_list as $h_v)
                {
                    $arr_access = array(
                                        'hotel_id' => $admin_id,
                                        'department_id' => $department_id,
                                        'user_id' => $add,
                                        'services_name' => $h_v['service_name']
                                        );

                    $this->HotelAdminModel->insert_data('access_to_department',$arr_access);
                }
            }
            

            // $this->session->set_flashdata('msg','Data Added Successfully...');
            $login_departments["panel_admin_list"] = $this->HotelAdminModel->get_panel_admin_list_according_to_hotel_pagination($admin_id);
       
            $this->load->view('hoteladmin/ajaxLoginDepartmentList', $login_departments);
          //  redirect(base_url('HoteladminController/login_departments'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/login_departments'));
        }
    }
    public function viewRoomConfig(){
		
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$postArray = $this->input->post();
		// print_r($postArray);
		// exit;
		
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $this->session->userdata('u_id');
		$room_type=$postArray['room_type'];
		// print_r($room_type);
		// exit;
		
		
		$view_room['room_type_data'] = $this->HotelAdminModel->get_room_type_data($admin_id);
		$view_room['list'] = $this->HotelAdminModel->get_room_related_data($admin_id,$room_type);
		$view_room['floor_list'] = $this->HotelAdminModel->get_floor_list($admin_id);
		// print_r($view_room['room_type_data']);
		// exit;

		
		$this->load->view('hoteladmin/ajaxViewRoomConfig',$view_room);
	
	}
    public function assign_housekeeping_service_order_to_staff()
    {
        $h_k_order_id = $this->input->post('h_k_order_id');
        $order_status = $this->input->post('order_status');
        
        $wh = '(h_k_order_id = "'.$h_k_order_id.'")';

        $rand_no = rand('1111','9999');

        if($order_status == 1)
        {
            $staff_id = $this->input->post('staff_id');
            $accept_date = date('Y-m-d');
            $reject_date = "";
            $otp = $rand_no;
        }
        else
        {
            $staff_id = 0;
            $accept_date = "";
            $otp = "";
            $reject_date = date('Y-m-d');
        }

        $arr = array(
                     'order_status' => $order_status,
                     'staff_id' => $staff_id,
                     'accept_date' => $accept_date,
                     'reject_date' => $reject_date,
                     'otp' => $otp,
                    );

        $up = $this->HotelAdminModel->edit_data('house_keeping_orders',$wh,$arr);

        if($up)
        {
            if($order_status == 1)
            {
                $this->session->set_flashdata('msg','Order Accepted successfully');
                redirect(base_url('HoteladminController/order_management'));
            }
            else
            {
                $this->session->set_flashdata('msg','Order Rejected');
                redirect(base_url('HoteladminController/order_management'));
            }
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/order_management'));
        }
    }


    public function add_checkout_details()
    {
        $admin_id = $this->session->userdata('u_id');
        
        $booking_id = $this->uri->segment(3);

        $u_id = $this->uri->segment(4);
        $booking_details = $this->HotelAdminModel->get_user_booking_details($admin_id,$booking_id);
        
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

        $user_checkout_data = $this->HotelAdminModel->getData('user_checkout_data',$wh);

        if(empty($user_checkout_data))
        {
            $arr = array(
                            'hotel_id' => $admin_id,
                            'u_id' => $u_id,
                            'booking_id' => $booking_id
                        );

            $add = $this->HotelAdminModel->insert_data('user_checkout_data',$arr);

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

                    $add_rm_charges = $this->HotelAdminModel->insert_data('user_checkout_details',$arr1);

                    if($add_rm_charges)
                    { 
                        $wh1 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$add.'" AND description_name = "'.$description.'")';

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
                                        'user_checkout_data_id' => $add,
                                        'description_name' => $description,
                                        'sub_total' => $amount1
                                        );

                            $this->HotelAdminModel->insert_data('user_checkout_sub_total',$st_arr2);
                        }

                        //add total bill
                        $wh_ck = '(user_checkout_data_id = "'.$add.'")';

                        $user_checkout_data1 = $this->HotelAdminModel->getData('user_checkout_data',$wh_ck);

                        $tot_arr1 = array(
                                        'total_bill' => $user_checkout_data1['total_bill'] + $amount1
                                        );

                        $this->HotelAdminModel->edit_data('user_checkout_data',$wh_ck,$tot_arr1);
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

                    $add_lux = $this->HotelAdminModel->insert_data('user_checkout_details',$arr_lx);
                    
                    if($add_lux)
                    { 
                        $wh13 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$add.'" AND description_name = "'.$description_lx.'")';

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
                                            'user_checkout_data_id' => $add,
                                            'description_name' => $description_lx,
                                            'sub_total' => $lt_amount1
                                            );

                            $this->HotelAdminModel->insert_data('user_checkout_sub_total',$st_arr23);
                        }

                        //add total bill
                        $wh_ck3_1 = '(user_checkout_data_id = "'.$add.'")';

                        $user_checkout_data1_3 = $this->HotelAdminModel->getData('user_checkout_data',$wh_ck3_1);

                        $tot_arr3 = array(
                                            'total_bill' => $user_checkout_data1_3['total_bill'] + $lt_amount1
                                            );

                        $this->HotelAdminModel->edit_data('user_checkout_data',$wh_ck3_1,$tot_arr3);
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

                    $add_ser = $this->HotelAdminModel->insert_data('user_checkout_details',$arr_s);
                    
                    if($add_ser)
                    { 
                        $wh12 = '(hotel_id = "'.$admin_id.'" AND user_checkout_data_id = "'.$add.'" AND description_name = "'.$description_s.'")';

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
                                            'user_checkout_data_id' => $add,
                                            'description_name' => $description_s,
                                            'sub_total' => $s_amount1
                                            );

                            $this->HotelAdminModel->insert_data('user_checkout_sub_total',$st_arr22);
                        }

                        //add total bill
                        $wh_ck1 = '(user_checkout_data_id = "'.$add.'")';

                        $user_checkout_data11 = $this->HotelAdminModel->getData('user_checkout_data',$wh_ck1);

                        $tot_arr2 = array(
                                            'total_bill' => $user_checkout_data11['total_bill'] + $s_amount1
                                            );

                        $this->HotelAdminModel->edit_data('user_checkout_data',$wh_ck1,$tot_arr2);
                    }
                }
                
                redirect(base_url('HoteladminController/check_out_view/' . $booking_id.'/'.$u_id));
            }
        }
        else
        {
            redirect(base_url('HoteladminController/check_out_view/' . $booking_id.'/'.$u_id));
        }
    }




    public function create_all_department_staff()
        {
            $department_id = $this->input->post('department_id');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $email_id = $this->input->post('email_id');
            $password = $this->input->post('password'); 
            //$id_proof_name = $this->input->post('id_proof_name');
            $shift_type = $this->input->post('shift_type');
            $shift_start_time = $this->input->post('shift_start_time');
            $shift_end_time = $this->input->post('shift_end_time');
            
            $admin_id = $this->session->userdata('u_id');

            if($department_id == 3)
            {
                $user_type = 10;  //10
            }
            else
            {
                if($department_id == 4)
                {
                    $user_type = 8; //8
                }
                else
                {
                    if($department_id == 5)
                    {
                        $user_type = 9;  //9
                    }
                }
            }
            
            if(!empty($_FILES['profile_photo']['name']))
            {
                $_FILES['my_file']['name'] = $_FILES['profile_photo']['name']; 
                $_FILES['my_file']['type'] = $_FILES['profile_photo']['type']; 
                $_FILES['my_file']['size'] = $_FILES['profile_photo']['size']; 
                $_FILES['my_file']['error'] = $_FILES['profile_photo']['error']; 
                $_FILES['my_file']['tmp_name'] = $_FILES['profile_photo']['tmp_name']; 
    
                $path = 'assets/upload/other_panel_staff_photo/';
                $upload_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $upload_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
    
                if($this->upload->do_upload('my_file'))
                {
                    $file_data = $this->upload->data();
    
                    $profile_photo = base_url().$path.$file_data['file_name'];
                }
                else
                {
                    $this->session->set_flashdata('msg','Error to upload image');
                    redirect(base_url('HoteladminController/staff_login'));
                }
            }

         
            $arr = array(
                         'hotel_id' => $admin_id,
                         'user_type' => $user_type,
                         'user_is' => 2,
                         'full_name' => $first_name." ".$last_name,
                         'email_id' => $email_id,
                         'mobile_no' => $mobile_no,
                         'password' => md5($password),
                         'password_text' => $password,
                         'profile_photo' => $profile_photo,
                         //'id_proof_name' => $id_proof_name,
                         //'Id_proff_photo' => $Id_proff_photo,
                         'shift_type' => $shift_type,
                         'shift_start_time' => $shift_start_time,
                         'shift_end_time' => $shift_end_time,
                         'is_active' => 1,
                         'register_date' => date('Y-m-d'),
                        );

            $add = $this->HotelAdminModel->insert_data('register',$arr);

            if($add)
            {
                // $this->session->set_flashdata('msg','Data Added Successfully...');
                // redirect(base_url('HoteladminController/staff_login'));
                $staff_login['list'] = $this->HotelAdminModel->get_admin_panel_list_2($admin_id);
                $staff_login["staff_list"] = $this->HotelAdminModel->get_staff_list_according_to_hotel_1($admin_id);
                $this->load->view('hoteladmin/ajaxStaffLoginist', $staff_login);
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/staff_login'));
            }
        }

    public function delete_user()
    {
        $u_id = $this->input->post('id');
        
        $wh = '(u_id = "'.$u_id.'")';

        $del = $this->HotelAdminModel->delete_data('register',$wh);

        if($del)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }
    public function change_users_status()
        {
            $status = $this->input->post('status');

            $u_id = $this->input->post('id');
            
            $wh = '(u_id = "'.$u_id.'")';

            $arr = array(
                            'is_active' => $status
                        );

            $add = $this->HotelAdminModel->edit_data('register',$wh,$arr);

            if($add)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }

        public function access_frontOffice()
	{
        // print_r($this->input->post());die;
		if($this->session->userdata('u_id'))
		{
			$department_id = 2;

			$access_frontOffice['hotel_available_service_list'] = $this->HotelAdminModel->get_hotel_available_service_list($department_id);
			$access_frontOffice['u_id'] = $this->input->post('u_id1');
            // $this->load->view('include/header');
            $this->load->view('hoteladmin/access_frontOffice',$access_frontOffice);
            // $this->load->view('include/footer');
			
		}
		else
		{
			redirect(base_url());
		}
	}

    public function access_housekeeping()
	{
		if($this->session->userdata('u_id'))
		{
			$department_id = 5;

			$access_housekeeping['hotel_available_service_list'] = $this->HotelAdminModel->get_hotel_available_service_list($department_id);
			$access_housekeeping['u_id'] = $this->input->post('u_id1');
			$this->load->view('hoteladmin/access_housekeeping',$access_housekeeping);
		}
		else
		{
			redirect(base_url());
		}
	}

    public function add_access_to_department()
    {
        $is_access = $this->input->post('is_access');
        $access_to_department_id = $this->input->post('id');
        $service_name = $this->input->post('service_name');
        $front_ofs_admin_id = $this->input->post('front_ofs_admin_id');
        $hotel_id = $this->session->userdata('u_id');

        $department_id = 2;

        $wh = '(access_to_department_id = "'.$access_to_department_id.'")';

        $arr_up = array(
                        'is_access' => $is_access
                    );

        $up = $this->HotelAdminModel->edit_data('access_to_department',$wh,$arr_up); 

        if($up)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }

    public function access_room()
	{
		if($this->session->userdata('u_id'))
		{
			$department_id = 3;

			$access_room['hotel_available_service_list'] = $this->HotelAdminModel->get_hotel_available_service_list($department_id);
			$access_room['u_id'] = $this->input->post('u_id1');

			$this->load->view('hoteladmin/access_room',$access_room);
		}
		else
		{
			redirect(base_url());
		}
	}

    public function staff_login()
	{
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');

			$staff_login['list'] = $this->HotelAdminModel->get_admin_panel_list_2($admin_id);


            $staff_login["staff_list"] = $this->HotelAdminModel->get_staff_list_according_to_hotel_1($admin_id);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/staff_login',$staff_login);
            $this->load->view('include/footer');
			
		}
		else
		{
			redirect(base_url());
		}
	}




    public function access_food()
	{
        // print_r($this->input->post());die;
		if($this->session->userdata('u_id'))
		{
			$department_id = 4;

			$access_food['hotel_available_service_list'] = $this->HotelAdminModel->get_hotel_available_service_list($department_id);
			$access_food['u_id'] =$this->input->post('u_id1');
         
			$this->load->view('hoteladmin/access_food',$access_food);
		}
		else
		{
			redirect(base_url());
		}
	}
    public function login_departments()
	{   
		$userType = $this->session->userdata('userType');
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        
      	$admin_id = $get_hotel_id['u_id']; 
		
		$login_departments["panel_admin_list"] = $this->HotelAdminModel->get_panel_admin_list_according_to_hotel_pagination($admin_id);
        $login_departments['list'] = $this->HotelAdminModel->get_admin_panel_list($admin_id);
        // print_r($login_departments['list']);die;
		$this->load->view('include/header');
		$this->load->view('hoteladmin/viewLoginDepartmentsList', $login_departments);
		$this->load->view('include/footer');
		
	}
	

		public function feedbackList()
	{   
		$userType = $this->session->userdata('userType');
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        
      	$admin_id = $get_hotel_id['u_id']; 
		
		$guest_mng["list"] = $this->HotelAdminModel->get_feedback_list_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('hoteladmin/viewFeedbackList', $guest_mng);
		$this->load->view('include/footer');
		
	}
    public function delete_feedback()
    {
        $review_id = $this->input->post('id');
        
        $wh = '(review_id = "'.$review_id.'")';

        $del = $this->HotelAdminModel->delete_data('review',$wh);

        if($del)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }
			public function nearByPlace()
	{   
		$userType = $this->session->userdata('userType');
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        
      	$admin_id = $get_hotel_id['u_id']; 
		
		$guest_mng["list"] = $this->HotelAdminModel->get_hotel_near_by_place_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('hoteladmin/viewNearByPlaceList', $guest_mng);
		$this->load->view('include/footer');
		
	}
    public function delete_hotel_near_by_places()
    {
        $hotel_near_by_place_id = $this->input->post('id');
        
        $wh = '(hotel_near_by_place_id = "'.$hotel_near_by_place_id.'")';

        $del = $this->HotelAdminModel->delete_data('hotel_near_by_place',$wh);

        $del = $this->HotelAdminModel->delete_data('hotel_near_by_place_images',$wh);

        if($del)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }

    public function edit_hotel_near_by_places()
    {
        $hotel_near_by_place_id = $this->input->post('hotel_near_by_place_id');

        $places = $this->input->post('places');
        $places_name = $this->input->post('places_name');
        $contact_no = $this->input->post('contact_no');
        $place_address = $this->input->post('place_address');
        $description = $this->input->post('description');
        $latitute = $this->input->post('latitute');
        $longitude = $this->input->post('longitude');
        $website_link = $this->input->post('website_link');

        $id = $this->input->post('id',TRUE); // image id
        
        $wh = '(hotel_near_by_place_id = "'.$hotel_near_by_place_id.'")';

        $arr = array(
                    'places' => $places,
                    'places_name' => $places_name,
                    'contact_no' => $contact_no,
                    'place_address' => $place_address,
                    'description' => $description,
                    'latitute' => $latitute,
                    'longitude' => $longitude,
                    'website_link' => $website_link,
                    );

        $up = $this->HotelAdminModel->edit_data('hotel_near_by_place',$wh,$arr);

        if($up)
        {
             // updated particular images
            if(isset($_FILES['image']['name']))
            {
                echo $count_img = count($_FILES['image']['name'],TRUE);

                for($i = 0;$i < $count_img; $i++)
                {
                    if(!empty($_FILES['image']['name'][$i]))
                    {
                        $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                        $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                        $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                        $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                        $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];
    
                        $path = 'assets/upload/hotel_near_by_place_images/';
                        $file_path = './'.$path;
                        $config['allowed_types'] = '*';
                        $config['encrypt_name'] = TRUE;
                        $config['upload_path'] = $file_path;
                        $this->load->library('upload',$config);
                        $this->upload->initialize($config);

                        if($this->upload->do_upload('my_uploaded_file'))
                        {
                            $file_data = $this->upload->data();
    
                            $images = base_url().$path.$file_data['file_name'];
                            
                            $wh1 = '(id = "'.$id[$i].'")';

                            $arr1 = array(
                                        'images' => $images
                                        );

                            $this->HotelAdminModel->edit_data('hotel_near_by_place_images',$wh1,$arr1);
                        }        
                    }
                }
            }
            
            $this->session->set_flashdata('msg','Data updated successfully..');
            redirect(base_url('HoteladminController/nearByPlace'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/nearByPlace'));
        }
    }

    public function add_hotel_near_by_places()
    {
        $places = $this->input->post('places');
        $places_name = $this->input->post('places_name');
        $contact_no = $this->input->post('contact_no');
        $place_address = $this->input->post('place_address');
        $description = $this->input->post('description');
        $latitute = $this->input->post('latitute');
        $longitude = $this->input->post('longitude');
        $website_link = $this->input->post('website_link');

        $admin_id = $this->session->userdata('u_id');

        $arr = array(
                        'hotel_id' => $admin_id,
                        'places' => $places,
                        'places_name' => $places_name,
                        'contact_no' => $contact_no,
                        'place_address' => $place_address,
                        'description' => $description,
                        'latitute' => $latitute,
                        'longitude' => $longitude,
                        'website_link' => $website_link,
                    );

        $add = $this->HotelAdminModel->insert_data('hotel_near_by_place',$arr);

        if($add)
        {
            // add multiple images
            $count_img = count($_FILES['image']['name'],TRUE);

            for($i = 0;$i < $count_img; $i++)
            {
                if(!empty($_FILES['image']['name'][$i]))
                {
                    $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                    $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                    $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                    $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                    $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];

                    $path = 'assets/upload/hotel_near_by_place_images/';
                    $file_path = './'.$path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('my_uploaded_file'))
                    {
                        $file_data = $this->upload->data();

                        $images = base_url().$path.$file_data['file_name'];
                        
                        $arr1 = array(
                                    'hotel_id' => $admin_id,
                                    'hotel_near_by_place_id' => $add,
                                    'images' => $images
                                    );

                        $this->HotelAdminModel->insert_data('hotel_near_by_place_images',$arr1);
                    }        
                }
            }

            $this->session->set_flashdata('msg','Data added successfully');
            redirect(base_url('HoteladminController/nearByPlace')); 
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/nearByPlace'));
        }
    }

	public function nearByHelp()
	{   
		$userType = $this->session->userdata('userType');
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        
      	$admin_id = $get_hotel_id['u_id']; 
		
		$guest_mng["list"] = $this->HotelAdminModel->get_hotel_near_by_help_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('hoteladmin/viewNearByHelpList', $guest_mng);
		$this->load->view('include/footer');
		
	}
    public function delete_hotel_near_by_help()
    {
        $hotel_near_by_help_id = $this->input->post('id');
        
        $wh = '(hotel_near_by_help_id = "'.$hotel_near_by_help_id.'")';

        $del = $this->HotelAdminModel->delete_data('hotel_near_by_help',$wh);

        $del = $this->HotelAdminModel->delete_data('hotel_near_by_help_images',$wh);

        if($del)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }

    public function edit_hotel_near_by_help()
    {
        $hotel_near_by_help_id = $this->input->post('hotel_near_by_help_id');

        $places_name = $this->input->post('places_name');
        $name = $this->input->post('name');
        $contact_no = $this->input->post('contact_no');
        $place_address = $this->input->post('place_address');
        $description = $this->input->post('description');
        $open_time = $this->input->post('open_time');
        $close_time = $this->input->post('close_time');

        $id = $this->input->post('id',TRUE); // image id
        
        $wh = '(hotel_near_by_help_id = "'.$hotel_near_by_help_id.'")';

        $arr = array(
                    'places_name' => $places_name,
                    'name' => $name,
                    'contact_no' => $contact_no,
                    'place_address' => $place_address,
                    'description' => $description,
                    'open_time' => $open_time,
                    'close_time' => $close_time,
                    );

        $up = $this->HotelAdminModel->edit_data('hotel_near_by_help',$wh,$arr);

        if($up)
        {
            // updated particular images
            if(isset($_FILES['image']['name']))
            {
                echo $count_img = count($_FILES['image']['name'],TRUE);

                for($i = 0;$i < $count_img; $i++)
                {
                    if(!empty($_FILES['image']['name'][$i]))
                    {
                        $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                        $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                        $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                        $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                        $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];
    
                        $path = 'assets/upload/hotel_near_by_help_images/';
                        $file_path = './'.$path;
                        $config['allowed_types'] = '*';
                        $config['encrypt_name'] = TRUE;
                        $config['upload_path'] = $file_path;
                        $this->load->library('upload',$config);
                        $this->upload->initialize($config);

                        if($this->upload->do_upload('my_uploaded_file'))
                        {
                            $file_data = $this->upload->data();
    
                            $images = base_url().$path.$file_data['file_name'];
                            
                            $wh1 = '(id = "'.$id[$i].'")';

                            $arr1 = array(
                                        'images' => $images
                                        );

                            $this->HotelAdminModel->edit_data('hotel_near_by_help_images',$wh1,$arr1);
                        }        
                    }
                }
            }
            
            $this->session->set_flashdata('msg','Data updated successfully..');
            redirect(base_url('HoteladminController/nearByHelp'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/nearByHelp'));
        }
    }

    public function add_hotel_near_by_help()
    {
        $places_name = $this->input->post('places_name');
        $name = $this->input->post('name');
        $contact_no = $this->input->post('contact_no');
        $place_address = $this->input->post('place_address');
        $description = $this->input->post('description');
        $open_time = $this->input->post('open_time');
        $close_time = $this->input->post('close_time');

        $admin_id = $this->session->userdata('u_id');

        $arr = array(
                        'hotel_id' => $admin_id,
                        'places_name' => $places_name,
                        'name' => $name,
                        'contact_no' => $contact_no,
                        'place_address' => $place_address,
                        'description' => $description,
                        'open_time' => $open_time,
                        'close_time' => $close_time,
                    );

        $add = $this->HotelAdminModel->insert_data('hotel_near_by_help',$arr);

        if($add)
        {
            // add multiple images
            $count_img = count($_FILES['image']['name'],TRUE);

            for($i = 0;$i < $count_img; $i++)
            {
                if(!empty($_FILES['image']['name'][$i]))
                {
                    $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                    $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                    $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                    $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                    $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];

                    $path = 'assets/upload/hotel_near_by_help_images/';
                    $file_path = './'.$path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('my_uploaded_file'))
                    {
                        $file_data = $this->upload->data();

                        $images = base_url().$path.$file_data['file_name'];
                        
                        $arr1 = array(
                                    'hotel_id' => $admin_id,
                                    'hotel_near_by_help_id' => $add,
                                    'images' => $images
                                    );

                        $this->HotelAdminModel->insert_data('hotel_near_by_help_images',$arr1);
                    }        
                }
            }

            $this->session->set_flashdata('msg','Data added successfully');
            redirect(base_url('HoteladminController/nearByHelp')); 
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/nearByHelp'));
        }
    }
		public function offerList()
	{   
		$userType = $this->session->userdata('userType');
		$admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
        
      	$admin_id = $get_hotel_id['u_id']; 
		
		$guest_mng["list"] = $this->HotelAdminModel->get_offer_list_pagination($admin_id);
		$this->load->view('include/header');
		$this->load->view('hoteladmin/viewOfferList', $guest_mng);
		$this->load->view('include/footer');
		
	}
    public function delete_offer()
    {
        $offer_id = $this->input->post('id');
        
        $wh = '(offer_id = "'.$offer_id.'")';

        $del = $this->HotelAdminModel->delete_data('offers',$wh);

        if($del)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }

    public function add_offer()
        {
            $offer_name = $this->input->post('offer_name');
            // $min_amount = $this->input->post('min_amount');
            $amt_in_per = $this->input->post('amt_in_per');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $description = $this->input->post('description');
            $offer_for = $this->input->post('offer_for');

            $admin_id = $this->session->userdata('u_id');
            
            $char = str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');

            $offer_code = substr($char,0,6);

            $wh = '(offer_for = 1 AND hotel_id = "'.$admin_id.'")';

            $offer_data = $this->HotelAdminModel->getData('offers',$wh);

            if($offer_data)
            {
                $this->session->set_flashdata('msg','Already this offer exits..');
                redirect(base_url('HoteladminController/offerList'));
            }
            else
            {
                $_FILES['my_file']['name'] = $_FILES['image']['name']; 
                $_FILES['my_file']['type'] = $_FILES['image']['type']; 
                $_FILES['my_file']['size'] = $_FILES['image']['size']; 
                $_FILES['my_file']['error'] = $_FILES['image']['error']; 
                $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name']; 
    
                $path = 'assets/upload/offer_img/';
                $upload_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $upload_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
    
                if($this->upload->do_upload('my_file'))
                {
                    $file_data = $this->upload->data();
    
                    $image = base_url().$path.$file_data['file_name'];
                }
                else
                {
                    $this->session->set_flashdata('msg','Erro to upload image');
                    redirect(base_url('HoteladminController/offerList'));
                }
    
                $arr = array(
                             'hotel_id' => $admin_id,
                             'offer_code' => $offer_code,
                             'offer_name' => $offer_name,
                            //  'min_amount' => $min_amount,
                             'amt_in_per' => $amt_in_per,
                             'start_date' => $start_date,
                             'end_date' => $end_date,
                             'image' => $image,
                             'description' => $description,
                             'offer_for' => $offer_for,
                            );
    
                $add = $this->HotelAdminModel->insert_data('offers',$arr);
    
                if($add)
                {
                    $this->session->set_flashdata('msg','Offers added Successfully...');
                    redirect(base_url('HoteladminController/offerList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/offerList'));
                }
            }
        }

    public function edit_offer()
    {
        $offer_name = $this->input->post('offer_name');
        // $min_amount = $this->input->post('min_amount');
        $amt_in_per = $this->input->post('amt_in_per');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $description = $this->input->post('description');
        $offer_for = $this->input->post('offer_for');

        $offer_id = $this->input->post('offer_id');

        $admin_id = $this->session->userdata('u_id');

        $wh = '(offer_id = "'.$offer_id.'")';

        $offer_data = $this->HotelAdminModel->getData('offers',$wh);

        if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name']))
        {
            
          
            $_FILES['my_file']['name'] = $_FILES['image']['name']; 
            $_FILES['my_file']['type'] = $_FILES['image']['type']; 
            $_FILES['my_file']['size'] = $_FILES['image']['size']; 
            $_FILES['my_file']['error'] = $_FILES['image']['error']; 
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name']; 

            $path = 'assets/upload/offer_img/';
            $upload_path = './'.$path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $upload_path;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('my_file'))
            {
              
                
                $file_data = $this->upload->data();

                $image = base_url().$path.$file_data['file_name'];
            }
            else
            {
               
                $this->session->set_flashdata('msg','Error to upload image');
                redirect(base_url('HoteladminController/offerList'));
            }
        }
        else
        {
            
            $image = $offer_data['image'];
        }
  
        $arr = array(
                     'hotel_id' => $admin_id,
                     'offer_name' => $offer_name,
                    //  'min_amount' => $min_amount,
                     'amt_in_per' => $amt_in_per,
                     'start_date' => $start_date,
                     'end_date' => $end_date,
                     'image' => $image,
                     'description' => $description,
                     'offer_for' => $offer_for,
                    );

        $add = $this->HotelAdminModel->edit_data('offers',$wh,$arr);

        if($add)
        {
            $this->session->set_flashdata('msg','Offers Updated Successfully...');
            redirect(base_url('HoteladminController/offerList'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/offerList'));
        }
    }
    public function resend_notification_to_user()
    {
        $notification_id = $this->uri->segment(3);

        $wh = '(notification_id = "'.$notification_id.'")';

        $wh = '(notification_id = "'.$notification_id.'")';

        $notification_data = $this->HotelAdminModel->getData('notifications',$wh);

        $notification_data1 = $this->HotelAdminModel->getAllData('notifictions_u_id',$wh);

        $admin_id = $this->session->userdata('u_id');
        
        $arr = array(
                        'send_to' => $notification_data['send_to'],
                        'send_for' => $notification_data['send_for'],
                        'notification_type' => $notification_data['notification_type'],
                        'title' => $notification_data['title'],
                        'description' => $notification_data['description'],
                        'send_by' => $notification_data['send_by'],
                        'send_by_id' => $notification_data['send_by_id'],
                    );

        $add = $this->HotelAdminModel->insert_data('notifications',$arr);

        if($add)
        {
            // if($notification_data['send_to'] == 2)
            // {
                if($notification_data1)
                {
                    foreach($notification_data1 as $nt)
                    {
                        $arr1 = array(
                                    'notification_id' => $notification_id,
                                    'user_id' => $nt['user_id']
                                    );

                        $add_u_nt = $this->HotelAdminModel->insert_data('notifictions_u_id',$arr1);

                        if($add_u_nt)
                        {
                            $arr_u_nt = array(
                                                'u_id' => $users[$i],
                                                'hotel_id' => $admin_id,
                                                'subject' => $title,
                                                'description' => strip_tags($description),
                                                'clear_flag' => 1,
                                                'count_flag' => 1,
                                            );

                            $this->HotelAdminModel->insert_data('user_notification',$arr_u_nt);
                        }
                    }
                }  
            // }
            
            echo "1";
        }
        else
        {
            echo "0";
        }
    }
    public function resend_notification_to_department()
    {
        $notification_id = $this->uri->segment(3);
// print_r($notification_id);die;
        $wh = '(notification_id = "'.$notification_id.'")';

        $wh = '(notification_id = "'.$notification_id.'")';

        $notification_data = $this->HotelAdminModel->getData('notifications',$wh);

        $notification_data1 = $this->HotelAdminModel->getAllData('notifictions_department_id',$wh);

        $admin_id = $this->session->userdata('u_id');
        
        $arr = array(
                        'send_to' => $notification_data['send_to'],
                        'send_for' => $notification_data['send_for'],
                        'notification_type' => $notification_data['notification_type'],
                        'title' => $notification_data['title'],
                        'description' => $notification_data['description'],
                        'send_by' => $notification_data['send_by'],
                        'send_by_id' => $notification_data['send_by_id'],
                    );

        $add = $this->HotelAdminModel->insert_data('notifications',$arr);

        if($add)
        {
            // if($notification_data['send_to'] == 2)
            // {
                if($notification_data1)
                {
                    foreach($notification_data1 as $nt)
                    {
                        $arr1 = array(
                                    'notification_id' => $notification_id,
                                    'department_id' => $nt['department_id']
                                    );

                        $this->HotelAdminModel->insert_data('notifictions_department_id',$arr1);
                    }
                }  
            // }
            
            $this->session->set_flashdata('msg','Resent Notification to Department Successfully...');
            redirect(base_url('HoteladminController/sendDepartment'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/sendDepartment'));
        }
    }
 public function delete_notification()
        {
            $notification_id = $this->input->post('id');
            
            $wh = '(notification_id = "'.$notification_id.'")';

            $del = $this->HotelAdminModel->delete_data('notifications',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
        public function sent_notification_to_department()
        {
            $send_to = $this->input->post('send_to');
            $departments = $this->input->post('departments');
            $notification_type = $this->input->post('notification_type');
            $title = $this->input->post('title');
            $description = $this->input->post('description');

            $admin_id = $this->session->userdata('u_id');
            
            if($send_to == "all")
            {
                $send_to1 = 1;
            }
            else
            {
                $send_to1 = 2;
            }

          

            $send_for = 7;

            $arr = array(
                        'send_to' => $send_to1,
                        'send_for' => $send_for,
                        'notification_type' => $notification_type,
                        'title' => $title,
                        'description' => $description,
                        'send_by' => 2,
                        'send_by_id' => $admin_id,
                    );

            $add = $this->HotelAdminModel->insert_data('notifications',$arr);

            if($add)
            {
                if($send_to1 == 2)
                {
                    $count = count($departments);

                    for($i = 0;$i < $count;$i++)
                    {
                        $arr1 = array(
                                    'notification_id' => $add,
                                    'department_id' => $departments[$i]
                                    );

                        $this->HotelAdminModel->insert_data('notifictions_department_id',$arr1);
                    }
                }
                else
                {
                    //send all departments
                    $hotels_department = $this->HotelAdminModel->get_admin_panel_list($admin_id);

                    // $count1 = count($hotels_department);

                    foreach ($hotels_department as $hd) 
                    {
                        $arr_nd = array(
                                        'notification_id' => $add,
                                        'department_id' => $hd['department_id']
                                        );

                        $this->HotelAdminModel->insert_data('notifictions_department_id',$arr_nd);
                    }
                }
                $this->session->set_flashdata('msg','Sent Notification to Department Successfully...');
                redirect(base_url('HoteladminController/sendDepartment'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/sendDepartment'));
            }
        }
	public function sendDepartment()
{   
	$userType = $this->session->userdata('userType');
	$admin_id = $this->session->userdata('u_id');
	$wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    
  	$admin_id = $get_hotel_id['u_id']; 
	
	$guest_mng["list"] = $this->HotelAdminModel->get_notifications_pagination($admin_id);
    $guest_mng['hotel_admin_panels'] = $this->HotelAdminModel->get_admin_panel_list($admin_id);
	$this->load->view('include/header');
	$this->load->view('hoteladmin/viewSendDepartmentList', $guest_mng);
	$this->load->view('include/footer');
	
}


//request reject .//3-11-2022 //archana
        public function reject_enquiry_request()
        {
            //$hotel_enquiry_request_id = $this->uri->segemnt(3);
            $hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');
			$admin_id = $this->session->userdata('u_id');

            $wh = '(hotel_enquiry_request_id = "'.$hotel_enquiry_request_id.'")';

            $arr = array(
                        'request_status' => 2,
                        'reject_date' => date('Y-m-d'),
                        'request_reject_by' => 1,
                        'request_reject_by_u_id' => $admin_id,
                        );

            $up = $this->HotelAdminModel->edit_data('hotel_enquiry_request',$wh,$arr);

            if($up)
            {
                
                $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id);
                $this->load->view('hoteladmin/ajax', $guest_mng);
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('enquiry_request'));
            }
        }
		public function reject_enquiry_request1()
        {
            $hotel_enquiry_request_id = $this->uri->segment(3);
            // $hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');
			$admin_id = $this->session->userdata('u_id');
// print_r($this->uri->segment(3));die;
            $wh = '(hotel_enquiry_request_id = "'.$hotel_enquiry_request_id.'")';

            $arr = array(
                        'request_status' => 2,
                        'reject_date' => date('Y-m-d'),
                        'request_reject_by' => 1,
                        'request_reject_by_u_id' => $admin_id,
                        );

            $up = $this->HotelAdminModel->edit_data('hotel_enquiry_request',$wh,$arr);

            if($up)
            {
                
                $this->session->set_flashdata('msg','Request rejected');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }


        public function accept_cloakroom_service_request()
        {
			$admin_id = $this->session->userdata('u_id');

            $luggage_request_id = $this->uri->segment(3);

            $wh = '(luggage_request_id = "'.$luggage_request_id.'")';

            $arr = array(
                            'request_status' => 1,
                            'assign_by' => 1,
                            'assign_by_u_id' => $admin_id,
                        );

            $up = $this->HotelAdminModel->edit_data('luggage_request',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Request accepted successfully');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }

        public function edit_luggage_charges()
        {
            $luggage_type = $this->input->post('luggage_type');
            $charges = $this->input->post('charges');

            $luggage_charge_id = $this->input->post('luggage_charge_id');

            $wh = '(luggage_charge_id = "'.$luggage_charge_id.'")';

            $arr = array(
                            'luggage_type' => $luggage_type,
                            'charges' => $charges,
                        );

            $up = $this->HotelAdminModel->edit_data('luggage_charges',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Data Updated Successfully');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }

        public function delete_luggage_charge()
        {
            $luggage_charge_id = $this->input->post('id');
            
            $wh = '(luggage_charge_id = "'.$luggage_charge_id.'")';

            $del = $this->HotelAdminModel->delete_data('luggage_charges',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
        public function add_luggage_charges()
        {
            $luggage_type = $this->input->post('luggage_type');
            $charges = $this->input->post('charges');

            $admin_id = $this->session->userdata('u_id');

            $wh = '(luggage_type = "'.$luggage_type.'" AND hotel_id = "'.$admin_id.'")';

            $luggage_charges_data = $this->HotelAdminModel->getData('luggage_charges',$wh);

            if($luggage_charges_data)
            {
                $this->session->set_flashdata('msg','Data Already Exits');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $arr = array(
                                'hotel_id' => $admin_id,
                                'luggage_type' => $luggage_type,
                                'charges' => $charges,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                            );

                $add = $this->HotelAdminModel->insert_data('luggage_charges',$arr);

                if($add)
                {
                    $this->session->set_flashdata('msg','Luggage charges Added Successfully');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
        }


        //2-11-2022 //archana
        public function reject_cloakroom_service_request()
        {
			$admin_id = $this->session->userdata('u_id');

            $luggage_request_id = $this->uri->segment(3);

            $wh = '(luggage_request_id = "'.$luggage_request_id.'")';

            $arr = array(
                            'request_status' => 2,
                            'assign_by' => 1,
                            'assign_by_u_id' => $admin_id,
                        );

            $up = $this->HotelAdminModel->edit_data('luggage_request',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Request rejected successfully');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
        public function delete_expenses()
        {
            $expense_id = $this->input->post('id');
            
            $wh = '(expense_id = "'.$expense_id.'")';

            $del = $this->HotelAdminModel->delete_data('expenses',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
        public function add_floor()
        {
            $admin_id = $this->session->userdata('u_id');

            $floor = $this->input->post('floor');

            $wh = '(hotel_id = "'.$admin_id.'" AND floor = "'.$floor.'")';

            $floor_data = $this->HotelAdminModel->getData('floors',$wh);

            if($floor_data)
            {
                $this->session->set_flashdata('msg','Floor already exists..');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $arr =  array(
                              'hotel_id' => $admin_id,
                              'floor' => $floor,
                              'added_by' => 1,
                              'added_by_u_id' => $admin_id,
                            );

                $add = $this->HotelAdminModel->insert_data('floors',$arr);

                if($add)
                {
                    $this->session->set_flashdata('msg','Floor added Successfully..');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
        }
        public function add_expenses()
        {
            $guest_name = $this->input->post('guest_name');
            $mobile_no = $this->input->post('mobile_no');
            $expense_amt = $this->input->post('expense_amt');
            $date = $this->input->post('date');
            $description = $this->input->post('description');
            $booking_id = $this->input->post('booking_id');
            
			$admin_id = $this->session->userdata('u_id');

            $user_data = $this->HotelAdminModel->get_user_data_by_no($mobile_no);

            if($user_data)
            {
                $arr = array(
                                'hotel_id' => $admin_id,
                                'booking_id' => $booking_id,
                                'u_id' => $user_data['u_id'],
                                'guest_name' => $guest_name,
                                'mobile_no' => $mobile_no,
                                'expense_amt' => $expense_amt,
                                'date' => $date,
                                'description' => $description,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                            );

                $add = $this->HotelAdminModel->insert_data('expenses',$arr);

                if($add)
                {
                    $this->session->set_flashdata('msg','Data Added Successfully');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
            else
            {
                $this->session->set_flashdata('msg','Mobile number not registerd');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }

	public function sendUserNoti()
{   
	$userType = $this->session->userdata('userType');
	$admin_id = $this->session->userdata('u_id');
	$wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    
  	$admin_id = $get_hotel_id['u_id']; 
	
	$guest_mng["list"] = $this->HotelAdminModel->get_admin_sent_user_notifications_pagination($admin_id);
    $guest_mng['user_list'] = $this->HotelAdminModel->get_user_list_by_hotels($admin_id);

	$this->load->view('include/header');
	$this->load->view('hoteladmin/viewSendUserNotiList', $guest_mng);
	$this->load->view('include/footer');
	
}
public function sent_notification_to_users()
{
    $send_to = $this->input->post('send_to');
    $users = $this->input->post('users');
    $notification_type = $this->input->post('notification_type');
    $title = $this->input->post('title');
    $description = $this->input->post('description');

    $admin_id = $this->session->userdata('u_id');
    
    if($send_to == "all")
    {
        $send_to1 = 1;
    }
    else
    {
        $send_to1 = 2;
    }


    $send_for = 3;
    
    $arr = array(
                'send_to' => $send_to1,
                'send_for' => $send_for,
                'notification_type' => $notification_type,
                'title' => $title,
                'description' => strip_tags($description),
                'send_by' => 2,
                'send_by_id' => $admin_id,
            );

    $add = $this->HotelAdminModel->insert_data('notifications',$arr);

    if($add)
    {
        if($send_to1 == 2)
        {
            $count = count($users);

            for($i = 0;$i < $count;$i++)
            {
                $arr1 = array(
                            'notification_id' => $add,
                            'user_id' => $users[$i]
                            );

                $add_u_nt = $this->HotelAdminModel->insert_data('notifictions_u_id',$arr1);

                if($add_u_nt)
                {
                    $arr_u_nt = array(
                                        'u_id' => $users[$i],
                                        'hotel_id' => $admin_id,
                                        'subject' => $title,
                                        'description' => $description,
                                        'clear_flag' => 1,
                                        'count_flag' => 1,
                                    );

                    $this->HotelAdminModel->insert_data('user_notification',$arr_u_nt);
                }
            }
        }
        else
        {
            $user_list = $this->HotelAdminModel->get_user_list_of_particular_hotel($admin_id);

            if($user_list)
            {
                foreach($user_list as $u_l)
                {
                    $arr_nt = array(
                                'notification_id' => $add,
                                'user_id' => $u_l['u_id']
                                );

                    $add_u_nt_1 = $this->HotelAdminModel->insert_data('notifictions_u_id',$arr_nt);

                    if($add_u_nt_1)
                    {
                        $arr_u_nt_1 = array(
                                            'u_id' => $u_l['u_id'],
                                            'hotel_id' => $admin_id,
                                            'subject' => $title,
                                            'description' => $description,
                                            'clear_flag' => 1,
                                            'count_flag' => 1,
                                            );

                        $this->HotelAdminModel->insert_data('user_notification',$arr_u_nt_1);
                    }
                }
            }
            
        }

        $this->session->set_flashdata('msg','Sent Notification to Users Successfully...');
        redirect(base_url('HoteladminController/sendUserNoti'));
    }
    else
    {
        $this->session->set_flashdata('msg','Something went wrong');
        redirect(base_url('HoteladminController/sendUserNoti'));
    }
}

	public function privacyPolicy()
{   
	$userType = $this->session->userdata('userType');
	$admin_id = $this->session->userdata('u_id');
	$wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    
  	$admin_id = $get_hotel_id['u_id']; 
	
	$guest_mng["data"] = $this->HotelAdminModel->get_hotel_privacy_policy($admin_id);
	$this->load->view('include/header');
	$this->load->view('hoteladmin/viewPrivacyPolicyList', $guest_mng);
	$this->load->view('include/footer');
	
}

	public function faqList()
{   
	$userType = $this->session->userdata('userType');
	$admin_id = $this->session->userdata('u_id');
	$wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    
  	$admin_id = $get_hotel_id['u_id']; 
	
	$guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
	$this->load->view('include/header');
	$this->load->view('hoteladmin/viewFaqList', $guest_mng);
	$this->load->view('include/footer');
	
}

public function frontOfficeList()
{   
	$userType = $this->session->userdata('userType');
	$admin_id = $this->session->userdata('u_id');
	$wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    
  	$admin_id = $get_hotel_id['u_id']; 
	$user_type = 9;
	//$guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
	$order_status = 0;
	$housekeeping_new_order["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id,$order_status);
	$housekeeping_new_order['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);


	$this->load->view('include/header');
	$this->load->view('hoteladmin/viewFrontOfficeList', $housekeeping_new_order);
	$this->load->view('include/footer');
	
}

public function HouseKeepingList()
{   
	$userType = $this->session->userdata('userType');
	$admin_id = $this->session->userdata('u_id');
	$wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    
  	$admin_id = $get_hotel_id['u_id']; 
	$user_type = 9;
	//$guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
	$order_status = 0;
	$housekeeping_new_order["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id,$order_status);
	$housekeeping_new_order['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);


	$this->load->view('include/header');
	$this->load->view('hoteladmin/ViewHouseKeepingList', $housekeeping_new_order);
	$this->load->view('include/footer');
	
}

public function FoodBeberageList()
{   
	$userType = $this->session->userdata('userType');
	$admin_id = $this->session->userdata('u_id');
	$wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    
  	$admin_id = $get_hotel_id['u_id']; 
	$user_type = 9;
	//$guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
	$order_status = 0;
	$housekeeping_new_order["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id,$order_status);
	$housekeeping_new_order['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);


	$this->load->view('include/header');
	$this->load->view('hoteladmin/ViewFoodBeberageList', $housekeeping_new_order);
	$this->load->view('include/footer');
	
}



public function RoomServiceList()
{   
	$userType = $this->session->userdata('userType');
	$admin_id = $this->session->userdata('u_id');
	$wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    
  	$admin_id = $get_hotel_id['u_id']; 
	$user_type = 9;
	//$guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
	$order_status = 0;
	$housekeeping_new_order["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id,$order_status);
	$housekeeping_new_order['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);


	$this->load->view('include/header');
	$this->load->view('hoteladmin/ViewRoomServiceList', $housekeeping_new_order);
	$this->load->view('include/footer');
	
}

	public function enquiry_request()
{   
	$userType = $this->session->userdata('userType');
	$admin_id = $this->session->userdata('u_id');
	$wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    
  	$admin_id = $get_hotel_id['u_id']; 
	
	$guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id);
	$this->load->view('include/header');
	$this->load->view('hoteladmin/viewEnquiryRequestList', $guest_mng);
	$this->load->view('include/footer');
}

public function orderManageList()
{
	$userType = $this->session->userdata('userType');
	$admin_id = $this->session->userdata('u_id');
	$wh_admin = '(u_id ="'.$admin_id.'")';
    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
    
  	$admin_id = $get_hotel_id['u_id']; 
	
	//$guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
	$guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id);
	$this->load->view('include/header');
	$this->load->view('hoteladmin/vieworderManageList', $guest_mng);
	$this->load->view('include/footer');
}
public function assign_room_type()
{
    $room_type = $this->input->post('status');
   //  $room_type_name = $this->input->post('room_type_name');
    $hotel_enquiry_request_id  = $this->input->post('id');

    $wh1 = '(room_type_id  = "'.$room_type.'")';
    $room_type_name = $this->HotelAdminModel->getData($tbl='room_type',$wh1);
    
    $r_name=$room_type_name['room_type_name'];

    $wh = '(hotel_enquiry_request_id  = "'.$hotel_enquiry_request_id.'")';

    $arr = array(
                    'room_type' => $room_type,
                    'room_type_name' => $r_name
                );
    
    $update = $this->HotelAdminModel->edit_data('hotel_enquiry_request',$wh,$arr);

    if($update)
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
}

        public function add_faq()
        {
            $question = $this->input->post('question');
            $answer = $this->input->post('answer');
            
            $admin_id = $this->session->userdata('u_id');

            $arr1 = array(
                        'hotel_id' => $admin_id,
                        'question' => $question,
                        'answer' => $answer,
                        'is_active' => 1,
                        );

            $add = $this->HotelAdminModel->insert_data('faq',$arr1);

            if($add)
            {
            	$admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
			    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			    
			  	$admin_id = $get_hotel_id['u_id']; 
                $guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);

				$this->load->view('hoteladmin/ajaxFaqList', $guest_mng);
            }
            
        }

		public function ajaxIconBlockView()
		{
			$postArr = $this->input->post();
			$userType = $this->session->userdata('userType');
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$guest_mng['icon_id'] = $postArr['data_id'];
			$guest_mng['sub_section_icon_id'] = $postArr['sub_section_id'];
			$admin_id = $get_hotel_id['u_id']; 
			if($postArr['data_id'] == 1){
             
                $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id);
                $guest_mng["list1"] = $this->HotelAdminModel->get_hotel_enquiry_accepted_request_pagination($admin_id);
                $guest_mng["list2"] = $this->HotelAdminModel->get_hotel_enquiry_rejected_request_pagination($admin_id);
               
                
			}else if($postArr['data_id'] == 2){
				$guest_mng["floor_list"] = $this->HotelAdminModel->get_floor_list_pagination($admin_id);
			}else if($postArr['data_id'] == 3){
				$guest_mng["floor_list"] = $this->HotelAdminModel->get_floor_list_pagination($admin_id);
			}else if($postArr['data_id'] == 4){
				$guest_mng["list"] = $this->HotelAdminModel->get_floor_list_pagination($admin_id);
			}else if($postArr['data_id'] == 5){
				$guest_mng["list"] = $this->HotelAdminModel->get_room_type_list_pagination($admin_id);
			}else if($postArr['data_id'] == 6){
                $room_type = 1;
				$guest_mng['room_type'] = $this->HotelAdminModel->get_room_type_list1($admin_id);
		        $guest_mng['floor_list'] = $this->HotelAdminModel->get_floor_list($admin_id);
                $guest_mng['room_type_data'] = $this->HotelAdminModel->get_room_type_data($admin_id);

                $guest_mng['list'] = $this->HotelAdminModel->get_room_related_data($admin_id,$room_type);
    
                $guest_mng['floor_list1'] = $this->HotelAdminModel->get_floor_list($admin_id);
			}else if($postArr['data_id'] == 7){
				$guest_mng["list"] = $this->HotelAdminModel->get_business_center_pagination($admin_id);
			}else if($postArr['data_id'] == 8){
                
				$guest_mng["list"] = $this->HotelAdminModel->get_business_center_list_pagination($admin_id);
                $guest_mng['business_center'] = $this->HotelAdminModel->get_active_business_center($admin_id);
			}else if($postArr['data_id'] == 9){
				
				
				 $guest_mng["list"] = [];
			}else if($postArr['data_id'] == 10){
			
				if($guest_mng['sub_section_icon_id'] == 1){
					$service_name = 1;
					$guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
				}
			
				
				// $guest_mng["list"] = [];
			}else if($postArr['data_id'] == 11){
				$guest_mng["list"] = $this->HotelAdminModel->get_lost_found_pagination($admin_id);
			}else if($postArr['data_id'] == 12){
				$guest_mng["list"] = $this->HotelAdminModel->get_user_expense_pagination($admin_id);
			}else if($postArr['data_id'] == 13){
				$guest_mng["list"] = $this->HotelAdminModel->get_visitor_pagination($admin_id);
			}else if($postArr['data_id'] == 14){
				$guest_mng["list"] = $this->HotelAdminModel->get_visitor_pagination($admin_id);
			}else if($postArr['data_id'] == 15){
				$guest_mng["list"] = $this->HotelAdminModel->get_visitor_pagination($admin_id);
			}
            // print_r($guest_mng);die;
			$this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);	
		
		}

        public function assign_room_serv_services_order_to_staff()
        {
            $rmservice_services_order_id = $this->input->post('rmservice_services_order_id');
            $order_status = $this->input->post('order_status');
            
            $rand_no = rand('1111','9999');

            $wh = '(rmservice_services_order_id = "'.$rmservice_services_order_id.'")';

            $rs_s_order_data = $this->HotelAdminModel->getData('rmservice_services_orders',$wh);

            if($order_status == 1)
            {
                $staff_id = $this->input->post('staff_id');
                $accept_date = date('Y-m-d');
                $reject_date = "";
                $otp = $rand_no;
            }
            else
            {
                $staff_id = 0;
                $accept_date = "";
                $otp = "";
                $reject_date = date('Y-m-d');
            }

            $arr = array(
                         'order_status' => $order_status,
                         'staff_id' => $staff_id,
                         'accept_date' => $accept_date,
                         'reject_date' => $reject_date,
                         'otp' => $otp,
                        );

            $up = $this->HotelAdminModel->edit_data('rmservice_services_orders',$wh,$arr);

            if($up)
            {
                if($order_status == 1)
                {
                    $wh1 = '(room_service_unique_id = "'.$rs_s_order_data['room_service_unique_id'].'")';

                    $arr_rs = array(
                                    'order_status' => $order_status,
                                    'staff_id' => $staff_id,
                                    'accept_date' => $accept_date,
                                    'reject_date' => $reject_date,
                                    'otp' => $otp,
                                );

                    $this->HotelAdminModel->edit_data('room_service_menu_orders',$wh1,$arr);

                    $this->session->set_flashdata('msg','Order Accepted successfully');
                    redirect(base_url('HoteladminController/order_management'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Order Rejected');
                    redirect(base_url('HoteladminController/order_management'));
                }
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/order_management'));
            }
        }
        
        public function assign_food_order_to_staff()
        {
            $food_order_id = $this->input->post('food_order_id');
            $order_status = $this->input->post('order_status');
            
            $rand_no = rand('1111','9999');

            $wh = '(food_order_id = "'.$food_order_id.'")';

            if($order_status == 1)
            {
                $staff_id = $this->input->post('staff_id');
                $accept_date = date('Y-m-d');
                $reject_date = "";
                $otp = $rand_no;
            }
            else
            {
                $staff_id = 0;
                $accept_date = "";
                $otp = "";
                $reject_date = date('Y-m-d');
            }

            $arr = array(
                         'order_status' => $order_status,
                         'staff_id' => $staff_id,
                         'accept_date' => $accept_date,
                         'reject_date' => $reject_date,
                         'otp' => $otp,
                        );

            $up = $this->HotelAdminModel->edit_data('food_orders',$wh,$arr);

            if($up)
            {
                if($order_status == 1)
                {
                    $this->session->set_flashdata('msg','Order Accepted successfully');
                    redirect(base_url('HoteladminController/order_management'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Order Rejected');
                    redirect(base_url('HoteladminController/order_management'));
                }
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/order_management'));
            }
        }

        public function assign_laundry_order_to_staff()
        {
            $cloth_order_id = $this->input->post('cloth_order_id');
            $order_status = $this->input->post('order_status');

            $rand_no = rand(1111,9999);
            
            $wh = '(cloth_order_id = "'.$cloth_order_id.'")';

            $order_data = $this->HotelAdminModel->getData('cloth_orders',$wh);

            if($order_status == 1)
            {
                $staff_id = $this->input->post('staff_id');
                $accept_date = date('Y-m-d');
                $reject_date = "";
                $otp = $rand_no;
            }
            else
            {
                $staff_id = 0;
                $accept_date = "";
                $otp = 0;
                $reject_date = date('Y-m-d');
            }

            $arr = array(
                         'order_status' => $order_status,
                         'staff_id' => $staff_id,
                         'accept_date' => $accept_date,
                         'reject_date' => $reject_date,
                         'otp' => $otp
                        );

            $up = $this->HotelAdminModel->edit_data('cloth_orders',$wh,$arr);

            if($up)
            {
                if($order_status == 1)
                {
                    $subject = "OTP for laundry Order";

                    $description = "Your OTP for Order ID :".$cloth_order_id." is ".$otp;

                    $arr1 = array(
                                    'u_id' => $order_data['u_id'],
                                    'hotel_id' => $order_data['hotel_id'],
                                    'subject' => $subject,
                                    'description' => $description,
                                );

                    $this->HotelAdminModel->insert_data('user_notification',$arr1);

                    $this->session->set_flashdata('msg','Order Accepted successfully');
                    redirect(base_url('HoteladminController/order_management'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Order Rejected');
                    redirect(base_url('HoteladminController/order_management'));
                }
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/order_management'));
            }
        }

        public function ajaxOrderIconView()
		{
			$postArr = $this->input->post();
			$userType = $this->session->userdata('userType');
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$guest_mng['icon_id'] = $postArr['data_id'];
			$guest_mng['sub_section_icon_id'] = $postArr['sub_section_id'];
			$admin_id = $get_hotel_id['u_id']; 
			if($postArr['data_id'] == 1){
             
                $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id);
                $guest_mng["list1"] = $this->HotelAdminModel->get_hotel_enquiry_accepted_request_pagination($admin_id);
                $guest_mng["list2"] = $this->HotelAdminModel->get_hotel_enquiry_rejected_request_pagination($admin_id);
               
                
			}else if($postArr['data_id'] == 2){
            $order_status = 0;
			$user_type = 9;
            $guest_mng["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id,$order_status);
            $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);
            $guest_mng["list1"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id,1);
            $guest_mng["list2"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id,2);
            $guest_mng["list3"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id,3);

			}else if($postArr['data_id'] == 3){
            $user_type = 8;
			$order_status = 0;
            $guest_mng["list"] = $this->HotelAdminModel->get_food_order_pagination($admin_id,$order_status);
            $guest_mng["list1"] = $this->HotelAdminModel->get_food_order_pagination($admin_id,1);
            $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);
            $guest_mng["list2"] = $this->HotelAdminModel->get_food_order_pagination($admin_id,2);
            $guest_mng["list3"] = $this->HotelAdminModel->get_food_order_pagination($admin_id,3);


			}else if($postArr['data_id'] == 4){
                $order_status = 0;
            $user_type = 9;
            $guest_mng["list"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id,$order_status);
            $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);
            $guest_mng["list1"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id,1);
            $guest_mng["list2"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id,2);
            $guest_mng["list3"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id,3);



			}
           $this->load->view('hoteladmin/ajaxOrderIconView', $guest_mng);	
		
		}
        public function delete_house_keeping_service()
        {
            $h_k_services_id = $this->input->post('id');
            
            $wh = '(h_k_services_id = "'.$h_k_services_id.'")';

            $del = $this->HotelAdminModel->delete_data('house_keeping_services',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
        public function get_id_data()
        {
            $room_type=$this->input->post('id');
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
            $admin_id = $get_hotel_id['u_id']; 
            $guest_mng['list'] = $this->HotelAdminModel->get_room_related_data($admin_id,$room_type);
            $guest_mng['room_type'] = $this->HotelAdminModel->get_room_type_list1($admin_id);
            $guest_mng['floor_list'] = $this->HotelAdminModel->get_floor_list($admin_id);
            $guest_mng['icon_id'] = 6;
            $this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);	
        }
        public function ajaxHousekeepingIcon()
		{
			$postArr = $this->input->post();
			$userType = $this->session->userdata('userType');
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$guest_mng['icon_id'] = $postArr['data_id'];
			$admin_id = $get_hotel_id['u_id']; 
			if($postArr['data_id'] == 1){
            $guest_mng["list"] = $this->HotelAdminModel->get_cloth_list_pagination($admin_id);
             $guest_mng['laundry_time'] = $this->HotelAdminModel->get_laundry_time($admin_id);
			}else if($postArr['data_id'] == 2){
				$guest_mng["list"] = $this->HotelAdminModel->get_housekeeping_services_list_pagination($admin_id);
			}else if($postArr['data_id'] == 3){
			
            $hotel_id = $this->session->userdata('u_id');
            $date = date('Y-m-d');  
          
          	//get dirty rooms
			$wh = '(room_status = 1 AND hotel_id ="'.$hotel_id.'")';
			$guest_mng['get_dirty_rooms'] = $this->HotelAdminModel->getAllData('room_status',$wh);

			//get accupied rooms
			$wh1 = '(room_status = 2 AND hotel_id ="'.$hotel_id.'")';
			$guest_mng['get_accupied_rooms'] = $this->HotelAdminModel->getAllData('room_status',$wh1);

			//get available rooms
			
			$guest_mng['get_available_rooms'] = $this->HotelAdminModel->get_daily_report_available_rooms($date,$hotel_id);
			//print_r($data['get_available_rooms']); die;
          
			//get under maintainance rooms
			$wh3 = '(room_status = 4 AND hotel_id ="'.$hotel_id.'")';
			$guest_mng['get_under_maintenance_rooms'] = $this->HotelAdminModel->getAllData('room_status',$wh3);
			}
			$this->load->view('hoteladmin/ajaxHousekeepingIcon', $guest_mng);	
		
		}
        public function delete_room_service_minibar()
        {
            $r_s_min_bar_id = $this->input->post('id');
            
            $wh = '(r_s_min_bar_id = "'.$r_s_min_bar_id.'")';

            $del = $this->HotelAdminModel->delete_data('room_servs_mini_bar',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
        public function delete_room_service_cat()
        {
            $room_servs_category_id = $this->input->post('id');
            
            $wh = '(room_servs_category_id = "'.$room_servs_category_id.'")';

            $del = $this->HotelAdminModel->delete_data('room_servs_category',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }


        public function order_management()
	{
        // echo 'hi';die;
		if($this->session->userdata('u_id'))
		{
            $this->load->view('include/header');
            $this->load->view('hoteladmin/viewOrderManagement');
	        $this->load->view('include/footer');
			
		}
		else
		{
			redirect(base_url());
		}
	}
        public function ajaxRoomServiceIcon()
		{
			$postArr = $this->input->post();
			$userType = $this->session->userdata('userType');
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$guest_mng['icon_id'] = $postArr['data_id'];
			$admin_id = $get_hotel_id['u_id']; 
			if($postArr['data_id'] == 1){
                
            $guest_mng["list"] = $this->HotelAdminModel->room_service_list_pagination($admin_id);
            // print_r($guest_mng["list"]);die;
             }else if($postArr['data_id'] == 2){
				$guest_mng['room_servs_cat_list'] = $this->HotelAdminModel->get_room_service_cat_list($admin_id);
                $guest_mng['list'] = $this->HotelAdminModel->get_room_service_cat_list($admin_id);
                
			}else if($postArr['data_id'] == 3){
                $guest_mng["list"] = $this->HotelAdminModel->room_service_minibar_pagination($admin_id);

           }
         
			$this->load->view('hoteladmin/ajaxRoomServiceIcon', $guest_mng);	
		
		}

        public function delete_room_service_menu()
        {
            $room_serv_menu_id = $this->input->post('id');
            
            $wh = '(room_serv_menu_id = "'.$room_serv_menu_id.'")';

            $del = $this->HotelAdminModel->delete_data('room_serv_menu_list',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
        public function add_room_service_menus()
        {
            $room_servs_category_id = $this->input->post('room_servs_category_id');
            $menu_name = $this->input->post('menu_name');
            $price = $this->input->post('price');
            $prepartion_time = $this->input->post('prepartion_time');
            $time_in = $this->input->post('time_in');
            $offer_in_per = $this->input->post('offer_in_per');
            $details = $this->input->post('details');
            // print_r($this->input->post());die;
            $admin_id = $this->session->userdata('u_id');
            
            $wh = '(menu_name = "'.ucwords($menu_name).'" AND hotel_id = "'.$admin_id.'")';

            $room_serv_menu_list = $this->HotelAdminModel->getData('room_serv_menu_list',$wh);

            $discount_price = ($price *$offer_in_per)/100;

            $total_price = $price - $discount_price;

            if($room_serv_menu_list)
            {
                $this->session->set_flashdata('msg','This Menu already exits..');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
            else
            {
                $_FILES['my_file']['name'] = $_FILES['image']['name'];
                $_FILES['my_file']['type'] = $_FILES['image']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['image']['size'];
                $_FILES['my_file']['error'] = $_FILES['image']['error'];

                $path = 'assets/upload/room_service_menu_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $image = base_url().$path.$file_data['file_name'];

                    $arr = array(
                                'hotel_id' => $admin_id,
                                'menu_name' => ucwords($menu_name),
                                'room_serv_cat_id' => $room_servs_category_id,
                                'price' => $price,
                                'prepartion_time' => $prepartion_time,
                                'time_in' => $time_in,
                                'details' => $details,
                                'offer_in_per' => $offer_in_per,
                                'total_price' => $total_price,
                                'image' => $image,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                                );

                    $add = $this->HotelAdminModel->insert_data('room_serv_menu_list',$arr);

                    if($add)
                    {
                        $this->session->set_flashdata('msg','Data Added Successfully...');
                        redirect(base_url('HoteladminController/RoomServiceList'));
                    }
                    else
                    {
                        $this->session->set_flashdata('msg','Something went wrong');
                        redirect(base_url('HoteladminController/RoomServiceList'));
                    }
                }
                else
                {
                    $this->session->set_flashdata('msg','Error to upload image');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                }
            }
        }

        public function edit_room_service_cat()
        {
            $category_name = $this->input->post('category_name');

            $room_servs_category_id = $this->input->post('room_servs_category_id');

            $wh = '(room_servs_category_id = "'.$room_servs_category_id.'")';

            $room_servs_category = $this->HotelAdminModel->getData('room_servs_category',$wh);

            if(!empty($_FILES['image']['name']))
            {
                $_FILES['my_file']['name'] = $_FILES['image']['name'];
                $_FILES['my_file']['type'] = $_FILES['image']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['image']['size'];
                $_FILES['my_file']['error'] = $_FILES['image']['error'];
    
                $path = 'assets/upload/room_service_cat_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $image = base_url().$path.$file_data['file_name'];
                }
            }
            else
            {
                $image = $room_servs_category['image'];
            }

            $arr = array(
                            'category_name' => ucwords($category_name),
                            'image' => $image,
                        );

            $up = $this->HotelAdminModel->edit_data('room_servs_category',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Data updated Successfully...');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
        }

        public function add_room_service_cat()
        {
            $category_name = $this->input->post('category_name');
            
            $admin_id = $this->session->userdata('u_id');
            
            $wh = '(category_name = "'.ucwords($category_name).'" AND hotel_id = "'.$admin_id.'")';

            $room_servs_category = $this->HotelAdminModel->getData('room_servs_category',$wh);

            if($room_servs_category)
            {
                $this->session->set_flashdata('msg','This category already exits..');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
            else
            {
                $_FILES['my_file']['name'] = $_FILES['image']['name'];
                $_FILES['my_file']['type'] = $_FILES['image']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['image']['size'];
                $_FILES['my_file']['error'] = $_FILES['image']['error'];

                $path = 'assets/upload/room_service_cat_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $image = base_url().$path.$file_data['file_name'];

                    $arr = array(
                                'hotel_id' => $admin_id,
                                'category_name' => ucwords($category_name),
                                'image' => $image,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                                );

                    $add = $this->HotelAdminModel->insert_data('room_servs_category',$arr);

                    if($add)
                    {
                        $this->session->set_flashdata('msg','Data Added Successfully...');
                        redirect(base_url('HoteladminController/RoomServiceList'));
                    }
                    else
                    {
                        $this->session->set_flashdata('msg','Something went wrong');
                        redirect(base_url('HoteladminController/RoomServiceList'));
                    }
                }
                else
                {
                    $this->session->set_flashdata('msg','Error to upload image');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                }
            }
        }


        public function edit_room_service_menu()
        {
            $menu_name = $this->input->post('menu_name');
            $price = $this->input->post('price');
            $offer_in_per = $this->input->post('offer_in_per');
            $prepartion_time = $this->input->post('prepartion_time');
            $time_in = $this->input->post('time_in');
            $details = $this->input->post('details');

            $room_serv_menu_id = $this->input->post('room_serv_menu_id');

            $wh = '(room_serv_menu_id = "'.$room_serv_menu_id.'")';

            $room_serv_menu_list = $this->HotelAdminModel->getData('room_serv_menu_list',$wh);

            $total_price = $room_serv_menu_list['total_price'];

            if($_POST['price'])
            {
                $discount_price = ($price * $offer_in_per)/100;

                $total_price = $price - $discount_price;
            }
            
            if(!empty($_FILES['image']['name']))
            {
                $_FILES['my_file']['name'] = $_FILES['image']['name'];
                $_FILES['my_file']['type'] = $_FILES['image']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['image']['size'];
                $_FILES['my_file']['error'] = $_FILES['image']['error'];
    
                $path = 'assets/upload/room_service_menu_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $image = base_url().$path.$file_data['file_name'];
                }
            }
            else
            {
                $image = $room_serv_menu_list['image'];
            }

            $arr = array(
                            'menu_name' => ucwords($menu_name),
                            'price' => $price,
                            'prepartion_time' => $prepartion_time,
                            'time_in' => $time_in,
                            'details' => $details,
                            'offer_in_per' => $offer_in_per,
                            'total_price' => $total_price,
                            'image' => $image,
                        );

            $up = $this->HotelAdminModel->edit_data('room_serv_menu_list',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Data updated Successfully...');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
        }

        public function add_room_services()
        {
            $service_name = $this->input->post('service_name');
            $amount = $this->input->post('amount');
            $additional_note = $this->input->post('additional_note');

            $admin_id = $this->session->userdata('u_id');

            $wh = '(service_name = "'.ucwords($service_name).'" AND hotel_id = "'.$admin_id.'")';

            $room_servs_services = $this->HotelAdminModel->getData('room_servs_services',$wh);

            if($room_servs_services)
            {
                $this->session->set_flashdata('msg','This service already exits..');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
            else
            {
                $_FILES['my_file']['name'] = $_FILES['icon_img']['name'];
                $_FILES['my_file']['type'] = $_FILES['icon_img']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['icon_img']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['icon_img']['size'];
                $_FILES['my_file']['error'] = $_FILES['icon_img']['error'];

                $path = 'assets/upload/room_service_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $icon_img = base_url().$path.$file_data['file_name'];

                    $arr = array(
                                'hotel_id' => $admin_id,
                                'service_name' => ucwords($service_name),
                                'amount' => $amount,
                                'icon_img' => $icon_img,
                                'additional_note' => $additional_note,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                                );

                    $add = $this->HotelAdminModel->insert_data('room_servs_services',$arr);

                    if($add)
                    {
                        $this->session->set_flashdata('msg','Data Added Successfully...');
                        redirect(base_url('HoteladminController/RoomServiceList'));
                    }
                    else
                    {
                        $this->session->set_flashdata('msg','Something went wrong');
                        redirect(base_url('HoteladminController/RoomServiceList'));
                    }
                }
                else
                {
                    $this->session->set_flashdata('msg','Error to upload image');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                }
            }
        }
 public function edit_room_service_minibar()
        {
            $item_name = $this->input->post('item_name');
            $price = $this->input->post('price');
            $description = $this->input->post('description');

            $r_s_min_bar_id = $this->input->post('r_s_min_bar_id');

            $wh = '(r_s_min_bar_id = "'.$r_s_min_bar_id.'")';

            $room_servs_mini_bar = $this->HotelAdminModel->getData('room_servs_mini_bar',$wh);

            if(!empty($_FILES['icon_img']['name']))
            {
                $_FILES['my_file']['name'] = $_FILES['icon_img']['name'];
                $_FILES['my_file']['type'] = $_FILES['icon_img']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['icon_img']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['icon_img']['size'];
                $_FILES['my_file']['error'] = $_FILES['icon_img']['error'];
    
                $path = 'assets/upload/room_service_minibar_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $icon_img = base_url().$path.$file_data['file_name'];
                }
            }
            else
            {
                $icon_img = $room_servs_mini_bar['icon_img'];
            }

            $arr = array(
                            'item_name' => ucwords($item_name),
                            'price' => $price,
                            'description' => $description,
                            'icon_img' => $icon_img,
                        );

            $up = $this->HotelAdminModel->edit_data('room_servs_mini_bar',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Data updated Successfully...');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
        }

        public function add_room_service_minibar()
        {
            $item_name = $this->input->post('item_name');
            $price = $this->input->post('price');
            $description = $this->input->post('description');
            
            $admin_id = $this->session->userdata('u_id');
            
            $wh = '(item_name = "'.ucwords($item_name).'" AND hotel_id = "'.$admin_id.'")';

            $room_servs_mini_bar = $this->HotelAdminModel->getData('room_servs_mini_bar',$wh);

            if($room_servs_mini_bar)
            {
                $this->session->set_flashdata('msg','This Minibar already exits..');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
            else
            {
                $_FILES['my_file']['name'] = $_FILES['icon_img']['name'];
                $_FILES['my_file']['type'] = $_FILES['icon_img']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['icon_img']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['icon_img']['size'];
                $_FILES['my_file']['error'] = $_FILES['icon_img']['error'];

                $path = 'assets/upload/room_service_minibar_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $icon_img = base_url().$path.$file_data['file_name'];

                    $arr = array(
                                'hotel_id' => $admin_id,
                                'item_name' => ucwords($item_name),
                                'price' => $price,
                                'description' => $description,
                                'icon_img' => $icon_img,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                                );

                    $add = $this->HotelAdminModel->insert_data('room_servs_mini_bar',$arr);

                    if($add)
                    {
                        $this->session->set_flashdata('msg','Data Added Successfully...');
                        redirect(base_url('HoteladminController/RoomServiceList'));
                    }
                    else
                    {
                        $this->session->set_flashdata('msg','Something went wrong');
                        redirect(base_url('HoteladminController/RoomServiceList'));
                    }
                }
                else
                {
                    $this->session->set_flashdata('msg','Error to upload image');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                }
            }
        }
        public function edit_room_services()
        {
            $service_name = $this->input->post('service_name');
            $amount = $this->input->post('amount');
            $additional_note = $this->input->post('additional_note');

            $r_s_services_id = $this->input->post('r_s_services_id');

            $wh = '(r_s_services_id = "'.$r_s_services_id.'")';

            $room_servs_services = $this->HotelAdminModel->getData('room_servs_services',$wh);

            if(!empty($_FILES['icon_img']['name']))
            {
                $_FILES['my_file']['name'] = $_FILES['icon_img']['name'];
                $_FILES['my_file']['type'] = $_FILES['icon_img']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['icon_img']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['icon_img']['size'];
                $_FILES['my_file']['error'] = $_FILES['icon_img']['error'];
    
                $path = 'assets/upload/room_service_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $icon_img = base_url().$path.$file_data['file_name'];
                }
            }
            else
            {
                $icon_img = $room_servs_services['icon_img'];
            }

            $arr = array(
                            'service_name' => ucwords($service_name),
                            'amount' => $amount,
                            'icon_img' => $icon_img,
                            'additional_note' => $additional_note
                        );

            $up = $this->HotelAdminModel->edit_data('room_servs_services',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Data updated Successfully...');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
        }

        public function delete_room_services()
        {
            $r_s_services_id = $this->input->post('id');
            
            $wh = '(r_s_services_id = "'.$r_s_services_id.'")';

            $del = $this->HotelAdminModel->delete_data('room_servs_services',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
        public function edit_food_facility()
        {
            $facility_name = $this->input->post('facility_name');
            $description = $this->input->post('description');

            $food_facility_id = $this->input->post('food_facility_id');

            $wh = '(food_facility_id = "'.$food_facility_id.'")';

            $food_facility = $this->HotelAdminModel->getData('food_facility',$wh);

            if(!empty($_FILES['icon']['name']))
            {
                $_FILES['my_file']['name'] = $_FILES['icon']['name'];
                $_FILES['my_file']['type'] = $_FILES['icon']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['icon']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['icon']['size'];
                $_FILES['my_file']['error'] = $_FILES['icon']['error'];
    
                $path = 'assets/upload/food_facility_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $icon = base_url().$path.$file_data['file_name'];
                }
            }
            else
            {
                $icon = $food_facility['icon'];
            }

            $arr = array(
                            'facility_name' => $facility_name,
                            'description' => $description,
                            'icon' => $icon,
                        );

            $up = $this->HotelAdminModel->edit_data('food_facility',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Data updated Successfully...');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
        }
        public function accept_reserve_order()
        {
            $reserve_table_id = $this->uri->segment(3);

            $wh = '(reserve_table_id = "'.$reserve_table_id.'")';

            $arr = array(
                          'request_status' => 1,
                          'accept_date' => date('Y-m-d'),
                        );

            $up = $this->HotelAdminModel->edit_data('reserve_table',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Request Accepted');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
        }

        public function reject_reserve_order()
        {
            $reserve_table_id = $this->uri->segment(3);

            $wh = '(reserve_table_id = "'.$reserve_table_id.'")';

            $arr = array(
                          'request_status' => 2,
                          'reject_date' => date('Y-m-d'),
                        );

            $up = $this->HotelAdminModel->edit_data('reserve_table',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Request Rejected');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
        }
        
        public function edit_food_menus()
        {
            $food_facility_id = $this->input->post('food_facility_id');
            $food_category_id = $this->input->post('food_category_id');
            $menus_for = $this->input->post('menus_for');
            $items_name = $this->input->post('items_name');
            $price = $this->input->post('price');
            $offer_in_per = $this->input->post('offer_in_per');
            $prepartion_time = $this->input->post('prepartion_time');
            $time_in = $this->input->post('time_in');
            $description = $this->input->post('description');

            $food_item_id = $this->input->post('food_item_id');

            $wh = '(food_item_id = "'.$food_item_id.'")';

            $food_menus = $this->HotelAdminModel->getData('food_menus',$wh);

            if(!empty($_FILES['item_img']['name']))
            {
                $_FILES['my_file']['name'] = $_FILES['item_img']['name'];
                $_FILES['my_file']['type'] = $_FILES['item_img']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['item_img']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['item_img']['size'];
                $_FILES['my_file']['error'] = $_FILES['item_img']['error'];

                $path = 'assets/upload/food_menu_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $item_img = base_url().$path.$file_data['file_name'];
                }
            }
            else
            {
                $item_img = $food_menus['item_img'];
            }

            $arr = array(
                        'food_facility_id' => $food_facility_id,
                        'food_category_id' => $food_category_id,
                        'menus_for' => $menus_for,
                        'items_name' => $items_name,
                        'price' => $price,
                        'offer_in_per' => $offer_in_per,
                        'prepartion_time' => $prepartion_time,
                        'time_in' => $time_in,
                        'description' => $description,
                        'item_img' => $item_img,
                        );

            $up = $this->HotelAdminModel->edit_data('food_menus',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Data updated Successfully...');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
        }


        public function add_food_menu()
        {
            $food_facility_id = $this->input->post('food_facility_id');
            $food_category_id = $this->input->post('food_category_id');
            $menus_for = $this->input->post('menus_for');
            $items_name = $this->input->post('items_name');
            $price = $this->input->post('price');
            $offer_in_per = $this->input->post('offer_in_per');
            $prepartion_time = $this->input->post('prepartion_time');
            $time_in = $this->input->post('time_in');
            $description = $this->input->post('description');

            $admin_id = $this->session->userdata('u_id');

            $discount_price = $price * ($offer_in_per/100);
            $dis_price = $price - $discount_price;

            $_FILES['my_file']['name'] = $_FILES['item_img']['name'];
            $_FILES['my_file']['type'] = $_FILES['item_img']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['item_img']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['item_img']['size'];
            $_FILES['my_file']['error'] = $_FILES['item_img']['error'];

            $path = 'assets/upload/food_menu_img/';
            $file_path = './'.$path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('my_file'))
            { 
                $file_data = $this->upload->data();

                $item_img = base_url().$path.$file_data['file_name'];

                $arr = array(
                            'hotel_id' => $admin_id,
                            'food_facility_id' => $food_facility_id,
                            'food_category_id' => $food_category_id,
                            'menus_for' => $menus_for,
                            'items_name' => $items_name,
                            'price' => $price,
                            'offer_in_per' => $offer_in_per,
                            'discount_price' => $dis_price,
                            'prepartion_time' => $prepartion_time,
                            'time_in' => $time_in,
                            'description' => $description,
                            'item_img' => $item_img,
                            //'added_by' => 1,
                            //'added_by_u_id' => $admin_id,
                            );

                $add = $this->HotelAdminModel->insert_data('food_menus',$arr);

                if($add)
                {
                    $this->session->set_flashdata('msg','Food menu Added Successfully...');
                    redirect(base_url('HoteladminController/FoodBeberageList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/FoodBeberageList'));
                }
            }
            else
            {
                $this->session->set_flashdata('msg','Error to upload image');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
        }
        
        //11-11-2022 // delete food menu//archana
        public function delete_food_menus()
        {
            $food_item_id = $this->input->post('id');
            
            $wh = '(food_item_id = "'.$food_item_id.'")';

            $del = $this->HotelAdminModel->delete_data('food_menus',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }


        public function add_food_category()
        {
            $food_facility_id = $this->input->post('food_facility_id');
            $category_name = $this->input->post('category_name');

            $admin_id = $this->session->userdata('u_id');

            $wh = '(food_facility_id = "'.$food_facility_id.'" AND category_name = "'.$category_name.'" AND hotel_id = "'.$admin_id.'")';

            $food_cat = $this->HotelAdminModel->getData('food_category',$wh);

            if($food_cat)
            {
                $this->session->set_flashdata('msg','This Category already exits..');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
            else
            {
                $arr = array(
                            'hotel_id' => $admin_id,
                            'food_facility_id' => $food_facility_id,
                            'category_name' => $category_name,
                            'added_by' => 1,
                            'added_by_u_id' => $admin_id,
                            );

                $add = $this->HotelAdminModel->insert_data('food_category',$arr);

                if($add)
                {
                    $this->session->set_flashdata('msg','Data Added Successfully...');
                    redirect(base_url('HoteladminController/FoodBeberageList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/FoodBeberageList'));
                }
            }
        }

        public function add_food_facility()
        {
            $facility_name = $this->input->post('facility_name');
            $description = $this->input->post('description');

            $admin_id = $this->session->userdata('u_id');

            $wh = '(facility_name = "'.$facility_name.'" AND hotel_id = "'.$admin_id.'")';

            $food_facility = $this->HotelAdminModel->getData('food_facility',$wh);

            if($food_facility)
            {
                $this->session->set_flashdata('msg','This Facility already exists..');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
            else
            {
                $_FILES['my_file']['name'] = $_FILES['icon']['name'];
                $_FILES['my_file']['type'] = $_FILES['icon']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['icon']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['icon']['size'];
                $_FILES['my_file']['error'] = $_FILES['icon']['error'];

                $path = 'assets/upload/food_facility_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $icon = base_url().$path.$file_data['file_name'];

                    $arr = array(
                                'hotel_id' => $admin_id,
                                'facility_name' => $facility_name,
                                'description' => $description,
                                'icon' => $icon,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                                );

                    $add = $this->HotelAdminModel->insert_data('food_facility',$arr);

                    if($add)
                    {
                        $this->session->set_flashdata('msg','Data Added Successfully...');
                        redirect(base_url('HoteladminController/FoodBeberageList'));
                    }
                    else
                    {
                        $this->session->set_flashdata('msg','Something went wrong');
                        redirect(base_url('HoteladminController/FoodBeberageList'));
                    }
                }
                else
                {
                    $this->session->set_flashdata('msg','Error to upload image');
                    redirect(base_url('HoteladminController/FoodBeberageList'));
                }
           	}
        }

        public function delete_food_facility()
        {
            $food_facility_id = $this->input->post('id');
            
            $wh = '(food_facility_id = "'.$food_facility_id.'")';

            $del = $this->HotelAdminModel->delete_data('food_facility',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }

        public function edit_cloth()
        {
            $cloth_name = $this->input->post('cloth_name');
            $price = $this->input->post('price');

            $cloth_id = $this->input->post('cloth_id');

            $wh = '(cloth_id = "'.$cloth_id.'")';

            $cloth = $this->HotelAdminModel->getData('cloth',$wh);

            if(!empty($_FILES['image']['name']))
            {
                $_FILES['my_file']['name'] = $_FILES['image']['name'];
                $_FILES['my_file']['type'] = $_FILES['image']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['image']['size'];
                $_FILES['my_file']['error'] = $_FILES['image']['error'];
    
                $path = 'assets/upload/cloth_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $image = base_url().$path.$file_data['file_name'];
                }
            }
            else
            {
                $image = $cloth['image'];
            }

            $arr = array(
                            'cloth_name' => ucwords($cloth_name),
                            'price' => $price,
                            'image' => $image,
                        );

            $up = $this->HotelAdminModel->edit_data('cloth',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Data updated Successfully...');
                redirect(base_url('HoteladminController/HouseKeepingList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/HouseKeepingList'));
            }
        }

        public function dirty_room_sts_update()
         {
            $room_status_id = $this->input->post('room_status_id');
            $room_status = $this->input->post('room_status');
			$date = date('Y-m-d h:i:s');
            if($room_status == 3) 
            {
                    $arr = array(
                                    'room_status' =>$room_status, 
                      				'created_at' => $date
                                );

                    $wh = '(room_status_id = "'.$room_status_id.'")';
                    $update = $this->HotelAdminModel->edit_data($tbl='room_status', $wh, $arr);
                    if ($update) 
                    {
                        $this->session->set_flashdata('msg', 'Success..!');
                        redirect(base_url('HoteladminController/HouseKeepingList'));
                    } 
                    else 
                    {
                        $this->session->set_flashdata('msg', 'Something went Wrong');
                        redirect(base_url('HoteladminController/HouseKeepingList'));
                    }
            }
            elseif($room_status == 4) 
            {
                    $arr = array(
                                    'room_status' =>$room_status,  
                                );

                    $wh = '(room_status_id = "'.$room_status_id.'")';
                    $update = $this->HotelAdminModel->edit_data($tbl='room_status', $wh, $arr);
                    if ($update) 
                    {
                        $this->session->set_flashdata('msg', 'Success..!');
                        redirect(base_url('HoteladminController/HouseKeepingList'));
                    } 
                    else 
                    {
                        $this->session->set_flashdata('msg', 'Something went Wrong');
                        redirect(base_url('HoteladminController/HouseKeepingList'));
                    }
            }

         }


         public function under_maintainance_room_sts_update()
         {
            $room_status_id = $this->input->post('room_status_id');
            $room_status = $this->input->post('room_status');
			$date = date('Y-m-d h:i:s');
            if($room_status) 
            {
                    $arr = array(
                                    'room_status' =>$room_status,  
                      				'created_at' => $date
                                );

                    $wh = '(room_status_id = "'.$room_status_id.'")';
                    $update = $this->HotelAdminModel->edit_data($tbl='room_status', $wh, $arr);
                    if ($update) 
                    {
                        $this->session->set_flashdata('msg', 'Success..!');
                        redirect(base_url('HoteladminController/HouseKeepingList'));
                    } 
                    else 
                    {
                        $this->session->set_flashdata('msg', 'Something went Wrong');
                        redirect(base_url('HoteladminController/HouseKeepingList'));
                    }
            }

         }
        public function add_housekeeping_service()
        { 
            
            $service_type = $this->input->post('service_type');
            $amount = $this->input->post('amount');

            $admin_id = $this->session->userdata('u_id');

            $wh = '(service_type = "'.ucwords($service_type).'" AND hotel_id = "'.$admin_id.'")';

            $house_keeping_services = $this->HotelAdminModel->getData('house_keeping_services',$wh);            

            if($house_keeping_services)
            {
                $this->session->set_flashdata('msg','This Service already exits..');
                redirect(base_url('HoteladminController/HouseKeepingList'));
            }
            else
            {
                $_FILES['my_file']['name'] = $_FILES['icon']['name'];
                $_FILES['my_file']['type'] = $_FILES['icon']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['icon']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['icon']['size'];
                $_FILES['my_file']['error'] = $_FILES['icon']['error'];

                $path = 'assets/upload/housekeeping_service_icon/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $icon = base_url().$path.$file_data['file_name'];

                    $arr = array(
                                'hotel_id' => $admin_id,
                                'service_type' => ucwords($service_type),
                                'amount' => $amount,
                                'icon' => $icon,
                                'is_active' => 1,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                                );

                    $add = $this->HotelAdminModel->insert_data('house_keeping_services',$arr);

                    if($add)
                    {
                        $this->session->set_flashdata('msg','Data Added Successfully...');
                        redirect(base_url('HoteladminController/HouseKeepingList'));
                    }
                    else
                    {
                        $this->session->set_flashdata('msg','Something went wrong');
                        redirect(base_url('HoteladminController/HouseKeepingList'));
                    }
                }
                else
                {
                    $this->session->set_flashdata('msg','Error to upload image');
                    redirect(base_url('HoteladminController/HouseKeepingList'));
                }
            }
        }



        public function edit_housekeeping_service()
        {
            $service_type = $this->input->post('service_type');
            $amount = $this->input->post('amount');

            $h_k_services_id = $this->input->post('h_k_services_id');

            $wh = '(h_k_services_id = "'.$h_k_services_id.'")';

            $house_keeping_services = $this->HotelAdminModel->getData('house_keeping_services',$wh);

            if(!empty($_FILES['icon']['name']))
            {
                $_FILES['my_file']['name'] = $_FILES['icon']['name'];
                $_FILES['my_file']['type'] = $_FILES['icon']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['icon']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['icon']['size'];
                $_FILES['my_file']['error'] = $_FILES['icon']['error'];
    
                $path = 'assets/upload/housekeeping_service_icon/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $icon = base_url().$path.$file_data['file_name'];
                }
            }
            else
            {
                $icon = $house_keeping_services['icon'];
            }

            $arr = array(
                            'service_type' => ucwords($service_type),
                            'amount' => $amount,
                            'icon' => $icon,
                        );

            $up = $this->HotelAdminModel->edit_data('house_keeping_services',$wh,$arr);

            if($up)
            {
                $this->session->set_flashdata('msg','Data updated Successfully...');
                redirect(base_url('HoteladminController/HouseKeepingList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/HouseKeepingList'));
            }
        }


        public function change_housekeeping_service_status()
        {
            $status = $this->input->post('status');
            $h_k_services_id = $this->input->post('id');

            $wh = '(h_k_services_id = "'.$h_k_services_id.'")';

            $arr = array(
                            'is_active' => $status
                        );
            
            $update = $this->HotelAdminModel->edit_data('house_keeping_services',$wh,$arr);

            if($update)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
        public function add_cloth()
        {
            $cloth_name = $this->input->post('cloth_name');
            $price = $this->input->post('price');

            $admin_id = $this->session->userdata('u_id');

            $wh = '(cloth_name = "'.ucwords($cloth_name).'" AND hotel_id = "'.$admin_id.'")';

            $cloth = $this->HotelAdminModel->getData('cloth',$wh);

            if($cloth)
            {
                $this->session->set_flashdata('msg','This Cloth already exits..');
                redirect(base_url('laundry_service'));
            }
            else
            {
                $_FILES['my_file']['name'] = $_FILES['image']['name'];
                $_FILES['my_file']['type'] = $_FILES['image']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['image']['size'];
                $_FILES['my_file']['error'] = $_FILES['image']['error'];

                $path = 'assets/upload/cloth_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_file'))
                { 
                    $file_data = $this->upload->data();

                    $image = base_url().$path.$file_data['file_name'];

                    $arr = array(
                                'hotel_id' => $admin_id,
                                'cloth_name' => ucwords($cloth_name),
                                'price' => $price,
                                'image' => $image,
                                'added_by' => 1,
                                'added_by_u_d' => $admin_id,
                                );

                    $add = $this->HotelAdminModel->insert_data('cloth',$arr);

                    if($add)
                    {
                        $this->session->set_flashdata('msg','Data Added Successfully...');
                        redirect(base_url('HoteladminController/HouseKeepingList'));
                    }
                    else
                    {
                        $this->session->set_flashdata('msg','Something went wrong');
                        redirect(base_url('HoteladminController/HouseKeepingList'));
                    }
                }
                else
                {
                    $this->session->set_flashdata('msg','Error to upload image');
                    redirect(base_url('HoteladminController/HouseKeepingList'));
                }
            }
        }

        public function set_laundry_picup_drop_time()
        {
            $pick_up_start_time = $this->input->post('pick_up_start_time');
            $pick_up_end_time = $this->input->post('pick_up_end_time');
            $drop_start_time = $this->input->post('drop_start_time');
            $drop_end_time = $this->input->post('drop_end_time');

            $admin_id = $this->session->userdata('u_id');

            $wh = '(hotel_id = "'.$admin_id.'")';

            $laundry_time = $this->HotelAdminModel->getData('laundry_time',$wh);
            
            $add = "";
            $up = "";
// print_r($laundry_time);die;
            if($laundry_time)
            {
                $arr_up = array(
                              'pick_up_start_time' => $pick_up_start_time,
                              'drop_start_time' => $drop_start_time,
                              'pick_up_end_time' => $pick_up_end_time,
                              'drop_end_time' => $drop_end_time,
                              'updated_by' => 1,
                              'updated_by_u_id' => $admin_id,
                            );
                
                $add = $this->HotelAdminModel->edit_data('laundry_time',$wh,$arr_up);
            }
            else
            {
                $arr_add = array(
                                'hotel_id' => $admin_id,
                                'pick_up_start_time' => $pick_up_start_time,
                                'drop_start_time' => $drop_start_time,
                                'pick_up_end_time' => $pick_up_end_time,
                                'drop_end_time' => $drop_end_time,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                            );
      
                $up = $this->HotelAdminModel->insert_data('laundry_time',$arr_add);
            }
            
            if($add || $up)
            {
                $this->session->set_flashdata('msg','Laundry time set Successfully...');
                redirect(base_url('HoteladminController/HouseKeepingList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/HouseKeepingList'));
            }
        }


        public function delete_cloth()
        {
            $cloth_id = $this->input->post('id');
            
            $wh = '(cloth_id = "'.$cloth_id.'")';

            $del = $this->HotelAdminModel->delete_data('cloth',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }


        public function update_rooms()
        {
            $floor_id = $this->input->post('floor_id');
            $room_type = $this->input->post('room_type'); 
            $price = $this->input->post('price');
            $room_details = $this->input->post('room_details');

            $room_img_id = $this->input->post('room_img_id',TRUE);

            $room_configure_id = $this->input->post('room_configure_id');

            $admin_id = $this->session->userdata('u_id');

            $wh = '(room_configure_id = "'.$room_configure_id.'")';

            $arr = array(
                            'floor_id' => $floor_id,
                            'room_type' => $room_type,
                            'room_details' => $room_details,
                            'price' => $price,
                        );
            
            $up = $this->HotelAdminModel->edit_data('room_configure',$wh,$arr);

            if($up)
            {
                //edit rooms no
                if(isset($_POST['room_no']))
                {
                    $del = $this->HotelAdminModel->delete_data('room_nos',$wh);

                    if($del)
                    {
                        $room_data = $_POST['room_no'];

                        $room_string = $room_data[0];
    
                        $room_arr = explode(",",$room_string);
    
                        foreach ($room_arr as $key => $value) 
                        {
                            $arr_rm = array(
                                            'hotel_id' => $admin_id,
                                            'room_configure_id' => $room_configure_id,
                                            'room_no' => $value,
                                            'added_by' => 1,
                                            'added_by_id' => $admin_id,
                                            );
    
                            
                            $add_room_no = $this->HotelAdminModel->insert_data('room_nos',$arr_rm);
                            
                            if($add_room_no)
                            {
                                $arr_rm = array(
                                                'hotel_id' => $admin_id,
                                                'room_no' => $value,
                                                'room_status' => 3,
                                                'added_by' => 1,
                                                'added_by_u_id' => $admin_id,
                                                );

                                $this->HotelAdminModel->insert_data('room_status',$arr_rm);

                            }
                        }
                    }
                }

                //edit facility
                if(isset($_POST['facility']))
                {
                    $del1 = $this->HotelAdminModel->delete_data('room_facility',$wh);

                    if($del1)
                    {
                        $room_fc_data = $_POST['facility'];

                        $room_fc_string = $room_fc_data[0];
    
                        $room_fc_arr = explode(",",$room_fc_string);
    
                        foreach ($room_fc_arr as $key => $value1) 
                        {
                            $arr_fc = array(
                                            'hotel_id' => $admin_id,
                                            'room_configure_id' => $room_configure_id,
                                            'room_facility' => $value1,
                                            'added_by' => 1,
                                            'added_by_u_id' => $admin_id,
                                            );
    
                            $this->HotelAdminModel->insert_data('room_facility',$arr_fc);
                        }
                    }
                }

                //edit multiple images
                if(isset($_FILES['image']['name']))
                {
                    $count1 = count($_FILES['image']['name'],TRUE);

                    for($k = 0;$k < $count1; $k++)
                    {
                        $wh_rm_i = '(room_img_id = "'.$room_img_id[$k].'")';

                        $room_img = $this->HotelAdminModel->getData('room_imgs',$wh_rm_i);

                        if(!empty($_FILES['image']['name'][$k]))
                        {
                            $_FILES['my_file']['name'] = $_FILES['image']['name'][$k];
                            $_FILES['my_file']['type'] = $_FILES['image']['type'][$k];
                            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'][$k];
                            $_FILES['my_file']['size'] = $_FILES['image']['size'][$k];
                            $_FILES['my_file']['error'] = $_FILES['image']['error'][$k];

                            $path = 'assets/upload/room_img/';
                            $file_path = './'.$path;
                            $config['allowed_types'] = '*';
                            $config['encrypt_name'] = TRUE;
                            $config['upload_path'] = $file_path;
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload('my_file'))
                            { 
                                $file_data = $this->upload->data();

                                $images = base_url().$path.$file_data['file_name'];
                            } 
                        }
                        else
                        {
                            $images = $room_img['images'];
                        }

                        $arr_rm_i = array(
                                            'images' => $images
                                        );

                        $this->HotelAdminModel->edit_data('room_imgs',$wh_rm_i,$arr_rm_i);
                    }
                }

                $this->session->set_flashdata('msg','Data Updated successfully..');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
        public function delete_room_data()
        {
            $room_configure_id = $this->input->post('id');
            
            $wh = '(room_configure_id = "'.$room_configure_id.'")';

            $del = $this->HotelAdminModel->delete_data('room_configure',$wh);

            $del = $this->HotelAdminModel->delete_data('room_facility',$wh);

            $del = $this->HotelAdminModel->delete_data('room_imgs',$wh);

            $del = $this->HotelAdminModel->delete_data('room_nos',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }   
        public function ajaxSubIconBlockViewReservation()
		{
			
			$postArr = $this->input->post();
			$userType = $this->session->userdata('userType');
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$admin_id = $get_hotel_id['u_id']; 
			
            $guest_mng["list"] = $this->HotelAdminModel->get_business_center_list_pagination($admin_id);
            $guest_mng['business_center'] = $this->MainModel->get_active_business_center($admin_id);
            
			
			$this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
		}
        public function ajaxSubIconBlockViewEnquiry()
		{
			
			$postArr = $this->input->post();
			$userType = $this->session->userdata('userType');
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$admin_id = $get_hotel_id['u_id']; 
			
            $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id);
            $guest_mng["list1"] = $this->HotelAdminModel->get_hotel_enquiry_accepted_request_pagination($admin_id);
            $guest_mng["list2"] = $this->HotelAdminModel->get_hotel_enquiry_rejected_request_pagination($admin_id);
            
			
			$this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
		}
		public function delete_floor()
        {
            $floor_id = $this->input->post('id');
            
            $wh = '(floor_id = "'.$floor_id.'")';

            $del = $this->HotelAdminModel->delete_data('floors',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }   
		public function edit_floor()
        {
			// echo 'hi';die;
            $admin_id = $this->session->userdata('u_id');

            $floor_id = $this->input->post('floor_id');

            $floor = $this->input->post('floor');

            $wh = '(floor_id = "'.$floor_id.'")';

            $wh1 = '(hotel_id = "'.$admin_id.'" AND floor = "'.$floor.'")';

            $floor_data = $this->HotelAdminModel->getData('floors',$wh1);

            if($floor_data)
            {
                $this->session->set_flashdata('msg','Floor already exits..');
				redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $arr =  array(
                                'floor' => $floor,
                            );

                $add = $this->HotelAdminModel->edit_data('floors',$wh,$arr);

                if($add)
                {
                    $this->session->set_flashdata('msg','Floor updated Successfully..');
					redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
        }

        public function add_shuttle_service_staff_avaibility()
        {
            
            $day = $this->input->post('day');
            $front_ofs_service_id = $this->input->post('front_ofs_service_id');
            $start_time = $this->input->post('start_time');
            $end_time = $this->input->post('end_time');
            
            $admin_id = $this->session->userdata('u_id');

            $arr = array(
                            'hotel_id' => $admin_id,
                            'day' => $day,
                            'front_ofs_service_id' => $front_ofs_service_id,
                            'start_time' => $start_time,
                            'end_time' => $end_time,
                            'available_status' => 1,
                        );

            $add = $this->HotelAdminModel->insert_data('shuttle_service_avaibility',$arr);

            if($add)
            {
                $this->session->set_flashdata('msg','Data Added Successfully');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
        public function shuttle_availabilty()
	{
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');
		
			$day1 = "Sunday";
			$day2 = "Monday";
			$day3 = "Tuesday";
			$day4 = "Wednesday";
			$day5 = "Thursday";
			$day6 = "Friday";
			$day7 = "Saturday";
            $service_name = 4;
			$guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
			
			$guest_mng['sun_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day1);

			$guest_mng['mon_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day2);

			$guest_mng['tue_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day3);

			$guest_mng['wed_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day4);

			$guest_mng['thurs_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day5);

			$guest_mng['fri_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day6);

			$guest_mng['sat_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day7);
			$guest_mng['sub_icon_id'] = 4;
		

			$this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
		}
		else
		{
			redirect(base_url());
		}
		
	}


    public function change_available_status()
    {
        $available_status = $this->input->post('status');
        $shuttle_service_avaibility_id = $this->input->post('id');

        $wh = '(shuttle_service_avaibility_id = "'.$shuttle_service_avaibility_id.'")';

        $arr = array(
                        'available_status' => $available_status
                    );
        
        $update = $this->HotelAdminModel->edit_data('shuttle_service_avaibility',$wh,$arr);

        if($update)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }
        public function reserve_business_center()
        {
           
            $client_name = $this->input->post('client_name');
            $client_mobile_no = $this->input->post('client_mobile_no');
            $business_center_type = $this->input->post('business_center_type');
            $event_name = $this->input->post('event_name');
            $event_date = $this->input->post('event_date');
            $start_time = $this->input->post('start_time');
            $end_time = $this->input->post('end_time');
            $admin_id = $this->session->userdata('u_id');

            $wh = '(hotel_id = "'.$admin_id.'" AND business_center_type = "'.$business_center_type.'" AND event_date = "'.$event_date.'" AND start_time >= "'.$start_time.'"AND end_time <= "'.$end_time.'")';

            $business_center_reser_data = $this->HotelAdminModel->getData('business_center_reservation',$wh);

            if($business_center_reser_data)
            {
                $this->session->set_flashdata('msg','Already Reserve this center of selected date');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
               
                if(!empty($_FILES))
                {
                    $_FILES['my_file']['name'] = $_FILES['id_proof_photo']['name'];
                    $_FILES['my_file']['type'] = $_FILES['id_proof_photo']['type'];
                    $_FILES['my_file']['tmp_name'] = $_FILES['id_proof_photo']['tmp_name'];
                    $_FILES['my_file']['size'] = $_FILES['id_proof_photo']['size'];
                    $_FILES['my_file']['error'] = $_FILES['id_proof_photo']['error'];
    
                    $path = 'assets/upload/business_center_reservation_id_proff_pics/';
                    $file_path = './'.$path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
    
                    if($this->upload->do_upload('my_file'))
                    {
                        $file_data = $this->upload->data();
    
                        $id_proof_photo = base_url().$path.$file_data['file_name'];
                    }
                    else
                    {
                      
                        $this->session->set_flashdata('msg','Image Error to upload');
                        redirect(base_url('HoteladminController/frontOfficeList'));
                    }
    
                }
                else
                {
                   
                    $this->session->set_flashdata('msg','Image Error to upload');
                        redirect(base_url('HoteladminController/frontOfficeList'));
                }
              
                $arr = array(
                            'hotel_id' => $admin_id,
                            'client_name' => $client_name,
                            'client_mobile_no' => $client_mobile_no,
                            'business_center_type' => $business_center_type,
                            'event_date' => $event_date,
                            'event_name' => $event_name,
                            'start_time' => $start_time,
                            'end_time' => $end_time,
                            'id_proof_photo' => $id_proof_photo,
                            'added_by' => 1,
                            'added_by_u_id' => $admin_id,
                            );

                $add = $this->HotelAdminModel->insert_data('business_center_reservation',$arr);

                if($add)
                {
                    $this->session->set_flashdata('msg','Data Added Successfully');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Image Error to upload');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
        }
 
        public function change_cab_service_request()
        {
            $cab_service_request_id = $this->input->post('cab_service_request_id');
            $request_status = $this->input->post('request_status');
            
            $wh = '(cab_service_request_id = "'.$cab_service_request_id.'")';
            // red =1, green=2
            if($request_status == "red")
            {
                $request_status1 = 1;
                $driver_name = $this->input->post('driver_name');
                $driver_contact_no = $this->input->post('driver_contact_no');
                $assign_vehicle_type = $this->input->post('assign_vehicle_type');
                $vehicle_no = $this->input->post('vehicle_no');
                $accepted_date = date('Y-m-d');
                $reject_date = "";
            }
            else
            {
                $request_status1 = 2;
                $driver_name = "";
                $driver_contact_no = "";
                $assign_vehicle_type = "";
                $vehicle_no = "";
                $accepted_date = "";
                $reject_date = date('Y-m-d');
            }

            $arr = array(
                            'request_status' => $request_status1,
                            'driver_name' => $driver_name,
                            'driver_contact_no' => $driver_contact_no,
                            'assign_vehicle_type' => $assign_vehicle_type,
                            'accepted_date' => $accepted_date,
                            'reject_date' => $reject_date,
                            'vehicle_no' => $vehicle_no,
                        );

            $up = $this->HotelAdminModel->edit_data('cab_service_request_list',$wh,$arr);

            if($up)
            {
                if($request_status1 == 1)
                {
                    $this->session->set_flashdata('msg','Request accepted successfully');
                }
                else
                {
                    $this->session->set_flashdata('msg','Request has been Cancelled');
                }
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            } 
        }


        public function edit_front_ofs_services()
        {
            $service_name = $this->input->post('service_name');
            $staff_name = $this->input->post('staff_name');
            $contact_no = $this->input->post('contact_no');
            $open_time = $this->input->post('open_time');
            $close_time = $this->input->post('close_time');
            $break_start_time = $this->input->post('break_start_time');
            $description = $this->input->post('description');
            $t_nd_c = $this->input->post('t_nd_c');

            $admin_id = $this->session->userdata('u_id');

            $front_ofs_service_id = $this->input->post('front_ofs_service_id');

            $front_ofs_service_image_id = $this->input->post('front_ofs_service_image_id',TRUE);

            $front_ofs_spa_service_images_id = $this->input->post('front_ofs_spa_service_images_id',TRUE);

            $wh = '(front_ofs_service_id = "'.$front_ofs_service_id.'") ';

            $spa_type = $this->input->post('spa_type');
            $spa_price = $this->input->post('spa_price');
 
            $spa_type12 = $this->input->post('spa_type12');
            $spa_price12 = $this->input->post('spa_price12');

            $shuttle_service_image_id = $this->input->post('shuttle_service_image_id');

            $arr = array(
                            'service_name' => $service_name,
                            'staff_name' => $staff_name,
                            'contact_no' => $contact_no,
                            'open_time' => $open_time,
                            'close_time' => $close_time,
                            'break_start_time' => $break_start_time,
                            'description' => $description,
                            't_nd_c' => $t_nd_c
                        );

            $up = $this->HotelAdminModel->edit_data('front_ofs_services',$wh,$arr);

            if($up)
            {
                // edit multiple images
                if(isset($_FILES['image']['name']))
                {
                    $count = count($_FILES['image']['name'],TRUE);

                    for($i = 0;$i < $count; $i++)
                    {
                        if(!empty($_FILES['image']['name'][$i]))
                        {
                            $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                            $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                            $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                            $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];
    
                            $path = 'assets/upload/fronf_ofs_services_images/';
                            $file_path = './'.$path;
                            $config['allowed_types'] = '*';
                            $config['encrypt_name'] = TRUE;
                            $config['upload_path'] = $file_path;
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);
    
                            if($this->upload->do_upload('my_uploaded_file'))
                            { 
                                $file_data = $this->upload->data();
    
                                $image = base_url().$path.$file_data['file_name'];
                                
                                $wh1 = '(front_ofs_service_image_id = "'.$front_ofs_service_image_id[$i].'")';

                                $arr1 = array(
                                                'image' => $image,
                                            );
    
                                $this->HotelAdminModel->edit_data('front_ofs_services_images',$wh1,$arr1);
                            } 
                        }
                    }
                }

                //edit only single image of shuttle service
                if($service_name == 4)
                {
                    if(isset($_FILES['shuttle_img']['name']))
                    {
                        if(!empty($_FILES['shuttle_img']['name']))
                        {
                            $_FILES['my_shuttle_file']['name'] = $_FILES['shuttle_img']['name'];
                            $_FILES['my_shuttle_file']['type'] = $_FILES['shuttle_img']['type'];
                            $_FILES['my_shuttle_file']['tmp_name'] = $_FILES['shuttle_img']['tmp_name'];
                            $_FILES['my_shuttle_file']['size'] = $_FILES['shuttle_img']['size'];
                            $_FILES['my_shuttle_file']['error'] = $_FILES['shuttle_img']['error'];
    
                            $path = 'assets/upload/fronf_ofs_services_images/';
                            $file_path = './'.$path;
                            $config['allowed_types'] = '*';
                            $config['encrypt_name'] = TRUE;
                            $config['upload_path'] = $file_path;
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);
    
                            if($this->upload->do_upload('my_uploaded_file'))
                            { 
                                $file_data = $this->upload->data();
    
                                $shuttle_img = base_url().$path.$file_data['file_name'];
                                
                                $wh_sh = '(front_ofs_service_image_id = "'.$shuttle_service_image_id.'")';

                                $arr_sh = array(
                                                'image' => $shuttle_img,
                                            );
    
                                $this->HotelAdminModel->edit_data('front_ofs_services_images',$wh_sh,$arr_sh);
                            } 
                        }
                    }
                }

                // spa images
                if($service_name == 2)
                {
                    // edit multiple spa photo price and type
                    if(isset($_FILES['spa_photo']['name']))
                    {
                        $count1 = count($_FILES['spa_photo']['name'],TRUE);

                        for($k = 0;$k < $count1; $k++)
                        {
                            $wh_sp_i = '(front_ofs_spa_service_images_id = "'.$front_ofs_spa_service_images_id[$k].'")';

                            $services_img = $this->HotelAdminModel->getData('front_ofs_spa_service_images',$wh_sp_i);

                            if(!empty($_FILES['spa_photo']['name'][$k]))
                            {
                                $_FILES['my_spa_file1']['name'] = $_FILES['spa_photo']['name'][$k];
                                $_FILES['my_spa_file1']['type'] = $_FILES['spa_photo']['type'][$k];
                                $_FILES['my_spa_file1']['tmp_name'] = $_FILES['spa_photo']['tmp_name'][$k];
                                $_FILES['my_spa_file1']['size'] = $_FILES['spa_photo']['size'][$k];
                                $_FILES['my_spa_file1']['error'] = $_FILES['spa_photo']['error'][$k];
    
                                $path = 'assets/upload/fronf_ofs_spa_service_images/';
                                $file_path = './'.$path;
                                $config['allowed_types'] = '*';
                                $config['encrypt_name'] = TRUE;
                                $config['upload_path'] = $file_path;
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
    
                                if($this->upload->do_upload('my_spa_file1'))
                                { 
                                    $file_data = $this->upload->data();
    
                                    $spa_photo = base_url().$path.$file_data['file_name'];
                                    
                                } 
                            }
                            else
                            {
                                $spa_photo = $services_img['spa_photo'];
                            }

                            $arr_spa_up = array(
                                                'spa_photo' => $spa_photo,
                                                'spa_type' => $spa_type[$k],
                                                'spa_price' => $spa_price[$k],
                                            );

                            $this->HotelAdminModel->edit_data('front_ofs_spa_service_images',$wh_sp_i,$arr_spa_up);
                        }
                    }

                    // add multiple spa photo price and type
                    // $count3 = count($spa_type12);
                    $count3 = count($_FILES['spa_photo12']['name'],TRUE);

                    for($l = 0;$l < $count3; $l++)
                    {
                        if(!empty($_FILES['spa_photo12']['name'][$l]))
                        {
                            $_FILES['my_spa_file2']['name'] = $_FILES['spa_photo12']['name'][$l];
                            $_FILES['my_spa_file2']['type'] = $_FILES['spa_photo12']['type'][$l];
                            $_FILES['my_spa_file2']['tmp_name'] = $_FILES['spa_photo12']['tmp_name'][$l];
                            $_FILES['my_spa_file2']['size'] = $_FILES['spa_photo12']['size'][$l];
                            $_FILES['my_spa_file2']['error'] = $_FILES['spa_photo12']['error'][$l];

                            $path = 'assets/upload/fronf_ofs_spa_service_images/';
                            $file_path = './'.$path;
                            $config['allowed_types'] = '*';
                            $config['encrypt_name'] = TRUE;
                            $config['upload_path'] = $file_path;
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload('my_spa_file2'))
                            { 
                                $file_data = $this->upload->data();

                                $spa_photo2 = base_url().$path.$file_data['file_name'];
                                
                                $arr_spa_ad = array(
                                                    'hotel_id' => $admin_id,
                                                    'front_ofs_service_id' => $front_ofs_service_id,
                                                    'spa_photo' => $spa_photo2,
                                                    'spa_type' => $spa_type12[$l],
                                                    'spa_price' => $spa_price12[$l],
                                                    );

                                $this->HotelAdminModel->insert_data('front_ofs_spa_service_images',$arr_spa_ad);
                            } 
                        }
                    }
                }
                  
                if($service_name == 1)
                {
                    $this->session->set_flashdata('msg','Data Updated Successfully');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    if($service_name == 2)
                    {
                        $this->session->set_flashdata('msg','Data Updated Successfully');
                        redirect(base_url('HoteladminController/frontOfficeList'));
                    }
                    else
                    {
                        if($service_name == 3)
                        {
                            $this->session->set_flashdata('msg','Data Updated Successfully');
                            redirect(base_url('HoteladminController/frontOfficeList'));
                        }
                        else
                        {
                            if($service_name == 4)
                            {
                                $this->session->set_flashdata('msg','Data Updated Successfully');
                                redirect(base_url('HoteladminController/frontOfficeList'));
                            }
                            else
                            {
                                if($service_name == 5)
                                {
                                    $this->session->set_flashdata('msg','Data Updated Successfully');
                                    redirect(base_url('HoteladminController/frontOfficeList'));
                                }
                                else
                                {
                                    if($service_name == 6)
                                    {
                                        $this->session->set_flashdata('msg','Data Updated Successfully');
                                        redirect(base_url('HoteladminController/frontOfficeList'));
                                    }
                                    else
                                    {
                                        if($service_name == 7)
                                        {
                                            $this->session->set_flashdata('msg','Data Updated Successfully');
                                            redirect(base_url('HoteladminController/frontOfficeList'));
                                        }
                                        else
                                        {
                                            if($service_name == 8)
                                            {
                                                $this->session->set_flashdata('msg','Data Updated Successfully');
                                                redirect(base_url('HoteladminController/frontOfficeList'));
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else
            {
                if($service_name == 1)
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    if($service_name == 2)
                    {
                        $this->session->set_flashdata('msg','Something went wrong');
                        redirect(base_url('HoteladminController/frontOfficeList'));
                    }
                    else
                    {
                        if($service_name == 3)
                        {
                            $this->session->set_flashdata('msg','Something went wrong');
                            redirect(base_url('HoteladminController/frontOfficeList'));
                        }
                        else
                        {
                            if($service_name == 4)
                            {
                                $this->session->set_flashdata('msg','Something went wrong');
                                redirect(base_url('HoteladminController/frontOfficeList'));
                            }
                            else
                            {
                                if($service_name == 5)
                                {
                                    $this->session->set_flashdata('msg','Something went wrong');
                                    redirect(base_url('HoteladminController/frontOfficeList'));
                                }
                                else
                                {
                                    if($service_name == 6)
                                    {
                                        $this->session->set_flashdata('msg','Something went wrong');
                                        redirect(base_url('HoteladminController/frontOfficeList'));
                                    }
                                    else
                                    {
                                        if($service_name == 7)
                                        {
                                            $this->session->set_flashdata('msg','Something went wrong');
                                            redirect(base_url('HoteladminController/frontOfficeList'));
                                        }
                                        else
                                        {
                                            if($service_name == 8)
                                            {
                                                $this->session->set_flashdata('msg','Something went wrong');
                                                redirect(base_url('HoteladminController/frontOfficeList'));
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }



        public function edit_expenses()
        {
            $guest_name = $this->input->post('guest_name');
            $mobile_no = $this->input->post('mobile_no');
            $expense_amt = $this->input->post('expense_amt');
            $date = $this->input->post('date');
            $description = $this->input->post('description');

            $expense_id = $this->input->post('expense_id');

            $wh = '(expense_id = "'.$expense_id.'")';

            $user_data = $this->HotelAdminModel->get_user_data_by_no($mobile_no);

            if($user_data)
            {
                $arr = array(
                            'guest_name' => $guest_name,
                            'mobile_no' => $mobile_no,
                            'u_id' => $user_data['u_id'],
                            'expense_amt' => $expense_amt,
                            'date' => $date,
                            'description' => $description,
                            );

                $up = $this->HotelAdminModel->edit_data('expenses',$wh,$arr);

                if($up)
                {
                    $this->session->set_flashdata('msg','Data Updated Successfully');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
            else
            {
                $this->session->set_flashdata('msg','Mobile number not registerd');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            
        }

        public function add_walking_guest()
        {
            $full_name = $this->input->post('full_name');
            $mobile_no = $this->input->post('mobile_no');
            $check_in = $this->input->post('check_in');
            $check_in_time = $this->input->post('check_in_time');
            $check_out = $this->input->post('check_out');
            $check_out_time = $this->input->post('check_out_time');
            $total_adults = $this->input->post('total_adults');
            $total_child = $this->input->post('total_child');
            $no_of_guests = $this->input->post('no_of_guests');
            $guest_type = $this->input->post('guest_type');
           
			$admin_id = $this->session->userdata('u_id');

            $wh = '(mobile_no = "'.$mobile_no.'")';

            $user_data = $this->HotelAdminModel->getData('register',$wh);

            $add_user = "";
            $up_user = "";

            //id proff images
            $_FILES['my_file']['name'] = $_FILES['id_proff_img']['name'];
            $_FILES['my_file']['type'] = $_FILES['id_proff_img']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['id_proff_img']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['id_proff_img']['size'];
            $_FILES['my_file']['error'] = $_FILES['id_proff_img']['error'];

            $path = 'assets/upload/id_proff_pic_for_add_booking/';
            $file_path = './'.$path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('my_file'))
            {
                $file_data = $this->upload->data();

                $id_proff_img = base_url().$path.$file_data['file_name'];
            }
            else
            {
                $this->session->set_flashdata('msg','Error to upload images');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
                            
            if($user_data)
            {
                $arr_up = array(
                                'full_name' => $full_name,
                                'mobile_no' => $mobile_no,
                                'guest_type' => $guest_type,
                            );
                
                $up_user = $this->HotelAdminModel->edit_data('register',$wh,$arr_up);

                $u_id = $user_data['u_id'];
            }
            else
            {
                $arr_add = array(
                                'hotel_id' => $admin_id,
                                'full_name' => $full_name,
                                'mobile_no' => $mobile_no,
                                'password' => md5($mobile_no),
                                'password_text' => $mobile_no,
                                'Id_proff_photo' => $id_proff_img,
                                'register_date' => date('Y-m-d'),
                                'guest_type' => $guest_type,
                                'is_active' => 1
                                );

                $add_user = $this->HotelAdminModel->insert_data('register',$arr_add);

                $u_id = $add_user;
            }

            if($add_user || $up_user)
            {
                $arr_add = array(
                                'hotel_id' => $admin_id,
                                'u_id' => $u_id,
                                'id_proff_img' => $id_proff_img,
                                'no_of_guests' => $no_of_guests,
                                'total_adults' => $total_adults,
                                'total_child' => $total_child,
                                'booking_date' => date('Y-m-d'),
                                'check_in' => $check_in,
                                'check_in_time' => $check_in_time,
                                'check_out' => $check_out,
                                'check_out_time' => $check_out_time,
                                'booking_status' => 1,
                                'booking_from' => 1,
                                );

                $add_booking = $this->HotelAdminModel->insert_data('user_hotel_booking',$arr_add);

                if($add_booking)
                {
                    //added as a guest
                    $arr_add_ug = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $u_id,
                                    'booking_id' => $add_booking,
                                    'login_id' => $mobile_no,
                                    'dnd_mode' => 2,
                                    'is_guest' => 1,
                                    );

                    $this->HotelAdminModel->insert_data('guest_user',$arr_add_ug);

                    //add room no type price
                    $no_of_rooms = $this->input->post('no_of_rooms');
                    $room_type = $this->input->post('room_type');
                    $room_no = $this->input->post('room_no');

                    $rm_data = $this->HotelAdminModel->get_room_nos_data($admin_id,$room_type,$room_no);
            
                    $arr_add_details = array(
                                            'booking_id' => $add_booking,
                                            'room_no' => $room_no,
                                            'price' => $rm_data['price'],
                                            'no_of_rooms' => $no_of_rooms,
                                            'room_type' => $room_type,
                                            );

                    $add_details = $this->HotelAdminModel->insert_data('user_hotel_booking_details',$arr_add_details);

                    if($add_details)
                    {
                        $wh_detail = '(booking_id = "'.$add_booking.'")';

                        $booking_data = $this->HotelAdminModel->getData('user_hotel_booking',$wh_detail);

                        $arr_up = array(
                                            'total_charges' => $booking_data['total_charges'] + $rm_data['price'],
                                            'no_of_rooms' => $booking_data['no_of_rooms'] + $no_of_rooms,
                                        );
            
                        $this->HotelAdminModel->edit_data('user_hotel_booking',$wh_detail,$arr_up);

                        //change room status
                        
                        $wh_rn_status = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$room_no.'")';

                        $arr_rn_status = array(
                                                    'room_status' => 2
                                                );

                        $this->HotelAdminModel->edit_data('room_status',$wh_rn_status,$arr_rn_status);

                    }
                    //multiple room no type price
                     
                    $no_of_rooms1 = $this->input->post('no_of_rooms1'); //multiple
                    $room_type1 = $this->input->post('room_type1');// multiple
                    $room_no1 = $this->input->post('room_no1');// multiple

                    if(isset($_POST['room_type1']))
                    {
                        $count = count($room_type1);

                        for($i = 0 ;$i < $count; $i++)
                        {
                            $rm_data1 = $this->HotelAdminModel->get_room_nos_data($admin_id,$room_type1[$i],$room_no1[$i]);
                    
                            $arr_add_details1 = array(
                                                        'booking_id' => $add_booking,
                                                        'room_no' => $room_no1[$i],
                                                        'price' => $rm_data1['price'],
                                                        'no_of_rooms' => $no_of_rooms1[$i],
                                                        'room_type' => $room_type1[$i],
                                                    );

                            $add_details1 = $this->HotelAdminModel->insert_data('user_hotel_booking_details',$arr_add_details1);

                            if($add_details1)
                            {
                                $wh_detail1 = '(booking_id = "'.$add_booking.'")';
        
                                $booking_data1 = $this->HotelAdminModel->getData('user_hotel_booking',$wh_detail1);
        
                                $arr_up1 = array(
                                                    'total_charges' => $booking_data1['total_charges'] + $rm_data1['price'],
                                                    'no_of_rooms' => $booking_data1['no_of_rooms'] + $no_of_rooms1[$i],
                                                );
                    
                                $this->HotelAdminModel->edit_data('user_hotel_booking',$wh_detail1,$arr_up1);
        
                                //change room status
                                
                                $wh_rn_status1 = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$room_no1[$i].'")';

                                $arr_rn_status1 = array(
                                                            'room_status' => 2
                                                        );

                                $this->HotelAdminModel->edit_data('room_status',$wh_rn_status1,$arr_rn_status1);

                            }
                        }
                    }

                    $this->session->set_flashdata('msg','Booking Successfully');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
        }

        public function assign_rooms()
        {
            $booking_id = $this->input->post('booking_id');
            $room_no = $this->input->post('room_no'); //single
            $price = $this->input->post('price'); //single
            $room_type = $this->input->post('room_type'); //single
            $price1 = $this->input->post('price1'); // multiple
            $room_no1 = $this->input->post('room_no1');//multiple
            // print_r($_POST);die;
            $wh_detail = '(booking_id = "'.$booking_id.'")';

			$admin_id = $this->session->userdata('u_id');

            $booking_data = $this->HotelAdminModel->getData('user_hotel_booking',$wh_detail);

            $add_details = "";
            $add_details1 = "";

            //single room addd

            if(isset($_POST['room_no']))
            {
                $arr = array(
                                'booking_id' => $booking_id,
                                'room_no' => $room_no,
                                'price' => $price,
                                'no_of_rooms' => 1,
                                'room_type' => $room_type,
                            );
       
                $add_details = $this->HotelAdminModel->insert_data('user_hotel_booking_details',$arr);

                if($add_details)
                {
                    // change room status
                    $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$room_no.'")';

                    $arr_rm_up = array(
                                        'room_status' => 2,
                                    );

                    $this->HotelAdminModel->edit_data('room_status',$wh_r,$arr_rm_up);

                    $arr_up = array(
                                        //'total_charges' => $booking_data['total_charges'] + $price,
                                        'booking_status' => 1
                                    );

                    $this->HotelAdminModel->edit_data('user_hotel_booking',$wh_detail,$arr_up);

                }
            }
          
            // add multipe room no
            if(isset($_POST['room_no1']))
            {
                $count = count($room_no1);

                for($i = 0 ;$i < $count; $i++)
                {
                    $arr1 = array(
                                    'booking_id' => $booking_id,
                                    'room_no' => $room_no1[$i],
                                    'price' => $price1[$i],
                                    'no_of_rooms' => 1,
                                    'room_type' => $room_type,
                                );
           
                    $add_details1 = $this->HotelAdminModel->insert_data('user_hotel_booking_details',$arr1);

                    if($add_details1)
                    {
                        // change room status
                        $wh_r1 = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$room_no1[$i].'")';

                        $arr_rm_up1 = array(
                                            'room_status' => 2,
                                        );

                        $this->HotelAdminModel->edit_data('room_status',$wh_r1,$arr_rm_up1);

                        $arr_up1 = array(
                                            'total_charges' => $booking_data['total_charges'] + $price1[$i],
                                            'booking_status' => 1
                                        );
            
                        $this->HotelAdminModel->edit_data('user_hotel_booking',$wh_detail,$arr_up1);

                    }
                }
            }

            if($add_details || $add_details1)
            {
              	//changes enquiry request status
                $wh_enq = '(hotel_enquiry_request_id = "'.$booking_data['enquiry_id'].'")';

                $arr_eq = array(
                                    'is_admin_accept_req' => 1,
                                    'request_status' => 4,
                                );

                $this->HotelAdminModel->edit_data('hotel_enquiry_request',$wh_enq,$arr_eq);

                $this->session->set_flashdata('msg','Assign Rooms and booking Successfully');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
        public function get_room_nos()
        {
            $room_type = $this->input->post('room_type');
            
			$admin_id = $this->session->userdata('u_id');

            $room_no_data = $this->HotelAdminModel->get_room_nos($admin_id,$room_type);

            $output = '';

            foreach($room_no_data as $r_n)
            {
                $available_rm = $this->HotelAdminModel->get_available_room_no($admin_id,$r_n['room_no']);

                if($available_rm)
                {
                    $output .= '<div class="room_card card  p-0"
                                    data-bs-target=".add" class="green">
                                    <input name="room_no" class="radio" type="radio"
                                        value="'.$r_n['room_no'].'">
                                    <span
                                        class="room_no m-0 room_card  red colored-div">'.$r_n['room_no'].'</span>
                                </div>';
                }
            }

            echo $output;
        }
		public function add_room_type()
        {	
            $admin_id = $this->session->userdata('u_id');

            $room_type_name = $this->input->post('room_type_name');
            $price = $this->input->post('price');
            $lux_tax = $this->input->post('lux_tax');
            $serv_tax = $this->input->post('serv_tax');

            $lux_tax_amt = $price * ($lux_tax/100);
            // $lux_tax_amt1 = $price + $lux_tax;

            $serv_tax_amt = $price * ($serv_tax/100);
            // $serv_tax_amt1 = $price + $serv_tax_amt;

            $wh = '(hotel_id = "'.$admin_id.'" AND room_type_name = "'.$room_type_name.'")';

            $room_type_data = $this->HotelAdminModel->getData('room_type',$wh);

            if($room_type_data)
            {
                $this->session->set_flashdata('msg','Room Type already exits..');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'];
                $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'];
                $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'];
                $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'];
                $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'];

                $path = 'assets/upload/room_type_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_uploaded_file'))
                {
                    $file_data = $this->upload->data();

                    $images = base_url().$path.$file_data['file_name'];
                }

                $arr =  array(
                              'hotel_id' => $admin_id,
                              'room_type_name' => $room_type_name,
                              'price' => $price,
                              'lux_tax' => $lux_tax,
                              'serv_tax' => $serv_tax,
                              'lux_tax_amt' => $lux_tax_amt,
                              'serv_tax_amt' => $serv_tax_amt,
                              'images' => $images,
                              'added_by' => 1,
                              'added_by_u_id' => $admin_id,
                            );

                $add = $this->HotelAdminModel->insert_data('room_type',$arr);

                if($add)
                {
                    $this->session->set_flashdata('msg','Room Type added Successfully..');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
        }
        public function add_rooms()
        {
            $floor_id = $this->input->post('floor_id');
            $price = $this->input->post('price');
            $room_details = $this->input->post('room_details');
            $room_type = $this->input->post('room_type');
            // $facility = $this->input->post('facility'); // multiple
            // $room_no = $this->input->post('room_no');

            $room_data = $_POST['room_no'];

            $room_string = $room_data[0];

            $room_arr = explode(",",$room_string);

            // print_r($room_arr);die;

            $admin_id = $this->session->userdata('u_id');

            if($room_arr)
            {
                $room_no_data = array();
                
                foreach($room_arr as $key => $value) 
                {
                    $wh = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$value.'")';

                    $room_no_data = $this->HotelAdminModel->getData('room_nos',$wh);

                    if($room_no_data)
                    {
                        $this->session->set_flashdata('msg','Room no Already exits..');
                        redirect(base_url('HoteladminController/frontOfficeList'));
                    }
                }
            }

            if(empty($room_no_data))
            {

                $arr = array(
                                'hotel_id' => $admin_id,
                                'floor_id' => $floor_id,
                                'room_type' => $room_type,
                                'room_details' => $room_details,
                                'price' => $price,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                            );
      
                $add = $this->HotelAdminModel->insert_data('room_configure',$arr);

                if($add)
                {
                    // add multiple room images 
                    $count_img = count($_FILES['images']['name'],TRUE);

                    for($i = 0;$i < $count_img; $i++)
                    {
                        if(!empty($_FILES['images']['name'][$i]))
                        {
                            $_FILES['my_uploaded_file']['name'] = $_FILES['images']['name'][$i];
                            $_FILES['my_uploaded_file']['type'] = $_FILES['images']['type'][$i];
                            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                            $_FILES['my_uploaded_file']['size'] = $_FILES['images']['size'][$i];
                            $_FILES['my_uploaded_file']['error'] = $_FILES['images']['error'][$i];

                            $path = 'assets/upload/room_img/';
                            $file_path = './'.$path;
                            $config['allowed_types'] = '*';
                            $config['encrypt_name'] = TRUE;
                            $config['upload_path'] = $file_path;
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);

                            if($this->upload->do_upload('my_uploaded_file'))
                            {
                                $file_data = $this->upload->data();

                                $images = base_url().$path.$file_data['file_name'];
                                
                                $arr1 = array(
                                                'hotel_id' => $admin_id,
                                                'room_configure_id' => $add,
                                                'images' => $images,
                                                'added_by' => 1,
                                                'added_by_id' => $admin_id,
                                            );

                                $this->HotelAdminModel->insert_data('room_imgs',$arr1);
                            }        
                        }
                    }

                    // add multiple facility
                    $facility = $_POST['facility'];

                    $facility_string = $facility[0];

                    $facility_string_arr = explode(",",$facility_string);

                    foreach ($facility_string_arr as $key => $value) 
                    {
                        $arr_fl = array(
                                            'hotel_id' => $admin_id,
                                            'room_configure_id' => $add,
                                            'room_facility' => $value,
                                            'added_by' => 1,
                                            'added_by_u_id' => $admin_id,
                                        );

                        $this->HotelAdminModel->insert_data('room_facility',$arr_fl);
                    }
                    
                    // add multiple room nos
                    $room_data = $_POST['room_no'];

                    $room_string = $room_data[0];

                    $room_arr = explode(",",$room_string);

                    foreach ($room_arr as $key => $value) 
                    {
                        $arr_rm = array(
                                        'hotel_id' => $admin_id,
                                        'room_configure_id' => $add,
                                        'room_no' => $value,
                                        'added_by' => 1,
                                        'added_by_id' => $admin_id,
                                        );

                        $add_room_no = $this->HotelAdminModel->insert_data('room_nos',$arr_rm);

                        if($add_room_no)
                        {
                            $arr_rm = array(
                                            'hotel_id' => $admin_id,
                                            'room_no' => $value,
                                            'room_status' => 3,
                                            'added_by' => 1,
                                            'added_by_u_id' => $admin_id,
                                            );

                            $this->HotelAdminModel->insert_data('room_status',$arr_rm);

                        }
                    }
                    
                    $this->session->set_flashdata('msg','Room no added successfully..');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
        }
		public function edit_room_type()
        {
            $admin_id = $this->session->userdata('u_id');

            $room_type_id = $this->input->post('room_type_id');

            $room_type_name = $this->input->post('room_type_name');
            $price = $this->input->post('price');
            $lux_tax = $this->input->post('lux_tax');
            $serv_tax = $this->input->post('serv_tax');

            $lux_tax_amt = $price * ($lux_tax/100);
            // $lux_tax_amt1 = $price + $lux_tax;

            $serv_tax_amt = $price * ($serv_tax/100);
            // $serv_tax_amt1 = $price + $serv_tax_amt;

            $wh = '(room_type_id = "'.$room_type_id.'")';

            $room_type_data1 = $this->HotelAdminModel->getData('room_type',$wh);

            if(!empty($_FILES['image']['name']))
            {
                $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'];
                $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'];
                $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'];
                $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'];
                $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'];

                $path = 'assets/upload/room_type_img/';
                $file_path = './'.$path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('my_uploaded_file'))
                {
                    $file_data = $this->upload->data();

                    $images = base_url().$path.$file_data['file_name'];
                }
            }
            else
            {
                $images = $room_type_data1['images'];
            }
            
            $arr =  array(
                            'room_type_name' => $room_type_name,
                            'price' => $price,
                            'lux_tax' => $lux_tax,
                            'serv_tax' => $serv_tax,
                            'lux_tax_amt' => $lux_tax_amt,
                            'serv_tax_amt' => $serv_tax_amt,
                            'images' => $images,
                        );

            $add = $this->HotelAdminModel->edit_data('room_type',$wh,$arr);

            if($add)
            {
                $this->session->set_flashdata('msg','Room Type updated Successfully..');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
		public function delete_room_type()
        {
            $room_type_id = $this->input->post('id');
            
            $wh = '(room_type_id = "'.$room_type_id.'")';

            $del = $this->HotelAdminModel->delete_data('room_type',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
		public function delete_lost_found_list()
        {
            $id = $this->input->post('id');
            
            $wh = '(id = "'.$id.'")';

            $del = $this->HotelAdminModel->delete_data('lost_found_list',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }

        public function edit_business_center()
        {
            $business_center_id = $this->input->post('business_center_id');

            $business_center_type = $this->input->post('business_center_type');
            $no_of_people = $this->input->post('no_of_people');
            $price = $this->input->post('price');
            $description = $this->input->post('description');
            $facility_name = $this->input->post('facility_name');

            $facility_name = $this->input->post('facility_name');//multiple
            $business_center_image_id = $this->input->post('business_center_image_id',TRUE); // image id
            // $id1 = $this->input->post('img_id',TRUE);
            
            $wh = '(business_center_id = "'.$business_center_id.'")';

            $arr = array(
                         'business_center_type' => $business_center_type,
                         'no_of_people' => $no_of_people,
                         'price' => $price,
                         'description' => $description
                        );

            $up = $this->HotelAdminModel->edit_data('business_center',$wh,$arr);

            if($up)
            {
                 // updated particular images
                if(isset($_FILES['image']['name']))
                {
                     $count_img = count($_FILES['image']['name'],TRUE);

                    for($i = 0;$i < $count_img; $i++)
                    {
                        if(!empty($_FILES['image']['name'][$i]))
                        {
                            $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                            $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                            $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                            $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];
        
                            $path = 'assets/upload/business_center_type/';
                            $file_path = './'.$path;
                            $config['allowed_types'] = '*';
                            $config['encrypt_name'] = TRUE;
                            $config['upload_path'] = $file_path;
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);
    
                            if($this->upload->do_upload('my_uploaded_file'))
                            {
                                $file_data = $this->upload->data();
        
                                $images = base_url().$path.$file_data['file_name'];
                                
                                $wh1 = '(business_center_image_id = "'.$business_center_image_id[$i].'")';
    
                                $arr1 = array(
                                            'image' => $images
                                            );
    
                                $this->HotelAdminModel->edit_data('business_center_images',$wh1,$arr1);
                            }        
                        }
                    }
                }
                
                //edit facility
                if(!empty($facility_name))
                {
                    for($j = 0;$j < count($facility_name); $j++)
                    {
                        $arr_fc = array(
                                        'facility_name' => $facility_name[$j]
                                    );

                        $this->HotelAdminModel->edit_data('business_center_facility',$wh,$arr_fc);
                    }
                }
                
                $this->session->set_flashdata('msg','Business center updated successfully..');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }

        }
        public function add_business_center()
        {
            $business_center_type = $this->input->post('business_center_type');
            $no_of_people = $this->input->post('no_of_people');
            $price = $this->input->post('price');
            $description = $this->input->post('description');
            $facility_name = $this->input->post('facility_name'); //multiple
            $admin_id = $this->session->userdata('u_id');

            $arr = array(
                            'hotel_id' => $admin_id,
                            'business_center_type' => $business_center_type,
                            'no_of_people' => $no_of_people,
                            'price' => $price,
                            'description' => $description,
                            'is_active' => 1,
                            'added_by' => 1,
                            'added_by_u_id' => $admin_id,
                        );
  
            $add = $this->HotelAdminModel->insert_data('business_center',$arr);

            if($add)
            {
                // add multiple images
                $count_img = count($_FILES['image']['name'],TRUE);

                for($i = 0;$i < $count_img; $i++)
                {
                    if(!empty($_FILES['image']['name'][$i]))
                    {
                        $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                        $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                        $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                        $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                        $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];
    
                        $path = 'assets/upload/business_center_type/';
                        $file_path = './'.$path;
                        $config['allowed_types'] = '*';
                        $config['encrypt_name'] = TRUE;
                        $config['upload_path'] = $file_path;
                        $this->load->library('upload',$config);
                        $this->upload->initialize($config);

                        if($this->upload->do_upload('my_uploaded_file'))
                        {
                            $file_data = $this->upload->data();
    
                            $images = base_url().$path.$file_data['file_name'];
                            
                            $arr1 = array(
                                        'hotel_id' => $admin_id,
                                        'business_center_id' => $add,
                                        'image' => $images
                                        );

                            $this->HotelAdminModel->insert_data('business_center_images',$arr1);
                        }        
                    }
                }

                //add multiple facility 
                for($j = 0;$j < count($facility_name); $j++)
                {
                    $arr_fc = array(
                                    'hotel_id' => $admin_id,
                                    'business_center_id' => $add,
                                    'facility_name' => $facility_name[$j]
                                );

                    $this->HotelAdminModel->insert_data('business_center_facility',$arr_fc);
                }   
                $this->session->set_flashdata('msg','Business center added successfully');
                redirect(base_url('HoteladminController/frontOfficeList')); 
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }


        public function delete_business_center()
        {
            $business_center_id = $this->input->post('id');
            
            $wh = '(business_center_id = "'.$business_center_id.'")';

            $del = $this->HotelAdminModel->delete_data('business_center',$wh);

            $del = $this->HotelAdminModel->delete_data('business_center_facility',$wh);

            $del = $this->HotelAdminModel->delete_data('business_center_images',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
		public function check_visitor_otp()
        {
            $visitor_id = $this->input->post('visitor_id');
            $otp = $this->input->post('otp');
            
            $wh = '(visitor_id = "'.$visitor_id.'")';

            $data = $this->HotelAdminModel->getData('visitor',$wh);

            if($data['otp'] == $otp)
            {
                $arr = array(
                             'is_otp_verified' => 1,
                             'is_otp_correct' => 1,
                            );

                $up = $this->HotelAdminModel->edit_data('visitor',$wh,$arr);

                if($up)
                {
                    $this->session->set_flashdata('msg','OTP verified Successfully');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
            else
            {
                $arr = array(
                                'is_otp_verified' => 2,
                                'is_otp_correct' => 2,
                            );

                $up = $this->HotelAdminModel->edit_data('visitor',$wh,$arr);

                if($up)
                {
                    $this->session->set_flashdata('msg','OTP is incorrect');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
        }

        public function check_out()
	{
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');

			$date = $this->input->post('date');

			if(isset($_POST['search']))
			{
             $check_out["list"] = $this->HotelAdminModel->get_checkout_guest_list_date_wise_pagination($admin_id,$date);
			}
			else
			{
              $check_out["list"] = $this->HotelAdminModel->get_checkout_guest_list_pagination($admin_id);
			}
            $check_out["sub_icon_id"] = 'n2';

			$this->load->view('hoteladmin/ajaxSubIconBlockView',$check_out);
		}
		else
		{
			redirect(base_url());
		}
	}


        public function check_out_view()
	{
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');
			
			$booking_id = $this->uri->segment(3);

			$u_id = $this->uri->segment(4);

			$check_out_view['admin_data'] = $this->HotelAdminModel->get_user_data($admin_id);

			$check_out_view['user_data'] = $this->HotelAdminModel->get_user_data($u_id);

			$check_out_view['booking_details'] = $this->HotelAdminModel->get_user_booking_details($admin_id,$booking_id);

			$check_out_view['booking_checkout_data'] = $this->HotelAdminModel->get_user_checkout_booking_data($admin_id,$booking_id,$u_id);

			$check_out_view['booking_room_details'] = $this->HotelAdminModel->get_booking_room_details($booking_id);
			
			$check_out_view['minibar_list'] = $this->HotelAdminModel->get_room_service_minibar($admin_id);
$this->load->view('include/header');
			$this->load->view('hoteladmin/check_out_view',$check_out_view);
$this->load->view('include/footer');

		}
		else
		{
			redirect(base_url());
		}
	}


    public function checkout_bill()
    {
        $booking_id = $this->input->post('booking_id');
        $u_id = $this->input->post('u_id');
        $is_today_charge = $this->input->post('is_today_charge');
        $amount = $this->input->post('amount');
        // $payment_type = $this->input->post('payment_type');
// print_r($u_id);die;
        $user_checkout_data_id = $this->input->post('user_checkout_data_id');
        
        $admin_id = $this->session->userdata('u_id');
        
        $wh = '(user_checkout_data_id = "'.$user_checkout_data_id.'")';

        $wh1 = '(booking_id = "'.$booking_id.'")';

        $user_hotel_booking = $this->HotelAdminModel->getData('user_hotel_booking',$wh1);

        $user_checkout_data = $this->HotelAdminModel->getData('user_checkout_data',$wh);

        $check_in = $user_hotel_booking['check_in'];

        if($check_in == date('Y-m-d') && $is_today_charge == 1)
        {
            $arr_ch = array(
                            'paid_date' => date('Y-m-d'),
                            'is_paid' => 1,
                            'total_bill' => $amount,
                            'is_today_charge' => 1,
                            'todays_charges' => $amount,
                            );

            $up_ch = $this->HotelAdminModel->edit_data('user_checkout_data',$wh,$arr_ch);

            if($up_ch)
            {
                $del = $this->HotelAdminModel->delete_data('user_checkout_details',$wh);

                $del = $this->HotelAdminModel->delete_data('user_checkout_sub_total',$wh);

                if($del)
                {
                    $arr_ch_d = array(
                                      'user_checkout_data_id' => $user_checkout_data_id,
                                      'hotel_id' => $admin_id,
                                      'description' => "Room Charges",
                                      'date' => date('Y-m-d'),
                                      'amount' => $amount
                                    );
                    
                    $add_chk_details = $this->HotelAdminModel->insert_data('user_checkout_details',$arr_ch_d);
                    
                    if($add_chk_details)
                    {
                        $arr_ch_d_sub = array(
                                        'user_checkout_data_id' => $user_checkout_data_id,
                                        'hotel_id' => $admin_id,
                                        'description_name' => "Room Charges",
                                        'sub_total' => $amount
                                        );
                        
                        $this->HotelAdminModel->insert_data('user_checkout_sub_total',$arr_ch_d_sub);
                    }
                }

                $arr_ck_1 = array(
                                'booking_status' => 2,
                                'actual_checkout' => date('Y-m-d'),
                                );

                $chk_1 = $this->HotelAdminModel->edit_data('user_hotel_booking',$wh1,$arr_ck_1);

                if($chk_1)
                {
                    //guest user status change
                    $wh_gu_1 = '(u_id = "'.$u_id.'" AND hotel_id = "'.$admin_id.'" AND booking_id = "'.$booking_id.'")';
                    
                    $arr_gu_1 = array(
                                    'is_guest' => 2
                                );

                    $this->HotelAdminModel->edit_data('guest_user',$wh_gu_1,$arr_gu_1);

                    //room status change
                    
                    $booking_details_1 = $this->HotelAdminModel->getAllData('user_hotel_booking_details',$wh1);

                    if($booking_details_1)
                    {
                        foreach ($booking_details_1 as $bk_1) 
                        {
                            $wh_rm_s_1 = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$bk_1['room_no'].'")';

                            $arr_bk_1 = array(
                                            'room_status' => 1
                                            );

                            $this->HotelAdminModel->edit_data('room_status',$wh_rm_s_1,$arr_bk_1);

                        }
                    }

                    //change checkout status for all order
                    $arr_chng_chk_1 = array(
                                        'is_paid_after_check_out' => 1
                                        );

                    $arr_v_wash_1 = array(
                                        'is_paid_checkout' => 1
                                        );
                    $this->HotelAdminModel->edit_data('cloth_orders',$wh_gu_1,$arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('food_orders',$wh_gu_1,$arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('rmservice_services_orders',$wh_gu_1,$arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('room_service_menu_orders',$wh_gu_1,$arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('house_keeping_orders',$wh_gu_1,$arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('vehicle_wash_request',$wh_gu_1,$arr_v_wash_1);

                    $this->HotelAdminModel->edit_data('expenses',$wh_gu_1,$arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('luggage_request',$wh_gu_1,$arr_chng_chk_1);

                }  
                redirect(base_url('HoteladminController/check_out_view/' . $booking_id.'/'.$u_id));   
            }
        }
        else
        {
            if($is_today_charge == 1)
            {
                if(empty($amount))
                {
                    $amount=0;
                }
                else
                {
                    $amount=$amount;
                }
                $total = $user_checkout_data['total_bill'] + $amount;
                $is_today_charge = 1;
                $todays_charges = $amount;
            }
            else
            {
                $total = $user_checkout_data['total_bill'];
                $is_today_charge = 0;
                $todays_charges = 0;
            }

            $arr = array(
                        //  'payment_type' => $payment_type,
                        'paid_date' => date('Y-m-d'),
                        'is_paid' => 1,
                        'total_bill' => $total,
                        'is_today_charge' => $is_today_charge,
                        'todays_charges' => $todays_charges
                        );

            $up = $this->HotelAdminModel->edit_data('user_checkout_data',$wh,$arr);
            
            if($up)
            {
                $arr1 = array(
                                'booking_status' => 2,
                                'actual_checkout' => date('Y-m-d'),
                            );

                $chk = $this->HotelAdminModel->edit_data('user_hotel_booking',$wh1,$arr1);

                if($chk)
                {
                    //guest user status change
                    $wh_gu = '(u_id = "'.$u_id.'" AND hotel_id = "'.$admin_id.'" AND booking_id = "'.$booking_id.'")';
                    
                    $arr_gu = array(
                                    'is_guest' => 2
                                );

                    $this->HotelAdminModel->edit_data('guest_user',$wh_gu,$arr_gu);

                    //room status change
                    
                    $booking_details = $this->HotelAdminModel->getAllData('user_hotel_booking_details',$wh1);

                    if($booking_details)
                    {
                        foreach ($booking_details as $bk) 
                        {
                            $wh_rm_s = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$bk['room_no'].'")';

                            $arr_bk = array(
                                            'room_status' => 1
                                            );

                            $this->HotelAdminModel->edit_data('room_status',$wh_rm_s,$arr_bk);

                        }
                    }

                    //change checkout status for all order
                    $arr_chng_chk = array(
                                        'is_paid_after_check_out' => 1
                                        );

                    $arr_v_wash = array(
                                        'is_paid_checkout' => 1
                                        );
                    $this->HotelAdminModel->edit_data('cloth_orders',$wh_gu,$arr_chng_chk);

                    $this->HotelAdminModel->edit_data('food_orders',$wh_gu,$arr_chng_chk);

                    $this->HotelAdminModel->edit_data('rmservice_services_orders',$wh_gu,$arr_chng_chk);

                    $this->HotelAdminModel->edit_data('room_service_menu_orders',$wh_gu,$arr_chng_chk);

                    $this->HotelAdminModel->edit_data('house_keeping_orders',$wh_gu,$arr_chng_chk);

                    $this->HotelAdminModel->edit_data('vehicle_wash_request',$wh_gu,$arr_v_wash);

                    $this->HotelAdminModel->edit_data('expenses',$wh_gu,$arr_chng_chk);

                    $this->HotelAdminModel->edit_data('luggage_request',$wh_gu,$arr_chng_chk);

                    redirect(base_url('HoteladminController/check_out_view/' . $booking_id.'/'.$u_id));    

                }
            }
        }
    }


    public function add_advance_payment()
    {
        $booking_id = $this->input->post('booking_id');
        $u_id = $this->input->post('u_id');
        $description = $this->input->post('description');
        $total_amt = $this->input->post('total_amt');
        $amount = $this->input->post('amount');
        $payment_type = $this->input->post('payment_type');

        $user_checkout_data_id = $this->input->post('user_checkout_data_id');
        
        $admin_id = $this->session->userdata('u_id');
        
        $wh = '(user_checkout_data_id = "'.$user_checkout_data_id.'")';

        $user_checkout_data = $this->HotelAdminModel->getData('user_checkout_data',$wh);

        if($amount > $total_amt)
        {
            $this->session->set_flashdata('msg','Enter valid Number');
            redirect(base_url('HoteladminController/check_out_view/' . $booking_id.'/'.$u_id));
        }
        else
        {
            if($user_checkout_data['remaing_amt'] == 0)
            {
                $remaing_amt = $user_checkout_data['total_bill'] - $amount;
            }
            else
            {
                $remaing_amt = $user_checkout_data['remaing_amt'] - $amount;
            }

            $arr = array(
                            'advance_payment' => $user_checkout_data['advance_payment'] + $amount,
                            'advance_pay_type' => $payment_type,
                            'advance_pay_date' => date('Y-m-d'),
                            'remaing_amt' => $remaing_amt,
                            'is_paid_advance_payment' => 1,
                        );
          
            $up = $this->HotelAdminModel->edit_data('user_checkout_data',$wh,$arr);

            if($up)
            { 
                redirect(base_url('HoteladminController/check_out_view/' . $booking_id.'/'.$u_id));    
            }
        }
    }

    public function additional_amount_in_checkout()
    {
      
        $booking_id = $this->input->post('booking_id');
        $u_id = $this->input->post('u_id');
        $description = $this->input->post('description');
        $date = $this->input->post('date');
        $amount = $this->input->post('amount');

        $user_checkout_data_id = $this->input->post('user_checkout_data_id');
        
        $admin_id = $this->session->userdata('u_id');
        
        $booking_details = $this->HotelAdminModel->get_user_booking_details($admin_id,$booking_id);
        
        $wh = '(user_checkout_data_id = "'.$user_checkout_data_id.'")';

        $user_checkout_data = $this->HotelAdminModel->getData('user_checkout_data',$wh);

        $wh1 = '(booking_id = "'.$booking_id.'")';

        $remaing_amt = 0;
        
        if($user_checkout_data['advance_payment'] != 0)
        {
            $remaing_amt = $user_checkout_data['remaing_amt'] + $amount;
        }
        
        $arr = array(
                     'total_bill' => $user_checkout_data['total_bill'] + $amount,
                     'remaing_amt' => $remaing_amt
                    );

        $up = $this->HotelAdminModel->edit_data('user_checkout_data',$wh,$arr);
        
        if($up)
        {
            $wh_11 = '(user_checkout_data_id = "'.$user_checkout_data_id.'" AND hotel_id = "'.$admin_id.'" AND description = "'.$description.'")';

            $user_checkout_details = $this->HotelAdminModel->getData('user_checkout_details',$wh_11);

            if($user_checkout_details)
            {
                $arr_11  = array(
                                'date' => $date,
                                'amount' => $amount
                                );

                $up_check_details = $this->HotelAdminModel->edit_data('user_checkout_details',$wh_11,$arr_11);

                if($up_check_details)
                {
                    $wh_1 = '(description_name = "'.$description.'" AND user_checkout_data_id = "'.$user_checkout_data_id.'")';

                    $user_checkout_sub_total_data = $this->HotelAdminModel->getData('user_checkout_sub_total',$wh_1);

                    if($user_checkout_sub_total_data)
                    {
                        $arr_sub = array(
                                        'sub_total' => $user_checkout_sub_total_data['sub_total'] + $amount
                                    );

                        $this->HotelAdminModel->edit_data('user_checkout_sub_total',$wh_1,$arr_sub);
                    }
                }
            }
            else
            {
                $date__1 = $booking_details['check_in'];
                $date__2 = $booking_details['check_out'];
               
                $diff = abs(strtotime($date__2) - strtotime($date__1));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        
                for($i = 0;$i < $days; $i++)
                {  
                    if(date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days')) == $date)
                    {
                        $date1 = $date;
                        $amount1 = $amount;
                    }
                    else
                    {
                        $date1 = date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days'));
                        $amount1 = 0;
                    }

                    $arr1 = array(
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $user_checkout_data_id,
                                'description' => $description,
                                'date' => $date1,
                                'amount' => $amount1
                                );

                    $add_check_details = $this->HotelAdminModel->insert_data('user_checkout_details',$arr1);

                    if($add_check_details)
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
                    }
                }
            }
            redirect(base_url('HoteladminController/check_out_view/' . $booking_id.'/'.$u_id));    
        }
    }
        public function change_business_center_status()
        {
            $status = $this->input->post('status');
            $business_center_id = $this->input->post('id');

            $wh = '(business_center_id = "'.$business_center_id.'")';

            $arr = array(
                            'is_active' => $status
                        );
            
            $update = $this->HotelAdminModel->edit_data('business_center',$wh,$arr);

            if($update)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
		public function ajaxSubIconBlockView()
		{
			
			$postArr = $this->input->post();
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$guest_mng['icon_id'] = $postArr['data_id'];
			$guest_mng['sub_section_icon_id'] = $postArr['sub_section_id'];
			$admin_id = $get_hotel_id['u_id']; 
			$guest_mng['sub_icon_id'] = $postArr['sub_section_id'];
			if($postArr['data_id'] == "10"){
				if($postArr['sub_section_id'] == "1"){
					$service_name = 1;
					$guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
				}else if($postArr['sub_section_id'] == "2"){
					$service_name = 2;
					$guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
				}else if($postArr['sub_section_id'] == "3"){
					$service_name = 3;
					$guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
				}else if($postArr['sub_section_id'] == "4"){
					$service_name = 4;
					$guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
                    $day1 = "Sunday";
			$day2 = "Monday";
			$day3 = "Tuesday";
			$day4 = "Wednesday";
			$day5 = "Thursday";
			$day6 = "Friday";
			$day7 = "Saturday";
            $service_name = 4;
			$guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
			
			$guest_mng['sun_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day1);

			$guest_mng['mon_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day2);

			$guest_mng['tue_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day3);

			$guest_mng['wed_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day4);

			$guest_mng['thurs_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day5);

			$guest_mng['fri_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day6);

			$guest_mng['sat_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id,$day7);
				}else if($postArr['sub_section_id'] == "5"){
					$service_name = 5;
					$guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
				}else if($postArr['sub_section_id'] == "6"){
				
					$guest_mng["vehicle_wash_request"] = $this->HotelAdminModel->get_vehicle_wash_request_list_pagination($admin_id);
                    $guest_mng["vehicle_wash_request1"] = $this->HotelAdminModel->get_vehicle_wash_accepted_request_list_pagination($admin_id);
                    $guest_mng["vehicle_wash_request2"] = $this->HotelAdminModel->get_vehicle_wash_charges_list_pagination($admin_id);
				}else if($postArr['sub_section_id'] == "7"){
				
					$guest_mng["luggage_request"] = $this->HotelAdminModel->get_luggage_request_list_pagination($admin_id);
                    $guest_mng["luggage_request1"] = $this->HotelAdminModel->get_luggage_accepted_request_list_pagination($admin_id);
					$guest_mng["luggage_request2"] = $this->HotelAdminModel->get_luggage_charges_list_pagination($admin_id);
				}else if($postArr['sub_section_id'] == "8"){
					$guest_mng["list"] = $this->HotelAdminModel->get_cab_service_pagination($admin_id);
                    $guest_mng["list1"] = $this->HotelAdminModel->cab_service_completed_pagination($admin_id);
            
				}
               
			}
            if($postArr['data_id'] == "3"){
				if($postArr['sub_section_id'] == "n1"){
			$service_name = 1;
			$guest_mng["today_hotel_book_list_by_app"] = $this->HotelAdminModel->get_user_pending_booking_list_from_app_pagination($admin_id); 
            $guest_mng['list'] = $this->HotelAdminModel->get_user_pending_booking_list_from_app($admin_id);

			$guest_mng['room_type_list'] = $this->HotelAdminModel->get_room_type_list($admin_id);
				}else if($postArr['sub_section_id'] == "n2"){
					$service_name = 2;
                    $guest_mng["list"] = $this->HotelAdminModel->get_checkout_guest_list_pagination($admin_id);
				}
               
			}
			$this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
		}
        public function ajaxSubOrderIconView()
		{
			
			$postArr = $this->input->post();
            // print_r($postArr);
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$guest_mng['icon_id'] = $postArr['data_id'];
			$guest_mng['sub_section_icon_id'] = $postArr['sub_section_id'];
			$admin_id = $get_hotel_id['u_id']; 
			$guest_mng['sub_icon_id'] = $postArr['sub_section_id'];
			if($postArr['data_id'] == "1"){
				if($postArr['sub_section_id'] == "1"){
                    $order_status = 0;

			$user_type = 10;
                    $guest_mng["list"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id,$order_status);
          
                    $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);
                    $guest_mng["list1"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id,1);
                    $guest_mng["list2"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id,2);
                    $guest_mng["list3"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id,3);


				}
                if($postArr['sub_section_id'] == "2"){
                    $order_status = 0;

			$user_type = 10;
            $guest_mng["list"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id,$order_status);
          
            $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id,$user_type);

            $guest_mng["list1"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id,1);  
            $guest_mng["list2"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id,2);  
            $guest_mng["list3"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id,3); 

				}
               
			}
            
			$this->load->view('hoteladmin/ajaxSubOrderIconView', $guest_mng);
		}

        public function assign_room_serv_menu_order_to_staff()
        {
            $room_service_menu_order_id = $this->input->post('room_service_menu_order_id');
            $order_status = $this->input->post('order_status');
            
            $rand_no = rand('1111','9999');

            $wh = '(room_service_menu_order_id = "'.$room_service_menu_order_id.'")';

            $rs_m_order_data = $this->HotelAdminModel->getData('room_service_menu_orders',$wh);

            if($order_status == 1)
            {
                $staff_id = $this->input->post('staff_id');
                $accept_date = date('Y-m-d');
                $reject_date = "";
                $otp = $rand_no;
            }
            else
            {
                $staff_id = 0;
                $accept_date = "";
                $otp = "";
                $reject_date = date('Y-m-d');
            }

            $arr = array(
                         'order_status' => $order_status,
                         'staff_id' => $staff_id,
                         'accept_date' => $accept_date,
                         'reject_date' => $reject_date,
                         'otp' => $otp,
                        );

            $up = $this->HotelAdminModel->edit_data('room_service_menu_orders',$wh,$arr);

            if($up)
            {
                if($order_status == 1)
                {
                    $wh1 = '(room_service_unique_id = "'.$rs_m_order_data['room_service_unique_id'].'")';

                    $arr_rs = array(
                                    'order_status' => $order_status,
                                    'staff_id' => $staff_id,
                                    'accept_date' => $accept_date,
                                    'reject_date' => $reject_date,
                                    'otp' => $otp,
                                );

                    $this->HotelAdminModel->edit_data('rmservice_services_orders',$wh1,$arr);

                    $this->session->set_flashdata('msg','Order Accepted successfully');
                    redirect(base_url('HoteladminController/order_management'));
                }
                else
                {
                    $this->session->set_flashdata('msg','Order Rejected');
                    redirect(base_url('HoteladminController/order_management'));
                }
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('HoteladminController/order_management'));
            }
        }
        public function ajaxSubIconBlockView3()
		{
			
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$admin_id = $get_hotel_id['u_id']; 
			$guest_mng['sub_icon_id'] = 8;
			
            $guest_mng["list"] = $this->HotelAdminModel->get_cab_service_pagination($admin_id);
            $guest_mng["list1"] = $this->HotelAdminModel->cab_service_completed_pagination($admin_id);
            
			
			$this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
		}
        public function ajaxSubIconBlockView2()
		{
			
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$admin_id = $get_hotel_id['u_id']; 
			$guest_mng['sub_icon_id'] = 7;
			
            $guest_mng["luggage_request"] = $this->HotelAdminModel->get_luggage_request_list_pagination($admin_id);
            $guest_mng["luggage_request1"] = $this->HotelAdminModel->get_luggage_accepted_request_list_pagination($admin_id);
            $guest_mng["luggage_request2"] = $this->HotelAdminModel->get_luggage_charges_list_pagination($admin_id);
			
			
			$this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
		}
        public function ajaxSubIconBlockView1()
		{
			
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$admin_id = $get_hotel_id['u_id']; 
			$guest_mng['sub_icon_id'] = 6;
			
            $guest_mng["vehicle_wash_request"] = $this->HotelAdminModel->get_vehicle_wash_request_list_pagination($admin_id);
            $guest_mng["vehicle_wash_request1"] = $this->HotelAdminModel->get_vehicle_wash_accepted_request_list_pagination($admin_id);
            $guest_mng["vehicle_wash_request2"] = $this->HotelAdminModel->get_vehicle_wash_charges_list_pagination($admin_id);
			
			
			$this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
		}


        public function edit_faq()
        {
            $faq_id = $this->input->post('faq_id');
            //$hotel_id = $this->input->post('hotel_id');
            $question = $this->input->post('question');
            $answer = $this->input->post('answer');          
            
            $wh = '(faq_id = "'.$faq_id.'")';

            $arr = array(
                          'question' => $question,
                          'answer' => $answer,
                        );

            $up = $this->HotelAdminModel->edit_data('faq',$wh,$arr);

            if($up)
            {  
               $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
			    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			    
			  	$admin_id = $get_hotel_id['u_id']; 
                $guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);

				$this->load->view('hoteladmin/ajaxFaqList', $guest_mng);
            }
           
        }

        public function ajaxFoodBeverageIcon()
		{
			$postArr = $this->input->post();
			$userType = $this->session->userdata('userType');
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			$guest_mng['icon_id'] = $postArr['data_id'];
			$admin_id = $get_hotel_id['u_id']; 
			if($postArr['data_id'] == 1){
                $guest_mng["list"] = $this->HotelAdminModel->get_facility_list_pagination($admin_id);
             }else if($postArr['data_id'] == 2){
				$guest_mng["facility_list"] = $this->HotelAdminModel->get_facility_category_list_pagination($admin_id);
			}else if($postArr['data_id'] == 3){
                $guest_mng["list"] = $this->HotelAdminModel->get_menu_list_pagination($admin_id);
                $guest_mng['facility_list'] = $this->HotelAdminModel->get_food_facility($admin_id);
           }
           else if($postArr['data_id'] == 4){
            $request_status = 0;
            $request_status1 = 1;
            $request_status2 = 2;
            $guest_mng["list"] = $this->HotelAdminModel->get_reserve_table_pending_list_pagination($admin_id,$request_status);
            $guest_mng["list_accepted"] = $this->HotelAdminModel->get_reserve_table_list_pagination($admin_id,$request_status1);
            $guest_mng["list_rejected"] = $this->HotelAdminModel->get_reserve_table_list_pagination($admin_id,$request_status2);

           
            }
			$this->load->view('hoteladmin/ajaxFoodBeverageIcon', $guest_mng);	
		
		}
         public function delete_faq()
        {
            $faq_id = $this->input->post('id');
            
            $wh = '(faq_id = "'.$faq_id.'")';

            $del = $this->HotelAdminModel->delete_data('faq',$wh);

            if($del)
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }

         public function change_faq_status()
        {
            $status = $this->input->post('status');
            $faq_id = $this->input->post('id');

            $wh = '(faq_id = "'.$faq_id.'")';

            $arr = array(
                            'is_active' => $status
                        );
            
            $update = $this->HotelAdminModel->edit_data('faq',$wh,$arr);

            if($update)
            {
                 $admin_id = $this->session->userdata('u_id');
				$wh_admin = '(u_id ="'.$admin_id.'")';
			    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			    
			  	$admin_id = $get_hotel_id['u_id']; 
                $guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);

				$this->load->view('hoteladmin/ajaxFaqList', $guest_mng);
            }
            else
            {
                echo "0";
            }
        }

        public function manage_handover()
        {
            if($this->session->userdata('u_id'))
            {
               $admin_id = $this->session->userdata('u_id');
              
                $is_complete1 = 0;
                 $handover["manager_pending_list"] = $this->HotelAdminModel->get_manager_handover_list_pagination($admin_id,$is_complete1);
                 $handover["manager_complete_list1"] = $this->HotelAdminModel->get_manager_handover_completed_list_pagination($admin_id,1);

                 $this->load->view('include/header');
                $this->load->view('hoteladmin/manage_handover',$handover);
                $this->load->view('include/footer');
               
            }
            else
            {
                redirect(base_url());
            }
        }
        public function staff_handover()
        {
            if($this->session->userdata('u_id'))
            {
                $admin_id = $this->session->userdata('u_id');
               $handover["staff_pending_list"] = $this->HotelAdminModel->get_staff_handover_pagination($admin_id,0);
               $handover["staff_complete_list"] = $this->HotelAdminModel->get_staff_complete_handover_pagination($admin_id,1);
           
               $this->load->view('include/header');
               $this->load->view('hoteladmin/staff_handover',$handover);
               $this->load->view('include/footer');
                
            }
            else
            {
                redirect(base_url());
            }
        }
 public function add_hotel_privacy_policy()
        {
            $admin_id = $this->session->userdata('u_id');
     
            $content = $this->input->post('content');

            $wh = '(added_by_u_id = "'.$admin_id.'" AND added_by = 1)';

            $hotel_privacy_policy = $this->HotelAdminModel->get_hotel_privacy_policy($admin_id);

            $up = "";
            $add = "";

            if($hotel_privacy_policy)
            {
                $arr = array(
                              'content' => $content,
                              'privacy_policy_for' => 1,
                              'added_by' => 1,
                              'added_by_u_id' => $admin_id,
                            );

                $up = $this->HotelAdminModel->edit_data('privacy_policy',$wh,$arr);
            }
            else
            {
                $arr1 = array(
                              'content' => $content,
                              'privacy_policy_for' => 1,
                              'added_by' => 1,
                              'added_by_u_id' => $admin_id,
                            );

                $add = $this->HotelAdminModel->insert_data('privacy_policy',$arr1);
            }

            if($up || $add)
            {


            	$guest_mng["data"] = $this->HotelAdminModel->get_hotel_privacy_policy($admin_id);
               $this->load->view('hoteladmin/ajaxPrivacyPolicyList', $guest_mng);
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('privacy'));
            }
        }
	

	//fetch rooms nos //archana //21-11-2022 
        public function get_room_nos_list()
        {
            $room_type = $this->input->post('room_type');
            
			$admin_id = $this->session->userdata('u_id');

            $room_no_data = $this->HotelAdminModel->get_room_nos($admin_id,$room_type);

            $output = '<option>--choose Room No--</option>';


            foreach($room_no_data as $rn)
            {
                $available_rm = $this->HotelAdminModel->get_available_room_no($admin_id,$rn['room_no']);

                if($available_rm)
                { 
                    $output .= '<option value="'.$rn['room_no'].'">'.$rn['room_no'].'</option>';
                }
            }

            echo $output;
            
        }

	public function guest_history()
{   
	
		if($this->session->userdata('u_id'))
		{
			$admin_id = $this->session->userdata('u_id');
			$postArray = $this->input->post();
		
			$booking_id=$postArray['booking_id'];
		$u_id=$postArray['u_id1'];

			// print_r($u_id);die;
			$guest_history['booking_history'] = $this->HotelAdminModel->get_user_booking_history($admin_id,$u_id);

			//print_r($guest_history['booking_history']);
          
            /*$config=[
                        'base_url' => base_url('guest_history'),
                        'per_page' =>10,
                        'total_rows' => count($this->HotelAdminModel->get_user_booking_history($admin_id,$u_id)),
                        'full_tag_open'=>"<ul class='pagination pagination-circle'>",
                        'prev_tag_open' =>"<li class=' page-item'>",
                        'prev_tag_close' =>"</li>",
                        'cur_tag_open' =>"<li class='active page-item'><a class='page-link'>",
                        'cur_tag_close' =>"</a></li>",
                        'num_tag_open' =>"<li class=' page-item'>",
                        'num_tag_close' =>"</li>",
                        'next_tag_open' =>"<li class=' page-item'>",
                        'next_tag_close' =>"</li>",
                        'full_tag_close'=>"</ul>"
                    ];

            $this->pagination->initialize($config);

            $guest_history["booking_history"] = $this->HotelAdminModel->get_user_booking_history_pagination($config['per_page'], $this->uri->segment(4),$admin_id,$u_id);*/
          
			$guest_history['user_data'] = $this->HotelAdminModel->get_user_data($u_id);
			$guest_history['booking_details'] = $this->HotelAdminModel->get_user_booking_details($admin_id,$booking_id);
			$guest_history['room_number'] = $this->HotelAdminModel->get_booking_room_details($booking_id);
          	
			// $this->load->view('include/header');
			$this->load->view('hoteladmin/viewGuestHistory', $guest_history);
			// $this->load->view('include/footer');
		}
		else
		{
			redirect(base_url());
		}
}        


public function accept_enquiry_request()
{
	//echo '<pre>';print_r($this->input->post());exit;
	$room_charges = $this->input->post('room_charges');
	$service_tax = $this->input->post('service_tax');
	$luxury_tax = $this->input->post('luxury_tax');

	$hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');
	
	$admin_id = $this->session->userdata('u_id');
  
	$user_data = $this->HotelAdminModel->get_user_data($admin_id);

	$admin_wallet_points = $user_data['wallet_points'];
  
	if($admin_wallet_points < 0  || $admin_wallet_points == 0)
	{
		//$this->session->set_flashdata('msg','Your Wallet Amount is Less');
		$tb_blocks['success'] = 0;
		$tb_blocks['message'] = "Your Wallet Amount is Less";
		echo json_encode($tb_blocks, JSON_UNESCAPED_SLASHES);die;
	}
	else
	{
		  $wh = '(hotel_enquiry_request_id = "'.$hotel_enquiry_request_id.'")';

		  $arr = array(
					  'request_status' => 1,
					  'accept_date' => date('Y-m-d'),
					  'room_charges' => $room_charges,
					  'service_tax' => $service_tax,
					  'luxury_tax' => $luxury_tax,
					  'request_accept_by' => 1,
					  'request_accept_by_u_id' => $admin_id,
					  );

		  $up = $this->HotelAdminModel->edit_data('hotel_enquiry_request',$wh,$arr);

		  if($up)
		  {
			  $user_data = $this->HotelAdminModel->get_user_data($admin_id);
			//  echo '<pre>';print_r($user_data);exit;
			  $city_id = $user_data['city'];

			  $admin_wallet_points = $user_data['wallet_points'];

			  $wh_1 = '(city = "'.$city_id.'")';

			  $lead_recharge_data = $this->HotelAdminModel->getData('leads_recharge',$wh_1);
				if(!empty($lead_recharge_data)){
					$lead_percentage = $lead_recharge_data['lead_percentage'];

					$cut_amount = $room_charges * ($lead_percentage / 100);
	  
					$current_wallet_amount = $admin_wallet_points - ($cut_amount);
				}else{
					$current_wallet_amount = $user_data['wallet_points'];
					$cut_amount = $room_charges;
				}
			

			  $wh_u_id = '(u_id = "'.$admin_id.'")';

			  $arr_u_id = array(
								  'wallet_points' => $current_wallet_amount,
							  );

			  $this->HotelAdminModel->edit_data('register',$wh_u_id,$arr_u_id);

			  $arr_admin_history = array(
										  'hotel_admin_id' => $admin_id,
										  'amount' => $cut_amount,
										  'amount_status' => 2,
									  );

			  $this->HotelAdminModel->insert_data('hotel_admin_wallet_history',$arr_admin_history);

			//   $this->session->set_flashdata('msg','Request accepted Successfully');
			//   redirect(base_url('enquiry_request'));

			$tb_blocks['success'] = 1;
			$admin_id = $this->session->userdata('u_id');
			$wh_admin = '(u_id ="'.$admin_id.'")';
			$get_hotel_id = $this->MainModel->getData('register',$wh_admin);
			
			$admin_id = $get_hotel_id['u_id']; 
			
			$guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id);
			$tb_blocks['tb_block'] = $this->load->view('hoteladmin/ajaxEnquiryRequestList', $guest_mng);									  
			echo json_encode($tb_blocks, JSON_UNESCAPED_SLASHES);die;
		  }
		  else
		  {
			//   $this->session->set_flashdata('msg','Something went wrong');
			//   redirect(base_url('enquiry_request'));
			$tb_blocks['success'] = 0;
			$tb_blocks['message'] = "Something went wrong";
			echo json_encode($tb_blocks, JSON_UNESCAPED_SLASHES);die;
		  }
	}

}
public function accept_enquiry_request1()
{
	$room_charges = $this->input->post('room_charges');
	$service_tax = $this->input->post('service_tax');
	$luxury_tax = $this->input->post('luxury_tax');

	$hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');
	
	$admin_id = $this->session->userdata('u_id');
  
	$user_data = $this->MainModel->get_user_data($admin_id);

	$admin_wallet_points = $user_data['wallet_points'];
  
	if($admin_wallet_points < 0  || $admin_wallet_points == 0)
	{
		$this->session->set_flashdata('msg','Your Wallet Amount is Less');
		redirect(base_url('HoteladminController/frontOfficeList'));
	}
	else
	{
		  $wh = '(hotel_enquiry_request_id = "'.$hotel_enquiry_request_id.'")';

		  $arr = array(
					  'request_status' => 1,
					  'accept_date' => date('Y-m-d'),
					  'room_charges' => $room_charges,
					  'service_tax' => $service_tax,
					  'luxury_tax' => $luxury_tax,
					  'request_accept_by' => 1,
					  'request_accept_by_u_id' => $admin_id,
					  );

		  $up = $this->HotelAdminModel->edit_data('hotel_enquiry_request',$wh,$arr);

		  if($up)
		  {
			  $user_data = $this->MainModel->get_user_data($admin_id);

			  $city_id = $user_data['city'];

			  $admin_wallet_points = $user_data['wallet_points'];

			  $wh_1 = '(city = "'.$city_id.'")';

			  $lead_recharge_data = $this->MainModel->getData('leads_recharge',$wh_1);
			// print_r($lead_recharge_data);die;
             
		      if(!empty($lead_recharge_data))
		      {
		      $lead_percentage = $lead_recharge_data['lead_percentage'];

			  $cut_amount = $room_charges * ($lead_percentage / 100);

			  $current_wallet_amount = $admin_wallet_points - ($cut_amount);
		      }
		      else
		      {
			  $cut_amount = $room_charges;

			  $current_wallet_amount = $admin_wallet_points - ($cut_amount);
		      }

			  $wh_u_id = '(u_id = "'.$admin_id.'")';

			  $arr_u_id = array(
								  'wallet_points' => $current_wallet_amount,
							  );

			  $this->HotelAdminModel->edit_data('register',$wh_u_id,$arr_u_id);

			  $arr_admin_history = array(
										  'hotel_admin_id' => $admin_id,
										  'amount' => $cut_amount,
										  'amount_status' => 2,
									  );

			  $this->HotelAdminModel->insert_data('hotel_admin_wallet_history',$arr_admin_history);

			  $this->session->set_flashdata('msg','Request accepted Successfully');
			  redirect(base_url('HoteladminController/frontOfficeList'));
		  }
		  else
		  {
			  $this->session->set_flashdata('msg','Something went wrong');
			  redirect(base_url('HoteladminController/frontOfficeList'));
		  }
	}

}
public function request_accept()
{
    // $request_status = $this->input->post('request_status');
    
    $admin_id = $this->session->userdata('u_id');

    $vehicle_wash_request_id = $this->uri->segment(3);

    $wh = '(vehicle_wash_request_id = "'.$vehicle_wash_request_id.'")';

    $arr = array(
                    'request_status' => 1,
                    'accept_date' => date('Y-m-d'),
                    'assign_by' => 1,
                    'assign_by_u_id' => $admin_id,
                );

    $up = $this->HotelAdminModel->edit_data('vehicle_wash_request',$wh,$arr);

    if($up)
    {
        $this->session->set_flashdata('msg','Request accepted successfully');
        redirect(base_url('HoteladminController/frontOfficeList'));
    }
    else
    {
        $this->session->set_flashdata('msg','Something went wrong');
        redirect(base_url('HoteladminController/frontOfficeList'));
    }
}
public function request_reject()
{ 
    $admin_id = $this->session->userdata('u_id');

    $vehicle_wash_request_id = $this->uri->segment(3);

    $wh = '(vehicle_wash_request_id = "'.$vehicle_wash_request_id.'")';

    $arr = array(
                    'request_status' => 2,
                    'assign_by' => 1,
                    'assign_by_u_id' => $admin_id,
                );

    $up = $this->HotelAdminModel->edit_data('vehicle_wash_request',$wh,$arr);

    if($up)
    {
        $this->session->set_flashdata('msg','Request rejected successfully');
        redirect(base_url('HoteladminController/frontOfficeList'));
    }
    else
    {
        $this->session->set_flashdata('msg','Something went wrong');
        redirect(base_url('HoteladminController/frontOfficeList'));
    }
}

public function add_vehicle_washing_charges()
{
    $vehicle_type = $this->input->post('vehicle_type');
    $charges = $this->input->post('charges');

    $admin_id = $this->session->userdata('u_id');

    $wh = '(vehicle_type = "'.$vehicle_type.'" AND hotel_id = "'.$admin_id.'")';

    $vehicle_washing_charges_data = $this->HotelAdminModel->getData('vehicle_washing_charges',$wh);

    if($vehicle_washing_charges_data)
    {
        $this->session->set_flashdata('msg','Data Already Exits');
        redirect(base_url('HoteladminController/frontOfficeList'));
    }
    else
    {
        $arr = array(
                        'hotel_id' => $admin_id,
                        'vehicle_type' => $vehicle_type,
                        'charges' => $charges,
                        'added_by' => 1,
                        'added_by_u_id' => $admin_id,
                    );

        $add = $this->HotelAdminModel->insert_data('vehicle_washing_charges',$arr);

        if($add)
        {
            $this->session->set_flashdata('msg','Vehicle washing charges Added Successfully');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }

    
}
public function edit_vehicle_washing_charges()
{
    $vehicle_type = $this->input->post('vehicle_type');
    $charges = $this->input->post('charges');

    $vehicle_washing_charge_id = $this->input->post('vehicle_washing_charge_id');

    $wh = '(vehicle_washing_charge_id = "'.$vehicle_washing_charge_id.'")';

    $arr = array(
                    'vehicle_type' => $vehicle_type,
                    'charges' => $charges,
                );

    $up = $this->HotelAdminModel->edit_data('vehicle_washing_charges',$wh,$arr);

    if($up)
    {
        $this->session->set_flashdata('msg','Data Updated Successfully');
        redirect(base_url('HoteladminController/frontOfficeList'));
    }
    else
    {
        $this->session->set_flashdata('msg','Something went wrong');
        redirect(base_url('HoteladminController/frontOfficeList'));
    }
}

public function delete_vehicle_washing_charges()
{
    $vehicle_washing_charge_id = $this->input->post('id');
    
    $wh = '(vehicle_washing_charge_id = "'.$vehicle_washing_charge_id.'")';

    $del = $this->HotelAdminModel->delete_data('vehicle_washing_charges',$wh);

    if($del)
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
}

public function add_hotel_guidelines()
{
    $admin_id = $this->session->userdata('u_id');

    $content = $this->input->post('content');

    $wh = '(hotel_id = "'.$admin_id.'")';

    $hotel_guidelines_data = $this->HotelAdminModel->getData('hotel_guidelines',$wh);

    $up = "";
    $add = "";

    if($hotel_guidelines_data)
    {
        $arr_up = array(
                    'content' => $content,
                    );

        $up = $this->HotelAdminModel->edit_data('hotel_guidelines',$wh,$arr_up);
    }
    else
    {
        $arr_add =  array(
                      'hotel_id' => $admin_id,
                      'content' => $content,
                      'added_by' => 1,
                      'added_by_u_id' => $admin_id,
                    );

        $add = $this->HotelAdminModel->insert_data('hotel_guidelines',$arr_add);
    }
    
    if($add || $up)
    {
        $this->session->set_flashdata('msg','Data added Successfully..');
        redirect(base_url('HoteladminController/frontOfficeList'));
    }
    else
    {
        $this->session->set_flashdata('msg','Something went wrong');
        redirect(base_url('HoteladminController/frontOfficeList'));
    }
}

	
}