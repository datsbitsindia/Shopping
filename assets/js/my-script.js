$(document).ready(function(){
	$(".count-btn").click(function(){
		var baseUrl = $("#baseUrl").val();
		var productId = $(this).parent().attr('id');
		var qty = parseInt($("#itemQty_"+productId).val());
		var price = parseInt($("#itemPrice_"+productId).val());
		$.ajax({
			method : "POST",
			url : baseUrl+'includes/commonFile.php',
			dataType : 'html',
			data : {'type':'updateCart','productId':productId,'qty':qty},
			success : function(res){
				console.log(res);
			}, error:function(error){
				console.log(error);
			}
		});

		var totalProductPrice = parseInt(price * qty);
		$("#totalProductPrice_"+productId).html(totalProductPrice);
		var calculate_cart_price = 0;
		$(".cart_items_calculate").each(function(){			
			calculate_cart_price += Number($(this).find('.pro-subtotal').find('.calculate_subtotal').text());
		});
		$("#subtotal_calculate_carts").html(calculate_cart_price);
		$("#total_calculate_carts").html(calculate_cart_price);
	})

	var currentUrl = window.location.href;
	console.log(currentUrl);
	$(".main-menu li").each(function(){
		if($(this).attr('class') == currentUrl) {
			$(this).addClass('active');
		}
	});

	var type = $("#getSlug").val();
    if(type == 'bookAppoinment') {
        $("#accountInfo").removeClass('active');
        $("#account-info").removeClass('active show');
        $("#bookAppoinment").addClass('active');
        $("#book-appointment").addClass('active show');
    }
});

function verifyMobileNo () {
	var baseUrl = $("#baseUrl").val();
	var mobileno = $("#mobileno").val();
	$.ajax({
		type : 'POST',
		url : baseUrl+'includes/verifyMobileNo.php',
		data : {'type':'verify-user','mobile':mobileno},
		dataType : 'json',
		success : function(data) {
			alert(data['message']);
			if(data['error'] == 1) {
				window.location.href = baseUrl+'register.php';
			} else {
				$("#isValidMobileNo").val('1');
			}
		}, error : function(error) {
			console.log(error);
		}
	});
}

function verifyEmail() {
	var baseUrl = $("#baseUrl").val();
	var emailId = $("#emailId").val();
	$.ajax({
		type : 'POST',
		url : baseUrl+'includes/verifyEmail.php',
		data : {'type':'verify-user-email','emailId':emailId},
		dataType : 'json',
		success : function(data) {
			alert(data['message']);
			if(data['error'] == 1) {
				window.location.href = baseUrl+'register.php';
			} else {
				$("#isValidEmail").val('1');
			}
		}, error : function(error) {
			console.log(error);
		}
	});
}

function register() {
	var isValidMobileNo = $("#isValidMobileNo").val();
	var isValidEmail = $("#isValidEmail").val();
	if(isValidMobileNo==1 && isValidEmail==1) {
		$('#btnRegister').prop("disabled", false);
		$("#frmRegister").submit();
	} else {
		alert("Please verify Mobile No and Email Id");
		return false;
	}
}

function getCities(id) {
	//alert(id);
	var baseUrl = $("#baseUrl").val();
	html = '';
	$.ajax({
		type : 'POST',
		url : baseUrl+'includes/commonFile.php',
		data : {'type':'getCities'},
		dataType : 'json',
		success : function(data) {
			console.log(data);
			html = '<option value="0">Select City</option>';
			if(data['error'] == 0) {
				$(data['data']).each(function(key, val){
					html += '<option value='+val['id']+'>'+val['name']+'</option>';
				});
				$("#city_name").html(html);
				if (id!="") 
				{
					$("#city_name").val(id);
				}
				
			}
		}, error : function(error) {
			console.log(error);
		}
	});	
}

function getArea(id) {
	// alert(id);
	var baseUrl = $("#baseUrl").val();
	var city_name = $("#city_name").val();
	// console.log("city_name",city_name);
	html2 = '';
	$.ajax({
		type : 'POST',
		url : baseUrl+'includes/commonFile.php',
		data : {'type':'getArea','city_name':city_name},
		dataType : 'json',
		success : function(data) {
			console.log(data);
			html2 = '<option value="0">Select Area</option>';
			if(data['error'] == 0) {
				$(data['data']).each(function(key, val){
					html2 += '<option value='+val['id']+'>'+val['name']+'</option>';
				});
				$("#area_name").html(html2);
				if (id!="") 
				{
					$("#area_name").val(id);
				}
			}
		}, error : function(error) {
			console.log(error);
		}
	});
}
$(document).on('change',".varation_mesurment",function(){
	var m_value = this.value;
	var baseUrl = $("#baseUrl").val();
	//var p_id = this.data('productid');
	var selected = $(this).find('option:selected');
    var p_id = selected.data('productid'); 
    var servefor = selected.data('servefor'); 
    var stock = selected.data('stock'); 
    var discountedprice = selected.data('discountedprice'); 
    var price = selected.data('price');
    var finalpirce = selected.data('finalpirce'); 
    var name = selected.data('name'); 
    var image_name = selected.data('image'); 
    $('.regular_price').text(price + " QAR"); 
    $('.sale_price').text(discountedprice + " QAR"); 
    $('.text_stock').text(stock);
    var final_string = name+"="+finalpirce+"="+image_name;
    jQuery('input[name="productData"]').val(final_string);
});


