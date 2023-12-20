<?php
require_once 'pdo.php';

// ==============================Product================================
function get_all_table_columns($nametable) {
    $sql = "SHOW COLUMNS FROM ".$nametable;
    $columns = pdo_query($sql);
    $column_names = array();
    foreach ($columns as $column) {
        $column_names[] = $column['Field'];
    }
    return $column_names;
}

function get_cart_admin($key = "", $idbill, $limit) {
    $bill_columns = get_all_table_columns("cart");
    
    $sql = "SELECT * FROM cart WHERE 1";
    
    if ($idbill > 0) {
        $sql .= " AND idbill = " . $idbill;
    }
    
    if ($key != "") {
        $search_conditions = array();
        foreach ($bill_columns as $column) {
            $search_conditions[] = $column . " LIKE '%" . $key . "%'";
        }
        $sql .= " AND (" . implode(" OR ", $search_conditions) . ")";
    }
    
    $sql .= " ORDER BY id DESC LIMIT " . $limit;
    
    $listbill = pdo_query($sql);
    return $listbill;
}

function show_order_admin($product) {
    $html_dssp ='';
    foreach ($product as $pd) {
        extract($pd);
        $op2 = $option2 != "" ? " + " . $option2 : "";
        $op3 = $option3 != "" ? " + " . $option3 : "";

        $html_dssp .= 
        '
        <div class="product_bill col-lg-4">
            <div class="card-group">
                <div class="card">
                    <img class="card-img-top" src="../Asset/upload/img/'.$img.'">

                    <div class="card-body">
                        <h5 class="card-title text-center">'.$name.'</h5>
                        <div class="row">
                            <div class="col-12 my-2">
                                <p class="card-text">Options: '.$option1.$op2.$op3.'</p>
                            </div>

                            <div class="col-12 my-2">
                                <p class="card-text">Số Lượng: '.$quantity.'</p>
                            </div>

                            <div class="col-lg-5 my-2">
                                <p class="card-text">ID Sản Phẩm: '.$idpro.'</p>
                            </div>

                            <div class="col-lg-7 my-2">
                                <p class="card-text">Giá: '.number_format($sale, 0, ',', '.').' VNĐ</p>
                            </div>

                            <div class="col-lg-5 my-2">
                                <p class="card-text">ID Bill: '.$idbill.'</p>
                            </div>

                            <div class="col-lg-7 my-2">
                                <p class="card-text">Giá Option: '.number_format($total, 0, ',', '.').' VNĐ</p>
                            </div>
                        </div>
                        
                    </div>

                    <div class="card-footer">
                        <h5>Tổng: <span style="color: red;"> '.number_format($total, 0, ',', '.').' VNĐ</span></h5>
                    </div>
                </div>
            </div>
        </div>';
        }

    return $html_dssp;
}

function get_bill_user($id) {
    $sql = "SELECT * FROM bill WHERE iduser =?";
    return pdo_query_one($sql,$id);
}

function get_cart_user($id) {
    $sql = "SELECT * FROM cart WHERE idbill =?";
    return pdo_query($sql,$id);
}

function show_cart_user($product) {
    $html_dssp ='';
    foreach ($product as $pd) {
        extract($pd);

        $html_dssp .= 
        '
        <tbody>
            <tr>
                <td>'.$name.'</td>
                <td>'.$option1.$option2.'</td>
                <td>'.$quantity.'</td>
                <td>'.number_format($sale, 0, ',', '.').' đ</td>
                <td class = "text-end">'.number_format($total, 0, ',', '.').' đ</td>
            </tr>
        </tbody>
        ';
        }

    return $html_dssp;
}





function get_bill_admin($key = "", $iduser = 0, $limit) {
    $bill_columns = get_all_table_columns("bill");
    
    $sql = "SELECT * FROM bill WHERE 1";
    
    if ($iduser > 0) {
        $sql .= " AND iduser = " . $iduser;
    }
    
    if ($key != "") {
        $search_conditions = array();
        foreach ($bill_columns as $column) {
            $search_conditions[] = $column . " LIKE '%" . $key . "%'";
        }
        $sql .= " AND (" . implode(" OR ", $search_conditions) . ")";
    }
    
    $sql .= " ORDER BY id DESC LIMIT " . $limit;
    
    $listbill = pdo_query($sql);
    return $listbill;
}

function show_bill_admin($product) {
    $html_dssp ='';
    $stt=1;
    foreach ($product as $pd) {
        extract($pd);
        $loai = ($type == "No") ? '<span class="status pending">Chưa Xác Nhận</span>' : (($type == "Process") ? '<span class="status process">Đang Xử Lý</span>' : '<span class="status completed">Đang Giao Hàng</span>');
        $button  = ($type == "No") ? '<button class="btn btn-warning" type="submit" name="accept">Xác Nhận Đơn Hàng</button>' : (($type == "Process") ? '<button class="btn btn-primary" type="submit" name="success">Hoàn Thành</button>' : '<button class="btn btn-success" type="button">Đã Xong</button>');

        $html_dssp .= 
        '
        <tbody>
            <tr class="text-center">
                <td>'.$stt.'</td>
                <td>'.$madh.'</td>
                <td><a href="indexadmin.php?pg=order&id='.$id.'"><i class="fa-light fa-ballot-check fa-2xl"></i></a></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_show_product_'.$stt.'"> 
                        Thông Tin Chi Tiết
                    </button>
                </td>
                <td>'.$loai.'</td>
                <td>
                    <a href="indexadmin.php?pg=del_bill&id='.$id.'"><i class="bx bx-x-circle"></i></a>
                    <i style="margin-left: 20px;" class="bx bx-edit"></i>
                </td>
            </tr>
        </tbody>
        ';

        $html_dssp .= 
        '
        <div class="modal fade" id="modal_show_product_'.$stt.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chi Tiết Đơn Hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 my-4 text-center"><i class="fa-regular fa-badge-check fa-2xl"></i><h4 class="mt-4">Tổng Đơn Hàng: <span style="color: red;">'.number_format($total, 0, ',', '.').' VNĐ</span></h4></div>
                            <div class="col-12 my-1"><p><i class="fa-solid fa-user"></i> Name: '.$name.'</p></div>
                            <div class="col-12 my-1"><p><i class="fa-sharp fa-solid fa-envelope"></i> Email: '.$email.'</p></div>
                            <div class="col-12 my-1"><p><i class="fa-regular fa-phone"></i> Số Điện Thoại: '.$phone.'</p></div>
                            <div class="col-12 my-1"><p><i class="fa-regular fa-address-card"></i> Địa Chỉ: '.$address.'</p></div>
                            <div class="col-6 my-1"><p><i class="fa-regular fa-alarm-clock"></i> Ngày đặt: '.$date.'</p></div>
                            <div class="col-6 my-1"><p><i class="fa-solid fa-truck-fast"></i> Ship: '.number_format($ship, 0, ',', '.').' VNĐ</p></div>
                            <div class="col-6 my-1"><p><i class="fa-solid fa-ticket"></i> Voucher: '.number_format($voucher, 0, ',', '.').' VNĐ</p></div>
                            <div class="col-6 my-1"><p><i class="fa-solid fa-money-bill-transfer"></i> PTTT: '.$pttt.'</p></div>
                            <div class="col-6 my-1"><a href="indexadmin.php?pg=order&id='.$id.'"><p><i class="fa-light fa-ballot-check"></i> Đơn Đặt Hàng</p></a></div>
                           
                            <div class="col-6 my-1 text-center">
                                <form action="indexadmin.php?pg=bill&id='.$id.'" method="post">
                                    '.$button.'
                                </form>
                            </div>

                            <div class="col-12 my-1"><p><i class="fa-duotone fa-note"></i> Note: '.$note.'</p></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>

                </div>
            </div>
        </div>';

        $stt ++;
        
        }

    return $html_dssp;
}


