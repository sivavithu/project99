
<?php

ob_start(); ?>
<?php 
session_start();

echo $_SESSION['color'];

print_r($_SESSION);
if (!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin')) {

    header("location:../login.php");
    ob_end_flush();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
     <h1>hi admin</h1>
    <a href="./manageusers.php"><button>manage users</button></a>
    
</body>
</html>


 

