<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FireBaseController extends CI_Controller {

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

	public function index()
	{ 
        // $this->load->view('include/header');
        $this->load->view('firebase_notifications_view');
        // $this->load->view('include/footer');

    }

}
