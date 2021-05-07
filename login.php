<?php  
    error_reporting(0);
    session_start();  
    include_once("includes/header.php"); 

    
$type = 'login';
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

// $facebook = new \Facebook\Facebook([
//   'app_id'      => '239323617518775',
//   'app_secret'     => '627ba75f0adc192ae80aecae0d73f73d',
//   'graph_api_version' => 'v5.0'
// ]);

// $facebook_helper = $facebook->getRedirectLoginHelper();

// $google_client = new Google_Client();

// //Set the OAuth 2.0 Client ID
// $google_client->setClientId('801861643573-g6bh7tu4i9ll2k4fg33g157lei8maf84.apps.googleusercontent.com');

// //Set the OAuth 2.0 Client Secret key
// $google_client->setClientSecret('p-o9dTFiN5y6ba2mczEUn-Ys');

// //Set the OAuth 2.0 Redirect URI
// $google_client->setRedirectUri('https://abshr.online/login.php');
// //
// $google_client->addScope('email');

// $google_client->addScope('profile');

// $login_button = '<a href="'.$google_client->createAuthUrl().'&type=gmail"><img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" /></a>';

// //$facebook_permissions = ['email']; // Optional permissions

// $facebook_login_url = $facebook_helper->getLoginUrl('https://abshr.online/login.php');
    
// $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img src="https://i.stack.imgur.com/Vk9SO.png" /></a></div>';

// //echo "facebook".$facebook_login_url;
 

    
    if(isset($_GET["code"]) && isset($_GET["scope"]))
    {
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
        if(!isset($token['error']))
        {
            $google_client->setAccessToken($token['access_token']);
            $_SESSION['access_token'] = $token['access_token'];
            $google_service = new Google_Service_Oauth2($google_client);
            $data = $google_service->userinfo->get();
            //echo 
            $postData = 'accesskey=90336&api_id='.$data['id'].'&email='.$data['email'].'&name='.$data['name'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => SocialApiUrl.'redirect.php',
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
            $errorMsg = '';
            if ($err) {
              echo "cURL Error #:" . $err;
            }
            $res = json_decode($response);
            echo "<pre>";
                print_r($res);
            echo "<pre>";
            
            echo "====================== session ============================";
            echo "</br>";   
            if($res[0]->id) 
            {
                $_SESSION['userid'] = $res[0]->id;
                $_SESSION['name'] = $res[0]->name;
                $_SESSION['email'] = $res[0]->email;
                $_SESSION['mobile'] = $res[0]->mobile;
                $_SESSION['latitude'] = $res[0]->latitude;
                $_SESSION['longitude'] = $res[0]->longitude;
                $_SESSION['address'] = $res[0]->street;
                echo "<script>window.location.href='myaccount.php';</script>";
            }
        }
    }
    
    if(isset($_GET['code']))
    {
        unset($_SESSION['access_token']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email_address']);
        unset($_SESSION['user_image']);
        if(isset($_SESSION['access_token']))
        {
            $access_token = $_SESSION['access_token'];
        }
        else
        {
            $access_token = $facebook_helper->getAccessToken();
            $_SESSION['access_token'] = $access_token;
            $facebook->setDefaultAccessToken($_SESSION['access_token']);
        }
        $postData = 'api_id='.$access_token;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => SocialApiUrl.'facebook_login.php',
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
        $errorMsg = '';
        if ($err) {
          echo "cURL Error #:" . $err;
        }
        $res = json_decode($response);
        if($res[0]->id) 
        {
            $_SESSION['userid'] = $res[0]->id;
            $_SESSION['name'] = $res[0]->name;
            $_SESSION['email'] = $res[0]->email;
            $_SESSION['mobile'] = $res[0]->mobile;
            $_SESSION['latitude'] = $res[0]->latitude;
            $_SESSION['longitude'] = $res[0]->longitude;
            $_SESSION['address'] = $res[0]->street;
            echo "<script>window.location.href='myaccount.php';</script>";
        }    
    }

    if(isset($_POST['btnSignIn'])) {
     
        $mobileno = $_POST['txtMobileNo'];
        $password = $_POST['password'];
        $type = $_GET['type'];

        $postData = 'accesskey=90336&mobile='.$mobileno.'&password='.$password;
            $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => ApiUrl."login.php",
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
        $errorMsg = '';
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $res = json_decode($response,TRUE);
            if($res['user_id']) {
                $_SESSION['userid'] = $res['user_id'];
                $_SESSION['name'] = $res['name'];
                $_SESSION['email'] = $res['email'];
                $_SESSION['mobile'] = $res['mobile'];

                $_SESSION['latitude'] = $res['latitude'];
                $_SESSION['longitude'] = $res['longitude'];
                $_SESSION['address'] = $res['street'];
                     
                if($type=='checkout') {
                    echo "<script>window.location.href='checkout.php';</script>";
                } else {
                    echo "<script>window.location.href='myaccount.php';</script>";
                }
                
            } else {
                $errorMsg = 'Invalid Mobile No or Password';
            }
        }
    }

?>

    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">login</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- login register wrapper start -->
        <div class="login-register-wrapper section-padding">
            <div class="container">
                <div class="member-area-from-wrap">
                    <div class="row justify-content-center">
                        <!-- Login Content Start -->
                        <div class="col-lg-6">
                            <div class="login-reg-form-wrap">
                                <h5>Sign In</h5>
                                <span id="errorMsg"><?php echo $errorMsg; ?></span>
                                <form id="log-in-form" action="login.php?type=<?php echo $type; ?>" method="post" >
                                    <div class="single-input-item">
                                        <input type="number" placeholder="Enter your Mobile No." required  id="txtMobileNo" name="txtMobileNo"/>
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" placeholder="Enter your Password" required  id="password" name="password" />
                                    </div>
                                    <div class="single-input-item">
                                        <div
                                            class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="remember-meta">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                                                    <label class="custom-control-label" for="rememberMe">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <a href="#" class="forget-pwd">Forget Password?</a>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <button type="submit" class="btn btn-sqr" name="btnSignIn">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>

<?php include_once("includes/footer.php"); ?>