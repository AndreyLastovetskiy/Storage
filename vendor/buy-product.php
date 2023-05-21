<?php
session_start();

if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLog'] = "Авторизуйтесь!";
    header("Location: ../login.php");
    exit();
}
if($_COOKIE['idgroup'] != 3) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

require_once("../db/db.php");

$id_agent = $_COOKIE['id_user'];
$id_product = $_POST['id_product'];
$quantity = $_POST['quantity'];

$select_product = mysqli_query($link, "SELECT `quantity` FROM `product` WHERE `id` = '$id_product'");
$select_product = mysqli_fetch_assoc($select_product);

if(($select_product['quantity'] - $quantity) < 0) {
    $_SESSION['errBuy'] = "На складе нет такого количества данного товара!";
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    $minus = $select_product['quantity'] - $quantity;
    mysqli_query($link, "UPDATE `product` SET `quantity`='$minus' WHERE `id` = '$id_product'");
    mysqli_query($link, "INSERT INTO `card`
                        (`id_product`, `id_agent`, `quantity`) 
                        VALUES 
                        ('$id_product','$id_agent','$quantity')
    ");
    header("Location: ../index.php");
}

?>