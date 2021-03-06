<?php 
 //header('Access-Control-Allow-Origin: *');
include_once '../includes/crud.php';	
include_once '../includes/functions.php';
function send_email($to,$subject,$message){
	
	$db=new Database();
	$db->connect();
	
    $fn = new functions();
    $system_configs = $fn->get_system_configs();
	
	$app_name = $system_configs['app_name'];
	$from_mail = $system_configs['from_mail'];
	$reply_to = $system_configs['reply_to'];
	
	//send email
	$headers = "From: ".$app_name."<".$from_mail.">\n";
	$headers .= "Reply-To: ".$reply_to."\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\n";
	
		if(!mail($to,$subject,$message,$headers))
			return false;
		else
			return true;
}
?>