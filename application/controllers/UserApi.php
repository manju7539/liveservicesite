<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserApi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->model('ApiModel');
        $this->load->helper('notification_helper');
        $this->load->model('MainModel');
    }

    //formate//7-11-2022 //archana
    public function formate()
    {
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');


            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //user registration /7/11/2022 //archana
    // public function user_registration()
    // {
    //     if(!empty($this->input->post('name')) && !empty($this->input->post('mobile_no')) && !empty($this->input->post('email')) && !empty($this->input->post('password')) && !empty($this->input->post('city')) && !empty($this->input->post('id_proff_img')))
    //     {
    //         $name = $this->input->post('name');
    //         $mobile_no = $this->input->post('mobile_no');
    //         $email = $this->input->post('email');
    //         $password = $this->input->post('password');
    //         $city = $this->input->post('city');
    //         $id_proff_img_base64 = $this->input->post('id_proff_img');


    //         $check_mobile_no = $this->ApiModel->check_mobile_no($mobile_no);

    //         $check_email_id = $this->ApiModel->check_email_id($email);

    //         $rand_no = rand('1111','9999');

    //         if(empty($check_mobile_no))
    //         {
    //             if(empty($check_email_id))
    //             {      
    //                 $b64 = $id_proff_img_base64;
    //                 $bin = base64_decode($b64);
    //                 $size = getImageSizeFromString($bin);

    //                 // Check the MIME type to be sure that the binary data is an image
    //                 if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
    //                     die('Base64 value is not a valid image');
    //                 }

    //                 $ext = substr($size['mime'], 6);

    //                 // Make sure that you save only the desired file extensions
    //                 if (!in_array($ext, ['png', 'gif', 'jpeg'])) {
    //                     die('Unsupported image type');
    //                 }


    //                 $base_url= base_url();
    //                 $upload_dir = 'assets/upload/id_proff_pic_for_add_booking/';
    //                 $file_name = md5(uniqid()) . '.' . $ext; 
    //                 $file_path = $upload_dir . $file_name;
    //                 $response1 = file_put_contents($file_path, $bin);

    //                 if ($response1) {
    //                     // Update the database with the image path
    //                     $img_url = $base_url . $file_path;


    //                     $arr = array(
    //                                 'user_type' => 0,
    //                                 'guest_type' => 1,
    //                                 'full_name' => $name,
    //                                 'email_id' => $email,
    //                                 'mobile_no' => $mobile_no,
    //                                 'password' => md5($password),
    //                                 'password_text' => $password,
    //                                 'otp' => $rand_no,	
    //                                 'city' => $city,
    //                                 'guest_type' => 1,
    //                                 //  'is_active' => 1,
    //                                 'register_date' => date('Y-m-d'),
    //                                 'Id_proff_photo' => $img_url,
    //                                 );

    //                     $add = $this->ApiModel->insert_data('register',$arr);

    //                     if($add)
    //                     {
    //                         $wh = '(city_id = "'.$city.'")';

    //                         $city_data = $this->ApiModel->getData('city',$wh);

    //                         $city_name = "";

    //                         if($city_data)
    //                         {
    //                             $city_name =$city_data['city'];
    //                         }

    //                         $send_data[] = array(
    //                                                 'u_id' => $add,
    //                                                 'full_name' => $name,
    //                                                 'email_id' => $email,
    //                                                 'mobile_no' => $mobile_no,
    //                                                 'otp' => $rand_no,
    //                                                 'city' => $city_name,
    //                                                 'Id_proff_photo' => $img_url,
    //                                             );

    //                         $response['error_code'] = "200";
    //                         $response['message'] = "Registration is done..!";
    //                         $response['data'] = $send_data;
    //                         echo json_encode($response);
    //                         exit();
    //                     }
    //                     else
    //                     {
    //                         $response['error_code'] = "403";
    //                         $response['message'] = "Something went wrong";
    //                         echo json_encode($response);
    //                         exit();
    //                     }
    //                 } 
    //                 else 
    //                 {
    //                     $response['error_code'] = "403";
    //                     $response['message'] = "Error saving image file";
    //                     echo json_encode($response);
    //                     exit();
    //                 }
    //             }
    //             else
    //             {
    //                 $response['error_code'] = "401";
    //                 $response['message'] = "Email id already exits..!";
    //                 echo json_encode($response);
    //                 exit();
    //             }
    //         }
    //         else
    //         {
    //             $response['error_code'] = "401";
    //             $response['message'] = "Mobile number already exits..!";
    //             echo json_encode($response);
    //             exit();
    //         }

    //     }
    //     else
    //     {
    //         $response['error_code'] = "406";
    //         $response['message'] = "Required Parameter Missing..!";
    //         echo json_encode($response);
    //         exit();
    //     }
    // }


    // User registration function (updated with debug logs and enhanced error handling)
    // public function user_registration()
    // {
    //     // Check if all required parameters are present
    //     if (!empty($this->input->post('name')) &&
    //         !empty($this->input->post('mobile_no')) &&
    //         !empty($this->input->post('email')) &&
    //         !empty($this->input->post('password')) &&
    //         !empty($this->input->post('city')) &&
    //         !empty($this->input->post('id_proff_img'))) 
    //     {
    //         $name = $this->input->post('name');
    //         $mobile_no = $this->input->post('mobile_no');
    //         $email = $this->input->post('email');
    //         $password = $this->input->post('password');
    //         $city = $this->input->post('city');
    //         $id_proff_img_base64 = $this->input->post('id_proff_img');

    //         // Log debug message for received input
    //         log_message('debug', 'Received POST data: ' . json_encode($this->input->post()));

    //         // Check if the mobile number already exists
    //         $check_mobile_no = $this->ApiModel->check_mobile_no($mobile_no);
    //         $check_email_id = $this->ApiModel->check_email_id($email);
    //         $rand_no = rand(1111, 9999);

    //         if (empty($check_mobile_no)) {
    //             if (empty($check_email_id)) {
    //                 // Decode base64 image
    //                 $b64 = $id_proff_img_base64;
    //                 $bin = base64_decode($b64);
    //                 $size = getImageSizeFromString($bin);

    //                 // Validate MIME type of the image
    //                 if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
    //                     $response = [
    //                         'error_code' => "406",
    //                         'message' => "Base64 value is not a valid image."
    //                     ];
    //                     echo json_encode($response);
    //                     exit();
    //                 }

    //                 $ext = substr($size['mime'], 6);

    //                 // Check allowed file extensions
    //                 if (!in_array($ext, ['png', 'gif', 'jpeg', 'jpg'])) {
    //                     $response = [
    //                         'error_code' => "406",
    //                         'message' => "Unsupported image type. Only png, gif, and jpeg are allowed."
    //                     ];
    //                     echo json_encode($response);
    //                     exit();
    //                 }

    //                 // Define file upload directory
    //                 $upload_dir = 'assets/upload/id_proff_pic_for_add_booking/';
    //                 if (!is_dir($upload_dir)) {
    //                     mkdir($upload_dir, 0777, true); // Ensure directory exists
    //                 }

    //                 $file_name = md5(uniqid()) . '.' . $ext;
    //                 $file_path = $upload_dir . $file_name;
    //                 $response1 = file_put_contents($file_path, $bin);

    //                 // Check if the file was saved successfully
    //                 if ($response1 === false) {
    //                     $response = [
    //                         'error_code' => "403",
    //                         'message' => "Error saving image file."
    //                     ];
    //                     echo json_encode($response);
    //                     exit();
    //                 }

    //                 $img_url = base_url($file_path);

    //                 // Prepare data for insertion
    //                 $data = [
    //                     'user_type' => 0,
    //                     'guest_type' => 1,
    //                     'full_name' => $name,
    //                     'email_id' => $email,
    //                     'mobile_no' => $mobile_no,
    //                     'password' => md5($password),
    //                     'password_text' => $password,
    //                     'otp' => $rand_no,
    //                     'city' => $city,
    //                     'register_date' => date('Y-m-d'),
    //                     'Id_proff_photo' => $img_url,
    //                 ];

    //                 $add = $this->ApiModel->insert_data('register', $data);

    //                 if ($add) {
    //                     $wh = '(city_id = "' . $city . '")';
    //                     $city_data = $this->ApiModel->getData('city', $wh);
    //                     $city_name = $city_data ? $city_data['city'] : "";

    //                     $send_data[] = [
    //                         'u_id' => $add,
    //                         'full_name' => $name,
    //                         'email_id' => $email,
    //                         'mobile_no' => $mobile_no,
    //                         'otp' => $rand_no,
    //                         'city' => $city_name,
    //                         'Id_proff_photo' => $img_url,
    //                     ];

    //                     $response = [
    //                         'error_code' => "200",
    //                         'message' => "Registration is done!",
    //                         'data' => $send_data
    //                     ];
    //                     echo json_encode($response);
    //                     exit();
    //                 } else {
    //                     $response = [
    //                         'error_code' => "403",
    //                         'message' => "Something went wrong."
    //                     ];
    //                     echo json_encode($response);
    //                     exit();
    //                 }
    //             } else {
    //                 $response = [
    //                     'error_code' => "401",
    //                     'message' => "Email ID already exists!"
    //                 ];
    //                 echo json_encode($response);
    //                 exit();
    //             }
    //         } else {
    //             $response = [
    //                 'error_code' => "401",
    //                 'message' => "Mobile number already exists!"
    //             ];
    //             echo json_encode($response);
    //             exit();
    //         }
    //     } else {
    //         // Identify missing parameters
    //         $missing_params = [];
    //         foreach (['name', 'mobile_no', 'email', 'password', 'city', 'id_proff_img'] as $param) {
    //             if (empty($this->input->post($param))) {
    //                 $missing_params[] = $param;
    //             }
    //         }
    //         log_message('error', 'Missing parameters: ' . implode(', ', $missing_params));

    //         $response = [
    //             'error_code' => "406",
    //             'message' => "Parameter(s) '" . implode(', ', $missing_params) . "' is missing."
    //         ];


    //         echo json_encode($response);
    //         exit();
    //     }
    // }

    public function user_registration()
    {
        // Check if all required parameters are present
        if (
            !empty($this->input->post('name')) &&
            !empty($this->input->post('mobile_no')) &&
            !empty($this->input->post('email')) &&
            !empty($this->input->post('password')) &&
            !empty($this->input->post('city')) &&
            !empty($_FILES['id_proff_img']['tmp_name'])
        ) {
            $name = $this->input->post('name');
            $mobile_no = $this->input->post('mobile_no');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $city = $this->input->post('city');

            log_message('debug', 'Received POST data: ' . json_encode($this->input->post()));

            // Check if the mobile number or email already exists
            $check_mobile_no = $this->ApiModel->check_mobile_no($mobile_no);
            $check_email_id = $this->ApiModel->check_email_id($email);
            $rand_no = rand(1111, 9999);

            if (empty($check_mobile_no)) {
                if (empty($check_email_id)) {
                    // Define upload directory
                    $upload_dir = 'assets/upload/id_proff_pic_for_add_booking/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true); // Create directory if not exists
                    }

                    // Generate unique file name
                    $file_name = md5(uniqid()) . '.' . pathinfo($_FILES['id_proff_img']['name'], PATHINFO_EXTENSION);
                    $file_path = $upload_dir . $file_name;

                    // Move uploaded file to the directory
                    if (!move_uploaded_file($_FILES['id_proff_img']['tmp_name'], $file_path)) {
                        $response = [
                            'error_code' => "403",
                            'message' => "Error saving image file."
                        ];
                        echo json_encode($response);
                        exit();
                    }

                    // Generate file URL
                    $img_url = base_url($file_path);

                    // Prepare data for insertion, including the new login_type field
                    $data = [
                        'user_type' => 0,
                        'is_active' => 1,
                        'guest_type' => 1,
                        'full_name' => $name,
                        'email_id' => $email,
                        'mobile_no' => $mobile_no,
                        'password' => md5($password),
                        'password_text' => $password,
                        'otp' => $rand_no,
                        'city' => $city,
                        'register_date' => date('Y-m-d'),
                        'Id_proff_photo' => $img_url,
                        'login_type' => 1, // Added the login_type field with value 1
                    ];

                    // Insert user data into the database
                    $add = $this->ApiModel->insert_data('register', $data);

                    if ($add) {
                        // Fetch city name
                        $wh = '(city_id = "' . $city . '")';
                        $city_data = $this->ApiModel->getData('city', $wh);
                        $city_name = $city_data ? $city_data['city'] : "";

                        // Send response
                        $send_data[] = [
                            'u_id' => $add,
                            'full_name' => $name,
                            'email_id' => $email,
                            'mobile_no' => $mobile_no,
                            'otp' => $rand_no,
                            'city' => $city_name,
                            'Id_proff_photo' => $img_url,
                        ];

                        $response = [
                            'error_code' => "200",
                            'message' => "Registration is done!",
                            'data' => $send_data
                        ];
                        echo json_encode($response);
                        exit();
                    } else {
                        $response = [
                            'error_code' => "403",
                            'message' => "Something went wrong."
                        ];
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response = [
                        'error_code' => "401",
                        'message' => "Email ID already exists!"
                    ];
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response = [
                    'error_code' => "401",
                    'message' => "Mobile number already exists!"
                ];
                echo json_encode($response);
                exit();
            }
        } else {
            // Identify missing parameters
            $missing_params = [];
            foreach (['name', 'mobile_no', 'email', 'password', 'city', 'id_proff_img'] as $param) {
                if (empty($this->input->post($param)) && empty($_FILES['id_proff_img']['tmp_name'])) {
                    $missing_params[] = $param;
                }
            }
            log_message('error', 'Missing parameters: ' . implode(', ', $missing_params));

            $response = [
                'error_code' => "406",
                'message' => "Parameter(s) '" . implode(', ', $missing_params) . "' is missing."
            ];
            echo json_encode($response);
            exit();
        }
    }



    //user login /7/11/2022 //archana


    // public function user_login()
    // {
    //     if(!empty($this->input->post('login_id')) && !empty($this->input->post('password')))
    //     {
    //         $login_id = $this->input->post('login_id');
    //         $password = $this->input->post('password');

    //         $wh = '(email_id = "'.$login_id.'" AND password = "'.md5($password).'" AND user_type = 0) OR (mobile_no = "'.$login_id.'"  AND password = "'.md5($password).'" AND user_type = 0)';

    //         $user = $this->ApiModel->getData('register',$wh);

    //         if($user)
    //         {      
    //             if($user['is_active'] == 1)
    //             {
    //                 $send_data[] = array(
    //                                         'u_id' => $user['u_id'],
    //                                         'full_name' => $user['full_name'],
    //                                         'email_id' => $user['email_id'],
    //                                         'mobile_no' => $user['mobile_no']
    //                                     );

    //                 $response['error_code'] = "200";
    //                 $response['message'] = "You Have Successfully Logged in";
    //                 $response['data'] = $send_data;
    //                 echo json_encode($response);
    //                 exit();
    //             }
    //             else
    //             {
    //                 $response['error_code'] = "401";
    //                 $response['message'] = "Your Account is deactivated";
    //                 echo json_encode($response);
    //                 exit();
    //             }
    //         }
    //         else
    //         {
    //             $response['error_code'] = "401";
    //             $response['message'] = "Email/Mobile OR Password Doesn't Match. Please Check";
    //             echo json_encode($response);
    //             exit();
    //         }
    //     }
    //     else
    //     {
    //         $response['error_code'] = "406";
    //         $response['message'] = "Required Parameter Missing..!";
    //         echo json_encode($response);
    //         exit();
    //     }
    // }


    public function send_json_response($error_code, $message, $data = [])
    {
        echo json_encode([
            'error_code' => (string) $error_code,
            'message' => $message,
            'data' => $data
        ]);
        exit(); // End the script execution after sending response
    }

    /**
     * User Verification
     */


    public function user_verification()
    {
        // Get input data
        $email = trim($this->input->post('email', true));
        $google_token = trim($this->input->post('google_token', true));
        $name = trim($this->input->post('name', true) ?? '');
        $mobile_no = trim($this->input->post('mobile_no', true) ?? '');
        $city = trim($this->input->post('city', true) ?? '');

        // Validate required parameters
        if (empty($email) || empty($google_token)) {
            return $this->send_json_response(406, "Missing required parameter(s): Email and Google Token are mandatory.");
        }

        // Debugging logs
        log_message('debug', "Received Inputs - Email: $email, Name: '$name', Mobile: '$mobile_no', City: '$city'");

        // Check if email exists in the database
        $this->db->where('email_id', $email);
        $this->db->where('is_active', 1);
        $check_email_id = $this->db->get('register')->row_array();

        if (!empty($check_email_id)) {
            // User exists, retrieve details from the database
            // Check if name or mobile_no is empty
            $status = !empty($check_email_id['full_name']) && !empty($check_email_id['mobile_no']) ? true : false;

            return $this->send_json_response(200, "Success", [
                'u_id' => $check_email_id['u_id'],
                'message' => 'Already Registered',
                'status' => $status, // Set status to false if name or mobile_no is empty
                'email' => $check_email_id['email_id'],
                'mobile_no' => $check_email_id['mobile_no'],
                'name' => $check_email_id['full_name']
            ]);
        }

        // Register new user
        $data = [
            'user_type' => 0,
            'guest_type' => 1,
            'login_type' => 2, // Google login
            'is_active' => 1, // Active user
            'full_name' => $name,
            'email_id' => $email,
            'mobile_no' => $mobile_no,
            'google_token' => $google_token,
            'city' => $city,
            'register_date' => date('Y-m-d')
        ];

        // Insert new user data and get the inserted ID
        $inserted_id = $this->ApiModel->insert_data('register', $data);

        // Check if the user was inserted and validate the newly inserted data
        if ($inserted_id) {
            // After registration, check if the name or mobile_no is empty
            $status = !empty($name) && !empty($mobile_no) ? true : false;

            return $this->send_json_response(200, "Success", [
                'u_id' => $inserted_id,
                'message' => 'Successfully Registered',
                'status' => $status, // Set status to false if name or mobile_no is empty
                'email' => $email,
                'mobile_no' => $mobile_no,
                'name' => $name
            ]);
        } else {
            return $this->send_json_response(500, "Something went wrong during registration.");
        }
    }









    public function user_login()
    {
        header('Content-Type: application/json'); // Ensure JSON response

        if (!empty($this->input->post('login_id')) && !empty($this->input->post('password'))) {
            $login_id = $this->input->post('login_id');
            $password = md5($this->input->post('password')); // Hash password

            // Use CodeIgniter's Query Builder
            $this->db->where("(email_id = '$login_id' OR mobile_no = '$login_id')", NULL, FALSE);
            $this->db->where([
                'password' => $password,
                'user_type' => 0,
                'login_type' => 1
            ]);

            $user = $this->db->get('register')->row_array(); // Fetch user

            if ($user) {
                if ($user['is_active'] == 1) {
                    // Ensure 'data' is an array of arrays
                    $response = [
                        'error_code' => "200",
                        'message' => "You Have Successfully Logged in",
                        'data' => [
                            [
                                'u_id' => $user['u_id'],
                                'full_name' => $user['full_name'],
                                'email_id' => $user['email_id'],
                                'mobile_no' => $user['mobile_no']
                            ]
                        ]
                    ];
                } else {
                    $response = [
                        'error_code' => "401",
                        'message' => "Your Account is deactivated"
                    ];
                }
            } else {
                $response = [
                    'error_code' => "401",
                    'message' => "Email/Mobile OR Password Doesn't Match. Please Check"
                ];
            }
        } else {
            $response = [
                'error_code' => "406",
                'message' => "Required Parameter Missing..!"
            ];
        }

        echo json_encode($response);
        exit();
    }



    //verify otp //7-11-2022 //archana 
    public function verify_otp()
    {
        if (!empty($this->input->post('login_id')) && !empty($this->input->post('otp'))) {
            $login_id = $this->input->post('login_id');
            $otp = $this->input->post('otp');

            $wh = '(email_id = "' . $login_id . '" AND otp	 = "' . $otp . '" AND user_type = 0) OR (mobile_no = "' . $login_id . '"  AND otp	 = "' . $otp . '" AND user_type = 0)';

            $user = $this->ApiModel->getData('register', $wh);

            if ($user) {
                $arr = array(
                    'is_otp_verified' => 1,
                    'is_active' => 1,
                );

                $up = $this->ApiModel->edit_data('register', $wh, $arr);

                if ($up) {
                    $send_data[] = array(
                        'u_id' => $user['u_id']
                    );

                    $response['error_code'] = "200";
                    $response['message'] = "OTP verified successfully..";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Something went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "401";
                $response['message'] = "Mobile no and OTP Doest not match";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //check mobile number //7-11-2022 //archana 
    public function check_mobile_no()
    {
        if (!empty($this->input->post('mobile_no'))) {
            $mobile_no = $this->input->post('mobile_no');

            $check_mobile_no = $this->ApiModel->check_mobile_no($mobile_no);

            $rand_no = rand('1111', '9999');

            $wh = '(mobile_no = "' . $mobile_no . '" AND user_type = 0)';

            if ($check_mobile_no) {
                $arr = array(
                    'otp' => $rand_no,
                );

                $up = $this->ApiModel->edit_data('register', $wh, $arr);

                if ($up) {
                    $send_data[] = array(
                        'mobile_no' => $mobile_no,
                        'otp' => $rand_no,
                    );

                    $response['error_code'] = "200";
                    $response['message'] = "Success";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Something went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "401";
                $response['message'] = "In correct Mobile no";
                echo json_encode($response);
                exit();
            }

        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //login with otp and verified number //7-11-2022 //archana 
    public function login_with_otp()
    {
        if (!empty($this->input->post('mobile_no')) && !empty($this->input->post('otp'))) {
            $mobile_no = $this->input->post('mobile_no');
            $otp = $this->input->post('otp');

            $wh = '(mobile_no = "' . $mobile_no . '" AND otp = "' . $otp . '" AND user_type = 0)';

            $user = $this->ApiModel->getData('register', $wh);

            if ($user) {
                $arr = array(
                    'is_otp_verified_for_mobile_login' => 1,
                );

                $up = $this->ApiModel->edit_data('register', $wh, $arr);

                if ($up) {
                    $send_data[] = array(
                        'u_id' => $user['u_id'],
                        'mobile_no' => $user['mobile_no'],
                        'email_id' => $user['email_id'],
                        'full_name' => $user['full_name'],

                    );

                    $response['error_code'] = "200";
                    $response['message'] = "You Have Successfully Logged in";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Something went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "401";
                $response['message'] = "Mobile no and OTP Doest not match";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //get user details //7-11-2022 //archana 
    public function get_user_details()
    {
        // echo 'hi';die;
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $wh = '(city_id = "' . $user['city'] . '")';

                $city_data = $this->ApiModel->getData('city', $wh);

                $city_name = "";

                if ($city_data) {
                    $city_name = $city_data['city'];
                }

                $send_data[] = array(
                    'u_id' => $user['u_id'],
                    'full_name' => $user['full_name'],
                    'email_id' => $user['email_id'],
                    'mobile_no' => $user['mobile_no'],
                    'profile_photo' => $user['profile_photo'],
                    'address' => $user['address'],
                    'city_name' => $city_name
                );

                $response['error_code'] = "200";
                $response['message'] = "Success";
                $response['data'] = $send_data;
                echo json_encode($response);
                exit();
            } else {
                $response['error_code'] = "403";
                $response['message'] = "User Not Found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //edit profile //7-11-2022 //archana 
    public function edit_profile()
    {
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');
            $profile_photo = $this->input->post('profile_photo');
            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                if ($profile_photo) {
                    $b64 = $profile_photo;
                    $bin = base64_decode($b64);
                    $size = getImageSizeFromString($bin);

                    // Check the MIME type to be sure that the binary data is an image
                    if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
                        die('Base64 value is not a valid image');
                    }

                    $ext = substr($size['mime'], 6);

                    // Make sure that you save only the desired file extensions
                    if (!in_array($ext, ['png', 'gif', 'jpeg'])) {
                        die('Unsupported image type');
                    }


                    $base_url = base_url();
                    $upload_dir = 'assets/upload/user_photo/';
                    $file_name = md5(uniqid()) . '.' . $ext;
                    $file_path = $upload_dir . $file_name;
                    $response1 = file_put_contents($file_path, $bin);

                    if ($response1) {
                        $img_url = $base_url . $file_path;
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Error saving image file";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $img_url = $user['profile_photo'];
                }
                $wh = '(u_id = "' . $u_id . '")';


                if (isset($_POST['name'])) {
                    $name = $this->input->post('name');
                } else {
                    $name = $user['full_name'];
                }

                if (isset($_POST['address'])) {
                    $address = $this->input->post('address');
                } else {
                    $address = $user['address'];
                }

                if (isset($_POST['mobile_no'])) {
                    $mobile_no = $this->input->post('mobile_no');

                    $wh_m = 'mobile_no ="' . $mobile_no . '" AND u_id != "' . $u_id . '"';
                    $exist_mobile_no = $this->ApiModel->getData('register', $wh_m);
                    if ($exist_mobile_no) {
                        $response['error_code'] = "403";
                        $response['message'] = "This Mobile Number Is Already Exist";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $mobile_no = $user['mobile_no'];
                }

                if (isset($_POST['email_id'])) {
                    $email_id = $this->input->post('email_id');

                    $wh_m = 'email_id ="' . $email_id . '" AND u_id != "' . $u_id . '"';
                    $exist_email_id = $this->ApiModel->getData('register', $wh_m);
                    if ($exist_email_id) {
                        $response['error_code'] = "403";
                        $response['message'] = "This Email Id Is Already Exist";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $email_id = $user['email_id'];
                }

                $arr = array(
                    'full_name' => $name,
                    'profile_photo' => $img_url,
                    'address' => $address,
                    'mobile_no' => $mobile_no,
                    'email_id' => $email_id,
                );

                $up = $this->ApiModel->edit_data('register', $wh, $arr);

                if ($up) {
                    $user1 = $this->ApiModel->get_user_data($u_id);

                    $send_data[] = array(
                        'u_id' => $u_id,
                        'full_name' => $user1['full_name'],
                        'profile_photo' => $user1['profile_photo'],
                        'address' => $user1['address'],
                        'mobile_no' => $user1['mobile_no'],
                        'email_id' => $user1['email_id'],
                    );

                    $response['error_code'] = "200";
                    $response['message'] = "Profile updated Successfully...";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Something went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //check mobile number or email id //7-11-2022 //archana 
    public function check_mobile_no_or_email()
    {
        if (!empty($this->input->post('login_id'))) {
            $login_id = $this->input->post('login_id');

            $wh = '(email_id = "' . $login_id . '" AND user_type = 0) OR (mobile_no = "' . $login_id . '" AND user_type = 0)';

            $user = $this->ApiModel->getData('register', $wh);

            $rand_no = rand('1111', '9999');

            if ($user) {
                $arr = array(
                    'otp_for_change_password' => $rand_no
                );

                $up = $this->ApiModel->edit_data('register', $wh, $arr);

                if ($up) {
                    $send_data[] = array(
                        'u_id' => $user['u_id'],
                        'otp' => $rand_no
                    );

                    $response['error_code'] = "200";
                    $response['message'] = "Success";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Something went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "Email/Mobile is incorrect";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //otp verified for change password//7-11-2022 //archana 
    public function otp_verified_for_change_password()
    {
        if (!empty($this->input->post('login_id')) && !empty($this->input->post('otp'))) {
            $login_id = $this->input->post('login_id');
            $otp = $this->input->post('otp');

            $wh = '(email_id = "' . $login_id . '" AND otp_for_change_password = "' . $otp . '" AND user_type = 0) OR (mobile_no = "' . $login_id . '"  AND otp_for_change_password = "' . $otp . '" AND user_type = 0)';

            $user = $this->ApiModel->getData('register', $wh);

            if ($user) {
                $arr = array(
                    'is_otp_verified_for_change_password' => 1,
                );

                $up = $this->ApiModel->edit_data('register', $wh, $arr);

                if ($up) {
                    $send_data[] = array(
                        'u_id' => $user['u_id']
                    );

                    $response['error_code'] = "200";
                    $response['message'] = "OTP verified successfully..";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Something went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "401";
                $response['message'] = "Email/Mobile no and OTP Doest not match";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //change password //7-11-2022 //archana 
    public function change_password()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('new_password')) && !empty($this->input->post('confirm_password'))) {
            $u_id = $this->input->post('u_id');
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $wh = '(u_id = "' . $u_id . '")';

                if ($new_password == $confirm_password) {
                    $arr = array(
                        'password' => md5($new_password),
                        'password_text' => $new_password,
                    );

                    $up = $this->ApiModel->edit_data('register', $wh, $arr);

                    if ($up) {
                        $send_data[] = array(
                            'u_id' => $u_id,
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Password change Successfully...";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "401";
                    $response['message'] = "New password and Confirm Password doest not match";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //home page //7-11-2022 //archana
    public function home_page()
    {
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $hotel_list = $this->ApiModel->get_hotel_list();

                $wh1 = '(u_id = "' . $u_id . '" AND count_flag = 1)';

                $notification = $this->ApiModel->getAllData('user_notification', $wh1);

                if ($hotel_list) {
                    $data = array();

                    foreach ($hotel_list as $h_l) {
                        $wh = '(hotel_id = "' . $h_l['u_id'] . '")';

                        $hotel_img = $this->ApiModel->getData('hotel_photos', $wh);

                        $images = "";

                        if (($hotel_img)) {
                            $images = $hotel_img['images'];
                        }

                        $wh2 = '(city_id = "' . $h_l['city'] . '")';

                        $city_data = $this->ApiModel->getData('city', $wh2);

                        $city = "";

                        if ($city_data) {
                            $city = $city_data['city'];
                        }

                        $hotel_avg_rating = $this->ApiModel->get_hotel_avg_rating($h_l['u_id']);

                        $avrag_rating = 0;

                        if ($hotel_avg_rating[0]['avrag_rating']) {
                            $avrag_rating = round($hotel_avg_rating[0]['avrag_rating'], 2);
                        }

                        $wh_rt = '(hotel_id = "' . $h_l['u_id'] . '")';

                        $room_type = $this->ApiModel->getData('room_type', $wh_rt);

                        if ($room_type) {
                            $data[] = array(
                                'hotel_id' => $h_l['u_id'],
                                'hotel_name' => $h_l['hotel_name'],
                                'hotel_area' => $h_l['area'],
                                'hotel_city' => $city,
                                'hotel_state' => $h_l['state'],
                                'hotel_img' => $images,
                                'hotel_logo' => $h_l['hotel_logo'],
                                'avrage_rating' => $avrag_rating
                            );
                        }
                        /*else
                        { 
                            $data[] = array();
                        }*/
                    }

                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['data'] = $data;
                    $response['notification_count'] = count($notification);
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Hotel list not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //hotel details//7-11-2022 //archana
    public function get_hotel_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $hotel_data = $this->ApiModel->get_hotel_data($hotel_id);

                if ($hotel_data) {
                    $hotel_images = $this->ApiModel->get_hotel_imgs($hotel_id);

                    $wh = '(city_id = "' . $hotel_data['city'] . '")';

                    $city_data = $this->ApiModel->getData('city', $wh);

                    $city = "";

                    if ($city_data) {
                        $city = $city_data['city'];
                    }

                    //avrage rating

                    $hotel_rating = $this->ApiModel->get_hotel_avg_rating($hotel_id);

                    $hotel_facility = $this->ApiModel->get_hotel_panel_list($hotel_id);

                    $h_facility = array();

                    if ($hotel_facility) {

                        // abc
                        foreach ($hotel_facility as $h_fc) {
                            $hotel_services = $this->ApiModel->get_hotel_services($hotel_id, $h_fc['department_id']);
                            // print_r($hotel_services);die;
                            $services = array();

                            if ($hotel_services) {
                                foreach ($hotel_services as $hs) {
                                    $services[] = array(
                                        'services_id' => $hs['services_id'],
                                        'services_name' => $hs['services_name'],
                                        'status' => $hs['status'],
                                    );
                                }
                            }
                            // print_r($services);die;
                            $send_data[] = array(
                                'department_id' => $h_fc['department_id'],
                                'department_name' => $h_fc['department_name'],
                                'department_status' => $h_fc['department_status'],
                                'services' => $services
                            );
                        }
                        // abc

                    }

                    $img = array();

                    if ($hotel_images) {
                        foreach ($hotel_images as $h_i) {
                            $img[] = array(
                                'hotel_id' => $h_i['hotel_id'],
                                'images' => $h_i['images'],
                            );
                        }
                    }

                    $desc = array();

                    $ratings_details = $this->ApiModel->getAllData_rating($hotel_id);

                    if (!empty($ratings_details)) {
                        foreach ($ratings_details as $r_d) {
                            $desc[] = array(
                                'u_id' => $r_d['u_id'], // Added user ID to the data
                                'full_name' => $r_d['full_name'], // Added full name to the data
                                'rating' => $r_d['rating'],
                                'description' => $r_d['review'],
                                'rating_date' => $r_d['rating_date'],
                                'rating_time' => $r_d['rating_time'],
                            );
                        }
                    }




                    //get hotel ratings
                    $wh_ratings1 = '(rating = 1)';
                    $ratings_data_one = $this->ApiModel->get_ratings_count($wh_ratings1, $hotel_id);
                    $ratings_count_one = $ratings_data_one[0]['total_count'];

                    $wh_ratings2 = '(rating = 2)';
                    $ratings_data_two = $this->ApiModel->get_ratings_count($wh_ratings2, $hotel_id);
                    $ratings_count_two = $ratings_data_two[0]['total_count'];

                    $wh_ratings3 = '(rating = 3)';
                    $ratings_data_three = $this->ApiModel->get_ratings_count($wh_ratings3, $hotel_id);
                    $ratings_count_three = $ratings_data_three[0]['total_count'];

                    $wh_ratings4 = '(rating = 4)';
                    $ratings_data_four = $this->ApiModel->get_ratings_count($wh_ratings4, $hotel_id);
                    $ratings_count_four = $ratings_data_four[0]['total_count'];

                    $wh_ratings5 = '(rating = 5)';
                    $ratings_data_five = $this->ApiModel->get_ratings_count($wh_ratings5, $hotel_id);
                    $ratings_count_five = $ratings_data_five[0]['total_count'];

                    $ratings[] = array(
                        'hotel_rating_one' => $ratings_count_one,
                        'hotel_rating_two' => $ratings_count_two,
                        'hotel_rating_three' => $ratings_count_three,
                        'hotel_rating_four' => $ratings_count_four,
                        'hotel_rating_five' => $ratings_count_five,
                    );
                    if (!empty($hotel_rating[0]['avrag_rating'])) {
                        $avg_rating = round($hotel_rating[0]['avrag_rating'], 2);
                    } else {
                        $avg_rating = '';
                    }
                    $data[] = array(
                        'hotel_id' => $hotel_data['u_id'],
                        'hotel_name' => $hotel_data['hotel_name'],
                        'hotel_admin_name' => $hotel_data['full_name'],
                        'address' => $hotel_data['address'],
                        'area' => $hotel_data['area'],
                        'pincode' => $hotel_data['pincode'],
                        'city' => $city,
                        'state' => $hotel_data['state'],
                        'latitude' => $hotel_data['latitude'],
                        'longitude' => $hotel_data['longitude'],
                        'hotel_avrage_rating' => $avg_rating,
                        'hotel_description' => strip_tags($hotel_data['hotel_description']),
                        'hotel_requirement' => strip_tags($hotel_data['hotel_requirement']),
                        'hotel_importans' => strip_tags($hotel_data['hotel_importans']),
                        'hotel_facility' => $h_facility,
                        'img' => $img,
                        'review_rating_count' => $ratings,
                        'description' => $desc,
                        'department_info' => $send_data
                    );




                    $response['error_code'] = "200";
                    $response['message'] = "Data found";
                    $response['data'] = $data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Data not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //send enquiry request//7-11-2022 //archana
    /*public function send_enquiry_request()
    {
        if(!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('check_in_date')) && !empty($this->input->post('check_out_date')) && !empty($this->input->post('requirement')) && !empty($this->input->post('room_type')) && !empty($this->input->post('room_related_data')))
        {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $check_in_date = $this->input->post('check_in_date');
            $check_out_date = $this->input->post('check_out_date');
            $room_type = $this->input->post('room_type');

            $room_related_data = json_decode($this->input->post('room_related_data'),TRUE);
           
            $requirement = $this->input->post('requirement');
            
            $user = $this->ApiModel->get_user_data($u_id);

            if($user)
            {
                $wh_req = '(u_id = "'.$u_id.'" AND hotel_id = "'.$hotel_id.'" AND check_in_date = "'.$check_in_date.'" AND check_out_date = "'.$check_out_date.'")';

              $request_data = $this->ApiModel->getData('hotel_enquiry_request',$wh_req);
              $wh_room_type = '(room_type_id = "'.$room_type.'")';

              $room_type_exist= $this->ApiModel->getData('room_type',$wh_room_type);

             
                $room_type_name = $room_type_exist['room_type_name'];
            

                if($request_data)
                {
                    $response['error_code'] = "401";
                    $response['message'] = "You Already sent requset with same data";
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $arr = array(
                                    'hotel_id' => $hotel_id,
                                    'u_id' => $u_id,
                                    'check_in_date' => $check_in_date,
                                    'check_out_date' => $check_out_date,
                                    'requirement' => $requirement,
                                    'room_type' => $room_type,
                                    'room_type_name'=>$room_type_name
                                     
                                );

                    $add = $this->ApiModel->insert_data('hotel_enquiry_request',$arr);
                   //print_r($arr);die;
                    if($add)
                    {
                        foreach($room_related_data as $r_m)
                        {
                            $arr_d = array(
                                            'hotel_id' => $hotel_id,
                                            'hotel_enquiry_request_id' => $add,
                                            'no_of_room' => $r_m['no_of_room'],
                                            'childs' => $r_m['childs'],
                                            // 'room_type' => $r_m['room_type'],
                                        );

                            $this->ApiModel->insert_data('hotel_enquiry_request_details',$arr_d);
                        }

                        $hotel_data = $this->ApiModel->get_hotel_data($hotel_id);

                        $wh = '(u_id = "'.$hotel_id.'")';

                        $wh_city = '(city = "'.$hotel_data['city'].'")';

                        $leads_recharge_data = $this->ApiModel->getData('leads_recharge',$wh_city);
                        
                        if($leads_recharge_data)
                        {
                            $arr_r = array(
                                            'wallet_points' => $hotel_data['wallet_points'] - $leads_recharge_data['lead_cost'],
                                        );

                            $this->ApiModel->edit_data('register',$wh,$arr_r);

                            $arr_w_h = array(
                                            'hotel_admin_id' => $hotel_id,
                                            'amount' => $leads_recharge_data['lead_cost'],
                                            'amount_status' => 2
                                        );

                            $this->ApiModel->insert_data('hotel_admin_wallet_history',$arr_w_h);
                        }

                        $hotel_name = $hotel_data['hotel_name'];

                        $subject = "Send request";

                        $description = "Sent enquiry request to ".$hotel_name." hotel";

                        $arr_nt = array(
                                        'hotel_id' => $hotel_id,
                                        'u_id' => $u_id,
                                        'subject' => $subject,
                                        'description' => $description,
                                        'clear_flag' => 1,
                          
                                        );

                        $this->ApiModel->insert_data('user_notification',$arr_nt);

                        //sent near by hotel request list
                        $hotel_data['city'];

                        $wh_admin_c = '(city = "'.$hotel_data['city'].'" AND user_type = 2 AND u_id != "'.$hotel_id.'")'; //u_id !
                        $hotel_list = $this->ApiModel->getAllData('register',$wh_admin_c);
                      
                        if($hotel_list)
                        {
                              $wh_room_type = '(room_type_id = "'.$room_type.'")';

                              $room_type_exist= $this->ApiModel->getData('room_type',$wh_room_type);
                              
                              if(!empty($room_type_exist))
                              {
                                 $room_type_name = $room_type_exist['room_type_name'];
                              }
                            foreach ($hotel_list as $hl) 
                            {
                              //$wh_room_type = '(room_type_id = "'.$room_type.'" AND hotel_id="'.$hl['u_id'].'")';

                             // $room_type_exist= $this->ApiModel->getData('room_type',$wh_room_type);
                              
                              //if($room_type_exist)
                             // {
                                
                              
                              
                                  $arr_n_h = array(
                                                    'hotel_id' => $hl['u_id'],
                                                    'u_id' => $u_id,
                                                    'check_in_date' => $check_in_date,
                                                    'check_out_date' => $check_out_date,
                                                    'requirement' => $requirement,
                                                    'room_type' => $room_type,
                                                    'room_type_name' => $room_type_name                                   
                                                  );

                                  $add_n_h = $this->ApiModel->insert_data('hotel_enquiry_request',$arr_n_h);

                                  if($add_n_h)
                                  {
                                      foreach($room_related_data as $r_m)
                                      {
                                          $arr_d1 = array(
                                                          'hotel_id' => $hl['u_id'],
                                                          'hotel_enquiry_request_id' => $add_n_h,
                                                          'no_of_room' => $r_m['no_of_room'],
                                                          'childs' => $r_m['childs'],
                                                          // 'room_type' => $r_m['room_type'],
                                                      );

                                          $this->ApiModel->insert_data('hotel_enquiry_request_details',$arr_d1);
                                      }
                                  }
                                //}
                                
                                $hotel_data1 = $this->ApiModel->get_hotel_data($hl['u_id']);

                                $wh1 = '(u_id = "'.$hl['u_id'].'")';

                                $wh_city1 = '(city = "'.$hotel_data1['city'].'")';

                                $leads_recharge_data1 = $this->ApiModel->getData('leads_recharge',$wh_city1);
                                
                                if($leads_recharge_data1)
                                {
                                    $arr_r1 = array(
                                                    'wallet_points' => $hotel_data1['wallet_points'] - $leads_recharge_data1['lead_cost'],
                                                );

                                    $this->ApiModel->edit_data('register',$wh1,$arr_r1);

                                    $arr_w_h1 = array(
                                                        'hotel_admin_id' => $hl['u_id'],
                                                        'amount' => $leads_recharge_data1['lead_cost'],
                                                        'amount_status' => 2
                                                     );

                                    $this->ApiModel->insert_data('hotel_admin_wallet_history',$arr_w_h1);
                                }
                                
                                $hotel_name1 = $hotel_data1['hotel_name'];

                                $subject1 = "Send request";

                                $description1 = "Sent enquiry request to ".$hotel_name1." hotel";

                                $arr_nt1 = array(
                                                'hotel_id' => $hl['u_id'],
                                                'u_id' => $u_id,
                                                'subject' => $subject1,
                                                'description' => $description1,
                                                'clear_flag' => 1,
                                                );

                                $this->ApiModel->insert_data('user_notification',$arr_nt1);

                            }
                        }

                        $send_data[] = array(
                                                'hotel_enquiry_request_id' => $add,
                                                'hotel_id' => $hotel_id,
                                                'hotel_name' => $hotel_data['hotel_name'],
                                            );

                        $response['error_code'] = "200";
                        $response['message'] = "Enquiry request sent successfully";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    }
                    else
                    {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                }       
            }
            else
            {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        }
        else
        {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }*/

    //send enquiry request updated //28-12-2022 //ravina
    public function send_enquiry_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('check_in_date')) && !empty($this->input->post('check_out_date')) && !empty($this->input->post('requirement')) && !empty($this->input->post('room_type')) && !empty($this->input->post('room_related_data')) && !empty($this->input->post('user_prefer')) && !empty($this->input->post('token'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $check_in_date = $this->input->post('check_in_date');
            $check_out_date = $this->input->post('check_out_date');
            $room_type = $this->input->post('room_type');
            $offer_id = $this->input->post('offer_id');
            $token = $this->input->post('token');

            $room_related_data = json_decode($this->input->post('room_related_data'), TRUE);

            $user_prefer_data = json_decode($this->input->post('user_prefer'), TRUE);

            $requirement = $this->input->post('requirement');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $wh_req = '(u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND check_in_date = "' . $check_in_date . '" AND check_out_date = "' . $check_out_date . '" AND is_main_req = 1)';

                $request_data = $this->ApiModel->getData('hotel_enquiry_request', $wh_req);
                //   print_r($request_data);die;
                $wh_room_type = '(room_type_id = "' . $room_type . '")';

                $room_type_exist = $this->ApiModel->getData('room_type', $wh_room_type);

                $room_type_name = $room_type_exist['room_type_name'];



                if ($request_data) {
                    $response['error_code'] = "401";
                    $response['message'] = "You Already sent requset with same data";
                    echo json_encode($response);
                    exit();
                } else {
                    $wh_req = '(u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND check_out_date > "' . $check_in_date . '" AND is_main_req = 1)';
                    $check_date = $this->ApiModel->getData('hotel_enquiry_request', $wh_req);
                    // print_r($check_date);die;
                    if ($check_date) {
                        $response['error_code'] = "401";
                        $response['message'] = "You Can't Send Same Date enquiry";
                        echo json_encode($response);
                        exit();
                    }

                    $wh_token_get = '(u_id ="' . $u_id . '")';
                    $user_token_exist = $this->ApiModel->getAllData('user_firebase_tokens', $wh_token_get);
                    if ($user_token_exist) {
                        $arr_token = array(
                            'token' => $token
                        );

                        $up = $this->ApiModel->edit_data('user_firebase_tokens', $wh_token_get, $arr_token);
                    } else {
                        $arr_token = array(
                            'u_id' => $u_id,
                            'token' => $token
                        );

                        $add = $this->ApiModel->insert_data('user_firebase_tokens', $arr_token);
                    }

                    foreach ($user_prefer_data as $u_d) {
                        $arr = array(
                            'hotel_id' => $hotel_id,
                            'u_id' => $u_id,
                            'check_in_date' => $check_in_date,
                            'check_out_date' => $check_out_date,
                            'requirement' => $requirement,
                            'room_type' => $room_type,
                            'room_type_name' => $room_type_name,
                            'offer_id' => $offer_id,
                            'smoking_room' => $u_d['smoking_room'] ?? '0',
                            'non_smoking_room' => $u_d['non_smoking_room'] ?? '0',
                            'king_bed' => $u_d['king_bed'] ?? '0',
                            'twin_bed' => $u_d['twin_bed'] ?? '0',
                            'mountain_view' => $u_d['mountain_view'] ?? '0',
                            'city_view' => $u_d['city_view'] ?? '0',
                            'top_floors' => $u_d['top_floors'] ?? '0',
                            'lower_floors' => $u_d['lower_floors'] ?? '0',
                            'is_main_req' => 1,
                        );

                        $add = $this->ApiModel->insert_data('hotel_enquiry_request', $arr);
                    }
                    //print_r($arr);die;
                    if ($add) {
                        foreach ($room_related_data as $r_m) {
                            $arr_d = array(
                                'hotel_id' => $hotel_id,
                                'hotel_enquiry_request_id' => $add,
                                'no_of_room' => $r_m['no_of_room'] ?? '0',
                                'childs' => $r_m['childs'] ?? '0',
                                'adults' => $r_m['adults'] ?? '0',
                                // 'room_type' => $r_m['room_type'],
                            );

                            $this->ApiModel->insert_data('hotel_enquiry_request_details', $arr_d);
                        }

                        $hotel_data = $this->ApiModel->get_hotel_data($hotel_id);

                        $wh = '(u_id = "' . $hotel_id . '")';

                        $wh_city = '(city = "' . $hotel_data['city'] . '")';

                        $leads_recharge_data = $this->ApiModel->getData('leads_recharge', $wh_city);

                        if ($leads_recharge_data) {
                            $arr_r = array(
                                'wallet_points' => $hotel_data['wallet_points'] - $leads_recharge_data['lead_cost'],
                            );

                            $this->ApiModel->edit_data('register', $wh, $arr_r);

                            $arr_w_h = array(
                                'hotel_admin_id' => $hotel_id,
                                'amount' => $leads_recharge_data['lead_cost'],
                                'amount_status' => 2
                            );

                            $this->ApiModel->insert_data('hotel_admin_wallet_history', $arr_w_h);
                        }

                        $hotel_name = $hotel_data['hotel_name'];

                        // $subject = "Send request";

                        // $description = "Sent enquiry request to ".$hotel_name." hotel";

                        // $arr_nt = array(
                        //                 'hotel_id' => $hotel_id,
                        //                 'u_id' => $u_id,
                        //                 'subject' => $subject,
                        //                 'description' => $description,
                        //                 'clear_flag' => 1,
                        //                 'count_flag' => 1,
                        //                 );

                        // $this->ApiModel->insert_data('user_notification',$arr_nt);

                        //sent near by hotel request list
                        $hotel_data['city'];

                        $wh_admin_c = '(city = "' . $hotel_data['city'] . '" AND user_type = 2 AND u_id != "' . $hotel_id . '")'; //u_id !

                        $hotel_list = $this->ApiModel->getAllData('register', $wh_admin_c);

                        if ($hotel_list) {
                            $wh_room_type = '(room_type_id = "' . $room_type . '")';

                            $room_type_exist = $this->ApiModel->getData('room_type', $wh_room_type);

                            if (!empty($room_type_exist)) {
                                $room_type_name = $room_type_exist['room_type_name'];
                            }

                            foreach ($hotel_list as $hl) {
                                //$wh_room_type = '(room_type_id = "'.$room_type.'" AND hotel_id="'.$hl['u_id'].'")';

                                // $room_type_exist= $this->ApiModel->getData('room_type',$wh_room_type);

                                //if($room_type_exist)
                                // {



                                $arr_n_h = array(
                                    'hotel_id' => $hl['u_id'],
                                    'u_id' => $u_id,
                                    'check_in_date' => $check_in_date,
                                    'check_out_date' => $check_out_date,
                                    'requirement' => $requirement,
                                    'room_type' => $room_type,
                                    'room_type_name' => $room_type_name,
                                    'is_sub_req' => 1,
                                    'request_id' => $add,
                                );

                                $add_n_h = $this->ApiModel->insert_data('hotel_enquiry_request', $arr_n_h);

                                if ($add_n_h) {
                                    foreach ($room_related_data as $r_m) {
                                        $arr_d1 = array(
                                            'hotel_id' => $hl['u_id'],
                                            'hotel_enquiry_request_id' => $add_n_h,
                                            'no_of_room' => $r_m['no_of_room'] ?? '0',
                                            'childs' => $r_m['childs'] ?? '0',
                                            // 'room_type' => $r_m['room_type'],
                                        );

                                        $this->ApiModel->insert_data('hotel_enquiry_request_details', $arr_d1);
                                    }
                                }
                                //}

                                $hotel_data1 = $this->ApiModel->get_hotel_data($hl['u_id']);

                                $wh1 = '(u_id = "' . $hl['u_id'] . '")';

                                $wh_city1 = '(city = "' . $hotel_data1['city'] . '")';

                                $leads_recharge_data1 = $this->ApiModel->getData('leads_recharge', $wh_city1);

                                if ($leads_recharge_data1) {
                                    $arr_r1 = array(
                                        'wallet_points' => $hotel_data1['wallet_points'] - $leads_recharge_data1['lead_cost'],
                                    );

                                    $this->ApiModel->edit_data('register', $wh1, $arr_r1);

                                    $arr_w_h1 = array(
                                        'hotel_admin_id' => $hl['u_id'],
                                        'amount' => $leads_recharge_data1['lead_cost'],
                                        'amount_status' => 2
                                    );

                                    $this->ApiModel->insert_data('hotel_admin_wallet_history', $arr_w_h1);
                                }

                                /*$hotel_name1 = $hotel_data1['hotel_name'];

                                $subject1 = "Send request";

                                $description1 = "Sent enquiry request to ".$hotel_name1." hotel";

                                $arr_nt1 = array(
                                                'hotel_id' => $hl['u_id'],
                                                'u_id' => $u_id,
                                                'subject' => $subject1,
                                                'description' => $description1,
                                                'clear_flag' => 1,
                                                );

                                $this->ApiModel->insert_data('user_notification',$arr_nt1);*/

                            }
                        }

                        $wh_admins = '(u_id = "' . $hotel_id . '" OR hotel_id = "' . $hotel_id . '") AND (user_type = 2 OR user_type = 3 OR user_type = 5 OR user_type = 7)';

                        $hotel_admins = $this->ApiModel->getAllData('register', $wh_admins);
                        // print_r($hotel_admins);
                        if (!empty($hotel_admins)) {
                            foreach ($hotel_admins as $h_a) {
                                $wh_token = '(u_id = "' . $h_a['u_id'] . '")';

                                $get_token = $this->MainModel->getData($tbl = 'user_firebase_tokens', $wh_token);
                                // echo "<pre>";print_r($get_token);

                                if (!empty($get_token['token'])) {
                                    $deviceToken = $get_token['token'];
                                    $title = 'Hello all';
                                    $body = array(
                                        "Good Morning"

                                    );
                                    // print_r($deviceToken);
                                    // print_r($title);
                                    // print_r($body);
                                    $result = send_push_notification_for_staff($deviceToken, $title, $body);
                                    // print_r($result);
                                }
                            }
                        }

                        $send_data[] = array(
                            'hotel_enquiry_request_id' => $add,
                            'hotel_id' => $hotel_id,
                            'hotel_name' => $hotel_data['hotel_name'],
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Enquiry request sent successfully";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //get enquiry list with their status //8-11-2022 //archana
    public function get_enquiry_request_list()
        {
         
            if(!empty($this->input->post('u_id')))
            {
                $u_id = $this->input->post('u_id');
                
                $user = $this->ApiModel->get_user_data($u_id);

                if($user)
                {
                    $enquiry_data = $this->ApiModel->get_enquiry_list($u_id);
                    
                    if($enquiry_data)
                    {
                      	$sub_enq_data = array(); 
                      
                        //sub enquiry list
                        foreach ($enquiry_data as $eq) 
                        {
                            $sub_enquiry_data = $this->ApiModel->get_sub_enquiry_list($u_id,$eq['hotel_enquiry_request_id']);
                             
                            if($sub_enquiry_data)
                            {
                                $sub_enq_data = array();

                                foreach ($sub_enquiry_data as $s_eq) 
                                {
                                    $wh21 = '(city_id = "'.$s_eq['city'].'")';

                                    $city_data1 = $this->ApiModel->getData('city',$wh21);
            
                                    $city1 = "";
            
                                    if($city_data1)
                                    {
                                        $city1 = $city_data1['city'];
                                    }
                                   
                                    $booking_id1 ='';
        
                                    $wh31 = '(enquiry_id = "'.$s_eq['hotel_enquiry_request_id'].'")';
        
                                    $get_booking_id1 = $this->ApiModel->getData('user_hotel_booking',$wh31);
        
                                    if($get_booking_id1)
                                    {
                                        $booking_id1 = $get_booking_id1['booking_id'];
                                    }
                                  
                                    $request_status1 ="";
                                    $room_charges1 = 0;
        
                                    if($s_eq['request_status'] == 0)
                                    {
                                        $request_status1 = "Pending";
                                        $room_charges1 = $s_eq['room_charges'];
                                        $room_type_name1 = $s_eq['room_type_name'];
                                    }
                                    else
                                    {
                                        if($s_eq['request_status'] == 1)
                                        {
                                            $request_status1 = "Accepted";
                                            $room_charges1 = $s_eq['room_charges'];
                                        }
                                        else
                                        {
                                            if($s_eq['request_status'] == 2)
                                            {
                                                $request_status1 = "Rejected";
                                                $room_charges1 = $s_eq['room_charges'];
                                                $room_type_name1 = $s_eq['room_type_name'];
                                            }
                                            else
                                            {
                                                if($s_eq['request_status'] == 3)
                                                {
                                                    $request_status1 = "User accepted"; //user rejected
                                                    $room_charges1 = $s_eq['room_charges'];
                                                    $room_type_name1 = $s_eq['room_type_name'];
                                                }
                                                else
                                                {
                                                    if($s_eq['request_status'] == 4)
                                                    {
                                                        $request_status1 = "Room assigned"; 
                                                        $room_charges1 = $s_eq['room_charges'];
                                                        $room_type_name1 = $s_eq['room_type_name'];
                                                    }
                                                }
                                            }
                                          
                                        }
                                    }
                                    
                                    $sub_enq_data[] = array(
                                                                'hotel_enquiry_request_id' => $s_eq['hotel_enquiry_request_id'],
                                                                'booking_id' => $booking_id1,
                                                                'city' => $city1,
                                                                'check_in_date' => $s_eq['check_in_date'],
                                                                'check_out_date' => $s_eq['check_out_date'],
                                                                'hotel_name' => $s_eq['hotel_name'],
                                                                 'hotel_id' => $s_eq['hotel_id'],
                                                                'hotel_logo' => $s_eq['hotel_logo'],
                                                                'request_status' => $request_status1,
                                                                'request_status_flag' => $s_eq['request_status'],
                                                                'room_charges' => $room_charges1,
                                                                'room_type_name' => $s_eq['room_type_name']
                                                            );
                                }
                            }

                            $wh2 = '(city_id = "'.$eq['city'].'")';

                            $city_data = $this->ApiModel->getData('city',$wh2);
    
                            $city = "";
    
                            if($city_data)
                            {
                                $city = $city_data['city'];
                            }
                           
                            $booking_id ='';

                            $wh3 = '(enquiry_id = "'.$eq['hotel_enquiry_request_id'].'")';

                            $get_booking_id = $this->ApiModel->getData('user_hotel_booking',$wh3);

                            if($get_booking_id)
                            {
                              	$booking_id = $get_booking_id['booking_id'];
                            }
                          
                            $request_status ="";
                            $room_charges = 0;

                            if($eq['request_status'] == 0)
                            {
                                $request_status = "Pending";
                                $room_charges = $eq['room_charges'];
                                $room_type_name = $eq['room_type_name'];
                            }
                            else
                            {
                                if($eq['request_status'] == 1)
                                {
                                    $request_status = "Accepted";
                                    $room_charges = $eq['room_charges'];
                                }
                                else
                                {
                                    if($eq['request_status'] == 2)
                                    {
                                        $request_status = "Rejected";
                                        $room_charges = $eq['room_charges'];
                                       $room_type_name = $eq['room_type_name'];
                                    }
                                    else
                                    {
                                        if($eq['request_status'] == 3)
                                        {
                                            $request_status = "User accepted"; //user rejected
                                            $room_charges = $eq['room_charges'];
                                           $room_type_name = $eq['room_type_name'];
                                        }
                                        else
                                        {
                                            if($eq['request_status'] == 4)
                                            {
                                                $request_status = "Room assigned"; 
                                                $room_charges = $eq['room_charges'];
                                                $room_type_name = $eq['room_type_name'];
                                            }
                                        }
                                    }
                                  
                                }
                            }

                            $send_data[] = array(
                                                    'hotel_enquiry_request_id' => $eq['hotel_enquiry_request_id'],
                              						'booking_id' => $booking_id,
                              						'hotel_id' => $s_eq['hotel_id'],
                                                    'city' => $city,
                                                    'check_in_date' => $eq['check_in_date'],
                                                    'check_out_date' => $eq['check_out_date'],
                                                    'hotel_name' => $eq['hotel_name'],
                                					'hotel_logo' => $eq['hotel_logo'],
                                                    'request_status' => $request_status,
                                                    'request_status_flag'=> $eq['request_status'],
                                                    'room_charges' => $room_charges,
                                                    'room_type_name' => $eq['room_type_name'],
                                                    'sub_request_list' => $sub_enq_data
                                                );
                            
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                        // $room_assign_data = $this->ApiModel->get_room_assign_detail_list($u_id);
                        //     if($room_assign_data)
                        //     {
    
                        //     }|
                        // print_r($r
                    }
                    else
                    {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                }
                else
                {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                $response['error_code'] = "406";
                $response['message'] = "Required Parameter Missing..!";
                echo json_encode($response);
                exit();
            }
        }

    //to confirm booking //8-11-2022 //archana
    public function is_confirm_booking()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_enquiry_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');

            // Fetch user data
            $user = $this->ApiModel->get_user_data($u_id);

            if (!$user) {
                $response = [
                    'error_code' => "404",
                    'message' => "User not found"
                ];
                echo json_encode($response);
                exit();
            }

            // Check if the request has been accepted
            $wh2 = '(hotel_enquiry_request_id = "' . $hotel_enquiry_request_id . '" AND request_status = 1)';
            $check_request_accepted_or_not = $this->ApiModel->getData('hotel_enquiry_request', $wh2);

            if (!$check_request_accepted_or_not) {
                $response = [
                    'error_code' => "401",
                    'message' => "Your request is not accepted"
                ];
                echo json_encode($response);
                exit();
            }

            // Fetch hotel enquiry request data
            $wh = '(hotel_enquiry_request_id = "' . $hotel_enquiry_request_id . '")';
            $hotel_enquiry_request_data = $this->ApiModel->getData('hotel_enquiry_request', $wh);

            if (!$hotel_enquiry_request_data) {
                $response = [
                    'error_code' => "404",
                    'message' => "Data not found"
                ];
                echo json_encode($response);
                exit();
            }

            // Fetch total adults, children, rooms
            $total_child_guest = $this->ApiModel->get_total_adults_child($hotel_enquiry_request_id);

            $total_adults = $total_child_guest[0]['total_adults'] ?? 0;
            $total_child = $total_child_guest[0]['total_child'] ?? 0;
            $no_of_guests = $total_adults + $total_child;
            $no_of_rooms = $total_child_guest[0]['no_of_rooms'] ?? 0;

            // Prepare data for booking
            $arr = [
                'hotel_id' => $hotel_enquiry_request_data['hotel_id'],
                'enquiry_id' => $hotel_enquiry_request_id,
                'u_id' => $u_id,
                'booking_date' => date('Y-m-d'),
                'check_in' => $hotel_enquiry_request_data['check_in_date'],
                'check_out' => $hotel_enquiry_request_data['check_out_date'],
                'total_charges' => $hotel_enquiry_request_data['room_charges'],
                'service_tax' => $hotel_enquiry_request_data['service_tax'],
                'luxury_tax' => $hotel_enquiry_request_data['luxury_tax'],
                'offer_id' => $hotel_enquiry_request_data['offer_id'],
                'booking_from' => 2,
                'no_of_rooms' => $no_of_rooms,
                'no_of_guests' => $no_of_guests,
                'room_type' => $hotel_enquiry_request_data['room_type'],
                'total_adults' => $total_adults,
                'total_child' => $total_child,
            ];

            $add = $this->ApiModel->insert_data('user_hotel_booking', $arr);

            if (!$add) {
                $response = [
                    'error_code' => "403",
                    'message' => "Something went wrong"
                ];
                echo json_encode($response);
                exit();
            }

            // Reject other requests for the same user and date
            $wh_eq = '(hotel_enquiry_request_id != "' . $hotel_enquiry_request_id . '" AND u_id = "' . $u_id . '" AND check_in_date = "' . $hotel_enquiry_request_data['check_in_date'] . '" AND check_out_date = "' . $hotel_enquiry_request_data['check_out_date'] . '")';
            $chk_hotel_enquiry_request_data = $this->ApiModel->getAllData('hotel_enquiry_request', $wh_eq);

            if ($chk_hotel_enquiry_request_data) {
                foreach ($chk_hotel_enquiry_request_data as $cherd) {
                    $arr_rj = [
                        'request_status' => 2,
                        'reject_date' => date('Y-m-d')
                    ];
                    $this->ApiModel->edit_data('hotel_enquiry_request', $wh_eq, $arr_rj);
                }
            }

            // Fetch hotel data for notification
            $hotel_data = $this->ApiModel->get_hotel_data($hotel_enquiry_request_data['hotel_id']);
            $hotel_name = $hotel_data['hotel_name'];

            // Send notification
            $subject = "Confirm Booking";
            $description = "Your booking is confirmed in " . $hotel_name . " with booking ID " . $add;

            $arr_nt = [
                'hotel_id' => $hotel_enquiry_request_data['hotel_id'],
                'u_id' => $u_id,
                'subject' => $subject,
                'description' => $description,
                'clear_flag' => 1,
                'count_flag' => 1,
            ];
            $this->ApiModel->insert_data('user_notification', $arr_nt);

            // Update enquiry request status
            $arr_req = [
                'request_status' => 3,
                'is_confirm_booking' => 1,
                'is_confirm_booking_u_id' => $u_id,
                'is_confirm_booking_hotel_id' => $hotel_enquiry_request_data['hotel_id'],
                'is_confirm_booking_booking_id' => $add,
            ];
            $this->ApiModel->edit_data('hotel_enquiry_request', $wh, $arr_req);

            // Response data
            $send_data = [
                [
                    'booking_id' => $add,
                    'hotel_id' => $hotel_enquiry_request_data['hotel_id'],
                    'hotel_name' => $hotel_name,
                ]
            ];

            $response = [
                'error_code' => "200",
                'message' => "Your booking is confirmed",
                'data' => $send_data
            ];
            echo json_encode($response);
            exit();
        } else {
            $response = [
                'error_code' => "406",
                'message' => "Required parameter missing"
            ];
            echo json_encode($response);
            exit();
        }
    }


    //login as guest//8-11-2022 //archana
    public function login_as_guest()
    {
        if (!empty($this->input->post('booking_id')) && !empty($this->input->post('login_id'))) {
            //$u_id = $this->input->post('u_id');
            $booking_id = $this->input->post('booking_id');
            $login_id = $this->input->post('login_id');

            //$user = $this->ApiModel->get_user_data($u_id);

            //if($user)
            //{
            $wh = '(email_id = "' . $login_id . '") OR (mobile_no = "' . $login_id . '")';

            $check_user_login_id = $this->ApiModel->getData('register', $wh);

            if ($check_user_login_id) {
                $wh1 = '(booking_id = "' . $booking_id . '" AND booking_status = 1)';

                $check_booking_data = $this->ApiModel->getData('user_hotel_booking', $wh1);

                $rand_no = rand('1111', '9999');

                if ($check_booking_data) {
                    $wh2 = '(hotel_id = "' . $check_booking_data['hotel_id'] . '" AND booking_id = "' . $booking_id . '")';

                    $check_already_guest = $this->ApiModel->getData('guest_user', $wh2);

                    if (empty($check_already_guest)) {
                        $arr = array(
                            'u_id' => $check_booking_data['u_id'],
                            'hotel_id' => $check_booking_data['hotel_id'],
                            'booking_id' => $booking_id,
                            'login_id' => $login_id,
                            'otp' => $rand_no,
                            'dnd_mode' => 2,
                            'is_guest' => 1,
                            'chat_visible_mode' => 2,
                            'is_department_notification' => 2,
                            'is_offer_notification' => 2,
                        );

                        $add_gu = $this->ApiModel->insert_data('guest_user', $arr);

                        if ($add_gu) {
                            $rand_no1 = rand(11111, 99999);

                            $booking_details = $this->ApiModel->get_user_booking_details_1($check_booking_data['hotel_id'], $booking_id);

                            $date1 = $booking_details['check_in'];
                            $date2 = $booking_details['check_out'];
                            $service_tax = $booking_details['service_tax'];
                            $luxury_tax = $booking_details['luxury_tax'];
                            $offer_id = $booking_details['offer_id'];

                            $diff = abs(strtotime($date2) - strtotime($date1));

                            $years = floor($diff / (365 * 60 * 60 * 24));
                            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                            $amount = $booking_details['total_charges'];

                            $s_amount = $service_tax;

                            $lt_amount = $luxury_tax;

                            $wh_off = '(offer_id = "' . $offer_id . '")';

                            $offers = $this->ApiModel->getData('offers', $wh_off);

                            $wh_chk = '(hotel_id = "' . $check_booking_data['hotel_id'] . '" AND u_id = "' . $check_booking_data['u_id'] . '" AND booking_id = "' . $booking_id . '")';

                            $user_checkout_data = $this->ApiModel->getData('user_checkout_data', $wh_chk);

                            $discount = 0;

                            if ($offers) {
                                $discount = $offers['amt_in_per'];
                            }

                            if (empty($user_checkout_data)) {
                                $arr = array(
                                    'hotel_id' => $check_booking_data['hotel_id'],
                                    'u_id' => $check_booking_data['u_id'],
                                    'booking_id' => $booking_id,
                                    'discount' => $discount,
                                    'invoice_no' => $rand_no1
                                );

                                $add = $this->ApiModel->insert_data('user_checkout_data', $arr);

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
                                            'hotel_id' => $check_booking_data['hotel_id'],
                                            'user_checkout_data_id' => $add,
                                            'description' => $description,
                                            'date' => date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days')),
                                            'amount' => $amount1
                                        );

                                        $add_rm_charges = $this->ApiModel->insert_data('user_checkout_details', $arr1);

                                        if ($add_rm_charges) {
                                            $wh1 = '(hotel_id = "' . $check_booking_data['hotel_id'] . '" AND user_checkout_data_id = "' . $add . '" AND description_name = "' . $description . '")';

                                            $user_checkout_sub_total = $this->ApiModel->getData('user_checkout_sub_total', $wh1);

                                            //add subtotal
                                            if ($user_checkout_sub_total) {
                                                $st_arr1 = array(
                                                    'sub_total' => $user_checkout_sub_total['sub_total'] + $amount1
                                                );

                                                $this->ApiModel->edit_data('user_checkout_sub_total', $wh1, $st_arr1);
                                            } else {
                                                //edit subtotal
                                                $st_arr2 = array(
                                                    'hotel_id' => $check_booking_data['hotel_id'],
                                                    'user_checkout_data_id' => $add,
                                                    'description_name' => $description,
                                                    'sub_total' => $amount1
                                                );

                                                $this->ApiModel->insert_data('user_checkout_sub_total', $st_arr2);
                                            }

                                            //add total bill
                                            $wh_ck = '(user_checkout_data_id = "' . $add . '")';

                                            $user_checkout_data1 = $this->ApiModel->getData('user_checkout_data', $wh_ck);

                                            $tot_arr1 = array(
                                                'total_bill' => $user_checkout_data1['total_bill'] + $amount1
                                            );

                                            $this->ApiModel->edit_data('user_checkout_data', $wh_ck, $tot_arr1);
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
                                            'hotel_id' => $check_booking_data['hotel_id'],
                                            'user_checkout_data_id' => $add,
                                            'description' => $description_lx,
                                            'date' => date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $k . 'days')),
                                            'amount' => $lt_amount1
                                        );

                                        $add_lux = $this->ApiModel->insert_data('user_checkout_details', $arr_lx);

                                        if ($add_lux) {
                                            $wh13 = '(hotel_id = "' . $check_booking_data['hotel_id'] . '" AND user_checkout_data_id = "' . $add . '" AND description_name = "' . $description_lx . '")';

                                            $user_checkout_sub_total2 = $this->ApiModel->getData('user_checkout_sub_total', $wh13);

                                            //add subtotal
                                            if ($user_checkout_sub_total2) {
                                                $st_arr13 = array(
                                                    'sub_total' => $user_checkout_sub_total2['sub_total'] + $lt_amount1
                                                );

                                                $this->ApiModel->edit_data('user_checkout_sub_total', $wh13, $st_arr13);
                                            } else {
                                                //edit subtotal
                                                $st_arr23 = array(
                                                    'hotel_id' => $check_booking_data['hotel_id'],
                                                    'user_checkout_data_id' => $add,
                                                    'description_name' => $description_lx,
                                                    'sub_total' => $lt_amount1
                                                );

                                                $this->ApiModel->insert_data('user_checkout_sub_total', $st_arr23);
                                            }

                                            //add total bill
                                            $wh_ck3_1 = '(user_checkout_data_id = "' . $add . '")';

                                            $user_checkout_data1_3 = $this->ApiModel->getData('user_checkout_data', $wh_ck3_1);

                                            $tot_arr3 = array(
                                                'total_bill' => $user_checkout_data1_3['total_bill'] + $lt_amount1
                                            );

                                            $this->ApiModel->edit_data('user_checkout_data', $wh_ck3_1, $tot_arr3);
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
                                            'hotel_id' => $check_booking_data['hotel_id'],
                                            'user_checkout_data_id' => $add,
                                            'description' => $description_s,
                                            'date' => date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $j . 'days')),
                                            'amount' => $s_amount1
                                        );

                                        $add_ser = $this->ApiModel->insert_data('user_checkout_details', $arr_s);

                                        if ($add_ser) {
                                            $wh12 = '(hotel_id = "' . $check_booking_data['hotel_id'] . '" AND user_checkout_data_id = "' . $add . '" AND description_name = "' . $description_s . '")';

                                            $user_checkout_sub_total1 = $this->ApiModel->getData('user_checkout_sub_total', $wh12);

                                            //add subtotal
                                            if ($user_checkout_sub_total1) {
                                                $st_arr12 = array(
                                                    'sub_total' => $user_checkout_sub_total1['sub_total'] + $s_amount1
                                                );

                                                $this->ApiModel->edit_data('user_checkout_sub_total', $wh12, $st_arr12);
                                            } else {
                                                //edit subtotal
                                                $st_arr22 = array(
                                                    'hotel_id' => $check_booking_data['hotel_id'],
                                                    'user_checkout_data_id' => $add,
                                                    'description_name' => $description_s,
                                                    'sub_total' => $s_amount1
                                                );

                                                $this->ApiModel->insert_data('user_checkout_sub_total', $st_arr22);
                                            }

                                            //add total bill
                                            $wh_ck1 = '(user_checkout_data_id = "' . $add . '")';

                                            $user_checkout_data11 = $this->ApiModel->getData('user_checkout_data', $wh_ck1);

                                            $tot_arr2 = array(
                                                'total_bill' => $user_checkout_data11['total_bill'] + $s_amount1
                                            );

                                            $this->ApiModel->edit_data('user_checkout_data', $wh_ck1, $tot_arr2);
                                        }
                                    }

                                }
                            }
                            $send_data[] = array(
                                'guest_login_id' => $add_gu,
                                'hotel_id' => $check_booking_data['hotel_id'],
                                'u_id' => $check_booking_data['u_id'],
                                'booking_id' => $booking_id,
                                'login_id' => $login_id,
                                'otp' => $rand_no,
                            );

                            $response['error_code'] = "200";
                            $response['message'] = "Success";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $arr1 = array(
                            'u_id' => $check_booking_data['u_id'],
                            'hotel_id' => $check_booking_data['hotel_id'],
                            'booking_id' => $booking_id,
                            'login_id' => $login_id,
                            'otp' => $rand_no,
                            'dnd_mode' => 2,
                            'is_guest' => 1,
                        );

                        $up = $this->ApiModel->edit_data('guest_user', $wh2, $arr1);

                        if ($up) {
                            $send_data[] = array(
                                'guest_login_id' => $check_already_guest['guest_user_id'],
                                'hotel_id' => $check_booking_data['hotel_id'],
                                'u_id' => $check_booking_data['u_id'],
                                'booking_id' => $booking_id,
                                'login_id' => $login_id,
                                'otp' => $rand_no,
                            );

                            $response['error_code'] = "200";
                            $response['message'] = "Success";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                        /*$response['error_code'] = "401";
                        $response['message'] = "You already login as guest";
                        echo json_encode($response);
                        exit();*/
                    }
                } else {
                    $response['error_code'] = "401";
                    $response['message'] = "Room not allocated";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "401";
                $response['message'] = "Email/Mobile no is not registerd";
                echo json_encode($response);
                exit();
            }
            /*}
            else
            {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }*/
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //otp verify for guest login//8-11-2022 //archana
    public function verify_otp_for_guest_login()
    {
        if (!empty($this->input->post('guest_login_id')) && !empty($this->input->post('otp'))) {
            // $a=$this->input->post();
            $guest_login_id = $this->input->post('guest_login_id');
            $otp = $this->input->post('otp');

            $wh = '(guest_user_id = "' . $guest_login_id . '" AND otp = "' . $otp . '")';

            $guest_user = $this->ApiModel->getData('guest_user', $wh);

            if ($guest_user) {
                $user = $this->ApiModel->get_user_data($guest_user['u_id']);

                $arr = array(
                    'is_otp_verified' => 1,
                );

                $up = $this->ApiModel->edit_data('guest_user', $wh, $arr);


                $wh1 = '(u_id = "' . $guest_user['u_id'] . '" AND hotel_id = "' . $guest_user['hotel_id'] . '" AND booking_id = "' . $guest_user['booking_id'] . '")';
                // print_r($wh1);die;
                $arr1 = array(
                    'check_in_status' => 1,
                    'id_proff_img' => $user['Id_proff_photo'],
                );

                $checkin_status = $this->ApiModel->edit_checkin_status('user_hotel_booking', $wh1, $arr1);

                $verify_id_status = '';
                if ($checkin_status['id_proff_img']) {
                    $verify_id_status = 1;
                } else {
                    $verify_id_status = 0;
                }

                // print_r($checkin_status);die;
                if ($up && $checkin_status) {


                    $send_data[] = array(
                        'guest_login_id' => $guest_login_id,
                        'u_id' => $guest_user['u_id'],
                        'hotel_id' => $guest_user['hotel_id'],
                        'booking_id' => $guest_user['booking_id'],
                        'check_in_status' => $checkin_status['check_in_status'],
                        'verify_id_status' => $verify_id_status,
                    );

                    $response['error_code'] = "200";
                    $response['message'] = "OTP verified successfully..";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Something went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "loginid and otp does not match";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //upload documents//8-11-2022 //archana
    public function upload_id_proff_document()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('id_proff_img'))) {
            $u_id = $this->input->post('u_id');
            $booking_id = $this->input->post('booking_id');
            $id_proff_img_base64 = $this->input->post('id_proff_img');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $wh = '(u_id = "' . $u_id . '" AND booking_id = "' . $booking_id . '")';
                $booking_data = $this->ApiModel->getData('user_hotel_booking', $wh);

                $b64 = $id_proff_img_base64;
                $bin = base64_decode($b64);
                $size = getImageSizeFromString($bin);

                // Check the MIME type to be sure that the binary data is an image
                if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
                    die('Base64 value is not a valid image');
                }

                $ext = substr($size['mime'], 6);

                // Make sure that you save only the desired file extensions
                if (!in_array($ext, ['png', 'gif', 'jpeg'])) {
                    die('Unsupported image type');
                }


                $base_url = base_url();
                $upload_dir = 'assets/upload/id_proff_pic_for_add_booking/';
                $file_name = md5(uniqid()) . '.' . $ext;
                $file_path = $upload_dir . $file_name;
                $response1 = file_put_contents($file_path, $bin);


                if ($response1) {
                    // Update the database with the image path
                    $img_url = $base_url . $file_path;
                    $arr = array(
                        'id_proff_img' => $img_url,
                    );
                    $up = $this->ApiModel->edit_data('user_hotel_booking', $wh, $arr);
                    // print_r($up);die;
                    if ($up) {
                        $arr1 = array(
                            'check_in_status' => 1,
                        );

                        $wh1 = '(u_id = "' . $u_id . '" AND hotel_id = "' . $booking_data['hotel_id'] . '" AND booking_id = "' . $booking_id . '")';

                        $checkin_status = $this->ApiModel->edit_checkin_status('user_hotel_booking', $wh1, $arr1);

                        $send_data = array(
                            'booking_id' => $booking_id,
                            'u_id' => $u_id,
                            'hotel_id' => $booking_data['hotel_id'],
                            'booking_date' => $booking_data['booking_date'],
                            'check_in' => $booking_data['check_in'],
                            'check_out' => $booking_data['check_out'],
                            'total_charges' => $booking_data['total_charges'],
                            'check_in_status' => $checkin_status['check_in_status'],
                        );
                        //   print_r($send_data);die;                  
                        $response['error_code'] = "200";
                        $response['message'] = "Document upload successfully";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Error saving image file";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }
    //user all nofications//8-11-2022 //archana
    public function get_user_notification()
    {
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $nofication_data = $this->ApiModel->get_user_notifications($u_id);

                if ($nofication_data) {
                    $wh_nt = '(u_id = "' . $u_id . '")';

                    $arr = array(
                        'count_flag' => 0
                    );

                    $change_count_status = $this->ApiModel->edit_data('user_notification', $wh_nt, $arr);

                    if ($change_count_status) {
                        foreach ($nofication_data as $n_d) {
                            $wh = '(u_id ="' . $n_d['hotel_id'] . '")';

                            $get_hotel_logo = $this->ApiModel->getData('register', $wh);

                            if (!empty($get_hotel_logo)) {
                                $hotel_logo = $get_hotel_logo['hotel_logo'];
                            } else {
                                $hotel_logo = '';
                            }

                            $send_data[] = array(
                                'u_notification_id' => $n_d['u_notification_id'],
                                'subject' => $n_d['subject'],
                                'description' => strip_tags($n_d['description']),
                                'hotel_logo' => $hotel_logo,
                                'notification_date' => $n_d['created_at'],
                                'notification_time' => date('h:i A', strtotime($n_d['created_at'])),
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Data not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //hotel enquiry details//9-11-2022 //archana
    public function get_enquiry_request_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_enquiry_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $enquiry_details = $this->ApiModel->get_enquiry_details($u_id, $hotel_enquiry_request_id);

                if ($enquiry_details) {
                    $wh2 = '(city_id = "' . $enquiry_details['city'] . '")';

                    $city_data = $this->ApiModel->getData('city', $wh2);

                    $city = "";

                    if ($city_data) {
                        $city = $city_data['city'];
                    }

                    $wh3 = '(room_type_id = "' . $enquiry_details['room_type'] . '")';

                    $room_type_data = $this->ApiModel->getData('room_type', $wh3);

                    $room_type_name = "";

                    if ($room_type_data) {
                        $room_type_name = $room_type_data['room_type_name'];
                    }

                    $enquiry_other_details = $this->ApiModel->get_hotel_enquiry_details($hotel_enquiry_request_id);

                    $enquiry_data = array();

                    if ($enquiry_other_details) {
                        foreach ($enquiry_other_details as $e_d) {
                            $enquiry_data[] = array(
                                'hotel_enquiry_request_detail_id' => $e_d['hotel_enquiry_request_detail_id'],
                                'no_of_room' => $e_d['no_of_room'],
                                'childs' => $e_d['childs'],
                                'adults' => $e_d['adults'],
                            );
                        }
                    }

                    $send_data[] = array(
                        'hotel_id' => $enquiry_details['hotel_id'],
                        'hotel_name' => $enquiry_details['hotel_name'],
                        'city' => $city,
                        'room_type_name' => $room_type_name,
                        'hotel_state' => $enquiry_details['state'],
                        'check_in_date' => $enquiry_details['check_in_date'],
                        'check_out_date' => $enquiry_details['check_out_date'],
                        'room_charges' => $enquiry_details['room_charges'],
                        'requirement' => $enquiry_details['requirement'],
                        'smoking_room' => $enquiry_details['smoking_room'],
                        'non_smoking_room' => $enquiry_details['non_smoking_room'],
                        'king_bed' => $enquiry_details['king_bed'],
                        'twin_bed' => $enquiry_details['twin_bed'],
                        'mountain_view' => $enquiry_details['mountain_view'],
                        'city_view' => $enquiry_details['city_view'],
                        'top_floors' => $enquiry_details['top_floors'],
                        'lower_floors' => $enquiry_details['lower_floors'],
                        'details' => $enquiry_data
                    );

                    $response['error_code'] = "200";
                    $response['message'] = "Data found";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Data not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //offer lsit//9-11-2022 //archana
    public function get_hotels_offer_list()
    {
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $offer_list = $this->ApiModel->get_offer_list();
                // print_r($offer_list);die;
                if ($offer_list) {
                    foreach ($offer_list as $off) {
                        // if($off['start_date'] >= date('Y-m-d') || $off['end_date'] <= date('Y-m-d'))
                        // {
                        $wh1 = '(u_id = "' . $off['hotel_id'] . '")';

                        $hotel_data = $this->ApiModel->getData('register', $wh1);

                        $hotel_name = "";
                        $city = "";
                        $state = "";

                        if ($hotel_data) {
                            $hotel_name = $hotel_data['hotel_name'];
                            $city = $hotel_data['city'];
                            $state = $hotel_data['state'];
                        }

                        $wh2 = '(hotel_id = "' . $off['hotel_id'] . '")';

                        $hotel_img = $this->ApiModel->getData('hotel_photos', $wh2);

                        $h_images = "";

                        if ($hotel_img) {
                            $h_images = $hotel_img['images'];
                        }

                        $wh3 = '(city_id = "' . $city . '")';

                        $city_data = $this->ApiModel->getData('city', $wh3);

                        $city_name = "";

                        if ($city_data) {
                            $city_name = $city_data['city'];
                        }

                        $hotel_avg_rating = $this->ApiModel->get_hotel_avg_rating($off['hotel_id']);

                        $avrag_rating = 0;

                        if ($hotel_avg_rating[0]['avrag_rating']) {
                            $avrag_rating = round($hotel_avg_rating[0]['avrag_rating'], 2);
                        }

                        $send_data[] = array(
                            'offer_id' => $off['offer_id'],
                            'offer_code' => $off['offer_code'],
                            'offer_for' => $off['offer_for'],
                            'hotel_id' => $off['hotel_id'],
                            'hotel_name' => $hotel_name,
                            'hotel_img' => $h_images,
                            'offer_name' => $off['offer_name'],
                            // 'min_amount' => $off['min_amount'],
                            'amt_in_per' => $off['amt_in_per'],
                            'start_date' => $off['start_date'],
                            'end_date' => $off['end_date'],
                            'image' => $off['image'],
                            'description' => $off['description'],
                            'city' => $city_name,
                            'state' => $state,
                            'avrage_rating' => $avrag_rating,
                        );
                        // }
                        // else
                        // {
                        //     $response['error_code'] = "404";
                        //     $response['message'] = "Offer not available";
                        //     echo json_encode($response);
                        //     exit();
                        // }
                    }

                    $response['error_code'] = "200";
                    $response['message'] = "Data not found";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Data not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //cancel enquiry equest before admin accept//9-11-2022 //archana
    public function cancel_enquiry_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_enquiry_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $wh = '(hotel_enquiry_request_id = "' . $hotel_enquiry_request_id . '")';

                $del = $this->ApiModel->delete_data('hotel_enquiry_request', $wh);

                $del = $this->ApiModel->delete_data('hotel_enquiry_request_details', $wh);

                if ($del) {
                    $response['error_code'] = "200";
                    $response['message'] = "Enquiry request cancelled succsessfully";
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Something went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //reject enquiry equest after admin accept //9-11-2022 //archana
    public function reject_enquiry_request_by_user()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_enquiry_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_enquiry_request_id = $this->input->post('hotel_enquiry_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $wh = '(hotel_enquiry_request_id = "' . $hotel_enquiry_request_id . '")';

                $arr = array(
                    'request_status' => 2,    // 'request_status' => 3,
                    'request_reject_by' => 3,
                    'request_reject_by_u_id' => $u_id,
                    'reject_date' => date('Y-m-d'),
                );

                $up = $this->ApiModel->edit_data('hotel_enquiry_request', $wh, $arr);

                if ($up) {
                    $response['error_code'] = "200";
                    $response['message'] = "Request rejected";
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Something went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //currently my booking details//10-11-2022 //archana
    public function my_hotel_booking_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {


            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    //count of orders
                    //pending request count

                    $wh = '(hotel_id = "' . $hotel_id . '" AND u_id = "' . $u_id . '" AND booking_id = "' . $booking_id . '" AND order_status = 0)';

                    $cloth_order = $this->ApiModel->getAllData('cloth_orders', $wh);

                    $food_orders = $this->ApiModel->getAllData('food_orders', $wh);

                    $house_keeping_orders = $this->ApiModel->getAllData('house_keeping_orders', $wh);

                    $rmservice_services_orders = $this->ApiModel->getAllData('rmservice_services_orders', $wh);

                    $room_service_menu_orders = $this->ApiModel->getAllData('room_service_menu_orders', $wh);

                    $request_pending = count($cloth_order) + count($food_orders) + count($house_keeping_orders) + count($rmservice_services_orders) + count($room_service_menu_orders);

                    //services count(complete count)

                    $wh2 = '(hotel_id = "' . $hotel_id . '" AND u_id = "' . $u_id . '" AND booking_id = "' . $booking_id . '" AND order_status = 2)';

                    $cloth_order_com = $this->ApiModel->getAllData('cloth_orders', $wh);

                    $food_orders_com = $this->ApiModel->getAllData('food_orders', $wh);

                    $house_keeping_orders_com = $this->ApiModel->getAllData('house_keeping_orders', $wh);

                    $rmservice_services_orders_com = $this->ApiModel->getAllData('rmservice_services_orders', $wh);

                    $room_service_menu_orders_com = $this->ApiModel->getAllData('room_service_menu_orders', $wh);

                    $service_count = count($cloth_order_com) + count($food_orders_com) + count($house_keeping_orders_com) + count($rmservice_services_orders_com) + count($room_service_menu_orders_com);

                    //get visitors permission

                    $total_visitor = $this->ApiModel->get_total_visitors_count($hotel_id, $u_id, $booking_id);

                    //pending payment

                    $wh_pay = '(hotel_id = "' . $hotel_id . '" AND u_id = "' . $u_id . '" AND booking_id = "' . $booking_id . '" AND is_paid_advance_payment = 0)';

                    $user_checkout_data = $this->ApiModel->getAllData('user_checkout_data', $wh_pay);
                    //   print_r($user_checkout_data);die;
                    $wh_get_vis = '(hotel_id = "' . $hotel_id . '" AND u_id = "' . $u_id . '" AND booking_id = "' . $booking_id . '" AND is_otp_verified = 0 AND is_otp_correct = 0)';
                    $visitor_data = $this->ApiModel->getAllData('visitor', $wh_get_vis);
                    // print_r($visitor_data);die;

                    $payment_pending = count($user_checkout_data);

                    $count_data[] = array(
                        'request_pending' => $request_pending,
                        'service_pending' => $service_count,
                        'payment_pending' => $payment_pending,
                        'total_bill' => $user_checkout_data[0]['total_bill'],
                        'visitor_permission' => count($total_visitor)
                    );

                    $count_data1 = array();

                    if ($count_data) {
                        $count_data1 = $count_data;
                    }

                    //booking details
                    $booking_data = $this->ApiModel->get_user_booking_details($u_id, $hotel_id, $booking_id);

                    if ($booking_data) {
                        $wh_c_w = '(booking_id = "' . $booking_id . '" AND title = "Call waiter from user")';
                        $call_waiter_list = $this->ApiModel->getAllData('notifications', $wh_c_w);

                        $call_waiter_flag = "";
                        if ($call_waiter_list) {
                            foreach ($call_waiter_list as $c_w_l) {
                                if ($c_w_l['order_status'] == 0) {
                                    $call_waiter_flag = 0;
                                } else {
                                    $call_waiter_flag = 4;
                                }
                            }
                        } else {
                            $call_waiter_flag = 4;
                        }

                        $booking_status = '';
                        if ($booking_data['check_in_status'] == 1) {
                            $booking_status = true;
                        } else {
                            $booking_status = false;
                        }

                        $id_proff_img_flag = '';
                        if ($booking_data['id_proff_img']) {
                            $id_proff_img_flag = 1;
                        } else {
                            $id_proff_img_flag = 0;
                        }

                        $hotel_data = $this->ApiModel->get_hotel_data($hotel_id);

                        $hotel_name = "";
                        $mobile_no = "";

                        if ($hotel_data) {
                            $hotel_name = $hotel_data['hotel_name'];
                            $mobile_no = $hotel_data['mobile_no'];
                        }

                        $wh = '(hotel_id = "' . $hotel_id . '")';

                        $hotel_img = $this->ApiModel->getData('hotel_photos', $wh);

                        $images = "";

                        if ($hotel_img) {
                            $images = $hotel_img['images'];
                        }

                        $wh2 = '(booking_id = "' . $booking_id . '")';

                        $room_no_data = $this->ApiModel->getAllData('user_hotel_booking_details', $wh2);

                        $room_data = array();

                        if ($room_no_data) {
                            foreach ($room_no_data as $r_n_m) {
                                $room_data[] = array(
                                    'room_no' => $r_n_m['room_no']
                                );
                            }
                        }

                        $dnd_mode_flag = "";
                        $dnd_mode = "";

                        if ($guest_user['dnd_mode'] == 1) {
                            $dnd_mode_flag = "1";
                            $dnd_mode = "On";
                        } else {
                            if ($guest_user['dnd_mode'] == 2) {
                                $dnd_mode_flag = "2";
                                $dnd_mode = "Off";
                            }
                        }

                        $send_data[] = array(
                            'hotel_id' => $hotel_id,
                            'hotel_name' => $hotel_name,
                            'mobile_no' => $mobile_no,
                            'images' => $images,
                            'check_in_date' => $booking_data['check_in'],
                            'check_out_date' => $booking_data['check_out'],
                            'total_charges' => $booking_data['total_charges'],
                            'no_of_guests' => $booking_data['no_of_guests'],
                            'no_of_rooms' => $booking_data['no_of_rooms'],
                            'total_adults' => $booking_data['total_adults'],
                            'total_child' => $booking_data['total_child'],
                            'check_in_status' => $booking_status,
                            'id_proff_img_flag' => $id_proff_img_flag,
                            'dnd_mode_flag' => $dnd_mode_flag,
                            'dnd_mode' => $dnd_mode,
                            'room_nos' => $room_data,
                            'visitor_data' => $visitor_data,
                            'booking_id' => $booking_id,
                            'call_waiter_flag' => $call_waiter_flag,
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        $response['count_data'] = $count_data1;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //add visit pass for guest login//10-11-2022 //archana
    public function add_visitor()
    {
        if (
            !empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id'))
            && !empty($this->input->post('booking_id')) && !empty($this->input->post('visitor_name'))
            && !empty($this->input->post('no_of_visitor')) && !empty($this->input->post('visit_date'))
            && !empty($this->input->post('visit_time'))
        ) {
            // $a=$this->input->post();
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $visitor_name = $this->input->post('visitor_name');
            $no_of_visitor = $this->input->post('no_of_visitor');
            $visit_date = $this->input->post('visit_date');
            $visit_time = $this->input->post('visit_time');
            // $room_no = $this->input->post('room_no');

            $rand_no = rand('1111', '9999');
            $user_details = $this->ApiModel->get_user_room_no($booking_id);
            $room_no = $user_details['room_no'];
            // print_r($room_no);exit;
            $user = $this->ApiModel->get_user_data($u_id);
            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    if ($guest_user['dnd_mode'] == 2) {
                        $wh = '(hotel_id = "' . $hotel_id . '" AND u_id = "' . $u_id . '" AND booking_id = "' . $booking_id . '" And is_otp_verified = 0 AND is_otp_correct = 0)';

                        $check_pending_request = $this->ApiModel->getData('visitor', $wh);
                        // print_r($check_pending_request);die;
                        if ($check_pending_request) {

                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Visitor Request Is Incomplete You Can't Make A New Request";
                            echo json_encode($response);
                            exit();
                        } else {
                            $arr = array(
                                'hotel_id' => $hotel_id,
                                'u_id' => $u_id,
                                'booking_id' => $booking_id,
                                'visitor_name' => $visitor_name,
                                'no_of_visitor' => $no_of_visitor,
                                'visit_date' => $visit_date,
                                'visit_time' => $visit_time,
                                'room_no' => $room_no,
                                'otp' => $rand_no,
                                // 'visit_date' => $visit_date,
                            );

                            $add = $this->ApiModel->insert_data('visitor', $arr);
                            // print_r($add);die;

                            if ($add) {

                                $hotel_data = $this->ApiModel->get_hotel_data($hotel_id);

                                $hotel_name = $hotel_data['hotel_name'];

                                $subject = "Send request for visit pass";

                                $description = "Sent visit pass request to " . $hotel_name . " hotel";

                                $arr_nt = array(
                                    'hotel_id' => $hotel_id,
                                    'u_id' => $u_id,
                                    'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );

                                $this->ApiModel->insert_data('user_notification', $arr_nt);

                                $send_data[] = array(
                                    'u_id' => $add,
                                    'visitor_id' => $add,
                                    'otp' => $rand_no,
                                    'hotel_id' => $hotel_id,
                                    'booking_id' => $booking_id,
                                );

                                $response['error_code'] = "200";
                                $response['message'] = "Your Request for visit pass has been sent successfully..!";
                                $response['data'] = $send_data;
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }

                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Your DND mode is on.. so that u not sent request to visit pass";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //help and support list for guest login//10-11-2022 //archana
    public function get_help_support_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $help_support_list = $this->ApiModel->get_help_support_list($hotel_id);

                    if ($help_support_list) {
                        foreach ($help_support_list as $hs) {
                            $send_data[] = array(
                                'title' => $hs['question'],
                                'description' => strip_tags($hs['answer']),
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show near by places list//10-11-2022 //archana
    public function get_hotel_near_by_places_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $near_by_places_list = $this->ApiModel->get_near_by_places_list($hotel_id);

                    if ($near_by_places_list) {
                        foreach ($near_by_places_list as $h_plac) {
                            $wh = '(hotel_near_by_place_id = "' . $h_plac['hotel_near_by_place_id'] . '")';

                            $near_by_places_img = $this->ApiModel->getData('hotel_near_by_place_images', $wh);

                            $images = "";

                            if ($near_by_places_img) {
                                $images = $near_by_places_img['images'];
                            }

                            $send_data[] = array(
                                'hotel_near_by_place_id' => $h_plac['hotel_near_by_place_id'],
                                'places' => $h_plac['places'],
                                'places_name' => $h_plac['places_name'],
                                'image' => $images,
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show near by places details//10-11-2022 //archana
    public function get_hotel_near_by_places_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('hotel_near_by_place_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $hotel_near_by_place_id = $this->input->post('hotel_near_by_place_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $near_by_places_details = $this->ApiModel->get_near_by_places_details($hotel_id, $hotel_near_by_place_id);

                    if ($near_by_places_details) {
                        $wh = '(hotel_near_by_place_id = "' . $near_by_places_details['hotel_near_by_place_id'] . '")';

                        $near_by_places_imgs = $this->ApiModel->getAllData('hotel_near_by_place_images', $wh);

                        $images = array();

                        if ($near_by_places_imgs) {
                            foreach ($near_by_places_imgs as $n_img) {
                                $images[] = array(
                                    'id' => $n_img['id'],
                                    'images' => $n_img['images']
                                );
                            }
                        }

                        $send_data[] = array(
                            'hotel_near_by_place_id' => $near_by_places_details['hotel_near_by_place_id'],
                            'places' => $near_by_places_details['places'],
                            'places_name' => $near_by_places_details['places_name'],
                            'contact_no' => $near_by_places_details['contact_no'],
                            'place_address' => strip_tags(str_replace('&nbsp;', '', $near_by_places_details['place_address'])),
                            'description' => strip_tags(str_replace('&nbsp;', '', $near_by_places_details['description'])),
                            'latitute' => $near_by_places_details['latitute'],
                            'longitude' => $near_by_places_details['longitude'],
                            'website_link' => $near_by_places_details['website_link'],
                            'image' => $images,
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }



    //after guest login show near by help list//10-11-2022 //archana
    public function get_hotel_near_by_help_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $near_by_help_list = $this->ApiModel->get_near_by_help_list($hotel_id);

                    if ($near_by_help_list) {
                        foreach ($near_by_help_list as $n_help) {
                            $wh = '(hotel_near_by_help_id = "' . $n_help['hotel_near_by_help_id'] . '")';

                            $near_by_help_img = $this->ApiModel->getData('hotel_near_by_help_images', $wh);

                            $images = "";

                            if ($near_by_help_img) {
                                $images = $near_by_help_img['images'];
                            }

                            $send_data[] = array(
                                'hotel_near_by_help_id' => $n_help['hotel_near_by_help_id'],
                                'places' => $n_help['places_name'],
                                'image' => $images,
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show near by help details//10-11-2022 //archana
    public function get_hotel_near_by_help_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('hotel_near_by_help_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $hotel_near_by_help_id = $this->input->post('hotel_near_by_help_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $near_by_help_details = $this->ApiModel->get_near_by_help_details($hotel_id, $hotel_near_by_help_id);

                    if ($near_by_help_details) {
                        $wh = '(hotel_near_by_help_id = "' . $near_by_help_details['hotel_near_by_help_id'] . '")';

                        $near_by_help_imgs = $this->ApiModel->getAllData('hotel_near_by_help_images', $wh);

                        $images = array();

                        if ($near_by_help_imgs) {
                            foreach ($near_by_help_imgs as $n_img) {
                                $images[] = array(
                                    'id' => $n_img['id'],
                                    'images' => $n_img['images']
                                );
                            }
                        }

                        $send_data[] = array(
                            'hotel_near_by_help_id' => $near_by_help_details['hotel_near_by_help_id'],
                            'places_name' => $near_by_help_details['places_name'],
                            'name' => $near_by_help_details['name'],
                            'contact_no' => $near_by_help_details['contact_no'],
                            'place_address' => strip_tags($near_by_help_details['place_address']),
                            'description' => strip_tags($near_by_help_details['description']),
                            'open_time' => date('h:i A', strtotime($near_by_help_details['open_time'])),
                            'close_time' => date('h:i A', strtotime($near_by_help_details['close_time'])),
                            'image' => $images,
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show their offers//10-11-2022 //archana
    public function get_login_hotel_offer_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $hotel_offer_list = $this->ApiModel->get_hotel_offer_list($hotel_id);

                    if ($hotel_offer_list) {
                        foreach ($hotel_offer_list as $off) {
                            $wh1 = '(u_id = "' . $off['hotel_id'] . '")';

                            $hotel_data = $this->ApiModel->getData('register', $wh1);

                            $hotel_name = "";

                            if ($hotel_data) {
                                $hotel_name = $hotel_data['hotel_name'];
                            }

                            $wh2 = '(hotel_id = "' . $off['hotel_id'] . '")';

                            $hotel_img = $this->ApiModel->getData('hotel_photos', $wh2);

                            $h_images = "";

                            if ($hotel_img) {
                                $h_images = $hotel_img['images'];
                            }
                            $send_data[] = array(
                                'offer_id' => $off['offer_id'],
                                'offer_code' => $off['offer_code'],
                                'hotel_id' => $off['hotel_id'],
                                'hotel_name' => $hotel_name,
                                'hotel_img' => $h_images,
                                'offer_name' => $off['offer_name'],
                                'min_amount' => $off['min_amount'],
                                'amt_in_per' => $off['amt_in_per'],
                                'start_date' => $off['start_date'],
                                'end_date' => $off['end_date'],
                                'image' => $off['image'],
                                'description' => strip_tags($off['description']),
                            );

                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show their guide lines//10-11-2022 //archana
    public function get_hotel_guidelines()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $hotel_guidelines_data = $this->ApiModel->get_hotel_guidelines_data($hotel_id);

                    if ($hotel_guidelines_data) {
                        $send_data[] = array(
                            'hotel_guideline_id' => $hotel_guidelines_data['hotel_guideline_id'],
                            'hotel_id' => $hotel_guidelines_data['hotel_id'],
                            'content' => strip_tags(str_replace('&nbsp;', '', $hotel_guidelines_data['content'])),

                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Data not found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show their add order complaints//10-11-2022 //archana
    public function add_order_complaints()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('complaint_for')) && !empty($this->input->post('order_description')) && !empty($this->input->post('issue_details')) && !empty($this->input->post('image'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $complaint_for = $this->input->post('complaint_for');
            $order_description = $this->input->post('order_description');
            $issue_details = $this->input->post('issue_details');
            $image = $this->input->post('image');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $b64 = $image;
                    $bin = base64_decode($b64);
                    $size = getImageSizeFromString($bin);

                    if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
                        die('Base64 value is not a valid image');
                    }

                    $ext = substr($size['mime'], 6);

                    if (!in_array($ext, ['png', 'gif', 'jpeg'])) {
                        die('Unsupported image type');
                    }

                    $base_url = base_url();
                    $upload_dir = 'assets/upload/complaint_img/';
                    $file_name = md5(uniqid()) . '.' . $ext;
                    $file_path = $upload_dir . $file_name;
                    $response1 = file_put_contents($file_path, $bin);

                    if ($response1) {
                        $img_url = $base_url . $file_path;

                        $arr = array(
                            'hotel_id' => $hotel_id,
                            'u_id' => $u_id,
                            'booking_id' => $booking_id,
                            'complaint_for' => $complaint_for,
                            'order_description' => $order_description,
                            'image' => $img_url,
                            'issue_details' => $issue_details,
                            'added_by' => 1,
                            'added_by_u_id' => $u_id,
                        );

                        $add = $this->ApiModel->insert_data('order_complaints', $arr);

                        if ($add) {
                            $send_data[] = array(
                                'complaint_id' => $add,
                                'complaint_for' => $complaint_for,
                                'order_description' => $order_description,
                                'issue_details' => $issue_details,
                                'hotel_id' => $hotel_id,
                                'booking_id' => $booking_id,
                            );

                            $response['error_code'] = "200";
                            $response['message'] = "Your complaint has been submit successfully..!";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Error to upload images";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show their ON and OFF DND button//10-11-2022 //archana
    public function on_off_dnd_mode()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('dnd_mode'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $dnd_mode = $this->input->post('dnd_mode');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';

                    $arr = array(
                        'dnd_mode' => $dnd_mode
                    );

                    $add = $this->ApiModel->edit_data('guest_user', $wh, $arr);

                    if ($add) {
                        if ($dnd_mode == 1) {
                            $response['error_code'] = "200";
                            $response['message'] = "Your DND mode is activated";
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "DND mode is deactivate";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show my complaints//14-11-2022 //archana
    public function get_my_order_complaint_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('complaint_for'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $complaint_for = $this->input->post('complaint_for');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $my_complaint_list = $this->ApiModel->get_user_order_complaint_list($hotel_id, $u_id, $complaint_for);

                    if ($my_complaint_list) {
                        foreach ($my_complaint_list as $c_l) {
                            if ($c_l['complaint_status'] == 0) {
                                $complaint_status = "Pending";
                            } else {
                                if ($c_l['complaint_status'] == 1) {
                                    $complaint_status = "Solved";
                                } else {
                                    if ($c_l['complaint_status'] == 2) {
                                        $complaint_status = "Unsolved";
                                    }
                                }
                            }

                            $send_data[] = array(
                                'complaint_id' => $c_l['complaint_id'],
                                'complaint_for' => $c_l['complaint_for'],
                                'order_description' => $c_l['order_description'],
                                'image' => $c_l['image'],
                                'issue_details' => $c_l['issue_details'],
                                'complaint_status' => $complaint_status,
                                'complaint_status_flag' => $c_l['complaint_status'],
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show food facility//14-11-2022 //archana
    public function get_our_food_facility()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $food_facility = $this->ApiModel->get_food_facility($hotel_id);

                    if ($food_facility) {
                        foreach ($food_facility as $ff) {
                            $send_data[] = array(
                                'food_facility_id' => $ff['food_facility_id'],
                                'facility_name' => $ff['facility_name'],
                                'description' => str_replace('&nbsp;', '', $ff['description']),
                                'icon' => $ff['icon'],
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show food category//14-11-2022 //archana
    public function get_our_food_category()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_facility_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $food_facility_id = $this->input->post('food_facility_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $food_category = $this->ApiModel->get_food_category($hotel_id, $food_facility_id);

                    if ($food_category) {
                        foreach ($food_category as $fc) {
                            $send_data[] = array(
                                'food_category_id' => $fc['food_category_id'],
                                'food_facility_id' => $fc['food_facility_id'],
                                'food_facility_name' => $fc['facility_name'],
                                'category_name' => $fc['category_name'],
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show breakfast food menus with price//14-11-2022 //archana
    public function get_our_breakfast_food_menu()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_facility_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $food_facility_id = $this->input->post('food_facility_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $breakfast_food_menus = $this->ApiModel->get_breakfast_food_menus($hotel_id, $food_facility_id);

                    if ($breakfast_food_menus) {
                        foreach ($breakfast_food_menus as $bfm) {
                            if ($bfm['time_in'] == 1) {
                                $time_in = "Minute";
                            } else {
                                if ($bfm['time_in'] == 2) {
                                    $time_in = "Hrs";
                                }
                            }
                            $prepartion_time = $bfm['prepartion_time'] . " " . $time_in;

                            $send_data[] = array(
                                'food_item_id' => $bfm['food_item_id'],
                                'hotel_id' => $bfm['hotel_id'],
                                'food_facility_id' => $bfm['food_facility_id'],
                                'facility_name' => $bfm['facility_name'],
                                'food_category_id' => $bfm['food_category_id'],
                                'category_name' => $bfm['category_name'],
                                'items_name' => $bfm['items_name'],
                                'price' => $bfm['price'],
                                'item_img' => $bfm['item_img'],
                                'offer_price' => $bfm['discount_price'],
                                'prepartion_time' => $prepartion_time,
                                'description' => $bfm['description'],
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show regular food menus with price//14-11-2022 //archana
    public function get_our_regular_food_menu()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_facility_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $food_facility_id = $this->input->post('food_facility_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $regular_food_menus = $this->ApiModel->get_regular_food_menus($hotel_id, $food_facility_id);

                    if ($regular_food_menus) {
                        foreach ($regular_food_menus as $rfm) {
                            if ($rfm['time_in'] == 1) {
                                $time_in = "Minute";
                            } else {
                                if ($rfm['time_in'] == 2) {
                                    $time_in = "Hrs";
                                }
                            }
                            $prepartion_time = $rfm['prepartion_time'] . " " . $time_in;

                            $send_data[] = array(
                                'food_item_id' => $rfm['food_item_id'],
                                'hotel_id' => $rfm['hotel_id'],
                                'food_facility_id' => $rfm['food_facility_id'],
                                'facility_name' => $rfm['facility_name'],
                                'food_category_id' => $rfm['food_category_id'],
                                'category_name' => $rfm['category_name'],
                                'items_name' => $rfm['items_name'],
                                'price' => $rfm['price'],
                                'item_img' => $rfm['item_img'],
                                'offer_price' => $rfm['discount_price'],
                                'prepartion_time' => $prepartion_time,
                                'description' => $rfm['description'],
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show today special food menus with price//14-11-2022 //archana
    public function get_our_today_special_food_menu()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_facility_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $food_facility_id = $this->input->post('food_facility_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $today_special_food_menus = $this->ApiModel->get_today_special_food_menus($hotel_id, $food_facility_id);

                    if ($today_special_food_menus) {
                        foreach ($today_special_food_menus as $tsfm) {
                            if ($tsfm['time_in'] == 1) {
                                $time_in = "Minute";
                            } else {
                                if ($tsfm['time_in'] == 2) {
                                    $time_in = "Hrs";
                                }
                            }
                            $prepartion_time = $tsfm['prepartion_time'] . " " . $time_in;

                            $send_data[] = array(
                                'food_item_id' => $tsfm['food_item_id'],
                                'hotel_id' => $tsfm['hotel_id'],
                                'food_facility_id' => $tsfm['food_facility_id'],
                                'facility_name' => $tsfm['facility_name'],
                                'food_category_id' => $tsfm['food_category_id'],
                                'category_name' => $tsfm['category_name'],
                                'items_name' => $tsfm['items_name'],
                                'price' => $tsfm['price'],
                                'item_img' => $tsfm['item_img'],
                                'offer_price' => $tsfm['discount_price'],
                                'prepartion_time' => $prepartion_time,
                                'description' => str_replace('&nbsp;', '', $tsfm['description']),
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login place oder for food//14-11-2022 //archana
    public function placed_order_for_food_menu()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_data')) && !empty($this->input->post('order_total'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $order_total = $this->input->post('order_total');
            $additional_note = $this->input->post('additional_note');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh_r = '(booking_id = "' . $booking_id . '")';
                    $room_details = $this->ApiModel->getData('user_hotel_booking_details', $wh_r);

                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'u_id' => $u_id,
                        'booking_id' => $booking_id,
                        'order_from' => 3,
                        'order_total' => $order_total,
                        'additional_note' => $additional_note,
                        'room_no' => $room_details['room_no'],
                        'order_date' => date('Y-m-d'),
                        'order_time' => date('H:i A'),
                        'added_by' => 2,
                        'added_by' => $u_id
                    );

                    $add = $this->ApiModel->insert_data('food_orders', $arr);

                    if ($add) {
                        $food_data = json_decode($this->input->post('food_data'), TRUE);

                        foreach ($food_data as $fd) {
                            // print_r($fd);die;
                            $arr1 = array(
                                'hotel_id' => $hotel_id,
                                'food_order_id' => $add,
                                'food_items_id' => $fd['food_item_id'],
                                'price' => $fd['price'],
                                'total' => $fd['price'] * $fd['quantity'],
                                'quantity' => $fd['quantity'],
                            );

                            $add_detail = $this->ApiModel->insert_data('food_order_details', $arr1);

                            if ($add_detail) {
                                $wh = '(food_item_id = "' . $fd['food_item_id'] . '")';

                                $food_menu = $this->ApiModel->getData('food_menus', $wh);

                                if ($food_menu['time_in'] == 1) {
                                    $time_in = "Minute";
                                    $prepartion_time = $food_menu['prepartion_time'];
                                } else {
                                    if ($food_menu['time_in'] == 2) {
                                        $time_in = "Hrs";
                                        $prepartion_time1 = $food_menu['prepartion_time'];

                                        $prepartion_time = $prepartion_time1 * 60;
                                    }
                                }

                                $current_time = date('h:i');
                                $time = strtotime($current_time);

                                $delivery_time = date("h:i", strtotime('+' . $prepartion_time . ' minutes', $time));

                                $wh_d = '(food_order_id = "' . $add . '")';

                                $arrdel_time = array(
                                    'delivery_time' => $delivery_time,
                                );

                                $this->ApiModel->edit_data('food_orders', $wh_d, $arrdel_time);
                            }
                        }

                        if ($add && $add_detail) {
                            /*$arr_notification = array(
                                                         'u_id' => $u_id,
                                                         'hotel_id' => $hotel_id,                                               
                                                         'booking_id' => $booking_id,
                                                            'title' => 'Your Order Is Placed',
                                                            'description' => 'Your Order is Placed...!'
                                                     );

                           $add_notification = $this->ApiModel->insert_data('guest_login_user_notification',$arr_notification);*/

                            $wh_d = '(food_order_id = "' . $add . '")';

                            $food_orders = $this->ApiModel->getData('food_orders', $wh_d);

                            $send_data[] = array(
                                'food_order_id' => $add,
                                'approximately_delivery_time' => date('h:i A', strtotime($food_orders['delivery_time']))
                            );

                            $response['error_code'] = "200";
                            $response['message'] = "Your order is placed.";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        }

                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cancel food placed order before accept //14-11-2022 //archana
    public function cancel_food_menu_order()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $food_order_id = $this->input->post('food_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(food_order_id = "' . $food_order_id . '")';

                    $arr = array(
                        'order_status' => 4,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('food_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }
 //get show feedback user check in
    public function get_feedback()
{
    if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
        $u_id = $this->input->post('u_id');
        $hotel_id = $this->input->post('hotel_id');
        $booking_id = $this->input->post('booking_id');

        // Check if the user exists
        $user = $this->ApiModel->get_user_data($u_id);

        if ($user) {
            // Fetch user feedback based on user ID, hotel ID, and booking ID
            $feedback = $this->ApiModel->get_feedback_data($u_id, $hotel_id, $booking_id);

            if (!empty($feedback)) {
                $response['error_code'] = "200";
                $response['message'] = "Feedback retrieved successfully";
                $response['feedback_data'] = $feedback;
                echo json_encode($response);
                exit();
            } else {
                $response['error_code'] = "404";
                $response['message'] = "No feedback found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "404";
            $response['message'] = "User not found";
            echo json_encode($response);
            exit();
        }
    } else {
        $response['error_code'] = "406";
        $response['message'] = "Required Parameter Missing..!";
        echo json_encode($response);
        exit();
    }
}


    //after guest login add feedback //14-11-2022 //archana
    public function add_feedback()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('review_data'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $review = $this->input->post('review');


            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $review_data = json_decode($this->input->post('review_data'), TRUE);

                    $up = "";

                    foreach ($review_data as $rd) {
                        $arr = array(
                            'hotel_id' => $hotel_id,
                            'u_id' => $u_id,
                            'booking_id' => $booking_id,
                            'rating' => $rd['rating'],
                            'review_for' => $rd['review_for'],
                            'review' => $review,
                            'rating_date' => date('Y-m-d'),
                            'rating_time' => date('H:i:s'),
                        );

                        $up = $this->ApiModel->insert_data('review', $arr);
                    }

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Data Submitted successfully";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login food placed order details //15-11-2022 //archana
    public function get_food_placed_order_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $food_order_id = $this->input->post('food_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(food_order_id = "' . $food_order_id . '" AND order_status = 0)';

                    $food_order_data = $this->ApiModel->getData('food_orders', $wh);

                    if ($food_order_data) {
                        $wh1 = '(food_order_id = "' . $food_order_id . '")';

                        $food_order_details = $this->ApiModel->getAllData('food_order_details', $wh1);

                        $food_menu_data = array();

                        if ($food_order_details) {
                            foreach ($food_order_details as $f_o_d) {
                                $wh_fm = '(food_item_id = "' . $f_o_d['food_items_id'] . '")';

                                $food_menus_data = $this->ApiModel->getData('food_menus', $wh_fm);

                                $items_name = "";

                                if ($food_menus_data) {
                                    $items_name = $food_menus_data['items_name'];
                                }

                                $food_menu_data[] = array(
                                    'food_order_details_id' => $f_o_d['food_order_details_id'],
                                    'food_order_id' => $f_o_d['food_order_id'],
                                    'food_items_id' => $f_o_d['food_items_id'],
                                    'items_name' => $items_name,
                                    'price' => $f_o_d['price'],
                                    'quantity' => $f_o_d['quantity']
                                );
                            }
                        }
                        $send_data[] = array(
                            'food_order_id' => $food_order_data['food_order_id'],
                            'hotel_id' => $food_order_data['hotel_id'],
                            'booking_id' => $food_order_data['booking_id'],
                            'order_total' => $food_order_data['order_total'],
                            'delivery_time' => $food_order_data['delivery_time'],
                            'order_date' => $food_order_data['order_date'],
                            'order_time' => date('h:i a', strtotime($food_order_data['created_at'])),
                            'food_menu_data' => $food_menu_data
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['send_data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login food placed order is paid //15-11-2022 //archana
    public function is_paid_food_placed_order_amount()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $food_order_id = $this->input->post('food_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(food_order_id = "' . $food_order_id . '")';

                    $arr = array(
                        'is_paid' => 1,
                        'paid_date' => date('Y-m-d'),
                    );

                    $up = $this->ApiModel->edit_data('food_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Amount Paid Successfully";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login house keeping services //15-11-2022 //archana
    public function get_our_housekeeping_services()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $housekeeping_services = $this->ApiModel->get_housekeeping_services($hotel_id);

                    if ($housekeeping_services) {
                        foreach ($housekeeping_services as $hs) {
                            $send_data[] = array(
                                'h_k_services_id' => $hs['h_k_services_id'],
                                'service_type' => $hs['service_type'],
                                'amount' => $hs['amount'],
                                'icon' => $hs['icon']
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login place oder for house keeping services//15-11-2022 //archana
    public function placed_order_for_housekeeping_services()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('housekeeping_data'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $additional_note = $this->input->post('additional_note');
            $order_total = $this->input->post('order_total');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'u_id' => $u_id,
                        'booking_id' => $booking_id,
                        'order_from' => 3,
                        'order_date' => date('Y-m-d'),
                        'order_time' => date('H:i A'),
                        'additional_note' => $additional_note,
                        'order_total' => $order_total,
                        'added_by' => 2,
                        'added_by' => $u_id,
                    );

                    $add = $this->ApiModel->insert_data('house_keeping_orders', $arr);

                    if ($add) {
                        $housekeeping_data = json_decode($this->input->post('housekeeping_data'), TRUE);

                        foreach ($housekeeping_data as $hk) {
                            $arr1 = array(
                                'hotel_id' => $hotel_id,
                                'h_k_order_id' => $add,
                                'h_k_service_id' => $hk['h_k_service_id'],
                                'price' => $hk['price'],
                                'quantity' => $hk['quantity'],
                            );

                            $add_detail = $this->ApiModel->insert_data('house_keeping_order_details', $arr1);

                        }

                        if ($add && $add_detail) {
                            $send_data[] = array(
                                'h_k_order_id' => $add
                            );

                            $response['error_code'] = "200";
                            $response['message'] = "Your order is placed.";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login housekeeping placed order details //15-11-2022 //archana
    public function get_housekeeping_placed_order_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('h_k_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $h_k_order_id = $this->input->post('h_k_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(h_k_order_id = "' . $h_k_order_id . '" AND order_status = 0)';

                    $house_keeping_orders_data = $this->ApiModel->getData('house_keeping_orders', $wh);

                    if ($house_keeping_orders_data) {
                        $wh1 = '(h_k_order_id = "' . $h_k_order_id . '")';

                        $house_keeping_order_details = $this->ApiModel->getAllData('house_keeping_order_details', $wh1);

                        $housekeeping_service_data = array();

                        if ($house_keeping_order_details) {
                            foreach ($house_keeping_order_details as $hk_o_d) {
                                $wh_hk = '(h_k_services_id = "' . $hk_o_d['h_k_service_id'] . '")';

                                $house_keeping_services_data = $this->ApiModel->getData('house_keeping_services', $wh_hk);

                                $service_type = "";

                                if ($house_keeping_services_data) {
                                    $service_type = $house_keeping_services_data['service_type'];
                                }

                                $housekeeping_service_data[] = array(
                                    'h_k_order_details_id' => $hk_o_d['h_k_order_details_id'],
                                    'h_k_order_id' => $hk_o_d['h_k_order_id'],
                                    'h_k_service_id' => $hk_o_d['h_k_service_id'],
                                    'service_type_name' => $service_type,
                                    'price' => $hk_o_d['price'],
                                    'quantity' => $hk_o_d['quantity']
                                );
                            }
                        }

                        $send_data[] = array(
                            'h_k_order_id' => $house_keeping_orders_data['h_k_order_id'],
                            'hotel_id' => $house_keeping_orders_data['hotel_id'],
                            'booking_id' => $house_keeping_orders_data['booking_id'],
                            'order_date' => $house_keeping_orders_data['order_date'],
                            'order_total' => $house_keeping_orders_data['order_total'],
                            'order_time' => date('h:i a', strtotime($house_keeping_orders_data['created_at'])),
                            'housekeeping_service_data' => $housekeeping_service_data
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['send_data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cancel housekeeping service placed order before accept //15-11-2022 //archana
    public function cancel_house_keeping_service_order()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('h_k_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $h_k_order_id = $this->input->post('h_k_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(h_k_order_id = "' . $h_k_order_id . '")';

                    $arr = array(
                        'order_status' => 4,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('house_keeping_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login house keeping placed order is paid //15-11-2022 //archana
    public function is_paid_housekeeping_service_placed_order_amount()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('h_k_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $h_k_order_id = $this->input->post('h_k_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(h_k_order_id = "' . $h_k_order_id . '")';

                    $arr = array(
                        'is_paid' => 1,
                        'paid_date' => date('Y-m-d'),
                    );

                    $up = $this->ApiModel->edit_data('house_keeping_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Amount Paid Successfully";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login laundry timing and cloth name nad price //15-11-2022 //archana
    public function get_our_laundry_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $laundry_time = $this->ApiModel->get_laundry_time($hotel_id);

                    $cloth_list = $this->ApiModel->get_cloth_list($hotel_id);

                    $laundry_time_data = array();
                    $cloth_data = array();

                    if ($laundry_time) {
                        $pick_up_time = date('h:i a', strtotime($laundry_time['pick_up_start_time'])) . " to " . date('h:i a', strtotime($laundry_time['pick_up_end_time']));

                        $drop_time = date('h:i a', strtotime($laundry_time['drop_start_time'])) . " to " . date('h:i a', strtotime($laundry_time['drop_end_time']));

                        $laundry_time_data[] = array(
                            'pick_up_time' => $pick_up_time,
                            'drop_time' => $drop_time
                        );
                    }

                    if ($cloth_list) {
                        foreach ($cloth_list as $cl) {
                            $cloth_data[] = array(
                                'cloth_id' => $cl['cloth_id'],
                                'cloth_name' => $cl['cloth_name'],
                                'price' => $cl['price'],
                                'image' => $cl['image'],
                            );
                        }
                    }

                    if ($laundry_time_data || $cloth_data) {
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['laundry_time_data'] = $laundry_time_data;
                        $response['cloth_data'] = $cloth_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login place order for laudry//15-11-2022 //archana
    //in which assign staff to this order then generate otp to confirm your order
    public function placed_order_for_laundry()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('order_total')) && !empty($this->input->post('laundry_data'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $order_total = $this->input->post('order_total');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'u_id' => $u_id,
                        'booking_id' => $booking_id,
                        'order_total' => $order_total,
                        'order_from' => 3,
                        'order_date' => date('Y-m-d'),
                        'order_time' => date('H:i A'),
                        'added_by' => 2,
                        'added_by' => $u_id,
                    );

                    $add = $this->ApiModel->insert_data('cloth_orders', $arr);

                    if ($add) {
                        $laundry_data = json_decode($this->input->post('laundry_data'), TRUE);

                        foreach ($laundry_data as $ld) {
                            $arr1 = array(
                                'hotel_id' => $hotel_id,
                                'cloth_order_id' => $add,
                                'cloth_id' => $ld['cloth_id'],
                                'price' => $ld['price'],
                                'quantity' => $ld['quantity'],
                            );

                            $add_detail = $this->ApiModel->insert_data('cloth_order_details', $arr1);

                        }

                        if ($add && $add_detail) {
                            $send_data[] = array(
                                'cloth_order_id' => $add
                            );

                            $response['error_code'] = "200";
                            $response['message'] = "Your order is placed.";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login laundry placed order details //15-11-2022 //archana
    public function get_laundry_placed_order_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('cloth_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $cloth_order_id = $this->input->post('cloth_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(cloth_order_id = "' . $cloth_order_id . '" AND order_status = 0)';

                    $cloth_orders_data = $this->ApiModel->getData('cloth_orders', $wh);

                    if ($cloth_orders_data) {
                        $wh1 = '(cloth_order_id = "' . $cloth_order_id . '")';

                        $cloth_order_details = $this->ApiModel->getAllData('cloth_order_details', $wh1);

                        $cloth_data = array();

                        if ($cloth_order_details) {
                            foreach ($cloth_order_details as $c_o_d) {
                                $wh_c = '(cloth_id = "' . $c_o_d['cloth_id'] . '")';

                                $cloths_data = $this->ApiModel->getData('cloth', $wh_c);

                                $cloth_name = "";

                                if ($cloths_data) {
                                    $cloth_name = $cloths_data['cloth_name'];
                                }

                                $cloth_data[] = array(
                                    'cloth_order_details_id' => $c_o_d['cloth_order_details_id'],
                                    'cloth_order_id' => $c_o_d['cloth_order_id'],
                                    'cloth_id' => $c_o_d['cloth_id'],
                                    'cloth_name' => $cloth_name,
                                    'price' => $c_o_d['price'],
                                    'quantity' => $c_o_d['quantity']
                                );
                            }
                        }

                        $send_data[] = array(
                            'cloth_order_id' => $cloth_orders_data['cloth_order_id'],
                            'hotel_id' => $cloth_orders_data['hotel_id'],
                            'booking_id' => $cloth_orders_data['booking_id'],
                            'order_date' => $cloth_orders_data['order_date'],
                            'order_total' => $cloth_orders_data['order_total'],
                            'order_time' => date('h:i a', strtotime($cloth_orders_data['created_at'])),
                            'housekeeping_service_data' => $cloth_data
                        );


                        $response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['send_data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cancel laundry placed order before accept //15-11-2022 //archana
    public function cancel_laundry_order()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('cloth_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $cloth_order_id = $this->input->post('cloth_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(cloth_order_id = "' . $cloth_order_id . '")';

                    $arr = array(
                        'order_status' => 4,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('cloth_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login house keeping placed order is paid //15-11-2022 //archana
    public function is_paid_laundry_placed_order_amount()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('cloth_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $cloth_order_id = $this->input->post('cloth_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(cloth_order_id = "' . $cloth_order_id . '")';

                    $arr = array(
                        'is_paid' => 1,
                        'paid_date' => date('Y-m-d'),
                    );

                    $up = $this->ApiModel->edit_data('cloth_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Amount Paid Successfully";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show their add other complaints//23-11-2022 //archana
    // public function add_other_complaints()
    // {
    //     if(!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('issue_details')) && !empty($this->input->post('complaint_for')) && !empty($this->input->post('image')))

    //     {
    //         $u_id = $this->input->post('u_id');
    //         $hotel_id = $this->input->post('hotel_id');
    //         $booking_id = $this->input->post('booking_id');

    //         $issue_details = $this->input->post('issue_details');
    //         $complaint_for = $this->input->post('complaint_for');
    //         $image = $this->input->post('image');

    //         $user = $this->ApiModel->get_user_data($u_id);

    //         if($user)
    //         {
    //             $guest_user = $this->ApiModel->get_user_guest_data($u_id,$hotel_id,$booking_id);

    //             if($guest_user)
    //             {
    //                 $b64 = $image;
    //                 $bin = base64_decode($b64);
    //                 $size = getImageSizeFromString($bin);

    //                 if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
    //                     die('Base64 value is not a valid image');
    //                 }

    //                 $ext = substr($size['mime'], 6);

    //                 if (!in_array($ext, ['png', 'gif', 'jpeg'])) {
    //                 die('Unsupported image type');
    //                 }

    //                 $base_url= base_url();
    //                 $upload_dir = 'assets/upload/complaint_img/';
    //                 $file_name = md5(uniqid()) . '.' . $ext; 
    //                 $file_path = $upload_dir . $file_name;
    //                 $response1 = file_put_contents($file_path, $bin);

    //                 if ($response1) {

    //                     $img_url = $base_url . $file_path;

    //                     $arr = array(
    //                                     'hotel_id' => $hotel_id,
    //                                     'u_id' => $u_id,
    //                                     'booking_id' => $booking_id,
    //                                     'complaint_for' => $complaint_for,
    //                                     'issue_details' => $issue_details,
    //                                     'image' => $img_url    ,
    //                                     'added_by' => 1,
    //                                     'added_by_u_id' => $u_id,
    //                                 );

    //                     $add = $this->ApiModel->insert_data('other_complaints',$arr);

    //                     if($add)
    //                     {  
    //                         $send_data[] = array(
    //                                                 'complaint_id' => $add,
    //                                                 'issue_details' => $issue_details,
    //                                                 'hotel_id' => $hotel_id,
    //                                                 'booking_id' => $booking_id,
    //                                             );

    //                         $response['error_code'] = "200";
    //                         $response['message'] = "Your complaint has been submit successfully..!";
    //                         $response['data'] = $send_data;
    //                         echo json_encode($response);
    //                         exit();
    //                     }
    //                     else
    //                     {
    //                         $response['error_code'] = "403";
    //                         $response['message'] = "Something went wrong";
    //                         echo json_encode($response);
    //                         exit();
    //                     }
    //                 }
    //                 else
    //                 {
    //                     $response['error_code'] = "401";
    //                     $response['message'] = "Error to upload images";
    //                     echo json_encode($response);
    //                     exit();
    //                 }
    //             }
    //             else
    //             {
    //                 $response['error_code'] = "404";
    //                 $response['message'] = "Guest Login session expired";
    //                 echo json_encode($response);
    //                 exit();
    //             }
    //         }
    //         else
    //         {
    //             $response['error_code'] = "404";
    //             $response['message'] = "User not found";
    //             echo json_encode($response);
    //             exit();
    //         }
    //     }
    //     else
    //     {
    //         $response['error_code'] = "406";
    //         $response['message'] = "Required Parameter Missing..!";
    //         echo json_encode($response);
    //         exit();
    //     }
    // }

    public function add_other_complaints()
    {
        if (
            !empty($this->input->post('u_id')) &&
            !empty($this->input->post('hotel_id')) &&
            !empty($this->input->post('booking_id')) &&
            !empty($this->input->post('issue_details')) &&
            !empty($this->input->post('complaint_for'))
        ) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $issue_details = $this->input->post('issue_details');
            $complaint_for = $this->input->post('complaint_for');
            $image = $this->input->post('image'); // Image is optional

            // Debugging: Check received input values
            error_log("u_id: $u_id, hotel_id: $hotel_id, booking_id: $booking_id");

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                // Debugging: Check if guest user exists
                if (!$guest_user) {
                    error_log("Guest user not found for u_id: $u_id, hotel_id: $hotel_id, booking_id: $booking_id");
                }

                if ($guest_user) {
                    $img_url = '';

                    // Process image only if provided
                    if (!empty($image)) {
                        $b64 = $image;
                        $bin = base64_decode($b64);
                        $size = getImageSizeFromString($bin);

                        if (!empty($size['mime']) && strpos($size['mime'], 'image/') === 0) {
                            $ext = substr($size['mime'], 6);
                            if (in_array($ext, ['png', 'gif', 'jpeg', 'jpg'])) {
                                $upload_dir = 'assets/upload/complaint_img/';
                                $file_name = md5(uniqid()) . '.' . $ext;
                                $file_path = $upload_dir . $file_name;
                                $response1 = file_put_contents($file_path, $bin);

                                if ($response1) {
                                    $img_url = base_url() . $file_path;
                                }
                            }
                        }
                    }

                    // Insert complaint data
                    $arr = [
                        'hotel_id' => $hotel_id,
                        'u_id' => $u_id,
                        'booking_id' => $booking_id,
                        'complaint_for' => $complaint_for,
                        'issue_details' => $issue_details,
                        'image' => $img_url, // Ensure it's never NULL
                        'added_by' => 1,
                        'added_by_u_id' => $u_id,
                    ];

                    $add = $this->ApiModel->insert_data('other_complaints', $arr);

                    if ($add) {
                        $send_data[] = [
                            'complaint_id' => $add,
                            'issue_details' => $issue_details,
                            'hotel_id' => $hotel_id,
                            'booking_id' => $booking_id,
                        ];

                        $response['error_code'] = "200";
                        $response['message'] = "Your complaint has been submitted successfully!";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing!";
            echo json_encode($response);
            exit();
        }
    }


    //after guest login show my other complaints//23-11-2022 //archana
    public function get_my_other_complaint_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('complaint_for'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $complaint_for = $this->input->post('complaint_for');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $my_complaint_list = $this->ApiModel->get_user_other_complaint_list($hotel_id, $u_id, $complaint_for);

                    if ($my_complaint_list) {
                        foreach ($my_complaint_list as $c_l) {
                            if ($c_l['complaint_status'] == 0) {
                                $complaint_status = "Pending";
                            } else {
                                if ($c_l['complaint_status'] == 1) {
                                    $complaint_status = "Solved";
                                } else {
                                    if ($c_l['complaint_status'] == 2) {
                                        $complaint_status = "Unsolved";
                                    }
                                }
                            }
                            $send_data[] = array(
                                'issue_details' => $c_l['issue_details'],
                                'image' => $c_l['image'],
                                'complaint_status' => $complaint_status,
                                'complaint_status_flag' => $c_l['complaint_status'],
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login login hotel panel list //23-11-2022 //archana
    public function get_our_hotel_services()
    {
        if (!empty($this->input->post('hotel_id'))) {
            // $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            // $booking_id = $this->input->post('booking_id');

            // $user = $this->ApiModel->get_user_data($u_id);

            // if($user)
            // {
            //$guest_user = $this->ApiModel->get_user_guest_data($u_id,$hotel_id,$booking_id);

            // if($guest_user)
            // {
            $hotel_panel_list = $this->ApiModel->get_hotel_panel_list($hotel_id);

            if ($hotel_panel_list) {
                foreach ($hotel_panel_list as $hp_l) {
                    $hotel_services = $this->ApiModel->get_hotel_services($hotel_id, $hp_l['department_id']);
                    // print_r($hotel_services);die;
                    $services = array();

                    if ($hotel_services) {
                        foreach ($hotel_services as $hs) {
                            $services[] = array(
                                'services_id' => $hs['services_id'],
                                'services_name' => $hs['services_name'],
                                'status' => $hs['status'],
                            );
                        }
                    }

                    $send_data[] = array(
                        'department_id' => $hp_l['department_id'],
                        'department_name' => $hp_l['department_name'],
                        'department_status' => $hp_l['department_status'],
                        'services' => $services
                    );
                }
                $response['error_code'] = "200";
                $response['message'] = "Data Found";
                $response['data'] = $send_data;
                echo json_encode($response);
                exit();
            } else {
                $response['error_code'] = "404";
                $response['message'] = "Data Not Found";
                echo json_encode($response);
                exit();
            }
            // }
            // else
            // {
            //     $response['error_code'] = "404";
            //     $response['message'] = "Guest Login session expired";
            //     echo json_encode($response);
            //     exit();
            // }
            // }
            // else
            // {
            //     $response['error_code'] = "404";
            //     $response['message'] = "User not found";
            //     echo json_encode($response);
            //     exit();
            // }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login room service services //23-11-2022 //archana
    public function get_our_hotel_roomservice_services()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $roomservice_services = $this->ApiModel->get_roomservice_services_list($hotel_id);

                    if ($roomservice_services) {
                        foreach ($roomservice_services as $rm_s) {
                            $send_data[] = array(
                                'r_s_services_id' => $rm_s['r_s_services_id'],
                                'service_name' => $rm_s['service_name'],
                                'amount' => $rm_s['amount'],
                                'icon_img' => $rm_s['icon_img']
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login place order for roomservice services//23-11-2022 //archana
    public function placed_order_for_roomservice_services()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('order_total')) && !empty($this->input->post('roomservice_service_data'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $order_total = $this->input->post('order_total');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'u_id' => $u_id,
                        'booking_id' => $booking_id,
                        'order_total' => $order_total,
                        'order_from' => 3,
                        'order_date' => date('Y-m-d'),
                        'order_time' => date('H:i:s'),
                        'added_by' => 2,
                        'added_by' => $u_id,
                    );

                    $add = $this->ApiModel->insert_data('rmservice_services_orders', $arr);

                    if ($add) {
                        $roomservice_service_data = json_decode($this->input->post('roomservice_service_data'), TRUE);

                        foreach ($roomservice_service_data as $rm_s) {
                            $arr1 = array(
                                'hotel_id' => $hotel_id,
                                'rmservice_services_order_id' => $add,
                                'room_serv_service_id' => $rm_s['r_s_services_id'],
                                'price' => $rm_s['price'],
                                'quantity' => $rm_s['quantity'],
                            );

                            $add_detail = $this->ApiModel->insert_data('rmservice_services_details', $arr1);

                        }

                        if ($add && $add_detail) {
                            $send_data[] = array(
                                'rmservice_services_order_id' => $add
                            );

                            $response['error_code'] = "200";
                            $response['message'] = "Your order is placed.";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login roomservice services placed order details //23-11-2022 //archana
    public function get_roomservice_services_placed_order_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('rmservice_services_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $rmservice_services_order_id = $this->input->post('rmservice_services_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(rmservice_services_order_id = "' . $rmservice_services_order_id . '" AND order_status = 0)';

                    $rs_services_orders_data = $this->ApiModel->getData('rmservice_services_orders', $wh);

                    if ($rs_services_orders_data) {
                        $wh1 = '(rmservice_services_order_id = "' . $rmservice_services_order_id . '")';

                        $rs_services_orders_data_order_details = $this->ApiModel->getAllData('rmservice_services_details', $wh1);

                        $rs_service_data = array();

                        if ($rs_services_orders_data_order_details) {
                            foreach ($rs_services_orders_data_order_details as $rs_s) {
                                $wh_rm_s = '(r_s_services_id = "' . $rs_s['room_serv_service_id'] . '")';

                                $room_servs_services_data = $this->ApiModel->getData('room_servs_services', $wh_rm_s);

                                $service_name = "";

                                if ($room_servs_services_data) {
                                    $service_name = $room_servs_services_data['service_name'];
                                }

                                $rs_service_data[] = array(
                                    'rmservice_services_detail_id' => $rs_s['rmservice_services_detail_id'],
                                    'rmservice_services_order_id' => $rs_s['rmservice_services_order_id'],
                                    'room_serv_service_id' => $rs_s['room_serv_service_id'],
                                    'service_name' => $service_name,
                                    'price' => $rs_s['price'],
                                    'quantity' => $rs_s['quantity']
                                );
                            }
                        }

                        $send_data[] = array(
                            'rmservice_services_order_id' => $rs_services_orders_data['rmservice_services_order_id'],
                            'hotel_id' => $rs_services_orders_data['hotel_id'],
                            'booking_id' => $rs_services_orders_data['booking_id'],
                            'order_date' => $rs_services_orders_data['order_date'],
                            'order_total' => $rs_services_orders_data['order_total'],
                            'order_time' => date('h:i a', strtotime($rs_services_orders_data['created_at'])),
                            'roomservice_services_data' => $rs_service_data
                        );


                        $response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['send_data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cancel roomservice services placed order before accept //23-11-2022 //archana
    public function cancel_roomservice_services_order()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('rmservice_services_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $rmservice_services_order_id = $this->input->post('rmservice_services_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(rmservice_services_order_id = "' . $rmservice_services_order_id . '")';

                    $arr = array(
                        'order_status' => 4,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('rmservice_services_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login room service services placed order is paid //15-11-2022 //archana
    public function is_paid_roomservice_services_placed_order_amount()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('rmservice_services_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $rmservice_services_order_id = $this->input->post('rmservice_services_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(rmservice_services_order_id = "' . $rmservice_services_order_id . '")';

                    $arr = array(
                        'payment_status' => 1,
                        'paid_date' => date('Y-m-d'),
                    );

                    $up = $this->ApiModel->edit_data('rmservice_services_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Amount Paid Successfully";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login room service menu category //23-11-2022 //archana
    public function get_our_room_service_menu_category()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $room_servs_category = $this->ApiModel->get_roomservice_menu_cat_list($hotel_id);

                    if ($room_servs_category) {
                        foreach ($room_servs_category as $rs_cat) {
                            $send_data[] = array(
                                'room_servs_category_id' => $rs_cat['room_servs_category_id'],
                                'category_name' => $rs_cat['category_name']
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login room service menu list category wise //23-11-2022 //archana
    public function get_our_room_service_menu_list_cateogory_wise()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('room_servs_category_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $room_servs_category_id = $this->input->post('room_servs_category_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $room_serv_menu_list = $this->ApiModel->get_roomservice_menu_list_cat_wise($hotel_id, $room_servs_category_id);

                    if ($room_serv_menu_list) {
                        foreach ($room_serv_menu_list as $rs_m) {
                            $send_data[] = array(
                                'room_serv_menu_id' => $rs_m['room_serv_menu_id'],
                                'room_serv_cat_id' => $rs_m['room_serv_cat_id'],
                                'menu_name' => $rs_m['menu_name'],
                                'price' => $rs_m['price'],
                                'details' => $rs_m['details'],
                                'price' => $rs_m['price'],
                                'image' => $rs_m['image'],
                                'total_price' => $rs_m['total_price']
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login place order for room service menu//23-11-2022 //archana
    public function placed_order_for_room_service_menu()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $order_total = $this->input->post('order_total');
            $additional_note = $this->input->post('additional_note');

            $roomservice_service_data = json_decode($this->input->post('roomservice_service_data'), TRUE);
            $room_service_menu_data = json_decode($this->input->post('room_service_menu_data'), TRUE);

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if (($guest_user)) {
                    $unique_number = rand(1111, 9999);

                    if ($roomservice_service_data && $room_service_menu_data) {
                        $order_is = 3;
                    } else {
                        if ($roomservice_service_data) {
                            $order_is = 1;
                        } else {
                            if ($room_service_menu_data) {
                                $order_is = 2;
                            }
                        }
                    }

                    //add room service menu order
                    $add = "";

                    //if($room_service_menu_data)
                    // {  
                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'u_id' => $u_id,
                        'booking_id' => $booking_id,
                        //  'order_total' => $order_total,
                        'main_total' => $order_total,
                        'order_description' => $additional_note,
                        'order_from' => 3,
                        'order_date' => date('Y-m-d'),
                        'order_time' => date('H:i:s'),
                        'added_by' => 2,
                        'added_by' => $u_id,
                        'order_is' => $order_is,
                        'room_service_unique_id' => $unique_number,
                    );

                    $add = $this->ApiModel->insert_data('room_service_menu_orders', $arr);

                    if ($add) {
                        if ($room_service_menu_data) {
                            foreach ($room_service_menu_data as $rs_m) {
                                $arr1 = array(
                                    'hotel_id' => $hotel_id,
                                    'room_service_menu_order_id' => $add,
                                    'room_service_cat_id' => $rs_m['room_service_cat_id'],
                                    'room_serv_menu_id' => $rs_m['room_serv_menu_id'],
                                    'price' => $rs_m['price'],
                                    'quantity' => $rs_m['quantity'],
                                    'room_service_unique_id' => $unique_number,
                                );

                                $add_detail = $this->ApiModel->insert_data('room_service_menu_details', $arr1);

                                if ($add_detail) {
                                    $wh = '(room_serv_menu_id = "' . $rs_m['room_serv_menu_id'] . '")';

                                    $room_serv_menu = $this->ApiModel->getData('room_serv_menu_list', $wh);

                                    if ($room_serv_menu['time_in'] == 1) {
                                        $time_in = "Minute";
                                        $prepartion_time = $room_serv_menu['prepartion_time'];
                                    } else {
                                        if ($room_serv_menu['time_in'] == 2) {
                                            $time_in = "Hrs";
                                            $prepartion_time1 = $room_serv_menu['prepartion_time'];

                                            $prepartion_time = $prepartion_time1 * 60;
                                        }
                                    }

                                    $current_time = date('h:i');
                                    $time = strtotime($current_time);

                                    $delivery_time = date("h:i", strtotime('+' . $prepartion_time . ' minutes', $time));

                                    $wh_d = '(room_service_menu_order_id = "' . $add . '")';

                                    $rs_m_order_data = $this->ApiModel->getData('room_service_menu_orders', $wh_d);

                                    $arrdel_time = array(
                                        'delivery_time' => $delivery_time,
                                        'order_total' => $rs_m_order_data['order_total'] + ($rs_m['price'] * $rs_m['quantity'])
                                    );

                                    $this->ApiModel->edit_data('room_service_menu_orders', $wh_d, $arrdel_time);
                                }
                            }
                        }
                    }
                    //}

                    $add_rs_service = "";

                    //room service service order
                    if ($roomservice_service_data) {
                        $where = '(booking_id ="' . $this->input->post('booking_id') . '")';
                        $get_room = $this->ApiModel->getData('user_hotel_booking_details', $where);
                        if (!empty($get_room)) {
                            $room_no_data = $get_room['room_no'];
                        } else {
                            $room_no_data = 0;
                        }
                        $arr_rs = array(
                            'hotel_id' => $hotel_id,
                            'room_service_menu_order_id' => $add,
                            'u_id' => $u_id,
                            'booking_id' => $booking_id,
                            // 'order_total' => $order_total,
                            'main_total' => $order_total,
                            'room_no' => $room_no_data,
                            'additional_note' => $additional_note,
                            'order_from' => 3,
                            'order_date' => date('Y-m-d'),
                            'order_time' => date('H:i:s'),
                            'added_by' => 2,
                            'added_by' => $u_id,
                            'room_service_unique_id' => $unique_number,
                        );

                        $add_rs_service = $this->ApiModel->insert_data('rmservice_services_orders', $arr_rs);

                        if ($add_rs_service) {

                            foreach ($roomservice_service_data as $rm_s) {
                                $arr1_rs = array(
                                    'hotel_id' => $hotel_id,
                                    'room_service_menu_order_id' => $add,
                                    'rmservice_services_order_id' => $add_rs_service,
                                    'room_serv_service_id' => $rm_s['r_s_services_id'],
                                    'price' => $rm_s['price'],
                                    'quantity' => $rm_s['quantity'],
                                    'room_service_unique_id' => $unique_number,
                                );

                                $add_rs_detail = $this->ApiModel->insert_data('rmservice_services_details', $arr1_rs);

                                if ($add_rs_detail) {
                                    $wh = '(rmservice_services_order_id = "' . $add_rs_service . '")';

                                    $rs_order_data = $this->ApiModel->getData('rmservice_services_orders', $wh);

                                    $arr_rs_o = array(
                                        'order_total' => $rs_order_data['order_total'] + ($rm_s['price'] * $rm_s['quantity'])
                                    );

                                    $this->ApiModel->edit_data('rmservice_services_orders', $wh, $arr_rs_o);

                                }
                            }
                        }
                    }

                    if (($add || $add_detail) || ($add_rs_service && $add_rs_detail)) {
                        $add1 = "";
                        $add_rs_service1 = "";
                        $date = "";

                        if ($add || $add_detail) {
                            $add1 = $add;

                            $wh_d = '(room_service_menu_order_id = "' . $add . '")';

                            $room_service_menu_orders = $this->ApiModel->getData('room_service_menu_orders', $wh_d);

                            $date = date('h:i A', strtotime($room_service_menu_orders['delivery_time']));

                        }

                        if ($add_rs_service && $add_rs_detail) {
                            $add_rs_service1 = $add_rs_service;
                        }

                        $send_data[] = array(
                            'room_service_menu_order_id' => $add1,
                            'rmservice_services_order_id' => $add_rs_service1,
                            'approximately_delivery_time' => $date,
                            'room_service_unique_id' => $unique_number,
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Your order is placed.";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login roomservice menu placed order details //23-11-2022 //archana
    public function get_room_service_menu_placed_order_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('room_service_menu_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $room_service_menu_order_id = $this->input->post('room_service_menu_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $rs_service_data = array();

                    //room service menu details
                    $wh = '(room_service_unique_id = "' . $room_service_menu_order_id . '" AND order_status = 0)';

                    $room_service_menu_orders_data = $this->ApiModel->getData('room_service_menu_orders', $wh);

                    $room_service_services_orders_data = $this->ApiModel->getData('rmservice_services_orders', $wh);

                    $rmservice_services_order_id = "";

                    if ($room_service_services_orders_data) {
                        $rmservice_services_order_id = $room_service_services_orders_data['rmservice_services_order_id'];
                    }

                    if ($room_service_menu_orders_data) {
                        //menu details
                        $wh1 = '(room_service_unique_id = "' . $room_service_menu_order_id . '")';

                        $room_service_menu_details = $this->ApiModel->getAllData('room_service_menu_details', $wh1);

                        $rs_menu_data = array();

                        if ($room_service_menu_details) {
                            foreach ($room_service_menu_details as $rs_m) {
                                //menu name
                                $wh_rs_m = '(room_serv_menu_id = "' . $rs_m['room_serv_menu_id'] . '")';

                                $room_serv_menu_data = $this->ApiModel->getData('room_serv_menu_list', $wh_rs_m);

                                $menu_name = "";

                                if ($room_serv_menu_data) {
                                    $menu_name = $room_serv_menu_data['menu_name'];
                                }

                                //category name
                                $wh_rs_c = '(room_servs_category_id  = "' . $rs_m['room_serv_menu_id'] . '")';

                                $room_servs_category_data = $this->ApiModel->getData('room_servs_category', $wh_rs_c);

                                $category_name = "";

                                if ($room_servs_category_data) {
                                    $category_name = $room_servs_category_data['category_name'];
                                }

                                $rs_menu_data[] = array(
                                    'room_service_details_id' => $rs_m['room_service_details_id'],
                                    'room_service_menu_order_id' => $rs_m['room_service_menu_order_id'],
                                    'room_service_cat_id' => $rs_m['room_service_cat_id'],
                                    'category_name' => $category_name,
                                    'room_serv_menu_id' => $rs_m['room_serv_menu_id'],
                                    'menu_name' => $menu_name,
                                    'price' => $rs_m['price'],
                                    'quantity' => $rs_m['quantity']
                                );
                            }
                        }

                        //service details
                        $wh1 = '(room_service_unique_id = "' . $room_service_menu_order_id . '")';

                        $rs_services_orders_data_order_details = $this->ApiModel->getAllData('rmservice_services_details', $wh1);

                        $rs_service_data = array();

                        if ($rs_services_orders_data_order_details) {
                            foreach ($rs_services_orders_data_order_details as $rs_s) {
                                $wh_rm_s = '(r_s_services_id = "' . $rs_s['room_serv_service_id'] . '")';

                                $room_servs_services_data = $this->ApiModel->getData('room_servs_services', $wh_rm_s);

                                $service_name = "";

                                if ($room_servs_services_data) {
                                    $service_name = $room_servs_services_data['service_name'];
                                }

                                $rs_service_data[] = array(
                                    'rmservice_services_detail_id' => $rs_s['rmservice_services_detail_id'],
                                    'rmservice_services_order_id' => $rs_s['rmservice_services_order_id'],
                                    'room_serv_service_id' => $rs_s['room_serv_service_id'],
                                    'service_name' => $service_name,
                                    'price' => $rs_s['price'],
                                    'quantity' => $rs_s['quantity']
                                );
                            }
                        }
                        $send_data[] = array(
                            'room_service_menu_order_id' => $room_service_menu_orders_data['room_service_menu_order_id'],
                            'room_service_service_order_id' => $rmservice_services_order_id,
                            'hotel_id' => $room_service_menu_orders_data['hotel_id'],
                            'booking_id' => $room_service_menu_orders_data['booking_id'],
                            'order_date' => $room_service_menu_orders_data['order_date'],
                            'order_total' => $room_service_menu_orders_data['main_total'],
                            'additional_note' => $room_service_menu_orders_data['order_description'],
                            'approximately_delivery_time' => $room_service_menu_orders_data['delivery_time'],
                            'order_time' => date('h:i a', strtotime($room_service_menu_orders_data['created_at'])),
                            'room_service_menu_data' => $rs_menu_data,
                            'roomservice_services_data' => $rs_service_data,
                        );


                        $response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['send_data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cancel room service menu placed order before accept //23-11-2022 //archana
    public function cancel_room_service_menu_order()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('room_service_menu_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $room_service_menu_order_id = $this->input->post('room_service_menu_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(room_service_unique_id = "' . $room_service_menu_order_id . '")';

                    $arr = array(
                        'order_status' => 4,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('room_service_menu_orders', $wh, $arr);

                    $up = $this->ApiModel->edit_data('rmservice_services_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login room service menu placed order is paid //15-11-2022 //archana
    public function is_paid_room_service_menu_placed_order_amount()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('room_service_menu_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $room_service_menu_order_id = $this->input->post('room_service_menu_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(room_service_unique_id = "' . $room_service_menu_order_id . '")';

                    $arr = array(
                        'payment_status' => 1,
                        'paid_date' => date('Y-m-d'),
                    );

                    $up = $this->ApiModel->edit_data('room_service_menu_orders', $wh, $arr);

                    $up = $this->ApiModel->edit_data('rmservice_services_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Amount Paid Successfully";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, login hotel minibar //24-11-2022 //archana
    public function get_our_hotel_minibar()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $room_servs_mini_bar = $this->ApiModel->get_hotel_minibar($hotel_id);

                    if ($room_servs_mini_bar) {
                        foreach ($room_servs_mini_bar as $rs_m) {
                            $send_data[] = array(
                                'r_s_min_bar_id' => $rs_m['r_s_min_bar_id'],
                                'item_name' => $rs_m['item_name'],
                                'price' => $rs_m['price'],
                                'icon_img' => $rs_m['icon_img'],
                                'description' => strip_tags($rs_m['description'])
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my all food order not only complete //24-11-2022 //archana
    public function get_my_food_order_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $user_food_orders = $this->ApiModel->get_user_food_orders($hotel_id, $u_id, $booking_id);

                    if ($user_food_orders) {
                        foreach ($user_food_orders as $u_fb_o) {
                            $user_food_orders_details = $this->ApiModel->get_user_food_orders_details($hotel_id, $u_fb_o['food_order_id']);

                            $food_menu_data = array();

                            if ($user_food_orders_details) {
                                foreach ($user_food_orders_details as $u_fb_od) {
                                    $food_menu_data[] = array(
                                        'food_order_details_id' => $u_fb_od['food_order_details_id'],
                                        'food_order_id' => $u_fb_od['food_order_id'],
                                        'food_items_id' => $u_fb_od['food_items_id'],
                                        'items_name' => $u_fb_od['items_name'],
                                        'price' => $u_fb_od['price'],
                                        'quantity' => $u_fb_od['quantity']
                                    );
                                }
                            }

                            $order_status = "";
                            $staff_id = "";
                            $accept_date = "";
                            $order_date = "";
                            $reject_date = "";
                            $otp = "";

                            $wh_s = '(u_id = "' . $u_fb_o['staff_id'] . '")';

                            $staff_data = $this->ApiModel->getData('register', $wh_s);

                            $staff_full_name = "";
                            $staff_mobile_no = "";

                            if ($staff_data) {
                                $staff_full_name = $staff_data['full_name'];
                                $staff_mobile_no = $staff_data['mobile_no'];
                            }

                            if ($u_fb_o['order_status'] == 0) {
                                $order_status = "New Order";
                                $staff_id = $u_fb_o['staff_id'];
                                $accept_date = "";
                                $order_date = date('d-m-Y', strtotime($u_fb_o['order_date']));
                                $reject_date = "";
                                $otp = "";
                            } else {
                                if ($u_fb_o['order_status'] == 1) {
                                    $order_status = "Accept Order";
                                    $staff_id = $u_fb_o['staff_id'];
                                    $accept_date = $u_fb_o['accept_date'];
                                    $order_date = date('d-m-Y', strtotime($u_fb_o['order_date']));
                                    $reject_date = "";
                                    $otp = $u_fb_o['otp'];
                                } else {
                                    if ($u_fb_o['order_status'] == 3) {
                                        $order_status = "Reject Order";
                                        $staff_id = $u_fb_o['staff_id'];
                                        $accept_date = "";
                                        $order_date = date('d-m-Y', strtotime($u_fb_o['order_date']));
                                        $reject_date = $u_fb_o['reject_date'];
                                        $otp = "";
                                    } else {
                                        if ($u_fb_o['order_status'] == 4) {
                                            $order_status = "Camcelled By User";
                                            $staff_id = "";
                                            $accept_date = "";
                                            $order_date = date('d-m-Y', strtotime($u_fb_o['order_date']));
                                            $reject_date = "";
                                            $otp = "";
                                        }
                                    }
                                }
                            }
                            $reject_reason = "";
                            if ($u_fb_o['reject_reason'] == 1) {
                                $reject_reason = "Out of stock";
                            } else if ($u_fb_o['reject_reason'] == 2) {
                                $reject_reason = "We do not serve";
                            } else if ($u_fb_o['reject_reason'] == 3) {
                                $reject_reason = "Out of time";
                            } else if ($u_fb_o['reject_reason'] == 4) {
                                $reject_reason = "Others";
                            }
                            $send_data[] = array(
                                'food_order_id' => $u_fb_o['food_order_id'],
                                'hotel_id' => $u_fb_o['hotel_id'],
                                'booking_id' => $u_fb_o['booking_id'],
                                'order_total' => $u_fb_o['order_total'],
                                'delivery_time' => $u_fb_o['delivery_time'],
                                'order_date' => $order_date,
                                'order_status' => $order_status,
                                'order_status_flag' => $u_fb_o['order_status'],
                                'staff_id' => $staff_id,
                                'staff_full_name' => $staff_full_name,
                                'staff_mobile_no' => $staff_mobile_no,
                                'accept_date' => $accept_date,
                                'order_date' => $order_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'otp' => $otp,
                                'order_time' => date('h:i a', strtotime($u_fb_o['order_time'])),
                                'food_menu_data' => $food_menu_data
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my all housekeeping order not only complete //24-11-2022 //archana
    public function get_my_housekeeping_order_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $user_housekeeping_orders = $this->ApiModel->get_user_housekeeping_orders($hotel_id, $u_id, $booking_id);

                    if ($user_housekeeping_orders) {
                        foreach ($user_housekeeping_orders as $u_hk_o) {
                            $user_housekeeping_orders_details = $this->ApiModel->get_user_housekeeping_details($hotel_id, $u_hk_o['h_k_order_id']);

                            $hk_s_data = array();

                            if ($user_housekeeping_orders_details) {
                                foreach ($user_housekeeping_orders_details as $u_hk_od) {
                                    $hk_s_data[] = array(
                                        'h_k_order_details_id' => $u_hk_od['h_k_order_details_id'],
                                        'h_k_order_id' => $u_hk_od['h_k_order_id'],
                                        'h_k_service_id' => $u_hk_od['h_k_service_id'],
                                        'service_type' => $u_hk_od['service_type'],
                                        'price' => $u_hk_od['price'],
                                        'quantity' => $u_hk_od['quantity']
                                    );
                                }
                            }

                            $order_status = "";
                            $staff_id = "";
                            $accept_date = "";
                            $order_date = "";
                            $reject_date = "";
                            $otp = "";

                            $wh_s = '(u_id = "' . $u_hk_o['staff_id'] . '")';

                            $staff_data = $this->ApiModel->getData('register', $wh_s);

                            $staff_full_name = "";
                            $staff_mobile_no = "";

                            if ($staff_data) {
                                $staff_full_name = $staff_data['full_name'];
                                $staff_mobile_no = $staff_data['mobile_no'];
                            }

                            if ($u_hk_o['order_status'] == 0) {
                                $order_status = "New Order";
                                $staff_id = $u_hk_o['staff_id'];
                                $accept_date = "";
                                $order_date = date('d-m-Y', strtotime($u_hk_o['order_date']));
                                $reject_date = "";
                                $otp = "";
                            } else {
                                if ($u_hk_o['order_status'] == 1) {
                                    $order_status = "Accept Order";
                                    $staff_id = $u_hk_o['staff_id'];
                                    $accept_date = $u_hk_o['accept_date'];
                                    $order_date = date('d-m-Y', strtotime($u_hk_o['order_date']));
                                    $reject_date = "";
                                    $otp = $u_hk_o['otp'];
                                } else {
                                    if ($u_hk_o['order_status'] == 3) {
                                        $order_status = "Reject Order";
                                        $staff_id = $u_hk_o['staff_id'];
                                        $accept_date = "";
                                        $order_date = date('d-m-Y', strtotime($u_hk_o['order_date']));
                                        $reject_date = $u_hk_o['reject_date'];
                                        $otp = "";
                                    } else {
                                        if ($u_hk_o['order_status'] == 4) {
                                            $order_status = "Cancelled By User";
                                            $staff_id = "";
                                            $accept_date = "";
                                            $order_date = date('d-m-Y', strtotime($u_hk_o['order_date']));
                                            $reject_date = "";
                                            $otp = "";
                                        }
                                    }
                                }
                            }
                            $reject_reason = "";
                            if ($u_hk_o['reject_reason'] == 1) {
                                $reject_reason = "Out of stock";
                            } else if ($u_hk_o['reject_reason'] == 2) {
                                $reject_reason = "We do not serve";
                            } else if ($u_hk_o['reject_reason'] == 3) {
                                $reject_reason = "Out of time";
                            } else if ($u_hk_o['reject_reason'] == 4) {
                                $reject_reason = "Others";
                            }
                            $send_data[] = array(
                                'h_k_order_id' => $u_hk_o['h_k_order_id'],
                                'hotel_id' => $u_hk_o['hotel_id'],
                                'booking_id' => $u_hk_o['booking_id'],
                                'order_total' => $u_hk_o['order_total'],
                                'approxi_delivery_time' => $u_hk_o['approx_time'],
                                'order_date' => $order_date,
                                'order_status' => $order_status,
                                'order_status_flag' => $u_hk_o['order_status'],
                                'staff_id' => $staff_id,
                                'staff_full_name' => $staff_full_name,
                                'staff_mobile_no' => $staff_mobile_no,
                                'accept_date' => $accept_date,
                                'order_date' => $order_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'otp' => $otp,
                                'order_time' => date('h:i a', strtotime($u_hk_o['order_time'])),
                                'hk_s_data' => $hk_s_data
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my all luandry order not only complete //24-11-2022 //archana
    public function get_my_laundry_order_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $user_laundry_orders = $this->ApiModel->get_user_laundry_orders($hotel_id, $u_id, $booking_id);

                    if ($user_laundry_orders) {
                        foreach ($user_laundry_orders as $u_ld_o) {
                            $user_laundry_details = $this->ApiModel->get_user_laundry_details($hotel_id, $u_ld_o['cloth_order_id']);

                            $ld_data = array();

                            if ($user_laundry_details) {
                                foreach ($user_laundry_details as $u_ld_od) {
                                    $ld_data[] = array(
                                        'cloth_order_details_id' => $u_ld_od['cloth_order_details_id'],
                                        'cloth_order_id' => $u_ld_od['cloth_order_id'],
                                        'cloth_id' => $u_ld_od['cloth_id'],
                                        'cloth_name' => $u_ld_od['cloth_name'],
                                        'price' => $u_ld_od['price'],
                                        'quantity' => $u_ld_od['quantity']
                                    );
                                }
                            }

                            $order_status = "";
                            $staff_id = "";
                            $accept_date = "";
                            $order_date = "";
                            $reject_date = "";
                            $otp = "";

                            $wh_s = '(u_id = "' . $u_ld_o['staff_id'] . '")';

                            $staff_data = $this->ApiModel->getData('register', $wh_s);

                            $staff_full_name = "";
                            $staff_mobile_no = "";

                            if ($staff_data) {
                                $staff_full_name = $staff_data['full_name'];
                                $staff_mobile_no = $staff_data['mobile_no'];
                            }

                            if ($u_ld_o['order_status'] == 0) {
                                $order_status = "New Order";
                                $staff_id = $u_ld_o['staff_id'];
                                $accept_date = "";
                                $order_date = date('d-m-Y', strtotime($u_ld_o['order_date']));
                                $reject_date = "";
                                $otp = "";
                            } else {
                                if ($u_ld_o['order_status'] == 1) {
                                    $order_status = "Accept Order";
                                    $staff_id = $u_ld_o['staff_id'];
                                    $accept_date = $u_ld_o['accept_date'];
                                    $order_date = date('d-m-Y', strtotime($u_ld_o['order_date']));
                                    $reject_date = "";
                                    $otp = $u_ld_o['otp'];
                                } else {
                                    if ($u_ld_o['order_status'] == 3) {
                                        $order_status = "Reject Order";
                                        $staff_id = $u_ld_o['staff_id'];
                                        $accept_date = "";
                                        $order_date = date('d-m-Y', strtotime($u_ld_o['order_date']));
                                        $reject_date = $u_ld_o['reject_date'];
                                        $otp = "";
                                    } else {
                                        if ($u_ld_o['order_status'] == 4) {
                                            $order_status = "Cancelled by User";
                                            $staff_id = "";
                                            $accept_date = "";
                                            $order_date = date('d-m-Y', strtotime($u_ld_o['order_date']));
                                            $reject_date = "";
                                            $otp = "";
                                        }
                                    }
                                }
                            }
                            $reject_reason = "";
                            if ($u_ld_o['reject_reason'] == 1) {
                                $reject_reason = "Out of stock";
                            } else if ($u_ld_o['reject_reason'] == 2) {
                                $reject_reason = "We do not serve";
                            } else if ($u_ld_o['reject_reason'] == 3) {
                                $reject_reason = "Out of time";
                            } else if ($u_ld_o['reject_reason'] == 4) {
                                $reject_reason = "Others";
                            }
                            $send_data[] = array(
                                'cloth_order_id' => $u_ld_o['cloth_order_id'],
                                'hotel_id' => $u_ld_o['hotel_id'],
                                'booking_id' => $u_ld_o['booking_id'],
                                'order_total' => $u_ld_o['order_total'],
                                'order_date' => $order_date,
                                'order_status' => $order_status,
                                'order_status_flag' => $u_ld_o['order_status'],
                                'staff_id' => $staff_id,
                                'staff_full_name' => $staff_full_name,
                                'staff_mobile_no' => $staff_mobile_no,
                                'accept_date' => $accept_date,
                                'order_date' => $order_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'otp' => $otp,
                                'order_time' => date('h:i a', strtotime($u_ld_o['order_time'])),
                                'laundry_data' => $ld_data
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my all room service services order not only complete //24-11-2022 //archana
    public function get_my_room_service_services_order_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $user_rs_services_orders = $this->ApiModel->get_user_rs_services_orders($hotel_id, $u_id, $booking_id);

                    if ($user_rs_services_orders) {
                        foreach ($user_rs_services_orders as $u_rs_s_o) {
                            $rs_s_data = array();

                            $user_rs_services_details = $this->ApiModel->get_user_rs_services_details($hotel_id, $u_rs_s_o['rmservice_services_order_id']);

                            if ($user_rs_services_details) {
                                $rs_s_data = array();

                                foreach ($user_rs_services_details as $u_rs_s_od) {
                                    $rs_s_data[] = array(
                                        'rmservice_services_detail_id' => $u_rs_s_od['rmservice_services_detail_id'],
                                        'rmservice_services_order_id' => $u_rs_s_od['rmservice_services_order_id'],
                                        'room_serv_service_id' => $u_rs_s_od['room_serv_service_id'],
                                        'service_name' => $u_rs_s_od['service_name'],
                                        'price' => $u_rs_s_od['price'],
                                        'quantity' => $u_rs_s_od['quantity']
                                    );
                                }
                            }

                            $order_status = "";
                            $staff_id = "";
                            $accept_date = "";
                            $order_date = "";
                            $reject_date = "";
                            $otp = "";

                            $wh_s = '(u_id = "' . $u_rs_s_o['staff_id'] . '")';

                            $staff_data = $this->ApiModel->getData('register', $wh_s);

                            $staff_full_name = "";

                            if ($staff_data) {
                                $staff_full_name = $staff_data['full_name'];
                            }

                            if ($u_rs_s_o['order_status'] == 0) {
                                $order_status = "New Order";
                                $staff_id = $u_rs_s_o['staff_id'];
                                $accept_date = "";
                                $order_date = $u_rs_s_o['order_date'];
                                $reject_date = "";
                                $otp = "";
                            } else {
                                if ($u_rs_s_o['order_status'] == 1) {
                                    $order_status = "Accept Order";
                                    $staff_id = $u_rs_s_o['staff_id'];
                                    $accept_date = $u_rs_s_o['accept_date'];
                                    $order_date = $u_rs_s_o['order_date'];
                                    $reject_date = "";
                                    $otp = $u_rs_s_o['otp'];
                                } else {
                                    if ($u_rs_s_o['order_status'] == 3) {
                                        $order_status = "Reject Order";
                                        $staff_id = $u_rs_s_o['staff_id'];
                                        $accept_date = "";
                                        $order_date = $u_rs_s_o['order_date'];
                                        $reject_date = $u_rs_s_o['reject_date'];
                                        $otp = "";
                                    }
                                }
                            }
                            $send_data[] = array(
                                'rmservice_services_order_id' => $u_rs_s_o['rmservice_services_order_id'],
                                'hotel_id' => $u_rs_s_o['hotel_id'],
                                'booking_id' => $u_rs_s_o['booking_id'],
                                'order_total' => $u_rs_s_o['order_total'],
                                'order_date' => $u_rs_s_o['order_date'],
                                'order_status' => $order_status,
                                'order_status_flag' => $u_rs_s_o['order_status'],
                                'staff_id' => $staff_id,
                                'staff_full_name' => $staff_full_name,
                                'accept_date' => $accept_date,
                                'order_date' => $order_date,
                                'reject_date' => $reject_date,
                                'otp' => $otp,
                                'order_time' => date('h:i a', strtotime($u_rs_s_o['created_at'])),
                                'rs_service_data' => $rs_s_data
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my all room service menu order not only complete //24-11-2022 //archana
    public function get_my_room_service_menu_order_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $room_services_orders = $this->ApiModel->get_user_rs_menu_orders($hotel_id, $u_id, $booking_id);

                    //$user_rs_services_orders = $this->ApiModel->get_user_rs_services_orders($hotel_id,$u_id,$booking_id);

                    //$room_services_orders = array_merge($user_rs_menu_orders,$user_rs_services_orders);
                    //$room_services_orders = array_unique($room_services_orders_1);

                    if ($room_services_orders) {
                        foreach ($room_services_orders as $u_rs_m_o) {
                            //menu details
                            $user_rs_menu_details = $this->ApiModel->get_user_rs_menu_details($hotel_id, $u_rs_m_o['room_service_menu_order_id']);

                            $rs_m_data = array();

                            if ($user_rs_menu_details) {
                                foreach ($user_rs_menu_details as $u_rs_m_od) {
                                    $rs_m_data[] = array(
                                        'room_service_details_id' => $u_rs_m_od['room_service_details_id'],
                                        'room_service_menu_order_id' => $u_rs_m_od['room_service_menu_order_id'],
                                        'room_service_cat_id' => $u_rs_m_od['room_service_cat_id'],
                                        'category_name' => $u_rs_m_od['category_name'],
                                        'room_serv_menu_id' => $u_rs_m_od['room_serv_menu_id'],
                                        'menu_name' => $u_rs_m_od['menu_name'],
                                        'price' => $u_rs_m_od['price'],
                                        'quantity' => $u_rs_m_od['quantity']
                                    );
                                }
                            }

                            //service details
                            $user_rs_services_details = $this->ApiModel->get_user_rs_services_details($hotel_id, $u_rs_m_o['room_service_unique_id']);

                            $rs_s_data = array();

                            if ($user_rs_services_details) {
                                foreach ($user_rs_services_details as $u_rs_s_od) {
                                    if ($user_rs_services_details) {
                                        $room_service_menu_order_id = $u_rs_s_od['room_service_menu_order_id'];
                                    } else {
                                        $room_service_menu_order_id = 0;
                                    }

                                    $rs_s_data[] = array(
                                        'rmservice_services_detail_id' => $u_rs_s_od['rmservice_services_detail_id'],
                                        'room_service_menu_order_id' => $u_rs_s_od['room_service_menu_order_id'],
                                        'rmservice_services_order_id' => $u_rs_s_od['rmservice_services_order_id'],
                                        'room_serv_service_id' => $u_rs_s_od['room_serv_service_id'],
                                        'service_name' => $u_rs_s_od['service_name'],
                                        'price' => $u_rs_s_od['price'],
                                        'quantity' => $u_rs_s_od['quantity']
                                    );
                                }
                            }

                            $order_status = "";
                            $staff_id = "";
                            $accept_date = "";
                            $order_date = "";
                            $reject_date = "";
                            $otp = "";

                            $wh_s = '(u_id = "' . $u_rs_m_o['staff_id'] . '")';

                            $staff_data = $this->ApiModel->getData('register', $wh_s);

                            $staff_full_name = "";
                            $staff_mobile_no = "";

                            if ($staff_data) {
                                $staff_full_name = $staff_data['full_name'];
                                $staff_mobile_no = $staff_data['mobile_no'];
                            }

                            if ($u_rs_m_o['order_status'] == 0) {
                                $order_status = "New Order";
                                $staff_id = $u_rs_m_o['staff_id'];
                                $accept_date = "";
                                $order_date = $u_rs_m_o['order_date'];
                                $reject_date = "";
                                $otp = "";
                            } else {
                                if ($u_rs_m_o['order_status'] == 1) {
                                    $order_status = "Accept Order";
                                    $staff_id = $u_rs_m_o['staff_id'];
                                    $accept_date = $u_rs_m_o['accept_date'];
                                    $order_date = $u_rs_m_o['order_date'];
                                    $reject_date = "";
                                    $otp = $u_rs_m_o['otp'];
                                } else {
                                    if ($u_rs_m_o['order_status'] == 3) {
                                        $order_status = "Reject Order";
                                        $staff_id = $u_rs_m_o['staff_id'];
                                        $accept_date = "";
                                        $order_date = $u_rs_m_o['order_date'];
                                        $reject_date = $u_rs_m_o['reject_date'];
                                        $otp = "";
                                    }
                                }
                            }

                            $rmservice_services_order_id = 0;

                            if ($u_rs_m_o['rmservice_services_order_id']) {
                                $rmservice_services_order_id = $u_rs_m_o['rmservice_services_order_id'];
                            }

                            $send_data[] = array(
                                'room_service_menu_order_id' => $u_rs_m_o['room_service_menu_order_id'],
                                'room_service_service_order_id' => $rmservice_services_order_id,
                                'room_service_unique_id' => $u_rs_m_o['room_service_unique_id'],
                                'hotel_id' => $u_rs_m_o['hotel_id'],
                                'booking_id' => $u_rs_m_o['booking_id'],
                                'order_total' => $u_rs_m_o['order_total'],
                                'order_date' => $u_rs_m_o['order_date'],
                                'order_status' => $order_status,
                                'order_status_flag' => $u_rs_m_o['order_status'],
                                'approx_delivery_time' => $u_rs_m_o['delivery_time'],
                                'staff_id' => $staff_id,
                                'staff_full_name' => $staff_full_name,
                                'staff_mobile_no' => $staff_mobile_no,
                                'accept_date' => $accept_date,
                                'order_date' => $order_date,
                                'reject_date' => $reject_date,
                                'otp' => $otp,
                                'order_time' => date('h:i a', strtotime($u_rs_m_o['created_at'])),
                                'rs_menu_data' => $rs_m_data,
                                'rs_service_data' => $rs_s_data
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, request to reserve table//24-11-2022 //archana
    public function request_to_reserve_table()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_facility_id')) && !empty($this->input->post('reserve_date')) && !empty($this->input->post('reserve_time')) && !empty($this->input->post('no_of_people'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $food_facility_id = $this->input->post('food_facility_id');
            $reserve_date = $this->input->post('reserve_date');
            $reserve_time = $this->input->post('reserve_time');
            $no_of_people = $this->input->post('no_of_people');
            $additional_note = $this->input->post('additional_note');

            $room_no = $this->ApiModel->get_resve_tbl_room_no($hotel_id, $booking_id);

            $roomno = $room_no['room_no'];
            $get_room_configure_id = $this->ApiModel->get_room_configure_id($hotel_id, $roomno);

            $room_configure_id = $get_room_configure_id['room_configure_id'];
            $floor_id = $this->ApiModel->get_floor_id($hotel_id, $room_configure_id);


            $floors_id = $floor_id['floor_id'];
            $floor = 0;
            if ($floors_id != 0) {
                $floor = $this->ApiModel->get_floor_no($hotel_id, $floors_id);
            } else {
                $floor = 0;
            }

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);


                if ($guest_user) {
                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'food_facility_id' => $food_facility_id,
                        'booking_id' => $booking_id,
                        'u_id' => $u_id,
                        'no_of_people' => $no_of_people,
                        'reserve_date' => $reserve_date,
                        'reserve_time' => $reserve_time,
                        'room_no' => $roomno,
                        'floor' => $floor['floor'],
                        'additional_note' => $additional_note,
                        'request_date' => date('Y-m-d'),
                        'request_time' => date('H:i A'),
                        'added_by' => 3,
                    );
                    // print_r($arr);die;
                    $add = $this->ApiModel->insert_data('reserve_table', $arr);


                    if ($add) {
                        $wh = '(food_facility_id = "' . $food_facility_id . '")';

                        $food_facility = $this->ApiModel->getData('food_facility', $wh);

                        $facility_name = "";

                        if ($food_facility) {
                            $facility_name = $food_facility['facility_name'];
                        }

                        $send_data[] = array(
                            'reserve_table_id' => $add,
                            'reserve_for' => $facility_name,
                            'reserve_date' => $reserve_date,
                            'additional_note' => $additional_note,
                            'reserve_time' => date('h:i', strtotime($reserve_time)),
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been sent to successfully";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cancel reserve table request before accept //23-11-2022 //archana
    public function cancel_reserve_table_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('reserve_table_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $reserve_table_id = $this->input->post('reserve_table_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(reserve_table_id = "' . $reserve_table_id . '")';

                    $arr = array(
                        'request_status' => 3,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('reserve_table', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my all reserve table request not only accept //24-11-2022 //archana
    public function get_my_reserve_table_request_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $user_reserve_table_request = $this->ApiModel->get_user_reserve_table_request($hotel_id, $u_id, $booking_id);

                    if ($user_reserve_table_request) {
                        foreach ($user_reserve_table_request as $u_re_t) {
                            $request_status = "";
                            $request_date = "";
                            $reject_date = "";
                            $cancel_date = "";
                            $accept_date = "";
                            $reserve_date = date('d-m-Y', strtotime($u_re_t['reserve_date']));

                            if ($u_re_t['request_status'] == 0) {
                                $request_status = "New Order";
                                $request_date = date('d-m-Y', strtotime($u_re_t['request_date']));
                                $reject_date = "";
                                $accept_date = "";
                                $cancel_date = "";
                            } else {
                                if ($u_re_t['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $request_date = date('d-m-Y', strtotime($u_re_t['request_date']));
                                    $reject_date = "";
                                    $accept_date = date('d-m-Y', strtotime($u_re_t['accept_date']));
                                    $cancel_date = "";
                                } else {
                                    if ($u_re_t['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $request_date = date('d-m-Y', strtotime($u_re_t['request_date']));
                                        $reject_date = date('d-m-Y', strtotime($u_re_t['reject_date']));
                                        $cancel_date = "";
                                        $accept_date = "";
                                    } else {
                                        if ($u_re_t['request_status'] == 3) {
                                            $request_status = "Cancel Order";
                                            $request_date = date('d-m-Y', strtotime($u_re_t['request_date']));
                                            $reject_date = "";
                                            $accept_date = "";
                                            $cancel_date = date('d-m-Y', strtotime($u_re_t['cancel_date']));
                                        } else {
                                            if ($u_re_t['request_status'] == 4) {
                                                $request_status = "Complete Order";
                                                $request_date = date('d-m-Y', strtotime($u_re_t['request_date']));
                                                $reject_date = "";
                                                $accept_date = date('d-m-Y', strtotime($u_re_t['accept_date']));
                                                $cancel_date = "";
                                            }
                                        }
                                    }
                                }
                            }
                            $send_data[] = array(
                                'reserve_table_id' => $u_re_t['reserve_table_id'],
                                'hotel_id' => $u_re_t['hotel_id'],
                                'booking_id' => $u_re_t['booking_id'],
                                'food_facility_id' => $u_re_t['food_facility_id'],
                                'facility_name' => $u_re_t['facility_name'],
                                'no_of_people' => $u_re_t['no_of_people'],
                                'request_status' => $request_status,
                                'request_status_flag' => $u_re_t['request_status'],
                                'request_date' => $request_date,
                                'accept_date' => $accept_date,
                                'reject_date' => $reject_date,
                                'cancel_date' => $cancel_date,
                                'request_time' => date('h:i a', strtotime($u_re_t['request_time'])),
                                'reserve_date' => $reserve_date,
                                'reserve_time' => date('h:i a', strtotime($u_re_t['reserve_time'])),
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login business center list //24-11-2022 //archana
    public function get_our_hotel_business_center_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $hotel_business_center_list = $this->ApiModel->get_hotel_business_center_list($hotel_id);

                    if ($hotel_business_center_list) {
                        foreach ($hotel_business_center_list as $bcl) {
                            $wh = '(business_center_id = "' . $bcl['business_center_id'] . '")';

                            $business_center_facility = $this->ApiModel->getData('business_center_facility', $wh);

                            $facility_name = "";

                            if ($business_center_facility) {
                                $facility_name = $business_center_facility['facility_name'];
                            }

                            $business_center_images = $this->ApiModel->getAllData('business_center_images', $wh);

                            $img = array();

                            if ($business_center_images) {
                                foreach ($business_center_images as $bc_img) {
                                    $img[] = array(
                                        'business_center_image_id' => $bc_img['business_center_image_id'],
                                        'image' => $bc_img['image'],
                                    );
                                }
                            }
                            $send_data[] = array(
                                'business_center_id' => $bcl['business_center_id'],
                                'business_center_type' => $bcl['business_center_type'],
                                'capacity_of_people' => $bcl['no_of_people'],
                                'price' => $bcl['price'],
                                'description' => strip_tags($bcl['description']),
                                'facility' => $facility_name,
                                'images' => $img,
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, request to reserve business center//25-11-2022 //archana
    // public function request_to_reserve_business_center()
    // {
    //     if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('business_center_id')) && !empty($this->input->post('event_date')) && !empty($this->input->post('event_name')) && !empty($this->input->post('start_time')) && !empty($this->input->post('end_time'))) {

    //         $u_id = $this->input->post('u_id');
    //         $hotel_id = $this->input->post('hotel_id');
    //         $booking_id = $this->input->post('booking_id');

    //         $business_center_id = $this->input->post('business_center_id');
    //         $event_date = $this->input->post('event_date');
    //         $event_name = $this->input->post('event_name');
    //         $start_time = $this->input->post('start_time');
    //         $end_time = $this->input->post('end_time');
    //         $additional_note = $this->input->post('additional_note');

    //         $user = $this->ApiModel->get_user_data($u_id);

    //         if ($user) {
    //             $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);
    //             // print_r($guest_user);die;
    //             if ($guest_user) {
    //                 $wh = '(business_center_type = "' . $business_center_id . '" AND event_date = "' . $event_date . '" AND start_time >= "' . $start_time . '" AND end_time <= "' . $end_time . '" AND request_status = 1) OR (business_center_type = "' . $business_center_id . '" AND event_date = "' . $event_date . '" AND start_time <= "' . $start_time . '" AND end_time >= "' . $end_time . '" AND request_status = 1)';

    //                 $business_center_reservation = $this->ApiModel->getData('business_center_reservation', $wh);

    //                 if ($business_center_reservation) {
    //                     $response['error_code'] = "403";
    //                     $response['message'] = "Already Reserve this center ... plz use different";
    //                     echo json_encode($response);
    //                     exit();
    //                 } else {
    //                     $arr = array(
    //                         'hotel_id' => $hotel_id,
    //                         'booking_id' => $booking_id,
    //                         'u_id' => $u_id,
    //                         'client_name' => $user['full_name'],
    //                         'client_mobile_no' => $user['mobile_no'],
    //                         'business_center_type' => $business_center_id,
    //                         'event_date' => $event_date,
    //                         'event_name' => $event_name,
    //                         'start_time' => $start_time,
    //                         'end_time' => $end_time,
    //                         'additional_note' => $additional_note,
    //                         'id_proof_photo' => $user['Id_proff_photo'],
    //                         'request_date' => date('Y-m-d'),
    //                         'request_time' => date('H:i A'),


    //                     );

    //                     $add = $this->ApiModel->insert_data('business_center_reservation', $arr);

    //                     if ($add) {
    //                         $wh1 = '(business_center_id = "' . $business_center_id . '")';

    //                         $business_center = $this->ApiModel->getData('business_center', $wh1);

    //                         $business_center_type = "";

    //                         if ($business_center) {
    //                             $business_center_type = $business_center['business_center_type'];
    //                         }

    //                         $event_time = date('h:i a', strtotime($start_time)) . " to " . date('h:i a', strtotime($end_time));

    //                         $send_data[] = array(
    //                             'b_c_reserve_id' => $add,
    //                             'reserve_business_center_name' => $business_center_type,
    //                             'reserve_date' => $event_date,
    //                             'event_name' => $event_name,
    //                             'additional_note' => $additional_note,
    //                             'event_time' => $event_time
    //                         );

    //                         $response['error_code'] = "200";
    //                         $response['message'] = "Your request has been placed successfully";
    //                         $response['data'] = $send_data;
    //                         echo json_encode($response);
    //                         exit();
    //                     } else {
    //                         $response['error_code'] = "403";
    //                         $response['message'] = "Something went wrong";
    //                         echo json_encode($response);
    //                         exit();
    //                     }
    //                 }

    //             } else {
    //                 $response['error_code'] = "404";
    //                 $response['message'] = "Guest Login session expired";
    //                 echo json_encode($response);
    //                 exit();
    //             }
    //         } else {
    //             $response['error_code'] = "404";
    //             $response['message'] = "User not found";
    //             echo json_encode($response);
    //             exit();
    //         }
    //     } else {
    //         $response['error_code'] = "406";
    //         $response['message'] = "Required Parameter Missing..!";
    //         echo json_encode($response);
    //         exit();
    //     }
    // }

    public function request_to_reserve_business_center()
{
    if (
        !empty($this->input->post('u_id')) &&
        !empty($this->input->post('hotel_id')) &&
        !empty($this->input->post('booking_id')) &&
        !empty($this->input->post('business_center_id')) &&
        !empty($this->input->post('event_date')) &&
        !empty($this->input->post('event_name')) &&
        !empty($this->input->post('start_time')) &&
        !empty($this->input->post('end_time'))
    ) {
        $u_id = $this->input->post('u_id');
        $hotel_id = $this->input->post('hotel_id');
        $booking_id = $this->input->post('booking_id');
        $business_center_id = $this->input->post('business_center_id');
        $event_date = $this->input->post('event_date');
        $event_name = $this->input->post('event_name');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        $additional_note = $this->input->post('additional_note');

        // Fetch user data
        $user = $this->ApiModel->get_user_data($u_id);

        if (!$user) {
            echo json_encode(['error_code' => "404", 'message' => "User not found"]);
            exit();
        }

        // Fetch guest user data
        $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);
        if (!$guest_user) {
            echo json_encode(['error_code' => "404", 'message' => "Guest Login session expired"]);
            exit();
        }

        // Check if id_proof_photo exists
        $id_proof_photo = isset($user['Id_proff_photo']) && !empty($user['Id_proff_photo']) 
            ? $user['Id_proff_photo'] 
            : 'default_proof.jpg'; // Provide a default image or path

        // Check for existing reservations
        $wh = '(
            business_center_type = "' . $business_center_id . '" 
            AND event_date = "' . $event_date . '" 
            AND start_time >= "' . $start_time . '" 
            AND end_time <= "' . $end_time . '" 
            AND request_status = 1
        ) OR (
            business_center_type = "' . $business_center_id . '" 
            AND event_date = "' . $event_date . '" 
            AND start_time <= "' . $start_time . '" 
            AND end_time >= "' . $end_time . '" 
            AND request_status = 1
        )';

        $business_center_reservation = $this->ApiModel->getData('business_center_reservation', $wh);

        if ($business_center_reservation) {
            echo json_encode(['error_code' => "403", 'message' => "Already reserved this center. Please use a different one."]);
            exit();
        }

        // Insert reservation data
        $arr = [
            'hotel_id' => $hotel_id,
            'booking_id' => $booking_id,
            'u_id' => $u_id,
            'client_name' => $user['full_name'],
            'client_mobile_no' => $user['mobile_no'],
            'business_center_type' => $business_center_id,
            'event_date' => $event_date,
            'event_name' => $event_name,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'additional_note' => $additional_note,
            'id_proof_photo' => $id_proof_photo, // Ensure this is not NULL
            'request_date' => date('Y-m-d'),
            'request_time' => date('H:i A'),
        ];

        $add = $this->ApiModel->insert_data('business_center_reservation', $arr);

        if ($add) {
            // Fetch business center type
            $wh1 = '(business_center_id = "' . $business_center_id . '")';
            $business_center = $this->ApiModel->getData('business_center', $wh1);
            $business_center_type = $business_center['business_center_type'] ?? '';

            $event_time = date('h:i a', strtotime($start_time)) . " to " . date('h:i a', strtotime($end_time));

            $send_data[] = [
                'b_c_reserve_id' => $add,
                'reserve_business_center_name' => $business_center_type,
                'reserve_date' => $event_date,
                'event_name' => $event_name,
                'additional_note' => $additional_note,
                'event_time' => $event_time
            ];

            echo json_encode([
                'error_code' => "200",
                'message' => "Your request has been placed successfully",
                'data' => $send_data
            ]);
            exit();
        } else {
            echo json_encode(['error_code' => "403", 'message' => "Something went wrong"]);
            exit();
        }
    } else {
        echo json_encode(['error_code' => "406", 'message' => "Required Parameter Missing..!"]);
        exit();
    }
}

      
    //after guest login cancel reserve business center request before accept //25-11-2022 //archana
    public function cancel_reserve_business_center_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('b_c_reserve_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $b_c_reserve_id = $this->input->post('b_c_reserve_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(b_c_reserve_id = "' . $b_c_reserve_id . '")';

                    $arr = array(
                        'request_status' => 3,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('business_center_reservation', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my all reserve business center request not only accept //25-11-2022 //archana
    public function get_my_reserve_business_center_request_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $business_center_reservation = $this->ApiModel->get_user_reserve_business_request($hotel_id, $u_id, $booking_id);

                    if ($business_center_reservation) {
                        foreach ($business_center_reservation as $u_r_bc) {
                            $request_status = "";
                            $request_date = "";
                            $reject_date = "";
                            $accept_date = "";
                            $cancel_date = "";
                            $event_date = date('d-m-Y', strtotime($u_r_bc['event_date']));

                            if ($u_r_bc['request_status'] == 0) {
                                $request_status = "New Order";
                                $request_date = date('d-m-Y', strtotime($u_r_bc['request_date']));
                                $accept_date = "";
                                $reject_date = "";
                                $cancel_date = "";
                            } else {
                                if ($u_r_bc['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $request_date = date('d-m-Y', strtotime($u_r_bc['request_date']));
                                    $accept_date = date('d-m-Y', strtotime($u_r_bc['accept_date']));
                                    $reject_date = "";
                                    $cancel_date = "";
                                } else {
                                    if ($u_r_bc['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $request_date = date('d-m-Y', strtotime($u_r_bc['request_date']));
                                        $reject_date = date('d-m-Y', strtotime($u_r_bc['reject_date']));
                                        $cancel_date = "";
                                        $accept_date = "";
                                    } else {
                                        if ($u_r_bc['request_status'] == 3) {
                                            $request_status = "Cancel Order";
                                            $request_date = date('d-m-Y', strtotime($u_r_bc['request_date']));
                                            $reject_date = "";
                                            $accept_date = "";
                                            $cancel_date = date('d-m-Y', strtotime($u_r_bc['cancel_date']));
                                        } else {
                                            if ($u_r_bc['request_status'] == 4) {
                                                $request_status = "Complete Order";
                                                $request_date = date('d-m-Y', strtotime($u_r_bc['request_date']));
                                                $accept_date = date('d-m-Y', strtotime($u_r_bc['accept_date']));
                                                $reject_date = "";
                                                $cancel_date = "";
                                            }
                                        }
                                    }
                                }
                            }
                            $reject_reason = "";
                            if ($u_r_bc['reject_reason'] == 1) {
                                $reject_reason = "Please Try After Sometime";
                            } else if ($u_r_bc['reject_reason'] == 2) {
                                $reject_reason = "Temporarily unavailable";
                            } else if ($u_r_bc['reject_reason'] == 3) {
                                $reject_reason = "Slots not available";
                            } else if ($u_r_bc['reject_reason'] == 4) {
                                $reject_reason = "Please contact Front office";
                            }
                            $send_data[] = array(
                                'b_c_reserve_id' => $u_r_bc['b_c_reserve_id'],
                                'hotel_id' => $u_r_bc['hotel_id'],
                                'booking_id' => $u_r_bc['booking_id'],
                                'business_center_id' => $u_r_bc['business_center_type'],
                                'business_center_name' => $u_r_bc['business_center_name'],
                                'guest_capacity' => $u_r_bc['no_of_people'],
                                'request_status' => $request_status,
                                'request_status_flag' => $u_r_bc['request_status'],
                                'request_date' => $request_date,
                                'accept_date' => $accept_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'cancel_date' => $cancel_date,
                                'event_date' => $event_date,
                                'start_time' => date('h:i a', strtotime($u_r_bc['start_time'])),
                                'end_time' => date('h:i a', strtotime($u_r_bc['end_time'])),
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login,our hotel available banquet hall list //25-11-2022 //archana
    public function get_our_hotel_banquet_hall_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $banquet_hall = $this->ApiModel->get_hotel_banquet_hall_list($hotel_id);

                    if ($banquet_hall) {
                        foreach ($banquet_hall as $bh) {
                            $wh = '(banquet_hall_id = "' . $bh['banquet_hall_id'] . '")';

                            $banquet_hall_images = $this->ApiModel->getAllData('banquet_hall_images', $wh);

                            $img = array();

                            if ($banquet_hall_images) {
                                foreach ($banquet_hall_images as $bh_img) {
                                    $img[] = array(
                                        'banquet_hall_image_id' => $bh_img['banquet_hall_image_id'],
                                        'images' => $bh_img['images'],
                                    );
                                }
                            }
                            $send_data[] = array(
                                'banquet_hall_id' => $bh['banquet_hall_id'],
                                'banquet_hall_name' => $bh['banquet_hall_name'],
                                'capacity_of_people' => $bh['no_of_people'],
                                'description' => strip_tags(str_replace('&nbsp;', '', $bh['description'])),
                                'images' => $img,
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, request to reserve banquet hall//25-11-2022 //archana
    public function request_to_reserve_banquet_hall()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('banquet_hall_id')) && !empty($this->input->post('event_date')) && !empty($this->input->post('event_time')) && !empty($this->input->post('people_capacity'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $banquet_hall_id = $this->input->post('banquet_hall_id');
            $event_date = $this->input->post('event_date');
            $event_time = $this->input->post('event_time');
            $additional_note = $this->input->post('additional_note');
            $people_capacity = $this->input->post('people_capacity');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(banquet_hall_id = "' . $banquet_hall_id . '" AND event_date = "' . $event_date . '" AND event_time = "' . $event_time . '" AND request_status = 1)';

                    $banquet_hall_orders = $this->ApiModel->getData('banquet_hall_orders', $wh);

                    $wh1 = '(banquet_hall_id = "' . $banquet_hall_id . '")';

                    $banquet_hall = $this->ApiModel->getData('banquet_hall', $wh1);

                    $no_of_people = "";
                    $banquet_hall_name = "";

                    if ($banquet_hall) {
                        $no_of_people = $banquet_hall['no_of_people'];
                        $banquet_hall_name = $banquet_hall['banquet_hall_name'];
                    }

                    if ($banquet_hall_orders) {
                        $response['error_code'] = "403";
                        $response['message'] = "Already Reserve this banquet hall.. plz use different";
                        echo json_encode($response);
                        exit();
                    } else {
                        if ($people_capacity <= $no_of_people) {
                            $arr = array(
                                'hotel_id' => $hotel_id,
                                'booking_id' => $booking_id,
                                'u_id' => $u_id,
                                'banquet_hall_id' => $banquet_hall_id,
                                'event_date' => $event_date,
                                'event_time' => $event_time,
                                'no_of_people' => $people_capacity,
                                'additional_note' => $additional_note,
                                'request_by' => 1,
                                'request_by_u_id' => $u_id,
                                'request_date' => date('Y-m-d'),
                                'request_time' => date('H:i A'),
                            );

                            $add = $this->ApiModel->insert_data('banquet_hall_orders', $arr);

                            if ($add) {
                                $send_data[] = array(
                                    'banquet_hall_orders_id' => $add,
                                    'reserve_banquet_hall_name' => $banquet_hall_name,
                                    'capacity_of_people' => $people_capacity,
                                    'event_date' => $event_date,
                                    'additional_note' => $additional_note,
                                    'event_time' => date('h:i a', strtotime($event_time)),
                                );

                                $response['error_code'] = "200";
                                $response['message'] = "Your request has been placed successfully";
                                $response['data'] = $send_data;
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Your People capacity is more than hall capacity";
                            echo json_encode($response);
                            exit();
                        }
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cancel reserve banquet hall request before accept //25-11-2022 //archana
    public function cancel_reserve_banquet_hall_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('banquet_hall_orders_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $banquet_hall_orders_id = $this->input->post('banquet_hall_orders_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(banquet_hall_orders_id = "' . $banquet_hall_orders_id . '")';

                    $arr = array(
                        'request_status' => 3,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('banquet_hall_orders', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my all reserve banquet hall request not only accept //25-11-2022 //archana
    public function get_my_reserve_banquet_hall_request_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $banquet_hall_orders = $this->ApiModel->get_user_reserve_banquet_hall_request($hotel_id, $u_id, $booking_id);

                    if ($banquet_hall_orders) {
                        foreach ($banquet_hall_orders as $u_bh_o) {
                            $request_status = "";
                            $request_date = "";
                            $reject_date = "";
                            $cancel_date = "";
                            $accept_date = "";
                            $event_date = date('d-m-Y', strtotime($u_bh_o['event_date']));

                            if ($u_bh_o['request_status'] == 0) {
                                $request_status = "New Order";
                                $request_date = date('d-m-Y', strtotime($u_bh_o['request_date']));
                                $accept_date = "";
                                $reject_date = "";
                                $cancel_date = "";
                            } else {
                                if ($u_bh_o['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $request_date = date('d-m-Y', strtotime($u_bh_o['request_date']));
                                    $accept_date = date('d-m-Y', strtotime($u_bh_o['accept_date']));
                                    $reject_date = "";
                                    $cancel_date = "";
                                } else {
                                    if ($u_bh_o['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $request_date = date('d-m-Y', strtotime($u_bh_o['request_date']));
                                        $reject_date = date('d-m-Y', strtotime($u_bh_o['reject_date']));
                                        $cancel_date = "";
                                        $accept_date = "";
                                    } else {
                                        if ($u_bh_o['request_status'] == 3) {
                                            $request_status = "Cancel Order";
                                            $request_date = date('d-m-Y', strtotime($u_bh_o['request_date']));
                                            $reject_date = "";
                                            $accept_date = "";
                                            $cancel_date = date('d-m-Y', strtotime($u_bh_o['cancel_date']));
                                        } else {
                                            if ($u_bh_o['request_status'] == 4) {
                                                $request_status = "Complete Order";
                                                $request_date = date('d-m-Y', strtotime($u_bh_o['request_date']));
                                                $accept_date = date('d-m-Y', strtotime($u_bh_o['accept_date']));
                                                $reject_date = "";
                                                $cancel_date = "";
                                            }
                                        }
                                    }

                                }
                            }
                            $send_data[] = array(
                                'banquet_hall_orders_id' => $u_bh_o['banquet_hall_orders_id'],
                                'hotel_id' => $u_bh_o['hotel_id'],
                                'booking_id' => $u_bh_o['booking_id'],
                                'banquet_hall_id' => $u_bh_o['banquet_hall_id'],
                                'banquet_hall_name' => $u_bh_o['banquet_hall_name'],
                                'request_status' => $request_status,
                                'request_status_flag' => $u_bh_o['request_status'],
                                'request_date' => $request_date,
                                'reject_date' => $reject_date,
                                'cancel_date' => $cancel_date,
                                'accept_date' => $accept_date,
                                'event_date' => $event_date,
                                'event_time' => date('h:i a', strtotime($u_bh_o['event_time']))
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, sent request to cab//25-11-2022 //archana
    public function sent_request_to_cab()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('total_passanger')) && !empty($this->input->post('vehicle_type')) && !empty($this->input->post('destination')) && !empty($this->input->post('select_date')) && !empty($this->input->post('select_time'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $total_passanger = $this->input->post('total_passanger');
            $vehicle_type = $this->input->post('vehicle_type');
            $destination = $this->input->post('destination');
            $select_date = $this->input->post('select_date');
            $select_time = $this->input->post('select_time');
            $additional_note = $this->input->post('additional_note');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'booking_id' => $booking_id,
                        'u_id' => $u_id,
                        'total_passanger' => $total_passanger,
                        'request_vehicle_type' => $vehicle_type,
                        'select_date' => $select_date,
                        'select_time' => $select_time,
                        'destination_name' => $destination,
                        'description' => $additional_note,
                        'request_date' => date('Y-m-d'),
                        'request_time' => date('H:i A'),
                    );

                    $add = $this->ApiModel->insert_data('cab_service_request_list', $arr);

                    if ($add) {
                        $send_data[] = array(
                            'cab_service_request_id' => $add,
                            'request_vehicle_type' => $vehicle_type,
                            'total_passanger' => $total_passanger,
                            'select_date' => $select_date,
                            'select_time' => date('h:i a', strtotime($select_time)),
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been placed successfully";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cancel cab request before accept //25-11-2022 //archana
    public function cancel_cab_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('cab_service_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $cab_service_request_id = $this->input->post('cab_service_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(cab_service_request_id = "' . $cab_service_request_id . '")';

                    $arr = array(
                        'request_status' => 3,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('cab_service_request_list', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my all cab request//25-11-2022 //archana
    public function get_my_cab_request_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $cab_service_request_list = $this->ApiModel->get_user_cab_req_list($hotel_id, $u_id, $booking_id);

                    if ($cab_service_request_list) {
                        foreach ($cab_service_request_list as $u_cab_r) {
                            $request_status = "";
                            $request_date = "";
                            $reject_date = "";
                            $cancel_date = "";
                            $accept_date = "";
                            $complete_date = "";
                            $driver_name = "";
                            $driver_contact_no = "";
                            $assign_vehicle_type = "";
                            $vehicle_no = "";
                            $otp = "";

                            if ($u_cab_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $request_date = date('d-m-Y', strtotime($u_cab_r['request_date']));
                                $accept_date = "";
                                $reject_date = "";
                                $complete_date = "";
                                $cancel_date = "";
                                $driver_name = "";
                                $driver_contact_no = "";
                                $assign_vehicle_type = "";
                                $vehicle_no = "";
                                $otp = "";
                            } else {
                                if ($u_cab_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $request_date = date('d-m-Y', strtotime($u_cab_r['request_date']));
                                    $accept_date = date('d-m-Y', strtotime($u_cab_r['accepted_date']));
                                    $driver_name = $u_cab_r['driver_name'];
                                    $driver_contact_no = $u_cab_r['driver_contact_no'];
                                    $assign_vehicle_type = $u_cab_r['assign_vehicle_type'];
                                    $vehicle_no = $u_cab_r['vehicle_no'];
                                    $otp = $u_cab_r['otp'];
                                    $reject_date = "";
                                    $cancel_date = "";
                                    $complete_date = "";
                                } else {
                                    if ($u_cab_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $request_date = date('d-m-Y', strtotime($u_cab_r['request_date']));
                                        $reject_date = $u_cab_r['reject_date'];
                                        $cancel_date = "";
                                        $accept_date = "";
                                        $driver_name = "";
                                        $driver_contact_no = "";
                                        $assign_vehicle_type = "";
                                        $vehicle_no = "";
                                        $complete_date = "";
                                        $otp = "";
                                    } else {
                                        if ($u_cab_r['request_status'] == 3) {
                                            $request_status = "Cancel Order";
                                            $request_date = date('d-m-Y', strtotime($u_cab_r['request_date']));
                                            $reject_date = "";
                                            $accept_date = "";
                                            $cancel_date = date('d-m-Y', strtotime($u_cab_r['cancel_date']));
                                            $driver_name = "";
                                            $driver_contact_no = "";
                                            $assign_vehicle_type = "";
                                            $vehicle_no = "";
                                            $complete_date = "";
                                            $otp = "";
                                        } else {
                                            if ($u_cab_r['request_status'] == 4) {
                                                $request_status = "Completed Order";
                                                $request_date = date('d-m-Y', strtotime($u_cab_r['request_date']));
                                                $reject_date = "";
                                                $accept_date = "";
                                                $complete_date = date('d-m-Y', strtotime($u_cab_r['complete_date']));
                                                $driver_name = "";
                                                $driver_contact_no = "";
                                                $assign_vehicle_type = "";
                                                $vehicle_no = "";
                                                $otp = "";
                                                $cancel_date = "";
                                            }
                                        }
                                    }

                                }
                            }
                            $reject_reason = "";
                            if ($u_cab_r['reject_reason'] == 1) {
                                $reject_reason = "Please Try After Sometime";
                            } else if ($u_cab_r['reject_reason'] == 2) {
                                $reject_reason = "Temporarily Unavailable";
                            } else if ($u_cab_r['reject_reason'] == 3) {
                                $reject_reason = "Slots Not Available";
                            } else if ($u_cab_r['reject_reason'] == 4) {
                                $reject_reason = "Please Contact Front Office";
                            }
                            $send_data[] = array(
                                'cab_service_request_id' => $u_cab_r['cab_service_request_id'],
                                'hotel_id' => $u_cab_r['hotel_id'],
                                'booking_id' => $u_cab_r['booking_id'],
                                'total_passanger' => $u_cab_r['total_passanger'],
                                'request_vehicle_type' => $u_cab_r['request_vehicle_type'],
                                'destination_name' => $u_cab_r['destination_name'],
                                'description' => strip_tags($u_cab_r['description']),
                                'request_status' => $request_status,
                                'request_status_flag' => $u_cab_r['request_status'],
                                'request_date' => $request_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'cancel_date' => $cancel_date,
                                'complete_date' => $complete_date,
                                'accept_date' => $accept_date,
                                'driver_name' => $driver_name,
                                'driver_contact_no' => $driver_contact_no,
                                'assign_vehicle_type' => $assign_vehicle_type,
                                'vehicle_no' => $vehicle_no,
                                'otp' => $otp,
                                'select_date' => date('d-m-Y', strtotime($u_cab_r['select_date'])),
                                'select_time' => date('h:i a', strtotime($u_cab_r['select_time']))
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cab service request is paid //15-11-2022 //archana
    public function is_paid_cab_service_req_amount()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('cab_service_request_id')) && !empty($this->input->post('paid_amount'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $cab_service_request_id = $this->input->post('cab_service_request_id');
            $paid_amount = $this->input->post('paid_amount');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(cab_service_request_id = "' . $cab_service_request_id . '")';

                    $arr = array(
                        'is_paid' => 1,
                        'paid_amount' => $paid_amount,
                        'paid_date' => date('Y-m-d'),
                    );

                    $up = $this->ApiModel->edit_data('cab_service_request_list', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Amount Paid Successfully";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login,our hotel luggage charges //25-11-2022 //archana
    public function get_our_hotel_luggage_charges()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $luggage_charges = $this->ApiModel->get_hotel_luggage_charges($hotel_id);

                    if ($luggage_charges) {
                        foreach ($luggage_charges as $lug) {
                            $send_data[] = array(
                                'luggage_type_id' => $lug['luggage_charge_id'],
                                'luggage_type' => $lug['luggage_type'],
                                'charges' => $lug['charges'],
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, sent request to luggages//25-11-2022 //archana
    public function sent_request_to_luggage()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))   && !empty($this->input->post('luggage_type')) && !empty($this->input->post('quantity')) && !empty($this->input->post('select_date')) && !empty($this->input->post('select_time'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $quantity = $this->input->post('quantity');
            $select_date = $this->input->post('select_date');
            $luggage_type =  $this->input ->post('luggage_type');
            $select_time = $this->input->post('select_time');
            $additional_note = $this->input->post('additional_note');

            $user = $this->ApiModel->get_user_data($u_id);
            // $a=$this->input->post();
            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'booking_id' => $booking_id,
                        'u_id' => $u_id,
                        'mobile_no' => $user['mobile_no'],
                        'quantity' => $quantity,
                        'select_date' => $select_date,
                        'select_time' => $select_time,
                        'luggage_type' => $luggage_type,
                        'note' => $additional_note,
                        'request_date' => date('Y-m-d'),
                    );

                    $add = $this->ApiModel->insert_data('luggage_request', $arr);

                    if ($add) {
                        $send_data[] = array(
                            'luggage_request_id' => $add,
                            'quantity' => $quantity,
                            'luggage_type' => $luggage_type,
                            'select_date' => $select_date,
                            'select_time' => date('h:i A', strtotime($select_time)),
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been placed successfully";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cancel luggage request before accept //25-11-2022 //archana
    public function cancel_luggage_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('luggage_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $luggage_request_id = $this->input->post('luggage_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(luggage_request_id = "' . $luggage_request_id . '")';

                    $arr = array(
                        'request_status' => 3,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('luggage_request', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my all luggage request//25-11-2022 //archana
    public function get_my_luggage_request_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $luggage_request = $this->ApiModel->get_user_luggage_req_list($hotel_id, $u_id, $booking_id);

                    // print_r($luggage_request);exit;
                    if ($luggage_request) {
                        foreach ($luggage_request as $u_v_r) {
                            $request_status = "";
                            $request_date = "";
                            $reject_date = "";
                            $cancel_date = "";
                            $accept_date = "";
                            $complete_date = "";
                            if ($u_v_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                $accept_date = "";
                                $reject_date = "";
                                $cancel_date = "";
                                $complete_date = "";
                            } else {
                                if ($u_v_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                    $accept_date = date('d-m-Y', strtotime($u_v_r['accept_date']));
                                    $reject_date = "";
                                    $cancel_date = "";
                                    $complete_date = "";
                                } else {
                                    if ($u_v_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                        $reject_date = date('d-m-Y', strtotime($u_v_r['reject_date']));
                                        $cancel_date = "";
                                        $accept_date = "";
                                        $complete_date = "";
                                    } else {
                                        if ($u_v_r['request_status'] == 3) {
                                            $request_status = "Cancel Order";
                                            $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                            $reject_date = "";
                                            $accept_date = "";
                                            $cancel_date = date('d-m-Y', strtotime($u_v_r['cancel_date']));
                                            $complete_date = "";
                                        } else {
                                            if ($u_v_r['request_status'] == 4) {
                                                $request_status = "Completed Order";
                                                $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                                $reject_date = "";
                                                $accept_date = "";
                                                $complete_date = date('d-m-Y', strtotime($u_v_r['complete_date']));
                                                $cancel_date = "";
                                            }
                                        }

                                    }

                                }
                            }
                            $reject_reason = "";
                            if ($u_v_r['reject_reason'] == 1) {
                                $reject_reason = "Temporarily unavailable";
                            } else if ($u_v_r['reject_reason'] == 2) {
                                $reject_reason = "Space Not Available";
                            } else if ($u_v_r['reject_reason'] == 3) {
                                $reject_reason = "Please Contact Front Office";
                            } else if ($u_v_r['reject_reason'] == 4) {
                                $reject_reason = "Available Post Checkout";
                            }
                            $send_data[] = array(
                                'luggage_request_id' => $u_v_r['luggage_request_id'],
                                'hotel_id' => $u_v_r['hotel_id'],
                                'booking_id' => $u_v_r['booking_id'],
                                'note' => strip_tags($u_v_r['note']),
                                'request_status' => $request_status,
                                'request_status_flag' => $u_v_r['request_status'],
                                'is_completed' => $u_v_r['is_completed'],
                                'request_date' => $request_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'cancel_date' => $cancel_date,
                                'complete_date' => $complete_date,
                                'accept_date' => $accept_date,
                                'select_date' => $request_date,
                                'select_time' => date('h:i a', strtotime($u_v_r['select_time'])),
                                'quantity' => $u_v_r['quantity'],
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login luggage service request is paid //15-11-2022 //archana
    public function is_paid_luggage_request_amount()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('luggage_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $luggage_request_id = $this->input->post('luggage_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(luggage_request_id = "' . $luggage_request_id . '")';

                    $arr = array(
                        'is_paid' => 1,
                        'paid_date' => date('Y-m-d'),
                    );

                    $up = $this->ApiModel->edit_data('luggage_request', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Amount Paid Successfully";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login,our hotel vehicle wash charges //25-11-2022 //archana
    public function get_our_vehicle_wash_charges()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $vehicle_washing_charges = $this->ApiModel->get_hotel_vehicle_wash_charges($hotel_id);

                    if ($vehicle_washing_charges) {
                        foreach ($vehicle_washing_charges as $v_ch) {
                            $send_data[] = array(
                                'vehicle_washing_charge_id' => $v_ch['vehicle_washing_charge_id'],
                                'vehicle_type' => $v_ch['vehicle_type'],
                                'charges' => $v_ch['charges'],
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, sent request to wash vehicle//25-11-2022 //archana
    public function sent_request_to_wash_my_vehicle()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('vehicle_washing_charge_id')) && !empty($this->input->post('vehicle_name')) && !empty($this->input->post('vehicle_number')) && !empty($this->input->post('select_date')) && !empty($this->input->post('select_time'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $vehicle_washing_charge_id = $this->input->post('vehicle_washing_charge_id');
            $vehicle_name = $this->input->post('vehicle_name');
            $vehicle_number = $this->input->post('vehicle_number');
            $vehicle_img = $_FILES['vehicle_img']['name'];
            $select_date = $this->input->post('select_date');
            $select_time = $this->input->post('select_time');
            $additional_note = $this->input->post('additional_note');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                // car_wash_vehicles_img
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(vehicle_washing_charge_id = "' . $vehicle_washing_charge_id . '")';

                    $vehicle_washing_charges = $this->ApiModel->getData('vehicle_washing_charges', $wh);

                    $charges = "";

                    if ($vehicle_washing_charges) {
                        $charges = $vehicle_washing_charges['charges'];
                    }

                    $vehicle_img = "";

                    if (!empty($_FILES['vehicle_img']['name'])) {
                        $_FILES['my_file']['name'] = $_FILES['vehicle_img']['name'];
                        $_FILES['my_file']['type'] = $_FILES['vehicle_img']['type'];
                        $_FILES['my_file']['size'] = $_FILES['vehicle_img']['size'];
                        $_FILES['my_file']['error'] = $_FILES['vehicle_img']['error'];
                        $_FILES['my_file']['tmp_name'] = $_FILES['vehicle_img']['tmp_name'];

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
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Erro to upload image";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $vehicle_img = "";
                    }

                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'booking_id' => $booking_id,
                        'u_id' => $u_id,
                        'vehicle_washing_charge_id' => $vehicle_washing_charge_id,
                        'vehicle_name' => $vehicle_name,
                        'vehicle_no' => $vehicle_number,
                        'vehicle_img' => $vehicle_img,
                        'charges' => $charges,
                        'note' => $additional_note,
                        'select_date' => $select_date,
                        'select_time' => $select_time,
                        'note' => $additional_note,
                        'request_date' => date('Y-m-d'),
                    );

                    $add = $this->ApiModel->insert_data('vehicle_wash_request', $arr);

                    if ($add) {
                        $send_data[] = array(
                            'vehicle_wash_request_id' => $add,
                            'vehicle_name' => $vehicle_name,
                            'vehicle_no' => $vehicle_number,
                            'vehicle_img' => $vehicle_img,
                            'charges' => $charges,
                            'select_date' => $select_date,
                            'select_time' => date('h:i A', strtotime($select_time)),
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been placed successfully";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login cancel vehicle wash request before accept //25-11-2022 //archana
    public function cancel_vehicle_wash_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('vehicle_wash_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $vehicle_wash_request_id = $this->input->post('vehicle_wash_request_id');

            $user = $this->ApiModel->get_user_data($u_id);
            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(vehicle_wash_request_id = "' . $vehicle_wash_request_id . '")';

                    $arr = array(
                        'request_status' => 3,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('vehicle_wash_request', $wh, $arr);
                    // print_r($up);die;

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get my vehicle wash request//25-11-2022 //archana
    public function get_my_vehicle_wash_request_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $vehicle_wash_request = $this->ApiModel->get_user_vehicle_wash_request($hotel_id, $u_id, $booking_id);
                    // print_r($vehicle_wash_request);die;

                    if ($vehicle_wash_request) {
                        foreach ($vehicle_wash_request as $u_v_r) {
                            $request_status = "";
                            $request_date = "";
                            $reject_date = "";
                            $cancel_date = "";
                            $accept_date = "";
                            $complete_date = "";

                            if ($u_v_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $request_date = date('d-m-Y', strtotime($u_v_r['request_date']));
                                $accept_date = "";
                                $reject_date = "";
                                $cancel_date = "";
                                $complete_date = "";
                            } else {
                                if ($u_v_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $request_date = date('d-m-Y', strtotime($u_v_r['request_date']));
                                    $accept_date = date('d-m-Y', strtotime($u_v_r['accept_date']));
                                    $reject_date = "";
                                    $cancel_date = "";
                                    $complete_date = "";
                                } else {
                                    if ($u_v_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $request_date = date('d-m-Y', strtotime($u_v_r['request_date']));
                                        $reject_date = date('d-m-Y', strtotime($u_v_r['reject_date']));
                                        $cancel_date = "";
                                        $accept_date = "";
                                        $complete_date = "";
                                    } else {
                                        if ($u_v_r['request_status'] == 3) {
                                            $request_status = "Cancel Order";
                                            $request_date = date('d-m-Y', strtotime($u_v_r['request_date']));
                                            $reject_date = "";
                                            $accept_date = "";
                                            $cancel_date = date('d-m-Y', strtotime($u_v_r['cancel_date']));
                                            $complete_date = "";
                                        } else {
                                            if ($u_v_r['request_status'] == 4) {
                                                $request_status = "Completed Order";
                                                $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                                $reject_date = "";
                                                $accept_date = "";
                                                $complete_date = date('d-m-Y', strtotime($u_v_r['complete_date']));
                                                $cancel_date = "";
                                            }
                                        }
                                    }

                                }
                            }
                            $reject_reason = "";
                            if ($u_v_r['reject_reason'] == 1) {
                                $reject_reason = "Please Try After Sometime";
                            } else if ($u_v_r['reject_reason'] == 2) {
                                $reject_reason = "Temporarily Unavailable";
                            } else if ($u_v_r['reject_reason'] == 3) {
                                $reject_reason = "Vehicle Not Identified";
                            } else if ($u_v_r['reject_reason'] == 4) {
                                $reject_reason = "Please Contact Front Office";
                            }
                            $send_data[] = array(
                                'vehicle_wash_request_id' => $u_v_r['vehicle_wash_request_id'],
                                'vehicle_washing_charge_id' => $u_v_r['vehicle_washing_charge_id'],
                                'hotel_id' => $u_v_r['hotel_id'],
                                'booking_id' => $u_v_r['booking_id'],
                                'vehicle_name' => $u_v_r['vehicle_name'],
                                'vehicle_no' => $u_v_r['vehicle_no'],
                                'vehicle_img' => $u_v_r['vehicle_img'],
                                'charges' => $u_v_r['charges'],
                                'note' => strip_tags($u_v_r['note']),
                                'request_status' => $request_status,
                                'request_status_flag' => $u_v_r['request_status'],
                                'request_date' => $request_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'cancel_date' => $cancel_date,
                                'complete_date' => $complete_date,
                                'accept_date' => $accept_date,
                                'select_date' => date('d-m-Y', strtotime($u_v_r['select_date'])),
                                'select_time' => date('h:i a', strtotime($u_v_r['select_time']))
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login behicle wash request is paid //25-11-2022 //archana
    public function is_paid_my_vehicle_wash_request_amount()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('vehicle_wash_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $vehicle_wash_request_id = $this->input->post('vehicle_wash_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(vehicle_wash_request_id = "' . $vehicle_wash_request_id . '")';

                    $arr = array(
                        'is_paid' => 1,
                        'paid_date' => date('Y-m-d'),
                    );

                    $up = $this->ApiModel->edit_data('vehicle_wash_request', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Amount Paid Successfully";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login,our hotel gym facility details //28-11-2022 //archana
    public function get_our_hotel_gym_services_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $service_name = 1;

                    $hotel_gym_service_data = $this->ApiModel->get_hotel_front_ofs_service_data($hotel_id, $service_name);

                    if ($hotel_gym_service_data) {
                        foreach ($hotel_gym_service_data as $h_gym) {
                            $open_time = date('h:i a', strtotime($h_gym['open_time'])) . " to " . date('h:i a', strtotime($h_gym['close_time']));

                            $break_time = date('h:i a', strtotime($h_gym['break_start_time'])) . " to " . date('h:i a', strtotime($h_gym['break_close_time']));

                            $send_data[] = array(
                                'staff_name' => $h_gym['staff_name'],
                                'contact_no' => $h_gym['contact_no'],
                                'open_time' => $open_time,
                                'break_time' => $break_time,
                                'description' => str_replace('&nbsp;', '', $h_gym['description']),
                                't_nd_c' => str_replace('&nbsp;', '', $h_gym['t_nd_c']),
                            );
                        }

                        $wh = '(hotel_id = "' . $hotel_id . '" AND service_name = 1)';

                        $hotel_gym_imges = $this->ApiModel->getAllData('front_ofs_services_images', $wh);

                        $image_data = array();

                        if ($hotel_gym_imges) {
                            foreach ($hotel_gym_imges as $gym_img) {
                                $image_data[] = array(
                                    'front_ofs_service_image_id' => $gym_img['front_ofs_service_image_id'],
                                    'image' => $gym_img['image']
                                );
                            }
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        $response['images'] = $image_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login,our hotel pool service details //28-11-2022 //archana
    public function get_our_hotel_pool_services_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $service_name = 3;

                    $hotel_pool_service_data = $this->ApiModel->get_hotel_front_ofs_service_data($hotel_id, $service_name);

                    if ($hotel_pool_service_data) {
                        foreach ($hotel_pool_service_data as $h_pool) {
                            $open_time = date('h:i a', strtotime($h_pool['open_time'])) . " to " . date('h:i a', strtotime($h_pool['close_time']));

                            $break_time = date('h:i a', strtotime($h_pool['break_start_time'])) . " to " . date('h:i a', strtotime($h_pool['break_close_time']));

                            $send_data[] = array(
                                'staff_name' => $h_pool['staff_name'],
                                'contact_no' => $h_pool['contact_no'],
                                'open_time' => $open_time,
                                'break_time' => $break_time,
                                'description' => str_replace('&nbsp;', '', $h_pool['description']),
                                't_nd_c' => str_replace('&nbsp;', '', $h_pool['t_nd_c']),
                            );
                        }

                        $wh = '(hotel_id = "' . $hotel_id . '" AND service_name = 3)';

                        $hotel_pool_imges = $this->ApiModel->getAllData('front_ofs_services_images', $wh);

                        $image_data = array();

                        if ($hotel_pool_imges) {
                            foreach ($hotel_pool_imges as $pool_img) {
                                $image_data[] = array(
                                    'front_ofs_service_image_id' => $pool_img['front_ofs_service_image_id'],
                                    'image' => $pool_img['image']
                                );
                            }
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        $response['images'] = $image_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login,our hotel spa service details //28-11-2022 //archana
    public function get_our_hotel_spa_services_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $service_name = 2;

                    $hotel_spa_service_data = $this->ApiModel->get_hotel_front_ofs_service_data($hotel_id, $service_name);

                    if ($hotel_spa_service_data) {
                        foreach ($hotel_spa_service_data as $h_spa) {
                            $open_time = date('h:i a', strtotime($h_spa['open_time'])) . " to " . date('h:i a', strtotime($h_spa['close_time']));

                            $break_time = date('h:i a', strtotime($h_spa['break_start_time'])) . " to " . date('h:i a', strtotime($h_spa['break_close_time']));

                            $wh1 = '(hotel_id = "' . $hotel_id . '" AND front_ofs_service_id = "' . $h_spa['front_ofs_service_id'] . '")';

                            $hotel_spa_type_imags = $this->ApiModel->getAllData('front_ofs_spa_service_images', $wh1);

                            $spa_tyep_image_data = array();

                            if ($hotel_spa_type_imags) {
                                foreach ($hotel_spa_type_imags as $sp_type_img) {
                                    $spa_tyep_image_data[] = array(
                                        'front_ofs_spa_service_images_id' => $sp_type_img['front_ofs_spa_service_images_id'],
                                        'spa_photo' => $sp_type_img['spa_photo'],
                                        'spa_type' => $sp_type_img['spa_type'],
                                        'spa_price' => $sp_type_img['spa_price'],
                                        'spa_description' => strip_tags(str_replace('&nbsp;', '', $sp_type_img['spa_description'])),
                                    );
                                }
                            }
                            $send_data[] = array(
                                'staff_name' => $h_spa['staff_name'],
                                'contact_no' => $h_spa['contact_no'],
                                'open_time' => $open_time,
                                'break_time' => $break_time,
                                'description' => strip_tags(str_replace('&nbsp;', '', $h_spa['description'])),
                                't_nd_c' => strip_tags(str_replace('&nbsp;', '', $h_spa['t_nd_c'])),
                                'spa_details' => $spa_tyep_image_data
                            );
                        }

                        $wh = '(hotel_id = "' . $hotel_id . '" AND service_name = 2)';

                        $hotel_spa_imges = $this->ApiModel->getAllData('front_ofs_services_images', $wh);

                        $image_data = array();

                        if ($hotel_spa_imges) {
                            foreach ($hotel_spa_imges as $pool_img) {
                                $image_data[] = array(
                                    'front_ofs_service_image_id' => $pool_img['front_ofs_service_image_id'],
                                    'image' => $pool_img['image']
                                );
                            }
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        $response['images'] = $image_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login,our hotel baby care service details //28-11-2022 //archana
    public function get_our_hotel_baby_care_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $service_name = 5;

                    $hotel_baby_care_service_data = $this->ApiModel->get_hotel_front_ofs_service_data($hotel_id, $service_name);

                    if ($hotel_baby_care_service_data) {
                        foreach ($hotel_baby_care_service_data as $h_by_c) {
                            $open_time = date('h:i a', strtotime($h_by_c['open_time'])) . " to " . date('h:i a', strtotime($h_by_c['close_time']));

                            $break_time = date('h:i a', strtotime($h_by_c['break_start_time'])) . " to " . date('h:i a', strtotime($h_by_c['break_close_time']));

                            $send_data[] = array(
                                'staff_name' => $h_by_c['staff_name'],
                                'contact_no' => $h_by_c['contact_no'],
                                'open_time' => $open_time,
                                'break_time' => $break_time,
                                'description' => str_replace('&nbsp;', '', $h_by_c['description']),
                                't_nd_c' => str_replace('&nbsp;', '', $h_by_c['t_nd_c']),
                            );
                        }

                        $wh = '(hotel_id = "' . $hotel_id . '" AND service_name = 5)';

                        $hotel_baby_care_imges = $this->ApiModel->getAllData('front_ofs_services_images', $wh);

                        $image_data = array();

                        if ($hotel_baby_care_imges) {
                            foreach ($hotel_baby_care_imges as $b_care_img) {
                                $image_data[] = array(
                                    'front_ofs_service_image_id' => $b_care_img['front_ofs_service_image_id'],
                                    'image' => $b_care_img['image']
                                );
                            }
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        $response['images'] = $image_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login,our hotel shuttle service staff data and their avaibility //28-11-2022 //archana
    public function get_our_hotel_shuttle_service_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $flag = $this->input->post('flag');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $service_name = 4;

                    $wh = '(hotel_id = "' . $hotel_id . '" AND service_name = "' . $service_name . '")';

                    $shuttle_service_data = $this->ApiModel->getData('front_ofs_services', $wh);

                    if ($shuttle_service_data) {
                        $wh1 = '(hotel_id = "' . $hotel_id . '" AND service_name = 4)';

                        $hotel_shuttle_service_imges = $this->ApiModel->getData('front_ofs_services_images', $wh1);

                        $image = "";

                        if ($hotel_shuttle_service_imges) {
                            $image = $hotel_shuttle_service_imges['image'];
                        }

                        if ($flag == 1) {
                            $date = 'Y-m-d';

                            $day_t = date('l', strtotime('tomorrow'));
                            $tomorrow = strtotime('tomorrow');
                            $wh2 = '(hotel_id = "' . $hotel_id . '" AND front_ofs_service_id = "' . $shuttle_service_data['front_ofs_service_id'] . '" AND day = "' . $day_t . '")';

                            $avaibility_chart = $this->ApiModel->getAllData('shuttle_service_avaibility', $wh2);
                        } else {
                            $wh3 = '(hotel_id = "' . $hotel_id . '" AND front_ofs_service_id = "' . $shuttle_service_data['front_ofs_service_id'] . '" AND day = "' . date('l') . '")';

                            $avaibility_chart = $this->ApiModel->getAllData('shuttle_service_avaibility', $wh3);
                        }

                        $today_available_chart = array();

                        if ($avaibility_chart) {
                            foreach ($avaibility_chart as $av_ch) {
                                $time = date('h:i a', strtotime($av_ch['start_time'])) . " - " . date('h:i a', strtotime($av_ch['end_time']));

                                if ($av_ch['available_status'] == 1) {
                                    $available_status = "Available";
                                } else {
                                    $available_status = "Unavailable";
                                }

                                $today_available_chart[] = array(
                                    'time' => $time,
                                    'available_status' => $available_status,
                                );
                            }
                        }

                        $send_data[] = array(
                            'staff_name' => $shuttle_service_data['staff_name'],
                            'contact_no' => $shuttle_service_data['contact_no'],
                            'description' => str_replace('&nbsp;', '', $shuttle_service_data['description']),
                            't_nd_c' => str_replace('&nbsp;', '', $shuttle_service_data['t_nd_c']),
                            'image' => $image,
                            'today_available_chart' => $today_available_chart
                        );


                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, food offer list//29-11-2022 //archana
    // public function get_our_hotel_food_offers()
    // {
    //     if(!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')))
    //     {
    //         $u_id = $this->input->post('u_id');
    //         $hotel_id = $this->input->post('hotel_id');
    //         $booking_id = $this->input->post('booking_id');

    //         $user = $this->ApiModel->get_user_data($u_id);


    //         if($user)
    //         {
    //             $guest_user = $this->ApiModel->get_user_guest_data($u_id,$hotel_id,$booking_id);

    //             if($guest_user)
    //             {
    //                 //$wh = '(hotel_id = "'.$hotel_id.'" AND start_date >= "'.date('Y-m-d').'" AND end_date <= "'.date('Y-m-d').'") OR (hotel_id = "'.$hotel_id.'" AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'")';
    //                  $wh = '(hotel_id = "'.$hotel_id.'" AND offer_for = 3 AND start_date >= "'.date('Y-m-d').'" AND end_date <= "'.date('Y-m-d').'") OR (hotel_id = "'.$hotel_id.'" AND offer_for = 3 AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'")';

    //                 $food_offer_list = $this->ApiModel->getAllData('offers',$wh);
    //                 print_r($food_offer_list);
    //                 // die;
    //                 if($food_offer_list)
    //                 {
    //                     foreach($food_offer_list as $off)
    //                     { 
    //                         $send_data[] = array(
    //                                             'offer_id' => $off['offer_id'],
    //                                             'offer_code' => $off['offer_code'],
    //                                             'offer_for' => $off['offer_for'],
    //                                             'hotel_id' => $off['hotel_id'],
    //                                             'offer_name' => $off['offer_name'],
    //                                             // 'min_amount' => $off['min_amount'],
    //                                             'amt_in_per' => $off['amt_in_per'],
    //                                             'start_date' => $off['start_date'],
    //                                             'end_date' => $off['end_date'],
    //                                             'image' => $off['image'],
    //                                             'description' => $off['description'],
    //                                             );

    //                     } 

    //                     $response['error_code'] = "200";
    //                     $response['message'] = "Data not found";
    //                     $response['data'] = $send_data;
    //                     echo json_encode($response);
    //                     exit();
    //                 }
    //                 else
    //                 {
    //                     $response['error_code'] = "404";
    //                     $response['message'] = "Data not Found";
    //                     echo json_encode($response);
    //                     exit();
    //                 }
    //             }
    //             else
    //             {
    //                 $response['error_code'] = "404";
    //                 $response['message'] = "Guest Login session expired";
    //                 echo json_encode($response);
    //                 exit();
    //             }
    //         }
    //         else
    //         {
    //             $response['error_code'] = "404";
    //             $response['message'] = "User not found";
    //             echo json_encode($response);
    //             exit();
    //         }
    //     }
    //     else
    //     {
    //         $response['error_code'] = "406";
    //         $response['message'] = "Required Parameter Missing..!";
    //         echo json_encode($response);
    //         exit();
    //     }
    // }


    public function get_our_hotel_food_offers()
    {
        // Check if required parameters are provided
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            // Get parameters from the request
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            // Check if the user exists
            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                // Check if the guest user exists with the given u_id, hotel_id, and booking_id
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    // Get today's date
                    $today = date('Y-m-d');

                    // Prepare the condition for querying the offers
                    $wh = '(hotel_id = "' . $hotel_id . '" AND start_date <= "' . $today . '" AND end_date >= "' . $today . '")';

                    // Log the query for debugging purposes
                    log_message('debug', 'Generated Query for Food Offers: ' . $wh);

                    // Fetch offers that match the criteria
                    $food_offer_list = $this->ApiModel->getAllData('offers', $wh);

                    // Log the fetched data for debugging purposes
                    log_message('debug', 'Fetched Food Offers: ' . print_r($food_offer_list, true));

                    if ($food_offer_list) {
                        // Initialize the response data
                        $send_data = array();

                        // Loop through the offers and prepare the data to be sent in the response
                        foreach ($food_offer_list as $off) {
                            $send_data[] = array(
                                'offer_id' => $off['offer_id'],
                                'offer_code' => $off['offer_code'],
                                'offer_for' => $off['offer_for'],
                                'hotel_id' => $off['hotel_id'],
                                'offer_name' => $off['offer_name'],
                                'amt_in_per' => $off['amt_in_per'],
                                'start_date' => $off['start_date'],
                                'end_date' => $off['end_date'],
                                'image' => $off['image'],
                                'description' => $off['description'],
                            );
                        }

                        // Send success response with the offer data
                        $response['error_code'] = "200";
                        $response['message'] = "Offers found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        // No offers found for the given hotel_id and date range
                        $response['error_code'] = "404";
                        $response['message'] = "No offers found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    // Guest user session expired or invalid
                    $response['error_code'] = "404";
                    $response['message'] = "Guest login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                // User not found
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            // Missing required parameters
            $response['error_code'] = "406";
            $response['message'] = "Required parameter(s) missing!";
            echo json_encode($response);
            exit();
        }
    }


    //after guest login, hotel guest list//29-11-2022 //archana
    public function get_our_hotel_guest_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(u_id != "' . $u_id . '")';

                    $guest_user = $this->ApiModel->get_hotel_guest_list($hotel_id, $wh);

                    if ($guest_user) {
                        foreach ($guest_user as $g_u) {
                            if ($g_u['u_id'] != $u_id) {
                                $wh_u = '(u_id = "' . $g_u['u_id'] . '")';

                                $user_data = $this->ApiModel->getData('register', $wh_u);

                                $full_name = "";
                                $profile_photo = "";

                                if ($user_data) {
                                    $full_name = $user_data['full_name'];
                                    $profile_photo = $user_data['profile_photo'];
                                }

                                $send_data[] = array(
                                    'u_id' => $g_u['u_id'],
                                    'full_name' => $full_name,
                                    'profile_photo' => $profile_photo
                                );
                            }
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, send msg to guest user//29-11-2022 //archana
    public function send_message()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('receiver_id')) && !empty($this->input->post('msg'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $receiver_id = $this->input->post('receiver_id');
            $msg = $this->input->post('msg');
            $reply_send_id = $this->input->post('reply_send_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'sender_id' => $u_id,
                        'receiver_id' => $receiver_id,
                        'msg' => $msg,
                        'msg_date' => date('Y-m-d'),
                        'msg_time' => date('H:i:a'),
                    );

                    $add = $this->ApiModel->insert_data('chat_details_of_user', $arr);

                    if ($add) {
                        if ($reply_send_id == 1) {
                            $wh = '(send_id = "' . $add . '")';

                            $wh1 = '(sender_id = "' . $u_id . '")';

                            $user_chat_data = $this->ApiModel->getData('chat_details_of_user', $wh1);

                            $arr1 = array(
                                'reply_send_flag' => 1,
                                'reply_send_id' => $user_chat_data['send_id']
                            );

                            $this->ApiModel->edit_data('chat_details_of_user', $wh, $arr1);
                        }
                        $send_data[] = array(
                            'send_id' => $add,
                            'hotel_id' => $hotel_id,
                            'sender_id' => $u_id,
                            'receiver_id' => $receiver_id,
                            'msg' => $msg,
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Message Sent Successfully..";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get msg//29-11-2022 //archana
    public function get_message()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('receiver_id')) && !empty($this->input->post('date'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $receiver_id = $this->input->post('receiver_id');
            $date = $this->input->post('date');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $get_msg_sender = $this->ApiModel->get_msg_data($hotel_id, $u_id, $receiver_id, $date);

                    $get_msg_receiver = $this->ApiModel->get_msg_data($hotel_id, $receiver_id, $u_id, $date);

                    $msg_data = array_merge($get_msg_sender, $get_msg_receiver);

                    if ($msg_data) {
                        foreach ($msg_data as $msg) {
                            if ($msg['sender_id'] == $u_id) {
                                $send_flag = 1;
                                $receiver_flag = 0;
                            } else {
                                $send_flag = 0;
                                $receiver_flag = 1;
                            }

                            $send_data[] = array(
                                'send_id' => $msg['send_id'],
                                'send_flag' => $send_flag,
                                'receiver_flag' => $receiver_flag,
                                'msg' => $msg['msg'],
                                'msg_date' => $msg['msg_date'],
                                'msg_time' => date('h:i a', strtotime($msg['msg_time'])),
                            );
                        }

                        $sort_data = $send_data;

                        foreach ($sort_data as $key => $row) {
                            $vc_array_data[$key] = $row['msg_date'];
                            $vc_array_data[$key] = $row['msg_time'];
                        }

                        array_multisort($vc_array_data, SORT_ASC, $sort_data);

                        $final_msg_data = $sort_data;

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $final_msg_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get found list//29-11-2022 //archana
    public function get_found_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $found_list = $this->ApiModel->get_found_list($hotel_id);

                    if ($found_list) {
                        foreach ($found_list as $f_l) {
                            $send_data[] = array(
                                'id' => $f_l['id'],
                                'found_item_name' => $f_l['found_item_name'],
                                'img' => $f_l['img'],
                                'found_date' => $f_l['lost_found_date'],
                                'description' => $f_l['description']
                            );
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //city list//3-12-2022 //archana
    public function get_city_list()
    {
        /*if(!empty($this->input->post('u_id')))
        {
            $u_id = $this->input->post('u_id');
            
            $user = $this->ApiModel->get_user_data($u_id);

            if($user)
            {*/
        $city = $this->ApiModel->get_city_list();

        if ($city) {
            foreach ($city as $ct) {
                $send_data[] = array(
                    'city_id' => $ct['city_id'],
                    'city' => $ct['city']
                );
            }
            $response['error_code'] = "200";
            $response['message'] = "Data Found";
            $response['data'] = $send_data;
            echo json_encode($response);
            exit();
        } else {
            $response['error_code'] = "404";
            $response['message'] = "Data not found";
            echo json_encode($response);
            exit();
        }
        /*}
        else
        {
            $response['error_code'] = "404";
            $response['message'] = "User not found";
            echo json_encode($response);
            exit();
        }
    }
    else
    {
        $response['error_code'] = "406";
        $response['message'] = "Required Parameter Missing..!";
        echo json_encode($response);
        exit();
    }*/
    }

    //search hotel list by city//3-12-2022 //archana
    public function search_hotel_list_by_city()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('city_id'))) {
            $u_id = $this->input->post('u_id');
            $city_id = $this->input->post('city_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $hotel_list = $this->ApiModel->get_hotel_list_by_city($city_id);

                if ($hotel_list) {
                    foreach ($hotel_list as $hl) {
                        $wh = '(city_id = "' . $hl['city'] . '")';

                        $city_data = $this->ApiModel->getData('city', $wh);

                        $city_name = "";

                        if ($city_data) {
                            $city_name = $city_data['city'];
                        }

                        $hotel_avg_rating = $this->ApiModel->get_hotel_avg_rating($hl['u_id']);

                        $avrag_rating = 0;

                        if ($hotel_avg_rating[0]['avrag_rating']) {
                            $avrag_rating = round($hotel_avg_rating[0]['avrag_rating'], 2);
                        }

                        $send_data[] = array(
                            'hotel_id' => $hl['u_id'],
                            'hotel_name' => $hl['hotel_name'],
                            'hotel_logo' => $hl['hotel_logo'],
                            'city_name' => $city_name,
                            'state' => $hl['state'],
                            'avrage_rating' => $avrag_rating
                        );
                    }

                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Data not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //user booking history//3-12-2022 //archana
    public function get_my_booking_history()
    {
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $user_booking_history = $this->ApiModel->get_user_booking_history($u_id);

                if ($user_booking_history) {
                    foreach ($user_booking_history as $h_book) {
                        $food_total = 0;
                        $house_and_laundry_total = 0;
                        $front_office_total = 0;
                        $total_bill = 0;
                        $room_charges = 0;

                        $wh_t = '(booking_id = "' . $h_book['booking_id'] . '" AND order_status = 2)';
                        $wh_r = '(booking_id = "' . $h_book['booking_id'] . '" AND request_status = 4)';
                        $wh_c = '(booking_id = "' . $h_book['booking_id'] . '")';
                        // food order data
                        $get_food_order_data = $this->ApiModel->getAllData('food_orders', $wh_t);
                        foreach ($get_food_order_data as $g_f_o_d) {
                            $food_total = $food_total + $g_f_o_d['order_total'];
                        }

                        // housekeeping orders data
                        $get_house_order_data = $this->ApiModel->getAllData('house_keeping_orders', $wh_t);
                        foreach ($get_house_order_data as $g_h_o_d) {
                            $house_and_laundry_total = $house_and_laundry_total + $g_h_o_d['order_total'];
                        }

                        // laundry orders data
                        $get_laundry_order_data = $this->ApiModel->getAllData('cloth_orders', $wh_t);
                        foreach ($get_laundry_order_data as $g_l_o_d) {
                            $house_and_laundry_total = $house_and_laundry_total + $g_l_o_d['order_total'];
                        }

                        // business_center_reservation data
                        // $get_business_center_reservation_data = $this->ApiModel->getAllData('business_center_reservation',$wh_t);
                        // foreach($get_business_center_reservation_data as $g_b_c_r_d)
                        // {
                        //     $front_office_total = $front_office_total + $g_b_c_r_d['order_total'];
                        // }
                        // print_r($get_business_center_reservation_data);die;

                        // spa service request list data
                        $get_spa_service_request_data = $this->ApiModel->getAllData('spa_service_request_list', $wh_r);
                        foreach ($get_spa_service_request_data as $g_s_s_r_d) {
                            $front_office_total = $front_office_total + $g_s_s_r_d['charges'];
                        }

                        // vehicle wash request data
                        $get_vehicle_wash_request_data = $this->ApiModel->getAllData('vehicle_wash_request', $wh_r);
                        foreach ($get_vehicle_wash_request_data as $g_v_w_r_d) {
                            $front_office_total = $front_office_total + $g_v_w_r_d['charges'];
                        }

                        //Room Charges total bill
                        $get_user_checkout_data = $this->ApiModel->getAllData('user_checkout_data', $wh_c);
                        // 
                        foreach ($get_user_checkout_data as $g_u_c_d) {
                            $room_charges = $room_charges + $g_u_c_d['total_bill'];
                            // print_r($room_charges);die;

                        }


                        $total_bill = $food_total + $house_and_laundry_total + $front_office_total + $room_charges;


                        // print_r($front_office_total);die;

                        $wh = '(hotel_id = "' . $h_book['hotel_id'] . '")';

                        $hotel_photos = $this->ApiModel->getData('hotel_photos', $wh);

                        $images = "";

                        if ($hotel_photos) {
                            $images = $hotel_photos['images'];
                        }

                        $wh1 = '(city_id = "' . $h_book['city'] . '")';

                        $city = $this->ApiModel->getData('city', $wh1);

                        $city_name = "";

                        if ($city) {
                            $city_name = $city['city'];
                        }

                        $wh_r_h = '(hotel_id = "' . $h_book['hotel_id'] . '" AND u_id = "' . $u_id . '")';

                        $chk_hotel_ratings = $this->ApiModel->getData('hotel_ratings', $wh_r_h);

                        $is_give_rating = 0;

                        if ($chk_hotel_ratings) {
                            $is_give_rating = 1;
                        } else {
                            $is_give_rating = 0;
                        }

                        $send_data[] = array(
                            'booking_id' => $h_book['booking_id'],
                            'hotel_id' => $h_book['hotel_id'],
                            'total_rooms' => $h_book['no_of_rooms'],
                            'total_guest' => $h_book['no_of_guests'],
                            'total_adults' => $h_book['total_adults'],
                            'total_child' => $h_book['total_child'],
                            'check_in' => $h_book['check_in'],
                            'actual_checkout' => $h_book['actual_checkout'],
                            'hotel_name' => $h_book['hotel_name'],
                            'hotel_img' => $images,
                            'hotel_city' => $city_name,
                            'hotel_state' => $h_book['state'],
                            'is_give_rating' => $is_give_rating,
                            'food_total' => $food_total,
                            'house_and_laundry_total' => $house_and_laundry_total,
                            'front_office_total' => $front_office_total,
                            'room_charges' => $room_charges,
                            'total_bill' => $total_bill,
                        );
                    }

                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Data not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //user booking details//3-12-2022 //archana
    public function get_booking_details()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $wh = '(booking_id = "' . $booking_id . '" AND booking_status = 2)';

                $user_hotel_booking = $this->ApiModel->getData('user_hotel_booking', $wh);

                if ($user_hotel_booking) {
                    $booking_details = $this->ApiModel->get_hotel_booking_details($user_hotel_booking['booking_id']);

                    $room_data = array();

                    $wh2 = '(booking_id = "' . $booking_id . '" AND is_paid = 1)';

                    $payment_data = $this->ApiModel->getData('user_checkout_data', $wh2);

                    $total_bill = "";

                    if ($payment_data) {
                        $total_bill = $payment_data['total_bill'];
                    }

                    foreach ($booking_details as $bd) {
                        $wh1 = '(room_type_id = "' . $bd['room_type'] . '")';

                        $room_type_data = $this->ApiModel->getData('room_type', $wh1);

                        $room_type_name = "";

                        if ($room_type_data) {
                            $room_type_name = $room_type_data['room_type_name'];
                        }

                        $room_data[] = array(
                            'booking_details_id' => $bd['no_of_guests'],
                            'room_no' => $bd['room_no'],
                            'room_type' => $room_type_name
                        );
                    }

                    $send_data[] = array(
                        'booking_id' => $booking_id,
                        'no_of_guests' => $user_hotel_booking['no_of_guests'],
                        'total_adults' => $user_hotel_booking['total_adults'],
                        'total_child' => $user_hotel_booking['total_child'],
                        'check_in' => $user_hotel_booking['check_in'],
                        'actual_checkout' => $user_hotel_booking['actual_checkout'],
                        'room_data' => $room_data,
                        'total_paid_payment' => $total_bill
                    );

                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Data not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //room type list by hotel id //7-12-2022 //archana
    public function get_room_type()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $room_type_list = $this->ApiModel->get_room_type_list_1($hotel_id);

                if ($room_type_list) {
                    $data = array();

                    foreach ($room_type_list as $rt) {
                        $data[] = array(
                            'room_type_id' => $rt['room_type_id'],
                            'hotel_id' => $rt['hotel_id'],
                            'room_type_name' => $rt['room_type_name'],
                            'room_type_price' => $rt['price'],
                            'images' => $rt['images']
                        );
                    }

                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['data'] = $data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "List not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //close user notification//7-12-2022 //archana
    public function close_user_notification()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('u_notification_id'))) {
            $u_id = $this->input->post('u_id');
            $u_notification_id = $this->input->post('u_notification_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $wh = '(u_notification_id = "' . $u_notification_id . '")';

                $arr = array(
                    'clear_flag' => 0
                );

                $up = $this->ApiModel->edit_data('user_notification', $wh, $arr);

                if ($up) {
                    $response['error_code'] = "200";
                    $response['message'] = "Notification close successfully";
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "SOmething went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //close all user notification//7-12-2022 //archana
    public function close_all_user_notification()
    {
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $wh = '(u_id = "' . $u_id . '")';

                $arr = array(
                    'clear_flag' => 0
                );

                $up = $this->ApiModel->edit_data('user_notification', $wh, $arr);

                if ($up) {
                    $response['error_code'] = "200";
                    $response['message'] = "Close all notification successfully";
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "SOmething went wrong";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login show their paid unpaid biils//9-12-2022 //archana
    public function get_my_paid_unpaid_bills()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(booking_id = "' . $booking_id . '" AND order_status = 2)';

                    $laudry_order = $this->ApiModel->getAllData('cloth_orders', $wh);

                    $food_orders = $this->ApiModel->getAllData('food_orders', $wh);

                    $rmservice_services_orders = $this->ApiModel->getAllData('rmservice_services_orders', $wh);

                    $room_service_menu_orders = $this->ApiModel->getAllData('room_service_menu_orders', $wh);

                    $house_keeping_orders = $this->ApiModel->getAllData('house_keeping_orders', $wh);

                    $ld_data = array();
                    $food_data = array();
                    $rs_serv_data = array();
                    $rs_menu_data = array();
                    $hk_data = array();

                    if ($laudry_order) {
                        foreach ($laudry_order as $lo) {
                            $wh_ld = '(cloth_order_id = "' . $lo['cloth_order_id'] . '")';

                            $laudry_order_details = $this->ApiModel->getAllData('cloth_order_details', $wh_ld);

                            $ld_details_data = array();

                            if ($laudry_order_details) {
                                foreach ($laudry_order_details as $lod) {
                                    $wh_c = '(cloth_id = "' . $lod['cloth_id'] . '")';

                                    $cloth_data = $this->ApiModel->getData('cloth', $wh_c);

                                    $cloth_name = "";

                                    if ($cloth_data) {
                                        $cloth_name = $cloth_data['cloth_name'];
                                    }

                                    $ld_details_data[] = array(
                                        'order_id' => $lod['cloth_order_id'],
                                        'cloth_id' => $lod['cloth_id'],
                                        'cloth_name' => $cloth_name,
                                        'price' => $lod['price'],
                                    );
                                }
                            }

                            if ($lo['is_paid'] == 1) {
                                $paid_status = "Paid";
                            } else {
                                if ($lo['is_paid'] == 0) {
                                    $paid_status = "Unpaid";
                                }
                            }

                            $ld_data[] = array(
                                'order_id' => $lo['cloth_order_id'],
                                'order_of' => "Laudry order",
                                'order_total' => $lo['order_total'],
                                'is_paid' => $lo['is_paid'],
                                'paid_status' => $paid_status,
                                'is_paid' => $lo['is_paid'],
                                'order_description' => $ld_details_data
                            );
                        }
                    }

                    if ($food_orders) {
                        foreach ($food_orders as $fo) {
                            $wh_fd1 = '(food_order_id = "' . $fo['food_order_id'] . '")';

                            $food_order_details = $this->ApiModel->getAllData('food_order_details', $wh_fd1);

                            $fd_details_data = array();

                            if ($food_order_details) {
                                foreach ($food_order_details as $fod) {
                                    $wh_fd = '(food_item_id = "' . $fod['food_items_id'] . '")';

                                    $food_menus_data = $this->ApiModel->getData('food_menus', $wh_fd);

                                    $items_name = "";

                                    if ($food_menus_data) {
                                        $items_name = $food_menus_data['items_name'];
                                    }

                                    $fd_details_data[] = array(
                                        'order_id' => $fod['food_order_id'],
                                        'food_items_id' => $fod['food_items_id'],
                                        'items_name' => $items_name,
                                        'price' => $fod['price'],
                                    );
                                }
                            }

                            if ($fo['is_paid'] == 1) {
                                $paid_status = "Paid";
                            } else {
                                if ($fo['is_paid'] == 0) {
                                    $paid_status = "Unpaid";
                                }
                            }
                            $food_data[] = array(
                                'order_id' => $fo['food_order_id'],
                                'order_of' => "Food order",
                                'order_total' => $fo['order_total'],
                                'is_paid' => $fo['is_paid'],
                                'paid_status' => $paid_status,
                                'order_description' => $fd_details_data
                            );
                        }
                    }

                    if ($rmservice_services_orders) {
                        foreach ($rmservice_services_orders as $rs_s) {
                            $wh_rs_s = '(rmservice_services_order_id = "' . $rs_s['rmservice_services_order_id'] . '")';

                            $rmservice_services_details = $this->ApiModel->getAllData('rmservice_services_details', $wh_rs_s);

                            $rm_s_details_data = array();

                            if ($rmservice_services_details) {
                                foreach ($rmservice_services_details as $rm_s_d) {
                                    $wh_rm_s = '(r_s_services_id = "' . $rm_s_d['room_serv_service_id'] . '")';

                                    $room_servs_services_data = $this->ApiModel->getData('room_servs_services', $wh_rm_s);

                                    $service_name = "";

                                    if ($room_servs_services_data) {
                                        $service_name = $room_servs_services_data['service_name'];
                                    }

                                    $rm_s_details_data[] = array(
                                        'rmservice_services_order_id' => $rm_s_d['rmservice_services_order_id'],
                                        'room_serv_service_id' => $rm_s_d['room_serv_service_id'],
                                        'service_name' => $service_name,
                                        'price' => $rm_s_d['price'],
                                    );
                                }
                            }

                            if ($rs_s['payment_status'] == 1) {
                                $paid_status = "Paid";
                            } else {
                                if ($rs_s['payment_status'] == 0) {
                                    $paid_status = "Unpaid";
                                }
                            }
                            $rs_serv_data[] = array(
                                'order_id' => $rs_s['rmservice_services_order_id'],
                                'order_of' => "Room service services order",
                                'order_total' => $rs_s['order_total'],
                                'is_paid' => $rs_s['payment_status'],
                                'paid_status' => $paid_status,
                                'order_description' => $rm_s_details_data
                            );
                        }


                        $response['error_code'] = "200";
                        $response['message'] = "Data not found";
                        $response['data'] = $rs_serv_data;
                        echo json_encode($response);
                        exit();
                    }

                    if ($room_service_menu_orders) {
                        foreach ($room_service_menu_orders as $rs_m) {
                            $wh_rs_m1 = '(room_service_menu_order_id = "' . $rs_m['room_service_menu_order_id'] . '")';

                            $room_service_menu_details = $this->ApiModel->getAllData('room_service_menu_details', $wh_rs_m1);

                            $rs_m_details_data = array();

                            if ($room_service_menu_details) {
                                foreach ($room_service_menu_details as $rm_m_d) {
                                    $wh_rs_m = '(room_serv_menu_id = "' . $rm_m_d['room_serv_menu_id'] . '")';

                                    $room_serv_menu_list = $this->ApiModel->getData('room_serv_menu_list', $wh_rs_m);

                                    $menu_name = "";

                                    if ($room_serv_menu_list) {
                                        $menu_name = $room_serv_menu_list['menu_name'];
                                    }

                                    $rs_m_details_data[] = array(
                                        'room_service_menu_order_id' => $rm_m_d['room_service_menu_order_id'],
                                        'room_serv_menu_id' => $rm_m_d['room_serv_menu_id'],
                                        'menu_name' => $menu_name,
                                        'price' => $rm_m_d['price'],
                                    );
                                }
                            }

                            if ($rs_m['payment_status'] == 1) {
                                $paid_status = "Paid";
                            } else {
                                if ($rs_m['payment_status'] == 0) {
                                    $paid_status = "Unpaid";
                                }
                            }

                            $rs_menu_data[] = array(
                                'order_id' => $rs_m['room_service_menu_order_id'],
                                'order_of' => "Room service menu order",
                                'order_total' => $rs_m['order_total'],
                                'is_paid' => $rs_m['payment_status'],
                                'paid_status' => $paid_status,
                                'order_description' => $rs_m_details_data
                            );
                        }

                    }

                    if ($house_keeping_orders) {
                        foreach ($house_keeping_orders as $hk) {
                            $wh_hk1 = '(h_k_order_id = "' . $hk['h_k_order_id'] . '")';

                            $house_keeping_order_details = $this->ApiModel->getAllData('house_keeping_order_details', $wh_hk1);

                            $rs_m_details_data = array();

                            if ($house_keeping_order_details) {
                                foreach ($house_keeping_order_details as $hk_o_d) {
                                    $wh_hk = '(h_k_services_id = "' . $hk_o_d['h_k_service_id'] . '")';

                                    $house_keeping_services = $this->ApiModel->getData('house_keeping_services', $wh_hk);

                                    $service_type = "";

                                    if ($house_keeping_services) {
                                        $service_type = $house_keeping_services['service_type'];
                                    }

                                    $hk_details_data[] = array(
                                        'h_k_order_id' => $hk_o_d['h_k_order_id'],
                                        'h_k_service_id' => $hk_o_d['h_k_service_id'],
                                        'menu_name' => $service_type,
                                        'price' => $hk_o_d['price'],
                                    );
                                }
                            }

                            if ($hk['is_paid'] == 1) {
                                $paid_status = "Paid";
                            } else {
                                if ($hk['is_paid'] == 0) {
                                    $paid_status = "Unpaid";
                                }
                            }

                            $hk_data[] = array(
                                'order_id' => $hk['h_k_order_id'],
                                'order_of' => "Housekeeping order",
                                'is_paid' => $hk['is_paid'],
                                'order_total' => $hk['order_total'],
                                'paid_status' => $paid_status,
                                'order_description' => $hk_details_data
                            );
                        }


                        $response['error_code'] = "200";
                        $response['message'] = "Data not found";
                        $response['data'] = $hk_data;
                        echo json_encode($response);
                        exit();
                    }

                    $response['error_code'] = "200";
                    $response['message'] = "Data not found";
                    $response['laudry_order'] = $ld_data;
                    $response['food_order'] = $food_data;
                    $response['rmservice_services_orders'] = $rs_serv_data;
                    $response['room_service_menu_orders'] = $rs_menu_data;
                    $response['house_keeping_orders'] = $hk_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login call waiter//4-1-2022 //archana
    public function call_waiter()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('room_no'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $room_no = $this->input->post('room_no');
            $flag = $this->input->post('flag');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $hotel_data = $this->ApiModel->get_hotel_data($hotel_id);
                    $hotel_name = trim($hotel_data['hotel_name']);
                    // print_r($hotel_data['hotel_name']);die;
                    if ($flag == 0) {
                        $subject = "Call waiter from user";

                        $description = "Sent request for call waiter to " . $hotel_name . " hotel.. Room No From " . $room_no;

                        // $arr = array(
                        //                 'u_id'=> $u_id,
                        //                 'hotel_id'=> $hotel_id,
                        //                 'subject' => $subject,
                        //                 'description' => $description,
                        //                 'clear_flag' => 1,                                  
                        //                 'count_flag' => 1,                                  
                        //             );

                        // $add = $this->ApiModel->insert_data('user_notification',$arr);

                        // if($add)
                        // {      
                        //sent notification to room service department
                        $arr1 = array(
                            'send_to' => 2,
                            'send_for' => 7,
                            'notification_type' => 2,
                            'title' => $subject,
                            'description' => $description,
                            'send_by_id' => $hotel_id,
                            'added_by_id' => $u_id,
                            'room_no' => $room_no,
                            'booking_id' => $booking_id
                        );

                        $add_nt = $this->ApiModel->insert_data('notifications', $arr1);

                        if ($add_nt) {
                            $arr_d = array(
                                'notification_id' => $add_nt,
                                'department_id' => 5
                            );

                            $this->ApiModel->insert_data('notifictions_department_id', $arr_d);
                        }
                        $response['error_code'] = "200";
                        $response['message'] = "Success..!";
                        echo json_encode($response);
                        exit();
                    } elseif ($flag == 1) {

                        $wh = '(added_by_id = "' . $u_id . '" AND order_status = 0 AND description = "Sent request for call waiter to ' . $hotel_name . ' hotel.. Room No From ' . $room_no . '")';

                        $arr = array(
                            'order_status' => 3,
                        );
                        $up = $this->ApiModel->edit_data('notifications', $wh, $arr);

                        if ($up) {
                            $response['error_code'] = "200";
                            $response['message'] = "Request Cancelled Successfully..!";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login wakeup call//4-1-2022 //archana
    public function wakeup_call()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('room_no')) && !empty($this->input->post('date')) && !empty($this->input->post('time'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $room_no = $this->input->post('room_no');
            $date = $this->input->post('date');
            $time = $this->input->post('time');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    if ($guest_user['dnd_mode'] == 2) {
                        $hotel_data = $this->ApiModel->get_hotel_data($hotel_id);

                        $subject = "Wakeup call from user";

                        $date1 = date('d F Y', strtotime($date));
                        $time1 = date('h:i a', strtotime($time));

                        $datetimeFormate = $date1 . " - " . $time1;

                        $description = "Wakeup call From Room No " . $room_no . "<br>Date and time is " . $datetimeFormate;

                        $arr = array(
                            'u_id' => $u_id,
                            'hotel_id' => $hotel_id,
                            'subject' => $subject,
                            'description' => $description,
                            'clear_flag' => 1,
                            'count_flag' => 1,
                        );

                        $add = $this->ApiModel->insert_data('user_notification', $arr);

                        if ($add) {
                            $arr1 = array(
                                'send_to' => 2,
                                'send_for' => 7,
                                'send_by_id' => $hotel_id,
                                'added_by_id' => $u_id,
                                'booking_id' => $booking_id,
                                'room_no' => $room_no,
                                'title' => $subject,
                                'description' => $description,
                                'date' => $date,
                                'time' => $time
                            );

                            $add_nt = $this->ApiModel->insert_data('notifications', $arr1);

                            if ($add_nt) {
                                $arr_d = array(
                                    'notification_id' => $add_nt,
                                    'department_id' => 2
                                );

                                $this->ApiModel->insert_data('notifictions_department_id', $arr_d);
                            }

                            $response['error_code'] = "200";
                            $response['message'] = "Success..!";
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Your DND mode is on";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }


    public function terms_condition()
    {
        $term_condition_id = $this->input->post('term_condition_id');

        if (!$term_condition_id) {
            // Respond with an error if term_condition_id is not provided
            $response = [
                'status' => false,
                'message' => 'Term Condition ID is required.'
            ];
            echo json_encode($response);
            return;
        }

        // Fetch the terms and conditions from the database
        $terms_condition = $this->ApiModel->get_terms_condition($term_condition_id);


        if (!empty($terms_condition)) {
            // Respond with the terms and conditions data
            $response = [
                'status' => true,
                'data' => $terms_condition
            ];
        } else {
            // Respond with an error if no data is found
            $response = [
                'status' => false,
                'message' => 'No terms and conditions found for the provided ID.'
            ];
        }

        // Return the response as JSON
        echo json_encode($response);
    }


    public function help_center()
    {
        // Retrieve `help_center_id` from POST request
        $help_center_id = $this->input->post('help_center_id');

        // Validate the input
        if (empty($help_center_id)) {
            // Respond with an error if `help_center_id` is not provided
            $response = [
                'status' => false,
                'message' => 'Help Center ID is required.'
            ];
            echo json_encode($response);
            return;
        }

        // Fetch data using the model
        $help_center_data = $this->ApiModel->get_help_center($help_center_id);

        if (!empty($help_center_data)) {
            // Respond with the data if found
            $response = [
                'status' => true,
                'data' => $help_center_data
            ];
        } else {
            // Respond with an error if no data is found
            $response = [
                'status' => false,
                'message' => 'No help center data found for the provided ID.'
            ];
        }

        // Return the response as JSON
        echo json_encode($response);
    }



    //get faq
    public function get_faq()
    {
        // echo 'hi';die;
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');

            $user = $this->ApiModel->get_user_data($u_id);
            if ($user) {
                $faq_list = $this->ApiModel->get_faq($hotel_id);

                if ($faq_list) {
                    foreach ($faq_list as $rt) {
                        $data[] = array(
                            'faq_id' => $rt['faq_id'],
                            'hotel_id' => $rt['hotel_id'],
                            'question' => $rt['question'],
                            'answer' => strip_tags($rt['answer']),
                        );
                    }

                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['data'] = $data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Faq list not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    public function get_hotel_privacy_policies()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');

            $user = $this->ApiModel->get_user_data($u_id);
            if ($user) {
                $hotel_privacy_policy = $this->ApiModel->get_p_policy($hotel_id);

                if ($hotel_privacy_policy) {
                    foreach ($hotel_privacy_policy as $rt) {
                        $data[] = array(
                            'privacy_id' => $rt['privacy_id'],
                            'hotel_id' => $rt['added_by_u_id'],
                            'content' => strip_tags($rt['content']),
                        );
                    }

                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['data'] = $data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Faq list not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    public function add_hotel_review()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('ratings')) && !empty($this->input->post('description'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $ratings = $this->input->post('ratings');
            $description = $this->input->post('description');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $wh = '(hotel_id = "' . $hotel_id . '" AND u_id = "' . $u_id . '")';

                $rating = $this->ApiModel->getData('hotel_ratings', $wh);

                if ($rating) {
                    $response['error_code'] = "401";
                    $response['message'] = "Already Gived rating of this hotel";
                    echo json_encode($response);
                    exit();
                } else {
                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'u_id' => $u_id,
                        'rating' => $ratings,
                        'review' => $description,
                        'rating_date' => date('Y-m-d'),
                        'rating_time' => date('H:i:s'),
                    );

                    $add = $this->ApiModel->insert_data('hotel_ratings', $arr);

                    if ($add) {
                        $response['error_code'] = "200";
                        $response['message'] = "Success..!";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //get login guest user notifications
    public function guest_user_notification()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);
            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);
                if ($guest_user) {
                    $nofication_data = $this->ApiModel->get_guest_u_notifications();
                    if ($nofication_data) {
                        foreach ($nofication_data as $n_d) {
                            $send_data[] = array(
                                'notification_id' => $n_d['id'],
                                'subject' => $n_d['title'],
                                'description' => $n_d['description'],
                                'notification_type' => $n_d['notification_type'],
                                'notification_date' => $n_d['created_at'],
                                'notification_time' => date('h:i A', strtotime($n_d['created_at'])),
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //get count
    public function get_orders_count()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);
            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);
                if ($guest_user) {
                    //request pending count
                    $wh = '(order_status = 1 OR order_status = 0)';
                    $housekeeping_orders = $this->ApiModel->get_total_request_pending_count($wh, $hotel_id, $u_id, $booking_id);
                    $count_request_pending = $housekeeping_orders[0]['total_count'];

                    //services pending count
                    $wh1 = '(order_status = 1 OR order_status = 0)';
                    $services_orders = $this->ApiModel->get_total_request_pending_count_1($wh1, $hotel_id, $u_id, $booking_id);
                    $services_count_request_pending = $services_orders[0]['total_count'];

                    //get visitors permission

                    $get_visitors = $this->ApiModel->get_total_visitors_count($hotel_id, $u_id, $booking_id);
                    $get_visitors_count = $get_visitors[0]['total_count'];

                    $send_data[] = array(
                        'request_pending' => $count_request_pending,
                        'service_pending' => $services_count_request_pending,
                        'visitor_permission' => $get_visitors_count
                    );



                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();

                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }

            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }

        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    public function add_user_preferences()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('user_prefer'))) {
            $u_id = $this->input->post('u_id');
            //$u_prefer = $this->input->post('user_prefer');

            $user = $this->ApiModel->get_user_data($u_id);
            if ($user) {
                $user_prefer_data = json_decode($this->input->post('user_prefer'), TRUE);

                $user_data_exist = $this->ApiModel->get_data($u_id);
                if ($user_data_exist) {
                    //echo "exist data";
                    foreach ($user_prefer_data as $u_data) {
                        $arr = array(
                            //'u_id' => $u_id,
                            'smoking_room' => $u_data['smoking_room'],
                            'non_smoking_room' => $u_data['non_smoking_room'],
                            'king_bed' => $u_data['king_bed'],
                            'twin_bed' => $u_data['twin_bed'],
                            'mountain_view' => $u_data['mountain_view'],
                            'city_view' => $u_data['city_view'],
                            'top_floors' => $u_data['top_floors'],
                            'lower_floors' => $u_data['lower_floors']

                        );
                    }

                    $wh = '(u_id ="' . $u_id . '")';
                    $up = $this->ApiModel->edit_data('preferences', $wh, $arr);
                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Data Update..!";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    //echo "Data no available";
                    foreach ($user_prefer_data as $u_data) {
                        $arr_d = array(
                            'u_id' => $u_id,
                            'smoking_room' => $u_data['smoking_room'],
                            'non_smoking_room' => $u_data['non_smoking_room'],
                            'king_bed' => $u_data['king_bed'],
                            'twin_bed' => $u_data['twin_bed'],
                            'mountain_view' => $u_data['mountain_view'],
                            'city_view' => $u_data['city_view'],
                            'top_floors' => $u_data['top_floors'],
                            'lower_floors' => $u_data['lower_floors']

                        );

                        $add = $this->ApiModel->insert_data('preferences', $arr_d);
                    }

                    if ($add) {
                        $response['error_code'] = "200";
                        $response['message'] = "Data Added Successfully..!";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }

                }

            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    public function get_user_preferences()
    {
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');

            $user = $this->ApiModel->get_user_data($u_id);
            if ($user) {
                $get_user_preference = $this->ApiModel->get_data($u_id);
                if ($get_user_preference) {
                    foreach ($get_user_preference as $p) {
                        $send_data[] = array(
                            'u_id' => $u_id,
                            'smoking_room' => $p['smoking_room'],
                            'non_smoking_room' => $p['non_smoking_room'],
                            'king_bed' => $p['king_bed'],
                            'twin_bed' => $p['twin_bed'],
                            'mountain_view' => $p['mountain_view'],
                            'city_view' => $p['city_view'],
                            'top_floors' => $p['top_floors'],
                            'lower_floors' => $p['lower_floors']
                        );
                    }

                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Data not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    public function add_firebase_token()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('token'))) {
            $u_id = $this->input->post('u_id');
            $token = $this->input->post('token');

            $user = $this->ApiModel->get_staff_user_data($u_id);
            //print_r($user);die;
            if ($user) {

                $wh = '(u_id ="' . $u_id . '")';
                $user_token_exist = $this->ApiModel->getAllData('user_firebase_tokens', $wh);
                if ($user_token_exist) {
                    $arr = array(
                        'token' => $token
                    );

                    $up = $this->ApiModel->edit_data('user_firebase_tokens', $wh, $arr);
                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Data Update..!";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $arr_d = array(
                        'u_id' => $u_id,
                        'token' => $token
                    );

                    $add = $this->ApiModel->insert_data('user_firebase_tokens', $arr_d);


                    if ($add) {
                        $response['error_code'] = "200";
                        $response['message'] = "Data Added Successfully..!";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }

                }

            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //user confirm enquiry list //5-1-2023 //archana
    public function get_my_confirm_enquiry_request_list()
    {
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $enquiry_data = $this->ApiModel->get_confirm_enquiry_list($u_id);
                // print_r($enquiry_data);die;

                if ($enquiry_data) {
                    foreach ($enquiry_data as $eq) {
                        $wh2 = '(city_id = "' . $eq['city'] . '")';

                        $city_data = $this->ApiModel->getData('city', $wh2);

                        $city = "";

                        if ($city_data) {
                            $city = $city_data['city'];
                        }

                        $booking_id = '';
                        $check_in_status = '';
                        $get_checkout_details = '';
                        $booking_status = '';

                        $wh3 = '(enquiry_id = "' . $eq['hotel_enquiry_request_id'] . '")';

                        $get_booking_id = $this->ApiModel->getData('user_hotel_booking', $wh3);

                        if ($get_booking_id) {
                            $booking_id = $get_booking_id['booking_id'];
                            $check_in_status = $get_booking_id['check_in_status'];
                            $booking_status = $get_booking_id['booking_status'];

                            $wh4 = '(booking_id = "' . $booking_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $get_booking_id['hotel_id'] . '")';
                            $get_checkout_details = $this->ApiModel->getData('user_checkout_requests', $wh4);
                            //print_r($get_checkout_details);die;
                            $user_checkout_request_status = '';

                            if ($get_checkout_details) {
                                if ($get_checkout_details['request_status'] == 0) {
                                    $user_checkout_request_status = '0';
                                } else if ($get_checkout_details['request_status'] == 1) {
                                    $user_checkout_request_status = '1';
                                } else {
                                    $user_checkout_request_status = '2';
                                }
                            } else {
                                $user_checkout_request_status = '';
                            }
                            // print_r($get_checkout_details);die;

                        }

                        $request_status = "";
                        $room_charges = 0;

                        if ($eq['request_status'] == 0) {
                            $request_status = "Pending";
                            $room_charges = $eq['room_charges'];
                            $room_type_name = $eq['room_type_name'];
                        } else {
                            if ($eq['request_status'] == 1) {
                                $request_status = "Accepted";
                                $room_charges = $eq['room_charges'];
                            } else {
                                if ($eq['request_status'] == 2) {
                                    $request_status = "Rejected";
                                    $room_charges = $eq['room_charges'];
                                    $room_type_name = $eq['room_type_name'];
                                } else {
                                    if ($eq['request_status'] == 3) {
                                        $request_status = "User accepted"; //user rejected
                                        $room_charges = $eq['room_charges'];
                                        $room_type_name = $eq['room_type_name'];
                                    } else {
                                        if ($eq['request_status'] == 4) {
                                            $request_status = "Room assigned";
                                            $room_charges = $eq['room_charges'];
                                            $room_type_name = $eq['room_type_name'];
                                        }
                                    }
                                }

                            }
                        }

                        $send_data[] = array(
                            'hotel_enquiry_request_id' => $eq['hotel_enquiry_request_id'],
                            'booking_id' => $booking_id,
                            'hotel_id' => $eq['hotel_id'],
                            'city' => $city,
                            'check_in_date' => $eq['check_in_date'],
                            'check_out_date' => $eq['check_out_date'],
                            'hotel_name' => $eq['hotel_name'],
                            'hotel_logo' => $eq['hotel_logo'],
                            'request_status' => $request_status,
                            'request_status_flag' => $eq['request_status'],
                            'room_charges' => $room_charges,
                            'room_type_name' => $eq['room_type_name'],
                            'check_in_status' => $check_in_status,
                            'user_checkout_request_status' => $user_checkout_request_status,
                            'booking_status' => $booking_status,
                        );


                    }
                    $response['error_code'] = "200";
                    $response['message'] = "Data found";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Data not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }


    public function placed_order_for_room_service_menu_11()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('order_total'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $order_total = $this->input->post('order_total');

            $roomservice_service_data = json_decode($this->input->post('roomservice_service_data'), TRUE);
            $room_service_menu_data = json_decode($this->input->post('room_service_menu_data'), TRUE);

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $add_rs_service = "";

                    $unique_number = rand(1111, 9999);

                    //room service service order
                    if ($roomservice_service_data) {
                        $arr_rs = array(
                            'hotel_id' => $hotel_id,
                            'u_id' => $u_id,
                            'booking_id' => $booking_id,
                            // 'order_total' => $order_total,
                            'order_from' => 3,
                            'order_date' => date('Y-m-d'),
                            'order_time' => date('H:i:s'),
                            'added_by' => 2,
                            'added_by' => $u_id,
                            'room_service_unique_id' => $unique_number,
                        );

                        $add_rs_service = $this->ApiModel->insert_data('rmservice_services_orders', $arr_rs);

                        if ($add_rs_service) {

                            foreach ($roomservice_service_data as $rm_s) {
                                $arr1_rs = array(
                                    'hotel_id' => $hotel_id,
                                    'rmservice_services_order_id' => $add_rs_service,
                                    'room_serv_service_id' => $rm_s['r_s_services_id'],
                                    'price' => $rm_s['price'],
                                    'quantity' => $rm_s['quantity'],
                                );

                                $add_rs_detail = $this->ApiModel->insert_data('rmservice_services_details', $arr1_rs);

                                if ($add_rs_detail) {
                                    $wh = '(rmservice_services_order_id = "' . $add_rs_service . '")';

                                    $rs_order_data = $this->ApiModel->getData('rmservice_services_orders', $wh);

                                    $arr_rs_o = array(
                                        'order_total' => $rs_order_data['order_total'] + ($rm_s['price'] * $rm_s['quantity'])
                                    );

                                    $this->ApiModel->edit_data('rmservice_services_orders', $wh, $arr_rs_o);

                                }
                            }
                        }
                    }

                    //add room service menu order
                    $add = "";

                    if ($room_service_menu_data) {
                        $arr = array(
                            'hotel_id' => $hotel_id,
                            'u_id' => $u_id,
                            'booking_id' => $booking_id,
                            //  'order_total' => $order_total,
                            'order_from' => 3,
                            'order_date' => date('Y-m-d'),
                            'order_time' => date('H:i:s'),
                            'added_by' => 2,
                            'added_by' => $u_id,
                            'room_service_unique_id' => $unique_number,
                        );

                        $add = $this->ApiModel->insert_data('room_service_menu_orders', $arr);

                        if ($add) {
                            foreach ($room_service_menu_data as $rs_m) {
                                $arr1 = array(
                                    'hotel_id' => $hotel_id,
                                    'room_service_menu_order_id' => $add,
                                    'room_service_cat_id' => $rs_m['room_service_cat_id'],
                                    'room_serv_menu_id' => $rs_m['room_serv_menu_id'],
                                    'price' => $rs_m['price'],
                                    'quantity' => $rs_m['quantity'],
                                );

                                $add_detail = $this->ApiModel->insert_data('room_service_menu_details', $arr1);

                                if ($add_detail) {
                                    $wh = '(room_serv_menu_id = "' . $rs_m['room_serv_menu_id'] . '")';

                                    $room_serv_menu = $this->ApiModel->getData('room_serv_menu_list', $wh);

                                    if ($room_serv_menu['time_in'] == 1) {
                                        $time_in = "Minute";
                                        $prepartion_time = $room_serv_menu['prepartion_time'];
                                    } else {
                                        if ($room_serv_menu['time_in'] == 2) {
                                            $time_in = "Hrs";
                                            $prepartion_time1 = $room_serv_menu['prepartion_time'];

                                            $prepartion_time = $prepartion_time1 * 60;
                                        }
                                    }

                                    $current_time = date('h:i');
                                    $time = strtotime($current_time);

                                    $delivery_time = date("h:i", strtotime('+' . $prepartion_time . ' minutes', $time));

                                    $wh_d = '(room_service_menu_order_id = "' . $add . '")';

                                    $rs_m_order_data = $this->ApiModel->getData('room_service_menu_orders', $wh_d);

                                    $arrdel_time = array(
                                        'delivery_time' => $delivery_time,
                                        'order_total' => $rs_m_order_data['order_total'] + ($rs_m['price'] * $rs_m['quantity'])
                                    );

                                    $this->ApiModel->edit_data('room_service_menu_orders', $wh_d, $arrdel_time);
                                }

                            }
                        }
                    }

                    if (($add && $add_detail) || ($add_rs_service && $add_rs_detail)) {
                        $add1 = "";
                        $add_rs_service1 = "";
                        $date = "";

                        if ($add && $add_detail) {
                            $add1 = $add;

                            $wh_d = '(room_service_menu_order_id = "' . $add . '")';

                            $room_service_menu_orders = $this->ApiModel->getData('room_service_menu_orders', $wh_d);

                            $date = date('h:i A', strtotime($room_service_menu_orders['delivery_time']));

                        }

                        if ($add_rs_service && $add_rs_detail) {
                            $add_rs_service1 = $add_rs_service;
                        }

                        $send_data[] = array(
                            'room_service_menu_order_id' => $add1,
                            'rmservice_services_order_id' => $add_rs_service1,
                            'approximately_delivery_time' => $date,
                            'room_service_unique_id' => $unique_number,
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Your order is placed.";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }


    //afer guest login user all order order and upcoming order //10-1-2023 //archana
    public function get_my_orders_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    //all order list
                    // $order_status = 2;

                    $laudry_order = $this->ApiModel->get_user_laudry_order($hotel_id, $u_id, $booking_id);

                    $food_order = $this->ApiModel->get_user_food_order($hotel_id, $u_id, $booking_id);

                    $housekeeping_order = $this->ApiModel->get_user_housekeeping_order($hotel_id, $u_id, $booking_id);

                    $rs_service_order = $this->ApiModel->get_user_rs_service_order($hotel_id, $u_id, $booking_id);

                    $rs_menu_order = $this->ApiModel->get_user_rs_menu_order($hotel_id, $u_id, $booking_id);

                    $spa_service_request = $this->ApiModel->get_spa_service_request($hotel_id, $u_id, $booking_id);

                    $vehicle_wash_service_request = $this->ApiModel->get_vehicle_wash_service_request($hotel_id, $u_id, $booking_id);

                    $luggage_service_request = $this->ApiModel->get_luggage_service_request($hotel_id, $u_id, $booking_id);

                    $cab_service_request = $this->ApiModel->get_cab_service_request($hotel_id, $u_id, $booking_id);

                    $business_center_request = $this->ApiModel->get_business_center_request($hotel_id, $u_id, $booking_id);

                    $reserve_table_request = $this->ApiModel->get_reserve_table_request($hotel_id, $u_id, $booking_id);

                    $banquet_hall_request = $this->ApiModel->get_banquet_hall_request($hotel_id, $u_id, $booking_id);



                    $laudry_data = array();
                    $food_data = array();
                    $hk_data = array();
                    $rs_data = array();
                    $spa_data = array();
                    $vehicle_wash_data = array();
                    $luggage_data = array();
                    $cab_data = array();
                    $business_center_data = array();
                    $reserve_table_data = array();
                    $banquet_hall_data = array();


                    //complete laudry order
                    if ($laudry_order) {
                        foreach ($laudry_order as $lo) {
                            $wh_c = '(cloth_order_id = "' . $lo['cloth_order_id'] . '")';

                            $laudry_order_details = $this->ApiModel->getAllData('cloth_order_details', $wh_c);

                            $laudry_details = array();

                            if ($laudry_order_details) {
                                foreach ($laudry_order_details as $lo_d) {
                                    $wh_cc = '(cloth_id = "' . $lo_d['cloth_id'] . '")';

                                    $cloth_data = $this->ApiModel->getData('cloth', $wh_cc);

                                    $cloth_name = "";

                                    if ($cloth_data) {
                                        $cloth_name = $cloth_data['cloth_name'];
                                    }

                                    $laudry_details[] = array(
                                        'order_details_id' => $lo_d['cloth_order_details_id'],
                                        'order_id' => $lo_d['cloth_order_id'],
                                        'service_id' => $lo_d['cloth_id'],
                                        'service_name' => $cloth_name,
                                        'price' => $lo_d['price'],
                                        'quantity' => $lo_d['quantity'],
                                        'total' => $lo_d['price'] * $lo_d['quantity'],
                                    );
                                }
                            }

                            $order_status = "";
                            $staff_id = "";
                            $accept_date = "";
                            $order_date = "";
                            $reject_date = "";
                            $complete_date = "";
                            $otp = "";
                            $complete_time = "";
                            $reject_reason = "";

                            $wh_s = '(u_id = "' . $lo['staff_id'] . '")';

                            $staff_data = $this->ApiModel->getData('register', $wh_s);

                            $staff_full_name = "";
                            $staff_mobile_no = "";

                            if ($staff_data) {
                                $staff_full_name = $staff_data['full_name'];
                                $staff_mobile_no = $staff_data['mobile_no'];
                            }

                            if ($lo['order_status'] == 0) {
                                $order_status = "New Order";
                                $staff_id = $lo['staff_id'];
                                $accept_date = "";
                                $complete_date = "";
                                $order_date = $lo['order_date'];
                                $reject_date = "";
                                $complete_time = "";
                                $otp = "";
                                $reject_reason = "";
                            } else {
                                if ($lo['order_status'] == 1) {
                                    $order_status = "Accept Order";
                                    $staff_id = $lo['staff_id'];
                                    $accept_date = $lo['accept_date'];
                                    $order_date = $lo['order_date'];
                                    $reject_date = "";
                                    $complete_date = "";
                                    $complete_time = "";
                                    $otp = $lo['otp'];
                                    $reject_reason = "";
                                } else {
                                    if ($lo['order_status'] == 2) {
                                        $order_status = "Complete Order";
                                        $staff_id = $lo['staff_id'];
                                        $accept_date = "";
                                        $order_date = $lo['order_date'];
                                        $complete_date = $lo['complete_date'];
                                        $complete_time = date('h:i a', strtotime($lo['complete_time']));
                                        $reject_date = "";
                                        $otp = "";
                                        $reject_reason = "";
                                    } else {
                                        if ($lo['order_status'] == 3) {
                                            $order_status = "Reject Order";
                                            $staff_id = $lo['staff_id'];
                                            $accept_date = "";
                                            $complete_date = "";
                                            $complete_time = "";
                                            $order_date = $lo['order_date'];
                                            $reject_date = $lo['reject_date'];
                                            $otp = "";

                                            if ($lo['reject_reason'] == 1) {
                                                $reject_reason = "Out of stock";
                                            } elseif ($lo['reject_reason'] == 2) {
                                                $reject_reason = "We do not serve";
                                            } elseif ($lo['reject_reason'] == 3) {
                                                $reject_reason = "Out of time";
                                            } elseif ($lo['reject_reason'] == 4) {
                                                $reject_reason = "Out of time";
                                            }
                                        } else {
                                            if ($lo['order_status'] == 4) {
                                                $order_status = "Cancelled By User";
                                                $staff_id = "";
                                                $accept_date = "";
                                                $complete_date = "";
                                                $order_date = $lo['order_date'];
                                                $reject_date = "";
                                                $complete_time = "";
                                                $otp = "";
                                                $reject_reason = "";
                                            }
                                        }
                                    }
                                }
                            }

                            $laudry_data[] = array(
                                'order_of' => "Laudry",
                                'order_id' => $lo['cloth_order_id'],
                                'order_total' => $lo['order_total'],
                                'order_date' => $lo['order_date'],
                                'order_time' => date('h:i a', strtotime($lo['order_time'])),
                                'order_status' => $order_status,
                                'order_status_flag' => $lo['order_status'],
                                'staff_id' => $staff_id,
                                'staff_full_name' => $staff_full_name,
                                'staff_mobile_no' => $staff_mobile_no,
                                'accept_date' => $accept_date,
                                'order_date' => $order_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'otp' => $otp,
                                'complete_date' => $complete_date,
                                'complete_time' => $complete_time,
                                'order_description' => $laudry_details,
                            );
                        }

                    }

                    //complete food order
                    if ($food_order) {
                        foreach ($food_order as $fo) {
                            $wh_f = '(food_order_id = "' . $fo['food_order_id'] . '")';

                            $food_order_details = $this->ApiModel->getAllData('food_order_details', $wh_f);

                            $food_details = array();

                            if ($food_order_details) {
                                foreach ($food_order_details as $fo_d) {
                                    $wh_ff = '(food_item_id = "' . $fo_d['food_items_id'] . '")';

                                    $food_menus_data = $this->ApiModel->getData('food_menus', $wh_ff);

                                    $items_name = "";

                                    if ($food_menus_data) {
                                        $items_name = $food_menus_data['items_name'];
                                    }

                                    $food_details[] = array(
                                        'order_details_id' => $fo_d['food_order_details_id'],
                                        'order_id' => $fo_d['food_order_id'],
                                        'service_id' => $fo_d['food_items_id'],
                                        'service_name' => $items_name,
                                        'price' => $fo_d['price'],
                                        'quantity' => $fo_d['quantity'],
                                        'total' => $fo_d['price'] * $fo_d['quantity'],
                                    );
                                }
                            }

                            $order_status_fo = "";
                            $staff_id_fo = "";
                            $accept_date_fo = "";
                            $order_date_fo = "";
                            $reject_date_fo = "";
                            $complete_date_fo = "";
                            $otp_fo = "";
                            $complete_time_fo = "";
                            $reject_reason = "";

                            $wh_s_fo = '(u_id = "' . $fo['staff_id'] . '")';

                            $staff_data_fo = $this->ApiModel->getData('register', $wh_s_fo);

                            $staff_full_name_fo = "";
                            $staff_mobile_no_fo = "";

                            if ($staff_data_fo) {
                                $staff_full_name_fo = $staff_data_fo['full_name'];
                                $staff_mobile_no_fo = $staff_data_fo['mobile_no'];
                            }

                            if ($fo['order_status'] == 0) {
                                $order_status_fo = "New Order";
                                $staff_id_fo = $fo['staff_id'];
                                $accept_date_fo = "";
                                $complete_date_fo = "";
                                $order_date_fo = $fo['order_date'];
                                $reject_date_fo = "";
                                $complete_time_fo = "";
                                $otp_fo = "";
                                $reject_reason = "";
                            } else {
                                if ($fo['order_status'] == 1) {
                                    $order_status_fo = "Accept Order";
                                    $staff_id_fo = $fo['staff_id'];
                                    $accept_date_fo = $fo['accept_date'];
                                    $order_date_fo = $fo['order_date'];
                                    $reject_date_fo = "";
                                    $complete_date_fo = "";
                                    $complete_time_fo = "";
                                    $otp_fo = $fo['otp'];
                                    $reject_reason = "";
                                } else {
                                    if ($fo['order_status'] == 2) {
                                        $order_status_fo = "Complete Order";
                                        $staff_id_fo = $fo['staff_id'];
                                        $accept_date_fo = "";
                                        $order_date_fo = $fo['order_date'];
                                        $complete_date_fo = $fo['complete_date'];
                                        $complete_time_fo = date('h:i a', strtotime($fo['complete_time']));
                                        $reject_date_fo = "";
                                        $otp_fo = "";
                                        $reject_reason = "";
                                    } else {
                                        if ($fo['order_status'] == 3) {
                                            $order_status_fo = "Reject Order";
                                            $staff_id_fo = $fo['staff_id'];
                                            $accept_date_fo = "";
                                            $complete_date_fo = "";
                                            $complete_time_fo = "";
                                            $order_date_fo = $fo['order_date'];
                                            $reject_date_fo = $fo['reject_date'];
                                            $otp_fo = "";

                                            if ($fo['reject_reason'] == 1) {
                                                $reject_reason = "Out of stock";
                                            } elseif ($fo['reject_reason'] == 2) {
                                                $reject_reason = "We do not serve";
                                            } elseif ($fo['reject_reason'] == 3) {
                                                $reject_reason = "Out of time";
                                            } elseif ($fo['reject_reason'] == 4) {
                                                $reject_reason = "Out of time";
                                            }
                                        } else {
                                            if ($fo['order_status'] == 4) {
                                                $order_status_fo = "Cancelled By User";
                                                $staff_id_fo = "";
                                                $accept_date_fo = "";
                                                $complete_date_fo = "";
                                                $order_date_fo = $fo['order_date'];
                                                $reject_date_fo = "";
                                                $complete_time_fo = "";
                                                $otp_fo = "";
                                                $reject_reason = "";
                                            }
                                        }
                                    }
                                }
                            }

                            $food_data[] = array(
                                'order_of' => "Food",
                                'order_id' => $fo['food_order_id'],
                                'order_total' => $fo['order_total'],
                                'order_date' => $fo['order_date'],
                                'order_time' => date('h:i a', strtotime($fo['order_time'])),
                                'order_status' => $order_status_fo,
                                'order_status_flag' => $fo['order_status'],
                                'staff_id' => $staff_id_fo,
                                'staff_full_name' => $staff_full_name_fo,
                                'staff_mobile_no' => $staff_mobile_no_fo,
                                'accept_date' => $accept_date_fo,
                                'order_date' => $order_date_fo,
                                'reject_date' => $reject_date_fo,
                                'reject_reason' => $reject_reason,
                                'otp' => $otp_fo,
                                'complete_date' => $complete_date_fo,
                                'complete_time' => $complete_time_fo,
                                'order_description' => $food_details,
                            );
                        }

                    }

                    //complete housekeeping order
                    if ($housekeeping_order) {
                        foreach ($housekeeping_order as $hko) {
                            // print_r($hko);die;
                            $wh_hk = '(h_k_order_id = "' . $hko['h_k_order_id'] . '")';

                            $house_keeping_order_details = $this->ApiModel->getAllData('house_keeping_order_details', $wh_hk);

                            $hk_details = array();

                            if ($house_keeping_order_details) {
                                foreach ($house_keeping_order_details as $hko_d) {
                                    $wh_hkk = '(h_k_services_id = "' . $hko_d['h_k_service_id'] . '")';

                                    $house_keeping_services_data = $this->ApiModel->getData('house_keeping_services', $wh_hkk);

                                    $service_type = "";

                                    if ($house_keeping_services_data) {
                                        $service_type = $house_keeping_services_data['service_type'];
                                    }

                                    $hk_details[] = array(
                                        'order_details_id' => $hko_d['h_k_order_details_id'],
                                        'order_id' => $hko_d['h_k_order_id'],
                                        'service_id' => $hko_d['h_k_service_id'],
                                        'service_name' => $service_type,
                                        'price' => $hko_d['price'],
                                        'quantity' => $hko_d['quantity'],
                                        'total' => $hko_d['price'] * $hko_d['quantity'],
                                    );
                                }
                            }

                            $order_status_hk = "";
                            $staff_id_hk = "";
                            $accept_date_hk = "";
                            $order_date_hk = "";
                            $reject_date_hk = "";
                            $complete_date_hk = "";
                            $otp_hk = "";
                            $complete_time_hk = "";
                            $reject_reason = "";

                            $wh_s_hk = '(u_id = "' . $hko['staff_id'] . '")';

                            $staff_data_hk = $this->ApiModel->getData('register', $wh_s_hk);

                            $staff_full_name_hk = "";
                            $staff_mobile_no_hk = "";

                            if ($staff_data_hk) {
                                $staff_full_name_hk = $staff_data_hk['full_name'];
                                $staff_mobile_no_hk = $staff_data_hk['mobile_no'];
                            }

                            if ($hko['order_status'] == 0) {
                                $order_status_hk = "New Order";
                                $staff_id_hk = $hko['staff_id'];
                                $accept_date_hk = "";
                                $complete_date_hk = "";
                                $order_date_hk = $hko['order_date'];
                                $reject_date_hk = "";
                                $complete_time_hk = "";
                                $otp_hk = "";
                                $reject_reason = "";
                            } else {
                                if ($hko['order_status'] == 1) {
                                    $order_status_hk = "Accept Order";
                                    $staff_id_hk = $hko['staff_id'];
                                    $accept_date_hk = $hko['accept_date'];
                                    $order_date_hk = $hko['order_date'];
                                    $reject_date_hk = "";
                                    $complete_date_hk = "";
                                    $complete_time_hk = "";
                                    $otp_hk = $hko['otp'];
                                    $reject_reason = "";
                                } else {
                                    if ($hko['order_status'] == 2) {
                                        $order_status_hk = "Complete Order";
                                        $staff_id_hk = $hko['staff_id'];
                                        $accept_date_hk = "";
                                        $order_date_hk = $hko['order_date'];
                                        $complete_date_hk = $hko['complete_date'];
                                        $complete_time_hk = date('h:i a', strtotime($hko['complete_time']));
                                        $reject_date_hk = "";
                                        $otp_hk = "";
                                        $reject_reason = "";
                                    } else {
                                        if ($hko['order_status'] == 3) {
                                            $order_status_hk = "Reject Order";
                                            $staff_id_hk = $hko['staff_id'];
                                            $accept_date_hk = "";
                                            $complete_date_hk = "";
                                            $complete_time_hk = "";
                                            $order_date_hk = $hko['order_date'];
                                            $reject_date_hk = $hko['reject_date'];
                                            $otp_hk = "";

                                            if ($hko['reject_reason'] == 1) {
                                                $reject_reason = "Out of stock";
                                            } elseif ($hko['reject_reason'] == 2) {
                                                $reject_reason = "We do not serve";
                                            } elseif ($hko['reject_reason'] == 3) {
                                                $reject_reason = "Out of time";
                                            } elseif ($hko['reject_reason'] == 4) {
                                                $reject_reason = "Out of time";
                                            }
                                        } else {
                                            if ($hko['order_status'] == 4) {
                                                $order_status_hk = "Cancelled By User";
                                                $staff_id_hk = "";
                                                $accept_date_hk = "";
                                                $complete_date_hk = "";
                                                $order_date_hk = $hko['order_date'];
                                                $reject_date_hk = "";
                                                $complete_time_hk = "";
                                                $otp_hk = "";
                                                $reject_reason = "";

                                            }
                                        }

                                    }
                                }
                            }

                            $hk_data[] = array(
                                'order_of' => "Housekeeping",
                                'order_id' => $hko['h_k_order_id'],
                                'order_total' => $hko['order_total'],
                                'order_date' => $order_date_hk,
                                'order_time' => date('h:i a', strtotime($hko['order_time'])),
                                'order_status' => $order_status_hk,
                                'order_status_flag' => $hko['order_status'],
                                'staff_id' => $staff_id_hk,
                                'staff_full_name' => $staff_full_name_hk,
                                'staff_mobile_no' => $staff_mobile_no_hk,
                                'accept_date' => $accept_date_hk,
                                'order_date' => $order_date_hk,
                                'reject_date' => $reject_date_hk,
                                'reject_reason' => $reject_reason,
                                'otp' => $otp_hk,
                                'complete_date' => $complete_date_hk,
                                'complete_time' => $complete_time_hk,
                                'order_description' => $hk_details,
                            );
                        }

                    }

                    //complete rs service order
                    if ($rs_service_order) {
                        foreach ($rs_service_order as $rs_so) {
                            //room service service details
                            $wh_rs_s = '(room_service_unique_id = "' . $rs_so['room_service_unique_id'] . '")';

                            $rmservice_services_details = $this->ApiModel->getAllData('rmservice_services_details', $wh_rs_s);

                            $rs_service_details = array();

                            if ($rmservice_services_details) {
                                foreach ($rmservice_services_details as $rsso_d) {
                                    $wh_rs_ss = '(r_s_services_id = "' . $rsso_d['room_serv_service_id'] . '")';

                                    $room_servs_services_data = $this->ApiModel->getData('room_servs_services', $wh_rs_ss);

                                    $service_name = "";

                                    if ($room_servs_services_data) {
                                        $service_name = $room_servs_services_data['service_name'];
                                    }

                                    $rs_service_details[] = array(
                                        'order_details_id' => $rsso_d['rmservice_services_detail_id'],
                                        'order_id' => $rsso_d['rmservice_services_order_id'],
                                        'service_id' => $rsso_d['room_serv_service_id'],
                                        'service_name' => $service_name,
                                        'price' => $rsso_d['price'],
                                        'quantity' => $rsso_d['quantity'],
                                        'total' => $rsso_d['price'] * $rsso_d['quantity'],
                                    );
                                }
                            }

                            //room service menu details
                            $room_service_menu_details = $this->ApiModel->getAllData('room_service_menu_details', $wh_rs_s);

                            $rs_menu_details = array();

                            if ($room_service_menu_details) {
                                foreach ($room_service_menu_details as $rsmo_d) {
                                    $wh_rs_ss = '(	room_serv_menu_id = "' . $rsmo_d['room_serv_menu_id'] . '")';

                                    $room_serv_menu_list_data = $this->ApiModel->getData('room_serv_menu_list', $wh_rs_ss);

                                    $menu_name = "";

                                    if ($room_serv_menu_list_data) {
                                        $menu_name = $room_serv_menu_list_data['menu_name'];
                                    }

                                    $rs_menu_details[] = array(
                                        'order_details_id' => $rsmo_d['room_service_details_id'],
                                        'order_id' => $rsmo_d['room_service_menu_order_id'],
                                        'service_id' => $rsmo_d['room_serv_menu_id'],
                                        'service_name' => $menu_name,
                                        'price' => $rsmo_d['price'],
                                        'quantity' => $rsmo_d['quantity'],
                                        'total' => $rsmo_d['price'] * $rsmo_d['quantity'],
                                    );
                                }
                            }

                            $rs_details = array_merge($rs_service_details, $rs_menu_details);
                            // $rs_details[] =  $rs_service_details;
                            // $rs_details[] =  $rs_menu_details;

                            $order_status_rs = "";
                            $staff_id_rs = "";
                            $accept_date_rs = "";
                            $order_date_rs = "";
                            $reject_date_rs = "";
                            $complete_date_rs = "";
                            $otp_rs = "";
                            $complete_time_rs = "";

                            $wh_s_rs = '(u_id = "' . $rs_so['staff_id'] . '")';

                            $staff_data_rs = $this->ApiModel->getData('register', $wh_s_rs);

                            $staff_full_name_rs = "";
                            $staff_mobile_no_rs = "";

                            if ($staff_data_rs) {
                                $staff_full_name_rs = $staff_data_rs['full_name'];
                                $staff_mobile_no_rs = $staff_data_rs['mobile_no'];
                            }

                            if ($rs_so['order_status'] == 0) {
                                $order_status_rs = "New Order";
                                $staff_id_rs = $rs_so['staff_id'];
                                $accept_date_rs = "";
                                $complete_date_rs = "";
                                $order_date_rs = $rs_so['order_date'];
                                $reject_date_rs = "";
                                $complete_time_rs = "";
                                $otp_rs = "";
                            } else {
                                if ($rs_so['order_status'] == 1) {
                                    $order_status_rs = "Accept Order";
                                    $staff_id_rs = $rs_so['staff_id'];
                                    $accept_date_rs = $rs_so['accept_date'];
                                    $order_date_rs = $rs_so['order_date'];
                                    $reject_date_rs = "";
                                    $complete_date_rs = "";
                                    $complete_time_rs = "";
                                    $otp_rs = $rs_so['otp'];
                                } else {
                                    if ($rs_so['order_status'] == 2) {
                                        $order_status_rs = "Complete Order";
                                        $staff_id_rs = $rs_so['staff_id'];
                                        $accept_date_rs = "";
                                        $order_date_rs = $rs_so['order_date'];
                                        $complete_date_rs = $rs_so['complete_date'];
                                        $complete_time_rs = date('h:i a', strtotime($rs_so['complete_time']));
                                        $reject_date_rs = "";
                                        $otp_rs = "";
                                    } else {
                                        if ($rs_so['order_status'] == 3) {
                                            $order_status_rs = "Reject Order";
                                            $staff_id_rs = $rs_so['staff_id'];
                                            $accept_date_rs = "";
                                            $complete_date_rs = "";
                                            $complete_time_rs = "";
                                            $order_date_rs = $rs_so['order_date'];
                                            $reject_date_rs = $rs_so['reject_date'];
                                            $otp_rs = "";
                                        }
                                    }
                                }
                            }
                            $rs_data[] = array(
                                'order_of' => "Room Service",
                                'order_id' => $rs_so['room_service_unique_id'],
                                'order_total' => $rs_so['order_total'],
                                'order_date' => $rs_so['order_date'],
                                'order_time' => date('h:i a', strtotime($rs_so['order_time'])),
                                'order_status' => $order_status_rs,
                                'order_status_flag' => $rs_so['order_status'],
                                'staff_id' => $staff_id_rs,
                                'staff_full_name' => $staff_full_name_rs,
                                'staff_mobile_no' => $staff_mobile_no_rs,
                                'accept_date' => $accept_date_rs,
                                'order_date' => $order_date_rs,
                                'reject_date' => $reject_date_rs,
                                'otp' => $otp_rs,
                                'complete_date' => $complete_date_rs,
                                'complete_time' => $complete_time_rs,
                                'order_description' => $rs_details,
                            );
                        }

                    }

                    //complete spa request
                    if ($spa_service_request) {
                        foreach ($spa_service_request as $s_s_r) {
                            $wh_s = '(front_ofs_spa_service_images_id = "' . $s_s_r['spa_type'] . '")';

                            $spa_service_request_details = $this->ApiModel->getAllData('front_ofs_spa_service_images', $wh_s);

                            $spa_details = array();
                            $request_status = "";
                            $select_date = "";
                            $select_time = "";
                            $request_date = "";
                            $reject_date = "";
                            $complete_date = "";
                            $request_time = "";
                            $cancel_date = "";
                            $reject_reason = "";
                            $accept_date = "";

                            if ($s_s_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $complete_date = "";
                                $reject_date = "";
                                $reject_reason = "";
                            } else {
                                if ($s_s_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $reject_date = "";
                                    $complete_date = "";
                                    $reject_reason = "";
                                    $accept_date = $s_s_r['accept_date'];
                                } else {
                                    if ($s_s_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $complete_date = "";
                                        $reject_date = $s_s_r['reject_date'];

                                        if ($s_s_r['reject_reason'] == 1) {
                                            $reject_reason = "Please Try After Sometime";
                                        } elseif ($s_s_r['reject_reason'] == 2) {
                                            $reject_reason = "Temporarily Unavailable";
                                        } elseif ($s_s_r['reject_reason'] == 3) {
                                            $reject_reason = "Slots Not Available";
                                        } elseif ($s_s_r['reject_reason'] == 4) {
                                            $reject_reason = "Please Contact Front Office";
                                        }
                                    } else {
                                        if ($s_s_r['request_status'] == 3) {
                                            $request_status = "Cancelled By User";
                                            $complete_date = "";
                                            $cancel_date = $s_s_r['cancel_date'];
                                            $reject_date = "";
                                            $reject_reason = "";
                                        } else {
                                            if ($s_s_r['request_status'] == 4) {
                                                $request_status = "Complete Order";
                                                $complete_date = $s_s_r['complete_date'];
                                                $reject_date = "";
                                                $reject_reason = "";
                                                $accept_date = $s_s_r['accept_date'];

                                            }
                                        }
                                    }
                                }
                            }
                            if ($spa_service_request_details) {
                                foreach ($spa_service_request_details as $s_s_r_d) {
                                    $spa_details[] = array(
                                        'order_details_id' => $s_s_r_d['front_ofs_spa_service_images_id'],
                                        'order_id' => $s_s_r['spa_service_request_id'],
                                        'service_id' => $s_s_r_d['front_ofs_spa_service_images_id'],
                                        'service_name' => $s_s_r_d['spa_type'],
                                        'price' => $s_s_r_d['spa_price'],
                                        'quantity' => 1,
                                        'total' => $s_s_r_d['spa_price'],
                                        'spa_description' => strip_tags(str_replace('&nbsp;', '', $s_s_r_d['spa_description'])),
                                        'select_date' => $s_s_r['select_date'],
                                        'select_time' => $s_s_r['select_time'],
                                        'cancel_date' => $cancel_date,
                                        'note' => $s_s_r['note'],
                                    );
                                }
                            }

                            $spa_data[] = array(
                                'order_of' => "Spa",
                                'order_id' => $s_s_r['spa_service_request_id'],
                                'order_total' => $s_s_r['charges'],
                                'order_date' => $s_s_r['select_date'],
                                'order_time' => date('h:i a', strtotime($s_s_r['select_time'])),
                                'order_status' => $request_status,
                                'order_status_flag' => $s_s_r['request_status'],
                                "accept_date" => $accept_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'complete_date' => $complete_date,
                                'order_description' => $spa_details,
                                'otp' => "",
                            );
                        }

                    }

                    //complete vehicle wash request
                    if ($vehicle_wash_service_request) {
                        foreach ($vehicle_wash_service_request as $v_w_s_r) {
                            $wh_s = '(vehicle_washing_charge_id = "' . $v_w_s_r['vehicle_washing_charge_id'] . '")';

                            $vehicle_wash_service_request_details = $this->ApiModel->getAllData('vehicle_washing_charges', $wh_s);

                            $vehicle_wash_details = array();
                            $request_status = "";
                            $select_date = "";
                            $select_time = "";
                            $request_date = "";
                            $reject_date = "";
                            $complete_date = "";
                            $request_time = "";
                            $cancel_date = "";
                            $reject_reason = "";
                            $accept_date = "";

                            if ($v_w_s_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $complete_date = "";
                                $reject_date = "";
                                $reject_reason = "";
                            } else {
                                if ($v_w_s_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $reject_date = "";
                                    $complete_date = "";
                                    $reject_reason = "";
                                    $accept_date = $v_w_s_r['accept_date'];
                                } else {
                                    if ($v_w_s_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $complete_date = "";
                                        $reject_date = $v_w_s_r['reject_date'];

                                        if ($v_w_s_r['reject_reason'] == 1) {
                                            $reject_reason = "Please Try After Sometime";
                                        } elseif ($v_w_s_r['reject_reason'] == 2) {
                                            $reject_reason = "Temporarily Unavailable";
                                        } elseif ($v_w_s_r['reject_reason'] == 3) {
                                            $reject_reason = "Vehicle Not Identified";
                                        } elseif ($v_w_s_r['reject_reason'] == 4) {
                                            $reject_reason = "Please Contact Front Office";
                                        }
                                    } else {
                                        if ($v_w_s_r['request_status'] == 3) {
                                            $request_status = "Cancelled By User";
                                            $complete_date = "";
                                            $cancel_date = $v_w_s_r['cancel_date'];
                                            $reject_date = "";
                                            $reject_reason = "";
                                        } else {
                                            if ($v_w_s_r['request_status'] == 4) {
                                                $request_status = "Complete Order";
                                                $complete_date = $v_w_s_r['complete_date'];
                                                $reject_date = "";
                                                $reject_reason = "";
                                                $accept_date = $v_w_s_r['accept_date'];

                                            }
                                        }
                                    }
                                }
                            }

                            if ($vehicle_wash_service_request_details) {
                                foreach ($vehicle_wash_service_request_details as $v_w_s_r_d) {
                                    $vehicle_wash_details[] = array(
                                        'order_details_id' => $v_w_s_r_d['vehicle_washing_charge_id'],
                                        'order_id' => $v_w_s_r['vehicle_wash_request_id'],
                                        'service_id' => $v_w_s_r_d['vehicle_washing_charge_id'],
                                        'service_name' => "vehicle wash",
                                        'quantity' => 1,
                                        'total' => $v_w_s_r_d['charges'],
                                        'vehicle_type' => $v_w_s_r_d['vehicle_type'],
                                        'price' => $v_w_s_r_d['charges'],
                                        'vehicle_name' => $v_w_s_r['vehicle_name'],
                                        'vehicle_no' => $v_w_s_r['vehicle_no'],
                                        'vehicle_img' => $v_w_s_r['vehicle_img'],
                                        'select_date' => $v_w_s_r['select_date'],
                                        'select_time' => $v_w_s_r['select_time'],
                                        'cancel_date' => $cancel_date,
                                        'note' => $v_w_s_r['note'],
                                    );
                                }
                            }



                            $vehicle_wash_data[] = array(

                                'order_of' => "Vehicle Wash",
                                'order_id' => $v_w_s_r['vehicle_wash_request_id'],
                                'order_total' => $v_w_s_r['charges'],
                                'order_date' => $v_w_s_r['select_date'],
                                'order_time' => date('h:i a', strtotime($v_w_s_r['select_time'])),
                                'order_status' => $request_status,
                                'order_status_flag' => $v_w_s_r['request_status'],
                                "accept_date" => $accept_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'complete_date' => $complete_date,
                                'complete_time' => "",
                                'order_description' => $vehicle_wash_details,
                                'otp' => "",
                            );
                        }

                    }
                    //complete luggage request
                    if ($luggage_service_request) {
                        foreach ($luggage_service_request as $l_s_r) {
                            $luggage_details = array();
                            $request_status = "";
                            $select_date = "";
                            $select_time = "";
                            $request_date = "";
                            $reject_date = "";
                            $complete_date = "";
                            $request_time = "";
                            $cancel_date = "";
                            $reject_reason = "";
                            $accept_date = "";

                            if ($l_s_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $complete_date = "";
                                $reject_date = "";
                                $reject_reason = "";
                            } else {
                                if ($l_s_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $reject_date = "";
                                    $complete_date = "";
                                    $reject_reason = "";
                                    $accept_date = $l_s_r['accept_date'];
                                } else {
                                    if ($l_s_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $complete_date = "";
                                        $reject_date = $l_s_r['reject_date'];

                                        if ($l_s_r['reject_reason'] == 1) {
                                            $reject_reason = "Temporarily unavailable";
                                        } elseif ($l_s_r['reject_reason'] == 2) {
                                            $reject_reason = "Space Not Available";
                                        } elseif ($l_s_r['reject_reason'] == 3) {
                                            $reject_reason = "Please Contact Front Office";
                                        } elseif ($l_s_r['reject_reason'] == 4) {
                                            $reject_reason = "Available Post Checkout";
                                        }
                                    } else {
                                        if ($l_s_r['request_status'] == 3) {
                                            $request_status = "Cancelled By User";
                                            $complete_date = "";
                                            $cancel_date = $l_s_r['cancel_date'];
                                            $reject_date = "";
                                            $reject_reason = "";
                                        } else {
                                            if ($l_s_r['request_status'] == 4) {
                                                $request_status = "Complete Order";
                                                $complete_date = $l_s_r['complete_date'];
                                                $reject_date = "";
                                                $reject_reason = "";
                                                $accept_date = $l_s_r['accept_date'];

                                            }
                                        }
                                    }
                                }
                            }

                            $luggage_details[] = array(
                                'order_details_id' => $l_s_r['luggage_request_id'],
                                'order_id' => $l_s_r['luggage_request_id'],
                                'service_id' => $l_s_r['luggage_request_id'],
                                'service_name' => "Luggage",
                                'price' => 0,
                                'total' => 0,
                                'quantity' => $l_s_r['quantity'],
                                'select_date' => $l_s_r['select_date'],
                                'select_time' => $l_s_r['select_time'],
                                'cancel_date' => $cancel_date,
                                'note' => $l_s_r['note'],
                            );
                            $luggage_data[] = array(
                                'order_of' => "Luggage",
                                'order_id' => $l_s_r['luggage_request_id'],
                                'order_date' => $l_s_r['select_date'],
                                'order_time' => date('h:i a', strtotime($l_s_r['select_time'])),
                                'order_total' => 0,
                                'order_status' => $request_status,
                                'order_status_flag' => $l_s_r['request_status'],
                                "accept_date" => $accept_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'complete_date' => $complete_date,
                                'complete_time' => "",
                                'otp' => "",
                                'order_description' => $luggage_details,

                            );
                        }

                    }

                    //complete cab request
                    if ($cab_service_request) {
                        foreach ($cab_service_request as $c_s_r) {
                            $cab_details = array();
                            $request_status = "";
                            $select_date = "";
                            $select_time = "";
                            $request_date = "";
                            $reject_date = "";
                            $complete_date = "";
                            $request_time = "";
                            $cancel_date = "";
                            $reject_reason = "";
                            $otp = "";
                            $driver_name = "";
                            $driverr_contact_no = "";
                            $assign_vehicle_type = "";
                            $vehicle_no = "";
                            $accept_date = "";

                            if ($c_s_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $complete_date = "";
                                $reject_date = "";
                                $reject_reason = "";
                                $otp = "";
                            } else {
                                if ($c_s_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $reject_date = "";
                                    $complete_date = "";
                                    $reject_reason = "";
                                    $otp = $c_s_r['otp'];
                                    $driver_name = $c_s_r['driver_name'];
                                    $driverr_contact_no = $c_s_r['driver_contact_no'];
                                    $assign_vehicle_type = $c_s_r['assign_vehicle_type'];
                                    $vehicle_no = $c_s_r['vehicle_no'];
                                    $accept_date = $c_s_r['accepted_date'];
                                } else {
                                    if ($c_s_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $complete_date = "";
                                        $reject_date = $c_s_r['reject_date'];
                                        $otp = "";

                                        if ($c_s_r['reject_reason'] == 1) {
                                            $reject_reason = "Please Try After Sometime";
                                        } elseif ($c_s_r['reject_reason'] == 2) {
                                            $reject_reason = "Temporarily Unavailable";
                                        } elseif ($c_s_r['reject_reason'] == 3) {
                                            $reject_reason = "Slots Not Available";
                                        } elseif ($c_s_r['reject_reason'] == 4) {
                                            $reject_reason = "Please Contact Front Office";
                                        }
                                    } else {
                                        if ($c_s_r['request_status'] == 3) {
                                            $request_status = "Cancelled By User";
                                            $complete_date = "";
                                            $cancel_date = $c_s_r['cancel_date'];
                                            $reject_date = "";
                                            $reject_reason = "";
                                            $otp = "";
                                        } else {
                                            if ($c_s_r['request_status'] == 4) {
                                                $request_status = "Complete Order";
                                                $complete_date = $c_s_r['complete_date'];
                                                $reject_date = "";
                                                $reject_reason = "";
                                                $otp = "";
                                                $driver_name = $c_s_r['driver_name'];
                                                $driverr_contact_no = $c_s_r['driver_contact_no'];
                                                $assign_vehicle_type = $c_s_r['assign_vehicle_type'];
                                                $vehicle_no = $c_s_r['vehicle_no'];
                                                $accept_date = $c_s_r['accepted_date'];
                                            }
                                        }
                                    }
                                }
                            }

                            $cab_details[] = array(
                                'order_details_id' => $c_s_r['cab_service_request_id'],
                                'order_id' => $c_s_r['cab_service_request_id'],
                                'service_id' => $c_s_r['cab_service_request_id'],
                                'service_name' => "Cab",
                                'price' => 0,
                                'quantity' => 1,
                                'total' => 0,
                                'total_passanger' => $c_s_r['total_passanger'],
                                'request_vehicle_type' => $c_s_r['request_vehicle_type'],
                                'destination_name' => $c_s_r['destination_name'],
                                'select_date' => $c_s_r['select_date'],
                                'select_time' => $c_s_r['select_time'],
                                'driver_name' => $driver_name,
                                'driverr_contact_no' => $driverr_contact_no,
                                'assign_vehicle_type' => $assign_vehicle_type,
                                'vehicle_no' => $vehicle_no,
                                'cancel_date' => $cancel_date,
                                'description' => $c_s_r['description'],
                            );

                            $cab_data[] = array(
                                'order_of' => "Cab",
                                'order_id' => $c_s_r['cab_service_request_id'],
                                'order_total' => 0,
                                'order_date' => $c_s_r['select_date'],
                                "order_time" => date('h:i a', strtotime($c_s_r['select_time'])),
                                'order_status' => $request_status,
                                'order_status_flag' => $c_s_r['request_status'],
                                "accept_date" => $accept_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'otp' => $otp,
                                'complete_date' => $complete_date,
                                'complete_time' => "",
                                'order_description' => $cab_details,

                            );
                        }

                    }


                    //complete busineess center request
                    if ($business_center_request) {
                        foreach ($business_center_request as $b_c_r) {
                            $wh_b_c = '(business_center_id = "' . $b_c_r['business_center_type'] . '")';

                            $business_center_request_details = $this->ApiModel->getAllData('business_center', $wh_b_c);

                            $busines_center_details = array();
                            $request_status = "";
                            $select_date = "";
                            $select_time = "";
                            $request_date = "";
                            $reject_date = "";
                            $complete_date = "";
                            $request_time = "";
                            $cancel_date = "";
                            $reject_reason = "";
                            $accept_date = "";

                            if ($b_c_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $complete_date = "";
                                $reject_date = "";
                                $reject_reason = "";
                            } else {
                                if ($b_c_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $reject_date = "";
                                    $complete_date = "";
                                    $reject_reason = "";
                                    $accept_date = $b_c_r['accept_date'];
                                } else {
                                    if ($b_c_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $complete_date = "";
                                        $reject_date = $b_c_r['reject_date'];

                                        if ($b_c_r['reject_reason'] == 1) {
                                            $reject_reason = "Please Try After Sometime";
                                        } elseif ($b_c_r['reject_reason'] == 2) {
                                            $reject_reason = "Temporarily Unavailable";
                                        } elseif ($b_c_r['reject_reason'] == 3) {
                                            $reject_reason = "Slots Not Available";
                                        } elseif ($b_c_r['reject_reason'] == 4) {
                                            $reject_reason = "Please Contact Front Office";
                                        }
                                    } else {
                                        if ($b_c_r['request_status'] == 3) {
                                            $request_status = "Cancelled By User";
                                            $complete_date = "";
                                            $cancel_date = $b_c_r['cancel_date'];
                                            $reject_date = "";
                                            $reject_reason = "";
                                        } else {
                                            if ($b_c_r['request_status'] == 4) {
                                                $request_status = "Complete Order";
                                                $complete_date = "";
                                                $reject_date = "";
                                                $reject_reason = "";
                                                $accept_date = $b_c_r['accept_date'];

                                            }
                                        }
                                    }
                                }
                            }

                            if ($business_center_request_details) {
                                foreach ($business_center_request_details as $b_c_d) {
                                    $wh_b_c_f = '(business_center_id = "' . $b_c_d['business_center_id'] . '")';

                                    $business_facility_data = $this->ApiModel->getData('business_center_facility', $wh_b_c_f);

                                    $facility = "";

                                    if ($business_facility_data) {
                                        $facility = $business_facility_data['facility_name'];
                                    }

                                    $busines_center_details[] = array(
                                        'order_details_id' => $b_c_d['business_center_id'],
                                        'order_id' => $b_c_r['b_c_reserve_id'],
                                        'service_id' => $b_c_d['business_center_id'],
                                        'service_name' => $b_c_d['business_center_type'],
                                        'price' => $b_c_d['price'],
                                        'quantity' => 1,
                                        'total' => $b_c_d['price'],
                                        'no_of_people' => $b_c_d['no_of_people'],
                                        'description' => $b_c_d['description'],
                                        'facility' => $facility,
                                        'event_name' => $b_c_r['event_name'],
                                        'event_date' => $b_c_r['event_date'],
                                        'start_time' => $b_c_r['start_time'],
                                        'end_time' => $b_c_r['end_time'],
                                        'cancel_date' => $cancel_date,
                                        'note' => $b_c_r['additional_note'],
                                    );
                                }
                            }

                            $business_center_data[] = array(
                                'order_of' => "Business Center",
                                'order_id' => $b_c_r['b_c_reserve_id'],
                                'order_total' => $business_center_request_details[0]['price'] ?? '',
                                'order_date' => $b_c_r['request_date'],
                                "order_time" => date('h:i a', strtotime($b_c_r['request_time'])),
                                'order_status' => $request_status,
                                'order_status_flag' => $b_c_r['request_status'],
                                'accept_date' => $accept_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'complete_date' => $complete_date,
                                'complete_time' => "",
                                'otp' => "",
                                'order_description' => $busines_center_details,
                            );
                        }

                    }

                    //complete reserve table request
                    if ($reserve_table_request) {
                        foreach ($reserve_table_request as $r_t_r) {
                            $wh_r_t = '(food_facility_id = "' . $r_t_r['food_facility_id'] . '")';

                            $reserve_table_facility_details = $this->ApiModel->getAllData('food_facility', $wh_r_t);

                            $table_facility_details = array();
                            $request_status = "";
                            $select_date = "";
                            $select_time = "";
                            $request_date = "";
                            $reject_date = "";
                            $complete_date = "";
                            $request_time = "";
                            $cancel_date = "";
                            $accept_date = "";

                            if ($r_t_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $complete_date = "";
                                $reject_date = "";
                            } else {
                                if ($r_t_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $reject_date = "";
                                    $complete_date = "";
                                    $accept_date = $r_t_r['accept_date'];

                                } else {
                                    if ($r_t_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $complete_date = "";
                                        $reject_date = $r_t_r['reject_date'];
                                    } else {
                                        if ($r_t_r['request_status'] == 3) {
                                            $request_status = "Cancelled By User";
                                            $complete_date = "";
                                            $cancel_date = $r_t_r['cancel_date'];
                                            $reject_date = "";
                                        } else {
                                            if ($r_t_r['request_status'] == 4) {
                                                $request_status = "Complete Order";
                                                $complete_date = $r_t_r['complete_date'];
                                                $reject_date = "";
                                                $accept_date = $r_t_r['accept_date'];

                                            }
                                        }
                                    }
                                }
                            }

                            if ($reserve_table_facility_details) {
                                foreach ($reserve_table_facility_details as $r_t_f_d) {
                                    $table_facility_details[] = array(
                                        'order_details_id' => $r_t_f_d['food_facility_id'],
                                        'order_id' => $r_t_r['reserve_table_id'],
                                        'service_id' => $r_t_f_d['food_facility_id'],
                                        'service_name' => $r_t_f_d['facility_name'],
                                        'price' => 0,
                                        'quantity' => 1,
                                        'total' => 0,
                                        'description' => strip_tags($r_t_f_d['description']),
                                        'no_of_people' => $r_t_r['no_of_people'],
                                        'reserve_date' => $r_t_r['reserve_date'],
                                        'reserve_time' => $r_t_r['reserve_time'],
                                        'cancel_date' => $cancel_date,
                                        'additional_note' => $r_t_r['additional_note'],
                                    );
                                }
                            }

                            $reserve_table_data[] = array(
                                'order_of' => "Reserve Table",
                                'order_id' => $r_t_r['reserve_table_id'],
                                'order_total' => 0,
                                'order_date' => $r_t_r['reserve_date'],
                                "order_time" => date('h:i a', strtotime($r_t_r['reserve_time'])),
                                'order_status' => $request_status,
                                'order_status_flag' => $r_t_r['request_status'],
                                'accept_date' => $accept_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => "",
                                'complete_date' => $complete_date,
                                'complete_time' => $complete_date,
                                'otp' => "",
                                'order_description' => $table_facility_details,
                            );
                        }

                    }

                    //complete banquet hall request
                    if ($banquet_hall_request) {
                        foreach ($banquet_hall_request as $b_h_r) {
                            $wh_b_h_c = '(banquet_hall_id = "' . $b_h_r['banquet_hall_id'] . '")';

                            $banquet_hall_order_details = $this->ApiModel->getAllData('banquet_hall', $wh_b_h_c);

                            $banquet_hall_details = array();
                            $request_status = "";
                            $select_date = "";
                            $select_time = "";
                            $request_date = "";
                            $reject_date = "";
                            $request_time = "";
                            $cancel_date = "";
                            $accept_date = "";

                            if ($b_h_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $reject_date = "";
                            } else {
                                if ($b_h_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $reject_date = "";
                                    $accept_date = $b_h_r['accept_date'];
                                } else {
                                    if ($b_h_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $reject_date = $b_h_r['reject_date'];
                                    } else {
                                        if ($b_h_r['request_status'] == 3) {
                                            $request_status = "Cancelled By User";
                                            $cancel_date = $b_h_r['cancel_date'];
                                            $reject_date = "";
                                        } else {
                                            if ($b_h_r['request_status'] == 4) {
                                                $request_status = "Complete Order";
                                                $reject_date = "";
                                                $accept_date = $b_h_r['accept_date'];
                                            }
                                        }
                                    }
                                }
                            }

                            if ($banquet_hall_order_details) {
                                foreach ($banquet_hall_order_details as $b_h_o_d) {
                                    $banquet_hall_details[] = array(
                                        'order_details_id' => $b_h_o_d['banquet_hall_id'],
                                        'order_id' => $b_h_r['banquet_hall_orders_id'],
                                        'service_id' => $b_h_o_d['banquet_hall_id'],
                                        'service_name' => $b_h_o_d['banquet_hall_name'],
                                        'price' => 0,
                                        'total' => 0,
                                        'quantity' => 1,
                                        'no_of_people' => $b_h_o_d['no_of_people'],
                                        'description' => str_replace('&nbsp;', '', strip_tags($b_h_o_d['description'])),
                                        'no_of_people' => $b_h_r['no_of_people'],
                                        'event_date' => $b_h_r['event_date'],
                                        'event_time' => $b_h_r['event_time'],
                                        'cancel_date' => $cancel_date,
                                        'note' => $b_h_r['additional_note'],
                                    );
                                }
                            }

                            $banquet_hall_data[] = array(
                                'order_of' => "Banquet Hall",
                                'order_id' => $b_h_r['banquet_hall_orders_id'],
                                'order_total' => 0,
                                'order_date' => $b_h_r['event_date'],
                                "order_time" => date('h:i a', strtotime($b_h_r['event_time'])),
                                'order_status' => $request_status,
                                'order_status_flag' => $b_h_r['request_status'],
                                'accept_date' => $accept_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => "",
                                'otp' => "",
                                'complete_date' => "",
                                'complete_time' => "",
                                'order_description' => $banquet_hall_details,
                            );
                        }

                    }

                    $complete_orders = array_merge($laudry_data, $food_data, $hk_data, $rs_data, $spa_data, $vehicle_wash_data, $luggage_data, $cab_data, $business_center_data, $reserve_table_data, $banquet_hall_data);
                    /*$complete_orders[] =  $laudry_data;
                    $complete_orders[] =  $food_data;
                    $complete_orders[] =  $hk_data;
                    $complete_orders[] =  $rs_data;
                    // $complete_orders[] =  $rs_menu_data;*/

                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['complete_orders'] = $complete_orders;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //currently stay of user //18-1-2023 //archana
    public function my_currently_hotel_booking_details()
    {
        if (!empty($this->input->post('u_id'))) {
            $u_id = $this->input->post('u_id');
            $user = $this->ApiModel->get_user_data($u_id);
            if ($user) {
                $guest_list = $this->ApiModel->get_hotel_data_before_check_in($u_id);

                if ($guest_list) {
                    foreach ($guest_list as $gl) {

                        $hotel_data = $this->ApiModel->get_hotel_data($gl['hotel_id']);

                        $hotel_name = "";
                        $mobile_no = "";

                        if ($hotel_data) {
                            $hotel_name = $hotel_data['hotel_name'];
                            $mobile_no = $hotel_data['mobile_no'];
                        }

                        $wh = '(hotel_id = "' . $gl['hotel_id'] . '")';

                        $hotel_img = $this->ApiModel->getData('hotel_photos', $wh);

                        $images = "";

                        if ($hotel_img) {
                            $images = $hotel_img['images'];
                        }

                        $wh2 = '(booking_id = "' . $gl['booking_id'] . '")';

                        $room_no_data = $this->ApiModel->getAllData('user_hotel_booking_details', $wh2);
                        // print_r($room_no_data);die;

                        $room_data = array();

                        if ($room_no_data) {
                            foreach ($room_no_data as $r_n_m) {
                                $room_data[] = array(
                                    'room_no' => $r_n_m['room_no']
                                );
                            }
                        }
                        $wh3 = '(u_id = "' . $u_id . '"  AND hotel_id = "' . $gl['hotel_id'] . '" AND booking_id = "' . $gl['booking_id'] . '")';

                        $chek_out_request_data = $this->ApiModel->getData('user_checkout_requests', $wh2);
                        // print_r($chek_out_request_data);die;
                        $check_out_status = '';
                        if ($chek_out_request_data) {

                            $check_out_status = "1";

                        } else {
                            $check_out_status = "0";
                        }


                        $send_data[] = array(
                            'hotel_id' => $gl['hotel_id'],
                            'booking_id' => $gl['booking_id'],
                            'hotel_name' => $hotel_name,
                            'mobile_no' => $mobile_no,
                            'images' => $images,
                            'check_in_date' => $gl['check_in'],
                            'check_out_date' => $gl['check_out'],
                            'total_charges' => $gl['total_charges'],
                            'no_of_guests' => $gl['no_of_guests'],
                            'no_of_rooms' => $gl['no_of_rooms'],
                            'total_adults' => $gl['total_adults'],
                            'total_child' => $gl['total_child'],
                            'room_nos' => $room_data,
                            'check_in_status' => $guest_list[0]['check_in_status'],
                            'check_out_status' => $check_out_status,

                        );


                    }

                    $response['error_code'] = "200";
                    $response['message'] = "Data Found";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Data no found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, user settings//25-1-2023 //archana
    public function my_settings()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('chat_visible_mode')) && !empty($this->input->post('department_notification_mode')) && !empty($this->input->post('offer_notification_mode'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $chat_visible_mode = $this->input->post('chat_visible_mode');
            $department_notification_mode = $this->input->post('department_notification_mode');
            $offer_notification_mode = $this->input->post('offer_notification_mode');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';

                    $arr = array(
                        'chat_visible_mode' => $chat_visible_mode,
                        'is_department_notification' => $department_notification_mode,
                        'is_offer_notification	' => $offer_notification_mode
                    );

                    $up = $this->ApiModel->edit_data('guest_user', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Data Updated Successfully..";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after login guest, after complete order user not statisfy this order then raise dispute the order
    public function raise_dispute_order()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('order_id')) && !empty($this->input->post('order_of')) && !empty($this->input->post('order_total'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $order_id = $this->input->post('order_id');
            $order_of = $this->input->post('order_of');
            $order_total = $this->input->post('order_total');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '" AND order_id = "' . $order_id . '" AND order_of = "' . $order_of . '")';

                    $check_data = $this->ApiModel->getData('user_raise_dispute_order', $wh);

                    if ($check_data) {
                        $response['error_code'] = "401";
                        $response['message'] = "Your Alredy dispute this order";
                        echo json_encode($response);
                        exit();
                    } else {
                        $arr = array(
                            'u_id' => $u_id,
                            'hotel_id' => $hotel_id,
                            'booking_id' => $booking_id,
                            'order_id' => $order_id,
                            'order_of' => $order_of,
                            'order_total' => $order_total
                        );

                        $add = $this->ApiModel->insert_data('user_raise_dispute_order', $arr);

                        if ($add) {
                            $response['error_code'] = "200";
                            $response['message'] = "Success";
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get user settings//30-1-2023 //archana
    public function get_my_settings()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $chat_visible_mode = "Off";
                    $department_notification_mode = "Off";
                    $offer_notification_mode = "Off";

                    if ($guest_user['chat_visible_mode'] == 1) {
                        $chat_visible_mode = "On";
                    }

                    if ($guest_user['is_department_notification'] == 1) {
                        $department_notification_mode = "On";
                    }

                    if ($guest_user['is_offer_notification'] == 1) {
                        $offer_notification_mode = "On";
                    }

                    $send_data[] = array(
                        'chat_visible_mode_flag' => $guest_user['chat_visible_mode'],
                        'chat_visible_mode' => $chat_visible_mode,
                        'department_notification_mode_flag' => $guest_user['is_department_notification'],
                        'department_notification_mode' => $department_notification_mode,
                        'offer_notification_mode_flag' => $guest_user['is_offer_notification'],
                        'offer_notification_mode' => $offer_notification_mode,
                    );


                    $response['error_code'] = "200";
                    $response['message'] = "Success";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }


    //after guest login, user send query to departments//30-1-2023 //archana
    public function send_query_to_department()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('department_id')) && !empty($this->input->post('service_id')) && !empty($this->input->post('services_name')) && !empty($this->input->post('msg'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $department_id = $this->input->post('department_id');
            $service_id = $this->input->post('service_id');
            $services_name = $this->input->post('services_name');
            $msg = $this->input->post('msg');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    if ($department_id == 2) {
                        $msg_to = 1;
                    } else {
                        if ($department_id == 3) {
                            $msg_to = 2;
                        } else {
                            if ($department_id == 4) {
                                $msg_to = 3;
                            } else {
                                if ($department_id == 5) {
                                    $msg_to = 4;
                                }
                            }
                        }
                    }
                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'u_id' => $u_id,
                        'booking_id' => $booking_id,
                        'msg_to' => $msg_to,
                        'department_id' => $department_id,
                        'service_id' => $service_id,
                        'services_name' => $services_name,
                        'sender_id' => $u_id,
                        'receiver_id' => $department_id,
                        'msg' => $msg,
                        'msg_date' => date('Y-m-d'),
                        'msg_time' => date('h:i')
                    );

                    $add = $this->ApiModel->insert_data('user_query_to_department', $arr);

                    if ($add) {
                        $send_data[] = array(
                            'query_id' => $add,
                            'sender_id' => $u_id,
                            'receiver_id' => $department_id,
                            'msg' => $msg,
                            'msg_date_time' => date('Y-m-d h:i a'),
                        );

                        $response['error_code'] = "200";
                        $response['message'] = "Sent Query to department successfully..!";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //after guest login, get user chat list//30-1-2023 //archana
    public function get_my_query_of_departments()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('department_id')) && !empty($this->input->post('service_id')) && !empty($this->input->post('services_name'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $department_id = $this->input->post('department_id');
            $service_id = $this->input->post('service_id');
            $services_name = $this->input->post('services_name');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $user_chat_with_department = $this->ApiModel->get_user_chat_with_department($hotel_id, $u_id, $booking_id, $department_id, $service_id, $services_name);

                    if ($user_chat_with_department) {
                        foreach ($user_chat_with_department as $ucht) {
                            if ($ucht['sender_id'] == $u_id) {
                                $sender_flag = 1;
                                $receiver_flag = 0;
                            } else {
                                $sender_flag = 0;
                                $receiver_flag = 1;
                            }

                            $send_data[] = array(
                                'msg' => $ucht['msg'],
                                'date' => $ucht['msg_date'],
                                'sender_flag' => $sender_flag,
                                'receiver_flag' => $receiver_flag,
                                'msg_time' => date('h:i a', strtotime($ucht['msg_time']))
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Success";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Chat list not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //this api for complete order of staff
    public function staff_verify_otp()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('order_id')) && !empty($this->input->post('otp')) && !empty($this->input->post('flag'))) {
            $u_id = $this->input->post('u_id');
            $order_id = $this->input->post('order_id');
            $otp = $this->input->post('otp');
            $flag = $this->input->post('flag');

            $user_type = '';
            $wh_dept = '(u_id = "' . $u_id . '")';

            $depart_data = $this->ApiModel->getData('register', $wh_dept);

            if (!empty($depart_data)) {
                if ($depart_data['user_type'] == "10") //Room Service
                {
                    $user_type = 10;
                } else {
                    if ($depart_data['user_type'] == "8") //Food & Beverages
                    {
                        $user_type = 8;
                    } else {
                        if ($depart_data['user_type'] == "9") //Housekeeping Service
                        {
                            $user_type = 9;
                        }
                    }
                }
            }

            if ($user_type == 9) {
                //services orders
                if ($flag == 1) {
                    $where = '(h_k_order_id ="' . $order_id . '" AND otp = "' . $otp . '")';

                    $check_otp = $this->ApiModel->getData('house_keeping_orders', $where);

                    if ($check_otp) {
                        $arr = array(
                            'is_otp_verified' => 1,
                            'order_status' => 2,
                            'complete_date' => date('Y-m-d'),
                            'complete_time' => date('H:i:s')
                        );

                        $up = $this->ApiModel->edit_data('house_keeping_orders', $where, $arr);

                        if ($up) {
                            //add checkout bill
                            $wh_hk_c = '(hotel_id = "' . $check_otp['hotel_id'] . '" AND u_id = "' . $check_otp['u_id'] . '" AND booking_id = "' . $check_otp['booking_id'] . '")';

                            $c_o_data = $this->ApiModel->getData('user_checkout_data', $wh_hk_c);

                            $arr_ch_d = array(
                                'total_bill' => $c_o_data['total_bill'] + $check_otp['order_total'],
                            );

                            $add_chk_data = $this->ApiModel->edit_data('user_checkout_data', $wh_hk_c, $arr_ch_d);

                            if ($add_chk_data) {
                                $description_hk = "Housekeeping";

                                $booking_details = $this->ApiModel->get_user_booking_details_1($check_otp['hotel_id'], $check_otp['booking_id']);

                                $date1 = $booking_details['check_in'];
                                $date2 = $booking_details['check_out'];

                                $check_out = $booking_details['check_out'];

                                $check_in = $booking_details['check_in'];

                                $diff = abs(strtotime($date2) - strtotime($date1));

                                $years = floor($diff / (365 * 60 * 60 * 24));
                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                for ($i = 0; $i < $days; $i++) {
                                    $wh_d = '(hotel_id = "' . $check_otp['hotel_id'] . '" AND description = "' . $description_hk . '" AND date = "' . date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days')) . '" AND user_checkout_data_id = "' . $c_o_data['user_checkout_data_id'] . '")';

                                    $chk_o_details = $this->ApiModel->getData('user_checkout_details', $wh_d);

                                    $add_user_checkout_details = "";

                                    if ($chk_o_details) {
                                        if (date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days')) == $check_otp['complete_date']) {
                                            $amount1 = $chk_o_details['amount'] + $check_otp['order_total'];
                                        } else {
                                            $amount1 = 0;
                                        }

                                        $arr_ch_det = array(
                                            'amount' => $amount1,
                                        );

                                        $add_user_checkout_details = $this->ApiModel->edit_data('user_checkout_details', $wh_d, $arr_ch_det);
                                    } else {
                                        if (date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days')) == $check_otp['complete_date']) {
                                            $amount2 = $check_otp['order_total'];
                                        } else {
                                            $amount2 = 0;
                                        }

                                        $arr_ch_det1 = array(
                                            'user_checkout_data_id' => $c_o_data['user_checkout_data_id'],
                                            'hotel_id' => $check_otp['hotel_id'],
                                            'description' => $description_hk,
                                            'date' => date('Y-m-d', strtotime($booking_details['check_in'] . '+' . $i . 'days')),
                                            'amount' => $amount2
                                        );

                                        $add_user_checkout_details = $this->ApiModel->insert_data('user_checkout_details', $arr_ch_det1);
                                    }
                                }

                                if ($add_user_checkout_details) {
                                    $wh12 = '(hotel_id = "' . $check_otp['hotel_id'] . '" AND user_checkout_data_id = "' . $c_o_data['user_checkout_data_id'] . '" AND description_name = "' . $description_hk . '")';

                                    $user_checkout_sub_total1 = $this->ApiModel->getData('user_checkout_sub_total', $wh12);

                                    //add subtotal
                                    if ($user_checkout_sub_total1) {
                                        $st_arr12 = array(
                                            'sub_total' => $user_checkout_sub_total1['sub_total'] + $check_otp['order_total']
                                        );

                                        $this->ApiModel->edit_data('user_checkout_sub_total', $wh12, $st_arr12);
                                    } else {
                                        //edit subtotal
                                        $st_arr22 = array(
                                            'hotel_id' => $check_otp['hotel_id'],
                                            'user_checkout_data_id' => $c_o_data['user_checkout_data_id'],
                                            'description_name' => $description_hk,
                                            'sub_total' => $check_otp['order_total']
                                        );

                                        $this->ApiModel->insert_data('user_checkout_sub_total', $st_arr22);
                                    }
                                }

                            }

                            //add notification
                            $arr = array(
                                'u_id' => $u_id,
                                'hotel_id' => $depart_data['hotel_id'],
                                'subject' => 'Order Completed',
                                'description' => 'Your Order is completed successfully',
                                'notification_order_flag' => 0,
                            );

                            $add = $this->ApiModel->insert_data('staff_notification', $arr);

                            $response['error_code'] = "200";
                            $response['message'] = "You have successfully completed Order..";
                            //$response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "OTP Doest not match";
                        echo json_encode($response);
                        exit();
                    }
                } elseif ($flag == 2) {
                    //laundry orders
                    $where_c_ord = '(cloth_order_id ="' . $order_id . '" AND otp = "' . $otp . '")';

                    $check_otp_cloth = $this->ApiModel->getData('cloth_orders', $where_c_ord);

                    if ($check_otp_cloth) {
                        $arr = array(
                            'is_otp_verified' => 1,
                            'order_status' => 2,
                            'complete_date' => date('Y-m-d'),
                            'complete_time' => date('H:i:s')
                        );

                        $up = $this->ApiModel->edit_data('cloth_orders', $where_c_ord, $arr);

                        if ($up) {
                            //add checkout bill
                            $wh_ld_c = '(hotel_id = "' . $check_otp_cloth['hotel_id'] . '" AND u_id = "' . $check_otp_cloth['u_id'] . '" AND booking_id = "' . $check_otp_cloth['booking_id'] . '")';

                            $ld_c_o_data = $this->ApiModel->getData('user_checkout_data', $wh_ld_c);

                            $arr_ch_d_ld = array(
                                'total_bill' => $ld_c_o_data['total_bill'] + $check_otp_cloth['order_total'],
                            );

                            $add_chk_data_ld = $this->ApiModel->edit_data('user_checkout_data', $wh_ld_c, $arr_ch_d_ld);

                            if ($add_chk_data_ld) {
                                $description_ld = "Laundry";

                                $booking_details_1 = $this->ApiModel->get_user_booking_details_1($check_otp_cloth['hotel_id'], $check_otp_cloth['booking_id']);

                                $date11 = $booking_details_1['check_in'];
                                $date21 = $booking_details_1['check_out'];

                                $check_out_1 = $booking_details_1['check_out'];

                                $check_in_1 = $booking_details_1['check_in'];

                                $diff_1 = abs(strtotime($date21) - strtotime($date11));

                                $years_1 = floor($diff_1 / (365 * 60 * 60 * 24));
                                $months_1 = floor(($diff_1 - $years_1 * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                $days_1 = floor(($diff_1 - $years_1 * 365 * 60 * 60 * 24 - $months_1 * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                $days_1 = floor(($diff_1 - $years_1 * 365 * 60 * 60 * 24 - $months_1 * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                for ($j = 0; $j < $days_1; $j++) {
                                    $wh_d1 = '(hotel_id = "' . $check_otp_cloth['hotel_id'] . '" AND description = "' . $description_ld . '" AND date = "' . date('Y-m-d', strtotime($booking_details_1['check_in'] . '+' . $j . 'days')) . '" AND user_checkout_data_id = "' . $ld_c_o_data['user_checkout_data_id'] . '")';

                                    $chk_o_details1 = $this->ApiModel->getData('user_checkout_details', $wh_d1);

                                    $add_user_checkout_details1 = "";

                                    if ($chk_o_details1) {
                                        if (date('Y-m-d', strtotime($booking_details_1['check_in'] . '+' . $j . 'days')) == $check_otp_cloth['complete_date']) {
                                            $amount1_ld = $chk_o_details1['amount'] + $check_otp_cloth['order_total'];
                                        } else {
                                            $amount1_ld = 0;
                                        }

                                        $arr_ch_det_ld = array(
                                            'amount' => $amount1_ld,
                                        );

                                        $add_user_checkout_details1 = $this->ApiModel->edit_data('user_checkout_details', $wh_d1, $arr_ch_det_ld);
                                    } else {
                                        if (date('Y-m-d', strtotime($booking_details_1['check_in'] . '+' . $j . 'days')) == $check_otp_cloth['complete_date']) {
                                            $amount2_ld = $check_otp_cloth['order_total'];
                                        } else {
                                            $amount2_ld = 0;
                                        }

                                        $arr_ch_det1_ld = array(
                                            'user_checkout_data_id' => $ld_c_o_data['user_checkout_data_id'],
                                            'hotel_id' => $check_otp_cloth['hotel_id'],
                                            'description' => $description_ld,
                                            'date' => date('Y-m-d', strtotime($booking_details_1['check_in'] . '+' . $j . 'days')),
                                            'amount' => $amount2_ld
                                        );

                                        $add_user_checkout_details1 = $this->ApiModel->insert_data('user_checkout_details', $arr_ch_det1_ld);
                                    }
                                }

                                if ($add_user_checkout_details1) {
                                    $wh12_ld = '(hotel_id = "' . $check_otp_cloth['hotel_id'] . '" AND user_checkout_data_id = "' . $ld_c_o_data['user_checkout_data_id'] . '" AND description_name = "' . $description_ld . '")';

                                    $user_checkout_sub_total1_ld = $this->ApiModel->getData('user_checkout_sub_total', $wh12_ld);

                                    //add subtotal
                                    if ($user_checkout_sub_total1_ld) {
                                        $st_arr12_ld = array(
                                            'sub_total' => $user_checkout_sub_total1_ld['sub_total'] + $check_otp_cloth['order_total']
                                        );

                                        $this->ApiModel->edit_data('user_checkout_sub_total', $wh12_ld, $st_arr12_ld);
                                    } else {
                                        //edit subtotal
                                        $st_arr22_ld = array(
                                            'hotel_id' => $check_otp_cloth['hotel_id'],
                                            'user_checkout_data_id' => $ld_c_o_data['user_checkout_data_id'],
                                            'description_name' => $description_ld,
                                            'sub_total' => $check_otp_cloth['order_total']
                                        );

                                        $this->ApiModel->insert_data('user_checkout_sub_total', $st_arr22_ld);
                                    }
                                }
                            }

                            //add notification
                            $arr = array(
                                'u_id' => $u_id,
                                'hotel_id' => $depart_data['hotel_id'],
                                'subject' => 'Order Completed',
                                'description' => 'Your Order is completed successfully',
                                'notification_order_flag' => 0,
                            );

                            $add = $this->ApiModel->insert_data('staff_notification', $arr);


                            $response['error_code'] = "200";
                            $response['message'] = "You have successfully completed Order..";
                            //$response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "OTP Doest not match";
                        echo json_encode($response);
                        exit();
                    }
                }
            } elseif ($user_type == 8) {
                $where_food = '(food_order_id ="' . $order_id . '" AND otp = "' . $otp . '")';

                $check_otp_food_ord = $this->ApiModel->getData('food_orders', $where_food);

                if ($check_otp_food_ord) {
                    $arr = array(
                        'is_otp_verified' => 1,
                        'order_status' => 2,
                        'complete_date' => date('Y-m-d'),
                        'complete_time' => date('H:i:s')
                    );

                    $up = $this->ApiModel->edit_data('food_orders', $where_food, $arr);

                    if ($up) {
                        //add checkout bill 
                        $wh_fd_c = '(hotel_id = "' . $check_otp_food_ord['hotel_id'] . '" AND u_id = "' . $check_otp_food_ord['u_id'] . '" AND booking_id = "' . $check_otp_food_ord['booking_id'] . '")';

                        $fd_c_o_data = $this->ApiModel->getData('user_checkout_data', $wh_fd_c);

                        $arr_ch_d_fd = array(
                            'total_bill' => $fd_c_o_data['total_bill'] + $check_otp_food_ord['order_total'],
                        );

                        $add_chk_data_fd = $this->ApiModel->edit_data('user_checkout_data', $wh_fd_c, $arr_ch_d_fd);

                        if ($add_chk_data_fd) {
                            $description_fd = "Bar And Restaurant";

                            $booking_details_2 = $this->ApiModel->get_user_booking_details_1($check_otp_food_ord['hotel_id'], $check_otp_food_ord['booking_id']);

                            $date12 = $booking_details_2['check_in'];
                            $date22 = $booking_details_2['check_out'];

                            $check_out_2 = $booking_details_2['check_out'];

                            $check_in_2 = $booking_details_2['check_in'];

                            $diff_2 = abs(strtotime($date22) - strtotime($date12));

                            $years_2 = floor($diff_2 / (365 * 60 * 60 * 24));
                            $months_2 = floor(($diff_2 - $years_2 * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                            $days_2 = floor(($diff_2 - $years_2 * 365 * 60 * 60 * 24 - $months_2 * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                            $days_2 = floor(($diff_2 - $years_2 * 365 * 60 * 60 * 24 - $months_2 * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                            for ($k = 0; $k < $days_2; $k++) {
                                $wh_d2 = '(hotel_id = "' . $check_otp_food_ord['hotel_id'] . '" AND description = "' . $description_fd . '" AND date = "' . date('Y-m-d', strtotime($booking_details_2['check_in'] . '+' . $k . 'days')) . '" AND user_checkout_data_id = "' . $fd_c_o_data['user_checkout_data_id'] . '")';

                                $chk_o_details2 = $this->ApiModel->getData('user_checkout_details', $wh_d2);

                                $add_user_checkout_details2 = "";

                                if ($chk_o_details2) {
                                    if (date('Y-m-d', strtotime($booking_details_2['check_in'] . '+' . $k . 'days')) == date('Y-m-d')) {
                                        $amount1_fd = $chk_o_details2['amount'] + $check_otp_food_ord['order_total'];
                                    } else {
                                        $amount1_fd = 0;
                                    }

                                    $arr_ch_det_fd = array(
                                        'amount' => $amount1_fd,
                                    );

                                    $add_user_checkout_details2 = $this->ApiModel->edit_data('user_checkout_details', $wh_d2, $arr_ch_det_fd);
                                } else {
                                    if (date('Y-m-d', strtotime($booking_details_2['check_in'] . '+' . $k . 'days')) == date('Y-m-d')) {
                                        $amount2_fd = $check_otp_food_ord['order_total'];
                                    } else {
                                        $amount2_fd = 0;
                                    }

                                    $arr_ch_det1_fd = array(
                                        'user_checkout_data_id' => $fd_c_o_data['user_checkout_data_id'],
                                        'hotel_id' => $check_otp_food_ord['hotel_id'],
                                        'description' => $description_fd,
                                        'date' => date('Y-m-d', strtotime($booking_details_2['check_in'] . '+' . $k . 'days')),
                                        'amount' => $amount2_fd
                                    );

                                    $add_user_checkout_details2 = $this->ApiModel->insert_data('user_checkout_details', $arr_ch_det1_fd);
                                }
                            }

                            if ($add_user_checkout_details2) {
                                $wh12_fd = '(hotel_id = "' . $check_otp_food_ord['hotel_id'] . '" AND user_checkout_data_id = "' . $fd_c_o_data['user_checkout_data_id'] . '" AND description_name = "' . $description_fd . '")';

                                $user_checkout_sub_total1_fd = $this->ApiModel->getData('user_checkout_sub_total', $wh12_fd);

                                //add subtotal
                                if ($user_checkout_sub_total1_fd) {
                                    $st_arr12_fd = array(
                                        'sub_total' => $user_checkout_sub_total1_fd['sub_total'] + $check_otp_food_ord['order_total']
                                    );

                                    $this->ApiModel->edit_data('user_checkout_sub_total', $wh12_fd, $st_arr12_fd);
                                } else {
                                    //edit subtotal
                                    $st_arr22_fd = array(
                                        'hotel_id' => $check_otp_food_ord['hotel_id'],
                                        'user_checkout_data_id' => $fd_c_o_data['user_checkout_data_id'],
                                        'description_name' => $description_fd,
                                        'sub_total' => $check_otp_food_ord['order_total']
                                    );

                                    $this->ApiModel->insert_data('user_checkout_sub_total', $st_arr22_fd);
                                }
                            }
                        }

                        //add notification
                        $arr = array(
                            'u_id' => $u_id,
                            'hotel_id' => $depart_data['hotel_id'],
                            'subject' => 'Order Completed',
                            'description' => 'Your Order is completed successfully',
                            'notification_order_flag' => 0,
                        );

                        $add = $this->ApiModel->insert_data('staff_notification', $arr);

                        $response['error_code'] = "200";
                        $response['message'] = "You have successfully completed Order..";
                        //$response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "401";
                    $response['message'] = "OTP Doest not match";
                    echo json_encode($response);
                    exit();
                }
            } elseif ($user_type == 10) {
                if ($flag == 1) {
                    $where = '(room_service_menu_order_id ="' . $order_id . '" AND otp = "' . $otp . '")';

                    $check_rs_menu_otp = $this->ApiModel->getData('room_service_menu_orders', $where);

                    if ($check_rs_menu_otp) {
                        $arr = array(
                            'is_otp_verified' => 1,
                            'order_status' => 2,
                            'complete_date' => date('Y-m-d'),
                            'complete_time' => date('H:i:s')
                        );

                        //$where1 = '(h_k_order_id ="'.$order_id.'")';
                        $up = $this->ApiModel->edit_data('room_service_menu_orders', $where, $arr);

                        if ($up) {
                            //add checkout bill 
                            $wh_rs_m_c = '(hotel_id = "' . $check_rs_menu_otp['hotel_id'] . '" AND u_id = "' . $check_rs_menu_otp['u_id'] . '" AND booking_id = "' . $check_rs_menu_otp['booking_id'] . '")';

                            $rsm_c_o_data = $this->ApiModel->getData('user_checkout_data', $wh_rs_m_c);

                            $arr_ch_d_rsm = array(
                                'total_bill' => $rsm_c_o_data['total_bill'] + $check_rs_menu_otp['order_total'],
                            );

                            $add_chk_data_rsm = $this->ApiModel->edit_data('user_checkout_data', $wh_rs_m_c, $arr_ch_d_rsm);

                            if ($add_chk_data_rsm) {
                                $description_rsm = "Room Service Menu";

                                $booking_details_3 = $this->ApiModel->get_user_booking_details_1($check_rs_menu_otp['hotel_id'], $check_rs_menu_otp['booking_id']);

                                $date13 = $booking_details_3['check_in'];
                                $date23 = $booking_details_3['check_out'];

                                $check_out_3 = $booking_details_3['check_out'];

                                $check_in_3 = $booking_details_3['check_in'];

                                $diff_3 = abs(strtotime($date23) - strtotime($date13));

                                $years_3 = floor($diff_3 / (365 * 60 * 60 * 24));
                                $months_3 = floor(($diff_3 - $years_3 * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                $days_3 = floor(($diff_3 - $years_3 * 365 * 60 * 60 * 24 - $months_3 * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                $days_3 = floor(($diff_3 - $years_3 * 365 * 60 * 60 * 24 - $months_3 * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                for ($l = 0; $l < $days_3; $l++) {
                                    $wh_d3 = '(hotel_id = "' . $check_rs_menu_otp['hotel_id'] . '" AND description = "' . $description_rsm . '" AND date = "' . date('Y-m-d', strtotime($booking_details_3['check_in'] . '+' . $l . 'days')) . '" AND user_checkout_data_id = "' . $rsm_c_o_data['user_checkout_data_id'] . '")';

                                    $chk_o_details3 = $this->ApiModel->getData('user_checkout_details', $wh_d3);

                                    $add_user_checkout_details3 = "";

                                    if ($chk_o_details3) {
                                        if (date('Y-m-d', strtotime($booking_details_3['check_in'] . '+' . $l . 'days')) == $check_rs_menu_otp['complete_date']) {
                                            $amount1_rsm = $chk_o_details3['amount'] + $check_rs_menu_otp['main_total'];
                                        } else {
                                            $amount1_rsm = 0;
                                        }

                                        $arr_ch_det_rsm = array(
                                            'amount' => $amount1_rsm,
                                        );

                                        $add_user_checkout_details3 = $this->ApiModel->edit_data('user_checkout_details', $wh_d3, $arr_ch_det_rsm);
                                    } else {
                                        if (date('Y-m-d', strtotime($booking_details_3['check_in'] . '+' . $l . 'days')) == $check_rs_menu_otp['complete_date']) {
                                            $amount2_rsm = $check_rs_menu_otp['main_total'];
                                        } else {
                                            $amount2_rsm = 0;
                                        }

                                        $arr_ch_det1_rsm = array(
                                            'user_checkout_data_id' => $rsm_c_o_data['user_checkout_data_id'],
                                            'hotel_id' => $check_rs_menu_otp['hotel_id'],
                                            'description' => $description_rsm,
                                            'date' => date('Y-m-d', strtotime($booking_details_3['check_in'] . '+' . $l . 'days')),
                                            'amount' => $amount2_rsm
                                        );

                                        $add_user_checkout_details3 = $this->ApiModel->insert_data('user_checkout_details', $arr_ch_det1_rsm);
                                    }
                                }

                                if ($add_user_checkout_details3) {
                                    $wh12_rsm = '(hotel_id = "' . $check_rs_menu_otp['hotel_id'] . '" AND user_checkout_data_id = "' . $rsm_c_o_data['user_checkout_data_id'] . '" AND description_name = "' . $description_rsm . '")';

                                    $user_checkout_sub_total1_rsm = $this->ApiModel->getData('user_checkout_sub_total', $wh12_rsm);

                                    //add subtotal
                                    if ($user_checkout_sub_total1_rsm) {
                                        $st_arr12_rsm = array(
                                            'sub_total' => $user_checkout_sub_total1_rsm['sub_total'] + $check_rs_menu_otp['order_total']
                                        );

                                        $this->ApiModel->edit_data('user_checkout_sub_total', $wh12_rsm, $st_arr12_rsm);
                                    } else {
                                        //edit subtotal
                                        $st_arr22_rsm = array(
                                            'hotel_id' => $check_rs_menu_otp['hotel_id'],
                                            'user_checkout_data_id' => $rsm_c_o_data['user_checkout_data_id'],
                                            'description_name' => $description_rsm,
                                            'sub_total' => $check_rs_menu_otp['order_total']
                                        );

                                        $this->ApiModel->insert_data('user_checkout_sub_total', $st_arr22_rsm);
                                    }
                                }
                            }

                            //add notification
                            $arr = array(
                                'u_id' => $u_id,
                                'hotel_id' => $depart_data['hotel_id'],
                                'subject' => 'Order Completed',
                                'description' => 'Your Order is completed successfully',
                                'notification_order_flag' => 0,
                            );

                            $add = $this->ApiModel->insert_data('staff_notification', $arr);

                            $response['error_code'] = "200";
                            $response['message'] = "You have successfully completed Order..";
                            //$response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "OTP Doest not match";
                        echo json_encode($response);
                        exit();
                    }
                } elseif ($flag == 2) {
                    //laundry orders
                    $where_c_ord = '(rmservice_services_order_id ="' . $order_id . '" AND otp = "' . $otp . '")';

                    $check_otp_cloth = $this->ApiModel->getData('rmservice_services_orders', $where_c_ord);

                    if ($check_otp_cloth) {
                        $arr = array(
                            'is_otp_verified' => 1,
                            'order_status' => 2,
                            'complete_date' => date('Y-m-d'),
                            'complete_time' => date('H:i:s')
                        );

                        $up = $this->ApiModel->edit_data('rmservice_services_orders', $where_c_ord, $arr);

                        if ($up) {

                            //add notification
                            $arr = array(
                                'u_id' => $u_id,
                                'hotel_id' => $depart_data['hotel_id'],
                                'subject' => 'Order Completed',
                                'description' => 'Your Order is completed successfully',
                                'notification_order_flag' => 0,
                            );

                            $add = $this->ApiModel->insert_data('staff_notification', $arr);


                            $response['error_code'] = "200";
                            $response['message'] = "You have successfully completed Order..";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "OTP Doest not match";
                        echo json_encode($response);
                        exit();
                    }
                }
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }


    // api for make house keeping order completed
    public function complete_order_for_housekeeping_services()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('h_k_order_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $h_k_order_id = $this->input->post('h_k_order_id');
            $booking_id = $this->input->post('booking_id');
            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);
                if ($guest_user) {
                    $wh = '(h_k_order_id = "' . $h_k_order_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $order_details = $this->ApiModel->getData('house_keeping_orders', $wh);

                    if ($order_details) {

                        if ($order_details['order_status'] == "0") //new order
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Can't Make It Complete Before Order Placed...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['order_status'] == "2") //order completed
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Already Completed By Admin...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['order_status'] == "3") //order Rejected
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Order is Rejected...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['order_status'] == "4") //cancelled by user
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Cancelled This Order...!";
                            echo json_encode($response);
                            exit();
                        } else {
                            $arr = array(
                                'order_status' => 2,
                                'complete_date' => date('Y-m-d'),
                            );

                            $add = $this->ApiModel->edit_data('house_keeping_orders', $wh, $arr);

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Order Completed successfully...!";
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }

                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }


    // api for make Food & Beverages order completed
    public function complete_order_for_food_services()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('food_order_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $food_order_id = $this->input->post('food_order_id');
            $booking_id = $this->input->post('booking_id');
            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);
                if ($guest_user) {
                    $wh = '(food_order_id = "' . $food_order_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $order_details = $this->ApiModel->getData('food_orders', $wh);

                    if ($order_details) {

                        if ($order_details['order_status'] == "0") //new order
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Can't Make It Complete Before Order Placed...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['order_status'] == "2") //order completed
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Already Completed By Admin...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['order_status'] == "3") //order Rejected
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Order is Rejected...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['order_status'] == "4") //cancelled by user
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Cancelled This Order...!";
                            echo json_encode($response);
                            exit();
                        } else {
                            $arr = array(
                                'order_status' => 2,
                                'complete_date' => date('Y-m-d'),
                            );

                            $add = $this->ApiModel->edit_data('food_orders', $wh, $arr);

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Order Completed successfully...!";
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }

                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // api for make Food & Beverages order completed
    public function complete_order_for_laundry_services()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('cloth_order_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $cloth_order_id = $this->input->post('cloth_order_id');
            $booking_id = $this->input->post('booking_id');
            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(cloth_order_id = "' . $cloth_order_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $order_details = $this->ApiModel->getData('cloth_orders', $wh);

                    if ($order_details) {

                        if ($order_details['order_status'] == "0") //new order
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Can't Make It Complete Before Order Placed...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['order_status'] == "2") //order completed
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Already Completed By Admin...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['order_status'] == "3") //order Rejected
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Order is Rejected...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['order_status'] == "4") //cancelled by user
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Cancelled This Order...!";
                            echo json_encode($response);
                            exit();
                        } else {
                            $arr = array(
                                'order_status' => 2,
                                'complete_date' => date('Y-m-d'),
                            );

                            $add = $this->ApiModel->edit_data('cloth_orders', $wh, $arr);

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Order Completed successfully...!";
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }

                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }
    // spa type and insert spa request
    public function spa_types()//hemali
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $get_spa_type = $this->ApiModel->get_spa_type($hotel_id);

                    if ($get_spa_type) {
                        foreach ($get_spa_type as $v_ch) {
                            $send_data[] = array(
                                'spa_type' => $v_ch['front_ofs_spa_service_images_id'],
                                'spa_type_name' => $v_ch['spa_type'],
                                'charges' => $v_ch['spa_price'],
                                'spa_photo' => $v_ch['spa_photo'],
                                'spa_description' => strip_tags(str_replace('&nbsp;', '', $v_ch['spa_description'])),
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }
    public function sent_request_to_spa() // hemali
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('spa_type')) && !empty($this->input->post('select_date')) && !empty($this->input->post('select_time'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $spa_type = $this->input->post('spa_type');
            $select_date = $this->input->post('select_date');
            $select_time = $this->input->post('select_time');
            $additional_note = $this->input->post('additional_note');


            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                $wh = '(front_ofs_spa_service_images_id = "' . $spa_type . '")';

                $spa_charges = $this->ApiModel->getData('front_ofs_spa_service_images', $wh);

                if ($spa_charges) {
                    $charges = $spa_charges['spa_price'];
                }

                if ($guest_user) {

                    $arr = array(
                        'hotel_id' => $hotel_id,
                        'booking_id' => $booking_id,
                        'mobile_no' => $guest_user['login_id'],
                        'u_id' => $u_id,
                        'spa_type' => $spa_type,
                        'note' => $additional_note,
                        'charges' => $charges,
                        'select_date' => $select_date,
                        'select_time' => $select_time,
                        'note' => $additional_note,
                        'request_date' => date('Y-m-d'),
                        'request_time' => date('H:i A'),
                    );

                    $add = $this->ApiModel->insert_data('spa_service_request_list', $arr);

                    if ($add) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been placed successfully";
                        $response['data'] = $arr;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    public function cancel_spa_request()//hemali
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('spa_service_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $spa_service_request_id = $this->input->post('spa_service_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(spa_service_request_id = "' . $spa_service_request_id . '")';

                    $arr = array(
                        'request_status' => 3,
                        'cancel_date' => date('Y-m-d')
                    );

                    $up = $this->ApiModel->edit_data('spa_service_request_list', $wh, $arr);

                    if ($up) {
                        $response['error_code'] = "200";
                        $response['message'] = "Your request has been cancelled";
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //spa request my data
    public function get_my_spa_request_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    // $spa_request = $this->ApiModel->get_user_spa_request($hotel_id,$u_id,$booking_id);
                    // $spaTypes = array();
                    // // print_r($spa_request);exit;
                    // foreach($spa_request as $v_ch)
                    // {
                    //                     $spa_type1 =  $v_ch['spa_type'];
                    //                     $spaTypes[] = $spa_type1;

                    // }
                    // $spaTypesname = array();
                    // foreach($spaTypes as $abc)
                    // {
                    // $wh4 = '("'.$u_id.'" AND "'.$hotel_id.'")';
                    $spa_request = $this->ApiModel->get_user_spa_type($u_id, $hotel_id);
                    //     $spaTypesname[] = $spa_type_name1['spa_type'];  
                    // }

                    // print_r($spa_request);exit;

                    // $wh = $spa_type1;

                    // $spa_type_name1 = $this->ApiModel->get_user_spa_type($hotel_id,$wh);
                    // $A= $spa_type_name1[0]['spa_type'];
                    //  print_r($A);exit;
                    // foreach($spa_type_name1 as $v_ch1)
                    // {
                    //                     $spa_type_name =  $v_ch1['spa_type'];

                    // }

                    // print_r($spa_request);exit;
                    if ($spa_request) {
                        foreach ($spa_request as $u_v_r) {
                            $request_status = "";
                            $request_date = "";
                            $reject_date = "";
                            $cancel_date = "";
                            $accept_date = "";
                            $complete_date = "";

                            if ($u_v_r['request_status'] == 0) {
                                $request_status = "New Order";
                                $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                $accept_date = "";
                                $reject_date = "";
                                $cancel_date = "";
                                $complete_date = "";
                            } else {
                                if ($u_v_r['request_status'] == 1) {
                                    $request_status = "Accept Order";
                                    $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                    $accept_date = date('d-m-Y', strtotime($u_v_r['accept_date']));
                                    $reject_date = "";
                                    $cancel_date = "";
                                    $complete_date = "";
                                } else {
                                    if ($u_v_r['request_status'] == 2) {
                                        $request_status = "Reject Order";
                                        $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                        $reject_date = date('d-m-Y', strtotime($u_v_r['reject_date']));
                                        $cancel_date = "";
                                        $accept_date = "";
                                        $complete_date = "";
                                    } else {
                                        if ($u_v_r['request_status'] == 3) {
                                            $request_status = "Cancel Order";
                                            $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                            $reject_date = "";
                                            $accept_date = "";
                                            $cancel_date = date('d-m-Y', strtotime($u_v_r['cancel_date']));
                                            $complete_date = "";
                                        } else {
                                            if ($u_v_r['request_status'] == 4) {
                                                $request_status = "Completed Order";
                                                $request_date = date('d-m-Y', strtotime($u_v_r['select_date']));
                                                $reject_date = "";
                                                $accept_date = "";
                                                $cancel_date = "";
                                                $complete_date = date('d-m-Y', strtotime($u_v_r['complete_date']));
                                            }
                                        }
                                    }
                                }
                            }
                            $reject_reason = "";
                            if ($u_v_r['reject_reason'] == 1) {
                                $reject_reason = "Please Try After Sometime";
                            } else if ($u_v_r['reject_reason'] == 2) {
                                $reject_reason = "Temporarily Unavailable";
                            } else if ($u_v_r['reject_reason'] == 3) {
                                $reject_reason = "Slots Not Available";
                            } else if ($u_v_r['reject_reason'] == 4) {
                                $reject_reason = "Please contact Front office";
                            }
                            $send_data[] = array(
                                'spa_service_request_id' => $u_v_r['spa_service_request_id'],
                                'hotel_id' => $u_v_r['hotel_id'],
                                'booking_id' => $u_v_r['booking_id'],
                                'spa_type' => $u_v_r['spa_type'],
                                'charges' => $u_v_r['charges'],
                                'note' => strip_tags($u_v_r['note']),
                                'request_status' => $request_status,
                                'request_status_flag' => $u_v_r['request_status'],
                                'request_date' => $request_date,
                                'reject_date' => $reject_date,
                                'reject_reason' => $reject_reason,
                                'cancel_date' => $cancel_date,
                                'accept_date' => $accept_date,
                                'complete_date' => $complete_date,
                                'select_date' => date('d-m-Y', strtotime($u_v_r['request_date'])),
                                'select_time' => date('h:i a', strtotime($u_v_r['request_time']))
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // edit food order 
    public function edit_food_order()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_data')) && !empty($this->input->post('order_total')) && !empty($this->input->post('food_order_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $order_total = $this->input->post('order_total');
            $food_order_id = $this->input->post('food_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(food_order_id = "' . $food_order_id . '" AND order_status = 0)';
                    $check_status = $this->ApiModel->getData('food_orders', $wh);

                    if ($check_status) {
                        $arr = array(
                            'order_total' => $order_total,
                        );

                        $wh = '(food_order_id = "' . $food_order_id . '" AND order_status = 0)';
                        $add = $this->ApiModel->edit_data('food_orders', $wh, $arr);
                        // print_r($add);die;
                        if ($add) {
                            $food_data = json_decode($this->input->post('food_data'), TRUE);
                            // print_r($food_data);die;

                            if (is_array($food_data)) {
                                $wh4 = '(food_order_id = "' . $food_order_id . '")';
                                $this->ApiModel->delete_data('food_order_details', $wh4);
                                // die;

                                if (!isset($food_data[0])) {
                                    $food_data = array($food_data);
                                }

                                foreach ($food_data as $fd) {
                                    $arr1 = array(
                                        'food_order_id' => $food_order_id,
                                        'hotel_id' => $hotel_id,
                                        'food_items_id' => $fd['food_items_id'],
                                        'price' => $fd['price'],
                                        'quantity' => $fd['quantity'],
                                        'total' => $fd['price'] * $fd['quantity'],
                                    );

                                    $add_detail = $this->ApiModel->insert_data('food_order_details', $arr1);
                                    // print_r($add_detail);die;

                                    if ($add_detail) {
                                        $wh1 = '(food_item_id = "' . $fd['food_items_id'] . '")';
                                        $food_menu = $this->ApiModel->getData('food_menus', $wh1);

                                        if ($food_menu && isset($food_menu['time_in'])) {
                                            if ($food_menu['time_in'] == 1) {
                                                $time_in = "Minute";
                                                $preparation_time = $food_menu['prepartion_time'];
                                            } elseif ($food_menu['time_in'] == 2) {
                                                $time_in = "Hrs";
                                                $preparation_time1 = $food_menu['prepartion_time'];
                                                $preparation_time = $preparation_time1 * 60;
                                            }

                                            $current_time = date('h:i');
                                            $time = strtotime($current_time);
                                            $delivery_time = date("h:i", strtotime('+' . $preparation_time . ' minutes', $time));

                                            $wh_d = '(food_order_id = "' . $food_order_id . '")';
                                            $arrdel_time = array(
                                                'delivery_time' => $delivery_time,
                                            );

                                            $this->ApiModel->edit_data('food_orders', $wh_d, $arrdel_time);
                                        }
                                    }

                                }
                                if ($add && $add_detail) {

                                    $wh_d = '(food_order_id = "' . $food_order_id . '")';

                                    $food_orders = $this->ApiModel->getData('food_orders', $wh_d);

                                    $send_data[] = array(
                                        'food_order_id' => $food_order_id,
                                        'food_items_id' => $fd['food_items_id'],
                                        'price' => $fd['price'],
                                        'quantity' => $fd['quantity'],
                                        'approximately_delivery_time' => date('h:i A', strtotime($food_orders['delivery_time']))
                                    );


                                    $response['error_code'] = "200";
                                    $response['message'] = "Your order is Edited Successfully...";
                                    $response['data'] = $send_data;
                                    echo json_encode($response);
                                    exit();
                                }
                            }
                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Sorry Your Order is Accepted, You Can't Edit Order...!";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //  edit laundry order
    public function edit_laundry_order()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('laundry_data')) && !empty($this->input->post('order_total')) && !empty($this->input->post('cloth_order_id'))) {
            // $a=$this->input->post();
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $order_total = $this->input->post('order_total');
            $cloth_order_id = $this->input->post('cloth_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(cloth_order_id = "' . $cloth_order_id . '" AND order_status = 0)';
                    $check_status = $this->ApiModel->getData('cloth_orders', $wh);

                    if ($check_status) {

                        $arr = array(
                            'order_total' => $order_total,
                        );

                        $wh = '(cloth_order_id = "' . $cloth_order_id . '" AND order_status = 0)';
                        $add = $this->ApiModel->edit_data('cloth_orders', $wh, $arr);

                        if ($add) {
                            $laundry_data = json_decode($this->input->post('laundry_data'), TRUE);

                            if (is_array($laundry_data)) {
                                $wh4 = '(cloth_order_id = "' . $cloth_order_id . '")';
                                $this->ApiModel->delete_data('cloth_order_details', $wh4);


                                if (!isset($laundry_data[0])) {
                                    $laundry_data = array($laundry_data);
                                }

                                foreach ($laundry_data as $fd) {
                                    $arr1 = array(
                                        'cloth_order_id' => $cloth_order_id,
                                        'hotel_id' => $hotel_id,
                                        'cloth_id' => $fd['cloth_id'],
                                        'price' => $fd['price'],
                                        'quantity' => $fd['quantity'],
                                    );

                                    $add_detail = $this->ApiModel->insert_data('cloth_order_details', $arr1);
                                    // print_r($add_detail);die;
                                }
                                if ($add && $add_detail) {
                                    $response['error_code'] = "200";
                                    $response['message'] = "Your order is Edited Successfully...";
                                    echo json_encode($response);
                                    exit();
                                }
                            }
                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Sorry Your Order is Accepted, You Can't Edit Order...!";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //  edit reserv request
    public function edit_reserve_table_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('food_facility_id')) && !empty($this->input->post('reserve_date')) && !empty($this->input->post('reserve_time')) && !empty($this->input->post('no_of_people')) && !empty($this->input->post('reserve_table_id'))) {
            // $a=$this->input->post();
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $food_facility_id = $this->input->post('food_facility_id');
            $reserve_date = $this->input->post('reserve_date');
            $reserve_time = $this->input->post('reserve_time');
            $no_of_people = $this->input->post('no_of_people');
            $reserve_table_id = $this->input->post('reserve_table_id');
            $additional_note = $this->input->post('additional_note');


            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                //    print_r($booking_id);
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(reserve_table_id = "' . $reserve_table_id . '" AND request_status = 0)';
                    $check_status = $this->ApiModel->getData('reserve_table', $wh);

                    if ($check_status) {

                        $arr = array(
                            'food_facility_id' => $food_facility_id,
                            'no_of_people' => $no_of_people,
                            'additional_note' => $additional_note,
                            'reserve_date' => $reserve_date,
                            'reserve_time' => $reserve_time
                        );

                        $add = $this->ApiModel->edit_data('reserve_table', $wh, $arr);

                        if ($add) {
                            $wh = '(food_facility_id = "' . $food_facility_id . '")';

                            $food_facility = $this->ApiModel->getData('food_facility', $wh);

                            $facility_name = "";

                            if ($food_facility) {
                                $facility_name = $food_facility['facility_name'];
                            }

                            $send_data[] = array(
                                'reserve_table_id' => $reserve_table_id,
                                'reserve_for' => $facility_name,
                                'reserve_date' => $reserve_date,
                                'additional_note' => $additional_note,
                                'reserve_time' => $reserve_time,
                            );

                            $response['error_code'] = "200";
                            $response['message'] = "Your order is Edited Successfully...";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();

                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Sorry Your Request is Accepted, You Can't Edit Request...!";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //  edit Business Center request
    public function edit_business_center_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('business_center_id')) && !empty($this->input->post('event_date')) && !empty($this->input->post('start_time')) && !empty($this->input->post('end_time')) && !empty($this->input->post('event_name')) && !empty($this->input->post('b_c_reserve_id'))) {
            // $a=$this->input->post();
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $business_center_id = $this->input->post('business_center_id');
            $event_date = $this->input->post('event_date');
            $start_time = $this->input->post('start_time');
            $end_time = $this->input->post('end_time');
            $event_name = $this->input->post('event_name');
            $b_c_reserve_id = $this->input->post('b_c_reserve_id');
            $additional_note = $this->input->post('additional_note');


            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(b_c_reserve_id = "' . $b_c_reserve_id . '" AND request_status = 0)';
                    $check_status = $this->ApiModel->getData('business_center_reservation', $wh);

                    if ($check_status) {

                        $arr = array(

                            'business_center_type' => $business_center_id,
                            'event_date' => $event_date,
                            'event_name' => $event_name,
                            'start_time' => $start_time,
                            'end_time' => $end_time,
                            'additional_note' => $additional_note,

                        );

                        $add = $this->ApiModel->edit_data('business_center_reservation', $wh, $arr);

                        if ($add) {
                            $wh1 = '(business_center_id = "' . $business_center_id . '")';

                            $business_center = $this->ApiModel->getData('business_center', $wh1);

                            $business_center_type = "";

                            if ($business_center) {
                                $business_center_type = $business_center['business_center_type'];
                            }

                            $event_time = date('h:i a', strtotime($start_time)) . " to " . date('h:i a', strtotime($end_time));

                            $send_data[] = array(
                                'b_c_reserve_id' => $b_c_reserve_id,
                                'reserve_business_center_name' => $business_center_type,
                                'reserve_date' => $event_date,
                                'event_name' => $event_name,
                                'additional_note' => $additional_note,
                                'event_time' => $event_time
                            );
                            $response['error_code'] = "200";
                            $response['message'] = "Your order is Edited Successfully...";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();

                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Sorry Your Request is Accepted, You Can't Edit Request...!";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //  edit cab request
    public function edit_cab_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('total_passanger')) && !empty($this->input->post('vehicle_type')) && !empty($this->input->post('destination')) && !empty($this->input->post('select_date')) && !empty($this->input->post('select_time')) && !empty($this->input->post('cab_service_request_id'))) {
            // $a=$this->input->post();
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $total_passanger = $this->input->post('total_passanger');
            $vehicle_type = $this->input->post('vehicle_type');
            $destination = $this->input->post('destination');
            $select_date = $this->input->post('select_date');
            $select_time = $this->input->post('select_time');
            $additional_note = $this->input->post('additional_note');
            $cab_service_request_id = $this->input->post('cab_service_request_id');


            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);
                // print_r($guest_user);die;

                if ($guest_user) {
                    $wh = '(cab_service_request_id = "' . $cab_service_request_id . '" AND request_status = 0)';
                    $check_status = $this->ApiModel->getData('cab_service_request_list', $wh);

                    if ($check_status) {

                        $arr = array(

                            'total_passanger' => $total_passanger,
                            'request_vehicle_type' => $vehicle_type,
                            'select_date' => $select_date,
                            'select_time' => $select_time,
                            'destination_name' => $destination,
                            'description' => $additional_note,

                        );

                        $add = $this->ApiModel->edit_data('cab_service_request_list', $wh, $arr);

                        if ($add) {
                            $send_data[] = array(
                                'cab_service_request_id' => $cab_service_request_id,
                                'request_vehicle_type' => $vehicle_type,
                                'total_passanger' => $total_passanger,
                                'select_date' => $select_date,
                                'select_time' => date('h:i a', strtotime($select_time)),
                            );
                            $response['error_code'] = "200";
                            $response['message'] = "Your order is Edited Successfully...";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();

                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Sorry Your Request is Accepted, You Can't Edit Request...!";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //  edit wash vehicle request
    public function edit_wash_my_vehicle_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('vehicle_washing_charge_id')) && !empty($this->input->post('vehicle_name')) && !empty($this->input->post('vehicle_number')) && !empty($this->input->post('select_date')) && !empty($this->input->post('select_time')) && !empty($this->input->post('vehicle_wash_request_id'))) {
            // $a=$this->input->post();
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $vehicle_washing_charge_id = $this->input->post('vehicle_washing_charge_id');
            $vehicle_name = $this->input->post('vehicle_name');
            $vehicle_number = $this->input->post('vehicle_number');
            $select_date = $this->input->post('select_date');
            $select_time = $this->input->post('select_time');
            $additional_note = $this->input->post('additional_note');
            // $vehicle_img = $_FILES['vehicle_img']['name'];
            $vehicle_wash_request_id = $this->input->post('vehicle_wash_request_id');


            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(vehicle_wash_request_id = "' . $vehicle_wash_request_id . '" AND request_status = 0)';
                    $check_status = $this->ApiModel->getData('vehicle_wash_request', $wh);

                    if ($check_status) {
                        $wh1 = '(vehicle_washing_charge_id = "' . $vehicle_washing_charge_id . '")';

                        $vehicle_washing_charges = $this->ApiModel->getData('vehicle_washing_charges', $wh1);

                        $charges = "";

                        if ($vehicle_washing_charges) {
                            $charges = $vehicle_washing_charges['charges'];
                        }

                        $vehicle_img = "";


                        if (isset($_FILES['vehicle_img']['name'])) {
                            $_FILES['my_file']['name'] = $_FILES['vehicle_img']['name'];
                            $_FILES['my_file']['type'] = $_FILES['vehicle_img']['type'];
                            $_FILES['my_file']['size'] = $_FILES['vehicle_img']['size'];
                            $_FILES['my_file']['error'] = $_FILES['vehicle_img']['error'];
                            $_FILES['my_file']['tmp_name'] = $_FILES['vehicle_img']['tmp_name'];

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

                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Erro to upload image";
                                echo json_encode($response);
                                exit();
                            }
                        } else {
                            // Image file is not uploaded, use the existing image value
                            $existing_vehicle = $this->ApiModel->getData('vehicle_wash_request', $wh);

                            $vehicle_img = $existing_vehicle['vehicle_img'];
                            // print_r($vehicle_img);die;
                        }

                        $arr = array(

                            'vehicle_washing_charge_id' => $vehicle_washing_charge_id,
                            'vehicle_name' => $vehicle_name,
                            'vehicle_no' => $vehicle_number,
                            'vehicle_img' => $vehicle_img,
                            'charges' => $charges,
                            'note' => $additional_note,
                            'select_date' => $select_date,
                            'select_time' => $select_time,
                            'note' => $additional_note,


                        );

                        $add = $this->ApiModel->edit_data('vehicle_wash_request', $wh, $arr);

                        if ($add) {
                            $send_data[] = array(
                                'vehicle_wash_request_id' => $vehicle_wash_request_id,
                                'vehicle_name' => $vehicle_name,
                                'vehicle_no' => $vehicle_number,
                                'vehicle_img' => $vehicle_img,
                                'charges' => $charges,
                                'select_date' => $select_date,
                                'select_time' => date('h:i a', strtotime($select_time)),
                            );
                            $response['error_code'] = "200";
                            $response['message'] = "Your order is Edited Successfully...";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();

                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Sorry Your Request is Accepted, You Can't Edit Request...!";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //  edit banquet hall request
    public function edit_banquet_hall_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('banquet_hall_id')) && !empty($this->input->post('event_date')) && !empty($this->input->post('event_time')) && !empty($this->input->post('people_capacity')) && !empty($this->input->post('banquet_hall_orders_id'))) {
            // $a=$this->input->post();
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $banquet_hall_id = $this->input->post('banquet_hall_id');
            $event_date = $this->input->post('event_date');
            $event_time = $this->input->post('event_time');
            $people_capacity = $this->input->post('people_capacity');
            $additional_note = $this->input->post('additional_note');
            $banquet_hall_orders_id = $this->input->post('banquet_hall_orders_id');


            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(banquet_hall_orders_id = "' . $banquet_hall_orders_id . '" AND request_status = 0)';
                    $check_status = $this->ApiModel->getData('banquet_hall_orders', $wh);

                    if ($check_status) {
                        $wh3 = '(banquet_hall_id = "' . $banquet_hall_id . '" AND event_date = "' . $event_date . '" AND event_time = "' . $event_time . '" AND request_status = 1)';

                        $banquet_hall_orders = $this->ApiModel->getData('banquet_hall_orders', $wh3);

                        $wh1 = '(banquet_hall_id = "' . $banquet_hall_id . '")';

                        $banquet_hall = $this->ApiModel->getData('banquet_hall', $wh1);

                        $no_of_people = "";
                        $banquet_hall_name = "";

                        if ($banquet_hall) {
                            $no_of_people = $banquet_hall['no_of_people'];
                            $banquet_hall_name = $banquet_hall['banquet_hall_name'];
                        }

                        if ($banquet_hall_orders) {
                            $response['error_code'] = "403";
                            $response['message'] = "Already Reserve this banquet hall.. plz use different";
                            echo json_encode($response);
                            exit();
                        }

                        $arr = array(


                            'banquet_hall_id' => $banquet_hall_id,
                            'event_date' => $event_date,
                            'event_time' => $event_time,
                            'no_of_people' => $people_capacity,
                            'additional_note' => $additional_note,

                        );

                        $add = $this->ApiModel->edit_data('banquet_hall_orders', $wh, $arr);

                        if ($add) {
                            $send_data[] = array(
                                'banquet_hall_orders_id' => $banquet_hall_orders_id,
                                'reserve_banquet_hall_name' => $banquet_hall_name,
                                'capacity_of_people' => $people_capacity,
                                'event_date' => $event_date,
                                'additional_note' => $additional_note,
                                'event_time' => date('h:i a', strtotime($event_time)),
                            );
                            $response['error_code'] = "200";
                            $response['message'] = "Your order is Edited Successfully...";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();

                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Sorry Your Request is Accepted, You Can't Edit Request...!";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //  edit House keeping  order
    public function edit_house_keeping_order()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('housekeeping_data')) && !empty($this->input->post('order_total')) && !empty($this->input->post('h_k_order_id'))) {
            //  $a=$this->input->post();
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $additional_note = $this->input->post('additional_note');
            $order_total = $this->input->post('order_total');
            $h_k_order_id = $this->input->post('h_k_order_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(h_k_order_id = "' . $h_k_order_id . '" AND order_status = 0)';
                    $check_status = $this->ApiModel->getData('house_keeping_orders', $wh);

                    if ($check_status) {

                        $arr = array(
                            'order_total' => $order_total,
                            'additional_note' => $additional_note,
                        );

                        $add = $this->ApiModel->edit_data('house_keeping_orders', $wh, $arr);

                        if ($add) {
                            $housekeeping_data = json_decode($this->input->post('housekeeping_data'), TRUE);

                            if (is_array($housekeeping_data)) {
                                $wh4 = '(h_k_order_id = "' . $h_k_order_id . '")';
                                $this->ApiModel->delete_data('house_keeping_order_details', $wh4);

                                if (!isset($housekeeping_data[0])) {
                                    $housekeeping_data = array($housekeeping_data);
                                }
                                $send_data = array();
                                foreach ($housekeeping_data as $hk) {
                                    $arr1 = array(
                                        'h_k_order_id' => $h_k_order_id,
                                        'hotel_id' => $hotel_id,
                                        'h_k_service_id' => $hk['h_k_service_id'],
                                        'price' => $hk['price'],
                                        'quantity' => $hk['quantity'],
                                    );

                                    $add_detail = $this->ApiModel->insert_data('house_keeping_order_details', $arr1);

                                    $send_data[] = array(
                                        'h_k_order_id' => $h_k_order_id,
                                        'order_total' => $order_total,
                                        'additional_note' => $additional_note,
                                        'h_k_service_id' => $hk['h_k_service_id'],
                                        'price' => $hk['price'],
                                        'quantity' => $hk['quantity'],
                                    );
                                }

                                if ($add && $add_detail) {
                                    $response['error_code'] = "200";
                                    $response['message'] = "Your order is Edited Successfully...";
                                    $response['data'] = $send_data;
                                    echo json_encode($response);
                                    exit();
                                }
                            }

                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Sorry Your Order is Accepted, You Can't Edit Order...!";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // edit spa request
    public function edit_spa_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('spa_type')) && !empty($this->input->post('select_date')) && !empty($this->input->post('select_time')) && !empty($this->input->post('spa_service_request_id'))) {
            //  $a=$this->input->post();
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $spa_type = $this->input->post('spa_type');
            $select_date = $this->input->post('select_date');
            $select_time = $this->input->post('select_time');
            $additional_note = $this->input->post('additional_note');
            $spa_service_request_id = $this->input->post('spa_service_request_id');


            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                $wh2 = '(front_ofs_spa_service_images_id = "' . $spa_type . '")';

                $spa_charges = $this->ApiModel->getData('front_ofs_spa_service_images', $wh2);

                if ($spa_charges) {
                    $charges = $spa_charges['spa_price'];
                }

                if ($guest_user) {
                    $wh = '(spa_service_request_id = "' . $spa_service_request_id . '" AND request_status = 0)';
                    $check_status = $this->ApiModel->getData('spa_service_request_list', $wh);

                    if ($check_status) {

                        $arr = array(
                            'spa_type' => $spa_type,
                            'note' => $additional_note,
                            'charges' => $charges,
                            'select_date' => $select_date,
                            'select_time' => $select_time,
                            'note' => $additional_note,
                        );

                        $add = $this->ApiModel->edit_data('spa_service_request_list', $wh, $arr);

                        if ($add) {
                            $send_data[] = array(
                                'spa_service_request_id' => $spa_service_request_id,
                                'spa_type' => $spa_type,
                                'note' => $additional_note,
                                'charges' => $charges,
                                'select_date' => $select_date,
                                'select_time' => $select_time,
                                'note' => $additional_note,
                            );

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Your order is Edited Successfully...";
                                $response['data'] = $send_data;
                                echo json_encode($response);
                                exit();
                            }
                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response['error_code'] = "401";
                        $response['message'] = "Sorry Your Order is Accepted, You Can't Edit Order...!";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }
    // Send all active services of hotel //22-06-23 //chiragi
    public function get_hotel_all_active_service()
    {
        if (!empty($this->input->post('hotel_id'))) {
            $hotel_id = $this->input->post('hotel_id');
            $wh = '(hotel_id = "' . $hotel_id . '")';
            $hotels_services = $this->ApiModel->getAllData('hotels_services', $wh);
            if (!empty($hotels_services)) {
                foreach ($hotels_services as $serv) {
                    $send_data[] = array(
                        'hotel_id' => $serv['hotel_id'],
                        'services_id' => $serv['services_id'],
                        'services_name' => $serv['services_name'],
                        'status' => $serv['status'],
                    );
                }
                $response['error_code'] = "200";
                $response['message'] = "Data found";
                $response['data'] = $send_data;
                echo json_encode($response);
                exit();
            } else {
                $response['error_code'] = "404";
                $response['message'] = "Data not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // complete reserve table request
    public function complete_request_for_table_reserve()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('reserve_table_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $reserve_table_id = $this->input->post('reserve_table_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(reserve_table_id = "' . $reserve_table_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $order_details = $this->ApiModel->getData('reserve_table', $wh);

                    if ($order_details) {

                        if ($order_details['request_status'] == "0") //new Request
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Can't Make It Complete Before Request Accept...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "2") //Request Rejected
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Request is Rejected...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "3") //cancelled by user
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Cancelled This Request...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "4") //Request Completed
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Your Request is Already Completed";
                            echo json_encode($response);
                            exit();
                        } else {
                            $arr = array(
                                'request_status' => 4,
                            );

                            $add = $this->ApiModel->edit_data('reserve_table', $wh, $arr);

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Requested Completed successfully...!";
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // complete request for business center
    public function complete_request_for_business_center()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('b_c_reserve_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $b_c_reserve_id = $this->input->post('b_c_reserve_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(b_c_reserve_id = "' . $b_c_reserve_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $order_details = $this->ApiModel->getData('business_center_reservation', $wh);

                    if ($order_details) {

                        if ($order_details['request_status'] == "0") //new Request
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Can't Make It Complete Before Request Accept...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "2") //Request Rejected
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Request is Rejected...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "3") //cancelled by user
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Cancelled This Request...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "4") //Request Completed
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Your Request is Already Completed";
                            echo json_encode($response);
                            exit();
                        } else {
                            $arr = array(
                                'request_status' => 4,
                            );

                            $add = $this->ApiModel->edit_data('business_center_reservation', $wh, $arr);

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Requested Completed successfully...!";
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // complete request for banquet hall
    public function complete_request_for_banquet_hall()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('banquet_hall_orders_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $banquet_hall_orders_id = $this->input->post('banquet_hall_orders_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(banquet_hall_orders_id = "' . $banquet_hall_orders_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $order_details = $this->ApiModel->getData('banquet_hall_orders', $wh);

                    if ($order_details) {

                        if ($order_details['request_status'] == "0") //new Request
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Can't Make It Complete Before Request Accept...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "2") //Request Rejected
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Request is Rejected...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "3") //cancelled by user
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Cancelled This Request...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "4") //Request Completed
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Your Request is Already Completed";
                            echo json_encode($response);
                            exit();
                        } else {
                            $arr = array(
                                'request_status' => 4,
                            );

                            $add = $this->ApiModel->edit_data('banquet_hall_orders', $wh, $arr);

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Requested Completed successfully...!";
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // complete request for cab service
    public function complete_request_for_cab_service()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('cab_service_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $cab_service_request_id = $this->input->post('cab_service_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(cab_service_request_id = "' . $cab_service_request_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $order_details = $this->ApiModel->getData('cab_service_request_list', $wh);

                    if ($order_details) {

                        if ($order_details['request_status'] == "0") //new Request
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Can't Make It Complete Before Request Accept...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "2") //Request Rejected
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Request is Rejected...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "3") //cancelled by user
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Cancelled This Request...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "4") //Request Completed
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Your Request is Already Completed";
                            echo json_encode($response);
                            exit();
                        } else {
                            $today_date = date('Y-m-d');
                            $arr = array(
                                'request_status' => 4,
                                'complete_date' => $today_date
                            );

                            $add = $this->ApiModel->edit_data('cab_service_request_list', $wh, $arr);

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Requested Completed successfully...!";
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // complete request for wash my car
    public function complete_request_for_wash_my_car()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('vehicle_wash_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $vehicle_wash_request_id = $this->input->post('vehicle_wash_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(vehicle_wash_request_id = "' . $vehicle_wash_request_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $order_details = $this->ApiModel->getData('vehicle_wash_request', $wh);

                    if ($order_details) {

                        if ($order_details['request_status'] == "0") //new Request
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Can't Make It Complete Before Request Accept...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "2") //Request Rejected
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Request is Rejected...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "3") //cancelled by user
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Cancelled This Request...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "4") //Request Completed
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Your Request is Already Completed";
                            echo json_encode($response);
                            exit();
                        } else {
                            $today_date = date('Y-m-d');
                            $arr = array(
                                'request_status' => 4,
                                'complete_date' => $today_date
                            );

                            $add = $this->ApiModel->edit_data('vehicle_wash_request', $wh, $arr);

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Requested Completed successfully...!";
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // complete request for spa
    public function complete_request_for_spa()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('spa_service_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $spa_service_request_id = $this->input->post('spa_service_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(spa_service_request_id = "' . $spa_service_request_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $order_details = $this->ApiModel->getData('spa_service_request_list', $wh);

                    if ($order_details) {

                        if ($order_details['request_status'] == "0") //new Request
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Can't Make It Complete Before Request Accept...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "2") //Request Rejected
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Request is Rejected...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "3") //cancelled by user
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Cancelled This Request...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "4") //Request Completed
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Your Request is Already Completed";
                            echo json_encode($response);
                            exit();
                        } else {
                            $today_date = date('Y-m-d');
                            $arr = array(
                                'request_status' => 4,
                                'complete_date' => $today_date
                            );

                            $add = $this->ApiModel->edit_data('spa_service_request_list', $wh, $arr);

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Requested Completed successfully...!";
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // checkout user
    public function checkout_request()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);

                if ($guest_user) {
                    $wh = '(u_id = "' . $u_id . '"  AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $check_request = $this->ApiModel->getData('user_checkout_requests', $wh);
                    $checkout_request_flag = '';


                    if (empty($check_request)) {

                        $arr = array(

                            'request_status' => 0,
                            'u_id' => $u_id,
                            'hotel_id' => $hotel_id,
                            'booking_id' => $booking_id,

                        );
                        $add = $this->ApiModel->insert_data('user_checkout_requests', $arr);

                        if ($add) {
                            $wh_token = '(u_id ="' . $u_id . '")';
                            $user_token_exist = $this->ApiModel->getAllData('user_firebase_tokens', $wh_token);
                            if ($user_token_exist) {
                                $arr_token = array(
                                    'token' => ""
                                );

                                $reset_token = $this->ApiModel->edit_data('user_firebase_tokens', $wh_token, $arr_token);

                            }
                            $wh_n = '(u_id = "' . $u_id . '"  AND hotel_id = "' . $hotel_id . '")';
                            $arr1 = array(

                                'clear_flag' => 0,
                            );
                            $clear_notification = $this->ApiModel->edit_data('user_notification', $wh_n, $arr1);

                            $send_data[] = array(

                                'request_status' => 0,
                            );

                            $response['error_code'] = "200";
                            $response['message'] = "Requested Completed successfully...!";
                            $response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['error_code'] = "401";
                            $response['message'] = "Retry...!";
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        if ($check_request['request_status'] == 0) {
                            $checkout_request_flag = "new request";
                        } else if ($check_request['request_status'] == 1) {
                            $checkout_request_flag = "Request Accepted";
                        } else if ($check_request['request_status'] == 2) {
                            $checkout_request_flag = "Request Completed";
                        }
                        $send_data1[] = array(

                            'checkout_request_flag' => $checkout_request_flag,
                        );
                        $response['error_code'] = "401";
                        $response['message'] = "You Already Apply For CheckOut";
                        $response['data'] = $send_data1;
                        echo json_encode($response);
                        exit();
                    }
                } else {

                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }
    // luggage return 
    public function luggage_return()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('hotel_id')) && !empty($this->input->post('booking_id')) && !empty($this->input->post('luggage_request_id'))) {
            $u_id = $this->input->post('u_id');
            $hotel_id = $this->input->post('hotel_id');
            $booking_id = $this->input->post('booking_id');
            $luggage_request_id = $this->input->post('luggage_request_id');

            $user = $this->ApiModel->get_user_data($u_id);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $hotel_id, $booking_id);
                if ($guest_user) {
                    $wh = '(luggage_request_id = "' . $luggage_request_id . '" AND u_id = "' . $u_id . '" AND hotel_id = "' . $hotel_id . '" AND booking_id = "' . $booking_id . '")';
                    $order_details = $this->ApiModel->getData('luggage_request', $wh);
                    // print_r($order_details);die;
                    if ($order_details) {

                        if ($order_details['request_status'] == "0") //new Request
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Can't Make It Complete Before Luggage PickUp...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "2") //Request Rejected
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "Sorry Your Request is Rejected...!";
                            echo json_encode($response);
                            exit();
                        } else if ($order_details['request_status'] == "3") //cancelled by user
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "You Cancelled This Request...!";
                            echo json_encode($response);
                            exit();
                        } else {
                            $arr = array(
                                'is_completed' => 1,
                            );

                            $add = $this->ApiModel->edit_data('luggage_request', $wh, $arr);

                            if ($add) {
                                $response['error_code'] = "200";
                                $response['message'] = "Luggage Return successfully...!";
                                echo json_encode($response);
                                exit();
                            } else {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data not found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    // call waiter request list
    public function get_my_call_waiter_list()
    {
        if (!empty($this->input->post('u_id')) && !empty($this->input->post('booking_id'))) {
            $u_id = $this->input->post('u_id');
            $booking_id = $this->input->post('booking_id');


            $user = $this->ApiModel->get_user_data($u_id);
            $wh = '(booking_id = "' . $booking_id . '")';
            $booking_data = $this->ApiModel->getData('user_hotel_booking', $wh);

            if ($user) {
                $guest_user = $this->ApiModel->get_user_guest_data($u_id, $booking_data['hotel_id'], $booking_id);
                if ($guest_user) {
                    $wh_c = '(booking_id = "' . $booking_id . '" AND added_by_id = "' . $u_id . '" AND title = "Call waiter from user")';
                    $call_waiter_history = $this->ApiModel->getAllData('notifications', $wh_c);

                    if ($call_waiter_history) {
                        foreach ($call_waiter_history as $c_w_h) {
                            $send_data[] = array(
                                'notification_id' => $c_w_h['notification_id'],
                                'title' => $c_w_h['title'],
                                'description' => $c_w_h['description'],
                                'room_no' => $c_w_h['room_no'],
                                'booking_id' => $c_w_h['booking_id'],
                                'order_status' => $c_w_h['order_status'],
                                'hotel_id' => $c_w_h['send_by_id'],
                                'u_id' => $c_w_h['added_by_id'],
                            );
                        }

                        $response['error_code'] = "200";
                        $response['message'] = "Data Found";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not Found";
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['error_code'] = "404";
                    $response['message'] = "Guest Login session expired";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing..!";
            echo json_encode($response);
            exit();
        }
    }

    //update id proff img
    // public function update_id_proff()
    // {
    //     if(!empty($this->input->post('u_id')) && !empty($this->input->post('id_proff_img')))
    //     {
    //         $u_id = $this->input->post('u_id');
    //         $id_proff_img_base64 = $this->input->post('id_proff_img');

    //         $user = $this->ApiModel->get_user_data($u_id);
    //         if($user)
    //         {
    //             $b64 = $id_proff_img_base64;
    //             $bin = base64_decode($b64);
    //             $size = getImageSizeFromString($bin);

    //             // Check the MIME type to be sure that the binary data is an image
    //             if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
    //                 die('Base64 value is not a valid image');
    //             }

    //             $ext = substr($size['mime'], 6);

    //             // Make sure that you save only the desired file extensions
    //             if (!in_array($ext, ['png', 'gif', 'jpeg'])) {
    //                 die('Unsupported image type');
    //             }


    //             $base_url= base_url();
    //             $upload_dir = 'assets/upload/id_proff_pic_for_add_booking/';
    //             $file_name = md5(uniqid()) . '.' . $ext; 
    //             $file_path = $upload_dir . $file_name;
    //             $response1 = file_put_contents($file_path, $bin);

    //             if ($response1) {
    //                 // Update the database with the image path
    //                 $img_url = $base_url . $file_path;

    //                 $wh = '(u_id = "'.$u_id.'")';
    //                 $arr = array(
    //                     'Id_proff_photo' => $img_url,
    //                 );

    //                 $up = $this->ApiModel->edit_data('register',$wh,$arr);

    //                 if($up)
    //                 {
    //                     $send_data[] = array(
    //                                             'Id_proff_photo' => $img_url,
    //                                         );

    //                     $response['error_code'] = "200";
    //                     $response['message'] = "Document Updated Successfully..!";
    //                     $response['data'] = $send_data;
    //                     echo json_encode($response);
    //                     exit();
    //                 }
    //                 else
    //                 {
    //                     $response['error_code'] = "403";
    //                     $response['message'] = "Something went wrong";
    //                     echo json_encode($response);
    //                     exit();
    //                 }

    //             }
    //             else 
    //             {
    //                 $response['error_code'] = "403";
    //                 $response['message'] = "Error saving image file";
    //                 echo json_encode($response);
    //                 exit();
    //             }
    //         }
    //         else
    //         {
    //             $response['error_code'] = "404";
    //             $response['message'] = "User not found";
    //             echo json_encode($response);
    //             exit();
    //         }
    //     }
    //     else
    //     {
    //         $response['error_code'] = "406";
    //         $response['message'] = "Required Parameter Missing..!";
    //         echo json_encode($response);
    //         exit();
    //     }
    // } 

    public function update_id_proff()
    {
        // Check if required POST parameters and file are provided
        if (!empty($this->input->post('u_id')) && !empty($_FILES['id_proff_img']['tmp_name'])) {
            $u_id = $this->input->post('u_id');
            $file = $_FILES['id_proff_img'];

            // Validate the uploaded file
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $response['error_code'] = "406";
                $response['message'] = "File upload error: " . $file['error'];
                echo json_encode($response);
                exit();
            }

            // Validate file type
            $allowed_types = ['image/png', 'image/jpeg', 'image/gif'];
            if (!in_array($file['type'], $allowed_types)) {
                $response['error_code'] = "406";
                $response['message'] = "Unsupported image type. Allowed types: png, jpeg, gif.";
                echo json_encode($response);
                exit();
            }

            // Generate a unique file name
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $upload_dir = 'assets/upload/id_proff_pic_for_add_booking/';
            $file_name = md5(uniqid()) . '.' . $ext;
            $file_path = $upload_dir . $file_name;

            // Move the uploaded file to the server directory
            if (!move_uploaded_file($file['tmp_name'], $file_path)) {
                $response['error_code'] = "403";
                $response['message'] = "Failed to save the uploaded file.";
                echo json_encode($response);
                exit();
            }

            // Generate the full image URL
            $img_url = base_url() . $file_path;

            // Fetch user data
            $user = $this->ApiModel->get_user_data($u_id);
            if ($user) {
                // Update the database
                $wh = '(u_id = "' . $u_id . '")';
                $arr = ['Id_proff_photo' => $img_url];
                $up = $this->ApiModel->edit_data('register', $wh, $arr);

                if ($up) {
                    $send_data[] = ['Id_proff_photo' => $img_url];
                    $response['error_code'] = "200";
                    $response['message'] = "Document Updated Successfully..!";
                    $response['data'] = $send_data;
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error_code'] = "403";
                    $response['message'] = "Something went wrong during the database update.";
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['error_code'] = "404";
                $response['message'] = "User not found.";
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error_code'] = "406";
            $response['message'] = "Required Parameter Missing or File Not Uploaded!";
            echo json_encode($response);
            exit();
        }
    }


    public function contact_details()
    {

        $this->load->model('ApiModel');

        // Fetch store_id from POST request
        $store_id = $this->input->post('store_id');

        // Check if store_id is provided
        if (!empty($store_id)) {
            // Fetch data from the model
            $data = $this->ApiModel->get_contact_details($store_id);

            if (!empty($data)) {
                // Send success response with data
                $response = [
                    'status' => true,
                    'message' => 'Store settings fetched successfully',
                    'data' => $data
                ];
            } else {
                // Send response if no data found
                $response = [
                    'status' => false,
                    'message' => 'No data found for the provided store_id',
                    'data' => []
                ];
            }
        } else {
            // Send response for missing store_id
            $response = [
                'status' => false,
                'message' => 'store_id is required',
                'data' => []
            ];
        }

        // Output the response in JSON format
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }


}

?>