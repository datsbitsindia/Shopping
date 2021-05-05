<?php

require_once '../vendor/autoload.php';

// require_once 'dbcontroller.php';

//Google API PHP Library includes
// require_once '../vendor/google/apiclient/src/Google/Client.php';
// require_once '../vendor/google/auth/src/Oauth2.php';

include('../includes/crud.php');
$db=new Database();
$db->connect(); 
// include('../includes/functions.php');

// Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
// $client_id = '631640353913-p1j2ga719lqhkqee5nesg2ujm00ulfjm.apps.googleusercontent.com';
// $client_secret = '6Sv2HpNPWZa2jrs_B1LkGqGd';
// $redirect_uri = 'https://oai-grocery-1aa43.firebaseapp.com/__/auth/handler';
// $simple_api_key = '<Your-API-Key>';
 
//Create Client Request to access Google API
// $client = new Google_Client();
// $client->setApplicationName("PHP Google OAuth Login Example");
// $client->setClientId($client_id);
// $client->setClientSecret($client_secret);
// $client->setRedirectUri($redirect_uri);
// $client->setDeveloperKey($simple_api_key);
// $client->addScope("https://www.googleapis.com/auth/userinfo.email");

// Send Client Request
// $objOAuthService = new Google_Service_Oauth2($client);

if(isset($_POST['api_id']) && isset($_POST['email']) || isset($_POST['name'])){
  	
  	$sql_get_query = "SELECT *
				FROM users where api_id=".$_POST['api_id'];
	// Execute query
	$db->sql($sql_get_query);
	if(count($db->getResult())>0){
		
		
		$sql_query = "UPDATE users SET name='".$_POST['name']."', email='".$_POST['email']."' WHERE api_id='".$_POST['api_id']."'";

		if($db->sql($sql_query)){
				$sql_get_query1 = "SELECT *
				FROM users where api_id=".$_POST['api_id'];
				// Execute query
				$db->sql($sql_get_query1);
			print_r(json_encode($db->getResult()));
		}
		else{
			echo "204:Content Not Proper";
		}

	}
	else{				

		$sql_query = "INSERT INTO users (name, email,api_id)
						VALUES('".$_POST['name']."', '".$_POST['email']."','".$_POST['api_id']."')";

		if($db->sql($sql_query)){
			$sql_getquery = "SELECT * FROM users WHERE id=(SELECT max(id) FROM users)";
			$db->sql($sql_getquery);
			print_r(json_encode($db->getResult()));
		}
		else{
			echo "204:Content Not Proper";
		}
	}
	
}else{
	echo "204:Content Not Proper";
}
?>