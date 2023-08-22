<?php
    session_start();
    if(isset($_SESSION['user_id'])&& isset($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            header("location:/adminuser.php");
            exit;}
    
    else {
         header("location:/student/home.php");
        exit;
    }
}
else{
    header("location:/student/home.php");
    exit;
}?>
