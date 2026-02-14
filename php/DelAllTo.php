<?php
    include 'connect.php';
    $id = $_POST['id'];
    $str = $_SESSION['user_busket'];
    $str = 0;
    $_SESSION['user_busket'] = $str;
?>