<?php 

function getUserDetails($user_id){
	$CI = & get_instance();
	$CI->db->where('u_id', $user_id);
	$result = $CI->db->get('register')->row();
	return $result;
}

function getUserRole($id)
{
	$userRole = ["0" => "User","1"=>"Super Admin","2"=>"Admin","3"=>"Front Office","5"=>"House Keeping","6"=>"Room Service","7"=>"Food Admin", "8"=>"Food Staff","9"=>"Housekeeping Staff","10"=>"Room Service Staff"];
	return $userRole[$id];
}

function userRole()
{
	return ['1'=>'Super Admin','2'=>'Admin','3'=>'Front Office','5'=>'House keeping','6'=>'Room Service','7'=>'Food Admin','9'=>'Housekeeping Staff','10'=>'Room Service Staff'];
}
?>