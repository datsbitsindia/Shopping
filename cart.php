<?php 
 error_reporting(0);
 session_start(); 

if(isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'remove')
    {
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) 
            {
                if($_GET["code"] == $k)
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
        }
    }
}
?>
<?php include_once("includes/header.php"); ?>
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
                                    <li class="breadcrumb-item"><a href="shop.php">shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">cart</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-padding">
            <div class="container" id="cart_page_updated">
         
            </div>
        </div>
        <!-- cart main wrapper end -->
    </main>

<?php include_once("includes/footer.php"); ?>

  