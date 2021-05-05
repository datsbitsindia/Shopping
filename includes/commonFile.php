<?php
include_once("constant.php");
if(isset($_POST['type']))
{
	$type = $_POST['type'];
	if($type == 'getCities')
	{
		$postData = 'accesskey=90336';
		$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => ApiUrl."get-cities.php",
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
	}

	if($type == 'getArea') 
	{
		$cityId = $_POST['city_name'];
		$postData = 'accesskey=90336&city_id='.$cityId;
		$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => ApiUrl."get-areas-by-city-id.php",
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
	}

	if($type == 'getCateoryWiseProduct') 
	{
        $category_id = $_POST['category_id'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => ApiUrl."get-products-by-category-id.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "accesskey=90336&category_id=".$category_id,
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDExMTQ1MjUsInN1YiI6ImVLYXJ0IEF1dGhlbnRpY2F0aW9uIiwiaXNzIjoiZUthcnQifQ.usjg40akQHBl5A1tiKto9_aQbgjchwMCpJkhJjs3SEA",
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "postman-token: ef719084-82cd-e69d-3f0f-7801062a62de"
        ),
        ));

        $response2 = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response2;
        }
	}

	if($type == 'updateCart') 
	{
		$productId= $_POST['productId'];
		$qty= $_POST['qty'];
		session_start();
		$_SESSION['cart_item'][$productId]['quantity'] = $qty;
		echo 'updateCart';
	}

	// if ($type == 'get_varient') 
	// {
	// 	$vid = $_POST['v_id'];
	// 	$pid = $_POST['p_id'];
	// 	$postData = 'accesskey=90336&product_id='.$pid;
	// 	$curl = curl_init();
	// 			curl_setopt_array($curl, array(
	// 				CURLOPT_URL => "http://localhost/Ahemad/Ecommerce/api-firebase/get-product-by-id.php",
	// 				CURLOPT_RETURNTRANSFER => true,
	// 				CURLOPT_ENCODING => "",
	// 				CURLOPT_MAXREDIRS => 10,
	// 				CURLOPT_TIMEOUT => 30,
	// 				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 				CURLOPT_CUSTOMREQUEST => "POST",
	// 				CURLOPT_POSTFIELDS => $postData,
	// 				CURLOPT_HTTPHEADER => array(
	// 				    "authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDExMTQ1MjUsInN1YiI6ImVLYXJ0IEF1dGhlbnRpY2F0aW9uIiwiaXNzIjoiZUthcnQifQ.usjg40akQHBl5A1tiKto9_aQbgjchwMCpJkhJjs3SEA",
	// 				    "cache-control: no-cache",
	// 				    "content-type: application/x-www-form-urlencoded",
	// 				    "postman-token: ef719084-82cd-e69d-3f0f-7801062a62de"
	// 				),
	// 			));
	// 	$response = curl_exec($curl);
	// 	$err = curl_error($curl);

	// 	curl_close($curl);

	// 	if ($err) {
	// 	  echo "cURL Error #:" . $err;
	// 	} else {
	// 		echo $response;
	// 	}

	// 	$data = json_decode($response);

	// 	foreach ($data->data[0]->variants as $value) 
 //        {
 //        	if (condition) 
 //        	{
 //        		# code...
 //        	}
 //        }

	// 	$data1 = array(
	// 				""
	// 			)

	// 	die();
	// }
}
?>