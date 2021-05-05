<?php 
header('Access-Control-Allow-Origin: *');
session_start();

include '../includes/crud.php';
include_once('../includes/variables.php');
include_once('../includes/custom-functions.php');

// header("Content-Type: application/json");
// header("Expires: 0");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
//header("Content-Type: multipart/form-data");
// header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Kolkata');


$fn = new custom_functions;
// $permissions = $fn->get_permissions($_SESSION['id']);
include_once('verify-token.php');
$db = new Database();
$db->connect();
include 'send-email.php';
$response = array();
// print_r($_GET['accesskey']);

if(!isset($_POST['accesskey'])){
    if(!isset($_GET['accesskey'])){
        $response['error'] = true;
    	$response['message'] = "Access key is invalid or not passed!";
    	print_r(json_encode($response));
    	return false;
    }
}

if(isset($_POST['accesskey'])){
    $accesskey = $_POST['accesskey'];
}else{
    $accesskey = $_GET['accesskey'];
}

if ($access_key != $accesskey) {
	$response['error'] = true;
	$response['message'] = "invalid accesskey!";
	print_r(json_encode($response));
	return false;
}

if(isset($_POST['name']) && isset($_POST['phone_no'])){
	//insert data into database
	$sql_query = "INSERT INTO doctors_mst (name, description,phone_no,category_id)
						VALUES('".$_POST['name']."', '".$_POST['description']."','".$_POST['phone_no']."','".$_POST['pet_category']."')";

	if($db->sql($sql_query)){
		$response["message"] = "<span class='label label-success'>Data Saved Successfully!</span>";
		// $sql_getquery = "SELECT * FROM doctors_mst WHERE doctor_id=(SELECT max(doctor_id) FROM doctors_mst)";
		// $db->sql($sql_getquery);
		// print_r(json_encode($db->getResult()));
	}else{
		$response["message"] = "<span class='label label-danger'>Data Could not Saved!Try Again!</span>";
	}
	echo json_encode($response);
}

if(isset($_GET['type']) && $_GET['type'] != '' && $_GET['type'] == 'delete-doctor') {
	// if($permissions['home_sliders']['delete']==0){
	// 	echo 2;
	// 	return false;
	// }
    
    // print_r($_GET);
    $id		= $_GET['id'];
    // $image 	= $_GET['image'];
	
	// if(!empty($image))
	// 	unlink('../'.$image);
	
	$sql = 'DELETE FROM `doctors_mst` WHERE `id`='.$id;
	if($db->sql($sql)){
		echo 1;
	}else{
		echo 0;
	}
}
if(isset($_POST['get-doctors'])) {
    if(!verify_token()){
        return false;
    }
	$sql = 'select * from doctors_mst order by id desc';
	$db->sql($sql);
	$result =$db->getResult();
	$response = array();
	if(!empty($result)){
    	$response['error'] = false;
    	
    	$response['data'] = $result;
	}else{
	    $response['error'] = true;
	    $response['message'] = "No Data uploaded yet!";
	}
	print_r(json_encode($response));
}

if(isset($_POST['get-appointment'])) {
    if(!verify_token()){
        return false;
    }
    if(isset($_POST['user_id'])){
    	$sql = 'select da.id as id,da.person_name,da.description,da.mobile_no,da.category_id,da.status,da.email,da.user_id,pc.name,pc.date_added from doctor_appointment as da LEFT JOIN pet_category as pc ON da.category_id = pc.id where da.user_id='.$_POST['user_id'];
		$db->sql($sql);
		$result =$db->getResult();
		$response = array();
		if(!empty($result)){
	    	$response['error'] = false;
	    	
	    	$response['data'] = $result;
		}else{
		    $response['error'] = true;
		    $response['message'] = "No Data Found!";
		}
		print_r(json_encode($response));
    }
}

if(isset($_POST['get-all-appointment'])) {
    if(!verify_token()){
        return false;
    }
    
	$sql = 'select * from doctor_appointment LEFT JOIN pet_category ON doctor_appointment.category_id = pet_category.id';
	$db->sql($sql);
	$result =$db->getResult();
	$response = array();
	if(!empty($result)){
    	$response['error'] = false;
    	
    	$response['data'] = $result;
	}else{
	    $response['error'] = true;
	    $response['message'] = "No Data Found!";
	}
	print_r(json_encode($response));
   
}

if(isset($_POST['name']) && isset($_POST['mobile_no']) && isset($_POST['pet_category'])){
	//insert data into database
	$sql_query = "INSERT INTO doctor_appointment (person_name, description,mobile_no,category_id,email,user_id,status)
						VALUES('".$_POST['name']."', '".$_POST['description']."','".$_POST['mobile_no']."','".$_POST['pet_category']."','".$_POST['email']."','".$_POST['user_id']."','open')";

	if($db->sql($sql_query)){
		$sqlData = 'SELECT * FROM doctor_appointment ORDER BY id DESC LIMIT 1';
		$db->sql($sqlData);
		$result =$db->getResult();

		//send mail
		$to = $_POST['email'];
		$subject = "Your Appointment is fixed!";
		$message = "Thank you for submitting your request for appointment. Our representative will contact you shortly.Your Appointment id is : ".$result[0]['id']."";
		send_email($to,$subject,$message);
		$response["message"] = "<span class='label label-success'>Thank you for submitting your request for appointment. Our representative will contact you shortly.Your Appointment id is : ".$result[0]['id']."</span>";
		
	}else{
		$response["message"] = "<span class='label label-danger'>Data Could not Saved!Try Again!</span>";
	}
	echo json_encode($response);
}
?>