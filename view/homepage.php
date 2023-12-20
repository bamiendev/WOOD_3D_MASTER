
<?php
    $html_product = show_product_homepage_hot($dssp);
    $html_product_sale = show_product_sale_homepage($dssp_sale);
?>



<!-- Hero Section -->
<section class = "hero-section">
    <div class = "hero-items owl-carousel">
        <div class = "single-hero-items set-bg" data-setbg = "Asset/upload/home/<?=$img_home[0]["home1"]?>">
            <div class = "container">
                <div class = "row">
                    <div class = "col-lg-8">
                        <span>Wood 3D</span>
                        <h1>3D Viewer Product</h1>
                        <p class="text-justify">
                            Experiencing the dynamic and immersive features of a product through the interactive display of its three-dimensional model on a website elevates the browsing encounter, providing users with a rich and engaging perspective.
                        </p>

                        <a href="index.php?pg=blog&3dviewer" class = "primary-btn">
                            <button class="btn" type="button">
                                <strong>Start 3D Viewer</strong>
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
                </div>
            </div>
        </div>

        <div class = "single-hero-items set-bg" data-setbg = "Asset/upload/home/<?=$img_home[0]["home2"]?>">
            <div class = "container">
                <div class = "row">
                    <div class = "col-lg-8">
                        <span>Wood 3D</span>
                        <h1>Immersive Experience</h1>
                        <p class="text-justify">
                            This 3D model and image product viewing feature supports informed purchasing decisions by providing a comprehensive preview before purchase.
                        </p>
                        <a href="index.php?pg=product" class = "primary-btn">
                            <button class="btn" type="button">
                                <strong>Shop Now</strong>
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
                </div>
            </div>
        </div>
        
        <div class = "single-hero-items set-bg" data-setbg = "Asset/upload/home/<?=$img_home[0]["home3"]?>">
            <div class = "container">
                <div class = "row">
                    <div class = "col-lg-8">
                        <span>Wood 3D</span>
                        <h1>Discounted price</h1>
                        <p class="text-justify">This reduction in price can come in various forms such as direct discounts, special offers, promotions, or deals for a limited time.</p>
                        <a href="index.php?pg=sale" class = "primary-btn">
                            <button class="btn" type="button">
                                <strong>DISCOUNT SHOP</strong>
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
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Banner Category -->
<div class = "banner-section spad">
    <div class = "container-fluid">
        <div class = "row mt-4">
            <div class = "col-lg-4" data-aos = "fade-up">
                <div class = "single-banner">
                    <!-- <img src = "Asset/img/banner-1.png" alt = ""> -->
                    <img src="" data-src="Asset/img/banner-1.png">

                    <div class = "inner-text">
                        <a href = "diningchairs.html">Dining Chairs</a>
                    </div>
                    <div class="overlay"></div>
                </div>
            </div>
            <div class = "col-lg-4" data-aos = "fade-down">
                <div class = "single-banner">
                    <img src="" data-src="Asset/img/banner-2.png">
                    <div class = "inner-text">
                        <a href = "sofas.html">Sofas & Armchairs</a>
                    </div>
                    <div class="overlay"></div>
                </div>
            </div>
            <div class = "col-lg-4" data-aos = "fade-up">
                <div class = "single-banner">
                    <img src="" data-src="Asset/img/banner-3.png">
                    <div class = "inner-text">
                        <a href = "banquette.html">Banquette</a>
                    </div>
                    <div class="overlay"></div>
                </div>
            </div>
        </div>
        <div class = "row mt-4">
            <div class = "col-lg-4" data-aos = "fade-down">
                <div class = "single-banner">
                    <img src="" data-src="Asset/img/banner-4.png">
                    <div class = "inner-text">
                        <a href = "stool.html">Bar Height Stools</a>
                    </div>
                    <div class="overlay"></div>
                </div>
            </div>
            <div class = "col-lg-4" data-aos = "fade-up">
                <div class = "single-banner">
                    <img src="" data-src="Asset/img/banner-5.png">
                    <div class = "inner-text">
                        <a href = "officechairs.html">Office Chairs</a>
                    </div>
                    <div class="overlay"></div>
                </div>
            </div>
            <div class = "col-lg-4" data-aos = "fade-down">
                <div class = "single-banner">
                    <img src="" data-src="Asset/img/banner-6.png">
                    <div class = "inner-text">
                        <a href = "kidschairs.html">Kids Chairs</a>
                    </div>
                    <div class="overlay"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Bestsellers -->
