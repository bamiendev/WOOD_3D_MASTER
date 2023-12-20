<?php
extract($get_bill_user);
$loai = ($type == "No") ? 'Chờ Xác Nhận' : (($type == "Process") ? 'Đang Xử Lý' : 'Đang Giao Hàng');

$discount = number_format($ship+$voucher, 0, ',', '.');
$html_showCart = show_cart_user(get_cart_user($id));

?>
           <div class="col-lg-9">
                <div class = "invoice-wrapper" id = "print-area">
                    <div class = "invoice">
                        <div class = "invoice-container">
                            <div class = "invoice-head">
                                <div class = "invoice-head-top">
                                    <div class = "invoice-head-top-left text-start">
                                        <img src = "Asset/img/logo/logo_1.png">
                                    </div>
                                    <div class = "invoice-head-top-right text-end">
                                        <h3>Invoice</h3>
                                    </div>
                                </div>

                                <div class = "hr"></div>

                                <div class = "invoice-head-middle">
                                    <div class = "invoice-head-middle-left text-start">
                                        <p><span class = "text-bold">Date</span>: <?=$date?></p>
                                    </div>
                                    <div class = "invoice-head-middle-right text-end">
                                        <p><spanf class = "text-bold">Invoice No:</span><?=$madh?></p>
                                    </div>
                                </div>

                                <div class = "hr"></div>

                                <div class = "invoice-head-bottom">
                                    <div class = "invoice-head-bottom-left">
                                        <ul>
                                            <li class = 'text-bold'>Invoiced To:</li>
                                            <li><i class="fa-regular fa-user"></i> <?=$name?></li>
                                            <li><i class="fa-light fa-phone"></i> <?=$phone?></li>
                                            <li><i class="fa-regular fa-address-card"></i> <?=$address?></li>
                                            <li><i class="fa-regular fa-envelope"></i> <?=$email?></li>
                                        </ul>
                                    </div>
                                    <div class = "invoice-head-bottom-right">
                                        <ul class = "text-end">
                                            <li class = 'text-bold'>Pay To</li>
                                            <li>Wood 3D</li>
                                            <li>42/4 Trung Mỹ Tây 4, Quận 12, TP Hồ Chí Minh</li>
                                            <li>0918685740</li>
                                            <li>wood3d.master@gmail.com</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class = "overflow-view">
                                <div class = "invoice-body">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td class = "text-bold">Products</td>
                                                <td class = "text-bold">Options</td>
                                                <td class = "text-bold">Quantity</td>
                                                <td class = "text-bold">Price</td>
                                                <td class = "text-bold">Total</td>
                                            </tr>
                                        </thead>

                                        <?=$html_showCart?>
                                    </table>

                                    <div class = "invoice-body-bottom">
                                        <div class = "invoice-body-info-item border-bottom">
                                            <div class = "info-item-td text-end text-bold">Discount:</div>
                                            <div class = "info-item-td text-end"><span><?=$discount ?></span> VNĐ</div>
                                        </div>

                                        <div class = "invoice-body-info-item border-bottom">
                                            <div class = "info-item-td text-end text-bold">Total:</div>
                                            <div class = "info-item-td text-end" style="color:red"><span><?=number_format($total, 0, ',', '.')?></span> VNĐ</div>
                                        </div>

                                        <div class = "invoice-body-info-item">
                                            <div class = "info-item-td text-end text-bold">Status:</div>
                                            <div class = "info-item-td text-end"><?=$loai?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class = "invoice-foot text-center">
                                <p><span class = "text-bold text-center">NOTE:&nbsp;</span>This is computer generated receipt and does not require physical signature.</p>

                                <div class = "invoice-btns text-center">
                                    <button type = "button" class = "invoice-btn" onclick="printInvoice()">
                                        <span>
                                            <i class="fa-solid fa-print"></i>
                                        </span>
                                        <span>Print</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>