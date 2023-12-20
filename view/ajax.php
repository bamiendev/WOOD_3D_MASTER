<?php
session_start();

include "../dao/pdo.php";
include "../dao/product.php";
include "../dao/category.php";


// Live search bar
if (isset($_POST['input'])) {
    $input = $_POST['input'];

    $name_like = get_product_like_name($input, 4);

    $check = "";
    if ($name_like) {
        foreach ($name_like as $pd) {
            extract($pd);
            $check= ($type == "3d") ? "details_3d" : "details_img";
?>
        <div class="box-ss">
            <a href="index.php?pg=<?=$check?>&id_product=<?= $id ?>">
                <div class="row">
                    <div class="col-3 col-lg-3">
                        <img src="Asset/upload/img/<?= $img ?>" style="width: 100px;">
                    </div>
                    <div class="col-4 col-lg-5" style="display: flex; align-items: center;">
                        <span><?= $name ?></span>
                    </div>
                    <div class="col-5 col-lg-4 text-left" style="display: flex; align-items: center;">
                        <span style="color: red; "><?=number_format($sale, 0, ',', '.')?> VNĐ</span>
                    </div>
                </div>
            </a>
        </div>
<?php
        }
    } else {
        ?>

        <div class="box-ss">
            <a href="index.php?pg=details_3d&id_product=<?=$id?>">
                <div class="row">
                    <div class="col-12 mt-2">
                        <p class="text-center" >Không Có Sản Phẩm Tương Tự</p>
                    </div>
                </div>
            </a>
        </div>

<?php
    }
}


// Live filrer 3d
if(isset($_POST['data'])){
    $selected = $_POST['data'];
    
    if($selected == "rise"){
        $product = get_product_low("3d",9);
    } elseif($selected == "reduce") {
        $product = get_product_hi("3d",9);
    } elseif($selected == "a_z"){
        $product = get_product_a_z("3d",9);
    } elseif($selected == "z_a"){
        $product = get_product_z_a("3d",9);
    } else{
        $product = get_product_new("3d",9);
    }
    
    echo show_product($product);
}
if(isset($_POST['data_img'])){
    $selected = $_POST['data_img'];
    
    if($selected == "rise"){
        $product = get_product_low("img",9);
    } elseif($selected == "reduce") {
        $product = get_product_hi("img",9);
    } elseif($selected == "a_z"){
        $product = get_product_a_z("img",9);
    } elseif($selected == "z_a"){
        $product = get_product_z_a("img",9);
    } else{
        $product = get_product_new("img",9);
    }
    
    echo show_product_img($product);
}

if(isset($_POST['selectPorduct'])){
    $selected = $_POST['selectPorduct'];
    
    if($selected == "new"){
        $product = get_product_new("3d",9);
    } elseif($selected == "old") {
        $product = get_product_old("3d",9);
    } elseif($selected == "sale"){
        $product = get_product_a_z("3d",9);
    } elseif($selected == "view"){
        $product = get_product_view("3d",9);
    } else{
        $product = get_product_new("3d",9);
    }
    
    echo show_product($product);
}
if(isset($_POST['selectPorduct_img'])){
    $selected = $_POST['selectPorduct_img'];
    
    if($selected == "new"){
        $product = get_product_new("img",9);
    } elseif($selected == "old") {
        $product = get_product_old("img",9);
    } elseif($selected == "sale"){
        $product = get_product_a_z("img",9);
    } elseif($selected == "view"){
        $product = get_product_view("img",9);
    } else{
        $product = get_product_new("img",9);
    }
    
    echo show_product_img($product);
}

if(isset($_POST['data_category'])){
    $selected = $_POST['data_category'];
    $iddm = get_category_id($selected);
    $product = get_product_category("3d",$iddm ,9);
    echo show_product($product);
}
if(isset($_POST['data_category_img'])){
    $selected = $_POST['data_category_img'];
    $iddm = get_category_id($selected);
    $product = get_product_category("img",$iddm ,9);
    echo show_product_img($product);
}
// Live filrer 3d


// Live add cart
if(!isset($_SESSION["cart_product"])) $_SESSION["cart_product"]=[];

if (isset($_POST["id_product"])) {
    // Existing data from the form
    $id_product = $_POST["id_product"];
    $name_product = $_POST["name"];
    $img_product = $_POST["img"];
    $price_product = $_POST["price"];
    $sale_product = $_POST["sale"];
    $quantities = 1;
    $type = $_POST["type"];

    $priceAll = isset($_POST['priceAll']) ? $_POST['priceAll'] : "";
    $radioValue1 = isset($_POST['radioValue1']) ? $_POST['radioValue1'] : "";
    $radioValue2 = isset($_POST['radioValue2']) ? $_POST['radioValue2'] : "";
    $radioValue3 = isset($_POST['radioValue3']) ? $_POST['radioValue3'] : "";

    $product_exists = false;
    foreach ($_SESSION["cart_product"] as $key => $product) {
        if ($product["id"] == $id_product) {
            $_SESSION["cart_product"][$key]["priceAll"] = $priceAll;
            $_SESSION["cart_product"][$key]["radioValue1"] = $radioValue1;
            $_SESSION["cart_product"][$key]["radioValue2"] = $radioValue2;
            $_SESSION["cart_product"][$key]["radioValue3"] = $radioValue3;
            
            $product_exists = true;
            break;
        }
    }

    if (!$product_exists) {
        // Product doesn't exist, create a new entry
        $product = array(
            "id" => $id_product,
            "name" => $name_product,
            "img" => $img_product,
            "price" => $price_product,
            "sale" => $sale_product,
            "quantities" => $quantities,
            "type" => $type,
            "priceAll" => $priceAll,
            "radioValue1" => $radioValue1,
            "radioValue2" => $radioValue2,
            "radioValue3" => $radioValue3
        );
        array_push($_SESSION["cart_product"], $product);
    }

    echo sizeof($_SESSION["cart_product"]);
}

