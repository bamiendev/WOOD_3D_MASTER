<?php
include '../dao/pdo.php';
include '../dao/login.php';

session_start();
$msg = "";


if (isset($_GET['email'])) {
    $email = $_GET['email'];
}

// Form Change Password
if (isset($_POST['change_password'])) {
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    if ($new_password == $confirm_password) {
        update_user($new_password,$email);

        // $_SESSION['verify_msg'] = "<div class='alert alert-success'>Đổi Mật Khẩu Thành Công.</div>";
        header("Location: ../index.php");
    } else {
        $msg = "<div class='alert alert-danger'>Confirm password does not match new password.</div>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
    <link rel="stylesheet" href="../Asset/css/login/verify.css">

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .otp-card-inputs1 {
            margin: 30px 0;
            display: grid;
            justify-content: center;
            grid-template-columns: repeat(6, auto);
        }

        .otp-card-inputs1 input {
            width: 350px;
            /* Thay đổi kích thước input để phản ánh responsive */
            height: 50px;
            /* Thay đổi kích thước input để phản ánh responsive */
            font-size: 25px;
            /* Thay đổi kích thước font để phản ánh responsive */
            text-align: center;
            border-radius: 10px;
            /* Giảm độ cong của góc để thích hợp với kích thước input */
            border: 1px solid black;
        }
    </style>

</head>

<body>
    <!-- Form Change Password -->
    <div class="otp-card" id="change-password-form">
        <form action="" method="post">
            <h2 style="margin-bottom: 25px; font-weight: 700;">Thay Đổi Mật Khẩu</h2>
            <div class="otp-card-inputs1">
                <input style="font-size: 18px;" placeholder="Nhập mật khẩu mới" type="password" name="new_password">
            </div>
            <div class="otp-card-inputs1">
                <input style="font-size: 18px;" placeholder="Xác nhận mật khẩu mới" type="password" name="confirm_password">
            </div>
            <button style="margin-bottom: 35px;" type="submit" name="change_password">Thay Đổi Mật Khẩu</button>
        </form>
        <?php echo $msg; ?>
    </div>

    <script src="../../Asset/js/login/verify.js"></script>
</body>

</html>