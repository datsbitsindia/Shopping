<!doctype html>
<html class="no-js" lang="en">
<?php
 include_once("constant.php"); 
 $item_quantity = 0;
 $total_price = 0;
?>

<!-- Mirrored from demo.hasthemes.com/corano-preview/corano/index-5.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Apr 2021 15:56:12 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Corano - Jewellery Shop eCommerce Bootstrap 4 Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- Pe-icon-7-stroke CSS -->
    <link rel="stylesheet" href="assets/css/vendor/pe-icon-7-stroke.css">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <!-- Slick slider css -->
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <!-- Nice Select css -->
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <!-- jquery UI css -->
    <link rel="stylesheet" href="assets/css/plugins/jqueryui.min.css">

    <link rel="stylesheet" href="assets/css/toastr.min.css">
    <!-- main style css -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
<?php include_once("sidebar_cart.php"); ?>
    <!-- Start Header Area -->
    <header class="header-area">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header top start -->
            <!-- <div class="header-top bg-gray">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="welcome-message">
                                <p>Welcome to Corano Jewellery online store</p>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="header-top-settings">
                                <ul class="nav align-items-center justify-content-end">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- header top end -->

            <!-- header middle area start -->
            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="assets/img/logo/logo.png" alt="Brand Logo">
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- main menu area start -->
                        <div class="col-lg-8 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul class="main-menu">
                                            <li class="<?php echo baseUrl;?>index.php">
                                                <a href="index.php">Home </a>
                                            </li>
                                            <li class="<?php echo baseUrl;?>shop.php">
                                                <a href="shop.php">shop</a>
                                            </li>
                                            <li class="<?php echo baseUrl;?>cms_pages.php?type=aboutus">
                                                <a href="<?php echo baseUrl; ?>cms_pages.php?type=aboutus">About Us</a>
                                            </li>
                                            <li class="<?php echo baseUrl;?>cms_pages.php?type=terms">
                                                <a href="<?php echo baseUrl; ?>cms_pages.php?type=terms">Terms & Conditions</a>
                                            </li>
                                            <li class="<?php echo baseUrl;?>cms_pages.php?type=policy">
                                                <a href="<?php echo baseUrl; ?>cms_pages.php?type=policy">Privacy Policy</a>
                                            </li>
                                            <li class="<?php echo baseUrl;?>cms_pages.php?type=contactus">
                                                <a href="<?php echo baseUrl; ?>cms_pages.php?type=contactus">Contact Us</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-2">
                            <div class="header-right d-flex align-items-center justify-content-end">
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                        <li class="header-search-container mr-0">
                                            <button class="search-trigger d-block"><i class="pe-7s-search"></i></button>
                                            <form class="header-search-box d-none animated jackInTheBox">
                                                <input type="text" placeholder="Search entire store hire"
                                                    class="header-search-field">
                                                <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                            </form>
                                        </li>
                                        <li class="user-hover">
                                            <a href="#">
                                                <i class="pe-7s-user"></i>
                                            </a>
                                            <ul class="dropdown-list">
                                                <?php   
                                                        if (!empty($_SESSION['userid'])) {
                                                            echo '<li><a href="myaccount.php">my account</a></li>';
                                                            echo '<li><a href="logout.php">logout</a></li>';
                                                        }else{
                                                            echo '<li><a href="login.php">login</a></li>';
                                                            echo '<li><a href="register.php">register</a></li>';
                                                        }
                                                ?>                                                
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="minicart-btn">
                                                <i class="pe-7s-shopbag"></i>
                                                <div class="notification"><span class="minicart_item_quantity"><?php echo $item_quantity; ?></span></div>
                                            </a>
                                            <p><span class="minicart_total_price"><?php echo $total_price; ?></span>QAR</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->

                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->

        <!-- mobile header start -->
        <div class="mobile-header d-lg-none d-md-block sticky">
            <!--mobile header top start -->
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-logo">
                                <a href="index.html">
                                    <img src="assets/img/logo/logo.png" alt="Brand Logo">
                                </a>
                            </div>
                            <div class="mobile-menu-toggler">
                                <div class="mini-cart-wrap">
                                    <a href="cart.php" >
                                        <i class="pe-7s-shopbag"></i>
                                        <div class="notification"><span class="minicart_item_quantity"><?php echo $item_quantity; ?></span></div>
                                    </a>
                                    <p><span class="minicart_total_price"><?php echo $total_price; ?></span>QAR</p>
                                </div>
                                <button class="mobile-menu-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile header top start -->
        </div>
        <!-- mobile header end -->
        <!-- mobile header end -->

        <!-- offcanvas mobile menu start -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="pe-7s-close"></i>
                </div>

                <div class="off-canvas-inner">
                    <!-- search box start -->
                    <div class="search-box-offcanvas">
                        <form>
                            <input type="text" placeholder="Search Here...">
                            <button class="search-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                    <!-- search box end -->

                    <!-- mobile menu start -->
                    <div class="mobile-navigation">

                        <!-- mobile menu navigation start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li class="<?php echo baseUrl;?>index.php">
                                    <a href="index.php">Home </a>
                                </li>
                                <li class="<?php echo baseUrl;?>shop.php">
                                    <a href="shop.php">shop</a>
                                </li>
                                <li class="<?php echo baseUrl;?>cms_pages.php?type=aboutus">
                                    <a href="<?php echo baseUrl; ?>cms_pages.php?type=aboutus">About Us</a>
                                </li>
                                <li class="<?php echo baseUrl;?>cms_pages.php?type=terms">
                                    <a href="<?php echo baseUrl; ?>cms_pages.php?type=terms">Terms & Conditions</a>
                                </li>
                                <li class="<?php echo baseUrl;?>cms_pages.php?type=policy">
                                    <a href="<?php echo baseUrl; ?>cms_pages.php?type=policy">Privacy Policy</a>
                                </li>
                                <li class="<?php echo baseUrl;?>cms_pages.php?type=contactus">
                                    <a href="<?php echo baseUrl; ?>cms_pages.php?type=contactus">Contact Us</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->

                    <div class="mobile-settings">
                        <ul class="nav">
                            <li>
                                <div class="dropdown mobile-top-dropdown">
                                    <a href="#" class="dropdown-toggle" id="myaccount" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        My Account
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="myaccount">
                                        <?php   
                                                if (!empty($_SESSION['userid'])) {
                                                    echo '<a class="dropdown-item" href="myaccount.php">my account</a>';
                                                    echo '<a class="dropdown-item" href="logout.php">logout</a>';
                                                }else{
                                                    echo '<a class="dropdown-item" href="login.php">login</a>';
                                                    echo '<a class="dropdown-item" href="register.php">register</a>';
                                                }
                                        ?> 
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- offcanvas widget area start -->
                    <div class="offcanvas-widget-area">
                        <div class="off-canvas-contact-widget">
                            <ul>
                                <li><i class="fa fa-mobile"></i>
                                    <a href="#">0123456789</a>
                                </li>
                                <li><i class="fa fa-envelope-o"></i>
                                    <a href="#">demo@example.com</a>
                                </li>
                            </ul>
                        </div>
                        <div class="off-canvas-social-widget">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                    <!-- offcanvas widget area end -->
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
        <!-- offcanvas mobile menu end -->
    </header>
    <!-- end Header Area -->



<script type="text/javascript">
   var base_url = "<?php echo baseUrl ?>";
   var project_title = "Shop";
//    function googleTranslateElementInit() {
//         new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: "ar,en"}, 'google_translate_element');
//     }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>