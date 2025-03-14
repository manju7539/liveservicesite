<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPasswordController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		 $this->load->model('MainModel');
		// $this->load->library('pagination');   
      
        $this->load->library('form_validation');
	}
	public function index()
	{   
		$this->load->view('auth/forgot_password');
	}
    public function sendResetLink() {
        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_exists');
        
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, show error messages or redirect to the form page with an error message
            $this->session->set_flashdata('error_msg', 'Invalid email address.');
            redirect('ForgotPasswordController');
        } else {
            // Validation passed, generate a unique token and save it in the database along with the email address
            $email = $this->input->post('email');
            $user = $this->MainModel->getUserByEmail($email); // Replace with your method to get the user by email
            // print_r($user);die;
            
            
            if ($user) {
                $token = md5(uniqid(rand(), true));
                $this->MainModel->saveResetToken($email, $token); // Replace with your method to save the reset token
                // print_r($token);die;
                
                // Send the password reset email
                $this->load->library('email');
                $this->email->from('vivek.barvaliya.metizsoft@gmail.com', 'vivek barvaliya');
                $this->email->to($email);
                $this->email->subject('Password Reset');
                $this->email->message('Click the following link to reset your password: ' . base_url('ForgotPasswordController/reset/' . $token));
                $this->email->send();
                // Send the email
if ($this->email->send()) {
    echo 'Email sent successfully.';
} else {
    echo 'Email sending failed. Error: ' . $this->email->print_debugger();die;
}

                // echo $this->email->print_debugger();
                
                $this->session->set_flashdata('success_msg', 'An email with instructions to reset your password has been sent.');
                redirect('LoginController'); // Replace with your login controller
            } else {
                $this->session->set_flashdata('error_msg', 'Email address not found.');
                redirect('ForgotPasswordController');
            }
        }
    }

    // reset controller method
    public function reset($token) {
        // Validate the token and check if it exists in the database
        $user = $this->MainModel->getUserByResetToken($token); // Replace with your method to get the user by reset token
        
        if ($user) {
            // Display the password reset form
            $data['token'] = $token;
            $this->load->view('auth/reset_password', $data);
        } else {
            // Token is invalid or expired, show error message or redirect to an error page
            $this->session->set_flashdata('error_msg', 'Invalid or expired reset token.');
            redirect('ForgotPasswordController');
        }
    }
    
    public function updatePassword() {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
        
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, show error messages or redirect to the form page with an error message
            $data['token'] = $this->input->post('token');
            $this->load->view('auth/reset_password', $data);
        } else {
            // Validation passed, update the user's password in the database
            $token = $this->input->post('token');
            $password = $this->input->post('password');
            
            $this->MainModel->resetPassword($token, $password); // Replace with your method to reset the password
            
            $this->session->set_flashdata('success_msg', 'Your password has been reset successfully.');
            redirect('LoginController'); // Replace with your login controller
        }
    }
    public function email_exists($email)
    {
        $user = $this->MainModel->getUserByEmail($email);
    
        if (!$user) {
            $this->form_validation->set_message('email_exists', 'Email address not found.');
            return false;
        }
    
        return true;
    }
	

}
