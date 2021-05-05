function getSliderSettings(){
    return {
        autoplay: false,
        autoplaySpeed: 10000,
        dots: false,
        infinite: false,
        arrows: true,
        speed: 1000,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: '<button type="button" class="slick-prev slick-arrow" style=""><i class="pe-7s-angle-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow" style=""><i class="pe-7s-angle-right"></i></button>',
        responsive: [{
                breakpoint: 1280,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            }, {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: true,
                    autoplay: true
                }
                }, {
                    breakpoint: 768,
                    settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: true
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: true
                    }
            }]
    }
}

function getCategoryWiseData(category_id,category_name,baseUrl) {
	$("#pills-tabContent").find(".tab-pane").attr("id", "pills-"+category_name);
	$("#pills-tabContent").find(".tab-pane").attr("aria-labelledby", "pills-"+category_name+"-tab");
	$("#pills-"+category_name).addClass('active');
    $("#product-slider-init").slick('unslick');
    if(category_name=='Appoinment'){
		window.location.href = baseUrl+"myaccount.php";
	}

	html3 = '';
	$.ajax({
		type : 'POST',
		url : baseUrl+'/includes/commonFile.php',
		data : {'type':'getCateoryWiseProduct','category_id':category_id},
		dataType : 'json',
		success : function(data) {
			// console.log(data);
			var totalCnt = data['total'];
			if(totalCnt>0)
			{
				$(data['data']).each(function(key, val){

					var singleProduct = baseUrl+"single-product.php?product_id="+val['variants'][0]['product_id'];
					var image = val['image'];
					var name = val['name'];

					var final_price = 0;
                    var percent = 0;
                    if(val['variants'][0]['discounted_price']!='') {
                        var final_price = val['variants'][0]['discounted_price'];
                        var percent = ((val['variants'][0]['price']- val['variants'][0]['discounted_price'])*100) /val['variants'][0]['price'];
                    }  else {
                        var final_price = val['variants'][0]['price'];
                    }
                  


                    html3+='										<div class="product-item">';
                    html3+='                                            <figure class="product-thumb">';
                    html3+='                                        <a href="'+singleProduct+'">';
                    html3+='                                            <img class="pri-img" src="'+image+'" ';
                    html3+='                                                alt="product">';
                    html3+='                                            <img class="sec-img" src="'+image+'" ';
                    html3+='                                                alt="product">';
                    html3+='                                        </a>';
                    html3+='                                        <div class="product-badge">';
                    html3+='                                            <div class="product-label new">';
                    html3+='                                                <span>new</span>';
                    html3+='                                            </div>';
                    html3+='                                            <div class="product-label discount">';
                    html3+='                                                <span>'+percent+'%</span>';
                    html3+='                                            </div>';
                    html3+='                                        </div>';
                    html3+='                                        <div class="button-group">';
                    // html3+='                                            <a href="wishlist.html" data-toggle="tooltip" data-placement="left"';
                    // html3+='                                                title="Add to wishlist"><i class="pe-7s-like"></i></a>';
                    // html3+='                                            <a href="compare.html" data-toggle="tooltip" data-placement="left"';
                    // html3+='                                                title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>';
                    html3+='                                            <a href="'+singleProduct+'" title="Quick View"><i class="pe-7s-search"></i></span></a>';
                    html3+='                                        </div>';
                    // html3+='                                        <div class="cart-hover">';
                    // html3+='                                            <button class="btn btn-cart">add to cart</button>';
                    // html3+='                                        </div>';
                    html3+='                                    </figure>';
                    html3+='                                    <div class="product-caption">';
                    // html3+='                                        <div class="product-identity">';
                    // html3+='                                            <p class="manufacturer-name"><a href="'+singleProduct+'">Gold</a>';
                    // html3+='                                            </p>';
                    // html3+='                                        </div>';
                    html3+='                                        <h6 class="product-name">';
                    html3+='                                            <a href="'+singleProduct+'">'+name+'</a>';
                    html3+='                                        </h6>';
                    html3+='                                        <div class="price-box">';
                    html3+='                                            <span class="price-regular">'+val['variants'][0]['discounted_price']+'QAR</span>';
                    html3+='                                            <span class="price-old"><del>'+val['variants'][0]['price']+'QAR</del></span>';
                    html3+='                                        </div>';
                    html3+='                                    </div>';
                    html3+='                                </div>';

				});
			} else {
				html3 = 'No Records Found';
			}
			$("#product-slider-init").html(html3);			
            $("#product-slider-init").slick(getSliderSettings());
		}, error:function(error) {
			// console.log(data);
		}
	});	
	// window.location.href = baseUrl+"index.php?type="+type+"&category_id="+category_id+"&category_name="+category_name;
}