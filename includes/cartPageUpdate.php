<?php
include_once("constant.php");
error_reporting(0);
session_start(); 
?>
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
            <td class="pro-remove"><a role="button" onclick="cartRemove(<?php echo $item['id'] ?>)"><i class="fa fa-trash-o"></i></a></td>
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
<script>
$(document).ready(function() {
    $('.pro-qty').prepend('<span class="dec qtybtn cart_pro_qty" data-type="dec">-</span>');
    $('.pro-qty').append('<span class="inc qtybtn cart_pro_qty" data-type="inc">+</span>');
    $('.qtybtn').on('click', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
	});
});
</script>