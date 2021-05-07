<?php
include_once("constant.php");
$type = $_POST['type'];
$emailId = $_POST['emailId'];
$postData = 'accesskey=90336&type='.$type.'&email='.$emailId;
$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => ApiUrl."user-registration.php",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_HTTPHEADER => array(
			    "authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDExMTQ1MjUsInN1YiI6ImVLYXJ0IEF1dGhlbnRpY2F0aW9uIiwiaXNzIjoiZUthcnQifQ.usjg40akQHBl5A1tiKto9_aQbgjchwMCpJkhJjs3SEA",
			    "cache-control: no-cache",
			    "content-type: application/x-www-form-urlencoded",
			    "postman-token: ef719084-82cd-e69d-3f0f-7801062a62de"
			),
		));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	echo $response;
}
?>