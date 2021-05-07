<?php
$apiKey = '';
$postData = 'accesskey=90336&&get_user_data=1&user_id='.$_SESSION['userid'];
$curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => ApiUrl."get-user-data.php",
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
$user_data = json_decode($response,TRUE);
$err = curl_error($curl);
curl_close($curl);
$apiKey = $user_data['apikey'];
?>

<?php 
    $type = '';    
    if(isset($_GET['type'])){
        $type=$_GET['type'];
    }
?>

<input type="hidden" id="getSlug" value="<?php echo $type; ?>">
<div class="myaccount-tab-menu nav" role="tablist">
                    <a href="#dashboad" data-toggle="tab"><i class="fas fa-tachometer-alt"></i>
                        Dashboard</a>

                    <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                        Orders</a>

                    <!-- <a href="#download" data-toggle="tab"><i class="fas fa-cloud-download-alt"></i>
                        Download</a> -->

                    <!-- <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i>
                        Payment
                        Method</a> -->

                    <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i>
                        address</a>

                    <a href="#account-info" data-toggle="tab" class="active" id="accountInfo"><i class="fa fa-user"></i> Account
                        Details</a>

                    <?php if($apiKey=='') { ?>
                        <a href="#changepassword-info" data-toggle="tab" class=""><i class="fa fa-user"></i> Change Password</a>
                    <?php } ?>

                    <a href="<?php echo baseUrl; ?>logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
