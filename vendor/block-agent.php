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

$id_agent = $_GET['id'];

mysqli_query($link, "UPDATE `user` SET `blocked`='1' WHERE `id` = '$id_agent'");
header("Location: " . $_SERVER['HTTP_REFERER']);

?>