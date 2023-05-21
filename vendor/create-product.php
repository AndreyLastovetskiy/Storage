<?php
session_start();

if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLog'] = "Авторизуйтесь!";
    header("Location: ../login.php");
    exit();
}
if($_COOKIE['idgroup'] != 2) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

require_once("../db/db.php");

$name = $_POST['name'];
$materials = $_POST['materials'];
$quantity = $_POST['quantity'];

$mat_text = (implode(", ", $materials));

$path = "upload/product/" . time() . $_FILES['product_img']['name'];
move_uploaded_file($_FILES['product_img']['tmp_name'], "../" . $path);

mysqli_query($link, "INSERT INTO `product`
                    (`name`, `materials`, `quantity`, `product_img`) 
                    VALUES 
                    ('$name','$mat_text','$quantity','$path')
");

header("Location: " . $_SERVER['HTTP_REFERER']);

?>