<?php  
    error_reporting(0);
    session_start();  
    include_once("includes/header.php"); 
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
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">checkout</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- checkout main wrapper start -->
        <div class="checkout-page-wrapper section-padding">
            <div class="container">
                <div class="row justify-content-center">

                    <!-- Order Summary Details -->
                    <div class="col-lg-8">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Your Order Summary</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Products</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $cart_total_price = 0;
                                            if (isset($_SESSION["cart_item"]) && $_SESSION["cart_item"]!="") 
                                            {
                                                foreach (array_reverse($_SESSION["cart_item"]) as $key => $item)
                                                {
                                                    $cart_total_price += $item['price'] * $item['quantity']; 
                                                    echo'<tr>';
                                                    echo'    <td>';
                                                    echo'        <a href="'.baseUrl.'single-product.php?product_id='.$item['id'].'">';
                                                    echo'            '.$item['name'].' <strong> × '.$item['quantity'].'</strong>';
                                                    echo'        </a>';
                                                    echo'    </td>';
                                                    echo'    <td>'.$item['price'] * $item['quantity'].'QAR</td>';
                                                    echo'</tr>';
                                                }
                                            }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><h4>Sub Total</h4></td>
                                                <td><h4><?php echo $cart_total_price; ?>QAR</h4></td>
                                            </tr>
                                            <tr>
                                                <td><h4>Total Amount</h4></td>
                                                <td><h4><?php echo $cart_total_price; ?>QAR</h4></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" checked id="paypalpayment" name="paymentmethod"
                                                    value="paypal" class="custom-control-input" />
                                                <label class="custom-control-label" for="paypalpayment">Paypal <img
                                                        src="assets/img/paypal-card.jpg" class="img-fluid paypal-card"
                                                        alt="Paypal" /></label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" data-method="paypal">
                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                PayPal account.</p>
                                        </div>
                                    </div>
                                    <form action="<?php echo baseUrl; ?>includes/placeOrder.php" method="POST">
                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="hidden" value="<?php echo $cart_total_price; ?>" name="amount" />
                                            <input type="checkbox" class="custom-control-input" id="terms" required />
                                            <label class="custom-control-label" for="terms">I have read and agree to
                                                the website <a href="#">terms and conditions.</a></label>
                                        </div>
                                        <button type="submit" class="btn btn-sqr">Place Order</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout main wrapper end -->
    </main>

<?php include_once("includes/footer.php"); ?>