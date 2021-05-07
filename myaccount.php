<?php 
error_reporting(0);
session_start();  
include_once("includes/header.php");
if (!isset($_SESSION['userid']) || $_SESSION['userid']=="") 
{
    echo "<script>window.location.href='login.php';</script>";
    die();  
}   
?>


<?php 
    if(isset($_GET['type'])) {
        $type= $_GET['type'];
        if($type=='changePassword') {
            $user_id = $_POST['hiddenId'];
            $new_password = $_POST['txtPassword'];
            $postData = 'accesskey=90336&type=change-password&id='.$user_id.'&password='.$new_password;
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
            $data = json_decode($response,TRUE);
            $err = curl_error($curl);
            curl_close($curl);
        }

        else if($type == 'bookappointment') {
            $id = $_POST['hiddenId'];
            $name = $_POST['txtName'];
            $mobileno = $_POST['txtMobileNo'];
            $email = $_POST['txtEmail'];
            $category = $_POST['ddPatCategory'];
            $description = $_POST['description'];
            $postData = 'accesskey=90336&name='.$name.'&description='.$description.'&mobile_no='.$mobileno.'&pet_category='.$category.'&email='.$email.'&user_id='.$id;

            $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => ApiUrl."doctors-data.php",
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
            $resApp = json_decode($response,TRUE);
            $err = curl_error($curl);
            curl_close($curl);
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
                                    <li class="breadcrumb-item active" aria-current="page">my account</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="baseUrl" value="<?php echo baseUrl; ?>">
        <div class="my-account pt-80 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="title text-capitalize mb-30 pb-25">my account</h3>
                    </div>
                    <!-- My Account Tab Menu Start -->
                    <div class="col-lg-3 col-12 mb-30">
                        <?php include_once("includes/sidebar-myaccount.php"); ?>
                    </div>
                    <!-- My Account Tab Menu End -->

                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-9 col-12 mb-30">
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="dashboad" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Dashboard</h3>

                                    <div class="welcome mb-20">
                                        <p>Hello, <strong><?php echo $_SESSION['name']; ?></strong> (If Not <strong><?php echo $_SESSION['name']; ?> !</strong><a
                                                href="login-register.html" class="logout"> Logout</a>)</p>
                                    </div>

                                    <p class="mb-0">From your account dashboard. you can easily check &amp; view your
                                        recent orders, manage your shipping and billing addresses and edit your
                                        password and account details.</p>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="orders" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Orders</h3>

                                    <?php
                                        $postData = 'accesskey=90336&get_orders=73&user_id='.$_SESSION['userid'].'&limit=20offset=1';
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
                                        $data = json_decode($response);
                                        $err = curl_error($curl);
                                        curl_close($curl);
                                    ?>

                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if (!empty($data->data)) 
                                                    {
                                                        $i = 1;
                                                        foreach ($data->data as $value) 
                                                        {
                                                            $name = ($value->items[0]->name) ? ($value->items[0]->name): '-';
                                                            $date_added = ($value->items[0]->date_added) ? ($value->items[0]->date_added) : $value->date_added;
                                                            $create_date_array = explode(" ",$date_added);
                                                            $create_date = date('M d, Y',strtotime($create_date_array[0]));
                                                            $status = ($value->items[0]->active_status) ? ($value->items[0]->active_status) : $value->status[0][0];
                                                            $final_total = $value->final_total;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $name; ?></td>
                                                                <td><?php echo $create_date; ?></td>
                                                                <td><?php echo $status; ?></td>
                                                                <td><?php echo $final_total; ?></td>
                                                                <!-- <td><a href="<?php echo baseUrl; ?>?order_id=<?php echo $value->items[0]->order_id; ?>" class="ht-btn black-btn">View</a>
                                                                </td> -->
                                                            </tr>
                                                    <?php
                                                            $i++;
                                                        }    
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Payment Method</h3>

                                    <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Billing Address</h3>
                                    <?php
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
                                        $user_data = json_decode($response);    
                                        $err = curl_error($curl);
                                        curl_close($curl);
                                        

                                    ?>
                                    <address>
                                        <p><strong><?php echo $user_data->name; ?></strong></p>
                                        <p><?php echo $user_data->area_name; ?>,<?php echo $user_data->street; ?> <br>
                                            <?php echo $user_data->city_name; ?> <?php echo $user_data->pincode ?></p>
                                        <p>Mobile: <?php echo $user_data->mobile; ?></p>
                                    </address>

                                    <!-- <a href="#" class="ht-btn black-btn d-inline-block edit-address-btn"><i
                                            class="fa fa-edit"></i>Edit Address</a> -->
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                            <?php
                                if (isset($_REQUEST['edit_profile'])) 
                                {
                                    if ($_REQUEST['hidden_type'] == "update_profile") 
                                    {
                                        $postData = 'accesskey=90336&type=edit-profile&id='.$_SESSION['userid'].'&name='.$_REQUEST['input_name'].'&email='.$_REQUEST['input_email'].'&password='.$_REQUEST['new-pwd'].'&city_id='.$_REQUEST['city_name'].'&area_id='.$_REQUEST['area_name'].'&street='.$_REQUEST['input_address'].'&pincode='.$_REQUEST['input_code'].'&dob='.$_REQUEST['input_dob'].'&mobile='.$_REQUEST['mobile_number'];

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
                                        $messgae = json_decode($response);    
                                        $err = curl_error($curl);
                                        curl_close($curl);
                                    }
                                }
                            ?>
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade active show" id="account-info" role="tabpanel">
                                <div class="myaccount-content">
                                    
                                    <h3>Account Details</h3>
                                    <?php 
                                        $name = ($user_data->name!="")? $user_data->name  : '';
                                        $email = ($user_data->email!="")? $user_data->email  : '';
                                        $mobile_number = ($user_data->mobile!="")? $user_data->mobile  : '';
                                        $city_id = ($user_data->city_id!="")? $user_data->city_id  : '';
                                        $area_id = ($user_data->area_id!="")? $user_data->area_id : '';
                                        $address = ($user_data->street!="")? $user_data->street  : '';
                                        $pincode = ($user_data->pincode!="")? $user_data->pincode  : '';
                                        $dob = ($user_data->dob!="")? $user_data->dob  : '';
                                        
                                    ?>
                                    <div class="account-details-form">
                                        <form action="<?php baseUrl; ?>myaccount.php" method="post" id="insert_form">
                                            <div class="row">
                                                <?php
                                                    if ($messgae->message!="")
                                                    {
                                                        ?>
                                                        <div class="col-lg-12 col-12 mb-30">
                                                            <div class="alert alert-success">
                                                                <?php echo $messgae->message; ?>
                                                            </div>
                                                        </div>
                                                <?php
                                                        # code...
                                                    }
                                                ?>
                                                
                                                <input type="hidden" id="hidden_type" name="hidden_type" id="hidden_type" value="update_profile">
                                                <div class="single-input-item col-md-12">
                                                    <label for="com-name">First Name</label>
                                                    <input type="text" id="input_name" name="input_name" placeholder="First Name" value="<?php echo $name; ?>"  required />
                                                </div>
                                                <div class="single-input-item col-md-12">
                                                    <label for="com-name">Email</label>
                                                    <input type="email" id="input_email" name="input_email" placeholder="First Name" value="<?php echo $email; ?>"  required />
                                                </div>
                                                <div class="single-input-item col-md-12">
                                                    <label for="com-name">Mobile No.</label>
                                                    <input type="number" id="mobile_number" name="mobile_number" placeholder="First Name" value="<?php echo $mobile_number; ?>"  required />
                                                </div>
                                                <div class="single-input-item col-md-12">
                                                    <label for="com-name">City</label>
                                                    <select class="form-control" name="city_name" id="city_name" onchange="getArea();" required>
                                                    </select>
                                                </div>                                                
                                                <?php
                                                    if($area_id!="") 
                                                    {
                                                    ?>
                                                    <script type="text/javascript">
                                                            setTimeout(function()
                                                            {
                                                                getArea('<?php echo $area_id; ?>');
                                                            },1000);
                                                        
                                                    </script> 
                                                <?php        
                                                    }
                                                ?>
                                                <div class="single-input-item col-md-12">
                                                    <label for="com-name">Area Name</label>
                                                    <select class="form-control" name="area_name" id="area_name" required>
                                                    </select>
                                                </div>
                                                <div class="single-input-item col-md-12">
                                                    <label for="com-name">Address</label>
                                                    <textarea id="input_address" name="input_address" placeholder="Address" required ><?php echo $address; ?></textarea>
                                                </div>
                                                <div class="single-input-item col-md-12">
                                                    <label for="com-name">Pincode</label>
                                                    <input type="number" id="input_pincode" name="input_pincode" placeholder="First Name" value="<?php echo $pincode; ?>"  required />
                                                </div>
                                                <div class="single-input-item col-md-12">
                                                    <label for="com-name">Mobile No.</label>
                                                    <input type="date" id="dob" name="input_dob" placeholder="First Name" value="<?php echo $dob; ?>"  required />
                                                </div>
                                                <div class="single-input-item col-md-12">
                                                    <button type="submit" class="btn btn-sqr" value="Save" name="edit_profile">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <div class="tab-pane fade" id="changepassword-info" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Change Password</h3>
                                    <div class="account-details-form">
                                        <form action="<?php baseUrl; ?>myaccount.php?type=changePassword" method="POST" id="frmChangePassword">
                                            <div class="row">                                                
                                                <input type="hidden" id="hiddenId" name="hiddenId" value="<?php echo $_SESSION['userid']; ?>">
                                                <div class="single-input-item col-md-12">
                                                    <label for="com-name">New Password</label>
                                                    <input name="txtPassword" id="txtPassword" placeholder="New Password" type="password" required />
                                                </div>
                                                <div class="single-input-item col-md-12">
                                                    <button type="submit" class="btn btn-sqr" value="Save" name="changePassword">Update Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- My Account Tab Content End -->
                </div>
            </div>
        </div>
    </main>

<!-- product tab end -->
<?php include_once("includes/footer.php"); ?>
<script type="text/javascript">
        getCities('<?php echo $city_id; ?>');
        $( function() 
        {
            $('#dob').datepicker({
                        dateFormat: 'dd-mm-yy',
                        changeMonth: true,
                        changeYear: true
                    });
        });
</script>