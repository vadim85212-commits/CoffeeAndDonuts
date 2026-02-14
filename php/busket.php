<?php
    include 'connect.php';
    $id = $_POST['id'];
    $k = 1; 
    if($_SESSION['user_busket'] == '0'){
        $_SESSION['user_busket'] = '';
        $str = $_SESSION['user_busket']; 
        $str .= "[[$id,$k]]";
        $_SESSION['user_busket'] = $str;
    }
    else{
        $str = $_SESSION['user_busket'];
        $sub = "[$id,$k]";
        $str = substr($str,0,-1);
        $a = stripos($str, $sub);
        if($a === false){
            $str .= ".[$id,$k]]";
            $_SESSION['user_busket'] = $str;
        }
    }
?>
