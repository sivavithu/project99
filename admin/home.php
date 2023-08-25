
<?php
ob_end_flush();
ob_start(); ?>
<?php 
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen

session_start();
$_SESSION['color'] = 'red';
echo $_SESSION['color'];
echo "hi", $_SESSION['user_id'];
print_r($_SESSION);
if (!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin')) {
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
