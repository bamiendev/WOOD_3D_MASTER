
<?php
if($product_sale !="rong"){
    $html_productSale = show_product_sale($product_sale);
} else{
    $html_productSale =
    '
    <div class="col-12 mt-4">
        <div class="loader text-center">
            <span>Chưa Có Sản Phẩm</span>
            <span>Chưa Có Sản Phẩm</span>
        </div>
    </div>

    <div class="scene">
        <div class="forest">
            <div class="tree tree1">
                <div class="branch branch-top"></div>
                <div class="branch branch-middle"></div>
            </div>

            <div class="tree tree2">
                <div class="branch branch-top"></div>
                <div class="branch branch-middle"></div>
                <div class="branch branch-bottom"></div>
            </div>

            <div class="tree tree3">
                <div class="branch branch-top"></div>
                <div class="branch branch-middle"></div>
                <div class="branch branch-bottom"></div>
            </div>

            <div class="tree tree4">
                <div class="branch branch-top"></div>
                <div class="branch branch-middle"></div>
                <div class="branch branch-bottom"></div>
            </div>

            <div class="tree tree5">
                <div class="branch branch-top"></div>
                <div class="branch branch-middle"></div>
                <div class="branch branch-bottom"></div>
            </div>

            <div class="tree tree6">
                <div class="branch branch-top"></div>
                <div class="branch branch-middle"></div>
                <div class="branch branch-bottom"></div>
            </div>

            <div class="tree tree7">
                <div class="branch branch-top"></div>
                <div class="branch branch-middle"></div>
                <div class="branch branch-bottom"></div>
            </div>
        </div>

        <div class="tent">
            <div class="roof"></div>
            <div class="roof-border-left">
                <div class="roof-border roof-border1"></div>
                <div class="roof-border roof-border2"></div>
                <div class="roof-border roof-border3"></div>
            </div>
            <div class="entrance">
                <div class="door left-door">
                    <div class="left-door-inner"></div>
                </div>
                <div class="door right-door">
                    <div class="right-door-inner"></div>
                </div>
            </div>
        </div>

        <div class="floor">
            <div class="ground ground1"></div>
            <div class="ground ground2"></div>
        </div>

        <div class="fireplace">
            <div class="support"></div>
            <div class="support"></div>
            <div class="bar"></div>
            <div class="hanger"></div>
            <div class="smoke"></div>
            <div class="pan"></div>
            <div class="fire">
                <div class="line line1">
                    <div class="particle particle1"></div>
                    <div class="particle particle2"></div>
                    <div class="particle particle3"></div>
                    <div class="particle particle4"></div>
                </div>
                <div class="line line2">
                    <div class="particle particle1"></div>
                    <div class="particle particle2"></div>
                    <div class="particle particle3"></div>
                    <div class="particle particle4"></div>
                </div>
                <div class="line line3">
                    <div class="particle particle1"></div>
                    <div class="particle particle2"></div>
                    <div class="particle particle3"></div>
                    <div class="particle particle4"></div>
                </div>
            </div>
        </div>

        <div class="time-wrapper">
            <div class="time">
                <div class="day"></div>
                <div class="night">
                    <div class="moon"></div>
                    <div class="star star1 star-big"></div>
                    <div class="star star2 star-big"></div>
                    <div class="star star3 star-big"></div>
                    <div class="star star4"></div>
                    <div class="star star5"></div>
                    <div class="star star6"></div>
                    <div class="star star7"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 d-flex justify-content-center">
        <a href="index.php?pg=product">
            <button class="btn" type="button">
                <strong>Đến Trang Sản Phẩm 3D</strong>
                <div id="container-stars">
                    <div id="stars"></div>
                </div>

                <div id="glow">
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
            </button>
        </a>
    </div>
    ';
}








$html_productBest = show_product_best($product_best);

$html_productDeal = show_product_deal($product_deal);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-text">
                <a href="index.php"> Home</a>
                <span>Sale</span>
            </div>
        </div>
    </div>
</div>

<section class="sale-products spad">
    <div class="container">
        <div class="row">
            <div class="deal-of-week col-lg-3 text-center">
                <div class="section-title">
                    <h2>Deal Of The Week</h2>
                    <?=$html_productBest?>
                </div>

                <div class="countdown-timer" id="countdown">
                    <div class="cd-item">
                        <span id="days">4</span>
                        <p>Days</p>
                    </div>
                    <div class="cd-item">
                        <span id="hours">24</span>
                        <p>Hrs</p>
                    </div>
                    <div class="cd-item">
                        <span id="minutes">60</span>
                        <p>Mins</p>
                    </div>
                    <div class="cd-item">
                        <span id="seconds">60</span>
                        <p>Secs</p>
                    </div>
                </div>

                <div class="section-title">
                    <h2>Best sellers</h2>
                    
                </div>
            </div>

            <div class="sale-items col-lg-9">
                <div class="row">
                    <?=$html_productSale?>
                </div>
            </div>
        </div>
    </div>
    </section>