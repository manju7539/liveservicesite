<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['Dashboard'] = 'HomeController';
$route['newOrder'] = 'HomeController/newOrder';
$route['review'] = 'HomeController/review';
$route['newAcceptOrder'] = 'HomeController/newAcceptOrder';
$route['newRejectOrder'] = 'HomeController/newRejectOrder';
$route['newCompleteOrder'] = 'HomeController/newCompleteOrder';
$route['newManageOrder'] = 'HomeController/newManageOrder';
$route['newRequest'] = 'HomeController/newRequest';
$route['acceptedOrder'] = 'HomeController/acceptedOrder';
$route['rejectedOrder'] = 'HomeController/rejectedOrder';
$route['staffManage'] = 'HomeController/staffManage';
$route['facility'] = 'HomeController/Viewfacility';
$route['facilityCategory'] = 'HomeController/viewFacilityCategory';
$route['menulist'] = 'HomeController/viewMenuList';
$route['manageHalls'] = 'HomeController/viewManageHalls';
$route['panel_notification'] = 'HomeController/panel_notification';
$route['new_order'] = 'PageController/new_order';



$route['enquiry_request'] = 'HoteladminController/enquiry_request';


//front office
$route['frontArrival'] = 'FrontofficeController/frontaArrival';
$route['upcomingArrival'] = 'FrontofficeController/upcomingArrival';
$route['frontDeparture'] = 'FrontofficeController/frontDeparture';
$route['raiseDispute'] = 'FrontofficeController/raiseDispute';
$route['businessCenterRequest'] = 'FrontofficeController/businessCenterRequest';
$route['listOfAcceptedRequest'] = 'FrontofficeController/listOfAcceptedRequest';
$route['listOfRejectedRequest'] = 'FrontofficeController/listOfRejectedRequest';
$route['ManageBusinessCenter'] = 'FrontofficeController/ManageBusinessCenter';
$route['enquiry'] = 'FrontofficeController/enquiry';
$route['acceptedByUser'] = 'FrontofficeController/acceptedByUser';
$route['rejectedByUser'] = 'FrontofficeController/rejectedByUser';
$route['roomStatus'] = 'FrontofficeController/roomStatus';
$route['guests'] = 'FrontofficeController/guests';
$route['departed_guest'] = 'FrontofficeController/departed_guest';
$route['visitors'] = 'FrontofficeController/visitors';
$route['notification'] = 'FrontofficeController/notification';
$route['restaurant_notification'] = 'FrontofficeController/restaurant_notification';
$route['all_room_notification'] = 'FrontofficeController/all_room_notification';
$route['housekeeping_notification'] = 'FrontofficeController/housekeeping_notification';

$route['serviceRequest'] = 'FrontofficeController/serviceRequest';
$route['serviceBooking'] = 'FrontofficeController/serviceBooking';  
$route['feedback'] = 'FrontofficeController/feedback';
$route['handover'] = 'FrontofficeController/handover';
$route['completedHandover'] = 'FrontofficeController/completedHandover';

$route['facilityUpdate'] = 'FrontofficeController/facilityUpdate';
$route['lost'] = 'FrontofficeController/lost';
$route['expense'] = 'FrontofficeController/expense';
$route['nightAudit'] = 'FrontofficeController/nightAudit';
$route['hotelGuide'] = 'FrontofficeController/hotelGuide';
$route['addFloor'] = 'FrontofficeController/addFloor';
$route['addRoomType'] = 'FrontofficeController/addRoomType';
$route['roomConfig'] = 'FrontofficeController/roomConfig';
$route['agents'] = 'FrontofficeController/agents';


//admin dashboard
$route['room_service_dashboard'] = 'HomeController/room_service_dashboard';
$route['housekeeping_dashboard'] = 'HomeController/housekeeping_dashboard';
$route['food_bverages_dashboard'] = 'HomeController/food_bverages_dashboard';



//super admin

//$route['Dashboard'] = 'SuperAdmincontroller';
$route['hotelLists'] = 'SuperAdminController/hotelLists';
$route['hotel_info'] = 'SuperAdminController/hotel_info';
$route['leadsPlan'] = 'SuperAdminController/leadsPlan';
$route['leadRecharge'] = 'SuperAdminController/leadRecharge';
$route['mng_credits'] = 'SuperAdminController/mng_credits';
$route['leads'] = 'SuperAdminController/leads';
$route['plan_purchase_hotels'] = 'SuperAdminController/plan_purchase_hotels';
$route['guest_panel'] = 'SuperAdminController/guest_panel';
$route['customer_list'] = 'SuperAdminController/customer_list';
$route['all_booking'] = 'SuperAdminController/all_booking';
$route['deparment'] = 'SuperAdminController/deparment';
$route['city'] = 'SuperAdminController/city';
$route['app_terms'] = 'SuperAdminController/app_terms';
$route['app_privacy'] = 'SuperAdminController/app_privacy';
$route['web_terms'] = 'SuperAdminController/web_terms';
$route['web_privacy'] = 'SuperAdminController/web_privacy';
$route['panel_noti'] = 'SuperAdminController/panel_noti';
$route['cancle_booking'] = 'SuperAdminController/cancle_booking';




