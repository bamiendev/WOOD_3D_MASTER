<?php
    $html_category = show_category($dsdm);
    
    if($dssp !="rong"){
        $html_product = show_product_img($dssp);
    } else{
        $html_product =
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
            <a href="index.php?pg=product_img">
                <button class="btn" type="button">
                    <strong>Đến Trang Sản Phẩm Hình Ảnh</strong>
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
?>

<!-- Link -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-text">
                <a href="index.php"> Home</a>
                <span>Product 3D</span>
            </div>
        </div>
    </div>
</div>

<!-- Product Shop-->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <!-- Filter -->
            <?php if($dssp !="rong"){
            echo
            '
            <div class="col-12">
                <div class="row mb-3">
                    <div class="col-lg-2 d-flex justify-content-center align-items-center mx-auto" id="off_hidden">
                        <span style="font-weight: 600;"><i class="fa-regular fa-filter fa-bounce"></i> Bộ lọc</span>
                    </div>

                    <div class="col-lg-3 mt-2 d-flex justify-content-center align-items-center mx-auto">
                        <select class="wide" onchange="selectCategory_img(this.options[this.selectedIndex].value)">
                            <option>Lọc Theo Danh Mục</option>
                            <?=$html_category?>
                        </select>
                    </div>

                    <div class="col-lg-3 mt-2 d-flex justify-content-center align-items-center mx-auto">
                        <select class="wide" onchange="selectPorduct_img(this.options[this.selectedIndex].value)">
                            <option value="nothing">Lọc Theo Sản Phẩm</option>
                            <option value="sale">Bán Chạy</option>
                            <option value="view">Xem Nhiều</option>
                            <option value="new">Mới</option>
                            <option value="old">Cũ</option>
                        </select>
                    </div>
                    
                    <div class="col-lg-3 mt-2 d-flex justify-content-end align-items-center mx-auto">
                        <select class="wide" onchange="selectData_img(this.options[this.selectedIndex].value)">
                            <option>Lọc Theo Tên & Giá</option>
                            <option value="rise">Lọc theo giá: Tăng dần</option>
                            <option value="reduce">Lọc theo giá: Giảm dần</option>
                            <option value="a_z">Lọc theo tên: A-Z</option>
                            <option value="z_a">Lọc theo tên: Z-A</option>
                        </select>
                    </div>
                </div>
            </div>
            ';
            
            }?>
            
            <!-- List product -->
            <div class = "col-xl-12 col-lg-12">
                <div class = "product-list">
                    <div class = "row" id="product_list">
                        <?=$html_product;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
