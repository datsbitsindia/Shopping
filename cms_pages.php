<?php include_once("includes/header.php"); ?>

<?php
    if(isset($_GET['type'])) {
        $type = $_GET['type'];
        if($type=='aboutus'){
            $postData = "accesskey=90336&settings=1&get_about_us=1";
        } else if($type=='terms'){
            $postData = "accesskey=90336&settings=1&get_terms=1";
        } else if($type=='policy'){
            $postData = "accesskey=90336&settings=1&get_privacy=1";
        } else if($type=='contactus'){
            $postData = "accesskey=90336&settings=1&get_contact=1";
        }
    }
    
    $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => ApiUrl.'settings.php',
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

        $res = json_decode($response,TRUE);
        if(isset($res['about'])) {
            $content = $res['about'];
            $heading = "About Us";
        } else if(isset($res['terms'])) {
            $content = $res['terms'];
            $heading = "Terms & Conditions";
        } else if(isset($res['privacy'])) {
            $content = $res['privacy'];
            $heading = "Privacy Policy";
        } else if(isset($res['contact'])) {
            $content = $res['contact'];
            $heading = "Contact Us";
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
                                    <li class="breadcrumb-item"><a href="<?php echo baseUrl; ?>index.php"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $heading; ?></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- about us area start -->
        <section class="about-us section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <!-- <div class="col-lg-5">
                        <div class="about-thumb">
                            <img src="assets/img/about/about.jpg" alt="about thumb">
                        </div>
                    </div> -->
                    <div class="col-lg-12">
                        <div class="about-content ">
                            <div class="section-title text-center">
                                <h2 class="title"><?php echo $heading; ?></h2>
                            </div>
                            <!-- <h5 class="about-sub-title">
                                Founded in 1986, I.D. Jewelry, LLC, a family owned & operated business has become a
                                house-hold name in states all over the USA as well as countries all over the world.
                            </h5> -->
                            <p>
                            <?php
                                echo $content;        
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about us area end -->

    </main>

<?php include_once("includes/footer.php"); ?>