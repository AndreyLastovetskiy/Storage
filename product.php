<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    header("Location: ./login.php");
    exit();
}

require_once("./db/db.php");
$id_product = $_GET['id'];
$select_product = mysqli_query($link, "SELECT * FROM `product` WHERE `id` = '$id_product'");
$select_product = mysqli_fetch_assoc($select_product);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $select_product['name'] ?></title>
</head>
<body>
    <a href="./index.php">Назад</a>
    <h1><?= $select_product['name'] ?></h1>
    <img src="<?= $select_product['product_img'] ?>" width="300px">
    <p>Состав: <?= $select_product['materials'] ?></p>
    <p>Количество на складе: <?= $select_product['quantity'] ?>шт.</p>
    <?php if($_COOKIE['idgroup'] == 2) { ?>
        <a href="./vendor/delete-product.php?id=<?= $id_product ?>">Удалить</a>
    <?php } ?>
    <h2>Заказать</h2>
    <form action="./vendor/buy-product.php" method="post">
        <input type="hidden" name="id_product" value="<?= $id_product ?>">
        <input type="text" name="quantity"  placeholder="Количество">
        <button>Заказать</button>
    </form>
    <?php if(empty($_SESSION['errBuy'])) {
        echo "";
    } else {
        echo $_SESSION['errBuy'];
    } ?>
    
    <?php session_destroy(); ?>
</body>
</html>