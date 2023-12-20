<!-- 3D Model -->
<?php
$html_category_list3D = show_add_category_admin($category_list_3d);

$html_category_listImg = show_add_category_admin($category_list_img);
?>


<div class="col-12" id="3d">
    <div class="row">
        <div class="col-lg-6 px-0">
            <div class="model-container" style="height: 100dvh;">
                <model-viewer class="model-container" id="modelViewer" camera-controls disable-tapanimation-name="">
                    <button slot="hotspot-dot+X-Y+Z" class="dot" data-position="1 -1 1" data-normal="1 0 0"></button>
                    <button slot="hotspot-dim+X-Y" class="dim" data-position="1 -1 0" data-normal="1 0 0"></button>
                    <button slot="hotspot-dot+X-Y-Z" class="dot" data-position="1 -1 -1" data-normal="1 0 0"></button>
                    <button slot="hotspot-dim+X-Z" class="dim" data-position="1 0 -1" data-normal="1 0 0"></button>
                    <button slot="hotspot-dot+X+Y-Z" class="dot" data-position="1 1 -1" data-normal="0 1 0"></button>
                    <button slot="hotspot-dim+Y-Z" class="dim" data-position="0 -1 -1" data-normal="0 1 0"></button>
                    <button slot="hotspot-dot-X+Y-Z" class="dot" data-position="-1 1 -1" data-normal="0 1 0"></button>
                    <button slot="hotspot-dim-X-Z" class="dim" data-position="-1 0 -1" data-normal="-1 0 0"></button>
                    <button slot="hotspot-dot-X-Y-Z" class="dot" data-position="-1 -1 -1" data-normal="-1 0 0"></button>
                    <button slot="hotspot-dim-X-Y" class="dim" data-position="-1 -1 0" data-normal="-1 0 0"></button>
                    <button slot="hotspot-dot-X-Y+Z" class="dot" data-position="-1 -1 1" data-normal="-1 0 0"></button>
                    <svg id="dimLines" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" class="dimensionLineContainer">
                        <line class="dimensionLine"></line>
                        <line class="dimensionLine"></line>
                        <line class="dimensionLine"></line>
                        <line class="dimensionLine"></line>
                        <line class="dimensionLine"></line>
                    </svg>
                
                    <div id="controls" class="dim">
                        <label for="show-dimensions">Show Dimensions:</label>
                        <input class="form-check-input" id="show-dimensions" type="checkbox">
                    </div>
                </model-viewer>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="radio-inputs w-100 d-flex flex-nowrap text-center">
                <label id="material" class="radio">
                    <input type="radio" name="radio" checked="">
                    <span class="name">Material</span>
                </label>

                <label id="capture" class="radio">
                    <input type="radio" name="radio">
                    <span class="name">Capture</span>
                </label>

                <label id="button" class="radio">
                    <input type="radio" name="radio">
                    <span class="name">Aniamtion</span>
                </label>

                <label id="addProduct" class="radio">
                    <input type="radio" name="radio">
                    <span class="name">Product</span>
                </label>
            </div>

            <form class="addPro" action="" method="POST" enctype="multipart/form-data">
                <div class="row mt-3">
                    <!-- Page Change Material -->
                    <div id="page_material" class="col-12 d-none">
                        <div class="row">
                            <!-- Import -->
                            <h3 class="mb-2">Thêm File Glb</h3>
                            <div class="col-12 mb-4">
                                <input type="file" id="fileInput" name="glb" accept=".glb" style="display: none"/>
                                <button type="button" class="btn btn-outline-primary" onclick="openFile()">Import 3D</button>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <p id="fileNameDisplay"></p>
                                </div>
                            </div>

                            <!-- Show / Hidden -->
                            <div class="row">
                                <div class="col-4">
                                    <h3>Aniamtion</h3>
                                </div>
                                <div class="col-8">
                                    <h3>Ẩn / Hiện Toàn Bộ Materials</h3>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="row">
                                    <div class="col-4 d-flex justify-content-center">
                                        <select class="form-select form-select-lg" aria-label=".form-select-lg example" id="animationSelect"></select>
                                    </div>

                                    <div class="col-8 d-flex justify-content-start d-grid gap-3">
                                        <button type="button" class="btn btn-outline-primary" id="button_hidden_all">Hidden All Materials</button>
                                        <button type="button" class="btn btn-outline-primary" id="button_shows_all">Show All Materials</button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- All Materials: -->
                            <h3 class="mb-2">Materials: </h3>
                            <div class="col-12 mb-4">
                                <div id="material-buttons">
                                    <!-- Nút bấm sẽ được thêm vào đây -->
                                </div>
                            </div>

                            <!-- Change Metalness && Roughness -->
                            <h3 class="mb-2">Thay Đổi Metalness & Roughness</h3>
                            <div class="col-12 mb-4">
                                <div class="controls">
                                    <div class="mb-3" style="display: flex; align-items: center; justify-content: space-between;">
                                        <p style="margin: 0;">Metalness: <span id="metalness-value"></span></p>
                                        <input id="metalness" type="range" min="0" max="1" step="0.02" value="1" style="flex-grow: 1; margin-left: 20px">
                                    </div>

                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <p style="margin: 0;">Roughness:<span id="roughness-value"></span></p>
                                        <input id="roughness" type="range" min="0" max="1" step="0.02" value="1" style="flex-grow: 1; margin-left: 14px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Screen Capture -->
                    <div id="page_capture" class="col-12 d-none">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center"><button type="button" class="btn btn-outline-primary" id="download_1">Ảnh 1</button></div>
                                <img class="img-fluid capturedImage1" src="../Asset/upload/option/all.png" style="background-color: white;">  
                            </div>

                            <div class="col-6">
                                <div class="text-center"><button type="button" class="btn btn-outline-primary" id="download_2">Ảnh 2</button></div>
                                <img class="img-fluid capturedImage2" src="../Asset/upload/option/all.png" style="background-color: white;">
                            </div>
                            
                            <!-- <div class="col-3 mt-3">
                                <select class="form-select" id="chupanh" aria-label="Default select example">
                                    <option selected>Chụp Ảnh</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div> -->

                            <!-- <div class="col-3 mt-3">
                                <select class="form-select" id="groupSelect" aria-label="Default select example">
                                    <option selected>Số Nhóm</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>

                            <div class="col-3 mt-3">
                                <select class="form-select" id="imageSelect" aria-label="Default select example">
                                    <option selected>Số Ảnh</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div> -->

                            <!-- <div class="col-3 mt-3">
                                <button class="btn btn-outline-primary" id="confirmButton" onclick="displayImages()">Xác Nhận</button>
                            </div> -->

                            <!-- <div class="col-12" id="imagesContainer">
                            </div> -->
                        </div>
                    </div>

                    <!-- Page Change Button -->
                    <div id="page_button" class="col-12 d-none">
                        HHH
                    </div>

                    <!-- Page Add Product -->
                    <div id="page_addProduct" class="col-12 d-none">
                        <div class="row mb-3">
                            <div class="col-6 text-center">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_product_img">Thêm Sản Phẩm Image</button>
                                </div>
                            </div>

                            <div class="col-6 text-center">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_product_3d">Thêm Sản Phẩm 3D</button>
                                </div>
                            </div>
                        </div>

                        <!-- Img 1 & 2 -->
                        <div class="form-group mt-4 mb-4">
                            <h5>Ảnh Sản Phẩm</h5>
                            <div class="row">
                                <div class="col-6">
                                    <input type="file" class="form-control" accept=".png" id="img" name="img"/>
                                    <div id="selectedBanner"></div>
                                </div>

                                <div class="col-6">
                                    <input type="file" class="form-control" accept=".png" id="img2" name="img2"/>
                                    <div id="selectedBanner2"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Add product -->
                        <div class="modal fade" id="modal_product_img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thêm Sản Phẩm Hình Ảnh</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <!-- Product -->
                                    <div class="modal-body">
                                        <!-- Name product -->
                                        <div class="form-group">
                                            <label for="name_img" style="font-weight: 700; font-size: 20px;margin-bottom: 20px;">Tên sản phẩm:</label>
                                            <input type="text" class="form-control" name="name_img" placeholder="Nhập tên sản phẩm" >
                                        </div>

                                        <!-- Category -->
                                        <div class="form-group">
                                            <label for="categories" style="font-weight: 700; font-size: 20px; margin-top: 20px; margin-bottom: 20px;">Danh mục:</label>
                                            <select class="form-select" name="id_category_img" aria-label="Default select example">
                                                <option selected>Chọn danh mục</option>
                                                <?=$html_category_listImg;?>
                                            </select>
                                        </div>

                                        <!-- Price -->
                                        <div class="form-group">
                                            <label for="price" style="font-weight: 700; font-size: 20px; margin-top: 20px; margin-bottom: 20px;">Giá gốc</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="price_img" class="form-control" placeholder="Nhập giá gốc">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">VNĐ</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sale -->
                                        <div class="form-group">
                                            <label for="price" style="font-weight: 700; font-size: 20px; margin-top: 20px; margin-bottom: 20px;">Giá khuyến mãi</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="sale_img" class="form-control" placeholder="Nhập giá khuyến mãi">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">VNĐ</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detail -->
                                        <div class="form-group">
                                            <label style="font-weight: 700; font-size: 20px; margin-top: 20px;margin-bottom: 20px;">Mô tả chi tiết</label>
                                            <input type="text" name="detail_img" class="form-control" placeholder="Nhập mô tả về sản phẩm">
                                        </input>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" name="add_product_img" class="btn btn-primary">Thêm Sản Phẩm</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal_product_3d" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thêm Sản Phẩm 3D</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <input class="form-check-input" type="radio" hidden name="type_img" id="flexRadioDefault2" value="img" checked>
                                    </div>

                                    <div class="modal-body" id="form1">
                                        <button type="button" name="trans" class="btn btn-info">Options</button>
                                        <div class="form-group">
                                            <label for="name" style="font-weight: 700; font-size: 20px;margin-bottom: 20px;">Tên sản phẩm:</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm">
                                        </div>

                                        <div class="form-group">
                                            <label for="categories" style="font-weight: 700; font-size: 20px; margin-top: 20px; margin-bottom: 20px;">Danh mục:</label>
                                            <select class="form-select" name="id_category" aria-label="Default select example">
                                                <option selected>Chọn danh mục</option>
                                                <?=$html_category_list3D;?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="price" style="font-weight: 700; font-size: 20px; margin-top: 20px; margin-bottom: 20px;">Giá gốc</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="price" class="form-control" placeholder="Nhập giá gốc">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">VNĐ</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="price" style="font-weight: 700; font-size: 20px; margin-top: 20px; margin-bottom: 20px;">Giá khuyến mãi</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="sale" class="form-control" placeholder="Nhập giá khuyến mãi">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">VNĐ</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label style="font-weight: 700; font-size: 20px; margin-top: 20px;margin-bottom: 20px;">Mô tả chi tiết</label>
                                            <input type="text" name="detail" class="form-control" placeholder="Nhập mô tả về sản phẩm">
                                        </input>
                                        </div>
                                    </div>

                                    <div class="modal-body" id="form2" >
                                        <button type="button" name="trans2" class="btn btn-info">Add</button>
                                        <div class="form-group">
                                            <!-- Gr1 -->
                                            <div class="row mb-3">
                                                <h2 class="text-center" >Các Nút</h2>
                                                <!-- Type 0-->
                                                <div class="col-3 mt-2">
                                                    <h5 class="mt-2">Type 0</h5>
                                                    <div  id="input_materials">
                                                        <!-- Checkbox cho Loại 1 sẽ được thêm vào đây -->
                                                    </div>
                                                </div>

                                                <!-- Type 1 -->
                                                <div class="col-3 mt-2">
                                                    <h5 class="mt-2">Type 1</h5>
                                                    <div  id="input_materials_type1">
                                                        <!-- Checkbox cho Loại 1 sẽ được thêm vào đây -->
                                                    </div>
                                                </div>

                                                <!-- Type 2 -->
                                                <div class="col-3 mt-2">
                                                    <h5 class="mt-2">Type 2</h5>
                                                    <div  id="input_materials_type2">
                                                        <!-- Checkbox cho Loại 1 sẽ được thêm vào đây -->
                                                    </div>
                                                </div>

                                                <!-- Type 3 -->
                                                <div class="col-3 mt-2">
                                                    <h5 class="mt-2">Type 3</h5>
                                                    <div  id="input_materials_type3">
                                                        <!-- Checkbox cho Loại 1 sẽ được thêm vào đây -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" name="add_product_3d" class="btn btn-primary">Thêm Sản Phẩm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> 
</div>