<section class = "bestsell-banner spad">
    <h2>Best sellers</h2>
    <div class = "container-fluid" style = "padding: 20px 0 0;">
        <div class = "product-slider owl-carousel">
            <?=$html_product?>
        </div>
    </div>
</section>

<!-- Deal of the Week -->
<section class = "deal-of-week set-bg spad" data-setbg = "Asset/upload/home/<?=$img_home[0]["deal1"]?>">
    <div class = "col-lg-6 mx-auto text-center">
        <div class = "section-title">
            <h2>Deal Of The Week</h2>
            <p>Inspired by modern interiors with its statement
                shape and contemporary 3 leg design, Kalaspel's upholstered in elegant velvet.
                Dinner? Lead the way.</p>
            <div class = "product-price">
                $114.50
                <span>$229.00</span>
            </div>
        </div>
        <div class = "countdown-timer" id = "countdown">
            <div class = "cd-item">
                <span>10</span>
                <p>Days</p>
            </div>
            <div class = "cd-item">
                <span>12</span>
                <p>Hrs</p>
            </div>
            <div class = "cd-item">
                <span>48</span>
                <p>Mins</p>
            </div>
            <div class = "cd-item">
                <span>52</span>
                <p>Secs</p>
            </div>
        </div>
        <a href = "productdetail18.html" class = "primary-btn">Shop Now</a>
    </div>
</section>

<!-- Top Sale -->
<section class = "sale-banner spad">
    
    <div class="row">
        <div class="col-6 d-flex justify-content-start">
            <h2>On Sale</h2>
        </div>

        <div class="col-6 d-flex align-items-center justify-content-end ">
            <a href="index.php?pg=sale"><h5><i class="fa-duotone fa-share-all"></i> View All</h5></a>
        </div>
    </div>
    <div class = "container-fluid" style = "padding: 20px 0 0;">
        <div class = "product-slider owl-carousel">
            <?=$html_product_sale?>
        </div>
    </div>
    
</section>

<!-- Latest Blog Section -->
<section class = "latest-blog spad">
    <div class = "container">
        <div class = "row">
            <div class = "col-lg-12">
                <div class = "section-title">
                    <h2>Latest Blog</h2>
                </div>
            </div>
        </div>
        <div class = "row">
            <div class = "col-lg-4 col-md-6" data-aos="fade-up"
                 data-aos-easing="ease-in-sine">
                <div class = "single-latest-blog">
                    <img src="" data-src="Asset/img/blog/blog-8.png">
                    <div class = "latest-text">
                        <div class = "tag-list">
                            <div class = "tag-item">
                                LIFESTYLE
                            </div>
                        </div>
                        <a href = "blogdetail08.html">
                            <h4>Transforms a Georgian-Era Home</h4>
                        </a>
                        <p>Just a few strides from the bustle of Brick Lane in London’s
                            East End—where the sweet, spicy scent of the street’s...</p>
                    </div>
                </div>
            </div>
            <div class = "col-lg-4 col-md-6" data-aos="fade-down"
                 data-aos-easing="ease-in-sine">
                <div class = "single-latest-blog">
                    <img src="" data-src="Asset/img/blog/blog-1.png">
                    <div class = "latest-text">
                        <div class = "tag-list">
                            <div class = "tag-item">
                                GET INSPIRED
                            </div>
                        </div>
                        <a href = "blogdetail01.html">
                            <h4>5 Mid-Century Modern Sofas to Breathe Life</h4>
                        </a>
                        <p>For the home-decor-obsessed, a scroll through your Instagram
                            feed and a browse through a tasteful design store...</p>
                    </div>
                </div>
            </div>
            <div class = "col-lg-4 col-md-6" data-aos="fade-up"
                 data-aos-easing="ease-in-sine">
                <div class = "single-latest-blog">
                    <img src="" data-src="Asset/img/blog/blog-3.png">
                    <div class = "latest-text">
                        <div class = "tag-list">
                            <div class = "tag-item">
                                GET INSPIRED
                            </div>
                        </div>
                        <a href = "blogdetail02.html">
                            <h4>The Cloud Couch Becomes the Celebrity Favorite</h4>
                        </a>
                        <p>Owned and adored by celebrities such as Kendall Jenner,
                            Kerry Washington, Nina Dobrev, and Naomi Watts...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

