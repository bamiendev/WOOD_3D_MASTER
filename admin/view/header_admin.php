<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> -->
    <link rel="stylesheet" href="../Asset/css/fontawesome6.css" type="text/css">
    <link rel="stylesheet" href="../CND/bootstrap.min.css">
    <link rel="stylesheet" href="Asset/admin.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    <title>Wood3</title>

    <!-- dimesions -->
    <style>
        #controls {
            position: absolute;
            bottom: 16px;
            left: 16px;
            max-width: unset;
            transform: unset;
            pointer-events: auto;
            z-index: 100;
        }

        .dot {
            display: none;
        }

        .dim {
            background: #fff;
            border-radius: 4px;
            border: none;
            box-sizing: border-box;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
            color: rgba(0, 0, 0, 0.8);
            display: block;
            font-family: Futura, Helvetica Neue, sans-serif;
            font-size: 1em;
            font-weight: 700;
            max-width: 128px;
            overflow-wrap: break-word;
            padding: 0.5em 1em;
            position: absolute;
            width: max-content;
            height: max-content;
            transform: translate3d(-50%, -50%, 0);
            pointer-events: none;
            --min-hotspot-opacity: 0;
        }

        @media only screen and (max-width: 800px) {
            .dim {
                font-size: 3vw;
            }
        }

        .dimensionLineContainer {
            pointer-events: none;
            display: block;
        }

        .dimensionLine {
            stroke: #16a5e6;
            stroke-width: 2;
            stroke-dasharray: 2;
        }

        .hide {
            display: none;
        }

        /* This keeps child nodes hidden while the element loads */
        :not(:defined)>* {
            display: none;
        }
    </style>

    <style>
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        .orders table {
            overflow-x: auto;
        }

        .carousel-container img {
            width: 100%;
            height: auto;
        }

        .carousel-container {
            width: 100%;
            height: auto; 
            overflow: hidden;
        }
    </style>

    <!-- Css modelviewer -->
    <style>
        .control {
            display: flex;
            position: relative;
        }

        .viewer3D {
            flex: 100%;
        }


        .showfull {
            font-size: 25px;
            margin: 0 10px;
            position: absolute;
            bottom: 0;
            right: 0;

        }

        /* Color Modelviewer */
        #modelViewer {
            background-color: #b9b9b9;
        }

        .model-container {
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }

        @media (min-width: 961px) {
            .model-container {
                width: 100%;
                height: 100%;
            }
        }
    </style>

    <style>
        .modal-content {
            position: relative;
            width: calc(100% - 30px);
            left: 45px;
            transition: all 0.3s ease;
        }
    </style>

    <!-- Input -->
    <style>
        .input_1 {
            width: 100%;
            max-width: 220px;
            height: 45px;
            padding: 12px;
            border-radius: 12px;
            border: 1.5px solid lightgrey;
            outline: none;
            transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
            box-shadow: 0px 0px 20px -18px;
        }

        .input_1:hover {
            border: 2px solid lightgrey;
            box-shadow: 0px 0px 20px -17px;
        }

        .input_1:active {
            transform: scale(0.95);
        }

        .input_1:focus {
            border: 2px solid grey;
        }
    </style>

    <!-- Radio -->
    <style>
        .radio-inputs {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        border-radius: 0.5rem;
        background-color: #b9b9b9;
        box-sizing: border-box;
        box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
        padding: 0.25rem;
        width: 300px;
        font-size: 14px;
        }

        .radio-inputs .radio {
        flex: 1 1 auto;
        text-align: center;
        }

        .radio-inputs .radio input {
        display: none;
        }

        .radio-inputs .radio .name {
        display: flex;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        border: none;
        padding: .5rem 0;
        color: rgba(51, 65, 85, 1);
        transition: all .15s ease-in-out;
        }

        .radio-inputs .radio input:checked + .name {
        background-color: #fff;
        font-weight: 600;
        }
    </style>

    <!-- Alert -->
    <style>
        /* ======= Toast message ======== */
        #toast {
            position: fixed;
            top: 32px;
            right: 32px;
            z-index: 999999;
        }

        .toast {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 2px;
            padding: 20px 0;
            min-width: 400px;
            max-width: 450px;
            border-left: 4px solid;
            box-shadow: 0 5px 8px rgba(0, 0, 0, 0.08);
            transition: all linear 5s;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(calc(100% + 32px));
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
            }
        }

        .toast--success {
            border-color: #47d864;
        }

        .toast--success .toast__icon {
            color: #47d864;
        }

        .toast--info {
            border-color: #2f86eb;
        }

        .toast--info .toast__icon {
            color: #2f86eb;
        }

        .toast--warning {
            border-color: #ffc021;
        }

        .toast--warning .toast__icon {
            color: #ffc021;
        }

        .toast--error {
            border-color: #ff623d;
        }

        .toast--error .toast__icon {
            color: #ff623d;
        }

        .toast+.toast {
            margin-top: 24px;
        }

        .toast__icon {
            font-size: 24px;
        }

        .toast__icon,
        .toast__close {
            padding: 0 16px;
        }

        .toast__body {
            flex-grow: 1;
        }

        .toast__title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .toast__msg {
            font-size: 14px;
            color: #888;
            margin-top: 6px;
            line-height: 1.5;
        }

        .toast__close {
            font-size: 20px;
            color: rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .insights a{
            color: black;
        }
    </style>

    <!-- Button update -->
    <style>
        .button_update {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 999;
        }

    </style>
</head>

<body>
    <!-- Toast -->
    <div id="toast"></div>
    <!-- End of Toast -->

    <!-- Sidebar -->
    <div class="sidebar close">
        <a href="indexadmin.php?pg=ds" class="logo"> <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Wood</span>3D</div>
        </a>

        <ul class="side-menu">
            <nav style="margin-left: 15px;">
                <i class='bx bx-menu'></i>
            </nav>
        </ul>

        <ul class="side-menu">
            <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'add_product') echo ' class="active"'; ?>><a href="indexadmin.php?pg=add_product"><i class='bx bx-plus'></i>Add Products</a></li>
        </ul>

        <ul class="side-menu">
            <li <?php if (!isset($_GET['pg'])) echo ' class="active"'; ?>><a href="indexadmin.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'shop3d') echo ' class="active"'; ?>><a href="indexadmin.php?pg=shop3d"><i class='bx bx-cube' ></i>3D</a></li>
            <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'shop') echo ' class="active"'; ?>><a href="indexadmin.php?pg=shop"><i class='bx bxs-image' ></i>Image</a></li>

            <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'bill') echo ' class="active"'; ?>><a href="indexadmin.php?pg=bill"><i class='bx bx-clipboard'></i>Bill</a></li>
            <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'user') echo ' class="active"'; ?>><a href="indexadmin.php?pg=user"><i class='bx bx-user' ></i>Users</a></li>
            <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'voucher') echo ' class="active"'; ?>><a href="indexadmin.php?pg=voucher"><i class='bx bx-money'></i>Voucher</a></li>
            <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'comment') echo ' class="active"'; ?>><a href="indexadmin.php?pg=comment"><i class='bx bx-comment'></i>Comment</a></li>
            <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'home') echo ' class="active"'; ?>><a href="indexadmin.php?pg=home"><i class='bx bx-home-alt'></i>Comment</a></li>
        </ul>

        <ul class="side-menu">
            <li><a href="indexadmin.php?pg=logout" class="logout"><i class='bx bx-log-out-circle'></i>Logout</a></li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <div class="content">
        <div class="row">

