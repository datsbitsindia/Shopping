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
if (isset($_POST['id'])) {
    $ID = $_POST['id'];
} else {
    $ID = "";
}
// create array variable to handle error
// $update_order_permission = $permissions['orders']['update'];
// $error = array();
// if (isset($_POST['update_order_status'])) {
//     $process = $_POST['status'];
// }
    $status =  $_POST['status'];
    $sql="UPDATE doctor_appointment set `status`= '".$status."' WHERE id=".$ID;
    $db->sql($sql);
    $res=$db->getResult();
    $sqlData ="select * from doctor_appointment WHERE id=".$ID;
    $db->sql($sqlData);
	$result =$db->getResult();
	
    //send mail
    echo $to = $result[0]['email'];
	$subject = "Your Appointment is ".$status."!";
	$message = "Your Appointment id is : ".$ID." and your appointment is ".$status;
	send_email($to,$subject,$message);
    
?>