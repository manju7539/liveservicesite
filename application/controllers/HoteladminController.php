<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HoteladminController extends CI_Controller
{

    function __construct()
    {
        // error_reporting(0);
        // ini_set('display_errors', 0);
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->model('HotelAdminModel');
        $this->load->model('FrontofficeModel');
        $this->load->model('FoodAdminModel');
        $this->load->model('MainModel');
        $this->load->helper('notification_helper');
        if (empty($this->session->userdata('u_id'))) {
            redirect('/');
        }
        // $this->load->library('pagination');   
    }
    public function guestList()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $guest_mng["type"]  = !empty($postArr['type']) ? $postArr['type'] : '';

        $admin_id = $get_hotel_id['u_id'];
        if (isset($_POST['date1']) && isset($_POST['date2']) && isset($_POST['guest_name'])) {
            $guest_mng['room_type'] = $this->HotelAdminModel->get_room_type_list1($admin_id);
            $guest_mng['availble_rooms'] = $this->HotelAdminModel->get_room_no_list($admin_id);
            $guest_mng["list"] = $this->HotelAdminModel->get_guest_list_pagination1($admin_id, $_POST['date1'], $_POST['date2'], $_POST['guest_name']);
            $guest_mng['list1'] = $this->HotelAdminModel->get_departure_guest_list($admin_id);
            $guest_mng["today_hotel_book_list_by_app"] = $this->HotelAdminModel->get_user_pending_booking_list_from_app_pagination($admin_id);
            $guest_mng['list2'] = $this->HotelAdminModel->get_user_pending_booking_list_from_app($admin_id);
            $guest_mng['room_type_list'] = $this->HotelAdminModel->get_room_type_list($admin_id);
            $guest_mng['list_uc'] = $this->HotelAdminModel->get_upcoming_guest_list_pagination($admin_id);
        } else {
            $guest_mng['room_type'] = $this->HotelAdminModel->get_room_type_list1($admin_id);
            $guest_mng['availble_rooms'] = $this->HotelAdminModel->get_room_no_list($admin_id);
            $guest_mng["list"] = $this->HotelAdminModel->get_guest_list_pagination($admin_id);
            // echo "<pre>";
            // print_r($guest_mng["list"]);
            // die;
            $guest_mng['list1'] = $this->HotelAdminModel->get_departure_guest_list($admin_id);
            $guest_mng["today_hotel_book_list_by_app"] = $this->HotelAdminModel->get_user_pending_booking_list_from_app_pagination($admin_id);
            $guest_mng['list2'] = $this->HotelAdminModel->get_user_pending_booking_list_from_app($admin_id);
            $guest_mng['room_type_list'] = $this->HotelAdminModel->get_room_type_list($admin_id);
            $guest_mng['list_uc'] = $this->HotelAdminModel->get_upcoming_guest_list_pagination($admin_id);
        }
        $this->load->view('include/header');
        $this->load->view('hoteladmin/viewGuestList', $guest_mng);
        $this->load->view('include/footer');
    }
    public function changeFoodCat()
    {
        $food_facility_id = $this->input->post('food_facility_id');

        $admin_id = $this->session->userdata('u_id');

        $food_cat = $this->HotelAdminModel->get_food_category($admin_id, $food_facility_id);

        $output = '<option>---Choose Food Category--</option>';

        foreach ($food_cat as $fc) {
            $output .= '<option value="' . $fc['food_category_id'] . '">' . $fc['category_name'] . '</option>';
        }

        echo $output;
    }
    public function add_guest_count()
    {
        $adult = $this->input->post('adult');

        $child = $this->input->post('child');


        // $wh = '(r_s_min_bar_id = "'.$minibar.'")';

        // $room_servs_mini_bar =  $this->MainModel->getData('room_servs_mini_bar',$wh);

        $output = '';

        $output .=  $adult + $child;
        // print_r($output);exit;
        echo $output;
    }
    public function extend_checkout_data()
    {
        $booking_id = $this->input->post('booking_id');

        $booking_details_id = $this->input->post('booking_details_id', TRUE);

        $check_out = $this->input->post('check_out');

        $room_type = $this->input->post('room_type'); //multiple
        $room_no = $this->input->post('room_no'); //multiple

        $admin_id = $this->session->userdata('u_id');
        // print_r($this->session->userdata());die;
        $wh = '(booking_id = "' . $booking_id . '")';

        $arr = array(
            'extend_check_out' => $check_out
        );

        $up  = $this->HotelAdminModel->edit_data('user_hotel_booking', $wh, $arr);

        if ($up) {
            //edit room data
            $count = count($room_type);

            for ($i = 0; $i < $count; $i++) {
                $wh1 = '(booking_details_id = "' . $booking_details_id[$i] . '")';

                $rm_data = $this->HotelAdminModel->get_room_nos_data($admin_id, $room_type[$i], $room_no[$i]);
                if (!empty($rm_data)) {
                    $p =  $rm_data['price'];
                } else {
                    $p = 0;
                }
                $arr1 = array(
                    'extend_room_no' => $room_no[$i],
                    'extend_room_type' => $room_type[$i],
                    'extend_room_price' => $p,
                );

                $add_details = $this->HotelAdminModel->edit_data('user_hotel_booking_details', $wh1, $arr1);

                if ($add_details) {
                    //add total charges
                    $wh_detail = '(booking_id = "' . $booking_id . '")';

                    $booking_data = $this->HotelAdminModel->getData('user_hotel_booking', $wh_detail);

                    $arr_up = array(
                        'total_charges' => $booking_data['total_charges'] + $p,
                    );

                    $this->HotelAdminModel->edit_data('user_hotel_booking', $wh_detail, $arr_up);

                    //change room status
                    $wh_rm_st = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $room_no[$i] . '")';

                    $arr_rm_st = array(
                        'room_status' => 2
                    );

                    $this->HotelAdminModel->edit_data('room_status', $wh_rm_st, $arr_rm_st);
                }

                //add extended date
                $user_checkout_data = $this->HotelAdminModel->getData('user_checkout_data', $wh);

                $description_lx = "GST";
                $description_s = "Other Tax";

                $description_hk = "Housekeeping";
                $description_ld = "Laundry";
                $description_fd = "Bar And Restaurant";
                $description_rs = "Room Service Menu";

                $wh_ch_d_gst = '(user_checkout_data_id = "' . $user_checkout_data['user_checkout_data_id'] . '" AND description = "' . $description_lx . '")';

                $user_checkout_details_gst = $this->HotelAdminModel->getData('user_checkout_details', $wh_ch_d_gst);

                $wh_ch_d_o_tax = '(user_checkout_data_id = "' . $user_checkout_data['user_checkout_data_id'] . '" AND description = "' . $description_s . '")';

                $user_checkout_details_o_tax = $this->HotelAdminModel->getData('user_checkout_details', $wh_ch_d_o_tax);

                $wh_ch_d_hk = '(user_checkout_data_id = "' . $user_checkout_data['user_checkout_data_id'] . '" AND description = "' . $description_hk . '")';

                $user_checkout_details_hk = $this->HotelAdminModel->getData('user_checkout_details', $wh_ch_d_hk);

                $wh_ch_d_ld = '(user_checkout_data_id = "' . $user_checkout_data['user_checkout_data_id'] . '" AND description = "' . $description_ld . '")';

                $user_checkout_details_ld = $this->HotelAdminModel->getData('user_checkout_details', $wh_ch_d_ld);

                $wh_ch_d_fd = '(user_checkout_data_id = "' . $user_checkout_data['user_checkout_data_id'] . '" AND description = "' . $description_fd . '")';

                $user_checkout_details_fd = $this->HotelAdminModel->getData('user_checkout_details', $wh_ch_d_fd);

                $wh_ch_d_rs = '(user_checkout_data_id = "' . $user_checkout_data['user_checkout_data_id'] . '" AND description = "' . $description_rs . '")';

                $user_checkout_details_rs = $this->HotelAdminModel->getData('user_checkout_details', $wh_ch_d_ld);

                if ($user_checkout_data) {
                    $wh_rt = '(room_type_id = "' . $room_type[$i] . '")';

                    $room_type_data = $this->HotelAdminModel->getData('room_type', $wh_rt);

                    $date = $booking_data['check_in'];
                    $date1 = $booking_data['check_out'];
                    $date2 = $booking_data['extend_check_out'];

                    $diff = abs(strtotime($date2) - strtotime($date1));

                    $years = floor($diff / (365 * 60 * 60 * 24));
                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                    $user_checkout_data_id = $user_checkout_data['user_checkout_data_id'];

                    //room charges
                    for ($j = 0; $j < $days; $j++) {
                        $description = "Room Charges";

                        $check_out = $booking_data['extend_check_out'];

                        $check_in = $booking_data['check_out'];

                        $wh_chk_d_rc = '(user_checkout_data_id = "' . $user_checkout_data_id . '" AND description = "' . $description . '" AND date = "' . date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $j . 'days')) . '")';

                        $u_chk_d_rc = $this->HotelAdminModel->getData('user_checkout_details', $wh_chk_d_rc);

                        $add_rm_charges = "";

                        if (empty($u_chk_d_rc)) {
                            if (($check_in >= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $j . 'days')) && $check_out <= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $j . 'days'))) || ($check_in <= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $j . 'days')) && $check_out >= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $j . 'days')))) {
                                $amount1 = $room_type_data['price'];
                            } else {
                                $amount1 = 0;
                            }

                            $arr1 = array(
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $user_checkout_data_id,
                                'description' => $description,
                                'date' => date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $j . 'days')),
                                'amount' => $amount1
                            );

                            $add_rm_charges = $this->HotelAdminModel->insert_data('user_checkout_details', $arr1);
                        } else {
                            if (($check_in >= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $j . 'days')) && $check_out <= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $j . 'days'))) || ($check_in <= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $j . 'days')) && $check_out >= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $j . 'days')))) {
                                $amount1 = $room_type_data['price'];
                            } else {
                                $amount1 = 0;
                            }

                            $arr_rc_up = array(
                                'amount' => $amount1
                            );

                            $add_rm_charges = $this->HotelAdminModel->edit_data('user_checkout_details', $wh_chk_d_rc, $arr_rc_up);
                        }

                        if ($add_rm_charges) {
                            $wh1 = '(hotel_id = "' . $admin_id . '" AND user_checkout_data_id = "' . $user_checkout_data_id . '" AND description_name = "' . $description . '")';

                            $user_checkout_sub_total = $this->HotelAdminModel->getData('user_checkout_sub_total', $wh1);

                            //add subtotal
                            if ($user_checkout_sub_total) {
                                $st_arr1 = array(
                                    'sub_total' => $user_checkout_sub_total['sub_total'] + $amount1
                                );

                                $this->HotelAdminModel->edit_data('user_checkout_sub_total', $wh1, $st_arr1);
                            } else {
                                //edit subtotal
                                $st_arr2 = array(
                                    'hotel_id' => $admin_id,
                                    'user_checkout_data_id' => $user_checkout_data_id,
                                    'description_name' => $description,
                                    'sub_total' => $amount1
                                );

                                $this->HotelAdminModel->insert_data('user_checkout_sub_total', $st_arr2);
                            }

                            //add total bill
                            $wh_ck = '(user_checkout_data_id = "' . $user_checkout_data_id . '")';

                            $user_checkout_data1 = $this->HotelAdminModel->getData('user_checkout_data', $wh_ck);

                            $tot_arr1 = array(
                                'total_bill' => $user_checkout_data1['total_bill'] + $room_type_data['price']
                            );

                            $this->HotelAdminModel->edit_data('user_checkout_data', $wh_ck, $tot_arr1);
                        }
                    }

                    //GST
                    for ($k = 0; $k < $days; $k++) {
                        $description_lx = "GST";

                        $check_out = $booking_data['extend_check_out'];

                        $check_in = $booking_data['check_out'];

                        $lt_amount = $user_checkout_details_gst['amount'] ?? 0;

                        $wh_chk_d_lx = '(user_checkout_data_id = "' . $user_checkout_data_id . '" AND description = "' . $description_lx . '" AND date = "' . date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $k . 'days')) . '")';

                        $u_chk_d_lx = $this->HotelAdminModel->getData('user_checkout_details', $wh_chk_d_lx);

                        $add_lux = "";

                        if (empty($u_chk_d_lx)) {
                            if (($check_in >= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $k . 'days')) && $check_out <= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $k . 'days'))) || ($check_in <= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $k . 'days')) && $check_out >= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $k . 'days')))) {
                                $lt_amount1 = $lt_amount;
                            } else {
                                $lt_amount1 = 0;
                            }

                            $arr_lx = array(
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $user_checkout_data_id,
                                'description' => $description_lx,
                                'date' => date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $k . 'days')),
                                'amount' => $lt_amount1
                            );

                            $add_lux = $this->HotelAdminModel->insert_data('user_checkout_details', $arr_lx);
                        }

                        if ($add_lux) {
                            $wh13 = '(hotel_id = "' . $admin_id . '" AND user_checkout_data_id = "' . $user_checkout_data_id . '" AND description_name = "' . $description_lx . '")';

                            $user_checkout_sub_total2 = $this->HotelAdminModel->getData('user_checkout_sub_total', $wh13);

                            //add subtotal
                            if ($user_checkout_sub_total2) {
                                $st_arr13 = array(
                                    'sub_total' => $user_checkout_sub_total2['sub_total'] + $lt_amount1
                                );

                                $this->HotelAdminModel->edit_data('user_checkout_sub_total', $wh13, $st_arr13);
                            } else {
                                //edit subtotal
                                $st_arr23 = array(
                                    'hotel_id' => $admin_id,
                                    'user_checkout_data_id' => $user_checkout_data_id,
                                    'description_name' => $description_lx,
                                    'sub_total' => $lt_amount1
                                );

                                $this->HotelAdminModel->insert_data('user_checkout_sub_total', $st_arr23);
                            }

                            //add total bill
                            $wh_ck3_1 = '(user_checkout_data_id = "' . $user_checkout_data_id . '")';

                            $user_checkout_data1_3 = $this->HotelAdminModel->getData('user_checkout_data', $wh_ck3_1);

                            $tot_arr3 = array(
                                'total_bill' => $user_checkout_data1_3['total_bill'] + $lt_amount1
                            );

                            $this->HotelAdminModel->edit_data('user_checkout_data', $wh_ck3_1, $tot_arr3);
                        }
                    }

                    //other tax
                    for ($l = 0; $l < $days; $l++) {
                        $description_s = "Other Tax";

                        $check_out = $booking_data['extend_check_out'];

                        $check_in = $booking_data['check_out'];

                        $s_amount = $user_checkout_details_o_tax['amount'] ?? 0;

                        $wh_chk_d_ot = '(user_checkout_data_id = "' . $user_checkout_data_id . '" AND description = "' . $description_s . '" AND date = "' . date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $l . 'days')) . '")';

                        $u_chk_d_ot = $this->HotelAdminModel->getData('user_checkout_details', $wh_chk_d_ot);

                        $add_ser = "";

                        if (empty($u_chk_d_ot)) {
                            if (($check_in >= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $l . 'days')) && $check_out <= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $l . 'days'))) || ($check_in <= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $l . 'days')) && $check_out >= date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $l . 'days')))) {
                                $s_amount1 = $s_amount;
                            } else {
                                $s_amount1 = 0;
                            }

                            $arr_s = array(
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $user_checkout_data_id,
                                'description' => $description_s,
                                'date' => date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $l . 'days')),
                                'amount' => $s_amount1
                            );

                            $add_ser = $this->HotelAdminModel->insert_data('user_checkout_details', $arr_s);
                        }

                        if ($add_ser) {
                            $wh12 = '(hotel_id = "' . $admin_id . '" AND user_checkout_data_id = "' . $user_checkout_data_id . '" AND description_name = "' . $description_s . '")';

                            $user_checkout_sub_total1 = $this->HotelAdminModel->getData('user_checkout_sub_total', $wh12);

                            //add subtotal
                            if ($user_checkout_sub_total1) {
                                $st_arr12 = array(
                                    'sub_total' => $user_checkout_sub_total1['sub_total'] + $s_amount1
                                );

                                $this->HotelAdminModel->edit_data('user_checkout_sub_total', $wh12, $st_arr12);
                            } else {
                                //edit subtotal
                                $st_arr22 = array(
                                    'hotel_id' => $admin_id,
                                    'user_checkout_data_id' => $user_checkout_data_id,
                                    'description_name' => $description_s,
                                    'sub_total' => $s_amount1
                                );

                                $this->HotelAdminModel->insert_data('user_checkout_sub_total', $st_arr22);
                            }

                            //add total bill
                            $wh_ck1 = '(user_checkout_data_id = "' . $user_checkout_data_id . '")';

                            $user_checkout_data11 = $this->HotelAdminModel->getData('user_checkout_data', $wh_ck1);

                            $tot_arr2 = array(
                                'total_bill' => $user_checkout_data11['total_bill'] + $s_amount1
                            );

                            $this->HotelAdminModel->edit_data('user_checkout_data', $wh_ck1, $tot_arr2);
                        }
                    }

                    //if any service add this then add date
                    //Housekeeping
                    if ($user_checkout_details_hk) {
                        for ($m = 0; $m < $days; $m++) {
                            $check_out = $booking_data['extend_check_out'];

                            $check_in = $booking_data['check_out'];

                            $wh_chk_d_hk = '(user_checkout_data_id = "' . $user_checkout_data_id . '" AND description = "' . $description_hk . '" AND date = "' . date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $m . 'days')) . '")';

                            $u_chk_d_hk = $this->HotelAdminModel->getData('user_checkout_details', $wh_chk_d_hk);

                            $add_hk = "";

                            if (empty($u_chk_d_hk)) {
                                $arr_hk = array(
                                    'hotel_id' => $admin_id,
                                    'user_checkout_data_id' => $user_checkout_data_id,
                                    'description' => $description_ld,
                                    'date' => date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $m . 'days')),
                                    'amount' => 0
                                );

                                $add_hk = $this->HotelAdminModel->insert_data('user_checkout_details', $arr_hk);
                            }
                        }
                    }

                    //Laundry
                    if ($user_checkout_details_ld) {
                        for ($n = 0; $n < $days; $n++) {
                            $check_out = $booking_data['extend_check_out'];

                            $check_in = $booking_data['check_out'];

                            $wh_chk_d_ld = '(user_checkout_data_id = "' . $user_checkout_data_id . '" AND description = "' . $description_ld . '" AND date = "' . date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $n . 'days')) . '")';

                            $u_chk_d_ld = $this->HotelAdminModel->getData('user_checkout_details', $wh_chk_d_ld);

                            $add_ld = "";

                            if (empty($u_chk_d_ld)) {
                                $arr_hld = array(
                                    'hotel_id' => $admin_id,
                                    'user_checkout_data_id' => $user_checkout_data_id,
                                    'description' => $description_ld,
                                    'date' => date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $n . 'days')),
                                    'amount' => 0
                                );

                                $add_ld = $this->HotelAdminModel->insert_data('user_checkout_details', $arr_hld);
                            }
                        }
                    }

                    //Food
                    if ($user_checkout_details_fd) {
                        for ($o = 0; $o < $days; $o++) {
                            $check_out = $booking_data['extend_check_out'];

                            $check_in = $booking_data['check_out'];

                            $wh_chk_d_fd = '(user_checkout_data_id = "' . $user_checkout_data_id . '" AND description = "' . $description_fd . '" AND date = "' . date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $o . 'days')) . '")';

                            $u_chk_d_fd = $this->HotelAdminModel->getData('user_checkout_details', $wh_chk_d_fd);

                            $add_fd = "";

                            if (empty($u_chk_d_fd)) {
                                $arr_fd = array(
                                    'hotel_id' => $admin_id,
                                    'user_checkout_data_id' => $user_checkout_data_id,
                                    'description' => $description_fd,
                                    'date' => date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $o . 'days')),
                                    'amount' => 0
                                );

                                $add_fd = $this->HotelAdminModel->insert_data('user_checkout_details', $arr_fd);
                            }
                        }
                    }

                    //Room Service
                    if ($user_checkout_details_rs) {
                        for ($p = 0; $p < $days; $p++) {
                            $check_out = $booking_data['extend_check_out'];

                            $check_in = $booking_data['check_out'];

                            $wh_chk_d_rs = '(user_checkout_data_id = "' . $user_checkout_data_id . '" AND description = "' . $description_rs . '" AND date = "' . date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $p . 'days')) . '")';

                            $u_chk_d_rs = $this->HotelAdminModel->getData('user_checkout_details', $wh_chk_d_rs);

                            $add_fd = "";

                            if (empty($u_chk_d_rs)) {
                                $arr_rs = array(
                                    'hotel_id' => $admin_id,
                                    'user_checkout_data_id' => $user_checkout_data_id,
                                    'description' => $description_rs,
                                    'date' => date('Y-m-d', strtotime($booking_data['check_out'] . '+' . $p . 'days')),
                                    'amount' => 0
                                );

                                $add_fd = $this->HotelAdminModel->insert_data('user_checkout_details', $arr_rs);
                            }
                        }
                    }
                }
            }

            $this->session->set_flashdata('msg', 'Data Updated Successfully');
            redirect(base_url('HoteladminController/guestList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/guestList'));
        }
    }
    public function getBanquetData()
    {
        $wh = $this->input->post('id');
        // $data['add']= $this->MainModel->getdepartment($config['per_page'], $this->uri->segment(2));
        $data = $this->HotelAdminModel->getbanquetedit($wh);
        // echo "<pre>";
        // print_r($data);
        // exit;

        echo json_encode($data);
    }
    // public function delete_facility_category()
    // {          
    //       $id=$this->input->post('cat_id');

    //       $where = '(food_category_id = "'.$id.'")';
    //       $result= $this->MainModel->deleteData($tbl="food_category", $where);

    //       if($result)
    //       {
    //         echo "1";
    //       }
    //       else
    //       { 
    //         echo "0";
    //       }

    // }
    public function banquet_hall()
    {
        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');
            $wh = '(hotel_id ="' . $admin_id . '")';

            $banquet_hall["list"] = $this->HotelAdminModel->get_banquet_hall_pagination($admin_id);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/banquet_hall', $banquet_hall);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
    }
    public function delete_banquet_hall()
    {
        $banquet_hall_id = $this->input->post('id');

        $wh = '(banquet_hall_id = "' . $banquet_hall_id . '")';

        $del = $this->HotelAdminModel->delete_data('banquet_hall', $wh);

        $del = $this->HotelAdminModel->delete_data('banquet_hall_images', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $banquet_hall["list"] = $this->HotelAdminModel->get_banquet_hall_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxBanquetList', $banquet_hall);
        } else {
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

        $banquet_hall_image_id = $this->input->post('banquet_hall_image_id', TRUE);
        $wh = '(banquet_hall_id = "' . $banquet_hall_id . '")';

        $banquet_data = $this->HotelAdminModel->getData('banquet_hall_images', $wh);
        // print_r($banquet_data);die;
        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];

            $path = 'assets/upload/banquet_hall_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {

                $file_data = $this->upload->data();

                $image = base_url() . $path . $file_data['file_name'];

                $imgarr = array(
                    'images' => $image,
                );

                $up = $this->HotelAdminModel->edit_data_banquet_image('banquet_hall_images', $wh, $imgarr);
            } else {

                $this->session->set_flashdata('msg', 'Error to upload image');
                redirect(base_url('HoteladminController/banquet_hall'));
            }
        } else {

            $image = $banquet_data['images'];
        }
        $arr = array(
            'banquet_hall_name' => $banquet_hall_name,
            'no_of_people' => $no_of_people,
            'description' => $description,
        );
        $up = $this->HotelAdminModel->edit_data('banquet_hall', $wh, $arr);
        $banquet_hall["list"] = $this->HotelAdminModel->get_banquet_hall_pagination($admin_id);
        if ($up) {
            // $this->session->set_flashdata('msg','Offers Updated Successfully...');
            $this->load->view('hoteladmin/ajaxBanquetList', $banquet_hall);
            // redirect(base_url('HoteladminController/offerList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/offerList'));
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

        $add = $this->HotelAdminModel->insert_data('banquet_hall', $arr1);
        $banquet_hall["list"] = $this->HotelAdminModel->get_banquet_hall_pagination($admin_id);
        if ($add) {
            // add multiple images
            $count = count($_FILES['image']['name'], TRUE);

            for ($i = 0; $i < $count; $i++) {
                if (!empty($_FILES['image']['name'][$i])) {
                    $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                    $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                    $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                    $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                    $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];

                    $path = 'assets/upload/banquet_hall_img/';
                    $file_path = './' . $path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('my_uploaded_file')) {
                        $file_data = $this->upload->data();

                        $image = base_url() . $path . $file_data['file_name'];

                        $arr1 = array(
                            'hotel_id' => $admin_id,
                            'banquet_hall_id' => $add,
                            'images' => $image,
                        );

                        $this->HotelAdminModel->insert_data('banquet_hall_images', $arr1);
                    }
                }
            }

            $this->session->set_flashdata('msg', 'Data Added Successfully...');
            // redirect(base_url('HoteladminController/banquet_hall'));
            $this->load->view('hoteladmin/ajaxBanquetList', $banquet_hall);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/banquet_hall'));
        }
    }

    public function hotel_information()
    {
        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');

            $hotel_information['data'] = $this->HotelAdminModel->get_user_data($admin_id);
            //echo "<pre>";
            //print_r($hotel_information['data']);

            $hotel_information['facility_list'] = $this->HotelAdminModel->get_hotels_facility($admin_id);

            $hotel_information['leads_purchase_list'] = $this->HotelAdminModel->get_hotel_admin_leads($admin_id);

            $hotel_information['hotels_pics'] = $this->HotelAdminModel->get_hotel_photos($admin_id);

            $this->load->view('include/header');
            $this->load->view('hoteladmin/hotel_information', $hotel_information);
            $this->load->view('include/footer');
        } else {
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

        $hotel_photo_id = $this->input->post('hotel_photo_id', TRUE); // image id

        $admin_id = $this->session->userdata('u_id');

        $wh = '(u_id = "' . $admin_id . '")';

        $wh1 = '(hotel_id = "' . $admin_id . '")';

        $hotels_facility = $this->HotelAdminModel->getData('hotel_facility', $wh1);

        $hotel_data = $this->HotelAdminModel->getData('register', $wh);

        //add multiple hotesl photos
        if (isset($_FILES['images']['name'])) {
            $count_img = count($_FILES['images']['name'], TRUE);

            for ($i = 0; $i < $count_img; $i++) {
                if (!empty($_FILES['images']['name'][$i])) {
                    $_FILES['my_file']['name'] = $_FILES['images']['name'][$i];
                    $_FILES['my_file']['type'] = $_FILES['images']['type'][$i];
                    $_FILES['my_file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                    $_FILES['my_file']['size'] = $_FILES['images']['size'][$i];
                    $_FILES['my_file']['error'] = $_FILES['images']['error'][$i];

                    $path = 'assets/upload/hotels_photos/';
                    $file_path = './' . $path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('my_file')) {
                        $file_data = $this->upload->data();

                        $images = base_url() . $path . $file_data['file_name'];

                        $arr1 = array(
                            'hotel_id' => $admin_id,
                            'images' => $images
                        );

                        $this->HotelAdminModel->insert_data('hotel_photos', $arr1);
                    }
                }
            }
        }

        // add facility 
        if (isset($_POST['facility_name'])) {
            // add multiple facility
            $del = $this->HotelAdminModel->delete_data('hotel_facility', $wh1);

            if ($del) {
                $facility = $_POST['facility_name'];

                $facility_string = $facility[0];

                $facility_string_arr = explode(",", $facility_string);

                foreach ($facility_string_arr as $key => $value) {
                    $arr_fc = array(
                        'hotel_id' => $admin_id,
                        'facility_name' => $value,
                    );

                    $this->HotelAdminModel->insert_data('hotel_facility', $arr_fc);
                }
            }
        }

        // updated particular hotel_img
        if (isset($_FILES['h_image']['name'])) {
            $count_img1 = count($_FILES['h_image']['name'], TRUE);

            for ($j = 0; $j < $count_img1; $j++) {
                if (!empty($_FILES['h_image']['name'][$j])) {
                    $_FILES['my_uploaded_file']['name'] = $_FILES['h_image']['name'][$j];
                    $_FILES['my_uploaded_file']['type'] = $_FILES['h_image']['type'][$j];
                    $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['h_image']['tmp_name'][$j];
                    $_FILES['my_uploaded_file']['size'] = $_FILES['h_image']['size'][$j];
                    $_FILES['my_uploaded_file']['error'] = $_FILES['h_image']['error'][$j];

                    $path = 'assets/upload/hotels_photos/';
                    $file_path = './' . $path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('my_uploaded_file')) {
                        $file_data = $this->upload->data();

                        $hotel_images = base_url() . $path . $file_data['file_name'];

                        $wh_h_p = '(hotel_photo_id = "' . $hotel_photo_id[$j] . '")';

                        $arr_h_p = array(
                            'images' => $hotel_images
                        );

                        $this->HotelAdminModel->edit_data('hotel_photos', $wh_h_p, $arr_h_p);
                    }
                }
            }
        }
        // print_r($_FILES);die;
        //edit hotel logo 
        if ($_FILES['hotel_logo']['name']) {
            $_FILES['my_file_logo']['name'] = $_FILES['hotel_logo']['name'];
            $_FILES['my_file_logo']['type'] = $_FILES['hotel_logo']['type'];
            $_FILES['my_file_logo']['tmp_name'] = $_FILES['hotel_logo']['tmp_name'];
            $_FILES['my_file_logo']['size'] = $_FILES['hotel_logo']['size'];
            $_FILES['my_file_logo']['error'] = $_FILES['hotel_logo']['error'];

            $path = 'assets/upload/hotel_logo/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file_logo')) {
                $file_data = $this->upload->data();

                $hotel_logo = base_url() . $path . $file_data['file_name'];
            }
        } else {
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
        $this->HotelAdminModel->edit_data('register', $wh, $arr_r);


        // $admin_id = $this->session->userdata('u_id');

        // $hotel_information['data'] = $this->HotelAdminModel->get_user_data($admin_id);
        // $hotel_information['facility_list'] = $this->HotelAdminModel->get_hotels_facility($admin_id);
        // $hotel_information['leads_purchase_list'] = $this->HotelAdminModel->get_hotel_admin_leads($admin_id);
        // $hotel_information['hotels_pics'] = $this->HotelAdminModel->get_hotel_photos($admin_id);
        // // print_r($hotel_information);die;
        // $this->load->view('hoteladmin/ajaxhotel_information', $hotel_information );

        $this->session->set_flashdata('msg', 'Data Added Successfully...');
        redirect(base_url('HoteladminController/hotel_information'));
    }

    public function new_hall_request()
    {
        if ($this->session->userdata('u_id')) {

            $date = $this->input->post('date');
            $banquet_hall_id = $this->input->post('banquet_id');
            $admin_id = $this->session->userdata('u_id');

            if(isset($_POST['search']) && !empty($date) && !empty($banquet_hall_id) ) 
            {
                $new_hall_request["list"] = $this->HotelAdminModel->banquet_hall_pending_pagination_search($admin_id,$date,$banquet_hall_id);
                $new_hall_request["list1"] = $this->HotelAdminModel->banquet_hall_pending_pagination_accepted_search($admin_id,$date,$banquet_hall_id);
                $new_hall_request["list2"] = $this->HotelAdminModel->banquet_hall_pending_pagination_rejected_search($admin_id,$date,$banquet_hall_id);
                $this->load->view('include/header');
                $this->load->view('hoteladmin/new_hall_request', $new_hall_request);
                $this->load->view('include/footer');
            }
            else
            {
                $new_hall_request["list"] = $this->HotelAdminModel->banquet_hall_pending_pagination($admin_id);
                $new_hall_request["list1"] = $this->HotelAdminModel->banquet_hall_pending_pagination_accepted($admin_id);
                $new_hall_request["list2"] = $this->HotelAdminModel->banquet_hall_pending_pagination_rejected($admin_id);
                $this->load->view('include/header');
                $this->load->view('hoteladmin/new_hall_request', $new_hall_request);
                $this->load->view('include/footer');
            }
           
        } else {
            redirect(base_url());
        }
    }
    public function departed_guest()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

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
        $wh = '(banquet_hall_orders_id = "' . $banquet_hall_orders_id . '")';

        $arr = array(
            'request_status' => 1,
            'assign_by' => 1,
            'assign_by_u_id' => $admin_id,
        );

        $up = $this->HotelAdminModel->edit_data('banquet_hall_orders', $wh, $arr);

        if ($up) {
            $this->session->set_flashdata('msg', 'Request accepted successfully');
            redirect(base_url('HoteladminController/new_hall_request'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/new_hall_request'));
        }
    }

    //8-11-2022 //archana
    public function request_reject1()
    {
        $admin_id = $this->session->userdata('admin_id');

        $banquet_hall_orders_id = $this->uri->segment(3);

        $wh = '(banquet_hall_orders_id = "' . $banquet_hall_orders_id . '")';

        $arr = array(
            'request_status' => 2,
            'assign_by' => 1,
            'assign_by_u_id' => $admin_id,
        );

        $up = $this->HotelAdminModel->edit_data('banquet_hall_orders', $wh, $arr);

        if ($up) {
            $this->session->set_flashdata('msg', 'Request rejected successfully');
            redirect(base_url('HoteladminController/new_hall_request'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
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
        if ($department_id == 2) {
            $user_type = 3;
        } else {
            if ($department_id == 3) {
                $user_type = 6;
            } else {
                if ($department_id == 4) {
                    $user_type = 7;  //5
                } else {
                    if ($department_id == 5) {
                        $user_type = 5; //7
                    }
                }
            }
        }

        if (!empty($_FILES['profile_photo']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['profile_photo']['name'];
            $_FILES['my_file']['type'] = $_FILES['profile_photo']['type'];
            $_FILES['my_file']['size'] = $_FILES['profile_photo']['size'];
            $_FILES['my_file']['error'] = $_FILES['profile_photo']['error'];
            $_FILES['my_file']['tmp_name'] = $_FILES['profile_photo']['tmp_name'];

            $path = 'assets/upload/other_panel_admin_photo/';
            $upload_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $upload_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $profile_photo = base_url() . $path . $file_data['file_name'];
            } else {
                $this->session->set_flashdata('msg', 'Erro to upload image');
                redirect(base_url('HoteladminController/login_departments'));
            }
        }



        $arr = array(
            'hotel_id' => $admin_id,
            'user_type' => $user_type,
            'user_is' => 1,
            'full_name' => $first_name . " " . $last_name,
            'email_id' => $email_id,
            'mobile_no' => $mobile_no,
            'password' => md5($password),            //md5($mobile_no)
            'password_text' => $password,    //$mobile_no
            'profile_photo' => $profile_photo,
            //'id_proof_name' => $id_proof_name,
            //'Id_proff_photo' => $Id_proff_photo,
            'shift_type' => $shift_type,
            'shift_start_time' => $shift_start_time,
            'shift_end_time' => $shift_end_time,
            'is_active' => 1,
            'register_date' => date('Y-m-d'),
        );

        $add = $this->HotelAdminModel->insert_data('register', $arr);

        if ($add) {
            if ($hotel_available_service_list) {
                foreach ($hotel_available_service_list as $h_v) {
                    $arr_access = array(
                        'hotel_id' => $admin_id,
                        'department_id' => $department_id,
                        'user_id' => $add,
                        'services_name' => $h_v['service_name']
                    );

                    $this->HotelAdminModel->insert_data('access_to_department', $arr_access);
                }
            }


            // $this->session->set_flashdata('msg','Data Added Successfully...');
            $login_departments["panel_admin_list"] = $this->HotelAdminModel->get_panel_admin_list_according_to_hotel_pagination($admin_id);

            $this->load->view('hoteladmin/ajaxLoginDepartmentList', $login_departments);
            //  redirect(base_url('HoteladminController/login_departments'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/login_departments'));
        }
    }
    public function viewRoomConfig()
    {

        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $postArray = $this->input->post();
        // print_r($postArray);
        // exit;

        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $this->session->userdata('u_id');
        $room_type = $postArray['room_type'];
        // print_r($room_type);
        // exit;
        $where1 = '(room_type_id = "' . $room_type . '" AND hotel_id = "' . $admin_id . '" )';
        $view_room['room_type_data'] = $this->HotelAdminModel->get_room_type_data($where1);
        $view_room['list'] = $this->HotelAdminModel->get_room_related_data($admin_id, $room_type);
        $view_room['floor_list'] = $this->HotelAdminModel->get_floor_list($admin_id);
        // print_r($view_room['room_type_data']);
        // exit;


        $this->load->view('hoteladmin/ajaxViewRoomConfig', $view_room);
    }
    public function viewShuttleConfig()
    {
        // echo 'hi';die;
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $postArray = $this->input->post();
        // print_r($postArray);
        // exit;

        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
        $admin_id = $this->session->userdata('u_id');
        $room_type = $postArray['room_type'];
        // print_r($room_type);
        // exit;

        $day1 = "Sunday";
        $day2 = "Monday";
        $day3 = "Tuesday";
        $day4 = "Wednesday";
        $day5 = "Thursday";
        $day6 = "Friday";
        $day7 = "Saturday";
        $service_name = 4;
        $guest_mng['shuttle_id'] = $room_type;
        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);

        $guest_mng['sun_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day1);

        $guest_mng['mon_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day2);

        $guest_mng['tue_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day3);

        $guest_mng['wed_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day4);

        $guest_mng['thurs_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day5);

        $guest_mng['fri_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day6);

        $guest_mng['sat_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day7);


        // print_r($view_room['room_type_data']);
        // exit;


        $this->load->view('hoteladmin/ajaxViewShuttleConfig', $guest_mng);
    }
    public function assign_housekeeping_service_order_to_staff()
    {
        $h_k_order_id = $this->input->post('h_k_order_id');
        $house_user_id = $this->input->post('house_user_id');
        $order_status = $this->input->post('order_status');
        $reject_reason = $this->input->post('reject_reason');
        $staff_id = $this->input->post('staff_id');
        $wh = '(h_k_order_id = "' . $h_k_order_id . '")';
        $rand_no = rand('1111', '9999');
        $staff_name = '';
        $where1 = '(u_id ="' . $staff_id. '")';
        $get_staff_name = $this->MainModel->getData('register', $where1);
        if (!empty($get_staff_name)) {
            $staff_name = $get_staff_name['full_name'];
        } else {
            $staff_name = '';
        }
        if ($order_status == 1) {
            $staff_id = $this->input->post('staff_id');
            $accept_date = date('Y-m-d');
            $reject_date = "";
            $otp = $rand_no;
        } else {
            $staff_id = 0;
            $accept_date = "";
            $otp = "";
            $reject_date = date('Y-m-d');
        }

        $arr = array(
            'order_status' => $order_status,
            'reject_reason' => $reject_reason,
            'staff_id' => $staff_id,
            'staff_name'=>$staff_name,
            'accept_date' => $accept_date,
            'accept_time'=>date('G:i:s'),
            'reject_date' => $reject_date,
            'otp' => $otp,
        );
        $up = $this->HotelAdminModel->edit_data('house_keeping_orders', $wh, $arr);

        $admin_id = $this->session->userdata('u_id');
        $wh_d = '(u_id = "' . $admin_id . '")';
        $hotel_data = $this->MainModel->getData('register',$wh_d);
        $hotel_name = $hotel_data['hotel_name'];

        $user_type = 9;
        $guest_mng["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, 0);
        $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);

        if ($up) {
            if ($order_status == 1) {
                // push notification for user

                $get_u_id = $this->MainModel->getData($tbl = 'house_keeping_orders', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title = "";
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'HouseKeeping Order Is Accepted';
                    $body = 'Your HouseKeeping Order ID Is "'.$h_k_order_id.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                // inside app notification
                $subject = $title;
                $description = "$title In $hotel_name And Your Order Id Is $h_k_order_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $house_user_id,
                                    'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
                // print_r($arr_noti);die;
                $this->MainModel->insert_data('user_notification',$arr_noti);

                //push notification for staff
                $wh_s = '(u_id = "' . $get_u_id['staff_id'] . '")';
                // print_r($wh_s);die;
                $get_staff_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh_s);
                $title1 = "";
                if(!empty($get_staff_dt)){
                    $deviceToken1 = $get_staff_dt['token'];
                    $title1 = 'New Order Assign ';
                    $body1 = 'HouseKeeping Order ID Is "'.$h_k_order_id.'"';
                    $result1 = send_push_notification_for_staff($deviceToken1, $title1, $body1);
                }

                 // inside staff app notification
                 $subject1 = $title1;
                 $description1 = "$title1 And Order Id Is $h_k_order_id";
                 $arr_staff_noti = array(
                                     'u_id'=>$staff_id,
                                     'hotel_id' => $admin_id,
                                     'subject' => $subject1,
                                     'description' => $description1,
                                     'notification_order_flag' =>0,    
                                 );
                 // print_r($arr_staff_noti);die;
                 $this->MainModel->insert_data('staff_notification',$arr_staff_noti);
                
                $this->load->view('hoteladmin/ajaxOrderHouseView', $guest_mng);
            } else {
                // push notification for user
                $get_u_id = $this->MainModel->getData($tbl = 'house_keeping_orders', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title ="";
                $reason = '';

                if ($reject_reason == 1) {
                    $reason = "Out of stock";
                } else if ($reject_reason == 2) {
                    $reason = "We Do Not Serve";
                } else if ($reject_reason == 3) {
                    $reason = "Out Of Time";
                } else if ($reject_reason == 4) {
                    $reason = "Others";
                }
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'HouseKeeping Order Is Rejected';
                    $body = 'Your HouseKeeping Order ID is "' . $h_k_order_id . '" And Your Order is Rejected Because OF "' . $reason . '" ';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                // inside app notification
                $subject = $title;
                $description = "$title In $hotel_name Because Of $reason And Your Order Id Is $h_k_order_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $house_user_id,
                                    'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
                // print_r($arr_noti);die;

                $this->MainModel->insert_data('user_notification',$arr_noti);
                
                $this->load->view('hoteladmin/ajaxOrderHouseView', $guest_mng);
            }
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/order_management'));
        }
    }


    public function add_checkout_details()
    {
        $admin_id = $this->session->userdata('u_id');

        $booking_id = $this->uri->segment(3);

        $u_id = $this->uri->segment(4);
        $booking_details = $this->HotelAdminModel->get_user_booking_details($admin_id, $booking_id);

        $date1 = $booking_details['check_in'];
        $date2 = $booking_details['check_out'];
        $service_tax = $booking_details['service_tax'];
        $luxury_tax = $booking_details['luxury_tax'];

        $diff = abs(strtotime($date2) - strtotime($date1));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        // $amount = $booking_details['total_charges'] / $days;
        $amount = $booking_details['total_charges'];

        // $s_amount = $service_tax / $days;
        $s_amount = $service_tax;

        // $lt_amount = $luxury_tax / $days;
        $lt_amount = $luxury_tax;

        $wh = '(hotel_id = "' . $admin_id . '" AND u_id = "' . $u_id . '" AND booking_id = "' . $booking_id . '")';

        $user_checkout_data = $this->HotelAdminModel->getData('user_checkout_data', $wh);

        if (empty($user_checkout_data)) {
            $arr = array(
                'hotel_id' => $admin_id,
                'u_id' => $u_id,
                'booking_id' => $booking_id
            );

            $add = $this->HotelAdminModel->insert_data('user_checkout_data', $arr);

            if ($add) {
                //add room charges
                for ($i = 0; $i < $days; $i++) {
                    $description = "Room Charges";

                    $check_out = $booking_details['check_out'];

                    $check_in = $booking_details['check_in'];

                    if (($check_in >= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days')) && $check_out <= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days'))) || ($check_in <= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days')) && $check_out >= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days')))) {
                        $amount1 = $amount;
                    } else {
                        $amount1 = 0;
                    }

                    $arr1 = array(
                        'hotel_id' => $admin_id,
                        'user_checkout_data_id' => $add,
                        'description' => $description,
                        'date' => date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days')),
                        'amount' => $amount1
                    );

                    $add_rm_charges = $this->HotelAdminModel->insert_data('user_checkout_details', $arr1);

                    if ($add_rm_charges) {
                        $wh1 = '(hotel_id = "' . $admin_id . '" AND user_checkout_data_id = "' . $add . '" AND description_name = "' . $description . '")';

                        $user_checkout_sub_total = $this->HotelAdminModel->getData('user_checkout_sub_total', $wh1);

                        //add subtotal
                        if ($user_checkout_sub_total) {
                            $st_arr1 = array(
                                'sub_total' => $user_checkout_sub_total['sub_total'] + $amount1
                            );

                            $this->HotelAdminModel->edit_data('user_checkout_sub_total', $wh1, $st_arr1);
                        } else {
                            //edit subtotal
                            $st_arr2 = array(
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $add,
                                'description_name' => $description,
                                'sub_total' => $amount1
                            );

                            $this->HotelAdminModel->insert_data('user_checkout_sub_total', $st_arr2);
                        }

                        //add total bill
                        $wh_ck = '(user_checkout_data_id = "' . $add . '")';

                        $user_checkout_data1 = $this->HotelAdminModel->getData('user_checkout_data', $wh_ck);

                        $tot_arr1 = array(
                            'total_bill' => $user_checkout_data1['total_bill'] + $amount1
                        );

                        $this->HotelAdminModel->edit_data('user_checkout_data', $wh_ck, $tot_arr1);
                    }
                }

                //GST
                for ($k = 0; $k < $days; $k++) {
                    $description_lx = "GST";

                    $check_out = $booking_details['check_out'];

                    $check_in = $booking_details['check_in'];

                    if (($check_in >= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $k . 'days')) && $check_out <= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $k . 'days'))) || ($check_in <= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $k . 'days')) && $check_out >= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $k . 'days')))) {
                        $lt_amount1 = $lt_amount;
                    } else {
                        $lt_amount1 = 0;
                    }

                    $arr_lx = array(
                        'user_checkout_data_id' => $add,
                        'hotel_id' => $admin_id,
                        'user_checkout_data_id' => $add,
                        'description' => $description_lx,
                        'date' => date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $k . 'days')),
                        'amount' => $lt_amount1
                    );

                    $add_lux = $this->HotelAdminModel->insert_data('user_checkout_details', $arr_lx);

                    if ($add_lux) {
                        $wh13 = '(hotel_id = "' . $admin_id . '" AND user_checkout_data_id = "' . $add . '" AND description_name = "' . $description_lx . '")';

                        $user_checkout_sub_total2 = $this->HotelAdminModel->getData('user_checkout_sub_total', $wh13);

                        //add subtotal
                        if ($user_checkout_sub_total2) {
                            $st_arr13 = array(
                                'sub_total' => $user_checkout_sub_total2['sub_total'] + $lt_amount1
                            );

                            $this->HotelAdminModel->edit_data('user_checkout_sub_total', $wh13, $st_arr13);
                        } else {
                            //edit subtotal
                            $st_arr23 = array(
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $add,
                                'description_name' => $description_lx,
                                'sub_total' => $lt_amount1
                            );

                            $this->HotelAdminModel->insert_data('user_checkout_sub_total', $st_arr23);
                        }

                        //add total bill
                        $wh_ck3_1 = '(user_checkout_data_id = "' . $add . '")';

                        $user_checkout_data1_3 = $this->HotelAdminModel->getData('user_checkout_data', $wh_ck3_1);

                        $tot_arr3 = array(
                            'total_bill' => $user_checkout_data1_3['total_bill'] + $lt_amount1
                        );

                        $this->HotelAdminModel->edit_data('user_checkout_data', $wh_ck3_1, $tot_arr3);
                    }
                }

                //other tax
                for ($j = 0; $j < $days; $j++) {
                    $description_s = "Other Tax";

                    $check_out = $booking_details['check_out'];

                    $check_in = $booking_details['check_in'];

                    if (($check_in >= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $j . 'days')) && $check_out <= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $j . 'days'))) || ($check_in <= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $j . 'days')) && $check_out >= date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $j . 'days')))) {
                        $s_amount1 = $s_amount;
                    } else {
                        $s_amount1 = 0;
                    }

                    $arr_s = array(
                        'user_checkout_data_id' => $add,
                        'hotel_id' => $admin_id,
                        'user_checkout_data_id' => $add,
                        'description' => $description_s,
                        'date' => date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $j . 'days')),
                        'amount' => $s_amount1
                    );

                    $add_ser = $this->HotelAdminModel->insert_data('user_checkout_details', $arr_s);

                    if ($add_ser) {
                        $wh12 = '(hotel_id = "' . $admin_id . '" AND user_checkout_data_id = "' . $add . '" AND description_name = "' . $description_s . '")';

                        $user_checkout_sub_total1 = $this->HotelAdminModel->getData('user_checkout_sub_total', $wh12);

                        //add subtotal
                        if ($user_checkout_sub_total1) {
                            $st_arr12 = array(
                                'sub_total' => $user_checkout_sub_total1['sub_total'] + $s_amount1
                            );

                            $this->HotelAdminModel->edit_data('user_checkout_sub_total', $wh12, $st_arr12);
                        } else {
                            //edit subtotal
                            $st_arr22 = array(
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $add,
                                'description_name' => $description_s,
                                'sub_total' => $s_amount1
                            );

                            $this->HotelAdminModel->insert_data('user_checkout_sub_total', $st_arr22);
                        }

                        //add total bill
                        $wh_ck1 = '(user_checkout_data_id = "' . $add . '")';

                        $user_checkout_data11 = $this->HotelAdminModel->getData('user_checkout_data', $wh_ck1);

                        $tot_arr2 = array(
                            'total_bill' => $user_checkout_data11['total_bill'] + $s_amount1
                        );

                        $this->HotelAdminModel->edit_data('user_checkout_data', $wh_ck1, $tot_arr2);
                    }
                }

                redirect(base_url('HoteladminController/check_out_view/' . $booking_id . '/' . $u_id));
            }
        } else {
            redirect(base_url('HoteladminController/check_out_view/' . $booking_id . '/' . $u_id));
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

        if ($department_id == 3) {
            $user_type = 10;  //10
        } else {
            if ($department_id == 4) {
                $user_type = 8; //8
            } else {
                if ($department_id == 5) {
                    $user_type = 9;  //9
                }
            }
        }

        if (!empty($_FILES['profile_photo']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['profile_photo']['name'];
            $_FILES['my_file']['type'] = $_FILES['profile_photo']['type'];
            $_FILES['my_file']['size'] = $_FILES['profile_photo']['size'];
            $_FILES['my_file']['error'] = $_FILES['profile_photo']['error'];
            $_FILES['my_file']['tmp_name'] = $_FILES['profile_photo']['tmp_name'];

            $path = 'assets/upload/other_panel_staff_photo/';
            $upload_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $upload_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $profile_photo = base_url() . $path . $file_data['file_name'];
            } else {
                $this->session->set_flashdata('msg', 'Error to upload image');
                redirect(base_url('HoteladminController/staff_login'));
            }
        }


        $arr = array(
            'hotel_id' => $admin_id,
            'user_type' => $user_type,
            'user_is' => 2,
            'full_name' => $first_name . " " . $last_name,
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

        $add = $this->HotelAdminModel->insert_data('register', $arr);

        if ($add) {
            // $this->session->set_flashdata('msg','Data Added Successfully...');
            // redirect(base_url('HoteladminController/staff_login'));
            $staff_login['list'] = $this->HotelAdminModel->get_admin_panel_list_2($admin_id);
            $staff_login["staff_list"] = $this->HotelAdminModel->get_staff_list_according_to_hotel_1($admin_id);
            $this->load->view('hoteladmin/ajaxStaffLoginist', $staff_login);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/staff_login'));
        }
    }

    public function delete_user()
    {
        $admin_id = $this->session->userdata('u_id');
        $u_id = $this->input->post('id');

        $wh = '(u_id = "' . $u_id . '")';

        $del = $this->HotelAdminModel->delete_data('register', $wh);

        if ($del) {
            $login_departments["panel_admin_list"] = $this->HotelAdminModel->get_panel_admin_list_according_to_hotel_pagination($admin_id);

            $this->load->view('hoteladmin/ajaxLoginDepartmentList', $login_departments);
        } else {
            echo "0";
        }
    }
    public function delete_login_staff()
    {
        $admin_id = $this->session->userdata('u_id');
        $u_id = $this->input->post('id');

        $wh = '(u_id = "' . $u_id . '")';

        $del = $this->HotelAdminModel->delete_data('register', $wh);

        if ($del) {
            $staff_login['list'] = $this->HotelAdminModel->get_admin_panel_list_2($admin_id);
            $staff_login["staff_list"] = $this->HotelAdminModel->get_staff_list_according_to_hotel_1($admin_id);
            $this->load->view('hoteladmin/ajaxStaffLoginist', $staff_login);
        } else {
            echo "0";
        }
    }
    public function change_users_status()
    {
        $status = $this->input->post('status');

        $u_id = $this->input->post('id');

        $wh = '(u_id = "' . $u_id . '")';

        $arr = array(
            'is_active' => $status
        );

        $add = $this->HotelAdminModel->edit_data('register', $wh, $arr);

        if ($add) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function access_frontOffice()
    {
        // print_r($this->input->post());die;
        if ($this->session->userdata('u_id')) {
            $department_id = 2;

            $access_frontOffice['hotel_available_service_list'] = $this->HotelAdminModel->get_hotel_available_service_list($department_id);
            $access_frontOffice['u_id'] = $this->input->post('u_id1');
            // $this->load->view('include/header');
            $this->load->view('hoteladmin/access_frontOffice', $access_frontOffice);
            // $this->load->view('include/footer');

        } else {
            redirect(base_url());
        }
    }

    public function access_housekeeping()
    {
        if ($this->session->userdata('u_id')) {
            $department_id = 5;

            $access_housekeeping['hotel_available_service_list'] = $this->HotelAdminModel->get_hotel_available_service_list($department_id);
            $access_housekeeping['u_id'] = $this->input->post('u_id1');
            $this->load->view('hoteladmin/access_housekeeping', $access_housekeeping);
        } else {
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

        $wh = '(access_to_department_id = "' . $access_to_department_id . '")';

        $arr_up = array(
            'is_access' => $is_access
        );

        $up = $this->HotelAdminModel->edit_data('access_to_department', $wh, $arr_up);

        if ($up) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function access_room()
    {
        if ($this->session->userdata('u_id')) {
            $department_id = 3;

            $access_room['hotel_available_service_list'] = $this->HotelAdminModel->get_hotel_available_service_list($department_id);
            $access_room['u_id'] = $this->input->post('u_id1');

            $this->load->view('hoteladmin/access_room', $access_room);
        } else {
            redirect(base_url());
        }
    }

    public function staff_login()
    {
        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');

            $staff_login['list'] = $this->HotelAdminModel->get_admin_panel_list_2($admin_id);


            $staff_login["staff_list"] = $this->HotelAdminModel->get_staff_list_according_to_hotel_1($admin_id);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/staff_login', $staff_login);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
    }




    public function access_food()
    {
        // print_r($this->input->post());die;
        if ($this->session->userdata('u_id')) {
            $department_id = 4;

            $access_food['hotel_available_service_list'] = $this->HotelAdminModel->get_hotel_available_service_list($department_id);
            $access_food['u_id'] = $this->input->post('u_id1');

            $this->load->view('hoteladmin/access_food', $access_food);
        } else {
            redirect(base_url());
        }
    }
    public function login_departments()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

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
        $date = $this->input->post('date'); 
        $review_for = $this->input->post('review_for');
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $admin_id = $get_hotel_id['u_id'];

        if(isset($_POST['search'])) 
        {
            $guest_mng["list"] = $this->HotelAdminModel->get_feedback_list_pagination_search($admin_id,$date,$review_for);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/viewFeedbackList', $guest_mng);
            $this->load->view('include/footer');
        }
        else
        {
            $guest_mng["list"] = $this->HotelAdminModel->get_feedback_list_pagination($admin_id);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/viewFeedbackList', $guest_mng);
            $this->load->view('include/footer');
        }
    }
    public function delete_feedback()
    {
        $review_id = $this->input->post('id');

        $wh = '(review_id = "' . $review_id . '")';

        $del = $this->HotelAdminModel->delete_data('review', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_feedback_list_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxFeedbackList', $guest_mng);
        } else {
            redirect(base_url());
        }
    }
    public function nearByPlace()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

        $admin_id = $get_hotel_id['u_id'];

        $guest_mng["list"] = $this->HotelAdminModel->get_hotel_near_by_place_pagination($admin_id);
        $this->load->view('include/header');
        $this->load->view('hoteladmin/viewNearByPlaceList', $guest_mng);
        $this->load->view('include/footer');
    }
    public function delete_hotel_near_by_places()
    {
        $hotel_near_by_place_id = $this->input->post('id');

        $wh = '(hotel_near_by_place_id = "' . $hotel_near_by_place_id . '")';

        $del = $this->HotelAdminModel->delete_data('hotel_near_by_place', $wh);

        $del = $this->HotelAdminModel->delete_data('hotel_near_by_place_images', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_hotel_near_by_place_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxNearByPlaceList', $guest_mng);
        } else {
            redirect(base_url());
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
        $admin_id = $this->session->userdata('u_id');
        $id = $this->input->post('id', TRUE); // image id

        $wh = '(hotel_near_by_place_id = "' . $hotel_near_by_place_id . '")';

        $editdata_near_by_places = $this->HotelAdminModel->getData('hotel_near_by_place_images', $wh);
        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];

            $path = 'assets/upload/hotel_near_by_place_images/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {


                $file_data = $this->upload->data();

                $image = base_url() . $path . $file_data['file_name'];
                $imgarr = array(
                    'images' => $image,
                );
                $up = $this->HotelAdminModel->edit_data_nearByplace_image('hotel_near_by_place_images', $wh, $imgarr);
            } else {
                $this->session->set_flashdata('msg', 'Error to upload image');
                redirect(base_url('HoteladminController/nearByPlace'));
            }
        } else {

            $image = $editdata_near_by_places['images'];
        }
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

        $up = $this->HotelAdminModel->edit_data('hotel_near_by_place', $wh, $arr);
        $guest_mng["list"] = $this->HotelAdminModel->get_hotel_near_by_place_pagination($admin_id);
        if ($up) {
            // $this->session->set_flashdata('msg','Offers Updated Successfully...');
            $this->load->view('hoteladmin/ajaxNearByPlaceList', $guest_mng);
            // redirect(base_url('HoteladminController/offerList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/nearByPlace'));
        }
    }


    public function add_hotel_near_by_places()
    {
        // echo 'hi';die;
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

        $add = $this->HotelAdminModel->insert_data('hotel_near_by_place', $arr);
        $guest_mng["list"] = $this->HotelAdminModel->get_hotel_near_by_place_pagination($admin_id);
        if ($add) {
            // add multiple images
            $count_img = count($_FILES['image']['name'], TRUE);

            for ($i = 0; $i < $count_img; $i++) {
                if (!empty($_FILES['image']['name'][$i])) {
                    $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                    $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                    $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                    $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                    $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];

                    $path = 'assets/upload/hotel_near_by_place_images/';
                    $file_path = './' . $path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('my_uploaded_file')) {
                        $file_data = $this->upload->data();

                        $images = base_url() . $path . $file_data['file_name'];

                        $arr1 = array(
                            'hotel_id' => $admin_id,
                            'hotel_near_by_place_id' => $add,
                            'images' => $images
                        );

                        $this->HotelAdminModel->insert_data('hotel_near_by_place_images', $arr1);
                    }
                }
            }

            $this->session->set_flashdata('msg', 'Data added successfully');
            // redirect(base_url('HoteladminController/nearByPlace')); 
            $this->load->view('hoteladmin/ajaxNearByPlaceList', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/nearByPlace'));
        }
    }

    public function nearByHelp()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

        $admin_id = $get_hotel_id['u_id'];

        $guest_mng["list"] = $this->HotelAdminModel->get_hotel_near_by_help_pagination($admin_id);
        $this->load->view('include/header');
        $this->load->view('hoteladmin/viewNearByHelpList', $guest_mng);
        $this->load->view('include/footer');
    }
    public function delete_hotel_near_by_help()
    {
        $hotel_near_by_help_id = $this->input->post('id');

        $wh = '(hotel_near_by_help_id = "' . $hotel_near_by_help_id . '")';

        $del = $this->HotelAdminModel->delete_data('hotel_near_by_help', $wh);

        $del = $this->HotelAdminModel->delete_data('hotel_near_by_help_images', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_hotel_near_by_help_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxNearByHelpList', $guest_mng);
        } else {
            redirect(base_url(''));
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

        $id = $this->input->post('id', TRUE); // image id
        // echo "<pre>";print_r($id);die;

        $admin_id = $this->session->userdata('u_id');
        $wh = '(hotel_near_by_help_id = "' . $hotel_near_by_help_id . '")';
        $NBHD = $this->HotelAdminModel->getData('hotel_near_by_help_images', $wh);
        // echo "<pre>";print_r($NBHD);die;


        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {


            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];

            $path = 'assets/upload/hotel_near_by_help_images/';
            $upload_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $upload_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('my_file')) {


                $file_data = $this->upload->data();

                $image = base_url() . $path . $file_data['file_name'];
                $imgarr = array(
                    'images' => $image,
                );
                $up = $this->HotelAdminModel->edit_data_nearByHelp_image('hotel_near_by_help_images', $wh, $imgarr);
            } else {

                $this->session->set_flashdata('msg', 'Error to upload image');
                redirect(base_url('HoteladminController/nearByHelp'));
            }
        } else {

            $image = $NBHD['images'];
        }
        $arr = array(
            'places_name' => $places_name,
            'name' => $name,
            'contact_no' => $contact_no,
            'place_address' => $place_address,
            'description' => $description,
            'open_time' => $open_time,
            'close_time' => $close_time,
        );
        $up = $this->HotelAdminModel->edit_data('hotel_near_by_help', $wh, $arr);
        $guest_mng["list"] = $this->HotelAdminModel->get_hotel_near_by_help_pagination($admin_id);
        if ($up) {
            $this->session->set_flashdata('msg', 'Offers Updated Successfully...');
            $this->load->view('hoteladmin/ajaxNearByHelpList', $guest_mng);
            // redirect(base_url('HoteladminController/offerList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
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

        $add = $this->HotelAdminModel->insert_data('hotel_near_by_help', $arr);
        $guest_mng["list"] = $this->HotelAdminModel->get_hotel_near_by_help_pagination($admin_id);
        if ($add) {
            // add multiple images
            $count_img = count($_FILES['image']['name'], TRUE);

            for ($i = 0; $i < $count_img; $i++) {
                if (!empty($_FILES['image']['name'][$i])) {
                    $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                    $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                    $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                    $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                    $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];

                    $path = 'assets/upload/hotel_near_by_help_images/';
                    $file_path = './' . $path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('my_uploaded_file')) {
                        $file_data = $this->upload->data();

                        $images = base_url() . $path . $file_data['file_name'];

                        $arr1 = array(
                            'hotel_id' => $admin_id,
                            'hotel_near_by_help_id' => $add,
                            'images' => $images
                        );

                        $this->HotelAdminModel->insert_data('hotel_near_by_help_images', $arr1);
                    }
                }
            }

            $this->session->set_flashdata('msg', 'Data added successfully');
            $this->load->view('hoteladmin/ajaxNearByHelpList', $guest_mng);
            // redirect(base_url('HoteladminController/nearByHelp')); 
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/nearByHelp'));
        }
    }
    public function offerList()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

        $admin_id = $get_hotel_id['u_id'];

        $guest_mng["list"] = $this->HotelAdminModel->get_offer_list_pagination($admin_id);
        $this->load->view('include/header');
        $this->load->view('hoteladmin/viewOfferList', $guest_mng);
        $this->load->view('include/footer');
    }
    public function delete_offer()
    {
        $offer_id = $this->input->post('id');

        $wh = '(offer_id = "' . $offer_id . '")';

        $del = $this->HotelAdminModel->delete_data('offers', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_offer_list_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxOfferList', $guest_mng);
        } else {
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

        $offer_code = substr($char, 0, 6);

        $wh = '(offer_for = 1 AND hotel_id = "' . $admin_id . '")';

        // $offer_data = $this->HotelAdminModel->getData('offers', $wh);
        $guest_mng["list"] = $this->HotelAdminModel->get_offer_list_pagination($admin_id);

        // if ($offer_data) {
        //     echo '1';
        //     //    $this->load->view('hoteladmin/ajaxOfferList', $guest_mng);
        // } else {
            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];

            $path = 'assets/upload/offer_img/';
            $upload_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $upload_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $image = base_url() . $path . $file_data['file_name'];
            } else {
                $this->session->set_flashdata('msg', 'Erro to upload image');
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

            $add = $this->HotelAdminModel->insert_data('offers', $arr);

            $guest_mng["list"] = $this->HotelAdminModel->get_offer_list_pagination($admin_id);
            if ($add) {
                $this->session->set_flashdata('msg', 'Offers added Successfully...');
                $this->load->view('hoteladmin/ajaxOfferList', $guest_mng);
                // redirect(base_url('HoteladminController/offerList'));
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/offerList'));
            }
        // }
    }
    public function delete_hotel_pht()
    {
        $hotel_photo_id = $this->uri->segment(3);
        // print_r($hotel_photo_id);die;
        $wh = '(hotel_photo_id = "' . $hotel_photo_id . '")';

        $del = $this->HotelAdminModel->delete_data('hotel_photos', $wh);

        if ($del) {
            $this->session->set_flashdata('msg', 'photo Delete Successfully...');
            redirect(base_url('HoteladminController/hotel_information'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/hotel_information'));
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

        $wh = '(offer_id = "' . $offer_id . '")';

        $offer_data = $this->HotelAdminModel->getData('offers', $wh);

        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {


            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];

            $path = 'assets/upload/offer_img/';
            $upload_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $upload_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {


                $file_data = $this->upload->data();

                $image = base_url() . $path . $file_data['file_name'];
            } else {

                $this->session->set_flashdata('msg', 'Error to upload image');
                redirect(base_url('HoteladminController/offerList'));
            }
        } else {

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

        $add = $this->HotelAdminModel->edit_data('offers', $wh, $arr);
        $guest_mng["list"] = $this->HotelAdminModel->get_offer_list_pagination($admin_id);
        if ($add) {
            $this->session->set_flashdata('msg', 'Offers Updated Successfully...');
            $this->load->view('hoteladmin/ajaxOfferList', $guest_mng);
            // redirect(base_url('HoteladminController/offerList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/offerList'));
        }
    }
    public function resend_notification_to_user()
    {
        $notification_id = $this->input->post('notificationId');

        $wh = '(notification_id = "' . $notification_id . '")';

        $notification_data = $this->HotelAdminModel->getData('notifications', $wh);

        $notification_data1 = $this->HotelAdminModel->getAllData('notifictions_u_id', $wh);

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

        $add = $this->HotelAdminModel->insert_data('notifications', $arr);

        if ($add) {
            if ($notification_data['send_to'] == 3) {
                if ($notification_data1) {
                    foreach ($notification_data1 as $nt) {
                        $arr1 = array(
                            'notification_id' => $notification_id,
                            'user_id' => $nt['user_id']
                        );

                        $add_u_nt = $this->HotelAdminModel->insert_data('notifictions_u_id', $arr1);

                        if ($add_u_nt) {
                            $wh1 = '(u_id = "' . $nt['user_id'] . '")';
                            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                            if(!empty($get_dt)){
                                $deviceToken = $get_dt['token'];
                                $noti_title = $notification_data['title'];
                                $body = $notification_data['description'];
                                $result = send_push_notification($deviceToken, $noti_title, $body); 
                            }

                            
                            // print_r($result);
                            $arr_u_nt = array(
                                'u_id' => $admin_id,
                                'hotel_id' => $admin_id,
                                'subject' => $notification_data['title'],
                                'description' => $notification_data['description'],
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );

                            $this->HotelAdminModel->insert_data('user_notification', $arr_u_nt);
                        }
                    }
                }
            } else if ($notification_data['send_to'] == 4) {
                if ($notification_data1) {
                    foreach ($notification_data1 as $nt) {
                        $arr1 = array(
                            'notification_id' => $notification_id,
                            'user_id' => $nt['user_id']
                        );

                        $add_u_nt = $this->HotelAdminModel->insert_data('notifictions_u_id', $arr1);

                        if ($add_u_nt) {
                            $wh1 = '(u_id = "' . $nt['user_id'] . '")';
                            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                            if(!empty($get_dt)){
                                $deviceToken = $get_dt['token'];
                                $noti_title = $notification_data['title'];
                                $body = $notification_data['description'];
                                $result = send_push_notification($deviceToken, $noti_title, $body);
                            }
                            
                            $arr_u_nt = array(
                                'u_id' => $admin_id,
                                'hotel_id' => $admin_id,
                                'subject' => $notification_data['title'],
                                'description' => $notification_data['description'],
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );

                            $this->HotelAdminModel->insert_data('user_notification', $arr_u_nt);
                        }
                    }
                }
            }
            $guest_mng["list"] = $this->HotelAdminModel->get_admin_sent_user_notifications_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxSendUserNotiList', $guest_mng);


            // echo "1";
        } else {
            echo "0";
        }
    }
    public function resend_notification_to_department()
    {
        // echo 'hi';die;
        $notification_id = $this->input->post('notificationId');
        $a = $this->input->post();
        // print_r($a);die;

        $wh = '(notification_id = "' . $notification_id . '")';

        $wh = '(notification_id = "' . $notification_id . '")';

        $notification_data = $this->HotelAdminModel->getData('notifications', $wh);

        $notification_data1 = $this->HotelAdminModel->getAllData('notifictions_department_id', $wh);

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

        $add = $this->HotelAdminModel->insert_data('notifications', $arr);

        if ($add) {
            // if($notification_data['send_to'] == 2)
            // {
            if ($notification_data1) {
                foreach ($notification_data1 as $nt) {
                    $arr1 = array(
                        'notification_id' => $notification_id,
                        'department_id' => $nt['department_id']
                    );

                    $this->HotelAdminModel->insert_data('notifictions_department_id', $arr1);
                }
            }
            $guest_mng["list"] = $this->HotelAdminModel->get_notifications_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxSendDepartmentList', $guest_mng);
            // }

            // echo "1";
        } else {
            echo "0";
        }
    }
    public function delete_notification()
    {
        $notification_id = $this->input->post('id');

        $wh = '(notification_id = "' . $notification_id . '")';

        $del = $this->HotelAdminModel->delete_data('notifications', $wh);

        if ($del) {
            $guest_mng["list"] = $this->HotelAdminModel->get_notifications_pagination($admin_id);
            $guest_mng['hotel_admin_panels'] = $this->HotelAdminModel->get_admin_panel_list($admin_id);
            $this->load->view('hoteladmin/ajaxSendDepartmentList', $guest_mng);
    
        } else {
            redirect(base_url());

        }
    }
    public function user_delete_notification()
    {
        $notification_id = $this->input->post('id');

        $wh = '(notification_id = "' . $notification_id . '")';
        $del = $this->HotelAdminModel->delete_data('notifications', $wh);

        if ($del) {
            $guest_mng["list"] = $this->HotelAdminModel->get_admin_sent_user_notifications_pagination($admin_id);
            $guest_mng['user_list'] = $this->HotelAdminModel->get_user_list_by_hotels($admin_id);
            $this->load->view('hoteladmin/ajaxSendUserNotiList', $guest_mng);
        } else {
            redirect(base_url());

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

        if ($send_to == "all") {
            $send_to1 = 1;
        } else {
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
            'created_at' => date('Y-m-d H:i:s'),
        );

        $add = $this->HotelAdminModel->insert_data('notifications', $arr);
        $guest_mng["list"] = $this->HotelAdminModel->get_notifications_pagination($admin_id);
        $guest_mng['hotel_admin_panels'] = $this->HotelAdminModel->get_admin_panel_list($admin_id);
        if ($add) {
            if ($send_to1 == 2) {
                $count = count($departments);

                for ($i = 0; $i < $count; $i++) {
                    $arr1 = array(
                        'notification_id' => $add,
                        'department_id' => $departments[$i]
                    );

                    $this->HotelAdminModel->insert_data('notifictions_department_id', $arr1);
                }
            } else {
                //send all departments
                $hotels_department = $this->HotelAdminModel->get_admin_panel_list($admin_id);

                // $count1 = count($hotels_department);

                foreach ($hotels_department as $hd) {
                    $arr_nd = array(
                        'notification_id' => $add,
                        'department_id' => $hd['department_id']
                    );

                    $this->HotelAdminModel->insert_data('notifictions_department_id', $arr_nd);
                }
            }
            $this->session->set_flashdata('msg', 'Sent Notification to Department Successfully...');
            // redirect(base_url('HoteladminController/sendDepartment'));
            $this->load->view('hoteladmin/ajaxSendDepartmentList', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/sendDepartment'));
        }
    }
    public function sendDepartment()
    {
        $send_to = $this->input->post('send_to');
        $notification_type = $this->input->post('notification_type');
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $admin_id = $get_hotel_id['u_id'];

        if(isset($_POST['search'])) 
        {
            $guest_mng["list"] = $this->HotelAdminModel->get_notifications_pagination_search($admin_id,$send_to,$notification_type);
            $guest_mng['hotel_admin_panels'] = $this->HotelAdminModel->get_admin_panel_list($admin_id);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/viewSendDepartmentList', $guest_mng);
            $this->load->view('include/footer');
        }
        else
        {
            $guest_mng["list"] = $this->HotelAdminModel->get_notifications_pagination($admin_id);
            $guest_mng['hotel_admin_panels'] = $this->HotelAdminModel->get_admin_panel_list($admin_id);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/viewSendDepartmentList', $guest_mng);
            $this->load->view('include/footer');
        }
    }


    //request reject .//3-11-2022 //archana
    public function reject_enquiry_request()
    {
        //$hotel_enquiry_request_id = $this->uri->segemnt(3);
        $hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');
        $admin_id = $this->session->userdata('u_id');

        $wh = '(hotel_enquiry_request_id = "' . $hotel_enquiry_request_id . '")';

        $arr = array(
            'request_status' => 2,
            'reject_date' => date('Y-m-d'),
            'request_reject_by' => 1,
            'request_reject_by_u_id' => $admin_id,
        );

        $up = $this->HotelAdminModel->edit_data('hotel_enquiry_request', $wh, $arr);

        if ($up) {
            $today_date = date('Y-m-d');

            $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id,$today_date);
            $this->load->view('hoteladmin/ajax', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('enquiry_request'));
        }
    }
    public function reject_enquiry_request1()
    {
        $hotel_enquiry_request_id = $this->uri->segment(3);
        // $hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');
        $admin_id = $this->session->userdata('u_id');
        // print_r($this->uri->segment(3));die;
        $wh = '(hotel_enquiry_request_id = "' . $hotel_enquiry_request_id . '")';
        // $user_id = $this->input->post('u_id');
        $wh2 = '(u_id ="'.$admin_id.'")';
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh2);
        $hotel_name = $get_hotel_name['hotel_name'];
        $arr = array(
            'request_status' => 2,
            'reject_date' => date('Y-m-d'),
            'request_reject_by' => 1,
            'request_reject_by_u_id' => $admin_id,
        );

        $up = $this->HotelAdminModel->edit_data('hotel_enquiry_request', $wh, $arr);

        if ($up) {
            $get_u_id = $this->MainModel->getData($tbl = 'hotel_enquiry_request', $wh);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            $title = "";
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Enquiry Requested Is Rejected';
                $body = 'Your Enquiry ID is "'.$hotel_enquiry_request_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }
            $subject = $title;
            $description = "$title In $hotel_name And Hotel Enquiry ID Is $hotel_enquiry_request_id";
            $arr_noti = array(
                                'hotel_id' => $admin_id,
                                'u_id' =>  $get_u_id['u_id'],
                                 'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );
    //  print_r($arr_noti);die;
             $this->MainModel->insert_data('user_notification',$arr_noti);

            $this->session->set_flashdata('msg', 'Request rejected');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }


    public function accept_cloakroom_service_request()
    {
        $admin_id = $this->session->userdata('u_id');
        $luggage_request_id = $this->uri->segment(3);

        $wh = '(luggage_request_id = "' . $luggage_request_id . '")';

        $arr = array(
            'request_status' => 1,
            'assign_by' => 1,
            'assign_by_u_id' => $admin_id,
        );

        $up = $this->HotelAdminModel->edit_data('luggage_request', $wh, $arr);

        if ($up) {
            $get_u_id = $this->MainModel->getData($tbl = 'luggage_request', $wh);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Luggage Request Is Accepted';
                $body = 'Your Luggage Request ID is "'.$luggage_request_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }
           
            $this->session->set_flashdata('msg', 'Request accepted successfully');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }

    public function edit_luggage_charges()
    {
        $luggage_type = $this->input->post('luggage_type');
        $charges = $this->input->post('charges');

        $luggage_charge_id = $this->input->post('luggage_charge_id');

        $wh = '(luggage_charge_id = "' . $luggage_charge_id . '")';

        $arr = array(
            'luggage_type' => $luggage_type,
            'charges' => $charges,
        );

        $up = $this->HotelAdminModel->edit_data('luggage_charges', $wh, $arr);

        if ($up) {
            $this->session->set_flashdata('msg', 'Data Updated Successfully');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }

    public function delete_luggage_charge()
    {
        $luggage_charge_id = $this->input->post('id');

        $wh = '(luggage_charge_id = "' . $luggage_charge_id . '")';

        $del = $this->HotelAdminModel->delete_data('luggage_charges', $wh);

        if ($del) {
            echo "1";
        } else {
            echo "0";
        }
    }
    public function add_luggage_charges()
    {
        $luggage_type = $this->input->post('luggage_type');
        $charges = $this->input->post('charges');

        $admin_id = $this->session->userdata('u_id');

        $wh = '(luggage_type = "' . $luggage_type . '" AND hotel_id = "' . $admin_id . '")';

        $luggage_charges_data = $this->HotelAdminModel->getData('luggage_charges', $wh);

        if ($luggage_charges_data) {
            $this->session->set_flashdata('msg', 'Data Already Exits');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {
            $arr = array(
                'hotel_id' => $admin_id,
                'luggage_type' => $luggage_type,
                'charges' => $charges,
                'added_by' => 1,
                'added_by_u_id' => $admin_id,
            );

            $add = $this->HotelAdminModel->insert_data('luggage_charges', $arr);

            if ($add) {
                $this->session->set_flashdata('msg', 'Luggage charges Added Successfully');
                redirect(base_url('HoteladminController/frontOfficeList'));
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
    }


    //2-11-2022 //archana
    public function reject_cloakroom_service_request()
    {
        $admin_id = $this->session->userdata('u_id');

        $luggage_request_id = $this->uri->segment(3);

        $wh = '(luggage_request_id = "' . $luggage_request_id . '")';

        $arr = array(
            'request_status' => 2,
            'assign_by' => 1,
            'assign_by_u_id' => $admin_id,
        );

        $up = $this->HotelAdminModel->edit_data('luggage_request', $wh, $arr);

        if ($up) {
            $get_u_id = $this->MainModel->getData($tbl = 'luggage_request', $wh);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            $reason ='';

            if($reject_reason == 1)
            {
                $reason = "Temporarily unavailable";
            }
            else if($reject_reason == 2)
            {
                $reason = "Space Not Available";
            }
            else if($reject_reason == 3)
            {
                $reason = "Please Contact Front Office";
            }
            else if($reject_reason == 4)
            {
                $reason = "Available Post Checkout";
            }
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Luggage Request Is Rejected';
                $body = 'Your Luggage Request ID is "'.$luggage_request_id.'" And Your Request is Rejected Because OF "'.$reason.'" ';
                $result = send_push_notification($deviceToken, $title, $body);
            }

            
            // print_r($result);die;

            $this->session->set_flashdata('msg', 'Request rejected successfully');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }
    public function delete_expenses()
    {
        $expense_id = $this->input->post('id');

        $wh = '(expense_id = "' . $expense_id . '")';

        $del = $this->HotelAdminModel->delete_data('expenses', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_user_expense_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxaccountslist', $guest_mng);
        } else {
            echo "0";
        }
    }
    public function add_floor()
    {
        $admin_id = $this->session->userdata('u_id');

        $floor = $this->input->post('floor');

        $wh = '(hotel_id = "' . $admin_id . '" AND floor = "' . $floor . '")';

        $floor_data = $this->HotelAdminModel->getData('floors', $wh);

        if ($floor_data) {
            echo 1;
        } else {
            $arr =  array(
                'hotel_id' => $admin_id,
                'floor' => $floor,
                'added_by' => 1,
                'added_by_u_id' => $admin_id,
            );

            $add = $this->HotelAdminModel->insert_data('floors', $arr);
            $guest_mng["list"] = $this->HotelAdminModel->get_floor_list_pagination($admin_id);
            if ($add) {
                // $this->session->set_flashdata('msg','Floor added Successfully..');
                $this->load->view('hoteladmin/ajaxFloorList', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
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

        if ($user_data) {
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

            $add = $this->HotelAdminModel->insert_data('expenses', $arr);

            if ($add) {
                 $guest_mng["list"] = $this->HotelAdminModel->get_user_expense_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxaccountslist', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        } else {
            $this->session->set_flashdata('msg', 'Mobile number not registerd');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }

    public function sendUserNoti()
    {
        $send_to = $this->input->post('send_to');
        $notification_type = $this->input->post('notification_type');
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $admin_id = $get_hotel_id['u_id'];

        if(isset($_POST['search'])) 
        {
            $guest_mng["list"] = $this->HotelAdminModel->get_admin_sent_user_notifications_pagination_search($admin_id,$send_to,$notification_type);
            $guest_mng['user_list'] = $this->HotelAdminModel->get_user_list_by_hotels($admin_id);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/viewSendUserNotiList', $guest_mng);
            $this->load->view('include/footer');
        }
        else
        {
            $guest_mng["list"] = $this->HotelAdminModel->get_admin_sent_user_notifications_pagination($admin_id);
            $guest_mng['user_list'] = $this->HotelAdminModel->get_user_list_by_hotels($admin_id);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/viewSendUserNotiList', $guest_mng);
            $this->load->view('include/footer');
        }
    }
    public function sent_notification_to_users()
    {
        $send_to = $this->input->post('send_to');
        $users = $this->input->post('users');
        $notification_type = $this->input->post('notification_type');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $description = strip_tags($description); // Remove HTML tags from the description
        $description = trim($description);
        // print_r($description);die;
        $admin_id = $this->session->userdata('u_id');

        if ($send_to == "all") {
            $send_to1 = 1;
        } else {
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
            'created_at' => date('Y-m-d H:i:s'),
        );

        $add = $this->HotelAdminModel->insert_data('notifications', $arr);
        $guest_mng["list"] = $this->HotelAdminModel->get_admin_sent_user_notifications_pagination($admin_id);
        $guest_mng['user_list'] = $this->HotelAdminModel->get_user_list_by_hotels($admin_id);
        if ($add) {
            if ($send_to1 == 2) {
                $count = count($users);

                for ($i = 0; $i < $count; $i++) {
                    $arr1 = array(
                        'notification_id' => $add,
                        'user_id' => $users[$i]
                    );

                    $add_u_nt = $this->HotelAdminModel->insert_data('notifictions_u_id', $arr1);

                    if ($add_u_nt) 
                    {
                        $wh1 = '(u_id = "' . $users[$i] . '")';
                        $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                        if($get_dt){
                            $deviceToken = $get_dt['token'];
                            $noti_title = $title;
                            $body =$description;
                            $result = send_push_notification($deviceToken, $noti_title, $body);
                        }
                        // print_r($result);
                        $arr_u_nt = array(
                            'u_id' => $users[$i],
                            'hotel_id' => $admin_id,
                            'subject' => $title,
                            'description' => $description,
                            'clear_flag' => 1,
                            'count_flag' => 1,
                        );

                        $this->HotelAdminModel->insert_data('user_notification', $arr_u_nt);
                    }
                }
            } else {
                $user_list = $this->HotelAdminModel->get_user_list_of_particular_hotel($admin_id);

                if ($user_list) {
                    foreach ($user_list as $u_l) {
                        $arr_nt = array(
                            'notification_id' => $add,
                            'user_id' => $u_l['u_id']
                        );

                        $add_u_nt_1 = $this->HotelAdminModel->insert_data('notifictions_u_id', $arr_nt);

                        if ($add_u_nt_1) {
                            $wh1 = '(u_id = "' . $u_l['u_id'] . '")';
                            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                            if(!empty($get_dt)){
                                $deviceToken = $get_dt['token'];
                                $noti_title = $title;
                                $body = $description;
                                $result = send_push_notification($deviceToken, $noti_title, $body);
                            }

                            
                            // print_r($result);
                            $arr_u_nt_1 = array(
                                'u_id' => $u_l['u_id'],
                                'hotel_id' => $admin_id,
                                'subject' => $title,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );

                            $this->HotelAdminModel->insert_data('user_notification', $arr_u_nt_1);
                        }
                    }
                }
            }

            $this->session->set_flashdata('msg', 'Sent Notification to Users Successfully...');
            // redirect(base_url('HoteladminController/sendUserNoti'));
            $this->load->view('hoteladmin/ajaxSendUserNotiList', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/sendUserNoti'));
        }
    }

    public function privacyPolicy()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

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
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

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
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

        $admin_id = $get_hotel_id['u_id'];
        $user_type = 9;
        //$guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
        $order_status = 0;
        $housekeeping_new_order["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, $order_status);
        $housekeeping_new_order['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);

        $this->load->view('include/header');
        $this->load->view('hoteladmin/viewFrontOfficeList', $housekeeping_new_order);
        $this->load->view('include/footer');
    }

    public function HouseKeepingList()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

        $admin_id = $get_hotel_id['u_id'];
        $user_type = 9;
        //$guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
        $order_status = 0;
        $housekeeping_new_order["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, $order_status);
        $housekeeping_new_order['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);


        $this->load->view('include/header');
        $this->load->view('hoteladmin/ViewHouseKeepingList', $housekeeping_new_order);
        $this->load->view('include/footer');
    }

    public function FoodBeberageList()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

        $admin_id = $get_hotel_id['u_id'];
        $user_type = 9;
        //$guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
        $order_status = 0;
        $housekeeping_new_order["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, $order_status);
        $housekeeping_new_order['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
        $this->load->view('include/header');
        $this->load->view('hoteladmin/ViewFoodBeberageList', $housekeeping_new_order);
        $this->load->view('include/footer');
    }



    public function RoomServiceList()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

        $admin_id = $get_hotel_id['u_id'];
        $user_type = 9;
        //$guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
        $order_status = 0;
        $housekeeping_new_order["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, $order_status);
        $housekeeping_new_order['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);


        $this->load->view('include/header');
        $this->load->view('hoteladmin/ViewRoomServiceList', $housekeeping_new_order);
        $this->load->view('include/footer');
    }

    public function enquiry_request()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $today_date = date('Y-m-d');

        $admin_id = $get_hotel_id['u_id'];

        $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id,$today_date);
        $this->load->view('include/header');
        $this->load->view('hoteladmin/viewEnquiryRequestList', $guest_mng);
        $this->load->view('include/footer');
    }

    public function orderManageList()
    {
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

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

        $wh1 = '(room_type_id  = "' . $room_type . '")';
        $room_type_name = $this->HotelAdminModel->getData($tbl = 'room_type', $wh1);

        $r_name = $room_type_name['room_type_name'];

        $wh = '(hotel_enquiry_request_id  = "' . $hotel_enquiry_request_id . '")';

        $arr = array(
            'room_type' => $room_type,
            'room_type_name' => $r_name
        );

        $update = $this->HotelAdminModel->edit_data('hotel_enquiry_request', $wh, $arr);

        if ($update) {
            echo "1";
        } else {
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

        $add = $this->HotelAdminModel->insert_data('faq', $arr1);

        if ($add) {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="' . $admin_id . '")';
            $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

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
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $guest_mng['icon_id'] = $postArr['data_id'];
        $guest_mng['sub_section_icon_id'] = $postArr['sub_section_id'];
        $admin_id = $get_hotel_id['u_id'];
        $today_date = date('Y-m-d');

        if ($postArr['data_id'] == 1) {
            $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id,$today_date);
            $guest_mng["list1"] = $this->HotelAdminModel->get_hotel_enquiry_accepted_request_pagination($admin_id);
            $guest_mng["list2"] = $this->HotelAdminModel->get_hotel_enquiry_rejected_request_pagination($admin_id);
        } else if ($postArr['data_id'] == 2) {
            $guest_mng["floor_list"] = $this->HotelAdminModel->get_floor_list_pagination($admin_id);
        } else if ($postArr['data_id'] == 3) {
            $guest_mng["floor_list"] = $this->HotelAdminModel->get_floor_list_pagination($admin_id);
        } else if ($postArr['data_id'] == 4) {
            $guest_mng["list"] = $this->HotelAdminModel->get_floor_list_pagination($admin_id);
        } else if ($postArr['data_id'] == 5) {
            $guest_mng["list"] = $this->HotelAdminModel->get_room_type_list_pagination($admin_id);
        } else if ($postArr['data_id'] == 6) {
            $room_type = 1;
            $guest_mng['room_type'] = $this->HotelAdminModel->get_room_type_list1($admin_id);
            $guest_mng['floor_list'] = $this->HotelAdminModel->get_floor_list($admin_id);
            $guest_mng['room_type_data'] = $this->HotelAdminModel->get_room_type_data($admin_id);

            $guest_mng['list'] = $this->HotelAdminModel->get_room_related_data($admin_id, $room_type);

            $guest_mng['floor_list1'] = $this->HotelAdminModel->get_floor_list($admin_id);
        } else if ($postArr['data_id'] == 7) {
            $guest_mng["list"] = $this->HotelAdminModel->get_business_center_pagination($admin_id);
        } else if ($postArr['data_id'] == 8) {

            $guest_mng["list"] = $this->HotelAdminModel->get_business_center_reservation_list_app($admin_id);
            $guest_mng['list1'] = $this->HotelAdminModel->get_business_center_list_pagination($admin_id);
            $guest_mng["list2"] = $this->HotelAdminModel->get_business_center_list_reject_pagination($admin_id);
            $guest_mng['business_center'] = $this->HotelAdminModel->get_active_business_center($admin_id);
        } else if ($postArr['data_id'] == 9) {


            $guest_mng['list'] = $this->FrontofficeModel->get_service_request($admin_id);

            //  $guest_mng["list"] = [];
        } else if ($postArr['data_id'] == 10) {

            if ($guest_mng['sub_section_icon_id'] == 1) {
                $service_name = 1;
                $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
            }


            // $guest_mng["list"] = [];
        } else if ($postArr['data_id'] == 11) {
            $guest_mng["list"] = $this->HotelAdminModel->get_lost_found_pagination($admin_id);
        } else if ($postArr['data_id'] == 12) {
            $guest_mng["list"] = $this->HotelAdminModel->get_user_expense_pagination($admin_id);
        } else if ($postArr['data_id'] == 13) {
            $guest_mng["list"] = $this->HotelAdminModel->get_visitor_pagination($admin_id);
        } else if ($postArr['data_id'] == 14) {
            $guest_mng["list"] = $this->HotelAdminModel->get_visitor_pagination($admin_id);
        } else if ($postArr['data_id'] == 15) {
            $guest_mng["list"] = $this->HotelAdminModel->get_visitor_pagination($admin_id);
        }
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
    }
    public function ajaxIconBlockView_n()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 4;
        $guest_mng["list"] = $this->HotelAdminModel->get_floor_list_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
    }
    public function ajaxIconBlockView_room()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 5;
        $guest_mng["list"] = $this->HotelAdminModel->get_room_type_list_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
    }
    public function ajaxIconBlockView_lost()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 11;
        $guest_mng["list"] = $this->HotelAdminModel->get_lost_found_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
    }
    public function ajaxIconBlockView_exp()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 12;
        $guest_mng["list"] = $this->HotelAdminModel->get_user_expense_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
    }
    public function ajaxIconBlockView_n1()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 13;
        $guest_mng["list"] = $this->HotelAdminModel->get_visitor_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxIconBlockVisitorView', $guest_mng);
    }
    public function ajaxFoodVeverageView_n1()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 1;
        $guest_mng["list"] = $this->HotelAdminModel->get_facility_list_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxFoodBeverageIcon', $guest_mng);
    }
    public function ajaxiconblockviewbusreq()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 8;
        $guest_mng["list"] = $this->HotelAdminModel->get_business_center_reservation_list_app($admin_id);
        // print_r($guest_mng["list"]);die;
        $guest_mng['list1'] = $this->HotelAdminModel->get_business_center_list_pagination($admin_id);
        $guest_mng["list2"] = $this->HotelAdminModel->get_business_center_list_reject_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
    }

    public function assign_room_serv_services_order_to_staff()
    {
        $rmservice_services_order_id = $this->input->post('rmservice_services_order_id');
        // print_r($this->input->post());die;
        $order_status = $this->input->post('order_status');

        $rand_no = rand('1111', '9999');

        $wh = '(rmservice_services_order_id = "' . $rmservice_services_order_id . '")';

        $rs_s_order_data = $this->HotelAdminModel->getData('rmservice_services_orders', $wh);

        if ($order_status == 1) {
            $staff_id = $this->input->post('staff_id');
            $accept_date = date('Y-m-d');
            $reject_date = "";
            $otp = $rand_no;
        } else {
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

        $up = $this->HotelAdminModel->edit_data('rmservice_services_orders', $wh, $arr);
        $admin_id = $this->session->userdata('u_id');
        $guest_mng["list"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id, 0);

        if ($up) {
            if ($order_status == 1) {
                $wh1 = '(room_service_unique_id = "' . $rs_s_order_data['room_service_unique_id'] . '")';

                $arr_rs = array(
                    'order_status' => $order_status,
                    'staff_id' => $staff_id,
                    'accept_date' => $accept_date,
                    'reject_date' => $reject_date,
                    'otp' => $otp,
                );

                $this->HotelAdminModel->edit_data('room_service_menu_orders', $wh1, $arr);

                // $this->session->set_flashdata('msg','Order Accepted successfully');
                $this->load->view('hoteladmin/ajaxOrderAcceptView', $guest_mng);
                // redirect(base_url('HoteladminController/order_management'));
            } else {
                echo 1;
            }
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/order_management'));
        }
    }

    public function assign_food_order_to_staff()
    {
        $food_order_id = $this->input->post('food_order_id');
        $order_status = $this->input->post('order_status');
        $reject_reason = $this->input->post('reject_reason');
        $staff_id = $this->input->post('staff_id');
        $food_user_id = $this->input->post('food_user_id');


        $rand_no = rand('1111', '9999');

        $wh = '(food_order_id = "' . $food_order_id . '")';

        $staff_name = '';
		$where1 = '(u_id ="' . $staff_id. '")';
		$get_staff_name = $this->MainModel->getData('register', $where1);
		if (!empty($get_staff_name)) {
			$staff_name = $get_staff_name['full_name'];
		} else {
			$staff_name = '';
		}

        if ($order_status == 1) {
            $accept_date = date('Y-m-d');
            $reject_date = "";  
            $otp = $rand_no;
        } else {
            $staff_id = 0;
            $accept_date = "";
            $otp = "";
            $reject_date = date('Y-m-d');
        }

        $arr = array(
            'order_status' => $order_status,
            'reject_reason' => $reject_reason,
            'staff_id' => $staff_id,
            'staff_name'=>$staff_name,
            'accept_date' => $accept_date,
            'accept_time'=>date('G:i:s'),
            'reject_date' => $reject_date,
            'otp' => $otp,
        );

        $up = $this->HotelAdminModel->edit_data('food_orders', $wh, $arr);
        $admin_id = $this->session->userdata('u_id');
        $wh_d = '(u_id = "' . $admin_id . '")';
        $hotel_data = $this->MainModel->getData('register',$wh_d);
        $hotel_name = $hotel_data['hotel_name'];

        $guest_mng["list"] = $this->HotelAdminModel->get_food_order_pagination($admin_id, 0);
        if ($up) {
            if ($order_status == 1) {

                // push notification for user
                $get_u_id = $this->MainModel->getData($tbl = 'food_orders', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title = "";
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Food Order Is Accepted';
                    $body = 'Your Food Order ID is "'.$food_order_id.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                
                // inside user app notification
                $subject = $title;
                $description = "$title In $hotel_name And Your Order Id Is $food_order_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $food_user_id,
                                    'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
                // print_r($arr_noti);die;
                $this->MainModel->insert_data('user_notification',$arr_noti);

                //push notification for staff
                $wh_s = '(u_id = "' . $get_u_id['staff_id'] . '")';
                $get_staff_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh_s);
                $title1 = "";
                if(!empty($get_staff_dt)){
                    $deviceToken1 = $get_staff_dt['token'];
                    $title1 = 'New Order Assign ';
                    $body1 = 'Food Order ID is "'.$food_order_id.'"';
                    $result1 = send_push_notification_for_staff($deviceToken1, $title1, $body1);
                }

                // inside staff app notification
                $subject1 = $title1;
                $description1 = "$title1 And Order Id Is $food_order_id";
                $arr_staff_noti = array(
                                    'u_id'=>$staff_id,
                                    'hotel_id' => $admin_id,
                                    'subject' => $subject1,
                                    'description' => $description1,
                                    'notification_order_flag' =>0,    
                                );
                // print_r($arr_staff_noti);die;
                $this->MainModel->insert_data('staff_notification',$arr_staff_noti);

                $this->load->view('hoteladmin/ajaxOrderFoodView', $guest_mng);
            } else {
                $get_u_id = $this->MainModel->getData($tbl = 'food_orders', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title = "";
                $reason = '';

                if ($get_u_id['reject_reason'] == 1) {
                    $reason = "Out of stock";
                } else if ($get_u_id['reject_reason'] == 2) {
                    $reason = "We Do Not Serve";
                } else if ($get_u_id['reject_reason'] == 3) {
                    $reason = "Out Of Time";
                } else if ($get_u_id['reject_reason'] == 4) {
                    $reason = "Others";
                }

                // push notification for user
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Food Order Is Rejected';
                    $body = 'Your Food Order ID is "'.$food_order_id.'" And Your Order is Rejected Because OF "'.$reason.'" ';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                
                 // inside app notification
                 $subject = $title;
                 $description = "$title In $hotel_name Because Of $reason And Your Order Id Is $food_order_id";
                 $arr_noti = array(
                                     'hotel_id' => $admin_id,
                                     'u_id' => $food_user_id,
                                     'subject' => $subject,
                                     'description' => $description,
                                     'clear_flag' => 1,
                                     'count_flag' => 1,
                                 );
                //  print_r($arr_noti);die;
                $this->MainModel->insert_data('user_notification',$arr_noti);

                $this->load->view('hoteladmin/ajaxOrderFoodView', $guest_mng);
            }
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/order_management'));
        }
    }
     public function assign_laundry_order_to_staff()
    {
        $cloth_order_id = $this->input->post('cloth_order_id');
        $order_status = $this->input->post('order_status');
        $reject_reason = $this->input->post('reject_reason');
        $cloth_user_id = $this->input->post('cloth_user_id');
        $staff_id = $this->input->post('staff_id');
        $rand_no = rand(1111, 9999);

        $wh = '(cloth_order_id = "' . $cloth_order_id . '")';
        $staff_name = '';
        $where1 = '(u_id ="' . $staff_id. '")';
        $get_staff_name = $this->MainModel->getData('register', $where1);
        if (!empty($get_staff_name)) {
            $staff_name = $get_staff_name['full_name'];
        } else {
            $staff_name = '';
        }

        $order_data = $this->HotelAdminModel->getData('cloth_orders', $wh);

        if ($order_status == 1) {
            $staff_id = $this->input->post('staff_id');
            $accept_date = date('Y-m-d');
            $reject_date = "";
            $otp = $rand_no;
        } else {
            $staff_id = 0;
            $accept_date = "";
            $otp = 0;
            $reject_date = date('Y-m-d');
        }

        $arr = array(
            'order_status' => $order_status,
            'reject_reason' => $reject_reason,
            'staff_id' => $staff_id,
            'staff_name'=>$staff_name,
            'accept_date' => $accept_date,
            'accept_time'=>date('G:i:s'),
            'reject_date' => $reject_date,
            'otp' => $otp
        );

        $up = $this->HotelAdminModel->edit_data('cloth_orders', $wh, $arr);
        $admin_id = $this->session->userdata('u_id');
        $wh_d = '(u_id = "' . $admin_id . '")';
        $hotel_data = $this->MainModel->getData('register',$wh_d);
        $hotel_name = $hotel_data['hotel_name'];

        $guest_mng["list"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id, 0);

        if ($up) {
            if ($order_status == 1) {
               
                $subject = "OTP for laundry Order";

                $description = "Your OTP for Order ID :" . $cloth_order_id . " is " . $otp;

                $arr1 = array(
                    'u_id' => $order_data['u_id'],
                    'hotel_id' => $order_data['hotel_id'],
                    'subject' => $subject,
                    'description' => $description,
                );

                $this->HotelAdminModel->insert_data('user_notification', $arr1);

                // push notification for user
                $get_u_id = $this->MainModel->getData($tbl = 'cloth_orders', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title = "";
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Laundry Order Is Accepted';
                    $body = 'Your Laundry Order ID is "'.$cloth_order_id.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                // inside user app notification
                $subject = $title;
                $description = "$title In $hotel_name And Your Order Id Is $cloth_order_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $cloth_user_id,
                                    'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
                //  print_r($arr_noti);die;
                $this->MainModel->insert_data('user_notification',$arr_noti);
                
                //push notification for staff
                $wh_s = '(u_id = "' . $get_u_id['staff_id'] . '")';
                $get_staff_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh_s);
                $title1 = "";
                if(!empty($get_staff_dt)){
                    $deviceToken1 = $get_staff_dt['token'];
                    $title1 = 'New Laundry Order Assign ';
                    $body1 = 'Laundry Order ID is "'.$cloth_order_id.'"';
                    $result1 = send_push_notification_for_staff($deviceToken1, $title1, $body1);
                }
                
                // inside staff app notification
                $subject1 = $title1;
                $description1 = "$title1 And Order Id Is $cloth_order_id";
                $arr_staff_noti = array(
                                    'u_id'=>$staff_id,
                                    'hotel_id' => $admin_id,
                                    'subject' => $subject1,
                                    'description' => $description1,
                                    'notification_order_flag' =>0,    
                                );
                // print_r($arr_staff_noti);die;
                $this->MainModel->insert_data('staff_notification',$arr_staff_noti);

                $this->load->view('hoteladmin/ajaxLaundryView', $guest_mng);
            } else {

                // push notification for user
                $get_u_id = $this->MainModel->getData($tbl = 'cloth_orders', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title = "";
                $reason = '';

                if ($get_u_id['reject_reason'] == 1) {
                    $reason = "Out of stock";
                } else if ($get_u_id['reject_reason'] == 2) {
                    $reason = "We Do Not Serve";
                } else if ($get_u_id['reject_reason'] == 3) {
                    $reason = "Out Of Time";
                } else if ($get_u_id['reject_reason'] == 4) {
                    $reason = "Others";
                }
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Laundry Order Is Rejected';
                    $body = 'Your Laundry Order ID is "'.$cloth_order_id.'" And Your Order is Rejected Because OF "'.$reason.'" ';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                //inside user app notification
                
                $subject = $title;
                $description = "$title In $hotel_name Because Of $reason And Your Order Id Is $cloth_order_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $cloth_user_id,
                                    'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
                // print_r($arr_noti);die;
                $this->MainModel->insert_data('user_notification',$arr_noti);
                

                $this->load->view('hoteladmin/ajaxLaundryView', $guest_mng);
            }
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/order_management'));
        }
    }

    public function ajaxOrderIconView()
    {
        // echo "<pre>";
        // print_r($room_num);
        // exit;
        $postArr = $this->input->post();
        $room_num = $this->input->post('room_num');
        $userType = $this->session->userdata('userType');
        $guest_mng['icon_id'] = $postArr['data_id'];
        $guest_mng['sub_section_icon_id'] = $postArr['sub_section_id'];

        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $admin_id = $get_hotel_id['u_id'];
        // if($postArr['data_id'] == 1){

        //     $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id);
        //     $guest_mng["list1"] = $this->HotelAdminModel->get_hotel_enquiry_accepted_request_pagination($admin_id);
        //     $guest_mng["list2"] = $this->HotelAdminModel->get_hotel_enquiry_rejected_request_pagination($admin_id);


        // }else 
        if ($postArr['data_id'] == 2) {
            $guest_mng['room_num'] = $room_num;
            $order_status = 0;
            $user_type = 9;
            $guest_mng["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, $order_status, $room_num);
            $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
            $guest_mng["list1"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, 1, $room_num);
            $guest_mng["list2"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, 2, $room_num);
            $guest_mng["list3"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, 3, $room_num);
        } else if ($postArr['data_id'] == 3) {
            $user_type = 8;
            $order_status = 0;
            $guest_mng['room_num'] = $room_num;
            $guest_mng["list"] = $this->HotelAdminModel->get_food_order_pagination($admin_id, $order_status, $room_num);
            $guest_mng["list1"] = $this->HotelAdminModel->get_food_order_pagination($admin_id, 1, $room_num);
            $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
            $guest_mng["list2"] = $this->HotelAdminModel->get_food_order_pagination($admin_id, 2, $room_num);
            $guest_mng["list3"] = $this->HotelAdminModel->get_food_order_pagination($admin_id, 3, $room_num);
        } else if ($postArr['data_id'] == 4) {
            $order_status = 0;
            $user_type = 9;
            $guest_mng["list"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id, $order_status, $room_num);
            $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
            $guest_mng["list1"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id, 1, $room_num);
            $guest_mng["list2"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id, 2, $room_num);
            $guest_mng["list3"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id, 3, $room_num);
        }
        $guest_mng["type"]  = !empty($postArr['type']) ? $postArr['type'] : '';

        $this->load->view('hoteladmin/ajaxOrderIconView', $guest_mng);
    }

    public function get_food_new_ord_data()
    {
        $room_num = $this->input->post('room_num');

        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $columnName = '';
        foreach ($this->input->post('columns') as $col) {
            $columnName = $col['data'];
        }
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $hotel_id = $get_hotel_id['u_id'];

        $get_new_food_order_data = $this->HotelAdminModel->get_new_food_order_data($rowperpage, $row, $search, $hotel_id, $room_num);
        // echo "<pre>";
        // print_r($get_new_food_order_data);
        // exit;
        $total_new_food_order_data = $this->HotelAdminModel->get_total_new_food_order_data($search, $hotel_id, $room_num = '');

        $totalRecords = $total_new_food_order_data->total_record;

        $data = array();
        $i = 1;
        foreach ($get_new_food_order_data as $val) {
            $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="' . $val['out_of_time_status'] . '"><span> ' . $val['food_order_id'] . '</span></div>';

            $services = ' <a href="#" class="btn btn-secondary shadow btn-xs food_modal_btn" data-food-id ="' . $val['food_order_id'] . '"><i class="fa fa-eye"></i></a>';

            $orderstatus = '<a href="#"><div class="badge badge-danger"> Pending </div></a>';

            $action = '<a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data1" data-bs-toggle="modal" data-id="' . $val['food_order_id'] . '" data-bs-target=".update_faq_modal1"><i class="fa fa-share"></i></a> ';

            // $time = date('h:i A', strtotime($val['visit_time']));
            // $Visiting_Time = '<h5>'.$time.'</h5>';

            $data[] = array(
                "sr_no"            =>    $row + $i++,
                "Order_Id"        =>  $order_id,
                "Order_Type"    =>  "App",
                "Order_Date"    =>  date('d-m-Y', strtotime($val['order_date'])),
                "Order_Total"    =>  $val['order_total'],
                "Name"            =>  $val['full_name'],
                "Mobile_No"        =>  $val['mobile_no'],
                "Services"        =>  $services,
                "Order_Status"    =>  $orderstatus,
                "Action"        =>  $action,
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
    }
    public function food_order_view()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $ord_id = $this->input->post('ord_id');
        $admin_id = $this->session->userdata('u_id');
        $data['fb_order_details'] = $this->MainModel->get_food_details($admin_id, $ord_id);
        $this->load->view('hoteladmin/ajax_food_Order_View_data', $data);
    }

    public function housekeeping_order_status()
    {
        $arr = array(
            'order_status' => $_POST['status'],
            'complete_date' => date('Y-m-d'),
        );
        $h_k_order_id = $_POST['uid'];
        $house_u_id = $_POST['house_u_id'];

        $admin_id = $this->session->userdata('u_id');
        $wh_d = '(u_id = "' . $admin_id . '")';
        $hotel_data = $this->MainModel->getData('register',$wh_d);
        $hotel_name = $hotel_data['hotel_name'];

        $where = '(h_k_order_id="' . $h_k_order_id . '")';
        $id = $this->MainModel->editData($tbl = "house_keeping_orders", $where, $arr);
        if ($id) {
            // push notification for user
            $get_u_id = $this->MainModel->getData($tbl = 'house_keeping_orders', $where);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            $title = "";
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'HouseKeeping Order Is Completed';
                $body = 'Your HouseKeeping Order ID is "'.$h_k_order_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }

            $subject = $title;
            $description = "$title In $hotel_name And Your Order Id Is $h_k_order_id";
            $arr_noti = array(
                                'hotel_id' => $admin_id,
                                'u_id' => $house_u_id,
                                'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );
            // print_r($arr_noti);die;
            $this->MainModel->insert_data('user_notification',$arr_noti);

            
            // print_r($result);die;
            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }
    public function food_order_status()
    {

        $arr = array(
            'order_status' => $_POST['status'],
            'complete_date' => date('Y-m-d'),
        );

        $food_order_id = $_POST['uid'];
        $food_u_id = $_POST['food_u_id'];

        $admin_id = $this->session->userdata('u_id');
        $wh_d = '(u_id = "' . $admin_id . '")';
        $hotel_data = $this->MainModel->getData('register',$wh_d);
        $hotel_name = $hotel_data['hotel_name'];
        
        $where = '(food_order_id ="' . $food_order_id . '")';
        $id = $this->MainModel->editData($tbl = "food_orders", $where, $arr);
        if ($id) {
            // push notification for user
            $get_u_id = $this->MainModel->getData($tbl = 'food_orders', $where);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            $title = "";
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Food Order Is Completed';
                $body = 'Your Food Order ID is "'.$food_order_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }

            // inside user app notification
            $subject = $title;
            $description = "$title In $hotel_name And Your Order Id Is $food_order_id";
            $arr_noti = array(
                                'hotel_id' => $admin_id,
                                'u_id' => $food_u_id,
                                'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );
            // print_r($arr_noti);die;
            $this->MainModel->insert_data('user_notification',$arr_noti);
            
            // print_r($result);die;
            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }
    public function cloth_order_status()
    {

        $arr = array(
            'order_status' => $_POST['status'],
            'complete_date' => date('Y-m-d'),
            'complete_time' => date("G:i:s")
        );

        $cloth_order_id = $_POST['uid'];
        $cloth_u_id = $_POST['cloth_u_id'];

        $admin_id = $this->session->userdata('u_id');
        $wh_d = '(u_id = "' . $admin_id . '")';
        $hotel_data = $this->MainModel->getData('register',$wh_d);
        $hotel_name = $hotel_data['hotel_name'];

        $where = '(cloth_order_id ="' . $cloth_order_id . '")';
        $id = $this->MainModel->editData($tbl = "cloth_orders", $where, $arr);
        if ($id) {

            // push notification for user
            $get_u_id = $this->MainModel->getData($tbl = 'cloth_orders', $where);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            $title = "";
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Laundry Order Is Completed';
                $body = 'Your Laundry Order ID is "'.$cloth_order_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }

            // inside user app notification
            $subject = $title;
            $description = "$title In $hotel_name And Your Order Id Is $cloth_order_id";
            $arr_noti = array(
                                'hotel_id' => $admin_id,
                                'u_id' => $cloth_u_id,
                                'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );
            // print_r($arr_noti);die;
            $this->MainModel->insert_data('user_notification',$arr_noti);

            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }
    public function ajaxOrderIconView_v3()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 4;
        $order_status = 0;
        $user_type = 9;
        $guest_mng["list"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id, $order_status);
        $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
        $guest_mng["list1"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id, 1);
        $guest_mng["list2"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id, 2);
        $guest_mng["list3"] = $this->HotelAdminModel->get_laundry_order_pagination($admin_id, 3);

        $this->load->view('hoteladmin/ajaxOrderIconView', $guest_mng);
    }
    public function ajaxOrderIconView_v2()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 3;
        $user_type = 8;
        $order_status = 0;
        $guest_mng["list"] = $this->HotelAdminModel->get_food_order_pagination($admin_id, $order_status);
        $guest_mng["list1"] = $this->HotelAdminModel->get_food_order_pagination($admin_id, 1);
        $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
        $guest_mng["list2"] = $this->HotelAdminModel->get_food_order_pagination($admin_id, 2);
        $guest_mng["list3"] = $this->HotelAdminModel->get_food_order_pagination($admin_id, 3);
        $this->load->view('hoteladmin/ajaxOrderIconView', $guest_mng);
    }
    public function ajaxOrderIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 2;
        $order_status = 0;
        $user_type = 9;
        $guest_mng["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, $order_status);
        $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
        $guest_mng["list1"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, 1);
        $guest_mng["list2"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, 2);
        $guest_mng["list3"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, 3);


        $this->load->view('hoteladmin/ajaxOrderIconView', $guest_mng);
    }
    public function ajaxOrderIconView_n()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 2;
        $order_status = 0;
        $user_type = 9;
        $guest_mng["list"] = $this->HotelAdminModel->get_house_keeping_service_order_pagination($admin_id, $order_status);
        $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
        $this->load->view('hoteladmin/ajaxOrderIconView', $guest_mng);
    }
    public function delete_house_keeping_service()
    {
        $admin_id = $this->session->userdata('u_id');
        $h_k_services_id = $this->input->post('id');

        $wh = '(h_k_services_id = "' . $h_k_services_id . '")';

        $del = $this->HotelAdminModel->delete_data('house_keeping_services', $wh);

        if ($del) {
            $guest_mng["list"] = $this->HotelAdminModel->get_housekeeping_services_list_pagination($admin_id);
              $this->load->view('hoteladmin/ajaxhousekeepingserviceedit', $guest_mng);
        } else {
            echo "0";
        }
    }
    public function get_id_data()
    {
        $room_type = $this->input->post('id');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $admin_id = $get_hotel_id['u_id'];
        $guest_mng['list'] = $this->HotelAdminModel->get_room_related_data($admin_id, $room_type);
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
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $guest_mng['icon_id'] = $postArr['data_id'];
        $admin_id = $get_hotel_id['u_id'];
        if ($postArr['data_id'] == 1) {
            $guest_mng["list"] = $this->HotelAdminModel->get_cloth_list_pagination($admin_id);
            $guest_mng['laundry_time'] = $this->HotelAdminModel->get_laundry_time($admin_id);
        } else if ($postArr['data_id'] == 2) {
            $guest_mng["list"] = $this->HotelAdminModel->get_housekeeping_services_list_pagination($admin_id);
        } else if ($postArr['data_id'] == 3) {

            $hotel_id = $this->session->userdata('u_id');
            $date = date('Y-m-d');

            //get dirty rooms
            $wh = '(room_status = 1 AND hotel_id ="' . $hotel_id . '")';
            $guest_mng['get_dirty_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh);

            //get accupied rooms
            $wh1 = '(room_status = 2 AND hotel_id ="' . $hotel_id . '")';
            $guest_mng['get_accupied_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh1);

            //get available rooms

            $guest_mng['get_available_rooms'] = $this->HotelAdminModel->get_daily_report_available_rooms( $hotel_id);
            //print_r($data['get_available_rooms']); die;

            //get under maintainance rooms
            $wh3 = '(room_status = 4 AND hotel_id ="' . $hotel_id . '")';
            $guest_mng['get_under_maintenance_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh3);
        }
        $this->load->view('hoteladmin/ajaxHousekeepingIcon', $guest_mng);
    }
    public function delete_room_service_minibar()
    {
        $r_s_min_bar_id = $this->input->post('id');

        $wh = '(r_s_min_bar_id = "' . $r_s_min_bar_id . '")';

        $del = $this->HotelAdminModel->delete_data('room_servs_mini_bar', $wh);

        if ($del) {
            echo "1";
        } else {
            echo "0";
        }
    }
    public function delete_room_service_cat()
    {
        $room_servs_category_id = $this->input->post('id');

        $wh = '(room_servs_category_id = "' . $room_servs_category_id . '")';

        $del = $this->HotelAdminModel->delete_data('room_servs_category', $wh);

        if ($del) {
            echo "1";
        } else {
            echo "0";
        }
    }


    public function order_management()
    {
        // echo 'hi';die;
        $data['click_on_room_number'] = $this->input->get('room_no');
        if ($this->session->userdata('u_id')) {
            $this->load->view('include/header');
            $this->load->view('hoteladmin/viewOrderManagement', $data);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
    }
    public function ajaxRoomServiceIcon()
    {
        $postArr = $this->input->post();
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $guest_mng['icon_id'] = $postArr['data_id'];
        $admin_id = $get_hotel_id['u_id'];
        if ($postArr['data_id'] == 1) {

            $guest_mng["list"] = $this->HotelAdminModel->room_service_list_pagination($admin_id);
            // print_r($guest_mng["list"]);die;
        } else if ($postArr['data_id'] == 2) {
            $guest_mng['room_servs_cat_list'] = $this->HotelAdminModel->get_room_service_cat_list($admin_id);
            $guest_mng['list'] = $this->HotelAdminModel->get_room_service_cat_list($admin_id);
        } else if ($postArr['data_id'] == 3) {
            $guest_mng["list"] = $this->HotelAdminModel->room_service_minibar_pagination($admin_id);
        }

        $this->load->view('hoteladmin/ajaxRoomServiceIcon', $guest_mng);
    }

    public function delete_room_service_menu()
    {
        $room_serv_menu_id = $this->input->post('id');

        $wh = '(room_serv_menu_id = "' . $room_serv_menu_id . '")';

        $del = $this->HotelAdminModel->delete_data('room_serv_menu_list', $wh);

        if ($del) {
            echo "1";
        } else {
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

        $wh = '(menu_name = "' . ucwords($menu_name) . '" AND hotel_id = "' . $admin_id . '")';

        $room_serv_menu_list = $this->HotelAdminModel->getData('room_serv_menu_list', $wh);

        $discount_price = ($price * $offer_in_per) / 100;

        $total_price = $price - $discount_price;

        if ($room_serv_menu_list) {
            $this->session->set_flashdata('msg', 'This Menu already exits..');
            redirect(base_url('HoteladminController/RoomServiceList'));
        } else {
            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];

            $path = 'assets/upload/room_service_menu_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $image = base_url() . $path . $file_data['file_name'];

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

                $add = $this->HotelAdminModel->insert_data('room_serv_menu_list', $arr);

                if ($add) {
                    $this->session->set_flashdata('msg', 'Data Added Successfully...');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                }
            } else {
                $this->session->set_flashdata('msg', 'Error to upload image');
                redirect(base_url('HoteladminController/RoomServiceList'));
            }
        }
    }

    public function edit_room_service_cat()
    {
        $category_name = $this->input->post('category_name');

        $room_servs_category_id = $this->input->post('room_servs_category_id');

        $wh = '(room_servs_category_id = "' . $room_servs_category_id . '")';

        $room_servs_category = $this->HotelAdminModel->getData('room_servs_category', $wh);

        if (!empty($_FILES['image']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];

            $path = 'assets/upload/room_service_cat_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $image = base_url() . $path . $file_data['file_name'];
            }
        } else {
            $image = $room_servs_category['image'];
        }

        $arr = array(
            'category_name' => ucwords($category_name),
            'image' => $image,
        );

        $up = $this->HotelAdminModel->edit_data('room_servs_category', $wh, $arr);

        if ($up) {
            $this->session->set_flashdata('msg', 'Data updated Successfully...');
            redirect(base_url('HoteladminController/RoomServiceList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/RoomServiceList'));
        }
    }

    public function add_room_service_cat()
    {
        $category_name = $this->input->post('category_name');

        $admin_id = $this->session->userdata('u_id');

        $wh = '(category_name = "' . ucwords($category_name) . '" AND hotel_id = "' . $admin_id . '")';

        $room_servs_category = $this->HotelAdminModel->getData('room_servs_category', $wh);

        if ($room_servs_category) {
            $this->session->set_flashdata('msg', 'This category already exits..');
            redirect(base_url('HoteladminController/RoomServiceList'));
        } else {
            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];

            $path = 'assets/upload/room_service_cat_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $image = base_url() . $path . $file_data['file_name'];

                $arr = array(
                    'hotel_id' => $admin_id,
                    'category_name' => ucwords($category_name),
                    'image' => $image,
                    'added_by' => 1,
                    'added_by_u_id' => $admin_id,
                );

                $add = $this->HotelAdminModel->insert_data('room_servs_category', $arr);

                if ($add) {
                    $this->session->set_flashdata('msg', 'Data Added Successfully...');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                }
            } else {
                $this->session->set_flashdata('msg', 'Error to upload image');
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

        $wh = '(room_serv_menu_id = "' . $room_serv_menu_id . '")';

        $room_serv_menu_list = $this->HotelAdminModel->getData('room_serv_menu_list', $wh);

        $total_price = $room_serv_menu_list['total_price'];

        if ($_POST['price']) {
            $discount_price = ($price * $offer_in_per) / 100;

            $total_price = $price - $discount_price;
        }

        if (!empty($_FILES['image']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];

            $path = 'assets/upload/room_service_menu_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $image = base_url() . $path . $file_data['file_name'];
            }
        } else {
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

        $up = $this->HotelAdminModel->edit_data('room_serv_menu_list', $wh, $arr);

        if ($up) {
            $this->session->set_flashdata('msg', 'Data updated Successfully...');
            redirect(base_url('HoteladminController/RoomServiceList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/RoomServiceList'));
        }
    }

    public function add_room_services()
    {
        $service_name = $this->input->post('service_name');
        $amount = $this->input->post('amount');
        $additional_note = $this->input->post('additional_note');

        $admin_id = $this->session->userdata('u_id');

        $wh = '(service_name = "' . ucwords($service_name) . '" AND hotel_id = "' . $admin_id . '")';

        $room_servs_services = $this->HotelAdminModel->getData('room_servs_services', $wh);

        if ($room_servs_services) {
            $this->session->set_flashdata('msg', 'This service already exits..');
            redirect(base_url('HoteladminController/RoomServiceList'));
        } else {
            $_FILES['my_file']['name'] = $_FILES['icon_img']['name'];
            $_FILES['my_file']['type'] = $_FILES['icon_img']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['icon_img']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['icon_img']['size'];
            $_FILES['my_file']['error'] = $_FILES['icon_img']['error'];

            $path = 'assets/upload/room_service_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $icon_img = base_url() . $path . $file_data['file_name'];

                $arr = array(
                    'hotel_id' => $admin_id,
                    'service_name' => ucwords($service_name),
                    'amount' => $amount,
                    'icon_img' => $icon_img,
                    'additional_note' => $additional_note,
                    'added_by' => 1,
                    'added_by_u_id' => $admin_id,
                );

                $add = $this->HotelAdminModel->insert_data('room_servs_services', $arr);

                if ($add) {
                    $this->session->set_flashdata('msg', 'Data Added Successfully...');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                }
            } else {
                $this->session->set_flashdata('msg', 'Error to upload image');
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

        $wh = '(r_s_min_bar_id = "' . $r_s_min_bar_id . '")';

        $room_servs_mini_bar = $this->HotelAdminModel->getData('room_servs_mini_bar', $wh);

        if (!empty($_FILES['icon_img']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['icon_img']['name'];
            $_FILES['my_file']['type'] = $_FILES['icon_img']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['icon_img']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['icon_img']['size'];
            $_FILES['my_file']['error'] = $_FILES['icon_img']['error'];

            $path = 'assets/upload/room_service_minibar_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $icon_img = base_url() . $path . $file_data['file_name'];
            }
        } else {
            $icon_img = $room_servs_mini_bar['icon_img'];
        }

        $arr = array(
            'item_name' => ucwords($item_name),
            'price' => $price,
            'description' => $description,
            'icon_img' => $icon_img,
        );

        $up = $this->HotelAdminModel->edit_data('room_servs_mini_bar', $wh, $arr);

        if ($up) {
            $this->session->set_flashdata('msg', 'Data updated Successfully...');
            redirect(base_url('HoteladminController/RoomServiceList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/RoomServiceList'));
        }
    }

    public function add_room_service_minibar()
    {
        $item_name = $this->input->post('item_name');
        $price = $this->input->post('price');
        $description = $this->input->post('description');

        $admin_id = $this->session->userdata('u_id');

        $wh = '(item_name = "' . ucwords($item_name) . '" AND hotel_id = "' . $admin_id . '")';

        $room_servs_mini_bar = $this->HotelAdminModel->getData('room_servs_mini_bar', $wh);

        if ($room_servs_mini_bar) {
            $this->session->set_flashdata('msg', 'This Minibar already exits..');
            redirect(base_url('HoteladminController/RoomServiceList'));
        } else {
            $_FILES['my_file']['name'] = $_FILES['icon_img']['name'];
            $_FILES['my_file']['type'] = $_FILES['icon_img']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['icon_img']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['icon_img']['size'];
            $_FILES['my_file']['error'] = $_FILES['icon_img']['error'];

            $path = 'assets/upload/room_service_minibar_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $icon_img = base_url() . $path . $file_data['file_name'];

                $arr = array(
                    'hotel_id' => $admin_id,
                    'item_name' => ucwords($item_name),
                    'price' => $price,
                    'description' => $description,
                    'icon_img' => $icon_img,
                    'added_by' => 1,
                    'added_by_u_id' => $admin_id,
                );

                $add = $this->HotelAdminModel->insert_data('room_servs_mini_bar', $arr);

                if ($add) {
                    $this->session->set_flashdata('msg', 'Data Added Successfully...');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong');
                    redirect(base_url('HoteladminController/RoomServiceList'));
                }
            } else {
                $this->session->set_flashdata('msg', 'Error to upload image');
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

        $wh = '(r_s_services_id = "' . $r_s_services_id . '")';

        $room_servs_services = $this->HotelAdminModel->getData('room_servs_services', $wh);

        if (!empty($_FILES['icon_img']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['icon_img']['name'];
            $_FILES['my_file']['type'] = $_FILES['icon_img']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['icon_img']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['icon_img']['size'];
            $_FILES['my_file']['error'] = $_FILES['icon_img']['error'];

            $path = 'assets/upload/room_service_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $icon_img = base_url() . $path . $file_data['file_name'];
            }
        } else {
            $icon_img = $room_servs_services['icon_img'];
        }

        $arr = array(
            'service_name' => ucwords($service_name),
            'amount' => $amount,
            'icon_img' => $icon_img,
            'additional_note' => $additional_note
        );

        $up = $this->HotelAdminModel->edit_data('room_servs_services', $wh, $arr);

        if ($up) {
            $this->session->set_flashdata('msg', 'Data updated Successfully...');
            redirect(base_url('HoteladminController/RoomServiceList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/RoomServiceList'));
        }
    }

    public function delete_room_services()
    {
        $r_s_services_id = $this->input->post('id');

        $wh = '(r_s_services_id = "' . $r_s_services_id . '")';

        $del = $this->HotelAdminModel->delete_data('room_servs_services', $wh);

        if ($del) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function edit_food_facility()
    {
        $facility_name = $this->input->post('facility_name');
        $description = $this->input->post('description');
        $food_facility_id = $this->input->post('food_facility_id');
        $wh = '(food_facility_id = "' . $food_facility_id . '")';
        $food_facility = $this->HotelAdminModel->getData('food_facility', $wh);
        // print_r($this->input->post());die;
        if (!empty($_FILES['icon']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['icon']['name'];
            $_FILES['my_file']['type'] = $_FILES['icon']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['icon']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['icon']['size'];
            $_FILES['my_file']['error'] = $_FILES['icon']['error'];

            $path = 'assets/upload/food_facility_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();
                $icon = base_url() . $path . $file_data['file_name'];
            }
        } else {
            $icon = $food_facility['icon'];
        }
        $arr = array(
            'facility_name' => $facility_name,
            'description' => $description,
            'icon' => $icon,
        );
        $up = $this->HotelAdminModel->edit_data('food_facility', $wh, $arr);
        if ($up) {
            // $this->session->set_flashdata('msg','Data updated Successfully...');
            // redirect(base_url('HoteladminController/FoodBeberageList'));
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_facility_list_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxfoodfacilityedit', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/FoodBeberageList'));
        }
    }

    public function accept_reserve_order()
    {
        $reserve_table_id = $this->input->post('id');
        // $reserve_table_id = $this->uri->segment(3);

        $wh = '(reserve_table_id = "' . $reserve_table_id . '")';

        $arr = array(
            'request_status' => 1,
            'accept_date' => date('Y-m-d'),
        );

        $up = $this->HotelAdminModel->edit_data('reserve_table', $wh, $arr);
        // echo "<pre>";
        // print_r("chiragi".$up);
        // exit;
        if ($up) {
            $get_u_id = $this->MainModel->getData($tbl = 'reserve_table', $wh);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Reserve Table Request Is Accepted';
                $body = 'Your Reserve Table Request ID is "'.$reserve_table_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }


            echo $up;
        }
    }

    public function reject_reserve_order()
    {
        $reserve_table_id = $this->input->post('id');

        $wh = '(reserve_table_id = "' . $reserve_table_id . '")';

        $arr = array(
            'request_status' => 2,
            'reject_date' => date('Y-m-d'),
        );

        $up = $this->HotelAdminModel->edit_data('reserve_table', $wh, $arr);

        if ($up) {
            $get_u_id = $this->MainModel->getData($tbl = 'reserve_table', $wh);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Reserve Table Request Is Rejected';
                $body = 'Your Reserve Table Request ID is "'.$reserve_table_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }

            
            echo $up;
        }
    }

    public function edit_food_menus()
    {
        $food_facility_id = $this->input->post('facility1');
        $food_category_id = $this->input->post('food_category1');
        $menus_for = $this->input->post('menus_for');
        $items_name = $this->input->post('items_name');
        $price = $this->input->post('price');
        $offer_in_per = $this->input->post('offer_in_per');
        $prepartion_time = $this->input->post('prepartion_time');
        $time_in = $this->input->post('time_in');
        $description = $this->input->post('description');

        $food_item_id = $this->input->post('food_item_id');
        $admin_id = $this->session->userdata('u_id');


        $wh = '(food_item_id = "' . $food_item_id . '")';

        $food_menus = $this->HotelAdminModel->getData('food_menus', $wh);

        if (!empty($_FILES['item_img']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['item_img']['name'];
            $_FILES['my_file']['type'] = $_FILES['item_img']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['item_img']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['item_img']['size'];
            $_FILES['my_file']['error'] = $_FILES['item_img']['error'];

            $path = 'assets/upload/food_menu_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $item_img = base_url() . $path . $file_data['file_name'];
            }
        } else {
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

        $up = $this->HotelAdminModel->edit_data('food_menus', $wh, $arr);
        // print_r($up);die;
        if ($up) {
            $guest_mng["list"] = $this->HotelAdminModel->get_menu_list_pagination($admin_id);
            $guest_mng['facility_list'] = $this->HotelAdminModel->get_food_facility($admin_id);
            $this->load->view('hoteladmin/ajaxfoodmenu', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/FoodBeberageList'));
        }
    }

    public function add_food_menu()
    {
        // print_r($this->input->post());die;
        $food_facility_id = $this->input->post('facilities');
        $food_category_id = $this->input->post('categories');
        $menus_for = $this->input->post('menus_for');
        $items_name = $this->input->post('items_name');
        $price = $this->input->post('price');
        $offer_in_per = $this->input->post('offer_in_per');
        $prepartion_time = $this->input->post('prepartion_time');
        $time_in = $this->input->post('time_in');
        $description = $this->input->post('description');

        $admin_id = $this->session->userdata('u_id');

        $discount_price = $price * ($offer_in_per / 100);
        $dis_price = $price - $discount_price;

        $_FILES['my_file']['name'] = $_FILES['item_img']['name'];
        $_FILES['my_file']['type'] = $_FILES['item_img']['type'];
        $_FILES['my_file']['tmp_name'] = $_FILES['item_img']['tmp_name'];
        $_FILES['my_file']['size'] = $_FILES['item_img']['size'];
        $_FILES['my_file']['error'] = $_FILES['item_img']['error'];

        $path = 'assets/upload/food_menu_img/';
        $file_path = './' . $path;
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = TRUE;
        $config['upload_path'] = $file_path;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('my_file')) {
            $file_data = $this->upload->data();

            $item_img = base_url() . $path . $file_data['file_name'];

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

            $add = $this->HotelAdminModel->insert_data('food_menus', $arr);

            if ($add) {
                $guest_mng["list"] = $this->HotelAdminModel->get_menu_list_pagination($admin_id);
                $guest_mng['facility_list'] = $this->HotelAdminModel->get_food_facility($admin_id);
                $this->load->view('hoteladmin/ajaxfoodmenu', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
        } else {
            $this->session->set_flashdata('msg', 'Error to upload image');
            redirect(base_url('HoteladminController/FoodBeberageList'));
        }
    }

    //11-11-2022 // delete food menu//archana
    public function delete_food_menus()
    {
        $food_item_id = $this->input->post('id');

        $wh = '(food_item_id = "' . $food_item_id . '")';

        $del = $this->HotelAdminModel->delete_data('food_menus', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_menu_list_pagination($admin_id);
            $guest_mng['facility_list'] = $this->HotelAdminModel->get_food_facility($admin_id);
            $this->load->view('hoteladmin/ajaxfoodmenu', $guest_mng);
        } else {
            echo "0";
        }
    }

    public function add_food_category()
    {
        $food_facility_id = $this->input->post('food_facility_id');
        $category_name = $this->input->post('category_name');
        $admin_id = $this->session->userdata('u_id');
        $wh = '(food_facility_id = "' . $food_facility_id . '" AND category_name = "' . $category_name . '" AND hotel_id = "' . $admin_id . '")';
        $food_cat = $this->HotelAdminModel->getData('food_category', $wh);
        if ($food_cat) {
            $this->session->set_flashdata('msg', 'This Category already exits..');
            redirect(base_url('HoteladminController/FoodBeberageList'));
        } else {
            $arr = array(
                'hotel_id' => $admin_id,
                'food_facility_id' => $food_facility_id,
                'category_name' => $category_name,
                'added_by' => 1,
                'added_by_u_id' => $admin_id,
            );
            $add = $this->HotelAdminModel->insert_data('food_category', $arr);
            if ($add) {
                // $this->session->set_flashdata('msg','Data Added Successfully...');
                // redirect(base_url('HoteladminController/FoodBeberageList'));
                $guest_mng["facility_list"] = $this->HotelAdminModel->get_facility_category_list_pagination($admin_id);
                $this->load->view('hoteladmin/ajaxfoodcategories', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/FoodBeberageList'));
            }
        }
    }

    public function add_food_facility()
    {
        $facility_name = $this->input->post('facility_name');
        $description = $this->input->post('description');
        $admin_id = $this->session->userdata('u_id');
        $wh = '(facility_name = "' . $facility_name . '" AND hotel_id = "' . $admin_id . '")';
        $food_facility = $this->HotelAdminModel->getData('food_facility', $wh);
        $guest_mng["list"] = $this->HotelAdminModel->get_facility_list_pagination($admin_id);
        if ($food_facility) {
            echo 1;
        } else {
            if (!empty($_FILES) && isset($_FILES)) {
                $_FILES['my_file']['name'] = $_FILES['icon']['name'];
                $_FILES['my_file']['type'] = $_FILES['icon']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['icon']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['icon']['size'];
                $_FILES['my_file']['error'] = $_FILES['icon']['error'];
                $path = 'assets/upload/food_facility_img/';
                $file_path = './' . $path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('my_file')) {
                    $file_data = $this->upload->data();
                    $icon = base_url() . $path . $file_data['file_name'];
                    $arr = array(
                        'hotel_id' => $admin_id,
                        'facility_name' => $facility_name,
                        'description' => $description,
                        'icon' => $icon,
                        'added_by' => 1,
                        'added_by_u_id' => $admin_id,
                    );
                    $add = $this->HotelAdminModel->insert_data('food_facility', $arr);

                    if ($add) {


                        $this->load->view('hoteladmin/ajaxfoodfacilityedit', $guest_mng);
                    } else {
                        $this->load->view('hoteladmin/ajaxfoodfacilityedit', $guest_mng);
                    }
                } else {
                    $this->session->set_flashdata('msg', 'Error to upload image');
                    redirect(base_url('HoteladminController/FoodBeberageList'));
                }
            }
        }
    }

    public function delete_food_facility()
    {
        $food_facility_id = $this->input->post('id');

        $wh = '(food_facility_id = "' . $food_facility_id . '")';

        $del = $this->HotelAdminModel->delete_data('food_facility', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_facility_list_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxfoodfacilityedit', $guest_mng);
        } else {
            echo "0";
        }
    }

    public function edit_cloth()
    {
        $cloth_name = $this->input->post('cloth_name');
        $price = $this->input->post('price');
        $admin_id = $this->session->userdata('u_id');
        $cloth_id = $this->input->post('cloth_id');
        $wh = '(cloth_id = "' . $cloth_id . '")';
        $cloth = $this->HotelAdminModel->getData('cloth', $wh);
        if (!empty($_FILES['image']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];

            $path = 'assets/upload/cloth_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();
                $image = base_url() . $path . $file_data['file_name'];
            }
        } else {
            $image = $cloth['image'];
        }
        $arr = array(
            'cloth_name' => ucwords($cloth_name),
            'price' => $price,
            'image' => $image,
        );
        $up = $this->HotelAdminModel->edit_data('cloth', $wh, $arr);
        if ($up) {
            $guest_mng["list"] = $this->HotelAdminModel->get_cloth_list_pagination($admin_id);
            $guest_mng['laundry_time'] = $this->HotelAdminModel->get_laundry_time($admin_id);
            $this->load->view('hoteladmin/ajaxlaundaryserviceedit', $guest_mng);
            // $this->session->set_flashdata('msg','Data updated Successfully...');
            // redirect(base_url('HoteladminController/HouseKeepingList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/HouseKeepingList'));
        }
    }


    public function dirty_room_sts_update()
    {
        $admin_id = $this->session->userdata('u_id');

        //   $wh_admin = '(u_id ="'.$admin_id.'")';
        //   $get_hotel_id = $this->HotelAdminModel->getData('register',$wh_admin);
        //   $hotel_id = $get_hotel_id['hotel_id']; 
        $room_status_id = $this->input->post('room_status_id');
        $room_status = $this->input->post('room_status');
        // $date = date('Y-m-d');
        if ($room_status == 3) {
            $arr = array(
                'room_status' => $room_status,
                // 'created_at' => $date
            );

            $wh = '(room_status_id = "' . $room_status_id . '")';
            $update = $this->HotelAdminModel->editData($tbl = 'room_status', $wh, $arr);
            //    $wh1 = '(room_status = 1 AND hotel_id ="'.$hotel_id.'")';
            if ($update) {
                $wh1 = '(room_status = 1 AND hotel_id ="' . $admin_id . '")';
                $guest_mng['get_dirty_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh1);

                $wh2 = '(room_status = 2 AND hotel_id ="' . $admin_id . '")';
                $guest_mng['get_accupied_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh2);
                $guest_mng['get_available_rooms'] = $this->HotelAdminModel->get_daily_report_available_rooms($admin_id);
                $wh3 = '(room_status = 4 AND hotel_id ="' . $admin_id . '")';
                $guest_mng['get_under_maintenance_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh3);
                // $data['get_available_rooms'] = $this->HotelAdminModel->get_daily_report_available_rooms($date,$hotel_id);
                // print_r($guest_mng);
                // die;
                $this->load->view('hoteladmin/ajaxdirty_room', $guest_mng);
            } else {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url('RmStatus'));
            }
        } elseif ($room_status == 4) {
            $arr1 = array(
                'room_status' => $room_status,
            );

            $wh2 = '(room_status_id = "' . $room_status_id . '")';

            $update = $this->HotelAdminModel->editData($tbl = 'room_status', $wh2, $arr1);

            if ($update) {
                $wh4 = '(room_status = 1 AND hotel_id ="' . $admin_id . '")';
                $guest_mng['get_dirty_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh4);
                $wh5 = '(room_status = 2 AND hotel_id ="' . $admin_id . '")';
                $guest_mng['get_accupied_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh5);
                $guest_mng['get_available_rooms'] = $this->HotelAdminModel->get_daily_report_available_rooms($admin_id);
                $wh6 = '(room_status = 4 AND hotel_id ="' . $admin_id . '")';
                $guest_mng['get_under_maintenance_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh6);
                // print_r($guest_mng);
                // die;
                $this->load->view('hoteladmin/ajaxdirty_room', $guest_mng);
            } else {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url('RmStatus'));
            }
        }
    }



    public function under_maintainance_room_sts_update()
    {

        $admin_id = $this->session->userdata('u_id');

        // $wh_admin = '(u_id ="'.$admin_id.'")';
        // $get_hotel_id = $this->HotelAdminModel->getData('register',$wh_admin);

        // $hotel_id = $get_hotel_id['hotel_id']; 

        $room_status_id = $this->input->post('room_status_id');
        $room_status = $this->input->post('room_status');
        // $date = date('Y-m-d');
        if ($room_status) {
            $arr = array(
                'room_status' => $room_status,
                // 'created_at' => $date
            );

            $wh = '(room_status_id = "' . $room_status_id . '")';
            $update = $this->HotelAdminModel->edit_data($tbl = 'room_status', $wh, $arr);
            if ($update) {
                $wh1 = '(room_status = 1 AND hotel_id ="' . $admin_id . '")';
                $guest_mng['get_dirty_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh1);

                $wh2 = '(room_status = 2 AND hotel_id ="' . $admin_id . '")';
                $guest_mng['get_accupied_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh2);
                $guest_mng['get_available_rooms'] = $this->HotelAdminModel->get_daily_report_available_rooms($admin_id);
                $wh3 = '(room_status = 4 AND hotel_id ="' . $admin_id . '")';
                $guest_mng['get_under_maintenance_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh3);
                $this->load->view('hoteladmin/ajaxunder_maintance', $guest_mng);
            } else {
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
        $wh = '(service_type = "' . ucwords($service_type) . '" AND hotel_id = "' . $admin_id . '")';
        $house_keeping_services = $this->HotelAdminModel->getData('house_keeping_services', $wh);
        if ($house_keeping_services) {
            echo 1;
        } else {
            $_FILES['my_file']['name'] = $_FILES['icon']['name'];
            $_FILES['my_file']['type'] = $_FILES['icon']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['icon']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['icon']['size'];
            $_FILES['my_file']['error'] = $_FILES['icon']['error'];
            $path = 'assets/upload/housekeeping_service_icon/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();
                $icon = base_url() . $path . $file_data['file_name'];
                $arr = array(
                    'hotel_id' => $admin_id,
                    'service_type' => ucwords($service_type),
                    'amount' => $amount,
                    'icon' => $icon,
                    'is_active' => 1,
                    'added_by' => 1,
                    'added_by_u_id' => $admin_id,
                );
                $add = $this->HotelAdminModel->insert_data('house_keeping_services', $arr);
                if ($add) {
                    // $this->session->set_flashdata('msg','Data Added Successfully...');
                    // redirect(base_url('HoteladminController/HouseKeepingList'));
                    $guest_mng["list"] = $this->HotelAdminModel->get_housekeeping_services_list_pagination($admin_id);
                    $this->load->view('hoteladmin/ajaxhousekeepingserviceedit', $guest_mng);
                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong');
                    redirect(base_url('HoteladminController/HouseKeepingList'));
                }
            } else {
                $this->session->set_flashdata('msg', 'Error to upload image');
                redirect(base_url('HoteladminController/HouseKeepingList'));
            }
        }
    }


    public function edit_housekeeping_service()
    {
        $service_type = $this->input->post('service_type');
        $amount = $this->input->post('amount');
        $h_k_services_id = $this->input->post('h_k_services_id');
        $wh = '(h_k_services_id = "' . $h_k_services_id . '")';
        $house_keeping_services = $this->HotelAdminModel->getData('house_keeping_services', $wh);
        if (!empty($_FILES['icon']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['icon']['name'];
            $_FILES['my_file']['type'] = $_FILES['icon']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['icon']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['icon']['size'];
            $_FILES['my_file']['error'] = $_FILES['icon']['error'];

            $path = 'assets/upload/housekeeping_service_icon/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();
                $icon = base_url() . $path . $file_data['file_name'];
            }
        } else {
            $icon = $house_keeping_services['icon'];
        }
        $arr = array(
            'service_type' => ucwords($service_type),
            'amount' => $amount,
            'icon' => $icon,
        );
        $up = $this->HotelAdminModel->edit_data('house_keeping_services', $wh, $arr);
        if ($up) {
            // $this->session->set_flashdata('msg','Data updated Successfully...');
            // redirect(base_url('HoteladminController/HouseKeepingList'));
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_housekeeping_services_list_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxhousekeepingserviceedit', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/HouseKeepingList'));
        }
    }


    public function change_housekeeping_service_status()
    {
        $status = $this->input->post('status');
        $h_k_services_id = $this->input->post('id');
        // $a=$this->input->post();print_r($a);die;
        $wh = '(h_k_services_id = "' . $h_k_services_id . '")';
        $arr = array(
            'is_active' => $status
        );

        $update = $this->HotelAdminModel->edit_data('house_keeping_services', $wh, $arr);
        if ($update) {
            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }
    public function add_cloth()
    {
        $cloth_name = $this->input->post('cloth_name');
        $price = $this->input->post('price');
        $admin_id = $this->session->userdata('u_id');
        $wh = '(cloth_name = "' . ucwords($cloth_name) . '" AND hotel_id = "' . $admin_id . '")';
        $cloth = $this->HotelAdminModel->getData('cloth', $wh);
        if ($cloth) {
           echo 1;
        } else {
            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];
            $path = 'assets/upload/cloth_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();
                $image = base_url() . $path . $file_data['file_name'];
                $arr = array(
                    'hotel_id' => $admin_id,
                    'cloth_name' => ucwords($cloth_name),
                    'price' => $price,
                    'image' => $image,
                    'added_by' => 1,
                    'added_by_u_d' => $admin_id,
                );
                $add = $this->HotelAdminModel->insert_data('cloth', $arr);
                if ($add) {
                    // $this->session->set_flashdata('msg','Data Added Successfully...');
                    // redirect(base_url('HoteladminController/HouseKeepingList'));
                    $guest_mng["list"] = $this->HotelAdminModel->get_cloth_list_pagination($admin_id);

                    $this->load->view('hoteladmin/ajaxlaundaryserviceedit', $guest_mng);
                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong');
                    redirect(base_url('HoteladminController/HouseKeepingList'));
                }
            } else {
                $this->session->set_flashdata('msg', 'Error to upload image');
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
        $wh = '(hotel_id = "' . $admin_id . '")';
        $laundry_time = $this->HotelAdminModel->getData('laundry_time', $wh);

        $add = "";
        $up = "";
        // print_r($laundry_time);die;
        if ($laundry_time) {
            $arr_up = array(
                'pick_up_start_time' => $pick_up_start_time,
                'drop_start_time' => $drop_start_time,
                'pick_up_end_time' => $pick_up_end_time,
                'drop_end_time' => $drop_end_time,
                'updated_by' => 1,
                'updated_by_u_id' => $admin_id,
            );

            $add = $this->HotelAdminModel->edit_data('laundry_time', $wh, $arr_up);
        } else {
            $arr_add = array(
                'hotel_id' => $admin_id,
                'pick_up_start_time' => $pick_up_start_time,
                'drop_start_time' => $drop_start_time,
                'pick_up_end_time' => $pick_up_end_time,
                'drop_end_time' => $drop_end_time,
                'added_by' => 1,
                'added_by_u_id' => $admin_id,
            );

            $up = $this->HotelAdminModel->insert_data('laundry_time', $arr_add);
        }

        if ($add || $up) {
            // $this->session->set_flashdata('msg','Laundry time set Successfully...');
            // redirect(base_url('HoteladminController/HouseKeepingList'));
            // $guest_mng['icon_id'] =1;
            // $guest_mng["list"] = $this->HotelAdminModel->get_cloth_list_pagination($admin_id);
            $guest_mng['laundry_time'] = $this->HotelAdminModel->get_laundry_time($admin_id);

            echo json_encode($guest_mng);
            // $this->load->view('hoteladmin/ajaxlaundrytimeedit',$guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/HouseKeepingList'));
        }
    }
    public function ajaxfoodfacilityforpagination()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 1;
        $guest_mng["list"] = $this->HotelAdminModel->get_facility_list_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxFoodBeverageIcon', $guest_mng);
    }
    public function ajaxfoodcategoryforpagination()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 2;
        $guest_mng["facility_list"] = $this->HotelAdminModel->get_facility_category_list_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxFoodBeverageIcon', $guest_mng);
    }
    public function getEditDataoftiming()
    {


        $where = $this->input->post('id');
        // print_r($where);die;
        $wh = '(laundry_time_id ="' . $where . '")';
        $data = $this->MainModel->getSingleData($tbl = 'laundry_time', $wh);
        // print_r($data);exit;
        echo json_encode($data);
    }
    public function getEditDataoffoodfacility()
    {


        $where = $this->input->post('id');
        // print_r($where);die;
        $wh = '(food_facility_id ="' . $where . '")';
        $data = $this->MainModel->getSingleData($tbl = 'food_facility', $wh);
        // print_r($data);exit;
        echo json_encode($data);
    }


    public function delete_cloth()
    {
        $admin_id = $this->session->userdata('u_id');
        $cloth_id = $this->input->post('id');
        $wh = '(cloth_id = "' . $cloth_id . '")';
        $del = $this->HotelAdminModel->delete_data('cloth', $wh);

        if ($del) {
            $guest_mng["list"] = $this->HotelAdminModel->get_cloth_list_pagination($admin_id);

            $this->load->view('hoteladmin/ajaxlaundaryserviceedit', $guest_mng);
        } else {
            echo "0";
        }
    }

    public function update_rooms()
    {
        //    print_r($this->input->post());die;
        $floor_id = $this->input->post('floor_id');
        $room_type = $this->input->post('room_type');
        $price = $this->input->post('price');
        $room_details = $this->input->post('room_details');
        $room_img_id = $this->input->post('room_img_id', TRUE);
        $room_configure_id = $this->input->post('room_configure_id');

        $admin_id = $this->session->userdata('u_id');

        $wh = '(room_configure_id = "' . $room_configure_id . '")';
        $old_room_no = $this->HotelAdminModel->getAllData('room_nos', $wh);

        $room_data = $_POST['room_no'];
        $room_arr = explode(",", $room_data);
        if (!empty($_POST['room_no'])) {

            $del = $this->HotelAdminModel->delete_data('room_nos', $wh);

            if ($room_arr) {
                $room_no_data = array();

                foreach ($room_arr as $key => $value) {
                    $wh1 = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $value . '")';
                    $room_no_data = $this->HotelAdminModel->getData('room_nos', $wh1);

                    if ($room_no_data) {
                        foreach ($old_room_no as $o_r_n) {
                            $arr_old_room = array(
                                'hotel_id' => $admin_id,
                                'room_configure_id' => $room_configure_id,
                                'room_no' => $o_r_n['room_no'],
                                'added_by' => 1,
                                'added_by_id' => $admin_id,
                            );
                            $add__old_room_no = $this->HotelAdminModel->insert_data('room_nos', $arr_old_room);
                        }
                        $this->session->set_flashdata('msg', '"' . $value . '"Room no Already exits..');
                        redirect(base_url('HoteladminController/frontOfficeList'));
                    }
                    else
					{
						$delete_room = array();
						foreach ($old_room_no as $o_r_n) 
						{
							$room_data = $_POST['room_no'];
                            $room_arr = explode(",", $room_data);
							
								if(!in_array($o_r_n['room_no'], $room_arr))
								{
									$delete_room[] = $o_r_n['room_no'];
								}
                        }
						if($delete_room)
						{
							foreach ($delete_room as $d_r) 
							{
								$wh5 = 'hotel_id = "' . $admin_id . '" AND room_no = "' . $d_r . '" AND room_status = 2';
								$check_occupied = $this->HotelAdminModel->getData('room_status', $wh5);

								if($check_occupied)
								{
									foreach ($old_room_no as $o_r_n) {
										$arr_old_room = array(
											'hotel_id' => $admin_id,
											'room_configure_id' => $room_configure_id,
											'room_no' => $o_r_n['room_no'],
											'added_by' => 1,
											'added_by_id' => $admin_id,
										);
										$add__old_room_no = $this->HotelAdminModel->insert_data('room_nos', $arr_old_room);
									}
									$this->session->set_flashdata('msg', '"' . $d_r . '"Room is Booked, plese try after some time');
                                    redirect(base_url('HoteladminController/frontOfficeList'));
								}
								else
								{
									$wh6 = 'hotel_id = "' . $admin_id . '" AND room_no = "' . $d_r. '"';
									$delete = $this->HotelAdminModel->delete_data('room_status', $wh6);
								}
							}
						}
					}
                }
            }
            if (empty($room_no_data)) {

                $arr = array(
                    // 'floor_id' => $floor_id,
                    // 'room_type' => $room_type,
                    'room_details' => $room_details,
                    // 'price' => $price,
                );

                $up = $this->HotelAdminModel->edit_data('room_configure', $wh, $arr);

                if ($up) {
                    //edit rooms no
                    if (isset($_POST['room_no'])) {
                        $del = $this->HotelAdminModel->delete_data('room_nos', $wh);

                        if ($del) {
                            $room_data = $_POST['room_no'];

                            $room_arr = explode(",", $room_data);

                            foreach ($room_arr as $key => $value) {
                                $arr_rm = array(
                                    'hotel_id' => $admin_id,
                                    'room_configure_id' => $room_configure_id,
                                    'room_no' => $value,
                                    'added_by' => 1,
                                    'added_by_id' => $admin_id,
                                );


                                $add_room_no = $this->HotelAdminModel->insert_data('room_nos', $arr_rm);

                                $wh2 = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $value . '")';
								$room_status = $this->HotelAdminModel->getData('room_status', $wh2);

                                if($room_status == null)
								{
									// echo "hi";die;
									if ($add_room_no) 
									{
										$arr_rm = array(
											'hotel_id' => $admin_id,
											'room_no' => $value,
											'room_status' => 3,
											'added_by' => 1,
											'added_by_u_id' => $admin_id,
										);
										
										$this->HotelAdminModel->insert_data('room_status', $arr_rm);
									}
								}
								elseif($room_status != NULL)
								{
									// echo "heloo";die;
									$room_status_id = $room_status['room_status'];
									if ($room_status_id != NULL) 
									{
										$arr_rm = array(
											'hotel_id' => $admin_id,
											'room_no' =>$room_status['room_no'],
											'room_status' => $room_status_id,
											'added_by' => 1,
											'added_by_u_id' => $admin_id,
										);
										// print_r($arr_rm);exit;
										$this->HotelAdminModel->edit_data('room_status',$wh2 ,$arr_rm);

									}
								}
                            }
                        }
                    }

                    //edit facility
                    if (isset($_POST['facility'])) {
                        $del1 = $this->HotelAdminModel->delete_data('room_facility', $wh);

                        if ($del1) {
                            $room_fc_data = $_POST['facility'];

                            $room_fc_arr = explode(",", $room_fc_data);

                            foreach ($room_fc_arr as $key => $value1) {
                                $arr_fc = array(
                                    'hotel_id' => $admin_id,
                                    'room_configure_id' => $room_configure_id,
                                    'room_facility' => $value1,
                                    'added_by' => 1,
                                    'added_by_u_id' => $admin_id,
                                );

                                $this->HotelAdminModel->insert_data('room_facility', $arr_fc);
                            }
                        }
                    }

                    //edit multiple images
                    // if(isset($_FILES['image']['name']))
                    // {
                    //     $count1 = count($_FILES['image']['name'],TRUE);

                    //     for($k = 0;$k < $count1; $k++)
                    //     {
                    //         $wh_rm_i = '(room_img_id = "'.$room_img_id[$k].'")';

                    //         $room_img = $this->HotelAdminModel->getData('room_imgs',$wh_rm_i);

                    //         if(!empty($_FILES['image']['name'][$k]))
                    //         {
                    //             $_FILES['my_file']['name'] = $_FILES['image']['name'][$k];
                    //             $_FILES['my_file']['type'] = $_FILES['image']['type'][$k];
                    //             $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'][$k];
                    //             $_FILES['my_file']['size'] = $_FILES['image']['size'][$k];
                    //             $_FILES['my_file']['error'] = $_FILES['image']['error'][$k];

                    //             $path = 'assets/upload/room_img/';
                    //             $file_path = './'.$path;
                    //             $config['allowed_types'] = '*';
                    //             $config['encrypt_name'] = TRUE;
                    //             $config['upload_path'] = $file_path;
                    //             $this->load->library('upload',$config);
                    //             $this->upload->initialize($config);

                    //             if($this->upload->do_upload('my_file'))
                    //             { 
                    //                 $file_data = $this->upload->data();

                    //                 $images = base_url().$path.$file_data['file_name'];
                    //             } 
                    //         }
                    //         else
                    //         {
                    //             $images = $room_img['images'];
                    //         }

                    //         $arr_rm_i = array(
                    //                             'images' => $images
                    //                         );

                    //         $this->HotelAdminModel->edit_data('room_imgs',$wh_rm_i,$arr_rm_i);
                    //     }
                    // }

                    $this->session->set_flashdata('msg', 'Data Updated successfully..');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            }
        } else {
            $this->session->set_flashdata('msg', 'Please Enter A Room No');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }
    public function delete_room_data()
    {
        $room_configure_id = $this->input->post('id');
        $admin_id = $this->session->userdata('u_id');

        $wh = '(room_configure_id = "'.$room_configure_id.'")';
		$old_room_no = $this->HotelAdminModel->getAllData('room_nos', $wh);
		$deleted_rooms = [];
		$occupied_rooms = [];
		foreach ($old_room_no as $o_rn) {
			$room_data = $o_rn['room_no'];
			$wh1 = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $room_data . '" AND room_status != 2)';
			$room_status = $this->HotelAdminModel->getData('room_status', $wh1);

			if (!empty($room_status)) {
				// Room is unoccupied, mark it for deletion
				$deleted_rooms[] = $room_data;
			} else {
				// Room is occupied, mark it as such
				$occupied_rooms[] = $room_data;
			}
		}
        // Initialize $del to false before the if-else block
		$del = false;
		// Check if all rooms are unoccupied
		if (count($deleted_rooms) === count($old_room_no)) {
			// All rooms are unoccupied, proceed with deletion
			$del = $this->HotelAdminModel->delete_data('room_configure', $wh);
			$del = $this->HotelAdminModel->delete_data('room_facility', $wh);
			$del = $this->HotelAdminModel->delete_data('room_imgs', $wh);
		}

		// Delete unoccupied room numbers in room_status and room_nos tables
		foreach ($deleted_rooms as $room_data) {
			$wh1 = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $room_data . '")';
			$del = $this->HotelAdminModel->delete_data('room_status', $wh1);
			$del = $this->HotelAdminModel->delete_data('room_nos', $wh1);
		}

		$deleted_message = implode(', ', $deleted_rooms);
		$occupied_message = implode(', ', $occupied_rooms);

        if ($del) {
			if (count($deleted_rooms) === count($old_room_no)) {
				$message = "Data Delete Successfully. Deleted room(s): $deleted_message";
			}
			
			else{
				$message = "Data Delete Successfully. Deleted room(s): $deleted_message. Occupied room(s): $occupied_message";
			}
			$this->session->set_flashdata('msg',$message);
		} 
		else {
			if(empty($deleted_rooms) )
			{
				$message = "All Rooms Are Occupied Please Try After Sometimes";
				$this->session->set_flashdata('msg',$message);
			}
			else{
				$message = "Something went wrong";
				$this->session->set_flashdata('msg',$message);
			}
		}
    }
    public function ajaxSubIconBlockViewReservation()
    {

        $postArr = $this->input->post();
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
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
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $admin_id = $get_hotel_id['u_id'];
        $today_date = date('Y-m-d');

        $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id,$today_date);
        $guest_mng["list1"] = $this->HotelAdminModel->get_hotel_enquiry_accepted_request_pagination($admin_id);
        $guest_mng["list2"] = $this->HotelAdminModel->get_hotel_enquiry_rejected_request_pagination($admin_id);


        $this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
    }
    public function delete_floor()
    {
        $floor_id = $this->input->post('id');

        $wh = '(floor_id = "' . $floor_id . '")';

        $del = $this->HotelAdminModel->delete_data('floors', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_floor_list_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxFloorList', $guest_mng);
        } else {
            echo "0";
        }
    }
    public function edit_floor()
    {
        // echo 'hi';die;
        $admin_id = $this->session->userdata('u_id');

        $floor_id = $this->input->post('floor_id');

        $floor = $this->input->post('floor');

        $wh = '(floor_id = "' . $floor_id . '")';

        $wh1 = '(hotel_id = "' . $admin_id . '" AND floor = "' . $floor . '")';

        $floor_data = $this->HotelAdminModel->getData('floors', $wh1);

        if ($floor_data) {
            echo 1;
        } else {
            $arr =  array(
                'floor' => $floor,
            );

            $add = $this->HotelAdminModel->edit_data('floors', $wh, $arr);
            $guest_mng["list"] = $this->HotelAdminModel->get_floor_list_pagination($admin_id);
            if ($add) {
                // $this->session->set_flashdata('msg','Floor updated Successfully..'); 
                $this->load->view('hoteladmin/ajaxFloorList', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
    }
    public function getFloorData()
    {
        $wh = $this->input->post('id');
        // print_r($wh);die;
        //    print_r($this->input->post(''));
        $data = $this->HotelAdminModel->getfloordata($tbl = 'floors', $wh);
        echo json_encode($data);
    }
    public function add_shuttle_service_staff_avaibility()
    {
        // echo 'hi';die;
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
        // print_r($arr);die;
        $add = $this->HotelAdminModel->insert_data('shuttle_service_avaibility', $arr);

        if ($add) {

           

            $day1 = "Sunday";
            $day2 = "Monday";
            $day3 = "Tuesday";
            $day4 = "Wednesday";
            $day5 = "Thursday";
            $day6 = "Friday";
            $day7 = "Saturday";
            $service_name = 4;
            $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);

            $guest_mng['sun_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day1);

            $guest_mng['mon_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day2);

            $guest_mng['tue_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day3);

            $guest_mng['wed_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day4);

            $guest_mng['thurs_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day5);

            $guest_mng['fri_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day6);

            $guest_mng['sat_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day7);
            $guest_mng['sub_icon_id'] = 4;
            // print_r($day);exit;
            $this->load->view('hoteladmin/ajaxSubIconBlockView', array(
				'list' => $guest_mng["list"],
				'sun_list' => $guest_mng['sun_list'],
				'mon_list' => $guest_mng['mon_list'],
				'tue_list' => $guest_mng['tue_list'],
				'wed_list'=> $guest_mng['wed_list'],
				'thurs_list' => $guest_mng['thurs_list'],
				'fri_list'=> $guest_mng['fri_list'],
				'sat_list'=> $guest_mng['sat_list'],
				'day' => $day,
				'sub_icon_id' => 4
			));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }
    public function shuttle_availabilty()
    {
        
        $admin_id = $this->session->userdata('u_id');
    //    print_r($admin_id);die;
        $day1 = "Sunday";
        $day2 = "Monday";
        $day3 = "Tuesday";
        $day4 = "Wednesday";
        $day5 = "Thursday";
        $day6 = "Friday";
        $day7 = "Saturday";
        $service_name = 4;
        // $guest_mng['shuttle_id'] = $room_type;
        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);

        $guest_mng['sun_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day1);

        $guest_mng['mon_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day2);

        $guest_mng['tue_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day3);

        $guest_mng['wed_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day4);

        $guest_mng['thurs_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day5);

        $guest_mng['fri_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day6);

        $guest_mng['sat_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day7);
        $guest_mng['sub_icon_id'] = 4;


            $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
        
    }


    public function change_available_status()
    {
        $available_status = $this->input->post('status');
        $shuttle_service_avaibility_id = $this->input->post('id');

        $wh = '(shuttle_service_avaibility_id = "' . $shuttle_service_avaibility_id . '")';
        $day_data = $this->MainModel->getData($tbl ='shuttle_service_avaibility', $wh);
		$day = $day_data['day'];
        $arr = array(
            'available_status' => $available_status
        );

        $update = $this->HotelAdminModel->edit_data('shuttle_service_avaibility', $wh, $arr);

        if ($update) {
            $admin_id = $this->session->userdata('u_id');
        

            $day1 = "Sunday";
            $day2 = "Monday";
            $day3 = "Tuesday";
            $day4 = "Wednesday";
            $day5 = "Thursday";
            $day6 = "Friday";
            $day7 = "Saturday";
            $service_name = 4;
            $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);

            $guest_mng['sun_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day1);

            $guest_mng['mon_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day2);

            $guest_mng['tue_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day3);

            $guest_mng['wed_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day4);

            $guest_mng['thurs_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day5);

            $guest_mng['fri_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day6);

            $guest_mng['sat_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day7);
            $guest_mng['sub_icon_id'] = 4;
            // print_r($day);exit;
            $this->load->view('hoteladmin/ajaxSubIconBlockView', array(
				'list' => $guest_mng["list"],
				'sun_list' => $guest_mng['sun_list'],
				'mon_list' => $guest_mng['mon_list'],
				'tue_list' => $guest_mng['tue_list'],
				'wed_list'=> $guest_mng['wed_list'],
				'thurs_list' => $guest_mng['thurs_list'],
				'fri_list'=> $guest_mng['fri_list'],
				'sat_list'=> $guest_mng['sat_list'],
				'day' => $day,
				'sub_icon_id' => 4
			));
        } else {
            redirect(base_url('HoteladminController/frontOfficeList'));
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
        $additional_note = $this->input->post('additional_note');
        $admin_id = $this->session->userdata('u_id');

        $wh = '(hotel_id = "' . $admin_id . '" AND business_center_type = "' . $business_center_type . '" AND event_date = "' . $event_date . '" AND start_time >= "' . $start_time . '"AND end_time <= "' . $end_time . '")';

        $business_center_reser_data = $this->HotelAdminModel->getData('business_center_reservation', $wh);

        if ($business_center_reser_data) {
            $this->session->set_flashdata('msg', 'Already Reserve this center of selected date');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {

            if (!empty($_FILES)) {
                $_FILES['my_file']['name'] = $_FILES['id_proof_photo']['name'];
                $_FILES['my_file']['type'] = $_FILES['id_proof_photo']['type'];
                $_FILES['my_file']['tmp_name'] = $_FILES['id_proof_photo']['tmp_name'];
                $_FILES['my_file']['size'] = $_FILES['id_proof_photo']['size'];
                $_FILES['my_file']['error'] = $_FILES['id_proof_photo']['error'];

                $path = 'assets/upload/business_center_reservation_id_proff_pics/';
                $file_path = './' . $path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('my_file')) {
                    $file_data = $this->upload->data();

                    $id_proof_photo = base_url() . $path . $file_data['file_name'];
                } else {

                    $this->session->set_flashdata('msg', 'Image Error to upload');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
            } else {

                $this->session->set_flashdata('msg', 'Image Error to upload');
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
                'additional_note'=>$additional_note,
                'added_by' => 1,
                'added_by_u_id' => $admin_id,
            );

            $add = $this->HotelAdminModel->insert_data('business_center_reservation', $arr);

            if ($add) {
                $guest_mng["list"] = $this->HotelAdminModel->get_business_center_reservation_list_app($admin_id);
                $guest_mng['list1'] = $this->HotelAdminModel->get_business_center_list_pagination($admin_id);
                $guest_mng["list2"] = $this->HotelAdminModel->get_business_center_list_reject_pagination($admin_id);
                $guest_mng['business_center'] = $this->HotelAdminModel->get_active_business_center($admin_id);

                $this->load->view('hoteladmin/ajaxBusinessNewRequest', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Image Error to upload');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
    }
    public function getchangecabData()
    {
        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getdatacab($tbl = 'cab_service_request_list', $wh);
        // echo "<pre>";print_r($data);die;
        echo json_encode($data);
    }
    public function change_cab_service_request()
    {
        $cab_service_request_id = $this->input->post('cab_service_request_id');
        $request_status = $this->input->post('request_status');
        $rand_no = rand('1111', '9999');
        $admin_id = $this->session->userdata('u_id');
        $wh = '(cab_service_request_id = "' . $cab_service_request_id . '")';
        $user_id = $this->input->post('u_id');
        $wh5 = '(u_id ="'.$admin_id.'")';
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh5);
        $hotel_name = $get_hotel_name['hotel_name'];
        // red =1, green=2
        if ($request_status == "red") {
            $request_status1 = 1;
            $driver_name = $this->input->post('driver_name');
            $driver_contact_no = $this->input->post('driver_contact_no');
            $assign_vehicle_type = $this->input->post('assign_vehicle_type');
            $vehicle_no = $this->input->post('vehicle_no');
            $accepted_date = date('Y-m-d');
            $reject_date = "";
            $otp = $rand_no;

            $arr = array(
                'request_status' => $request_status1,
                'driver_name' => $driver_name,
                'driver_contact_no' => $driver_contact_no,
                'assign_vehicle_type' => $assign_vehicle_type,
                'accepted_date' => $accepted_date,
                'reject_date' => $reject_date,
                'vehicle_no' => $vehicle_no,
                'otp' => $otp,
            );

            $up = $this->HotelAdminModel->edit_data('cab_service_request_list', $wh, $arr);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'cab_service_request_list', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title = '';
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Cab Service Request Is Accepted';
                    $body = 'Your Cab Request ID is "'.$cab_service_request_id.'" ';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                $subject = $title;
                $description = "$title In $hotel_name And Your Cab Request Id Is $cab_service_request_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $user_id,
                                     'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
        //  print_r($arr_noti);die;
                 $this->MainModel->insert_data('user_notification',$arr_noti);
                
                $guest_mng["list"] = $this->HotelAdminModel->get_cab_service_pagination($admin_id);
                $this->load->view('hoteladmin/ajaxchangecab', $guest_mng);
            }
        } else {
            $request_status1 = 2;
            $driver_name = "";
            $driver_contact_no = "";
            $assign_vehicle_type = "";
            $vehicle_no = "";
            $accepted_date = "";
            $reject_date = date('Y-m-d');
            $otp = "";
            $reject_reason = $this->input->post('reject_reason');

            $arr = array(
                'request_status' => $request_status1,
                'driver_name' => $driver_name,
                'driver_contact_no' => $driver_contact_no,
                'assign_vehicle_type' => $assign_vehicle_type,
                'accepted_date' => $accepted_date,
                'reject_date' => $reject_date,
                'reject_reason' => $reject_reason,
                'vehicle_no' => $vehicle_no,
                'otp' => $otp,
            );

            $up = $this->HotelAdminModel->edit_data('cab_service_request_list', $wh, $arr);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'cab_service_request_list', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $reason ='';
                $title = "";

                if($reject_reason == 1)
                {
                    $reason = "Please Try After Sometime";
                }
                else if($reject_reason == 2)
                {
                    $reason = "Temporarily Unavailable";
                }
                else if($reject_reason == 3)
                {
                    $reason = "Slots Not Available";
                }
                else if($reject_reason == 4)
                {
                    $reason = "Please Contact Front Office";
                }
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Cab Service Request Is Rejected';
                    $body = 'Your Cab Request ID is "'.$cab_service_request_id.'" And Your Request is Rejected Because OF "'.$reason.'" ';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                $subject = $title;
                $description = "$title In $hotel_name Because Of $reason And Your Cab Request Id Is $cab_service_request_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $user_id,
                                     'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
        //  print_r($arr_noti);die;
                 $this->MainModel->insert_data('user_notification',$arr_noti);
                // $admin_id = $get_hotel_id['u_id']; 
                $guest_mng["list"] = $this->HotelAdminModel->get_cab_service_pagination($admin_id);
                $this->load->view('hoteladmin/ajaxchangecab', $guest_mng);
            }
        }
    }


    public function edit_front_ofs_services()
    {
        // echo "hello";die;
        // print_r($this->input->post());die;
        $service_name = $this->input->post('service_name');
        $staff_name = $this->input->post('staff_name');
        $contact_no = $this->input->post('contact_no');
        $open_time = $this->input->post('open_time');
        $close_time = $this->input->post('close_time');
        $break_start_time = $this->input->post('break_start_time');
        $break_close_time = $this->input->post('break_close_time');
        $description = $this->input->post('description');
        $t_nd_c = $this->input->post('t_nd_c');
        $u_id = $this->session->userdata('u_id');


        $front_ofs_service_id = $this->input->post('front_ofs_service_id');

        $front_ofs_service_image_id = $this->input->post('front_ofs_service_image_id', TRUE);

        $front_ofs_spa_service_images_id = $this->input->post('front_ofs_spa_service_images_id', TRUE);

        $wh = '(front_ofs_service_id = "' . $front_ofs_service_id . '") ';

        $spa_type = $this->input->post('spa_type');
        $spa_price = $this->input->post('spa_price');
        $spa_description = $this->input->post('spa_description');
        $spa_type12 = $this->input->post('spa_type12');
        $spa_price12 = $this->input->post('spa_price12');
        $spa_description12 = $this->input->post('spa_description12');

        // echo "<pre>";
        // print_r($spa_type12);
        // die;

        $shuttle_service_image_id = $this->input->post('front_ofs_service_img_id');


        // echo "<pre>";
        // print_r($shuttle_service_image_id);
        // exit;

        $arr = array(
            'service_name' => $service_name,
            'staff_name' => $staff_name,
            'contact_no' => $contact_no,
            'open_time' => $open_time,
            'close_time' => $close_time,
            'break_start_time' => $break_start_time,
            'break_close_time' => $break_close_time,
            'description' => $description,
            't_nd_c' => $t_nd_c


        );

        $up = $this->HotelAdminModel->edit_data('front_ofs_services', $wh, $arr);
        //               echo "<pre>";
        // print_r($up);
        // exit;

        if ($up) {

            // edit multiple images
            if (isset($_FILES['image']['name'])) {
                $count = count($_FILES['image']['name'], TRUE);
                // echo "<pre>";
                // print_r($_FILES['image']['name']);
                // die; 
                for ($i = 0; $i < $count; $i++) {
                    // $i = 0;

                    if (!empty($_FILES['image']['name'][$i])) {
                        $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                        $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                        $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                        $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                        $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];

                        $path = 'logo/';
                        $file_path = './' . $path;
                        $config['allowed_types'] = '*';
                        $config['encrypt_name'] = TRUE;
                        $config['upload_path'] = $file_path;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('my_uploaded_file')) {
                            $file_data = $this->upload->data();

                            $image = base_url() . $path . $file_data['file_name'];

                            $wh1 = '(front_ofs_service_image_id = "' . $shuttle_service_image_id . '")';

                            $arr1 = array(
                                'image' => $image,
                            );

                            $this->HotelAdminModel->edit_data('front_ofs_services_images', $wh1, $arr1);
                        }
                    }
                }
            }

            //edit only single image of shuttle service
            if ($service_name == 4) {


                $where1 = '(front_ofs_service_image_id ="' . $shuttle_service_image_id . '")';
                $result = $this->HotelAdminModel->check_image($tbl = 'front_ofs_services_images', $where1);

                $old_img = $result[0]['image'];
                $update_image = date("Y_m_d_H_m_s") . '-' . $_FILES['shuttle_img']['name'];
                $file = "";
                if (!empty($_FILES['shuttle_img']['name'])) {

                    $uploadPath =  realpath(FCPATH . 'assets/upload/fronf_ofs_services_images/');
                    // /var/www/html/hotel_management_new/assets/upload/fronf_ofs_services_images
                    //$config['overwrite'] = TRUE;
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = $update_image;

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if ($this->upload->do_upload('shuttle_img')) {
                        $update_filename = $this->upload->data();
                        $postArr['shuttle_img'] = $update_filename['file_name'];
                        $file_path_url = base_url() . 'assets/upload/fronf_ofs_services_images/' . $update_filename['file_name'];
                        $file = $file_path_url;
                    }
                } else {
                    $file = $old_img;
                }



                $wh_sh = '(front_ofs_service_image_id = "' . $shuttle_service_image_id . '")';
                $arr_sh = array('image' => $file);

                $this->HotelAdminModel->edit_data('front_ofs_services_images', $wh_sh, $arr_sh);
            }
            if ($service_name == 1) {


                $where1 = '(front_ofs_service_image_id ="' . $shuttle_service_image_id . '")';
                $result = $this->HotelAdminModel->check_image($tbl = 'front_ofs_services_images', $where1);

                $old_img = $result[0]['image'];
                $update_image = date("Y_m_d_H_m_s") . '-' . $_FILES['gym_img']['name'];
                $file = "";
                if (!empty($_FILES['gym_img']['name'])) {

                    $uploadPath =  realpath(FCPATH . 'assets/upload/fronf_ofs_services_images/');
                    // /var/www/html/hotel_management_new/assets/upload/fronf_ofs_services_images
                    //$config['overwrite'] = TRUE;
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = $update_image;

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if ($this->upload->do_upload('gym_img')) {
                        $update_filename = $this->upload->data();
                        $postArr['gym_img'] = $update_filename['file_name'];
                        $file_path_url = base_url() . 'assets/upload/fronf_ofs_services_images/' . $update_filename['file_name'];
                        $file = $file_path_url;
                    }
                } else {
                    $file = $old_img;
                }



                $wh_sh = '(front_ofs_service_image_id = "' . $shuttle_service_image_id . '")';
                $arr_sh = array('image' => $file);

                $this->HotelAdminModel->edit_data('front_ofs_services_images', $wh_sh, $arr_sh);
            }
            if ($service_name == 3) {


                $where1 = '(front_ofs_service_image_id ="' . $shuttle_service_image_id . '")';
                $result = $this->HotelAdminModel->check_image($tbl = 'front_ofs_services_images', $where1);

                $old_img = $result[0]['image'];
                $update_image = date("Y_m_d_H_m_s") . '-' . $_FILES['pool_img']['name'];
                $file = "";
                if (!empty($_FILES['pool_img']['name'])) {

                    $uploadPath =  realpath(FCPATH . 'assets/upload/fronf_ofs_services_images/');
                    // /var/www/html/hotel_management_new/assets/upload/fronf_ofs_services_images
                    //$config['overwrite'] = TRUE;
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = $update_image;

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if ($this->upload->do_upload('pool_img')) {
                        $update_filename = $this->upload->data();
                        $postArr['pool_img'] = $update_filename['file_name'];
                        $file_path_url = base_url() . 'assets/upload/fronf_ofs_services_images/' . $update_filename['file_name'];
                        $file = $file_path_url;
                    }
                } else {
                    $file = $old_img;
                }



                $wh_sh = '(front_ofs_service_image_id = "' . $shuttle_service_image_id . '")';
                $arr_sh = array('image' => $file);

                $this->HotelAdminModel->edit_data('front_ofs_services_images', $wh_sh, $arr_sh);
            }
            if ($service_name == 5) {


                $where1 = '(front_ofs_service_image_id ="' . $shuttle_service_image_id . '")';

                $result = $this->HotelAdminModel->check_image($tbl = 'front_ofs_services_images', $where1);
                // echo "<pre>";
                // print_r($result);die;
                $old_img = $result[0]['image'];
                $update_image = date("Y_m_d_H_m_s") . '-' . $_FILES['baby_img']['name'];
                $file = "";
                if (!empty($_FILES['baby_img']['name'])) {

                    $uploadPath =  realpath(FCPATH . 'assets/upload/fronf_ofs_services_images/');
                    // /var/www/html/hotel_management_new/assets/upload/fronf_ofs_services_images
                    //$config['overwrite'] = TRUE;
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = $update_image;

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if ($this->upload->do_upload('baby_img')) {
                        $update_filename = $this->upload->data();
                        $postArr['baby_img'] = $update_filename['file_name'];
                        $file_path_url = base_url() . 'assets/upload/fronf_ofs_services_images/' . $update_filename['file_name'];
                        $file = $file_path_url;
                    }
                } else {
                    $file = $old_img;
                }



                $wh_sh = '(front_ofs_service_image_id = "' . $shuttle_service_image_id . '")';
                $arr_sh = array('image' => $file);

                $this->HotelAdminModel->edit_data('front_ofs_services_images', $wh_sh, $arr_sh);
            }

            // spa images
            if ($service_name == 2) {
                //     $where1='(front_ofs_service_image_id ="'.$shuttle_service_image_id.'")';
                //     // echo "<pre>";
                //     // print_r($where1);die;
                //     $result = $this->HotelAdminModel->check_image($tbl = 'front_ofs_services_images', $where1);
                // //    print_r($_FILES['spa_photo']['name']);die;
                //     $old_img = $result[0]['image'];
                //     $update_image = date("Y_m_d_H_m_s").'-'.$_FILES['spa_photo']['name'];  
                //     print_r($update_image);die;

                //     $file = "";
                //     if(!empty($_FILES['spa_photo']['name'])){

                //         $uploadPath =  realpath(FCPATH . 'assets/upload/fronf_ofs_services_images/');
                //         // /var/www/html/hotel_management_new/assets/upload/fronf_ofs_services_images
                //         //$config['overwrite'] = TRUE;
                //         $config['upload_path'] = $uploadPath;
                //         $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
                //         $config['file_name'] = $update_image;  

                //         // Load and initialize upload library
                //         $this->load->library('upload', $config);
                //         $this->upload->initialize($config);

                //         // Upload file to server
                //         if($this->upload->do_upload('spa_photo')){   
                //             $update_filename = $this->upload->data();
                //             $postArr['spa_photo'] = $update_filename['file_name'];
                //             $file_path_url = base_url() . 'assets/upload/fronf_ofs_services_images/' . $update_filename['file_name'];
                //             $file = $file_path_url; 
                //         }
                //     } 
                //     else
                //     {
                //         $file = $old_img;
                //     }



                //     $wh_sh = '(front_ofs_service_image_id = "' . $shuttle_service_image_id . '")';
                //     $arr_sh = array('image' => $file);

                //     $this->HotelAdminModel->edit_data('front_ofs_services_images', $wh_sh, $arr_sh);





                // edit multiple spa photo price and type
                if (isset($_FILES['spa_photo']['name'])) {
                    // echo "hi";die;
                    $count1 = count($_FILES['spa_photo']['name'], TRUE);
                    // print_r($count1);die;
                    for ($k = 0; $k < $count1; $k++) {

                        $wh_sp_i = '(front_ofs_spa_service_images_id = "' . $front_ofs_spa_service_images_id[$k] . '")';

                        $services_img = $this->MainModel->getData('front_ofs_spa_service_images', $wh_sp_i);

                        if (!empty($_FILES['spa_photo']['name'][$k])) {
                            $_FILES['my_spa_file1']['name'] = $_FILES['spa_photo']['name'][$k];
                            $_FILES['my_spa_file1']['type'] = $_FILES['spa_photo']['type'][$k];
                            $_FILES['my_spa_file1']['tmp_name'] = $_FILES['spa_photo']['tmp_name'][$k];
                            $_FILES['my_spa_file1']['size'] = $_FILES['spa_photo']['size'][$k];
                            $_FILES['my_spa_file1']['error'] = $_FILES['spa_photo']['error'][$k];

                            $path = 'logo/';
                            $file_path = './' . $path;
                            $config['allowed_types'] = '*';
                            $config['encrypt_name'] = TRUE;
                            $config['upload_path'] = $file_path;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload('my_spa_file1')) {
                                $file_data = $this->upload->data();

                                $spa_photo = base_url() . $path . $file_data['file_name'];
                            }
                        } else {
                            $spa_photo = $services_img['spa_photo'];
                        }

                        $arr_spa_up = array(
                            'spa_photo' => $spa_photo,
                            'spa_type' => $spa_type[$k],
                            'spa_price' => $spa_price[$k],
                            'spa_description' => $spa_description[$k],
                        );

                        $ak = $this->HotelAdminModel->edit_data('front_ofs_spa_service_images', $wh_sp_i, $arr_spa_up);
                    }
                }

                if (!empty($_FILES['spa_photo12']['name'])) {

                    $count3 = count($_FILES['spa_photo12']['name'], TRUE);
                    // print_r($count3);die;
                    for ($l = 0; $l < $count3; $l++) {
                        if (!empty($_FILES['spa_photo12']['name'][$l])) {
                            $_FILES['my_spa_file2']['name'] = $_FILES['spa_photo12']['name'][$l];
                            $_FILES['my_spa_file2']['type'] = $_FILES['spa_photo12']['type'][$l];
                            $_FILES['my_spa_file2']['tmp_name'] = $_FILES['spa_photo12']['tmp_name'][$l];
                            $_FILES['my_spa_file2']['size'] = $_FILES['spa_photo12']['size'][$l];
                            $_FILES['my_spa_file2']['error'] = $_FILES['spa_photo12']['error'][$l];

                            $path = 'logo/';
                            $file_path = './' . $path;
                            $config['allowed_types'] = '*';
                            $config['encrypt_name'] = TRUE;
                            $config['upload_path'] = $file_path;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload('my_spa_file2')) {
                                $file_data = $this->upload->data();

                                $spa_photo2 = base_url() . $path . $file_data['file_name'];

                                $arr_spa_ad = array(
                                    'hotel_id' => $u_id,
                                    'front_ofs_service_id' => $front_ofs_service_id,
                                    'spa_photo' => $spa_photo2,
                                    'spa_type' => $spa_type12[$l],
                                    'spa_price' => $spa_price12[$l],
                                    'spa_description' => $spa_description12[$l],
                                );

                                $ad = $this->HotelAdminModel->insert_data('front_ofs_spa_service_images', $arr_spa_ad);
                                // print_r($ad);die;
                            }
                        }
                    }
                }
            }

            if ($service_name == 1) {
                $admin_id = $this->session->userdata('u_id');
                $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
                $this->load->view('hoteladmin/ajaxeditgymcenter', $guest_mng);
                // $this->session->set_flashdata('msg','Data Updated Successfully');
                // redirect(base_url('HoteladminController/frontOfficeList'));
            } else {
                if ($service_name == 2) {
                    $admin_id = $this->session->userdata('u_id');
                    $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
                    $this->load->view('hoteladmin/ajaxeditspacenterinfo', $guest_mng);
                    // $this->session->set_flashdata('msg','Data Updated Successfully');
                    // redirect(base_url('HoteladminController/frontOfficeList'));
                } else {
                    if ($service_name == 3) {
                        $admin_id = $this->session->userdata('u_id');
                        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
                        $this->load->view('hoteladmin/ajaxeditpoolcenter', $guest_mng);
                        // $this->session->set_flashdata('msg','Data Updated Successfully');
                        // redirect(base_url('HoteladminController/frontOfficeList'));
                    } else {
                        if ($service_name == 4) {
                            $admin_id = $this->session->userdata('u_id');
                            $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
                            $this->load->view('hoteladmin/ajaxeditshuttlecenter', $guest_mng);
                            // $this->session->set_flashdata('msg','Data Updated Successfully');
                            // redirect(base_url('HoteladminController/frontOfficeList'));
                        } else {
                            if ($service_name == 5) {
                                $admin_id = $this->session->userdata('u_id');
                                $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
                                $this->load->view('hoteladmin/ajaxeditbabycenter', $guest_mng);
                                // $this->session->set_flashdata('msg','Data Updated Successfully');
                                // redirect(base_url('HoteladminController/frontOfficeList'));
                            } else {
                                if ($service_name == 6) {
                                    $this->session->set_flashdata('msg', 'Data Updated Successfully');
                                    redirect(base_url('HoteladminController/frontOfficeList'));
                                } else {
                                    if ($service_name == 7) {
                                        $this->session->set_flashdata('msg', 'Data Updated Successfully');
                                        redirect(base_url('HoteladminController/frontOfficeList'));
                                    } else {
                                        if ($service_name == 8) {
                                            $this->session->set_flashdata('msg', 'Data Updated Successfully');
                                            redirect(base_url('HoteladminController/frontOfficeList'));
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            if ($service_name == 1) {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            } else {
                if ($service_name == 2) {
                    $this->session->set_flashdata('msg', 'Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                } else {
                    if ($service_name == 3) {
                        $this->session->set_flashdata('msg', 'Something went wrong');
                        redirect(base_url('HoteladminController/frontOfficeList'));
                    } else {
                        if ($service_name == 4) {
                            $this->session->set_flashdata('msg', 'Something went wrong');
                            redirect(base_url('HoteladminController/frontOfficeList'));
                        } else {
                            if ($service_name == 5) {
                                $this->session->set_flashdata('msg', 'Something went wrong');
                                redirect(base_url('HoteladminController/frontOfficeList'));
                            } else {
                                if ($service_name == 6) {
                                    $this->session->set_flashdata('msg', 'Something went wrong');
                                    redirect(base_url('HoteladminController/frontOfficeList'));
                                } else {
                                    if ($service_name == 7) {
                                        $this->session->set_flashdata('msg', 'Something went wrong');
                                        redirect(base_url('HoteladminController/frontOfficeList'));
                                    } else {
                                        if ($service_name == 8) {
                                            $this->session->set_flashdata('msg', 'Something went wrong');
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

    public function getEditexpenseData()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($wh);die;
        $wh = '(expense_id ="' . $where . '")';
        $data = $this->MainModel->getSingleData($tbl = 'expenses', $wh);

        $wh1 = '(expense_id = "' . $where . '")';

      
        $data["list"] = $this->HotelAdminModel->getAllData('expenses', $wh1);
        // echo "<pre>";
        // print_r($data["list"]);die;
        // print_r($data);die;

        echo json_encode($data);
    }
    public function edit_expenses()
    {
        $guest_name = $this->input->post('guest_name');
        $mobile_no = $this->input->post('mobile_no');
        $expense_amt = $this->input->post('expense_amt');
        $date = $this->input->post('date');
        $description = $this->input->post('description');

        $expense_id = $this->input->post('expense_id');

        $wh = '(expense_id = "' . $expense_id . '")';

        $user_data = $this->HotelAdminModel->get_user_data_by_no($mobile_no);

        if ($user_data) {
            $arr = array(
                'guest_name' => $guest_name,
                'mobile_no' => $mobile_no,
                'u_id' => $user_data['u_id'],
                'expense_amt' => $expense_amt,
                'date' => $date,
                'description' => $description,
            );

            $up = $this->HotelAdminModel->edit_data('expenses', $wh, $arr);

            if ($up) {
                $admin_id = $this->session->userdata('u_id');
                $guest_mng["list"] = $this->HotelAdminModel->get_user_expense_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxaccountslist', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        } else {
            $this->session->set_flashdata('msg', 'Mobile number not registerd');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }

    public function add_walking_guest()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
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

        $wh = '(mobile_no = "' . $mobile_no . '")';
        $user_data = $this->HotelAdminModel->getData('register', $wh);

        $add_user = "";
        $up_user = "";

        //id proff images
        $_FILES['my_file']['name'] = $_FILES['id_proff_img']['name'];
        $_FILES['my_file']['type'] = $_FILES['id_proff_img']['type'];
        $_FILES['my_file']['tmp_name'] = $_FILES['id_proff_img']['tmp_name'];
        $_FILES['my_file']['size'] = $_FILES['id_proff_img']['size'];
        $_FILES['my_file']['error'] = $_FILES['id_proff_img']['error'];

        $path = 'assets/upload/id_proff_pic_for_add_booking/';
        $file_path = './' . $path;
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = TRUE;
        $config['upload_path'] = $file_path;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('my_file')) {
            $file_data = $this->upload->data();

            $id_proff_img = base_url() . $path . $file_data['file_name'];
        } else {
            $this->session->set_flashdata('msg', 'Error to upload images');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }

        if ($user_data) {
            $arr_up = array(
                'full_name' => $full_name,
                'mobile_no' => $mobile_no,
                'guest_type' => $guest_type,
            );

            $up_user = $this->HotelAdminModel->edit_data('register', $wh, $arr_up);

            $u_id = $user_data['u_id'];
        } else {
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

            $add_user = $this->HotelAdminModel->insert_data('register', $arr_add);

            $u_id = $add_user;
        }

        if ($add_user || $up_user) {
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
                'check_in_status' => 1,
                'booking_from' => 1,
            );

            $add_booking = $this->HotelAdminModel->insert_data('user_hotel_booking', $arr_add);

            if ($add_booking) {
                //added as a guest
                $arr_add_ug = array(
                    'hotel_id' => $admin_id,
                    'u_id' => $u_id,
                    'booking_id' => $add_booking,
                    'login_id' => $mobile_no,
                    'dnd_mode' => 2,
                    'is_guest' => 1,
                );

                $this->HotelAdminModel->insert_data('guest_user', $arr_add_ug);

                //add room no type price
                $no_of_rooms = $this->input->post('no_of_rooms');
                $room_type = $this->input->post('room_type');
                $room_no = $this->input->post('room_no');

                $rm_data = $this->HotelAdminModel->get_room_nos_data($admin_id, $room_type, $room_no);

                $arr_add_details = array(
                    'booking_id' => $add_booking,
                    'room_no' => $room_no,
                    'price' => $rm_data['price'],
                    'no_of_rooms' => $no_of_rooms,
                    'room_type' => $room_type,
                );

                $add_details = $this->HotelAdminModel->insert_data('user_hotel_booking_details', $arr_add_details);

                if ($add_details) {
                    $wh_detail = '(booking_id = "' . $add_booking . '")';

                    $booking_data = $this->HotelAdminModel->getData('user_hotel_booking', $wh_detail);

                    $arr_up = array(
                        'total_charges' => $booking_data['total_charges'] + $rm_data['price'],
                        'no_of_rooms' => $booking_data['no_of_rooms'] + $no_of_rooms,
                    );

                    $this->HotelAdminModel->edit_data('user_hotel_booking', $wh_detail, $arr_up);

                    //change room status

                    $wh_rn_status = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $room_no . '")';

                    $arr_rn_status = array(
                        'room_status' => 2
                    );

                    $this->HotelAdminModel->edit_data('room_status', $wh_rn_status, $arr_rn_status);
                }
                //multiple room no type price

                $no_of_rooms1 = $this->input->post('no_of_rooms1'); //multiple
                $room_type1 = $this->input->post('room_type1'); // multiple
                $room_no1 = $this->input->post('room_no1'); // multiple

                if (isset($_POST['room_type1'])) {
                    $count = count($room_type1);

                    for ($i = 0; $i < $count; $i++) {
                        $rm_data1 = $this->HotelAdminModel->get_room_nos_data($admin_id, $room_type1[$i], $room_no1[$i]);

                        $arr_add_details1 = array(
                            'booking_id' => $add_booking,
                            'room_no' => $room_no1[$i],
                            'price' => $rm_data1['price'],
                            'no_of_rooms' => $no_of_rooms1[$i],
                            'room_type' => $room_type1[$i],
                        );

                        $add_details1 = $this->HotelAdminModel->insert_data('user_hotel_booking_details', $arr_add_details1);

                        if ($add_details1) {
                            $wh_detail1 = '(booking_id = "' . $add_booking . '")';

                            $booking_data1 = $this->HotelAdminModel->getData('user_hotel_booking', $wh_detail1);

                            $arr_up1 = array(
                                'total_charges' => $booking_data1['total_charges'] + $rm_data1['price'],
                                'no_of_rooms' => $booking_data1['no_of_rooms'] + $no_of_rooms1[$i],
                            );

                            $this->HotelAdminModel->edit_data('user_hotel_booking', $wh_detail1, $arr_up1);

                            //change room status

                            $wh_rn_status1 = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $room_no1[$i] . '")';

                            $arr_rn_status1 = array(
                                'room_status' => 2
                            );

                            $this->HotelAdminModel->edit_data('room_status', $wh_rn_status1, $arr_rn_status1);
                        }
                    }
                }

                $this->session->set_flashdata('msg', 'Booking Successfully');
                redirect(base_url('HoteladminController/frontOfficeList'));
            } 
            else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
    }

    public function assign_rooms_modal()
    {
        $admin_id = $this->session->userdata('u_id');
        $booking_id_get = $this->input->post('booking_id_get');
        $book_room_num = $this->input->post('book_room_num');
        $room_type = $this->input->post('room_type_get');
        $count_of_room = '';

        $rooms = $this->MainModel->get_room_nos($admin_id, $room_type);
        $all_rooms =  array_column($rooms, 'room_no');
        $count_of_room = $this->MainModel->get_available_room_nos($admin_id, $all_rooms);
        $data['count_of_room'] = $count_of_room;
        $this->load->view('hoteladmin/ajax_assigne_room_modal', $data);
    }

    public function assign_rooms()
    {
        // echo "<pre>";
        // // print_r($count_of_room);
        // $book_room_num = $this->input->post();
        // print_r($book_room_num);
        // exit;
        $booking_id = $this->input->post('booking_id_get');
        $room_no = $this->input->post('room_no'); //single
        $price = $this->input->post('price'); //single
        $room_type = $this->input->post('room_type'); //single
        $price1 = $this->input->post('price1'); // multiple
        $room_no1 = $this->input->post('room_no1'); //multiple
        // print_r($_POST);die;
        $wh_detail = '(booking_id = "' . $booking_id . '")';

        $admin_id = $this->session->userdata('u_id');

        $booking_data = $this->HotelAdminModel->getData('user_hotel_booking', $wh_detail);
        $wh = '(u_id ="'.$admin_id.'")';
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
        $hotel_name = $get_hotel_name['hotel_name'];
        $add_details = "";
        $add_details1 = "";

        //single room addd

        if (isset($_POST['room_no'])) {
            $arr = array(
                'booking_id' => $booking_id,
                'room_no' => $room_no,
                'price' => $price,
                'no_of_rooms' => 1,
                'room_type' => $room_type,
            );

            $add_details = $this->HotelAdminModel->insert_data('user_hotel_booking_details', $arr);

            if ($add_details) {
                // change room status
                $wh_r = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $room_no . '")';

                $arr_rm_up = array(
                    'room_status' => 2,
                );

                $this->HotelAdminModel->edit_data('room_status', $wh_r, $arr_rm_up);

                $arr_up = array(
                    //'total_charges' => $booking_data['total_charges'] + $price,
                    'booking_status' => 1
                );

                $this->HotelAdminModel->edit_data('user_hotel_booking', $wh_detail, $arr_up);
            }
        }

        // add multipe room no
        if (isset($_POST['room_no1'])) {
            $count = count($room_no1);

            for ($i = 0; $i < $count; $i++) {
                $arr1 = array(
                    'booking_id' => $booking_id,
                    'room_no' => $room_no1[$i],
                    'price' => $price1[$i],
                    'no_of_rooms' => 1,
                    'room_type' => $room_type,
                );

                $add_details1 = $this->HotelAdminModel->insert_data('user_hotel_booking_details', $arr1);

                if ($add_details1) {
                    // change room status
                    $wh_r1 = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $room_no1[$i] . '")';

                    $arr_rm_up1 = array(
                        'room_status' => 2,
                    );

                    $this->HotelAdminModel->edit_data('room_status', $wh_r1, $arr_rm_up1);

                    $arr_up1 = array(
                        'total_charges' => $booking_data['total_charges'] + $price1[$i],
                        'booking_status' => 1
                    );

                    $this->HotelAdminModel->edit_data('user_hotel_booking', $wh_detail, $arr_up1);
                }
            }
        }

        if ($add_details || $add_details1) {
            //changes enquiry request status
            $wh_enq = '(hotel_enquiry_request_id = "' . $booking_data['enquiry_id'] . '")';

            $arr_eq = array(
                'is_admin_accept_req' => 1,
                'request_status' => 4,
            );

            $this->HotelAdminModel->edit_data('hotel_enquiry_request', $wh_enq, $arr_eq);

            $get_u_id = $this->MainModel->getData($tbl = 'user_hotel_booking', $wh_detail);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            $title = "";
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Room Assign Is Successfully';
                $body = 'Your Booking ID is "'.$booking_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }
            $subject = $title;
            $description = "$title In $hotel_name And Your Booking ID Is $booking_id";
            $arr_noti = array(
                                'hotel_id' => $admin_id,
                                'u_id' => $get_u_id['u_id'],
                                 'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );
    //  print_r($arr_noti);die;
             $this->MainModel->insert_data('user_notification',$arr_noti);
            
            // print_r($result);die;

            $this->session->set_flashdata('msg', 'Assign Rooms and booking Successfully');
            // redirect(base_url('HoteladminController/frontOfficeList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            // redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }
    public function ajax_resetdata_arrival()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['sub_icon_id'] = "n1";
        $service_name = 1;
        $guest_mng["today_hotel_book_list_by_app"] = $this->HotelAdminModel->get_user_pending_booking_list_from_app_pagination($admin_id);

        $guest_mng['list'] = $this->HotelAdminModel->get_user_pending_booking_list_from_app($admin_id);

        $guest_mng['room_type_list'] = $this->HotelAdminModel->get_room_type_list($admin_id);
        // echo "<pre>";
        // print_r($guest_mng);
        // exit;
        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }
    public function get_room_nos()
    {
        $room_type = $this->input->post('room_type');

        $admin_id = $this->session->userdata('u_id');

        $room_no_data = $this->HotelAdminModel->get_room_nos($admin_id, $room_type);

        $output = '';

        foreach ($room_no_data as $r_n) {
            $available_rm = $this->HotelAdminModel->get_available_room_no($admin_id, $r_n['room_no']);

            if ($available_rm) {
                $output .= '<div class="room_card card  p-0"
                                    data-bs-target=".add" class="green">
                                    <input name="room_no" class="radio" type="radio"
                                        value="' . $r_n['room_no'] . '">
                                    <span
                                        class="room_no m-0 room_card  red colored-div">' . $r_n['room_no'] . '</span>
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

        $lux_tax_amt = $price * ($lux_tax / 100);
        // $lux_tax_amt1 = $price + $lux_tax;

        $serv_tax_amt = $price * ($serv_tax / 100);
        // $serv_tax_amt1 = $price + $serv_tax_amt;

        $wh = '(hotel_id = "' . $admin_id . '" AND room_type_name = "' . $room_type_name . '")';

        $room_type_data = $this->HotelAdminModel->getData('room_type', $wh);

        if ($room_type_data) {
            echo "1";
        } else {
            $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'];

            $path = 'assets/upload/room_type_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file')) {
                $file_data = $this->upload->data();

                $images = base_url() . $path . $file_data['file_name'];
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

            $add = $this->HotelAdminModel->insert_data('room_type', $arr);

            if ($add) {
                // $this->session->set_flashdata('msg','Room Type added Successfully..');
                // redirect(base_url('HoteladminController/frontOfficeList'));
                $guest_mng["list"] = $this->HotelAdminModel->get_room_type_list_pagination($admin_id);
                $this->load->view('hoteladmin/ajaxroomtypedata', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
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
        // print_r($this->input->post());die;

        $room_data = $_POST['room_no'];

        $room_arr = explode(",", $room_data);

        $admin_id = $this->session->userdata('u_id');
        $whf = '(hotel_id = "' . $admin_id . '" AND floor_id = "' . $floor_id . '" AND room_type = "' . $room_type . '")';
        $floor_data = $this->HotelAdminModel->getData('room_configure', $whf);
        // print_r($floor_data);die;

        if ($floor_data) {
            $this->session->set_flashdata('msg', 'On This Floor Room Is Already Created Plz View..');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {


            if ($room_arr) {
                $room_no_data = array();

                foreach ($room_arr as $key => $value) {
                    $wh = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $value . '")';
                    $room_no_data = $this->HotelAdminModel->getData('room_nos', $wh);

                    if ($room_no_data) {
                        $this->session->set_flashdata('msg', '"' . $value . '"Room no Already exits..');
                        redirect(base_url('HoteladminController/frontOfficeList'));
                    }
                }
            }

            if (empty($room_no_data)) {

                $room_no_data = $this->HotelAdminModel->getData('room_nos', $wh);

                $arr = array(
                    'hotel_id' => $admin_id,
                    'floor_id' => $floor_id,
                    'room_type' => $room_type,
                    'room_details' => $room_details,
                    'price' => $price,
                    'added_by' => 1,
                    'added_by_u_id' => $admin_id,
                );

                $add = $this->HotelAdminModel->insert_data('room_configure', $arr);

                if ($add) {
                    // add multiple room images 
                    // $count_img = count($_FILES['images']['name'],TRUE);

                    // for($i = 0;$i < $count_img; $i++)
                    // {
                    //     if(!empty($_FILES['images']['name'][$i]))
                    //     {
                    //         $_FILES['my_uploaded_file']['name'] = $_FILES['images']['name'][$i];
                    //         $_FILES['my_uploaded_file']['type'] = $_FILES['images']['type'][$i];
                    //         $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                    //         $_FILES['my_uploaded_file']['size'] = $_FILES['images']['size'][$i];
                    //         $_FILES['my_uploaded_file']['error'] = $_FILES['images']['error'][$i];

                    //         $path = 'assets/upload/room_img/';
                    //         $file_path = './'.$path;
                    //         $config['allowed_types'] = '*';
                    //         $config['encrypt_name'] = TRUE;
                    //         $config['upload_path'] = $file_path;
                    //         $this->load->library('upload',$config);
                    //         $this->upload->initialize($config);

                    //         if($this->upload->do_upload('my_uploaded_file'))
                    //         {
                    //             $file_data = $this->upload->data();

                    //             $images = base_url().$path.$file_data['file_name'];

                    //             $arr1 = array(
                    //                             'hotel_id' => $admin_id,
                    //                             'room_configure_id' => $add,
                    //                             'images' => $images,
                    //                             'added_by' => 1,
                    //                             'added_by_id' => $admin_id,
                    //                         );

                    //             $this->HotelAdminModel->insert_data('room_imgs',$arr1);
                    //         }        
                    //     }
                    // }

                    // add multiple facility
                    $facility = $_POST['facility'];

                    $facility_string_arr = explode(",", $facility);

                    foreach ($facility_string_arr as $key => $value) {
                        $arr_fl = array(
                            'hotel_id' => $admin_id,
                            'room_configure_id' => $add,
                            'room_facility' => $value,
                            'added_by' => 1,
                            'added_by_u_id' => $admin_id,
                        );

                        $this->HotelAdminModel->insert_data('room_facility', $arr_fl);
                    }

                    // add multiple room nos
                    $room_data = $_POST['room_no'];


                    $room_arr = explode(",", $room_data);


                    foreach ($room_arr as $key => $value) {

                        $arr_rm = array(
                            'hotel_id' => $admin_id,
                            'room_configure_id' => $add,
                            'room_no' => $value,
                            'added_by' => 1,
                            'added_by_id' => $admin_id,
                        );

                        $add_room_no = $this->HotelAdminModel->insert_data('room_nos', $arr_rm);

                        if ($add_room_no) {
                            $arr_rm = array(
                                'hotel_id' => $admin_id,
                                'room_no' => $value,
                                'room_status' => 3,
                                'added_by' => 1,
                                'added_by_u_id' => $admin_id,
                            );

                            $this->HotelAdminModel->insert_data('room_status', $arr_rm);
                        }
                    }

                    $this->session->set_flashdata('msg', 'Room no added successfully..');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong');
                    redirect(base_url('HoteladminController/frontOfficeList'));
                }
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

        $lux_tax_amt = $price * ($lux_tax / 100);
        // $lux_tax_amt1 = $price + $lux_tax;

        $serv_tax_amt = $price * ($serv_tax / 100);
        // $serv_tax_amt1 = $price + $serv_tax_amt;

        $wh = '(room_type_id = "' . $room_type_id . '")';

        $room_type_data1 = $this->HotelAdminModel->getData('room_type', $wh);

        if (!empty($_FILES['image']['name'])) {
            $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'];

            $path = 'assets/upload/room_type_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file')) {
                $file_data = $this->upload->data();

                $images = base_url() . $path . $file_data['file_name'];
            }
        } else {
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

        $add = $this->HotelAdminModel->edit_data('room_type', $wh, $arr);

        if ($add) {

            $wh1 = '(room_type = "' . $room_type_id . '")';
            $room_configuration_data = $this->HotelAdminModel->getData('room_configure', $wh1);

            if($room_configuration_data){
                $arr1 =  array(
                    'price' => $price,
                );
                $edit_data = $this->HotelAdminModel->edit_data('room_configure', $wh1, $arr1);

                if($edit_data){

                    $guest_mng["list"] = $this->HotelAdminModel->get_room_type_list_pagination($admin_id);
                    $this->load->view('hoteladmin/ajaxroomtypedata', $guest_mng);
                }

            }
            else{
                    $guest_mng["list"] = $this->HotelAdminModel->get_room_type_list_pagination($admin_id);
                    $this->load->view('hoteladmin/ajaxroomtypedata', $guest_mng);
            }
          
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }
    public function delete_room_type()
    {
        $room_type_id = $this->input->post('id');

        $wh = '(room_type_id = "' . $room_type_id . '")';

        $del = $this->HotelAdminModel->delete_data('room_type', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_room_type_list_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxroomtypedata', $guest_mng);
        } else {
            echo "0";
        }
    }
    public function delete_lost_found_list()
    {
        $id = $this->input->post('id');

        $wh = '(id = "' . $id . '")';

        $del = $this->HotelAdminModel->delete_data('lost_found_list', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_lost_found_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxlostlistdelete', $guest_mng);
        } else {
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

        $facility_name = $this->input->post('facility_name'); //multiple
        $business_center_image_id = $this->input->post('business_center_image_id', TRUE); // image id
        // $id1 = $this->input->post('img_id',TRUE);

        $wh = '(business_center_id = "' . $business_center_id . '")';

        $arr = array(
            'business_center_type' => $business_center_type,
            'no_of_people' => $no_of_people,
            'price' => $price,
            'description' => $description
        );

        $up = $this->HotelAdminModel->edit_data('business_center', $wh, $arr);

        if ($up) {
            // updated particular images
            if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                // $count_img = count(array($_FILES['image']['name'],TRUE));

                // for($i = 0;$i < $count_img; $i++)
                // {
                //     if(!empty($_FILES['image']['name'][$i]))
                //     {
                $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'];
                $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'];
                $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'];
                $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'];
                $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'];

                $path = 'assets/upload/business_center_type/';
                $file_path = './' . $path;
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $file_path;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('my_uploaded_file')) {
                    $file_data = $this->upload->data();

                    $images = base_url() . $path . $file_data['file_name'];

                    // $wh1 = '(business_center_image_id = "'.$business_center_image_id[$i].'")';

                    $arr1 = array(
                        'image' => $images
                    );

                    $this->HotelAdminModel->edit_data('business_center_images', $wh, $arr1);
                }
                //     }
                // }
            }

            //edit facility
            if (!empty($facility_name)) {
                for ($j = 0; $j < count($facility_name); $j++) {
                    $arr_fc = array(
                        'facility_name' => $facility_name[$j]
                    );

                    $this->HotelAdminModel->edit_data('business_center_facility', $wh, $arr_fc);
                }
            }

            // $this->session->set_flashdata('msg','Business center updated successfully..');
            // redirect(base_url('HoteladminController/frontOfficeList'));
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_business_center_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxeditbusinesscenter', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
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

        $add = $this->HotelAdminModel->insert_data('business_center', $arr);

        if ($add) {
            // add multiple images
            $count_img = count($_FILES['image']['name'], TRUE);

            for ($i = 0; $i < $count_img; $i++) {
                if (!empty($_FILES['image']['name'][$i])) {
                    $_FILES['my_uploaded_file']['name'] = $_FILES['image']['name'][$i];
                    $_FILES['my_uploaded_file']['type'] = $_FILES['image']['type'][$i];
                    $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                    $_FILES['my_uploaded_file']['size'] = $_FILES['image']['size'][$i];
                    $_FILES['my_uploaded_file']['error'] = $_FILES['image']['error'][$i];

                    $path = 'assets/upload/business_center_type/';
                    $file_path = './' . $path;
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = $file_path;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('my_uploaded_file')) {
                        $file_data = $this->upload->data();

                        $images = base_url() . $path . $file_data['file_name'];

                        $arr1 = array(
                            'hotel_id' => $admin_id,
                            'business_center_id' => $add,
                            'image' => $images
                        );

                        $this->HotelAdminModel->insert_data('business_center_images', $arr1);
                    }
                }
            }

            //add multiple facility 
            for ($j = 0; $j < count($facility_name); $j++) {
                $arr_fc = array(
                    'hotel_id' => $admin_id,
                    'business_center_id' => $add,
                    'facility_name' => $facility_name[$j]
                );

                $this->HotelAdminModel->insert_data('business_center_facility', $arr_fc);
            }
            $guest_mng["list"] = $this->HotelAdminModel->get_business_center_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxeditbusinesscenter', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }


    public function delete_business_center()
    {
        $business_center_id = $this->input->post('id');

        $wh = '(business_center_id = "' . $business_center_id . '")';

        $del = $this->HotelAdminModel->delete_data('business_center', $wh);

        $del = $this->HotelAdminModel->delete_data('business_center_facility', $wh);

        $del = $this->HotelAdminModel->delete_data('business_center_images', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');

            $guest_mng["list"] = $this->HotelAdminModel->get_business_center_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxeditbusinesscenter', $guest_mng);
        } else {
            echo "0";
        }
    }
    public function check_visitor_otp()
    {
        $visitor_id = $this->input->post('visitor_id');
        $otp = $this->input->post('otp');

        $wh = '(visitor_id = "' . $visitor_id . '")';

        $data = $this->HotelAdminModel->getData('visitor', $wh);
        $admin_id = $this->session->userdata('u_id');
        if ($data['otp'] == $otp) {
            $arr = array(
                'is_otp_verified' => 1,
                'is_otp_correct' => 1,
            );

            $up = $this->HotelAdminModel->edit_data('visitor', $wh, $arr);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'visitor', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Visitor Otp Is Verified, Guest Is Coming';
                    $body = 'Your Visitor ID is "'.$visitor_id.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                $guest_mng["list"] = $this->HotelAdminModel->get_visitor_pagination($admin_id);
                // print_r($guest_mng);die;
                $this->load->view('hoteladmin/ajaxOTPList', $guest_mng);
                // $this->session->set_flashdata('msg','OTP verified Successfully');
                // redirect(base_url('HoteladminController/frontOfficeList'));
            } else {

                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        } else {
            $arr = array(
                'is_otp_verified' => 2,
                'is_otp_correct' => 2,
            );

            $up = $this->HotelAdminModel->edit_data('visitor', $wh, $arr);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'visitor', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Visitor Otp Is Not Verified';
                    $body = 'Your Visitor ID is "'.$visitor_id.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

               
                // print_r($result);die;
                echo 1;
                // $this->session->set_flashdata('msg','OTP is incorrect');
                // redirect(base_url('HoteladminController/frontOfficeList'));
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
    }

    public function check_out()
    {
        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');

            $date = $this->input->post('date');

            if (isset($_POST['search'])) {
                $check_out["list"] = $this->HotelAdminModel->get_checkout_guest_list_date_wise_pagination($admin_id, $date);
            } else {
                $check_out["list"] = $this->HotelAdminModel->get_checkout_guest_list_pagination($admin_id);
            }
            $check_out["sub_icon_id"] = 'n2';

            $this->load->view('hoteladmin/ajaxSubIconBlockView', $check_out);
        } else {
            redirect(base_url());
        }
    }


    public function check_out_view()
    {
        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');

            $booking_id = $this->uri->segment(3);

            $u_id = $this->uri->segment(4);

            $check_out_view['admin_data'] = $this->HotelAdminModel->get_user_data($admin_id);

            $check_out_view['user_data'] = $this->HotelAdminModel->get_user_data($u_id);

            $check_out_view['booking_details'] = $this->HotelAdminModel->get_user_booking_details($admin_id, $booking_id);

            $check_out_view['booking_checkout_data'] = $this->HotelAdminModel->get_user_checkout_booking_data($admin_id, $booking_id, $u_id);

            $check_out_view['booking_room_details'] = $this->HotelAdminModel->get_booking_room_details($booking_id);

            $check_out_view['minibar_list'] = $this->HotelAdminModel->get_room_service_minibar($admin_id);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/check_out_view', $check_out_view);
            $this->load->view('include/footer');
        } else {
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

        $wh = '(user_checkout_data_id = "' . $user_checkout_data_id . '")';

        $wh1 = '(booking_id = "' . $booking_id . '")';

        $user_hotel_booking = $this->HotelAdminModel->getData('user_hotel_booking', $wh1);

        $user_checkout_data = $this->HotelAdminModel->getData('user_checkout_data', $wh);

        $check_in = $user_hotel_booking['check_in'];

        if ($check_in == date('Y-m-d') && $is_today_charge == 1) {
            // echo 'hello';die;
            $arr_ch = array(
                'paid_date' => date('Y-m-d'),
                'is_paid' => 1,
                'total_bill' => $amount,
                'is_today_charge' => 1,
                'todays_charges' => $amount,
            );

            $up_ch = $this->HotelAdminModel->edit_data('user_checkout_data', $wh, $arr_ch);

            if ($up_ch) {
                $del = $this->HotelAdminModel->delete_data('user_checkout_details', $wh);

                $del = $this->HotelAdminModel->delete_data('user_checkout_sub_total', $wh);

                if ($del) {
                    $arr_ch_d = array(
                        'user_checkout_data_id' => $user_checkout_data_id,
                        'hotel_id' => $admin_id,
                        'description' => "Room Charges",
                        'date' => date('Y-m-d'),
                        'amount' => $amount
                    );

                    $add_chk_details = $this->HotelAdminModel->insert_data('user_checkout_details', $arr_ch_d);

                    if ($add_chk_details) {
                        $arr_ch_d_sub = array(
                            'user_checkout_data_id' => $user_checkout_data_id,
                            'hotel_id' => $admin_id,
                            'description_name' => "Room Charges",
                            'sub_total' => $amount
                        );

                        $this->HotelAdminModel->insert_data('user_checkout_sub_total', $arr_ch_d_sub);
                    }
                }

                $arr_ck_1 = array(
                    'booking_status' => 2,
                    'actual_checkout' => date('Y-m-d'),
                    'check_in_status' => 2,
                );

                $chk_1 = $this->HotelAdminModel->edit_data('user_hotel_booking', $wh1, $arr_ck_1);

                $arr_ckr = array(
                    'request_status' => 2,
                );
                $ck_request_status = $this->HotelAdminModel->edit_data('user_checkout_requests', $wh1, $arr_ckr);

                $wh_token = '(u_id ="'.$u_id.'")';
                $user_token_exist = $this->HotelAdminModel->getAllData('user_firebase_tokens',$wh_token);
                if($user_token_exist)
                {
                    $arr_token = array(                                              
                                    'token' => ""                                               
                                );
                    
                    $reset_token = $this->HotelAdminModel->edit_data('user_firebase_tokens',$wh_token,$arr_token);
                }
               
                // clear all notification
                $wh_n = '(u_id = "' . $u_id . '" AND hotel_id = "' . $admin_id . '")';
                $arr_n = array(
                    'clear_flag' => 0,
                );
                $clear_notification = $this->HotelAdminModel->edit_data('user_notification', $wh_n, $arr_n);


                if ($chk_1) {
                    //guest user status change
                    $wh_gu_1 = '(u_id = "' . $u_id . '" AND hotel_id = "' . $admin_id . '" AND booking_id = "' . $booking_id . '")';

                    $arr_gu_1 = array(
                        'is_guest' => 2
                    );

                    $this->HotelAdminModel->edit_data('guest_user', $wh_gu_1, $arr_gu_1);

                    //room status change

                    $booking_details_1 = $this->HotelAdminModel->getAllData('user_hotel_booking_details', $wh1);

                    if ($booking_details_1) {
                        foreach ($booking_details_1 as $bk_1) {
                            $wh_rm_s_1 = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $bk_1['room_no'] . '")';

                            $arr_bk_1 = array(
                                'room_status' => 1
                            );

                            $this->HotelAdminModel->edit_data('room_status', $wh_rm_s_1, $arr_bk_1);
                            $wh_rm_s_11 = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $bk_1['extend_room_no'] . '")';

                            $arr_bk_11 = array(
                                'room_status' => 1
                            );

                            $this->HotelAdminModel->edit_data('room_status', $wh_rm_s_11, $arr_bk_11);
                        }
                    }

                    //change checkout status for all order
                    $arr_chng_chk_1 = array(
                        'is_paid_after_check_out' => 1
                    );

                    $arr_v_wash_1 = array(
                        'is_paid_checkout' => 1
                    );
                    $this->HotelAdminModel->edit_data('cloth_orders', $wh_gu_1, $arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('food_orders', $wh_gu_1, $arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('rmservice_services_orders', $wh_gu_1, $arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('room_service_menu_orders', $wh_gu_1, $arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('house_keeping_orders', $wh_gu_1, $arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('vehicle_wash_request', $wh_gu_1, $arr_v_wash_1);

                    $this->HotelAdminModel->edit_data('expenses', $wh_gu_1, $arr_chng_chk_1);

                    $this->HotelAdminModel->edit_data('luggage_request', $wh_gu_1, $arr_chng_chk_1);
                }
                redirect(base_url('HoteladminController/check_out_view/' . $booking_id . '/' . $u_id));
            }
        } else {

            if ($is_today_charge == 1) {
                if (empty($amount)) {
                    $amount = 0;
                } else {
                    $amount = $amount;
                }
                $total = $user_checkout_data['total_bill'] + $amount;
                $is_today_charge = 1;
                $todays_charges = $amount;
            } else {
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

            $up = $this->HotelAdminModel->edit_data('user_checkout_data', $wh, $arr);

            if ($up) {
                $arr1 = array(
                    'booking_status' => 2,
                    'actual_checkout' => date('Y-m-d'),
                    'check_in_status' => 2,
                );

                $chk = $this->HotelAdminModel->edit_data('user_hotel_booking', $wh1, $arr1);

                $arr_ckr = array(
                    'request_status' => 2,
                );
                $ck_request_status = $this->HotelAdminModel->edit_data('user_checkout_requests', $wh1, $arr_ckr);

                $wh_token = '(u_id ="'.$u_id.'")';
                $user_token_exist = $this->HotelAdminModel->getAllData('user_firebase_tokens',$wh_token);
                if($user_token_exist)
                {
                    $arr_token = array(                                              
                                    'token' => ""                                               
                                );
                    
                    $reset_token = $this->HotelAdminModel->edit_data('user_firebase_tokens',$wh_token,$arr_token);
                }
                // print_r($ck_request_status);die;

                 // clear all notification
                $wh_n = '(u_id = "' . $u_id . '" AND hotel_id = "' . $admin_id . '")';
                $arr_n = array(
                    'clear_flag' => 0,
                );
                $clear_notification = $this->HotelAdminModel->edit_data('user_notification', $wh_n, $arr_n);

                if ($chk) {
                    //guest user status change
                    $wh_gu = '(u_id = "' . $u_id . '" AND hotel_id = "' . $admin_id . '" AND booking_id = "' . $booking_id . '")';

                    $arr_gu = array(
                        'is_guest' => 2
                    );

                    $this->HotelAdminModel->edit_data('guest_user', $wh_gu, $arr_gu);

                    //room status change

                    $booking_details = $this->HotelAdminModel->getAllData('user_hotel_booking_details', $wh1);

                    if ($booking_details) {
                        foreach ($booking_details as $bk) {
                            $wh_rm_s = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $bk['room_no'] . '")';

                            $arr_bk = array(
                                'room_status' => 1
                            );

                            $this->HotelAdminModel->edit_data('room_status', $wh_rm_s, $arr_bk);
                            $wh_rm_s_11 = '(hotel_id = "' . $admin_id . '" AND room_no = "' . $bk['extend_room_no'] . '")';
                            // print_r($wh_rm_s_11);die;
                            $arr_bk_11 = array(
                                'room_status' => 1
                            );

                            $this->HotelAdminModel->edit_data('room_status', $wh_rm_s_11, $arr_bk_11);
                        }
                    }
                    // die;
                    //change checkout status for all order
                    $arr_chng_chk = array(
                        'is_paid_after_check_out' => 1
                    );

                    $arr_v_wash = array(
                        'is_paid_checkout' => 1
                    );
                    $this->HotelAdminModel->edit_data('cloth_orders', $wh_gu, $arr_chng_chk);

                    $this->HotelAdminModel->edit_data('food_orders', $wh_gu, $arr_chng_chk);

                    $this->HotelAdminModel->edit_data('rmservice_services_orders', $wh_gu, $arr_chng_chk);

                    $this->HotelAdminModel->edit_data('room_service_menu_orders', $wh_gu, $arr_chng_chk);

                    $this->HotelAdminModel->edit_data('house_keeping_orders', $wh_gu, $arr_chng_chk);

                    $this->HotelAdminModel->edit_data('vehicle_wash_request', $wh_gu, $arr_v_wash);

                    $this->HotelAdminModel->edit_data('expenses', $wh_gu, $arr_chng_chk);

                    $this->HotelAdminModel->edit_data('luggage_request', $wh_gu, $arr_chng_chk);

                    redirect(base_url('HoteladminController/check_out_view/' . $booking_id . '/' . $u_id));
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

        $wh = '(user_checkout_data_id = "' . $user_checkout_data_id . '")';

        $user_checkout_data = $this->HotelAdminModel->getData('user_checkout_data', $wh);

        if ($amount > $total_amt) {
            $this->session->set_flashdata('msg', 'Enter valid Number');
            redirect(base_url('HoteladminController/check_out_view/' . $booking_id . '/' . $u_id));
        } else {
            if ($user_checkout_data['remaing_amt'] == 0) {
                $remaing_amt = $user_checkout_data['total_bill'] - $amount;
            } else {
                $remaing_amt = $user_checkout_data['remaing_amt'] - $amount;
            }

            $arr = array(
                'advance_payment' => $user_checkout_data['advance_payment'] + $amount,
                'advance_pay_type' => $payment_type,
                'advance_pay_date' => date('Y-m-d'),
                'remaing_amt' => $remaing_amt,
                'is_paid_advance_payment' => 1,
            );

            $up = $this->HotelAdminModel->edit_data('user_checkout_data', $wh, $arr);

            if ($up) {
                redirect(base_url('HoteladminController/check_out_view/' . $booking_id . '/' . $u_id));
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

        $booking_details = $this->HotelAdminModel->get_user_booking_details($admin_id, $booking_id);

        $wh = '(user_checkout_data_id = "' . $user_checkout_data_id . '")';

        $user_checkout_data = $this->HotelAdminModel->getData('user_checkout_data', $wh);

        $wh1 = '(booking_id = "' . $booking_id . '")';

        $remaing_amt = 0;

        if ($user_checkout_data['advance_payment'] != 0) {
            $remaing_amt = $user_checkout_data['remaing_amt'] + $amount;
        }

        $arr = array(
            'total_bill' => $user_checkout_data['total_bill'] + $amount,
            'remaing_amt' => $remaing_amt
        );

        $up = $this->HotelAdminModel->edit_data('user_checkout_data', $wh, $arr);

        if ($up) {
            $wh_11 = '(user_checkout_data_id = "' . $user_checkout_data_id . '" AND hotel_id = "' . $admin_id . '" AND description = "' . $description . '")';

            $user_checkout_details = $this->HotelAdminModel->getData('user_checkout_details', $wh_11);

            if ($user_checkout_details) {
                $arr_11  = array(
                    'date' => $date,
                    'amount' => $amount
                );

                $up_check_details = $this->HotelAdminModel->edit_data('user_checkout_details', $wh_11, $arr_11);

                if ($up_check_details) {
                    $wh_1 = '(description_name = "' . $description . '" AND user_checkout_data_id = "' . $user_checkout_data_id . '")';

                    $user_checkout_sub_total_data = $this->HotelAdminModel->getData('user_checkout_sub_total', $wh_1);

                    if ($user_checkout_sub_total_data) {
                        $arr_sub = array(
                            'sub_total' => $user_checkout_sub_total_data['sub_total'] + $amount
                        );

                        $this->HotelAdminModel->edit_data('user_checkout_sub_total', $wh_1, $arr_sub);
                    }
                }
            } else {
                $date__1 = $booking_details['check_in'];
                $date__2 = $booking_details['check_out'];

                $diff = abs(strtotime($date__2) - strtotime($date__1));

                $years = floor($diff / (365 * 60 * 60 * 24));
                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                for ($i = 0; $i < $days; $i++) {
                    if (date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days')) == $date) {
                        $date1 = $date;
                        $amount1 = $amount;
                    } else {
                        $date1 = date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days'));
                        $amount1 = 0;
                    }

                    $arr1 = array(
                        'hotel_id' => $admin_id,
                        'user_checkout_data_id' => $user_checkout_data_id,
                        'description' => $description,
                        'date' => $date1,
                        'amount' => $amount1
                    );

                    $add_check_details = $this->HotelAdminModel->insert_data('user_checkout_details', $arr1);

                    if ($add_check_details) {
                        $wh1 = '(hotel_id = "' . $admin_id . '" AND user_checkout_data_id = "' . $user_checkout_data_id . '" AND description_name = "' . $description . '")';

                        $user_checkout_sub_total = $this->HotelAdminModel->getData('user_checkout_sub_total', $wh1);

                        //add subtotal
                        if ($user_checkout_sub_total) {
                            $st_arr1 = array(
                                'sub_total' => $user_checkout_sub_total['sub_total'] + $amount1
                            );

                            $this->HotelAdminModel->edit_data('user_checkout_sub_total', $wh1, $st_arr1);
                        } else {
                            //edit subtotal
                            $st_arr2 = array(
                                'hotel_id' => $admin_id,
                                'user_checkout_data_id' => $user_checkout_data_id,
                                'description_name' => $description,
                                'sub_total' => $amount1
                            );

                            $this->HotelAdminModel->insert_data('user_checkout_sub_total', $st_arr2);
                        }
                    }
                }
            }
            redirect(base_url('HoteladminController/check_out_view/' . $booking_id . '/' . $u_id));
        }
    }
    public function change_business_center_status()
    {
        $status = $this->input->post('status');
        $business_center_id = $this->input->post('id');

        $wh = '(business_center_id = "' . $business_center_id . '")';

        $arr = array(
            'is_active' => $status
        );

        $update = $this->HotelAdminModel->edit_data('business_center', $wh, $arr);

        if ($update) {
            echo "1";
        } else {
            echo "0";
        }
    }
    public function ajaxSubIconBlockView()
    {
        $postArr = $this->input->post();
        $u_id = $this->session->userdata('u_id');
        $where = '(u_id = "' . $u_id . '")';
        $admin_details = $this->HotelAdminModel->getData($tbl = 'register', $where);
        $admin_id = $admin_details['u_id'];
        $guest_mng['icon_id'] = $postArr['data_id'];
        $guest_mng['sub_section_icon_id'] = $postArr['sub_section_id'];
        $guest_mng['sub_icon_id'] = $postArr['sub_section_id'];

        if ($postArr['data_id'] == "10") {
            if ($postArr['sub_section_id'] == "1") {
                $service_name = 1;
                $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
            } else if ($postArr['sub_section_id'] == "2") {
                $service_name = 2;

                $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
                $guest_mng["spa_request"] = $this->HotelAdminModel->get_spa_request_list_pagination($admin_id);
                $guest_mng["spa_request1"] = $this->HotelAdminModel->get_spa_accept_list_pagination($admin_id);
                $guest_mng["spa_request6"] = $this->HotelAdminModel->get_spa_complete_list_pagination($admin_id);
                $guest_mng["spa_request2"] = $this->HotelAdminModel->get_spa_reject_list_pagination($admin_id);
            } else if ($postArr['sub_section_id'] == "3") {
                $service_name = 3;
                $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
            } else if ($postArr['sub_section_id'] == "4") {
                $service_name = 4;
                $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
                $day1 = "Sunday";
                $day2 = "Monday";
                $day3 = "Tuesday";
                $day4 = "Wednesday";
                $day5 = "Thursday";
                $day6 = "Friday";
                $day7 = "Saturday";
                $service_name = 4;
                $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);

                $guest_mng['sun_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day1);

                $guest_mng['mon_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day2);

                $guest_mng['tue_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day3);

                $guest_mng['wed_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day4);

                $guest_mng['thurs_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day5);

                $guest_mng['fri_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day6);

                $guest_mng['sat_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day7);
            } else if ($postArr['sub_section_id'] == "5") {
                $service_name = 5;
                $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
            } else if ($postArr['sub_section_id'] == "6") {

                $guest_mng["vehicle_wash_request"] = $this->HotelAdminModel->get_vehicle_wash_request_list_pagination($admin_id);
                $guest_mng["vehicle_wash_request1"] = $this->HotelAdminModel->get_vehicle_wash_accepted_request_list_pagination($admin_id);
                $guest_mng["vehicle_wash_request3"] = $this->HotelAdminModel->get_vehicle_wash_rejected_request_list_pagination($admin_id);
                $guest_mng["vehicle_wash_request7"] = $this->HotelAdminModel->get_vehicle_wash_completed_request_list_pagination($admin_id);
                $guest_mng["vehicle_wash_request2"] = $this->HotelAdminModel->get_vehicle_wash_charges_list_pagination($admin_id);
            } else if ($postArr['sub_section_id'] == "7") {

                $guest_mng["luggage_request"] = $this->HotelAdminModel->get_luggage_request_list_pagination($admin_id);
                $guest_mng["luggage_request1"] = $this->HotelAdminModel->get_luggage_accepted_request_list_pagination($admin_id);
                $guest_mng["luggage_request3"] = $this->HotelAdminModel->get_luggage_rejected_request_list_pagination($admin_id);
                $guest_mng["luggage_request4"] = $this->HotelAdminModel->get_luggage_completed_request_list_pagination($admin_id);
                $guest_mng["luggage_request2"] = $this->HotelAdminModel->get_luggage_charges_list_pagination($admin_id);
            } else if ($postArr['sub_section_id'] == "8") {
                $guest_mng["list"] = $this->HotelAdminModel->get_cab_service_pagination($admin_id);
                $guest_mng["list1"] = $this->HotelAdminModel->cab_service_accepted_pagination($admin_id);
                $guest_mng["list3"] = $this->HotelAdminModel->cab_service_completed_pagination($admin_id);
                $guest_mng["list2"] = $this->HotelAdminModel->cab_service_rejected_pagination($admin_id);
                $guest_mng["list4"] = $this->HotelAdminModel->cab_service_cancle_tab($admin_id);
            }
        }
        if ($postArr['data_id'] == "3") {
            if ($postArr['sub_section_id'] == "n1") {
                $service_name = 1;
                $guest_mng["today_hotel_book_list_by_app"] = $this->HotelAdminModel->get_user_pending_booking_list_from_app_pagination($admin_id);
                $guest_mng['today_hotel_book_list_by_app1'] = $this->HotelAdminModel->get_upcoming_list_from_app($admin_id);

                $guest_mng['list'] = $this->HotelAdminModel->get_user_pending_booking_list_from_app($admin_id);

                $guest_mng['room_type_list'] = $this->HotelAdminModel->get_room_type_list($admin_id);
            } else if ($postArr['sub_section_id'] == "n2") {
                $service_name = 2;
                $guest_mng["list"] = $this->HotelAdminModel->get_checkout_guest_list_pagination($admin_id);
            }
        }
        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }
    public function new_data_of_today_arrival_data()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $draw  = $this->input->post('draw');
        $row  = $this->input->post('start');
        $rowperpage  = $this->input->post('length');
        $search_array  = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';

        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        if ($this->session->userdata('userType') == 2) {
            $hotel_id = $get_hotel_id['u_id'];
        } else {
            $hotel_id = $get_hotel_id['hotel_id'];
        }

        $today_arrival_data_list = $this->HotelAdminModel->today_arrival_data_list($rowperpage, $row, $search, $hotel_id);
        // echo "<pre>";
        // print_r($new_Manage_Order_list);
        // exit;

        $total_today_arrival_data_list = $this->HotelAdminModel->total_today_arrival_data_list($search, $hotel_id);

        $totalRecords = $total_today_arrival_data_list->total_record;

        $data = array();
        $i = 1;
        foreach ($today_arrival_data_list as $val) {
            $action = '<button type="button" style="margin:auto" data-booking-id="' . $val['booking_id'] . '" data-book-room="' . $val['no_of_rooms'] . '" data-room-type="' . $val['room_type'] . '" class="btn btn-success shadow btn-xs room_assigne_btn"><i class="fa fa-check"></i></button>';

            $data[] = array(
                "sr_no"            =>    $row + $i++,
                "Booking_id"    =>  $val['booking_id'],
                "Name"          =>  $val['full_name'],
                "date_C_In"     =>  date('d-m-Y',strtotime($val['check_in'])),
                "date_C_Out"    => date('d-m-Y',strtotime($val['check_out'])),
                "Phone"            =>  $val['mobile_no'],
                "Email"            =>  $val['email_id'],
                "rooms"            =>  $val['no_of_rooms'],
                "Adult"         =>  $val['total_adults'],
                "Child"         =>  $val['total_child'],
                "Assign_Room"   =>  $action,
            );
        }

        // Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );
        echo json_encode($response);
    }
    public function ajaxSubOrderIconView()
    {

        $postArr = $this->input->post();
        // print_r($postArr);
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $guest_mng['icon_id'] = $postArr['data_id'];
        $guest_mng['sub_section_icon_id'] = $postArr['sub_section_id'];
        $admin_id = $get_hotel_id['u_id'];
        $guest_mng['sub_icon_id'] = $postArr['sub_section_id'];
        if ($postArr['data_id'] == "1") {
            if ($postArr['sub_section_id'] == "1") {
                $order_status = 0;

                $user_type = 10;
                $guest_mng["list"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id, $order_status);

                $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
                $guest_mng["list1"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id, 1);
                $guest_mng["list2"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id, 2);
                $guest_mng["list3"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id, 3);
            }
            if ($postArr['sub_section_id'] == "2") {
                $order_status = 0;

                $user_type = 10;
                $guest_mng["list"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id, $order_status);

                $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);

                $guest_mng["list1"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id, 1);
                $guest_mng["list2"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id, 2);
                $guest_mng["list3"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id, 3);
            }
        }

        $this->load->view('hoteladmin/ajaxSubOrderIconView', $guest_mng);
    }
    public function ajaxSubOrderIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['sub_icon_id'] = 1;
        $order_status = 0;
        $user_type = 10;
        $guest_mng["list"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id, $order_status);
        $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
        $guest_mng["list1"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id, 1);
        $guest_mng["list2"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id, 2);
        $guest_mng["list3"] = $this->HotelAdminModel->get_room_service_services_order_pagination($admin_id, 3);

        $this->load->view('hoteladmin/ajaxSubOrderIconView', $guest_mng);
    }
    public function ajaxSubOrderIconView_v2()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['sub_icon_id'] = 2;
        $order_status = 0;
        $user_type = 10;
        $guest_mng["list"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id, $order_status);
        $guest_mng['staff_list'] = $this->HotelAdminModel->get_particular_hotel_staff_list($admin_id, $user_type);
        $guest_mng["list1"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id, 1);
        $guest_mng["list2"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id, 2);
        $guest_mng["list3"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id, 3);

        $this->load->view('hoteladmin/ajaxSubOrderIconView', $guest_mng);
    }
    public function assign_room_serv_menu_order_to_staff()
    {
        $room_service_menu_order_id = $this->input->post('room_service_menu_order_id');
        $order_status = $this->input->post('order_status');
        // print_r($this->input->post());die;
        $rand_no = rand('1111', '9999');

        $wh = '(room_service_menu_order_id = "' . $room_service_menu_order_id . '")';

        $rs_m_order_data = $this->HotelAdminModel->getData('room_service_menu_orders', $wh);

        if ($order_status == 1) {
            $staff_id = $this->input->post('staff_id');
            $accept_date = date('Y-m-d');
            $reject_date = "";
            $otp = $rand_no;
        } else {
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

        $up = $this->HotelAdminModel->edit_data('room_service_menu_orders', $wh, $arr);
        $admin_id = $this->session->userdata('u_id');
        $guest_mng["list"] = $this->HotelAdminModel->get_room_service_menu_order_pagination($admin_id, 0);

        if ($up) {
            if ($order_status == 1) {
                $wh1 = '(room_service_unique_id = "' . $rs_m_order_data['room_service_unique_id'] . '")';

                $arr_rs = array(
                    'order_status' => $order_status,
                    'staff_id' => $staff_id,
                    'accept_date' => $accept_date,
                    'reject_date' => $reject_date,
                    'otp' => $otp,
                );

                $this->HotelAdminModel->edit_data('rmservice_services_orders', $wh1, $arr);

                // $this->session->set_flashdata('msg','Order Accepted successfully');
                // redirect(base_url('HoteladminController/order_management'));
                $this->load->view('hoteladmin/ajaxNewOrderView', $guest_mng);
            } else {
                echo 1;
            }
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/order_management'));
        }
    }
    public function ajaxSubIconBlockView3()
    {

        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $admin_id = $get_hotel_id['u_id'];
        $guest_mng['sub_icon_id'] = 8;

        $guest_mng["list"] = $this->HotelAdminModel->get_cab_service_pagination($admin_id);
        $guest_mng["list1"] = $this->HotelAdminModel->cab_service_accepted_pagination($admin_id);
        $guest_mng["list3"] = $this->HotelAdminModel->cab_service_completed_pagination($admin_id);
        $guest_mng["list2"] = $this->HotelAdminModel->cab_service_rejected_pagination($admin_id);
        $guest_mng["list4"] = $this->HotelAdminModel->cab_service_cancle_tab($admin_id);
        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }
    public function ajaxSubIconBlockView2()
    {

        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $admin_id = $get_hotel_id['u_id'];
        $guest_mng['sub_icon_id'] = 7;

        $guest_mng["luggage_request"] = $this->HotelAdminModel->get_luggage_request_list_pagination($admin_id);
        $guest_mng["luggage_request1"] = $this->HotelAdminModel->get_luggage_accepted_request_list_pagination($admin_id);
        $guest_mng["luggage_request3"] = $this->HotelAdminModel->get_luggage_rejected_request_list_pagination($admin_id);
        $guest_mng["luggage_request4"] = $this->HotelAdminModel->get_luggage_completed_request_list_pagination($admin_id);
        $guest_mng["luggage_request2"] = $this->HotelAdminModel->get_luggage_charges_list_pagination($admin_id);


        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }
    public function ajaxSubIconBlockView1()
    {

        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $admin_id = $get_hotel_id['u_id'];
        $guest_mng['sub_icon_id'] = 6;

        $guest_mng["vehicle_wash_request"] = $this->HotelAdminModel->get_vehicle_wash_request_list_pagination($admin_id);

        $guest_mng["vehicle_wash_request1"] = $this->HotelAdminModel->get_vehicle_wash_accepted_request_list_pagination($admin_id);
        $guest_mng["vehicle_wash_request3"] = $this->HotelAdminModel->get_vehicle_wash_rejected_request_list_pagination($admin_id);
        $guest_mng["vehicle_wash_request7"] = $this->HotelAdminModel->get_vehicle_wash_completed_request_list_pagination($admin_id);
        $guest_mng["vehicle_wash_request2"] = $this->HotelAdminModel->get_vehicle_wash_charges_list_pagination($admin_id);


        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }
    public function ajaxSubIconBlockView4()
    {

        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $admin_id = $get_hotel_id['u_id'];
        $guest_mng['sub_icon_id'] = 2;

        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
        $guest_mng["spa_request"] = $this->HotelAdminModel->get_spa_request_list_pagination($admin_id);
        $guest_mng["spa_request1"] = $this->HotelAdminModel->get_spa_accept_list_pagination($admin_id);
        $guest_mng["spa_request6"] = $this->HotelAdminModel->get_spa_complete_list_pagination($admin_id);
        $guest_mng["spa_request2"] = $this->HotelAdminModel->get_spa_reject_list_pagination($admin_id);

        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }



    public function edit_faq()
    {
        // print_r($this->input->post());die;
        $faq_id = $this->input->post('faq_id');
        //$hotel_id = $this->input->post('hotel_id');
        $question = $this->input->post('question');
        $answer = $this->input->post('answer');

        $wh = '(faq_id = "' . $faq_id . '")';

        $arr = array(
            'question' => $question,
            'answer' => $answer,
        );

        $up = $this->HotelAdminModel->edit_data('faq', $wh, $arr);

        if ($up) {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="' . $admin_id . '")';
            $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

            $admin_id = $get_hotel_id['u_id'];
            $guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);

            $this->load->view('hoteladmin/ajaxFaqList', $guest_mng);
        }
    }
    public function getFAQData()
    {
        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getlostdata($tbl = 'faq', $wh);
        echo json_encode($data);
    }
    public function getHKData()
    {
        $wh = $this->input->post('id');
        $data = $this->HotelAdminModel->getHSdata($tbl = 'house_keeping_orders', $wh);
        echo json_encode($data);
    }
    public function getFBData()
    {
        $wh = $this->input->post('id');
        $data = $this->HotelAdminModel->getFBdata($tbl = 'food_orders', $wh);
        echo json_encode($data);
    }
    public function getLaundryData()
    {
        $wh = $this->input->post('id');
        $data = $this->HotelAdminModel->getLaundrydata($tbl = 'cloth_orders', $wh);
        echo json_encode($data);
    }
    public function getStaffData()
    {
        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getstaffdata($tbl = 'rmservice_services_orders', $wh);
        echo json_encode($data);
    }
    public function getOTPData()
    {
        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getotpdata($tbl = 'visitor', $wh);
        echo json_encode($data);
    }
    public function getStaff1Data()
    {
        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getstaff1data($tbl = 'room_service_menu_orders', $wh);
        echo json_encode($data);
    }
    public function ajaxFoodBeverageIcon()
    {
        $postArr = $this->input->post();
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $guest_mng['icon_id'] = $postArr['data_id'];
        $admin_id = $get_hotel_id['u_id'];
        if ($postArr['data_id'] == 1) {
            $guest_mng["list"] = $this->HotelAdminModel->get_facility_list_pagination($admin_id);
        } else if ($postArr['data_id'] == 2) {
            $guest_mng["facility_list"] = $this->HotelAdminModel->get_facility_category_list_pagination($admin_id);
        } else if ($postArr['data_id'] == 3) {
            $guest_mng["list"] = $this->HotelAdminModel->get_menu_list_pagination($admin_id);
            $guest_mng['facility_list'] = $this->HotelAdminModel->get_food_facility($admin_id);
        } else if ($postArr['data_id'] == 4) {
            $request_status = 0;
            $request_status1 = 1;
            $request_status2 = 2;
            $guest_mng["list"] = $this->HotelAdminModel->get_reserve_table_pending_list_pagination($admin_id, $request_status);
            $guest_mng["list_accepted"] = $this->HotelAdminModel->get_reserve_table_list_pagination($admin_id, $request_status1);
            $guest_mng["list_rejected"] = $this->HotelAdminModel->get_reserve_table_list_pagination($admin_id, $request_status2);
        }
        
        $guest_mng["type"]  = !empty($postArr['type']) ? $postArr['type'] : '';
        
        $this->load->view('hoteladmin/ajaxFoodBeverageIcon', $guest_mng);
    }

    public function get_reserve_table_new_data()
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
        $columnName = '';
        foreach ($this->input->post('columns') as $col) {
            $columnName = $col['data'];
        }

        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $hotel_id = $get_hotel_id['u_id'];

        $get_new_reserve_tbl_data = $this->HotelAdminModel->get_new_reserve_tbl_data($rowperpage, $row, $search, $hotel_id);

        $total_new_reserve_tbl_data = $this->HotelAdminModel->total_new_reserve_tbl_data($search, $hotel_id);

        $totalRecords = $total_new_reserve_tbl_data->total_record;

        $data = array();
        $i = 1;
        foreach ($get_new_reserve_tbl_data as $val) {
            $time = date('h:i A', strtotime($val['request_time']));
            $Req_Date_Time = '<span> ' . date('d-m-Y', strtotime($val['request_date'])) . '/<sub>' . $time . '</sub></span>';

            $action = '<div><a href="javascript:void(0)" data-id="' . $val['reserve_table_id'] . '" class="btn badge-success btn-tbl-edit btn-xs acp_req"><i class="fa fa-check"></i></a>&nbsp;&nbsp;<a href="#" class="btn badge-danger shadow btn-xs rej_req" id="reject_ord" delete-id="' . $val['reserve_table_id'] . '"><i class="fa fa-close"></i></a></div>';
            // $action = '';

            $data[] = array(
                "sr_no"            =>    $row + $i++,
                "Req_Date_Time"    =>  $Req_Date_Time,
                "Reserve_Date"    =>  date('d-m-Y', strtotime($val['reserve_date'])),
                "Guest_Name"    =>  $val['full_name'],
                "Mobile_No"        =>  $val['mobile_no'],
                "No_of_people"    =>  $val['no_of_people'],
                "Action"        =>  $action,
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
    }

    public function get_reserve_table_accepted_data()
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
        $columnName = '';
        foreach ($this->input->post('columns') as $col) {
            $columnName = $col['data'];
        }

        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $hotel_id = $get_hotel_id['u_id'];

        $get_acceped_reserve_tbl_data = $this->HotelAdminModel->get_acceped_reserve_tbl_data($rowperpage, $row, $search, $hotel_id);

        $total_acceped_reserve_tbl_data = $this->HotelAdminModel->total_acceped_reserve_tbl_data($search, $hotel_id);

        $totalRecords = $total_acceped_reserve_tbl_data->total_record;

        $data = array();
        $i = 1;
        foreach ($get_acceped_reserve_tbl_data as $val) {
            $time = date('h:i A', strtotime($val['request_time']));
            $Req_Date_Time = '<span> ' . date('d-m-Y', strtotime($val['request_date'])) . '/<sub>' . $time . '</sub></span>';

            $action = '<div><a href="javascript:void(0)" data-id="' . $val['reserve_table_id'] . '" class="btn badge-success btn-tbl-edit btn-xs acp_req"><i class="fa fa-check"></i></a>&nbsp;&nbsp;<a href="#" class="btn badge-danger shadow btn-xs rej_req" id="reject_ord" delete-id="' . $val['reserve_table_id'] . '"><i class="fa fa-close"></i></a></div>';

            $Order_Status = '<div class="badge badge-success"> Accepted</div>';

            $data[] = array(
                "sr_no"            =>    $row + $i++,
                "Req_Date_Time"    =>  $Req_Date_Time,
                "Reserve_Date"    =>  date('d-m-Y', strtotime($val['reserve_date'])),
                "Guest_Name"    =>  $val['full_name'],
                "Mobile_No"        =>  $val['mobile_no'],
                "No_of_people"    =>  $val['no_of_people'],
                "Accepted_Date" =>  date('d-m-Y', strtotime($val['accept_date'])),
                "Order_Status"  =>  $Order_Status,
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
    }


    public function get_reserve_table_rejected_data()
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
        // $columnName ='';
        // foreach($this->input->post('columns') AS $col)
        // {
        //     $columnName = $col['data'];
        // }

        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $hotel_id = $get_hotel_id['u_id'];

        $get_new_reserve_tbl_data = $this->HotelAdminModel->get_rejected_reserve_tbl_data($rowperpage, $row, $search, $hotel_id);

        $total_new_reserve_tbl_data = $this->HotelAdminModel->total_rejected_reserve_tbl_data($search, $hotel_id);

        $totalRecords = $total_new_reserve_tbl_data->total_record;

        $data = array();
        $i = 1;
        foreach ($get_new_reserve_tbl_data as $val) {
            $time = date('h:i A', strtotime($val['request_time']));
            $Req_Date_Time = '<span> ' . date('d-m-Y', strtotime($val['request_date'])) . '/<sub>' . $time . '</sub></span>';

            $Order_Status = '<div class="badge badge-danger"> rejected</div>';

            $data[] = array(
                "sr_no"            =>    $row + $i++,
                "Req_Date_Time"    =>  $Req_Date_Time,
                "Reserve_Date"    =>  date('d-m-Y', strtotime($val['reserve_date'])),
                "Guest_Name"    =>  $val['full_name'],
                "Mobile_No"        =>  $val['mobile_no'],
                "No_of_people"    =>  $val['no_of_people'],
                "Rejected_Date" =>  date('d-m-Y', strtotime($val['reject_date'])),
                "Order_Status"  =>  $Order_Status,
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
    }

    public function delete_faq()
    {
        $faq_id = $this->input->post('id');

        $wh = '(faq_id = "' . $faq_id . '")';

        $del = $this->HotelAdminModel->delete_data('faq', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxFaqList', $guest_mng);
        } else {
            redirect(base_url());
        }
    }

    public function change_faq_status()
    {
        $status = $this->input->post('status');
        $faq_id = $this->input->post('id');

        $wh = '(faq_id = "' . $faq_id . '")';

        $arr = array(
            'is_active' => $status
        );

        $update = $this->HotelAdminModel->edit_data('faq', $wh, $arr);

        if ($update) {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="' . $admin_id . '")';
            $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

            $admin_id = $get_hotel_id['u_id'];
            $guest_mng["list"] = $this->HotelAdminModel->get_faq_pagination($admin_id);

            $this->load->view('hoteladmin/ajaxFaqList', $guest_mng);
        } else {
            echo "0";
        }
    }

    public function manage_handover()
    {
        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');

            $is_complete1 = 0;
            $handover["manager_pending_list"] = $this->HotelAdminModel->get_manager_handover_list_pagination($admin_id, $is_complete1);
            $handover["manager_complete_list1"] = $this->HotelAdminModel->get_manager_handover_completed_list_pagination($admin_id, 1);

            $this->load->view('include/header');
            $this->load->view('hoteladmin/manage_handover', $handover);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
    }



    public function order_complaints()
    {
        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');
            $complaint_status = 0;
            $complaint_mng["list"] = $this->HotelAdminModel->get_complaints_pagination($admin_id, $complaint_status);
            $complaint_mng["list1"] = $this->HotelAdminModel->get_close_complaints_pagination($admin_id, 1);
            // print_r( $complaint_mng["list1"]);die;
            $this->load->view('include/header');
            $this->load->view('hoteladmin/complaint_mng', $complaint_mng);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
    }
    public function other_complaints()
    {
        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');
            $complaint_status = 0;
            $complaint_mng["list"] = $this->HotelAdminModel->get_other_complaints_pagination($admin_id, $complaint_status);
            $complaint_mng["list1"] = $this->HotelAdminModel->get_close_other_complaints_pagination($admin_id, 1);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/other_complaint', $complaint_mng);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
    }
    public function staff_handover()
    {
        if ($this->session->userdata('u_id')) {
            $date = $this->input->post('date');
            $staff_id = $this->input->post('staff_id');
            $admin_id = $this->session->userdata('u_id');
            $today_date = date('Y-m-d');

            if(isset($_POST['search'])) 
            {
                $handover["staff_pending_list"] = $this->HotelAdminModel->get_staff_handover_pagination_search($admin_id,$date,$staff_id);
                $handover["staff_complete_list"] = $this->HotelAdminModel->get_staff_complete_handover_pagination_search($admin_id,$date,$staff_id);
                $this->load->view('include/header');
                $this->load->view('hoteladmin/staff_handover', $handover);
                $this->load->view('include/footer');
            }
            else
            {
                $handover["staff_pending_list"] = $this->HotelAdminModel->get_staff_handover_pagination($admin_id, 0,$today_date);
                $handover["staff_complete_list"] = $this->HotelAdminModel->get_staff_complete_handover_pagination($admin_id, 1);
                $this->load->view('include/header');
                $this->load->view('hoteladmin/staff_handover', $handover);
                $this->load->view('include/footer');
            }
          
        } else {
            redirect(base_url());
        }
    }
    public function buy_plan()
    {
        if ($this->session->userdata('u_id')) {
            $buy_plan['list'] = $this->HotelAdminModel->get_leads_plan();
            $this->load->view('include/header');
            $this->load->view('hoteladmin/buy_plan', $buy_plan);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
    }
    public function add_wallet_points()
    {
        $admin_id = $this->session->userdata('u_id');
        $amount = $this->input->post('amount');

        $admin_data = $this->HotelAdminModel->get_user_data($admin_id);
        $leads_data = $this->HotelAdminModel->get_leads_plan_1();


        if ($leads_data[0]['amount'] < $amount) {
            $arr =  array(
                'hotel_admin_id' => $admin_id,
                'amount' => $amount,
                'amount_status' => 1,
                'added_by' => 2
            );

            $add = $this->HotelAdminModel->insert_data('hotel_admin_wallet_history', $arr);

            if ($add) {
                $wh = '(u_id = "' . $admin_id . '")';

                $arr_w = array(
                    'wallet_points' => $admin_data['wallet_points'] + $amount
                );

                $this->HotelAdminModel->edit_data('register', $wh, $arr_w);

                $this->session->set_flashdata('msg', 'Added Wallet Amount Successfully...');
                redirect(base_url('HoteladminController/buy_plan'));
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/buy_plan'));
            }
        } else {
            $this->session->set_flashdata('msg', 'Enter valid amount');
            redirect(base_url('HoteladminController/buy_plan'));
        }
    }

    public function purchase_leads()
    {
        $admin_id = $this->uri->segment(3);
        $leads_plan_id = $this->uri->segment(4);
        $amount = $this->uri->segment(5);

        $admin_data = $this->HotelAdminModel->get_user_data($admin_id);

        $arr =  array(
            'leads_plan_id' => $leads_plan_id,
            'hotel_id' => $admin_id,
            'purchase_price' => $amount,
        );

        $add = $this->HotelAdminModel->insert_data('admin_purchase_leads', $arr);

        if ($add) {
            $wh = '(u_id = "' . $admin_id . '")';

            $arr_w = array(
                'wallet_points' => $admin_data['wallet_points'] + $amount
            );

            $this->HotelAdminModel->edit_data('register', $wh, $arr_w);

            $this->session->set_flashdata('msg', 'leads purchased Successfully...');
            redirect(base_url('HoteladminController/buy_plan'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/buy_plan'));
        }
    }

    public function add_hotel_privacy_policy()
    {
        $admin_id = $this->session->userdata('u_id');

        $content = $this->input->post('content');

        $wh = '(added_by_u_id = "' . $admin_id . '" AND added_by = 1)';

        $hotel_privacy_policy = $this->HotelAdminModel->get_hotel_privacy_policy($admin_id);

        $up = "";
        $add = "";

        if ($hotel_privacy_policy) {
            $arr = array(
                'content' => $content,
                'privacy_policy_for' => 1,
                'added_by' => 1,
                'added_by_u_id' => $admin_id,
            );

            $up = $this->HotelAdminModel->edit_data('privacy_policy', $wh, $arr);
        } else {
            $arr1 = array(
                'content' => $content,
                'privacy_policy_for' => 1,
                'added_by' => 1,
                'added_by_u_id' => $admin_id,
            );

            $add = $this->HotelAdminModel->insert_data('privacy_policy', $arr1);
        }

        if ($up || $add) {


            $guest_mng["data"] = $this->HotelAdminModel->get_hotel_privacy_policy($admin_id);
            $this->load->view('hoteladmin/ajaxPrivacyPolicyList', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('privacy'));
        }
    }


    //fetch rooms nos //archana //21-11-2022 
    public function get_room_nos_list()
    {
        $room_type = $this->input->post('room_type');

        $admin_id = $this->session->userdata('u_id');

        $room_no_data = $this->HotelAdminModel->get_room_nos($admin_id, $room_type);

        $output = '<option>--choose Room No--</option>';


        foreach ($room_no_data as $rn) {
            $available_rm = $this->HotelAdminModel->get_available_room_no($admin_id, $rn['room_no']);

            if ($available_rm) {
                $output .= '<option value="' . $rn['room_no'] . '">' . $rn['room_no'] . '</option>';
            }
        }

        echo $output;
    }

    public function guest_history()
    {

        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');
            $postArray = $this->input->post();
            // print_r($this->uri->segment(3));die;
            $booking_id = $this->uri->segment(3);
            $u_id = $this->uri->segment(4);

            // print_r($u_id);die;
            $guest_history['booking_history'] = $this->HotelAdminModel->get_user_booking_history($admin_id, $u_id);
            // echo "<pre>";
            // print_r($guest_history['booking_history']);die;

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
            $guest_history['booking_details'] = $this->HotelAdminModel->get_user_booking_details($admin_id, $booking_id);
                // echo "<pre>";
                // print_r($guest_history['booking_details']);die;
            $guest_history['room_number'] = $this->HotelAdminModel->get_booking_room_details($booking_id);

            $this->load->view('include/header');
            $this->load->view('hoteladmin/viewGuestHistory', $guest_history);
            $this->load->view('include/footer');
        } else {
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

        if ($admin_wallet_points < 0  || $admin_wallet_points == 0) {
            //$this->session->set_flashdata('msg','Your Wallet Amount is Less');
            $tb_blocks['success'] = 0;
            $tb_blocks['message'] = "Your Wallet Amount is Less";
            echo json_encode($tb_blocks, JSON_UNESCAPED_SLASHES);
            die;
        } else {
            $wh = '(hotel_enquiry_request_id = "' . $hotel_enquiry_request_id . '")';

            $arr = array(
                'request_status' => 1,
                'accept_date' => date('Y-m-d'),
                'room_charges' => $room_charges,
                'service_tax' => $service_tax,
                'luxury_tax' => $luxury_tax,
                'request_accept_by' => 1,
                'request_accept_by_u_id' => $admin_id,
            );

            $up = $this->HotelAdminModel->edit_data('hotel_enquiry_request', $wh, $arr);

            if ($up) {
                $user_data = $this->HotelAdminModel->get_user_data($admin_id);
                //  echo '<pre>';print_r($user_data);exit;
                $city_id = $user_data['city'];

                $admin_wallet_points = $user_data['wallet_points'];

                $wh_1 = '(city = "' . $city_id . '")';

                $lead_recharge_data = $this->HotelAdminModel->getData('leads_recharge', $wh_1);
                if (!empty($lead_recharge_data)) {
                    $lead_percentage = $lead_recharge_data['lead_percentage'];

                    $cut_amount = $room_charges * ($lead_percentage / 100);

                    $current_wallet_amount = $admin_wallet_points - ($cut_amount);
                } else {
                    $current_wallet_amount = $user_data['wallet_points'];
                    $cut_amount = $room_charges;
                }


                $wh_u_id = '(u_id = "' . $admin_id . '")';

                $arr_u_id = array(
                    'wallet_points' => $current_wallet_amount,
                );

                $this->HotelAdminModel->edit_data('register', $wh_u_id, $arr_u_id);

                $arr_admin_history = array(
                    'hotel_admin_id' => $admin_id,
                    'amount' => $cut_amount,
                    'amount_status' => 2,
                );

                $this->HotelAdminModel->insert_data('hotel_admin_wallet_history', $arr_admin_history);

                //   $this->session->set_flashdata('msg','Request accepted Successfully');
                //   redirect(base_url('enquiry_request'));

                $tb_blocks['success'] = 1;
                $admin_id = $this->session->userdata('u_id');
                $wh_admin = '(u_id ="' . $admin_id . '")';
                $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

                $admin_id = $get_hotel_id['u_id'];
                $today_date = date('Y-m-d');
                $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id,$today_date);
                $tb_blocks['tb_block'] = $this->load->view('hoteladmin/ajaxEnquiryRequestList', $guest_mng);
                echo json_encode($tb_blocks, JSON_UNESCAPED_SLASHES);
                die;
            } else {
                //   $this->session->set_flashdata('msg','Something went wrong');
                //   redirect(base_url('enquiry_request'));
                $tb_blocks['success'] = 0;
                $tb_blocks['message'] = "Something went wrong";
                echo json_encode($tb_blocks, JSON_UNESCAPED_SLASHES);
                die;
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
        $user_id = $this->input->post('u_id');
        $wh = '(u_id ="'.$admin_id.'")';    
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
        $hotel_name = $get_hotel_name['hotel_name'];

        $admin_wallet_points = $user_data['wallet_points'];

        if ($admin_wallet_points < 0  || $admin_wallet_points == 0) {
            $this->session->set_flashdata('msg', 'Your Wallet Amount is Less');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {

            $wh = '(hotel_enquiry_request_id = "' . $hotel_enquiry_request_id . '")';

            $arr = array(
                'request_status' => 1,
                'accept_date' => date('Y-m-d'),
                'room_charges' => $room_charges,
                'service_tax' => $service_tax,
                'luxury_tax' => $luxury_tax,
                'request_accept_by' => 1,
                'request_accept_by_u_id' => $admin_id,
            );

            $up = $this->HotelAdminModel->edit_data('hotel_enquiry_request', $wh, $arr);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'hotel_enquiry_request', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title = "";

                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Enquiry Request Is Accepted';
                    $body = 'Your Hotel Enquiry ID is "'.$hotel_enquiry_request_id.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                $subject = $title;
                $description = "$title In $hotel_name And Hotel Enquiry ID Is $hotel_enquiry_request_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $user_id,
                                     'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
        //  print_r($arr_noti);die;
                 $this->MainModel->insert_data('user_notification',$arr_noti);
               
                // print_r($body);die;

                $user_data = $this->MainModel->get_user_data($admin_id);

                $city_id = $user_data['city'];

                $admin_wallet_points = $user_data['wallet_points'];

                $wh_1 = '(city = "' . $city_id . '")';

                $lead_recharge_data = $this->MainModel->getData('leads_recharge', $wh_1);
                // print_r($lead_recharge_data);die;

                if (!empty($lead_recharge_data)) {
                    $lead_percentage = $lead_recharge_data['lead_percentage'];

                    $cut_amount = $room_charges * ($lead_percentage / 100);

                    $current_wallet_amount = $admin_wallet_points - ($cut_amount);
                } else {
                    $cut_amount = $room_charges;

                    $current_wallet_amount = $admin_wallet_points - ($cut_amount);
                }

                $wh_u_id = '(u_id = "' . $admin_id . '")';

                $arr_u_id = array(
                    'wallet_points' => $current_wallet_amount,
                );

                $this->HotelAdminModel->edit_data('register', $wh_u_id, $arr_u_id);

                $arr_admin_history = array(
                    'hotel_admin_id' => $admin_id,
                    'amount' => $cut_amount,
                    'amount_status' => 2,
                );

                $this->HotelAdminModel->insert_data('hotel_admin_wallet_history', $arr_admin_history);

                $this->session->set_flashdata('msg', 'Request accepted Successfully');
                redirect(base_url('HoteladminController/frontOfficeList'));
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
    }
    public function request_accept()
    {
        // $request_status = $this->input->post('request_status');

        $admin_id = $this->session->userdata('u_id');

        $vehicle_wash_request_id = $this->uri->segment(3);

        $wh = '(vehicle_wash_request_id = "' . $vehicle_wash_request_id . '")';

        $arr = array(
            'request_status' => 1,
            'accept_date' => date('Y-m-d'),
            'assign_by' => 1,
            'assign_by_u_id' => $admin_id,
        );

        $up = $this->HotelAdminModel->edit_data('vehicle_wash_request', $wh, $arr);

        if ($up) {
            $get_u_id = $this->MainModel->getData($tbl = 'vehicle_wash_request', $wh);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Vehicle Wash Request Is Accepted';
                $body = 'Your Vehicle Wash Request ID is "'.$vehicle_wash_request_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }

            
            // print_r($result);die;

            $this->session->set_flashdata('msg', 'Request accepted successfully');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }
    public function request_reject()
    {
        $admin_id = $this->session->userdata('u_id');

        $vehicle_wash_request_id = $this->uri->segment(3);

        $wh = '(vehicle_wash_request_id = "' . $vehicle_wash_request_id . '")';

        $arr = array(
            'request_status' => 2,
            'assign_by' => 1,
            'assign_by_u_id' => $admin_id,
        );

        $up = $this->HotelAdminModel->edit_data('vehicle_wash_request', $wh, $arr);

        if ($up) {
            $get_u_id = $this->MainModel->getData($tbl = 'vehicle_wash_request', $wh);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);

            $deviceToken = $get_dt['token'];
            $title = 'Vehicle Wash Request Is Rejected';
            $body = array(
                'vehicle_wash_request_id' => $vehicle_wash_request_id,
            );
            $result = send_push_notification($deviceToken, $title, $body);
            // print_r($result);die;

            $this->session->set_flashdata('msg', 'Request rejected successfully');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }

    public function add_vehicle_washing_charges()
    {
        $vehicle_type = $this->input->post('vehicle_type');
        $charges = $this->input->post('charges');

        $admin_id = $this->session->userdata('u_id');

        $wh = '(vehicle_type = "' . $vehicle_type . '" AND hotel_id = "' . $admin_id . '")';

        $vehicle_washing_charges_data = $this->HotelAdminModel->getData('vehicle_washing_charges', $wh);

        if ($vehicle_washing_charges_data) {
           echo 1;
        } else {
            $arr = array(
                'hotel_id' => $admin_id,
                'vehicle_type' => $vehicle_type,
                'charges' => $charges,
                'added_by' => 1,
                'added_by_u_id' => $admin_id,
            );

            $add = $this->HotelAdminModel->insert_data('vehicle_washing_charges', $arr);

            if ($add) {
                $guest_mng["vehicle_wash_request2"] = $this->HotelAdminModel->get_vehicle_wash_charges_list_pagination($admin_id);
                $this->load->view('hoteladmin/ajaxcarwashcharges', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
    }
    public function getEditchargesData()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($wh);die;
        //    print_r($this->input->post(''));
        $wh = '(vehicle_washing_charge_id ="' . $where . '")';
        $data = $this->MainModel->getSingleData($tbl = 'vehicle_washing_charges', $wh);

        // print_r($data);die;

        echo json_encode($data);
    }
    public function edit_vehicle_washing_charges()
    {   
        // echo "hi";die;
        $vehicle_type = $this->input->post('vehicle_type');
        $charges = $this->input->post('charges');

        $vehicle_washing_charge_id = $this->input->post('vehicle_washing_charge_id');

        $wh = '(vehicle_washing_charge_id = "' . $vehicle_washing_charge_id . '")';

        $arr = array(
            'vehicle_type' => $vehicle_type,
            'charges' => $charges,
        );

        $up = $this->HotelAdminModel->edit_data('vehicle_washing_charges', $wh, $arr);
        if ($up) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["vehicle_wash_request2"] = $this->HotelAdminModel->get_vehicle_wash_charges_list_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxcarwashcharges', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }

    public function delete_vehicle_washing_charges()
    {
        $vehicle_washing_charge_id = $this->input->post('id');

        $wh = '(vehicle_washing_charge_id = "' . $vehicle_washing_charge_id . '")';

        $del = $this->HotelAdminModel->delete_data('vehicle_washing_charges', $wh);

        if ($del) {
            $admin_id = $this->session->userdata('u_id');
            $guest_mng["vehicle_wash_request2"] = $this->HotelAdminModel->get_vehicle_wash_charges_list_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxcarwashcharges', $guest_mng);
        } else {
            echo "0";
        }
    }

    public function add_hotel_guidelines()
    {
        $admin_id = $this->session->userdata('u_id');

        $content = $this->input->post('content');

        $wh = '(hotel_id = "' . $admin_id . '")';

        $hotel_guidelines_data = $this->HotelAdminModel->getData('hotel_guidelines', $wh);

        $up = "";
        $add = "";

        if ($hotel_guidelines_data) {
            $arr_up = array(
                'content' => $content,
            );

            $up = $this->HotelAdminModel->edit_data('hotel_guidelines', $wh, $arr_up);
        } else {
            $arr_add =  array(
                'hotel_id' => $admin_id,
                'content' => $content,
                'added_by' => 1,
                'added_by_u_id' => $admin_id,
            );

            $add = $this->HotelAdminModel->insert_data('hotel_guidelines', $arr_add);
        }

        if ($add || $up) {
            $this->session->set_flashdata('msg', 'Data added Successfully..');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }
    // code by vivek
    public function getListOfNearPlaces()
    {
        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getnearplacesdata($tbl = 'hotel_near_by_place', $wh);
        $were = '(hotel_near_by_place_id = "' . $wh . '")';
        $data['hotel_near_by_place_images'] = $this->HotelAdminModel->getAllData('hotel_near_by_place_images', $were);
        // echo "<pre>";print_r($data);exit;
        echo json_encode($data);
    }
    public function getEditDataofbanquet()
    {
        $wh = $this->input->post('id');

        $data['list'] = $this->HotelAdminModel->getdataforeditofbanquet($wh);

        $wh1 = '(banquet_hall_id = "' . $data['list']['banquet_hall_id'] . '")';

        $data['banquet_hall_images'] = $this->MainModel->getAllData('banquet_hall_images', $wh1);
        // echo "<pre>";print_r($data['banquet_hall_images']);exit;

        echo json_encode($data);
    }
    public function getofferdata()
    {

        $wh = $this->input->post('id');
        $data = $this->HotelAdminModel->getdataforeditofoffer($wh);
        echo json_encode($data);
    }
    public function getEditdata_NearByHelp()
    {

        $wh = $this->input->post('id');
        $data['list'] = $this->HotelAdminModel->getdataforeditonearbyhotel($wh);

        $wh = '(hotel_near_by_help_id = "' . $data['list']['hotel_near_by_help_id'] . '")';

        $data['hotel_near_by_help_images'] = $this->MainModel->getAllData('hotel_near_by_help_images', $wh);
        // echo "<pre>";print_r($data);die;
        echo json_encode($data);
    }
    public function getEditDataofcloth()
    {


        $where = $this->input->post('id');
        // print_r($where);die;
        $wh = '(cloth_id ="' . $where . '")';
        $data = $this->MainModel->getSingleData($tbl = 'cloth', $wh);
        // print_r($data);exit;
        echo json_encode($data);
    }
    public function getEditDataofservice()
    {


        $where = $this->input->post('id');
        // print_r($where);die;
        $wh = '(h_k_services_id ="' . $where . '")';
        $data = $this->MainModel->getSingleData($tbl = 'house_keeping_services', $wh);
        // print_r($data);exit;
        echo json_encode($data);
    }
    public function getEditDataofFrontEnquiry()
    {


        $where = $this->input->post('id');
        // print_r($where);die;
        $wh = '(hotel_enquiry_request_id ="' . $where . '")';
        $data = $this->MainModel->getSingleData($tbl = 'hotel_enquiry_request', $wh);
        $wh_room_type = '(room_type_id = "' . $data['room_type'] . '" AND hotel_id="' . $data['hotel_id'] . '" )';
        $data['room_type_exist'] = $this->HotelAdminModel->getData('room_type', $wh_room_type);
        // print_r($data);exit;
        echo json_encode($data);
    }
    public function ajaxclothforpagination()
    {

        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 1;
        $guest_mng["list"] = $this->HotelAdminModel->get_cloth_list_pagination($admin_id);
        $guest_mng['laundry_time'] = $this->HotelAdminModel->get_laundry_time($admin_id);
        $this->load->view('hoteladmin/ajaxHousekeepingIcon', $guest_mng);
    }
    public function ajaxserviceforpagination()
    {

        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 2;
        $guest_mng["list"] = $this->HotelAdminModel->get_housekeeping_services_list_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxHousekeepingIcon', $guest_mng);
    }
    public function ajaxfrontenquiryrecall()
    {
        $admin_id = $this->session->userdata('u_id');
        $today_date = date('Y-m-d');
        $guest_mng['icon_id'] = 1;
        $guest_mng["list"] = $this->HotelAdminModel->get_hotel_enquiry_request_pagination($admin_id,$today_date);
        $guest_mng["list1"] = $this->HotelAdminModel->get_hotel_enquiry_accepted_request_pagination($admin_id);
        $guest_mng["list2"] = $this->HotelAdminModel->get_hotel_enquiry_rejected_request_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
    }
    public function all_notification()
    {
        if ($this->session->userdata('u_id')) {
            // $u_id= $this->session->userdata('u_id');
            // $where ='(u_id = "'.$u_id.'")';
            // $admin_details = $this->MainModel->getData($tbl ='register', $where);
			$today_date = date('Y-m-d');

            $admin_id = $this->session->userdata('u_id');

            $all_notification['see_all_notification'] = $this->FrontofficeModel->see_all_notification($admin_id,$today_date);
            $all_notification['all_hotel_notis_from_SA'] = $this->FrontofficeModel->all_hotel_notic_from_superadmin($today_date);
            $all_notification['specific_hotel_notis_from_SA'] = $this->FrontofficeModel->specific_hotel_notis_from_SA($admin_id,$today_date);

            // $admin_id = $this->session->userdata('u_id');
            // $all_notification['get_front_ofs_notifications'] = $this->HotelAdminModel->get_notifications_for_front_ofs_1($admin_id);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/all_notification', $all_notification);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
    }
    public function roomServDashNotification()
    {
        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');
            $all_room_notification['get_rs_notifications'] = $this->HotelAdminModel->get_notifications_for_rs_1($admin_id);
            // echo "<pre>";print_r($all_room_notification);die;
            $this->load->view('include/header');
            $this->load->view('hoteladmin/all_room_notification', $all_room_notification);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
    }
    public function HouseKeepingDashNotification()
    {
        if ($this->session->userdata('u_id')) {
            $admin_id = $this->session->userdata('u_id');
			$today_date = date('Y-m-d');
            $h_notification['get_hk_notifications'] = $this->HotelAdminModel->get_notifications_for_housekeeping_1($admin_id,$today_date);
            $this->load->view('include/header');
            $this->load->view('hoteladmin/housekeeping_notification', $h_notification);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
    }
    public function foodDashNotification()
    {
        $this->load->view('include/header');
        $this->load->view('hoteladmin/restaurant_notification');
        $this->load->view('include/footer');
    }

    public function getEditRoomTypeData()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($wh);die;
        //    print_r($this->input->post(''));
        $wh = '(room_type_id ="' . $where . '")';
        $data = $this->MainModel->getSingleData($tbl = 'room_type', $wh);
        // print_r($data);die;

        echo json_encode($data);
    }
    public function getEditBusinessCenterData()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($wh);die;
        $wh = '(business_center_id ="' . $where . '")';
        $data = $this->MainModel->getSingleData($tbl = 'business_center', $wh);

        $wh1 = '(business_center_id = "' . $where . '")';

        $data['business_center_facility'] = $this->HotelAdminModel->getAllData('business_center_facility', $wh1);
        $data['business_center_imgs'] = $this->HotelAdminModel->getAllData('business_center_images', $wh1);

        // print_r($data);die;

        echo json_encode($data);
    }
    public function getEditRoomConfigData()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($wh);die;
        // $room_type = 1;
        // $guest_mng['floor_list'] = $this->HotelAdminModel->get_floor_list($admin_id);

        // $guest_mng['room_type'] = $this->HotelAdminModel->get_room_type_list1($admin_id);
        // $guest_mng['room_type_data'] = $this->HotelAdminModel->get_room_type_data($admin_id);
        // $guest_mng['list'] = $this->HotelAdminModel->get_room_related_data($admin_id,$room_type);
        // $guest_mng['floor_list1'] = $this->HotelAdminModel->get_floor_list($admin_id);

        $wh = '(room_configure_id ="' . $where . '")';
        $data = $this->MainModel->getSingleData($tbl = 'room_configure', $wh);
        $data['room_number'] = $this->HotelAdminModel->get_room_numbers($admin_id, $where);
        $data['room_facility'] = $this->HotelAdminModel->get_room_facility($admin_id, $where);
        $data['room_imgs'] = $this->HotelAdminModel->get_room_imgs($admin_id, $where);
        $whf = '(floor_id ="' . $data['floor_id'] . '")';
        $data['floor'] = $this->MainModel->getSingleData($tbl = 'floors', $whf);
        $whrt = '(room_type_id ="' . $data['room_type'] . '")';
        $data['room_name'] = $this->MainModel->getSingleData($tbl = 'room_type', $whrt);



        //    echo "<pre>"; print_r($data);die;

        echo json_encode($data);
    }

    public function add_carwash_request()
    {

        $admin_id = $this->session->userdata('u_id');
        // $where ='(u_id = "'.$u_id.'")';
        // $admin_details = $this->HotelAdminModel->getData($tbl ='register', $where);
        // $admin_id = $admin_details['u_id'];

        // print_r($_FILES['image']['name']);exit;
        $mobile_no = $this->input->post('mobile_no');
        $booking_id = $this->input->post('booking_id');
        $vehicle_name = $this->input->post('vehicle_name');
        $vehicle_number = $this->input->post('vehicle_no');
        $vehicle_img = $_FILES['image']['name'];
        $request_date = $this->input->post('request_date');
        $request_time = $this->input->post('request_time');
        $additional_note = $this->input->post('additional_note');
        $vehicle_washing_charge_id = $this->input->post('vehicle_washing_charge_id');
        $where = '(mobile_no = "' . $mobile_no . '")';
        $admin_details = $this->HotelAdminModel->getData($tbl = 'register', $where);


        $wh = '(vehicle_washing_charge_id = "' . $vehicle_washing_charge_id . '")';

        $vehicle_washing_charges = $this->HotelAdminModel->getData('vehicle_washing_charges', $wh, $admin_details);

        $charges = "";

        if ($vehicle_washing_charges) {
            $charges = $vehicle_washing_charges['charges'];
        }

        $vehicle_img = "";

        if (!empty($_FILES['image']['name'])) {
            $_FILES['my_file']['name'] = $_FILES['image']['name'];
            $_FILES['my_file']['type'] = $_FILES['image']['type'];
            $_FILES['my_file']['size'] = $_FILES['image']['size'];
            $_FILES['my_file']['error'] = $_FILES['image']['error'];
            $_FILES['my_file']['tmp_name'] = $_FILES['image']['tmp_name'];

            $path = 'assets/upload/car_wash_vehicles_img/';
            $upload_path = './' . $path;
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $upload_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_file')) {
                $file_data = $this->upload->data();

                $vehicle_img = base_url() . $path . $file_data['file_name'];
            }
        }
        // print_r($vehicle_img);exit;
        $arr = array(
            'hotel_id' => $admin_id,
            'booking_id' => $booking_id,
            'u_id' => $admin_details['u_id'],
            'vehicle_washing_charge_id' => $vehicle_washing_charge_id,
            'vehicle_name' => $vehicle_name,
            'vehicle_no' => $vehicle_number,
            'vehicle_img' => $vehicle_img,
            'charges' => $charges,
            'note' => $additional_note,
            'select_date' => $request_date,
            'select_time' => $request_time,
            'note' => $additional_note,
            'request_date' => date('Y-m-d'),
        );
        $up = $this->HotelAdminModel->insert_data('vehicle_wash_request', $arr);
        if ($up) {

            $u_id = $this->session->userdata('u_id');
            $where = '(u_id = "' . $u_id . '")';
            $admin_details = $this->HotelAdminModel->getData($tbl = 'register', $where);
            $admin_id = $admin_details['u_id'];

            $guest_mng["vehicle_wash_request"] = $this->HotelAdminModel->get_vehicle_wash_request_list_pagination($admin_id);
            //  $this->session->set_flashdata('msg','Data Updated Successfully');
            $this->load->view('hoteladmin/ajaxcarwashrequest', $guest_mng);
        }
    }
    public function add_booking_id()
    {
        $mobile_no = $this->input->post('mobile_no');
        $wh = '(mobile_no = "' . $mobile_no . '")';
        //  print_r($wh);exit;
        $register =  $this->HotelAdminModel->getData('register', $wh);
        $wh1 = '(u_id = "' . $register['u_id'] . '" AND is_guest = 1)';
        $guest_user =  $this->HotelAdminModel->getData1('guest_user', $wh1);
        //  print_r($guest_user);exit;
        $output = '';
        $output .= $guest_user['booking_id'];

        echo $output;
    }
    public function add_cab_request()
    {
        $admin_id = $this->session->userdata('u_id');
        // $where ='(u_id = "'.$u_id.'")';
        // $admin_details = $this->HotelAdminModel->getData($tbl ='register', $where);
        // $admin_id = $admin_details['u_id'];

        $booking_id = $this->input->post('booking_id');
        $mobile_no = $this->input->post('mobile_no');
        $total_passanger = $this->input->post('total_passanger');
        $vehicle_type = $this->input->post('vehicle_type');
        $destination = $this->input->post('destination');
        $select_date = $this->input->post('request_date');
        $select_time = $this->input->post('request_time');
        $additional_note = $this->input->post('additional_note');
        $where = '(mobile_no = "' . $mobile_no . '")';
        $admin_details = $this->HotelAdminModel->getData($tbl = 'register', $where);

        if ($admin_details) {
            $arr = array(
                'hotel_id' => $admin_id,
                // 'mobile_no' => $mobile_no,
                'booking_id' => $booking_id,
                'u_id' => $admin_details['u_id'],
                'total_passanger' => $total_passanger,
                'request_vehicle_type' => $vehicle_type,
                'select_date' => $select_date,
                'select_time' => $select_time,
                'destination_name' => $destination,
                'description' => $additional_note,
                'request_date' => date('Y-m-d'),
                'request_time' => date('H:i:s'),
            );

            $add = $this->HotelAdminModel->insert_data('cab_service_request_list', $arr);

            if ($add) {

                $u_id = $this->session->userdata('u_id');
                $where = '(u_id = "' . $u_id . '")';
                $admin_details = $this->HotelAdminModel->getData($tbl = 'register', $where);
                $admin_id = $admin_details['u_id'];

                $guest_mng["list"] = $this->HotelAdminModel->get_cab_service_pagination($admin_id);
                $guest_mng["list1"] = $this->HotelAdminModel->cab_service_accepted_pagination($admin_id);
                $guest_mng["list3"] = $this->HotelAdminModel->cab_service_completed_pagination($admin_id);
                $guest_mng["list2"] = $this->HotelAdminModel->cab_service_rejected_pagination($admin_id);
                $guest_mng["list4"] = $this->HotelAdminModel->cab_service_cancle_tab($admin_id);
                $this->load->view('hoteladmin/ajaxcabservice', $guest_mng);
            }
        }
    }

    public function add_luggage_request()
    {

        $admin_id = $this->session->userdata('u_id');
        // $where ='(u_id = "'.$u_id.'")';
        // $admin_details = $this->HotelAdminModel->getData($tbl ='register', $where);
        // $admin_id = $admin_details['u_id'];
        // print_r($admin_id);
        // die;
        // $guest_name = $this->input->post('guest_name');
        $mobile_no = $this->input->post('mobile_no');
        $booking_id = $this->input->post('booking_id');
        $luggage_type = $this->input->post('luggage_type');
        $quantity = $this->input->post('quantity');
        $request_date = $this->input->post('request_date');
        $request_time = $this->input->post('request_time');
        $additional_note = $this->input->post('additional_note');
        $where = '(mobile_no = "' . $mobile_no . '")';
        $admin_details = $this->HotelAdminModel->getData($tbl = 'register', $where);
        if ($admin_details) {
            $arr = array(
                //  'guest_name' => $guest_name,
                'mobile_no' => $mobile_no,
                'booking_id' => $booking_id,
                'u_id' => $admin_details['u_id'],
                'select_date' => $request_date,
                'select_time' => $request_time,
                'hotel_id' => $admin_id,
                'luggage_type' => $luggage_type,
                'quantity' => $quantity,
                'request_date' => date('Y-m-d'),
                'note' => $additional_note,
            );
            //  print_r($arr);exit;
            $up = $this->HotelAdminModel->insert_data('luggage_request', $arr);
            // print_r($up);exit;	
            if ($up) {

                $u_id = $this->session->userdata('u_id');
                $where = '(u_id = "' . $u_id . '")';
                $admin_details = $this->HotelAdminModel->getData($tbl = 'register', $where);
                $admin_id = $admin_details['u_id'];

                $guest_mng["luggage_request"] = $this->HotelAdminModel->get_luggage_request_list_pagination($admin_id);
                // print_r($guest_mng["luggage_request"]);exit;
                $guest_mng["luggage_request1"] = $this->HotelAdminModel->get_luggage_accepted_request_list_pagination($admin_id); // print_r($guest_mng["luggage_request"]);exit;
                $guest_mng["luggage_request4"] = $this->HotelAdminModel->get_luggage_completed_request_list_pagination($admin_id);
                $guest_mng["luggage_request2"] = $this->HotelAdminModel->get_luggage_rejected_request_list_pagination($admin_id);

                $this->load->view('hoteladmin/ajax_luggage_request', $guest_mng);
            }
        }
    }
    public function change_new_spa_status()
    {

        // echo "hii";die;
        // $a=$this->input->post();print_r($a);exit;
        $spa_service_request_id = $this->input->post('spa_service_request_id');
        $request_status = $this->input->post('request_status');
        $admin_id = $this->session->userdata('u_id');
        $reject_reason = $this->input->post('reject_reason');
        $user_id = $this->input->post('u_id');
        $wh = '(u_id ="'.$admin_id.'")';
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
        $hotel_name = $get_hotel_name['hotel_name'];
   
        
				
        $spa_request_id = $this->uri->segment(3);

        if ($request_status == 1) {
            $arr = array(
                'request_status' => $request_status,
                'accept_date' => date('Y-m-d'),
                'assign_by' => 1,
                'assign_by_u_id' => $admin_id,
            );
            $wh = '(spa_service_request_id = "' . $spa_service_request_id . '")';
            $up = $this->HotelAdminModel->edit_data('spa_service_request_list', $wh, $arr);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'spa_service_request_list', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title = "";
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Spa Request Is Accepted';
					$body = 'Your Spa Request ID is "'.$spa_service_request_id.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                
                // print_r($result);die;
                       $subject = $title;
						$description = "$title In $hotel_name And Your Spa Request Id Is $spa_service_request_id";
						$arr_noti = array(
											'hotel_id' => $admin_id,
											'u_id' => $user_id,
									 		'subject' => $subject,
											'description' => $description,
											'clear_flag' => 1,
											'count_flag' => 1,
										);
				//  print_r($arr_noti);die;
				 		$this->MainModel->insert_data('user_notification',$arr_noti);

                // $this->session->set_flashdata('msg','Request accepted successfully');
                $guest_mng["spa_request"] = $this->HotelAdminModel->get_spa_request_list_pagination($admin_id);

                $this->load->view('hoteladmin/ajaxnewsparequestadd', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        } elseif ($request_status == 2) {
            $arr1 = array(
                'request_status' => $request_status,
                'assign_by' => 1,
                'reject_reason' =>$reject_reason,
                'assign_by_u_id' => $admin_id,
            );
            $wh1 = '(spa_service_request_id = "' . $spa_service_request_id . '")';
            $up = $this->HotelAdminModel->edit_data('spa_service_request_list', $wh1, $arr1);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'spa_service_request_list', $wh1);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $reason ='';
                $title = "";

                if($reject_reason == 1)
                {
                    $reason = "Please Try After Sometime";
                }
                else if($reject_reason == 2)
                {
                    $reason = "Temporarily Unavailable";
                }
                else if($reject_reason == 3)
                {
                    $reason = "Slots Not Available";
                }
                else if($reject_reason == 4)
                {
                    $reason = "Please Contact Front Office";
                }
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Spa Request Is Rejected';
					$body = 'Your Spa Request ID is "'.$spa_service_request_id.'" And Your Request is Rejected Because OF "'.$reason.'" ';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                // print_r($result);die;
                $subject = $title;
                $description =  "$title In $hotel_name Because Of $reason And Your Spa Request Id Is $spa_service_request_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $user_id,
                                     'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
        //  print_r($arr_noti);die;
                 $this->MainModel->insert_data('user_notification',$arr_noti);


                //    $this->session->set_flashdata('msg','Request rejected successfully');
                $guest_mng["spa_request"] = $this->HotelAdminModel->get_spa_request_list_pagination($admin_id);

                $this->load->view('hoteladmin/ajaxnewsparequestadd', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
    }

    public function change_new_car_status()
    {

        // echo "hii";die;
        // $a=$this->input->post();
        $vehicle_wash_request_id = $this->input->post('vehicle_wash_request_id');
        $request_status = $this->input->post('request_status');
        $admin_id = $this->session->userdata('u_id');
        $reject_reason = $this->input->post('reject_reason');
        $user_id = $this->input->post('u_id');
        $wh = '(u_id ="'.$admin_id.'")';
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
        $hotel_name = $get_hotel_name['hotel_name'];
        // $vehicle_wash_request_id = $this->uri->segment(3);
        if ($request_status == 1) {
            $arr = array(
                'request_status' => $request_status,
                'accept_date' => date('Y-m-d'),
                'assign_by' => 1,
                'assign_by_u_id' => $admin_id,
            );
            $wh = '(vehicle_wash_request_id = "' . $vehicle_wash_request_id . '")';
            $up = $this->HotelAdminModel->edit_data('vehicle_wash_request', $wh, $arr);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'vehicle_wash_request', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title = '';
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Vehicle Wash Request Is Accepted';
                    $body = 'Your Vehicle Wash Request ID is "'.$vehicle_wash_request_id.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                $subject = $title;
                $description = "$title In $hotel_name And Your Vehicle Wash Request Id Is $vehicle_wash_request_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $user_id,
                                     'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
        //  print_r($arr_noti);die;
                 $this->MainModel->insert_data('user_notification',$arr_noti);
                // print_r($result);die;

                // $this->session->set_flashdata('msg','Request accepted successfully');
                $guest_mng["vehicle_wash_request"] = $this->HotelAdminModel->get_vehicle_wash_request_list_pagination($admin_id);

                $this->load->view('hoteladmin/ajaxcarwashrequest', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        } elseif ($request_status == 2) {
            $arr1 = array(
                'request_status' => $request_status,
                'reject_date' => date('Y-m-d'),
                'assign_by' => 1,
                'reject_reason' =>$reject_reason,
                'assign_by_u_id' => $admin_id,
            );
            $wh1 = '(vehicle_wash_request_id = "' . $vehicle_wash_request_id . '")';

            $up = $this->HotelAdminModel->edit_data('vehicle_wash_request', $wh1, $arr1);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'vehicle_wash_request', $wh1);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $reason ='';
                $title = "";

                if($reject_reason == 1)
                {
                    $reason = "Please Try After Sometime";
                }
                else if($reject_reason == 2)
                {
                    $reason = "Temporarily Unavailable";
                }
                else if($reject_reason == 3)
                {
                    $reason = "Vehicle Not Identified";
                }
                else if($reject_reason == 4)
                {
                    $reason = "Please Contact Front Office";
                }

                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Vehicle Wash Request Is Rejected';
                    $body = 'Your Vehicle Wash Request ID is "'.$vehicle_wash_request_id.'" And Your Request is Rejected Because OF "'.$reason.'" ';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                $subject = $title;
                $description = "$title In $hotel_name Because Of $reason And Your Vehicle Wash Request Id Is $vehicle_wash_request_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $user_id,
                                     'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
        //  print_r($arr_noti);die;
                 $this->MainModel->insert_data('user_notification',$arr_noti);
                // print_r($result);die;

                //    $this->session->set_flashdata('msg','Request rejected successfully');
                $guest_mng["vehicle_wash_request"] = $this->HotelAdminModel->get_vehicle_wash_request_list_pagination($admin_id);

                $this->load->view('hoteladmin/ajaxcarwashrequest', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
    }

    public function spa_request_accept()
    {
        // $request_status = $this->input->post('request_status');

        $admin_id = $this->session->userdata('u_id');

        $spa_request_id = $this->uri->segment(3);
        // print_r($spa_request_id);exit;
        $wh = '(spa_service_request_id = "' . $spa_request_id . '")';

        $arr = array(
            'request_status' => 1,
            'accept_date' => date('Y-m-d'),
            'assign_by' => 1,
            'assign_by_u_id' => $admin_id,
        );

        $up = $this->HotelAdminModel->edit_data('spa_service_request_list', $wh, $arr);

        if ($up) {
            $get_u_id = $this->MainModel->getData($tbl = 'spa_service_request_list', $wh);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';

            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);

            $deviceToken = $get_dt['token'];
            $title = 'Spa Request Is Accepted';
            $body = array(
                'spa_service_request_id' => $spa_request_id,
            );
            $result = send_push_notification($deviceToken, $title, $body);
            // print_r($result);die;

            $guest_mng["spa_request"] = $this->HotelAdminModel->get_spa_request_list_pagination($admin_id);

            $this->load->view('hoteladmin/ajaxnewsparequestadd', $guest_mng);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }

    public function spa_request_reject()
    {
        $admin_id = $this->session->userdata('u_id');

        $spa_request_id = $this->uri->segment(3);
        // print_r($spa_request_id);exit;
        $wh = '(spa_service_request_id = "' . $spa_request_id . '")';

        $arr = array(
            'request_status' => 2,
            'assign_by' => 1,
            'assign_by_u_id' => $admin_id,
        );

        $up = $this->HotelAdminModel->edit_data('spa_service_request_list', $wh, $arr);

        if ($up) {
            $get_u_id = $this->MainModel->getData($tbl = 'spa_service_request_list', $wh);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';

            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);

            $deviceToken = $get_dt['token'];
            $title = 'Spa Request Is Rejected';
            $body = array(
                'spa_service_request_id' => $spa_request_id,
            );
            $result = send_push_notification($deviceToken, $title, $body);
            // print_r($result);die;

            $this->session->set_flashdata('msg', 'Request rejected successfully');
            redirect(base_url('HoteladminController/frontOfficeList'));
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HoteladminController/frontOfficeList'));
        }
    }
    public function add_spa_request()
    {
        $admin_id = $this->session->userdata('u_id');
        // $where ='(u_id = "'.$u_id.'")';
        // $admin_details = $this->HotelAdminModel->getData($tbl ='register', $where);
        // $admin_id = $admin_details['u_id'];

        // $guest_name = $this->input->post('guest_name');
        $mobile_no = $this->input->post('mobile_no');
        $booking_id = $this->input->post('booking_id');
        $spa_type = $this->input->post('spa_type');
        $request_date = $this->input->post('request_date');
        $request_time = $this->input->post('request_time');
        $additional_note = $this->input->post('additional_note');
        $where = '(mobile_no = "' . $mobile_no . '")';
        $admin_details = $this->HotelAdminModel->getData($tbl = 'register', $where);

        if ($admin_details) {
            $arr = array(
                //  'guest_name' => $guest_name,
                'mobile_no' => $mobile_no,
                'booking_id' => $booking_id,
                'u_id' => $admin_details['u_id'],
                'select_date' => $request_date,
                'select_time' => $request_time,
                'hotel_id' => $admin_id,
                'spa_type' => $spa_type,
                'request_date' => date('Y-m-d'),
                'request_time' => date('H:i A', strtotime('now')),
                'note' => $additional_note,
            );
            //  print_r($arr);exit;
            $up = $this->HotelAdminModel->insert_data('spa_service_request_list', $arr);

            if ($up) {

                $u_id = $this->session->userdata('u_id');
                $where = '(u_id = "' . $u_id . '")';
                $admin_details = $this->HotelAdminModel->getData($tbl = 'register', $where);

                $admin_id = $admin_details['u_id'];
                $service_name = 1;
                $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
                $guest_mng["spa_request"] = $this->HotelAdminModel->get_spa_request_list_pagination($admin_id);
                $guest_mng["spa_request1"] = $this->HotelAdminModel->get_spa_accept_list_pagination($admin_id);
                $guest_mng["spa_request6"] = $this->HotelAdminModel->get_spa_complete_list_pagination($admin_id);
                $guest_mng["spa_request2"] = $this->HotelAdminModel->get_spa_reject_list_pagination($admin_id);

                $this->load->view('hoteladmin/ajaxviewsparequest', $guest_mng);
            }
        }
    }

    public function spa_status()
    {


        //         $a=$this->input->post();
        // print_r($a);die;
        $today_date = date('Y-m-d');
        $arr = array(
            'request_status' => $_POST['status'],
            'complete_date' => $today_date 
        );

        $spa_service_request_id = $_POST['uid'];
        $where = '(spa_service_request_id="' . $spa_service_request_id . '")';
        $id = $this->HotelAdminModel->editData($tbl = "spa_service_request_list", $where, $arr);
        $u_id=$_POST['useruid'];
        $admin_id = $this->session->userdata('u_id');
        $wh = '(u_id ="'.$admin_id.'")';
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
        $hotel_name = $get_hotel_name['hotel_name'];
        if ($id) {
            $get_u_id = $this->MainModel->getData($tbl = 'spa_service_request_list', $where);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            $title = '';
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Spa Request Is Completed';
                $body = 'Your Spa Request ID is "'.$spa_service_request_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }

           
            // print_r($result);die;
             // inside app notification
             $subject = $title;
            
             $description = "$title In $hotel_name And Your Spa Request Id Is $spa_service_request_id";
            
             $arr_noti = array(
                                 'hotel_id' => $admin_id,
                                 'u_id' => $u_id,
                                 'subject' => $subject,
                                 'description' => $description,
                                 'clear_flag' => 1,
                                 'count_flag' => 1,
                             );
// print_r($arr_noti);die;
             $this->MainModel->insert_data('user_notification',$arr_noti);
           

            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }

    public function ajaxspaIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['sub_icon_id'] = 2;
        $order_status = 0;
        $user_type = 9;
        $service_name = 2;
        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
        $guest_mng['room_type_list'] = $this->HotelAdminModel->get_room_type_list($admin_id);
        $guest_mng["spa_request"] = $this->HotelAdminModel->get_spa_request_list_pagination($admin_id);
        $guest_mng["spa_request1"] = $this->HotelAdminModel->get_spa_accept_list_pagination($admin_id);
        $guest_mng["spa_request6"] = $this->HotelAdminModel->get_spa_complete_list_pagination($admin_id);
        $guest_mng["spa_request2"] = $this->HotelAdminModel->get_spa_reject_list_pagination($admin_id);


        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }

    public function carwash_status()
    {


        //         $a=$this->input->post();
        // print_r($a);die;
        $today_date = date('Y-m-d');
        $arr = array(
            'request_status' => $_POST['status'],
            'complete_date' => $today_date 
        );

        $vehicle_wash_request_id = $_POST['uid'];
        $where = '(vehicle_wash_request_id="' . $vehicle_wash_request_id . '")';
        $id = $this->HotelAdminModel->editData($tbl = "vehicle_wash_request", $where, $arr);
        $u_id=$_POST['caruid'];
        $admin_id = $this->session->userdata('u_id');
        $wh = '(u_id ="'.$admin_id.'")';
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
        $hotel_name = $get_hotel_name['hotel_name'];
        if ($id) {
            $get_u_id = $this->MainModel->getData($tbl = 'vehicle_wash_request', $where);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            $title = '';
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Vehicle Wash Request Is Completed';
                $body = 'Your Vehicle Wash Request ID is "'.$vehicle_wash_request_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }

             // inside app notification
             $subject = $title;
            
             $description = "$title In $hotel_name And Your Vehicle Wash Request id is $vehicle_wash_request_id";
            
             $arr_noti = array(
                                 'hotel_id' => $admin_id,
                                 'u_id' => $u_id,
                                 'subject' => $subject,
                                 'description' => $description,
                                 'clear_flag' => 1,
                                 'count_flag' => 1,
                             );
// print_r($arr_noti);die;
             $this->MainModel->insert_data('user_notification',$arr_noti);
           
            // print_r($result);die;

            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }

    public function ajaxcarIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['sub_icon_id'] = 6;
        $order_status = 0;
        $user_type = 9;
        $guest_mng['room_type_list'] = $this->HotelAdminModel->get_room_type_list($admin_id);
        $guest_mng["vehicle_wash_request"] = $this->HotelAdminModel->get_vehicle_wash_request_list_pagination($admin_id);
        $guest_mng["vehicle_wash_request1"] = $this->HotelAdminModel->get_vehicle_wash_accepted_request_list_pagination($admin_id);
        $guest_mng["vehicle_wash_request3"] = $this->HotelAdminModel->get_vehicle_wash_rejected_request_list_pagination($admin_id);
        $guest_mng["vehicle_wash_request7"] = $this->HotelAdminModel->get_vehicle_wash_completed_request_list_pagination($admin_id);
        $guest_mng["vehicle_wash_request2"] = $this->HotelAdminModel->get_vehicle_wash_charges_list_pagination($admin_id);


        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }

    public function luggage_status()
    {


        //         $a=$this->input->post();
        // print_r($a);die;
        $today_date = date('Y-m-d');
        $arr = array(
            'request_status' => $_POST['status'],
            'complete_date' => $today_date
        );

        $luggage_request_id = $_POST['uid'];
        $where = '(luggage_request_id="' . $luggage_request_id . '")';
        $id = $this->HotelAdminModel->editData($tbl = "luggage_request", $where, $arr);
        $u_id=$_POST['luggageuid'];
        $admin_id = $this->session->userdata('u_id');
        $wh = '(u_id ="'.$admin_id.'")';
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
        $hotel_name = $get_hotel_name['hotel_name'];
        if ($id) {
            $get_u_id = $this->MainModel->getData($tbl = 'luggage_request', $where);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            $title = '';
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Luggage Return';
                $body = 'Your Luggage Request ID is "'.$luggage_request_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }

            // inside app notification
            $subject = $title;
            
            $description = "$title In $hotel_name And Your Luggage Request Id Is $luggage_request_id";
           
            $arr_noti = array(
                                'hotel_id' => $admin_id,
                                'u_id' => $u_id,
                                'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );
// print_r($arr_noti);die;
            $this->MainModel->insert_data('user_notification',$arr_noti);   
            // print_r($result);die;

            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }

    public function ajaxluggageIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['sub_icon_id'] = 7;
        $order_status = 0;
        $user_type = 9;
        $guest_mng['room_type_list'] = $this->HotelAdminModel->get_room_type_list($admin_id);
        $guest_mng["luggage_request"] = $this->HotelAdminModel->get_luggage_request_list_pagination($admin_id);
        $guest_mng["luggage_request1"] = $this->HotelAdminModel->get_luggage_accepted_request_list_pagination($admin_id);
        $guest_mng["luggage_request3"] = $this->HotelAdminModel->get_luggage_rejected_request_list_pagination($admin_id);
        $guest_mng["luggage_request4"] = $this->HotelAdminModel->get_luggage_completed_request_list_pagination($admin_id);
        $guest_mng["luggage_request2"] = $this->HotelAdminModel->get_luggage_charges_list_pagination($admin_id);

        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }

    public function cab_status()
    {
        $today_date = date('Y-m-d');
        $arr = array(
            'request_status' => $_POST['status'],
            'complete_date' => $today_date
        );

        $cab_service_request_id = $_POST['uid'];
        $where = '(cab_service_request_id="' . $cab_service_request_id . '")';
        $id = $this->HotelAdminModel->editData($tbl = "cab_service_request_list", $where, $arr);
        $u_id=$_POST['cabuid'];
        $admin_id = $this->session->userdata('u_id');
        $wh = '(u_id ="'.$admin_id.'")';
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
        $hotel_name = $get_hotel_name['hotel_name'];
        if ($id) {
            $get_u_id = $this->MainModel->getData($tbl = 'cab_service_request_list', $where);
            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
            $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
            $title = '';
            if(!empty($get_dt)){
                $deviceToken = $get_dt['token'];
                $title = 'Cab Service Request Is Completed';
                $body = 'Your Cab Service Request ID is "'.$cab_service_request_id.'"';
                $result = send_push_notification($deviceToken, $title, $body);
            }

            $subject = $title;
            
            $description = "$title In $hotel_name And Yoyr Cab Service Request id is $cab_service_request_id";
           
            $arr_noti = array(
                                'hotel_id' => $admin_id,
                                'u_id' => $u_id,
                                'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );
// print_r($arr_noti);die;
            $this->MainModel->insert_data('user_notification',$arr_noti);  

            

            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }

    public function ajaxcabIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['sub_icon_id'] = 8;
        $order_status = 0;
        $user_type = 9;

        $guest_mng['room_type_list'] = $this->HotelAdminModel->get_room_type_list($admin_id);
        $guest_mng["list"] = $this->HotelAdminModel->get_cab_service_pagination($admin_id);

        $guest_mng["list1"] = $this->HotelAdminModel->cab_service_accepted_pagination($admin_id);
        $guest_mng["list3"] = $this->HotelAdminModel->cab_service_completed_pagination($admin_id);
        $guest_mng["list2"] = $this->HotelAdminModel->cab_service_rejected_pagination($admin_id);
        $guest_mng["list4"] = $this->HotelAdminModel->cab_service_cancle_tab($admin_id);


        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }

    public function order_complaints_status()
    {
        $arr = array(
            'complaint_status' => $_POST['status']
        );

        $complaint_id = $_POST['uid'];
        $where = '(complaint_id="' . $complaint_id . '")';
        $id = $this->MainModel->editData($tbl = "order_complaints", $where, $arr);
        if ($id) {
            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }
    public function other_complaints_status()
    {
        $arr = array(
            'complaint_status' => $_POST['status']
        );

        $complaint_id = $_POST['uid'];
        $where = '(complaint_id="' . $complaint_id . '")';
        $id = $this->MainModel->editData($tbl = "other_complaints", $where, $arr);
        if ($id) {
            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }
    public function change_bus_req_status()
    {

        $b_c_reserve_id = $this->input->post('b_c_reserve_id');
        $request_status = $this->input->post('request_status');
        $reject_reason = $this->input->post('reject_reason');
        $admin_id = $this->session->userdata('u_id');

        if ($request_status == 1) {
            $arr = array(
                'request_status' => $request_status,
            );
            $where1 = '(b_c_reserve_id ="' . $b_c_reserve_id . '")';
            $add = $this->MainModel->edit_data($tbl = "business_center_reservation", $where1, $arr);
            if ($add) {
                $get_u_id = $this->MainModel->getData($tbl = 'business_center_reservation', $where1);
                // print_r($get_u_id)
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Business Center Request Is Accepted';
                    $body = 'Your Business Center Request ID is "'.$b_c_reserve_id.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                // print_r($result);die;

                $guest_mng["list"] = $this->HotelAdminModel->get_business_center_reservation_list_app($admin_id);
                $guest_mng['list1'] = $this->HotelAdminModel->get_business_center_list_pagination($admin_id);
                $guest_mng["list2"] = $this->HotelAdminModel->get_business_center_list_reject_pagination($admin_id);
                $guest_mng['business_center'] = $this->HotelAdminModel->get_active_business_center($admin_id);

                $this->load->view('hoteladmin/ajaxBusinessNewRequest', $guest_mng);
            } else {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url(''));
            }
        } elseif ($request_status == 2) {
            $arr1 = array(
                'request_status' => $request_status,
                'reject_reason' => $reject_reason,
            );
            $where = '(b_c_reserve_id ="' . $b_c_reserve_id . '")';
            $add = $this->MainModel->edit_data($tbl = "business_center_reservation", $where, $arr1);

            if ($add) {
                $get_u_id = $this->MainModel->getData($tbl = 'business_center_reservation', $where);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $rr = "";
                if ($get_u_id['reject_reason'] == 1) {
                    $rr = "Please Try After Sometime";
                } else if ($get_u_id['reject_reason'] == 2) {
                    $rr = "Temporarily unavailable";
                } else if ($get_u_id['reject_reason'] == 3) {
                    $rr = "Slots not available";
                } else if ($get_u_id['reject_reason'] == 4) {
                    $rr = "Please contact Front office";
                } else {
                    $rr = "";
                }
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Business Center Request Is Rejected';
                    $body = 'Your Business Center Request ID is "' . $b_c_reserve_id . '" And Your Request is Rejected Because OF "' . $rr . '"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

               

                $guest_mng["list"] = $this->HotelAdminModel->get_business_center_reservation_list_app($admin_id);
                $guest_mng['list1'] = $this->HotelAdminModel->get_business_center_list_pagination($admin_id);
                $guest_mng["list2"] = $this->HotelAdminModel->get_business_center_list_reject_pagination($admin_id);
                $guest_mng['business_center'] = $this->HotelAdminModel->get_active_business_center($admin_id);
                $this->load->view('hoteladmin/ajaxBusinessNewRequest', $guest_mng);
            } else {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url(''));
            }
        }
    }
    public function getbusreqdataid()
    {
        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getregdata($tbl = 'business_center_reservation', $wh);
        // echo "<pre>";print_r($data);die;
        echo json_encode($data);
    }
    public function getdirtyData()
    {
        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getdatadirty($tbl = 'room_status', $wh);

        echo json_encode($data);
    }
    public function ajaxstatusdirty()
    {

        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 3;

        // $date = date('Y-m-d h:i:s');
        // $hotel_id = $this->session->userdata('u_id');
        $wh1 = '(room_status = 1 AND hotel_id ="' . $admin_id . '")';
        $guest_mng['get_dirty_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh1);

        $wh2 = '(room_status = 2 AND hotel_id ="' . $admin_id . '")';
        $guest_mng['get_accupied_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh2);
        $guest_mng['get_available_rooms'] = $this->HotelAdminModel->get_daily_report_available_rooms($admin_id);
        $wh3 = '(room_status = 4 AND hotel_id ="' . $admin_id . '")';
        $guest_mng['get_under_maintenance_rooms'] = $this->HotelAdminModel->getAllData('room_status', $wh3);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxHousekeepingIcon', $guest_mng);
    }
    public function checkOutRequestAdmin()
    {
        $u_id = $this->session->userdata('u_id');
        // $where ='(u_id = "'.$u_id.'")';
        // $admin_details = $this->MainModel->getData($tbl ='register', $where);
        // $admin_id = $admin_details['hotel_id'];
        // print_r($u_id);die;

        $data['list'] = $this->HotelAdminModel->get_all_checkout_request($u_id);
        $data['list1'] = $this->HotelAdminModel->get_all_accepted_checkout_request($u_id);
        $data['list2'] = $this->HotelAdminModel->get_all_completed_checkout_request($u_id);


        //    echo "<pre>"; print_r($data['list2']); echo "</pre>";die;
        $this->load->view('include/header');
        $this->load->view('hoteladmin/checkoutrequestAdmin', $data);
        $this->load->view('include/footer');
    }
    public function change_status_of_checkout_request()
    {
        $arr = array(
            'request_status' => $_POST['status']
        );

        $u_id = $_POST['uid'];
        // $a=$this->input->post();print_r($a);die;
        $where = '(checkout_request_id ="' . $u_id . '")';
        $id = $this->MainModel->editData($tbl = "user_checkout_requests", $where, $arr);
        if ($id) {
            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }
    public function checkout_action_change()
    {
        // $a=$this->input->post();
        // print_r($a);die;
        $arr = array(
            'request_status' => $_POST['status']
        );

        $checkout_request_id = $_POST['uid'];
        $where = '(checkout_request_id="' . $checkout_request_id . '")';
        $id = $this->MainModel->editData($tbl = "user_checkout_requests", $where, $arr);
        if ($id) {
            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }
    public function food_category_data_modal()
    {

        $id = $this->input->post('id');
        // print_r($id);die;
        $where1 = '(food_facility_id ="' . $id . '")';
        // print_r($where1);die;
        $data['get_facility_category'] = $this->HotelAdminModel->getAllData1('food_category', $where1);
        // print_r($data);die;
        // $guest_mng["facility_list"] = $this->HotelAdminModel->get_facility_category_list_pagination($admin_id);
        $this->load->view('hoteladmin/ajaxCategoryFacility', $data);
    }
    public function delete_facility_category()
    {
        $id = $this->input->post('cat_id');

        $hotel_id = $this->session->userdata('u_id');

        $where = '(food_category_id = "' . $id . '" AND hotel_id = "' . $hotel_id . '")';
        $del_menus = $this->MainModel->deleteData($tbl = "food_menus", $where);

        $where = '(food_category_id = "' . $id . '" AND hotel_id = "' . $hotel_id . '")';
        $result = $this->MainModel->deleteData($tbl = "food_category", $where);
        if ($result) {
            echo "1";
        } else {
            echo "0";
        }
    }
    public function getrequirement()
    {

        $wh = $this->input->post('id');
        //  echo "<pre>";print_r($wh);die;
        $data = $this->HotelAdminModel->getdatasparequest($tbl = 'spa_service_request_list', $wh);
        // echo "<pre>";print_r($data);die;
        echo json_encode($data);
    }
    public function getrequirement_car()
    {

        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getdatacarwash($tbl = 'vehicle_wash_request', $wh);
        // echo "<pre>";print_r($data);die;
        echo json_encode($data);
    }
    public function change_new_luggage_status()
    {

        // echo "hii";die;
        // $a=$this->input->post();print_r($a);exit;
        $luggage_request_id = $this->input->post('luggage_request_id');
        $request_status = $this->input->post('request_status');
        $admin_id = $this->session->userdata('u_id');
        $reject_reason = $this->input->post('reject_reason');
        $user_id = $this->input->post('u_id');
        $wh = '(u_id ="'.$admin_id.'")';
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
        $hotel_name = $get_hotel_name['hotel_name'];
        // $luggage_request_id = $this->uri->segment(3);

        if ($request_status == 1) {
            $arr = array(
                'request_status' => $request_status,
                'accept_date' => date('Y-m-d'),
                'assign_by' => 1,
                'assign_by_u_id' => $admin_id,
            );
            $wh = '(luggage_request_id = "' . $luggage_request_id . '")';
            $up = $this->HotelAdminModel->edit_data('luggage_request', $wh, $arr);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'luggage_request', $wh);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $title = '';
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Luggage Request Is Accepted';
                    $body = 'Your Luggage Request ID is "'.$luggage_request_id.'" ';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                $subject = $title;
                $description = "$title In $hotel_name And Your Luggage Request Id Is $luggage_request_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $user_id,
                                     'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
        //  print_r($arr_noti);die;
                 $this->MainModel->insert_data('user_notification',$arr_noti);
                // $this->session->set_flashdata('msg','Request accepted successfully');
                $guest_mng["luggage_request"] = $this->HotelAdminModel->get_luggage_request_list_pagination($admin_id);


                $this->load->view('hoteladmin/ajax_luggage_request', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        } elseif ($request_status == 2) {
            $arr1 = array(
                'request_status' => $request_status,
                'assign_by' => 1,
                'assign_by_u_id' => $admin_id,
                'reject_reason' =>$reject_reason,
            );
            $wh1 = '(luggage_request_id = "' . $luggage_request_id . '")';
            $up = $this->HotelAdminModel->edit_data('luggage_request', $wh1, $arr1);

            if ($up) {
                $get_u_id = $this->MainModel->getData($tbl = 'luggage_request', $wh1);
                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                $get_dt = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh1);
                $reason ='';
                $title = "";

                if($reject_reason == 1)
                {
                    $reason = "Temporarily unavailable";
                }
                else if($reject_reason == 2)
                {
                    $reason = "Space Not Available";
                }
                else if($reject_reason == 3)
                {
                    $reason = "Please Contact Front Office";
                }
                else if($reject_reason == 4)
                {
                    $reason = "Available Post Checkout";
                }
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Luggage Request Is Rejected';
                    $body = 'Your Luggage Request ID is "'.$luggage_request_id.'" And Your Request is Rejected Because OF "'.$reason.'" ';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                $subject = $title;
                $description =  "$title In $hotel_name Because Of $reason And Your Luggage Request Id Is $luggage_request_id";
                $arr_noti = array(
                                    'hotel_id' => $admin_id,
                                    'u_id' => $user_id,
                                     'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
        //  print_r($arr_noti);die;
                 $this->MainModel->insert_data('user_notification',$arr_noti);
                //    $this->session->set_flashdata('msg','Request rejected successfully');
                $guest_mng["luggage_request"] = $this->HotelAdminModel->get_luggage_request_list_pagination($admin_id);

                $this->load->view('hoteladmin/ajax_luggage_request', $guest_mng);
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HoteladminController/frontOfficeList'));
            }
        }
    }
    public function get_food_cat_count()
    {
        $food_category_id = $this->input->post('food_category_id');
        $food_category_name = $this->input->post('food_category_name');

        $id_count = count($food_category_id, TRUE);

        //   echo "id_count==".$id_count;

        for ($i = 0; $i < $id_count; $i++) {
            $wh = '(food_category_id  = "' . $food_category_id[$i] . '")';
            $arr1 = array(

                'category_name' => $food_category_name[$i]

            );

            $up =  $this->MainModel->editData('food_category', $wh, $arr1);
        }

        if ($up) {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="' . $admin_id . '")';
            $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
            $hotel_id = $get_hotel_id['hotel_id'];

            $guest_mng["facility_list"] = $this->HotelAdminModel->get_facility_category_list_pagination($admin_id);
            $this->load->view('hoteladmin/ajaxCategoryList', $guest_mng);
        }
    }
    public function getrequirement_luggage()
    {
        // $where = $this->input->post('id');
        // print_r($wh);die;
        // $wh = '(luggage_request_id ="' . $where . '")';
        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getdataluggage($tbl = 'luggage_request', $wh);
        // echo "<pre>";print_r($data);die;
        echo json_encode($data);
    }
    public function ajaxFoodVeveragefoodpagination()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 3;
        $guest_mng["list"] = $this->HotelAdminModel->get_menu_list_pagination($admin_id);
        $guest_mng['facility_list'] = $this->HotelAdminModel->get_food_facility($admin_id);
        $this->load->view('hoteladmin/ajaxFoodBeverageIcon', $guest_mng);
    }
    public function getmenufetchdata()
    {
        $admin_id = $this->session->userdata('u_id');
        $wh = $this->input->post('id');

        $data = $this->HotelAdminModel->getfoodmenudata($tbl = 'food_menus', $wh);
        $wh1 = '(food_facility_id ="' . $data['food_facility_id'] . '"  AND hotel_id = "' . $admin_id . '" )';
        $data['category'] = $this->MainModel->getAllData($tbl = 'food_category', $wh1);
        // echo "<pre>";print_r($data);exit;
        echo json_encode($data);
    }
    public function ajaxbusinessIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $guest_mng['icon_id'] = 7;
        $guest_mng["list"] = $this->HotelAdminModel->get_business_center_pagination($admin_id);

        $this->load->view('hoteladmin/ajaxIconBlockView', $guest_mng);
    }
    public function geteditgymData()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($wh);die;
        $wh = '(front_ofs_service_id ="' . $where . '")';
        $guest_mng['data'] = $this->HotelAdminModel->getgymsingledata($tbl = 'front_ofs_services', $wh);
        $guest_mng['images'] = $this->HotelAdminModel->getgymsingledata($tbl = 'front_ofs_services_images', $wh);
        // $service_name = 1;
        // $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
        // echo "<pre>";
        // print_r($guest_mng);die;
        echo json_encode($guest_mng);
    }
    public function geteditpoolData()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($wh);die;
        $wh = '(front_ofs_service_id ="' . $where . '")';
        $guest_mng['data'] = $this->HotelAdminModel->getpoolsingledata($tbl = 'front_ofs_services', $wh);
        $guest_mng['images'] = $this->HotelAdminModel->getpoolsingledata($tbl = 'front_ofs_services_images', $wh);
        // $guest_mng = $this->HotelAdminModel->getpoolsingledata($tbl ='front_ofs_services', $wh);

        // $service_name = 3;
        // $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
        // print_r($data);die;
        echo json_encode($guest_mng);
    }
    public function geteditshuttleData()
    {

        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($wh);die;
        $wh = '(front_ofs_service_id ="' . $where . '")';
        $guest_mng['data'] = $this->HotelAdminModel->getshuttlesingledata($tbl = 'front_ofs_services', $wh);
        $guest_mng['images'] = $this->HotelAdminModel->getshuttlesingledata($tbl = 'front_ofs_services_images', $wh);


        // $service_name = 4;
        // $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
        // echo "<pre>";print_r($guest_mng);die;
        echo json_encode($guest_mng);
    }
    public function geteditbabyData()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($wh);die;
        $wh = '(front_ofs_service_id ="' . $where . '")';
        // $guest_mng = $this->HotelAdminModel->getbabysingledata($tbl ='front_ofs_services', $wh);
        $guest_mng['data'] = $this->HotelAdminModel->getbabysingledata($tbl = 'front_ofs_services', $wh);
        $guest_mng['images'] = $this->HotelAdminModel->getbabysingledata($tbl = 'front_ofs_services_images', $wh);
        // $service_name = 5;
        // $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
        // print_r($data);die;
        echo json_encode($guest_mng);
    }

    public function geteditgymnotesdata()
    {
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($wh);die;
        $wh = '(front_ofs_service_id ="' . $where . '")';
        // $guest_mng = $this->HotelAdminModel->getbabysingledata($tbl ='front_ofs_services', $wh);
        $guest_mng['data'] = $this->HotelAdminModel->getbabysingledata($tbl = 'front_ofs_services', $wh);
        $this->load->view('hoteladmin/ajaxeditnotesgym', $guest_mng);
    }
    public function ajaxgymIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $service_name = 1;

        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
        $guest_mng['sub_icon_id'] = 1;
        // echo "<pre>";
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }
    public function ajaxpoolIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $service_name = 3;

      
        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
        $guest_mng['sub_icon_id'] = 3;
        // echo "<pre>";
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }
    public function ajaxshuttleIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $service_name = 4;
        $day1 = "Sunday";
        $day2 = "Monday";
        $day3 = "Tuesday";
        $day4 = "Wednesday";
        $day5 = "Thursday";
        $day6 = "Friday";
        $day7 = "Saturday";
       
        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
        $guest_mng['sun_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day1);

        $guest_mng['mon_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day2);

        $guest_mng['tue_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day3);

        $guest_mng['wed_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day4);

        $guest_mng['thurs_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day5);

        $guest_mng['fri_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day6);

        $guest_mng['sat_list'] = $this->HotelAdminModel->get_shuttle_service_staff_avaibility_by_day($admin_id, $day7);
        $guest_mng['sub_icon_id'] = 4;
        // echo "<pre>";
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }
    public function ajaxbabyIconView_v1()
    {
        $admin_id = $this->session->userdata('u_id');
        $service_name = 5;

        
         $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id, $service_name);
         $guest_mng['sub_icon_id'] = 5;
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxSubIconBlockView', $guest_mng);
    }
   
    public function get_discri_name_data_gym()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxgymnote', $guest_mng);
    }
    public function get_terms_name_data_gym()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxgymterm', $guest_mng);
    }
    public function get_discri_name_data_pool()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxpooldiscription', $guest_mng);
    }
    public function get_terms_name_data_pool()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxpoolterm', $guest_mng);
    }
    public function get_discri_name_data_shuttle()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxshuttlediscription', $guest_mng);
    }
    public function get_terms_name_data_shuttle()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxshuttleterm', $guest_mng);
    }
    public function get_discri_name_data_baby()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxbabydiscription', $guest_mng);
    }
    public function get_terms_name_data_baby()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxbabyterm', $guest_mng);
    }



    public function get_house_new_ord_data()
    {
        $room_num = $this->input->post('room_num');

        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $columnName = '';
        foreach ($this->input->post('columns') as $col) {
            $columnName = $col['data'];
        }
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $hotel_id = $get_hotel_id['u_id'];

        $get_new_house_order_data = $this->HotelAdminModel->get_new_house_order_data($rowperpage, $row, $search, $hotel_id, $room_num);
        // echo "<pre>";
        // print_r($get_new_food_order_data);
        // exit;
        $total_new_house_order_data = $this->HotelAdminModel->get_total_new_house_order_data($search, $hotel_id, $room_num = '');

        $totalRecords = $total_new_house_order_data->total_record;

        $data = array();
        $i = 1;
        foreach ($get_new_house_order_data as $val) {
            $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="' . $val['out_of_time_status'] . '"><span> ' . $val['h_k_order_id'] . '</span></div>';

            $order_type = '';
            if ($val['order_from'] == 1) {
                $order_type = 'On Call';
            } elseif ($val['order_from'] == 2) {
                $order_type = 'From Staff';
            } elseif ($val['order_from'] == 3) {
                $order_type = 'App Order';
            }
            $services = ' <a href="#" class="btn btn-secondary shadow btn-xs house_modal_btn" data-house-id ="' . $val['h_k_order_id'] . '"><i class="fa fa-eye"></i></a>';



            $action = '<a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data" data-bs-toggle="modal" data-id="' . $val['h_k_order_id'] . '" data-bs-target=".update_faq_modal"><i class="fa fa-share"></i></a> ';

            // $time = date('h:i A', strtotime($val['visit_time']));
            // $Visiting_Time = '<h5>'.$time.'</h5>';

            $data[] = array(
                "Sr_No"            => $row + $i++,
                "Order Id"        => $order_id,
                "Order Type"    => $order_type,
                "Order Date"    => date('d-m-Y', strtotime($val['order_date'])),
                "Order Total"    => $val['order_total'],
                "Name"            => $val['full_name'],
                "Mobile No"        => $val['mobile_no'],
                "Services"        => $services,
                "Action"        => $action
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
    }
    public function house_order_view()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $ord_id = $this->input->post('ord_id');
        $admin_id = $this->session->userdata('u_id');
        $data['hk_order_details'] = $this->MainModel->get_house_keeping_service_details($admin_id, $ord_id);
        $this->load->view('hoteladmin/ajax_house_Order_View_data', $data);
    }
    public function get_laundry_new_ord_data()
    {
        $room_num = $this->input->post('room_num');

        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $columnName = '';
        foreach ($this->input->post('columns') as $col) {
            $columnName = $col['data'];
        }
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $hotel_id = $get_hotel_id['u_id'];

        $get_new_laundry_order_data = $this->HotelAdminModel->get_new_laundry_order_data($rowperpage, $row, $search, $hotel_id, $room_num);
        // echo "<pre>";
        // print_r($get_new_food_order_data);
        // exit;
        $total_new_laundry_order_data = $this->HotelAdminModel->get_total_new_laundry_order_data($search, $hotel_id, $room_num = '');

        $totalRecords = $total_new_laundry_order_data->total_record;

        $data = array();
        $i = 1;
        foreach ($get_new_laundry_order_data as $val) {

            $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="' . $val['out_of_time_status'] . '"><span> ' . $val['cloth_order_id'] . '</span></div>';
            $order_type = '';
            if ($val['order_from'] == 1) {
                $order_type = 'On Call';
            } elseif ($val['order_from'] == 2) {
                $order_type = 'From Staff';
            } elseif ($val['order_from'] == 3) {
                $order_type = 'App Order';
            }
            $time = date('h:i A', strtotime($val['order_time']));
            $Visiting_Time = '<sub>' . $time . '</sub>';
            $services = ' <a href="#" class="btn btn-secondary shadow btn-xs laundry_modal_btn" data-laundry-id ="' . $val['cloth_order_id'] . '"><i class="fa fa-eye"></i></a>';



            $action = '<a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data2" data-bs-toggle="modal" data-id="' . $val['cloth_order_id'] . '" data-bs-target=".update_faq_modal2"><i class="fa fa-share"></i></a> ';

            // $time = date('h:i A', strtotime($val['visit_time']));
            // $Visiting_Time = '<h5>'.$time.'</h5>';

            $data[] = array(
                "Sr_No"            =>    $row + $i++,
                "Order Id"    => $order_id,

                "Order Date"    => date('d-m-Y', strtotime($val['order_date'])) . $Visiting_Time,
                "Order Total"    =>  $val['order_total'],
                "Order Type"    =>  $order_type,
                "Name"    =>  $val['full_name'],
                "Mobile No"    => $val['mobile_no'],

                "Services"    =>  $services,
                "Action"    =>   $action
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
    }
    public function laundry_order_view()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $ord_id = $this->input->post('ord_id');
        $admin_id = $this->session->userdata('u_id');
        $data['ld_order_details'] = $this->MainModel->get_laundry_order_details($admin_id, $ord_id);
        $this->load->view('hoteladmin/ajax_laundry_Order_View_data', $data);
    }
    public function geteditspainfo()
    {
        // echo "hi";die;
        $admin_id = $this->session->userdata('u_id');
        $where = $this->input->post('id');
        // print_r($where);die;
        $wh = '(front_ofs_service_id ="' . $where . '")';

        $guest_mng['data'] = $this->HotelAdminModel->getspasingledata($tbl = 'front_ofs_services', $where);
        $guest_mng['images'] = $this->HotelAdminModel->getspasingleinfo($tbl = 'front_ofs_services_images', $wh);
        $service_name = 2;
        $guest_mng["list"] = $this->HotelAdminModel->get_front_ofs_services_pagination($admin_id,$service_name);
        // echo "<pre>";
        // print_r($guest_mng["list"]);die;
        echo json_encode($guest_mng);
    }
    public function get_discri_name_data_info()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxnoteinfo', $guest_mng);
    }
    public function get_discri_name_data_infoterm()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxnoteinfoterm', $guest_mng);
    }
    public function get_discri_name_data_infoimage()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(front_ofs_service_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'front_ofs_services', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxnoteinfoimages', $guest_mng);
    }
    public function get_discri_name_data_spa_request()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(spa_service_request_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'spa_service_request_list', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxnotesparequest', $guest_mng);
    }
    public function get_discri_name_data_luggage_request()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(luggage_request_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'luggage_request', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxnoteluggagerequest', $guest_mng);
    }
    public function get_spa_order_data()
    {

        // echo "hi";
        // die;
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $columnName = '';
        foreach ($this->input->post('columns') as $col) {
            $columnName = $col['data'];
        }
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $hotel_id = $get_hotel_id['u_id'];

        $get_new_spa_order_data = $this->HotelAdminModel->get_new_spa_order_data($rowperpage, $row, $search, $hotel_id);
        // echo "<pre>";
        // print_r($get_new_spa_order_data);
        // die;
        $total_new_spa_order_data = $this->HotelAdminModel->get_total_new_spa_order_data($search, $hotel_id);
        //  echo "<pre>";
        // print_r($total_new_spa_order_data);
        // die;
        $totalRecords = $total_new_spa_order_data->total_record;
        // echo "<pre>";
        // print_r($totalRecords);
        // die;
        $data = array();
        $i = 1;
        foreach ($get_new_spa_order_data as $val) {
            $wh2 = '(front_ofs_spa_service_images_id="' . $val['spa_type'] . '")';
            $spa_type_name = $this->HotelAdminModel->getData($tbl = 'front_ofs_spa_service_images', $wh2);
            // print_r($spa_type);die;
            $services = ' <a href="#" class="btn btn-secondary shadow btn-xs house_modal_btn edit_spa_request_click"data-sparequest-id ="' . $val['spa_service_request_id'] . '"><i class="fa fa-eye"></i></a>';



            $action = '<a href="#"  class="btn btn-warning shadow btn-xs sharp me-1 update_spa_modal_btn" id="edit_spa_data" data-bs-toggle="modal"  data-id1="' . $val['spa_service_request_id'] . '"><i class="fa fa-share"></i></a> ';

            // $time = date('h:i A', strtotime($val['visit_time']));
            // $Visiting_Time = '<h5>'.$time.'</h5>';

            $data[] = array(
                "Sr_No"            =>    $row + $i++,
                "Guest_Name"    => $val['full_name'],
                "Phone"    => $val['mobile_no'],

                "Request_Date"    =>   date('d-m-Y', strtotime($val['select_date'])),
                "Request_Time"    =>  $val['select_time'],
                "Spa Type"    => $spa_type_name['spa_type']??'',

                "Note"    =>  $services,
                "Action"    =>  $action
            );
        }


        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );
        // print_r($response);die;
        echo json_encode($response);
    }

    public function get_luggage_order_data()
    {

        // echo "hi";
        // die;
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $columnName = '';
        foreach ($this->input->post('columns') as $col) {
            $columnName = $col['data'];
        }
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $hotel_id = $get_hotel_id['u_id'];

        $get_new_luggage_order_data = $this->HotelAdminModel->get_new_luggage_order_data($rowperpage, $row, $search, $hotel_id);
        // echo "<pre>";
        // print_r($get_new_luggage_order_data);
        // die;
        $total_new_luggage_order_data = $this->HotelAdminModel->get_total_new_luggage_order_data($search, $hotel_id);
        //  echo "<pre>";
        // print_r($total_new_luggage_order_data);
        // die;
        $totalRecords = $total_new_luggage_order_data->total_record;
        // echo "<pre>";
        // print_r($totalRecords);
        // die;
        $data = array();
        $i = 1;
        foreach ($get_new_luggage_order_data as $val) {

            $services = ' <a href="#" class="btn btn-secondary shadow btn-xs house_modal_btn edit_luggage_request_click"data-luggagerequest-id ="' . $val['luggage_request_id'] . '"><i class="fa fa-eye"></i></a>';



            $action = '<a href="#"  class="btn btn-warning shadow btn-xs sharp me-1 update_luggage_modal_btn" id="edit_luggage_data" data-bs-toggle="modal"  data-id3="' . $val['luggage_request_id'] . '"><i class="fa fa-share"></i></a> ';

            // $time = date('h:i A', strtotime($val['visit_time']));
            // $Visiting_Time = '<h5>'.$time.'</h5>';

            $data[] = array(

                "Sr_No"            =>    $row + $i++,
                "Guest_Name"    => $val['full_name'],
                "Mobile Number"    => $val['mobile_no'],

                "Date"    =>  date('d-m-Y', strtotime($val['select_date'])),
                "Time"    =>  $val['select_time'],
                "Type Of Luggage"    => $val['luggage_type'],
                "Qty"    =>  $val['quantity'],
                "Note"    =>  $services,
                "Action"    => $action
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
    }
    public function get_discri_name_data_cab_request()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(cab_service_request_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'cab_service_request_list', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxnotecabrequest', $guest_mng);
    }
    public function get_cab_order_data()
    {

        // echo "hi";
        // die;
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $columnName = '';
        foreach ($this->input->post('columns') as $col) {
            $columnName = $col['data'];
        }
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $hotel_id = $get_hotel_id['u_id'];

        $get_new_cab_order_data = $this->HotelAdminModel->get_new_cab_order_data($rowperpage, $row, $search, $hotel_id);
        // echo "<pre>";
        // print_r($get_new_cab_order_data);
        // die;
        $total_new_cab_order_data = $this->HotelAdminModel->get_total_new_cab_order_data($search, $hotel_id);
        //  echo "<pre>";
        // print_r($total_new_cab_order_data);
        // die;
        $totalRecords = $total_new_cab_order_data->total_record;
        // echo "<pre>";
        // print_r($totalRecords);
        // die;
        $data = array();
        $i = 1;
        foreach ($get_new_cab_order_data as $val) {

            $services = ' <a href="#" class="btn btn-secondary shadow btn-xs edit_cab_request_click" data-cabrequest-id ="' . $val['cab_service_request_id'] . '"><i class="fa fa-eye"></i></a>';



            $action = '<a href="#"  class="btn btn-warning shadow btn-xs sharp me-1 change_cab" id="edit_data" data-bs-toggle="modal"  data-id="' . $val['cab_service_request_id'] . '"><i class="fa fa-share"></i></a> ';

            // $time = date('h:i A', strtotime($val['visit_time']));
            // $Visiting_Time = '<h5>'.$time.'</h5>';

            $data[] = array(


                "Sr_No"            =>    $row + $i++,
                "Passengers"    => $val['total_passanger'],
                "Requested Date"    => date('d-m-Y', strtotime($val['request_date'])),

                "Guest Name"    =>  $val['full_name'],
                "Phone"    =>  $val['mobile_no'],
                "Vehicle Type"    => $val['request_vehicle_type'],
                "Destination"    =>   $val['destination_name'],
                "Note"    =>  $services,
                "Assign"    =>  $action
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
    }
    public function get_discri_name_data_carwash_request()
    {

        $id = $this->input->post('id'); //print_r($id);die;

        $wh = '(vehicle_wash_request_id ="' . $id . '")';
        $guest_mng["list"] = $this->HotelAdminModel->getData($tbl = 'vehicle_wash_request', $wh);
        // print_r($guest_mng);die;
        $this->load->view('hoteladmin/ajaxnotecarwashrequest', $guest_mng);
    }

    public function get_carwash_order_data()
    {

        // echo "hi";
        // die;
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $columnName = '';
        foreach ($this->input->post('columns') as $col) {
            $columnName = $col['data'];
        }
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
        $hotel_id = $get_hotel_id['u_id'];

        $get_new_carwash_order_data = $this->HotelAdminModel->get_new_carwash_order_data($rowperpage, $row, $search, $hotel_id);
        // echo "<pre>";
        // print_r($get_new_carwash_order_data);
        // die;
        $total_new_carwash_order_data = $this->HotelAdminModel->get_total_new_carwash_order_data($search, $hotel_id);
        //  echo "<pre>";
        // print_r($total_new_carwash_order_data);
        // die;
        $totalRecords = $total_new_carwash_order_data->total_record;
        // echo "<pre>";
        // print_r($totalRecords);
        // die;
        $data = array();
        $i = 1;
        foreach ($get_new_carwash_order_data as $val) {

            $profile = ' <a href="' . $val['vehicle_img'] . '" target="_blank"   data-src="' . $val['vehicle_img'] . '" data-exthumbimage ="' . $val['vehicle_img'] . '"><img class="me-3 "
            src="' . $val['vehicle_img'] . '"  alt=""  style="width:50px;"></a>';

            $services = ' <a href="#" class="btn btn-secondary shadow btn-xs edit_car_request_click" data-carrequest-id ="' . $val['vehicle_wash_request_id'] . '"><i class="fa fa-eye"></i></a>';



            $action = '<a href="#"  class="btn btn-warning shadow btn-xs sharp me-1 update_car_modal_btn" id="edit_car_data" data-bs-toggle="modal"  data-id2="' . $val['vehicle_wash_request_id'] . '"><i class="fa fa-share"></i></a> ';

            // $time = date('h:i A', strtotime($val['visit_time']));
            // $Visiting_Time = '<h5>'.$time.'</h5>';

            $data[] = array(


                "Sr_No"            =>    $row + $i++,
                "Guest Name"    =>  $val['full_name'],
                "Phone"    =>  $val['mobile_no'],

                "Select Date"    =>  date('d-m-Y', strtotime($val['select_date'])),
                "Select Time"    =>  $val['select_time'],
                "Vehicle Name"    =>  $val['vehicle_name'],
                "Vehicle No"    =>   $val['vehicle_no'],
                "Photo"    =>  $profile,
                "Note"    =>   $services,
                "Assign"    => $action
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
    }

    public function getunderData()
    {
        $wh = $this->input->post('id');
               
                $data = $this->HotelAdminModel->getdataunder($tbl ='room_status', $wh);
                
                echo json_encode($data);
       
    }

    public function accepted_order_of_food()
    {
        // echo "hi";die;
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

        $accepted_food_Order_list = $this->HotelAdminModel->accepted_food_Order_list($rowperpage,$row,$search, $hotel_id);
        
        // echo "<pre>";
        // print_r($accepted_food_Order_list);
        // exit;
        $total_accepted_food_list_data = $this->HotelAdminModel->total_accepted_food_list_data($search, $hotel_id);
        // echo "<pre>";
        // print_r($total_accepted_food_list_data);
        // exit;
        $totalRecords = $total_accepted_food_list_data->total_record;

        $data = array();
        $i=1;
        foreach($accepted_food_Order_list AS $val)
        {
            $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="'.$val['out_of_time_status'].'"><span> '.$val['food_order_id'].'</span></div>';
            $order_from = "";

            if($val['order_from'] == 1)
               {
                   $order_from = "On Call Order";
               }
               else if($val['order_from'] == 2)
               {
                   $order_from = "From Staff Order";
               }
               else if($val['order_from'] == 3)
               {
                   $order_from = "App Order";
               }
               else if($val['order_from'] == 4)
               {
                   $order_from = "Walking Order";
               }

        //     echo "<pre>";
        // print_r($order_id);
        // exit;
        // $wh = '(u_id = "' . $val['staff_id'] . '")';
        //     print_r($wh);die;
        // $staff_data = $this->MainModel->getData('register', $wh);

        // $staff_full_name = "";

        // if ($staff_data) {
        //    $staff_full_name = $staff_data['full_name'];
        // }
        $services = ' <a href="#" class="btn btn-secondary shadow btn-xs accept_modal_btn" data-accept-id ="'.$val['food_order_id'].'"><i class="fa fa-eye"></i></a>';
        $order_status = '<div>
        <input type="hidden" name="user_id" id="foodorderid'.$val['food_order_id'].'" value="'.$val['food_order_id'].'">
        <input type="hidden" name="food_u_id" id="food_u_id'.$val['food_order_id'].'" value="'.$val['u_id'].'">
        <select class="form-control" name="status" id="food_order_status'.$val['food_order_id'].'" onchange="change_food_status('.$val['food_order_id'].');" style="min-width:85px;text-align:center">
            <option value="1" selected>Accepted</option>
            <option value="2">Completed</option>
        </select>
        </div>';	

            $data[] = array(
                "sr_no"			=>	$row+$i++ ,
                "order_id"	    =>  $order_id,
                "ord_type" =>  $order_from,
                "ord_date"      =>  date('d-m-Y', strtotime($val['order_date'])),
                "accepted_date"	        =>   date('d-m-Y', strtotime($val['accept_date'])),
                "guest_name"	    => $val['full_name'],
                "Mobile_no"	=> $val['mobile_no'],
                "Services"	=>  $services,  
                "Assign_Order"  => $val['staff_name'],
               
                "Order_Status"  => $order_status,
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

    public function accept_order_view()
    {
        $food_order_id = $this->input->post('id');
		$wh_l = '(food_order_id = "' . $food_order_id . '")';
		
		
       $data['get_food_orders_data'] = $this->HotelAdminModel->getAllData1('food_order_details',$wh_l);
    //    echo "<pre>";
    //    print_r($data['get_food_orders_data']);die;
        $this->load->view('hoteladmin/ajax_food_Order_View_accept', $data);
    }
    public function out_of_time_house_orders_of_accepted()
	{
		log_message('DEBUG', 'acceptdetimeout_order--'.json_encode('newTime_out_color change_log'));
		$ord_to_15min = date('Y-m-d H:i:s', (time() - 60 * 14));
		$time_out_ord = $this->HotelAdminModel->outof_time_accepted_house_order($ord_to_15min);
		$arr_to_string = array_column($time_out_ord,'h_k_order_id');
		$result =[];
		foreach($arr_to_string as $val_time)
		{
			$where = '(h_k_order_id = "'.$val_time.'" AND order_status = 1)';
			$arr= array(
				'out_of_time_status'=>2,
			);
			$out_of_time_status_update = $this->HotelAdminModel->editData($tbl="house_keeping_orders",$where,$arr);
			$result[]= $val_time;
		}
		$data = $result;
		echo json_encode($data); 
	}

    public function accepted_order_of_house()
    {
        // echo "hi";die;
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

        $accepted_house_Order_list = $this->HotelAdminModel->accepted_house_Order_list($rowperpage,$row,$search, $hotel_id);
        
        // echo "<pre>";
        // print_r($accepted_house_Order_list);
        // exit;
        $total_accepted_house_list_data = $this->HotelAdminModel->total_accepted_house_list_data($search, $hotel_id);
        // echo "<pre>";
        // print_r($total_accepted_house_list_data);
        // exit;
        $totalRecords = $total_accepted_house_list_data->total_record;

        $data = array();
        $i=1;
        foreach($accepted_house_Order_list AS $val)
        {
            $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="'.$val['out_of_time_status'].'"><span> '.$val['h_k_order_id'].'</span></div>';

                //order type 
                $order_from = "";

                if($val['order_from'] == 1)
                   {
                       $order_from = "On Call Order";
                   }
                   else if($val['order_from'] == 2)
                   {
                       $order_from = "From Staff Order";
                   }
                   else if($val['order_from'] == 3)
                   {
                       $order_from = "App Order";
                   }
                   else if($val['order_from'] == 4)
                   {
                       $order_from = "Walking Order";
                   }

            $services = ' <a href="#" class="btn btn-secondary shadow btn-xs house_modal_btn" data-house-id="'.$val['h_k_order_id'].'"><i class="fa fa-eye"></i></a>';
        $order_status = '<div>
        <input type="hidden" name="user_id" id="uid'.$val['h_k_order_id'].'" value="'.$val['h_k_order_id'].'">
        <input type="hidden" name="house_u_id" id="house_u_id'.$val['h_k_order_id'].'" value="'.$val['u_id'].'">
        <select class="form-control" name="status" id="status'.$val['h_k_order_id'].'" onchange="change_status('.$val['h_k_order_id'].');" style="min-width:85px;text-align:center">
            <option value="1" selected>Accepted</option>
            <option value="2">Completed</option>
        </select>
        </div>';	

            $data[] = array(
                "sr_no"			=>	$row+$i++ ,
                "order_id"	    =>  $order_id,
                "ord_type" =>   $order_from,
                "ord_date"      =>  date('d-m-Y', strtotime($val['order_date'])),
                "accepted_date"	        =>  date('d-m-Y', strtotime($val['accept_date'])),
                "guest_name"	    => $val['full_name'],
                "Mobile_no"	=> $val['mobile_no'],
                "Services"	=>  $services,  
                "Assign_Order"  => $val['staff_name'],
               
                "Order_Status"  => $order_status,
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
    public function accept_order_view_house()
    {
       
        $ord_id = $this->input->post('ord_id');
        $admin_id = $this->session->userdata('u_id');
        $data['hk_order_details'] = $this->MainModel->get_house_keeping_service_details($admin_id, $ord_id);
        $this->load->view('hoteladmin/ajax_house_accepted_View_data', $data);
    }

    public function get_out_of_time_laundry_orders()
	{
		log_message('DEBUG', 'laundrytimeout_order--'.json_encode('newTime_out_color change_log'));
		$ord_to_15min = date('Y-m-d H:i:s', (time() - 60 * 14));
		$time_out_ord = $this->HotelAdminModel->outof_time_laundry_order($ord_to_15min);
		$arr_to_string = array_column($time_out_ord,'cloth_order_id');
		$result =[];
		foreach($arr_to_string as $val_time)
		{
			$where = '(cloth_order_id = "'.$val_time.'" AND order_status = 0)';
				$arr= array(
					'out_of_time_status'=>1,
				);
				$out_of_time_status_update = $this->HotelAdminModel->editData($tbl="cloth_orders",$where,$arr);
				$result[]= $val_time;
		}
		$data = $result;
		echo json_encode($data); 
	}

    public function out_of_time_laundry_orders_of_accepted()
	{
		log_message('DEBUG', 'acceptdetimeout_order--'.json_encode('newTime_out_color change_log'));
		$ord_to_15min = date('Y-m-d H:i:s', (time() - 60 * 14));
		$time_out_ord = $this->HotelAdminModel->outof_time_accepted_laundry_order($ord_to_15min);
		$arr_to_string = array_column($time_out_ord,'cloth_order_id');
		$result =[];
		foreach($arr_to_string as $val_time)
		{
			$where = '(cloth_order_id = "'.$val_time.'" AND order_status = 1)';
			$arr= array(
				'out_of_time_status'=>2,
			);
			$out_of_time_status_update = $this->HotelAdminModel->editData($tbl="cloth_orders",$where,$arr);
			$result[]= $val_time;
		}
		$data = $result;
		echo json_encode($data); 
	}

    public function accepted_order_of_laundry()
    {
        // echo "hi";die;
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

        $accepted_laundry_Order_list = $this->HotelAdminModel->accepted_laundry_Order_list($rowperpage,$row,$search, $hotel_id);
        
        // echo "<pre>";
        // print_r($accepted_laundry_Order_list);
        // exit;
        $total_accepted_laundry_list_data = $this->HotelAdminModel->total_accepted_laundry_list_data($search, $hotel_id);
        // echo "<pre>";
        // print_r($total_accepted_laundry_list_data);
        // exit;
        $totalRecords = $total_accepted_laundry_list_data->total_record;

        $data = array();
        $i=1;
        foreach($accepted_laundry_Order_list AS $val)
        {
            $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="'.$val['out_of_time_status'].'"><span> '.$val['cloth_order_id'].'</span></div>';
            
             //order type 
             $order_from = "";

             if($val['order_from'] == 1)
                {
                    $order_from = "On Call Order";
                }
                else if($val['order_from'] == 2)
                {
                    $order_from = "From Staff Order";
                }
                else if($val['order_from'] == 3)
                {
                    $order_from = "App Order";
                }
                else if($val['order_from'] == 4)
                {
                    $order_from = "Walking Order";
                }

            $services = ' <a href="#" class="btn btn-secondary shadow btn-xs laundry_modal_btn" data-laundry-id="'.$val['cloth_order_id'].'"><i class="fa fa-eye"></i></a>';
        $order_status = '<div>
        <input type="hidden" name="user_id" id="clothorderid'.$val['cloth_order_id'].'" value="'.$val['cloth_order_id'].'">
        <input type="hidden" name="user_id" id="cloth_u_id'.$val['cloth_order_id'].'" value="'.$val['u_id'].'">
        <select class="form-control" name="status" id="cloth_order_status'.$val['cloth_order_id'].'" onchange="change_cloth_status('.$val['cloth_order_id'].');" style="min-width:85px;text-align:center">
            <option value="1" selected>Accepted</option>
            <option value="2">Completed</option>
        </select>
        </div>';	

            $data[] = array(
                "sr_no"			=>	$row+$i++ ,
                "order_id"	    =>  $order_id,
                "ord_type" =>  $order_from,
                "ord_date"      =>  date('d-m-Y', strtotime($val['order_date'])),
                "accepted_date"	        =>   date('d-m-Y', strtotime($val['accept_date'])),
                "guest_name"	    => $val['full_name'],
                "Mobile_no"	=> $val['mobile_no'],
                "Services"	=>  $services,  
                "Assign_Order"  => $val['staff_name'],
               
                "Order_Status"  => $order_status,
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

    public function get_all_order_data()
    {
        $admin_id = $this->session->userdata('u_id');
        
        $booking_id = $this->input->post('id');
        $u_id = $this->input->post('user_id');

        $guest_history['housekeeping_service_completed_order'] = $this->MainModel->get_user_housekeeping_completed_order_list($admin_id,$booking_id,$u_id);
                    
        $guest_history['laundry_completed_order'] = $this->MainModel->get_user_laundry_order_list($admin_id,$booking_id,$u_id);
      
        $guest_history['food_completed_order'] = $this->MainModel->get_user_food_completed_order_list($admin_id,$booking_id,$u_id);
       
        $this->load->view('hoteladmin/ajaxinhouseviewservice',$guest_history);
    }
    public function Ser_request()
	{ 
        // echo "hi";die;
        // $userType = $this->session->userdata('userType');
        $u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
        $today_date = date('Y-m-d');
        $service_request['list'] = $this->HotelAdminModel->get_service_request($u_id);
        $service_request['list1'] = $this->HotelAdminModel->get_hotel_service_request($u_id,$today_date);
        $service_request['list2'] = $this->HotelAdminModel->get_accepted_service_request($u_id);
        $service_request['list4'] = $this->HotelAdminModel->get_rejected_service_request($u_id);
        $this->load->view('include/header');
        $this->load->view('hoteladmin/viewServiceRequest',$service_request);
        $this->load->view('include/footer');
	}

    public function add_service_request()
    {   
        
        $room_no = $this->input->post('room_no');
        $guest_id = $this->input->post('user_n');
        $user_n = $this->input->post('user_name');
        $send_to111 = $this->input->post('send_to');
        $requirement = $this->input->post('requirement');
        
       //  $admin_id = $this->session->userdata('front_id');
       $u_id= $this->session->userdata('u_id');
       $where ='(u_id = "'.$u_id.'")';
       $admin_details = $this->MainModel->getData($tbl ='register', $where);
      
      
       $u_id11 = $admin_details['u_id'];
       $description = ''.strip_tags($requirement).' from room no is '.$room_no.'';
        $user_data = $this->HotelAdminModel->get_user_data_by_username($user_n);
        // print_r($user_data);die;
        if(!empty($user_data ))
        {
            $arr = array(
                            'hotel_id'    => $u_id,
                            'room_no'      => $room_no,
                            'u_id' => $u_id11,
                            'guest_name' => $user_n,
                            'send_to' => $send_to111,
                            'send_to_u_id'=>$guest_id,
                            'requirement' => $description,
                            'date' => date('Y-m-d'),
                            'time' =>date("h:i:s"),
                        );
                        
                        // print_r($arr);exit;
            $add = $this->HotelAdminModel->insert_data('service_request',$arr);
            // print_r($add);die;
            if($add){
                    $send_for = 7;
                    $send_to = 2;
                    $title ="Service Request";
                       $arr = array(
                                   'ser_id'      => $add,
                                   'send_to'     => $send_to,
                                   'send_for'    => $send_for,
                                   'title'       =>$title,
                                   'room_no'     => $room_no,
                                   'description'  => $description,
                                //    'send_by'      => 3,
                                   'send_by_id'   => $u_id,
                                   'added_by_id' => $u_id11,
                               );
                  
                       $add11 = $this->HotelAdminModel->insert_data('notifications',$arr);
                       // var_dump($add11);die;
                       if($add11){
                          
                              $arr = array(
                                           'notification_id' => $add11,
                                           'department_id' => $send_to111
                                      );

                              $add11 = $this->HotelAdminModel->insert_data('notifictions_department_id',$arr);
            
                              $u_id = $this->session->userdata('u_id');
                              $where ='(u_id = "'.$u_id.'")';
                              $admin_details = $this->MainModel->getData($tbl ='register', $where);
                              $admin_id = $admin_details['hotel_id'];
                      
                              $service_request['list'] = $this->HotelAdminModel->get_service_request($u_id);
                         
                              $this->load->view('hoteladmin/ajaxviewServiceRequest',$service_request);
                            
               }
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('Ser_request'));
            }
           }
           else
           {
               $this->session->set_flashdata('msg','User not exit');
               redirect(base_url('Ser_request'));
           }	   
    }
    public function get_user_id()
    {
        $todays_date = date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        $userType = $this->session->userdata('userType');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="' . $admin_id . '")';
        $get_hotel_id = $this->MainModel->getData('register', $wh_admin);

        $admin_id = $get_hotel_id['u_id'];
        $room_no = $this->input->post('room_no');

        $guest_data = $this->HotelAdminModel->get_room_no_data($admin_id, $room_no,$todays_date);
        if (!empty($guest_data)) {
            $output = '';

            $output .= $guest_data['u_id'];

            echo $output;
        }
    }
            public function get_user_name()
            {
              $todays_date = date('Y-m-d');
              $hotel_id = $this->input->post('hotel_id');
              $userType = $this->session->userdata('userType');
              $admin_id = $this->session->userdata('u_id');
              $wh_admin = '(u_id ="' . $admin_id . '")';
              $get_hotel_id = $this->MainModel->getData('register', $wh_admin);
      
              $admin_id = $get_hotel_id['u_id'];
                $hotel_id = $this->input->post('hotel_id');
                // echo $hotel_id;die;
                $room_no = $this->input->post('room_no');
        
                $guest_data = $this->HotelAdminModel->get_room_no_data($admin_id, $room_no,$todays_date);
                if (!empty($guest_data)) {
                    $wh = '(u_id = "'.$guest_data['u_id'].'")';
        
                    $user_data = $this->HotelAdminModel->getData('register', $wh);
        
                    $output = '';
        
                    $output .= $user_data['full_name'];
        
                    echo $output;
                }
            }
}


