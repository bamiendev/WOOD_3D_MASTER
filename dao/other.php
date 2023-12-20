<?php
require_once 'pdo.php';

// ============================================User===========================================

// Hàm lấy toàn bộ danh sách người dùng
function get_user($limit){
    $sql = "SELECT * FROM users ORDER BY id DESC limit ".$limit;
    return pdo_query($sql);
}

// Del voucher
function del_user($id){
    $sql = "DELETE FROM users WHERE id=?";
    pdo_execute($sql, $id);
}

function del_bill($madh){
    $sql = "DELETE FROM bill WHERE id=?";
    pdo_execute($sql, $madh);
}

// Hàm lấy hiển thị danh sách người dùng
function show_users_admin($user){
    $html_dssp ='';
    $modal_counter = 1;
    
    foreach ($user as $us) {
        extract($us);

        if(isset($status) && $status==1){
            $config = '<span class="status completed">Xác Nhận</span>';
        } elseif (isset($status) && $status==2) {
            $modal_counter++;
            continue;
        }
        else{
            $config = '<span class="status pending">Chưa Xác Nhận</span>';
        }

        $html_dssp .= 
        '<tr>
            <td style="margin-left: 20px;">'.$modal_counter.'</td>
            <td>'.$name.'</td>
            <td>'.$email.'</td>
            <td>'.$config.'</td>
            <td>
                <a href="indexadmin.php?pg=del_user&id='.$id.'"><i class="bx bx-x-circle"></i></a>
            </td>
        </tr>';

        $modal_counter++;
    }

    return $html_dssp;
}



// ============================================Voucher===========================================

// Hàm lấy toàn bộ voucher
function get_voucher($limit){
    $sql = "SELECT * FROM voucher ORDER BY 	price_voucher DESC limit ".$limit;
    return pdo_query($sql);
}

// Add voucher
function add_voucher($name_voucher, $price_sale){
    $sql = "INSERT INTO voucher(name_voucher, price_voucher) VALUES (?,?)";
    pdo_execute($sql,$name_voucher, $price_sale);
}
// Del voucher
function del_voucher($id){
    $sql = "DELETE FROM voucher WHERE id=?";
    pdo_execute($sql, $id);
}

// Show voucher
function show_voucher_admin($voucher){
    $html_dssp ='';
    $modal_counter = 1;
    
    foreach ($voucher as $vc) {
        extract($vc);

        $html_dssp .= 
            '
            <div class="col-lg-6 col-xxl-4 mb-3">
                <div class="single">
                    <div class="text">
                        <div class="header_1">
                            <h3>'.$name_voucher.'</h3>
                            <h3>Giảm Giá: '.number_format($price_voucher, 0, ',', '.').' VNĐ</h3>
                            <div class="desc">
                                <h5> Hãy nhập mã '.$name_voucher.' để được giảm '.number_format($price_voucher, 0, ',', '.').' VNĐ</h5>
                            </div>
                        </div>

                        <div class="functions voucher">
                            <a href="indexadmin.php?pg=del_voucher&id='.$id.'"><i class="bx bx-x-circle"></i></a>
                            <i style="margin-left: 20px;" class="bx bx-edit"></i>
                        </div>
                    </div>
                </div>
            </div>';
        $modal_counter++;
    }

    return $html_dssp;
}


// ============================================alert===========================================
function alert_Success($message) {
    return "<script>
                document.addEventListener('DOMContentLoaded', function () {
                    showSuccessToast('$message');
                });
            </script>";
}

function alert_Error($message) {
    return "<script>
                document.addEventListener('DOMContentLoaded', function () {
                    showErrorToast('$message');
                });
            </script>";
}

function alert_Info($message) {
    return "<script>
                document.addEventListener('DOMContentLoaded', function () {
                    showInfoToast('$message');
                });
            </script>";
}




function get_img($id){
    $sql = "SELECT img FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['img'])) {
        return $result['img'];
    } else {
        return null;
    }
}

function get_img2($id){
    $sql = "SELECT img2 FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['img2'])) {
        return $result['img2'];
    } else {
        return null;
    }
}

function get_glb($id){
    $sql = "SELECT glb FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['glb'])) {
        return $result['glb'];
    } else {
        return null;
    }
}


function get_name1($id){
    $sql = "SELECT options_img1 FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['options_img1'])) {
        return $result['options_img1'];
    } else {
        return null;
    }
}

function get_name2($id){
    $sql = "SELECT options_img2 FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['options_img2'])) {
        return $result['options_img2'];
    } else {
        return null;
    }
}

// function get_home($id){
//     $sql = "SELECT home1 FROM home WHERE id=?";
//     $result = pdo_query_one($sql, $id);
//     if ($result && isset($result['options_img2'])) {
//         return $result['options_img2'];
//     } else {
//         return null;
//     }
// }


