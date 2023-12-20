<?php
$html_showcart = '
    <div class="col-lg-12 mt-3 wishlist-container">
        <div class="alert alert-warning text-center" role="alert">
            <i class="fa-light fa-sensor-triangle-exclamation fa-beat" style="color: #ff0000;"></i> &nbsp;&nbsp;There is nothing in your cart.
        </div>
        <div class="row btn-header">
            <div class="col-lg-12">
                <h6>Find out more about Wood 3D products</h6>
            </div>
        </div>
    </div>';

if (isset($_SESSION['like_product'])) {
    $count_product = count($_SESSION['like_product']);

    if ($count_product > 0) {
        $html_showcart = show_like($_SESSION['like_product']);
    }
} else {
    $count_product = 0;
}
?>




<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-text">
                <a href="index.php"> Home</a>
                <a href="index.php?pg=product_img"> Product Img</a>
                <a href="index.php?pg=product"> Product 3D</a>
                <span>Like</span>
            </div>
        </div>
    </div>
</div>

<section>
    <div class="container h-100">
        <div class = "row bill-header">
            <div class = "col-lg-8">
                <h2>Like</h2>
            </div>

            <div class = "col-lg-4">
                <p class = "wishlistNumber1 float-right">There are <span><?=$count_product?></span> item(s) in your cart</p>
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div id="cart">
                    <?=$html_showcart ?>
                </div>

                <div class="row mt-3 mb-2 text-center">
                    <div class="col-lg-6 mb-3">
                        <a href="javascript:history.go(-1)"><button type="button" class="buttonn rating-button">BACK TO SHOP</button></a>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <button type="submit" name="checkout" class="buttonn rating-button">CHECK OUT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>