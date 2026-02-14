<?php
    session_start();
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'coffee';

    $link = mysqli_connect($server, $username, $password, $database);
    mysqli_query($link, "SET NAMES 'utf8'");
    if ($link == false){
        print('Ошибка: Невозможно подключиться к MySQL ' . mysqli_connect_error());
    }
    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']){}
    else{
        $_SESSION['role'] = 'guest';
    }
?>