// Live checkout
if (isset($_POST["id_product_checkout"])) {
    // Existing data from the form
    $_SESSION["cart_product"]=[];

    $id_product = $_POST["id_product_checkout"];
    $name_product = $_POST["name"];
    $img_product = $_POST["img"];
    $price_product = $_POST["price"];
    $sale_product = $_POST["sale"];
    $quantities = 1;
    $type = $_POST["type"];

    $priceAll = isset($_POST['priceAll']) ? $_POST['priceAll'] : "";
    $radioValue1 = isset($_POST['radioValue1']) ? $_POST['radioValue1'] : "";
    $radioValue2 = isset($_POST['radioValue2']) ? $_POST['radioValue2'] : "";
    $radioValue3 = isset($_POST['radioValue3']) ? $_POST['radioValue3'] : "";

    $product_exists = false;
    foreach ($_SESSION["cart_product"] as $key => $product) {
        if ($product["id"] == $id_product) {
            $_SESSION["cart_product"][$key]["priceAll"] = $priceAll;
            $_SESSION["cart_product"][$key]["radioValue1"] = $radioValue1;
            $_SESSION["cart_product"][$key]["radioValue2"] = $radioValue2;
            $_SESSION["cart_product"][$key]["radioValue3"] = $radioValue3;
            
            $product_exists = true;
            break;
        }
    }

    if (!$product_exists) {
        $product = array(
            "id" => $id_product,
            "name" => $name_product,
            "img" => $img_product,
            "price" => $price_product,
            "sale" => $sale_product,
            "quantities" => $quantities,
            "type" => $type,
            "priceAll" => $priceAll,
            "radioValue1" => $radioValue1,
            "radioValue2" => $radioValue2,
            "radioValue3" => $radioValue3
        );
        array_push($_SESSION["cart_product"], $product);
    }
}

// Live del cart
if (isset($_POST["id_product_del"])) {
    $id_product_del = $_POST["id_product_del"];

    if (!is_array($id_product_del)) {
        $id_product_del = [$id_product_del];
    }

    $_SESSION["cart_product"] = array_filter($_SESSION["cart_product"], function($key) use ($id_product_del) {
        return !in_array($key, $id_product_del);
    }, ARRAY_FILTER_USE_KEY);

    $soluong = sizeof($_SESSION["cart_product"]);
    $response = array('success', $soluong);
    echo json_encode($response);
    exit;
}

// Live checkout
if(isset($_POST['province'])){
    $province = $_POST['province'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];

    $address = $ward . ', ' . $district . ', ' . $province;

    $ship = $_POST['ship'];
    $discount = $_POST['discount'];
    $total = $_POST['total'];

    $checkout = array(
        'province' => $province,
        'address' => $address,
        'ship' => $ship,
        'discount' => $discount,
        'total' => $total
    );
    
    $_SESSION['checkout'] = $checkout;
}



// Live add LIKE
if(!isset($_SESSION["like_product"])) $_SESSION["like_product"]=[];
if (isset($_POST["name_like"])) {
    $name_product = $_POST["name_like"];
    $price_product = $_POST["price"];
    $sale_product = $_POST["sale"];
    $img = $_POST["img"];
    $type = $_POST["type"];
    $id= $_POST["id"];

    $product_exists = false;
    foreach ($_SESSION["like_product"] as $key => $product) {
        if ($product["name"] == $name_product) {
            $product_exists = true;
            break;
        }
    }

    if (!$product_exists) {
        $product = array(
            "name" => $name_product,
            "price" => $price_product,
            "sale" => $sale_product,
            "type" => $type,
            "img" => $img,
            "id" => $id,
        );
        array_push($_SESSION["like_product"], $product);
    }
    echo sizeof($_SESSION["like_product"]);;
}

// live del page
if (isset($_POST["id_delPage"])) {
    $id_product_dell = $_POST["id_delPage"];

    if (!is_array($id_product_dell)) {
        $id_product_dell = [$id_product_dell];
    }

    foreach ($id_product_dell as $del_id) {
        foreach ($_SESSION["like_product"] as $key => $product) {
            if ($product['id'] == $del_id) {
                unset($_SESSION["like_product"][$key]);
            }
        }
    }

    echo count($_SESSION["like_product"]);
    exit;
}
?>