function show_bill_ds($product) {
    $html_dssp ='';
    foreach ($product as $pd) {
        extract($pd);
        $loai = ($type == "No") ? '<span class="status pending">Chưa Xác Nhận</span>' : (($type == "Process") ? '<span class="status process">Đang Xử Lý</span>' : '<span class="status completed">Đang Giao Hàng</span>');
        $html_dssp .=
        '
        <tbody>
            <tr>
                <td><p>'.$name.'</p></td>
                <td>'.$date.'</td>
                <td>'.$madh.'</td>
                <td>'.$loai.'</td>
                <td class="text-center"><a href="indexadmin.php?pg=order&id='.$id.'"><i class="fa-light fa-ballot-check fa-2xl"></i></a></td>
                <td class="text-center">
                    <a href="indexadmin.php?pg=del_bill&id='.$id.'"><i class="bx bx-x-circle"></i></a>
                </td>
            </tr>
        </tbody>
        ';
        }

    return $html_dssp;
}


function add_cart($idpro, $sale, $name, $img,$quantity,$option1,$option2,$option3,$total,$id_bill){
    $sql = "INSERT INTO cart (idpro, sale, name, img, quantity,	option1, option2, option3, total, idbill) VALUES (?,?,?,?,?,?,?,?,?,?)";
    return pdo_execute($sql, $idpro, $sale, $name, $img,$quantity,$option1,$option2,$option3,$total,$id_bill);
}


function bill_id($madh, $iduser, $name, $email, $phone, $address, $date, $ship, $voucher, $total, $pttt, $note){
    $sql = "INSERT INTO bill (madh, iduser, name, email, phone, address, date, 	ship, voucher, total, pttt, note) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    return pdo_execute_id($sql, $madh, $iduser, $name, $email, $phone, $address, $date, $ship, $voucher, $total, $pttt, $note);
}


function get_product($iddm,$type,$limit){
    $sql = "SELECT * FROM product WHERE 1 AND type=?";
    if($iddm>0){
        $sql .=" AND id_category=".$iddm;
    }
    $sql .= " ORDER BY id DESC limit ".$limit;
    $products = pdo_query($sql,$type);

    if(empty($products)) {
        return "rong";
    } else {
        return $products;
    }
}

