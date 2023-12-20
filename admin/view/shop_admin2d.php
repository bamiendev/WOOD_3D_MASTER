<?php
$html_list_product_img = show_product_admin($list_product_img);
$html_list_category_img = show_category_admin($list_category_img);
?>



<main>
    <div class="header">
        <div class="left">
            <h1>Shop</h1>
        </div>

        <nav>
            <a href="#" class="notif"> <i class='bx bx-bell'></i><span class="count">12</span></a>
        </nav>
    </div>
</main>


<main>
    <ul class="insights">
        <li id="category_img">
            <i class='bx bxs-image'></i>
            <span class="info">
                <h3><?=$total_category?></h3>
                <p>Danh Mục Hình Ảnh</p>
            </span>
        </li>

        <li id="product_img">
            <i class='bx bxs-image'></i>
            <span class="info">
                <h3><?=$total_product?></h3>
                <p>Sản Phẩm Hình Ảnh</p>
            </span>
        </li>
    </ul>
</main>

<div class="row">
    <div class="col-lg-12 mt-2" id="product_imgG">
        <div
            style="background-color: #f6f6f9;border-radius: 25px; margin-left: 30px;">
            <h2 class="text-center mb-2" style="padding-top: 20px;">Sản Phẩm Img</h2>
            <div class="mb-3" style="display: flex; justify-content: center; align-items: center;">
                <a href="indexadmin.php?pg=add_product">
                    <button type="button" class="button__">
                        <span class="button__text">Add Item</span>
                        <span class="button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke-linejoin="round" stroke-linecap="round"
                                stroke="currentColor" height="24" fill="none" class="svg">
                                <line y2="19" y1="5" x2="12" x1="12"></line>
                                <line y2="12" y1="12" x2="19" x1="5"></line>
                            </svg>
                        </span>
                    </button>
                </a>
            </div>
            
            <main>
                <div class="bottom-data">
                    <div class="orders">
                        <div class="header">
                            <h4>Toàn Bộ Sản Phẩm</h4>
                            <input placeholder="Tìm kiếm..." type="text" name="text" class="input_1">
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <td style="font-weight: 700; font-size:18px">STT</td>
                                    <th>Tên / Chi Tiết Sản Phẩm</th>
                                    <th>Danh Mục</th>
                                    <th>Giá</th>
                                    <th>Trạng Thái</th>
                                    <th>Chỉnh Sửa</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?=$html_list_product_img;?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="col-lg-12 mt-2" id="category">
        <div class="row">
            <div class="col-lg-12">
                <div style="background-color: #f6f6f9;border-radius: 25px; margin-left: 30px;">
                    <h2 class="text-center mb-2" style="padding-top: 20px;">Danh Mục Img</h2>
                    <div class="mb-3" style="display: flex; justify-content: center; align-items: center;">
                        <button type="button" class="button__" data-bs-toggle="modal"
                            data-bs-target="#modal_category">
                            <span class="button__text">Add Item</span>
                            <span class="button__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24"
                                    stroke-width="2" stroke-linejoin="round" stroke-linecap="round"
                                    stroke="currentColor" height="24" fill="none" class="svg">
                                    <line y2="19" y1="5" x2="12" x1="12"></line>
                                    <line y2="12" y1="12" x2="19" x1="5"></line>
                                </svg>
                            </span>
                        </button>
                    </div>
                
                    <main>
                        <div class="bottom-data">
                            <div class="orders">
                                <div class="header">
                                    <h4>Toàn Bộ Danh Mục</h4>
                                    <input placeholder="Tìm kiếm..." type="text" name="text" class="input_1">
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <td style="font-weight: 700; font-size:18px">STT</td>
                                            <td style="font-weight: 700; font-size:18px">Tên Danh Mục</td>
                                            <td style="font-weight: 700; font-size:18px">Sắp Xếp</td>
                                            <td style="font-weight: 700; font-size:18px">Chỉnh Sửa</td>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?=$html_list_category_img;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </main>
                </div>
            </div>

            <div class="modal fade" id="modal_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Danh Mục</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="addPro" action="indexadmin.php?pg=add_category" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Tên Danh Mục</label>
                                    <input type="text" class="form-control" name="name_category" id="name" placeholder="Nhập tên danh mục">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="name">Thứ Tự</label>
                                    <input type="text" class="form-control" name="stt_category" placeholder="Nhập thứ tự">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="name">Loại Danh Mục</label>
                                    <select class="form-select" name="select">
                                        <option value="img">Img</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" name="add_category" class="btn btn-primary">Thêm Danh Mục</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
