<?php
include_once("constant.php");
error_reporting(0);
session_start(); 
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
		$productId= $_POST['id'];
		if(!empty($_SESSION["cart_item"])) 
		{
			foreach($_SESSION["cart_item"] as $k => $v) 
			{
				if($v['id'] == $productId) 
				{
					
					if(empty($_SESSION["cart_item"][$k]["quantity"]) || intval($_SESSION["cart_item"][$k]["quantity"]) < 0) 
					{
						unset($_SESSION["cart_item"][$k]);
						
					}
					if($_POST['name_type'] == 'inc'){
						$_SESSION["cart_item"][$k]["quantity"] += 1;
					}else if($_POST['name_type'] == 'dec'){
						if(intval($_SESSION["cart_item"][$k]["quantity"]) - 1 == 0){
							unset($_SESSION["cart_item"][$k]);
						}else{
							$_SESSION["cart_item"][$k]["quantity"] -= 1;
						}						
					}
					
				}
			}
		}

		echo 'Cart Update Success.';
	}

	if ($type == 'removeCart')
    {
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) 
            {
                if($_POST["id"] == $k)
                {
                    unset($_SESSION["cart_item"][$k]);
                }       
                if(empty($_SESSION["cart_item"]))
                {
                    unset($_SESSION["cart_item"]);
                }
            }
            header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
            header("Pragma: no-cache"); // HTTP 1.0.
            header("Expires: 0");
			echo 'Cart Remove Success';
        }
    }

	if($type == 'addCart') {
		$product_qty = $_POST['qty'];
		$product_id = $_POST['id'];
		$product_variant_id = $_POST['product_variant_id'];
		$product_price = $_POST['final_price'];
		$product_name = $_POST['name'];
		$product_image = $_POST['image'];

		$itemArray = array('name'=>$product_name,'product_variant_id'=>$product_variant_id, 'id'=>$product_id, 'quantity'=>$product_qty, 'price'=>$product_price, 'image'=>$product_image);
		$f = 0;
		if(!empty($_SESSION["cart_item"])) 
		{
			foreach($_SESSION["cart_item"] as $k => $v) 
			{
				if($v['id'] == $product_id && $v['product_variant_id'] == $product_variant_id) 
				{
					if(empty($_SESSION["cart_item"][$k]["quantity"])) 
					{
						$_SESSION["cart_item"][$k]["quantity"] = 0;
					}
					$_SESSION["cart_item"][$k]["quantity"] += $_POST["qty"];
					$f = 1;
				}
				else
				{
					//
				}
			}
			if($f == 0) 
			{
				$_SESSION["cart_item"][$product_id] = $itemArray;
				//$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
			}
			
		}
		else 
		{
			$_SESSION["cart_item"][$product_id] = $itemArray;
		}

		if($f == 1) {
			echo 'Cart Update Success';
		}else{
			echo 'Cart Add Success';
		}

	}
}
?>