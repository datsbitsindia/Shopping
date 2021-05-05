<?php 
session_start();
include '../includes/crud.php';
include_once('../includes/variables.php');
include_once('../includes/custom-functions.php');


header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//header("Content-Type: multipart/form-data");
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Kolkata');


$fn = new custom_functions;
// Akshay
$id = '';
if(isset($_SESSION['id'])) {
	$id = $_SESSION['id'];		
}
$permissions = $fn->get_permissions($id);
// Akshay
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

if(isset($_POST['name'])){
	//insert data into database
	$sql_query = "INSERT INTO pet_category (name)
						VALUES('".$_POST['name']."')";

	if($db->sql($sql_query)){
		$response["message"] = "<span class='label label-success'>Data Saved Successfully!</span>";
	}else{
		$response["message"] = "<span class='label label-danger'>Data Could not Saved!Try Again!</span>";
	}
	echo json_encode($response);
}

if(isset($_GET['type']) && $_GET['type'] != '' && $_GET['type'] == 'delete-petcategory') {

	$id		= $_GET['id'];
    $sql = 'DELETE FROM `pet_category` WHERE `id`='.$id;
	if($db->sql($sql)){
		echo 1;
	}else{
		echo 0;
	}
}
if(isset($_POST['get-petcategory'])) {

    if(!verify_token()){
        return false;
    }
	$sql = 'select * from pet_category order by id desc';

	$db->sql($sql);
	$result =$db->getResult();
	$response  = array();
	if(!empty($result)){
    	$response['error'] = false;
    	
    	$response['data'] = $result;
	}else{
	    $response['error'] = true;
	    $response['message'] = "No slider images uploaded yet!";
	}
	print_r(json_encode($response));
}
?>