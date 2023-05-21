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

$idgroup = 3;
$login = $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];
$blocked = 0;

$select_admin = mysqli_query($link, "SELECT * FROM `user` WHERE `login` = '$login' AND `idgroup` = '2'");
$select_admin = mysqli_fetch_assoc($select_admin);

if(empty($select_admin)) {
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($link, "INSERT INTO `user`
                        (`idgroup`, `login`, `password`, `email`, `blocked`) 
                        VALUES 
                        ('$idgroup','$login','$hash_pass','$email','$blocked')
    ");
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['errCreateAdm'] = "Такой администратор уже существует!";
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

?>