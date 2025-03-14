<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		 $this->load->model('MainModel');
		// $this->load->library('pagination');   
	}
	public function index()
	{   
		$this->load->view('auth/login');
	}

	 // Super admin login.....//Supriya
        public function page_login()
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $userType = $this->input->post('userType');

            $check_email = $this->MainModel->check_email($email,md5($password), $userType);
           
            if($check_email)
            {
                if($check_email['is_active'] == 1)
                {
                    $session_data = array(
                                          'u_id' => $check_email['u_id'],
                                          'userType' => $userType,  
                                          'full_name' => $check_email['full_name'],
                                          'phone' => $check_email['mobile_no'],
                                          'email_id' => $check_email['email_id']
                                        );

                    $this->session->set_userdata($session_data);
                    $this->session->set_flashdata('msg','You Have Successfully Logged in');
                    redirect(base_url('Dashboard'));
                }
                else
                {
                    $this->session->set_flashdata('error_msg','<strong style="color:#ff7826">Your Account is Deactivated</strong>');
                    redirect(base_url());
                }
            }
            else
            {
                $this->session->set_flashdata('error_msg','<strong style="color:#ff7826">Wrong Email id or Password</strong>');
                redirect(base_url());
            }
        }

     // admin logout function 22-08-2022 //ravina
      public function logout()
      {
          $this->session->sess_destroy();
          redirect(base_url());
      }
}
