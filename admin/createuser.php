<?php
ob_start();
session_start();


if(!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin')) {
     header("location:../login.php");
       exit;}
    
include("../connection.php");
require('actions.php');

if (isset($_POST['createuser'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $result = createUser($username, $name, $email, $hashedPassword, $role);

    if ($result) {
        header("location: manageusers.php");
        exit;
    } else {
        echo mysqli_error($con);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Create User</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        
        <label for="role">Role:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
        </select><br><br>
        
        <input type="submit" name="createuser" value="Create User">
    </form>
</body>
</html>
