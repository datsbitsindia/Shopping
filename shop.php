<?php
    error_reporting(0);
    session_start();
    include_once("includes/header.php");
$productCnt = 0;
$limit = 12;
$currentPage = 1;
if(isset($_GET['type'])) {
    $type = $_GET['type'];
    if($type == 'search') {
        $text = $_POST['txtSearch'];
        if($text!='') {
            $_SESSION['txtSearch'] = $text;
            $url = ApiUrl.'products-search.php';
            $postData = 'type=products-search&accesskey=90336&search='.$text;
        } else {
            $_SESSION['txtSearch'] = '';
            $startFrom = 0;
            $url = ApiUrl.'get-all-products.php';
            $postData = 'get_all_products=1&accesskey=90336&offset='.$startFrom.'&limit='.$limit;    
        }
    }
} else {
    if(!empty($_SESSION['txtSearch'])) {
        $text = $_SESSION['txtSearch'];
    }

    $cond = '';
    if(!empty($_GET['order']) && !empty($_GET['sort1'])) {
        $order = $_GET['order'];
        $sort1 = $_GET['sort1'];
        $cond = '&order='.$order.'&sort1='.$sort1;
        $_SESSION['sort_order'] = $cond;
    } else {
        if(!empty($_GET["page"])){
            $currentPage = intval($_GET["page"]);
        }
        else 
        {
            $_SESSION['sort_order'] = '';
        }
    }

    if(!empty($_SESSION['sort_order'])) {
        $cond = $_SESSION['sort_order'];
    }    
    
    $startFrom = ($currentPage * $limit) - $limit;

    if(!empty($_SESSION['txtSearch'])) {
        $url = ApiUrl.'products-search.php';
        $postData = 'type=products-search&accesskey=90336&search='.$text.'&offset='.$startFrom.'&limit='.$limit."".$cond;    
    } else {
        $url = ApiUrl.'get-all-products.php';
        $postData = 'get_all_products=1&accesskey=90336&offset='.$startFrom.'&limit='.$limit."".$cond;
    }
}

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $postData,
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
    $data = json_decode($response,TRUE);
    if(isset($data['total'])) {
        $productCnt = $data['total'];
    } else {
        $productCnt = count($data['data']);    
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
                                <li class="breadcrumb-item active" aria-current="page">shop</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- shop main wrapper start -->
                <div class="col-lg-12">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view" data-toggle="tooltip"
                                                title="Grid View"><i class="fa fa-th"></i></a>
                                            <a href="#" data-target="list-view" data-toggle="tooltip"
                                                title="List View"><i class="fa fa-list"></i></a>
                                        </div>
                                        <div class="product-amount">
                                            <p>Showing 1–16 of <?php echo $productCnt; ?> results</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                    <div class="top-bar-right">
                                        <?php 
                                            $buttonVal = 'relevance';
                                            if($sort1=='name' && $order=='ASC') {
                                                $buttonVal = 'name_a_z';
                                            } else if($sort1=='name' && $order=='DESC') {
                                                $buttonVal = 'name_z_a';
                                            } else {
                                                $buttonVal = 'relevance';
                                            }
                                        ?>
                                        <div class="product-short">
                                            <p>Sort By : </p>
                                            <select class="nice-select" name="sortby" id="sortByProduct">
                                                <option value="relevance">Relevance</option>
                                                <option value="name_a_z">Name (A - Z)</a></option>
                                                <option value="name_z_a">Name (Z - A)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $data = json_decode($response);
                            $totalEmployee = $data->total;
                            $lastPage = ceil($totalEmployee/$limit);
                            $firstPage = 1;
                            $nextPage = $currentPage + 1;
                            $previousPage = $currentPage - 1;
                        ?>
                        <!-- shop product top wrap start -->

                        <!-- product item list wrapper start -->
                        <div class="shop-product-wrap grid-view row mbn-30">
                            <!-- product single item start -->
                            <?php
                            if (!empty($data) && $data->error!=1) {
                                foreach ($data->data as $value) 
                                {
                            ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <!-- product grid start -->
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="<?php echo baseUrl; ?>single-product.php?product_id=<?php echo $value->variants[0]->product_id; ?>">
                                                <img class="pri-img" src="<?php echo $value->image ?>" alt="product">
                                                <img class="sec-img" src="<?php echo $value->image ?>" alt="product">
                                            </a>
                                            <?php
                                                $final_price = 0;
                                                if($value->variants[0]->discounted_price!='') {
                                                    $final_price = $value->variants[0]->discounted_price;
                                                }  else {
                                                    $final_price = $value->variants[0]->price;
                                                }
                                                $percent = (($value->variants[0]->price - $value->variants[0]->discounted_price)*100) /$value->variants[0]->price;

                                            ?>
                                            <div class="product-badge">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-label discount">
                                                    <span><?php echo round($percent); ?>%</span>
                                                </div>
                                            </div>
                                            <div class="button-group">
                                                <!-- <a href="wishlist.html" data-toggle="tooltip" data-placement="left"
                                                    title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                                <a href="compare.html" data-toggle="tooltip" data-placement="left"
                                                    title="Add to Compare"><i class="pe-7s-refresh-2"></i></a> -->
                                                <a href="<?php echo baseUrl; ?>single-product.php?product_id=<?php echo $value->variants[0]->product_id; ?>">
                                                    <span
                                                        data-toggle="tooltip" data-placement="left"
                                                        title="Quick View"><i class="pe-7s-search"></i></span></a>
                                            </div>
                                            <div class="cart-hover">
                                                <form method="post" class="add_product_storage" >
                                                    <input type="hidden" value="addCart" name="type">
                                                    <input type="hidden" value="<?php echo $value->id; ?>" name="id">
                                                    <input type="hidden" value="1" name="qty">
                                                    <input type="hidden" value="<?php echo $value->name; ?>" name="name">
                                                    <input type="hidden" value="<?php echo $final_price; ?>" name="final_price">
                                                    <input type="hidden" value="<?php echo $value->image; ?>" name="image">                            
                                                    <button type="submit"  class="btn btn-cart">add to cart</button>
                                                </form>  
                                            </div>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <!-- <div class="product-identity">
                                                <p class="manufacturer-name"><a href="product-details.html">Platinum</a>
                                                </p>
                                            </div>
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
                                            </ul> -->
                                            <h6 class="product-name">
                                                <a href="<?php echo baseUrl; ?>single-product.php?product_id=<?php echo $value->variants[0]->product_id; ?>">
                                                    <?php echo $value->name; ?>
                                                </a>
                                            </h6>
                                            <div class="price-box">
                                                <span class="price-regular"><?php echo $value->variants[0]->discounted_price;  ?> QAR</span>
                                                <span class="price-old"><del><?php echo $value->variants[0]->price;  ?> QAR</del></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid end -->

                                    <!-- product list item end -->
                                    <div class="product-list-item">
                                        <figure class="product-thumb">
                                            <a href="<?php echo baseUrl; ?>single-product.php?product_id=<?php echo $value->variants[0]->product_id; ?>">
                                                <img class="pri-img" src="<?php echo $value->image ?>"  alt="product">
                                                <img class="sec-img" src="<?php echo $value->image ?>" alt="product">
                                            </a>                                            
                                            <?php
                                                $final_price = 0;
                                                if($value->variants[0]->discounted_price!='') {
                                                    $final_price = $value->variants[0]->discounted_price;
                                                }  else {
                                                    $final_price = $value->variants[0]->price;
                                                }
                                                $percent = (($value->variants[0]->price - $value->variants[0]->discounted_price)*100) /$value->variants[0]->price;

                                            ?>
                                            <div class="product-badge">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-label discount">
                                                    <span><?php echo round($percent); ?>%</span>
                                                </div>
                                            </div>
                                            <div class="button-group">
                                                <!-- <a href="wishlist.html" data-toggle="tooltip" data-placement="left"
                                                    title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                                <a href="compare.html" data-toggle="tooltip" data-placement="left"
                                                    title="Add to Compare"><i class="pe-7s-refresh-2"></i></a> -->
                                                <a href="<?php echo baseUrl; ?>single-product.php?product_id=<?php echo $value->variants[0]->product_id; ?>">
                                                    <span
                                                        data-toggle="tooltip" data-placement="left"
                                                        title="Quick View"><i class="pe-7s-search"></i></span></a>
                                            </div>
                                            <div class="cart-hover">
                                                <form method="post" action="single-product.php?action=add&product_id=<?php echo $value->id; ?>">
                                                    <input type="hidden" value="1" name="qty">
                                                    <button type="submit" class="btn btn-cart">add to cart</button>
                                                </form>
                                            </div>
                                        </figure>
                                        <div class="product-content-list">
                                            <!-- <div class="manufacturer-name">
                                                <a href="product-details.html">Platinum</a>
                                            </div> -->
                                            <!-- <ul class="color-categories">
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
                                            </ul> -->

                                            <h5 class="product-name">
                                                <a href="<?php echo baseUrl; ?>single-product.php?product_id=<?php echo $value->variants[0]->product_id; ?>">
                                                    <?php echo $value->name; ?>
                                                </a>
                                            </h5>
                                            <div class="price-box">
                                                <span class="price-regular"><?php echo $value->variants[0]->discounted_price;  ?> QAR</span>
                                                <span class="price-old"><del><?php echo $value->variants[0]->price;  ?> QAR</del></span>
                                            </div>
                                            <p><?php echo $value->description; ?></p>
                                        </div>
                                    </div>
                                    <!-- product list item end -->
                                </div>
                            <?php        
                                }
                            } else {
                                echo '<div class="card-body">No Records Found</div>';
                            }
                            ?>
                            <!-- product single item start -->
                        </div>
                        <!-- product item list wrapper end -->

                        <!-- start pagination area -->
                        <div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                <?php if($currentPage != $firstPage) { ?>
                                    <li><a class="previous" href="?page=<?php echo $firstPage ?>"><i class="pe-7s-angle-left"></i></a></li>
                                <?php } ?>
                                <?php if($currentPage >= 2) { ?>
                                    <li><a href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
                                <?php } ?>
                                    <li class="active"><a  href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>
                                <?php if($currentPage != $lastPage) { ?>
                                    <li><a href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
                                    <li><a class="next" href="?page=<?php echo $lastPage ?>"><i class="pe-7s-angle-right"></i></a></li>
                                <?php } ?>
                               
                            </ul>
                        </div>
                        <!-- end pagination area -->
                    </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
</main>

<?php include_once("includes/footer.php"); ?>

<script>
var base_url = "<?php echo baseUrl ?>";
var buttonVal = "<?php echo $buttonVal ?>";
$('#sortByProduct').val(buttonVal);
$('#sortByProduct').niceSelect('update'); 

$('#sortByProduct').on('change', function() {
    console.log($(this).val());
    if($(this).val() == 'relevance'){
        window.location.replace(base_url+"shop.php?order=ASC&sort1=id");
    } else if($(this).val() == 'name_a_z'){
        window.location.replace(base_url+"shop.php?order=ASC&sort1=name");
    } else if($(this).val() == 'name_z_a'){
        window.location.replace(base_url+"shop.php?order=DESC&sort1=name");
    }
    // window.location.replace("http://stackoverflow.com");
});

</script>