//room service start

$route['menuNewOrder'] = 'RoomserviceController/menuNewOrder';
$route['menuAcceptedOrder'] = 'RoomserviceController/menuAcceptedOrder';
$route['menuCompletedOrder'] = 'RoomserviceController/menuCompletedOrder';
$route['menuRejectedOrder'] = 'RoomserviceController/menuRejectedOrder';
$route['roomServiceOrder'] = 'RoomserviceController/roomServiceOrder';
$route['roomServiceAcceptedOrder'] = 'RoomserviceController/roomServiceAcceptedOrder';
$route['roomServiceRejectedOrder'] = 'RoomserviceController/roomServiceRejectedOrder';
$route['roomServiceCompletedOrder'] = 'RoomserviceController/roomServiceCompletedOrder';
$route['menuManage'] = 'RoomserviceController/menuManage';
$route['menuManageAddCategories'] = 'RoomserviceController/menuManageAddCategories';
$route['serviceManagement'] = 'RoomserviceController/serviceManagement';
$route['miniBar'] = 'RoomserviceController/miniBar';
$route['staffManage'] = 'RoomserviceController/staffManage';
$route['roomServiceReview'] = 'RoomserviceController/roomServiceReview';
$route['managerHandover'] = 'RoomserviceController/managerHandover';
$route['managerHandoverUpdate'] = 'RoomserviceController/managerHandoverUpdate';
$route['staffHandover'] = 'RoomserviceController/staffHandover';
$route['staffCompletedHandover'] = 'RoomserviceController/staffCompletedHandover';

// chiragi add routs
$route['order_accep_req'] = 'RoomserviceController/order_accep_req';
$route['search_completed_order'] = 'RoomserviceController/search_completed_order';
$route['newroomServiceOrder'] = 'RoomserviceController/newroomServiceOrder';
$route['newroomServiceAcceptedOrder'] = 'RoomserviceController/newroomServiceAcceptedOrder';
$route['newroomServiceRejectedOrder'] = 'RoomserviceController/newroomServiceRejectedOrder';
$route['newroomServiceCompletedOrder'] = 'RoomserviceController/newroomServiceCompletedOrder';
$route['MenuManagementdata'] = 'RoomserviceController/MenuManagementdata';
$route['get_menu_service_data'] = 'RoomserviceController/get_menu_service_data';
$route['roomservice_update_manumodal'] = 'RoomserviceController/roomservice_update_manumodal';
// $route['ajaxmenuManageAddCategories'] = 'RoomserviceController/ajaxmenuManageAddCategories';
$route['staff_history/(:any)'] = 'RoomserviceController/staff_history';
// chiragi end routs

// room service end

///****************************************************************///
///**************************USER API Route************************///
///****************************************************************///

$route['user_registration'] = 'UserApi/user_registration'; //7/11/2022

$route['user_login'] = 'UserApi/user_login'; //7/11/2022

$route['verify_otp'] = 'UserApi/verify_otp'; //7/11/2022

$route['check_mobile_no'] = 'UserApi/check_mobile_no'; //7/11/2022

$route['login_with_otp'] = 'UserApi/login_with_otp'; //7/11/2022

$route['get_user_details'] = 'UserApi/get_user_details'; //7/11/2022

$route['edit_profile'] = 'UserApi/edit_profile'; //7/11/2022

$route['check_mobile_no_or_email'] = 'UserApi/check_mobile_no_or_email'; //7/11/2022

$route['otp_verified_for_change_password'] = 'UserApi/otp_verified_for_change_password'; //7/11/2022

$route['change_password'] = 'UserApi/change_password'; //7/11/2022

$route['home_page'] = 'UserApi/home_page'; //7/11/2022

$route['get_hotel_details'] = 'UserApi/get_hotel_details'; //7/11/2022

$route['send_enquiry_request'] = 'UserApi/send_enquiry_request'; //7/11/2022

$route['get_enquiry_request_list'] = 'UserApi/get_enquiry_request_list'; //8/11/2022

$route['is_confirm_booking'] = 'UserApi/is_confirm_booking'; //8/11/2022

