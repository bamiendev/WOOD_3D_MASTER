<?php
include '../dao/pdo.php';
include '../dao/login.php';


// Khai bao session
session_start();
$msg = "";

$img_home = get_all_home();

// Kiem tra si submit
if (isset($_POST['si_submit'])) {
    $name_si = $_POST['si_name'];
    $email_si = $_POST['si_email'];
    $password_si = md5($_POST['si_password']);
    $confirm_password_si = md5($_POST['si_confirm-password']);

    $user=check_user($email_si,$password_si);

    if(isset($user) && is_array($user) && count($user)> 0) {
        extract($user);
        $msg = "<div class='alert alert-danger'>{$email_si} - This email has already been registered.</div>";
    } else{
        if ($password_si === $confirm_password_si) {
            add_user($name_si , $email_si,$password_si ,0 ,0);
            header("Location: sms.php?email=".urlencode($email_si)."&name=".urlencode("login"));
        } else {
            $msg = "<div class='alert alert-danger'>Xác nhận mật khẩu không khớp</div>";
        }
    }
}


// Kiem tra si submit
if (isset($_POST['sg_submit'])) {
    $email_sg = $_POST['sg_email'];
    $password_sg = md5($_POST['sg_password']);

    $user=check_user($email_sg,$password_sg);

    if(isset($user) && is_array($user) && count($user)> 0) {

        extract($user);
        $_SESSION['rule'] = $status;
        $_SESSION['name_user'] = $name;
        $_SESSION['id_user'] = $id;
        $_SESSION['email_user'] = $email;

        if ($status == 1) {
            header("Location: ../index.php?pg=user");
        } elseif ($status == 2) {
            header("Location: ../admin/indexadmin.php");
        } else {
            header("Location: sms.php?email=".urlencode($email_sg)."&name=".urlencode("login"));
        }

    } else {
        $msg = "<div class='alert alert-danger'>Sai tài khoản hoặc mật khẩu</div>"; 
    }
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in & Sign up </title>

    <!-- Css -->
    <link rel="stylesheet" href="../Asset/css/login/login.css" />

    <!-- Icon -->

</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">

                    <!-- sign-in-form -->

                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" autocomplete="off" class="sign-in-form">
                        <a href="../index.php" style="text-decoration: none;">
                            <div class="logo">
                                <img src="../Asset/img/logo/logo_2.png" alt="easyclass" />
                                <img src="" data-src="../Asset/img/logo/logo_2.png">
                                <h4 style="text-align: center;" >Wood 3D</h4>
                            </div>
                        </a>
                        

                        <div class="heading">
                            <h2 style="text-align: center;" >WELCOME TO WOOD 3D</h2>
                            <h6 style="font-size:14px;">Chưa có tài khoản ? </h6>
                            <a href="#" class="toggle">Đăng Ký</a>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="email" name="sg_email" minlength="4" class="input-field" value="<?php if (isset($_POST['sg_submit'])) {echo $email_sg;} ?>"
                                autocomplete="off" required />
                                <label>Email</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="sg_password" minlength="4" class="input-field" autocomplete="off" required />
                                <label>Mật Khẩu</label>
                            </div>

                            <?php
                            if(isset($msg)&& $msg!=""){
                                echo $msg;
                            }
                            ?>

                            <input name="sg_submit" type="submit" value="Đăng Nhập" class="sign-btn" />

                            <p class="toggle1" style="margin-bottom:20px; font-size: 16px; ">
                                <a style="text-decoration: none; color: black;" href="changepassword.php">Quên Mật Khẩu ?</a>
                            </p>

                            <p class="text">
                                Quên mật khẩu hoặc bạn đăng nhập?
                                <a href="../index.php?pg=faqs" target="_blank">Nhận trợ giúp đăng nhập</a>
                            </p>

                        </div>
                    </form>

                    <!-- sign-up-form-->

                    <form action="" method="post" autocomplete="off" class="sign-up-form">
                        <a href="../index.php" style="text-decoration: none;">
                            <div class="logo">
                                <img src="../Asset/img/logo/logo_2.png" alt="easyclass" />
                                <h4 style="text-align: center;" >Wood 3D</h4>
                            </div>
                        </a>

                        <div class="heading">
                            <h3>Chất Lượng Hàng Đầu</h3>
                            <h6 style="font-size:14px;">Đã có tài khoản ? </h6>
                            <a href="#" class="toggle">Đăng Nhập</a>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input placeholder="Nhập vào tên" type="text" name="si_name" minlength="4" class="input-field" 
                                value="<?php if (isset($_POST['si_submit'])) {echo $name_si;} ?>" 
                                autocomplete="off" required />
                            </div>

                            <div class="input-wrap">
                                <input placeholder="Nhập vào email" type="email" name="si_email" class="input-field" 
                                value="<?php if (isset($_POST['si_submit'])) {echo $email_si;} ?>"
                                autocomplete="off" required />
                            </div>

                            <div class="input-wrap">
                                <input placeholder="Nhập vào mật khẩu" type="password" name="si_password" minlength="4" 
                                class="input-field" autocomplete="off" required />
                            </div>

                            <div class="input-wrap">
                                <input placeholder="Xác nhận mật khẩu" type="password" name="si_confirm-password" minlength="4" 
                                class="input-field" autocomplete="off" required />
                            </div>

                            <input name="si_submit" type="submit" value="Đăng Ký" class="sign-btn" />

                            <p class="text">
                                Bằng cách đăng ký, tôi đồng ý với
                                <a href="../index.php?pg=faqs&term" target="_blank">Điều khoản dịch vụ </a> và 
                                <a href="../index.php?pg=faqs&policy" target="_blank">Chính sách quyền riêng tư</a>
                            </p>
                        </div>
                    </form>
                </div>


                <!-- Slide -->
                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="../Asset/upload/home/<?=$img_home[0]["login1"]?>" class="image img-1 show" alt=""/>
                        <img src="../Asset/upload/home/<?=$img_home[0]["login2"]?>" class="image img-2" alt=""/>
                        <img src="../Asset/upload/home/<?=$img_home[0]["login3"]?>" class="image img-3" alt=""/>
                    </div>

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Vietnam's Premier 3D Viewer</h2>
                                <h2>Unleashing Unique Creative</h2>
                                <h2>AFFORDABLE PRICES</h2>
                            </div>
                        </div>

                        <div class="bullets">
                            <span class="active" data-value="1"></span>
                            <span data-value="2"></span>
                            <span data-value="3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Javascript file -->

    <script src="../Asset/js/login/login.js"></script>
</body>

</html>