$(document).ready(function () {

    $('#log-in-form').validate({ // initialize the plugin
        rules: {
            txtMobileNo: {
                required: true
            },
            password: {
                required: true
            }
        }
    });
    $('#frmRegister').validate({ // initialize the plugin
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            emailId: {
                required: true,
                email:true
            },
            mobileno: {
                required: true
            },
           	city_name:{
           		required: true	
           	},
           	area_name:{
           		required: true	
           	},
           	password:{
           		required: true	
           	},
           	dob:{
           		required: true	
           	},
           	Street:{
           		required: true	
           	},
           	Pincode:{
           		required: true	
           	}
        }
    });
    $('#insert_form').validate({
		rules: {
            input_name: {
                required: true
            },
            input_email:{
            	required: true,
            	email:true
            },
            mobile_number:{
            	required: true	
            },
            city_name:{
            	required: true		
            },
            area_name:{
            	required: true		
            },
            input_address:{
            	required: true		
            },
            input_code:{
            	required: true		
            },
            input_dob:{
            	required: true		
            }
       	}    	
    });
});

function getCategoryWiseData(category_id,category_name,baseUrl) {
	$('.product-slider-init').slick('unslick');
	$(".tab-pane").attr("id", "pills-"+category_name);
	$(".tab-pane").attr("aria-labelledby", "pills-"+category_name+"-tab");

	$("#pills-"+category_name+"-tab").addClass('active');
	if(category_name=='Appoinment'){
		window.location.href = baseUrl+"myaccount.php";
	}

	html3 = '';
	$.ajax({
		type : 'POST',
		url : baseUrl+'includes/commonFile.php',
		data : {'type':'getCateoryWiseProduct','category_id':category_id},
		dataType : 'json',
		success : function(data) {
			console.log(data);
			var totalCnt = data['total'];
			if(totalCnt>0)
			{
				$(data['data']).each(function(key, val){

					var singleProduct = baseUrl+"single-product.php?product_id="+val['variants'][0]['product_id'];
					var image = val['image'];
					var name = val['name'];

					var final_price = 0;
                    if(val['variants'][0]['discounted_price']!='') {
                        var final_price = val['variants'][0]['discounted_price'];
                    }  else {
                        var final_price = val['variants'][0]['price'];
                    }

					html3+='<div class="slider-item">';
					html3+='<div class="product-list mb-30">';
					html3+='<div class="card product-card">';
					html3+='<div class="card-body p-0">';
					html3+='<div class="media flex-column">';
					html3+='<div class="product-thumbnail position-relative">';
					html3+='<span class="badge badge-danger top-right">New</span>';
					html3+='<a href="'+singleProduct+'">';
					html3+='<img class="first-img" src="'+image+'" alt="thumbnail">';
					html3+='</a>';
					html3+='</div>';
					html3+='<div class="media-body">';
					html3+='<div class="product-desc">';
					html3+='<h3 class="title"><a href="'+singleProduct+'">'+name+'</a></h3>';

					html3+='<div class="d-flex align-items-center justify-content-between">';
					html3+='<h6 class="product-price">'+final_price+' QAR</h6>';
					//html3+='<button class="pro-btn" data-toggle="modal" data-target="#add-to-cart"><i class="icon-basket"></i></button>';
					html3+='</div>';

					html3+='</div>';
					html3+='</div>';
					html3+='</div>';
					html3+='</div>';
					html3+='</div>';
					html3+='</div>';
					html3+='</div>';

				});
				
				
			} else {
				html3 = 'No Records Found';
			}
			$(".product-slider-init").html(html3);
			var $productSliderInit = $(".product-slider-init");
				$productSliderInit.slick({
	    		autoplay: false,
	    		autoplaySpeed: 10000,
	    dots: false,
	    infinite: false,
	    arrows: true,
	    speed: 1000,
	    slidesToShow: 5,
	    slidesToScroll: 1,
	    prevArrow: '<button class="slick-prev"><i class="ion-chevron-left"></i></button>',
	    nextArrow: '<button class="slick-next"><i class="ion-chevron-right"></i></button>',
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
    } // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
  });
		}, error:function(error) {
			console.log(data);
		}
	});	
	// window.location.href = baseUrl+"index.php?type="+type+"&category_id="+category_id+"&category_name="+category_name;
}