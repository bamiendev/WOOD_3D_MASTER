<?php
session_start();
ob_start();

if(isset($_SESSION['rule']) && $_SESSION['rule'] == 2){
    include "../dao/pdo.php";
    include "../dao/product.php";
    include "../dao/category.php";
    include "../dao/other.php";
    include "../dao/global.php";
    include "../dao/function.php";


    include "view/header_admin.php";
    $alert = "";

    function displayShopAdminView() {
        $list_product_img = get_product_new("img",20);
        $list_product_3d = get_product_new("3d",20);

        $list_category_img = get_category("img");
        $list_category_3d = get_category("3d");

        $total_product = get_product_count("3d")[0]['total'];
        $total_category = get_category_count("3d")[0]['total'];

        include "view/shop_admin.php";
    }

    function display2d() {
        $list_product_img = get_product_new("img",20);
        $list_category_img = get_category("img");
        $total_product = get_product_count("img")[0]['total'];
        $total_category = get_category_count("img")[0]['total'];
        include "view/shop_admin2d.php";
    }

    function display3d() {
        $list_product_3d = get_product_new("3d",20);
        $list_category_3d = get_category("3d");
        $total_product = get_product_count("3d")[0]['total'];
        $total_category = get_category_count("3d")[0]['total'];
        include "view/shop_admin.php";
    }

    function displayAdmin(){
        function convertToString($value) {
            return is_string($value) ? $value : strval($value);
        }
        $total_doanhthu = convertToString(get_total_doanhthu());
        $total_product = get_product_count("img")[0]['total'];
        $total_bill = convertToString(get_bill_count());
        $total_user= convertToString(get_user_count());

        $bill_admin = get_bill_admin("",0,20);

        include "view/ds_admin.php";
    }

    if (isset($_GET['pg'])) {
        switch ($_GET['pg']) {
            case 'updatehome':
                if(isset($_POST['update_home'])){
                    $home1 = isset($_FILES['home1']) ? $_FILES['home1'] : "";
                    $home2 = isset($_FILES['home2']) ? $_FILES['home2'] : "";
                    $home3 = isset($_FILES['home3']) ? $_FILES['home3'] : "";

                    $deal1 = isset($_FILES['deal1']) ? $_FILES['deal1'] : "";

                    $login1 = isset($_FILES['login1']) ? $_FILES['login1'] : "";
                    $login2 = isset($_FILES['login2']) ? $_FILES['login2'] : "";
                    $login3 = isset($_FILES['login3']) ? $_FILES['login3'] : "";

                    $all = get_all_home();
                    function processHomeFile($name) {
                        $all = get_all_home();
                        $result = '';
                    
                        if (!empty($_FILES[$name]['name'])) {
                            $timeStamp = time();
                            ${$name.'_1'} = HOME_PATH_ADMIN . $timeStamp . '_' . $_FILES[$name]['name'];
                            ${$name.'_all_1'} = $timeStamp . '_' . $_FILES[$name]['name'];
                    
                            if (isset($all[0][$name]) && is_file(HOME_PATH_ADMIN.$all[0][$name])) {
                                unlink(HOME_PATH_ADMIN.$all[0][$name]);
                            }
                    
                            if (move_uploaded_file($_FILES[$name]["tmp_name"], ${$name.'_1'})) {
                                $result = ${$name.'_all_1'};
                            }
                        }
                        return $result; 
                    }
                    
                    $home1_all = processHomeFile('home1');
                    $home2_all = processHomeFile('home2');
                    $home3_all = processHomeFile('home3');

                    $deal1_all = processHomeFile('deal1');

                    $login1_all = processHomeFile('login1');
                    $login2_all = processHomeFile('login2');
                    $login3_all = processHomeFile('login3');

                    update_home($home1_all, $home2_all, $home3_all, $deal1_all, $login1_all, $login2_all, $login3_all);
                    $alert = alert_Success('Đã Thêm Thành Công Ảnh Lên Trang Chủ');
                }

                include "view/updatehome.php";
                break;

            case 'home':
                include "view/updatehome.php";
                break;

            case 'logout':
                unset($_SESSION['rule']);
                header("Location: ../index.php");
                break;
        
            case 'shop':
                display2d();
                break;

            case 'shop3d':
                display3d();
                break;


            case 'add_category':
                if (isset($_POST["add_category"])) {
                    $name_category = $_POST["name_category"];
                    $stt_category = isset($_POST['stt_category']) ? $_POST['stt_category'] : 0;
                    $type = $_POST['select'];
            
                    if (!empty($name_category)) {
                        $check  = check_category($name_category);

                        if(isset($check) && is_array($check) && count($check)> 0) {
                            $alert = alert_Error('Đã có danh mục trong CSDL!'); 
                        } else{
                            if($type == '3d'){
                                add_category($name_category, "3d", $stt_category);
                            } else{
                                add_category($name_category, "img", $stt_category);
                            }
                            $alert = alert_Success('Đã Thêm Thành Công Danh Mục '.$name_category);
                        }
                    } else {
                        $alert = alert_Error('Các ô chưa được nhập dữ liệu!'); 
                    }
                }

                if($type == '3d'){
                    display3d();
                    break;
                } else{
                    display2d();
                    break;
                }

            case 'del_category':
                if(isset($_GET['id']) && $_GET['id']>0){
                    $id_category = $_GET['id'];
                    $alert = del_category($id_category);
                }
                displayShopAdminView();
                break;

            case 'del_product':
                if(isset($_GET['id']) && $_GET['id']>0){
                    $id_product = $_GET['id'];

                    $img = IMG_PATH_ADMIN.get_img($id_product);
                    $img2 = IMG_PATH_ADMIN.get_img2($id_product);
                    $glb = GLB_PATH_ADMIN.get_glb($id_product);

                    // Del details
                    if(is_file($img) && isset($img)){
                        unlink($img);
                    }

                    if(is_file($img2) && isset($img2)){
                        unlink($img2);
                    }

                    if(is_file($glb) && isset($glb)){
                        unlink($glb);
                    }

                    // Del option img
                    function deleteImages($id_product, $option_number) {
                        $name_imgDel = ($option_number == 1) ? get_img_option1($id_product) : (($option_number == 2) ? get_img_option2($id_product) : get_img_option3($id_product));
                        $mang_chuoi = explode(",", $name_imgDel);
                        $so_luong_anh = count($mang_chuoi);
                    
                        for ($i = 0; $i < $so_luong_anh; $i++) {
                            $imagePath = OPTION_PATH_ADMIN_IMG . $mang_chuoi[$i];
                            if (is_file($imagePath)) {
                                unlink($imagePath);
                            }
                        }
                    }
                    deleteImages($id_product, 1);
                    deleteImages($id_product, 2);
                    deleteImages($id_product, 3);


                    del_product($id_product);
                    $alert = alert_Success("Đã Xóa Thành Công");
                }
                displayShopAdminView();
                break;
            

            case 'add_product':
                $category_list_3d = get_category("3d");
                $category_list_img = get_category("img");

                $timestamp =time();
                
                if(isset($_POST['add_product_3d'])){
                    $name = $_POST['name'];
                    $img = $timestamp . '_' . $_FILES['img']['name'];
                    $img2 = $timestamp . '_' . $_FILES['img2']['name'];
                    $glb = $timestamp . '_' . $_FILES['glb']['name'];
                    $price = isset($_POST['price']) ? $_POST['price'] : 0;
                    $sale = isset($_POST['sale']) ? $_POST['sale'] : 0;
                    $view = isset($_POST['view']) ? $_POST['view'] : 0;
                    $id_category = $_POST['id_category'];
                    $detail = $_POST['detail'];

                    // Button
                    $data = [];
                    for ($i = 0; $i <= 3; $i++) {
                        $key = "type$i";
                        $data[$key] = isset($_POST[$key]) ? implode(',', $_POST[$key]) : '';
                    }

                    $target_file_img = IMG_PATH_ADMIN . $img;
                    $target_file_img2 = IMG_PATH_ADMIN . $img2;
                    $target_file_glb = GLB_PATH_ADMIN . $glb;

                    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file_img);
                    move_uploaded_file($_FILES["img2"]["tmp_name"], $target_file_img2);
                    move_uploaded_file($_FILES["glb"]["tmp_name"], $target_file_glb);

                    add_product($name, $img, $img2, $glb, $price, $sale, $view, $id_category,"3d",$data['type0'], $data['type1'], $data['type2'], $data['type3']);
                
                    $alert = alert_Success("Đã Thêm Thành công".$name);
                    display3d();
                    break;
                }

                if(isset($_POST['add_product_img'])){
                    $name = $_POST['name_img'];
                    $img = $timestamp . '_' . $_FILES['img']['name'];
                    $img2 = $timestamp . '_' . $_FILES['img2']['name'];
                    $price = isset($_POST['price_img']) ? $_POST['price_img'] : 0;
                    $sale = isset($_POST['sale_img']) ? $_POST['sale_img'] : 0;
                    $view = isset($_POST['view_img']) ? $_POST['view_img'] : 0;
                    $id_category = $_POST['id_category_img'];
                    $detail = $_POST['detail_img'];

                    $target_file_img = IMG_PATH_ADMIN . $img;
                    $target_file_img2 = IMG_PATH_ADMIN . $img2;

                    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file_img);
                    move_uploaded_file($_FILES["img2"]["tmp_name"], $target_file_img2);

                    add_product_img($name, $img, $img2, $price, $sale, $view, $id_category,"img");
                    $alert = alert_Success("Đã Thêm Thành công".$name);
                    display2d();
                    break;
                }

                include "view/3d_admin.php";
                break;

            case 'update':
                if(isset($_POST['update'])){
                    $timestamp = time();
                    
                    $name =$_POST['name'];
                    $img = $timestamp . '_' . $_FILES['img']['name'];
                    $img2 = $timestamp . '_' . $_FILES['img2']['name'];
                    $glb = $timestamp . '_' . $_FILES['glb']['name'];

                    $price = isset($_POST['price']) ? $_POST['price'] : 0;
                    $sale = isset($_POST['sale']) ? $_POST['sale'] : 0;
                    $view = isset($_POST['view']) ? $_POST['view'] : 0;
                    $id_category = $_POST['id_category'];
                    $id = $_POST['id'];
                    $detail = isset($_POST['detail']) ? $_POST['detail'] : "";

                    function upload_file($name, $imgPath, $customPath) {
                        $result = '';
                    
                        if (!empty($_FILES[$name]['name'])) {
                            $timeStamp = time();
                            $file = $customPath . $timeStamp . '_' . $_FILES[$name]['name'];
                            $test = $timeStamp . '_' . $_FILES[$name]['name'];
                    
                            if (isset($imgPath) && is_file($imgPath)) {
                                unlink($imgPath);
                            }
                    
                            if (move_uploaded_file($_FILES[$name]["tmp_name"], $file)) {
                                $result = $test;
                            }
                        }
                        return $result;
                    }

                    $img_path1 = IMG_PATH_ADMIN.get_img($id);
                    $img_path2 = IMG_PATH_ADMIN.get_img2($id);
                    $glb_path = GLB_PATH_ADMIN.get_glb($id);

                    $img_path_admin = IMG_PATH_ADMIN;
                    $glb_path_admin = GLB_PATH_ADMIN;

                    $img = upload_file('img', $img_path1, $img_path_admin);
                    $img2 = upload_file('img2', $img_path2, $img_path_admin);
                    $glb = upload_file('glb', $glb_path, $glb_path_admin);

                    update_product($name, $img, $img2, $glb, $price, $sale, $view, $id_category,$detail,$id);
                    $alert .= alert_Success("Cập Nhập Sản Phẩm ".$name." Thành Công");

                    // checkbox option
                    $data = [];
                    for ($i = 1; $i <= 4; $i++) {
                        $key = "type$i";
                        $data[$key] = isset($_POST[$key]) ? implode(',', $_POST[$key]) : '';
                    }

                    update_checkbox_option($data['type1'], $data['type2'], $data['type3'], $data['type4'],$id);
                    
                    // Option
                    function processPostOption($postKey) {
                        if (isset($_POST[$postKey])) {
                            $price = $_POST[$postKey];
                            if (!is_array($price)) {
                                return ($price === "0" || $price === 0) ? "0" : "";
                            } else {
                                return implode(',', $price);
                            }
                        }
                        return "";
                    }
                    
                    $price_option1 = processPostOption('price_option1');
                    $price_option2 = processPostOption('price_option2');
                    $price_option3 = processPostOption('price_option3');

                    update_options($price_option1, $price_option2, $price_option3, $id);
                }
                display3d();
                break;


            case 'update_img':
                if(isset($_POST['update'])){
                    $timestamp = time();

                    $img = isset($_FILES['img']) ? $_FILES['img'] : "";
                    $img2 = isset($_FILES['img2']) ? $_FILES['img2'] : "";

                    $name = $_POST['name'];
                    $price = isset($_POST['price']) ? $_POST['price'] : 0;
                    $sale = isset($_POST['sale']) ? $_POST['sale'] : 0;
                    $view = isset($_POST['view']) ? $_POST['view'] : 0;
                    $id_category = $_POST['id_category'];
                    $detail = isset($_POST['detail']) ? $_POST['detail'] : "";

                    $id = $_POST['id'];
                    
                    function upload_file($name, $imgPath, $customPath) {
                        $result = '';
                    
                        if (!empty($_FILES[$name]['name'])) {
                            $timeStamp = time();
                            $file = $customPath . $timeStamp . '_' . $_FILES[$name]['name'];
                            $test = $timeStamp . '_' . $_FILES[$name]['name'];
                    
                            if (isset($imgPath) && is_file($imgPath)) {
                                unlink($imgPath);
                            }
                    
                            if (move_uploaded_file($_FILES[$name]["tmp_name"], $file)) {
                                $result = $test;
                            }
                        }
                        return $result;
                    }

                    $img_path1 = IMG_PATH_ADMIN.get_img($id);
                    $img_path2 = IMG_PATH_ADMIN.get_img2($id);
                    $img_path_admin = IMG_PATH_ADMIN;

                    $img = upload_file('img', $img_path1, $img_path_admin);
                    $img2 = upload_file('img2', $img_path2, $img_path_admin);

                    update_product_img($name, $img, $img2, $price, $sale, $view,$id_category,$detail,$id);
                    $alert .= alert_Success("Cập Nhập Sản Phẩm ".$name." Thành Công");



                    // Option
                    function uploadfile($files,$name_options) {
                        $folder = OPTION_PATH_ADMIN_IMG;
                        $names = $files[$name_options]['name'];
                        $tmp_names = $files[$name_options]['tmp_name'];
                        $allFileNames = "";
                        foreach ($names as $key => $name) {
                            $temp_folder = $tmp_names[$key];
                            
                            $timestamp = time();
                            $fileExtension = pathinfo($name, PATHINFO_EXTENSION);
                            $newFileName = $timestamp . '_' . $key . '.' . $fileExtension;
                            move_uploaded_file($temp_folder, $folder . $newFileName);
                            $allFileNames .= ($allFileNames == "") ? $newFileName : (',' . $newFileName);
                        }
                        return $allFileNames;
                    }

                    // Type1
                    if(isset($_FILES['files'])) {
                        $result = "";
                        if(!empty($_FILES['files']['name'][0])){
                            $result = uploadfile($_FILES,"files");
                            $name_imgDel = get_img_option1($id);
                            $mang_chuoi = explode(",", $name_imgDel);
                            $so_luong_anh = count($mang_chuoi);
    
                            for ($i = 0; $i < $so_luong_anh; $i++) {
                                if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi[$i])){
                                    unlink(OPTION_PATH_ADMIN_IMG.$mang_chuoi[$i]);
                                }
                            }
                            update_options1($result,$id);
                        }
                    }

                    // Type2
                    if(isset($_FILES['files2'])) {
                        $result2 = "";
                        if(!empty($_FILES['files2']['name'][0])){
                            $result2 = uploadfile($_FILES,"files2");
                            $name_imgDel2 = get_img_option2($id);
                            $mang_chuoi2 = explode(",", $name_imgDel2);
                            $so_luong_anh2 = count($mang_chuoi2);
    
                            for ($i = 0; $i < $so_luong_anh2; $i++) {
                                if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi2[$i])){
                                    unlink(OPTION_PATH_ADMIN_IMG.$mang_chuoi2[$i]);
                                }
                            }
                            update_options2($result2,$id);
                        }
                    }

                    // Type3
                    if(isset($_FILES['files3'])) {
                        $result3 = "";
                        if(!empty($_FILES['files3']['name'][0])){
                            $result3 = uploadfile($_FILES,"files3");
                            $name_imgDel3 = get_img_option3($id);
                            $mang_chuoi3 = explode(",", $name_imgDel3);
                            $so_luong_anh3 = count($mang_chuoi3);
    
                            for ($i = 0; $i < $so_luong_anh3; $i++) {
                                if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi3[$i])){
                                    unlink(OPTION_PATH_ADMIN_IMG.$mang_chuoi3[$i]);
                                }
                            }
                            update_options3($result3,$id);
                        }
                    }

                    // Type4
                    if(isset($_FILES['files4'])) {
                        $result4 = "";
                        if(!empty($_FILES['files4']['name'][0])){
                            $result4 = uploadfile($_FILES,"files4");
                            $name_imgDel4 = get_img_option4($id);
                            $mang_chuoi4 = explode(",", $name_imgDel4);
                            $so_luong_anh4 = count($mang_chuoi4);
    
                            for ($i = 0; $i < $so_luong_anh4; $i++) {
                                if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi4[$i])){
                                    unlink(OPTION_PATH_ADMIN_IMG.$mang_chuoi4[$i]);
                                }
                            }
                            update_options4($result4,$id);
                        }
                    }

                    // Type5
                    if(isset($_FILES['files5'])) {
                        $result5 = "";
                        if(!empty($_FILES['files5']['name'][0])){
                            $result5 = uploadfile($_FILES,"files5");
                            $name_imgDel5 = get_img_option5($id);
                            $mang_chuoi5 = explode(",", $name_imgDel5);
                            $so_luong_anh5 = count($mang_chuoi5);
    
                            for ($i = 0; $i < $so_luong_anh5; $i++) {
                                if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi5[$i])){
                                    unlink(OPTION_PATH_ADMIN_IMG.$mang_chuoi5[$i]);
                                }
                            }
                            update_options5($result5,$id);
                        }
                    }

                    // Type6
                    if(isset($_FILES['files6'])) {
                        $result6 = "";
                        if(!empty($_FILES['files6']['name'][0])){
                            $result6 = uploadfile($_FILES,"files6");
                            $name_imgDel6 = get_img_option6($id);
                            $mang_chuoi6 = explode(",", $name_imgDel6);
                            $so_luong_anh6 = count($mang_chuoi6);
    
                            for ($i = 0; $i < $so_luong_anh6; $i++) {
                                if(is_file(OPTION_PATH_ADMIN_IMG.$mang_chuoi6[$i])){
                                    unlink(OPTION_PATH_ADMIN_IMG.$mang_chuoi6[$i]);
                                }
                            }
                            update_options6($result6,$id);
                        }
                    }

                    // Price Option
                    $price_option1 = isset($_POST['price_option1']) ? $_POST['price_option1'] : "";
                    $price_option2 = isset($_POST['price_option2']) ? $_POST['price_option2'] : "";
                    $price_option3 = isset($_POST['price_option3']) ? $_POST['price_option3'] : "";
                    $price_option4 = isset($_POST['price_option4']) ? $_POST['price_option4'] : "";
                    $price_option5 = isset($_POST['price_option5']) ? $_POST['price_option5'] : "";
                    $price_option6 = isset($_POST['price_option6']) ? $_POST['price_option6'] : "";

                    // Name Option
                    $name_option1 = isset($_POST['name_option1']) ? $_POST['name_option1'] : "";
                    $name_option2 = isset($_POST['name_option2']) ? $_POST['name_option2'] : "";
                    $name_option3 = isset($_POST['name_option3']) ? $_POST['name_option3'] : "";
                    $name_option4 = isset($_POST['name_option4']) ? $_POST['name_option4'] : "";
                    $name_option5 = isset($_POST['name_option5']) ? $_POST['name_option5'] : "";
                    $name_option6 = isset($_POST['name_option6']) ? $_POST['name_option6'] : "";

                    update_options_img($price_option1,$price_option2,$price_option3,$price_option4,$price_option5,$price_option6,$name_option1,$name_option2,$name_option3,$name_option4,$name_option5,$name_option6,$id);
                }

                displayShopAdminView();
                break;


            case 'details_3d':
                if(isset($_GET['id']) && $_GET['id']>0){
                    $id_product = $_GET['id'];
                    $product = get_product_id($id_product,"3d");
                }

                $list_category = get_category("3d");
                include "view/update.php";
                break;
 
            case 'details_img':
                if(isset($_GET['id']) && $_GET['id']>0){
                    $id_product = $_GET['id'];
                    $product = get_product_id($id_product,"img");
                }

                $list_category = get_category("img");

                include "view/update_img.php";
                break;


            case 'bill':
                $key = (isset($_POST['find']) && $_POST['find'] != "") ? trim($_POST['find']) : "";
                $bill_admin = get_bill_admin($key,0,20);

                if(isset($_POST['accept'])){
                    $id = $_GET['id'];
                    update_status_bill("Process",$id);
                    header("Location: indexadmin.php?pg=bill");
                    exit();
                }

                if(isset($_POST['success'])){
                    $id = $_GET['id'];
                    update_status_bill("Yes",$id);
                    header("Location: indexadmin.php?pg=bill");
                    exit();
                }

                include "view/bill.php";
                break;


            case 'del_bill':
                if(isset($_GET['id'])){
                    $madh = $_GET['id'];
                    del_bill($madh);
                    $alert = alert_Success('Xóa Thành Công Bill');
                }

                $key = (isset($_POST['find']) && $_POST['find'] != "") ? trim($_POST['find']) : "";
                $bill_admin = get_bill_admin($key,0,20);
                include "view/bill.php";
                break;


            case 'order':
                if(isset($_GET['id'])){
                    $key = (isset($_POST['find']) && $_POST['find'] != "") ? trim($_POST['find']) : "";
                    $iduser = isset($_GET['id']) ? $_GET['id'] : "";
                    $order_admin = get_cart_admin($key,$iduser,20);
                    include "view/order_admin.php";
                    break;
                } else{
                    header("Location: indexadmin.php");
                    exit;
                }
                

            case 'user':
                $list_users= get_user(20);
                include "view/user_admin.php";
                break;


            case 'del_user':
                if(isset($_GET['id']) && $_GET['id']>0){
                    $id_us = $_GET['id'];
                    del_user($id_us);
                    $alert = alert_Success('Đã Xóa Thành Công User');

                    $list_users= get_user(20);
                    include "view/user_admin.php";

                } else{
                    $alert = alert_Error('Lỗi');
                }
                break;


            case 'voucher':
                $list_voucher = get_voucher(20);
                include "view/voucher_admin.php";
                break;


            case 'add_voucher':
                if (isset($_POST["add_voucher"])) {
                    $name_voucher = $_POST["name_voucher"];
                    $price_voucher = $_POST["price_voucher"];

                    if (!empty($name_voucher) && !empty($price_voucher)) {
                        if(is_numeric($price_voucher)){
                            add_voucher($name_voucher, $price_voucher);
                            $alert = alert_Success('Đã Thêm Thành Công Voucher'.$name_voucher);
                        } else{
                            $alert = alert_Error('Giảm giá là 1 số!');
                        }
                    } else {
                        $alert = alert_Error('Các ô chưa được nhập dữ liệu!');
                    }
                }
                $list_voucher = get_voucher(20);
                include "view/voucher_admin.php";
                break;

                
            case 'del_voucher':
                if(isset($_GET['id']) && $_GET['id']>0){
                    $id_voucher = $_GET['id'];
                    del_voucher($id_voucher);
                    $alert = alert_Success('Đã Xóa Thành Công Voucher');
                }
                $list_voucher = get_voucher(20);
                include "view/voucher_admin.php";
                break;


            case 'comment':
                include "view/comment_admin.php";
                break;


            default:
            displayAdmin();
        } 

    } else{
        displayAdmin();
    }
    include "view/footer_admin.php";
} else{
    header("Location: ../index.php");
}


?>