<?php
include_once 'pdo.php';

function get_all_home(){
    $sql = "SELECT * FROM home WHERE id=1";
    return pdo_query($sql);
}

function check_email($email){
    $sql="SELECT email FROM users WHERE email=?";
    return pdo_query_one($sql, $email);
}

function check_user($email,$password){
    $sql="SELECT * FROM users WHERE email=? AND password=?";
    return pdo_query_one($sql, $email,$password);
}

function check_code($email){
    $sql="SELECT code, status FROM users WHERE email=?";
    return pdo_query_one($sql, $email);
}

function add_user($name, $email, $password, $code, $status){
    $sql = "INSERT INTO users (name, email, password, code, status) VALUES (?,?,?,?,?)";
    return pdo_execute($sql, $name, $email, $password, $code, $status);
}

function update_code($code,$email){
    $sql = "UPDATE users SET code =? WHERE email=?";
    pdo_execute($sql, $code, $email);    
}

function update_status($status,$email){
    $sql = "UPDATE users SET status =? WHERE email=?";
    pdo_execute($sql, $status, $email); 
}

function update_user($password, $email){
    $sql = "UPDATE users SET password =? WHERE email=?";
    pdo_execute($sql,$password, $email); 
}
?>