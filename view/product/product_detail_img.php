
<?php
extract($product_details);
$html_show_product_details = show_product_details_img($product_related);
$a = number_format($price, 0, ',', '.');
$c = number_format(get_discount_percent($price,$sale), 0, ',', '.');
$d = number_format(get_discount($price,$sale), 0, ',', '.');
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
    <div class="row h-100" id="product_all">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="product-pic-zoom">
                        <img class="product-big-img" id="zoom_img" src="Asset/upload/img/<?=$img?>" class="img-fluid">
                        <div class="zoom-icon">
                            <i class="fa fa-search-plus"></i>
                        </div>
                    </div>

                    <div class="product-thumbs mt-3">
                        <div class="product-thumbs-track ps-slider owl-carousel">
                            <?php
                                // Type1
                                $mang_chuoi = explode(",", $options_img1);
                                $so_luong_anh = count($mang_chuoi);
                                for ($i = 0; $i < $so_luong_anh; $i++) {
                                    if (!empty($mang_chuoi[0]) && is_file("Asset/upload/option/img/" . $mang_chuoi[0])) {
                                        echo
                                        '<div class="pt" data-imgbigurl="Asset/upload/option/img/'.$mang_chuoi[$i].'">
                                            <img src="Asset/upload/option/img/'.$mang_chuoi[$i].'" class="img-thumbnail">
                                        </div>' . "\n";
                                    }
                                }

                                // Type2
                                $mang_chuoi2 = explode(",", $options_img2);
                                $so_luong_anh2 = count($mang_chuoi2);
                                for ($i = 0; $i < $so_luong_anh2; $i++) {
                                    if (!empty($mang_chuoi2[0]) && is_file("Asset/upload/option/img/" . $mang_chuoi2[0])) {
                                        echo
                                        '<div class="pt" data-imgbigurl="Asset/upload/option/img/'.$mang_chuoi2[$i].'">
                                            <img src="Asset/upload/option/img/'.$mang_chuoi2[$i].'" class="img-thumbnail">
                                        </div>' . "\n";
                                    }
                                }

                                // Type3
                                $mang_chuoi3 = explode(",", $options_img3);
                                $so_luong_anh3 = count($mang_chuoi3);
                                for ($i = 0; $i < $so_luong_anh3; $i++) {
                                    if (!empty($mang_chuoi3[0]) && is_file("Asset/upload/option/img/" . $mang_chuoi3[0])) {
                                        echo
                                        '<div class="pt" data-imgbigurl="Asset/upload/option/img/'.$mang_chuoi3[$i].'">
                                            <img src="Asset/upload/option/img/'.$mang_chuoi3[$i].'" class="img-thumbnail">
                                        </div>' . "\n";
                                    }
                                }
                            ?>

                        </div>
                    </div>
                </div>

                <div id="imageModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered zoomable">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img id="modalImage" class="img-fluid" src="">
                            </div>
                        </div>

                        <div class="icon_modal">
                            <i class="fa-sharp fa-regular fa-circle-xmark fa-beat fa-2xl" style="color: #ff0000;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col-lg-6">
            <div class="row">
                <div class="col-12 mt-2 mb-3">
                    <h3>
                        <?=$name?>
                    </h3>
                </div>

                <div class="col-12 mt-2 mb-3">
                    <div class="old-price" style="font-size: 14px;text-decoration: line-through;">
                        Giá gốc: <span><?=$price?></span> VNĐ
                    </div>

                    <div class="new-price mt-3">
                        <div class="row">
                            <div class="col-12 col-lg-7">
                                <p id="current-price" style="font-weight: 750; font-size: 30px; color: #FF0000;"><span><?=$sale?></span></p>
                            </div>
                            <div class="col-12 col-lg-5">
                                <p id="additional-price" style="font-size: 16px; font-weight: 600; display: none;">(+ 122121 VNĐ)</p>
                            </div>
                        </div>
                    </div>
                    Tiết kiệm: <?=$d?> VNĐ (<?=$c?>%)
                </div>
                
                <div class="col-12 mt-2 mb-3">
                    <h3>Option</h3>
                    <div class="row mt-2">
                        <?php
                            function show_option_thumbs($img,$price,$name){
                                ${$img."_1"} = current(explode(",", $img));
                                if(is_file("Asset/upload/option/img/".${$img."_1"})){
                                    echo
                                    '
                                    <div class="col-4 col-sm-3 col-lg-3 col-xl-2 mt-1">
                                        <label class="custom-radio">
                                            <input type="radio" name="radio-card_img" id="'.$price.'" value="'.$price.'">
                                            <span class="radio-btn prevent"><i class="fa-solid fa-check"></i>
                                                <div class="hobbies-icon">
                                                    <img src="Asset/upload/option/img/'.${$img."_1"}.'" class="img-fluid">
                                                    <div class="col-12" style="background-color: #747474; border-radius:15px">
                                                        <h5 class="" style="color: white; font-size:12px">'.$name.'</h5>
                                                    </div>
                                                </div>
                                            </span>
                                        </label>
                                    </div>
                                    ';
                                } else{
                                    echo
                                    '<div class="col-4 col-lg-4 text-center">
                                        <img src="Asset/upload/option/all.png" class="img-fluid">
                                    </div>';
                                }
                            }

                            function show_option($img,$price,$name){
                                ${$img."_1"} = current(explode(",", $img));
                                if(is_file("Asset/upload/option/img/".${$img."_1"})){
                                    echo
                                    '
                                    <div class="col-4 col-sm-3 col-lg-3 col-xl-2 mt-1">
                                        <label class="custom-radio">
                                            <input type="radio" name="radio-card_img" id="'.$price.'" value="'.$price.'">
                                            <span class="radio-btn prevent"><i class="fa-solid fa-check"></i>
                                                <div class="hobbies-icon">
                                                    <img src="Asset/upload/option/img/'.${$img."_1"}.'" class="img-fluid">
                                                    <h3 class="">'.$name.'</h3>
                                                </div>
                                            </span>
                                        </label>
                                    </div>
                                    ';
                                }
                            }

                            show_option_thumbs($options_img1,$options_price1,$options_name_1);
                            show_option_thumbs($options_img2,$options_price2,$options_name_2);
                            show_option_thumbs($options_img3,$options_price3,$options_name_3);

                            show_option($options_img4,$options_price4,$options_name_4);
                            show_option($options_img5,$options_price5,$options_name_5);
                            show_option($options_img6,$options_price6,$options_name_6);
                        ?>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <form action="index.php?pg=add_cart" method="post">
                                <input type="hidden" name="id" value="<?=$id;?>">
                                <input type="hidden" name="name" value="<?=$name;?>">
                                <input type="hidden" name="img" value="<?=$img;?>">
                                <input type="hidden" name="price" value="<?=$price;?>">
                                <input type="hidden" name="sale" value="<?=$sale;?>">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="type" value="img">
                                <input type="hidden" name="category" value="IMG" >

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
                    <div class="col-lg-7 mx-auto">
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
                    <div class="col-lg-5 mx-auto">
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
                    <div class="col-lg-7 mx-auto">
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

    <div class="row text-center mb-4">
        <?=$html_show_product_details?>
    </div>
</div>


<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>


<!-- Nice select -->


