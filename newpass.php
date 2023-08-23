<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="newpass">
        <form action="" method="post">
            <span>enter new password</span><input type="password" name="password"><br>
            <input type="submit" name="newpass">
        </form>
    </div>

    <?php
    include ("connection.php");
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
    if(isset($_POST['newpass'])){
       if(isset($_SESSION['user_id']) && isset($_POST['password'])){
           $user=$_SESSION['user_id'];
           $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
           $sql = "UPDATE users SET password ='$password' WHERE user_id = '$user'";
           $result=mysqli_query($con,$sql);
           if(!$result){
            echo mysqli_error($con);
           }
           session_unset();
           session_destroy();
          header('location:/login.php');
           exit;
       }
    }
    ?>
</body>
</html>
