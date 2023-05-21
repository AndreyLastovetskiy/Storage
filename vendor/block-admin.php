<?php
session_start();

if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLog'] = "Авторизуйтесь!";
    header("Location: ../login.php");
    exit();
}
if($_COOKIE['idgroup'] != 1) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

require_once("../db/db.php");

$id_admin = $_GET['id'];

mysqli_query($link, "UPDATE `user` SET `blocked`='1' WHERE `id` = '$id_admin'");
header("Location: " . $_SERVER['HTTP_REFERER']);

?>