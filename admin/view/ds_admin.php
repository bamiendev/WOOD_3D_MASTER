<?php 
$html_total = number_format((float) $total_doanhthu, 0, ',', '.');
$html_product = number_format((float) $total_product, 0, ',', '.');
$html_showcart = show_bill_ds($bill_admin);
?> 


<main>
    <div class="header">
        <div class="left">
            <h1>Dashboard</h1>
        </div>

        <nav>
            <a href="#" class="notif"> <i class='bx bx-bell'></i><span class="count">12</span></a>
        </nav>
    </div>

    <ul class="insights">
        <li>
            <i class='bx bx-calendar-check'></i>
            <a href="indexadmin.php?pg=bill">
                <span class="info">
                    <h3><?=$total_bill?></h3>
                    <p>Đơn Đặt Hàng</p>
                </span>
            </a>
        </li>


        <li><i class='bx bx-show-alt'></i>
            <a href="indexadmin.php?pg=user">
                <span class="info">
                    <h3><?=$total_user?></h3>
                    <p>Người Dùng</p>
                </span>
            </a>
        </li>

        <li><i class='bx bx-line-chart'></i>
            <a href="indexadmin.php?pg=shop">
                <span class="info">
                    <h3><?=$html_product?></h3>
                    <p>Sản Phẩm</p>
                </span>
            </a>
        </li>
        <li><i class='bx bx-dollar-circle'></i>
            <span class="info">
                <h3><span><?=$html_total?></span>đ</h3>
                <p>Doanh Thu</p>
            </span>
        </li>
    </ul>

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <h3>Đặt Hàng Gần Đây</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Người Dùng</th>
                        <th>Ngày Đặt</th>
                        <th>Mã Đơn Hàng</th>
                        <th>Trạng Thái</th>
                        <th class="text-center">Chi Tiết Đơn Hàng</th>
                        <th class="text-center">Chỉnh Sửa</th>
                    </tr>
                </thead>
                <?=$html_showcart?>
            </table>
        </div>
    </div>

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <h3>Hoạt Động Gần Đây</h3>
                <input placeholder="Tìm kiếm..." type="text" name="text" class="input_1">
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Người Dùng</th>
                        <th>Ngày Đăng</th>
                        <th>Nội Dung</th>
                        <th>Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="images/profile-1.jpg">
                            <p>Admin</p>
                        </td>
                        <td>14-08-2023</td>
                        <td>Đã Upload Thành Công Sản Phẩm T200</td>
                        <td><span class="status completed">Hoàn Thành</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>




