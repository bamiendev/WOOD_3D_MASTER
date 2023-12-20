<?php
    // Show product
    if(is_array($product) && (count($product) > 0)){
        extract($product);
        $id_update = $id;

        $imgpath = IMG_PATH_ADMIN.$img;
        $imgpath2 = IMG_PATH_ADMIN.$img2;


        if(is_file($imgpath)){
            $img  = '<img id="imgPreview1" src="'.$imgpath.'" class="img-fluid">';
        } else{
            $img = "";
        }

        if(is_file($imgpath2)){
            $img2  = '<img id="imgPreview2" src="'.$imgpath2.'" class="img-fluid">';
        } else{
            $img2 = "";
        }

        $html_list_category = show_category_update_admin($list_category,$id_category);
    }
?>

<form class="addPro" action="indexadmin.php?pg=update_img" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="text-center mt-3">Cập Nhập Sản Phẩm</h2>
            <input type="hidden" name="id" value="<?=$id_update?>">
            <button type="submit" name="update" class="btn btn-primary button_update mb-4">Update</button>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Ảnh Sản Phẩm</h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="file" class="form-control" accept=".png" id="imgInput" name="img"/>
                            <?=$img?>
                        </div>

                        <div class="col-lg-6">
                            <input type="file" class="form-control" accept=".png" id="img2Input" name="img2"/>
                            <?=$img2?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <h5>Tên sản phẩm</h5>
                            <input type="text" class="form-control" name="name" id="name" value="<?=$name?>">
                        </div>

                        <div class="col-12">
                            <h5 class="my-2">Danh mục:</h5>
                            <select class="form-select" name="id_category" aria-label="Default select example">
                                <option selected>Chọn danh mục</option>
                                <?=$html_list_category;?>
                            </select>
                        </div>

                        <div class="col-12">
                            <h5 class="my-2">Giá gốc</h5>
                            <div class="input-group mb-3">
                                <input type="text" name="price" class="form-control" value="<?=($price>0)?$price:0;?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="my-2">Giá khuyến mãi</h5>
                            <div class="input-group mb-3">
                                <input type="text" name="sale" class="form-control" value="<?=($sale>0)?$sale:0;?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: 700; font-size: 20px; margin-top: 20px;margin-bottom: 20px;">Lượt Xem</label>
                            <input type="text" name="view" class="form-control" placeholder="Nhập mô tả về sản phẩm" value="<?=$view?>"></input>
                        </div>

                        <!-- Detail -->
                        <div class="form-group">
                            <label style="font-weight: 700; font-size: 20px; margin-top: 20px;margin-bottom: 20px;">Mô tả chi tiết</label>
                            <input type="text" name="detail" class="form-control" placeholder="Nhập mô tả về sản phẩm" value="<?=$detail?>"></input>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12"><h2 class="text-center">Options</h2></div>

        <!-- Type 1-->
        <div class="col-lg-6 mt-5">
            <h5>Type 1 </h5>
            <div class="row">
                <div class="col-lg-6">
                    <input type="text" name="name_option1" placeholder="Nhập tên options" class="form-control" value="<?=$options_name_1?>">
                </div>

                <div class="col-lg-6">
                    <input type="text" name="price_option1" placeholder="Nhập giá options" class="form-control" value="<?=$options_price1?>">
                </div>

                <div class="col-12 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <input type="file" name="files[]" placeholder="Thêm ảnh" class="form-control" multiple accept="image/*">
                        </div>

                        <div class="col-12 mt-2">
                            <h4>Có: <?php echo count(explode(",", $options_img1)); ?> ảnh</h4>
                        </div>

                        <div class="col-9 mx-auto">
                            <div class="carousel-container"
                                data-flickity='{
                                    "contain": true,
                                    "pageDots": false
                                }'>
                                <?php
                                    $mang_chuoi = explode(",", $options_img1);
                                    $so_luong_anh1 = count($mang_chuoi);
                                    if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi[0])){
                                        for ($i = 0; $i < $so_luong_anh1; $i++) {
                                            echo '<img id="imgPreview' . $i . '" src="../Asset/upload/option/img/' . $mang_chuoi[$i] . '" class="img-fluid">' . "\n";
                                        }
                                    } else{
                                        echo '<img src="../Asset/upload/option/all.png" class="img-fluid">' . "\n";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Type 2-->
        <div class="col-lg-6 mt-5">
            <h5>Type 2</h5>
            <div class="row">
                <div class="col-lg-6">
                    <input type="text" name="name_option2" placeholder="Nhập tên options" class="form-control" value="<?=$options_name_2?>">
                </div>

                <div class="col-lg-6">
                    <input type="text" name="price_option2" placeholder="Nhập giá options" class="form-control" value="<?=$options_price2?>">
                </div>

                <div class="col-12 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <input type="file" name="files2[]" placeholder="Thêm ảnh" class="form-control" multiple accept="image/*">
                        </div>

                        <div class="col-12 mt-2">
                            <h4>Có: <?php echo count(explode(",", $options_img2)); ?> ảnh</h4>
                        </div>

                        <div class="col-9 mx-auto">
                            <div class="carousel-container"
                                data-flickity='{
                                    "contain": true,
                                    "pageDots": false
                                }'>
                                <?php
                                    $mang_chuoi2 = explode(",", $options_img2);
                                    $so_luong_anh2 = count($mang_chuoi2);
                                    if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi2[0])){
                                        for ($i = 0; $i < $so_luong_anh2; $i++) {
                                            echo '<img id="imgPreview' . $i . '" src="../Asset/upload/option/img/' . $mang_chuoi2[$i] . '" class="img-fluid">' . "\n";
                                        }
                                    } else{
                                        echo '<img src="../Asset/upload/option/all.png" class="img-fluid">' . "\n";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Type 3-->
        <div class="col-lg-6 mt-5">
            <h5>Type 3</h5>
            <div class="row">
                <div class="col-lg-6">
                    <input type="text" name="name_option3" placeholder="Nhập tên options" class="form-control" value="<?=$options_name_3?>">
                </div>

                <div class="col-lg-6">
                    <input type="text" name="price_option3" placeholder="Nhập giá options" class="form-control" value="<?=$options_price3?>">
                </div>

                <div class="col-12 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <input type="file" name="files3[]" placeholder="Thêm ảnh" class="form-control" multiple accept="image/*">
                        </div>

                        <div class="col-12 mt-2">
                            <h4>Có: <?php echo count(explode(",", $options_img3)); ?> ảnh</h4>
                        </div>

                        <div class="col-9 mx-auto">
                            <div class="carousel-container"
                                data-flickity='{
                                    "contain": true,
                                    "pageDots": false
                                }'>
                                <?php
                                    $mang_chuoi3 = explode(",", $options_img3);
                                    $so_luong_anh3 = count($mang_chuoi3);
                                    if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi3[0])){
                                        for ($i = 0; $i < $so_luong_anh3; $i++) {
                                            echo '<img id="imgPreview' . $i . '" src="../Asset/upload/option/img/' . $mang_chuoi3[$i] . '" class="img-fluid">' . "\n";
                                        }
                                    } else{
                                        echo '<img src="../Asset/upload/option/all.png" class="img-fluid">' . "\n";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Type 4-->
        <div class="col-lg-6 mt-5">
            <h5>Type 4</h5>
            <div class="row">
                <div class="col-lg-6">
                    <input type="text" name="name_option4" placeholder="Nhập tên options" class="form-control" value="<?=$options_name_4?>">
                </div>

                <div class="col-lg-6">
                    <input type="text" name="price_option4" placeholder="Nhập giá options" class="form-control" value="<?=$options_price4?>">
                </div>

                <div class="col-12 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <input type="file" name="files4[]" placeholder="Thêm ảnh" class="form-control" multiple accept="image/*">
                        </div>

                        <div class="col-12 mt-2">
                            <h4>Có: <?php echo count(explode(",", $options_img4)); ?> ảnh</h4>
                        </div>

                        <div class="col-9 mx-auto">
                            <div class="carousel-container"
                                data-flickity='{
                                    "contain": true,
                                    "pageDots": false
                                }'>
                                <?php
                                    $mang_chuoi4 = explode(",", $options_img4);
                                    $so_luong_anh4 = count($mang_chuoi4);
                                    if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi4[0])){
                                        for ($i = 0; $i < $so_luong_anh4; $i++) {
                                            echo '<img id="imgPreview' . $i . '" src="../Asset/upload/option/img/' . $mang_chuoi4[$i] . '" class="img-fluid">' . "\n";
                                        }
                                    } else{
                                        echo '<img src="../Asset/upload/option/all.png" class="img-fluid">' . "\n";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Type 5-->
        <div class="col-lg-6 mt-5">
            <h5>Type 5</h5>
            <div class="row">
                <div class="col-lg-6">
                    <input type="text" name="name_option5" placeholder="Nhập tên options" class="form-control" value="<?=$options_name_5?>">
                </div>

                <div class="col-lg-6">
                    <input type="text" name="price_option5" placeholder="Nhập giá options" class="form-control" value="<?=$options_price5?>">
                </div>

                <div class="col-12 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <input type="file" name="files5[]" placeholder="Thêm ảnh" class="form-control" multiple accept="image/*">
                        </div>

                        <div class="col-12 mt-2">
                            <h4>Có: <?php echo count(explode(",", $options_img5)); ?> ảnh</h4>
                        </div>

                        <div class="col-9 mx-auto">
                            <div class="carousel-container"
                                data-flickity='{
                                    "contain": true,
                                    "pageDots": false
                                }'>
                                <?php
                                    $mang_chuoi5 = explode(",", $options_img5);
                                    $so_luong_anh5 = count($mang_chuoi5);
                                    if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi5[0])){
                                        for ($i = 0; $i < $so_luong_anh5; $i++) {
                                            echo '<img id="imgPreview' . $i . '" src="../Asset/upload/option/img/' . $mang_chuoi5[$i] . '" class="img-fluid">' . "\n";
                                        }
                                    } else{
                                        echo '<img src="../Asset/upload/option/all.png" class="img-fluid">' . "\n";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Type 6-->
        <div class="col-lg-6 mt-5">
            <h5>Type 6</h5>
            <div class="row">
                <div class="col-lg-6">
                    <input type="text" name="name_option6" placeholder="Nhập tên options" class="form-control" value="<?=$options_name_6?>">
                </div>

                <div class="col-lg-6">
                    <input type="text" name="price_option6" placeholder="Nhập giá options" class="form-control" value="<?=$options_price6?>">
                </div>

                <div class="col-12 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <input type="file" name="files6[]" placeholder="Thêm ảnh" class="form-control" multiple accept="image/*">
                        </div>

                        <div class="col-12 mt-2">
                            <h4>Có: <?php echo count(explode(",", $options_img6)); ?> ảnh</h4>
                        </div>

                        <div class="col-9 mx-auto">
                            <div class="carousel-container"
                                data-flickity='{
                                    "contain": true,
                                    "pageDots": false
                                }'>
                                <?php
                                    $mang_chuoi6 = explode(",", $options_img6);
                                    $so_luong_anh6 = count($mang_chuoi6);
                                    if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi6[0])){
                                        for ($i = 0; $i < $so_luong_anh6; $i++) {
                                            echo '<img id="imgPreview' . $i . '" src="../Asset/upload/option/img/' . $mang_chuoi6[$i] . '" class="img-fluid">' . "\n";
                                        }
                                    } else{
                                        echo '<img src="../Asset/upload/option/all.png" class="img-fluid">' . "\n";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

