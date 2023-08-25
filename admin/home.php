
<?php 

ob_start();
session_start();

echo vardump($_SESSION);
if(!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin')) {
     echo "sss";
     header("location:../login.php");
       exit;
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
    <a href="/manageusers.php"><button>manage users</button></a>
    
</body>
</html>
