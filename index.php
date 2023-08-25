<?php
    ob_start();
    session_start();
    if(isset($_SESSION['user_id'])&& isset($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            header("location:/admin/home.php");
            exit;}
    
    else if($_SESSION['role']=='student') {
        header("location:/student/home.php");
        exit;
    }
}
else{
    header("location:login.php");
    exit;
}?>
