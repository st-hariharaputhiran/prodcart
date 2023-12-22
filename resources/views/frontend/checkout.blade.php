@extends('layouts.app')
@section('content')
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Aroma Shop - Checkout</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!--================ Start Header Menu Area =================-->
	
	<!--================ End Header Menu Area =================-->

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Product Checkout</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  
  <!--================Checkout Area =================-->
  <section class="checkout_area section-margin--small">
    <div class="container">
    
        <div class="cupon_area">
            <div>
                <h3>Available Coupons</h3>
                <ul>
                    @foreach($coupons as $coupon)
                    <li>{{ $coupon->coupon_code }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="check_title">
                <h2>Have a coupon? <a href="#">Click here to enter your code</a></h2>
            </div>
            <input type="text" name="ccode" id="ccode" placeholder="Enter coupon code">
            <a class="button button-coupon" onclick="apcoupon()" href="#">Apply Coupon</a>
        </div>
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing Details</h3>
                    <form class="row contact_form" action="{{ route('goToPayment') }}" method="post">
                    @csrf
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="first" name="fname" value="{{ old('fname') }}">
                            <span class="placeholder" data-placeholder="First name"></span>
                            @error('fname')
                            <span style="color:red">{{ $errors->first('fname') }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="last" name="lname" value="{{ old('lname') }}">
                            <span class="placeholder" data-placeholder="Last name"></span>
                            @error('lname')
                            <span style="color:red">{{ $errors->first('lname') }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="company" name="company" placeholder="Company name" value="{{ old('company') }}">
                            @error('company')
                            <span style="color:red">{{ $errors->first('company') }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="pnumber" name="pnumber" value="{{ old('pnumber') }}">
                            <span class="placeholder" data-placeholder="Phone number"></span>
                            @error('pnumber')
                            <span style="color:red">{{ $errors->first('pnumber') }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="compemailany" value="{{ old('compemailany') }}">
                            <span class="placeholder" data-placeholder="Email Address"></span>
                            @error('compemailany')
                            <span style="color:red">{{ $errors->first('compemailany') }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <select name="country" class="country_select">
                                <option value="1">Country</option>
                                <option value="2">Country</option>
                                <option value="4">Country</option>
                            </select>
                            
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add1" name="add1" value="{{ old('add1') }}">
                            <span class="placeholder" data-placeholder="Address line 01"></span>
                            @error('add1')
                            <span style="color:red">{{ $errors->first('add1') }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add2" name="add2" value="{{ old('add2') }}">
                            <span class="placeholder" data-placeholder="Address line 02"></span>
                            
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                            <span class="placeholder" data-placeholder="Town/City"></span>
                            @error('city')
                            <span style="color:red">{{ $errors->first('city') }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <select name="district" class="country_select">
                                <option value="1">District</option>
                                <option value="2">District</option>
                                <option value="4">District</option>
                            </select>
                           
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" value="{{ old('zip') }}">
                            @error('zip')
                            <span style="color:red">{{ $errors->first('zip') }}</span>
                            @enderror
                        </div>
                        
                    
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li><a href="#"><h4>Product <span>Total</span></h4></a></li>
                            {{ $subtotal = 0 }}
                            @foreach($carts as $cart)

                            <li><a href="#">{{ $cart['product_title'] }} <span class="middle">x {{ $cart['product_quantity'] }}</span> <span class="last">{{ $cart['total'] }}</span></a></li>
                            {{ $subtotal += $cart['total'] }}
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Basic Price <span>{{ ($subtotal*60)/100 }}</span></a></li>
                            <li><a href="#">Subtotal <span>{{ $subtotal }}</span></a></li>
                            <li><a href="#">Shipping <span>Flat rate: {{ $shipping }}</span></a></li>
                            <li><a href="#" >Total <span id="ptotal">{{ ($potype == "basic") ? (($subtotal*60)/100)+$shipping : $subtotal+$shipping }}</span></a></li>
                        </ul>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="selector">
                                <label for="f-option5">Check payments</label>
                                <div class="check"></div>
                            </div>
                            <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                                Store Postcode.</p>
                        </div>
                        <div class="payment_item active">
                        <input type="hidden" name="stotal" value="{{ $subtotal  }}">
                        <input type="hidden" name="totalp" id="totalp" value="{{ ($potype == 'basic') ? (($subtotal*60)/100)+$shipping : $subtotal+$shipping }}">
                        <button type="submit">Process payment of <span id="pptotal">{{ ($potype == "basic") ? (($subtotal*60)/100)+$shipping : $subtotal+$shipping }}</span></button> &nbsp;
                        <div> <h5>Due Payment <span>{{ ($subtotal*40)/100 }}</span></h5></div>
                        </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->



  <!--================ Start footer Area  =================-->	
	<footer>
		<div class="footer-area footer-only">
			<div class="container">
				<div class="row section_gap">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets ">
							<h4 class="footer_title large_title">Our Mission</h4>
							<p>
								So seed seed green that winged cattle in. Gathering thing made fly you're no 
								divided deep moved us lan Gathering thing us land years living.
							</p>
							<p>
								So seed seed green that winged cattle in. Gathering thing made fly you're no divided deep moved 
							</p>
						</div>
					</div>
					<div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Quick Links</h4>
							<ul class="list">
								<li><a href="#">Home</a></li>
								<li><a href="#">Shop</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="#">Product</a></li>
								<li><a href="#">Brand</a></li>
								<li><a href="#">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget instafeed">
							<h4 class="footer_title">Gallery</h4>
							<ul class="list instafeed d-flex flex-wrap">
								<li><img src="img/gallery/r1.jpg" alt=""></li>
								<li><img src="img/gallery/r2.jpg" alt=""></li>
								<li><img src="img/gallery/r3.jpg" alt=""></li>
								<li><img src="img/gallery/r5.jpg" alt=""></li>
								<li><img src="img/gallery/r7.jpg" alt=""></li>
								<li><img src="img/gallery/r8.jpg" alt=""></li>
							</ul>
						</div>
					</div>
					<div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Contact Us</h4>
							<div class="ml-40">
								<p class="sm-head">
									<span class="fa fa-location-arrow"></span>
									Head Office
								</p>
								<p>123, Main Street, Your City</p>
	
								<p class="sm-head">
									<span class="fa fa-phone"></span>
									Phone Number
								</p>
								<p>
									+123 456 7890 <br>
									+123 456 7890
								</p>
	
								<p class="sm-head">
									<span class="fa fa-envelope"></span>
									Email
								</p>
								<p>
									free@infoexample.com <br>
									www.infoexample.com
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row d-flex">
					<p class="col-lg-12 footer-text text-center">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
				</div>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->



  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
  <script>
    function apcoupon()
    {
      var ccode=$("#ccode").val();
      var potype= "{{ $potype }}";
      $.ajax({
          method: "POST",
          url: "applycoupon",
          data: { 
            ccode:ccode,
            potype:potype,
            _token : "{{ csrf_token() }}"  
        }
        })
          .done(function( msg ) {
            if(typeof parseInt(msg) === 'number'){
                $("#ptotal").text(msg);
                $("#pptotal").text(msg);
                $("#totalp").val(msg);
                alert( "Coupon Applied");
            }
            else
            {
                alert( "Data Saved: " + msg );
            }
          });

    }
  </script>
</body>
@endsection