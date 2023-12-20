<?php
$html_list_users = show_users_admin($list_users);
?>


<!-- Users -->
<div class="row">
    <main>
        <div class="header">
            <div class="left">
                <h1>Users</h1>
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
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ Và Tên</th>
                        <th>Email</th>
                        <th>Trạng Thái</th>
                        <th>Chỉnh Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$html_list_users;?>
                    <!-- <tr>
                        <td style="margin-left: 20px;" >1</td>
                        <td>Nam</td>
                        <td>namyyuu@gmail.com</td>
                        <td><span class="status completed">Xác Nhận</span></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</main>