$route['login_as_guest'] = 'UserApi/login_as_guest'; //8/11/2022

$route['verify_otp_for_guest_login'] = 'UserApi/verify_otp_for_guest_login'; //8/11/2022

$route['upload_id_proff_document'] = 'UserApi/upload_id_proff_document'; //8/11/2022

$route['get_user_notification'] = 'UserApi/get_user_notification'; //8/11/2022

$route['get_enquiry_request_details'] = 'UserApi/get_enquiry_request_details'; //9/11/2022

$route['get_hotels_offer_list'] = 'UserApi/get_hotels_offer_list'; //9/11/2022

$route['cancel_enquiry_request'] = 'UserApi/cancel_enquiry_request'; //9/11/2022

$route['reject_enquiry_request_by_user'] = 'UserApi/reject_enquiry_request_by_user'; //9/11/2022

///**************************AFTER GUEST LOGIN API************************///
///****************************************************************///

$route['my_hotel_booking_details'] = 'UserApi/my_hotel_booking_details'; //10/11/2022

$route['add_visitor'] = 'UserApi/add_visitor'; //10/11/2022

$route['get_help_support_list'] = 'UserApi/get_help_support_list'; //10/11/2022

$route['get_hotel_near_by_places_list'] = 'UserApi/get_hotel_near_by_places_list'; //10/11/2022

$route['get_hotel_near_by_places_details'] = 'UserApi/get_hotel_near_by_places_details'; //10/11/2022

$route['get_hotel_near_by_help_list'] = 'UserApi/get_hotel_near_by_help_list'; //10/11/2022

$route['get_hotel_near_by_help_details'] = 'UserApi/get_hotel_near_by_help_details'; //10/11/2022

$route['get_login_hotel_offer_list'] = 'UserApi/get_login_hotel_offer_list'; //10/11/2022

$route['get_hotel_guidelines'] = 'UserApi/get_hotel_guidelines'; //10/11/2022

$route['on_off_dnd_mode'] = 'UserApi/on_off_dnd_mode'; //10/11/2022

//order complaint api
$route['add_order_complaints'] = 'UserApi/add_order_complaints'; //10/11/2022

$route['get_my_order_complaint_list'] = 'UserApi/get_my_order_complaint_list'; //14/11/2022

//food related api
$route['get_our_food_facility'] = 'UserApi/get_our_food_facility'; //14/11/2022

$route['get_our_food_category'] = 'UserApi/get_our_food_category'; //14/11/2022

$route['get_our_breakfast_food_menu'] = 'UserApi/get_our_breakfast_food_menu'; //14/11/2022

$route['get_our_regular_food_menu'] = 'UserApi/get_our_regular_food_menu'; //14/11/2022

$route['get_our_today_special_food_menu'] = 'UserApi/get_our_today_special_food_menu'; //14/11/2022

$route['placed_order_for_food_menu'] = 'UserApi/placed_order_for_food_menu'; //14/11/2022

$route['cancel_food_menu_order'] = 'UserApi/cancel_food_menu_order'; //14/11/2022

$route['get_food_placed_order_details'] = 'UserApi/get_food_placed_order_details'; //15/11/2022

$route['is_paid_food_placed_order_amount'] = 'UserApi/is_paid_food_placed_order_amount'; //15/11/2022

//feedback
$route['add_feedback'] = 'UserApi/add_feedback'; //14/11/2022

//house keeping related api
$route['get_our_housekeeping_services'] = 'UserApi/get_our_housekeeping_services'; //15/11/2022

$route['placed_order_for_housekeeping_services'] = 'UserApi/placed_order_for_housekeeping_services'; //15/11/2022

$route['get_housekeeping_placed_order_details'] = 'UserApi/get_housekeeping_placed_order_details'; //15/11/2022

$route['cancel_house_keeping_service_order'] = 'UserApi/cancel_house_keeping_service_order'; //15/11/2022

$route['is_paid_housekeeping_service_placed_order_amount'] = 'UserApi/is_paid_housekeeping_service_placed_order_amount'; //15/11/2022

//laundry related data
$route['get_our_laundry_details'] = 'UserApi/get_our_laundry_details'; //15/11/2022

$route['placed_order_for_laundry'] = 'UserApi/placed_order_for_laundry'; //15/11/2022

$route['get_laundry_placed_order_details'] = 'UserApi/get_laundry_placed_order_details'; //15/11/2022

$route['cancel_laundry_order'] = 'UserApi/cancel_laundry_order'; //15/11/2022

$route['is_paid_laundry_placed_order_amount'] = 'UserApi/is_paid_laundry_placed_order_amount'; //15/11/2022

