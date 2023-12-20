
<?php
$html_showcheckout = show_cart_checkout($_SESSION['cart_product']);
$html_count_sale = number_format(get_count_sale(), 0, ',', '.');
$html_showvoucher = show_voucher($list_voucher);

$count_product = sizeof($_SESSION["cart_product"]);

$html_ship = "";
if($count_product > 1 || get_count_sale() > 2000000){
    $html_ship = 0;
} else{
    $html_ship = '50.000';
}

?>
<section class="checkout">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"> Home</a>
                    <a href="index.php"> Product</a>
                    <span>Checkout</span>
                </div>
            </div>
        </div>

        <form action="index.php?pg=checkout_product" method="post">
            <div class="row">
                <div class="col-lg-8">
                    <h2>Delivery Information</h2>
                    <h6 class="mt-2 mb-2" id="personal">1. Personal Information</h6>
                    <div class="row mb-4">
                        <div class="col-lg-6 mt-2">
                            <input type="text" autocomplete="off" name="f_name" class="input" placeholder="First name...">
                        </div>

                        <div class="col-lg-6 mt-2">
                            <input type="text" autocomplete="off" name="l_name" class="input" placeholder="Last name...">
                        </div>

                        <div class="col-lg-12 mt-3">
                            <input type="text" autocomplete="off" name="email" class="input" placeholder="Email...">
                        </div>

                        <div class="col-lg-12 mt-3">
                            <input type="text" autocomplete="off" name="p_number" class="input" placeholder="Number phone...">
                        </div>
                    </div>
                    
                    <h6 class="mt-2 mb-2" id="address">2. Address Information</h6>
                    <div class="row mb-4">
                        <div class="col-lg-4 col-md-12 mt-2">
                            <select name="111" id="province" class="select-club-services"></select>
                        </div>

                        <div class="col-lg-4 col-md-6 mt-2">
                            <select name="222" id="district" class="select-club-services">
                                <option value="" selected>Chọn Quận</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-6 mt-2">
                            <select name="" id="ward" class="select-club-services">
                                <option value="" selected>Chọn Phường</option>
                            </select>
                        </div>

                        <div class="col-sm-12 mt-3">
                            <input type="text" autocomplete="off" name="h_number" class="input" placeholder="House number...">
                        </div>
                    </div>
                    
                    <h6 class="mt-2 mb-2">3. Coupon And Discounts</h6>
                    <p style="font-size: 14px">Note: You are eligible for 01 (one) coupon per purchase only.</p>
                    <div class="method">
                        <div class="row">
                            <?=$html_showvoucher?>
                        </div>
                    </div>

                    <h6>4. Reminder</h6>
                    <div class="row mb-4">
                        <div class="col-sm-12 mt-1">
                            <input type="text" autocomplete="off" name="note" class="input" placeholder="Note...">
                        </div>
                    </div>

                    <h6  id="policy">5. Sales Policy</h6>
                    <div class="row mb-4">
                        <div class="col-2 col-md-1 mt-1">
                            <div class="heart-container" title="Like">
                                <input type="checkbox" class="checkbox" id="Give-It-An-Id">
                                <div class="svg-container">
                                    <svg viewBox="0 0 24 24" class="svg-outline" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                        </path>
                                    </svg>
                                    <svg viewBox="0 0 24 24" class="svg-filled" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                        </path>
                                    </svg>
                                    <svg class="svg-celebrate" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                                        <polygon points="10,10 20,20"></polygon>
                                        <polygon points="10,50 20,50"></polygon>
                                        <polygon points="20,80 30,70"></polygon>
                                        <polygon points="90,10 80,20"></polygon>
                                        <polygon points="90,50 80,50"></polygon>
                                        <polygon points="80,80 70,70"></polygon>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 col-md-11 mt-1">
                            <p>I have read and agreed to the conditions of exchange, delivery, privacy policy, and terms of online shopping service.<a style="font-size: 20px; font-weight: 500;" target="_blank" href="index.php?pg=faqs&policy">This!</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5 d-flex justify-content-center">
                    <div class="iphone">
                        <legend class="text-center">Products</legend>

                        <?=$html_showcheckout;?>

                        <div class="row">
                            <legend class="text-center">Payment</legend>

                            <div class="col-12 form_radiobutton">
                                <label for="01"><i class="fa-duotone fa-credit-card"></i> Cash on delivery</label>
                                <input id="01" type="radio" name="pttt" value="1" checked="">
                            </div>

                            <div class="col-12 form_radiobutton">
                                <label for="02"><i class="fa-brands fa-cc-visa"></i> Visa</label>
                                <input id="02" type="radio" name="pttt" value="2" >
                            </div>

                            <div class="col-12 form_radiobutton">
                                <label for="03"><i class="fa-brands fa-cc-paypal"></i> PayPal</label>
                                <input id="03" type="radio" name="pttt" value="3">
                            </div>
                        </div>

                        <div class="row">
                            <legend class="text-center">Shopping Bill</legend>

                            <div class="col-5 mt-2">
                                <h7>Subtotal: </h7>
                            </div>

                            <div class="col-7 mt-2 text-right sub">
                                <h7><span><?=$html_count_sale?></span> VNĐ</h7>
                            </div>

                            <div class="col-5 mt-2">
                                <h7>Shipping: </h7>
                            </div>

                            <div class="col-7 mt-2 text-right ship">
                                <h7><span><?=$html_ship?> </span> VNĐ</h7>
                            </div>

                            <div class="col-5 mt-2">
                                <h7>Discount: </h7>
                            </div>

                            <div class="col-7 mt-2 text-right discount">
                                <h7><span>0</span> VNĐ</h7>
                            </div>

                            <div class="col-5 mt-4">
                                <h7>Total: </h7>
                            </div>

                            <div class="col-7 mt-4 text-right total">
                                <h5 style="color: #ff3030;"><span></span> VNĐ</h5>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <button type="submit" id="getProvince" name="checkout_button" class="buttonn rating-button">Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>