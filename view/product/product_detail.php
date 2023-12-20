
<?php
extract($product_details);
$html_show_product_details = show_product_details($product_related);
$c = number_format(get_discount_percent($price,$sale), 0, ',', '.');
$d = number_format(get_discount($price,$sale), 0, ',', '.');
$namecategory = get_category_name($id_category);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="breadcrumb-text">
                <a href="index.php"> Home</a>
                <a href="index.php"> Product</a>
                <span><?=$name?></span>
            </div>
        </div>
        
        <div class="col-lg-3 d-flex justify-content-end">
            <button class="button_product" onclick="scrollToProduct()">
                <div class="icon_product">
                    <i class="fa-solid fa-arrow-down fa-fade fa-lg" style="color: #000000;"></i>
                </div>
            </button>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row" id="product_all">
        <div class="col-md-6 col-sm-12 px-0">
            <div class="model-container">
                <model-viewer class="model-container" id="modelViewer" loading="eager" camera-controls
                    touch-action="pan-y" auto-rotate poster="" src="Asset/upload/glb/<?=$glb;?>" disable-tap>
                    <div slot="poster"
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"
                        aria-label="Orange and tan hamster running in a metal wheel" role="img"
                        class="wheel-and-hamster">
                        <!-- Loadding -->
                        <div class="wheel"></div>
                        <div class="hamster">
                            <div class="hamster__body">
                                <div class="hamster__head">
                                    <div class="hamster__ear"></div>
                                    <div class="hamster__eye"></div>
                                    <div class="hamster__nose"></div>
                                </div>
                                <div class="hamster__limb hamster__limb--fr"></div>
                                <div class="hamster__limb hamster__limb--fl"></div>
                                <div class="hamster__limb hamster__limb--br"></div>
                                <div class="hamster__limb hamster__limb--bl"></div>
                                <div class="hamster__tail"></div>
                            </div>
                        </div>
                        <div class="spoke"></div>
                    </div>

                    <div class="showfull">
                        <button id="fullscreenButton" class="showfull">
                            <i class="fa-solid fa-expand fa-beat-fade"></i>
                        </button>
                    </div>
                </model-viewer>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 px-0">
            <div class="row" style="margin-left: 5px; margin-right: 5px;">
                <!-- Ten -->
                <div class="col-12 mt-2 mb-3">
                    <h3 class="text-justify">
                        <?=$name;?>
                        <span class="ml-3"><i class="fa-light fa-heart-circle-plus fa-beat"></i></span>
                    </h3>
                    
                </div>

                <!-- Gia -->
                <div class="col-12">
                    <div class="old-price" style="font-size: 14px;text-decoration: line-through;">
                        <p>Giá gốc: <span><?=$price?></span> VNĐ</p>
                    </div>

                    <div class="new-price mt-3" >
                        <div class="row">
                            <div class="col-12 col-lg-7">
                                <p id="current-price" style="font-weight: 750; font-size: 30px; color: #FF0000;"><span><?=$sale?></span></p>
                            </div>
                            <div class="col-12 col-lg-5">
                                <p id="additional-price" style="font-size: 16px; font-weight: 600; display: none;">(+ 0 VNĐ)</p>
                            </div>

                            <input type="hidden" name="type" value="3d">
                            <input type="hidden" name="img" value="<?=$img;?>">
                            <input type="hidden" name="id" value="<?=$id;?>">
                        </div>
                    </div>

                    <div class="money">
                        Tiết kiệm: <span><?=$d;?></span> VNĐ (<?=$c;?>%)
                    </div>
                </div>

                <!-- Options -->
                <div class="col-12 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <!-- Options 1 -->
                            <?php 
                            if (!empty($options_name_1)) {
                                echo "<h3>Chân Bàn</h3>";
                            }
                            ?>
                            
                            <div class="row text-center mt-2">
                            <?php
                                if (!empty($options_name_1)) {
                                    $colors_array = explode(",", $options_name_1);
                                    $options_price1 = explode(",", $options_price1);

                                    $colors_count = count($colors_array);
                                    $limit = $colors_count;

                                    foreach (array_slice($colors_array, 0, $limit) as $index => $color) {
                                        $price1 = isset($options_price1[$index]) ? $options_price1[$index] : '';
                                        ?>
                                        <div class="col-4 col-sm-3 col-lg-3 col-xl-2 mt-1">
                                            <label class="custom-radio">
                                                <input type="radio" name="radio-card1" id="<?= $price1 ?>" value="<?= $color ?>">
                                                <span class="radio-btn prevent"><i class="fa-solid fa-check"></i>
                                                    <div class="hobbies-icon">
                                                        <img src="Asset/upload/option/all.png" class="img-fluid">
                                                        <div class="col-12" style="background-color: #747474; border-radius:15px">
                                                            <h5 class="" style="color: white; font-size:12px"><?= $color?></h5>
                                                        </div>
                                                    </div>
                                                </span>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                            </div>


                            <!-- Options 2 -->
                            <?php 
                            if (!empty($options_name_2)) {
                                echo '<h3 class="mt-1">Chân Ghế</h3>';
                            }
                            ?>

                            <div class="row text-center mt-2">
                                <?php
                                    if (!empty($options_name_2)) {
                                        $colors_array2 = explode(",", $options_name_2);
                                        $options_price2 = explode(",", $options_price2);
                                        $colors_count = count($colors_array2);
                                        $limit = $colors_count;

                                        foreach (array_slice($colors_array2, 0, $limit) as $index => $color2) {
                                            $price2 = isset($options_price2[$index]) ? $options_price2[$index] : '';
                                            ?>
                                            
                                            <div class="col-4 col-sm-3 col-lg-3 col-xl-2 mt-1">
                                                <label class="custom-radio">
                                                    <input type="radio" name="radio-card2" value="<?= $color2 ?>" id="<?=$price2?>">
                                                    <span class="radio-btn"><i class="fa-solid fa-check"></i>
                                                        <div class="hobbies-icon">
                                                        <img src="Asset/upload/option/all.png" class="img-fluid">
                                                        <div class="col-12" style="background-color: #747474; border-radius:15px">
                                                            <h5 class="" style="color: white; font-size:12px"><?= $color2?></h5>
                                                        </div>
                                                    </div>
                                                    </span>
                                                </label>
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>


                            <!-- Options 3 -->
                            <?php 
                            if (!empty($options_name_3)) {
                                echo '<h3 class="mt-1">Chân Ghế</h3>';
                            }
                            ?>

                            <div class="row text-center mt-2">
                                <?php
                                    if (!empty($options_name_3)) {
                                        $colors_array3 = explode(",", $options_name_3);
                                        $options_price3 = explode(",", $options_price3);

                                        $colors_count = count($colors_array3);
                                        $limit = $colors_count;

                                        foreach (array_slice($colors_array3, 0, $limit) as $index => $color3) {
                                            $price3 = isset($options_price3[$index]) ? $options_price3[$index] : '';
                                            ?>
                                            
                                            <div class="col-4 col-sm-3 col-lg-3 col-xl-2 mt-1">
                                                <label class="custom-radio">
                                                    <input type="radio" name="radio-card3" value="<?= $color3 ?>" id="<?=$price3?>">
                                                    <span class="radio-btn"><i class="fa-solid fa-check"></i>
                                                        <div class="hobbies-icon">
                                                        <img src="Asset/upload/option/all.png" class="img-fluid">
                                                        <div class="col-12" style="background-color: #747474; border-radius:15px">
                                                            <h5 class="" style="color: white; font-size:12px"><?= $color3?></h5>
                                                        </div>
                                                    </div>
                                                    </span>
                                                </label>
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>

                            <div class="row">
                                <div class="col-6 d-flex justify-content-center align-items-center">
                                    <form action="index.php?pg=checkout" method="post">
                                        <input type="hidden" name="id" value="<?=$id;?>">
                                        <input type="hidden" name="name" value="<?=$name;?>">
                                        <input type="hidden" name="img" value="<?=$img;?>">
                                        <input type="hidden" name="price" value="<?=$price;?>">
                                        <input type="hidden" name="sale" value="<?=$sale;?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="type" value="3d">
                                        <input type="hidden" name="category" value="<?=$namecategory?>" >

                                        <button type="submit" name="add_cart_product" class="buttonn rating-button">Giỏ Hàng</button>
                                    </form>
                                </div>

                                <div class="col-6 d-flex justify-content-center align-items-center">
                                    <form action="index.php?pg=checkout" method="post">
                                        <input type="hidden" name="id" value="<?=$id;?>">
                                        <input type="hidden" name="name" value="<?=$name;?>">
                                        <input type="hidden" name="img" value="<?=$img;?>">
                                        <input type="hidden" name="price" value="<?=$price;?>">
                                        <input type="hidden" name="sale" value="<?=$sale;?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="type" value="3d">
                                        <input type="hidden" name="category" value="<?=$namecategory?>" >
                                        
                                        <button type="submit" name="checkout_product" class="buttonn rating-button">Mua Ngay</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="product-tab text-center">
        <div class="tab-item">
            <ul class="nav" role="tablist">
                <li><a class="active" href="#tab-1" data-toggle="tab" role="tab">DESCRIPTION</a></li>
                <li><a href="#tab-2" data-toggle="tab" role="tab">SPECIFICATION</a></li>
                <li><a href="#tab-3" data-toggle="tab" role="tab">REVIEWS</a></li>
                <li><a href="#tab-4" data-toggle="tab" role="tab">SHIPPING</a></li>
            </ul>
        </div>

        <div class="tab-item-content">
            <div class="tab-content">
                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                    <div class="col-9 mx-auto">
                        <div class="details_product">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4>Mô Tả Chi Tiết</h4>
                                    <p class="text-justify mt-3"><?=$detail?></p>
                                </div>

                                <div class="col-lg-6">
                                    <img src="Asset/upload/img/<?=$img2?>" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                    <div class="col-9 mx-auto">
                        <div class="specification-table">
                            <table>
                                <tr>
                                    <td class="p-catagory">DIMENSIONS</td>
                                    <td>70cm x 60cm x 53cm</td>
                                </tr>
                                <tr>
                                    <td class="p-catagory">SEAT DIMENSIONS</td>
                                    <td>47cm x 48cm x 47cm</td>
                                </tr>
                                <tr>
                                    <td class="p-catagory">WEIGHT</td>
                                    <td>10kg</td>
                                </tr>
                                <tr>
                                    <td class="p-catagory">MATERIAL</td>
                                    <td>100% Recycled Polyester</td>
                                </tr>
                                <tr>
                                    <td class="p-catagory">AVAILABILITY</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td class="p-catagory">RATING</td>
                                    <td>
                                        <div class="pd-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <span>(5)</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-catagory">DETAILED DESCRIPTION</td>
                                    <td><a class="nutdownload" href="https://docs.google.com/document/d/17eT5H2NvTpI3cmIH1goO1M29Ocu9-IX1br2SXaICofk/edit" target="_blank" rel="noopener noreferrer"> Download Product Detail <i class = "icon_download"></i></a></td></tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                    <div class="col-9 mx-auto">
                        <div class="customer-review-option">
                            <div class="comment-option">
                                <div class="co-item">
                                    <div class="col-12">
                                        <div class="at-rating mb-2">
                                            <i class="fa-solid fa-star" style="color: #f1f500;"></i>
                                            <i class="fa-solid fa-star" style="color: #f1f500;"></i>
                                            <i class="fa-solid fa-star" style="color: #f1f500;"></i>
                                            <i class="fa-solid fa-star" style="color: #f1f500;"></i>
                                            <i class="fa-solid fa-star" style="color: #f1f500;"></i>
                                        </div>

                                        <h5 class="commet-khach">James Authur <span>7 Aug 2021</span></h5>
                                        
                                        <div class="at-reply">Fabric of good quality and looks classy. Satisfied first purchase!</div>
                                    </div>
                                </div>
                            </div>
                            
                            <h4>Leave A Comment</h4>
                            <div class="personal-rating mt-3">
                                <div class="rating">
                                    <div class="rating" id="ratingStars"></div>
                                </div>
                            </div>
                            <div class="leave-comment">
                                <form action="" class="comment-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Your Name">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder=" Your Email">
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <textarea placeholder="Your Comment"></textarea>
                                            <button type="button" name="checkout_product" class="buttonn rating-button">Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-4" role="tabpanel">
                    4
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 mt-3 mb-3">
            <div class="section-title">
                <h2 class="text-center" >Related Products</h2>
            </div>
        </div>
    </div>

    <!-- Sản Phẩm gần đây -->
    <div class="row text-center mb-4">
        <?=$html_show_product_details;?>
    </div>
</div>