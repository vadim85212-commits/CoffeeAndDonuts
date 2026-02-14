<?php
    include 'connect.php';
    $id = $_POST['id'];
    $p_arr = $_SESSION['user_busket'];
    $p_arr = substr($p_arr,0,-1);
    $p_arr = substr($p_arr, 1);
    $p_arr1 = explode('.', $p_arr);
    foreach($p_arr1 as $k => $v){
        $p_arr1[$k] = substr($p_arr1[$k],0,-1);
        $p_arr1[$k] = substr($p_arr1[$k], 1);
        $p_arr2[] = explode(',', $p_arr1[$k]);
    }
    $p_arr2 = array_values($p_arr2);
    foreach($p_arr2 as $key => $value){
        if($p_arr2[$key][0] == $id){
            $k = $p_arr2[$key][1];
        }
    }
    $str = $_SESSION['user_busket'];
    $r = 0;
    if (stripos($str, ".[$id,$k].")){
        $r = 1;
    }
    elseif (stripos($str, "[$id,$k].")){
        $r = 2;
    }
    elseif (stripos($str, ".[$id,$k]")){
        $r = 3;
    }
    elseif (stripos($str, "[$id,$k]")){
        $r = 4;
    }
    else{
        $r = 0;
    }      
    if($r == 1){
        $sub = ".[$id,$k].";
        $str = str_replace($sub, '.', $str);
    }
    elseif($r == 2){
        $sub = "[$id,$k].";
        $str = str_replace($sub, '', $str);
    }
    elseif($r == 3){
        $sub = ".[$id,$k]";
        $str = str_replace($sub, '', $str);
    }
    elseif($r == 4){
        $sub = "[$id,$k]";
        $str = str_replace($sub, '', $str);
    }
    if($str == '[]'){
        $str = '0';
    }
    $_SESSION['user_busket'] = $str;
?>