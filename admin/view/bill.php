<!-- Order -->
<?php
$html_showcart = show_bill_admin($bill_admin);
?>

<div class="row">
        <main>
            <div class="header">
                <div class="left">
                    <h1>Bill</h1>
                </div>

                <nav>
                    <a href="#" class="notif"> <i class='bx bx-bell'></i><span class="count">12</span></a>
                </nav>
            </div>
        </main>
    </div>

    <main>
        <div class="bottom-data">
            <div class="orders">
                <form method="post" action="">
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <input placeholder="Tìm kiếm đơn hàng" type="text" name="find" class="input_1">
                            <button name="find_md" class="btn btn-primary" type="submit">Find</button>
                        </div>
                    </div>
                </form>
                
                <table>
                    <thead>
                        <tr class="text-center">
                            <th>STT</th>
                            <th>Mã Đơn Hàng</th>
                            <th>Đơn Đặt Hàng</th>
                            <th>Thông Tin Chi Tiết</th>
                            <th>Trạng Thái</th>
                            <th>Chỉnh Sửa</th>
                        </tr>
                    </thead>

                    <?=$html_showcart?>
                </table>
            </div>
        </div>
    </main>