function show_product($product) {
    $html_dssp ='';
    
    foreach ($product as $pd) {
        extract($pd);
        $namecategory = get_category_name($id_category);
        $link = "index.php?pg=details_3d&id_product=".$id;
        $percent = percent($price,$sale);
        $arlet = ($sale == 0) ? '<div class="sale pp-sale">Liên Hệ</div>' : '<div class="sale pp-sale">Sale ' . $percent . '%</div>';
        $priceAll = ($sale == 0) ? "Liên Hệ" : number_format($sale, 0, ',', '.') . " VNĐ";
        
        $html_dssp .= 
        '<div class = "col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="product-single-card">
                <div class="product-top-area">
                    <div class = "product-item">
                        <div class = "pi-pic">
                            <a href="'.$link.'">
                                <div class="product-img">
                                    <div class="first-view"><img src="Asset/upload/img/'.$img.'" alt="logo" class="img-fluid"></div>
                                    <div class="hover-view"><img src="Asset/upload/img/'.$img2.'" alt="logo" class="img-fluid"></div>
                                </div>  
                            </a>
                            '.$arlet.'
                        </div>
                    </div>

                    <div class="sideicons">
                        <button type="submit" name="add_like" class="sideicons-btn">
                            <div class = "icon1 icon-heart"><i class="fa-regular fa-heart fa-beat"></i></div>
                        </button>

                        <form action="" method="post">
                            <input type="hidden" name="id" value="'.$id.'">
                            <input type="hidden" name="name" value="'.$name.'">
                            <input type="hidden" name="img" value="'.$img.'" >
                            <input type="hidden" name="price" value="'.$price.'" >
                            <input type="hidden" name="sale" value="'.$sale.'" >
                            <input type="hidden" name="category" value="'.$namecategory.'" >
                            <input type="hidden" name="type" value="3d">


                            <button type="submit" id="addToCartBtn" name="add_cart" class="sideicons-btn">
                                <ul>
                                    <li class = "w-icon active">
                                        <i class="fa-solid fa-cart-shopping fa-shake"></i>
                                    </li>
                                </ul>
                            </button>
                        </form>

                        <button class="sideicons-btn">
                            <i class="fa-solid fa-cube fa-bounce"></i>
                        </button>
                    </div>
                </div>

                <div class="bo">
                    <div class = "product-item">
                        <div class = "pi-text">
                            <div class = "catagory-name">'.$namecategory.'</div>
                            <a href = "'.$link.'">
                                <h5>'.$name.'</h5>
                                <span style = "display: none">1</span>
                                <div class = "product-price mt-1">
                                    '.$priceAll.'
                                </div>
                                <div class = "product-price"><span>'.number_format($price, 0, ',', '.').' VNĐ</span></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    return $html_dssp;
}

function show_product_img($product) {
    $html_dssp ='';
    
    foreach ($product as $pd) {
        extract($pd);
        $namecategory = get_category_name($id_category);
        $link = "index.php?pg=details_img&id_product=".$id;
        $percent = percent($price,$sale);
        $arlet = ($sale == 0) ? '<div class="sale pp-sale">Liên Hệ</div>' : '<div class="sale pp-sale">Sale ' . $percent . '%</div>';
        $priceAll = ($sale == 0) ? "Liên Hệ" : number_format($sale, 0, ',', '.') . " VNĐ";

        $html_dssp .=
        '
        <div class = "col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="product-single-card">
                <div class="product-top-area">
                    <div class = "product-item">
                        <div class = "pi-pic">
                            <a href="'.$link.'">
                                <div class="product-img">
                                    <div class="first-view"><img src="Asset/upload/img/'.$img.'" alt="logo" class="img-fluid"></div>
                                    <div class="hover-view"><img src="Asset/upload/img/'.$img2.'" alt="logo" class="img-fluid"></div>
                                </div>  
                            </a>
                            '.$arlet.'
                        </div>
                    </div>

                    <div class="sideicons">
                        <button type="submit" name="add_like" class="sideicons-btn">
                            <div class = "icon1 icon-heart"><i class="fa-regular fa-heart fa-beat"></i></div>
                        </button>

                        <form action="" method="post">
                            <input type="hidden" name="id" value="'.$id.'">
                            <input type="hidden" name="name" value="'.$name.'">
                            <input type="hidden" name="img" value="'.$img.'" >
                            <input type="hidden" name="price" value="'.$price.'" >
                            <input type="hidden" name="sale" value="'.$sale.'" >
                            <input type="hidden" name="category" value="'.$namecategory.'">
                            <input type="hidden" name="type" value="img">

                            <button type="submit" id="addToCartBtn" name="add_cart" class="sideicons-btn">
                                <ul>
                                    <li class = "w-icon active">
                                        <i class="fa-solid fa-cart-shopping fa-shake"></i>
                                    </li>
                                </ul>
                            </button>
                        </form>

                        <button class="sideicons-btn">
                            <i class="fa-solid fa-cube fa-bounce"></i>
                        </button>
                    </div>
                </div>

                <div class="bo">
                    <div class = "product-item">
                        <div class = "pi-text">
                            <div class = "catagory-name"><i class="fa-regular fa-image"></i> '.$namecategory.'</div>
                            <a href = "'.$link.'">
                                <h5>'.$name.'</h5>
                                <span style = "display: none">1</span>
                                <div class = "product-price mt-1">
                                    '.$priceAll.'
                                </div>
                                <div class = "product-price"><span>'.number_format($price, 0, ',', '.').' VNĐ</span></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    return $html_dssp;
}

function show_voucher($product) {
    $html_dssp ='';
    
    foreach ($product as $pd) {
        extract($pd);
        $html_dssp .= 
        '<div class="col-sm-6">
            <div class="coupon coupon4 rounded mb-3 d-flex justify-content-between">
                <div class="left-side py-3 d-flex  justify-content-start">
                    <div>
                        <span class="badge badge-pill badge-success">Limited offer</span>
                        <h6>'.$name_voucher.'</h6>
                        <p><span style="font-weight: 800;">'.number_format($price_voucher, 0, ',', '.').' VNĐ</span> off for your first time purchase at Wood 3D</p>
                    </div>
                </div>
                <div class="right-side">
                    <div class="info align-items-center">
                        <div class="w-100">
                            <div class="countdown-coupon">
                                <div class="cd-item">
                                    <span>10</span>
                                    <p>Days</p>
                                </div>
                            </div>
                            <div class="enter-codeCheck">
                                <input type="radio" class="couponcheck" name="selected_voucher" id="'.$name_voucher.'">
                                <label for="'.$name_voucher.'">'.$name_voucher.'</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }

    return $html_dssp;
}

function show_product_details($product) {
    $html_dssp ='';
    
    foreach ($product as $pd) {
        extract($pd);
        $namecategory = get_category_name($id_category);
        $link = "index.php?pg=details_3d&id_product=".$id;
        $percent = percent($price,$sale);
        $arlet = ($sale == 0) ? '<div class="sale pp-sale">Liên Hệ</div>' : '<div class="sale pp-sale">Sale ' . $percent . '%</div>';
        $priceAll = ($sale == 0) ? "Liên Hệ" : number_format($sale, 0, ',', '.') . " VNĐ";
        
        $html_dssp .= 
        '<div class = "col-lg-3 col-sm-6 mb-3">
            <div class="product-single-card">
                <div class="product-top-area">
                    <div class = "product-item">
                        <div class = "pi-pic">
                            <a href="'.$link.'">
                                <div class="product-img">
                                    <div class="first-view"><img src="Asset/upload/img/'.$img.'" alt="logo" class="img-fluid"></div>
                                    <div class="hover-view"><img src="Asset/upload/img/'.$img2.'" alt="logo" class="img-fluid"></div>
                                </div>  
                            </a>
                            '.$arlet.'
                        </div>
                    </div>

                    <div class="sideicons">
                        <button type="submit" name="add_like" class="sideicons-btn">
                            <div class = "icon1 icon-heart"><i class="fa-regular fa-heart fa-beat"></i></div>
                        </button>

                        <form action="index.php?pg=add_cart" method="post"> 
                            <input type="hidden" name="id" value="'.$id.'">
                            <input type="hidden" name="name" value="'.$name.'">
                            <input type="hidden" name="img" value="'.$img.'" >
                            <input type="hidden" name="price" value="'.$price.'" >
                            <input type="hidden" name="sale" value="'.$sale.'" >

                            <button type="submit" name="add_cart" class="sideicons-btn">
                                <ul>
                                    <li class = "w-icon active">
                                        <a href = "#" class = "add-cart1">
                                            <i class="fa-solid fa-cart-shopping fa-shake"></i>
                                        </a>
                                    </li>
                                </ul>
                            </button>
                        </form>

                        <button class="sideicons-btn">
                            <i class="fa-solid fa-cube fa-bounce"></i>
                        </button>
                    </div>
                </div>

                <div class="bo">
                    <div class = "product-item">
                        <div class = "pi-text">
                            <div class = "catagory-name">'.$namecategory.'</div>
                            <a href = "'.$link.'">
                                <h5>'.$name.'</h5>
                                <span style = "display: none">1</span>
                                <div class = "product-price mt-1">
                                    '.$priceAll.'
                                </div>
                                <div class = "product-price"><span>'.number_format($price, 0, ',', '.').' VNĐ</span></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    return $html_dssp;
}

function show_product_details_img($product) {
    $html_dssp ='';
    
    foreach ($product as $pd) {
        extract($pd);
        $link = "index.php?pg=details_img&id_product=".$id;
        $percent = percent($price,$sale);
        $arlet = ($sale == 0) ? '<div class="sale pp-sale">Liên Hệ</div>' : '<div class="sale pp-sale">Sale ' . $percent . '%</div>';
        $priceAll = ($sale == 0) ? "Liên Hệ" : number_format($sale, 0, ',', '.') . " VNĐ";

        $html_dssp .= 
        '<div class = "col-lg-3 col-sm-6 mb-3">
            <div class="product-single-card">
                <div class="product-top-area">
                    <div class = "product-item">
                        <div class = "pi-pic">
                            <a href="'.$link.'">
                                <div class="product-img">
                                    <div class="first-view"><img src="Asset/upload/img/'.$img.'" alt="logo" class="img-fluid"></div>
                                    <div class="hover-view"><img src="Asset/upload/img/'.$img2.'" alt="logo" class="img-fluid"></div>
                                </div>  
                            </a>
                            '.$arlet.'
                        </div>
                    </div>

                    <div class="sideicons">
                        <button type="submit" name="add_like" class="sideicons-btn">
                            <div class = "icon1 icon-heart"><i class="fa-regular fa-heart fa-beat"></i></div>
                        </button>

                        <form action="index.php?pg=add_cart" method="post"> 
                            <input type="hidden" name="id" value="'.$id.'">
                            <input type="hidden" name="name" value="'.$name.'">
                            <input type="hidden" name="img" value="'.$img.'" >
                            <input type="hidden" name="price" value="'.$price.'" >
                            <input type="hidden" name="sale" value="'.$sale.'" >

                            <button type="submit" name="add_cart" class="sideicons-btn">
                                <ul>
                                    <li class = "w-icon active">
                                        <a href = "#" class = "add-cart1">
                                            <i class="fa-solid fa-cart-shopping fa-shake"></i>
                                        </a>
                                    </li>
                                </ul>
                            </button>
                        </form>

                        <button class="sideicons-btn">
                            <i class="fa-solid fa-cube fa-bounce"></i>
                        </button>
                    </div>
                </div>

                <div class="bo">
                    <div class = "product-item">
                        <div class = "pi-text">
                            <div class = "catagory-name"><i class="fa-regular fa-image"></i> Image</div>
                            <a href = "'.$link.'">
                                <h5>'.$name.'</h5>
                                <span style = "display: none">1</span>
                                <div class = "product-price mt-1">
                                    '.$priceAll.'
                                </div>
                                <div class = "product-price"><span>'.number_format($price, 0, ',', '.').' VNĐ</span></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    return $html_dssp;
}

function get_product_homepage($type1,$type2,$limit){
    $sql = "SELECT * FROM product WHERE type=? OR type=? ORDER BY view DESC limit ".$limit;
    return pdo_query($sql,$type1,$type2,);
}

function get_product_deal($limit){
    $sql = "SELECT * FROM product WHERE sale > 0 ORDER BY RAND() limit ".$limit;
    
    $products = pdo_query($sql);
    if(empty($products)) {
        return "rong";
    } else {
        return $products;
    }
}



function percent($giaGoc, $giaGiam) {
    return ($giaGoc > 0 && $giaGiam > 0 && $giaGiam < $giaGoc) ? intval(ceil((($giaGoc - $giaGiam) / $giaGoc) * 100)) : 0;
}

function get_product_sale($limit){
    $sql = "SELECT * FROM product WHERE (price-sale) / price > 0.3 AND sale > 0 ORDER BY view DESC limit ".$limit;
    
    $products = pdo_query($sql);
    if(empty($products)) {
        return "rong";
    } else {
        return $products;
    }
}

function get_product_best($limit){
    $sql = "SELECT *, ((price - sale) / price) * 100  AS percent FROM product WHERE sale < price AND sale > 0 ORDER BY percent DESC limit ".$limit;
    return pdo_query($sql);
}

function show_product_best($product) {
    $html_dssp ='';
    
    foreach ($product as $pd) {
        extract($pd);
        $namecategory = get_category_name($id_category);

        $type_product = ($type == "3d") ? "details_3d" : "details_img";
        $link = "index.php?pg=" . $type_product . "&id_product=" . $id;
        $percent = percent($price,$sale);
        $arlet = ($sale == 0) ? '<div class="sale pp-sale">Liên Hệ</div>' : '<div class="sale pp-sale">Sale ' . $percent . '%</div>';

        $html_dssp .=
        '<div class="product-item">
            <div class="pi-pic">
                <img src="Asset/upload/img/'.$img.'" alt="bestseller">
                '.$arlet.'
                <div class = "icon18 icon-heart"><i class = "fa fa-heart-o"></i></div>
                <ul>
                    <li class="w-icon active"><a href="#!" class = "add-cart18">
                        <i class="fa-solid fa-fire-flame fa-xl" style="color: #ffffff;"></i></a>
                    </li>
                    <li class="quick-view"><a href="'.$link.'">+ Quick View</a></li>
                </ul>
            </div>
        </div>

        <div class="category-name">'.$namecategory.'</div>
        <a href="productdetail18.html"><h5>'.$name.'</h5></a>
        <div class="product-price"><span>'.number_format($sale, 0, ',', '.').'</span> VNĐ</div>';
    }

    return $html_dssp;
}



function show_product_deal($product) {
    $html_dssp ='';
    
    foreach ($product as $pd) {
        extract($pd);
        $namecategory = get_category_name($id_category);

        $type_product = ($type == "3d") ? "details_3d" : "details_img";
        $link = "index.php?pg=" . $type_product . "&id_product=" . $id;
        $percent = percent($price,$sale);
        $arlet = ($sale == 0) ? '<div class="sale pp-sale">Liên Hệ</div>' : '<div class="sale pp-sale">Sale ' . $percent . '%</div>';

        $html_dssp .=
        '
        <div class="product-item">
            <div class="pi-pic">
                <img src="Asset/upload/img/'.$img.'" alt="bestseller">
                '.$arlet.'
                <div class = "icon18 icon-heart"><i class = "fa fa-heart-o"></i></div>
                <ul>
                    <li class="w-icon active"><a href="#!" class = "add-cart18">
                        <i class="fa-solid fa-fire-flame fa-xl" style="color: #ffffff;"></i></a>
                    </li>
                    <li class="quick-view"><a href="'.$link.'">+ Quick View</a></li>
                </ul>
            </div>

            <div class="pi-text">
                <div class="category-name">'.$namecategory.'</div>
                <a href="'.$link.'">
                    <h5>'.$name.'</h5>
                </a>

                <div class="product-price">
                    '.number_format($sale, 0, ',', '.').' VNĐ
                    <span>'.number_format($price, 0, ',', '.').'VNĐ</span>
                </div>
            </div>
        </div>
        ';
    }

    return $html_dssp;
}


function show_product_sale_homepage($product) {
    $html_dssp ='';
    
    foreach ($product as $pd) {
        extract($pd);
        $namecategory = get_category_name($id_category);

        $type_product = ($type == "3d") ? "details_3d" : "details_img";
        $link = "index.php?pg=" . $type_product . "&id_product=" . $id;
        $percent = percent($price,$sale);
        $arlet = ($sale == 0) ? '<div class="sale pp-sale">Liên Hệ</div>' : '<div class="sale pp-sale">Sale ' . $percent . '%</div>';

        $html_dssp .=
        '
        <div class="col-12 p-2">
            <div class="product-single-card">
                <div class="product-top-area">
                    <div class = "product-item">
                        <div class = "pi-pic">
                            <a href="'.$link.'">
                                <div class="product-img">
                                    <div class="first-view"><img src="Asset/upload/img/1702616535_2.png" alt="logo"></div>
                                    <div class="hover-view"><img src="Asset/upload/img/1702616535_2.png" alt="logo"></div>
                                </div>  
                            </a>
                            '.$arlet.'
                        </div>
                    </div>

                    <div class="sideicons">
                        <button type="submit" name="add_like" class="sideicons-btn">
                            <div class = "icon1 icon-heart"><i class="fa-regular fa-heart fa-beat"></i></div>
                        </button>

                        <form action="index.php?pg=add_cart" method="post">
                            <input type="hidden" name="id" value="'.$id.'">
                            <input type="hidden" name="name" value="'.$name.'">
                            <input type="hidden" name="img" value="'.$img.'" >
                            <input type="hidden" name="price" value="'.$price.'" >
                            <input type="hidden" name="sale" value="'.$sale.'" >

                            <button type="submit" name="add_cart_homepage" class="sideicons-btn">
                                <ul>
                                    <li class = "w-icon active">
                                        <a href = "#" class = "add-cart1">
                                            <i class="fa-solid fa-cart-shopping fa-shake"></i>
                                        </a>
                                    </li>
                                </ul>
                            </button>
                        </form>

                        <button class="sideicons-btn">
                            <i class="fa-solid fa-cube fa-bounce"></i>
                        </button>
                    </div>
                </div>

                <div class="bo">
                    <div class = "product-item">
                        <div class = "pi-text pb-4">
                            <div class = "catagory-name">'.$namecategory.'</div>
                            <a href = "'.$link.'">
                                <h5>'.$name.'</h5>
                                <span style = "display: none">1</span>
                                <div class = "product-price mt-1">'.number_format($sale, 0, ',', '.').' VNĐ</div>
                                <div class = "product-price"><span>'.number_format($price, 0, ',', '.').' VNĐ</span></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    }

    return $html_dssp;
}

function show_product_homepage_hot($product) {
    $html_dssp ='';
    
    foreach ($product as $pd) {
        extract($pd);
        $namecategory = get_category_name($id_category);

        $type_product = ($type == "3d") ? "details_3d" : "details_img";
        $link = "index.php?pg=" . $type_product . "&id_product=" . $id;

        $percent = percent($price,$sale);
        $arlet = ($sale == 0) ? '<div class="sale pp-sale">Liên Hệ</div>' : '<div class="sale pp-sale">Sale ' . $percent . '%</div>';
        $priceAll = ($sale == 0) ? "Liên Hệ" : number_format($sale, 0, ',', '.') . " VNĐ";

        $html_dssp .= 
        '<div class="col-12 p-2">
            <div class="product-single-card">
                <div class="product-top-area">
                    <div class = "product-item">
                        <div class = "pi-pic">
                            <a href="'.$link.'">
                                <div class="product-img">
                                    <div class="first-view"><img src="Asset/upload/img/1702616535_2.png" alt="logo"></div>
                                    <div class="hover-view"><img src="Asset/upload/img/1702616535_2.png" alt="logo"></div>
                                </div>  
                            </a>
                            '.$arlet.'
                        </div>
                    </div>

                    <div class="sideicons">
                        <button type="submit" name="add_like" class="sideicons-btn">
                            <div class = "icon1 icon-heart"><i class="fa-regular fa-heart fa-beat"></i></div>
                        </button>

                        <form action="index.php?pg=add_cart" method="post">
                            <input type="hidden" name="id" value="'.$id.'">
                            <input type="hidden" name="name" value="'.$name.'">
                            <input type="hidden" name="img" value="'.$img.'" >
                            <input type="hidden" name="price" value="'.$price.'" >
                            <input type="hidden" name="sale" value="'.$sale.'" >

                            <button type="submit" name="add_cart_homepage" class="sideicons-btn">
                                <ul>
                                    <li class = "w-icon active">
                                        <a href = "#" class = "add-cart1">
                                            <i class="fa-solid fa-cart-shopping fa-shake"></i>
                                        </a>
                                    </li>
                                </ul>
                            </button>
                        </form>

                        <button class="sideicons-btn">
                            <i class="fa-solid fa-cube fa-bounce"></i>
                        </button>
                    </div>
                </div>

                <div class="bo">
                    <div class = "product-item">
                        <div class = "pi-text pb-4">
                            <div class = "catagory-name">'.$namecategory.'</div>
                            <a href = "'.$link.'">
                                <h5>'.$name.'</h5>
                                <span style = "display: none">1</span>
                                <div class = "product-price mt-1">'.$priceAll.'</div>
                                <div class = "product-price"><span>'.number_format($price, 0, ',', '.').' VNĐ</span></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    return $html_dssp;
}


function show_product_sale($product) {
    $html_dssp ='';
    
    foreach ($product as $pd) {
        extract($pd);
        $namecategory = get_category_name($id_category);

        $type_product = ($type == "3d") ? "details_3d" : "details_img";
        $link = "index.php?pg=" . $type_product . "&id_product=" . $id;
        $percent = percent($price,$sale);
        $arlet = ($sale == 0) ? '<div class="sale pp-sale">Liên Hệ</div>' : '<div class="sale pp-sale">Sale ' . $percent . '%</div>';

        $html_dssp .=
        '<div class="col-xl-4 col-lg-6 col-sm-12 mb-4">
            <div class="product-single-card">
                <div class="product-top-area">
                    <div class = "product-item">
                        <div class = "pi-pic">
                            <a href="'.$link.'">
                                <div class="product-img">
                                    <div class="first-view"><img src="Asset/upload/img/'.$img.'" alt="logo"></div>
                                    <div class="hover-view"><img src="Asset/upload/img/'.$img2.'" alt="logo"></div>
                                </div>  
                            </a>
                            '.$arlet.'
                        </div>
                    </div>

                    <div class="sideicons">
                        <button type="submit" name="add_like" class="sideicons-btn">
                            <div class = "icon1 icon-heart"><i class="fa-regular fa-heart fa-beat"></i></div>
                        </button>

                        <form action="index.php?pg=add_cart" method="post">
                            <input type="hidden" name="id" value="'.$id.'">
                            <input type="hidden" name="name" value="'.$name.'">
                            <input type="hidden" name="img" value="'.$img.'" >
                            <input type="hidden" name="price" value="'.$price.'" >
                            <input type="hidden" name="sale" value="'.$sale.'" >

                            <button type="submit" name="add_cart_homepage" class="sideicons-btn">
                                <ul>
                                    <li class = "w-icon active">
                                        <a href = "#" class = "add-cart1">
                                            <i class="fa-solid fa-cart-shopping fa-shake"></i>
                                        </a>
                                    </li>
                                </ul>
                            </button>
                        </form>

                        <button class="sideicons-btn">
                            <i class="fa-solid fa-cube fa-bounce"></i>
                        </button>
                    </div>
                </div>

                <div class="bo">
                    <div class = "product-item">
                        <div class = "pi-text">
                            <div class = "catagory-name">'.$namecategory.'</div>
                            <a href = "'.$link.'">
                                <h5>'.$name.'</h5>
                                <span style = "display: none">1</span>
                                <div class = "product-price mt-1">'.number_format($sale, 0, ',', '.').' VNĐ</div>
                                <div class = "product-price"><span>'.number_format($price, 0, ',', '.').' VNĐ</span></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    return $html_dssp;
}

function get_product_view($type,$limit){
    $sql = "SELECT * FROM product WHERE type=? ORDER BY view DESC limit ".$limit;
    return pdo_query($sql,$type);
}

function get_product_new($type,$limit){
    $sql = "SELECT * FROM product WHERE type=? ORDER BY id DESC limit ".$limit;
    return pdo_query($sql,$type);
}

function get_product_old($type,$limit){
    $sql = "SELECT * FROM product WHERE type=? ORDER BY id ASC limit ".$limit;
    return pdo_query($sql,$type);
}

function get_product_low($type,$limit){
    $sql = "SELECT * FROM product WHERE type=? ORDER BY sale ASC limit ".$limit;
    return pdo_query($sql,$type);
}

function get_product_hi($type,$limit){
    $sql = "SELECT * FROM product WHERE type=? ORDER BY sale DESC limit ".$limit;
    return pdo_query($sql,$type);
}

function get_product_a_z($type,$limit){
    $sql = "SELECT * FROM product WHERE type=? ORDER BY name ASC limit ".$limit;
    return pdo_query($sql,$type);
}

function get_product_z_a($type,$limit){
    $sql = "SELECT * FROM product WHERE type=? ORDER BY name DESC limit ".$limit;
    return pdo_query($sql,$type);
}

function get_product_category($type,$iddm,$limit){
    $sql = "SELECT * FROM product WHERE type=? AND id_category =?  ORDER BY id DESC limit ".$limit;
    return pdo_query($sql,$type,$iddm);
}

function show_product_alert($name,$img,$category){
    return "<script>
                const mockProduct = {
                    name: '$name',
                    image: 'Asset/upload/img/$img',
                    category: '$category' };
                const mockQuantity = 1;
                function simulateAddToCartNotification() {
                    showPopup(mockProduct, mockQuantity);
                }
                simulateAddToCartNotification();
            </script>
            ";
}

function get_product_id($id,$type){
    $sql = "SELECT * FROM product WHERE id=? AND type=?";
    return pdo_query_one($sql, $id,$type);
}

function get_product_like_name($name, $limit) {
    $sql = "SELECT * FROM product WHERE name LIKE ? LIMIT ?";
    $searchTerm = '%' . $name . '%';

    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $searchTerm, PDO::PARAM_STR);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        $rows = $stmt->fetchAll();
        return $rows;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}


// ==============================Cart================================
function show_cart($product) {
    $html_dssp ='';
    $stt=0;
    $type_product ='';
    foreach ($product as $pd) {
        extract($pd);
        $pricenew = (int) preg_replace('/[^0-9]/', '', $priceAll);

        $price_All = ($pricenew == 0) ? $sale : $pricenew;

        $option1 = ($radioValue1 == "") ? "Normal" : $radioValue1;
        $option2 = ($radioValue2 == "") ? "" : $radioValue2;
        $option3 = ($radioValue3 == "") ? "" : $radioValue3;

        $type_product = ($type == "3d") ? "details_3d" : "details_img";
        $link = "index.php?pg=" . $type_product . "&id_product=" . $id;
        $html_dssp .= 
        '<div class="card mb-4" id="cart_number">
            <div class="card-body p-4">
                <div class="row align-items-center text-center">
                    <div class="col-md-3 col-12 px-0">
                        <a href="'.$link.'">
                            <img src="Asset/upload/img/'.$img.'" class="img-fluid" width="250px">
                        </a>

                        <p class="lead fw-normal">'.$name.'</p>

                        <button id="'.$stt.'" type="button" class="delete-button delete-bt text-center">
                            <svg class="delete-svgIcon" viewBox="0 0 448 512">
                            <path
                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z">
                            </path>
                            </svg>
                        </button>
                    </div>

                    <div class="col-md-2 col-6 d-flex justify-content-center mt-3 px-0">
                        <div>
                            <p style="font-weight: 900; color:black">Options</p>
                            <p class="lead fw-normal">'.$option1.'</p>
                            <p class="lead fw-normal">'.$option2.'</p>
                            <p class="lead fw-normal">'.$option3.'</p>
                        </div>
                    </div>

                    <div class="col-md-2 col-6 d-flex justify-content-center mt-3 px-0">
                        <div>
                            <p style="font-weight: 900; color:black">Quantity</p>
                            <div class="quantity">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus" style="display: none;">
                                    <input type="number" step="1" min="1" max="" name="quantity_'.$id.'"
                                        value="1" title="Qty" class="input-text qty text" size="4" pattern=""
                                        inputmode="" data-id="'.$id.'" id="quantity_'.$id.'">
                                    <input type="button" value="+" class="plus" style="display: none;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-6 d-flex justify-content-center mt-3 px-0">
                        <div>
                            <p style="font-weight: 900; color:black">Price</p>
                            <p class="lead fw-normal sale-price" id="sale_'.$id.'"> <span>'.$price_All.'</span>  VNĐ</p>
                        </div>
                    </div>

                    <div class="col-md-2 col-6 d-flex justify-content-center mt-3 px-0">
                        <div>
                            <p style="font-weight: 900; color:black">Total</p>
                            <p class="lead fw-normal" id="price_'.$id.'" style="color: red;" > <span>'.$price_All.'</span> VNĐ</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>';
        $stt ++;
    }

    return $html_dssp;
}

function show_like($product) {
    $html_dssp ='';
    $stt=0;
    $type_product ='';
    foreach ($product as $pd) {
        extract($pd);
        $type_product = ($type == "3d") ? "details_3d" : "details_img";
        $link = "index.php?pg=" . $type_product . "&id_product=" . $id;
        $html_dssp .= 
        '<div class="card mb-4" id="cart_number">
            <div class="card-body p-4">
                <div class="row align-items-center text-center">
                    <div class="col-md-3 col-12 px-0">
                        <a href="'.$link.'"><img src="Asset/upload/img/'.$img.'" class="img-fluid" width="250px"></a>
                        <p class="lead fw-normal">'.$name.'</p>
                    </div>

                    <div class="col-md-2 col-6 d-flex justify-content-center mt-3 px-0">
                        '.$price.'
                    </div>

                    <div class="col-md-2 col-6 d-flex justify-content-center mt-3 px-0">
                        '.$sale.'
                    </div>

                    <div class="col-md-3 col-6 d-flex justify-content-center mt-3 px-0">
                        <i class="fa-regular fa-cart-plus fa-2xl"></i>
                    </div>

                    <div class="col-md-2 col-6 d-flex justify-content-center mt-3 px-0">
                        <button id="'.$id.'" type="button" class="delete-button delete-like text-center">
                            <svg class="delete-svgIcon" viewBox="0 0 448 512">
                            <path
                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z">
                            </path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>';
        $stt ++;
    }

    return $html_dssp;
}

function show_cart_checkout($product) {
    $html_dssp ='';
    foreach ($product as $pd) {
        extract($pd);

        $pricenew = (int) preg_replace('/[^0-9]/', '', $priceAll);
        $price_All = ($pricenew == 0) ? $sale : $pricenew;

        // Option
        $option1 = ($radioValue1 == "") ? "Normal" : $radioValue1;
        $option2 = ($radioValue2 == "") ? "" : " + ".$radioValue2;
        $option3 = ($radioValue3 == "") ? "" : " + ".$radioValue3;


        $count = $price_All * $quantities;
        $html_dssp .= 
        '<div class="border_product mt-3 mb-2">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h6>'.$name.'</h6>
                    <h7 class="mt-3">Option: '.$option1.$option2.$option3.'</h7>
                </div>
                
                <div class="col-5 img-checkout">
                    <img src="Asset/upload/img/'.$img.'">
                </div>

                <div class="col-7">
                    <p class="mt-3">Quantity: '.$quantities.'</p>
                    <p>'.number_format($count, 0, ',', '.').' VNĐ</p>
                </div>
            </div>
        </div>';
    }

    return $html_dssp;
}

function show_cart_success($product) {
    $html_dssp ='';
    foreach ($product as $pd) {
        extract($pd);
        $pricenew = (int) preg_replace('/[^0-9]/', '', $priceAll);
        $price_All = ($pricenew == 0) ? $sale : $pricenew;


        $option1 = ($radioValue1 == "") ? "Normal" : $radioValue1;
        $option2 = ($radioValue2 == "") ? "" : " + ".$radioValue2;
        $option3 = ($radioValue3 == "") ? "" : " + ".$radioValue3;

        $count = $price_All * $quantities;
        $html_dssp .= 
        '<div class="row">
            <div class = "col-lg-2 px-0">
                <img src = "Asset/upload/img/'.$img.'" width = 80px>
            </div>
            <div class = "col-lg-4 px-0">
                <h6>'.$name.'</h6>
                <p class = "mt-2">Options: '.$option1.$option2.$option3.'</p>
            </div>
            <div class = "col-6 col-lg-3 px-0">
                <p>Quantity: '.$quantities.'</p>
            </div>
            <div class = "col-6 col-lg-3 px-0">
                <p style = "color: crimson">'.number_format($count, 0, ',', '.').' VNĐ</p>
            </div>
        </div>';
    }

    return $html_dssp;
}

function get_count_price(){
    $count = 0;
    foreach ($_SESSION['cart_product'] as $sp) {
        extract($sp);
        $pricenew = (int) preg_replace('/[^0-9]/', '', $priceAll);
        $price_All = ($pricenew == 0) ? $price : $pricenew;

        $count_price = ((double)$price_All * (double)$quantities) + ((double)$price - (double)$sale);
        $count = (double)$count + $count_price;
    }
    return $count;
}

function get_count_sale(){
    $count = 0;
    foreach ($_SESSION['cart_product'] as $sp) {
        extract($sp);
        $pricenew = (int) preg_replace('/[^0-9]/', '', $priceAll);
        $price_All = ($pricenew == 0) ? $sale : $pricenew;

        $count_sale = (double)$price_All * (double)$quantities;
        $count = (double)$count + $count_sale;
    }
    return $count;
}

function get_discount($price,$sale){
    return $price - $sale;
}

function get_discount_percent($price,$sale){
    if ($price <= 0 || $sale <= 0 || $sale >= $price) {
        return 0; // Trả về 0 nếu giá gốc hoặc giá giảm không hợp lệ
    }
    $percent = (($price - $sale) / $price) * 100;
    return $percent;
}


function add_user_checkout($name, $password, $email, $address, $phone){
    $sql = "INSERT INTO users (name, password, email, address, phone) VALUES (?,?,?,?,?)";
    return pdo_execute_id($sql,$name, $password, $email, $address, $phone);
}

function check_user_bill($email){
    $sql="SELECT * FROM users WHERE email=?";
    return pdo_query_one($sql, $email);
}

function update_user_bill($address, $phone, $email){
    $sql = "UPDATE users SET address =?, phone=? WHERE email=?";
    return pdo_execute_id($sql, $address, $phone,$email); 
}

function get_user_bill($email){
    $sql = "SELECT id FROM users WHERE email=?";
    $result = pdo_query_one($sql, $email);
    if ($result && isset($result['id'])) {
        return $result['id'];
    } else {
        return null;
    }
}

// Hàm lấy sản phẩm liên quan
function get_dssp_lienquan($iddm, $id, $type, $limit){
    $sql = "SELECT * FROM product WHERE id_category=? AND id<>? AND type=? ORDER BY view DESC limit ".$limit;
    return pdo_query($sql, $iddm, $id, $type);
}

// ---------------------------------------------Admin------------------------------------------------------

// Hàm show sản phẩm admin
function show_product_admin($product) {
    $html_dssp ='';
    $modal_counter = 1;
    $type_product = '';

    foreach ($product as $sp) {
        extract($sp);

        $name_category = get_category_name($id_category);

        $type_product = ($type == "3d") ? "details_3d" : "details_img";
        // $name_category ='';
        $html_dssp .= 
            '
            <tr>
                <td>'.$modal_counter.'</td>

                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_show_product_'.$modal_counter.'"> 
                        '.$name.'
                    </button>
                </td>

                <td>'.$name_category.'</td>

                <td style="color: red;">'.number_format($sale, 0, ',', '.').' VNĐ</td>

                <td><span class="status completed">Hoàn Thành</span></td>

                <td>
                    <a href="indexadmin.php?pg=del_product&id='.$id.'"><i class="bx bx-x-circle"></i></a>
                    <a href="indexadmin.php?pg='.$type_product.'&id='.$id.'"><i style="margin-left: 20px;" class="bx bx-edit"></i></a>
                </td>
            </tr>';

        // Modal content for each product
        $html_dssp .= '
            <div class="modal fade" id="modal_show_product_'.$modal_counter.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chi Tiết Sản Phẩm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-xs-12">
                                <div class="product-single-card">
                                    <div class="product-top-area">
                                        <a href="../index.php?pg='.$type_product.'&id_product='.$id.'">
                                            <div class="product-img">
                                                <div class="first-view"><img src="'.IMG_PATH_ADMIN.''.$img.'" alt="logo" class="img-fluid"></div>
                                            </div>  
                                        </a>
                                    </div>
                                    
                                    <div class="product-info">
                                        <div>
                                            <h3 style="margin-bottom: 20px; font-size:25px">'.$name.'</h3>
                                            <h5>Danh mục: '.$name_category.'</h5>
                                            <h5>Giá Gốc: <span style="color: red;">'.number_format($price, 0, ',', '.').' VNĐ</span></h5>
                                            <h5>Giảm Giá: <span style="color: red;">'.number_format($sale, 0, ',', '.').' VNĐ</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>';

        $modal_counter++;
    }

    return $html_dssp;
}

function show_category_admin($product) {
    $html_dssp ='';
    $modal_counter = 1;
    
    foreach ($product as $sp) {
        extract($sp);
        // $name_category ='';
        $html_dssp .= 
            '
            <tr>
                <td>'.$modal_counter.'</td>
                <td>'.$name_category.'</td>
                <td>'.$stt.'</td>
                <td>
                    <a href="indexadmin.php?pg=del_category&id='.$id.'"><i class="bx bx-x-circle"></i></a>
                </td>
            </tr>';   

        $modal_counter++;
    }

    return $html_dssp;
}

function show_category_update_admin($product,$id_category) {
    $html_dssp ='';
    $modal_counter = 1;
    
    foreach ($product as $sp) {
        extract($sp);

        if($id == $id_category){
            $s="selected";
        } else{
            $s = "";
        }

        $html_dssp .= 
            '<option value="'.$id.'" '.$s.'>'.$name_category.'</option>';
        $modal_counter++;
    }

    return $html_dssp;
}

function add_category($name_category, $type, $stt){
    $sql = "INSERT INTO category(name_category, type, stt) VALUES (?,?,?)";
    pdo_execute($sql,$name_category, $type, $stt);
}


// Hàm Xóa Danh Mục
function del_category($id_category){
    $product_count = get_category_by_id($id_category);

    if ($product_count > 0) {
        $alert = alert_Info("Không Thể Xóa Danh Mục Đã Có Sản Phẩm");
    } else{
        $delete_category_sql = "DELETE FROM category WHERE id=?";
        pdo_execute($delete_category_sql, $id_category);
        $alert = alert_Success("Đã Xóa Thành Công");
    }
    return $alert;
}

function check_category($name_category){
    $sql="SELECT * FROM category WHERE name_category=?";
    return pdo_query_one($sql, $name_category);
}


function show_add_category_admin($product) {
    $html_dssp ='';
    $modal_counter = 1;
    
    foreach ($product as $sp) {
        extract($sp);
        // $name_category ='';
       
        $html_dssp .= 
            ' <option value="'.$id.'">'.$name_category.'</option>';   
        $modal_counter++;
    }

    return $html_dssp;
}


function del_product($id_category){
    $sql = "DELETE FROM product WHERE id=?";
    pdo_execute($sql, $id_category);
}

function add_product($name,$img,$img2,$glb,$price,$sale,$view,$id_category,$type,$name_op,$name1,$name2,$name3){
    $sql = "INSERT INTO product(name, img, img2, glb, price, sale, view, id_category,type, options_name, options_name_1, options_name_2, options_name_3) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    pdo_execute($sql,$name,$img,$img2,$glb,$price,$sale,$view,$id_category,$type,$name_op,$name1,$name2,$name3);
}

function add_product_img($name,$img,$img2,$price,$sale,$view,$id_category,$type){
    $sql = "INSERT INTO product(name, img, img2, price, sale, view, id_category,type) VALUES (?,?,?,?,?,?,?,?)";
    pdo_execute($sql,$name,$img,$img2,$price,$sale,$view,$id_category,$type);
}


function update_options($price1, $price2, $price3, $id) {
    $sql = "UPDATE product SET ";
    $params = [];

    if ($price1 !== "") {
        $sql .= "options_price1=?, ";
        $params[] = $price1;
    }

    if ($price2 !== "") {
        $sql .= "options_price2=?, ";
        $params[] = $price2;
    }

    if ($price3 !== "") {
        $sql .= "options_price3=?, ";
        $params[] = $price3;
    }

    if (count($params) > 0) {
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id=?";
        $params[] = $id;

        pdo_execute($sql, ...$params);
    }
}



function update_options1($name_option1, $id) {
    $string1 = get_img_option1($id);
    $string2 = $name_option1;

    $array1 = explode(',', $string1);
    $array2 = explode(',', $string2);

    foreach ($array1 as $index => $value) {
        if (empty($array2[$index]) && !empty($value)) {
            $array2[$index] = $value;
        }
    }
    $newString = implode(',', $array2);
    $sql = "UPDATE product SET options_img1 = :newString WHERE id = :id";
    
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':newString', $newString, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch(PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}



function update_options2($name_option1, $id) {
    $string1 = get_img_option1($id);
    $string2 = $name_option1;

    $array1 = explode(',', $string1);
    $array2 = explode(',', $string2);

    foreach ($array1 as $index => $value) {
        if (empty($array2[$index]) && !empty($value)) {
            $array2[$index] = $value;
        }
    }
    $newString = implode(',', $array2);
    $sql = "UPDATE product SET options_img2 = :newString WHERE id = :id";
    
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':newString', $newString, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch(PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}


function update_options3($name_option1, $id) {
    $string1 = get_img_option1($id);
    $string2 = $name_option1;

    $array1 = explode(',', $string1);
    $array2 = explode(',', $string2);

    foreach ($array1 as $index => $value) {
        if (empty($array2[$index]) && !empty($value)) {
            $array2[$index] = $value;
        }
    }
    $newString = implode(',', $array2);
    $sql = "UPDATE product SET options_img2 = :newString WHERE id = :id";
    
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':newString', $newString, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch(PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}







function update_options_img($price1, $price2, $price3, $price4, $price5, $price6,$name1, $name2, $name3, $name4, $name5, $name6, $id) {
    $sql = "UPDATE product SET ";
    $params = [];

    if ($price1 !== "") {
        $sql .= "options_price1=?, ";
        $params[] = $price1;
    }

    if ($price2 !== "") {
        $sql .= "options_price2=?, ";
        $params[] = $price2;
    }

    if ($price3 !== "") {
        $sql .= "options_price3=?, ";
        $params[] = $price3;
    }

    if ($price4 !== "") {
        $sql .= "options_price4=?, ";
        $params[] = $price4;
    }

    if ($price5 !== "") {
        $sql .= "options_price5=?, ";
        $params[] = $price5;
    }

    if ($price6 !== "") {
        $sql .= "options_price6=?, ";
        $params[] = $price6;
    }

    if ($name1 !== "") {
        $sql .= "options_name_1=?, ";
        $params[] = $name1;
    }
    if ($name2 !== "") {
        $sql .= "options_name_2=?, ";
        $params[] = $name2;
    }
    if ($name3 !== "") {
        $sql .= "options_name_3=?, ";
        $params[] = $name3;
    }
    if ($name4 !== "") {
        $sql .= "options_name_4=?, ";
        $params[] = $name4;
    }
    if ($name5 !== "") {
        $sql .= "options_name_5=?, ";
        $params[] = $name5;
    }
    if ($name6 !== "") {
        $sql .= "options_name_6=?, ";
        $params[] = $name6;
    }

    // Loại bỏ dấu phẩy và khoảng trắng cuối nếu có giá trị giá cả được cập nhật
    if (count($params) > 0) {
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id=?";
        $params[] = $id;

        pdo_execute($sql, ...$params);
    }
}


// function update_checkbox_option($data, $data1, $data2, $data3, $id) {
//     $sql = "UPDATE product SET ";
//     $params = [];

//     if ($data !== "") {
//         $sql .= "options_name=?, ";
//         $params[] = $data;
//     }
//     if ($data1 !== "") {
//         $sql .= "options_name_1=?, ";
//         $params[] = $data1;
//     }
//     if ($data2 !== "") {
//         $sql .= "options_name_2=?, ";
//         $params[] = $data2;
//     }
//     if ($data3 !== "") {
//         $sql .= "options_name_3=?, ";
//         $params[] = $data3;
//     }

//     // Loại bỏ dấu phẩy và khoảng trắng cuối nếu có giá trị giá cả được cập nhật
//     if (count($params) > 0) {
//         $sql = rtrim($sql, ', ');
//         $sql .= " WHERE id=?";
//         $params[] = $id;

//         pdo_execute($sql, ...$params);
//     }
// }


function update_checkbox_option($data, $data1, $data2, $data3, $id) {
    $sql = "UPDATE product SET options_name=?, options_name_1=?, options_name_2=?,options_name_3=? WHERE id=?";
    return pdo_execute($sql, $data, $data1, $data2, $data3, $id);
}







function get_img_option1($id){
    $sql = "SELECT options_img1 FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['options_img1'])) {
        return $result['options_img1'];
    } else {
        return null;
    }
}


function get_img_option2($id){
    $sql = "SELECT options_img2 FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['options_img2'])) {
        return $result['options_img2'];
    } else {
        return null;
    }
}


function get_img_option3($id){
    $sql = "SELECT options_img3 FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['options_img3'])) {
        return $result['options_img3'];
    } else {
        return null;
    }
}

function get_img_option4($id){
    $sql = "SELECT options_img4 FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['options_img4'])) {
        return $result['options_img4'];
    } else {
        return null;
    }
}

function get_img_option5($id){
    $sql = "SELECT options_img5 FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['options_img5'])) {
        return $result['options_img5'];
    } else {
        return null;
    }
}
function get_img_option6($id){
    $sql = "SELECT options_img6 FROM product WHERE id=?";
    $result = pdo_query_one($sql, $id);
    if ($result && isset($result['options_img6'])) {
        return $result['options_img6'];
    } else {
        return null;
    }
}



function update_status_bill($status,$id) {
    $sql = "UPDATE bill SET type=? WHERE id=?";
    pdo_execute($sql,$status,$id);
}

function update_options4($name_option1, $id) {
    $sql = "UPDATE product SET ";
    $params = [];

    if ($name_option1 !== "") {
        $sql .= "options_img4=?, ";
        $params[] = $name_option1;
    }

    if (count($params) > 0) {
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id=?";
        $params[] = $id;

        pdo_execute($sql, ...$params);
    }
}

function update_options5($name_option1, $id) {
    $sql = "UPDATE product SET ";
    $params = [];

    if ($name_option1 !== "") {
        $sql .= "options_img5=?, ";
        $params[] = $name_option1;
    }

    if (count($params) > 0) {
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id=?";
        $params[] = $id;

        pdo_execute($sql, ...$params);
    }
}
function update_options6($name_option1, $id) {
    $sql = "UPDATE product SET ";
    $params = [];

    if ($name_option1 !== "") {
        $sql .= "options_img6=?, ";
        $params[] = $name_option1;
    }

    if (count($params) > 0) {
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id=?";
        $params[] = $id;

        pdo_execute($sql, ...$params);
    }
}


function update_product($name, $img, $img2, $glb, $price, $sale, $view, $id_category,$detail, $id) {
    $sql = "UPDATE product SET name=?,";
    $params = array($name);

    if (!empty($img)) {
        $sql .= "img=?,";
        $params[] = $img;
    }

    if (!empty($img2)) {
        $sql .= "img2=?,";
        $params[] = $img2;
    }

    if (!empty($glb)) {
        $sql .= "glb=?,";
        $params[] = $glb;
    }

    $sql .= "price=?, sale=?, view=?, id_category=?,detail=? WHERE id=?";
    $params = array_merge($params, array($price, $sale, $view, $id_category,$detail, $id));

    pdo_execute($sql, ...$params);
}



function update_product_img($name, $img, $img2, $price, $sale, $view,$id_category,$detail, $id) {
    $sql = "UPDATE product SET name=?,";
    $params = array($name);

    if (!empty($img)) {
        $sql .= "img=?,";
        $params[] = $img;
    }

    if (!empty($img2)) {
        $sql .= "img2=?,";
        $params[] = $img2;
    }

    $sql .= "price=?, sale=?, view=?, id_category=?, detail=? WHERE id=?";
    $params = array_merge($params, array($price, $sale, $view,$id_category, $detail,$id));

    pdo_execute($sql, ...$params);
}

function update_home($home1, $home2, $home3, $deal1, $login1, $login2, $login3){
    $sql = "UPDATE home SET ";
    $params = array();

    // Xây dựng câu lệnh SQL dựa trên các biến không rỗng
    if (!empty($home1)) {
        $sql .= "home1=?, ";
        $params[] = $home1;
    }
    if (!empty($home2)) {
        $sql .= "home2=?, ";
        $params[] = $home2;
    }
    if (!empty($home3)) {
        $sql .= "home3=?, ";
        $params[] = $home3;
    }
    if (!empty($deal1)) {
        $sql .= "deal1=?, ";
        $params[] = $deal1;
    }
    if (!empty($login1)) {
        $sql .= "login1=?, ";
        $params[] = $login1;
    }
    if (!empty($login2)) {
        $sql .= "login2=?, ";
        $params[] = $login2;
    }
    if (!empty($login3)) {
        $sql .= "login3=?, ";
        $params[] = $login3;
    }

    $sql = rtrim($sql, ", ") . " WHERE id=1";
    pdo_execute($sql, ...$params);
}

function get_all_home(){
    $sql = "SELECT * FROM home WHERE id=1";
    return pdo_query($sql);
}

function get_category_count($type){
    $sql = "SELECT COUNT(*) as total FROM category WHERE type=?";
    return pdo_query($sql,$type);
}

function get_product_count($type){
    $sql = "SELECT COUNT(*) as total FROM product WHERE type=?";
    return pdo_query($sql,$type);
}

function get_bill_count(){
    $sql = "SELECT COUNT(*) as total FROM bill";
    return pdo_query_value($sql);
}

function get_total_doanhthu(){
    $sql = "SELECT SUM(total) AS total_sum FROM bill";
    return pdo_query_value($sql);
}

function get_user_count(){
    $sql = "SELECT COUNT(*) as total FROM users";
    return pdo_query_value($sql);
}

function get_category_by_id($id_category){
    $sql = "SELECT COUNT(*) as total FROM product WHERE id_category = ?";
    return pdo_query_value($sql,$id_category);
}




