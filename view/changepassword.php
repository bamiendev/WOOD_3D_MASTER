<?php
include '../dao/pdo.php';
include '../dao/login.php';

session_start();
$msg = "";

// Form Forgot Password
if (isset($_POST['verify_email'])) {
    $email_verify = $_POST['email'];

    $check_email = check_email($email_verify);
    if(isset($check_email) && is_array($check_email) && count($check_email)> 0) {
        extract($check_email);

        if($email_verify == $email){
            header("Location: sms.php?email=".urlencode($email_verify )."&name=".urlencode("changepass"));
        }else{
            $msg = "<div class='alert alert-danger'>Có lỗi xảy ra!</div>";
        }

    } else {
        $msg = "<div class='alert alert-danger'>Email Không Tồn Tại. Vui Lòng Nhập Lại!</div>";
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
            height: 50px;
            font-size: 25px;
            text-align: center;
            border-radius: 10px;
            border: 1px solid black;
        }
    </style>

</head>
<body>

    <!-- Form Forgot Password -->
    <div class="otp-card" id="forgot-password-form">
        <form action="" method="post">
            <h2 style="margin-bottom: 25px; font-weight: 700;">Quên Mật Khẩu</h2>
            <p style="margin-bottom: 0px; font-size: 18px;">Vui lòng nhập email để lấy lại mật khẩu</p>
            <div class="otp-card-inputs1">
                <input style="font-size: 18px;" placeholder="Nhập vào email" type="email" name="email" autofocus>
            </div>
            <button style="margin-bottom: 45px;" type="submit" name="verify_email">Xác Nhận</button>
            <?php echo $msg;?>
        </form>
    </div>
    
    <script src="../Asset/js/login/verify.js"></script>
</body>
</html>