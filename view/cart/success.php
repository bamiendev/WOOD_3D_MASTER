<?php
$html_showcheckout = show_cart_success($_SESSION['cart_product']);
$html_count_sale = number_format(get_count_sale(), 0, ',', '.');
$html_count_price = number_format(get_count_price(), 0, ',', '.');
$html_all = number_format(get_discount(get_count_price(),get_count_sale()), 0, ',', '.');
$html_saved = $_SESSION['checkout']['discount'] + get_discount(get_count_price(),get_count_sale()) - $_SESSION['checkout']['ship'];
$html_date = $_GET['da'];
$html_madh = $_GET['mh'];
?>

<section class="success">
    <div class="container">
        <img src="Asset/img/success.gif" height="150px" class="success-img">
        <h2>Thank You For Your Order</h2>
        <div class="row">
            <div class="col-lg-12">
                <p>Your order has been confirmed !</p>
            </div>
        </div>

        <div class="row order-summary">
            <div class="col-6 col-lg-3 text-center">
                <h6>Order Date</h6>
                <p id="date"><?=$html_date?></p>
            </div>

            <div class="col-6 col-lg-3 text-center">
                <h6>Order ID</h6>
                <p id="order-id"><?=$html_madh?></p>
                <!-- <script>
                    function onLoadId() {
                        var text = localStorage.getItem("idOrder");
                        var idnum = document.getElementById('order-id');
                        if (text == undefined) {
                            initId(idnum);
                        }
                        else {
                            idnum.innerHTML += text;
                        }
                    }
                    function initId(text) {
                        if (text) {
                            var possible = "0123456789";
                            text.innerHTML = "RFC";
                            for (var i = 0; i < 5; i++)
                                text.innerHTML += `${possible.charAt(Math.floor(Math.random() * possible.length))}`;
                            localStorage.setItem("idOrder", text.innerHTML);
                        }
                    }
                    onLoadId();
                </script> -->
            </div>

            <div class="col-6 col-lg-3 text-center">
                <h6>Payment</h6>
                <p>Tiền mặt</p>
            </div>

            <div class="col-6 col-lg-3 text-center">
                <h6>Provinces</h6>
                <p><?php echo $_SESSION['checkout']['province']?></p>
            </div>
        </div>
        
        <div class="table-success" style="background: transparent">
            <?=$html_showcheckout;?>
        </div>

        <div class="row order-summary">
            <div class="col-7 col-lg-7 text-left">
                <p>Subtotal</p>
                <p>Discount</p>
                <p>Coupon Discount</p>
                <p>Express Shipping</p>
                <p>You Have Saved</p>
                </div>
            <div class = "col-5 col-lg-5 text-right">
                <p><span><?=$html_count_price?></span> VNĐ</p>
                <p><span><?=$html_all?></span> VNĐ</p>
                <p><span><?php echo number_format($_SESSION['checkout']['discount'], 0, ',', '.');?></span> VNĐ</p>
                <p><span><?php echo number_format($_SESSION['checkout']['ship'], 0, ',', '.');?></span> VNĐ</p>
                <p><span><?php echo number_format($html_saved, 0, ',', '.');?></span> VNĐ</p>
            </div>
        </div>

        <div class="row order-summary">
            <div class = "col-4 text-left">
                <h6>Total</h6>
            </div>
            <div class = "col-8 text-right">
                <h5 style = "color: crimson"><span><?php echo number_format($_SESSION['checkout']['total'], 0, ',', '.');?></span> VNĐ</h5>
            </div>
        </div>
        
        <div class="row order-summary">
            <div class="col-lg-12 text-center">
                <p class="text-center">Thank you for choosing Wood 3D for your shopping needs. </p>
                <p>We genuinely hope you delight in your purchase!</p>
                <h6>Thank You</h6>
                <p>From Wood 3D</p>
                <a href="index.php?pg=product"><button type="button" name="add_cart_product" class="buttonn rating-button">BACK</button></a>
            </div>
        </div>
    </div>
</section>
