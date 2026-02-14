<?php
    include 'php/connect.php';
    $sql = "UPDATE users SET user_name='".$_SESSION["user_name"]."', user_pass='".$_SESSION["user_pass"]."', 
    user_phone='".$_SESSION["user_phone"]."', user_email='".$_SESSION["user_email"]."', 
    user_busket='".$_SESSION["user_busket"]."' WHERE user_id='".$_SESSION["user_id"]."'";
    $result = mysqli_query($link, $sql);
    $page = $_SESSION['page'];
    if($page == 'admin.php'){
        $page = 'index.php';
    }

    $_SESSION = array();
    session_destroy();
    echo "<meta http-equiv='refresh' content='0;$page'>";
?>


