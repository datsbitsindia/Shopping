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
                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/home3-slide2.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-1">
                                        <h2 class="slide-title">Family Jewellery <span>Collection</span></h2>
                                        <h4 class="slide-desc">Designer Jewellery Necklaces-Bracelets-Earings</h4>
                                        <a href="shop.html" class="btn btn-hero">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->

                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/home1-slide3.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-2 float-md-right float-none">
                                        <h2 class="slide-title">Diamonds Jewellery<span>Collection</span></h2>
                                        <h4 class="slide-desc">Shukra Yogam & Silver Power Silver Saving Schemes.</h4>
                                        <a href="shop.html" class="btn btn-hero">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->

                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/home3-slide1.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-3">
                                        <h2 class="slide-title">Grace Designer<span>Jewellery</span></h2>
                                        <h4 class="slide-desc">Rings, Occasion Pieces, Pandora & More.</h4>
                                        <a href="shop.html" class="btn btn-hero">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item end -->
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
                                    <h6>Free Shipping</h6>
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
                                        <!-- product item start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="product-details.html">
                                                    <img class="pri-img" src="assets/img/product/product-1.jpg"
                                                        alt="product">
                                                    <img class="sec-img" src="assets/img/product/product-18.jpg"
                                                        alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                    <div class="product-label discount">
                                                        <span>10%</span>
                                                    </div>
                                                </div>
                                                <div class="button-group">
                                                    <a href="wishlist.html" data-toggle="tooltip" data-placement="left"
                                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                                    <a href="compare.html" data-toggle="tooltip" data-placement="left"
                                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#quick_view"><span
                                                            data-toggle="tooltip" data-placement="left"
                                                            title="Quick View"><i class="pe-7s-search"></i></span></a>
                                                </div>
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">add to cart</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption">
                                                <div class="product-identity">
                                                    <p class="manufacturer-name"><a href="product-details.html">Gold</a>
                                                    </p>
                                                </div>
                                                <h6 class="product-name">
                                                    <a href="product-details.html">Perfect Diamond Jewelry</a>
                                                </h6>
                                                <div class="price-box">
                                                    <span class="price-regular">$60.00</span>
                                                    <span class="price-old"><del>$70.00</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product item end -->
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