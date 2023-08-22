<?php
    session_start();
    if(isset($_SESSION['user_id'])&& isset($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            header("location:/adminuser.php");
            exit;}
    
    else {
         echo"<script>window.location.href='/student/home.php'</script>";
    }
}
else{
    header("location:/login.php");
    exit;
}?>
