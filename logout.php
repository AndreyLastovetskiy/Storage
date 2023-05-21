<?php
setcookie("id_user", null, -1, "/");
setcookie("idgroup", null, -1, "/");
header("Location: ./login.php");
?>