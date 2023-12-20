<?php
    // Cart
    session_start();
    ob_start();

    if(!isset($_SESSION["cart_product"])) $_SESSION["cart_product"]=[];
    if(!isset($_SESSION["like_product"])) $_SESSION["like_product"]=[];

    // Thư viện
    include "dao/pdo.php";
    include "dao/product.php";
    include "dao/category.php";
    include "dao/other.php";

    $alert = "";
    include "view/header.php";
    if (!isset($_GET['pg'])) {
        $dssp = get_product_homepage("img","3d",4);
        $dssp_sale = get_product_sale(10);
        $img_home = get_all_home();
        include "view/homepage.php";
    } else {
        switch ($_GET['pg']) {
            case 'logout':
                unset($_SESSION['rule']);
                unset($_SESSION['name_user']);
                unset($_SESSION['id_user']);
                unset($_SESSION['email_user']);

                header("Location: index.php");
                break;

            case 'user':
                if(isset($_SESSION['rule'])){
                    if($_SESSION['rule'] == 0 || $_SESSION['rule'] == 1){
                        include "view/user.php";

                        if(isset($_GET['info'])){
                            include "view/user/info.php";

                        } elseif (isset($_GET['address'])){
                            include "view/user/changeinfo.php";

                        } elseif (isset($_GET['pass'])){
                            include "view/user/changepass.php";

                        } elseif (isset($_GET['bill'])){
                            $get_bill_user = get_bill_user($_SESSION['id_user']);
                            include "view/user/bill.php";
                        }  else{
                            include "view/user/info.php";
                        }
                        
                    } elseif (isset($_SESSION['rule']) && $_SESSION['rule'] == 2) {
                        header("Location: admin/indexadmin.php");
                    }

                } else{
                    header("Location: index.php");
                }
                
                break;

            case 'product':
                $dsdm = get_category("3d");
                if (!isset($_GET['category'])) {
                    $iddm = 0;
                } else {
                    $iddm = $_GET['category'];
                }
                $dssp = get_product($iddm,"3d",9);
                include "view/product/product.php";
                break;


            case 'product_img':
                $dsdm = get_category("img");
                if (!isset($_GET['category'])) {
                    $iddm = 0;
                } else {
                    $iddm = $_GET['category'];
                }
                $dssp = get_product($iddm,"img",9);
                include "view/product/product_img.php";
                break;


            case 'details_3d':
                if(isset($_GET['id_product'])){
                    $id_product = $_GET['id_product'];
                    $product_details = get_product_id($id_product,"3d");

                    $id_category = $product_details['id_category'];
                    $product_related = get_dssp_lienquan($id_category,$id_product,"3d",4);

                }

                include "view/product/product_detail.php";
                break;


            case 'details_img':
                if(isset($_GET['id_product'])){
                    $id_product = $_GET['id_product'];
                    $product_details = get_product_id($id_product,"img");

                    $id_category = $product_details['id_category'];
                    $product_related = get_dssp_lienquan($id_category,$id_product,"img",4);

                }
                include "view/product/product_detail_img.php";
                break;
        
            case 'cart':
                if (isset($_GET['del']) && $_GET['del'] >= 0) {
                    array_splice($_SESSION["cart_product"],$_GET['del'],1);
                }
                include "view/cart/cart.php";
                break;

            case 'checkout':
                $list_voucher = get_voucher(2);

                if(!empty($_SESSION["cart_product"])){
                    $quantities = [];
                    foreach ($_POST as $key => $value) {
                        if (strpos($key, 'quantity_') !== false && is_numeric(substr($key, 9))) {
                            $productId = substr($key, 9);
                            $quantity = $value;
                            $quantities[$productId] = $quantity;
                        }
                    }

                    if(isset($_SESSION["cart_product"]) && is_array($_SESSION["cart_product"])) {
                        foreach($_SESSION["cart_product"] as $index => $product) {
                            if(isset($product['id']) && isset($quantities[$product['id']])) {
                                $_SESSION["cart_product"][$index]["quantities"] = $quantities[$product['id']];
                            }
                        }
                    }

                    include "view/cart/checkout.php";
                    break;

                } else{
                    include "view/cart/cart.php";
                    break;
                }
            
            case 'checkout_product':
                if (isset($_POST['checkout_button'])) {
                    $f_name = $_POST['f_name'];
                    $l_name = $_POST['l_name'];

                    $nameall = $f_name . ' ' . $l_name;
                    $p_number = $_POST['p_number'];
                    $h_number = $_POST['h_number'];
                    $email = $_POST['email'];

                    $address = $_SESSION['checkout']['address'];
                    $ship = $_SESSION['checkout']['ship'];
                    $voucher = $_SESSION['checkout']['discount'];
                    $total = $_SESSION['checkout']['total'];

                    $note = isset($_POST['note']) ? $_POST['note'] : "";
                    $pttt = $_POST['pttt'];
                    $password = md5("123456");
                    $date = date("m-d-Y");
                    $addressAll = $h_number.", ".$address;

                    $check=check_user_bill($email);
                    if(isset($check) && is_array($check) && count($check)> 0) {
                        extract($check);
                        if($phone != $p_number && $address != $addressAll){
                            $id_user = get_user_bill($email);
                            update_user_bill($addressAll,$p_number,$email);
                        } else{
                            $id_user = get_user_bill($email);
                        }
                    } else{
                        $id_user = add_user_checkout($nameall,$password,$email,$addressAll,$p_number);
                    }

                    $madh = "Wood3D"."_".$id_user.rand(1,9999);

                    $id_bill = bill_id($madh, $id_user, $nameall, $email, $p_number, $addressAll, $date, $ship, $voucher, $total, $pttt, $note);
                    
                    foreach ($_SESSION['cart_product'] as $sp) {
                        extract($sp);
                        $pricenew = (int) preg_replace('/[^0-9]/', '', $priceAll);
                        $price_All = ($pricenew == 0) ? $sale : $pricenew;

                        // Option
                        $option1 = ($radioValue1 == "") ? "Normal" : $radioValue1;
                        $option2 = ($radioValue2 == "") ? "" : $radioValue2;
                        $option3 = ($radioValue3 == "") ? "" : $radioValue3;

                        
                        $total_product = $price_All * $quantities;
                        add_cart($id, $sale, $name, $img, $quantities, $option1, $option2, $option3, $total_product, $id_bill);
                    }

                    $checkbill = array(
                        'madh' => $madh,
                        'date' => $date
                    );

                    $_SESSION['check_bill'] = $checkbill;
                    
                    header('Location: index.php?pg=bill&mh=' . $madh . '&da=' . $date);
                }
                break;

            case 'bill':
                if(isset($_GET['mh']) && isset($_GET['da'])){
                    $alert = 
                    '
                    <script>
                        content =
                        `<h6 class="mb-2"><i class="fa-light fa-thumbs-up fa-xl"></i> Order confirmed!</h6>
                        <h6 class="mb-2"><i class="fa-thin fa-envelope fa-xl"></i> Check your email!</h6>`;
                        
                        function simulateAddToCartNotification() {
                            showPopupStatus("Success",content);
                        }
                        simulateAddToCartNotification();
                    </script>
                    ';

                    $checkmh = $_GET['mh'];
                    $checkda = $_GET['da'];

                    if(isset($_SESSION['check_bill']['date']) && isset($_SESSION['check_bill']['madh'])){
                        if($checkda == $_SESSION['check_bill']['date'] && $checkmh == $_SESSION['check_bill']['madh']){
                            include "view/cart/success.php";
                            $_SESSION["cart_product"] = [];
                            $_SESSION['checkout'] = [];
                            $_SESSION['check_bill'] = [];
                            break;
                        }
                    } else{
                        include "view/cart/success_thanks.php";
                        break;
                    }

                } else{
                    header('Location: index.php?pg=cart');
                    exit();
                }

            case 'like':
                include "view/product/like.php";
                break;

            case 'sale':
                $product_sale = get_product_sale(9);
                $product_deal = get_product_deal(1);
                $product_best = get_product_best(1);

                include "view/product/sale.php";
                break;
                
            case 'faqs':
                if(isset($_GET['policy'])){
                    include "view/faqs/policy.php";
                    break;
                    
                } else if(isset($_GET['term'])){
                    include "view/faqs/term.php";
                    break;

                } else{
                    include "view/faqs/faqs.php";
                    break;
                }
        
            case 'blog':
                include "view/blog/blog.php";
                break;

            case 'contact':
                include "view/contact.php";
                break;

            default:
                $dssp = get_product_homepage("img","3d",4);
                $dssp_sale = get_product_sale(10);
                $img_home = get_all_home();

                include "view/homepage.php";
                break;
        }
    }
    include "view/footer.php";

?>