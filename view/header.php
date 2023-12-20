<?php
    $count_product = isset($_SESSION["cart_product"]) ? count($_SESSION["cart_product"]) : 0;
    $count_like = isset($_SESSION["like_product"]) ? count($_SESSION["like_product"]) : 0;

    if(isset($_SESSION['rule'])){
        $_html_login = 
        '
        <a href="index.php?pg=user">
            <i class="fa-regular fa-user"></i>
        </a>
        ';
    } else{
        $_html_login = 
        '
        <a href="view/login.php">
            <i class="fa-regular fa-user"></i>
        </a>
        ';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Home furniture at your price">
    <meta name="keywords" content="chairs, furniture, quality, bergen, belair, bartlett, richfield chairs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="Asset/img/favicon-02.png" type="image/png" sizes="16x16">
    <title>Wood 3D | ARIS</title>

    
    <!-- Css Styles -->
    <link rel="stylesheet" href="Asset/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="Asset/css/fontawesome6.css" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">
    
    <link rel="stylesheet" href="Asset/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="Asset/css/animation.css" type="text/css">
    <link rel="stylesheet" href="Asset/css/style.css" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="Asset/css/add.css" type="text/css">

    <!-- Loadding -->
    <style>
        @keyframes stageBackground {

            0%,
            10%,
            90%,
            100% {
                background-color: #00B6BB;
            }

            25%,
            75% {
                background-color: #0094bd;
            }
        }

        @keyframes earthRotation {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes sunrise {

            0%,
            10%,
            90%,
            100% {
                box-shadow: 0 0 0 25px #5ad6bd, 0 0 0 40px #4acead, 0 0 0 60px rgba(74, 206, 173, 0.6), 0 0 0 90px rgba(74, 206, 173, 0.3);
            }

            25%,
            75% {
                box-shadow: 0 0 0 0 #5ad6bd, 0 0 0 0 #4acead, 0 0 0 0 rgba(74, 206, 173, 0.6), 0 0 0 0 rgba(74, 206, 173, 0.3);
            }
        }

        @keyframes moonOrbit {
            25% {
                transform: rotate(-60deg);
            }

            50% {
                transform: rotate(-60deg);
            }

            75% {
                transform: rotate(-120deg);
            }

            0%,
            100% {
                transform: rotate(-180deg);
            }
        }

        @keyframes nightTime {

            0%,
            90% {
                opacity: 0;
            }

            50%,
            75% {
                opacity: 1;
            }
        }

        @keyframes hotPan {

            0%,
            90% {
                background-color: #74667e;
            }

            50%,
            75% {
                background-color: #b2241c;
            }
        }

        @keyframes heat {

            0%,
            90% {
                box-shadow: inset 0 0 0 0 rgba(255, 255, 255, 0.3);
            }

            50%,
            75% {
                box-shadow: inset 0 -2px 0 0 white;
            }
        }

        @keyframes smoke {

            0%,
            50%,
            90%,
            100% {
                opacity: 0;
            }

            50%,
            75% {
                opacity: 0.7;
            }
        }

        @keyframes fire {

            0%,
            90%,
            100% {
                opacity: 0;
            }

            50%,
            75% {
                opacity: 1;
            }
        }

        @keyframes treeShake {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-2deg);
            }

            40% {
                transform: rotate(4deg);
            }

            50% {
                transform: rotate(-4deg);
            }

            60% {
                transform: rotate(6deg);
            }

            75% {
                transform: rotate(-6deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        @keyframes fireParticles {
            0% {
                height: 30%;
                opacity: 1;
                top: 75%;
            }

            25% {
                height: 25%;
                opacity: 0.8;
                top: 40%;
            }

            50% {
                height: 15%;
                opacity: 0.6;
                top: 20%;
            }

            75% {
                height: 10%;
                opacity: 0.3;
                top: 0;
            }

            100% {
                opacity: 0;
            }
        }

        @keyframes fireLines {

            0%,
            25%,
            75%,
            100% {
                bottom: 0;
            }

            50% {
                bottom: 5%;
            }
        }

        .scene {
            display: flex;
            margin: 0 auto 80px auto;
            justify-content: center;
            align-items: flex-end;
            width: 400px;
            height: 300px;
            position: relative;
        }

        .forest {
            display: flex;
            width: 75%;
            height: 90%;
            position: relative;
        }

        .tree {
            display: block;
            width: 50%;
            position: absolute;
            bottom: 0;
            opacity: 0.4;
        }

        .tree .branch {
            width: 80%;
            height: 0;
            margin: 0 auto;
            padding-left: 40%;
            padding-bottom: 50%;
            overflow: hidden;
        }

        .tree .branch:before {
            content: "";
            display: block;
            width: 0;
            height: 0;
            margin-left: -600px;
            border-left: 600px solid transparent;
            border-right: 600px solid transparent;
            border-bottom: 950px solid #000;
        }

        .tree .branch.branch-top {
            transform-origin: 50% 100%;
            animation: treeShake 0.5s linear infinite;
        }

        .tree .branch.branch-middle {
            width: 90%;
            padding-left: 45%;
            padding-bottom: 65%;
            margin: 0 auto;
            margin-top: -25%;
        }

        .tree .branch.branch-bottom {
            width: 100%;
            padding-left: 50%;
            padding-bottom: 80%;
            margin: 0 auto;
            margin-top: -40%;
        }

        .tree1 {
            width: 31%;
        }

        .tree1 .branch-top {
            transition-delay: 0.3s;
        }

        .tree2 {
            width: 39%;
            left: 9%;
        }

        .tree2 .branch-top {
            transition-delay: 0.4s;
        }

        .tree3 {
            width: 32%;
            left: 24%;
        }

        .tree3 .branch-top {
            transition-delay: 0.5s;
        }

        .tree4 {
            width: 37%;
            left: 34%;
        }

        .tree4 .branch-top {
            transition-delay: 0.6s;
        }

        .tree5 {
            width: 44%;
            left: 44%;
        }

        .tree5 .branch-top {
            transition-delay: 0.7s;
        }

        .tree6 {
            width: 34%;
            left: 61%;
        }

        .tree6 .branch-top {
            transition-delay: 0.2s;
        }

        .tree7 {
            width: 24%;
            left: 76%;
        }

        .tree7 .branch-top {
            transition-delay: 0.1s;
        }

        .tent {
            width: 60%;
            height: 25%;
            position: absolute;
            bottom: -0.5%;
            right: 15%;
            z-index: 1;
            text-align: right;
        }

        .roof {
            display: inline-block;
            width: 45%;
            height: 100%;
            margin-right: 10%;
            position: relative;
            /*bottom: 0;
  right: 9%;*/
            z-index: 1;
            border-top: 4px solid #4D4454;
            border-right: 4px solid #4D4454;
            border-left: 4px solid #4D4454;
            border-top-right-radius: 6px;
            transform: skew(30deg);
            box-shadow: inset -3px 3px 0px 0px #F7B563;
            /*background: linear-gradient(
    to bottom, 
    rgba(246,212,132,1) 0%,
    rgba(246,212,132,1) 24%,
    rgba(#F0B656,1) 25%,
    rgba(#F0B656,1) 74%,
    rgba(235,151,53,1) 75%,
    rgba(235,151,53,1) 100%
  );*/
            background: #f6d484;
        }

        .roof:before {
            content: "";
            width: 70%;
            height: 70%;
            position: absolute;
            top: 15%;
            left: 15%;
            z-index: 0;
            border-radius: 10%;
            background-color: #E78C20;
        }

        .roof:after {
            content: "";
            height: 75%;
            width: 100%;
            position: absolute;
            bottom: 0;
            right: 0;
            z-index: 1;
            background: linear-gradient(to bottom, rgba(231, 140, 32, 0.4) 0%, rgba(231, 140, 32, 0.4) 64%, rgba(231, 140, 32, 0.8) 65%, rgba(231, 140, 32, 0.8) 100%);
        }

        .roof-border-left {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            width: 1%;
            height: 125%;
            position: absolute;
            top: 0;
            left: 35.7%;
            z-index: 1;
            transform-origin: 50% 0%;
            transform: rotate(35deg);
        }

        .roof-border-left .roof-border {
            display: block;
            width: 100%;
            border-radius: 2px;
            border: 2px solid #4D4454;
        }

        .roof-border-left .roof-border1 {
            height: 40%;
        }

        .roof-border-left .roof-border2 {
            height: 10%;
        }

        .roof-border-left .roof-border3 {
            height: 40%;
        }

        .door {
            width: 55px;
            height: 92px;
            position: absolute;
            bottom: 2%;
            overflow: hidden;
            z-index: 0;
            transform-origin: 0 105%;
        }

        .left-door {
            transform: rotate(35deg);
            position: absolute;
            left: 13.5%;
            bottom: -3%;
            z-index: 0;
        }

        .left-door .left-door-inner {
            width: 100%;
            height: 100%;
            transform-origin: 0 105%;
            transform: rotate(-35deg);
            position: absolute;
            top: 0;
            overflow: hidden;
            background-color: #EDDDC2;
        }

        .left-door .left-door-inner:before {
            content: "";
            width: 15%;
            height: 100%;
            position: absolute;
            top: 0;
            right: 0;
            background: repeating-linear-gradient(#D4BC8B, #D4BC8B 4%, #E0D2A8 5%, #E0D2A8 10%);
        }

        .left-door .left-door-inner:after {
            content: "";
            width: 50%;
            height: 100%;
            position: absolute;
            top: 15%;
            left: 10%;
            transform: rotate(25deg);
            background-color: #fff;
        }

        .right-door {
            height: 89px;
            right: 21%;
            transform-origin: 0 105%;
            transform: rotate(-30deg) scaleX(-1);
            position: absolute;
            bottom: -3%;
            z-index: 0;
        }

        .right-door .right-door-inner {
            width: 100%;
            height: 100%;
            transform-origin: 0 120%;
            transform: rotate(-30deg);
            position: absolute;
            bottom: 0px;
            overflow: hidden;
            background-color: #EFE7CF;
        }

        .right-door .right-door-inner:before {
            content: "";
            width: 50%;
            height: 100%;
            position: absolute;
            top: 15%;
            right: -28%;
            z-index: 1;
            transform: rotate(15deg);
            background-color: #524A5A;
        }

        .right-door .right-door-inner:after {
            content: "";
            width: 50%;
            height: 100%;
            position: absolute;
            top: 15%;
            right: -20%;
            transform: rotate(20deg);
            background-color: #fff;
        }

        .floor {
            width: 80%;
            position: absolute;
            right: 10%;
            bottom: 0;
            z-index: 1;
        }

        .floor .ground {
            position: absolute;
            border-radius: 2px;
            border: 2px solid #4D4454;
        }

        .floor .ground.ground1 {
            width: 65%;
            left: 0;
        }

        .floor .ground.ground2 {
            width: 30%;
            right: 0;
        }

        .fireplace {
            display: block;
            width: 24%;
            height: 20%;
            position: absolute;
            left: 5%;
        }

        .fireplace:before {
            content: "";
            display: block;
            width: 8%;
            position: absolute;
            bottom: -4px;
            left: 2%;
            border-radius: 2px;
            border: 2px solid #4D4454;
            background: #4D4454;
        }

        .fireplace .support {
            display: block;
            height: 105%;
            width: 2px;
            position: absolute;
            bottom: -5%;
            left: 10%;
            border: 2px solid #4D4454;
        }

        .fireplace .support:before {
            content: "";
            width: 100%;
            height: 15%;
            position: absolute;
            top: -18%;
            left: -4px;
            border-radius: 2px;
            border: 2px solid #4D4454;
            transform-origin: 100% 100%;
            transform: rotate(45deg);
        }

        .fireplace .support:after {
            content: "";
            width: 100%;
            height: 15%;
            position: absolute;
            top: -18%;
            left: 0px;
            border-radius: 2px;
            border: 2px solid #4D4454;
            transform-origin: 0 100%;
            transform: rotate(-45deg);
        }

        .fireplace .support:nth-child(1) {
            left: 85%;
        }

        .fireplace .bar {
            width: 100%;
            height: 2px;
            border-radius: 2px;
            border: 2px solid #4D4454;
        }

        .fireplace .hanger {
            display: block;
            width: 2px;
            height: 25%;
            margin-left: -4px;
            position: absolute;
            left: 50%;
            border: 2px solid #4D4454;
        }

        .fireplace .pan {
            display: block;
            width: 25%;
            height: 50%;
            border-radius: 50%;
            border: 4px solid #4D4454;
            position: absolute;
            top: 25%;
            left: 35%;
            overflow: hidden;
            animation: heat 5s linear infinite;
        }

        .fireplace .pan:before {
            content: "";
            display: block;
            height: 53%;
            width: 100%;
            position: absolute;
            bottom: 0;
            z-index: -1;
            border-top: 4px solid #4D4454;
            background-color: #74667e;
            animation: hotPan 5s linear infinite;
        }

        .fireplace .smoke {
            display: block;
            width: 20%;
            height: 25%;
            position: absolute;
            top: 25%;
            left: 37%;
            background-color: white;
            filter: blur(5px);
            animation: smoke 5s linear infinite;
        }

        .fireplace .fire {
            display: block;
            width: 25%;
            height: 120%;
            position: absolute;
            bottom: 0;
            left: 33%;
            z-index: 1;
            animation: fire 5s linear infinite;
        }

        .fireplace .fire:before {
            content: "";
            display: block;
            width: 100%;
            height: 2px;
            position: absolute;
            bottom: -4px;
            z-index: 1;
            border-radius: 2px;
            border: 1px solid #efb54a;
            background-color: #efb54a;
        }

        .fireplace .fire .line {
            display: block;
            width: 2px;
            height: 100%;
            position: absolute;
            bottom: 0;
            animation: fireLines 1s linear infinite;
        }

        .fireplace .fire .line2 {
            left: 50%;
            margin-left: -1px;
            animation-delay: 0.3s;
        }

        .fireplace .fire .line3 {
            right: 0;
            animation-delay: 0.5s;
        }

        .fireplace .fire .line .particle {
            height: 10%;
            position: absolute;
            top: 100%;
            z-index: 1;
            border-radius: 2px;
            border: 2px solid #efb54a;
            animation: fireParticles 0.5s linear infinite;
        }

        .fireplace .fire .line .particle1 {
            animation-delay: 0.1s;
        }

        .fireplace .fire .line .particle2 {
            animation-delay: 0.3s;
        }

        .fireplace .fire .line .particle3 {
            animation-delay: 0.6s;
        }

        .fireplace .fire .line .particle4 {
            animation-delay: 0.9s;
        }

        .time-wrapper {
            display: block;
            width: 100%;
            height: 100%;
            position: absolute;
            overflow: hidden;
        }

        .time {
            display: block;
            width: 100%;
            height: 200%;
            position: absolute;
            transform-origin: 50% 50%;
            transform: rotate(270deg);
            animation: earthRotation 5s linear infinite;
        }

        .time .day {
            display: block;
            width: 20px;
            height: 20px;
            position: absolute;
            top: 20%;
            left: 40%;
            border-radius: 50%;
            box-shadow: 0 0 0 25px #5ad6bd, 0 0 0 40px #4acead, 0 0 0 60px rgba(74, 206, 173, 0.6), 0 0 0 90px rgba(74, 206, 173, 0.3);
            animation: sunrise 5s ease-in-out infinite;
            background-color: #ef9431;
        }

        .time .night {
            animation: nightTime 5s ease-in-out infinite;
        }

        .time .night .star {
            display: block;
            width: 4px;
            height: 4px;
            position: absolute;
            bottom: 10%;
            border-radius: 50%;
            background-color: #ffee00;
        }

        .time .night .star-big {
            width: 6px;
            height: 6px;
        }

        .time .night .star1 {
            right: 23%;
            bottom: 25%;
        }

        .time .night .star2 {
            right: 35%;
            bottom: 18%;
        }

        .time .night .star3 {
            right: 47%;
            bottom: 25%;
        }

        .time .night .star4 {
            right: 22%;
            bottom: 20%;
        }

        .time .night .star5 {
            right: 18%;
            bottom: 30%;
        }

        .time .night .star6 {
            right: 60%;
            bottom: 20%;
        }

        .time .night .star7 {
            right: 70%;
            bottom: 23%;
        }

        .time .night .moon {
            display: block;
            width: 25px;
            height: 25px;
            position: absolute;
            bottom: 22%;
            right: 33%;
            border-radius: 50%;
            transform: rotate(-60deg);
            box-shadow: 9px 9px 3px 0 rgb(0, 0, 0);
            filter: blur(1px);
            animation: moonOrbit 5s ease-in-out infinite;
        }

        .time .night .moon:before {
            content: "";
            display: block;
            width: 100%;
            height: 100%;
            position: absolute;
            bottom: -9px;
            left: 9px;
            border-radius: 50%;
            box-shadow: 0 0 0 5px rgba(255, 255, 255, 0.05), 0 0 0 15px rgba(255, 255, 255, 0.05), 0 0 0 25px rgba(255, 255, 255, 0.05), 0 0 0 35px rgba(255, 255, 255, 0.05);
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>

    <style>
        .loader {
            position: relative;
        }

        .loader span {
            position: absolute;
            color: #fff;
            transform: translate(-50%, -50%);
            font-size: 30px;
            letter-spacing: 3px;
            width: 100%;
        }

        .loader span:nth-child(1) {
            color: transparent;
            -webkit-text-stroke: 0.3px rgb(43 43 43);
        }

        .loader span:nth-child(2) {
            color: rgb(212 212 212);
            -webkit-text-stroke: 1px rgb(43 43 43);
            animation: uiverse723 3s ease-in-out infinite;
        }

        @keyframes uiverse723 {

            0%,
            100% {
                clip-path: polygon(0% 45%, 15% 44%, 32% 50%,
                        54% 60%, 70% 61%, 84% 59%, 100% 52%, 100% 100%, 0% 100%);
            }

            50% {
                clip-path: polygon(0% 60%, 16% 65%, 34% 66%,
                        51% 62%, 67% 50%, 84% 45%, 100% 46%, 100% 100%, 0% 100%);
            }
        }
    </style>

    <style>
        /* CSS để tạo hiệu ứng chuyển đổi */
        @keyframes tick {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            transform: scale(1.2);
            opacity: 1;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
        }
    </style>

    <style>
        .buttonn {
        position: relative;
        padding: 14px 70px;
        background: #000000;
        font-size: 17px;
        font-weight: 500;
        color: #ffffff;
        border: 3px solid #c1c1c1;
        border-radius: 8px;
        box-shadow: 0 0 0 #5050508c;
        transition: all .3s ease-in-out;
        }

        .star-1 {
        position: absolute;
        top: 20%;
        left: 20%;
        width: 25px;
        height: auto;
        filter: drop-shadow(0 0 0 #fffdef);
        z-index: -5;
        transition: all 1s cubic-bezier(0.05, 0.83, 0.43, 0.96);
        }

        .star-2 {
        position: absolute;
        top: 45%;
        left: 45%;
        width: 15px;
        height: auto;
        filter: drop-shadow(0 0 0 #fffdef);
        z-index: -5;
        transition: all 1s cubic-bezier(0, 0.4, 0, 1.01);
        }

        .star-3 {
        position: absolute;
        top: 40%;
        left: 40%;
        width: 5px;
        height: auto;
        filter: drop-shadow(0 0 0 #fffdef);
        z-index: -5;
        transition: all 1s cubic-bezier(0, 0.4, 0, 1.01);
        }

        .star-4 {
        position: absolute;
        top: 20%;
        left: 40%;
        width: 8px;
        height: auto;
        filter: drop-shadow(0 0 0 #fffdef);
        z-index: -5;
        transition: all .8s cubic-bezier(0, 0.4, 0, 1.01);
        }

        .star-5 {
        position: absolute;
        top: 25%;
        left: 45%;
        width: 15px;
        height: auto;
        filter: drop-shadow(0 0 0 #fffdef);
        z-index: -5;
        transition: all .6s cubic-bezier(0, 0.4, 0, 1.01);
        }

        .star-6 {
        position: absolute;
        top: 5%;
        left: 50%;
        width: 5px;
        height: auto;
        filter: drop-shadow(0 0 0 #fffdef);
        z-index: -5;
        transition: all .8s ease;
        }

        .buttonn:hover {
        background: transparent;
        color: #ff0000;
        box-shadow: 0 0 25px #fec1958c;
        }

        button:hover .star-1 {
        position: absolute;
        top: -80%;
        left: -30%;
        width: 25px;
        height: auto;
        filter: drop-shadow(0 0 10px #fffdef);
        z-index: 2;
        }

        button:hover .star-2 {
        position: absolute;
        top: -25%;
        left: 10%;
        width: 15px;
        height: auto;
        filter: drop-shadow(0 0 10px #fffdef);
        z-index: 2;
        }

        button:hover .star-3 {
        position: absolute;
        top: 55%;
        left: 25%;
        width: 5px;
        height: auto;
        filter: drop-shadow(0 0 10px #fffdef);
        z-index: 2;
        }

        button:hover .star-4 {
        position: absolute;
        top: 30%;
        left: 80%;
        width: 8px;
        height: auto;
        filter: drop-shadow(0 0 10px #fffdef);
        z-index: 2;
        }

        button:hover .star-5 {
        position: absolute;
        top: 25%;
        left: 115%;
        width: 15px;
        height: auto;
        filter: drop-shadow(0 0 10px #fffdef);
        z-index: 2;
        }

        button:hover .star-6 {
        position: absolute;
        top: 5%;
        left: 60%;
        width: 5px;
        height: auto;
        filter: drop-shadow(0 0 10px #fffdef);
        z-index: 2;
        }

        .star-1,
        .star-2,
        .star-3,
        .star-4,
        .star-5,
        .star-6 {
        fill: #FF0000;
        }

        .buttonn:hover .star-1,
        .buttonn:hover .star-2,
        .buttonn:hover .star-3,
        .buttonn:hover .star-4,
        .buttonn:hover .star-5,
        .buttonn:hover .star-6 {

        fill: #FFFF00;
        }
    </style>

    <style>
        .btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 13rem;
            overflow: hidden;
            height: 3rem;
            background-size: 300% 300%;
            backdrop-filter: blur(1rem);
            border-radius: 5rem;
            transition: 0.5s;
            animation: gradient_301 5s ease infinite;
            border: double 4px transparent;
            background-image: linear-gradient(#212121, #212121), linear-gradient(137.48deg, #ffdb3b 10%, #FE53BB 45%, #8F51EA 67%, #0044ff 87%);
            background-origin: border-box;
            background-clip: content-box, border-box;
        }

        #container-stars {
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            overflow: hidden;
            transition: 0.5s;
            backdrop-filter: blur(1rem);
            border-radius: 5rem;
        }

        strong {
            z-index: 2;
            font-size: 12px;
            letter-spacing: 5px;
            color: #FFFFFF;
            text-shadow: 0 0 4px white;
        }

        #glow {
            position: absolute;
            display: flex;
            width: 12rem;
        }

        .circle {
            width: 100%;
            height: 30px;
            filter: blur(2rem);
            animation: pulse_3011 4s infinite;
            z-index: -1;
        }

        .circle:nth-of-type(1) {
            background: rgba(254, 83, 186, 0.636);
        }

        .circle:nth-of-type(2) {
            background: rgba(142, 81, 234, 0.704);
        }

        .btn:hover #container-stars {
            z-index: 1;
            background-color: #212121;
        }

        .btn:hover {
            transform: scale(1.1)
        }

        .btn:active {
            border: double 4px #FE53BB;
            background-origin: border-box;
            background-clip: content-box, border-box;
            animation: none;
        }

        .btn:active .circle {
            background: #FE53BB;
        }

        #stars {
            position: relative;
            background: transparent;
            width: 200rem;
            height: 200rem;
        }

        #stars::after {
            content: "";
            position: absolute;
            top: -10rem;
            left: -100rem;
            width: 100%;
            height: 100%;
            animation: animStarRotate 90s linear infinite;
        }

        #stars::after {
            background-image: radial-gradient(#ffffff 1px, transparent 1%);
            background-size: 50px 50px;
        }

        #stars::before {
            content: "";
            position: absolute;
            top: 0;
            left: -50%;
            width: 170%;
            height: 500%;
            animation: animStar 60s linear infinite;
        }

        #stars::before {
            background-image: radial-gradient(#ffffff 1px, transparent 1%);
            background-size: 50px 50px;
            opacity: 0.5;
        }

        @keyframes animStar {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-135rem);
            }
        }

        @keyframes animStarRotate {
            from {
                transform: rotate(360deg);
            }

            to {
                transform: rotate(0);
            }
        }

        @keyframes gradient_301 {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes pulse_3011 {
            0% {
                transform: scale(0.75);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
            }

            100% {
                transform: scale(0.75);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            }
        }
    </style>
    
    <!-- End Css Styles -->
    <style>
        /* CSS */
        .product-pic-zoom {
            position: relative;
            overflow: hidden;
        }

        .product-pic-zoom:hover .product-big-img {
            transform: scale(1.3); /* Thay đổi kích thước ảnh khi hover */
            transition: transform 0.3s ease;
        }

        /* Tuỳ chỉnh kích thước của ảnh */
        .product-big-img {
            transition: transform 0.4s ease;
        }

        .modal-body {
            padding: 0;
        }

        .modal-backdrop.show {
            opacity: 0.7;
        }

        .zoomable .modal-body img {
        width: 100%;
        transition: transform 0.2s ease;
        }

        .zoomable .modal-body img.zoom-in {
        transform: scale(2);
        }

        .icon_modal{
            display: none;
        }

        @media (min-width: 	960px){
            .modal-content {
                background-color: transparent;
                border: none;
                box-shadow: none;
            }

            .modal-dialog {
                background-color: transparent;
            }

            .modal-backdrop {
                opacity: 0.5;
                backdrop-filter: blur(10px);
            }

            .icon_modal{
                display: block;
            }
        }

    </style>
 
    <style>
                
        .product-shop.page-details {
            padding-bottom: 60px;
        }

        .product-pic-zoom {
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .product-pic-zoom .zoom-icon {
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .product-pic-zoom .zoom-icon i {
            color: #4c4c4c;
            font-size: 14px;
            width: 40px;
            height: 40px;
            border: 1px solid #d7d7d7;
            text-align: center;
            border-radius: 50%;
            line-height: 37px;
        }

        .product-thumbs .pt {
            cursor: pointer;
            position: relative;
        }

        .product-thumbs .pt.active:after {
            position: absolute;
            content: "";
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            border: 1px solid #1B2F44;
            z-index: 1;
        }

        .ps-slider .owl-nav button[type=button] {
            height: 30px;
            width: 30px;
            background: #ffffff;
            color: #a7a7a7;
            text-align: center;
            line-height: 30px;
            border-radius: 50%;
            font-size: 20px;
            -webkit-box-shadow: 0px 6px 10px -1px #e9e9e9;
            box-shadow: 0px 6px 10px -1px #e9e9e9;
            position: absolute;
            left: -16px;
            top: 50%;
            -webkit-transform: translateY(-15px);
            -ms-transform: translateY(-15px);
            transform: translateY(-15px);
        }

        .ps-slider .owl-nav button[type=button].owl-next {
            left: auto;
            right: -16px;
        }

        .product-details .pd-title {
            position: relative;
            margin-bottom: 6px;
        }

        .product-details .pd-title span {
            display: block;
            font-size: 12px;
            color: #b2b2b2;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            line-height: 23px;
        }

        .product-details .pd-title h3 {
            color: #252525;
            font-weight: 700;
        }

        .product-details .pd-title .heart-icon {
            color: #252525;
            font-size: 18px;
            cursor: pointer;
            position: absolute;
            right: 0;
            top: 0;
        }

        .product-details .pd-rating {
            margin-bottom: 10px;
        }

        .product-details .pd-rating i {
            font-size: 16px;
            display: inline-block;
            color: #FAC451;
            margin-right: 3px;
        }

        .product-details .pd-rating span {
            font-size: 12px;
            color: #999591;
        }

        .product-details .pd-desc {
            margin-bottom: 24px;
        }

        .product-details .pd-desc p {
            color: #636363;
            text-align: justify;
        }

        .product-details .pd-desc h4 {
            color: #1B2F44;
            font-weight: 700;
        }

        .product-details .pd-desc h4 span {
            font-size: 18px;
            font-weight: 400;
            color: #b7b7b7;
            text-decoration: line-through;
            display: inline-block;
            margin-left: 13px;
        }

        .product-details .pd-color {
            margin-bottom: 25px;
        }

        .product-details .pd-color h6 {
            color: #1B2F44;
            font-weight: 700;
            float: left;
            margin-right: 28px;
        }

        .product-details .pd-color .pd-color-choose {
            display: inline-block;
        }


        .product-details .pd-color .pd-color-choose .cc-item input {
            position: absolute;
            visibility: hidden;
        }

        .product-details .pd-color .pd-color-choose .cc-item label {
            height: 20px;
            width: 20px;
            background: #252525;
            border-radius: 50%;
            cursor: pointer;
            margin-bottom: 0;
        }

        .product-details .pd-color .pd-color-choose .cc-item label.active {
            border: 2px #1B2F44 solid;
        }

        .product-details .quantity {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 33px;
        }

        .product-details .quantity .pro-qty {
            width: 123px;
            height: 46px;
            border: 2px solid #ebebeb;
            padding: 0 15px;
            float: left;
            margin-right: 14px;
        }

        .product-details .quantity .pro-qty .qtybtn {
            font-size: 24px;
            color: #b2b2b2;
            float: left;
            line-height: 38px;
            cursor: pointer;
            width: 18px;
        }

        .product-details .quantity .pro-qty .qtybtn.dec {
            font-size: 30px;
        }

        .product-details .quantity .pro-qty input {
            text-align: center;
            width: 52px;
            font-size: 14px;
            font-weight: 700;
            border: none;
            color: #4c4c4c;
            line-height: 40px;
            float: left;
        }

        .product-details .quantity .primary-btn.pd-cart {
            padding: 14px 70px 10px;
        }

        .product-details .pd-tags {
            margin-bottom: 27px;
        }

        .product-details .pd-tags li {
            list-style: none;
            font-size: 16px;
            color: #636363;
            line-height: 30px;
            margin: 15px 0px;
        }

        .product-details .pd-tags li span {
            color: #1B2F44;
            font-weight: 700;
            text-transform: uppercase;
        }

        .product-details .pd-share {
            overflow: hidden;
        }

        .product-details .pd-share .p-code {
            font-size: 16px;
            color: #252525;
            float: left;
        }

        .product-details .pd-share .pd-social {
            float: right;
        }

        .product-details .pd-share .pd-social a {
            display: inline-block;
            color: #252525;
            font-size: 14px;
            margin-left: 15px;
        }

        .product-tab {
            padding-top: 60px;
        }

        .tab-item {
            width: 100%;
        }

        .tab-item ul li a {
            display: inline-block;
            font-size: 16px;
            font-weight: 700;
            color: #b2b2b2;
            text-transform: uppercase;
            padding: 18px 60.25px;
            position: relative;
            border-bottom: 1px solid #ebebeb;
        }

        .tab-item ul li a.active {
            color: #252525;
            border-bottom: none;
            border-left: 1px solid #ebebeb;
            border-right: 1px solid #ebebeb;
        }

        .tab-item ul li a.active:before {
            opacity: 1;
        }

        .tab-item ul li a::before {
            position: absolute;
            left: 0;
            top: -1px;
            width: 100%;
            height: 5px;
            background: #1B2F44;
            content: "";
            opacity: 0;
        }
    </style>

    <style>
        .input {
            border: none;
            outline: none;
            border-radius: 15px;
            padding: 12px;
            background-color: #ccc;
            box-shadow: inset 2px 5px 10px rgba(0,0,0,0.3);
            transition: 300ms ease-in-out;
            width: 100%;
            }

            .input:focus {
            background-color: white;
            transform: scale(1.05);
            box-shadow: 13px 13px 100px #969696,
                        -13px -13px 100px #ffffff;
            }
    </style>

    <!-- Modelviewr -->
    <style>
        .viewer3D {
            flex: 100%;
        }

        .showfull {
            font-size: 30px;
            margin: 10px 15px;
            position: absolute;
            bottom: 0;
            right: 0;
        }

        .show .form-select {
            background-color: transparent;
            color: rgb(0, 0, 0);
            font-weight: 700;
            border-radius: 10px;
        }

        .showfull button{
            background: none;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }

        /* Color Modelviewer */

        #modelViewer:fullscreen {
            background-color: #ffffff;
        }

        #modelViewer {
            background-color: #fff; /* Màu nền mặc định */
        }

        .model-container {
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }

        @media (max-width: 540px) {
            .model-container {
                width: 100%;
                height: 500px;
            }
        }

        @media (min-width: 200px) and (max-width: 380px) {
            .model-container {
                width: 100%;
                height: 380px;
            }
        }

        @media (min-width: 541px) and (max-width: 700px) {
            .model-container {
                width: 100%;
                height: 500px;
            }
        }

        @media (min-width: 775px) and (max-width: 1025px) {
            .model-container {
                width: 100%;
                height: 100%;
            }
        }

        @media (min-width: 1025px) {
            .model-container {
                height: 100vh;
                width: 100%;
            }
        }

        h6 a{
            color: black;
        }
        h6 a:hover{
            color: #ff0000;
        }
        p a{
            color: black;
        }

        p a:hover{
            color: #ff0000;
        }
        button a{
            color: white;
        }
        button a:hover{
            color: red;
        }

        /* .model-container {
            height: 650px;
            width: 100%;
        } */
    </style>

    <!-- Quantity -->
    <style>
        .quantity {
            display: inline-block;
        }

        .quantity .input-text.qty {
            width: 35px;
            height: 39px;
            padding: 0 5px;
            text-align: center;
            background-color: transparent;
            border: 1px solid #efefef;
        }

        .quantity.buttons_added {
            text-align: left;
            position: relative;
            white-space: nowrap;
            vertical-align: top;
        }

        .quantity.buttons_added input {
            display: inline-block;
            margin: 0;
            vertical-align: top;
            box-shadow: none;
        }

        .quantity.buttons_added .minus,
        .quantity.buttons_added .plus {
            padding: 7px 10px 8px;
            height: 41px;
            background-color: #ffffff;
            border: 1px solid #efefef;
            cursor: pointer;
        }

        .quantity.buttons_added .minus {
            border-right: 0;
        }

        .quantity.buttons_added .plus {
            border-left: 0;
        }

        .quantity.buttons_added .minus:hover,
        .quantity.buttons_added .plus:hover {
            background: #eeeeee;
        }

        .quantity input::-webkit-outer-spin-button,
        .quantity input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            margin: 0;
        }

        .quantity.buttons_added .minus:focus,
        .quantity.buttons_added .plus:focus {
            outline: none;
        }
    </style>

    <style>
        :root{
            --blue-color: #0c2f54;
            --dark-color: #535b61;
            --white-color: #fff;
        }

        .text-dark{
            color: var(--dark-color);
        }
        .text-blue{
            color: var(--blue-color);
        }
        .text-end{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
        .text-start{
            text-align: left;
        }
        .text-bold{
            font-weight: 700;
        }
        .hr{
            height: 1px;
            background-color: rgba(0, 0, 0, 0.1);
        }
        .border-bottom{
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        .invoice{
            max-width: 850px;
            margin-right: auto;
            margin-left: auto;
            background-color: var(--white-color);
            padding: 30px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            min-height: 800px;
            margin-bottom: 20px;
        }
        .invoice-head-top-left img{
            width: 130px;
        }
        .invoice-head-top-right h3{
            font-weight: 500;
            font-size: 27px;
            color: var(--blue-color);
        }
        .invoice-head-middle, .invoice-head-bottom{
            padding: 16px 0;
        }
        .invoice-body{
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }
        .invoice-body table{
            border-collapse: collapse;
            border-radius: 4px;
            width: 100%;
        }
        .invoice-body table td, .invoice-body table th{
            padding: 12px;
        }
        .invoice-body table tr{
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        .invoice-body table thead{
            background-color: rgba(0, 0, 0, 0.02);
        }
        .invoice-body-info-item{
            display: grid;
            grid-template-columns: 80% 20%;
        }
        .invoice-body-info-item .info-item-td{
            padding: 12px;
            background-color: rgba(0, 0, 0, 0.02);
        }
        .invoice-foot{
            padding: 30px 0;
        }
        .invoice-foot p{
            font-size: 12px;
        }
        .invoice-btns{
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .invoice-btn{
            padding: 3px 9px;
            color: var(--dark-color);
            font-family: inherit;
            border: 1px solid rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .invoice-head-top, .invoice-head-middle, .invoice-head-bottom{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            padding-bottom: 10px;
        }

        @media screen and (max-width: 992px){
            .invoice{
                padding: 40px;
            }
        }

        @media screen and (max-width: 576px){
            .invoice-head-top, .invoice-head-middle, .invoice-head-bottom{
                grid-template-columns: repeat(1, 1fr);
            }
            .invoice-head-bottom-right{
                margin-top: 12px;
                margin-bottom: 12px;
            }
            .invoice *{
                text-align: left;
            }
            .invoice{
                padding: 28px;
            }
        }

        .overflow-view{
            overflow-x: scroll;
        }
        .invoice-body{
            min-width: 600px;
        }

        @media print{
            .print-area{
                visibility: visible;
                width: 100%;
                position: absolute;
                left: 0;
                top: 0;
                overflow: hidden;
            }

            .overflow-view{
                overflow-x: hidden;
            }

            .invoice-btns{
                display: none;
            }

            .header-top, .nav-bar-container,.footer-section{
                display: none;
            }
            #all, #user, #page_user{
                display: none;
            }
        }
    </style>
</head>

<body>
<!-- Start coding here -->

<!-- Header -->
<header>
    <!-- 1 -->
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class="fa-sharp fa-solid fa-envelope"></i>
                    wood3d.master@gmail.com
                </div>
                <div class="phone-service">
                    <i class="fa-duotone fa-phone"></i>
                    +84 (918) 685 740
                </div>
            </div>
            <div class="ht-right">
                <div class="lan-selector">
                    <select class="language_drop" id="countries" name="countries" style="width: 300px">
                        <option value="vn" data-image="Asset/img/flag2.png" 
                            data-imagecss="flag-vn" data-title="Vietnam">Việt Nam</option>

                        <option value="en" data-image="Asset/img/flag-1.jpg" 
                            data-imagecss="flag en" data-title="English">English
                        </option>

                        <option value="ch" data-image="Asset/img/flag3.jpg" 
                            data-imagecss="flag-ch" data-title="china">Chinese</option>
                    </select>
                </div>
                <div class="top-social">
                    <a href=""><i class="fa-brands fa-facebook fa-beat-fade" style="color: #2977ff;"></i></a>
                    <a href="#"><i class="fa-brands fa-pinterest" style="color: #ff0000;"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2 -->
    <div class="nav-bar-container">
        <div class = "container-fluid">
            <div class="row">
                <div class = "nav-bar">
                    <ul>
                        <li <?php if (!isset($_GET['pg'])) echo ' class="active"';?>><a href="index.php">Home</a></li>

                        <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'product_img') echo ' class="active"';?>><a href="index.php?pg=product_img">Products</a>
                            <ul class="dropdown" style="width: 150px; padding: 10px 12px">
                                <li><a href="index.php?pg=product_img"><i class="fa-light fa-image fa-bounce fa-xl"></i> Image</a></li>
                            </ul>
                        </li>

                        <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'product') echo ' class="active"';?>><a href="index.php?pg=product">Products</a>
                            <ul class="dropdown" style="width: 150px; padding: 10px 12px">
                                <li><a href="index.php?pg=product"><i class="fa-sharp fa-light fa-cube fa-beat fa-xl"></i> 3D</a></li>
                            </ul>
                        </li>

                        <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'sale') echo ' class="active"';?>><a href="index.php?pg=sale">Sale</a></li>

                        <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'faqs') echo ' class="active"';?>><a href="index.php?pg=faqs">FAQs</a>
                            <ul class="dropdown" style="width: 200px; padding: 10px 12px">
                                <li><a href="index.php?pg=faqs&policy">Return Policy</a></li>
                                <li><a href="index.php?pg=faqs&term">Terms & Conditions</a></li>
                            </ul>
                        </li>

                        <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'blog') echo ' class="active"';?>><a href="index.php?pg=blog">Blogs</a>
                            <ul class="dropdown" style="width: 150px; padding: 10px 12px">
                                <li><a href="index.php?pg=faqs&inspired">Get Inspired</a></li>
                            </ul>
                        </li>
                        
                        <li <?php if (isset($_GET['pg']) && $_GET['pg'] == 'contact') echo ' class="active"';?> class = "last"><a href = "index.php?pg=contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile -->
    <div role="navigation" id = "mobilenav">
        <div id="menuToggle">
            <input type="checkbox">
            <span></span>
            <span></span>
            <span></span>
            <ul id="menu">
                <li class = "nav-item text-center">
                    <img src="Asset/img/logo/logo_1.png">
                </li>
                <li class = "nav-item">
                    <ul class = "ham-dropdown">
                        <a href="index.php" class = "nav-item"><li><i class="fa-solid fa-house"></i>  Home</li></a>
                    </ul>
                </li>

                <li class = "nav-item">
                    <ul class = "ham-dropdown">
                        <a href="index.php?pg=product_img" class = "nav-item"><li><i class="fa-regular fa-image"></i> Products Image</li></a>
                    </ul>
                </li>

                <li class = "nav-item">
                    <ul class = "ham-dropdown">
                        <a href="index.php?pg=product" class = "nav-item"><li><i class="fa-sharp fa-light fa-cube"></i> Products 3D</li></a>
                    </ul>
                </li>

                <li class = "nav-item">
                    <ul class = "ham-dropdown">
                        <a href="index.php?pg=sale" class = "nav-item"><i class="fa-light fa-store"></i> Sale</li></a>
                    </ul>
                </li>

                <li class = "nav-item">
                    <ul class = "ham-dropdown">
                        <a href="index.php?pg=faqs" class = "nav-item"><li><i class="fa-regular fa-thumbs-up"></i> FAQs</li></a>
                    </ul>
                </li>

                <li class = "nav-item">
                    <ul class = "ham-dropdown">
                        <a href="index.php?pg=blog" class = "nav-item"><li><i class="fa-solid fa-blog"></i> Blogs</li></a>
                    </ul>
                </li>

                <li class = "nav-item">
                    <ul class = "ham-dropdown">
                        <a href="index.php?pg=contact" class = "nav-item"><li><i class="fa-solid fa-users"></i> Contact Us</li></a>
                    </ul>
                </li>

                <ul class = "menuside-contact">
                    <p>USER</p>
                    <li class="menuside-item">
                        <ul>
                            <li class="user-icon" id="userIcon">
                                <?=$_html_login?>
                            </li>

                            <li class="heart-icon" id="boxlike">
                                <a href = "index.php?pg=like">
                                    <i class="fa-sharp fa-solid fa-heart"></i>
                                </a>
                            </li>

                            <li class="cart-icon" id="boxcart">
                                <a href="index.php?pg=cart">
                                    <i class="fa-solid fa-cart-shopping fa-shake"></i>
                                </a>
                            </li>
                        
                        </ul>
                    </li>

                    <p>FOLLOW US</p>
                    <li class="menuside-item">
                        <ul>
                            <li><a href=""><i class="fa-brands fa-facebook fa-beat-fade" style="color: #2977ff;"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-pinterest" style="color: #ff0000;"></i></a></li>
                        </ul>
                    </li>

                    <p>Contact</p>
                    <div class="mail-service">
                        <i class="fa-regular fa-envelope fa-bounce"></i>
                        wood3d.master@gmail.com
                    </div>
                    <div class="phone-service mt-2">
                        <i class="fa-solid fa-phone fa-shake"></i>
                        +84 (918) 685 740
                    </div>
                </ul>
            </ul>
        </div>
    </div>
    <!-- 3 -->
    <div class="container" id="all">
        <div class="search-bar">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo"><a href="index.php"><img src="Asset/img/logo/logo_1.png"></a></div>
                </div>

                <div class="col-lg-6" style="position: relative;">
                    <form class="form_input">
                        <button type="button" >
                            <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
                                aria-labelledby="search">
                                <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                                    stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>

                        <input class="f_input" id="live_search" placeholder="Type your text" type="text" autocomplete="off">
                        
                        <button class="reset" type="reset">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        
                    </form>
                    <div id="searchresult" class="result-box"></div>
                </div>
                
                <div class="col-lg-3 text-right">
                    <div class="nav-right">
                        <ul>
                            <li class="user-icon" id="userIcon">
                                <?=$_html_login?>
                            </li>

                            <li class="cart-icon" id="boxlike">
                                <a href = "index.php?pg=like">
                                    <i class="fa-regular fa-heart"></i>
                                    <span class="cart-count"><?=$count_like?></span> 
                                </a>
                            </li>

                            <li class="cart-icon" id="boxcart">
                                <a href="index.php?pg=cart">
                                    <i class="fa-light fa-cart-shopping fa-shake"></i>
                                    <span class="cart-count"><?=$count_product?></span>  
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Header -->

<!-- Alert -->
<div class = "notification-toast animate__animated"></div>
<!-- end Alert -->