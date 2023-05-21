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

$select_material = mysqli_query($link, "SELECT * FROM `material` WHERE `name` = '$name'");
$select_material = mysqli_fetch_assoc($select_material);

if(empty($select_material)) {
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($link, "INSERT INTO `material`
                        (`name`) 
                        VALUES 
                        ('$name')
    ");
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['errCreateMat'] = "Такой материал уже существует!";
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

?>