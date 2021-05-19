<?php  
    error_reporting(0);
    session_start();  
    include_once("includes/header.php"); 
?>
<?php 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => ApiUrl."get-all-products.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "get_all_products=1&accesskey=90336",
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
  //echo $response;
}

?>


<?php 
    // Get Slider APIS
    $slider_data = array();
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => ApiUrl."slider-images.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "get-slider-images=1&accesskey=90336",
    CURLOPT_HTTPHEADER => array(
        "authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDExMTQ1MjUsInN1YiI6ImVLYXJ0IEF1dGhlbnRpY2F0aW9uIiwiaXNzIjoiZUthcnQifQ.usjg40akQHBl5A1tiKto9_aQbgjchwMCpJkhJjs3SEA",
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded",
        "postman-token: ef719084-82cd-e69d-3f0f-7801062a62de"
    ),
    ));

    $response1 = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $slider_data = json_decode($response1,TRUE);
    }
?>

<?php
    $category_name = '';
    $category_data = array();
    if(isset($_GET['type'])) {
        $type = $_GET['type'];
        if($type == 'getCateoryWiseProduct') {
            $category_id = $_GET['category_id'];
            $category_name = $_GET['category_name'];
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
                $category_data = json_decode($response2,TRUE);
            }
        }
    }
?>

<?php
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => ApiUrl."get-categories.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "accesskey=90336",
            CURLOPT_HTTPHEADER => array(
            "authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDExMTQ1MjUsInN1YiI6ImVLYXJ0IEF1dGhlbnRpY2F0aW9uIiwiaXNzIjoiZUthcnQifQ.usjg40akQHBl5A1tiKto9_aQbgjchwMCpJkhJjs3SEA",
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "postman-token: ef719084-82cd-e69d-3f0f-7801062a62de"
            ),
        ));

        $get_response_category = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //echo $response;
        }
        $get_array_category = json_decode($get_response_category);
?>

<main>
        <!-- hero slider area start -->
        <section class="slider-area hero-style-five">
            <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <?php 
            if(!empty($slider_data['data'])) {
                foreach ($slider_data['data'] as $key => $value) {
            ?>  
                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="<?php echo $value['image']; ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-1">
                                        <!-- <h2 class="slide-title">Family Jewellery <span>Collection</span></h2>
                                        <h4 class="slide-desc">Designer Jewellery Necklaces-Bracelets-Earings</h4> -->
                                        <a href="shop.php" class="btn btn-hero">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->
            <?php 
                    }
                }
            ?>

            </div>
        </section>
        <!-- hero slider area end -->

        <!-- service policy area start -->
        <div class="service-policy">
            <div class="container">
                <div class="policy-block section-padding">
                    <div class="row mtn-30">
                        <div class="col-sm-6 col-lg-3">
                            <div class="policy-item">
                                <div class="policy-icon">
                                    <i class="pe-7s-plane"></i>
                                </div>
                                <div class="policy-content">
                                    <h6>Shipping all over world</h6>
                                    <p>Free shipping all order</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="policy-item">
                                <div class="policy-icon">
                                    <i class="pe-7s-help2"></i>
                                </div>
                                <div class="policy-content">
                                    <h6>Support 24/7</h6>
                                    <p>Support 24 hours a day</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="policy-item">
                                <div class="policy-icon">
                                    <i class="pe-7s-back"></i>
                                </div>
                                <div class="policy-content">
                                    <h6>Money Return</h6>
                                    <p>30 days for free return</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="policy-item">
                                <div class="policy-icon">
                                    <i class="pe-7s-credit"></i>
                                </div>
                                <div class="policy-content">
                                    <h6>100% Payment Secure</h6>
                                    <p>We ensure secure payment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service policy area end -->

        <!-- banner statistics area start -->
        <div class="banner-statistics-area section-padding">
            <div class="container">
                <div class="row row-20 mtn-20">
                <?php
                if (!empty($get_array_category->data)) 
                {
                    foreach ($get_array_category->data as $value) 
                    {
                        ?>
                        <!-- active -->
                        <?php if(strtolower($value->name) != 'appoinment') { ?>
                                <div class="col-sm-6">
                                    <figure class="banner-statistics mt-20">
                                        <a href="#">
                                            <img src="<?php echo $value->image; ?>" alt="product banner">
                                        </a>
                                        <div class="banner-content text-right">
                                            <h5 class="banner-text1"><?php echo $value->name; ?></h5>
                                            <h2 class="banner-text2"><?php echo $value->subtitle; ?></span></h2>
                                            <a href="shop.php" class="btn btn-text">Shop Now</a>
                                        </div>
                                    </figure>
                                </div>
                    <?php 
                        } 
                    }
                }
                ?>
                </div>
            </div>
        </div>
        <!-- banner statistics area end -->

        <!-- product area start -->
        <section class="product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">new products</h2>
                            <p class="sub-title">Add our products to weekly lineup</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-container">
                            <!-- product tab menu start -->
                            <div class="product-tab-menu">
                                <ul class="nav justify-content-center">
                                <?php
                                if (!empty($get_array_category->data)) 
                                {
                                    foreach ($get_array_category->data as $value) 
                                    {
                                        ?>
                                        <!-- active -->
                                        <?php if(strtolower($value->name) != 'appoinment') { ?>
                                            <li>
                                                <a class="nav-link" id="pills-<?php echo $value->name; ?>-tab" data-toggle="pill" href="#pills-<?php echo $value->name; ?>"
                                                role="tab" aria-controls="pills-<?php echo $value->name; ?>" aria-selected="true" onclick="getCategoryWiseData(<?php echo $value->id; ?>,'<?php echo $value->name; ?>','<?php echo baseUrl; ?>')"><?php echo $value->name; ?></a>
                                            </li>
                                            <!-- <li><a href="#tab2" data-toggle="tab">Storage</a></li>
                                            <li><a href="#tab3" data-toggle="tab">Lying</a></li>
                                            <li><a href="#tab4" data-toggle="tab">Tables</a></li> -->
                                        <?php } ?>
                                    <?php
                                        }
                                        ?>
                                <?php       
                                    }
                                ?>
                                </ul>
                            </div>
                            <!-- product tab menu end -->

                            <!-- product tab content start -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show" id="" role="tabpanel" aria-labelledby="">
                                    <div class="product-carousel-4 slick-row-10 slick-arrow-style" id="product-slider-init">
                                  
                                    </div>
                                </div>
                            </div>

                            <!-- product tab content end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product area end -->

</main>

<?php include_once("includes/footer.php"); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#pills-Food-tab").addClass('active');
        getCategoryWiseData(47,'Food','<?php echo baseUrl; ?>');
    });    
</script>