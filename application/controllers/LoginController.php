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
            $token = $this->input->post('token');

            if(!empty($userType))
            {
                $check_email = $this->MainModel->check_email($email,md5($password), $userType);
            
                if($check_email)
                {
                    if($check_email['is_active'] == 1)
                    {
                        $where ='(u_id = "'.$check_email['u_id'].'")';
                        $token_details = $this->MainModel->getData($tbl ='user_firebase_tokens', $where);
                        
                        if(!empty($token_details))
                        {
                            $arr = array(
                                'u_id'  => $check_email['u_id'],
                                'token' => $token,
                            );
                            $add= $this->MainModel->editData($tbl='user_firebase_tokens', $where, $arr);  
                        }
                        else
                        {
                            $arr = array(
                                'u_id'  => $check_email['u_id'],
                                'token' => $token,
                            );
                            $add = $this->MainModel->insert_data('user_firebase_tokens', $arr);
                        }
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
                        $this->session->set_userdata('selected_role', $userType);
                        $this->session->set_flashdata('entered_email', $email);
                        $this->session->set_flashdata('entered_password', $password);

                        redirect(base_url());
                    }
                }
                else
                {
                    $this->session->set_flashdata('error_msg','<strong style="color:#ff7826">Wrong Email id or Password</strong>');
                    $this->session->set_userdata('selected_role', $userType);
                    $this->session->set_flashdata('entered_email', $email);
                    $this->session->set_flashdata('entered_password', $password);

                    redirect(base_url());
                }
            }
            else
            {
                $this->session->set_flashdata('error_msg','<strong style="color:#ff7826">PLease Select Your Role</strong>');
                $this->session->set_flashdata('entered_email', $email);
                $this->session->set_flashdata('entered_password', $password);

                redirect(base_url());
            }
        }

        public function app_login() {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $userType = $this->input->post('userType');
            $token = $this->input->post('token');
        
            // Check if the userType is provided
            if (!empty($userType)) {
                // Validate the email and password
                $check_email = $this->MainModel->check_email($email, md5($password), $userType);
        
                if ($check_email) {
                    if ($check_email['is_active'] == 1) {
                        // Check or update token details
                        $where = '(u_id = "' . $check_email['u_id'] . '")';
                        $token_details = $this->MainModel->getData('user_firebase_tokens', $where);
        
                        $arr = array(
                            'u_id'  => $check_email['u_id'],
                            'token' => $token,
                        );
        
                        if (!empty($token_details)) {
                            $this->MainModel->editData('user_firebase_tokens', $where, $arr);
                        } else {
                            $this->MainModel->insert_data('user_firebase_tokens', $arr);
                        }
        
                        // Prepare success response
                        $response = array(
                            'status'  => 'success',
                            'message' => 'Login successful',
                            'data'    => array(
                                'u_id'      => $check_email['u_id'],
                                'userType'  => $userType,
                                'full_name' => $check_email['full_name'],
                                'phone'     => $check_email['mobile_no'],
                                'email_id'  => $check_email['email_id'],
                            ),
                        );
                    } else {
                        // Account deactivated response
                        $response = array(
                            'status'  => 'error',
                            'message' => 'Your account is deactivated',
                        );
                    }
                } else {
                    // Invalid email or password response
                    $response = array(
                        'status'  => 'error',
                        'message' => 'Wrong email or password',
                    );
                }
            } else {
                // Role not selected response
                $response = array(
                    'status'  => 'error',
                    'message' => 'Please select your role',
                );
                
            }
        
            // Return JSON response
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    
        }
        

     // admin logout function 22-08-2022 //ravina
      public function logout()
      {
          $this->session->sess_destroy();
          redirect(base_url());
      }
}
