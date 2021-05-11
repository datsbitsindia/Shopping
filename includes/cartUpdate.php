<?php
include_once("constant.php");
error_reporting(0);
session_start(); 
?>

    <?php
        $total_price = 0;
        $total_quantity = 0;                            
        if(isset($_SESSION["cart_item"]) && !empty($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $item)
            {
            ?>
            
                <li class="minicart-item">
                    <div class="minicart-thumb">
                        <a href="<?php echo baseUrl; ?>single-product.php?product_id=<?php echo $item['id']; ?>">
                            <img src="<?php echo $item['image']; ?>" alt="product">
                        </a>
                    </div>
                    <div class="minicart-content">
                        <h3 class="product-name">
                            <a href="<?php echo baseUrl; ?>single-product.php?product_id=<?php echo $item['id']; ?>">
                                <?php echo $item['name']; ?>
                            </a>
                        </h3>
                        <p>
                            <span class="cart-quantity"><?php echo $item['quantity'] ?> <strong>&times;</strong></span>
                            <span class="cart-price"><?php echo $item['price'] ?>QAR</span>
                        </p>
                    </div>
                    <a role="button" onclick="cartRemove(<?php echo $item['id'] ?>)">
                        <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                    </a>
                </li>
            
            <?php
                $total_quantity += $item["quantity"];
                $total_price += ($item["price"]*$item["quantity"]);    
                $item_quantity ++;
            }    
        }
    ?>
    

<script>
 $(document).ready(function() {
    var cart_items = <?php echo json_encode($_SESSION["cart_item"]); ?>;
    var total_price = 0;
    var total_quantity = 0;                     
    if(cart_items != '') {
        $.each(cart_items, function(index, value) {
            total_price += Number(value['price'] * value['quantity']);
            total_quantity += Number(value['quantity']);
        });
    }
    $('.minicart_item_quantity').text(total_quantity);
    $('.minicart_total_price').text(total_price);
 });
</script>