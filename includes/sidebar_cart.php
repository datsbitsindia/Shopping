<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
            <div class="minicart-inner-content">
                <div class="minicart-close">
                    <i class="pe-7s-close"></i>
                </div>
                <div class="minicart-content-box">
                    <div class="minicart-item-wrapper">
                        <ul  id="minicartinnercontent_update">
                        </ul>
                    </div>

                    <div class="minicart-pricing-box">
                        <ul>
                            <li>
                                <span>sub-total</span>
                                <span>
                                    <strong>
                                        <span class="minicart_total_price">
                                            <?php echo $total_price; ?>
                                        </span>QAR
                                    </strong>
                                </span>
                            </li>
                            <!-- <li>
                                <span>Eco Tax (-2.00)</span>
                                <span><strong>$10.00</strong></span>
                            </li>
                            <li>
                                <span>VAT (20%)</span>
                                <span><strong>$60.00</strong></span>
                            </li> -->
                            <li class="total">
                                <span>total</span>
                                <span>
                                    <strong> 
                                        <span class="minicart_total_price">
                                            <?php echo $total_price; ?>
                                        </span>QAR
                                    </strong>
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="minicart-button">
                        <a href="<?php echo baseUrl; ?>cart.php"><i class="fa fa-shopping-cart"></i> View Cart</a>
                        <a href="<?php echo baseUrl; ?>checkout.php"><i class="fa fa-share"></i> Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->