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
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Thumbnail</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $cart_total_price = 0;
                                        if (isset($_SESSION["cart_item"]) && $_SESSION["cart_item"]!="") 
                                        {
                                            foreach (array_reverse($_SESSION["cart_item"]) as $key => $item)
                                            {
                                                
                                    ?>
                                        <tr class="cart_items_calculate">
                                            <td class="pro-thumbnail">
                                                <a href="<?php echo baseUrl; ?>single-product.php?product_id=<?php echo $item['id']; ?>">
                                                    <img class="img-fluid"  src="<?php echo $item['image']; ?>" alt="Product" />
                                                </a>
                                            </td>
                                            <td class="pro-title">
                                                <a href="<?php echo baseUrl; ?>single-product.php?product_id=<?php echo $item['id']; ?>">
                                                    <?php echo $item['name']; ?>
                                                </a>
                                            </td>
                                            <td class="pro-price"><span><?php echo $item['price'] ?>QAR</span></td>
                                            <td class="pro-quantity" >
                                                <div class="pro-qty" min="1" id="<?php echo $item['id']; ?>">
                                                    <input type="text" disabled value="<?php echo $item['quantity'] ?>" id="itemQty_<?php echo $item['id']; ?>">
                                                </div>
                                            </td>
                                            <td class="pro-subtotal">                                                
                                                <input type="hidden" id="itemPrice_<?php echo $item['id']; ?>" value="<?php echo $item['price']; ?>">
                                                <input type="hidden" id="baseUrl" value="<?php echo baseUrl; ?>">
                                                <span class="calculate_subtotal" id="totalProductPrice_<?php echo $item['id']; ?>">
                                                <?php
                                                        $price = $item['price'] * $item['quantity']; 
                                                        $cart_total_price += $item['price'] * $item['quantity']; 
                                                        echo $price; 
                                                ?>
                                                </span>QAR  
                                            </td>
                                            <td class="pro-remove"><a href="<?php echo baseUrl; ?>cart.php?action=remove&code=<?php echo $item['id']; ?>"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                        <?php        
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="6">
                                                Your cart is currently empty.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" colspan="6">
                                                <a class="btn theme-btn--dark3 theme-btn--dark3-sm btn--sm rounded-5" href="<?php echo baseUrl; ?>shop.php">RETURN TO SHOP</a>    
                                            </td>
                                        </tr>
                                    <?php        
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            <!-- <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="apply-coupon-wrapper">
                                    <form action="#" method="post" class=" d-block d-md-flex">
                                        <input type="text" placeholder="Enter Your Coupon Code" required />
                                        <button class="btn btn-sqr">Apply Coupon</button>
                                    </form>
                                </div>
                                <div class="cart-update">
                                    <a href="#" class="btn btn-sqr">Update Cart</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h6>Cart Totals</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Sub Total</td>
                                                <td>
                                                    <span id="subtotal_calculate_carts">
                                                        <?php echo $cart_total_price; ?>
                                                    </span>QAR
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td>Shipping</td>
                                                <td>$70</td>
                                            </tr> -->
                                            <tr class="total">
                                                <td>Total</td>
                                                <td class="total-amount" >
                                                    <span id="total_calculate_carts">
                                                        <?php echo $cart_total_price; ?>
                                                    </span>QAR
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="checkout.php" class="btn btn-sqr d-block">Proceed Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
    </main>

<?php include_once("includes/footer.php"); ?>

  