//other comlaints
$route['add_other_complaints'] = 'UserApi/add_other_complaints'; //23/11/2022

$route['get_my_other_complaint_list'] = 'UserApi/get_my_other_complaint_list'; //23/11/2022

//hotelservices
$route['get_our_hotel_services'] = 'UserApi/get_our_hotel_services'; //23/11/2022

//room service services
$route['get_our_hotel_roomservice_services'] = 'UserApi/get_our_hotel_roomservice_services'; //23/11/2022

$route['placed_order_for_roomservice_services'] = 'UserApi/placed_order_for_roomservice_services'; //23/11/2022

$route['get_roomservice_services_placed_order_details'] = 'UserApi/get_roomservice_services_placed_order_details'; //23/11/2022

$route['cancel_roomservice_services_order'] = 'UserApi/cancel_roomservice_services_order'; //23/11/2022

$route['is_paid_roomservice_services_placed_order_amount'] = 'UserApi/is_paid_roomservice_services_placed_order_amount'; //23/11/2022

//room service menu
$route['get_our_room_service_menu_category'] = 'UserApi/get_our_room_service_menu_category'; //23/11/2022

$route['get_our_room_service_menu_list_cateogory_wise'] = 'UserApi/get_our_room_service_menu_list_cateogory_wise'; //23/11/2022

$route['placed_order_for_room_service_menu'] = 'UserApi/placed_order_for_room_service_menu'; //23/11/2022

$route['get_room_service_menu_placed_order_details'] = 'UserApi/get_room_service_menu_placed_order_details'; //23/11/2022

$route['cancel_room_service_menu_order'] = 'UserApi/cancel_room_service_menu_order'; //23/11/2022

$route['is_paid_room_service_menu_placed_order_amount'] = 'UserApi/is_paid_room_service_menu_placed_order_amount'; //23/11/2022

$route['get_our_hotel_minibar'] = 'UserApi/get_our_hotel_minibar'; //24/11/2022

//all order request list not only complete order

$route['get_my_food_order_list'] = 'UserApi/get_my_food_order_list'; //24/11/2022

$route['get_my_housekeeping_order_list'] = 'UserApi/get_my_housekeeping_order_list'; //24/11/2022

$route['get_my_laundry_order_list'] = 'UserApi/get_my_laundry_order_list'; //24/11/2022

$route['get_my_room_service_services_order_list'] = 'UserApi/get_my_room_service_services_order_list'; //24/11/2022

$route['get_my_room_service_menu_order_list'] = 'UserApi/get_my_room_service_menu_order_list'; //24/11/2022

//reservation
//reserve table
$route['request_to_reserve_table'] = 'UserApi/request_to_reserve_table'; //24/11/2022

$route['cancel_reserve_table_request'] = 'UserApi/cancel_reserve_table_request'; //24/11/2022

$route['get_my_reserve_table_request_list'] = 'UserApi/get_my_reserve_table_request_list'; //24/11/2022

//business hall

$route['get_our_hotel_business_center_list'] = 'UserApi/get_our_hotel_business_center_list'; //24/11/2022

$route['request_to_reserve_business_center'] = 'UserApi/request_to_reserve_business_center'; //25/11/2022

$route['cancel_reserve_business_center_request'] = 'UserApi/cancel_reserve_business_center_request'; //25/11/2022

$route['get_my_reserve_business_center_request_list'] = 'UserApi/get_my_reserve_business_center_request_list'; //25/11/2022

//business hall

$route['get_our_hotel_banquet_hall_list'] = 'UserApi/get_our_hotel_banquet_hall_list'; //25/11/2022

$route['request_to_reserve_banquet_hall'] = 'UserApi/request_to_reserve_banquet_hall'; //25/11/2022

$route['cancel_reserve_banquet_hall_request'] = 'UserApi/cancel_reserve_banquet_hall_request'; //25/11/2022

$route['get_my_reserve_banquet_hall_request_list'] = 'UserApi/get_my_reserve_banquet_hall_request_list'; //25/11/2022

//sent request to cab

$route['sent_request_to_cab'] = 'UserApi/sent_request_to_cab'; //25/11/2022

$route['cancel_cab_request'] = 'UserApi/cancel_cab_request'; //25/11/2022

$route['get_my_cab_request_list'] = 'UserApi/get_my_cab_request_list'; //25/11/2022

$route['is_paid_cab_service_req_amount'] = 'UserApi/is_paid_cab_service_req_amount'; //25/11/2022

//clockroom request and details(luggage)

