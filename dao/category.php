<?php
require_once 'pdo.php';

// ==============================Category================================
function get_category($type){
    $sql = "SELECT * FROM category WHERE type=? ORDER BY stt DESC";
    return pdo_query($sql,$type);
}


function get_category_id($iddm){
    $sql = "SELECT id FROM category WHERE name_category = ?";
    $result =  pdo_query($sql, $iddm);
    if (!empty($result)) {
        return $result[0]['id'];
    } else {
        return null;
    }
}

function get_category_name($iddm){
    $sql = "SELECT name_category FROM category WHERE id = ?";
    $result =  pdo_query($sql, $iddm);
    if (!empty($result)) {
        return $result[0]['name_category'];
    } else {
        return null;
    }
}

function show_category($product) {
    $html_dssp ='';
    foreach ($product as $pd) {
        extract($pd);
        $html_dssp .= 
        '<option value="'.$name_category.'">'.$name_category.'</option>';
    }

    return $html_dssp;
}
