<?php
    error_reporting(0);
    session_start();
    include_once("includes/header.php");

      $curl = curl_init();        
      if (isset($_REQUEST['product_id'])) 
      {
        $product_id = $_REQUEST['product_id'];     
      }  
      curl_setopt_array($curl, array(
      CURLOPT_URL => ApiUrl."get-product-by-id.php",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "accesskey=90336&product_id=$product_id",
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
    } 
    $data = json_decode($response);
    //echo "<pre>";print_r($data);echo "</pre";die();    


if(isset($_GET['action'])) {
    $action = $_GET['action'];
    
    if($action == 'add') {
        $productData = $_POST['productData'];
        $qty = $_POST['qty'];
        $productId = $_GET['product_id'];
        //$itemArray = array();
        $exp_ProductData = explode("=", $productData);
        $product_name = $exp_ProductData[0];
        $product_price = $exp_ProductData[1];
        $product_image = $exp_ProductData[2];

        $itemArray = array('name'=>$product_name, 'id'=>$productId, 'quantity'=>$qty, 'price'=>$product_price, 'image'=>$product_image);
        $f = 0;
        if(!empty($_SESSION["cart_item"])) 
        {
            foreach($_SESSION["cart_item"] as $k => $v) 
            {
                if($v['id'] === $productId) 
                {
                    if(empty($_SESSION["cart_item"][$k]["quantity"])) 
                    {
                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                    }
                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["qty"];
                    $f = 1;
                }
                else
                {
                    //
                }
            }
            if($f == 0) 
            {
                $_SESSION["cart_item"][$productId] = $itemArray;
                //$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
            }
            
        }
        else 
        {
            $_SESSION["cart_item"][$productId] = $itemArray;
        }
    }
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
                                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.php">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">product details</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <?php
                            $final_price = 0;
                            if($data->data[0]->variants[0]->discounted_price!='') {
                                $final_price = $data->data[0]->variants[0]->discounted_price;
                            }  else {
                                $final_price = $data->data[0]->variants[0]->price;
                            }
                            $percent = (($data->data[0]->variants[0]->price - $data->data[0]->variants[0]->discounted_price)*100) /$data->data[0]->variants[0]->price;

                        ?>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom">
                                        <img src="<?php echo $data->data[0]->image; ?>"
                                            alt="product-details" />
                                    </div>
                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <div class="pro-nav-thumb">
                                        <img src="<?php echo $data->data[0]->image; ?>"
                                            alt="product-details" />
                                    </div>
                                </div>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>new</span>
                                    </div>
                                    <div class="product-label discount">
                                        <span><?php echo round($percent); ?>%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <!-- <div class="manufacturer-name">
                                        <a href="product-details.html">HasTech</a>
                                    </div> -->
                                    <h3 class="product-name"><?php echo $data->data[0]->name ?></h3>
                                    <input type="hidden" id="baseUrl" value="<?php echo baseUrl; ?>">
                                    <input type="hidden" value="<?php echo $data->data[0]->name."=".$final_price."=".$data->data[0]->image; ?>" name="productData">
                                    <!-- <div class="ratings d-flex">
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <div class="pro-review">
                                            <span>1 Reviews</span>
                                        </div>
                                    </div> -->     
                                    <form method="post" class="add_product_storage" >
                                                       
                                     
                                    <div class="price-box">
                                        <span class="price-regular"><?php echo $data->data[0]->variants[0]->discounted_price;  ?> QAR</span>
                                        <span class="price-old"><del><?php echo $data->data[0]->variants[0]->price;  ?> QAR</del></span>
                                    </div>
                                    <!-- <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                                    <div class="product-countdown" data-countdown="2019/12/20"></div> -->
                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span><?php echo $data->data[0]->variants[0]->stock;  ?> in stock</span>
                                    </div>
                                    <p class="pro-desc"><?php echo $data->data[0]->description; ?></p>
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <h6 class="option-title">qty:</h6>
                                        <div class="quantity">
                                            <div class="pro-qty"><input type="number" min="1" max="10" value="1" name="qty"></div>
                                        </div>
                                        <div class="action_link">
                                            <button type="submit" class="btn btn-cart2">Add to cart</button>
                                        </div>
                                    </div>
                                    <div class="pro-size">
                                        <h6 class="option-title">size :</h6>
                                        <select class="form-control varation_mesurment nice-select">
                                            <?php foreach ($data->data[0]->variants as $value) 
                                            {
                                                $option_value = $value->measurement." ".$value->measurement_unit_name;
                                                if($value->discounted_price!='') {
                                                    $final_price = $value->discounted_price;
                                                }  
                                                else 
                                                {
                                                    $final_price = $value->price;
                                                }
                                                ?>
                                                <?php //echo "final_price =".$final_price; ?>
                                                <option data-name="<?php echo $data->data[0]->name; ?>" data-image="<?php echo $data->data[0]->image; ?>" data-servefor="<?php echo $value->serve_for; ?>" data-stock="<?php echo $value->stock; ?>" data-finalpirce="<?php echo $final_price; ?>" data-discountedprice="<?php echo $value->discounted_price; ?>"  data-price="<?php echo $value->price; ?>"  data-productid="<?php echo $value->product_id; ?>" value="<?php echo $value->id;  ?>"><?php echo $option_value; ?></option>
                                                <?php            
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                    <?php
                                        $option_value = $data->data[0]->variants[0]->measurement." ".$data->data[0]->variants[0]->measurement_unit_name;
                                                    if($data->data[0]->variants[0]->discounted_price!='') {
                                                        $final_price = $data->data[0]->variants[0]->discounted_price;
                                                    }  
                                                    else 
                                                    {
                                                        $final_price = $data->data[0]->variants[0]->price;
                                                    }
                                    ?>   
                                        <input type="hidden" value="addCart" name="type">
                                        <input type="hidden" value="<?php echo $data->data[0]->id; ?>" name="id">
                                        <input type="hidden" value="<?php echo $data->data[0]->name; ?>" name="name">
                                        <input type="hidden" value="<?php echo $final_price; ?>" name="final_price">
                                        <input type="hidden" value="<?php echo $data->data[0]->image; ?>" name="image">  
                                    <!-- <div class="color-option">
                                        <h6 class="option-title">color :</h6>
                                        <ul class="color-categories">
                                            <li>
                                                <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                            </li>
                                            <li>
                                                <a class="c-darktan" href="#" title="Darktan"></a>
                                            </li>
                                            <li>
                                                <a class="c-grey" href="#" title="Grey"></a>
                                            </li>
                                            <li>
                                                <a class="c-brown" href="#" title="Brown"></a>
                                            </li>
                                        </ul>
                                    </div> -->
                                    <!-- <div class="useful-links">
                                        <a href="#" data-toggle="tooltip" title="Compare"><i
                                                class="pe-7s-refresh-2"></i>compare</a>
                                        <a href="#" data-toggle="tooltip" title="Wishlist"><i
                                                class="pe-7s-like"></i>wishlist</a>
                                    </div>
                                    <div class="like-icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div> -->
                                    </form>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#tab_one">description</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#tab_two">information</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                <p><?php echo $data->data[0]->description; ?></p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_two">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <?php foreach ($data->data[0]->variants as $value) 
                                                        {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $value->measurement_unit_name; ?></td>
                                                                <td><?php echo $value->measurement; ?></td>
                                                            </tr>
                                                        <?php            
                                                        } 
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

</main>

<?php include_once("includes/footer.php"); ?>