$route['get_our_hotel_luggage_charges'] = 'UserApi/get_our_hotel_luggage_charges'; //25/11/2022

$route['sent_request_to_luggage'] = 'UserApi/sent_request_to_luggage'; //25/11/2022

$route['cancel_luggage_request'] = 'UserApi/cancel_luggage_request'; //25/11/2022

$route['get_my_luggage_request_list'] = 'UserApi/get_my_luggage_request_list'; //25/11/2022

$route['is_paid_luggage_request_amount'] = 'UserApi/is_paid_luggage_request_amount'; //25/11/2022

//car wash request and details

$route['get_our_vehicle_wash_charges'] = 'UserApi/get_our_vehicle_wash_charges'; //25/11/2022

$route['sent_request_to_wash_my_vehicle'] = 'UserApi/sent_request_to_wash_my_vehicle'; //25/11/2022

$route['cancel_vehicle_wash_request'] = 'UserApi/cancel_vehicle_wash_request'; //25/11/2022

$route['get_my_vehicle_wash_request_list'] = 'UserApi/get_my_vehicle_wash_request_list'; //25/11/2022

$route['is_paid_my_vehicle_wash_request_amount'] = 'UserApi/is_paid_my_vehicle_wash_request_amount'; //25/11/2022

//hotels services list

$route['get_our_hotel_gym_services_details'] = 'UserApi/get_our_hotel_gym_services_details'; //28/11/2022

$route['get_our_hotel_pool_services_details'] = 'UserApi/get_our_hotel_pool_services_details'; //28/11/2022

$route['get_our_hotel_spa_services_details'] = 'UserApi/get_our_hotel_spa_services_details'; //28/11/2022

$route['get_our_hotel_baby_care_details'] = 'UserApi/get_our_hotel_baby_care_details'; //28/11/2022

$route['get_our_hotel_shuttle_service_details'] = 'UserApi/get_our_hotel_shuttle_service_details'; //28/11/2022

//login hotels food offers

$route['get_our_hotel_food_offers'] = 'UserApi/get_our_hotel_food_offers'; //28/11/2022

//chating with guest

$route['get_our_hotel_guest_list'] = 'UserApi/get_our_hotel_guest_list'; //29/11/2022

$route['send_message'] = 'UserApi/send_message'; //29/11/2022

$route['get_message'] = 'UserApi/get_message'; //29/11/2022

//lost and found 

$route['get_found_list'] = 'UserApi/get_found_list'; //29/11/2022

//city list and seraching hotel city wise

$route['get_city_list'] = 'UserApi/get_city_list'; //3/12/2022

$route['search_hotel_list_by_city'] = 'UserApi/search_hotel_list_by_city'; //3/12/2022

// user booking history

$route['get_my_booking_history'] = 'UserApi/get_my_booking_history'; //3/12/2022

$route['get_booking_details'] = 'UserApi/get_booking_details'; //3/12/2022

//room type hotel wise

$route['get_room_type'] = 'UserApi/get_room_type'; //7/12/2022

//api for notifications

$route['close_user_notification'] = 'UserApi/close_user_notification'; //7/12/2022

$route['close_all_user_notification'] = 'UserApi/close_all_user_notification'; //7/12/2022

//user paid unpaid bills

$route['get_my_paid_unpaid_bills'] = 'UserApi/get_my_paid_unpaid_bills'; //9/12/2022

//call waiter api
$route['call_waiter'] = 'UserApi/call_waiter'; //4/1/2023

//wakeup call
$route['wakeup_call'] = 'UserApi/wakeup_call'; //4/1/2023

//user confirm enquiry 
$route['get_my_confirm_enquiry_request_list'] = 'UserApi/get_my_confirm_enquiry_request_list'; //5/1/2023

//user all order completed list and pending list
$route['get_my_orders_list'] = 'UserApi/get_my_orders_list'; //10/1/2023

//user current stay
$route['my_currently_hotel_booking_details'] = 'UserApi/my_currently_hotel_booking_details'; //18/1/2023

//user hotel review
$route['add_hotel_review'] = 'UserApi/add_hotel_review'; //23/1/2023

//setting for guest login user
$route['my_settings'] = 'UserApi/my_settings'; //25/1/2023

//raise dispute order
$route['raise_dispute_order'] = 'UserApi/raise_dispute_order'; //27/1/2023

//get user setting 
$route['get_my_settings'] = 'UserApi/get_my_settings'; //30/1/2023

//get user setting 
$route['send_query_to_department'] = 'UserApi/send_query_to_department'; //30/1/2023

//get user setting 
$route['get_my_query_of_departments'] = 'UserApi/get_my_query_of_departments'; //30/1/2023

