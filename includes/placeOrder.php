<?php
session_start();
include_once("constant.php");

if (isset($_SESSION['userid']) && $_SESSION['userid']!="")  {
	$userId = $_SESSION['userid'];	
} else {	
	echo "<script>window.location.href='".baseUrl."login.php?type=checkout';</script>";
	die;
}

if(empty($_SESSION['cart_item']) || count($_SESSION['cart_item']) == 0){
	echo "<script>window.location.href='".baseUrl."shop.php';</script>";
	die;
}

$mobileNo = $_SESSION['mobile'];
$variantIds = array();
$qtyArr = array();
$total = 0;
$discount = 10;
$delivery_charge = 20;
$tax_amount = 10;
$tax_percentage = 5;
$wallet_balance = 0;
$wallet_used = false;
$final_amount = 0;
$latitude = $_SESSION['latitude'];
$longitude = $_SESSION['longitude'];
$payment_method = 'PAYPAL';
$paypal_response = 'PAYPAL';
$promo_code = '';
$address = $_SESSION['address'];
$delivery_time = 'Today - Evening (4:00pm to 7:00pm)';

if(!empty($_SESSION['cart_item'])) {
	foreach ($_SESSION['cart_item'] as $product_id => $value) {
		
		$pids = $value['product_variant_id'];
		$qtyes = $value['quantity'];
		$price = $value['price'];

		array_push($variantIds,$pids);
		array_push($qtyArr,$qtyes);

		$total += $price * $qtyes;
	}
}
$final_total = $total - ($total * ($discount / 100));

$productVariantIds = json_encode($variantIds);
$qty = json_encode($qtyArr);

$postData = 'accesskey=90336&place_order=1&user_id='.$userId.'&mobile='.$mobileNo.'&product_variant_id='.$productVariantIds.'&quantity='.$qty.'&total='.$total.'&delivery_charge='.$delivery_charge.'&tax_amount='.$tax_amount.'&tax_percentage='.$tax_percentage.'&wallet_balance='.$wallet_balance.'&wallet_used='.$wallet_used.'&discount='.$discount.'&final_total='.$final_total.'&latitude='.$longitude.'&longitude='.$longitude.'&payment_method='.$payment_method.'&promo_code='.$promo_code.'&address=&delivery_time='.$delivery_time'&paypal_response='.$paypal_response;

$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => ApiUrl."order-process.php",
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
	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0");
	unset($_SESSION['cart_item']);
	$res =json_decode($response,TRUE);
	header('location:'.baseUrl.'shop.php');
}
?>