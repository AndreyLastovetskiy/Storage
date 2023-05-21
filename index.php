<?php
session_start();

if(empty($_COOKIE['id_user'])) {
    header("Location: ./login.php");
    exit();
}

$id_agent = $_COOKIE['id_user'];
require_once("./db/db.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Главная</title>
</head>
<body>
    <a href="./logout.php">Выйти</a>
    <?php require_once("./modul/users.php") ?>
    <?php require_once("./modul/products.php") ?>
    <?php if($_COOKIE['idgroup'] == 2 || $_COOKIE['idgroup'] == 3) { ?>
        <h2>Продукты</h2>
        <?php 
        $select_products = mysqli_query($link, "SELECT `id`,`name` FROM `product`");
        $select_products = mysqli_fetch_all($select_products);

        foreach($select_products as $sp) { ?>
            <a href="./product.php?id=<?= $sp[0] ?>"><?= $sp[1] ?></a><br>
        <?php } ?>
    <?php } ?>
    <?php if($_COOKIE['idgroup'] == 3) { ?>
        <h2>Ваши Продукты</h2>
        <?php 
        $select_buy_prod = mysqli_query($link, "SELECT `id_product`,`id_agent`,`quantity` FROM `card` WHERE `id_agent` = '$id_agent'");
        $select_buy_prod = mysqli_fetch_all($select_buy_prod);

        foreach($select_buy_prod as $sbp) { 
            $name_product = $sbp[0];
            $select_product = mysqli_query($link, "SELECT * FROM `product` WHERE `id` = '$name_product'");
            $select_product = mysqli_fetch_assoc($select_product); ?>
            <a href="./product.php?id=<?= $sbp[0] ?>"><?= $select_product['name'] ?></a><br>
            <p>Количество: <?= $sbp[2] ?>шт.</p>
        <?php } ?>
    <?php } ?>

    <?php session_destroy(); ?>
</body>
</html>