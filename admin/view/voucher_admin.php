<?php
$html_list_voucher = show_voucher_admin($list_voucher);
$html_alert = $alert;
?>

<!-- Voucher -->
<div class="col-12" id="voucher">
    <div class="row">
        <main>
            <div class="header">
                <div class="left">
                    <h1>Voucher</h1>
                </div>

                <nav>
                    <a href="#" class="notif"> <i class='bx bx-bell'></i><span class="count">12</span></a>
                </nav>
            </div>
        </main>

        <form action="indexadmin.php?pg=add_voucher" method="post">
            <div style="display: flex; justify-content: center; align-items: center;">
                <button type="button" class="button__" data-bs-toggle="modal" data-bs-target="#modal_voucher">
                    <span class="button__text">Add Item</span>
                    <span class="button__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24"
                            fill="none" class="svg">
                            <line y2="19" y1="5" x2="12" x1="12"></line>
                            <line y2="12" y1="12" x2="19" x1="5"></line>
                        </svg>
                    </span>
                </button>
            </div>
            
            <!-- Modal Voucher -->
            <div class="modal fade" id="modal_voucher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Voucher</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Tên Voucher</label>
                                <input type="text" class="form-control" name="name_voucher" id="name" placeholder="Nhập tên voucher">
                            </div>
                        
                            <div class="form-group">
                                <label for="price_sale">Giảm Giá</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="price_voucher" id="price_sale" class="form-control"
                                        placeholder="Giá khuyến mãi">
                                    <div class="input-group-append">
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" name="add_voucher" class="btn btn-primary">Thêm Voucher</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?$html_alert?>
    <!-- Show voucher -->
    <div class="container-fluid">
        <div class="row mt-4">
            <?=$html_list_voucher;?>
        </div>
    </div>
</div>