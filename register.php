<?php  
    error_reporting(0);
    session_start();  
    include_once("includes/header.php"); 

    if ($_REQUEST['type'] == "register") 
	{
		$type = $_REQUEST['type'];
		$firstname = $_REQUEST['firstname'];
		$lastname = $_REQUEST['lastname'];
		$emailId = $_REQUEST['emailId'];
		$password = $_REQUEST['password'];
		$mobileno = $_REQUEST['mobileno'];
		$city_name = $_REQUEST['city_name'];
		$area_name = $_REQUEST['area_name'];
		$dob = $_REQUEST['dob'];
		$Street = $_REQUEST['Street'];
		$Pincode = $_REQUEST['Pincode'];		
		$name = $firstname." ".$lastname;
		
		$postData = 'accesskey=90336&type='.$type.'&name='.$name.'&email='.$emailId.'&password='.$password.'&country_code=91&mobile='.$mobileno.'&dob='.$dob.'&city_id='.$city_name.'&area_id='.$area_name.'&street='.$Street.'&pincode='.$Pincode;
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
		$errorMsg = '';
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0");
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$res = json_decode($response,TRUE);
			if($res['user_id']) {
				header('location:login.php');
			} else {
				$errorMsg = 'Something Went Wrong! Please try again';
			}
		}
        // echo "<pre>";print_r($res);echo "</pre>";
        // die();    
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
                                    <li class="breadcrumb-item active" aria-current="page">register</li>
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
                        <div class="col-lg-8">
                            <div class="login-reg-form-wrap">                                
                                <input type="hidden" id="baseUrl" value="<?php echo baseUrl; ?>">
                                <h5>Sign Up</h5>
                                <?php
                                    if(!empty($res)) 
                                    {
                                        if ($res['error']!="") 
                                        {
                                            ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $res['message']; ?>
                                            </div>
                                    <?php            
                                        }
                                        elseif ($res['error'] == "") 
                                        {
                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                <?php echo $res['message']; ?>
                                            </div>
                                    <?php
                                        }
                                    }
                                ?>
                                <form action="<?php echo baseUrl; ?>register.php?type=register"  method="POST" id="frmRegister">
                                    <input type="hidden" id="isValidMobileNo" value="0">
                                    <input type="hidden" id="isValidEmail" value="0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="single-input-item">
                                                <label for="f_name" class="required">First Name</label>
                                                <input type="text" id="firstname" name="firstname" placeholder="First Name" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="single-input-item">
                                                <label for="l_name" class="required">Last Name</label>
                                                <input type="text" id="lastname" name="lastname" placeholder="Last Name" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="email" class="required">Email Address</label>
                                        <div>
                                            <input type="email" id="emailId" name="emailId" placeholder="Email Address" required />
                                        </div>
                                        <span>
                                            <a role="button" onclick="verifyEmail()">Verify Email</a>
                                        </span>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="email" class="required">Mobile No</label>
                                        <div>
                                            <input type="number" id="mobileno" name="mobileno" placeholder="Mobile No" required />
                                        </div>
                                        <span>
                                            <a role="button" onclick="verifyMobileNo()">Verify Mobile No</a>
                                        </span>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="com-name">Company Name</label>
                                        <input type="text" id="com-name" placeholder="Company Name" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="country" class="required">Country</label>
                                        <select class="form-control" name="city_name" id="city_name" onchange="getArea()" required>
                            	        </select>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="country" class="required">Area Name</label>
                                        <select class="form-control" name="area_name" id="area_name" required>
                                        </select>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="pwd" class="required">Account Password</label>
                                        <input type="password" id="Password" name="password" placeholder="Account Password"
                                            required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="pwd" class="required">Birthdate</label>
                                        <input type="date" id="birthdate" name="dob" placeholder="MM-DD-YYYY" required />
                                    </div>

                                   <div class="single-input-item">
                                        <label for="street-address" class="required mt-20">Street </label>
                                        <input type="text" id="Street" name="Street" placeholder="Street address" required />
                                    </div>
                                   
                                    <div class="single-input-item">
                                        <label for="street-address" class="required mt-20">Pincode </label>
                                        <input type="number" id="Pincode" name="Pincode" placeholder="Pincode" required />
                                    </div>

                                    <!-- <div class="single-input-item">
                                        <label for="street-address" class="required mt-20">Street address</label>
                                        <input type="text" id="street-address" placeholder="Street address Line 1"
                                            required />
                                    </div>

                                    <div class="single-input-item">
                                        <input type="text" placeholder="Street address Line 2 (Optional)" />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="town" class="required">Town / City</label>
                                        <input type="text" id="town" placeholder="Town / City" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="state">State / Divition</label>
                                        <input type="text" id="state" placeholder="State / Divition" />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="postcode" class="required">Postcode / ZIP</label>
                                        <input type="text" id="postcode" placeholder="Postcode / ZIP" required />
                                    </div> -->

                                    <!-- <div class="single-input-item">
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" placeholder="Phone" />
                                    </div> -->
                                    <div class="single-input-item">
                                        <button type="submit" class="btn btn-sqr">Sign Up</button>
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
<script type="text/javascript">
	getCities();
</script>