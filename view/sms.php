<?php 
include '../dao/pdo.php';
include '../dao/login.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($email, $code) {
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'videonbtn@gmail.com';
        $mail->Password   = 'bipnzbigruzzklvf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('videonbtn@gmail.com', '3D Viewer');
        $mail->addAddress($email, 'User');

        $mail->isHTML(true);
        $mail->Subject = 'Account Verification';

        // HTML email template
        $mail->Body = '
            <html>
            <head>
                <style>
                    /* CSS styles for better email layout */
                    .container {
                        margin: 20px;
                        padding: 20px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        font-family: Arial, sans-serif;
                    }
                    h1 {
                        color: #333;
                    }
                    .otp-code {
                        color: #333;
                        font-size: 24px;
                        font-weight: bold;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>XÁC MINH TÀI KHOẢN</h1>
                    <p>Mã OTP 6 chữ số của bạn là:</p>
                    <div class="otp-code">' . $code . '</div>
                </div>
            </body>
            </html>';

        $mail->AltBody = 'Mã OTP của bạn là: ' . $code;

        $mail->send();
    } catch (Exception $e) {
        // Handle exception if needed
    }
}


$msg='';

// Ham lay bien tu link
function Get($link) {
    if (isset($_GET[$link])) {
        return $_GET[$link];
    } else {
        header("Location: 404.php");
        exit;
    }
}

$email = Get('email');
$name = Get('name');


if (!isset($_POST['verify']) || isset($_POST['resend'])) {
    $code = rand(100000, 999999);
    update_code($code, $email);
    sendEmail($email, $code);
}

if (isset($_POST['verify'])) {
    $otp = "";
    for ($i = 1; $i <= 6; $i++) {
        $otp .= $_POST["otp$i"];
    }

    $check_code = check_code($email);

    if(isset($check_code) && is_array($check_code) && count($check_code)> 0) {

        extract($check_code);
        if ($code == $otp) {
            update_status(1,$email);
            if( $name == "login"){
                header("Location: ../index.php");
            } elseif ($name == "changepass") {
                header("Location: changepasswordall.php?email=".urlencode($email));
            }
        } else{
            $msg = "<div class='alert alert-danger'>Sai OTP</div>";
        }
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
    
</head>
<body>
    <div class="otp-card">
        <form action="" method="post">
            <h1>Xác Nhận OTP</h1>

            <div style="padding-top: 10px;">
                <p style="font-size: 18px;">Code bao gồm 6 chữ số sẽ gửi về: <strong> <h4><?php echo $email; ?></h4> </strong> </p>
            </div>

            <div class="otp-card-inputs">
                <input type="text" name="otp1" maxlength="1" autofocus>
                <input type="text" name="otp2" maxlength="1">
                <input type="text" name="otp3" maxlength="1">
                <input type="text" name="otp4" maxlength="1">
                <input type="text" name="otp5" maxlength="1">
                <input type="text" name="otp6" maxlength="1">
                
            </div>
            <p>Không thấy mã OTP ? <a href="" name="resend" > Gửi lại code</a></p>
            <button style="margin-bottom: 25px;" type="submit" name="verify">Xác Nhận</button>
            <?php echo $msg; ?>
        </form>
    </div>

    <script src="../Asset/js/login/verify.js"></script>
</body>
</html>